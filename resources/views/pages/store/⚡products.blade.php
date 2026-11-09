<?php

use App\Models\Product;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

new #[Layout('pages.layouts.master'), Title('فروشگاه')]
class extends Component {

    use WithPagination;

    public string $sort = 'newest';

    public array $selectedCategory =[];

    #[Computed]
    public function categories(): \Illuminate\Database\Eloquent\Collection
    {
        return \App\Models\Category::query()->get();
    }

    public function updatedSort(): void
    {
        $this->resetPage();
    }

    #[Computed]
    public function products()
    {
        $query = Product::query()->activeProduct()
            ->when($this->selectedCategory , fn($q)=> $q->whereIn('category_id', $this->selectedCategory) );


        return match ($this->sort) {
            'cheapest' => $query->orderBy('discount_price')->paginate(6),
            'expensive' => $query->orderByDesc('discount_price')->paginate(6),
            'viewed' => $query->orderByDesc('viewed')->paginate(6),
            'sold' => $query->orderByDesc('sold')->paginate(6),
            default => $query->orderByDesc('created_at')->paginate(6),
        };
    }

    public function clearFilters()
    {
      $this->reset('selectedCategory');
      $this->resetPage();
    }

    public function sortTitle(): string
    {
        return match ($this->sort) {
            'cheapest' => 'ارزان ترین',
            'expensive' => 'گران ترین',
            'viewed' => 'پربازدیدترین',
            'sold' => 'پرفروش ترین',
            default => 'جدیدترین',
        };
    }
};
?>

<main class="container">
    <!-- Breadcrumb -->
    <nav class="flex mt-8" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
            <li class="inline-flex items-center">
                <a href="#"
                   class="inline-flex items-center text-sm gap-x-1  text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                    <svg class="size-4 mb-0.5">
                        <use href="#home"/>
                    </svg>
                    صفحه اصلی
                </a>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="m1 9 4-4-4-4"/>
                    </svg>
                    <span class="ms-1 text-sm  text-gray-500 md:ms-2 dark:text-gray-400">فروشگاه</span>
                </div>
            </li>
        </ol>
    </nav>

    <div class="flex flex-col lg:flex-row gap-4 mt-5">
        <!-- SIDE FILTER BOX -->
        <div
            class="lg:sticky top-1 h-fit lg:w-1/4 hidden lg:flex flex-col gap-y-4 items-center shadow rounded-lg py-4 dark:bg-gray-800 bg-white">
            <!-- TITLE -->
            <div class="flex items-center justify-between w-full px-2 xl:px-4">
                    <span class="flex items-center gap-x-1">
                        <p class="font-DanaMedium text-gray-700 dark:text-gray-200 text-lg">فیلترها
                        </p>
                    </span>
                <p wire:click="clearFilters"  class="text-blue-500 dark:text-blue-400 text-sm cursor-pointer"> حذف فیلتر‌ها</p>
            </div>
            <!-- FILTERS -->
            <div class="w-full divide-y divide-slate-200 dark:divide-gray-700/20">
                <!-- Accordion -->
                <div class="">
                    <button onclick="toggleAccordion(1)"
                            class="w-full flex justify-between items-center px-2 xl:px-4 pt-4 mb-4 text-gray-800 dark:text-gray-100">
                        <span>دسته بندی </span>
                        <span id="icon-1" class="text-gray-800 dark:text-gray-100">
                                <svg class="size-4 transition-transform duration-300">
                                    <use href="#chevron-left"></use>
                                </svg>
                            </span>
                    </button>
                    <div id="content-1" class="max-h-0 overflow-hidden transition-all duration-300 ease-in-out">
                        <div class="pb-3 text-gray-700 dark:text-gray-300 w-full flex flex-col gap-y-1.5">
                            @foreach($this->categories as $category)
                                <div class="inline-flex items-center mr-2.5 mt-1">
                                    <label class="relative flex cursor-pointer items-center rounded-full p-3"
                                           for="ripple-on" data-ripple-dark="true">
                                        <input wire:model.live="selectedCategory" value="{{$category->id}}" id="ripple-on" type="checkbox"
                                               class="peer relative h-5 w-5 cursor-pointer appearance-none rounded border border-slate-300 shadow hover:shadow-md transition-all before:absolute before:top-2/4 before:left-2/4 before:block before:h-12 before:w-12 before:-translate-y-2/4 before:-translate-x-2/4 before:rounded-full before:bg-slate-400 before:opacity-0 before:transition-opacity checked:border-blue-500 checked:bg-blue-500 checked:before:bg-slate-400 hover:before:opacity-10 dark:bg-gray-600 dark:checked:bg-blue-500 darKchecked:bg-blue-500  "/>
                                        <span
                                            class="pointer-events-none absolute top-2/4 left-2/4 -translate-y-2/4 -translate-x-2/4 text-white opacity-0 transition-opacity peer-checked:opacity-100">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5"
                                                 viewBox="0 0 20 20" fill="currentColor" stroke="currentColor"
                                                 stroke-width="1">
                                                <path fill-rule="evenodd"
                                                      d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                      clip-rule="evenodd"></path>
                                            </svg>
                                        </span>
                                    </label>
                                    <label class="cursor-pointer text-gray-800 dark:text-gray-400 mr-1" for="ripple-on">
                                       {{$category->title}}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- TOP FILTER BOX & PRODUCT & PAGINATION -->
        <div class="lg:w-3/4">
            <!-- MOBILE FILTERS -->
            <div class="flex lg:hidden items-center gap-x-2">
                <!-- SORT BTN -->
                <button
                    class="sort-modal-open text-sm mb-4 py-1.5 px-3 app-border rounded-full flex items-center gap-x-1">
                    <svg class="size-4 text-gray-400">
                        <use href="#sort-list"></use>
                    </svg>
                    <p>{{$this->sortTitle()}}</p>
                </button>
                <!-- SORT MODAL -->
                <div class="sort-modal">
                    <div class="flex justify-between sort-modal-close">
                        <p>مرتب سازی بر اساس </p>
                        <svg class="size-5 text-gray-800 dark:text-gray-300">
                            <use href="#x-mark"></use>
                        </svg>
                    </div>
                    <ul class="flex w-full child:w-full child:text-center flex-col items-center justify-center divide-y divide-gray-300 dark:divide-gray-200/20 child:py-3">
                        <li wire:click="$set('sort','newest')" class="{{ $sort === 'newest' ? 'text-blue-500' : '' }}">
                            جدیدترین
                        </li>
                        <li wire:click="$set('sort','cheapest')"
                            class="{{ $sort === 'cheapest' ? 'text-blue-500' : '' }}">ارزان‌ترین
                        </li>
                        <li wire:click="$set('sort','expensive')"
                            class="{{ $sort === 'expensive' ? 'text-blue-500' : '' }}">گران‌ترین
                        </li>
                        <li wire:click="$set('sort','viewed')" class="{{ $sort === 'viewed' ? 'text-blue-500' : '' }}">
                            پربازدیدترین
                        </li>
                        <li wire:click="$set('sort','sold')" class="{{ $sort === 'sold' ? 'text-blue-500' : '' }}">
                            پرفروش‌ترین
                        </li>
                    </ul>
                </div>
                <!-- FILTER BTN -->
                <button
                    class="filter-modal-open text-sm mb-4 py-1.5 px-3 app-border rounded-full flex items-center gap-x-1">
                    <svg class="size-4 text-gray-400">
                        <use href="#filter"></use>
                    </svg>
                    <p>فیلتر</p>
                </button>
                <!-- Filter MODAL -->
                <div class="filter-modal">
                    <div class="flex justify-between filter-modal-close">
                        <p>فیلتر</p>
                        <svg class="size-5 text-gray-800 dark:text-gray-300">
                            <use href="#x-mark"></use>
                        </svg>
                    </div>
                    <!-- FILTERS -->
                    <div class="w-full divide-y divide-slate-200 dark:divide-gray-700/20">
                        <!-- Accordion -->
                        <div class="">
                            <button onclick="toggleAccordion(3)"
                                    class="w-full flex justify-between items-center px-2 xl:px-4 pt-4 mb-4 text-gray-800 dark:text-gray-100">
                                <span>دسته بندی </span>
                                <span id="icon-1" class="text-gray-800 dark:text-gray-100">
                                <svg class="size-4 transition-transform duration-300">
                                    <use href="#chevron-left"></use>
                                </svg>
                            </span>
                            </button>
                            <div id="content-3" class="max-h-0 overflow-hidden transition-all duration-300 ease-in-out">
                                <div class="pb-3 text-gray-700 dark:text-gray-300 w-full flex flex-col gap-y-1.5">
                                    <!-- item -->
                                    <div class="inline-flex items-center mr-2.5 mt-1">
                                        <label class="relative flex cursor-pointer items-center rounded-full p-3"
                                               for="ripple-5" data-ripple-dark="true">
                                            <input id="ripple-5" type="checkbox"
                                                   class="peer relative h-5 w-5 cursor-pointer appearance-none rounded border border-slate-300 shadow hover:shadow-md transition-all before:absolute before:top-2/4 before:left-2/4 before:block before:h-12 before:w-12 before:-translate-y-2/4 before:-translate-x-2/4 before:rounded-full before:bg-slate-400 before:opacity-0 before:transition-opacity checked:border-blue-500 checked:bg-blue-500 checked:before:bg-slate-400 hover:before:opacity-10 dark:bg-gray-600 dark:checked:bg-blue-500 darKchecked:bg-blue-500  "/>
                                            <span
                                                class="pointer-events-none absolute top-2/4 left-2/4 -translate-y-2/4 -translate-x-2/4 text-white opacity-0 transition-opacity peer-checked:opacity-100">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5"
                                                 viewBox="0 0 20 20" fill="currentColor" stroke="currentColor"
                                                 stroke-width="1">
                                                <path fill-rule="evenodd"
                                                      d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                      clip-rule="evenodd"></path>
                                            </svg>
                                        </span>
                                        </label>
                                        <label class="cursor-pointer text-gray-800 dark:text-gray-400 mr-1"
                                               for="ripple-5">
                                            همه کالاها
                                        </label>
                                    </div>
                                    <!-- item -->
                                    <div class="inline-flex items-center mr-2.5">
                                        <label class="relative flex cursor-pointer items-center rounded-full p-3"
                                               for="ripple-6" data-ripple-dark="true">
                                            <input id="ripple-6" type="checkbox"
                                                   class="peer relative h-5 w-5 cursor-pointer appearance-none rounded border border-slate-300 shadow hover:shadow-md transition-all before:absolute before:top-2/4 before:left-2/4 before:block before:h-12 before:w-12 before:-translate-y-2/4 before:-translate-x-2/4 before:rounded-full before:bg-slate-400 before:opacity-0 before:transition-opacity checked:border-blue-500 checked:bg-blue-500 checked:before:bg-slate-400 hover:before:opacity-10 dark:bg-gray-600 dark:checked:bg-blue-500 darKchecked:bg-blue-500  "/>
                                            <span
                                                class="pointer-events-none absolute top-2/4 left-2/4 -translate-y-2/4 -translate-x-2/4 text-white opacity-0 transition-opacity peer-checked:opacity-100">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5"
                                                 viewBox="0 0 20 20" fill="currentColor" stroke="currentColor"
                                                 stroke-width="1">
                                                <path fill-rule="evenodd"
                                                      d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                      clip-rule="evenodd"></path>
                                            </svg>
                                        </span>
                                        </label>
                                        <label class="cursor-pointer text-gray-800 dark:text-gray-400 mr-1"
                                               for="ripple-6">
                                            موبایل
                                        </label>
                                    </div>
                                    <!-- item -->
                                    <div class="inline-flex items-center mr-2.5">
                                        <label class="relative flex cursor-pointer items-center rounded-full p-3"
                                               for="ripple-7" data-ripple-dark="true">
                                            <input id="ripple-7" type="checkbox"
                                                   class="peer relative h-5 w-5 cursor-pointer appearance-none rounded border border-slate-300 shadow hover:shadow-md transition-all before:absolute before:top-2/4 before:left-2/4 before:block before:h-12 before:w-12 before:-translate-y-2/4 before:-translate-x-2/4 before:rounded-full before:bg-slate-400 before:opacity-0 before:transition-opacity checked:border-blue-500 checked:bg-blue-500 checked:before:bg-slate-400 hover:before:opacity-10 dark:bg-gray-600 dark:checked:bg-blue-500 darKchecked:bg-blue-500  "/>
                                            <span
                                                class="pointer-events-none absolute top-2/4 left-2/4 -translate-y-2/4 -translate-x-2/4 text-white opacity-0 transition-opacity peer-checked:opacity-100">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5"
                                                 viewBox="0 0 20 20" fill="currentColor" stroke="currentColor"
                                                 stroke-width="1">
                                                <path fill-rule="evenodd"
                                                      d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                      clip-rule="evenodd"></path>
                                            </svg>
                                        </span>
                                        </label>
                                        <label class="cursor-pointer text-gray-800 dark:text-gray-400 mr-1"
                                               for="ripple-7">
                                            لپ تاپ
                                        </label>
                                    </div>
                                    <!-- item -->
                                    <div class="inline-flex items-center mr-2.5">
                                        <label class="relative flex cursor-pointer items-center rounded-full p-3"
                                               for="ripple-8" data-ripple-dark="true">
                                            <input id="ripple-8" type="checkbox"
                                                   class="peer relative h-5 w-5 cursor-pointer appearance-none rounded border border-slate-300 shadow hover:shadow-md transition-all before:absolute before:top-2/4 before:left-2/4 before:block before:h-12 before:w-12 before:-translate-y-2/4 before:-translate-x-2/4 before:rounded-full before:bg-slate-400 before:opacity-0 before:transition-opacity checked:border-blue-500 checked:bg-blue-500 checked:before:bg-slate-400 hover:before:opacity-10 dark:bg-gray-600 dark:checked:bg-blue-500 darKchecked:bg-blue-500  "/>
                                            <span
                                                class="pointer-events-none absolute top-2/4 left-2/4 -translate-y-2/4 -translate-x-2/4 text-white opacity-0 transition-opacity peer-checked:opacity-100">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5"
                                                 viewBox="0 0 20 20" fill="currentColor" stroke="currentColor"
                                                 stroke-width="1">
                                                <path fill-rule="evenodd"
                                                      d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                      clip-rule="evenodd"></path>
                                            </svg>
                                        </span>
                                        </label>
                                        <label class="cursor-pointer text-gray-800 dark:text-gray-400 mr-1"
                                               for="ripple-8">
                                            هدفون، هدست
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <span class="text-sm text-gray-400 ms-auto py-1.5 px-4">۱3,۰۴۰ کالا </span>
            </div>
            <!-- TOP FILTER BOX -->
            <div class="hidden lg:flex items-center justify-between  mb-6">
                <div class="flex items-center gap-x-5">
                    <div class="flex items-center gap-x-2">
                        <svg class="size-6 text-gray-400">
                            <use href="#sort-list"></use>
                        </svg>
                        <h2 class="font-DanaDemiBold text-gray-400">مرتب سازی :</h2>
                    </div>
                    <ul
                        class="flex items-center gap-x-1 lg:gap-x-4 child:transition-all child:cursor-pointer child:rounded-lg child:px-1 child:py-1 child:text-sm child:lg:text-base">
                        <li wire:click="$set('sort','newest')" class="{{ $sort === 'newest' ? 'text-blue-500' : '' }}">
                            جدیدترین
                        </li>
                        <li wire:click="$set('sort','cheapest')"
                            class="{{ $sort === 'cheapest' ? 'text-blue-500' : '' }}">ارزان‌ترین
                        </li>
                        <li wire:click="$set('sort','expensive')"
                            class="{{ $sort === 'expensive' ? 'text-blue-500' : '' }}">گران‌ترین
                        </li>
                        <li wire:click="$set('sort','viewed')" class="{{ $sort === 'viewed' ? 'text-blue-500' : '' }}">
                            پربازدیدترین
                        </li>
                        <li wire:click="$set('sort','sold')" class="{{ $sort === 'sold' ? 'text-blue-500' : '' }}">
                            پرفروش‌ترین
                        </li>
                    </ul>
                </div>
                <span class="text-sm text-gray-400 end">۱۳,۰۴۰ کالا </span>
            </div>
            <!-- PRODUCTS -->
            <div
                class="grid grid-cols-1 xxs:grid-cols-2 xs:grid-cols-2 sm:grid-cols-2 xl:grid-cols-3 gap-3 xs:gap-2 sm:gap-4">
                @foreach($this->products as $product)
                    <div class=" product-card group">
                        <!-- product header -->
                        <div class="product-card_header">
                            <div class="flex items-center gap-x-2">
                                <div class="tooltip">
                                    <button class="rounded-full p-1.5 app-border app-hover">
                                        <svg class="size-4">
                                            <use href="#shopping-cart"></use>
                                        </svg>
                                    </button>
                                    <div class="tooltiptext">
                                        سبد خرید
                                    </div>
                                </div>
                                <div class="tooltip">
                                    <button class="rounded-full p-1.5 app-border app-hover">
                                        <svg class="size-4">
                                            <use href="#heart"></use>
                                        </svg>
                                    </button>
                                    <div class="tooltiptext">
                                        علاقه مندی
                                    </div>
                                </div>
                                <div class="tooltip">
                                    <button class="rounded-full p-1.5 app-border app-hover">
                                        <svg class="size-4">
                                            <use href="#arrows-up-down"></use>
                                        </svg>
                                    </button>
                                    <div class="tooltiptext">
                                        مقایسه
                                    </div>
                                </div>
                            </div>
                            <!-- badge offer -->
                            <span class="product-card_badge">{{$product->discount}}% تخفیف‌</span>
                        </div>
                        <!-- product img -->
                        <a href="{{route('store.single.product', $product->id)}}">
                            <img class="product-card_img group-hover:opacity-0 absolute"
                                 src="{{$product->getMedia('products')->first()->getUrl('thumb')}}"
                                 alt="">
                            <img class="product-card_img opacity-0 group-hover:opacity-100"
                                 src="{{$product->getMedia('products')->first()->getUrl('thumb')}}" alt="">
                        </a>
                        <!--  product footer -->
                        <div class="space-y-2">
                            <a href="{{route('store.single.product', $product->id)}}" class="product-card_link">
                                {{$product->title}}  {{$product->e_title}}
                            </a>
                            <!-- Rate and Price -->
                            <div class="product-card_price-wrapper">
                                <!-- RATE -->
                                <div class="product-card_rate">
                                    <span class="flex items-center gap-x-0.5">
                                        <svg class="size-4 text-blue-500 mb-0.5">
                                            <use href="#rocket"></use>
                                        </svg>
                                        <p class="text-xs">ارسال امروز</p>
                                    </span>
                                    <span class="text-gray-400 flex items-center text-sm gap-x-0.5">
                                        <p> 5.0 </p>
                                        <svg class="size-4 mb-1">
                                            <use href="#star"></use>
                                        </svg>
                                    </span>
                                </div>
                                <!-- Price -->
                                <div class="product-card_price">
                                    @if($product->discount > 0)
                                        <del>{{$product->price}}<h6>تومان</h6></del>
                                    @endif
                                    <p>{{$product->discount_price}}</p>
                                    <span>تومان</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- PAGINATION -->

            <div class="mt-10 w-full flex items-center justify-center">
                {{$this->products->links('pages.layouts.pagination')}}
            </div>
        </div>
    </div>
</main>
