<?php

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use \App\Models\Product;

new #[Layout('pages.layouts.master'), Title('جزئیات محصول')]
class extends Component {

    public Product $product;
    public $mainImage;

    public function mount()
    {
        $this->mainImage = $this->product->getMedia('products')->first()->getUrl();
    }

    public function setMainImage($path)
    {
        $this->mainImage = $path;
    }

    #[\Livewire\Attributes\Computed]
    public function relatedProducts()
    {
        return \App\Models\Product::query()->where('category_id', $this->product->category_id)->take(6)->get();
    }
};
?>

<main class="container">
    <!-- Breadcrumb -->
    <nav class="flex mt-8" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
            <li class="inline-flex items-center">
                <a href="{{route('store.index')}}"
                   class="inline-flex items-center text-sm gap-x-1  text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                    <svg class="size-4 mb-0.5">
                        <use href="#home"/>
                    </svg>
                    صفحه اصلی
                </a>
            </li>
            <li class="inline-flex items-center">
                <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="m1 9 4-4-4-4"/>
                </svg>
                <a href="#"
                   class="inline-flex items-center text-sm gap-x-1  text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                    فروشگاه
                </a>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="m1 9 4-4-4-4"/>
                    </svg>
                    <span class="ms-1 text-sm  text-gray-500 md:ms-2 dark:text-gray-400">جزییات محصول</span>
                </div>
            </li>
        </ol>
    </nav>
    <!-- PRODUCT DETAILS SECTION -->
    <section
        class="mt-5 flex flex-col lg:flex-row items-start gap-4 child:rounded-lg child:bg-white child:dark:bg-gray-800 child:shadow child:p-4">
        <!-- IMAGE & INFO BOX Container -->
        <div class="w-full lg:w-3/4">
            <div class="flex flex-col md:flex-row justify-start gap-x-8 xl:gap-x-2 items-start">
                <!-- IMAGE SLIDER -->
                <div class="w-2/4 hidden md:flex flex-col justify-center items-center gap-y-4">
                        <span class="open-sliderModal">
                            <img src="{{$this->mainImage}}" class="cursor-pointer object-cover h-96 w-96" alt="">
                        </span>
                    <div
                        class="grid grid-cols-12 child:col-span-3 child:app-border gap-x-4 child:size-16 child:rounded-lg child:cursor-pointer">
                        @foreach($this->product->getMedia('products') as $media)
                        <div wire:click="setMainImage('{{$media->getUrl()}}')" class="p-1 open-sliderModal">
                            <img src="{{$media->getUrl('thumb')}}" class="object-cover  rounded-lg">
                        </div>
                        @endforeach
                        <div class="overflow-hidden relative open-sliderModal">
                            <svg class="absolute size-8 text-gray-100 top-4 left-4 z-10">
                                <use href="#ellipsis"></use>
                            </svg>
                            <img src="{{url('store/images/products/14.webp')}}" class="object-cover rounded-lg blur-sm">
                        </div>
                    </div>
                </div>
                <div class="slider-modal">
                    <div class="flex w-full h-fit items-center justify-between">
                        <h1 class="font-DanaMedium text-lg">
                            {{$this->product->title}}
                        </h1>
                        <svg class="size-6 cursor-pointer close-sliderModal">
                            <use href="#x-mark"></use>
                        </svg>
                    </div>

                    <div class="swiper ProductDetailsSlider mt-14 px-10 w-96 relative">
                        <div class="swiper-wrapper w-[50%] child:w-full child:rounded-lg child:overflow-hidden">
                            @foreach($this->product->getMedia('products') as $media)
                            <div class="swiper-slide">
                                <img src="{{$media->getUrl()}}" class="h-96 w-96" alt="">
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <button
                        class="slider-navigate_btn absolute right-40 top-68 border dark:border-gray-700 border-gray-200 button-prev-ProductDetailsSlider z-20">
                        <svg class="size-6 -rotate-90">
                            <use href="#chevron"/>
                        </svg>
                    </button>
                    <button
                        class="slider-navigate_btn absolute left-40 top-68 border dark:border-gray-700 border-gray-200 button-next-ProductDetailsSlider z-10">
                        <svg class="size-6 rotate-90">
                            <use href="#chevron"/>
                        </svg>
                    </button>
                </div>
                <!-- INFOS -->
                <div class="w-full md:w-3/4 flex flex-col gap-y-7">
                    <div class="flex items-center justify-between">
                        <a href="#" class="font-DanaMedium text-sky-400">{{$this->product->category->parent->title}} / {{$this->product->category->title}}</a>
                        <div class="hidden md:flex items-center gap-x-2">
                            <div class="tooltip">
                                <button class="rounded-full p-1.5 app-border app-hover">
                                    <svg class="size-4 md:size-5">
                                        <use href="#share"></use>
                                    </svg>
                                </button>
                                <div class="tooltiptext">
                                    اشتراک‌گذازی
                                </div>
                            </div>
                            <div class="tooltip">
                                <button class="rounded-full p-1.5 app-border app-hover">
                                    <svg class="size-4 md:size-5">
                                        <use href="#heart"></use>
                                    </svg>
                                </button>
                                <div class="tooltiptext">
                                    علاقه مندی
                                </div>
                            </div>
                            <div class="tooltip">
                                <button class="rounded-full p-1.5 app-border app-hover">
                                    <svg class="size-4 md:size-5">
                                        <use href="#arrows-up-down"></use>
                                    </svg>
                                </button>
                                <div class="tooltiptext">
                                    مقایspanه
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- MOBILE SLIDER -->
                    <div class="flex md:hidden">
                        <div class="swiper MobileProductSlider w-full">
                            <div class="swiper-wrapper w-full child:w-full child:overflow-hidden child:rounded-lg">
                                <div class="swiper-slide">
                                    <img src="./images/products/11.png" alt="">
                                </div>
                                <div class="swiper-slide">
                                    <img src="./images/products/12.webp" alt="">
                                </div>
                                <div class="swiper-slide">
                                    <img src="./images/products/13.webp" alt="">
                                </div>
                                <div class="swiper-slide">
                                    <img src="./images/products/14.webp" alt="">
                                </div>
                            </div>
                            <div class="swiper-pagination MobileProductSlider-pagination"></div>
                        </div>
                    </div>

                    <div class="flex flex-col gap-y-3">
                        <p class="text-lg font-DanaDemiBold dark:text-gray-300">
                            {{$product->title}}
                        </p>
                        <p class="text-sm text-gray-300 dark:text-gray-500">
                            {{$product->e_title}}
                        </p>
                        <div class="flex items-center gap-x-2">
                                <span class="flex items-center gap-x-1 text-sm">
                                    <svg class="size-4 text-yellow-400 mb-1.5">
                                        <use href="#star"></use>
                                    </svg>
                                    4.4 <span class="text-gray-300 dark:text-gray-500">(امتیاز 849 خریدار)</span>
                                </span>

                            <span
                                class="h-6 bg-slate-100 text-gray-400 dark:bg-slate-700 dark:text-gray-400 flex items-center justify-center rounded-full px-2 text-xs font-DanaMedium pt-1">
                                410 دیدگاه
                              </span>
                        </div>
                    </div>
                    <!-- COLOR -->
                    <div class="flex flex-col gap-y-4">
                        <h1 class="font-DanaDemiBold text-lg color-title dark:text-gray-200">رنگ : </h1>
                        <div class="flex items-center gap-x-3 child:rounded-full child:size-9 child:p-1">
                            @foreach($this->product->product_variants as $variant)
                                <button
                                    class="color-select-btn ring-4 ring-blue-400 transition-all duration-300 ease-in-out">
                                    <span style="background-color: {{$variant->color->code}}" class="w-full h-full rounded-full flex"></span>
                                </button>
                            @endforeach

                        </div>
                    </div>
                    <!-- Features Box  -->
                    <div class="w-full flex flex-col gap-y-4">
                        <h1 class="font-DanaDemiBold text-lg dark:text-gray-200">ویژگی‌ها</h1>
                        <div
                            class="grid grid-cols-12 gap-2 child:p-2 child:h-16 child:bg-gray-100 dark:child:bg-gray-900 child:rounded-lg child:flex child:flex-col child:gap-y-1.5">
                             @foreach($this->product->product_attributes as $product_attribute)
                                <div class="col-span-12 md:col-span-6 xl:col-span-4">
                                    <p class="text-sm text-gray-500">{{$product_attribute->attribute->title}}</p>
                                    <p class="line-clamp-1 font-DanaDemiBold text-sm text-slate-800 dark:text-slate-200">{{$product_attribute->attributeValue->text}}</p>
                                </div>
                             @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div
                class="mt-10 lg:mr-2 grid grid-cols-12 child:col-span-6 xl:child:col-span-3 gap-x-1 gap-y-2 lg:gap-4 child:border child:text-gray-400 child:dark:border-white/20 child:border-gray-200 child:rounded-lg child:h-12  child:p-2 child:flex child:items-center child:gap-x-1 lg:child:gap-x-2 child:text-sm lg:text-base">
                    <span>
                        <svg class="w-4 h-4 lg:w-6 lg:h-6">
                            <use href="#arrow-path-rounded-square"></use>
                        </svg>
                        <p>ضمانت بازگشت کالا</p>
                    </span>
                <span>
                        <svg class="w-4 h-4 lg:w-6 lg:h-6">
                            <use href="#check-badge"></use>
                        </svg>
                        <p>
                            تضمین اصالت کالا
                        </p>
                    </span>
                <span>
                        <svg class="w-4 h-4 lg:w-6 lg:h-6">
                            <use href="#calender-day"></use>
                        </svg>
                        <p>پشتیبانی کل هفته</p>
                    </span>
                <span>
                        <svg class="w-4 h-4 lg:w-6 lg:h-6">
                            <use href="#truke"></use>
                        </svg>
                        <p>ارspanال به spanراspanر ایران </p>
                    </span>
            </div>
        </div>
        <!-- PRICE & ADD TO CART BOX -->
        <div class="w-full lg:w-1/4 lg:sticky top-5 flex flex-col gap-y-6">
            <!-- PRICE -->
            <div class="flex items-center gap-x-1">
                <p class="text-2xl font-DanaDemiBold">۹۹,۸۹۹,۰۰۰</p>
                <p class="">تومان</p>
            </div>
            <button
                class="w-full flex items-center justify-between gap-x-1 rounded-lg border border-gray-200 dark:border-white/20 py-2 px-3">
                <svg class="w-6 h-6 increment text-green-600">
                    <use href="#plus"></use>
                </svg>
                <input type="number" name="customInput" id="customInput" min="1" max="20" value="1"
                       class="custom-input mr-4 text-lg bg-transparent">
                <svg class="w-6 h-6 decrement text-red-500">
                    <use href="#minus"></use>
                </svg>
            </button>

            <button
                class="w-full flex items-center gap-x-1 justify-between dark:bg-gray-900 dark:text-gray-400  bg-gray-100 transition-all rounded-lg py-2 px-2 xl:px-3 font-DanaMedium text-sm xl:text-base">
                <p>مجموع خرید :</p>
                <p>۹۹,۸۹۹,۰۰۰ تومان</p>
            </button>

            <div class="relative overflow-hidden text-sm font-DanaDemiBold text-right">
                <div id="slider-text" class="transition-all duration-700 ease-in-out">
                    <p>🔥 ۱۰۰۰+ فروش در هفته گذشته</p>
                </div>
            </div>
            <button
                class="w-full flex items-center gap-x-1 justify-center bg-blue-500 text-white hover:bg-blue-600 transition-all rounded-lg shadow py-2">
                افزودن به spanبد
                <svg class="w-5 h-5">
                    <use href="#shopping-bag"></use>
                </svg>
            </button>

            <div class="text-sm  text-gray-400 flex xl:items-center gap-x-1">
                <svg class="w-5 h-5">
                    <use href="#info"></use>
                </svg>
                <p>ارspanال رایگان برای خریدهای بالای 400 هزار تومان</p>
            </div>
        </div>
    </section>

    <!-- Best-selling products -->
    <livewire:pages::components.products-slider :products="$this->relatedProducts" title="محصولات مرتبط"
                                                subtitle="جدیدترین و بروزترین محصولات"/>

    <section id="properties" class="relative mt-10 flex flex-col items-start gap-4 rounded-lg bg-white dark:bg-gray-800 shadow p-4">
        <div
            class="w-full py-3 flex items-center gap-x-6 child:font-DanaMedium tab-buttons z-10 border-b  border-gray-600/20 dark:border-b-gray-200/20">
            <button class="tab-btn text-blue-500" data-target="tab1">معرفی محصول</button>
            <button class="tab-btn text-gray-500 dark:text-gray-300" data-target="tab2">مشخصات</button>
            <button class="tab-btn text-gray-500 dark:text-gray-300" data-target="tab3">دیدگاه‌ها</button>
        </div>
        <div class="tab-content tab1 block">
            <h2 class="font-DanaDemiBold border-b-2 border-blue-500 w-fit p-1 text-lg">معرفی</h2>
            <p class="mt-4 leading-8">
                  {!! $this->product->description !!}
                <a href="#" class="flex gap-x-1 items-center text-blue-400">
                    مشاهده بیشتر
                    <svg class="size-4">
                        <use href="#chevron-left"/>
                    </svg>
                </a>
            </p>
        </div>
        <div class="tab-content tab2 hidden w-full lg:w-[50%]">
            <h2 class="font-DanaDemiBold border-b-2 border-blue-500 w-fit p-1 text-lg">مشخصات کلی
            </h2>
            <div class="p-4 my-5 w-full mx-auto flex justify-center items-center gap-x-20">
                <ul class="space-y-3 text-gray-500 dark:text-gray-300 lg:w-2/4 child:pt-2">
                    @foreach($this->product->product_attributes as $product_attribute)
                        <li>{{$product_attribute->attribute->title}}</li>
                    @endforeach
                </ul>
                <ul class="space-y-3 text-gray-800 dark:text-gray-200 lg:w-2/4 divide-y divide-gray-200 dark:divide-gray-700 font-DanaMedium child:line-clamp-1">
                    @foreach($this->product->product_attributes as $product_attribute)
                        <li class="pt-2">{{$product_attribute->attributeValue->text}}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="tab-content tab3 hidden w-full">
            <div class="flex items-center gap-x-2 mb-6">
                <h2 class="font-DanaMedium text-2xl ">
                    دیدگاه ها
                </h2>
                <p class="text-sm text-blue-500">
                    (28 دیدگاه)
                </p>
            </div>

            <div class="w-full flex flex-col md:flex-row items-start gap-10">
                <!-- SUBMIT COMMENT -->
                <div class="lg:w-1/4 flex flex-col w-full ">
                    <p class="font-DanaMedium text-lg mb-2">ثبت دیدگاه</p>
                    <input type="text" placeholder="عنوان" class="tailwind-input">
                    <p class="text-gray-500 dark:text-white text-sm mb-4">این محصول را به دیگران پیشنهاد : </p>
                    <div class="grid grid-cols-12 child:col-span-6 gap-4 child:w-full  child:flex child:items-center child:justify-center child:gap-x-2 child:rounded-lg child:shadow child:py-2 mb-5 child:font-DanaMedium child:duration-300
                            child:transition-all">
                        <button
                            class="text-green-600 ring-transparent ring-1 focus:ring-green-600 dark:ring-white/20 dark:focus:ring-green-600">
                            <svg class="w-5 h-5">
                                <use href="#hand-up"></use>
                            </svg>
                            میکنم
                        </button>
                        <button
                            class="text-red-500 ring-transparent ring-1 focus:ring-[#EF4343] dark:ring-white/20 dark:focus:ring-[#EF4343]">
                            <svg class="w-5 h-5">
                                <use href="#hand-down"></use>
                            </svg>
                            نمیکنم
                        </button>
                    </div>
                    <textarea class="h-24 tailwind-input" placeholder="متن دیدگاه"></textarea>
                    <button class="rounded-lg p-2 bg-blue-500 hover:bg-blue-600 text-white transition-all">ثبت</button>
                </div>

                <!-- ALL COMMENTS -->
                <ul class="lg:w-3/4 flex flex-col gap-y-2 child:w-full ">
                    <!-- COMMENT ITEMS -->
                    <li class="child:flex py-4 border-b border-gray-200 dark:border-b-gray-200/20 child:border-white/20">
                        <!-- TITLE -->
                        <div class="flex items-center gap-x-2">
                            <h2 class="font-DanaMedium text-lg mb-1">عملکرد spanریع و روان</h2>
                            <span class="px-2 py-1 mb-2 rounded-lg bg-blue-500 text-white text-xs">خریدار</span>
                        </div>
                        <!-- COOMENT TEXT -->
                        <div class="flex-col">
                            <h2 class="flex items-center gap-x-1 text-green-500 mb-4">
                                <svg class="w-4 h-4">
                                    <use href="#hand-up"></use>
                                </svg>
                                پیشنهاد میشود
                            </h2>
                            <p class="text-gray-500 dark:text-gray-200 mb-2 line-clamp-2">
                                موبایل بspanیار spanریعی هspanت، اجرای برنامه‌ها بدون لگ انجام میشه. کیفیت spanاخت بدنه
                                هم عالیه.
                            </p>
                        </div>
                        <!-- COMMENT FOOTER -->
                        <div class="mt-2 lg:mt-0 flex-col lg:flex-row gap-y-2 lg:items-center justify-between">
                            <div class="flex items-center gap-x-4 text-gray-400 text-sm">
                                <p>11 بهمن 1402</p>
                                <p>امیررضا کریمی</p>
                            </div>
                            <div class="flex items-center gap-x-2 flex-wrap mt-2">
                                <p class="text-gray-400 text-sm">آیا این دیدگاه برایتان مفید بود؟</p>
                                <div class="flex items-center gap-x-2 child:flex child:items-center child:gap-x-1 child:rounded-lg child:p-2 child:font-DanaMedium child:duration-300
                                    child:transition-all child:text-sm">
                                    <button
                                        class="text-green-600 ring-transparent ring-1 focus:ring-green-600  dark:focus:ring-green-600">
                                        78
                                        <svg class="w-4 h-4">
                                            <use href="#hand-up"></use>
                                        </svg>
                                    </button>
                                    <button
                                        class="text-red-500 ring-transparent ring-1 focus:ring-[#EF4343]  dark:focus:ring-[#EF4343]">
                                        25
                                        <svg class="w-4 h-4">
                                            <use href="#hand-down"></use>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </li>
                    <!-- COMMENT ITEMS -->
                    <li class="child:flex py-4 border-b border-gray-200 dark:border-b-gray-200/20 child:border-white/20">
                        <!-- TITLE -->
                        <div class="flex items-center gap-x-2">
                            <h2 class="font-DanaMedium text-lg mb-1"> دوربین ناامیدکننده بود </h2>
                            <span class="px-2 py-1 mb-2 rounded-lg bg-blue-500 text-white text-xs">خریدار</span>
                        </div>
                        <!-- COOMENT TEXT -->
                        <div class="flex-col">
                            <h2 class="flex items-center gap-x-1 text-red-500 mb-4">
                                <svg class="w-4 h-4">
                                    <use href="#hand-down"></use>
                                </svg>
                                پیشنهاد نمیشود
                            </h2>
                            <p class="text-gray-500 dark:text-gray-200 mb-2">
                                دوربین گوشی در نور کم کیفیت خوبی نداره. انتظار بیشتری داشتم.
                            </p>
                        </div>
                        <!-- COMMENT FOOTER -->
                        <div class="mt-2 lg:mt-0  flex-col lg:flex-row gap-y-2 lg:items-center justify-between">
                            <div class="flex items-center gap-x-4 text-gray-400 text-sm">
                                <p>12 بهمن 1402</p>
                                <p>علی محمدی</p>
                            </div>
                            <div class="flex items-center gap-x-2 flex-wrap mt-2">
                                <p class="text-gray-400 text-sm ">آیا این دیدگاه برایتان مفید بود؟</p>
                                <div class="flex items-center gap-x-2 child:flex child:items-center child:gap-x-1 child:rounded-lg child:p-2 child:font-DanaMedium child:duration-300
                                    child:transition-all child:text-sm">
                                    <button
                                        class="text-green-600 ring-transparent ring-1 focus:ring-green-600  dark:focus:ring-green-600">
                                        4
                                        <svg class="w-4 h-4">
                                            <use href="#hand-up"></use>
                                        </svg>
                                    </button>
                                    <button
                                        class="text-red-500 ring-transparent ring-1 focus:ring-[#EF4343]  dark:focus:ring-[#EF4343]">
                                        15
                                        <svg class="w-4 h-4">
                                            <use href="#hand-down"></use>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </li>
                    <!-- COMMENT ITEMS -->
                    <li class="child:flex py-4 border-b border-gray-200  dark:border-b-gray-200/20 child:border-white/20">
                        <!-- TITLE -->
                        <div class="flex items-center gap-x-2">
                            <h2 class="font-DanaMedium text-lg mb-1">باطری خیلی خوبه</h2>
                            <span class="px-2 py-1 mb-2 rounded-lg bg-blue-500 text-white text-xs">خریدار</span>
                        </div>
                        <!-- COOMENT TEXT -->
                        <div class="flex-col">
                            <h2 class="flex items-center gap-x-1 text-green-500 mb-4">
                                <svg class="w-4 h-4">
                                    <use href="#hand-up"></use>
                                </svg>
                                پیشنهاد میشود
                            </h2>
                            <p class="text-gray-500 dark:text-gray-200 mb-2">
                                شارژدهی گوشی فوق‌العاده‌spanت، با اspanتفاده معمولی تا دو روز هم دوام میاره.
                            </p>
                        </div>
                        <!-- COMMENT FOOTER -->
                        <div class="mt-2 lg:mt-0 flex-col lg:flex-row gap-y-2 lg:items-center justify-between">
                            <div class="flex items-center gap-x-4 text-gray-400 text-sm">
                                <p>1 بهمن 1402</p>
                                <p>محمد صفدری</p>
                            </div>
                            <div class="flex items-center gap-x-2 flex-wrap mt-2">
                                <p class="text-gray-400 text-sm">آیا این دیدگاه برایتان مفید بود؟</p>
                                <div class="flex items-center gap-x-2 child:flex child:items-center child:gap-x-1 child:rounded-lg child:p-2 child:font-DanaMedium child:duration-300
                                    child:transition-all child:text-sm">
                                    <button
                                        class="text-green-600 ring-transparent ring-1 focus:ring-green-600  dark:focus:ring-green-600">
                                        7
                                        <svg class="w-4 h-4">
                                            <use href="#hand-up"></use>
                                        </svg>
                                    </button>
                                    <button
                                        class="text-red-500 ring-transparent ring-1 focus:ring-[#EF4343]  dark:focus:ring-[#EF4343]">
                                        5
                                        <svg class="w-4 h-4">
                                            <use href="#hand-down"></use>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </li>

                    <!-- HIDDEN COMMENTS -->
                    <!-- COMMENT ITEMS -->
                    <li dark:border-b-gray-200>
                        class="hidden-comment-item hidden child:flex py-4 border-b border-gray-200
                        dark:border-b-gray-200/20 child:border-white/20">
                        <!-- TITLE -->
                        <div class="flex items-center gap-x-2">
                            <h2 class="font-DanaMedium text-lg mb-1">باطری فوق‌العاده‌اspan</h2>
                            <span class="px-2 py-1 mb-2 rounded-lg bg-blue-500 text-white text-xs">خریدار</span>
                        </div>
                        <!-- COOMENT TEXT -->
                        <div class="flex-col">
                            <h2 class="flex items-center gap-x-1 text-green-500 mb-4">
                                <svg class="w-4 h-4">
                                    <use href="#hand-up"></use>
                                </svg>
                                پیشنهاد میشود
                            </h2>
                            <p class="text-gray-500 dark:text-gray-200 mb-2 line-clamp-2">
                                من باطری گوشی رو با اspanتفاده زیاد تspanت کردم، دو روز کامل جواب داد. عالیه!
                            </p>

                        </div>
                        <!-- COMMENT FOOTER -->
                        <div class="mt-2 lg:mt-0 flex-col lg:flex-row gap-y-2 lg:items-center justify-between">
                            <div class="flex items-center gap-x-4 text-gray-400 text-sm">
                                <p>11 بهمن 1402</p>
                                <p>امیررضا کریمی</p>
                            </div>
                            <div class="flex items-center gap-x-2 flex-wrap mt-2">
                                <p class="text-gray-400 text-sm">آیا این دیدگاه برایتان مفید بود؟</p>
                                <div class="flex items-center gap-x-2 child:flex child:items-center child:gap-x-1 child:rounded-lg child:p-2 child:font-DanaMedium child:duration-300
                child:transition-all child:text-sm">
                                    <button
                                        class="text-green-600 ring-transparent ring-1 focus:ring-green-600  dark:focus:ring-green-600">
                                        78
                                        <svg class="w-4 h-4">
                                            <use href="#hand-up"></use>
                                        </svg>
                                    </button>
                                    <button
                                        class="text-red-500 ring-transparent ring-1 focus:ring-[#EF4343]  dark:focus:ring-[#EF4343]">
                                        25
                                        <svg class="w-4 h-4">
                                            <use href="#hand-down"></use>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </li>
                    <!-- COMMENT ITEMS -->
                    <li
                        class="hidden-comment-item hidden child:flex py-4 border-b border-gray-200 dark:border-b-gray-200/20 child:border-white/20">
                        <!-- TITLE -->
                        <div class="flex items-center gap-x-2">
                            <h2 class="font-DanaMedium text-lg mb-1"> بspanته بندی خوب نبود </h2>
                            <span class="px-2 py-1 mb-2 rounded-lg bg-blue-500 text-white text-xs">خریدار</span>
                        </div>
                        <!-- COOMENT TEXT -->
                        <div class="flex-col">
                            <h2 class="flex items-center gap-x-1 text-red-500 mb-4">
                                <svg class="w-4 h-4">
                                    <use href="#hand-down"></use>
                                </svg>
                                پیشنهاد نمیشود
                            </h2>
                            <p class="text-gray-500 dark:text-gray-200 mb-2">
                                بspanته بندی محصول ایراد داشت.
                            </p>
                        </div>
                        <!-- COMMENT FOOTER -->
                        <div class="mt-2 lg:mt-0  flex-col lg:flex-row gap-y-2 lg:items-center justify-between">
                            <div class="flex items-center gap-x-4 text-gray-400 text-sm">
                                <p>12 بهمن 1402</p>
                                <p>علی محمدی</p>
                            </div>
                            <div class="flex items-center gap-x-2 flex-wrap mt-2">
                                <p class="text-gray-400 text-sm">آیا این دیدگاه برایتان مفید بود؟</p>
                                <div class="flex items-center gap-x-2 child:flex child:items-center child:gap-x-1 child:rounded-lg child:p-2 child:font-DanaMedium child:duration-300
                child:transition-all child:text-sm">
                                    <button
                                        class="text-green-600 ring-transparent ring-1 focus:ring-green-600  dark:focus:ring-green-600">
                                        4
                                        <svg class="w-4 h-4">
                                            <use href="#hand-up"></use>
                                        </svg>
                                    </button>
                                    <button
                                        class="text-red-500 ring-transparent ring-1 focus:ring-[#EF4343]  dark:focus:ring-[#EF4343]">
                                        15
                                        <svg class="w-4 h-4">
                                            <use href="#hand-down"></use>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </li>
                    <!-- COMMENT ITEMS -->
                    <li
                        class="hidden-comment-item hidden child:flex py-4 border-b border-gray-200 dark:border-b-gray-200/20 child:border-white/20">
                        <!-- TITLE -->
                        <div class="flex items-center gap-x-2">
                            <h2 class="font-DanaMedium text-lg mb-1">طراحی و رنگش فوق‌العاده‌spanت</h2>
                            <span class="px-2 py-1 mb-2 rounded-lg bg-blue-500 text-white text-xs">خریدار</span>
                        </div>
                        <!-- COOMENT TEXT -->
                        <div class="flex-col">
                            <h2 class="flex items-center gap-x-1 text-green-500 mb-4">
                                <svg class="w-4 h-4">
                                    <use href="#hand-up"></use>
                                </svg>
                                پیشنهاد میشود
                            </h2>
                            <p class="text-gray-500 dark:text-gray-200 mb-2">
                                کیفیت محصول عالیه
                            </p>
                        </div>
                        <!-- COMMENT FOOTER -->
                        <div class="mt-2 lg:mt-0 flex-col lg:flex-row gap-y-2 lg:items-center justify-between">
                            <div class="flex items-center gap-x-4 text-gray-400 text-sm">
                                <p>1 بهمن 1402</p>
                                <p>محمد صفدری</p>
                            </div>
                            <div class="flex items-center gap-x-2 flex-wrap mt-2">
                                <p class="text-gray-400 text-sm">آیا این دیدگاه برایتان مفید بود؟</p>
                                <div class="flex items-center gap-x-2 child:flex child:items-center child:gap-x-1 child:rounded-lg child:p-2 child:font-DanaMedium child:duration-300
                                child:transition-all child:text-sm">
                                    <button
                                        class="text-green-600 ring-transparent ring-1 focus:ring-green-600  dark:focus:ring-green-600">
                                        7
                                        <svg class="w-4 h-4">
                                            <use href="#hand-up"></use>
                                        </svg>
                                    </button>
                                    <button
                                        class="text-red-500 ring-transparent ring-1 focus:ring-[#EF4343]  dark:focus:ring-[#EF4343]">
                                        5
                                        <svg class="w-4 h-4">
                                            <use href="#hand-down"></use>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </li>
                    <button
                        class="more-comment-btn w-full flex items-center justify-center gap-x-1 my-4 text-blue-600 dark:text-blue-400 font-DanaMedium">
                        <p class="more-comment-text">مشاهده بیشتر</p>
                        <svg class="size-4 more-comment-icon">
                            <use href="#chevron"></use>
                        </svg>
                    </button>
                </ul>
            </div>
        </div>
    </section>
</main>
