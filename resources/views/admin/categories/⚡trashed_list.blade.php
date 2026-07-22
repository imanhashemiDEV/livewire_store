<?php

use App\Models\Category;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

new #[Layout('admin::layouts.master', ['breadcrumb' => 'لیست دسته بندی ها']), Title('لیست دسته بندی ها')]
class extends Component {


    public function mount(): void
    {
        if (session()->has('success')) {
            LivewireAlert::text(session('success'))
                ->success()
                ->show();
        }
    }



    #[On('destroy-category')]
    public function destroyCategory($category_id)
    {
        Category::query()->withTrashed()->find($category_id)->forceDelete();
    }

    #[On('rollback-category')]
    public function roolbackCategory($category_id)
    {
        Category::query()->withTrashed()->find($category_id)->restore();
    }


    #[Computed]
    public function categories()
    {
        return Category::query()->tree()->onlyTrashed()->get()->toTree();
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
                            دسته بندی های حذف شده
                        </div>
                        <div class="flex flex-col gap-x-3 gap-y-2 sm:flex-row rtl:md:mr-auto ltr:md:ml-auto">
                            <a href="{{route('admin.categories.list')}}" data-tw-merge=""
                               class="transition duration-200 border shadow-sm inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&:hover:not(:disabled)]:bg-opacity-90 [&:hover:not(:disabled)]:border-opacity-90 [&:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary group-[.mode--light]:!border-transparent group-[.mode--light]:!bg-white/[0.12] group-[.mode--light]:!text-slate-200">
                                <i data-tw-merge="" data-lucide="pen-line"
                                   class="rtl:ml-2 ltr:mr-2 h-4 w-4 stroke-[1.3]"></i>
                                لیست دسته بندی ها
                            </a>
                        </div>
                    </div>
                    <div class="mt-3.5 flex flex-col gap-8">
                        <div class="box box--stacked flex flex-col">

                            @include('admin.layouts.waiting')

                            <div data-tw-merge class="accordion m-4 p-4">
                                @foreach($this->categories as $category)
                                    <div data-tw-merge
                                         class="accordion-item py-4 first:-mt-4 last:-mb-4 [&amp;:not(:last-child)]:border-b [&amp;:not(:last-child)]:border-slate-200/60 [&amp;:not(:last-child)]:dark:border-darkmode-400">
                                        <div class="accordion-header flex" id="faq-accordion-1">
                                                <button
                                                    data-tw-merge
                                                    data-tw-toggle="collapse"
                                                    data-tw-target="#faq-accordion-1-collapse"
                                                    type="button"
                                                    aria-expanded="true"
                                                    aria-controls="faq-accordion-1-collapse"
                                                    class="accordion-button outline-none py-4 -my-4 font-medium w-full rtl:text-right ltr:text-left dark:text-slate-400 [&amp;:not(.collapsed)]:text-primary [&amp;:not(.collapsed)]:dark:text-slate-300"
                                                >{{$category->title}}</button>
                                            <x-fas-trash
                                                wire:click="$dispatch('delete-category',{ category_id: {{$category->id}} } )"
                                                class="text-danger h-6 w-6 cursor-pointer m-4"/>
                                            <x-eos-restore-page-o
                                                wire:click="$dispatch('restore-category',{ category_id: {{$category->id}} } )"
                                                class="text-info h-6 w-6 cursor-pointer m-4"/>

                                        </div>
                                        <div
                                            id="faq-accordion-1-collapse"
                                            aria-labelledby="faq-accordion-1"
                                            class="accordion-collapse collapse mt-3 text-slate-700 leading-relaxed dark:text-slate-400 [&amp;.collapse:not(.show)]:hidden [&amp;.collapse.show]:visible show"
                                        >
                                            <div
                                                data-tw-merge
                                                class="accordion-body leading-relaxed text-slate-600 dark:text-slate-500 leading-relaxed text-slate-600 dark:text-slate-500"
                                            >
                                                @foreach($category->children as $child)
                                                    <div class="w-full flex items-center justify-between mt-2">
                                                        <span class="flex-1">{{$child->title}}</span>
                                                        <x-fas-trash
                                                            wire:click="$dispatch('delete-category',{ category_id: {{$child->id}} } )"
                                                            class="text-danger h-6 w-6 cursor-pointer m-4"/>
                                                        <x-eos-restore-page-o
                                                            wire:click="$dispatch('restore-category',{ category_id: {{$child->id}} } )"
                                                            class="text-info h-6 w-6 cursor-pointer m-4"/>

                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@assets
<link rel="stylesheet" href="{{url('panel/css/vendors/tom-select.css')}}">
<script src="{{url('panel/js/vendors/tom-select.js')}}"></script>
@endassets

<script>

    Livewire.on('delete-category', (event) => {

        Swal.fire({
            title: "آیا از حذف دائم مطمئن هستید؟",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "بله",
            cancelButtonText: "خیر",
        }).then((result) => {
            if (result.isConfirmed) {
                //console.log(event)
                Livewire.dispatch('destroy-category', {category_id: event.category_id})
                Swal.fire({
                    text: "حذف با موفقیت انجام شد",
                    icon: "success"
                });
            }
        });

    })

    Livewire.on('restore-category', (event) => {

        Swal.fire({
            title: "آیا از بازگرداندن مطمئن هستید؟",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "بله",
            cancelButtonText: "خیر",
        }).then((result) => {
            if (result.isConfirmed) {
                //console.log(event)
                Livewire.dispatch('rollback-category', {category_id: event.category_id})
                Swal.fire({
                    text: "بازگرداندن با موفقیت انجام شد",
                    icon: "success"
                });
            }
        });

    })
</script>
