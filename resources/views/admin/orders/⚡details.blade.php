<?php

use App\Models\Order;
use App\Models\OrderDetail;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

new  #[Layout('admin::layouts.master', ['breadcrumb' => 'جزئیات فروش']), Title('جزئیات فروش')]
class extends Component {

    public Order $order;
    public $order_details;

    public function mount(): void
    {
        $this->order_details = $this->order->orderDetails;
    }

    public function changeStatus()
    {
        if($this->order->status == \App\Enums\OrderStatus::PROCESSING->value){
            $this->order->update([
                'status'=> \App\Enums\OrderStatus::COMPLETED->value
            ]);
        }elseif($this->order->status == \App\Enums\OrderStatus::COMPLETED->value){
            $this->order->update([
                'status'=> \App\Enums\OrderStatus::REJECTED->value
            ]);
        }elseif($this->order->status == \App\Enums\OrderStatus::REJECTED->value){
            $this->order->update([
                'status'=> \App\Enums\OrderStatus::PROCESSING->value
            ]);
        }
    }

};
?>

<div
    class="content transition-[margin,width] duration-100 rtl:xl:pr-3.5 ltr:xl:pl-3.5 pt-[54px] pb-16 relative z-10 group mode content--compact rtl:xl:mr-[275px] ltr:xl:ml-[275px] mode--light rtl:[&.content--compact]:xl:mr-[91px] ltr:[&.content--compact]:xl:ml-[91px]">
    <div class="px-5 mt-16">
        <div class="container">
            <div class="grid grid-cols-12 gap-x-6 gap-y-10">
                <div class="col-span-12">
                    <div class="flex flex-col gap-y-3 lg:h-10 lg:flex-row lg:items-center">
                        <div class="flex items-center text-lg font-medium group-[.mode--light]:text-white">
                            سفارش
                            <i data-tw-merge="" data-lucide="arrow-right"
                               class="mx-1 h-3.5 w-3.5 stroke-[1.3] sm:mx-2 sm:h-5 sm:w-5 rtl:rotate-180"></i>
                            <div class="text-sm sm:text-lg">
                                {{$this->order->order_code}}
                            </div>
                        </div>
                        <div class="flex flex-col gap-x-3 gap-y-2 sm:flex-row rtl:lg:mr-auto ltr:lg:ml-auto">
                            <button data-tw-merge=""
                                    class="transition duration-200 border shadow-sm inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&:hover:not(:disabled)]:bg-opacity-90 [&:hover:not(:disabled)]:border-opacity-90 [&:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary group-[.mode--light]:!border-transparent group-[.mode--light]:!bg-white/[0.12] group-[.mode--light]:!text-slate-200">
                                <i data-tw-merge="" data-lucide="printer"
                                   class="rtl:ml-3 ltr:mr-3 h-4 w-4 stroke-[1.3]"></i>
                                چاپ سفارش
                            </button>
                        </div>
                    </div>
                    <div class="mt-3.5 grid grid-cols-10 gap-5">
                        <div class="col-span-12 xl:col-span-3">
                            <div class="box box--stacked flex flex-col p-5">
                                <div class="flex flex-col gap-5">
                                    <div
                                        class="relative mt-3 rounded-[0.6rem] border border-slate-200/80 dark:border-darkmode-400">
                                        <div
                                            class="absolute rtl:right-0 ltr:left-0 -mt-2 rtl:mr-4 ltr:ml-4 bg-white px-3 text-xs uppercase text-slate-500">
                                            <div class="-mt-px">جزئیات خریدار</div>
                                        </div>
                                        <div class="mt-2.5 flex flex-col gap-5 p-5">
                                            <div class="flex items-center">
                                                <i data-tw-merge="" data-lucide="clipboard"
                                                   class="rtl:ml-2.5 ltr:mr-2.5 h-4 w-4 stroke-[1.3] text-slate-500"></i>
                                                <div
                                                    class="flex w-full flex-col flex-wrap gap-y-1 sm:flex-row sm:items-center">
                                                    <div class="w-54 rtl:sm:ml-auto ltr:sm:mr-auto">نام خریدار:</div>
                                                    <a class="underline decoration-primary/30 decoration-dotted underline-offset-[3px]"
                                                       href="">
                                                        {{$this->order->user->name}}
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="flex items-center">
                                                <i data-tw-merge="" data-lucide="clipboard"
                                                   class="rtl:ml-2.5 ltr:mr-2.5 h-4 w-4 stroke-[1.3] text-slate-500"></i>
                                                <div
                                                    class="flex w-full flex-col flex-wrap gap-y-1 sm:flex-row sm:items-center">
                                                    <div class="w-54 rtl:sm:ml-auto ltr:sm:mr-auto">نام تحویل گیرنده:</div>
                                                    <a class="underline decoration-primary/30 decoration-dotted underline-offset-[3px]"
                                                       href="">
                                                        {{$this->order->receiver_name}} {{ $this->order->receiver_family}}
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="flex items-center">
                                                <i data-tw-merge="" data-lucide="calendar"
                                                   class="rtl:ml-2.5 ltr:mr-2.5 h-4 w-4 stroke-[1.3] text-slate-500"></i>
                                                <div
                                                    class="flex w-full flex-col flex-wrap gap-y-1 sm:flex-row sm:items-center">
                                                    <div class="w-54 rtl:sm:ml-auto ltr:sm:mr-auto">شماره تلفن:</div>
                                                    {{$this->order->phone}}
                                                </div>
                                            </div>
                                            <div class="flex items-center">
                                                <i data-tw-merge="" data-lucide="clock"
                                                   class="rtl:ml-2.5 ltr:mr-2.5 h-4 w-4 stroke-[1.3] text-slate-500"></i>
                                                <div
                                                    class="flex w-full flex-col flex-wrap gap-y-1 sm:flex-row sm:items-center">
                                                    <div class="w-54 rtl:sm:ml-auto ltr:sm:mr-auto">آدرس:</div>
                                                    <ul>
                                                        <li>{{$this->order->province}}</li>
                                                        <li>{{$this->order->city}}</li>
                                                        <li>{{$this->order->postal_code}}</li>
                                                        <li>{{$this->order->address}}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="relative mt-3 rounded-[0.6rem] border border-slate-200/80 dark:border-darkmode-400">
                                        <div
                                            class="absolute rtl:right-0 ltr:left-0 -mt-2 rtl:mr-4 ltr:ml-4 bg-white px-3 text-xs uppercase text-slate-500">
                                            <div class="-mt-px">جزئیات تراکنش</div>
                                        </div>
                                        <div class="mt-2.5 flex flex-col gap-5 p-5">
                                            <div class="flex items-center">
                                                <i data-tw-merge="" data-lucide="clipboard"
                                                   class="rtl:ml-2.5 ltr:mr-2.5 h-4 w-4 stroke-[1.3] text-slate-500"></i>
                                                <div
                                                    class="flex w-full flex-col flex-wrap gap-y-1 sm:flex-row sm:items-center">
                                                    <div class="w-54 rtl:sm:ml-auto ltr:sm:mr-auto">تاریخ خرید:</div>
                                                    {{\Hekmatinasser\Verta\Verta::instance($this->order->created_at)}}
                                                </div>
                                            </div>
                                            <div class="flex items-center">
                                                <i data-tw-merge="" data-lucide="clock"
                                                   class="rtl:ml-2.5 ltr:mr-2.5 h-4 w-4 stroke-[1.3] text-slate-500"></i>
                                                <div
                                                    class="flex w-full flex-col flex-wrap gap-y-1 sm:flex-row sm:items-center">
                                                    <div class="w-54 rtl:sm:ml-auto ltr:sm:mr-auto">
                                                        وضعیت تراکنش:
                                                    </div>
                                                    <div
                                                        class="rtl:ml-auto ltr:mr-auto flex items-center rounded-md border border-success/10 bg-success/10 px-1.5 py-px text-xs font-medium text-success rtl:sm:ml-0 ltr:sm:mr-0">
                                                        @if($this->order->status === \App\Enums\OrderStatus::REJECTED->value)
                                                            <span class=" text-danger">مرجوع شده</span>
                                                        @elseif($this->order->status === \App\Enums\OrderStatus::PROCESSING->value)
                                                            <span class=" text-warning">در حال پردازش</span>
                                                        @elseif($this->order->status === \App\Enums\OrderStatus::COMPLETED->value)
                                                            <span class=" text-success">تکمیل شده</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex items-center">
                                                <i data-tw-merge="" data-lucide="clipboard"
                                                   class="rtl:ml-2.5 ltr:mr-2.5 h-4 w-4 stroke-[1.3] text-slate-500"></i>
                                                <div
                                                    class="flex w-full flex-col flex-wrap gap-y-1 sm:flex-row sm:items-center">
                                                    <div class="w-54 rtl:sm:ml-auto ltr:sm:mr-auto">روش پرداخت:</div>
                                                    {{$this->order->paymentType->title}}
                                                </div>
                                            </div>
                                            <div class="mt-1.5">
                                                <button data-tw-merge="" wire:click="changeStatus"
                                                        class="transition duration-200 border shadow-sm inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&:hover:not(:disabled)]:bg-opacity-90 [&:hover:not(:disabled)]:border-opacity-90 [&:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed w-full border-primary/20 text-primary/80 hover:bg-slate-50">
                                                    <i data-tw-merge="" data-lucide="pen-square"
                                                       class="rtl:ml-2 ltr:mr-2 h-4 w-4 stroke-[1.3]"></i>
                                                    تغییر وضعیت
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div
                                        class="relative mt-3 rounded-[0.6rem] border border-slate-200/80 dark:border-darkmode-400">
                                        <div
                                            class="absolute rtl:right-0 ltr:left-0 -mt-2 rtl:mr-4 ltr:ml-4 bg-white px-3 text-xs uppercase text-slate-500">
                                            <div class="-mt-px">جزئیات حمل و نقل</div>
                                        </div>
                                        <div class="mt-2.5 flex flex-col gap-5 p-5">
                                            <div class="flex items-center">
                                                <i data-tw-merge="" data-lucide="calendar"
                                                   class="rtl:ml-2.5 ltr:mr-2.5 h-4 w-4 stroke-[1.3] text-slate-500"></i>
                                                <div
                                                    class="flex w-full flex-col flex-wrap gap-y-1 sm:flex-row sm:items-center">
                                                    <div class="w-54 rtl:sm:ml-auto ltr:sm:mr-auto">
                                                        قیمت مجموع (18 آیتم):
                                                    </div>
                                                    1.442 تومان
                                                </div>
                                            </div>
                                            <div class="flex items-center">
                                                <i data-tw-merge="" data-lucide="clock"
                                                   class="rtl:ml-2.5 ltr:mr-2.5 h-4 w-4 stroke-[1.3] text-slate-500"></i>
                                                <div
                                                    class="flex w-full flex-col flex-wrap gap-y-1 sm:flex-row sm:items-center">
                                                    <div class="w-54 rtl:sm:ml-auto ltr:sm:mr-auto">
                                                        هزینه حمل و نقل:
                                                    </div>
                                                    96 تومان
                                                </div>
                                            </div>
                                            <div class="flex items-center">
                                                <i data-tw-merge="" data-lucide="map"
                                                   class="rtl:ml-2.5 ltr:mr-2.5 h-4 w-4 stroke-[1.3] text-slate-500"></i>
                                                <div
                                                    class="flex w-full flex-col flex-wrap gap-y-1 sm:flex-row sm:items-center">
                                                    <div class="w-54 rtl:sm:ml-auto ltr:sm:mr-auto">
                                                        بیمه حمل و نقل:
                                                    </div>
                                                    179 تومان
                                                </div>
                                            </div>
                                            <div class="flex items-center">
                                                <i data-tw-merge="" data-lucide="banknote"
                                                   class="rtl:ml-2.5 ltr:mr-2.5 h-4 w-4 stroke-[1.3] text-slate-500"></i>
                                                <div
                                                    class="flex w-full flex-col flex-wrap gap-y-1 sm:flex-row sm:items-center">
                                                    <div class="w-54 rtl:sm:ml-auto ltr:sm:mr-auto">مجموع:</div>
                                                    $
                                                    1.442
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 flex flex-col gap-7 xl:col-span-7">
                            <div class="box box--stacked flex flex-col p-5">
                                <div
                                    class="relative mt-3 rounded-[0.6rem] border border-slate-200/80 dark:border-darkmode-400">
                                    <div
                                        class="absolute rtl:right-0 ltr:left-0 -mt-2 rtl:mr-4 ltr:ml-4 bg-white px-3 text-xs uppercase text-slate-500">
                                        <div class="-mt-px">جزئیات محصول</div>
                                    </div>
                                    <div class="mt-2.5 flex flex-col gap-5 p-5">
                                        <div class="overflow-auto xl:overflow-visible">
                                            <table data-tw-merge=""
                                                   class="w-full rtl:text-right ltr:text-left border-b border-dashed border-slate-200/80">
                                                <thead data-tw-merge="" class="">
                                                <tr data-tw-merge="" class="">
                                                    <td data-tw-merge=""
                                                        class="dark:border-darkmode-300 border-b-0 px-0 py-0 rtl:[&_div]:first:rounded-r-md ltr:[&_div]:first:rounded-l-md rtl:[&_div]:first:border-r ltr:[&_div]:first:border-l rtl:[&_div]:last:rounded-l-md ltr:[&_div]:last:rounded-r-md rtl:[&_div]:last:border-l ltr:[&_div]:last:border-r">
                                                        <div
                                                            class="border-y border-slate-200/80 bg-slate-50 px-5 py-4 font-medium text-slate-500">
                                                             عکس - نام محصول
                                                        </div>
                                                    </td>
                                                    <td data-tw-merge=""
                                                        class="dark:border-darkmode-300 border-b-0 px-0 py-0 rtl:[&_div]:first:rounded-r-md ltr:[&_div]:first:rounded-l-md rtl:[&_div]:first:border-r ltr:[&_div]:first:border-l rtl:[&_div]:last:rounded-l-md ltr:[&_div]:last:rounded-r-md rtl:[&_div]:last:border-l ltr:[&_div]:last:border-r">
                                                        <div
                                                            class="border-y border-slate-200/80 bg-slate-50 px-5 py-4 rtl:text-left ltr:text-right font-medium text-slate-500">
                                                            تعداد
                                                        </div>
                                                    </td>
                                                    <td data-tw-merge=""
                                                        class="dark:border-darkmode-300 border-b-0 px-0 py-0 rtl:[&_div]:first:rounded-r-md ltr:[&_div]:first:rounded-l-md rtl:[&_div]:first:border-r ltr:[&_div]:first:border-l rtl:[&_div]:last:rounded-l-md ltr:[&_div]:last:rounded-r-md rtl:[&_div]:last:border-l ltr:[&_div]:last:border-r">
                                                        <div
                                                            class="border-y border-slate-200/80 bg-slate-50 px-5 py-4 rtl:text-left ltr:text-right font-medium text-slate-500">
                                                           اصلی قیمت
                                                        </div>
                                                    </td>
                                                    <td data-tw-merge=""
                                                        class="dark:border-darkmode-300 border-b-0 px-0 py-0 rtl:[&_div]:first:rounded-r-md ltr:[&_div]:first:rounded-l-md rtl:[&_div]:first:border-r ltr:[&_div]:first:border-l rtl:[&_div]:last:rounded-l-md ltr:[&_div]:last:rounded-r-md rtl:[&_div]:last:border-l ltr:[&_div]:last:border-r">
                                                        <div
                                                            class="border-y border-slate-200/80 bg-slate-50 px-5 py-4 rtl:text-left ltr:text-right font-medium text-slate-500">
                                                            تخفیف
                                                        </div>
                                                    </td>
                                                    <td data-tw-merge=""
                                                        class="dark:border-darkmode-300 border-b-0 px-0 py-0 rtl:[&_div]:first:rounded-r-md ltr:[&_div]:first:rounded-l-md rtl:[&_div]:first:border-r ltr:[&_div]:first:border-l rtl:[&_div]:last:rounded-l-md ltr:[&_div]:last:rounded-r-md rtl:[&_div]:last:border-l ltr:[&_div]:last:border-r">
                                                        <div
                                                            class="border-y border-slate-200/80 bg-slate-50 px-5 py-4 rtl:text-left ltr:text-right font-medium text-slate-500">
                                                            قیمت نهایی
                                                        </div>
                                                    </td>
                                                    <td data-tw-merge=""
                                                        class="dark:border-darkmode-300 border-b-0 px-0 py-0 rtl:[&_div]:first:rounded-r-md ltr:[&_div]:first:rounded-l-md rtl:[&_div]:first:border-r ltr:[&_div]:first:border-l rtl:[&_div]:last:rounded-l-md ltr:[&_div]:last:rounded-r-md rtl:[&_div]:last:border-l ltr:[&_div]:last:border-r">
                                                        <div
                                                            class="border-y border-slate-200/80 bg-slate-50 px-5 py-4 rtl:text-left ltr:text-right font-medium text-slate-500">
                                                            وضعیت
                                                        </div>
                                                    </td>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($this->order_details as $detail)
                                                    <tr data-tw-merge=""
                                                        class="[&_td]:first:pt-5 [&_td]:last:border-b-0 [&_td]:last:pb-5">
                                                        <td data-tw-merge=""
                                                            class="px-5 border-b dark:border-darkmode-300 border-dashed py-3.5 dark:bg-darkmode-600">
                                                            <div class="flex items-center">
                                                                <div class="image-fit zoom-in h-11 w-11">
                                                                    <img data-placement="top" title="{{$detail->product->title}}"
                                                                         src="{{$detail->product->getMedia('products')->first()->getUrl()}}"
                                                                         alt=""
                                                                         class="tooltip cursor-pointer rounded-full shadow-[0px_0px_0px_2px_#fff,_1px_1px_5px_rgba(0,0,0,0.32)] dark:shadow-[0px_0px_0px_2px_#3f4865,_1px_1px_5px_rgba(0,0,0,0.32)]">
                                                                </div>
                                                                <div class="rtl:mr-5 ltr:ml-5">
                                                                    <a class="whitespace-nowrap font-medium" href="">
                                                                        {{$detail->product->title}}
                                                                    </a>
                                                                    <div
                                                                        class="mt-1 flex flex-col gap-0.5 whitespace-nowrap text-xs text-slate-500">
                                                                        رنگ
                                                                        {{$detail->color->title}}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td data-tw-merge=""
                                                            class="px-5 border-b dark:border-darkmode-300 border-dashed py-4 rtl:text-left ltr:text-right dark:bg-darkmode-600">
                                                            <div class="whitespace-nowrap">
                                                                {{$detail->count}}
                                                            </div>
                                                        </td>
                                                        <td data-tw-merge=""
                                                            class="px-5 border-b dark:border-darkmode-300 border-dashed py-4 rtl:text-left ltr:text-right dark:bg-darkmode-600">
                                                            <div class="whitespace-nowrap">
                                                                {{$detail->price}}
                                                            </div>
                                                        </td>
                                                        <td data-tw-merge=""
                                                            class="px-5 border-b dark:border-darkmode-300 border-dashed py-4 rtl:text-left ltr:text-right dark:bg-darkmode-600">
                                                            <div class="whitespace-nowrap font-medium">
                                                                {{$detail->discount}}
                                                            </div>
                                                        </td>
                                                        <td data-tw-merge=""
                                                            class="px-5 border-b dark:border-darkmode-300 border-dashed py-4 rtl:text-left ltr:text-right dark:bg-darkmode-600">
                                                            <div class="whitespace-nowrap font-medium">
                                                                {{$detail->discount_price}} تومان
                                                            </div>
                                                        </td>
                                                        <td data-tw-merge=""
                                                            class="px-5 border-b dark:border-darkmode-300 border-dashed py-4 rtl:text-left ltr:text-right dark:bg-darkmode-600">
                                                            <div class="whitespace-nowrap font-medium">
                                                                @if($detail->status == \App\Enums\OrderDetailsStatus::COMPLETED->value)
                                                                    <p>تکمیل سفارش</p>
                                                                @elseif($detail->status == \App\Enums\OrderDetailsStatus::PENDING->value)
                                                                     <p>سفارش در حال پردازش</p>
                                                                @elseif($detail->status == \App\Enums\OrderDetailsStatus::FAILED->value)
                                                                    <p>سفارش لغو شده</p>
                                                                @elseif($detail->status == \App\Enums\OrderDetailsStatus::SEND_BY_SELLER->value)
                                                                    <p>سفارش ارسال شده توسط فروشنده</p>
                                                                @endif
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach


                                                </tbody>
                                            </table>
                                        </div>
                                        <div
                                            class="mb-5 rtl:mr-auto ltr:ml-auto mt-3 flex flex-col gap-3.5 rtl:pl-5 ltr:pr-5 rtl:text-left ltr:text-right">
                                            <div class="flex items-center justify-end">
                                                <div class="text-slate-500">مبلغ کل:</div>
                                                <div class="w-20 font-medium text-slate-600 sm:w-48">
                                                    {{$this->order->total_price}} تومان
                                                </div>
                                            </div>
                                            <div class="flex items-center justify-end">
                                                <div class="text-slate-500">تخفیف کل:</div>
                                                <div class="w-20 font-medium text-slate-600 sm:w-48">
                                                    {{$this->order->total_discount}} تومان
                                                </div>
                                            </div>
                                            @if($this->order->discount_id)
                                                <div class="flex items-center justify-end">
                                                    <div class="text-slate-500">تخفیف با کد:</div>
                                                    <div class="w-20 font-medium text-slate-600 sm:w-48">
                                                        {{($this->order->total_price * \App\Models\Discount::query()->find($this->order->discount_id)->value)/100}} تومان
                                                    </div>
                                                </div>
                                            @endif

                                            <div class="flex items-center justify-end">
                                                <div class="text-slate-500">مبلغ نهایی:</div>
                                                <div class="w-20 font-medium text-slate-600 sm:w-48">
                                                    {{$this->order->total_discount_price}} تومان
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
