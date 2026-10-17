<?php

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

new  #[Layout('pages.layouts.master'), Title('سفارش')]
class extends Component {
    //
};
?>

<main class="container">
    <!-- Breadcrumb -->
    <nav class="flex mt-8" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
            <li class="inline-flex items-center">
                <a href="index.html"
                   class="inline-flex items-center text-sm gap-x-1  text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                    <svg class="size-4 mb-0.5">
                        <use href="#home" />
                    </svg>
                    صفحه اصلی
                </a>
            </li>
            <li class="inline-flex items-center">
                <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="m1 9 4-4-4-4" />
                </svg>
                <a href="shop.html"
                   class="inline-flex items-center text-sm gap-x-1  text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                    سبد خرید
                </a>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="m1 9 4-4-4-4" />
                    </svg>
                    <span class="ms-1 text-sm  text-gray-500 md:ms-2 dark:text-gray-400">
                            آدرس و زمان ارسال
                        </span>
                </div>
            </li>
        </ol>
    </nav>

    <section
        class="flex flex-col lg:flex-row justify-between items-start gap-4 mt-5">
        <!-- Form -->
        <div class="w-full lg:w-3/4 flex flex-col gap-y-4 child:rounded-lg child:bg-white child:dark:bg-gray-800 child:shadow child:p-4">
            <div class="w-full flex flex-col">
                <span class="flex items-center gap-x-2">
                    <a href="shopping-cart.html">
                        <svg class="size-5">
                            <use href="#arrow-right"></use>
                        </svg>
                    </a>
                    <p  class="font-DanaDemiBold text-lg">آدرس و زمان ارسال</p>
                </span>
                <p class="text-gray-500 dark:text-gray-400 font-DanaMedium mt-4 mb-8 text-sm lg:text-base">
                    لطفا اطلاعات خود را به درستی وارد نمایید
                </p>
                <div class="flex flex-col lg:flex-row items-start ">
                    <form class="w-full grid grid-cols-12 gap-4">
                        <input type="text" placeholder="نام*"
                               class="block w-full py-1.5 px-3 text-base outline dark:outline-none outline-1 -outline-offset-1 placeholder:text-gray-400   transition-all col-span-6
                            text-gray-800 dark:text-gray-100 dark:bg-gray-900 bg-slate-100 border border-transparent hover:border-slate-200 appearance-none rounded-md outline-none focus:bg-white focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100 dark:focus:ring-blue-400 h-11">
                        <input type="text" placeholder="نام خانوادگی*"
                               class="block w-full py-1.5 px-3 text-base outline dark:outline-none outline-1 -outline-offset-1 placeholder:text-gray-400   transition-all col-span-6
                            text-gray-800 dark:text-gray-100 dark:bg-gray-900 bg-slate-100 border border-transparent hover:border-slate-200 appearance-none rounded-md outline-none focus:bg-white focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100 dark:focus:ring-blue-400 h-11">
                        <input type="text" placeholder="استان*"
                               class="block w-full py-1.5 px-3 text-base outline dark:outline-none outline-1 -outline-offset-1 placeholder:text-gray-400   transition-all col-span-6
                            text-gray-800 dark:text-gray-100 dark:bg-gray-900 bg-slate-100 border border-transparent hover:border-slate-200 appearance-none rounded-md outline-none focus:bg-white focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100 dark:focus:ring-blue-400 h-11">
                        <input type="text" placeholder="شهر*"
                               class="block w-full py-1.5 px-3 text-base outline dark:outline-none outline-1 -outline-offset-1 placeholder:text-gray-400   transition-all col-span-6
                            text-gray-800 dark:text-gray-100 dark:bg-gray-900 bg-slate-100 border border-transparent hover:border-slate-200 appearance-none rounded-md outline-none focus:bg-white focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100 dark:focus:ring-blue-400 h-11">
                        <input type="text" placeholder="آدرس*"
                               class="block w-full py-1.5 px-3 text-base outline dark:outline-none outline-1 -outline-offset-1 placeholder:text-gray-400   transition-all col-span-12
                            text-gray-800 dark:text-gray-100 dark:bg-gray-900 bg-slate-100 border border-transparent hover:border-slate-200 appearance-none rounded-md outline-none focus:bg-white focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100 dark:focus:ring-blue-400 h-11">
                        <input type="text" placeholder="تلفن*"
                               class="block w-full py-1.5 px-3 text-base outline dark:outline-none outline-1 -outline-offset-1 placeholder:text-gray-400   transition-all col-span-6
                            text-gray-800 dark:text-gray-100 dark:bg-gray-900 bg-slate-100 border border-transparent hover:border-slate-200 appearance-none rounded-md outline-none focus:bg-white focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100 dark:focus:ring-blue-400 h-11">
                        <input type="text" placeholder="کد پستی*"
                               class="block w-full py-1.5 px-3 text-base outline dark:outline-none outline-1 -outline-offset-1 placeholder:text-gray-400   transition-all col-span-6
                            text-gray-800 dark:text-gray-100 dark:bg-gray-900 bg-slate-100 border border-transparent hover:border-slate-200 appearance-none rounded-md outline-none focus:bg-white focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100 dark:focus:ring-blue-400 h-11">
                        <input type="text" placeholder="توضیحات"
                               class="block w-full py-1.5 px-3 text-base outline dark:outline-none outline-1 -outline-offset-1 placeholder:text-gray-400   transition-all col-span-12 h-11
                            text-gray-800 dark:text-gray-100 dark:bg-gray-900 bg-slate-100 border border-transparent hover:border-slate-200 appearance-none rounded-md outline-none focus:bg-white focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100 dark:focus:ring-blue-400">

                    </form>
                </div>
            </div>
            <div>
                    <span class="flex items-center gap-x-1">
                        <a href="shopping-cart.html">
                            <svg class="size-5 mb-1">
                                <use href="#truck"></use>
                            </svg>
                        </a>
                        <h1 class="font-DanaDemiBold">نوع ارسال</h1>
                    </span>
                <div class="grid grid-cols-12 child:col-span-12 gap-2 child:w-full child:flex child:items-center child:gap-x-2 child:rounded-lg  child:p-3 child:duration-300 child:border child:border-gray-300 child:dark:border-gray-300/20
                    child:transition-all child:text-gray-600 child:dark:text-gray-300  child:font-DanaMedium child:text-base mt-4">
                    <button
                        class=" group ring-transparent ring-1 focus:ring-blue-500 dark:ring-white/20 dark:focus:ring-blue-400">
                            <span
                                class="w-4 h-4 border border-gray-400 rounded-full group-focus:bg-blue-400 group-focus:border-blue-500 duration-300 transition-all"></span>
                        پست پیشتاز : 70,000 تومان
                    </button>
                    <button
                        class="group ring-transparent ring-1 focus:ring-blue-500 dark:ring-white/20 dark:focus:ring-blue-400">
                            <span
                                class="w-4 h-4 border border-gray-400 rounded-full group-focus:bg-blue-400 group-focus:border-blue-500 duration-300 transition-all"></span>
                        پست معمولی : 20,000 تومان
                    </button>
                </div>
            </div>
            <div class="w-full flex flex-col">
                <span class="flex items-center gap-x-2">
                    <a href="checkout.html">
                        <svg class="size-5">
                            <use href="#arrow-right"></use>
                        </svg>
                    </a>
                    <p  class="font-DanaDemiBold text-lg">انتخاب روش پرداخت</p>
                </span>
                <div class="grid grid-cols-12 child:col-span-12 gap-4 child:w-full child:flex child:items-center child:gap-x-3 child:rounded-lg child:px-3 child:py-3.5 child:duration-300 child:border child:border-gray-300 child:dark:border-gray-300/20
                    child:transition-all child:text-base mt-5">
                    <button
                        class="group ring-transparent ring-1 focus:ring-blue-500 dark:ring-white/20 dark:focus:ring-blue-400">
                        <span class="size-5 border border-gray-400 rounded-full group-focus:bg-blue-400 group-focus:border-blue-500 duration-300 transition-all"></span>
                        <svg class="size-6">
                            <use  href="#card"></use>
                        </svg>
                        <span class="flex flex-col items-start ">
                                <h1 class="text-lg dark:text-gray-300 text-gray-800 font-DanaMedium">پرداخت اینترنتی</h1>
                                <p class="text-gray-500 dark:text-gray-400">پرداخت آنلاین با کارت‌های بانکی</p>
                            </span>
                    </button>
                    <button
                        class="group ring-transparent ring-1 focus:ring-blue-500 dark:ring-white/20 dark:focus:ring-blue-400">
                        <span class="size-5 border border-gray-400 rounded-full group-focus:bg-blue-400 group-focus:border-blue-500 duration-300 transition-all"></span>
                        <svg style="width: 32px; height: 32px; fill: gray"><use xlink:href="#digipay"></use></svg>
                        <span class="flex flex-col items-start ">
                                <h1 class="text-lg dark:text-gray-300 text-gray-800 font-DanaMedium">
                                    پرداخت با کارت اعتباری
                                </h1>
                                <p class="text-gray-500 dark:text-gray-400">
                                    ویژه بانک‌ها، سازمان‌ها و شرکت‌ها
                                </p>
                            </span>
                    </button>

                </div>
            </div>
            <div>
                <div>
                    <label  label for="email" class="block text-lg font-DanaDemiBold text-gray-800 dark:text-gray-300">کد تخفیف</label>
                    <div class="mt-3 flex gap-x-2">
                        <input type="text"  placeholder="کد تخفیف خود را وارد کنید"
                               class="block w-full p-2.5 text-base outline dark:outline-none outline-1 -outline-offset-1 placeholder:text-gray-400 transition-all
                            text-gray-800 dark:text-gray-100 dark:bg-gray-900 bg-slate-100 border border-transparent hover:border-slate-200 appearance-none rounded-md outline-none focus:bg-white focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100 dark:focus:ring-blue-400">
                        <button class="px-5 bg-blue-500 rounded-md text-white hover:bg-blue-600 transition-all">اعمال</button>
                    </div>
                </div>
            </div>
            <div>
                <h1 class="font-DanaDemiBold text-lg">خلاصه سفارش</h1>
                <div class="mt-8">
                         <span class="flex items-center gap-x-1.5">
                        <a href="shopping-cart.html">
                            <svg class="size-6 text-red-500 mb-1">
                                <use href="#truck"></use>
                            </svg>
                        </a>
                        <h1 class="font-DanaMedium text-lg">جمعه ۲ خرداد-بازه ۹ - ۲۲</h1>
                        </span>
                    <div class="flex flex-col mt-8 gap-x-4">
                        <img src="./images/products/8.webp" class="w-36 h-20" alt="">
                        <ul class="flex flex-col items-start gap-y-2 font-DanaMedium text-gray-600 dark:text-gray-200 mt-5  mr-3">
                            <li class="flex items-center gap-x-1.5">
                                <span class="size-5 bg-blue-500 rounded-full"></span>
                                <p>آبی</p>
                            </li>
                            <li>
                                <p>مبلغ : ۵۲,۹۹۸,۰۰۰</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- PRICE BOX -->
        <div class="w-full lg:w-1/4 lg:sticky top-5 flex flex-col gap-y-4 rounded-lg bg-white dark:bg-gray-800 shadow p-4">
            <!-- PRICE -->
            <ul class="child:flex child:items-center child:justify-between space-y-8">
                <li>
                    <p>قیمت کالاها(۱)</p>
                    <p class="flex gap-x-1 text-gray-600 dark:text-gray-300 ">۱۲۵,۰۰۰,۰۰۰ <span class="hidden xl:flex">تومان</span></p>
                </li>
                <li class="text-red-500 dark:text-red-400">
                    <p>تخفیف </p>
                    <p class="font-DanaMedium">۵۰۰,۰۰۰ تومان  </p>
                </li>
                <li class="border-t-2 border-dashed border-gray-400 pt-8">
                    <p> مبلغ نهایی  :</p>
                    <p>۱۱۹,۵۰۰,۰۰۰ تومان</p>
                </li>
            </ul>

            <a href="./payment.html"
               class="w-full mt-4 flex items-center gap-x-1 justify-center bg-blue-500 text-white hover:bg-blue-600 transition-all rounded-lg shadow py-2">
                تایید و تکمیل سفارش
                <svg class="w-5 h-5">
                    <use href="#shopping-bag"></use>
                </svg>
            </a>

        </div>
    </section>
</main>>
