<x-app-layout>
    @section('title')
        Report
    @endsection
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Report') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl flex justify-center mx-auto sm:px-6 lg:px-8">
            <div class="bg-white w-1/2 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if(session('success'))
                        <x-auth-session-status :type="'success'" :status="session('success')"></x-auth-session-status>
                    @elseif(session('error'))
                        <x-auth-session-status :type="'error'" :status="session('error')"></x-auth-session-status>
                    @endif
                    <form action="{{route('transaction.createReport')}}" method="POST">
                        @csrf
                        <div class="mb-2">
                            <x-label for="customer_name" :value="__('Customer')" />
                            <select name="customer_name" class="w-full border border-gray-300 rounded focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="">...</option>
                                @foreach($customers as $customer)
                                    <option {{ old('customer') == $customer->customer_name ? 'selected' : '' }} value="{{$customer->customer_name}}">{{$customer->customer_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-2">
                            <x-label for="product_name" :value="__('Product')" />
                            <select name="product_name" class="w-full border border-gray-300 rounded focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="">...</option>
                                @foreach($products as $product)
                                    <option {{ old('product') == $product->product_name ? 'selected' : '' }} value="{{$product->product_name}}">{{$product->product_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-2">
                            <x-label for="from_date" :value="__('From Date')" />

                            <x-input id="from_date" class="block mt-1 w-full" type="date" name="from_date" :value="old('from_date')" />
                        </div>
                        <div class="mb-3">
                            <x-label for="to_date" :value="__('To Date')" />

                            <x-input id="to_date" class="block mt-1 w-full" type="date" name="to_date" :value="old('to_date')" />
                        </div>
                        <x-button>{{ __('Generate Report') }}</x-button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>


