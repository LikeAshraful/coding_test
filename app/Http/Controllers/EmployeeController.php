<?php

namespace App\Http\Controllers;

use App\Company;
use App\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::orderBy('id','desc')->paginate(10);

     	return view('employee.index', [
     		'employees' => $employees
     	]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::all();
        return view('employee.create',[
            'companies' => $companies
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'f_name' => 'required|max:255',
            'l_name' => 'required|max:255',
            'email' => 'email'
        ]);

        $employee = new Employee();
        $employee->first_name = $request->f_name;
        $employee->last_name = $request->l_name;
        $employee->email = $request->email;
        $employee->phone = $request->phone_no;
        $employee->password = Hash::make($request->password);
        $employee->company_id = $request->company;
        $employee->save();

        return redirect()->route('employee.all')->with('status', 'Successfully created new Employee');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = Employee::find($id);
        $companies = Company::all();
        return view('employee.edit-modal',[
            'employee' => $employee,
            'companies' => $companies
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'f_name' => 'required|max:255',
            'l_name' => 'required|max:255',
            'email' => 'email'
        ]);

        $employee = Employee::find($id);
        $employee->first_name = $request->f_name;
        $employee->last_name = $request->l_name;
        $employee->email = $request->email;
        $employee->phone = $request->phone_no;
        $employee->password = Hash::make($request->password);
        $employee->company_id = $request->company;
        $employee->save();

        return redirect()->route('employee.all')->with('status', 'Successfully Updated Employee');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::find($id);
        $employee->delete();
        return redirect()->route('employee.all')->with('status', 'Deleted Employee');
    }
}
