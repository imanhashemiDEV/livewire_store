<?php

use App\Models\Cart;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

new class extends Component {
    public $cart_count;

    #[On('refreshCartIcon')]
    #[Computed]
    public function cart()
    {
        $user = auth()->user();
        return Cart::query()->where('user_id', $user->id)->get();
    }
};
?>

<span class="absolute -top-1 -right-1 flex h-4 w-4">
                            <span
                                class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-600 opacity-75"></span>
                            <span
                                class="relative inline-flex rounded-full h-4 w-4 bg-red-500 text-xs pt-1 flex-center text-white">{{ $this->cart ? $this->cart->count() : 0 }}</span>
</span>
