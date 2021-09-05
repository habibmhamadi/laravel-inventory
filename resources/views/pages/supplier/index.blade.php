<x-app-layout>
    @section('title')
        Suppliers
    @endsection
    <x-slot name="header">
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Suppliers') }}
                </h2>
                <form onsubmit="sumbitSearch()" action="{{ route('supplier.index') }}" class="flex justify-center w-full">
                    <input id="searchInput" value="{{ $query }}" placeholder="Search" class="border border-gray-300 p-2 rounded w-1/2" type="search">
                </form>
                <a href="{{ route('supplier.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300">
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
                    @if($suppliers->count())
                        <table class="w-full">
                            <thead>
                                <tr class="bg-gray-200 font-bold text-gray-600">
                                    <th class="p-3">{{__('No.')}}</th>
                                    <th class="p-3">{{__('Name')}}</th>
                                    <th class="p-3">{{__('Phone')}}</th>
                                    <th class="p-3">{{__('Email')}}</th>
                                    <th class="p-3">{{__('Address')}}</th>
                                    <th class="p-3">{{__('Actions')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($suppliers as $supplier)
                                <tr class="text-sm">
                                    <td class="p-3">{{ $loop->iteration }}</td>
                                    <td class="p-3">{{ $supplier->name }}</td>
                                    <td class="p-3">{{ $supplier->phone }}</td>
                                    <td class="p-3">{{ $supplier->email }}</td>
                                    <td class="p-3">{{ $supplier->address }}</td>
                                    <td class="p-3">
                                        <a href="{{ route('supplier.edit', $supplier->id) }}" class="text-green-500">{{ __('Edit') }}</a>
                                        -
                                        <form id="deleteForm" class="inline" action="{{ route('supplier.destroy', $supplier->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <span onclick="document.getElementById('deleteForm').submit()" class="text-red-500 cursor-pointer">
                                                {{ __('Delete') }}
                                            </span>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                            <br>
                        {{ $suppliers->links() }}
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


