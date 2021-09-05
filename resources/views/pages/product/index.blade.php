<x-app-layout>
    @section('title')
        Products
    @endsection
    <x-slot name="header">
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Products') }}
                </h2>
                <form onsubmit="sumbitSearch()" action="{{ route('product.index') }}" class="flex justify-center w-full">
                    <input id="searchInput" value="{{ $query }}" placeholder="Search" class="border border-gray-300 p-2 rounded w-1/2" type="search">
                </form>
                <a href="{{ route('product.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300">
                    {{__('Create')}}
                </a>
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
                    @if($products->count())
                        <table class="w-full">
                            <thead>
                                <tr class="bg-gray-200 font-bold text-gray-600">
                                    <th class="p-3">{{__('No.')}}</th>
                                    <th class="p-3">{{__('Name')}}</th>
                                    <th class="p-3">{{__('Measurement')}}</th>
                                    <th class="p-3">{{__('Supplier')}}</th>
                                    <th class="p-3">{{__('Price')}}</th>
                                    <th class="p-3">{{__('Quantity')}}</th>
                                    <th class="text-center">{{__('Actions')}}</th>
                                    <th class="text-center">{{__('Add to Cart')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr class="text-sm">
                                    <td class="p-3">{{ $loop->iteration }}</td>
                                    <td class="p-3">{{ $product->name }}</td>
                                    <td class="p-3">{{ $product->measurement->name }}</td>
                                    <td class="p-3">{{ $product->supplier->name }}</td>
                                    <td class="p-3">{{ number_format($product->price) }}</td>
                                    <td class="p-3 {{$product->quantity < 1 ? 'text-red-500' : ''}}">{{ number_format($product->quantity) }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('product.edit', $product->id) }}" class="text-green-500">{{ __('Edit') }}</a>
                                        -
                                        <form id="deleteForm{{$product->id}}" class="inline" action="{{ route('product.destroy', $product->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <span onclick="document.getElementById('deleteForm{{$product->id}}').submit()" class="text-red-500 cursor-pointer">
                                                {{ __('Delete') }}
                                            </span>
                                        </form>
                                    </td>
                                    <td class="text-center">
                                        <form id="cartForm{{$product->id}}" class="inline" action="{{ route('cart.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{$product->id}}">
                                            <span onclick="document.getElementById('cartForm{{$product->id}}').submit()" class="text-yellow-500 cursor-pointer">
                                                {{ __('Add') }}
                                            </span>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                            <br>
                        {{ $products->links() }}
                    @else
                        <p>{{ __('No item found.') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @section('script')
            <script src="{{ asset('js/search_script.js') }}"></script>
    @endsection
</x-app-layout>


