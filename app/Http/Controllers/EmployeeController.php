<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddressRequest;
use App\Http\Requests\EmployeeRequest;
use App\Models\Address;
use App\Models\Employee;
use DB;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Validator;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Obtener los empleados y renderizar la lista        
        $employees = Employee::with(['branch:id,name'])->get();
        return Inertia::render('Employee/EmployeeList', [
            'employees' => $employees,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $mode = $request->query('mode');
        $employeeId = $request->query('employee');

        $employee = $mode === 'update'
            ? Employee::with('address')->findOrFail($employeeId)
            : null;

        return Inertia::render('Employee/EmployeeForm', [
            'mode' => $mode,
            'selectedEmployee' => $employee,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeRequest $request)
    {
        $addressData = $request->input('address');
        $addressId = null;

        if ($addressData) {
            $addressValidator = Validator::make(
                $addressData,
                (new AddressRequest())->rules()
            );
            if ($addressValidator->fails()) {
                return back()
                    ->withErrors(['address' => $addressValidator->errors()->toArray()])
                    ->withInput();
            }

            $address = Address::create($addressValidator->validated());
            $addressId = $address->id;
        }

        $employeeData = $request->validated();

        if ($addressId) {
            $employeeData['address_id'] = $addressId;
        }

        Employee::create($employeeData);


        return redirect()
            ->route('employee.view')
            ->with('success', 'Empleado creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $employee = Employee::with(['address', 'branch:id'])->findOrFail($id);
        return response()->json($employee);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        //Validar dirección
        $addressValidator = Validator::make(
            $request->input('address'),
            (new AddressRequest())->rules()
        );

        $employeeValidator = validator::make(
            $request->all(),
            (new EmployeeRequest())->rules($employee->id)
        );

        if ($addressValidator->fails() || $employeeValidator->fails()) {
            return back()->withErrors(array_merge(
                $employeeValidator->errors()->toArray(),
                ['address' => $addressValidator->errors()->toArray()]
            ))->withInput();
        }

        // Transacción para asegurar integridad
        DB::transaction(function () use ($request, $employee) {
            // Actualizar dirección
            $employee->address->update($request->input('address'));

            // Actualizar empleado
            $employee->update([
                'name' => $request->input('name'),
                'phone' => $request->input('phone'),
                'email' => $request->input('email'),
                'address_id' => $request->input('address_id'),
                'arear_or_department' => $request->input('arear_or_department'),
                'position' => $request->input('position'),
                'branch_id' => $request->input('branch_id'),
                'date_entry' => $request->input('date_entry'),
                'status' => $request->input('status'),
            ]);
        });

        return redirect()->route('employee.view')->with('success', 'Empleado actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {        
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:employees,id',
        ]);

        Employee::whereIn('id', $request->ids)->delete();        
        return redirect()->back()->with('success', 'Empleados eliminados exitosamente.');
    }
}
