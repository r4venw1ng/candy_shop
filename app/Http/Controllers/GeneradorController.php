<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Customer;
use App\Models\Supplier;
use Barryvdh\DomPDF\Facade\Pdf;

$pdf = Pdf::loadHTML($htmlContent);

class GeneradorController extends Controller
{
    // PDF para productos
    public function imprimirProductos()
    {
        $products = Product::where('status', 1)->get(); // Solo productos activos
        $pdf = PDF::loadView('pdf.productos', compact('products'));
        return $pdf->download('productos.pdf');
    }

    // PDF para clientes
    public function imprimirCustomers()
    {
        $customers = Customer::where('status', 1)->get(); // Solo clientes activos
        $pdf = PDF::loadView('pdf.customers', compact('customers'));
        return $pdf->download('customers.pdf');
    }

    // PDF para proveedores
    public function imprimirSuppliers()
    {
        $suppliers = Supplier::where('status', 1)->get(); // Solo proveedores activos
        $pdf = PDF::loadView('pdf.suppliers', compact('suppliers'));
        return $pdf->download('suppliers.pdf');
    }
}
