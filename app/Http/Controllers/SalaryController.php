<?php

namespace App\Http\Controllers;

use App\Salary;
use Illuminate\Http\Request;
use DB;

class SalaryController extends Controller
{

    public function Paid(Request $request,$id){
   
        $ValidateData = $request->validate([
         'salary_month' => 'required',
        ]);
     
        $month = $request->salary_month;
        $check = Salary::where('employee_id',$id)->where('salary_month',$month)->first();
        if ($check) {
           return response()->json('Salary Alrady Paid');
        }else{
            $data = new Salary;
            $data->employee_id = $id;
            $data->amount = $request->sallery;
            $data->salary_date = date('d/m/Y');
            $data->salary_month = $month;
            $data->salary_year = date('Y');
            $data->save(); 
        }
    }

    public function AllSalary(){
        $salary = Salary::select('salary_month')->groupBy('salary_month')->get();
        return response()->json($salary);
    }
    public function viewSalary($id){
        $month = $id;
  	$view = DB::table('salaries')
  			->join('employees','salaries.employee_id','employees.id')
  			->select('employees.name','salaries.*')
  			->where('salaries.salary_month',$month)
  			->get();
  			return response()->json($view);
    }
}
