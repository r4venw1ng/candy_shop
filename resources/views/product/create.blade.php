@extends('adminlte::page')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
   <div class="card w-50">
       <div class="card-header text-center">
           <h2>Crear un nuevo Producto</h2>
       </div>
       <div class="card-body">
           <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
               @csrf
               @if($errors->any())
                   <div class="alert alert-danger">
                       <ul>
                           @foreach($errors->all() as $error)
                               <li>{{ $error }}</li>
                           @endforeach
                       </ul>
                   </div>
               @endif
               <div class="form-group">
                   <label for="name">Nombre del Producto</label>
                   <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" />
               </div>

               <div class="form-group">
                   <label for="description">Descripción</label>
                   <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>
               </div>

               <div class="form-group">
                   <label for="price">Precio</label>
                   <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ old('price') }}" />
               </div>

               <div class="form-group">
                   <label for="stock">Stock</label>
                   <input type="number" class="form-control" id="stock" name="stock" value="{{ old('stock') }}" />
               </div>

               <div class="form-group">
                   <label for="sku">SKU</label>
                   <input type="text" class="form-control" id="sku" name="sku" value="{{ old('sku') }}" />
               </div>

               <div class="form-group">
                   <label for="weight">Peso (kg)</label>
                   <input type="number" step="0.01" class="form-control" id="weight" name="weight" value="{{ old('weight') }}" />
               </div>

               <div class="form-group">
                   <label for="category">Categoría</label>
                   <input type="text" class="form-control" id="category" name="category" value="{{ old('category') }}" />
               </div>

               <!-- El estado se registrará automáticamente como 'activo', por lo tanto, no es necesario seleccionarlo -->
               <input type="hidden" name="status" value="1">

               <div class="text-center">
                   <button type="submit" class="btn btn-success">Guardar Producto</button>
               </div>
           </form>
       </div>
   </div>
</div>
@endsection
