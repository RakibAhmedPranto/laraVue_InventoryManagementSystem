<?php

namespace App\Http\Controllers;

use App\Expense;
use Illuminate\Http\Request;
use DB;

class ExpenseController extends Controller
{

    public function index()
    {
        $expense = Expense::all();
        return response()->json($expense);
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'details' => 'required',
            'amount' => 'required',
           ]);

            $expense = new Expense;
            $expense->details = $request->details;
            $expense->amount = $request->amount;
            $expense->expense_date = date('d/m/y');

            $expense->save();
    }


    public function show($id)
    {
        $target = Expense::where('id',$id)->first();
        return response()->json($target);
    }

    public function update(Request $request, $id)
    {
        $data = array();
        $data['details'] =  $request->details;
        $data['amount'] =  $request->amount;
        DB::table('expenses')->where('id',$id)->update($data);
    }

    public function destroy($id)
    {
        $target = Expense::find($id);
        if(!empty($target)){
            $target->delete();
        }
    }
}
