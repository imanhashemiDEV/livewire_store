<?php

use App\Enums\DiscountStatus;
use App\Models\Cart;
use App\Models\Discount;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\PaymentType;
use App\Models\SendType;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Illuminate\Support\Facades\Log;
use \Illuminate\Support\Facades\DB;

new  #[Layout('pages.layouts.master'), Title('سفارش')]
class extends Component {

    public int $totalPrice = 0;
    public int $totalDiscount = 0;
    public int $total_discount_price = 0;

    //--- Form variables ---//
    public string $receiver_name = '';
    public string $receiver_family = '';
    public string $province = '';
    public string $city = '';
    public string $address = '';
    public string $phone = '';
    public string $postal_code = '';
    public string $description = '';
    public string $discount_code = '';

    public int $send_type_id = 1;
    public int $payment_type_id = 1;

    public $send_types;
    public $payment_types;

    protected function rules(): array
    {
        return [
            'receiver_name' => ['required', 'string', 'max:255'],
            'receiver_family' => ['required', 'string', 'max:255'],
            'province' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:500'],
            'phone' => ['required', 'string', 'max:20'],
            'postal_code' => ['required', 'string', 'max:20'],
            'description' => ['nullable', 'string', 'max:1000'],
            'discount_code' => ['nullable', 'string', 'max:255'],
            'send_type_id' => ['required', 'integer', 'exists:send_types,id'],
            'payment_type_id' => ['required', 'integer', 'exists:payment_types,id'],
        ];
    }


    public function mount(): void
    {
        $this->calculateCart();

        $this->send_type_id  = SendType::query()->first()?->id;
        $this->payment_type_id = PaymentType::query()->first()?->id;

        $this->send_types = SendType::query()->get();
        $this->payment_types = PaymentType::query()->get();
    }

    public function calculateCart(): void
    {
        $this->totalPrice = 0;
        $this->totalDiscount = 0;
        $this->finalPrice = 0;
        if ($this->cart) {
            foreach ($this->cart as $item) {
                $this->totalPrice += $item->product_variant->price * $item->count;
                if ($item->product_variant->discount > 0) {
                    $this->totalDiscount += ($item->product_variant->price - $item->product_variant->discount_price) * $item->count;
                }
            }

            $this->finalPrice = $this->totalPrice - $this->totalDiscount;
        }
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

    public function payment()
    {
        $this->validate();

        DB::beginTransaction();
        try {
            $order = Order::query()->create([
                'user_id' => auth()->user->id,
                'discount_id' => null,
                'send_type_id' => $this->send_type_id,
                'payment_type_id' => $this->payment_type_id,
                'order_code' => generateRandomInteger(6),
                'receiver_name' => $this->receiver_name,
                'receiver_family' => $this->receiver_family,
                'province' => $this->province,
                'city' => $this->city,
                'address' => $this->address,
                'phone' => $this->phone,
                'postal_code' => $this->postal_code,
                'description' => $this->description,
                'total_price' => $this->totalPrice,
                'total_discount' => $this->totalDiscount,
                'total_discount_price' => $this->total_discount_price,
            ]);

            foreach ($this->carts as $cart) {
                OrderDetail::query()->create([
                    'seller_id' => $cart->product_variant->seller_id,
                    'order_id' => $order,
                    'price' => $cart->product_variant->price,
                    'discount' => $cart->product_variant->discount,
                    'discount_price' => $cart->product_variant->discount_price,
                    'count' => $cart->count,
                    'product_id' => $cart->product_id,
                    'color_id' => $cart->product_variant->color_id,
                    'guaranty_id' => $cart->product_variant->guaranty_id
                ]);
            }

            DB::commit();

        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            DB::rollBack();
        }
    }

    public function setSendType($id): void
    {
        $this->send_type_id = $id;
    }

    public function setPaymentType($id): void
    {
        $this->payment_type_id = $id;
    }
};
?>

<main class="container">
    <!-- Breadcrumb -->
    <nav class="flex mt-8" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
            <li class="inline-flex items-center">
                <a href="#"
                   class="inline-flex items-center text-sm gap-x-1  text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                    <svg class="size-4 mb-0.5">
                        <use href="#home"/>
                    </svg>
                    صفحه اصلی
                </a>
            </li>
            <li class="inline-flex items-center">
                <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="m1 9 4-4-4-4"/>
                </svg>
                <a href="#"
                   class="inline-flex items-center text-sm gap-x-1  text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                    سبد خرید
                </a>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="m1 9 4-4-4-4"/>
                    </svg>
                    <span class="ms-1 text-sm  text-gray-500 md:ms-2 dark:text-gray-400">
                            آدرس و زمان ارسال
                        </span>
                </div>
            </li>
        </ol>
    </nav>

    <section
        class="flex flex-col lg:flex-row justify-between items-start gap-4 mt-5">
        <!-- Form -->
        <div
            class="w-full lg:w-3/4 flex flex-col gap-y-4 child:rounded-lg child:bg-white child:dark:bg-gray-800 child:shadow child:p-4">
            <div class="w-full flex flex-col">
                <span class="flex items-center gap-x-2">
                    <a href="#">
                        <svg class="size-5">
                            <use href="#arrow-right"></use>
                        </svg>
                    </a>
                    <p class="font-DanaDemiBold text-lg">آدرس و زمان ارسال</p>
                </span>
                <p class="text-gray-500 dark:text-gray-400 font-DanaMedium mt-4 mb-8 text-sm lg:text-base">
                    لطفا اطلاعات خود را به درستی وارد نمایید
                </p>
                <div class="flex flex-col lg:flex-row items-start ">
                    <form class="w-full grid grid-cols-12 gap-4">
                        <input type="text" wire:model="receiver_name" placeholder="نام*"
                               class="block w-full py-1.5 px-3 text-base  dark:outline-none outline-1 -outline-offset-1 placeholder:text-gray-400   transition-all col-span-6
                            text-gray-800 dark:text-gray-100 dark:bg-gray-900 bg-slate-100 border border-transparent hover:border-slate-200 appearance-none rounded-md outline-none focus:bg-white focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100 dark:focus:ring-blue-400 h-11">
                        <input type="text" wire:model="receiver_family" placeholder="نام خانوادگی*"
                               class="block w-full py-1.5 px-3 text-base  dark:outline-none outline-1 -outline-offset-1 placeholder:text-gray-400   transition-all col-span-6
                            text-gray-800 dark:text-gray-100 dark:bg-gray-900 bg-slate-100 border border-transparent hover:border-slate-200 appearance-none rounded-md outline-none focus:bg-white focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100 dark:focus:ring-blue-400 h-11">
                        <input type="text" wire:model="province" placeholder="استان*"
                               class="block w-full py-1.5 px-3 text-base  dark:outline-none outline-1 -outline-offset-1 placeholder:text-gray-400   transition-all col-span-6
                            text-gray-800 dark:text-gray-100 dark:bg-gray-900 bg-slate-100 border border-transparent hover:border-slate-200 appearance-none rounded-md outline-none focus:bg-white focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100 dark:focus:ring-blue-400 h-11">
                        <input type="text" wire:model="city" placeholder="شهر*"
                               class="block w-full py-1.5 px-3 text-base  dark:outline-none outline-1 -outline-offset-1 placeholder:text-gray-400   transition-all col-span-6
                            text-gray-800 dark:text-gray-100 dark:bg-gray-900 bg-slate-100 border border-transparent hover:border-slate-200 appearance-none rounded-md outline-none focus:bg-white focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100 dark:focus:ring-blue-400 h-11">
                        <input type="text" wire:model="address" placeholder="آدرس*"
                               class="block w-full py-1.5 px-3 text-base  dark:outline-none outline-1 -outline-offset-1 placeholder:text-gray-400   transition-all col-span-12
                            text-gray-800 dark:text-gray-100 dark:bg-gray-900 bg-slate-100 border border-transparent hover:border-slate-200 appearance-none rounded-md outline-none focus:bg-white focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100 dark:focus:ring-blue-400 h-11">
                        <input type="text" wire:model="phone" placeholder="تلفن*"
                               class="block w-full py-1.5 px-3 text-base  dark:outline-none outline-1 -outline-offset-1 placeholder:text-gray-400   transition-all col-span-6
                            text-gray-800 dark:text-gray-100 dark:bg-gray-900 bg-slate-100 border border-transparent hover:border-slate-200 appearance-none rounded-md outline-none focus:bg-white focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100 dark:focus:ring-blue-400 h-11">
                        <input type="text" wire:model="postal_code" placeholder="کد پستی*"
                               class="block w-full py-1.5 px-3 text-base  dark:outline-none outline-1 -outline-offset-1 placeholder:text-gray-400   transition-all col-span-6
                            text-gray-800 dark:text-gray-100 dark:bg-gray-900 bg-slate-100 border border-transparent hover:border-slate-200 appearance-none rounded-md outline-none focus:bg-white focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100 dark:focus:ring-blue-400 h-11">
                        <input type="text" wire:model="description" placeholder="توضیحات"
                               class="block w-full py-1.5 px-3 text-base  dark:outline-none outline-1 -outline-offset-1 placeholder:text-gray-400   transition-all col-span-12 h-11
                            text-gray-800 dark:text-gray-100 dark:bg-gray-900 bg-slate-100 border border-transparent hover:border-slate-200 appearance-none rounded-md outline-none focus:bg-white focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100 dark:focus:ring-blue-400">
                    </form>
                </div>
            </div>
            <div>
                    <span class="flex items-center gap-x-1">
                        <a href="#">
                            <svg class="size-5 mb-1">
                                <use href="#truck"></use>
                            </svg>
                        </a>
                        <h1 class="font-DanaDemiBold">نوع ارسال</h1>
                    </span>
                <div class="grid grid-cols-12 child:col-span-12 gap-2 child:w-full child:flex child:items-center child:gap-x-2 child:rounded-lg  child:p-3 child:duration-300 child:border child:border-gray-300 child:dark:border-gray-300/20
                    child:transition-all child:text-gray-600 child:dark:text-gray-300  child:font-DanaMedium child:text-base mt-4">
                    @foreach($this->send_types as $send_type)
                        <button wire:click="setSendType({{$send_type->id}})" @class([
                                    'group ring-1 transition-all duration-300 outline-none focus-visible:ring-2 focus-visible:ring-blue-400',
                                    'ring-blue-500 dark:ring-blue-500' => $this->send_type_id == $send_type->id,
                                    'ring-transparent dark:ring-white/20 hover:ring-blue-300/60' => $this->send_type_id != $send_type->id,
                                ]) >
                            <span
                                @class([
                                     'w-4 h-4 border  rounded-full duration-300 transition-all',
                                     'bg-blue-500 border-blue-500' => $this->send_type_id == $send_type->id,
                                     'border-gray-400' => $this->send_type_id != $send_type->id
                                   ])></span>
                            {{$send_type->title}} : {{$send_type->price}} تومان
                        </button>
                    @endforeach
                </div>
            </div>
            <div class="w-full flex flex-col">
                <span class="flex items-center gap-x-2">
                    <a href="#">
                        <svg class="size-5">
                            <use href="#arrow-right"></use>
                        </svg>
                    </a>
                    <p class="font-DanaDemiBold text-lg">انتخاب روش پرداخت</p>
                </span>
                <div class="grid grid-cols-12 child:col-span-12 gap-2 child:w-full child:flex child:items-center child:gap-x-2 child:rounded-lg child:px-3 child:py-3 child:duration-300 child:border child:border-gray-300 child:dark:border-gray-300/20
                    child:transition-all child:text-base mt-5">
                    @foreach($this->payment_types as $payment_type)

                        <button wire:click="setPaymentType({{$payment_type->id}})" @class([
                                    'group ring-1 transition-all duration-300 outline-none focus-visible:ring-2 focus-visible:ring-blue-400',
                                    'ring-blue-500 dark:ring-blue-500' => $this->payment_type_id == $payment_type->id,
                                    'ring-transparent dark:ring-white/20 hover:ring-blue-300/60' => $this->payment_type_id != $payment_type->id,
                                ])>
                        <span
                            @class([
                                     'w-4 h-4 border rounded-full duration-300 transition-all',
                                     'bg-blue-500 border-blue-500' => $this->payment_type_id == $payment_type->id,
                                     'border-gray-400' => $this->payment_type_id != $payment_type->id
                                   ])></span>
                            <svg class="size-6">
                                <use href="#shopping-cart"></use>
                            </svg>
                            <span class="flex flex-col items-start ">
                                <h1 class="text-lg dark:text-gray-300 text-gray-800 font-DanaMedium">{{$payment_type->title}}</h1>
                            </span>
                        </button>
                    @endforeach
                </div>
            </div>
            <div>
                <div>
                    <label label for="email" class="block text-lg font-DanaDemiBold text-gray-800 dark:text-gray-300">کد
                        تخفیف</label>
                    <div class="mt-3 flex gap-x-2">
                        <input type="text" placeholder="کد تخفیف خود را وارد کنید"
                               class="block w-full p-2.5 text-base dark:outline-none outline-1 -outline-offset-1 placeholder:text-gray-400 transition-all
                            text-gray-800 dark:text-gray-100 dark:bg-gray-900 bg-slate-100 border border-transparent hover:border-slate-200 appearance-none rounded-md outline-none focus:bg-white focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100 dark:focus:ring-blue-400">
                        <button  class="px-5 bg-blue-500 rounded-md text-white hover:bg-blue-600 transition-all">اعمال
                        </button>
                    </div>
                </div>
            </div>
            <div>
                <h1 class="font-DanaDemiBold text-lg">خلاصه سفارش</h1>
                <span class="flex items-center gap-x-1.5">
                        <a href="#">
                            <svg class="size-6 text-red-500 mb-1">
                                <use href="#truck"></use>
                            </svg>
                        </a>
                        <h1 class="font-DanaMedium text-lg">جمعه ۲ خرداد-بازه ۹ - ۲۲</h1>
                        </span>
                <div class="mt-8 flex justify-start gap-2">

                    @if($this->cart)
                        @foreach($this->cart as $item)
                            <div class="flex flex-col mt-8 gap-x-4">
                                <img src="{{$item->product->getMedia('products')->first()->getUrl()}}"
                                     class="w-36 h-20 rounded-lg" alt="">
                                <ul class="flex flex-col items-start gap-y-2 font-DanaMedium text-gray-600 dark:text-gray-200 mt-5  mr-3">
                                    <li class="flex items-center gap-x-1.5">
                                            <span style="background-color: {{$item->product_variant->color->code}}"
                                                  class="size-5 rounded-full"></span>
                                        <p>{{$item->product_variant->color->title}}</p>
                                    </li>

                                    @if($item->product_variant->discount > 0)
                                        <li>
                                    <span class="flex items-center gap-x-2">
                                        <span class="flex items-center gap-x-1 text-red-500">
                                            <p class="font-DanaMedium text-sm">{{$item->product_variant->discount}}%</p>
                                        </span>
                                        <span class="flex items-center gap-x-1 text-gray-400 line-through">
                                            <p class="text-sm">{{$item->product_variant->price}}</p>
                                            <p class="text-xs">تومان</p>
                                        </span>
                                    </span>
                                        </li>
                                    @endif

                                    <li>
                                        @if($item->product_variant->discount_price > 0)
                                            <p class="font-DanaMedium text-xl">{{$item->product_variant->discount_price}}</p>
                                        @else
                                            <p class="font-DanaMedium text-xl">{{$item->product_variant->price}}</p>
                                        @endif
                                    </li>
                                </ul>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
        <!-- PRICE BOX -->
        <div
            class="w-full lg:w-1/4 lg:sticky top-5 flex flex-col gap-y-4 rounded-lg bg-white dark:bg-gray-800 shadow p-4">
            <!-- PRICE -->
            <ul class="child:flex child:items-center child:justify-between space-y-8">
                <li>
                    <p>قیمت کالاها({{ $this->cart ? $this->cart->count() : 0 }})</p>
                    <p class="flex gap-x-1 text-gray-600 dark:text-gray-300 ">{{ number_format($this->totalPrice) }}
                        <span
                            class="hidden xl:flex">تومان</span>
                    </p>
                </li>
                @if($this->totalDiscount > 0)
                    <li class="text-red-500 dark:text-red-400">
                        <p>تخفیف </p>
                        <p class="font-DanaMedium">{{ number_format($this->totalDiscount) }}
                            تومان </p>
                    </li>
                @endif
                @if($this->discountByCode > 0)
                    <li class="text-red-500 dark:text-red-400">
                        <p>تخفیف با کد</p>
                        <p class="font-DanaMedium">{{ number_format($this->discountByCode) }}
                            تومان </p>
                    </li>
                @endif
                <li class="border-t-2 border-dashed border-gray-400 pt-8">
                    <p> مبلغ نهایی :</p>
                    <p>{{ number_format($this->total_discount_price) }} تومان</p>
                </li>
            </ul>

            <a wire:click="payment"
               class="w-full mt-4 flex items-center gap-x-1 justify-center bg-blue-500 text-white hover:bg-blue-600 transition-all rounded-lg shadow py-2">
                پرداخت
                <svg class="w-5 h-5">
                    <use href="#shopping-bag"></use>
                </svg>
            </a>

        </div>
    </section>
</main>>
