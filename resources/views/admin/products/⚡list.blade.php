<?php

use App\Models\Product;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

new #[Layout('admin::layouts.master',['breadcrumb'=>'لیست محصولات']), Title('لیست محصولات')]
class extends Component {

    use WithPagination;
    public $search;

    public function mount()
    {
        if (session()->has('success')){
            LivewireAlert::text(session('success'))
                ->success()
                ->show();
        }
    }

    public function searchProduct()
    {
        $this->products = Product::query()
            ->where('title','like' ,'%'. $this->search . '%')
            ->paginate(10);
    }

    #[Computed]
    public function products()
    {
        return Product::query()->take(20)->paginate(10);
    }
};
?>

<div
    class="content transition-[margin,width] duration-100 rtl:xl:pr-3.5 ltr:xl:pl-3.5 pt-[54px] pb-16 relative z-10 group mode content--compact rtl:xl:mr-[275px] ltr:xl:ml-[275px] mode--light rtl:[&.content--compact]:xl:mr-[91px] ltr:[&.content--compact]:xl:ml-[91px]">
    <div class="px-5 mt-16">
        <div class="container">
            <div class="grid grid-cols-12 gap-x-6 gap-y-10">
                <div class="col-span-12">
                    <div class="flex flex-col gap-y-3 md:h-10 md:flex-row md:items-center">
                        <div class="text-base font-medium group-[.mode--light]:text-white">
                            محصولات
                        </div>
                        <div class="flex flex-col gap-x-3 gap-y-2 sm:flex-row rtl:md:mr-auto ltr:md:ml-auto">
                            <a href="{{route('admin.products.create')}}" data-tw-merge=""
                               class="transition duration-200 border shadow-sm inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&:hover:not(:disabled)]:bg-opacity-90 [&:hover:not(:disabled)]:border-opacity-90 [&:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary group-[.mode--light]:!border-transparent group-[.mode--light]:!bg-white/[0.12] group-[.mode--light]:!text-slate-200">
                                <i data-tw-merge="" data-lucide="pen-line"
                                   class="rtl:ml-2 ltr:mr-2 h-4 w-4 stroke-[1.3]"></i>
                                افزودن محصول جدید
                            </a>
                        </div>
                    </div>
                    <div class="mt-3.5 flex flex-col gap-8">
                        <div class="box box--stacked flex flex-col p-5">
                            <div class="grid grid-cols-4 gap-5">
                                <div
                                    class="box col-span-4 rounded-[0.6rem] border border-dashed border-slate-300/80 p-5 shadow-sm md:col-span-2 xl:col-span-1">
                                    <div class="text-base text-slate-500">تعداد محصولات</div>
                                    <div class="mt-1.5 text-2xl font-medium">457,204</div>
                                    <div
                                        class="absolute inset-y-0 rtl:left-0 ltr:right-0 rtl:ml-5 ltr:mr-5 flex flex-col justify-center">
                                        <div
                                            class="flex items-center rounded-full border border-danger/10 bg-danger/10 py-[2px] rtl:pr-[7px] ltr:pl-[7px] rtl:pl-1 ltr:pr-1 text-xs font-medium text-danger">
                                            3%
                                            <i data-tw-merge="" data-lucide="chevron-down"
                                               class="rtl:mr-px ltr:ml-px h-4 w-4 stroke-[1.5]"></i>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="box col-span-4 rounded-[0.6rem] border border-dashed border-slate-300/80 p-5 shadow-sm md:col-span-2 xl:col-span-1">
                                    <div class="text-base text-slate-500">محصولات فعال</div>
                                    <div class="mt-1.5 text-2xl font-medium">122,721</div>
                                    <div
                                        class="absolute inset-y-0 rtl:left-0 ltr:right-0 rtl:ml-5 ltr:mr-5 flex flex-col justify-center">
                                        <div
                                            class="flex items-center rounded-full border border-success/10 bg-success/10 py-[2px] rtl:pr-[7px] ltr:pl-[7px] rtl:pl-1 ltr:pr-1 text-xs font-medium text-success">
                                            2%
                                            <i data-tw-merge="" data-lucide="chevron-up"
                                               class="rtl:mr-px ltr:ml-px h-4 w-4 stroke-[1.5]"></i>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="box col-span-4 rounded-[0.6rem] border border-dashed border-slate-300/80 p-5 shadow-sm md:col-span-2 xl:col-span-1">
                                    <div class="text-base text-slate-500">محصولات تمام شده</div>
                                    <div class="font-mediumm mt-1.5 text-2xl">489,223</div>
                                    <div
                                        class="absolute inset-y-0 rtl:left-0 ltr:right-0 rtl:ml-5 ltr:mr-5 flex flex-col justify-center">
                                        <div
                                            class="flex items-center rounded-full border border-danger/10 bg-danger/10 py-[2px] rtl:pr-[7px] ltr:pl-[7px] rtl:pl-1 ltr:pr-1 text-xs font-medium text-danger">
                                            3%
                                            <i data-tw-merge="" data-lucide="chevron-down"
                                               class="rtl:mr-px ltr:ml-px h-4 w-4 stroke-[1.5]"></i>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="box col-span-4 rounded-[0.6rem] border border-dashed border-slate-300/80 p-5 shadow-sm md:col-span-2 xl:col-span-1">
                                    <div class="text-base text-slate-500">محصولات رد شده</div>
                                    <div class="font-mediumm mt-1.5 text-2xl">411,259</div>
                                    <div
                                        class="absolute inset-y-0 rtl:left-0 ltr:right-0 rtl:ml-5 ltr:mr-5 flex flex-col justify-center">
                                        <div
                                            class="flex items-center rounded-full border border-success/10 bg-success/10 py-[2px] rtl:pr-[7px] ltr:pl-[7px] rtl:pl-1 ltr:pr-1 text-xs font-medium text-success">
                                            8%
                                            <i data-tw-merge="" data-lucide="chevron-up"
                                               class="rtl:mr-px ltr:ml-px h-4 w-4 stroke-[1.5]"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box box--stacked flex flex-col">
                            @include('admin.layouts.waiting')
                            <div class="flex flex-col gap-y-2 p-5 sm:flex-row sm:items-center">
                                <div>
                                    <div class="relative">
                                        <i data-tw-merge="" data-lucide="search"
                                           class="absolute inset-y-0 rtl:right-0 ltr:left-0 z-10 my-auto rtl:mr-3 ltr:ml-3 h-4 w-4 stroke-[1.3] text-slate-500"></i>
                                        <input wire:model="search" @keyup.enter="$wire.searchProduct" data-tw-merge="" type="text" placeholder="جستجوی محصولات..."
                                               class="disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&[readonly]]:bg-slate-100 [&[readonly]]:cursor-not-allowed [&[readonly]]:dark:bg-darkmode-800/50 [&[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 [&[type='file']]:border rtl:file:ml-4 ltr:file:mr-4 file:py-2 file:px-4 rtl:file:rounded-r-md ltr:file:rounded-l-md file:border-0 rtl:file:border-l-[1px] ltr:file:border-r-[1px] file:border-slate-100/10 file:text-sm file:font-semibold file:bg-slate-100 file:text-slate-500/70 hover:file:bg-200 group-[.form-inline]:flex-1 group-[.input-group]:rounded-none rtl:group-[.input-group]:[&:not(:first-child)]:border-r-transparent ltr:group-[.input-group]:[&:not(:first-child)]:border-l-transparent rtl:group-[.input-group]:first:rounded-r ltr:group-[.input-group]:first:rounded-l rtl:group-[.input-group]:last:rounded-l ltr:group-[.input-group]:last:rounded-r group-[.input-group]:z-10 rounded-[0.5rem] rtl:pr-9 ltr:pl-9 sm:w-64">
                                    </div>
                                </div>
                            </div>
                            <div class="overflow-auto xl:overflow-visible">
                                <table data-tw-merge=""
                                       class="w-full rtl:text-right ltr:text-left border-b border-slate-200/60">
                                    <thead data-tw-merge="" class="">
                                    <tr data-tw-merge="" class="">
                                        <td data-tw-merge=""
                                            class="px-5 border-b dark:border-darkmode-300 w-5 border-t border-slate-200/60 bg-slate-50 py-4 font-medium text-slate-500">
                                            <input data-tw-merge="" type="checkbox"
                                                   class="transition-all duration-100 ease-in-out shadow-sm border-slate-200 cursor-pointer rounded focus:ring-4 focus:ring-offset-0 focus:ring-primary focus:ring-opacity-20 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&[type='radio']]:checked:bg-primary [&[type='radio']]:checked:border-primary [&[type='radio']]:checked:border-opacity-10 [&[type='checkbox']]:checked:bg-primary [&[type='checkbox']]:checked:border-primary [&[type='checkbox']]:checked:border-opacity-10 [&:disabled:not(:checked)]:bg-slate-100 [&:disabled:not(:checked)]:cursor-not-allowed [&:disabled:not(:checked)]:dark:bg-darkmode-800/50 [&:disabled:checked]:opacity-70 [&:disabled:checked]:cursor-not-allowed [&:disabled:checked]:dark:bg-darkmode-800/50">
                                        </td>
                                        <td data-tw-merge=""
                                            class="px-5 border-b dark:border-darkmode-300 border-t border-slate-200/60 bg-slate-50 py-4 font-medium text-slate-500">
                                            نام محصول
                                        </td>
                                        <td data-tw-merge=""
                                            class="px-5 border-b dark:border-darkmode-300 border-t border-slate-200/60 bg-slate-50 py-4 font-medium text-slate-500">
                                            دسته بندی
                                        </td>
                                        <td data-tw-merge=""
                                            class="px-5 border-b dark:border-darkmode-300 border-t border-slate-200/60 bg-slate-50 py-4 font-medium text-slate-500">
                                            قیمت
                                        </td>
                                        <td data-tw-merge=""
                                            class="px-5 border-b dark:border-darkmode-300 border-t border-slate-200/60 bg-slate-50 py-4 font-medium text-slate-500">
                                            تخفیف
                                        </td>
                                        <td data-tw-merge=""
                                            class="px-5 border-b dark:border-darkmode-300 border-t border-slate-200/60 bg-slate-50 py-4 font-medium text-slate-500">
                                            تاریخ ثبت
                                        </td>
                                        <td data-tw-merge=""
                                            class="px-5 border-b dark:border-darkmode-300 w-20 border-t border-slate-200/60 bg-slate-50 py-4 text-center font-medium text-slate-500">
                                            عملیات
                                        </td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($this->products as $product)
                                        <tr data-tw-merge="" class="[&_td]:last:border-b-0">
                                            <td data-tw-merge=""
                                                class="px-5 border-b dark:border-darkmode-300 border-dashed py-4 dark:bg-darkmode-600">
                                                <input data-tw-merge="" type="checkbox"
                                                       class="transition-all duration-100 ease-in-out shadow-sm border-slate-200 cursor-pointer rounded focus:ring-4 focus:ring-offset-0 focus:ring-primary focus:ring-opacity-20 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&[type='radio']]:checked:bg-primary [&[type='radio']]:checked:border-primary [&[type='radio']]:checked:border-opacity-10 [&[type='checkbox']]:checked:bg-primary [&[type='checkbox']]:checked:border-primary [&[type='checkbox']]:checked:border-opacity-10 [&:disabled:not(:checked)]:bg-slate-100 [&:disabled:not(:checked)]:cursor-not-allowed [&:disabled:not(:checked)]:dark:bg-darkmode-800/50 [&:disabled:checked]:opacity-70 [&:disabled:checked]:cursor-not-allowed [&:disabled:checked]:dark:bg-darkmode-800/50">
                                            </td>
                                            <td data-tw-merge=""
                                                class="px-5 border-b dark:border-darkmode-300 w-80 border-dashed py-4 dark:bg-darkmode-600">
                                                <div class="flex items-center">
                                                    <div class="image-fit zoom-in h-9 w-9">
{{--                                                        <img data-placement="top" title="{{$product->name}}"--}}
{{--                                                             src="{{ $product->image ? url('images/products/'. $product->image) : url('panel/images/products/profile.jpg')}}"--}}
{{--                                                             class="tooltip cursor-pointer rounded-full shadow-[0px_0px_0px_2px_#fff,_1px_1px_5px_rgba(0,0,0,0.32)] dark:shadow-[0px_0px_0px_2px_#3f4865,_1px_1px_5px_rgba(0,0,0,0.32)]">--}}
                                                    </div>
                                                    <div class="rtl:mr-3.5 ltr:ml-3.5">
                                                        <a class="whitespace-nowrap font-medium" href="">
                                                            {{$product->title}}
                                                        </a>
                                                        <div class="mt-0.5 whitespace-nowrap text-xs text-slate-500">
                                                            {{$product->e_title}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td data-tw-merge=""
                                                class="px-5 border-b dark:border-darkmode-300 border-dashed py-4 dark:bg-darkmode-600">
                                                <a class="whitespace-nowrap font-medium">
                                                    {{$product->category_id}}
                                                </a>
                                            </td>
                                            <td data-tw-merge=""
                                                class="px-5 border-b dark:border-darkmode-300 border-dashed py-4 dark:bg-darkmode-600">
                                                <a class="whitespace-nowrap font-medium">
                                                    {{$product->price}}
                                                </a>
                                            </td>
                                            <td data-tw-merge=""
                                                class="px-5 border-b dark:border-darkmode-300 border-dashed py-4 dark:bg-darkmode-600">
                                                <a class="whitespace-nowrap font-medium">
                                                    {{$product->discount}}
                                                </a>
                                            </td>
                                            <td data-tw-merge=""
                                                class="px-5 border-b dark:border-darkmode-300 border-dashed py-4 dark:bg-darkmode-600">
                                                <div class="whitespace-nowrap">
                                                    {{\Hekmatinasser\Verta\Facades\Verta::instance($product->created_at)->formatJalaliDate()}}
                                                </div>
                                            </td>
                                            <td data-tw-merge=""
                                                class="flex gap-x-2 px-5 border-b dark:border-darkmode-300 border-dashed py-4 dark:bg-darkmode-600">
                                                <a href="{{route('admin.products.edit',$product->id)}}"><x-fas-edit class="text-info h-6 w-6 cursor-pointer"/></a>
                                                <x-fas-trash
                                                    wire:click="$dispatch('delete-product',{ product_id: {{$product->id}} } )"
                                                    class="text-danger h-6 w-6 cursor-pointer m-4"/>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div
                                class="flex-reverse flex flex-col-reverse flex-wrap items-center justify-center gap-y-2 p-5 sm:flex-row">
                                {{$this->products->links('admin.layouts.pagination')}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    Livewire.on('delete-product', (event) => {

        Swal.fire({
            title: "آیا از حذف مطمئن هستید؟",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "بله",
            cancelButtonText: "خیر",
        }).then((result) => {
            if (result.isConfirmed) {
                //console.log(event)
                Livewire.dispatch('destroy-product', {product_id: event.product_id})
                Swal.fire({
                    text: "حذف با موفقیت انجام شد",
                    icon: "success"
                });
            }
        });

    })
</script>
