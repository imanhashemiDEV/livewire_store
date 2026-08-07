<?php

use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;
use App\Models\Product;
new  #[Layout('admin::layouts.master',['breadcrumb'=>'ایجاد گالری']), Title('ایجاد گالری')]
class extends Component {

    use WithFileUploads;

    public Product $product;

    #[Validate('required|image|mimes:jpg,png')]
    public $image;

    public function saveImage()
    {
        $this->product->addMedia($this->image)->toMediaCollection('products');
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
                        <div class="flex flex-col p-5 box box--stacked">
                            <div class="rounded-[0.6rem] border border-slate-200/80 p-5 dark:border-darkmode-400">
                                <div class="flex items-center border-b border-slate-200/80 pb-5 text-[0.94rem] font-medium dark:border-darkmode-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="chevron-down" class="lucide lucide-chevron-down w-5 h-5 rtl:ml-2 ltr:mr-2 stroke-[1.3]"><path d="m6 9 6 6 6-6"></path></svg>
                                    بارگذاری محصول
                                </div>
                                <div class="mt-5">
                                    <div class="flex-col block pt-5 mt-5 first:mt-0 first:pt-0 sm:flex xl:flex-row xl:items-center">
                                        <div class="inline-block mb-2 sm:mb-0 rtl:sm:ml-5 ltr:sm:mr-5 rtl:sm:text-left ltr:sm:text-right rtl:xl:ml-14 ltr:xl:mr-14 xl:w-60">
                                            <div class="rtl:text-right ltr:text-left">
                                                <div class="flex items-center">
                                                    <div class="font-medium">تصاویر محصول</div>
                                                    <div class="rtl:mr-2.5 ltr:ml-2.5 rounded-md border border-slate-200 bg-slate-100 px-2 py-0.5 text-xs text-slate-500 dark:bg-darkmode-300 dark:text-slate-400">
                                                        ضروری
                                                    </div>
                                                </div>
                                                <div class="mt-1.5 text-xs leading-relaxed text-slate-500/80 xl:mt-3">
                                                    تصاویر با کیفیت بالا می‌توانند به شدت تأثیرگذار باشند
                                                    بر جذابیت محصول شما. تصاویر واضح و روشنی بارگذاری کنید که
                                                    محصول شما را از زوایا و دیدگاه‌های مختلف نشان دهند.
                                                    پرسپکتیو.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex-1 w-full mt-3 xl:mt-0">
                                            <div class="border border-dashed rounded-md border-slate-300/80">
                                                <div class="grid grid-cols-9 gap-5 px-5 pt-5 sm:grid-cols-10">
                                                    @foreach($this->product->getMedia('products') as $media)
                                                        <div class="relative h-24 col-span-3 cursor-pointer image-fit zoom-in md:col-span-2">
                                                            <img class="rounded-lg" src="{{$media->getUrl()}}" alt="تیل وایز - قالب داشبورد مدیریتی">
                                                            <span data-placement="top" class="tooltip cursor-pointer absolute top-0 rtl:left-0 ltr:right-0 w-5 h-5 -mt-2 rtl:-ml-2 ltr:-mr-2 bg-white rounded-full"><span class="flex items-center justify-center w-full h-full text-white border rounded-full border-danger/50 bg-danger/80">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="x" class="lucide lucide-x h-4 w-4 stroke-[1.3]"><path d="M18 6 6 18"></path><path d="m6 6 12 12"></path></svg>
                                                                            </span></span>
                                                        </div>
                                                    @endforeach

                                                </div>
                                            </div>

                                            <div class="flex items-center justify-between">
                                                <div
                                                    class="mt-5 block flex-col pt-5 first:mt-0 first:pt-0 sm:flex xl:flex-row xl:items-center">
                                                    <div
                                                        class="mb-2 inline-block sm:mb-0 rtl:sm:ml-5 ltr:sm:mr-5 rtl:sm:text-left ltr:sm:text-right rtl:xl:ml-14 ltr:xl:mr-14 xl:w-60">
                                                        <div class="rtl:text-right ltr:text-left">
                                                            <div class="flex items-center">
                                                                <div class="font-medium">عکس</div>
                                                            </div>
                                                            <div class="mt-1.5 text-xs leading-relaxed text-slate-500/80 xl:mt-3">
                                                                .عکس خود را اضافه کنید
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mt-3 w-full flex-1 xl:mt-0">
                                                        <div class="flex flex-col items-center md:flex-row">
                                                            <input wire:model="image" id="regular-form-6" type="file"
                                                                   placeholder="ورودی فایل"
                                                                   class="disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&amp;[readonly]]:bg-slate-100 [&amp;[readonly]]:cursor-not-allowed [&amp;[readonly]]:dark:bg-darkmode-800/50 [&amp;[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 [&amp;[type='file']]:border rtl:file:ml-4 ltr:file:mr-4 file:py-2 file:px-4 rtl:file:rounded-r-md ltr:file:rounded-l-md file:border-0 rtl:file:border-l-[1px] ltr:file:border-r-[1px] file:border-slate-100/10 file:text-sm file:font-semibold file:bg-slate-100 file:text-slate-500/70 hover:file:bg-200 group-[.form-inline]:flex-1 group-[.input-group]:rounded-none rtl:group-[.input-group]:[&amp;:not(:first-child)]:border-r-transparent ltr:group-[.input-group]:[&amp;:not(:first-child)]:border-l-transparent rtl:group-[.input-group]:first:rounded-r ltr:group-[.input-group]:first:rounded-l rtl:group-[.input-group]:last:rounded-l ltr:group-[.input-group]:last:rounded-r group-[.input-group]:z-10">
                                                        </div>
                                                        @error('image')
                                                        <span class="block text-danger my-2"> {{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="flex border-t border-slate-200/80 px-7 py-5 md:justify-end">
                                                    <button wire:click="saveImage" type="submit" data-tw-merge=""
                                                            class="transition duration-200 bg-rose-500 border shadow-sm inline-flex items-center justify-center py-2 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&:hover:not(:disabled)]:bg-opacity-90 [&:hover:not(:disabled)]:border-opacity-90 [&:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed text-primary dark:border-primary [&:hover:not(:disabled)]:bg-primary/10 w-full border-primary/50 px-10 md:w-auto">
                                                        <i data-tw-merge="" data-lucide="pocket"
                                                           class="rtl:-mr-2 ltr:-ml-2 rtl:ml-2 ltr:mr-2 h-4 w-4 stroke-[1.3]"></i>
                                                        ثبت
                                                    </button>
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
