@extends('plantillas.plantilla') {{-- todo extendemos de la plantilla que hemos creado anteriormente --}}
@section('titulo')
Actualizando producto
@endsection

@section('cabecera')
Actualizado el producto {{$product -> nombre}} {{-- //? Poner el nombre del producto que estoy modificando --}}
@endsection

@section('contenido')

<div class="w-1/2 mx-auto p-6 rounded-xl shadow-xl bg-gray-200">
    {{-- todo A la hora de crear el producto, la ruta que va a tener el formulario para procesar los datos es con el metodo store --}}
    <form action="{{route('products.update' , $product)}}" method="POST"> {{-- ? Cambia la ruta, la cual es products.update y a la cual se le tiene que pasar el producto que se esta modificando mediante la variable $product (que esta en el parametro de la funcion update) --}}
        @csrf
        @method('put') {{-- todo para indicar que la solicitud debe ser tratada como una solicitud de actualización. --}}
        <div class="mb-5">
            <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre</label>
            <input type="text" name="nombre" id="nombre" value="{{$product -> nombre}}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Nombre...">

                @error('nombre') {{-- todo 'nombre' viene de como se defina el name del input --}}
                    <p class="text-italic text-red-600 text-sm">****{{$message}}</p>
                @enderror
            </div>
            <div class="mb-5">
                <label for="descripcion"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descripción</label>
                <textarea type="descripcion" name="descripcion" id="descripcion" rows="8"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Descripción...">{{$product -> descripcion}}</textarea>

                @error('descripcion') {{-- todo 'nombre' viene de como se defina el name del input --}}
                    <p class="text-italic text-red-600 text-sm">****{{$message}}</p>
                @enderror
            </div>
            
            <div class="mb-5">
                <label for="stock" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Stock</label>
                <input type="number" name="stock" id="stock" value="{{$product -> stock}}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="stock...">
                
                @error('stock') {{-- todo 'nombre' viene de como se defina el name del input --}}
                    <p class="text-italic text-red-600 text-sm">****{{$message}}</p>
                @enderror
    
            </div>
        <div class="flex flex-row-reverse">
            <button type="submit" class="ml-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                <i class="fas fa-save mr-2"></i>Actualizar Producto
            </button>
            <button type="reset" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                <i class="fas fa-paintbrush mr-2"></i>Limpiar
            </button>

           <a href="{{route('products.index')}}" class="bg-red-500 hover:bg-green-700 text-white font-bold py-2 px-4 mr-2 rounded">Volver</a>

        </div>

    </form>
</div>
@endsection