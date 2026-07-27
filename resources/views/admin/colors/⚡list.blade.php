<?php

use App\Models\Color;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

new #[Layout('admin::layouts.master', ['breadcrumb' => 'لیست  رنگ ها']), Title('لیست رنگ ها')]
class extends Component {


    #[Validate('required')]
    public $title,$code;
    public $edit_title,$edit_code;

    public $editColor = null;

    public function mount(): void
    {
        if (session()->has('success')) {
            LivewireAlert::text(session('success'))
                ->success()
                ->show();
        }
    }

    public function createColor(): void
    {
        $this->validate();

        Color::query()->create([
            'title' => $this->title,
            'code'=>$this->code,
        ]);

        session()->flash('success', 'رنگ  با موفقیت ایجاد شد');
        $this->reset('title','code');
    }

    public function setEditMode($id, $title, $code)
    {
        $this->edit_title = $title;
        $this->edit_code = $code;
        $this->editColor = $id;
    }

    public function updateColor()
    {
        $this->validate([
            'edit_title' => 'required',
            'edit_code' => 'required',
        ]);

        $color = Color::query()->find($this->editColor);
        $color->update([
            'title' => $this->edit_title,
            'code' => $this->edit_code,
        ]);

        $this->editColor = null;
    }


    #[\Livewire\Attributes\On('destroy-color')]
    public function destroyColor($color_id)
    {
        Color::destroy($color_id);
    }


    #[Computed]
    public function colors()
    {
        return Color::query()->paginate(10);
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
                            دسته بندی ها
                        </div>
                        <div class="flex flex-col gap-x-3 gap-y-2 sm:flex-row rtl:md:mr-auto ltr:md:ml-auto">
                            <a href="{{route('admin.categories.trashed_list')}}" data-tw-merge=""
                               class="transition duration-200 border shadow-sm inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&:hover:not(:disabled)]:bg-opacity-90 [&:hover:not(:disabled)]:border-opacity-90 [&:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary group-[.mode--light]:!border-transparent group-[.mode--light]:!bg-white/[0.12] group-[.mode--light]:!text-slate-200">
                                <i data-tw-merge="" data-lucide="pen-line"
                                   class="rtl:ml-2 ltr:mr-2 h-4 w-4 stroke-[1.3]"></i>
                                دسته بندی های حذف شده
                            </a>
                        </div>
                    </div>
                    <div class="mt-3.5 flex flex-col gap-8">
                        <div class="box box--stacked flex flex-col">

                            @include('admin.layouts.waiting')
                            <form wire:submit="createColor" class="box box--stacked flex flex-col m-2">
                                <div class="p-7 flex md:flex-row flex-col gap-4 w-full justify-around items-center">
                                    <div class=" block flex-col pt-5 first:mt-0 first:pt-0 sm:flex xl:flex-row xl:items-center">
                                        <div class="mb-2 inline-block sm:mb-0 rtl:sm:ml-5 ltr:sm:mr-5 rtl:sm:text-left ltr:sm:text-right rtl:xl:ml-14 ltr:xl:mr-14 xl:w-60">
                                            <div class="rtl:text-right ltr:text-left">
                                                <div class="flex items-center">
                                                    <div class="font-medium">عنوان دسته بندی</div>
                                                    <div
                                                        class="rtl:mr-2.5 ltr:ml-2.5 rounded-md border border-slate-200 bg-slate-100 px-2 py-0.5 text-xs text-slate-500 dark:bg-darkmode-300 dark:text-slate-400">
                                                        ضروری
                                                    </div>
                                                </div>
                                                <div
                                                    class="mt-1.5 text-xs leading-relaxed text-slate-500/80 xl:mt-3">
                                                    عنوان دسته بندی را وارد کنید
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-3 w-full flex gap-2 xl:mt-0">
                                            <div class="flex flex-col flex-1 items-center">
                                                <input wire:model="title" data-tw-merge="" type="text"
                                                       class="disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent
                                                   [&[readonly]]:bg-slate-100 [&[readonly]]:cursor-not-allowed
                                                    [&[readonly]]:dark:bg-darkmode-800/50 [&[readonly]]:dark:border-transparent
                                                    transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm
                                                    rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20
                                                    focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent
                                                    dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80
                                                    [&[type='file']]:border rtl:file:ml-4 ltr:file:mr-4 file:py-2 file:px-4 rtl:file:rounded-r-md
                                                    ltr:file:rounded-l-md file:border-0 rtl:file:border-l-[1px] ltr:file:border-r-[1px]
                                                    file:border-slate-100/10 file:text-sm file:font-semibold file:bg-slate-100
                                                    file:text-slate-500/70 hover:file:bg-200 group-[.form-inline]:flex-1 group-[.input-group]:rounded-none
                                                    rtl:group-[.input-group]:[&:not(:first-child)]:border-r-transparent
                                                    ltr:group-[.input-group]:[&:not(:first-child)]:border-l-transparent rtl:group-[.input-group]:first:rounded-r
                                                    ltr:group-[.input-group]:first:rounded-l rtl:group-[.input-group]:last:rounded-l
                                                    ltr:group-[.input-group]:last:rounded-r group-[.input-group]:z-10 first:rounded-b-none last:-mt-px
                                                    last:rounded-t-none focus:z-10 rtl:first:md:rounded-l-none ltr:first:md:rounded-r-none rtl:first:md:rounded-br-md
                                                    ltr:first:md:rounded-bl-md rtl:last:md:-mr-px ltr:last:md:-ml-px last:md:mt-0 rtl:last:md:rounded-r-none
                                                    ltr:last:md:rounded-l-none rtl:last:md:rounded-tl-md ltr:last:md:rounded-tr-md
                                                    [&:not(:first-child):not(:last-child)]:-mt-px [&:not(:first-child):not(:last-child)]:rounded-none
                                                    rtl:[&:not(:first-child):not(:last-child)]:md:-mr-px ltr:[&:not(:first-child):not(:last-child)]:md:-ml-px
                                                    [&:not(:first-child):not(:last-child)]:md:mt-0">
                                                @error('title')
                                                <span class="block text-danger my-2">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div wire:ignore  class=" flex flex-1 flex-col items-center">
                                        <select aria-label=".form-select" class="tom-select disabled:bg-slate-100 disabled:cursor-not-allowed disabled:dark:bg-darkmode-800/50 [&amp;[readonly]]:bg-slate-100 [&amp;[readonly]]:cursor-not-allowed [&amp;[readonly]]:dark:bg-darkmode-800/50 transition duration-200 ease-in-out w-full border-slate-200 shadow-sm rounded-md px-3 rtl:pl-8 ltr:pr-8 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 group-[.form-inline]:flex-1 text-md py-1 rtl:pr-4 ltr:pl-4 rtl:sm:ml-2 ltr:sm:mr-2">
                                            <option>دسته بندی اصلی</option>
                                            @foreach($this->allCategories as $key=>$value)
                                                <option value="{{$key}}">{{$value}}</option>
                                            @endforeach
                                        </select>
                                        @error('parent_id')
                                        <span class="block text-danger my-2">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    {{--                                    <div class=" flex flex-1 flex-col items-center">--}}
                                    {{--                                        <select wire:model="parent_id" aria-label=".form-select" class="tom-select disabled:bg-slate-100 disabled:cursor-not-allowed disabled:dark:bg-darkmode-800/50 [&amp;[readonly]]:bg-slate-100 [&amp;[readonly]]:cursor-not-allowed [&amp;[readonly]]:dark:bg-darkmode-800/50 transition duration-200 ease-in-out w-full border-slate-200 shadow-sm rounded-md px-3 rtl:pl-8 ltr:pr-8 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 group-[.form-inline]:flex-1 text-md py-1 rtl:pr-4 ltr:pl-4 rtl:sm:ml-2 ltr:sm:mr-2">--}}
                                    {{--                                            <option>دسته بندی اصلی</option>--}}
                                    {{--                                            @foreach($this->allCategories as $key=>$value)--}}
                                    {{--                                                <option value="{{$key}}">{{$value}}</option>--}}
                                    {{--                                            @endforeach--}}
                                    {{--                                        </select>--}}
                                    {{--                                        @error('parent_id')--}}
                                    {{--                                        <span class="block text-danger my-2">{{ $message }}</span>--}}
                                    {{--                                        @enderror--}}
                                    {{--                                    </div>--}}

                                    <button type="submit" data-tw-merge=""
                                            class="transition duration-200 bg-rose-500 border shadow-sm inline-flex items-center justify-center py-2 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&:hover:not(:disabled)]:bg-opacity-90 [&:hover:not(:disabled)]:border-opacity-90 [&:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed text-primary dark:border-primary [&:hover:not(:disabled)]:bg-primary/10 border-primary/50 px-10 md:w-auto">
                                        <i data-tw-merge="" data-lucide="pocket"
                                           class="rtl:-mr-2 ltr:-ml-2 rtl:ml-2 ltr:mr-2 h-4 w-4 stroke-[1.3]"></i>
                                        ثبت
                                    </button>
                                </div>
                            </form>


                            <div data-tw-merge class="accordion m-4 p-4">
                                @foreach($this->categories as $Color)
                                    <div data-tw-merge class="accordion-item py-4 first:-mt-4 last:-mb-4 [&amp;:not(:last-child)]:border-b [&amp;:not(:last-child)]:border-slate-200/60 [&amp;:not(:last-child)]:dark:border-darkmode-400">
                                        <div class="accordion-header flex" id="faq-accordion-1">
                                            @if($this->editColor== $Color->id)
                                                <input wire:model="edit_title" data-tw-merge="" type="text"
                                                       class="disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&[readonly]]:bg-slate-100 [&[readonly]]:cursor-not-allowed [&[readonly]]:dark:bg-darkmode-800/50 [&[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 [&[type='file']]:border rtl:file:ml-4 ltr:file:mr-4 file:py-2 file:px-4 rtl:file:rounded-r-md ltr:file:rounded-l-md file:border-0 rtl:file:border-l-[1px] ltr:file:border-r-[1px] file:border-slate-100/10 file:text-sm file:font-semibold file:bg-slate-100 file:text-slate-500/70 hover:file:bg-200 group-[.form-inline]:flex-1 group-[.input-group]:rounded-none rtl:group-[.input-group]:[&:not(:first-child)]:border-r-transparent ltr:group-[.input-group]:[&:not(:first-child)]:border-l-transparent rtl:group-[.input-group]:first:rounded-r ltr:group-[.input-group]:first:rounded-l rtl:group-[.input-group]:last:rounded-l ltr:group-[.input-group]:last:rounded-r group-[.input-group]:z-10 first:rounded-b-none last:-mt-px last:rounded-t-none focus:z-10 rtl:first:md:rounded-l-none ltr:first:md:rounded-r-none rtl:first:md:rounded-br-md ltr:first:md:rounded-bl-md rtl:last:md:-mr-px ltr:last:md:-ml-px last:md:mt-0 rtl:last:md:rounded-r-none ltr:last:md:rounded-l-none rtl:last:md:rounded-tl-md ltr:last:md:rounded-tr-md [&:not(:first-child):not(:last-child)]:-mt-px [&:not(:first-child):not(:last-child)]:rounded-none rtl:[&:not(:first-child):not(:last-child)]:md:-mr-px ltr:[&:not(:first-child):not(:last-child)]:md:-ml-px [&:not(:first-child):not(:last-child)]:md:mt-0">
                                                @error('edit_title')
                                                <span class="block text-danger my-2">{{ $message }}</span>
                                                @enderror
                                            @else
                                                <button
                                                    data-tw-merge
                                                    data-tw-toggle="collapse"
                                                    data-tw-target="#faq-accordion-1-collapse"
                                                    type="button"
                                                    aria-expanded="true"
                                                    aria-controls="faq-accordion-1-collapse"
                                                    class="accordion-button outline-none py-4 -my-4 font-medium w-full rtl:text-right ltr:text-left dark:text-slate-400 [&amp;:not(.collapsed)]:text-primary [&amp;:not(.collapsed)]:dark:text-slate-300"
                                                >{{$Color->title}}
                                                </button>
                                            @endif
                                            @if($this->editColor==$Color->id)
                                                <x-fas-save  wire:click="updateColor" class="text-success h-6 w-6 cursor-pointer"/>
                                            @else
                                                <x-fas-edit wire:click="setEditMode('{{$Color->id}}' , '{{$Color->title}}')" class="text-info h-6 w-6 cursor-pointer"/>
                                            @endif
                                            <x-fas-trash wire:click="$dispatch('delete-Color',{ Color_id: {{$Color->id}} } )"  class="text-danger h-6 w-6 cursor-pointer m-4"/>
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
                                                @foreach($Color->children as $child)
                                                    <div class="w-full flex items-center justify-between mt-2">
                                                        @if($this->editColor== $child->id)
                                                            <input wire:model="edit_title" data-tw-merge="" type="text"
                                                                   class="disabled:bg-slate-100 disabled:cursor-not-allowed dark:disabled:bg-darkmode-800/50 dark:disabled:border-transparent [&[readonly]]:bg-slate-100 [&[readonly]]:cursor-not-allowed [&[readonly]]:dark:bg-darkmode-800/50 [&[readonly]]:dark:border-transparent transition duration-200 ease-in-out w-full text-sm border-slate-200 shadow-sm rounded-md placeholder:text-slate-400/90 focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus:border-primary focus:border-opacity-40 dark:bg-darkmode-800 dark:border-transparent dark:focus:ring-slate-700 dark:focus:ring-opacity-50 dark:placeholder:text-slate-500/80 [&[type='file']]:border rtl:file:ml-4 ltr:file:mr-4 file:py-2 file:px-4 rtl:file:rounded-r-md ltr:file:rounded-l-md file:border-0 rtl:file:border-l-[1px] ltr:file:border-r-[1px] file:border-slate-100/10 file:text-sm file:font-semibold file:bg-slate-100 file:text-slate-500/70 hover:file:bg-200 group-[.form-inline]:flex-1 group-[.input-group]:rounded-none rtl:group-[.input-group]:[&:not(:first-child)]:border-r-transparent ltr:group-[.input-group]:[&:not(:first-child)]:border-l-transparent rtl:group-[.input-group]:first:rounded-r ltr:group-[.input-group]:first:rounded-l rtl:group-[.input-group]:last:rounded-l ltr:group-[.input-group]:last:rounded-r group-[.input-group]:z-10 first:rounded-b-none last:-mt-px last:rounded-t-none focus:z-10 rtl:first:md:rounded-l-none ltr:first:md:rounded-r-none rtl:first:md:rounded-br-md ltr:first:md:rounded-bl-md rtl:last:md:-mr-px ltr:last:md:-ml-px last:md:mt-0 rtl:last:md:rounded-r-none ltr:last:md:rounded-l-none rtl:last:md:rounded-tl-md ltr:last:md:rounded-tr-md [&:not(:first-child):not(:last-child)]:-mt-px [&:not(:first-child):not(:last-child)]:rounded-none rtl:[&:not(:first-child):not(:last-child)]:md:-mr-px ltr:[&:not(:first-child):not(:last-child)]:md:-ml-px [&:not(:first-child):not(:last-child)]:md:mt-0">
                                                            @error('edit_title')
                                                            <span class="block text-danger my-2">{{ $message }}</span>
                                                            @enderror
                                                        @else
                                                            <span class="flex-1">{{$child->title}}</span>
                                                        @endif

                                                        @if($this->editColor==$child->id)
                                                            <x-fas-save  wire:click="updateColor" class="text-success h-6 w-6 cursor-pointer m-4"/>
                                                        @else
                                                            <x-fas-edit wire:click="setEditMode('{{$child->id}}' , '{{$child->title}}')" class="text-info h-6 w-6 cursor-pointer"/>
                                                        @endif
                                                        <x-fas-trash wire:click="$dispatch('delete-Color',{ Color_id: {{$child->id}} } )" class="text-danger h-6 w-6 cursor-pointer m-4"/>
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
    new TomSelect(".tom-select",{
        create: true,
        onChange : function (value) {
            Livewire.dispatch('set-parent',{id:value});
        }
    });

    Livewire.on('delete-Color',(event)=>{

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
                Livewire.dispatch('destroy-Color', { Color_id: event.Color_id })
                Swal.fire({
                    text: "حذف با موفقیت انجام شد",
                    icon: "success"
                });
            }
        });

    })
</script>
