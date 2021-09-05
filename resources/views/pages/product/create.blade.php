<x-app-layout>
    @section('title')
        Product - Create
    @endsection
    <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Products - Create') }}
            </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl flex justify-center mx-auto sm:px-6 lg:px-8">
            <div class="bg-white w-1/2 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('product.store') }}" method="POST">
                        @csrf
                        <div class="mb-2">
                            <x-label for="name" :value="__('Name')" />

                            <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                            @error('name')<p class="text-sm text-red-500">{{ $message }}</p> @enderror
                        </div>
                        <div class="mb-2">
                            <x-label for="measurement_id" :value="__('Measurement')" />
                            <select required name="measurement_id" class="w-full border border-gray-300 rounded focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value=""></option>
                                @foreach($measurements as $measurement)
                                    <option {{ old('measurement_id') == $measurement->id ? 'selected' : '' }} value="{{$measurement->id}}">{{$measurement->name}}</option>
                                @endforeach
                            </select>
                            @error('measurement_id')<p class="text-sm text-red-500">{{ $message }}</p> @enderror
                        </div>
                        <div class="mb-2">
                            <x-label for="supplier_id" :value="__('Supplier')" />
                            <select required name="supplier_id" class="w-full border border-gray-300 rounded focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value=""></option>
                                @foreach($suppliers as $supplier)
                                    <option {{ old('supplier_id') == $supplier->id ? 'selected' : '' }} value="{{$supplier->id}}">{{$supplier->name}}</option>
                                @endforeach
                            </select>
                            @error('supplier_id')<p class="text-sm text-red-500">{{ $message }}</p> @enderror
                        </div>
                        <div class="mb-2">
                            <x-label for="price" :value="__('Price')" />

                            <x-input id="price" class="block mt-1 w-full" type="text" name="price" :value="old('price')" required autofocus />
                            @error('price')<p class="text-sm text-red-500">{{ $message }}</p> @enderror
                        </div>
                        <div class="mb-3">
                            <x-label for="quantity" :value="__('Quantity')" />

                            <x-input id="quantity" class="block mt-1 w-full" type="text" name="quantity" :value="old('quantity')" required autofocus />
                            @error('quantity')<p class="text-sm text-red-500">{{ $message }}</p> @enderror
                        </div>
                        <x-button>{{ __('Create') }}</x-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
