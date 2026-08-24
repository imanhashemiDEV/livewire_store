<?php

use Livewire\Component;

new class extends Component
{
    #[\Livewire\Attributes\Computed()]
    public function sliders()
    {
       return \App\Models\Slider::query()->get();
    }
};
?>

<div class="px-3 lg:container group w-full mt-4 lg:mt-10">
    <div dir="rtl" class="swiper header-slider h-52 md:h-96 cursor-pointer">
        <div class="swiper-wrapper">
            @foreach($this->sliders as $slider)
                <a class="swiper-slide">
                    <img src="{{url('images/sliders/'. $slider->photo)}}" class="rounded-xl" alt="">
                </a >
            @endforeach
        </div>
        <div class="swiper-pagination-wrapper">
            <div class="swiper-pagination"></div>
        </div>

        <!-- Swiper Navigation -->
        <div
            class="absolute z-10 bottom-5 opacity-0 invisible group-hover:opacity-100 transition-all duration-300 group-hover:visible right-6 hidden lg:flex items-center gap-x-2 child:flex-center child:w-9 child:h-9 child:cursor-pointer child:bg-white child:dark:bg-gray-800 child:text-gray-700 child:dark:text-gray-200 child:rounded-full child:shadow child-hover:text-blue-600 child-hover:dark:text-blue-500">
            <button class="button-prev">
                <svg class="size-5 -rotate-90">
                    <use href="#chevron" />
                </svg>
            </button>
            <button class="button-next">
                <svg class="size-5 rotate-90">
                    <use href="#chevron" />
                </svg>
            </button>
        </div>

    </div>
</div>
