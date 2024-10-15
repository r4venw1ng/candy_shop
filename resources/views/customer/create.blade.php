@extends('adminlte::page')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
   <div class="card w-50">
       <div class="card-header text-center">
           <h2>Crear un nuevo Cliente</h2>
       </div>
       <div class="card-body">
           <form action="{{ route('customer.store') }}" method="post" enctype="multipart/form-data">
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
                   <label for="name">Nombre</label>
                   <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" />
               </div>
               <div class="form-group">
                   <label for="address">Dirección</label>
                   <textarea class="form-control" id="address" name="address">{{ old('address') }}</textarea>
               </div>
               <div class="form-group">
                   <label for="phone">Teléfono</label>
                   <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}">
               </div>
               <div class="form-group">
                   <label for="email">Correo Electrónico</label>
                   <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
               </div>
               <div class="text-center">
                   <button type="submit" class="btn btn-success">Guardar Cliente</button>
               </div>
           </form>
       </div>
   </div>
</div>
@endsection
