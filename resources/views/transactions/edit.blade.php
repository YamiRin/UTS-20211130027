@extends('layout.template')
@section('title', 'Create Transaction')
@section('content')

    <div class="row d-flex justify-content-center mt-5">
        <div class="col-md-6">
            <div class="card p-5">
                <h2 class="mb-4">Edit Transaction</h2>
                @if($errors->any())
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <div>{{ $error }}</div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
                <form action="{{ route('transactions.update', $transaction) }}" method="POST">
                    @csrf
                    @method('put')
                    <input type="hidden" name="id" value="{{$transaction->id}}">
                    <div class="mb-3 col-md-12 ">
                        <label for="amount" class="form-label">Amount (IDR)</label>
                        <input value="{{ old('amount', $transaction->amount) }}" type="number" class="form-control" name="amount" id="amount">
                    </div>
                    <div class="mb-3 col-md-12 ">
                        <label for="type" class="form-label">Type</label>
                        <select class="form-select" name="type" id="type">
                            <option {{ old('type', $transaction->type) == 'income' ? 'selected' : '' }} value="income">Income</option>
                            <option {{ old('type', $transaction->type) == 'expense' ? 'selected': '' }} value="expense">Expense</option>
                        </select>
                    </div>
                    <div class="mb-3 col-md-12 {{ old('type', $transaction->type) ? old('type', $transaction->type) == 'income' ? 'd-block' : 'd-none' : '' }}" id="incomeOptions" >
                        <label for="category" class="form-label">Category</label>
                        <select class="form-select" name="category_income" id="category_income">
                            <option {{ old('category_income', $transaction->category_income) == 'wage' ? 'selected' : '' }} value="wage">Wage</option>
                            <option {{ old('category_income', $transaction->category_income) == 'bonus' ? 'selected' : '' }} value="bonus">Bonus</option>
                            <option {{ old('category_income', $transaction->category_income) == 'gift' ? 'selected' : '' }} value="gift">Gift</option>
                        </select>
                    </div>
                    <div class="mb-3 col-md-12 {{ old('type', $transaction->type) ? old('type', $transaction->type) == 'expense' ? 'd-block' : 'd-none' : 'd-none'}}" id="expenseOptions" >
                        <label for="category" class="form-label">Category</label>
                        <select class="form-select" name="category_expense" id="category_expense">
                            <option {{ old('category_expense', $transaction->category_expense) == 'Food  & Drinks' ? 'selected' : '' }} value="Food & Drinks">Food & Drinks</option>
                            <option {{ old('category_expense', $transaction->category_expense) == 'Shopping' ? 'selected' : '' }} value="Shopping">Shopping</option>
                            <option {{ old('category_expense', $transaction->category_expense) == 'Charity' ? 'selected' : '' }} value="Charity">Charity</option>
                            <option {{ old('category_expense', $transaction->category_expense) == 'Housing' ? 'selected' : '' }} value="Housing">Housing</option>
                            <option {{ old('category_expense', $transaction->category_expense) == 'Insurance' ? 'selected' : '' }} value="Insurance">Insurance</option>
                            <option {{ old('category_expense', $transaction->category_expense) == 'Taxes' ? 'selected' : '' }} value="Taxes">Taxes</option>
                            <option {{ old('category_expense', $transaction->category_expense) == 'Transportation' ? 'selected' : '' }} value="Transportation">Transportation</option>
                        </select>
                    </div>
                    <div class="mb-3 col-md-12 ">
                        <label for="phone_number" class="form-label">Notes</label>
                        <textarea class="form-control" name="notes" id="notes" rows="3">{{old('notes', $transaction->notes)}}</textarea>
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('transactions.index') }}" class="btn btn-secondary me-2">Cancel</a>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>

            </div>
        </div>
    </div>


    <script>
        const typeSelect = document.getElementById("type");
        const expenseOptions = document.getElementById("expenseOptions");
        const incomeOptions = document.getElementById("incomeOptions");

        typeSelect.addEventListener("change", function() {
            console.log(typeSelect.value)

            if (typeSelect.value == "income") {
                incomeOptions.classList.remove("d-none")
                incomeOptions.classList.add("d-block")

                expenseOptions.classList.remove("d-block")
                expenseOptions.classList.add("d-none")
            } else {
                expenseOptions.classList.remove("d-none")
                expenseOptions.classList.add("d-block")

                incomeOptions.classList.remove("d-block")
                incomeOptions.classList.add("d-none")
            }
        });
    </script>
@endsection
