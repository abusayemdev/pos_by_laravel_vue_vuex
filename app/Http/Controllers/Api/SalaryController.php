<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class SalaryController extends Controller
{
    public function pay_salary(Request $request, $id)
    {
        $validatedData = $request->validate([
            'salary_month' => 'required',
        ]);

        $month= $request->salary_month;

        $check = DB::table('salaries')->where('employee_id', $id)->where('salary_month', $month)->first();

        if ($check) {

            return response()->json('Salary already paid!');
        }else {
            $data = array();
            $data['employee_id'] = $id;
            $data['amount'] = $request->salary;
            $data['salary_date'] = date('d/m/Y');
            $data['salary_month'] = $month;
            $data['salary_year'] = date('Y');

            DB::table('salaries')->where('employee_id', $id)->insert($data);

        }
    }

    public function all_salaries()
    {
        $salaries = DB::table('salaries')->select('salary_month')->groupBy('salary_month')->get();

        return response()->json($salaries);
    }

    public function show_salary($id)
    {
        $month = $id;

        $salary_list = DB::table('salaries')
                       ->join('employees','employees.id', '=', 'salaries.employee_id')
                       ->select('employees.name','salaries.*')
                       ->where('salaries.salary_month',$month)
                       ->get();

        return response()->json($salary_list);


    }

    public function edit_salary($id)
    {
        $edit_salary = DB::table('salaries')
                       ->join('employees','employees.id', '=', 'salaries.employee_id')
                       ->select('employees.name','employees.email','salaries.*')
                       ->where('salaries.id',$id)
                       ->first();

        return response()->json($edit_salary);

    }



}
