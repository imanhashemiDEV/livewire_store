# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

A Persian (RTL, `fa` locale) e-commerce store with a storefront and an admin panel, built on **Laravel 13 + Livewire 4 single-file components**. There is no separate API layer: every page is a Livewire component rendered through `Route::livewire()`. Money is stored as integer **Rial** (`config/app.php` `currency => 'IRR'`).

## Commands

```bash
composer setup           # install, copy .env, key:generate, migrate, npm install + build
composer dev             # runs artisan serve + queue:listen + vite concurrently
composer test            # config:clear + artisan test

php artisan serve
php artisan migrate
php artisan test                                 # all tests (SQLite in-memory per phpunit.xml)
php artisan test --filter=ExampleTest            # single test by name
php artisan test tests/Feature/ExampleTest.php   # single test file
./vendor/bin/pint                                # format (Laravel preset; no pint.json)
npm run dev / npm run build                      # Vite (Tailwind 4, only app.css/app.js)

php artisan make:livewire admin::products.list   # creates resources/views/admin/products/⚡list.blade.php
php artisan make:livewire pages::store.checkout
```

`config/livewire.php` is configured for `sfc` components with the `⚡` emoji prefix, so component creation must target the `admin` or `pages` namespace.

## Livewire Architecture

- **Route → component mapping:** `Route::livewire('/admin/products', 'admin::products.list')` resolves the namespace registered in `config/livewire.php` to `resources/views/admin/products/⚡list.blade.php`. The `⚡` is dropped from the component name.
- **Single-file components** are anonymous classes extending `Livewire\Component` at the top of the `.blade.php` file, configured with attributes:
  ```php
  new #[Layout('admin::layouts.master', ['breadcrumb' => '...']), Title('...')]
  class extends Component { ... };
  ?>
  ```
  Always pass a layout: `config/livewire.php`'s fallback (`layouts::app`) does not exist. Admin components use `admin::layouts.master` (expects `$breadcrumb`); storefront components use `pages.layouts.master`.
- Common attributes: `#[Computed]` for derived query results, `#[On('event')]` for `$this->dispatch()` listeners, `#[Validate]` for property rules, `#[Url]` for query-string binding. Pagination uses `WithPagination` with custom pagination views in each layout directory.
- Admin CRUD screens follow a repeated pattern: inline create form + edit modal state (`$editX = null`), `session()->flash('success', ...)` + `LivewireAlert` on mount, `#[On('destroy-...')]` handlers, `WithPagination`, and `#[Computed]` list queries.

## Frontend Assets — Two Separate Templates

- Admin Blade views use the pre-built **Echo** admin template in `public/panel/` (CSS/JS referenced with `url('panel/...')`).
- Storefront views use the pre-built **Karin** template in `public/store/` (CSS/JS referenced with `url('store/...')`).
- `resources/css/app.css` is only the Vite/Tailwind 4 base plus Instrument Sans; it does **not** compile the utility classes used in these Blade files. Don't remove or restructure the `public/panel` / `public/store` assets, and don't expect Vite to process template classes.

## Domain Model

- **Product** has many **ProductVariant** rows (one per color/guaranty/seller). Price, discount, discount_price, stock (`count`), `sold`, and `max_sell` live on the variant. `Product` caches the cheapest active variant's pricing and `lowest_product_id` (the variant id); the storefront single-product page selects that variant by default. The admin panel approves `waiting` variants, which promotes them to `active` and refreshes the product's cached price.
- **Cart** is DB-backed and user-only; rows reference `product_variant_id`. Guests are redirected to login. Quantity is clamped by `max_sell`.
- **Order** + **OrderDetail** snapshot the buyer address, per-line seller/price/discount, and variant attributes at purchase time.
- Statuses use string-backed enums in `app/Enums/` (`ProductStatus`, `OrderStatus`, `OrderDetailsStatus`, `DiscountStatus`, `SellerStatus`, `AttributeType`) and are stored with `->value`.
- **Category** is a self-referencing tree via `Staudenmeir\LaravelAdjacencyList` (`tree()`, `toTree()`); deleting a category recursively soft-deletes children and restoring restores them.
- Most models use `SoftDeletes` and expose `..._trashed_list` admin components.
- Eloquent models declare mass assignment with Laravel 13's **`#[Fillable(...)]` attribute** (and `#[Hidden(...)]` on `User`), not the `$fillable` property. New models should follow this convention.

## Payments and Order Lifecycle

- `shetabit/payment` (config `config/payment.php`, default driver `zarinpal`). `PaymentType.driver` selects the gateway; the special `cash` driver skips the gateway.
- `pages::store.order` validates the form, creates `Order` + `OrderDetail` rows in a `DB::beginTransaction()`, then calls `Payment::via($driver)->purchase(...)` and redirects to the gateway. The gateway transaction id is saved to `orders.transaction_id`.
- Callback: `GET /payment_callback?Authority=...&Status=OK` (`pages::store.payment_callback`). It looks the order up by `transaction_id`, sets `PROCESSING` on success (increments `sold`, decrements variant `count`, activates the variant) or `FAILED` otherwise, and deletes the user's cart rows.
- `App\Helpers\helpers.php` is autoloaded globally and provides `make_slug()` and `generateRandomInteger()` (unique 6-digit `order_code`).

## Auth and Authorization

- **Fortify** with `username => 'mobile'`; there is no email login/verification. Registration collects name + mobile + password (`CreateNewUser`).
- Mobile password reset is a custom flow (`ResetPasswordByMobileController` + `UserCode` + `MelipayamakService`); the actual SMS call is currently commented out in `sendSMS()`.
- Two-factor authentication and passkeys are enabled in `config/fortify.php`.
- `/admin/*` routes (loaded in `bootstrap/app.php` with prefix `admin`) require `web`, `auth`, and the custom `admin` middleware. `AdminMiddleware` only checks the `is_admin` boolean. Some individual routes add Spatie role checks using **Persian role names**, e.g. `->middleware('role:مدیر کل|مدیر کاربران')`.
- Sidebar visibility uses `User::isSuperAdmin()` (id `1`, `is_admin`, or role `مدیر کل`) and `User::isUserAdmin()`.

## Media and Localization

- Spatie MediaLibrary, disk `private` by default (`MEDIA_DISK`). `App\Helpers\CustomPathGenerator` stores product media under `images/products/`; the CKEditor upload endpoint stores description images in `public/images/products/description/` and returns `{ "url": ... }`.
- UI text is Persian and laid out RTL (`dir="rtl"` in both layouts). Jalali dates are rendered with `Hekmatinasser\Verta` (`Verta::instance($model->created_at)->formatJalaliDate()`).
- Translation files exist under `lang/fa`; `APP_LOCALE=fa`.

## Notes / Gotchas

- `AdminMiddleware` redirects unauthorized users to `route('home')`, but no route named `home` is defined (Fortify's `home` is the path `/`). Expect a `RouteNotFoundException` there.
- `Product::brand()` currently returns `belongsTo(Category::class)` — likely a bug; `Brand::products()` is the correct direction.
- Tests are still the default Laravel examples; the commerce domain has no test coverage.
- Database is MySQL (`livewire_store`); PHPUnit overrides it to SQLite `:memory:`.
- `opencode.json` is committed and contains a provider API credential. Do not copy it into code, logs, or documentation.
