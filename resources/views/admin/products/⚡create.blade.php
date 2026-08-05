<?php

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;

new  #[Layout('admin::layouts.master', ['breadcrumb' => 'ایجاد محصول']), Title('ایجاد محصول')]
class extends Component {

    use WithFileUploads;

    #[Validate('required')]
    public $title, $e_title, $price, $category_id, $brand_id;
    public $description, $discount, $count, $max_sell;

    public function createProduct(): void
    {
        dd($this->description);
        $this->validate();

        Product::query()->create([
            'title' => $this->title,
            'e_title' => $this->e_title,
            'slug' => make_slug($this->title),
            'description' => $this->description,
            'price' => $this->price,
            'discount' => $this->discount,
            'count' => $this->count,
            'max_sell' => $this->max_sell,
            'category_id' => $this->category_id,
            'brand_id' => $this->brand_id,
        ]);

        session()->flash('success', 'محصول با موفقیت ایجاد شد');
        $this->redirectRoute('admin.products.list');
    }

    #[On('set-category')]
    public function setCategoryId($id)
    {
        $this->category_id = $id;
    }

    #[Computed]
    public function allCategories(): array
    {
        return Category::getAllCategories();
    }

    #[On('set-brand')]
    public function setBrandId($id): void
    {
        $this->brand_id = $id;
    }

    #[Computed]
    public function allBrands(): array
    {
        return Brand::query()->pluck('title', 'id')->toArray();
    }

};
?>

<div
    class="content transition-[margin,width] duration-100 rtl:xl:pr-3.5 ltr:xl:pl-3.5 pt-[54px] pb-16 relative z-10 group mode content--compact rtl:xl:mr-[275px] ltr:xl:ml-[275px] mode--light rtl:[&.content--compact]:xl:mr-[91px] ltr:[&.content--compact]:xl:ml-[91px]">
    <div class="px-5 mt-16">
        <div class="container">
            <div class="grid grid-cols-12 gap-x-6 gap-y-10">
                <div class="col-span-12 sm:col-span-10 sm:col-start-2">
                    @include('admin.layouts.waiting')
                    <div class="mt-7">
                        <form wire:submit="createProduct" class="box box--stacked flex flex-col">
                            <div class="p-7">
                                <div
                                    class="mt-5 block flex-col pt-5 first:mt-0 first:pt-0 sm:flex xl:flex-row xl:items-center">
                                    <div
                                        class="mb-2 inline-block sm:mb-0 rtl:sm:ml-5 ltr:sm:mr-5 rtl:sm:text-left ltr:sm:text-right rtl:xl:ml-14 ltr:xl:mr-14 xl:w-60">
                                        <div class="rtl:text-right ltr:text-left">
                                            <div class="flex items-center">
                                                <div class="font-medium">نام فارسی محصول</div>
                                                <div
                                                    class="rtl:mr-2.5 ltr:ml-2.5 rounded-md border border-slate-200 bg-slate-100 px-2 py-0.5 text-xs text-slate-500 dark:bg-darkmode-300 dark:text-slate-400">
                                                    ضروری
                                                </div>
                                            </div>
                                            <div class="mt-1.5 text-xs leading-relaxed text-slate-500/80 xl:mt-3">
                                                نام فارسی محصول را وارد کنید
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-3 w-full flex-1 xl:mt-0">
                                        <div class="flex flex-col items-center">
                                            <input wire:model="title" data-tw-merge="" type="text"
                                                   class="disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&[readonly]]:bg-slate-100 [&[readonly]]:cursor-not-allowed [&[readonly]]:dark:bg-darkmode-800/50 [&[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 [&[type='file']]:border rtl:file:ml-4 ltr:file:mr-4 file:py-2 file:px-4 rtl:file:rounded-r-md ltr:file:rounded-l-md file:border-0 rtl:file:border-l-[1px] ltr:file:border-r-[1px] file:border-slate-100/10 file:text-sm file:font-semibold file:bg-slate-100 file:text-slate-500/70 hover:file:bg-200 group-[.form-inline]:flex-1 group-[.input-group]:rounded-none rtl:group-[.input-group]:[&:not(:first-child)]:border-r-transparent ltr:group-[.input-group]:[&:not(:first-child)]:border-l-transparent rtl:group-[.input-group]:first:rounded-r ltr:group-[.input-group]:first:rounded-l rtl:group-[.input-group]:last:rounded-l ltr:group-[.input-group]:last:rounded-r group-[.input-group]:z-10 first:rounded-b-none last:-mt-px last:rounded-t-none focus:z-10 rtl:first:md:rounded-l-none ltr:first:md:rounded-r-none rtl:first:md:rounded-br-md ltr:first:md:rounded-bl-md rtl:last:md:-mr-px ltr:last:md:-ml-px last:md:mt-0 rtl:last:md:rounded-r-none ltr:last:md:rounded-l-none rtl:last:md:rounded-tl-md ltr:last:md:rounded-tr-md [&:not(:first-child):not(:last-child)]:-mt-px [&:not(:first-child):not(:last-child)]:rounded-none rtl:[&:not(:first-child):not(:last-child)]:md:-mr-px ltr:[&:not(:first-child):not(:last-child)]:md:-ml-px [&:not(:first-child):not(:last-child)]:md:mt-0">
                                            @error('title')
                                            <span class="block text-danger my-2"> {{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="mt-5 block flex-col pt-5 first:mt-0 first:pt-0 sm:flex xl:flex-row xl:items-center">
                                    <div
                                        class="mb-2 inline-block sm:mb-0 rtl:sm:ml-5 ltr:sm:mr-5 rtl:sm:text-left ltr:sm:text-right rtl:xl:ml-14 ltr:xl:mr-14 xl:w-60">
                                        <div class="rtl:text-right ltr:text-left">
                                            <div class="flex items-center">
                                                <div class="font-medium">نام انگلیسی محصول</div>
                                                <div
                                                    class="rtl:mr-2.5 ltr:ml-2.5 rounded-md border border-slate-200 bg-slate-100 px-2 py-0.5 text-xs text-slate-500 dark:bg-darkmode-300 dark:text-slate-400">
                                                    ضروری
                                                </div>
                                            </div>
                                            <div class="mt-1.5 text-xs leading-relaxed text-slate-500/80 xl:mt-3">
                                                نام انگلیسی محصول را وارد کنید
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-3 w-full flex-1 xl:mt-0">
                                        <div class="flex flex-col items-center">
                                            <input wire:model="e_title" data-tw-merge="" type="text"
                                                   class="disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&[readonly]]:bg-slate-100 [&[readonly]]:cursor-not-allowed [&[readonly]]:dark:bg-darkmode-800/50 [&[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 [&[type='file']]:border rtl:file:ml-4 ltr:file:mr-4 file:py-2 file:px-4 rtl:file:rounded-r-md ltr:file:rounded-l-md file:border-0 rtl:file:border-l-[1px] ltr:file:border-r-[1px] file:border-slate-100/10 file:text-sm file:font-semibold file:bg-slate-100 file:text-slate-500/70 hover:file:bg-200 group-[.form-inline]:flex-1 group-[.input-group]:rounded-none rtl:group-[.input-group]:[&:not(:first-child)]:border-r-transparent ltr:group-[.input-group]:[&:not(:first-child)]:border-l-transparent rtl:group-[.input-group]:first:rounded-r ltr:group-[.input-group]:first:rounded-l rtl:group-[.input-group]:last:rounded-l ltr:group-[.input-group]:last:rounded-r group-[.input-group]:z-10 first:rounded-b-none last:-mt-px last:rounded-t-none focus:z-10 rtl:first:md:rounded-l-none ltr:first:md:rounded-r-none rtl:first:md:rounded-br-md ltr:first:md:rounded-bl-md rtl:last:md:-mr-px ltr:last:md:-ml-px last:md:mt-0 rtl:last:md:rounded-r-none ltr:last:md:rounded-l-none rtl:last:md:rounded-tl-md ltr:last:md:rounded-tr-md [&:not(:first-child):not(:last-child)]:-mt-px [&:not(:first-child):not(:last-child)]:rounded-none rtl:[&:not(:first-child):not(:last-child)]:md:-mr-px ltr:[&:not(:first-child):not(:last-child)]:md:-ml-px [&:not(:first-child):not(:last-child)]:md:mt-0">
                                            @error('title')
                                            <span class="block text-danger my-2"> {{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="mt-5 block flex-col pt-5 first:mt-0 first:pt-0 sm:flex xl:flex-row xl:items-center">
                                    <div
                                        class="mb-2 inline-block sm:mb-0 rtl:sm:ml-5 ltr:sm:mr-5 rtl:sm:text-left ltr:sm:text-right rtl:xl:ml-14 ltr:xl:mr-14 xl:w-60">
                                        <div class="rtl:text-right ltr:text-left">
                                            <div class="flex items-center">
                                                <div class="font-medium">قیمت</div>
                                                <div
                                                    class="rtl:mr-2.5 ltr:ml-2.5 rounded-md border border-slate-200 bg-slate-100 px-2 py-0.5 text-xs text-slate-500 dark:bg-darkmode-300 dark:text-slate-400">
                                                    ضروری
                                                </div>
                                            </div>
                                            <div class="mt-1.5 text-xs leading-relaxed text-slate-500/80 xl:mt-3">
                                                لطفاً قیمت محصول را وارد کنید.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-3 w-full flex-1 xl:mt-0">
                                        <div class="flex flex-col items-center">
                                            <input wire:model="price" data-tw-merge="" type="text"
                                                   class="disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&[readonly]]:bg-slate-100 [&[readonly]]:cursor-not-allowed [&[readonly]]:dark:bg-darkmode-800/50 [&[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 [&[type='file']]:border rtl:file:ml-4 ltr:file:mr-4 file:py-2 file:px-4 rtl:file:rounded-r-md ltr:file:rounded-l-md file:border-0 rtl:file:border-l-[1px] ltr:file:border-r-[1px] file:border-slate-100/10 file:text-sm file:font-semibold file:bg-slate-100 file:text-slate-500/70 hover:file:bg-200 group-[.form-inline]:flex-1 group-[.input-group]:rounded-none rtl:group-[.input-group]:[&:not(:first-child)]:border-r-transparent ltr:group-[.input-group]:[&:not(:first-child)]:border-l-transparent rtl:group-[.input-group]:first:rounded-r ltr:group-[.input-group]:first:rounded-l rtl:group-[.input-group]:last:rounded-l ltr:group-[.input-group]:last:rounded-r group-[.input-group]:z-10">
                                            @error('price')
                                            <span class="block text-danger my-2"> {{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="mt-5 block flex-col pt-5 first:mt-0 first:pt-0 sm:flex xl:flex-row xl:items-center">
                                    <div
                                        class="mb-2 inline-block sm:mb-0 rtl:sm:ml-5 ltr:sm:mr-5 rtl:sm:text-left ltr:sm:text-right rtl:xl:ml-14 ltr:xl:mr-14 xl:w-60">
                                        <div class="rtl:text-right ltr:text-left">
                                            <div class="flex items-center">
                                                <div class="font-medium">تخفیف</div>
                                                <div
                                                    class="rtl:mr-2.5 ltr:ml-2.5 rounded-md border border-slate-200 bg-slate-100 px-2 py-0.5 text-xs text-slate-500 dark:bg-darkmode-300 dark:text-slate-400">
                                                    ضروری
                                                </div>
                                            </div>
                                            <div class="mt-1.5 text-xs leading-relaxed text-slate-500/80 xl:mt-3">
                                                لطفاً تخفیف را وارد کنید.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-3 w-full flex-1 xl:mt-0">
                                        <div class="flex flex-col items-center">
                                            <input wire:model="discount" data-tw-merge="" type="text"
                                                   class="disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&[readonly]]:bg-slate-100 [&[readonly]]:cursor-not-allowed [&[readonly]]:dark:bg-darkmode-800/50 [&[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 [&[type='file']]:border rtl:file:ml-4 ltr:file:mr-4 file:py-2 file:px-4 rtl:file:rounded-r-md ltr:file:rounded-l-md file:border-0 rtl:file:border-l-[1px] ltr:file:border-r-[1px] file:border-slate-100/10 file:text-sm file:font-semibold file:bg-slate-100 file:text-slate-500/70 hover:file:bg-200 group-[.form-inline]:flex-1 group-[.input-group]:rounded-none rtl:group-[.input-group]:[&:not(:first-child)]:border-r-transparent ltr:group-[.input-group]:[&:not(:first-child)]:border-l-transparent rtl:group-[.input-group]:first:rounded-r ltr:group-[.input-group]:first:rounded-l rtl:group-[.input-group]:last:rounded-l ltr:group-[.input-group]:last:rounded-r group-[.input-group]:z-10 first:rounded-b-none last:-mt-px last:rounded-t-none focus:z-10 rtl:first:md:rounded-l-none ltr:first:md:rounded-r-none rtl:first:md:rounded-br-md ltr:first:md:rounded-bl-md rtl:last:md:-mr-px ltr:last:md:-ml-px last:md:mt-0 rtl:last:md:rounded-r-none ltr:last:md:rounded-l-none rtl:last:md:rounded-tl-md ltr:last:md:rounded-tr-md [&:not(:first-child):not(:last-child)]:-mt-px [&:not(:first-child):not(:last-child)]:rounded-none rtl:[&:not(:first-child):not(:last-child)]:md:-mr-px ltr:[&:not(:first-child):not(:last-child)]:md:-ml-px [&:not(:first-child):not(:last-child)]:md:mt-0">
                                            @error('discount')
                                            <span class="block text-danger my-2"> {{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="mt-5 block flex-col pt-5 first:mt-0 first:pt-0 sm:flex xl:flex-row xl:items-center">
                                    <div
                                        class="mb-2 inline-block sm:mb-0 rtl:sm:ml-5 ltr:sm:mr-5 rtl:sm:text-left ltr:sm:text-right rtl:xl:ml-14 ltr:xl:mr-14 xl:w-60">
                                        <div class="rtl:text-right ltr:text-left">
                                            <div class="flex items-center">
                                                <div class="font-medium">تعداد</div>
                                                <div
                                                    class="rtl:mr-2.5 ltr:ml-2.5 rounded-md border border-slate-200 bg-slate-100 px-2 py-0.5 text-xs text-slate-500 dark:bg-darkmode-300 dark:text-slate-400">
                                                    ضروری
                                                </div>
                                            </div>
                                            <div class="mt-1.5 text-xs leading-relaxed text-slate-500/80 xl:mt-3">
                                                تعداد را وارد کنید
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-3 w-full flex-1 xl:mt-0">
                                        <div class="flex flex-col items-center">
                                            <input wire:model="count" data-tw-merge="" type="text"
                                                   class="disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&[readonly]]:bg-slate-100 [&[readonly]]:cursor-not-allowed [&[readonly]]:dark:bg-darkmode-800/50 [&[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 [&[type='file']]:border rtl:file:ml-4 ltr:file:mr-4 file:py-2 file:px-4 rtl:file:rounded-r-md ltr:file:rounded-l-md file:border-0 rtl:file:border-l-[1px] ltr:file:border-r-[1px] file:border-slate-100/10 file:text-sm file:font-semibold file:bg-slate-100 file:text-slate-500/70 hover:file:bg-200 group-[.form-inline]:flex-1 group-[.input-group]:rounded-none rtl:group-[.input-group]:[&:not(:first-child)]:border-r-transparent ltr:group-[.input-group]:[&:not(:first-child)]:border-l-transparent rtl:group-[.input-group]:first:rounded-r ltr:group-[.input-group]:first:rounded-l rtl:group-[.input-group]:last:rounded-l ltr:group-[.input-group]:last:rounded-r group-[.input-group]:z-10 first:rounded-b-none last:-mt-px last:rounded-t-none focus:z-10 rtl:first:md:rounded-l-none ltr:first:md:rounded-r-none rtl:first:md:rounded-br-md ltr:first:md:rounded-bl-md rtl:last:md:-mr-px ltr:last:md:-ml-px last:md:mt-0 rtl:last:md:rounded-r-none ltr:last:md:rounded-l-none rtl:last:md:rounded-tl-md ltr:last:md:rounded-tr-md [&:not(:first-child):not(:last-child)]:-mt-px [&:not(:first-child):not(:last-child)]:rounded-none rtl:[&:not(:first-child):not(:last-child)]:md:-mr-px ltr:[&:not(:first-child):not(:last-child)]:md:-ml-px [&:not(:first-child):not(:last-child)]:md:mt-0">
                                            @error('count')
                                            <span class="block text-danger my-2"> {{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="mt-5 block flex-col pt-5 first:mt-0 first:pt-0 sm:flex xl:flex-row xl:items-center">
                                    <div
                                        class="mb-2 inline-block sm:mb-0 rtl:sm:ml-5 ltr:sm:mr-5 rtl:sm:text-left ltr:sm:text-right rtl:xl:ml-14 ltr:xl:mr-14 xl:w-60">
                                        <div class="rtl:text-right ltr:text-left">
                                            <div class="flex items-center">
                                                <div class="font-medium">حداکثر فروش</div>
                                                <div
                                                    class="rtl:mr-2.5 ltr:ml-2.5 rounded-md border border-slate-200 bg-slate-100 px-2 py-0.5 text-xs text-slate-500 dark:bg-darkmode-300 dark:text-slate-400">
                                                    ضروری
                                                </div>
                                            </div>
                                            <div class="mt-1.5 text-xs leading-relaxed text-slate-500/80 xl:mt-3">
                                                حداکثر فروش را وارد کنید
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-3 w-full flex-1 xl:mt-0">
                                        <div class="flex flex-col items-center">
                                            <input wire:model="max_sell" data-tw-merge="" type="text"
                                                   class="disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&[readonly]]:bg-slate-100 [&[readonly]]:cursor-not-allowed [&[readonly]]:dark:bg-darkmode-800/50 [&[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 [&[type='file']]:border rtl:file:ml-4 ltr:file:mr-4 file:py-2 file:px-4 rtl:file:rounded-r-md ltr:file:rounded-l-md file:border-0 rtl:file:border-l-[1px] ltr:file:border-r-[1px] file:border-slate-100/10 file:text-sm file:font-semibold file:bg-slate-100 file:text-slate-500/70 hover:file:bg-200 group-[.form-inline]:flex-1 group-[.input-group]:rounded-none rtl:group-[.input-group]:[&:not(:first-child)]:border-r-transparent ltr:group-[.input-group]:[&:not(:first-child)]:border-l-transparent rtl:group-[.input-group]:first:rounded-r ltr:group-[.input-group]:first:rounded-l rtl:group-[.input-group]:last:rounded-l ltr:group-[.input-group]:last:rounded-r group-[.input-group]:z-10 first:rounded-b-none last:-mt-px last:rounded-t-none focus:z-10 rtl:first:md:rounded-l-none ltr:first:md:rounded-r-none rtl:first:md:rounded-br-md ltr:first:md:rounded-bl-md rtl:last:md:-mr-px ltr:last:md:-ml-px last:md:mt-0 rtl:last:md:rounded-r-none ltr:last:md:rounded-l-none rtl:last:md:rounded-tl-md ltr:last:md:rounded-tr-md [&:not(:first-child):not(:last-child)]:-mt-px [&:not(:first-child):not(:last-child)]:rounded-none rtl:[&:not(:first-child):not(:last-child)]:md:-mr-px ltr:[&:not(:first-child):not(:last-child)]:md:-ml-px [&:not(:first-child):not(:last-child)]:md:mt-0">
                                            @error('max_sell')
                                            <span class="block text-danger my-2"> {{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="mt-5 block flex-col pt-5 first:mt-0 first:pt-0 sm:flex xl:flex-row xl:items-center">
                                    <div
                                        class="mb-2 inline-block sm:mb-0 rtl:sm:ml-5 ltr:sm:mr-5 rtl:sm:text-left ltr:sm:text-right rtl:xl:ml-14 ltr:xl:mr-14 xl:w-60">
                                        <div class="rtl:text-right ltr:text-left">
                                            <div class="flex items-center">
                                                <div class="font-medium">دسته بندی</div>
                                                <div
                                                    class="rtl:mr-2.5 ltr:ml-2.5 rounded-md border border-slate-200 bg-slate-100 px-2 py-0.5 text-xs text-slate-500 dark:bg-darkmode-300 dark:text-slate-400">
                                                    ضروری
                                                </div>
                                            </div>
                                            <div class="mt-1.5 text-xs leading-relaxed text-slate-500/80 xl:mt-3">
                                                دسته بندی محصول را مشخص کنید
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-3 w-full flex-1 xl:mt-0">
                                        <div wire:ignore class="flex flex-col items-center">
                                            <select id="category" aria-label=".form-select"
                                                    class="tom-select disabled:bg-slate-100 disabled:cursor-not-allowed disabled:dark:bg-darkmode-800/50 [&amp;[readonly]]:bg-slate-100 [&amp;[readonly]]:cursor-not-allowed [&amp;[readonly]]:dark:bg-darkmode-800/50 transition duration-200 ease-in-out w-full border-slate-200 shadow-sm rounded-md px-3 rtl:pl-8 ltr:pr-8 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 group-[.form-inline]:flex-1 text-md py-1 rtl:pr-4 ltr:pl-4 rtl:sm:ml-2 ltr:sm:mr-2">
                                                <option>دسته بندی</option>
                                                @foreach($this->allCategories as $key=>$value)
                                                    <option value="{{$key}}">{{$value}}</option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                            <span class="block text-danger my-2">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="mt-5 block flex-col pt-5 first:mt-0 first:pt-0 sm:flex xl:flex-row xl:items-center">
                                    <div
                                        class="mb-2 inline-block sm:mb-0 rtl:sm:ml-5 ltr:sm:mr-5 rtl:sm:text-left ltr:sm:text-right rtl:xl:ml-14 ltr:xl:mr-14 xl:w-60">
                                        <div class="rtl:text-right ltr:text-left">
                                            <div class="flex items-center">
                                                <div class="font-medium">برند</div>
                                                <div
                                                    class="rtl:mr-2.5 ltr:ml-2.5 rounded-md border border-slate-200 bg-slate-100 px-2 py-0.5 text-xs text-slate-500 dark:bg-darkmode-300 dark:text-slate-400">
                                                    ضروری
                                                </div>
                                            </div>
                                            <div class="mt-1.5 text-xs leading-relaxed text-slate-500/80 xl:mt-3">
                                                برند محصول را وارد کنید
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-3 w-full flex-1 xl:mt-0">
                                        <div wire:ignore class="flex flex-col items-center">
                                            <select id="brand" aria-label=".form-select"
                                                    class="tom-select disabled:bg-slate-100 disabled:cursor-not-allowed disabled:dark:bg-darkmode-800/50 [&amp;[readonly]]:bg-slate-100 [&amp;[readonly]]:cursor-not-allowed [&amp;[readonly]]:dark:bg-darkmode-800/50 transition duration-200 ease-in-out w-full border-slate-200 shadow-sm rounded-md px-3 rtl:pl-8 ltr:pr-8 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 group-[.form-inline]:flex-1 text-md py-1 rtl:pr-4 ltr:pl-4 rtl:sm:ml-2 ltr:sm:mr-2">
                                                <option>برند</option>
                                                @foreach($this->allBrands as $key=>$value)
                                                    <option value="{{$key}}">{{$value}}</option>
                                                @endforeach
                                            </select>
                                            @error('brand_id')
                                            <span class="block text-danger my-2">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="mt-5 block flex-col pt-5 first:mt-0 first:pt-0 sm:flex xl:flex-row xl:items-center">
                                    <div
                                        class="mb-2 inline-block sm:mb-0 rtl:sm:ml-5 ltr:sm:mr-5 rtl:sm:text-left ltr:sm:text-right rtl:xl:ml-14 ltr:xl:mr-14 xl:w-60">
                                        <div class="rtl:text-right ltr:text-left">
                                            <div class="flex items-center">
                                                <div class="font-medium">توضیحات محصول</div>
                                                <div
                                                    class="rtl:mr-2.5 ltr:ml-2.5 rounded-md border border-slate-200 bg-slate-100 px-2 py-0.5 text-xs text-slate-500 dark:bg-darkmode-300 dark:text-slate-400">
                                                    ضروری
                                                </div>
                                            </div>
                                            <div class="mt-1.5 text-xs leading-relaxed text-slate-500/80 xl:mt-3">
                                                توضیحات محصول را وارد کنید
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-3 w-full flex-1 xl:mt-0">
                                        <div wire:ignore class="flex flex-col items-center">
                                            <textarea id="editor" wire:model="description"
                                                      class="disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&[readonly]]:bg-slate-100 [&[readonly]]:cursor-not-allowed [&[readonly]]:dark:bg-darkmode-800/50 [&[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 [&[type='file']]:border rtl:file:ml-4 ltr:file:mr-4 file:py-2 file:px-4 rtl:file:rounded-r-md ltr:file:rounded-l-md file:border-0 rtl:file:border-l-[1px] ltr:file:border-r-[1px] file:border-slate-100/10 file:text-sm file:font-semibold file:bg-slate-100 file:text-slate-500/70 hover:file:bg-200 group-[.form-inline]:flex-1 group-[.input-group]:rounded-none rtl:group-[.input-group]:[&:not(:first-child)]:border-r-transparent ltr:group-[.input-group]:[&:not(:first-child)]:border-l-transparent rtl:group-[.input-group]:first:rounded-r ltr:group-[.input-group]:first:rounded-l rtl:group-[.input-group]:last:rounded-l ltr:group-[.input-group]:last:rounded-r group-[.input-group]:z-10 first:rounded-b-none last:-mt-px last:rounded-t-none focus:z-10 rtl:first:md:rounded-l-none ltr:first:md:rounded-r-none rtl:first:md:rounded-br-md ltr:first:md:rounded-bl-md rtl:last:md:-mr-px ltr:last:md:-ml-px last:md:mt-0 rtl:last:md:rounded-r-none ltr:last:md:rounded-l-none rtl:last:md:rounded-tl-md ltr:last:md:rounded-tr-md [&:not(:first-child):not(:last-child)]:-mt-px [&:not(:first-child):not(:last-child)]:rounded-none rtl:[&:not(:first-child):not(:last-child)]:md:-mr-px ltr:[&:not(:first-child):not(:last-child)]:md:-ml-px [&:not(:first-child):not(:last-child)]:md:mt-0"></textarea>
                                            @error('description')
                                            <span class="block text-danger my-2">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="flex border-t border-slate-200/80 px-7 py-5 md:justify-end">
                                <button type="submit" data-tw-merge=""
                                        class="transition duration-200 bg-rose-500 border shadow-sm inline-flex items-center justify-center py-2 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&:hover:not(:disabled)]:bg-opacity-90 [&:hover:not(:disabled)]:border-opacity-90 [&:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed text-primary dark:border-primary [&:hover:not(:disabled)]:bg-primary/10 w-full border-primary/50 px-10 md:w-auto">
                                    <i data-tw-merge="" data-lucide="pocket"
                                       class="rtl:-mr-2 ltr:-ml-2 rtl:ml-2 ltr:mr-2 h-4 w-4 stroke-[1.3]"></i>
                                    ثبت
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@assets
<link rel="stylesheet" href="{{url('panel/css/vendors/tom-select.css')}}">
<script src="{{url('panel/js/vendors/tom-select.js')}}"></script>
<script src="{{url('panel/js/vendors/ckeditor.js')}}"></script>
@endassets

<script>
    new TomSelect("#category", {
        create: true,
        onChange: function (value) {
            Livewire.dispatch('set-category', {id: value});
        }
    });

    new TomSelect("#brand", {
        create: true,
        onChange: function (value) {
            Livewire.dispatch('set-brand', {id: value});
        }
    });

    ClassicEditor
        .create(document.querySelector('#editor'), {
            fontSize: {
                options: [
                    9,
                    11,
                    13,
                    'default',
                    18,
                    20,
                    22
                ]
            },
            fontFamily: {
                options: [
                    'default',
                    'B Koodak',
                ]
            },
            toolbar: {
                items: [
                    'heading',
                    '|',
                    'bold',
                    'italic',
                    'link',
                    '|',
                    'fontSize',
                    'fontFamily',
                    'fontColor',
                    '|',
                    'imageUpload',
                    'blockQuote',
                    'insertTable',
                    'undo',
                    'redo',
                    '|',
                    'bulletedList',
                    'numberedList',
                    'alignment'
                ]
            },
            language: {
                ui: 'fa',
                content: 'fa'
            },
            table: {
                contentToolbar: [
                    'tableColumn',
                    'tableRow',
                    'mergeTableCells'
                ]
            },

        })
        .then(editor => {
            editor.model.document.on('change:data', () => {
                this.set('description', editor.getData(), false);
            })
        })
        .catch(error => {
            console.error(error.stack);
        });

</script>
