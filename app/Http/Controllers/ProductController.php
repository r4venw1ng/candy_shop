<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener solo productos activos
        $products = Product::where('status', 1)->get();
        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos recibidos
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'sku' => 'required|string|max:100|unique:products,sku',
            'weight' => 'required|numeric|min:0',
            'category' => 'nullable|string|max:255',
            'status' => 'required|boolean',
        ]);

        // Crear un nuevo producto
        Product::create($request->all());

        return redirect()->route('product.index')->with('success', 'Producto creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'sku' => 'required|string|max:100|unique:products,sku,' . $id,
            'weight' => 'required|numeric|min:0',
            'category' => 'nullable|string|max:255',
            'status' => 'required|boolean',
        ]);

        // Buscar y actualizar el producto
        $product = Product::findOrFail($id);
        $product->update($request->all());

        return redirect()->route('product.index')->with('success', 'Producto actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Borrado lógico del producto (cambio de status)
        $product = Product::findOrFail($id);
        $product->status = 0; // Cambiar el estado a inactivo
        $product->save();

        return redirect()->route('product.index')->with('success', 'Producto desactivado correctamente.');
    }

    /**
     * Generar PDF con productos.
     */
    public function imprimirProductos()
    {
        // Obtener solo los productos activos
        $products = Product::where('status', 1)->get();

        // Cargar la vista con los productos en el PDF
        $pdf = PDF::loadView('pdf.products', compact('products'));

        // Descargar el PDF
        return $pdf->download('products.pdf');
    }
}
