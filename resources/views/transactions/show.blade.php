@extends('layout.template')
@section('title', 'Transaction View')
@section('content')
<div class="row d-flex justify-content-center mt-5">
    <div class="col-md-6">
        <div class="card p-5">
            <h3>Rp. {{ number_format($transaction->amount, 2, ',', '.') }}</h3>
            <table>
                <tr>
                    <td>Type</td>
                    <td>:</td>
                    <td><div class="btn btn-sm {{ $transaction->type == 'income' ? 'btn-success' : 'btn-danger' }}">{{ $transaction->type }}</div></td>
                </tr>
                <tr>
                    <td>Category</td>
                    <td>:</td>
                    <td>{{ $transaction->category }}</td>
                </tr>
                <tr>
                    <td>Notes</td>
                    <td>:</td>
                    <td>{{ $transaction->notes }}</td>
                </tr>
            </table>
        </div>
        <a href="{{route('transactions.index')}}" class="btn btn-primary">Back</a>
    </div>
</div>
@endsection
