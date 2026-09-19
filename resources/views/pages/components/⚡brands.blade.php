<?php

use Livewire\Component;

new class extends Component
{
    #[\Livewire\Attributes\Computed]
    public function brands()
    {
        return \App\Models\Brand::query()->get();
    }
};
?>

<section class="mx-4 lg:container mt-20">
    <!-- SECTION TITLE -->
    <div
        class="flex flex-col gap-y-4 xs:flex-row items-center justify-between w-full text-center xs:text-start">
        <div class="flex items-center gap-x-2 sm:gap-x-4">
                    <span class="size-12 hidden xs:flex rounded-lg bg-white shadow-lg dark:bg-gray-800 flex-center">
                        <svg class="size-7 text-gray-700 dark:text-gray-100">
                            <use href="#squares"></use>
                        </svg>
                    </span>
            <div class="space-y-1 md:space-y-1">
                <h3 class="text-xl md:text-2xl font-MorabbaMedium text-gray-800 dark:text-gray-50">
                    برندها
                </h3>
                <p class="text-sm text-gray-500 dark:text-gray-300">جدیدترین و بروزترین برندها</p>
            </div>
        </div>

    </div>
    <!-- ITEMS -->
    <div class="flex items-center justify-evenly flex-wrap mt-12 child:mb-8 gap-x-8 child:items-center child:flex-col child:duration-300 child:cursor-pointer child:gap-y-1 child:text-gray-800 child:dark:text-gray-300 child:relative">
       @foreach($this->brands as $brand)
            <a href="#" class="group flex">
                <img src="{{url('images/brands/'. $brand->image)}}"
                     class="w-[100px] h-[100px] lg:w-[120px] lg:h-[120px] object-cover group-hover:grayscale group-hover:opacity-90 duration-300"
                     alt="category1" />
                <p class="pt-1 text-sm lg:text-lg line-clamp-1">
                    {{$brand->title}}
                </p>
            </a>
       @endforeach
    </div>
</section>
