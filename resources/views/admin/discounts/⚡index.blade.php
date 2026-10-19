<?php

use App\Models\Discount;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

new #[Layout('admin::layouts.master', ['breadcrumb' => 'لیست کدهای تخفیف']), Title('لیست کدهای تخفیف')]
class extends Component {

    use WithPagination;

    #[Validate('required')]
    public $title, $code, $value;

    public $edit_title, $edit_code, $edit_value;

    public $editDiscount = null;
    public $search;

    public function mount(): void
    {
        if (session()->has('success')) {
            LivewireAlert::text(session('success'))
                ->success()
                ->show();
        }
    }

    public function searchDiscounts(): void
    {
        $this->discounts = Discount::query()
            ->orWhere('title', 'like', '%' . $this->search . '%')
            ->orWhere('code', 'like', '%' . $this->search . '%')
            ->paginate(10);
    }

    public function changeStatus($id)
    {
        $discount = Discount::query()->find($id);
        if ($discount->status === \App\Enums\DiscountStatus::ACTIVE->value) {
            $discount->update([
                'status' => \App\Enums\DiscountStatus::INACTIVE->value
            ]);
        } elseif ($discount->status === \App\Enums\DiscountStatus::INACTIVE->value) {
            $discount->update([
                'status' => \App\Enums\DiscountStatus::ACTIVE->value
            ]);
        }
    }


    public function setEditMode($id, $title, $driver): void
    {
        $this->edit_title = $title;
        $this->edit_driver = $driver;
        $this->editPaymentType = $id;
    }

    public function updateDiscount(): void
    {
        $this->validate([
            'edit_title' => 'required',
            'edit_code' => 'required',
            'edit_value' => 'required',
        ]);

        $discount = Discount::query()->find($this->editDiscount);
        $discount->update([
            'title' => $this->edit_title,
            'code' => $this->edit_code,
            'value' => $this->edit_value,
        ]);

        $this->editDiscount = null;
    }

    #[On('destroy-discount')]
    public function destroyDiscount($discount_id): void
    {
        Discount::destroy($discount_id);
    }

    #[Computed]
    public function discounts()
    {
        return Discount::query()->paginate(10);
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
                            کدهای تخفیف
                        </div>
                    </div>
                    <div class="mt-3.5 flex flex-col gap-8">

                        <div class="box box--stacked flex flex-col">
                            @include('admin.layouts.waiting')
                            <div class="flex flex-col gap-y-2 p-5 sm:flex-row sm:items-center">
                                <div>
                                    <div class="relative">
                                        <i data-tw-merge="" data-lucide="search"
                                           class="absolute inset-y-0 rtl:right-0 ltr:left-0 z-10 my-auto rtl:mr-3 ltr:ml-3 h-4 w-4 stroke-[1.3] text-slate-500"></i>
                                        <input wire:model="search" @keyup.enter="$wire.searchDiscounts" data-tw-merge=""
                                               type="text" placeholder="جستجوی تخفیف ..."
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
                                            عنوان تخفیف
                                        </td>
                                        <td data-tw-merge=""
                                            class="px-5 border-b dark:border-darkmode-300 border-t border-slate-200/60 bg-slate-50 py-4 font-medium text-slate-500">
                                            کد تخفیف
                                        </td>
                                        <td data-tw-merge=""
                                            class="px-5 border-b dark:border-darkmode-300 border-t border-slate-200/60 bg-slate-50 py-4 font-medium text-slate-500">
                                            درصد تخفیف
                                        </td>
                                        <td data-tw-merge=""
                                            class="px-5 border-b dark:border-darkmode-300 border-t border-slate-200/60 bg-slate-50 py-4 text-center font-medium text-slate-500">
                                            وضعیت
                                        </td>
                                        <td data-tw-merge=""
                                            class="px-5 border-b dark:border-darkmode-300 border-t border-slate-200/60 bg-slate-50 py-4 font-medium text-slate-500">
                                            تاریخ ثبت
                                        </td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($this->discounts as $discount)
                                        <tr data-tw-merge="" class="[&_td]:last:border-b-0">
                                            <td data-tw-merge=""
                                                class="px-5 border-b dark:border-darkmode-300 border-dashed py-4 dark:bg-darkmode-600">
                                                <input data-tw-merge="" type="checkbox"
                                                       class="transition-all duration-100 ease-in-out shadow-sm border-slate-200 cursor-pointer rounded focus:ring-4 focus:ring-offset-0 focus:ring-primary focus:ring-opacity-20 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&[type='radio']]:checked:bg-primary [&[type='radio']]:checked:border-primary [&[type='radio']]:checked:border-opacity-10 [&[type='checkbox']]:checked:bg-primary [&[type='checkbox']]:checked:border-primary [&[type='checkbox']]:checked:border-opacity-10 [&:disabled:not(:checked)]:bg-slate-100 [&:disabled:not(:checked)]:cursor-not-allowed [&:disabled:not(:checked)]:dark:bg-darkmode-800/50 [&:disabled:checked]:opacity-70 [&:disabled:checked]:cursor-not-allowed [&:disabled:checked]:dark:bg-darkmode-800/50">
                                            </td>
                                            <td data-tw-merge=""
                                                class="px-5 border-b dark:border-darkmode-300 w-80 border-dashed py-4 dark:bg-darkmode-600">
                                                <div class="flex items-center">
                                                    <div class="rtl:mr-3.5 ltr:ml-3.5">
                                                        <a class="whitespace-nowrap font-medium" href="">
                                                            {{$discount->title}}
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td data-tw-merge=""
                                                class="px-5 border-b dark:border-darkmode-300 border-dashed py-4 dark:bg-darkmode-600">
                                                <a class="whitespace-nowrap font-medium">
                                                    {{$discount->code}}
                                                </a>
                                            </td>
                                            <td data-tw-merge=""
                                                class="px-5 border-b dark:border-darkmode-300 border-dashed py-4 dark:bg-darkmode-600">
                                                <a class="whitespace-nowrap font-medium">
                                                    {{$discount->value}}
                                                </a>
                                            </td>
                                            <td data-tw-merge=""
                                                class="px-5 border-b dark:border-darkmode-300 border-dashed py-4 dark:bg-darkmode-600">
                                                <div class="flex items-center justify-center">
                                                    <i data-tw-merge="" data-lucide="database"
                                                       class="h-3.5 w-3.5 stroke-[1.7]"></i>
                                                    <div wire:click="changeStatus({{$discount->id}})"
                                                         class="rtl:mr-1.5 ltr:ml-1.5 whitespace-nowrap cursor-pointer">
                                                        @if($discount->status === \App\Enums\DiscountStatus::ACTIVE->value)
                                                            <span class=" text-success">فعال</span>
                                                        @elseif($discount->status === \App\Enums\DiscountStatus::INACTIVE->value)
                                                            <span class=" text-danger">منقضی</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td data-tw-merge=""
                                                class="px-5 border-b dark:border-darkmode-300 border-dashed py-4 dark:bg-darkmode-600">
                                                <div class="whitespace-nowrap">
                                                    {{\Hekmatinasser\Verta\Facades\Verta::instance($discount->created_at)->formatJalaliDate()}}
                                                </div>
                                            </td>
                                            <td data-tw-merge=""
                                                class="flex gap-x-2 px-5 border-b dark:border-darkmode-300 border-dashed py-4 dark:bg-darkmode-600">
                                                @if($this->editDiscount==$discount->id)
                                                    <x-fas-save wire:click="updateDiscount"
                                                                class="text-success h-6 w-6 cursor-pointer"/>
                                                @else
                                                    <x-fas-edit
                                                        wire:click="setEditMode('{{$discount->id}}' , '{{$discount->title}}', '{{$discount->code}}', '{{$discount->value}}')"
                                                        class="text-info h-6 w-6 cursor-pointer"/>
                                                @endif
                                                <x-fas-trash
                                                    wire:click="$dispatch('delete-discount',{ discountid: {{$discount->id}} } )"
                                                    class="text-danger h-6 w-6 cursor-pointer m-4"/>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div
                                class="flex-reverse flex flex-col-reverse flex-wrap items-center justify-center gap-y-2 p-5 sm:flex-row">
                                {{$this->discounts->links('admin.layouts.pagination')}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    Livewire.on('delete-discount', (event) => {

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
                Livewire.dispatch('destroy-discount', {discount_id: event.discount_id})
                Swal.fire({
                    text: "حذف با موفقیت انجام شد",
                    icon: "success"
                });
            }
        });

    })
</script>
