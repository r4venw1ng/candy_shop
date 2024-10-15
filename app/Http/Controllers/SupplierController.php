<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::where('status', 1)->get();
        return view('supplier.index', compact('suppliers'));
    }

    public function create()
    {
        return view('supplier.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:100',
            'address' => 'nullable|string',
        ]);

        Supplier::create($request->all());
        return redirect()->route('supplier.index')->with('success', 'Proveedor creado correctamente.');
    }

    public function edit(Supplier $supplier)
    {
        return view('supplier.edit', compact('supplier'));
    }

    public function update(Request $request, Supplier $supplier)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:100',
            'address' => 'nullable|string',
        ]);

        $supplier->update($request->all());
        return redirect()->route('supplier.index')->with('success', 'Proveedor actualizado correctamente.');
    }

    public function destroy(Supplier $supplier)
    {
        $supplier->update(['status' => 0]);
        return redirect()->route('supplier.index')->with('success', 'Proveedor desactivado correctamente.');
    }

    public function restore($id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->update(['status' => 1]);
        return redirect()->route('supplier.index')->with('success', 'Proveedor restaurado correctamente.');
    }
    
    public function imprimirSuppliers()
    {
        $suppliers = Supplier::where('status', 1)->get();
        $pdf = PDF::loadView('pdf.suppliers', compact('suppliers'));

        return $pdf->download('suppliers.pdf');
    }
}
