<?php

use App\Models\Cart;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

new class extends Component {
    public int $totalPrice = 0;
    public int $totalDiscount = 0;
    public int $finalPrice = 0;

    public function mount(): void
    {
        $this->calculateCart();
    }

    public function calculateCart(): void
    {
        $this->totalPrice = 0;
        $this->totalDiscount = 0;
        $this->finalPrice = 0;
        if($this->cart){
            foreach ($this->cart as $item){
                $this->totalPrice += $item->product_variant->price * $item->count;
                if($item->product_variant->discount > 0){
                    $this->totalDiscount += ($item->product_variant->price - $item->product_variant->discount_price) * $item->count;
                }
            }

            $this->finalPrice = $this->totalPrice - $this->totalDiscount;
        }
    }

    public function increaseProduct(int $cartId, $count): void
    {
        $cartItem = Cart::query()->find($cartId);
        if ($cartItem && $cartItem->count < $cartItem->product_variant->max_sell) {
            $cartItem->update([
                'count' => (int)++$count
            ]);
            $this->totalPrice += $cartItem->product_variant->price;
            $this->totalDiscount += $cartItem->product_variant->price - $cartItem->product_variant->discount_price;
            $this->finalPrice = $this->totalPrice - $this->totalDiscount;
        }

        $this->dispatch('refreshMainCart');
        $this->calculateCart();
    }

    public function decreaseProduct(int $cartId, $count): void
    {
        $cartItem = Cart::query()->find($cartId);
        if ($cartItem && $cartItem->count > 1) {
            $cartItem->update([
                'count' => (int)--$count
            ]);
            $this->totalPrice -= $cartItem->product_variant->price;
            $this->totalDiscount -= $cartItem->product_variant->price - $cartItem->product_variant->discount_price;
            $this->finalPrice = $this->totalPrice - $this->totalDiscount;
        } elseif ($cartItem && $cartItem->count == 1) {
            $this->totalPrice -= $cartItem->product_variant->price;
            $this->totalDiscount -= $cartItem->product_variant->price - $cartItem->product_variant->discount_price;
            $this->finalPrice = $this->totalPrice - $this->totalDiscount;
            $cartItem->delete();
            $this->dispatch('refreshCartIcon');
        }

        $this->dispatch('refreshMainCart');
        $this->calculateCart();
    }

    public function deleteCartItem(int $cartId, $count): void
    {
        $cartItem = Cart::query()->find($cartId);
        $this->totalPrice -= $cartItem->product_variant->price * $count;
        $this->totalDiscount -= ($cartItem->product_variant->price - $cartItem->product_variant->discount_price) * $count;
        $this->finalPrice = $this->totalPrice - $this->totalDiscount;
        $cartItem->delete();

        $this->dispatch('refreshMainCart');
        $this->dispatch('refreshCartIcon');
        $this->calculateCart();
    }

    #[On('refreshSideCart')]
    public function refreshCart(): void
    {
        $this->calculateCart();
    }

    #[Computed]
    public function cart()
    {
        $user = auth()->user();
        if ($user) {

            return Cart::query()->where('user_id', $user->id)->get();

        } else {
            $this->redirectRoute('login');
        }
    }
};
?>

<div class="cart" wire:ignore.self>
    <!-- HEADER -->
    <div
        class="flex items-center justify-between pb-2 border-b-2 border-gray-200 dark:border-gray-600 text-gray-800 dark:text-gray-300">
        <h2 class="font-DanaMedium text-lg">سبد خرید <span class="text-sm text-gray-400 font-Dana">
                                    (قیمت کالاها({{ $this->cart ? $this->cart->count() : 0 }}
                                    مورد)</span></h2>
        <svg class="size-5 cursor-pointer close-cart mb-.5">
            <use href="#x-mark"/>
        </svg>
    </div>
    <!-- MAIN -->
    <div class="flex flex-col divide-y-2 divide-gray-200 dark:divide-gray-600 my-4">
        @if($this->cart)
            @foreach($this->cart as $item)
                <div class="grid grid-cols-12 gap-x-2 w-full py-4 cursor-pointer">
                    <!-- img -->
                    <div class="col-span-4 w-24 h-20">
                        <img src="{{$item->product->getMedia('products')->first()->getUrl()}}" class="rounded-lg"
                             alt="product">
                    </div>
                    <!-- detail -->
                    <div class="col-span-8 flex flex-col justify-between">
                        <h2 class="font-DanaMedium line-clamp-2">
                            {{$item->product->title}}
                        </h2>
                        <div class="flex items-center justify-between gap-x-2 mt-2">
                            <button
                                class="w-20 flex items-center justify-between gap-x-1 rounded-lg border border-gray-200 dark:border-white/20 py-1 px-2">
                                <svg wire:click="increaseProduct('{{ $item->id }}' , '{{$item->count}}')"
                                     class="size-4  text-green-600">
                                    <use href="#plus"></use>
                                </svg>
                                <input type="number" name="customInput" id="customInput-{{ $item->id }}" min="1"
                                       max="{{ $item->product_variant->max_sell }}"
                                       value="{{ $item->count }}" class="custom-input w-4 mr-2 text-sm">
                                <svg wire:click="decreaseProduct('{{ $item->id }}' , '{{$item->count}}')"
                                     class="size-4  text-red-500">
                                    <use href="#minus"></use>
                                </svg>
                            </button>
                            <div class="flex flex-col items-end">
                                @if($item->product_variant->discount > 0)
                                    <p class="text-sm text-gray-400 line-through font-Dana">{{$item->product_variant->price}}
                                        <span class="text-xs">تومان</span>
                                    </p>
                                    <p class="text-sm text-red-500 font-Dana">
                                        {{ number_format($item->product_variant->price - $item->product_variant->discount_price) }}
                                        <span class="text-xs">تومان تخفیف</span>
                                    </p>
                                    <p class="text-lg text-blue-500 dark:text-blue-400 font-DanaMedium">{{$item->product_variant->discount_price}}
                                        <span class="font-Dana text-sm">تومان</span>
                                    </p>
                                @else
                                    <p class="text-lg text-blue-500 dark:text-blue-400 font-DanaMedium">{{$item->product_variant->price}}
                                        <span class="font-Dana text-sm">تومان</span>
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
    <!-- FOOTER -->
    <div
        class="w-[90%] fixed bottom-2 flex items-center justify-between border-t-2 border-gray-200 dark:border-gray-600 pt-4">
        <div>
            @if($this->totalDiscount > 0)
                <p class="text-gray-500 dark:text-gray-300 text-sm">مبلغ کل :</p>
                <p class="text-sm text-gray-400 line-through font-Dana">{{ number_format($this->totalPrice) }}
                    <span class="font-Dana text-xs">تومان</span>
                </p>
                <p class="text-gray-500 dark:text-gray-300 text-sm">تخفیف :</p>
                <p class="text-sm text-red-500 font-Dana">{{ number_format($this->totalDiscount) }}
                    <span class="font-Dana text-xs">تومان</span>
                </p>
            @endif
            <p class="text-gray-500 dark:text-gray-300 text-sm">مبلغ قابل پرداخت :</p>
            <p class="text-lg text-blue-500 dark:text-blue-400 font-DanaDemiBold">{{ number_format($this->finalPrice) }}
                <span class="font-Dana text-sm">تومان</span>
            </p>
        </div>
        <a href="#"
           class="py-2 px-4 bg-blue-600 flex-center hover:bg-blue-700 transition-all rounded-lg text-gray-200">
            ثبت سفارش
        </a>
    </div>
</div>
