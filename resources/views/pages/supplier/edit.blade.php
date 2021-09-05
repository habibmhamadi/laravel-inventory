<x-app-layout>
    @section('title')
        Supplier - Edit
    @endsection
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Suppliers - Edit') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl flex justify-center mx-auto sm:px-6 lg:px-8">
            <div class="bg-white w-1/2 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('supplier.update', $supplier->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-2">
                            <x-label for="name" :value="__('Name')" />

                            <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="$supplier->name" required autofocus />
                            @error('name')<p class="text-sm text-red-500">{{ $message }}</p> @enderror
                        </div>
                        <div class="mb-2">
                            <x-label for="phone" :value="__('Phone')" />

                            <x-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="$supplier->phone" required autofocus />
                            @error('phone')<p class="text-sm text-red-500">{{ $message }}</p> @enderror
                        </div>
                        <div class="mb-2">
                            <x-label for="email" :value="__('Email')" />

                            <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="$supplier->email" required autofocus />
                            @error('email')<p class="text-sm text-red-500">{{ $message }}</p> @enderror
                        </div>
                        <div class="mb-3">
                            <x-label for="address" :value="__('Address')" />

                            <x-input id="address" class="block mt-1 w-full" type="text" name="address" :value="$supplier->address" required autofocus />
                            @error('address')<p class="text-sm text-red-500">{{ $message }}</p> @enderror
                        </div>
                        <x-button>{{ __('Save') }}</x-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
