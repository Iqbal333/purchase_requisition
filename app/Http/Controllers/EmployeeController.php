<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
        $this->middleware('permission:employee-list|employee-create|employee-edit|employee-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:employee-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:employee-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:employee-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $employees = Employee::latest()->get();

        return view('employee.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $divisions = Division::get();
        return view('employee.create', compact('divisions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'division_id' => 'required',
            'position_name' => 'required',
            'nik' => 'required|unique:employees,nik',
            'phone_number' => 'required|numeric',
            'employee_name' => 'required',
            'address' => 'required'
        ]);

        $employee = new Employee();
        $employee->user_id = $request->user_id;
        $employee->division_id = $request->division_id;
        $employee->nik = $request->nik;
        $employee->position_name = $request->position_name;
        $employee->employee_name = $request->employee_name;
        $employee->phone_number = $request->phone_number;
        $employee->address = $request->address;

        $employee->save();

        return redirect('employee')->with('success', 'Berhasil tambah data karyawan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $auth = Auth::id();
        $employee = Employee::findOrFail($id);

        return view('employee.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = Employee::findOrFail($id);

        return view('employee.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);

        $request->validate([
            'nik' => [
                'required',
                Rule::unique('employees', 'nik')->ignore($employee->id)
            ],
        ]);

        $employee->user_id = $request->user_id;
        $employee->division_id = $request->division_id;
        $employee->nik = $request->nik;
        $employee->position_name = $request->position_name;
        $employee->employee_name = $request->employee_name;
        $employee->phone_number = $request->phone_number;
        $employee->address = $request->address;

        $employee->update();

        return redirect('employee')->with('success', 'Berhasil mengubah data karyawan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);

        $employee->delete();

        return redirect('employee')->with('success', 'Berhasil menghapus data karyawan');
    }
}
