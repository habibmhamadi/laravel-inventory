<x-app-layout>
    @section('title')
        Cart
    @endsection
    <x-slot name="header">
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Cart') }}
                </h2>
                @if($carts->count())
                    <form action="{{ route('transaction.store') }}" method="post" class="flex gap-x-5 items-center">
                        @csrf
                        <x-label for="name" class="text-lg" :value="__('Customer:')" />

                        <select required name="customer_id" class="mr-10 w-full border border-gray-300 rounded focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option disabled selected value="">...</option>
                            @foreach($customers as $customer)
                                <option {{ old('customer_id') == $customer->id ? 'selected' : '' }} value="{{$customer->id}}">{{$customer->name}}</option>
                            @endforeach
                        </select>
                        <x-button>{{__('Checkout')}}</x-button>
                    </form>
                @endif
            </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 overflow-x-scroll md:overflow-x-hidden">
                    @if(session('success'))
                        <x-auth-session-status :type="'success'" :status="session('success')"></x-auth-session-status>
                    @elseif(session('error'))
                        <x-auth-session-status :type="'error'" :status="session('error')"></x-auth-session-status>
                    @endif
                    @if($carts->count())
                        <table class="w-full">
                            <thead>
                                <tr class="bg-gray-200 font-bold text-gray-600">
                                    <th class="p-3">{{__('No.')}}</th>
                                    <th class="p-3">{{__('Name')}}</th>
                                    <th class="p-3">{{__('Price')}}</th>
                                    <th class="text-center">{{__('Quantity')}}</th>
                                    <th class="text-center">{{__('Total')}}</th>
                                    <th class="text-center">{{__('Actions')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                            @php
                                $total = 0
                            @endphp
                            @foreach($carts as $cart)
                                <tr>
                                    <td class="p-3">{{ $loop->iteration }}</td>
                                    <td class="p-3">{{ $cart->product->name }}</td>
                                    <td class="p-3">{{ number_format($cart->product->price) }}</td>
                                    <td class="text-center">
                                        @if($cart->product->quantity < $cart->quantity)
                                            <div class="flex justify-center">
                                                <p class="px-1.5 text-red-600 text-sm bg-red-200 rounded">{{__('Out of Stock')}}</p>
                                            </div>
                                        @else
                                            <div class="flex justify-center items-center gap-x-5">
                                                <a href="{{ route('cart.decrement', $cart->id) }}" class="bg-gray-100 rounded px-2">-</a>
                                                {{ number_format($cart->quantity) }}
                                                <a href="{{ route('cart.increment', $cart->id) }}" class="bg-gray-100 rounded px-2">+</a>
                                            </div>
                                            @php $total += $cart->quantity * $cart->product->price @endphp
                                        @endif
                                    </td>
                                    <td class="text-center">{{ number_format($cart->quantity * $cart->product->price) }}</td>
                                    <td class="text-center">
                                        <form id="deleteForm{{$cart->id}}" class="inline" action="{{ route('cart.destroy', $cart->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <span onclick="document.getElementById('deleteForm{{$cart->id}}').submit()" class="text-red-500 cursor-pointer">
                                                {{ __('Delete') }}
                                            </span>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                            <br>
                        <div>
                            <p class="text-lg font-semibold">{{__('Grand Total:')}}&nbsp; {{number_format($total)}}</p>
                        </div>
                    @else
                        <p>{{ __('No item found.') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


