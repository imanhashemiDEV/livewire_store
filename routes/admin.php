<?php


use Illuminate\Support\Facades\Route;

Route::livewire('/', 'admin::panel.index')->name('admin.panel.index');

Route::livewire('/users', 'admin::users.list')->middleware('role:مدیر کل|مدیر کاربران')->name('admin.users.list');
Route::livewire('/user_create', 'admin::users.create')->name('admin.users.create');
Route::livewire('/user_edit/{user}', 'admin::users.edit')->name('admin.users.edit');

Route::livewire('/roles', 'admin::roles.list')->name('admin.roles.list');
Route::livewire('/user_roles/{user}', 'admin::users.user_roles')->name('admin.users.user_roles');

Route::livewire('/categories', 'admin::categories.list')->name('admin.categories.list');
Route::livewire('/trashed_categories', 'admin::categories.trashed_list')->name('admin.categories.trashed_list');

Route::livewire('/brands', 'admin::brands.list')->name('admin.brands.list');
Route::livewire('/trashed_brands', 'admin::brands.trashed_list')->name('admin.brands.trashed_list');

Route::livewire('/colors', 'admin::colors.list')->name('admin.colors.list');

Route::livewire('/tags', 'admin::tags.list')->name('admin.tags.list');
Route::livewire('/trashed_tags', 'admin::tags.trashed_list')->name('admin.tags.trashed_list');

Route::livewire('/guarranties', 'admin::guarranties.list')->name('admin.guarranties.list');
Route::livewire('/trashed_guarranties', 'admin::guarranties.trashed_list')->name('admin.guarranties.trashed_list');

Route::livewire('/sellers', 'admin::sellers.list')->name('admin.sellers.list');

Route::livewire('/products', 'admin::products.list')->name('admin.products.list');
Route::livewire('/product_create', 'admin::products.create')->name('admin.products.create');
Route::livewire('/product_edit/{product}', 'admin::products.edit')->name('admin.products.edit');
Route::livewire('/trashed_products', 'admin::products.trashed_list')->name('admin.products.trashed_list');
Route::livewire('/product_gallery/{product}', 'admin::products.gallery')->name('admin.products.gallery');
Route::livewire('/product_attributes/{product}', 'admin::products.attributes')->name('admin.products.attributes');

Route::livewire('/attributes', 'admin::attributes.list')->name('admin.attributes.list');
Route::livewire('/attribute_values/{attribute}', 'admin::attributes.values')->name('admin.attributes.values');
