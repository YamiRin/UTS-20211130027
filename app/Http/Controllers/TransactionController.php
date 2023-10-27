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
        return view('transactions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required',
            'type' => 'required',
        ]);

        $category = $validated['type'] == 'income' ? $request->category_income : $request->category_expense;

        $transaction = Transaction::create([
            'amount' => $validated['amount'],
            'type' => $validated['type'],
            'category' => $category,
            'notes' => $request->notes,
        ]);

        return redirect()->route('transactions.index')->with(['message' => 'success']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        return view('transactions.show', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        return view('transactions.edit', compact('transaction'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        $validated = $request->validate([
            'amount' => 'required',
            'type' => 'required',
        ]);

        $category = $validated['type'] == 'income' ? $request->category_income : $request->category_expense;

        $transaction = $transaction->update([
            'amount' => $validated['amount'],
            'type' => $validated['type'],
            'category' => $category,
            'notes' => $request->notes,
        ]);

        return redirect()->route('transactions.index')->with(['message' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return redirect()->route('transactions.index')->with(['message' => 'success']);
    }
}
