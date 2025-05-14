<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddressRequest;
use App\Http\Requests\BranchRequest;
use App\Models\Address;
use App\Models\Branch;
use DB;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Validator;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $branches = Branch::all();
        return Inertia::render('Branch/BranchList', [
            'branches' => $branches,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $mode = $request->query('mode');
        $branchId = $request->query('branch');

        $branch = $mode === 'update'
            ? Branch::with('address')->findOrFail($branchId)
            : null;

        return Inertia::render('Branch/BranchForm', [
            'mode' => $mode,
            'selectedBranch' => $branch,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BranchRequest $request)
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
                    ->withErrors($addressValidator)
                    ->withInput();
            }

            $address = Address::create($addressValidator->validated());
            $addressId = $address->id;
        }

        $branchData = $request->validated();

        if ($addressId) {
            $branchData['address_id'] = $addressId;
        }

        Branch::create($branchData);


        return redirect()
            ->route('branch.index')
            ->with('success', 'Establecimiento creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Branch $branch)
    {
        //Validar dirección
        $addressValidator = Validator::make(
            $request->input('address'),
            (new AddressRequest())->rules()
        );

        $branchValidator = validator::make(
            $request->all(),
            (new branchRequest())->rules($branch->id)
        );

        if ($addressValidator->fails() || $branchValidator->fails()) {
            return back()->withErrors(array_merge(
                $branchValidator->errors()->toArray(),
                ['address' => $addressValidator->errors()->toArray()]
            ))->withInput();
        }

        // Transacción para asegurar integridad
        DB::transaction(function () use ($request, $branch) {
            // Actualizar dirección
            $branch->address->update($request->input('address'));

            // Actualizar empleado
            $branch->update([
                'name' => $request->input('name'),
                'phone' => $request->input('phone'),
                'email' => $request->input('email'),
                'address_id' => $request->input('address_id'),
                'manager' => $request->input('manager'),
                'status' => $request->input('status'),
                'type' => $request->input('type'),
            ]);
        });

        return redirect()->route('branch.index')->with('success', 'Establecimiento actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {      
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:branches,id',
        ]);

        Branch::whereIn('id', $request->ids)->delete();

        return redirect()->back()->with('success', 'Establecimiento(s) eliminado(s) exitosamente.');
    }

    public function getBranchNames()
    {
        $branches = Branch::select('id', 'name')->get();
        return response()->json($branches);
    }
}
