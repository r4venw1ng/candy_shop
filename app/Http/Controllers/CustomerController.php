<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener solo los clientes activos y pasarlos a la vista
        $customers = Customer::where('status', 1)->get();
        return view('customer.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Retornar la vista para crear un nuevo cliente
        return view('customer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'name' => 'required|string|max:100',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:100|unique:customers,email',
            'address' => 'nullable|string',
        ]);

        // Crear un nuevo cliente con los datos del formulario
        Customer::create($request->all());

        // Redireccionar a la lista de clientes con un mensaje de éxito
        return redirect()->route('customer.index')->with('success', 'Cliente creado correctamente.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($customer_id)
    {
        // Buscar el cliente por su ID
        $customer = Customer::findOrFail($customer_id);

        // Retornar la vista de edición del cliente
        return view('customer.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $customer_id)
    {
        // Validar los datos del formulario
        $request->validate([
            'name' => 'required|string|max:100',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:100|unique:customers,email,' . $customer_id . ',customer_id',
            'address' => 'nullable|string',
        ]);

        // Buscar el cliente por su ID y actualizarlo con los nuevos datos
        $customer = Customer::findOrFail($customer_id);
        $customer->update($request->all());

        // Redireccionar a la lista de clientes con un mensaje de éxito
        return redirect()->route('customer.index')->with('success', 'Cliente actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage (soft delete).
     */
    public function destroy($customer_id)
    {
        // Buscar el cliente por su ID y realizar el borrado lógico
        $customer = Customer::findOrFail($customer_id);
        $customer->status = 0; // Cambia el status a 0 para marcarlo como inactivo
        $customer->save(); // Asegúrate de guardar los cambios

        // Redireccionar a la lista de clientes con un mensaje de éxito
        return redirect()->route('customer.index')->with('success', 'Cliente desactivado correctamente.');
    }

    /**
     * Restore the specified resource from storage.
     */
    public function restore($customer_id)
    {
        // Buscar el cliente por su ID y restaurarlo
        $customer = Customer::findOrFail($customer_id);
        $customer->update(['status' => 1]); // Cambia el status a 1 para marcarlo como activo

        // Redireccionar a la lista de clientes con un mensaje de éxito
        return redirect()->route('customer.index')->with('success', 'Cliente restaurado correctamente.');
    }

    public function imprimirCustomers()
    {
        $customers = Customer::where('status', 1)->get();
        $pdf = PDF::loadView('pdf.customers', compact('customers'));

        return $pdf->download('customers.pdf');
    }
    
}
