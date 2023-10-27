<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = \App\Models\Transaction::orderBy('created_at', 'desc');

        $transaction_count = $transactions->get();
        $totalIncome = $transaction_count->where('type', 'income')->sum('amount');
        $totalExpense = $transaction_count->where('type', 'expense')->sum('amount');
        $incomeTransactionsCount = $transaction_count->where('type', 'income')->count();
        $expenseTransactionsCount = $transaction_count->where('type', 'expense')->count();

        $currentBalance = $totalIncome - $totalExpense;

        $transactions = $transactions->paginate(10);

        return view('transactions.index', compact('transactions', 'totalIncome', 'totalExpense', 'currentBalance', 'incomeTransactionsCount', 'expenseTransactionsCount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
