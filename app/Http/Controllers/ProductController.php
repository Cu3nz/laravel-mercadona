<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Ramsey\Uuid\Type\Integer;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //? Retornamos la vista index que hay en la carpeta de productos (resources/productos/index.blade.php)
        $producto = Product::orderBy('nombre') -> paginate(10);
        return view('productos.index' , compact('producto')); //* Nombre de la carpeta . primer nombre del archivo en este caso index.
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //? Devolvemos la vista.
        return view('productos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //? Lo primero que tenemos que hacer son las validaciones de los atributos que tenemos en el formulario. 

        $request -> validate([
            'nombre' => ['required' , 'string' , 'min:3' , 'unique:products,nombre'], //? Defino que es requerido en el formulario (por lo tanto tiene que tener un texto en el input ) , que es un string, que tiene que tener como minimo 3 caracteres y que es unico en la tabla products en la columna nombre.
            'descripcion' => ['required' , 'string' , 'min:10'] , //? Definimos que la descripcion es requerida, que es de tipo string y tiene que tener al menos 10 caracteres.
            'stock' => ['required' , 'integer' , 'min:1' , 'max:40'] //? Definimos que el stock es requerido, que es de tipo integer y como min podemos poner 1 y como maximo podemos poner 40.
        ]);

        //todo Si hemos llegado aqui, es porque nombre, descripcion y stock han pasado las validaciones , por lo tanto vamos a crear el producto.

        Product::create([
            'nombre' => ucfirst($request -> nombre), //? Ponemos en mayuscula el nombre.
            'descripcion' => ucfirst($request -> descripcion), //? Ponemos en mayuscula la descripcion.
            'stock' => (int) (($request -> stock)) //? Lo convertimos a numerico, por si acaso nos meten texto, que el texto valga 0.
        ]);

        return redirect() -> route('products.index') -> with('mensaje' , 'Producto creado exitosamente'); //? Nos dirigimos a la pagina principal y ponemos un mensaje de alerta con sweetalert que se almacena en la sesion mensaje
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //?  Devolvemos la vista con todos los atributos del producto al cual has hecho click 

        return view('productos.show' , compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //? Devolvemos la vista del formulario junto con el array de los datos de ese producto que quiero actualizar, esto para ponerlo en los values.

        return view('productos.update' , compact('product')); 

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //? Hacemos las mismas validaciones que en el create, solo que tenemos que hacer un cambio en el campo que es unico y que no se puede repetir, ya que si no hacemos este cambio, nos saltara el error de validacion de que el nombre esta repetido en la base de datos. Este cambio es 'unique:products,nombre'.$product -> id

        $request -> validate([
            //! Cuidado con la sentencia  tiene que tener la , entre nombre y la '.
            //todo  'unique:products,nombre,'.$product -> id. Se añade para que a la hora de actualizar el producto, se busque por toda la base de datos si existe ese nombre para cualquier otro producto (menos el que se esta actualizando).

            'nombre' => ['required' , 'string' , 'min:3' , 'unique:products,nombre,'.$product -> id], //? Defino que es requerido en el formulario (por lo tanto tiene que tener un texto en el input ) , que es un string, que tiene que tener como minimo 3 caracteres y que es unico en la tabla products en la columna nombre.

            'descripcion' => ['required' , 'string' , 'min:10'] , //? Definimos que la descripcion es requerida, que es de tipo string y tiene que tener al menos 10 caracteres.

            'stock' => ['required' , 'integer' , 'min:1' , 'max:40'] //? Definimos que el stock es requerido, que es de tipo integer y como min podemos poner 1 y como maximo podemos poner 40.
        ]);

        //* Si hemos paado las validaciones, actualizamos el producto

        $product -> update([
            //? Lo mismo que el create
            'nombre' => ucfirst($request -> nombre), //? Ponemos en mayuscula el nombre.
            'descripcion' => ucfirst($request -> descripcion), //? Ponemos en mayuscula la descripcion.
            'stock' => (int) (($request -> stock)) //? Lo convertimos a numerico, por si acaso nos meten texto, que el texto valga 0.
        ]);

        return redirect() -> route('products.index') -> with('mensaje' , 'Producto actualizado correctamente'); //? Nos vamos al index y ponemos un mensaje de actualizacion del producto

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
        $product -> delete(); //* Borramos el producto en cuestion que se ha pasado por parametro 
        //todo Una vez que borramos el producto, retornamos  la redireccion de la  ruta hacia la pagina principal, mosrando un mensaje por el sweetaalert.

        return redirect() -> route('products.index') -> with('mensaje' , 'Producto eliminado correctamente.');

    }
}
