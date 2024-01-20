@extends('plantillas.plantilla') {{-- todo extendemos de la plantilla que hemos creado anteriormente --}}

@section('titulo')
Informacion de producto
@endsection

@section('cabecera')
Informacion de producto {{$product -> nombre}}
@endsection

@section('contenido')

<div class="max-w-sm mx-auto mt-40 p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{$product -> nombre}}</h5>
    
    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{$product -> descripcion}}</p>

    {{--? Si el valor de `stock` es menor que 10, se aplica la clase `text-red-600`, que establece el color rojo. --}}
    {{-- ? - Si el valor de `stock` está entre 10 y 20 (inclusive), se aplica la clase `text-orange-600`, que establece el color naranja. --}}
    {{-- ?     - Si el valor de `stock` es mayor que 20, se aplica la clase `text-green-600`, que establece el color verde. --}}
    <span class="text-bold {{ $product->stock < 10 ? 'text-red-600' : ($product->stock <= 20 ? 'text-orange-600' : 'text-green-600') }}">
        Stock:
    </span>
    <span class="text-white"> 
        {{ $product->stock }} unidades 
    </span>
    <br><br>
    <a href="{{route('products.index')}}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        <i class="fas fa-home mr-2"></i> Ir a inicio
    </a>
</div>

    


@endsection