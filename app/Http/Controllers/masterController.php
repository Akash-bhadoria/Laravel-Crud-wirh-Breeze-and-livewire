<?php

namespace App\Http\Controllers;

use App\Models\CrudUser;
use Illuminate\Http\Request;
use App\Models\EmployeeMaster;
use Illuminate\Support\Facades\DB;
use App\Models\EmployeeInformation;
use Illuminate\Support\Facades\Auth;


class masterController extends Controller
{
    public function addMasterEmployee(Request $request){

        $masters = EmployeeMaster::create(['employee_created_by' => Auth::id(),
        'employee_name' => $request->employee_name,
        'employee_phone' => $request->employee_phone,
        'employee_age' => $request->employee_age,
    ])->id;

    $info = EmployeeInformation::create([
        'emp_id' => $masters,
        'address' => $request->employee_address,
        'doj' => $request->employee_doj,
        'salary' => $request->employee_salary,
    ]);

        return response()->json(['status' => 'success', 'message' => 'Data saved succesfully', 'Data' => $masters, 'Datainfo' => $info]);

    }

    public Function getEmployee(Request $request){
    

        $masters = EmployeeMaster::find($request->id);
        $info = EmployeeInformation::where('emp_id', $request->id)->first();
        return response()->json(['status' => 'success', 'data' => $masters, 'datainfo' => $info]);

    }

    public function editEmployee(Request $request){
        
        $masters = EmployeeMaster::where('id', $request->employee_id)->update([
            'employee_name' => $request->employee_name,
            'employee_phone' => $request->employee_phone,
            'employee_age' => $request->employee_age,
        ]);

        $info = EmployeeInformation::where('emp_id', $request->employee_id)->update([
            'address' => $request->employee_address,
            'doj' => $request->employee_doj,
            'salary' => $request->employee_salary,
        ]);
        return response()->json(['status' => 'success', 'message' => 'Data saved succesfully', 'Data' => $masters, 'Datainfo' => $info]);


    }

    public function fetchEmployee(){
        $fetchs = $this->employeeData();
        
        return view('dashboard', compact('fetchs'));
        
    }
    public function crudWire(){
        return view ('livewire.index');
    }

    public function fetchEmployeeTable(){
        $fetchs = $this->employeeData();
        $auth_id = Auth::id();
        return response()->json(['status' => 'success', 'data' => $fetchs, 'authid' => $auth_id]);
    }

    public function employeeData(){
        $fetchs = DB::table('employee_masters')
        ->select('employee_masters.id', 'employee_name', 'employee_phone', 'employee_age', 'employee_created_by', 'employee_informations.emp_id', 'employee_informations.address', 'employee_informations.doj', 'employee_informations.salary', 'users.name')
        ->join('employee_informations','employee_informations.emp_id','=','employee_masters.id')
        ->join('users','users.id','=','employee_masters.employee_created_by')
        ->get();
        return ($fetchs);
    }

    public function deleteEmployee(Request $request ){
        

        EmployeeMaster::find($request->id)->delete();

        EmployeeInformation::where('emp_id', $request->id)->delete();


        return response()->json(['status' => 'success', 'message' => 'Employee Deleted successfully']);

    }
}
