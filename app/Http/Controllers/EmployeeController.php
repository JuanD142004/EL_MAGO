<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use App\Models\Route;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::paginate();

        return view('employee.index', compact('employees'))
            ->with('i', (request()->input('page', 1) - 1) * $employees->perPage());
    }

    public function create()
    {
        $employee = new Employee();
        $users = User::pluck('name', 'id');
        $routes = Route::pluck('route_name', 'id');

        return view('employee.create', compact('employee', 'users', 'routes'));
    }

    public function store(Request $request)
    {
        request()->validate(Employee::$rules);

        Employee::create($request->all());

        return redirect()->route('employee.index')
            ->with('success', 'Employee created successfully.');
    }

    public function show($id)
    {
        $employee = Employee::find($id);

        return view('employee.show', compact('employee'));
    }

    public function edit($id)
    {
        $employee = Employee::find($id);
        $users = User::pluck('name', 'id');
        $routes = Route::pluck('route_name', 'id');

        return view('employee.edit', compact('employee', 'users', 'routes'));
    }

    public function update(Request $request, Employee $employee)
    {
        request()->validate(Employee::$rules);

        $employee->update($request->all());

        return redirect()->route('employee.index')
            ->with('success', 'Empleado actualizado con éxito.');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|boolean',
        ]);

        $employee = Employee::findOrFail($id);
        $employee->enabled = $request->input('status');
        $employee->save();

        $action = $employee->enabled ? 'habilitado' : 'inhabilitado';

        return redirect()->back()->with('success', "El Empleado ha sido $action correctamente.");
    }

    public function destroy($id)
    {
        Employee::find($id)->delete();

        return redirect()->route('employee.index')
            ->with('success', 'Employee deleted successfully.');
    }
}
