<?php

use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

new #[Layout('pages.layouts.master'), Title('صفحه اصلی')]
class extends Component {
    #[\Livewire\Attributes\Computed]
    public function lastProducts()
    {
        return \App\Models\Product::query()->orderByDesc('updated_at')->take(6)->get();
    }

    #[\Livewire\Attributes\Computed]
    public function bestProducts()
    {
        return \App\Models\Product::query()->orderByDesc('sold')->take(6)->get();
    }
};
?>

<main class="relative">

    <!-- Slider -->
    <livewire:pages::components.sliders/>

    <!-- CATEGORY -->
    <livewire:pages::components.brands/>


    <!-- Latest products -->
    <livewire:pages::components.products-slider :products="$this->lastProducts" title="جدیدترین محصولات"
                                                subtitle="جدیدترین و بروزترین محصولات"/>

    <!-- BANNER -->
    <section
        class="mx-4 lg:container mt-10 lg:mt-20 flex flex-col lg:flex-row items-center gap-5 child:rounded-xl child:overflow-hidden">
        <a href="shop.html" class="group">
            <img src="{{url('store/images/banner/1.webp')}}"
                 class="group-hover:scale-105 transition-transform duration-300"
                 alt="">
        </a>
        <a href="shop.html" class="group">
            <img src="{{url('store/images/banner/2.webp')}}"
                 class="group-hover:scale-105 transition-transform duration-300"
                 alt="">
        </a>
    </section>

    <!-- Best-selling products -->
    <livewire:pages::components.products-slider :products="$this->bestProducts" title="محصولات پرفروش"
                                                subtitle=" پرفروش ترین محصولات"/>

    <!-- Hottest products -->
    <section class="mx-4 lg:container mt-10 lg:mt-20 ">
        <div class="bg-white dark:bg-gray-800 shadow rounded-xl h-[420px] p-5 flex flex-col gap-y-2 relative">
            <!-- Title -->
            <div class="flex-center gap-x-1">
                <svg class="size-6 pb-1 text-orange-400">
                    <use href="#fire"></use>
                </svg>
                <h4 class="font-DanaMedium text-lg text-gray-800 dark:text-gray-200">داغ ترین چند ساعت گذشته </h4>
            </div>
            <div class="swiper HottestSlider w-full">
                <div class="swiper-wrapper w-full">
                    <!-- PRODUCT ITEM -->
                    <div class="swiper-slide hottest-slide">
                        <a href="product-details.html" class="hottest-slide_link ">
                            <img class="hottest-slide_img " src="{{url('store/images/products/1.png')}}" alt="">
                            <p class="hottest-slide_text ">
                                مانیتور گیمینگ ایسوس مدل ROG Swift PG259QN
                            </p>
                        </a>
                        <a href="product-details.html" class="hottest-slide_link ">
                            <img class="hottest-slide_img " src="{{url('store/images/products/3.png')}}" alt="">
                            <p class="hottest-slide_text ">
                                کنسول بازی پلی استیشن 5 نسخه دیسک دار
                            </p>
                        </a>
                        <a href="product-details.html" class="hottest-slide_link ">
                            <img class="hottest-slide_img " src="{{url('store/images/products/7.webp')}}" alt="">
                            <p class="hottest-slide_text ">
                                ساعت هوشمند سامسونگ مدل Galaxy Watch 6
                            </p>
                        </a>
                    </div>
                    <div class="swiper-slide hottest-slide">
                        <a href="product-details.html" class="hottest-slide_link ">
                            <img class="hottest-slide_img " src="{{url('store/images/products/1.png')}}" alt="">
                            <p class="hottest-slide_text ">
                                لپ تاپ 14 اینچی لنوو مدل ThinkPad X1 Carbon
                            </p>
                        </a>
                        <a href="product-details.html" class="hottest-slide_link ">
                            <img class="hottest-slide_img " src="{{url('store/images/products/3.png')}}" alt="">
                            <p class="hottest-slide_text ">
                                گوشی موبایل سامسونگ مدل Galaxy S23 Ultra
                            </p>
                        </a>
                        <a href="product-details.html" class="hottest-slide_link ">
                            <img class="hottest-slide_img " src="{{url('store/images/products/7.webp')}}" alt="">
                            <p class="hottest-slide_text ">
                                هدفون بی‌سیم اپل مدل AirPods Pro 2
                            </p>
                        </a>
                    </div>
                    <div class="swiper-slide hottest-slide">
                        <a href="product-details.html" class="hottest-slide_link ">
                            <img class="hottest-slide_img " src="{{url('store/images/products/1.png')}}" alt="">
                            <p class="hottest-slide_text ">
                                مانیتور گیمینگ ایسوس مدل ROG Swift PG259QN
                            </p>
                        </a>
                        <a href="product-details.html" class="hottest-slide_link ">
                            <img class="hottest-slide_img " src="{{url('store/images/products/3.png')}}" alt="">
                            <p class="hottest-slide_text ">
                                کنسول بازی پلی استیشن 5 نسخه دیسک دار
                            </p>
                        </a>
                        <a href="product-details.html" class="hottest-slide_link ">
                            <img class="hottest-slide_img " src="{{url('store/images/products/7.webp')}}" alt="">
                            <p class="hottest-slide_text ">
                                ساعت هوشمند سامسونگ مدل Galaxy Watch 6
                            </p>
                        </a>
                    </div>
                    <div class="swiper-slide hottest-slide">
                        <a href="product-details.html" class="hottest-slide_link ">
                            <img class="hottest-slide_img " src="{{url('store/images/products/1.png')}}" alt="">
                            <p class="hottest-slide_text ">
                                لپ تاپ 14 اینچی لنوو مدل ThinkPad X1 Carbon
                            </p>
                        </a>
                        <a href="product-details.html" class="hottest-slide_link ">
                            <img class="hottest-slide_img " src="{{url('store/images/products/3.png')}}" alt="">
                            <p class="hottest-slide_text ">
                                گوشی موبایل سامسونگ مدل Galaxy S23 Ultra
                            </p>
                        </a>
                        <a href="product-details.html" class="hottest-slide_link ">
                            <img class="hottest-slide_img " src="{{url('store/images/products/7.webp')}}" alt="">
                            <p class="hottest-slide_text ">
                                هدفون بی‌سیم اپل مدل AirPods Pro 2
                            </p>
                        </a>
                    </div>
                    <div class="swiper-slide hottest-slide">
                        <a href="product-details.html" class="hottest-slide_link ">
                            <img class="hottest-slide_img " src="{{url('store/images/products/1.png')}}" alt="">
                            <p class="hottest-slide_text ">
                                مانیتور گیمینگ ایسوس مدل ROG Swift PG259QN
                            </p>
                        </a>
                        <a href="product-details.html" class="hottest-slide_link ">
                            <img class="hottest-slide_img " src="{{url('store/images/products/3.png')}}" alt="">
                            <p class="hottest-slide_text ">
                                کنسول بازی پلی استیشن 5 نسخه دیسک دار
                            </p>
                        </a>
                        <a href="product-details.html" class="hottest-slide_link ">
                            <img class="hottest-slide_img " src="{{url('store/images/products/7.webp')}}" alt="">
                            <p class="hottest-slide_text ">
                                ساعت هوشمند سامسونگ مدل Galaxy Watch 6
                            </p>
                        </a>
                    </div>
                </div>
            </div>
            <button
                class="slider-navigate_btn absolute right-1 top-[47%] border dark:border-gray-700 border-gray-200 Hottest-prev-slide z-10">
                <svg class="size-6 -rotate-90">
                    <use href="#chevron"/>
                </svg>
            </button>
            <button
                class="slider-navigate_btn absolute left-1 top-[47%] border dark:border-gray-700 border-gray-200 Hottest-next-slide z-10">
                <svg class="size-6 rotate-90">
                    <use href="#chevron"/>
                </svg>
            </button>
        </div>
    </section>

    <!-- ARTICLE -->
    <section class="mx-4 lg:container mt-10 lg:mt-20">
        <!-- SECTION TITLE -->
        <div
            class="flex flex-col gap-y-4 xs:flex-row items-center justify-between w-full text-center xs:text-start">
            <div class="flex items-center gap-x-2 sm:gap-x-4">
                    <span class="size-12 hidden xs:flex rounded-lg bg-white shadow-lg dark:bg-gray-800 flex-center">
                        <svg class="size-7 text-gray-700 dark:text-gray-100">
                            <use href="#check-badge"></use>
                        </svg>
                    </span>
                <div class="space-y-1 md:space-y-1">
                    <h3 class="text-xl md:text-2xl font-MorabbaMedium text-gray-800 dark:text-gray-50">محبوب‌ترین
                        <span class="text-blue-600 dark:text-blue-500">مقالات</span>
                    </h3>
                    <p class="text-sm text-gray-500 dark:text-gray-300">جدیدترین و بروزترین مقالات</p>
                </div>
            </div>
            <div class="w-full xs:w-auto flex justify-between xs:justify-end  items-center gap-x-2">
                <div class="flex items-center gap-x-2">
                    <button class="slider-navigate_btn articleSlider-prev-slide">
                        <svg class="size-6 -rotate-90">
                            <use href="#chevron"/>
                        </svg>
                    </button>
                    <button class="slider-navigate_btn articleSlider-next-slide">
                        <svg class="size-6 rotate-90">
                            <use href="#chevron"/>
                        </svg>
                    </button>
                </div>
                <a href="articles.html"
                   class="group shadow-xl text-sm md:text-base flex gap-x-1.5 items-center px-2 h-10 md:px-3 text-white bg-blue-600 rounded-xl">
                    <p>مشاهده همه</p>
                    <span
                        class="w-7 h-7 rounded-full bg-blue-500 flex-center md:group-hover:-translate-x-1 transition-transform duration-300">
                            <svg class="size-5">
                                <use href="#arrow"/>
                            </svg>
                        </span>
                </a>
            </div>
        </div>
        <div class="swiper articleSlider w-full mt-5">
            <div class="swiper-wrapper w-full py-5">
                <!-- ITEM -->
                <div class="swiper-slide group article-box">
                    <div class="relative overflow-hidden rounded-lg">
                        <img src="{{url('store/images/articles/1.webp')}}" class="article-box_img" alt=""/>
                        <div
                            class="absolute opacity-0 left-0 top-0 bottom-0 right-0 bg-black/60 flex items-center justify-center group-hover:opacity-100 duration-300 transition-all rounded-bl-3xl rounded-tr-3xl">
                            <a href="./article-details.html"
                               class="flex items-center px-2 py-1 gap-x-1 font-DanaMedium rounded-lg border-2 border-white text-white">
                                <p>ادامه مطالب</p>
                                <svg class="w-4 h-4 rotate-90">
                                    <use href="#chevron"></use>
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div class="flex flex-col gap-y-1 py-5 px-1">
                        <h2 class="font-DanaDemiBold">بهترین لپ تاپ های بازار ایران [دی ۱۴۰۳] </h2>
                    </div>
                    <span class="flex w-full h-1 py-1 border-t border-gray-100 dark:border-white/10"></span>
                    <div class="flex items-center justify-between text-sm px-1">
                            <span class="flex items-center gap-x-1 text-blue-500 dark:text-sky-400">
                                <svg class="w-4 h-4">
                                    <use href="#calendar"></use>
                                </svg>
                                <p class="mt-1">1403/5/1</p>
                            </span>
                        <span class="flex items-start gap-x-1 text-gray-300">
                                <p class="font-DanaDemiBold">120</p>
                                <svg class="w-4 h-4">
                                    <use href="#eye"></use>
                                </svg>
                            </span>
                    </div>
                </div>
                <!-- ITEM -->
                <div class="swiper-slide group article-box">
                    <div class="relative overflow-hidden rounded-lg">
                        <img src="{{url('store/images/articles/2.webp')}}" class="article-box_img" alt=""/>
                        <div
                            class="absolute opacity-0 left-0 top-0 bottom-0 right-0 bg-black/60 flex items-center justify-center group-hover:opacity-100 duration-300 transition-all rounded-bl-3xl rounded-tr-3xl">
                            <a href="./article-details.html"
                               class="flex items-center px-2 py-1 gap-x-1 font-DanaMedium rounded-lg border-2 border-white text-white">
                                <p>ادامه مطالب</p>
                                <svg class="w-4 h-4 rotate-90">
                                    <use href="#chevron"></use>
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div class="flex flex-col gap-y-1 py-5 px-1">
                        <h2 class="font-DanaDemiBold">بهترین گوشی های بازار ایران [دی ۱۴۰۳] </h2>
                    </div>
                    <span class="flex w-full h-1 py-1 border-t border-gray-100 dark:border-white/10"></span>
                    <div class="flex items-center justify-between text-sm px-1">
                            <span class="flex items-center gap-x-1 text-blue-500 dark:text-sky-400">
                                <svg class="w-4 h-4">
                                    <use href="#calendar"></use>
                                </svg>
                                <p class="mt-1">1403/5/1</p>
                            </span>
                        <span class="flex items-start gap-x-1 text-gray-300">
                                <p class="font-DanaDemiBold">120</p>
                                <svg class="w-4 h-4">
                                    <use href="#eye"></use>
                                </svg>
                            </span>
                    </div>
                </div>
                <!-- ITEM -->
                <div class="swiper-slide group article-box">
                    <div class="relative overflow-hidden rounded-lg">
                        <img src="{{url('store/images/articles/3.webp')}}" class="article-box_img" alt=""/>
                        <div
                            class="absolute opacity-0 left-0 top-0 bottom-0 right-0 bg-black/60 flex items-center justify-center group-hover:opacity-100 duration-300 transition-all rounded-bl-3xl rounded-tr-3xl">
                            <a href="./article-details.html"
                               class="flex items-center px-2 py-1 gap-x-1 font-DanaMedium rounded-lg border-2 border-white text-white">
                                <p>ادامه مطالب</p>
                                <svg class="w-4 h-4 rotate-90">
                                    <use href="#chevron"></use>
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div class="flex flex-col gap-y-1 py-5 px-1">
                        <h2 class="font-DanaDemiBold">بهترین هدیه های دیجیتال [دی ۱۴۰۳] </h2>
                    </div>
                    <span class="flex w-full h-1 py-1 border-t border-gray-100 dark:border-white/10"></span>
                    <div class="flex items-center justify-between text-sm px-1">
                            <span class="flex items-center gap-x-1 text-blue-500 dark:text-sky-400">
                                <svg class="w-4 h-4">
                                    <use href="#calendar"></use>
                                </svg>
                                <p class="mt-1">1403/5/1</p>
                            </span>
                        <span class="flex items-start gap-x-1 text-gray-300">
                                <p class="font-DanaDemiBold">120</p>
                                <svg class="w-4 h-4">
                                    <use href="#eye"></use>
                                </svg>
                            </span>
                    </div>
                </div>
                <!-- ITEM -->
                <div class="swiper-slide group article-box">
                    <div class="relative overflow-hidden rounded-lg">
                        <img src="{{url('store/images/articles/4.webp')}}" class="article-box_img" alt=""/>
                        <div
                            class="absolute opacity-0 left-0 top-0 bottom-0 right-0 bg-black/60 flex items-center justify-center group-hover:opacity-100 duration-300 transition-all rounded-bl-3xl rounded-tr-3xl">
                            <a href="./article-details.html"
                               class="flex items-center px-2 py-1 gap-x-1 font-DanaMedium rounded-lg border-2 border-white text-white">
                                <p>ادامه مطالب</p>
                                <svg class="w-4 h-4 rotate-90">
                                    <use href="#chevron"></use>
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div class="flex flex-col gap-y-1 py-5 px-1">
                        <h2 class="font-DanaDemiBold">بهترین هارد های بازار ایران [دی ۱۴۰۳] </h2>
                    </div>
                    <span class="flex w-full h-1 py-1 border-t border-gray-100 dark:border-white/10"></span>
                    <div class="flex items-center justify-between text-sm px-1">
                            <span class="flex items-center gap-x-1 text-blue-500 dark:text-sky-400">
                                <svg class="w-4 h-4">
                                    <use href="#calendar"></use>
                                </svg>
                                <p class="mt-1">1403/5/1</p>
                            </span>
                        <span class="flex items-start gap-x-1 text-gray-300">
                                <p class="font-DanaDemiBold">120</p>
                                <svg class="w-4 h-4">
                                    <use href="#eye"></use>
                                </svg>
                            </span>
                    </div>
                </div>
                <!-- ITEM -->
                <div class="swiper-slide group article-box">
                    <div class="relative overflow-hidden rounded-lg">
                        <img src="{{url('store/images/articles/1.webp')}}" class="article-box_img" alt=""/>
                        <div
                            class="absolute opacity-0 left-0 top-0 bottom-0 right-0 bg-black/60 flex items-center justify-center group-hover:opacity-100 duration-300 transition-all rounded-bl-3xl rounded-tr-3xl">
                            <a href="./article-details.html"
                               class="flex items-center px-2 py-1 gap-x-1 font-DanaMedium rounded-lg border-2 border-white text-white">
                                <p>ادامه مطالب</p>
                                <svg class="w-4 h-4 rotate-90">
                                    <use href="#chevron"></use>
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div class="flex flex-col gap-y-1 py-5 px-1">
                        <h2 class="font-DanaDemiBold">بهترین هارد های بازار ایران [دی ۱۴۰۳] </h2>
                    </div>
                    <span class="flex w-full h-1 py-1 border-t border-gray-100 dark:border-white/10"></span>
                    <div class="flex items-center justify-between text-sm px-1">
                            <span class="flex items-center gap-x-1 text-blue-500 dark:text-sky-400">
                                <svg class="w-4 h-4">
                                    <use href="#calendar"></use>
                                </svg>
                                <p class="mt-1">1403/5/1</p>
                            </span>
                        <span class="flex items-start gap-x-1 text-gray-300">
                                <p class="font-DanaDemiBold">120</p>
                                <svg class="w-4 h-4">
                                    <use href="#eye"></use>
                                </svg>
                            </span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features -->
    <div
        class="container w-full mt-10 lg:mt-20 flex flex-wrap items-center  justify-center md:justify-between gap-6 child:text-sm child:gap-y-1 child:cursor-pointer">
        <!-- item -->
        <span class="flex-col items-center justify-center hidden md:flex">
                <img class="w-14 h-14" src="{{url('store/images/svg/1.svg')}} " alt="">
                <p class="text-gray-500 dark:text-gray-300">امکان تحویل اکسپرس</p>
            </span>
        <span class="flex flex-col items-center justify-center">
                <img class="w-14 h-14" src="{{url('store/images/svg/2.svg')}}" alt="">
                <p class="text-gray-500 dark:text-gray-300">ضمانت اصل بودن کالا</p>
            </span>
        <span class="flex flex-col items-center justify-center">
                <img class="w-14 h-14" src="{{url('store/images/svg/3.svg')}}" alt="">
                <p class="text-gray-500 dark:text-gray-300">ضمانت بازگشت کالا</p>
            </span>
        <span class="flex flex-col items-center justify-center">
                <img class="w-14 h-14" src="{{url('store/images/svg/4.svg')}}" alt="">
                <p class="text-gray-500 dark:text-gray-300">پشتیبانی 24 ساعته</p>
            </span>
        <span class="flex flex-col items-center justify-center">
                <img class="w-14 h-14" src="{{url('store/images/svg/5.svg')}}" alt="">
                <p class="text-gray-500 dark:text-gray-300">امکان پرداخت در محل</p>
            </span>
    </div>
</main>
