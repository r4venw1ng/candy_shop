@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row">
        <h2>Editar Producto</h2>
    </div>
    <div class="row">
        <hr>
        <form action="{{ route('product.update', $product->id) }}" method="post" enctype="multipart/form-data" class="col-lg-7">
            @csrf
            @method('PUT') <!-- Usamos el método PUT para actualizar -->
            
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $product->name) }}" />
            </div>

            <div class="form-group">
                <label for="description">Descripción</label>
                <textarea class="form-control" id="description" name="description">{{ old('description', $product->description) }}</textarea>
            </div>

            <div class="form-group">
                <label for="price">Precio</label>
                <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ old('price', $product->price) }}" />
            </div>

            <div class="form-group">
                <label for="stock">Stock</label>
                <input type="number" class="form-control" id="stock" name="stock" value="{{ old('stock', $product->stock) }}" />
            </div>

            <div class="form-group">
                <label for="sku">SKU</label>
                <input type="text" class="form-control" id="sku" name="sku" value="{{ old('sku', $product->sku) }}" />
            </div>

            <div class="form-group">
                <label for="weight">Peso</label>
                <input type="number" step="0.01" class="form-control" id="weight" name="weight" value="{{ old('weight', $product->weight) }}" />
            </div>

            <div class="form-group">
                <label for="category">Categoría</label>
                <input type="text" class="form-control" id="category" name="category" value="{{ old('category', $product->category) }}" />
            </div>

            <div class="form-group">
                <label for="status">Estado</label>
                <select class="form-control" id="status" name="status">
                    <option value="1" {{ old('status', $product->status) == 1 ? 'selected' : '' }}>Activo</option>
                    <option value="0" {{ old('status', $product->status) == 0 ? 'selected' : '' }}>Inactivo</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Actualizar Producto</button>
        </form>
    </div>
</div>
@endsection
