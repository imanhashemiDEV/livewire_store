<?php

use App\Models\ProductVariant;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Layout('admin::layouts.master', ['breadcrumb' => '']), Title('صفحه اصلی')]
class extends Component {


    #[Computed]
    public function product_variants()
    {
        return ProductVariant::query()->where('status', \App\Enums\ProductStatus::Waiting->value)->paginate(10);
    }

    public function approveProductVariant($id)
    {
        $variant = ProductVariant::query()->find($id);
        $variant->update(
            [
                'status'=> \App\Enums\ProductStatus::Active->value
            ]
        );
    }

};
?>

<div
    class="content transition-[margin,width] duration-100 rtl:xl:pr-3.5 ltr:xl:pl-3.5 pt-[54px] pb-16 relative z-10 group mode content--compact rtl:xl:mr-[275px] ltr:xl:ml-[275px] mode--light rtl:[&.content--compact]:xl:mr-[91px] ltr:[&.content--compact]:xl:ml-[91px]">
    <div class="px-5 mt-16">
        <div class="container">
            <div class="grid grid-cols-12 gap-x-6 gap-y-10">

                <div class="col-span-12" wire:ignore>
                    <div class="flex flex-col gap-y-3 md:h-10 md:flex-row md:items-center">
                        <div class="font-medium text-white">بینش‌های عملکرد</div>

                    </div>
                    <div class="-mx-2.5 mt-3.5">
                        <div data-config="performance-insight-slider-config" class="tiny-slider">
                            <div class="px-2.5 pb-3">
                                <div class="relative p-5 box box--stacked">
                                    <div class="flex items-center">
                                        <div
                                            class="group flex items-center justify-center w-10 h-10 border rounded-full [&.primary]:border-primary/10 [&.primary]:bg-primary/10 [&.success]:border-success/10 [&.success]:bg-success/10 success">
                                            <i data-tw-merge="" data-lucide="database"
                                               class="stroke-[1] w-5 h-5 group-[.primary]:text-primary group-[.primary]:fill-primary/10 group-[.success]:text-success group-[.success]:fill-success/10"></i>
                                        </div>
                                        <div class="flex rtl:mr-auto ltr:ml-auto">
                                            <div class="w-8 h-8 image-fit zoom-in">
                                                <img
                                                    class="rounded-full shadow-[0px_0px_0px_2px_#fff,_1px_1px_5px_rgba(0,0,0,0.32)] dark:shadow-[0px_0px_0px_2px_#3f4865,_1px_1px_5px_rgba(0,0,0,0.32)]"
                                                    src="{{url('panel')}}/images/products/product8-400x400.jpg"
                                                    alt="تیل وایز - قالب داشبورد مدیریتی">
                                            </div>
                                            <div class="w-8 h-8 image-fit zoom-in rtl:-mr-3 ltr:-ml-3">
                                                <img
                                                    class="rounded-full shadow-[0px_0px_0px_2px_#fff,_1px_1px_5px_rgba(0,0,0,0.32)] dark:shadow-[0px_0px_0px_2px_#3f4865,_1px_1px_5px_rgba(0,0,0,0.32)]"
                                                    src="{{url('panel')}}/images/products/product3-400x400.jpg"
                                                    alt="تیل وایز - قالب داشبورد مدیریتی">
                                            </div>
                                            <div class="w-8 h-8 image-fit zoom-in rtl:-mr-3 ltr:-ml-3">
                                                <img
                                                    class="rounded-full shadow-[0px_0px_0px_2px_#fff,_1px_1px_5px_rgba(0,0,0,0.32)] dark:shadow-[0px_0px_0px_2px_#3f4865,_1px_1px_5px_rgba(0,0,0,0.32)]"
                                                    src="{{url('panel')}}/images/products/product3-400x400.jpg"
                                                    alt="تیل وایز - قالب داشبورد مدیریتی">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-11">
                                        <div class="text-base font-medium">برجسته‌های بازاریابی</div>
                                        <div class="mt-0.5 text-slate-500">
                                            کمپین‌های اخیر
                                        </div>
                                    </div>
                                    <a class="flex items-center pt-4 mt-4 font-medium border-t border-dashed text-primary"
                                       href="">
                                        کاوش در کمپین‌ها
                                        <i data-tw-merge="" data-lucide="arrow-right"
                                           class="stroke-[1] rtl:mr-1.5 ltr:ml-1.5 h-4 w-4 rtl:rotate-180"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="px-2.5 pb-3">
                                <div class="relative p-5 box box--stacked">
                                    <div class="flex items-center">
                                        <div
                                            class="group flex items-center justify-center w-10 h-10 border rounded-full [&.primary]:border-primary/10 [&.primary]:bg-primary/10 [&.success]:border-success/10 [&.success]:bg-success/10 primary">
                                            <i data-tw-merge="" data-lucide="inbox"
                                               class="stroke-[1] w-5 h-5 group-[.primary]:text-primary group-[.primary]:fill-primary/10 group-[.success]:text-success group-[.success]:fill-success/10"></i>
                                        </div>
                                        <div class="flex rtl:mr-auto ltr:ml-auto">
                                            <div class="w-8 h-8 image-fit zoom-in">
                                                <img
                                                    class="rounded-full shadow-[0px_0px_0px_2px_#fff,_1px_1px_5px_rgba(0,0,0,0.32)] dark:shadow-[0px_0px_0px_2px_#3f4865,_1px_1px_5px_rgba(0,0,0,0.32)]"
                                                    src="{{url('panel')}}/images/products/product10-400x400.jpg"
                                                    alt="تیل وایز - قالب داشبورد مدیریتی">
                                            </div>
                                            <div class="w-8 h-8 image-fit zoom-in rtl:-mr-3 ltr:-ml-3">
                                                <img
                                                    class="rounded-full shadow-[0px_0px_0px_2px_#fff,_1px_1px_5px_rgba(0,0,0,0.32)] dark:shadow-[0px_0px_0px_2px_#3f4865,_1px_1px_5px_rgba(0,0,0,0.32)]"
                                                    src="{{url('panel')}}/images/products/product9-400x400.jpg"
                                                    alt="تیل وایز - قالب داشبورد مدیریتی">
                                            </div>
                                            <div class="w-8 h-8 image-fit zoom-in rtl:-mr-3 ltr:-ml-3">
                                                <img
                                                    class="rounded-full shadow-[0px_0px_0px_2px_#fff,_1px_1px_5px_rgba(0,0,0,0.32)] dark:shadow-[0px_0px_0px_2px_#3f4865,_1px_1px_5px_rgba(0,0,0,0.32)]"
                                                    src="{{url('panel')}}/images/products/product7-400x400.jpg"
                                                    alt="تیل وایز - قالب داشبورد مدیریتی">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-11">
                                        <div class="text-base font-medium">هشدارهای موجودی کم</div>
                                        <div class="mt-0.5 text-slate-500">
                                            اقلام در حال اتمام است
                                        </div>
                                    </div>
                                    <a class="flex items-center pt-4 mt-4 font-medium border-t border-dashed text-primary"
                                       href="">
                                        مشاهده موجودی
                                        <i data-tw-merge="" data-lucide="arrow-right"
                                           class="stroke-[1] rtl:mr-1.5 ltr:ml-1.5 h-4 w-4 rtl:rotate-180"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="px-2.5 pb-3">
                                <div class="relative p-5 box box--stacked">
                                    <div class="flex items-center">
                                        <div
                                            class="group flex items-center justify-center w-10 h-10 border rounded-full [&.primary]:border-primary/10 [&.primary]:bg-primary/10 [&.success]:border-success/10 [&.success]:bg-success/10 primary">
                                            <i data-tw-merge="" data-lucide="laptop"
                                               class="stroke-[1] w-5 h-5 group-[.primary]:text-primary group-[.primary]:fill-primary/10 group-[.success]:text-success group-[.success]:fill-success/10"></i>
                                        </div>
                                        <div class="flex rtl:mr-auto ltr:ml-auto">
                                            <div class="w-8 h-8 image-fit zoom-in">
                                                <img
                                                    class="rounded-full shadow-[0px_0px_0px_2px_#fff,_1px_1px_5px_rgba(0,0,0,0.32)] dark:shadow-[0px_0px_0px_2px_#3f4865,_1px_1px_5px_rgba(0,0,0,0.32)]"
                                                    src="{{url('panel')}}/images/products/product10-400x400.jpg"
                                                    alt="تیل وایز - قالب داشبورد مدیریتی">
                                            </div>
                                            <div class="w-8 h-8 image-fit zoom-in rtl:-mr-3 ltr:-ml-3">
                                                <img
                                                    class="rounded-full shadow-[0px_0px_0px_2px_#fff,_1px_1px_5px_rgba(0,0,0,0.32)] dark:shadow-[0px_0px_0px_2px_#3f4865,_1px_1px_5px_rgba(0,0,0,0.32)]"
                                                    src="{{url('panel')}}/images/products/product7-400x400.jpg"
                                                    alt="تیل وایز - قالب داشبورد مدیریتی">
                                            </div>
                                            <div class="w-8 h-8 image-fit zoom-in rtl:-mr-3 ltr:-ml-3">
                                                <img
                                                    class="rounded-full shadow-[0px_0px_0px_2px_#fff,_1px_1px_5px_rgba(0,0,0,0.32)] dark:shadow-[0px_0px_0px_2px_#3f4865,_1px_1px_5px_rgba(0,0,0,0.32)]"
                                                    src="{{url('panel')}}/images/products/product3-400x400.jpg"
                                                    alt="تیل وایز - قالب داشبورد مدیریتی">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-11">
                                        <div class="text-base font-medium">بالا 5 دسته‌بندی‌ها</div>
                                        <div class="mt-0.5 text-slate-500">
                                            دسته‌های محبوب
                                        </div>
                                    </div>
                                    <a class="flex items-center pt-4 mt-4 font-medium border-t border-dashed text-primary"
                                       href="">
                                        مرور دسته‌بندی‌ها
                                        <i data-tw-merge="" data-lucide="arrow-right"
                                           class="stroke-[1] rtl:mr-1.5 ltr:ml-1.5 h-4 w-4 rtl:rotate-180"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="px-2.5 pb-3">
                                <div class="relative p-5 box box--stacked">
                                    <div class="flex items-center">
                                        <div
                                            class="group flex items-center justify-center w-10 h-10 border rounded-full [&.primary]:border-primary/10 [&.primary]:bg-primary/10 [&.success]:border-success/10 [&.success]:bg-success/10 success">
                                            <i data-tw-merge="" data-lucide="fingerprint"
                                               class="stroke-[1] w-5 h-5 group-[.primary]:text-primary group-[.primary]:fill-primary/10 group-[.success]:text-success group-[.success]:fill-success/10"></i>
                                        </div>
                                        <div class="flex rtl:mr-auto ltr:ml-auto">
                                            <div class="w-8 h-8 image-fit zoom-in">
                                                <img
                                                    class="rounded-full shadow-[0px_0px_0px_2px_#fff,_1px_1px_5px_rgba(0,0,0,0.32)] dark:shadow-[0px_0px_0px_2px_#3f4865,_1px_1px_5px_rgba(0,0,0,0.32)]"
                                                    src="{{url('panel')}}/images/products/product8-400x400.jpg"
                                                    alt="تیل وایز - قالب داشبورد مدیریتی">
                                            </div>
                                            <div class="w-8 h-8 image-fit zoom-in rtl:-mr-3 ltr:-ml-3">
                                                <img
                                                    class="rounded-full shadow-[0px_0px_0px_2px_#fff,_1px_1px_5px_rgba(0,0,0,0.32)] dark:shadow-[0px_0px_0px_2px_#3f4865,_1px_1px_5px_rgba(0,0,0,0.32)]"
                                                    src="{{url('panel')}}/images/products/product4-400x400.jpg"
                                                    alt="تیل وایز - قالب داشبورد مدیریتی">
                                            </div>
                                            <div class="w-8 h-8 image-fit zoom-in rtl:-mr-3 ltr:-ml-3">
                                                <img
                                                    class="rounded-full shadow-[0px_0px_0px_2px_#fff,_1px_1px_5px_rgba(0,0,0,0.32)] dark:shadow-[0px_0px_0px_2px_#3f4865,_1px_1px_5px_rgba(0,0,0,0.32)]"
                                                    src="{{url('panel')}}/images/products/product3-400x400.jpg"
                                                    alt="تیل وایز - قالب داشبورد مدیریتی">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-11">
                                        <div class="text-base font-medium">محبوبیت مشتریان</div>
                                        <div class="mt-0.5 text-slate-500">
                                            مشتری ماه
                                        </div>
                                    </div>
                                    <a class="flex items-center pt-4 mt-4 font-medium border-t border-dashed text-primary"
                                       href="">
                                        مرور محصولات
                                        <i data-tw-merge="" data-lucide="arrow-right"
                                           class="stroke-[1] rtl:mr-1.5 ltr:ml-1.5 h-4 w-4 rtl:rotate-180"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="px-2.5 pb-3">
                                <div class="relative p-5 box box--stacked">
                                    <div class="flex items-center">
                                        <div
                                            class="group flex items-center justify-center w-10 h-10 border rounded-full [&.primary]:border-primary/10 [&.primary]:bg-primary/10 [&.success]:border-success/10 [&.success]:bg-success/10 primary">
                                            <i data-tw-merge="" data-lucide="zap"
                                               class="stroke-[1] w-5 h-5 group-[.primary]:text-primary group-[.primary]:fill-primary/10 group-[.success]:text-success group-[.success]:fill-success/10"></i>
                                        </div>
                                        <div class="flex rtl:mr-auto ltr:ml-auto">
                                            <div class="w-8 h-8 image-fit zoom-in">
                                                <img
                                                    class="rounded-full shadow-[0px_0px_0px_2px_#fff,_1px_1px_5px_rgba(0,0,0,0.32)] dark:shadow-[0px_0px_0px_2px_#3f4865,_1px_1px_5px_rgba(0,0,0,0.32)]"
                                                    src="{{url('panel')}}/images/products/product9-400x400.jpg"
                                                    alt="تیل وایز - قالب داشبورد مدیریتی">
                                            </div>
                                            <div class="w-8 h-8 image-fit zoom-in rtl:-mr-3 ltr:-ml-3">
                                                <img
                                                    class="rounded-full shadow-[0px_0px_0px_2px_#fff,_1px_1px_5px_rgba(0,0,0,0.32)] dark:shadow-[0px_0px_0px_2px_#3f4865,_1px_1px_5px_rgba(0,0,0,0.32)]"
                                                    src="{{url('panel')}}/images/products/product1-400x400.jpg"
                                                    alt="تیل وایز - قالب داشبورد مدیریتی">
                                            </div>
                                            <div class="w-8 h-8 image-fit zoom-in rtl:-mr-3 ltr:-ml-3">
                                                <img
                                                    class="rounded-full shadow-[0px_0px_0px_2px_#fff,_1px_1px_5px_rgba(0,0,0,0.32)] dark:shadow-[0px_0px_0px_2px_#3f4865,_1px_1px_5px_rgba(0,0,0,0.32)]"
                                                    src="{{url('panel')}}/images/products/product3-400x400.jpg"
                                                    alt="تیل وایز - قالب داشبورد مدیریتی">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-11">
                                        <div class="text-base font-medium">بالا 10 محصولات</div>
                                        <div class="mt-0.5 text-slate-500">
                                            محصولات ویژه
                                        </div>
                                    </div>
                                    <a class="flex items-center pt-4 mt-4 font-medium border-t border-dashed text-primary"
                                       href="">
                                        مرور محصولات
                                        <i data-tw-merge="" data-lucide="arrow-right"
                                           class="stroke-[1] rtl:mr-1.5 ltr:ml-1.5 h-4 w-4 rtl:rotate-180"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-12">
                    <div class="flex flex-col gap-y-3 md:h-10 md:flex-row md:items-center">
                        <div class="text-base font-medium">درخواست های جدید</div>

                    </div>
                    <div class="mt-2 overflow-auto lg:overflow-visible">
                        <table data-tw-merge=""
                               class="w-full rtl:text-right ltr:text-left border-separate border-spacing-y-[10px]">
                            <tbody>
                            @foreach($this->product_variants as $product_variant)
                            <tr data-tw-merge="" class="">
                                <td data-tw-merge=""
                                    class="px-5 py-3 border-b dark:border-darkmode-300 box rounded-l-none rounded-r-none border-x-0 shadow-[5px_3px_5px_#00000005] rtl:first:rounded-r-[0.6rem] ltr:first:rounded-l-[0.6rem] rtl:first:border-r ltr:first:border-l rtl:last:rounded-l-[0.6rem] ltr:last:rounded-r-[0.6rem] rtl:last:border-l ltr:last:border-r dark:bg-darkmode-600">
                                    <div class="flex items-center">
                                        <i data-tw-merge="" data-lucide="laptop"
                                           class="h-6 w-6 fill-primary/10 stroke-[0.8] text-theme-1"></i>
                                        <div class="rtl:mr-3.5 ltr:ml-3.5">
                                            <a class="font-medium whitespace-nowrap" href="">
                                                {{$product_variant->product->title}}
                                            </a>
                                            <div class="mt-1 text-xs whitespace-nowrap text-slate-500">
                                                {{$product_variant->product->category->title}}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td data-tw-merge=""
                                    class="px-5 py-3 border-b dark:border-darkmode-300 box w-60 rounded-l-none rounded-r-none border-x-0 shadow-[5px_3px_5px_#00000005] rtl:first:rounded-r-[0.6rem] ltr:first:rounded-l-[0.6rem] rtl:first:border-r ltr:first:border-l rtl:last:rounded-l-[0.6rem] ltr:last:rounded-r-[0.6rem] rtl:last:border-l ltr:last:border-r dark:bg-darkmode-600">
                                    <div class="mb-1 text-xs whitespace-nowrap text-slate-500">
                                        {{$product_variant->seller->title}}
                                    </div>
                                    <a class="flex items-center text-primary" href="">
                                        <i data-tw-merge="" data-lucide="external-link"
                                           class="h-3.5 w-3.5 stroke-[1.7]"></i>
                                        <div class="rtl:mr-1.5 ltr:ml-1.5 whitespace-nowrap">
                                            {{$product_variant->guarranty->title}}
                                        </div>
                                    </a>
                                </td>
                                <td data-tw-merge=""
                                    class="px-5 py-3 border-b dark:border-darkmode-300 box w-60 rounded-l-none rounded-r-none border-x-0 shadow-[5px_3px_5px_#00000005] rtl:first:rounded-r-[0.6rem] ltr:first:rounded-l-[0.6rem] rtl:first:border-r ltr:first:border-l rtl:last:rounded-l-[0.6rem] ltr:last:rounded-r-[0.6rem] rtl:last:border-l ltr:last:border-r dark:bg-darkmode-600">
                                    <div class="mb-1 text-xs whitespace-nowrap text-slate-500">
                                        قیمت
                                    </div>
                                    <a class="flex items-center text-primary" href="">
                                        <i data-tw-merge="" data-lucide="external-link"
                                           class="h-3.5 w-3.5 stroke-[1.7]"></i>
                                        <div class="rtl:mr-1.5 ltr:ml-1.5 whitespace-nowrap">
                                            {{$product_variant->price}}تومان
                                        </div>
                                    </a>
                                </td>
                                <td data-tw-merge=""
                                    class="px-5 py-3 border-b dark:border-darkmode-300 box w-44 rounded-l-none rounded-r-none border-x-0 shadow-[5px_3px_5px_#00000005] rtl:first:rounded-r-[0.6rem] ltr:first:rounded-l-[0.6rem] rtl:first:border-r ltr:first:border-l rtl:last:rounded-l-[0.6rem] ltr:last:rounded-r-[0.6rem] rtl:last:border-l ltr:last:border-r dark:bg-darkmode-600">
                                    <div class="mb-1 text-xs whitespace-nowrap text-slate-500">
                                        تخفیف
                                    </div>
                                    <div class="flex items-center text-primary">
                                        <i data-tw-merge="" data-lucide="arrow-left-square"
                                           class="h-3.5 w-3.5 stroke-[1.7]"></i>
                                        <div class="rtl:mr-1.5 ltr:ml-1.5 whitespace-nowrap">
                                            {{$product_variant->discount}}درصد
                                        </div>
                                    </div>
                                </td>
                                <td data-tw-merge=""
                                    class="px-5 py-3 border-b dark:border-darkmode-300 box w-44 rounded-l-none rounded-r-none border-x-0 shadow-[5px_3px_5px_#00000005] rtl:first:rounded-r-[0.6rem] ltr:first:rounded-l-[0.6rem] rtl:first:border-r ltr:first:border-l rtl:last:rounded-l-[0.6rem] ltr:last:rounded-r-[0.6rem] rtl:last:border-l ltr:last:border-r dark:bg-darkmode-600">
                                    <div class="mb-1 text-xs whitespace-nowrap text-slate-500">
                                        تاریخ
                                    </div>
                                    <div class="whitespace-nowrap">{{\Hekmatinasser\Verta\Facades\Verta::instance($product_variant->created_at)->formatJalaliDate()}}</div>
                                </td>
                                <td data-tw-merge=""
                                    class="px-5 border-b dark:border-darkmode-300 box relative w-20 rounded-l-none rounded-r-none border-x-0 py-0 shadow-[5px_3px_5px_#00000005] rtl:first:rounded-r-[0.6rem] ltr:first:rounded-l-[0.6rem] rtl:first:border-r ltr:first:border-l rtl:last:rounded-l-[0.6rem] ltr:last:rounded-r-[0.6rem] rtl:last:border-l ltr:last:border-r dark:bg-darkmode-600">
                                    <div class="flex items-center justify-center">
                                        <div data-tw-merge="" data-tw-placement="bottom-start"
                                             class="relative h-5 dropdown">
                                            <x-akar-chat-approve class="text-info h-6 w-6 cursor-pointer" wire:click="approveProductVariant({{$product_variant->id}})" />
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div
                        class="flex-reverse flex flex-col-reverse flex-wrap items-center justify-center gap-y-2 p-5 sm:flex-row">
                        {{$this->product_variants->links('admin.layouts.pagination')}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
