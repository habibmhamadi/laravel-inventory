<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title></title>

    <style>
        table {
            border-collapse: collapse;
            border-spacing: 0;
            width: 100%;
        }
        th, td {
            text-align: left;
            padding: 8px;
        }

    </style>
</head>
<body>
<div >
    <div>
        <div >
            <div></div>
            <h1>{{ $title }}</h1>
            <p>{{ $date }}</p>
        </div>
        @if($transactions->count())
            @php $total = 0 @endphp
            <table>
                <thead>
                <tr>
                    <th>{{__('No.')}}</th>
                    <th>{{__('Customer')}}</th>
                    <th>{{__('Product')}}</th>
                    <th>{{__('Price')}}</th>
                    <th>{{__('Quantity')}}</th>
                    <th>{{__('Total')}}</th>
                    <th>{{__('Date')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($transactions as $transaction)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $transaction->customer_name }}</td>
                        <td>{{ $transaction->product_name }}</td>
                        <td>{{ number_format($transaction->price) }}</td>
                        <td>{{ number_format($transaction->quantity) }}</td>
                        <td>{{ number_format($transaction->price * $transaction->quantity) }}</td>
                        <td>{{ $transaction->created_at->format('Y-m-d') }}</td>
                    </tr>
                    @php $total += $transaction->price * $transaction->quantity  @endphp
                @endforeach
                </tbody>
            </table>
            <br>
            <div>
                <p>{{__('Grand Total:')}}&nbsp; {{number_format($total)}}</p>
            </div>
        @else
            <p>{{ __('No item found.') }}</p>
        @endif
    </div>
</div>
</body>
</html>
