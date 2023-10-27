@extends('layout.template')
@section('title', 'Transaction')
@section('content')

<div class="table-responsive">
    @php


    @endphp
    <div class="row py-md-5">
        <div class="col-md-4">
            <div class="card p-3">
                <div class="d-flex justify-content-between flex-row h-full align-items-center">
                    <div>
                        Jumlah Saldo <br>
                        <span class="fw-bold">
                            Rp. {{ number_format($currentBalance, 2, ",", ".") }}
                        </span>
                        <br>
                        <small class="text-muted">
                            {{ $incomeTransactionsCount + $expenseTransactionsCount }} Transactions
                        </small>
                    </div>
                    <div>
                        <svg class="text-primary" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-cash-coin" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8zm5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0z"/>
                            <path d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1h-.003zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195l.054.012z"/>
                            <path d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083c.058-.344.145-.678.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1H1z"/>
                            <path d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 5.982 5.982 0 0 1 3.13-1.567z"/>
                        </svg>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-md-4">
            <div class="card p-3">
                <div class="d-flex justify-content-between flex-row h-full align-items-center">
                    <div>
                        Total Income <br>
                        <span class="fw-bold">
                            Rp. {{ number_format($totalIncome, 2, ",", ".") }}
                        </span>
                        <br>
                        <small class="text-muted">
                            {{ $incomeTransactionsCount }} Transactions
                        </small>
                    </div>
                    <div>
                        <svg class="text-success" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-arrow-down-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M2 13.5a.5.5 0 0 0 .5.5h6a.5.5 0 0 0 0-1H3.707L13.854 2.854a.5.5 0 0 0-.708-.708L3 12.293V7.5a.5.5 0 0 0-1 0v6z"/>
                        </svg>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-3">
                <div class="d-flex justify-content-between flex-row h-full align-items-center">
                    <div>
                        Total Expense <br>
                        <span class="fw-bold">
                            Rp. {{ number_format($totalExpense, 2, ",", ".") }}
                        </span>
                        <br>
                        <small class="text-muted">
                            {{ $expenseTransactionsCount }} Transactions
                        </small>
                    </div>
                    <div>
                        <svg class="text-danger" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-arrow-up-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M14 2.5a.5.5 0 0 0-.5-.5h-6a.5.5 0 0 0 0 1h4.793L2.146 13.146a.5.5 0 0 0 .708.708L13 3.707V8.5a.5.5 0 0 0 1 0v-6z"/>
                        </svg>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <table class="table table-light table-stripped">
        <thead>
            <tr>
                <th>No</th>
                <th width=150>Amount</th>
                <th>Type</th>
                <th>Category</th>
                <th>Notes</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th width=200>Actions</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = ($transactions->currentpage()-1)* $transactions->perpage() + 1
            @endphp
            @foreach ($transactions as $transaction)

                <tr>
                    <td>{{ $i }}</td>
                    <td>Rp. {{ number_format($transaction->amount, 2, ",", ".") }}</td>
                    <td>{{ $transaction->type }}</td>
                    <td>{{ $transaction->category }}</td>
                    <td>{{ $transaction->notes }}</td>
                    <td>{{ $transaction->created_at }}</td>
                    <td>{{ $transaction->updated_at }}</td>
                    <td>
                        <a href="{{ route('transactions.edit', $transaction) }}" class="btn btn-warning">Edit</a>
                        <a onclick="return confirm('Are you sure?')" href="{{ route('transactions.destroy', $transaction) }}" class="btn btn-danger">Delete</a>
                    </td>
                </tr>

                @php
                $i++;
            @endphp
            @endforeach
        </tbody>
    </table>

</div>
    {!! $transactions->withQueryString()->links('pagination::bootstrap-5') !!}

@endsection
