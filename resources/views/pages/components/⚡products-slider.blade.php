<?php

use Livewire\Component;

new class extends Component
{
    public $products ,$title , $subtitle;

};
?>

<section class="mx-4 lg:container mt-10 lg:mt-20">
    <!-- SECTION TITLE -->
    <div
        class="flex flex-col gap-y-4 xs:flex-row items-center justify-between w-full text-center xs:text-start">
        <div class="flex items-center gap-x-2 sm:gap-x-4">
                    <span class="size-12 hidden xs:flex rounded-lg bg-white shadow-lg dark:bg-gray-800 flex-center">
                        <svg class="size-7 text-gray-700 dark:text-gray-100">
                            <use href="#mobile"></use>
                        </svg>
                    </span>
            <div class="space-y-1 md:space-y-1">
                <h3 class="text-xl md:text-2xl font-MorabbaMedium text-gray-800 dark:text-gray-50">
                    <span class="text-blue-600 dark:text-blue-500">{{$this->title}}</span>
                </h3>
                <p class="text-sm text-gray-500 dark:text-gray-300">{{$this->subtitle}}</p>
            </div>
        </div>
        <div class="w-full xs:w-auto flex justify-between xs:justify-end  items-center gap-x-2">
            <div class="flex items-center gap-x-2">
                <button class="slider-navigate_btn LatestProducts-prev-slide">
                    <svg class="size-6 -rotate-90">
                        <use href="#chevron" />
                    </svg>
                </button>
                <button class="slider-navigate_btn LatestProducts-next-slide">
                    <svg class="size-6 rotate-90">
                        <use href="#chevron" />
                    </svg>
                </button>
            </div>
            <a href="shop.html"
               class="group shadow-xl text-sm md:text-base flex gap-x-1.5 items-center px-2 h-10 md:px-3 text-white bg-blue-600 rounded-xl">
                <p>مشاهده همه</p>
                <span
                    class="w-7 h-7 rounded-full bg-blue-500 flex-center md:group-hover:-translate-x-1 transition-transform duration-300">
                            <svg class="size-5">
                                <use href="#arrow" />
                            </svg>
                        </span>
            </a>
        </div>

    </div>
    <!-- Latest products Slider -->
    <div class="swiper LatestProducts mt-5 w-full">
        <div class="swiper-wrapper py-5">
            <!-- PRODUCT ITEM -->
            @foreach($this->products as $product)
                <div class="swiper-slide product-card group">
                    <!-- product header -->
                    <div class="product-card_header">
                        <div class="flex items-center gap-x-2">
                            <div class="tooltip">
                                <button class="rounded-full p-1.5 app-border app-hover">
                                    <svg class="size-4">
                                        <use href="#shopping-bag"></use>
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
                        @if($product->discount > 0)
                            <span class="product-card_badge">{{$product->discount}}% تخفیف‌</span>
                        @endif

                    </div>
                    <!-- product img -->
                    <a href="product-details.html">
                        <img class="product-card_img group-hover:opacity-0 absolute" src="{{$product->getMedia('products')->first()->getUrl('thumb')}}"
                             alt="">
                        <img class="product-card_img opacity-0 group-hover:opacity-100"
                             src="{{$product->getMedia('products')->first()->getUrl('thumb')}}" alt="">
                    </a>
                    <!--  product footer -->
                    <div class="space-y-2">
                        <a href="product-details.html" class="product-card_link">
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
    </div>
</section>
