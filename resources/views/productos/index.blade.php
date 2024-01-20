@extends('plantillas.plantilla') {{-- todo extendemos de la plantilla que hemos creado anteriormente --}}

@section('titulo')
Inicio
@endsection

@section('cabecera')
Listado de Productos del mercadona
@endsection

@section('contenido')

<div class="relative overflow-x-auto">
    <div class="flex flex-row-reverse">
        <a href="{{route('products.create')}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-2"><i class="fas fa-plus text-white-600"></i> Nuevo Producto</a> {{-- todo La ruta para ir al formulario es products.create --}}
    </div>
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Nombre del Producto
                </th>
                <th scope="col" class="px-6 py-3">
                    Descripcion
                </th>
                <th scope="col" class="px-6 py-3">
                    Stock
                </th>
                <th scope="col" class="px-6 py-3">
                    Actions
                </th>
            </tr>
        </thead>
        <tbody>
             @foreach ($producto as $item )
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
               {{$item -> nombre}}
                </th>
                <td class="px-6 py-4">
                   {{$item -> descripcion}}
                </td>
                <td class="px-6 py-4">
                   {{$item -> stock}}
                </td>
                <td class="px-6 py-4">
                    <form action="{{route('products.destroy' , $item)}}" method="post"> {{-- *En el action tengo que pasarle el producto que quiero eliminar por eso le paso el $item --}}
                        @csrf
                        @method('delete')
                        <a href="{{route('products.edit' , $item)}}"><i class="fas fa-edit text-yellow-600 mr-1"></i></a> {{-- ? La ruta para llevar al formulario de update , es la que he definido, la cual se le pasa el producto completo para tener todos sus datos. --}}
                        <a href="{{route('products.show' , $item)}}"><i class="fas fa-info text-blue-600 mr-1"></i></a> {{-- ? La ruta para llevar el info de ese producto es show, el cual espera algo por parametro, que sera el item. --}}
                        <button type="submit"><i class="fas fa-trash text-red-600"></i></button>
                    </form>
                </td>
            </tr>
        </tbody>
        @endforeach
    </table>

    <div class="my-2">
        {{$producto-> links()}}{{-- ? Genera el paginador con los numeritos --}}
    </div>

</div>
@if (session('mensaje'))
<script>
    Swal.fire({
  icon: "success",
  title: "{{ session('mensaje')}}", /* Para mostrar el mensaje */
  showConfirmButton: false,
  timer: 2000
});
</script>

@endif
@endsection
