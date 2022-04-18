<?php

use Illuminate\Support\Facades\Route;
use App\Direccion;
use App\MetodoPago;
use App\Inventario;
use App\Facturacion;
use Barryvdh\DomPDF\Facade as PDF;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*FRONTEND */
Auth::routes(['verify' => true]);
/* Route::get('/mail', function () {
    return view('frontend.mail');
}); */
Route::put('/direccion/update/{id}', 'DireccionController@update')->middleware('auth')->name('update.direccion');
Route::delete('/direccion/delete/{id}', 'DireccionController@destroy')->middleware('auth')->name('delete.direccion');
Route::delete('/direccion/delete/facturacion/{id}', 'DireccionController@destroyFacturacion')->middleware('auth')->name('delete.direccion.facturacion');
Route::get('/contrasena/reset/{session}', 'ResetPassController@updatePassword')->name('pass.reset')->middleware('signed');
Route::get('/productos/filter/{search}', function () {
    //session(['categoria' => true]);
    return view('frontend.product');
})->name('bySearch');
Route::get('/productos/ofertas', function () {
    //session(['categoria' => true]);
    return view('frontend.product');
})->name('byOferta');
Route::get('/noscript', function () {
    return view('noscript');
})->name('noscript');
Route::get('/compras-about', function () {
    return view('frontend.compras');
})->name('compras.about');
Route::get('/faq', function () {
    return view('frontend.faq');
})->name('faq');
Route::get('/marcas', function () {
    $marcas = \DB::table('marcas')->where('estado', 1)->get(['nombre', 'imagen']); 
    return view('frontend.marcas')->with('marcas', $marcas);
})->name('marcas');
Route::get('/seguridad-y-politica', function () {
    return view('frontend.seguridadpolitica');
})->name('seguridadpolitica');
Route::get('/opiniones', function () {
    return view('frontend.opiniones');
})->name('opiniones');
Route::get('/cambiar/contraseña', 'ResetPassController@index');
Route::post('/cambiar/contraseña/send', 'ResetPassController@changePassword')->name('reset.pass.email');
Route::put('/contraseña/update/{email}', 'ResetPassController@resetPassword')->name('restore.pass');

Route::put('/contraseña', 'Auth\AuthResetController@restore')->name('restore.pass.auth')->middleware('auth');
Route::get('/restore/contraseña', function () {
    return view('frontend.restore_auth');
})->middleware('auth');

Route::get('/sobre-nosotros', function () {
    return view('frontend.about');
});

Route::get('/ubicacion', function () {
    return view('frontend.ubicacion');
});


Route::get('/', function () {
    $trending = Inventario::join('productos', 'inventarios.id_producto', '=', 'productos.id')
        ->join('categorias', 'productos.id_categoria', '=', 'categorias.id')
        ->join('ofertas', 'inventarios.id_oferta', '=', 'ofertas.id')
        ->join('tipos_ofertas', 'ofertas.id_tipo_oferta', '=', 'tipos_ofertas.id')
        ->select('inventarios.*', 'productos.nombre', 'productos.imagen', 'categorias.nombre as categoria', 'ofertas.nombre as oferta', 'ofertas.tiempo_limite', 'productos.descripcion', 
        'tipos_ofertas.nombre as tipo_oferta', 'ofertas.estado as state')->where('inventarios.estado','=',1)->latest()->limit(8)->get();
    return view('frontend.home')->with('trending', $trending);
})->name('inicio');
Route::get('/about', function () {
    return view('frontend.about');
});
/* Route::get('/productos', function () {
    return view('frontend.product');
}); */
Route::get('/test', 'IndexController@index');
Route::get('/productos', 'ProductController@index')->name('productos');
Route::get('/test/{categoria_id}', 'ProductController@show');
Route::get('/productos/{categoria}', function () {
    session(['categoria' => true]);
    return view('frontend.product');
})->name('categoria');

Route::get('/detalle/{id}', 'ReviewController@index')->name('detalle');

Route::get('/carrito', function () {
    return view('frontend.cart');
})->name('carrito');
/* Route::get('/checkout', function () {
    $direcciones = Direccion::where('direcciones.id_user', auth()->user()->id)
    ->join('municipios', 'direcciones.id_municipio', '=', 'municipios.id')
    ->join('departamentos', 'municipios.id_departamento', '=', 'departamentos.id')
    ->join('users', 'direcciones.id_user', '=', 'users.id')
    ->select('departamentos.nombre as departamento', 'municipios.nombre as municipio', 'users.name as user', 'direcciones.firts_name', 'direcciones.last_name', 'direcciones.email', 'direcciones.telefono')
    ->get();

    return view('frontend.checkout')->with('direcciones', $direcciones);
}); */
Route::get('/contacto', function () {
    return view('frontend.contact');
});
Route::get('/preguntas-frecuentes', function () {
    return view('frontend.question');
});

Route::get('/login', function () {
    return view('frontend.login');
});
Route::get('/registro', function () {
    return view('frontend.register');
});
Route::get('/error', function () {
    return view('frontend.404');
});
Route::get('/mail', function () {
    return view('frontend.mail');
});


Route::post('/ventas/save','VentaController@store');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/* Route::get('/profile', function () {
    return view('frontend.profile');
})->name('profile')->middleware('auth'); */

Route::group(['namespace' => 'Auth', 'prefix' => 'profile', 'middleware' => 'auth'], function () {

    Route::get('/', 'ProfileController@index')->name('profile');

    Route::put('/{id}/update', 'ProfileController@update')->name('profile.update');
});

Route::post('review_store', 'ReviewController@store')->middleware('auth')->name('review');
Route::put('review_store/{id}', 'ReviewController@update')->middleware('auth')->name('review.update');
Route::delete('review_store/{id}', 'ReviewController@destroy')->middleware('auth')->name('review.delete');

Route::get('/checkout', function () {
    $direcciones = Direccion::where('direcciones.id_user', auth()->user()->id)
    ->join('municipios', 'direcciones.id_municipio', '=', 'municipios.id')
    ->join('departamentos', 'municipios.id_departamento', '=', 'departamentos.id')
    ->join('users', 'direcciones.id_user', '=', 'users.id')
    ->select('departamentos.nombre as departamento', 'municipios.nombre as municipio', 'users.name as user', 'direcciones.first_name', 'direcciones.last_name', 
    'direcciones.email', 'direcciones.telefono', 'direcciones.direccion', 'direcciones.id', 'direcciones.facturacion', 'direcciones.referencia', 'direcciones.referencia_facturacion', 'departamentos.id as id_departamento', 'municipios.id as id_municipio')
    ->get();

    $facturaciones = Facturacion::where('direcciones_facturaciones.id_user', auth()->user()->id)->join('municipios', 'direcciones_facturaciones.id_municipio', '=', 'municipios.id')
    ->join('departamentos', 'municipios.id_departamento', '=', 'departamentos.id')->select('departamentos.nombre as departamento', 'municipios.nombre as municipio', 'direcciones_facturaciones.direccion',
    'direcciones_facturaciones.referencia', 'direcciones_facturaciones.id')->get();

    $metodos_pagos = MetodoPago::get();

    return view('frontend.checkout')->with('direcciones', $direcciones)->with('metodos_pagos', $metodos_pagos)->with('facturaciones', $facturaciones);
})->middleware('auth')->name('checkout');

Route::post('/save/direccion', 'ProductController@store');
/*END FRONTEND */


/*BACKEND */
Route::prefix('admin')->middleware(['auth','typeuser'])->group(function () {
    Route::get('/inicio','IndexController@index');
   Route::post('/venta/fecha','IndexController@ventaxfecha');
    /*Marcas */
    Route::get('/marcas','MarcaController@index');
    Route::get('/marcas/add','MarcaController@create');
    Route::post('/marcas/save','MarcaController@store');
    Route::get('/marcas/edit/{id}','MarcaController@edit');
    Route::put('/marcas/update/{id}','MarcaController@update');
    Route::delete('/marcas/delete/{id}','MarcaController@destroy');
    Route::get('/prueba','MarcaController@show');
    /*END Marcas */

    /*Categorias*/
    Route::get('/categorias','CategoriaController@index');
    Route::get('/categorias/edit/{id}','CategoriaController@edit');
    Route::get('/categorias/add','CategoriaController@create');
    Route::get('/categorias/subadd','CategoriaController@subcat');
    Route::post('/categorias/save','CategoriaController@store');
    Route::put('/categorias/update/{id}','CategoriaController@update');
    Route::post('/categorias/subsave','CategoriaController@savesubcat');
    Route::get('/categorias/select','CategoriaController@selectCategoria');
    Route::delete('/categorias/delete/{id}','CategoriaController@destroy');
    /*END Categorias*/

    /*PROVEEDORES */
    Route::get('/proveedores','ProveedorController@index');
    Route::get('/proveedores/edit/{id}','ProveedorController@edit');
    Route::get('/proveedores/add','ProveedorController@create');
    Route::post('/proveedores/save','ProveedorController@store');
    Route::put('/proveedores/update/{id}','ProveedorController@update');
    Route::delete('/proveedores/delete/{id}','ProveedorController@destroy');
    /*END PROVEEDORES */

    /*PRODUCTOS */
    Route::get('/productos','ProductoController@index');
    Route::get('/productos/edit/{id}','ProductoController@edit');
    Route::get('/productos/add','ProductoController@create');
    Route::post('/productos/save','ProductoController@store');
    Route::put('/productos/update/{id}','ProductoController@update');
    Route::delete('/productos/delete/{id}','ProductoController@destroy');
    Route::get('/productos/selectp','ProductoController@selectproveedor');
    Route::get('/productos/selectm','ProductoController@selectmarca');
    Route::get('/productos/selectsub','ProductoController@selectsubcat');
    /*END PRODUCTOS */

    /*TIPOS OFERTAS */
    Route::get('/ofertas','OfertaController@index');
    Route::get('/ofertas/edit/{id}','OfertaController@edit');
    Route::get('/ofertas/add','OfertaController@create');
    Route::post('/ofertas/save','OfertaController@store');
    Route::put('/ofertas/update/{id}','OfertaController@update');
    Route::delete('/ofertas/delete/{id}','OfertaController@destroy');
    Route::get('/ofertas/select','OfertaController@selectTipoOferta');


    /*TIPOS OFERTAS */
    Route::get('/ofertas/tipos/add','OfertaController@createType');
    Route::post('/ofertas/tipos/save','OfertaController@saveType');
    Route::get('/ofertas/tipos/edit/{id}','OfertaController@editType');
    Route::put('/ofertas/tipos/update/{id}','OfertaController@updateType');
    Route::delete('/ofertas/tipos/delete/{id}','OfertaController@destroyType');
    /*END TIPOS OFERTAS */
    /*END OFERTAS */

    /*INVENTARIOS*/
    Route::get('/inventarios','InventarioController@index');
    Route::get('/inventarios/edit/{id}','InventarioController@edit');
    Route::get('/inventarios/add','InventarioController@create');
    Route::post('/inventarios/save','InventarioController@store');
    Route::put('/inventarios/update/{id}','InventarioController@update');
    Route::delete('/inventarios/delete/{id}','InventarioController@destroy');
    Route::get('/inventarios/selectp','InventarioController@selectproducto');
    Route::get('/inventarios/selecto','InventarioController@selectoferta');
    Route::get('/inventarios/notificacion/{id}/{type}','InventarioController@notify');
    Route::get('/inventarios/detail/{id}','InventarioController@detail');
    Route::get('/inventarios/historial/{id}','InventarioController@historial');


    /*END INVENTARIOS */


    /*TEST */
    Route::get('/test','IndexController@test');
    /*END TEST */

    /*METODOS DE PAGO */   
    Route::get('/metodos_pagos','MetodoPagoController@index');
    Route::get('/metodos_pagos/edit/{id}', 'MetodoPagoController@edit');
    Route::put('/metodos_pagos/update/{id}','MetodoPagoController@update');
    Route::get('/metodos_pagos/add','MetodoPagoController@create');
    Route::post('/metodos_pagos/save','MetodoPagoController@store');
    Route::delete('/metodos_pagos/delete/{id}', 'MetodoPagoController@destroy');
    /* END DE METODOS DE PAGO*/


    /*VENTAS BACKEND*/
    Route::get('/ventas','VentaController@index');
    Route::get('/ventas/detalle/{id}', 'VentaController@show');
    Route::get('/ventas/manual/{id}', 'VentaController@manual');
    Route::put('/ventas/manual/update/{id}', 'VentaController@manualupd');
    Route::get('/ventas/notificacion/{id}/{type}', 'VentaController@notify');
    Route::put('/ventas/detalle/verificacion/{id}','VentaController@update');
    Route::post('/ventas/enviar/mail','VentaController@mailuser');
    Route::post('/ventas/pdf','VentaController@printPDF');
   
    Route::get('/test','PedidoProveedorController@test');
    /*END VENTAS BACKEND */


    /*PEDIDOS PROVEEDORES*/
    Route::get('/pedidos','PedidoProveedorController@index');
    Route::get('/pedidos/edit/{id}','PedidoProveedorController@edit');
    Route::put('/pedidos/update/{id}','PedidoProveedorController@update');
    Route::post('/pedidos/pdf','PedidoProveedorController@pdf');   
    /*END PEDIDOS PROVEEDORES*/
});

/*END BACKEND */

Route::post('/wishlist', 'WishListController@store')->name('wishlist.store');
Route::get('/get', 'WishListController@index')->name('wishlist');
