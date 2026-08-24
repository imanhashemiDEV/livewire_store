<?php

use App\Models\Category;
use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component {
    #[Computed]
    public function categories()
    {
        return Category::query()->tree()->get()->toTree();
    }
};
?>

<li class="menu-item megamenu-link">
    <a href="" class="menu-item_link flex items-center justify-center gap-x-1">
        دسته بندی ها
        <svg class="size-4">
            <use href="#chevron"/>
        </svg>
    </a>
    <div
        class="megamenu">
        <!-- RIGHT MENU -->
        <ul class="megamenu_category">
            @foreach($this->categories as $category)
                <li class="megamenu_category-item active">
                    <svg class="w-5 h-5">
                        <use href=""></use>
                    </svg>
                    <a href="">{{$category->title}}</a>
                </li>
            @endforeach

        </ul>

        <div class="megamenu_left">
            <a href="shop.html" class="text-blue-400 flex items-center gap-x-0.5 text-sm mb-4">
                مشاهده همه
                <svg class="size-4 rotate-90">
                    <use href="#chevron"/>
                </svg>
            </a>
            @foreach($this->categories as $category)
            <ul class="megamenu_left-item">
                <div class="megamenu_left-menu">
                    @foreach($category->children as $child)
                        <li>
                            <a href="shop.html">{{$child->title}}</a>
                        </li>
                    @endforeach
                </div>
            </ul>
            @endforeach
        </div>
    </div>
</li>
