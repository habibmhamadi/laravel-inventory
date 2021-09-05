@props(['type' => '', 'status' => ''])

@if ($type == 'success')
    <div class="flex p-2 mb-2 text-sm bg-green-100 text-green-700">
        {{ $status }}
    </div>
@elseif($type == 'error')
    <div class="flex p-2 mb-2 text-sm bg-red-100 text-red-700">
        {{ $status }}
    </div>
@else
    <div {{ $attributes->merge(['class' => 'font-medium text-sm text-green-600']) }}>
        {{ $status }}
    </div>
@endif
