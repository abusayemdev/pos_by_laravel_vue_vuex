<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use Illuminate\Http\Request;
use DB;

class ExpenseController extends Controller
{
    public function index()
    {
        $expense= Expense::all();
        return response()->json($expense);
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'expense_details' => 'required',
            'expense_amount' => 'required',
        ]);

        $expense = new Expense;
        $expense->expense_details = $request->expense_details;
        $expense->expense_amount = $request->expense_amount;
        $expense->expense_date = date('d/m/Y');
        $expense->save();
    }


    public function show($id)
    {
        $expense = DB::table('expenses')->where('id',$id)->first();
        return response()->json($expense);
    }


    public function update(Request $request, $id)
    {
        $data = array();
        $data['expense_details'] = $request->expense_details;
        $data['expense_amount'] = $request->expense_amount;
        DB::table('expenses')->where('id',$id)->update($data);

    }

    
    public function destroy($id)
    {
        DB::table('expenses')->where('id', $id)->delete();
    }
}
