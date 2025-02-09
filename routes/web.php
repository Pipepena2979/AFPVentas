<?php

use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('adminlte::auth.login');
});

FacadesAuth::routes();

Route::get('/home', [App\Http\Controllers\AdminController::class, 'index'])->name('home');

Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index')->middleware('auth');

Route::get('/crear-empresa', [App\Http\Controllers\EmpresaController::class, 'create'])->name('admin.empresas.create');
Route::get('/crear-empresa/pais/{id_pais}', [App\Http\Controllers\EmpresaController::class, 'buscar_depto'])->name('admin.empresas.buscar_depto');
Route::get('/crear-empresa/depto/{id_departamento}', [App\Http\Controllers\EmpresaController::class, 'buscar_cuidad'])->name('admin.empresas.buscar_cuidad');
Route::post('/crear-empresa/create', [App\Http\Controllers\EmpresaController::class, 'store'])->name('admin.empresas.store');

// RUTAS PARA LAS CONFIGURACIONES //
Route::get('/admin/configuracion', [App\Http\Controllers\EmpresaController::class, 'edit'])->name('admin.configuracion.edit')->middleware('auth','can:Configuracion del Sistema');
Route::get('/admin/configuracion/pais/{id_pais}', [App\Http\Controllers\EmpresaController::class, 'buscar_depto'])->name('admin.empresas.edit.buscar_depto');
Route::get('/admin/configuracion/depto/{id_departamento}', [App\Http\Controllers\EmpresaController::class, 'buscar_cuidad'])->name('admin.empresas.edit.buscar_cuidad');
Route::put('/admin/configuracion/{id}', [App\Http\Controllers\EmpresaController::class, 'update'])->name('admin.configuracion.update');

// RUTAS PARA LOS ROLES //
Route::get('/admin/roles', [App\Http\Controllers\RolController::class, 'index'])->name('admin.roles.index')->middleware('auth', 'can:Listado de Roles');
Route::get('/admin/roles/reporte', [App\Http\Controllers\RolController::class, 'reporte'])->name('admin.roles.reporte')->middleware('auth', 'can:Ver Reporte de Roles');
Route::get('/admin/roles/create', [App\Http\Controllers\RolController::class, 'create'])->name('admin.roles.create')->middleware('auth', 'can:Registro de Roles');
Route::post('/admin/roles/create', [App\Http\Controllers\RolController::class, 'store'])->name('admin.roles.store')->middleware('auth');
Route::get('/admin/roles/{id}', [App\Http\Controllers\RolController::class, 'show'])->name('admin.roles.show')->middleware('auth', 'can:Ver datos del Rol');
Route::get('/admin/roles/{id}/edit', [App\Http\Controllers\RolController::class, 'edit'])->name('admin.roles.edit')->middleware('auth', 'can:Editar Rol');
Route::get('/admin/roles/{id}/asignar', [App\Http\Controllers\RolController::class, 'asignar'])->name('admin.roles.asignar')->middleware('auth');
Route::post('/admin/roles/asignar/{id}', [App\Http\Controllers\RolController::class, 'store_asignar'])->name('admin.roles.store_asignar')->middleware('auth');
Route::put('/admin/roles/{id}', [App\Http\Controllers\RolController::class, 'update'])->name('admin.roles.update')->middleware('auth');
Route::delete('/admin/roles/{id}', [App\Http\Controllers\RolController::class, 'destroy'])->name('admin.roles.destroy')->middleware('auth', 'can:Eliminar Rol');

// RUTAS PARA LOS PERMISOS //
Route::get('/admin/permisos', [App\Http\Controllers\PermisoController::class, 'index'])->name('admin.permisos.index')->middleware('auth', 'can:Listado de Permisos');
Route::get('/admin/permisos/create', [App\Http\Controllers\PermisoController::class, 'create'])->name('admin.permisos.create')->middleware('auth', 'can:Registro de Permisos');
Route::post('/admin/permisos/create', [App\Http\Controllers\PermisoController::class, 'store'])->name('admin.permisos.store')->middleware('auth');
Route::get('/admin/permisos/{id}', [App\Http\Controllers\PermisoController::class, 'show'])->name('admin.permisos.show')->middleware('auth', 'can:Ver datos del Permiso');
Route::get('/admin/permisos/{id}/edit', [App\Http\Controllers\PermisoController::class, 'edit'])->name('admin.permisos.edit')->middleware('auth', 'can:Editar Permiso');
Route::put('/admin/permisos/{id}', [App\Http\Controllers\PermisoController::class, 'update'])->name('admin.permisos.update')->middleware('auth');
Route::delete('/admin/permisos/{id}', [App\Http\Controllers\PermisoController::class, 'destroy'])->name('admin.permisos.destroy')->middleware('auth', 'can:Eliminar Permiso');

// RUTAS PARA LOS USUARIOS //
Route::get('/admin/usuarios', [App\Http\Controllers\UsuarioController::class, 'index'])->name('admin.usuarios.index')->middleware('auth', 'can:Listado de Usuarios');
Route::get('/admin/usuarios/reporte', [App\Http\Controllers\UsuarioController::class, 'reporte'])->name('admin.usuarios.reporte')->middleware('auth', 'can:Ver Reporte de Usuarios');
Route::get('/admin/usuarios/create', [App\Http\Controllers\UsuarioController::class, 'create'])->name('admin.usuarios.create')->middleware('auth', 'can:Registro de Usuarios');
Route::post('/admin/usuarios/create', [App\Http\Controllers\UsuarioController::class, 'store'])->name('admin.usuarios.store')->middleware('auth');
Route::get('/admin/usuarios/{id}', [App\Http\Controllers\UsuarioController::class, 'show'])->name('admin.usuarios.show')->middleware('auth', 'can:Ver datos del Usuario');
Route::get('/admin/usuarios/{id}/edit', [App\Http\Controllers\UsuarioController::class, 'edit'])->name('admin.usuarios.edit')->middleware('auth', 'can:Editar Usuario');
Route::put('/admin/usuarios/{id}', [App\Http\Controllers\UsuarioController::class, 'update'])->name('admin.usuarios.update')->middleware('auth');
Route::delete('/admin/usuarios/{id}', [App\Http\Controllers\UsuarioController::class, 'destroy'])->name('admin.usuarios.destroy')->middleware('auth', 'can:Eliminar Usuario');

// RUTAS PARA LAS CATEGORIAS //
Route::get('/admin/categorias', [App\Http\Controllers\CategoriaController::class, 'index'])->name('admin.categorias.index')->middleware('auth', 'can:Listado de Categorias');
Route::get('/admin/categorias/reporte', [App\Http\Controllers\CategoriaController::class, 'reporte'])->name('admin.categorias.reporte')->middleware('auth', 'can:Ver Reporte de las Categorias');
Route::get('/admin/categorias/create', [App\Http\Controllers\CategoriaController::class, 'create'])->name('admin.categorias.create')->middleware('auth', 'can:Registro de Categorias');
Route::post('/admin/categorias/create', [App\Http\Controllers\CategoriaController::class, 'store'])->name('admin.categorias.store')->middleware('auth');
Route::get('/admin/categorias/{id}', [App\Http\Controllers\CategoriaController::class, 'show'])->name('admin.categorias.show')->middleware('auth', 'can:Ver datos de la Categoria');
Route::get('/admin/categorias/{id}/edit', [App\Http\Controllers\CategoriaController::class, 'edit'])->name('admin.categorias.edit')->middleware('auth', 'can:Editar Categoria');
Route::put('/admin/categorias/{id}', [App\Http\Controllers\CategoriaController::class, 'update'])->name('admin.categorias.update')->middleware('auth');
Route::delete('/admin/categorias/{id}', [App\Http\Controllers\CategoriaController::class, 'destroy'])->name('admin.categorias.destroy')->middleware('auth', 'can:Eliminar Categoria');

// RUTAS PARA LOS PRODUCTOS //
Route::get('/admin/productos', [App\Http\Controllers\ProductoController::class, 'index'])->name('admin.productos.index')->middleware('auth', 'can:Listado de Productos');
Route::get('/admin/productos/reporte', [App\Http\Controllers\ProductoController::class, 'reporte'])->name('admin.productos.reporte')->middleware('auth', 'can:Ver Reporte de los Productos');
Route::get('/admin/productos/create', [App\Http\Controllers\ProductoController::class, 'create'])->name('admin.productos.create')->middleware('auth', 'can:Registro de Productos');
Route::post('/admin/productos/create', [App\Http\Controllers\ProductoController::class, 'store'])->name('admin.productos.store')->middleware('auth');
Route::get('/admin/productos/{id}', [App\Http\Controllers\ProductoController::class, 'show'])->name('admin.productos.show')->middleware('auth', 'can:Ver datos del Producto');
Route::get('/admin/productos/{id}/edit', [App\Http\Controllers\ProductoController::class, 'edit'])->name('admin.productos.edit')->middleware('auth', 'can:Editar Producto');
Route::put('/admin/productos/{id}', [App\Http\Controllers\ProductoController::class, 'update'])->name('admin.productos.update')->middleware('auth');
Route::delete('/admin/productos/{id}', [App\Http\Controllers\ProductoController::class, 'destroy'])->name('admin.productos.destroy')->middleware('auth', 'can:Eliminar Producto');

// RUTAS PARA LOS PROVEEDORES //
Route::get('/admin/proveedores', [App\Http\Controllers\ProveedorController::class, 'index'])->name('admin.proveedores.index')->middleware('auth', 'can:Listado de Proveedores');
Route::get('/admin/proveedores/reporte', [App\Http\Controllers\ProveedorController::class, 'reporte'])->name('admin.proveedores.reporte')->middleware('auth', 'can:Ver Reporte de Proveedores');
Route::get('/admin/proveedores/create', [App\Http\Controllers\ProveedorController::class, 'create'])->name('admin.proveedores.create')->middleware('auth', 'can:Registro de Proveedores');
Route::post('/admin/proveedores/create', [App\Http\Controllers\ProveedorController::class, 'store'])->name('admin.proveedores.store')->middleware('auth');
Route::get('/admin/proveedores/{id}', [App\Http\Controllers\ProveedorController::class, 'show'])->name('admin.proveedores.show')->middleware('auth', 'can:Ver datos del Proveedor');
Route::get('/admin/proveedores/{id}/edit', [App\Http\Controllers\ProveedorController::class, 'edit'])->name('admin.proveedores.edit')->middleware('auth', 'can:Editar Proveedor');
Route::put('/admin/proveedores/{id}', [App\Http\Controllers\ProveedorController::class, 'update'])->name('admin.proveedores.update')->middleware('auth');
Route::delete('/admin/proveedores/{id}', [App\Http\Controllers\ProveedorController::class, 'destroy'])->name('admin.proveedores.destroy')->middleware('auth', 'can:Eliminar Proveedor');

// RUTAS PARA LAS COMPRAS //
Route::get('/admin/compras', [App\Http\Controllers\CompraController::class, 'index'])->name('admin.compras.index')->middleware('auth', 'can:Listado de Compras');
Route::get('/admin/compras/reporte', [App\Http\Controllers\CompraController::class, 'reporte'])->name('admin.compras.reporte')->middleware('auth', 'can:Ver Reporte de Compras');
Route::get('/admin/compras/create', [App\Http\Controllers\CompraController::class, 'create'])->name('admin.compras.create')->middleware('auth', 'can:Registro de Compras');
Route::post('/admin/compras/create', [App\Http\Controllers\CompraController::class, 'store'])->name('admin.compras.store')->middleware('auth');
Route::get('/admin/compras/{id}', [App\Http\Controllers\CompraController::class, 'show'])->name('admin.compras.show')->middleware('auth', 'can:Ver datos de la Compra');
Route::get('/admin/compras/{id}/edit', [App\Http\Controllers\CompraController::class, 'edit'])->name('admin.compras.edit')->middleware('auth', 'can:Editar Compra');
Route::put('/admin/compras/{id}', [App\Http\Controllers\CompraController::class, 'update'])->name('admin.compras.update')->middleware('auth');
Route::delete('/admin/compras/{id}', [App\Http\Controllers\CompraController::class, 'destroy'])->name('admin.compras.destroy')->middleware('auth', 'can:Eliminar Compra');

// RUTAS PARA TMP_COMPRAS (COMPRAS TEMPORALES)/
Route::post('/admin/compras/create/tmp', [App\Http\Controllers\TmpCompraController::class, 'tmp_compras'])->name('admin.compras.tmp_compras')->middleware('auth');
Route::delete('/admin/compras/create/tmp/{id}', [App\Http\Controllers\TmpCompraController::class, 'destroy'])->name('admin.compras.tmp_compras.destroy')->middleware('auth');

// RUTAS PARA EL DETALLE DE LAS COMPRAS //
Route::post('/admin/compras/detalle/create', [App\Http\Controllers\DetalleCompraController::class, 'store'])->name('admin.compras.detalle.store')->middleware('auth');
Route::delete('/admin/compras/detalle/{id}', [App\Http\Controllers\DetalleCompraController::class, 'destroy'])->name('admin.compras.detalle.destroy')->middleware('auth');

// RUTAS PARA LOS CLIENTES //
Route::get('/admin/clientes', [App\Http\Controllers\ClienteController::class, 'index'])->name('admin.clientes.index')->middleware('auth', 'can:Listado de Clientes');
Route::get('/admin/clientes/reporte', [App\Http\Controllers\ClienteController::class, 'reporte'])->name('admin.clientes.reporte')->middleware('auth', 'can:Ver Reporte de Clientes');
Route::get('/admin/clientes/create', [App\Http\Controllers\ClienteController::class, 'create'])->name('admin.clientes.create')->middleware('auth', 'can:Registro de Clientes');
Route::post('/admin/clientes/create', [App\Http\Controllers\ClienteController::class, 'store'])->name('admin.clientes.store')->middleware('auth');
Route::get('/admin/clientes/{id}', [App\Http\Controllers\ClienteController::class, 'show'])->name('admin.clientes.show')->middleware('auth', 'can:Ver datos del Cliente');
Route::get('/admin/clientes/{id}/edit', [App\Http\Controllers\ClienteController::class, 'edit'])->name('admin.clientes.edit')->middleware('auth', 'can:Editar Cliente');
Route::put('/admin/clientes/{id}', [App\Http\Controllers\ClienteController::class, 'update'])->name('admin.clientes.update')->middleware('auth');
Route::delete('/admin/clientes/{id}', [App\Http\Controllers\ClienteController::class, 'destroy'])->name('admin.clientes.destroy')->middleware('auth', 'can:Eliminar Cliente');

// RUTAS PARA LAS VENTAS //
Route::get('/admin/ventas', [App\Http\Controllers\VentaController::class, 'index'])->name('admin.ventas.index')->middleware('auth', 'can:Listado de Ventas');
Route::get('/admin/ventas/reporte', [App\Http\Controllers\VentaController::class, 'reporte'])->name('admin.ventas.reporte')->middleware('auth', 'can:Ver Reporte de Ventas');
Route::get('/admin/ventas/create', [App\Http\Controllers\VentaController::class, 'create'])->name('admin.ventas.create')->middleware('auth', 'can:Crear Venta');
Route::post('/admin/ventas/create', [App\Http\Controllers\VentaController::class, 'store'])->name('admin.ventas.store')->middleware('auth');
Route::get('/admin/ventas/pdf/{id}', [App\Http\Controllers\VentaController::class, 'pdf'])->name('admin.ventas.pdf')->middleware('auth', 'can:Imprimir Factura Venta');
Route::get('/admin/ventas/{id}', [App\Http\Controllers\VentaController::class, 'show'])->name('admin.ventas.show')->middleware('auth', 'can:Ver datos de la Venta');
Route::get('/admin/ventas/{id}/edit', [App\Http\Controllers\VentaController::class, 'edit'])->name('admin.ventas.edit')->middleware('auth', 'can:Editar Venta');
Route::put('/admin/ventas/{id}', [App\Http\Controllers\VentaController::class, 'update'])->name('admin.ventas.update')->middleware('auth');
Route::delete('/admin/ventas/{id}', [App\Http\Controllers\VentaController::class, 'destroy'])->name('admin.ventas.destroy')->middleware('auth', 'can:Eliminar Venta');

// RUTAS PARA TMP_VENTAS (VENTAS TEMPORALES)/
Route::post('/admin/ventas/create/tmp', [App\Http\Controllers\TmpVentaController::class, 'tmp_ventas'])->name('admin.ventas.tmp_ventas')->middleware('auth');
Route::delete('/admin/ventas/create/tmp/{id}', [App\Http\Controllers\TmpVentaController::class, 'destroy'])->name('admin.ventas.tmp_ventas.destroy')->middleware('auth');

// RUTAS PARA EL DETALLE DE LAS VENTAS //
Route::post('/admin/ventas/detalle/create', [App\Http\Controllers\DetalleVentaController::class, 'store'])->name('admin.ventas.detalle.store')->middleware('auth');
Route::delete('/admin/ventas/detalle/{id}', [App\Http\Controllers\DetalleVentaController::class, 'destroy'])->name('admin.ventas.detalle.destroy')->middleware('auth');

// RUTAS PARA LOS ARQUEOS DE CAJA //
Route::get('/admin/arqueos', [App\Http\Controllers\ArqueoCajaController::class, 'index'])->name('admin.arqueos.index')->middleware('auth', 'can:Listado de Arqueos de Caja');
Route::get('/admin/arqueos/reporte', [App\Http\Controllers\ArqueoCajaController::class, 'reporte'])->name('admin.arqueos.reporte')->middleware('auth', 'can:Ver Reporte de Arqueos de Caja');
Route::get('/admin/arqueos/create', [App\Http\Controllers\ArqueoCajaController::class, 'create'])->name('admin.arqueos.create')->middleware('auth', 'can:Crear Arqueo de Caja');
Route::post('/admin/arqueos/create', [App\Http\Controllers\ArqueoCajaController::class, 'store'])->name('admin.arqueos.store')->middleware('auth');
Route::get('/admin/arqueos/{id}', [App\Http\Controllers\ArqueoCajaController::class, 'show'])->name('admin.arqueos.show')->middleware('auth', 'can:Ver datos del Arqueo de Caja');
Route::get('/admin/arqueos/{id}/edit', [App\Http\Controllers\ArqueoCajaController::class, 'edit'])->name('admin.arqueos.edit')->middleware('auth', 'can:Editar Arqueo de Caja');
Route::get('/admin/arqueos/{id}/ingreso-egreso', [App\Http\Controllers\ArqueoCajaController::class, 'ingreso_egreso'])->name('admin.arqueos.ingreso_egreso')->middleware('auth', 'can:Crear Ingreso - Egreso Arqueo de Caja');
Route::post('/admin/arqueos/create_ingreso-egreso', [App\Http\Controllers\ArqueoCajaController::class, 'store_ingreso_egreso'])->name('admin.arqueos.store_ingreso_egreso')->middleware('auth');
Route::get('/admin/arqueos/{id}/cierre', [App\Http\Controllers\ArqueoCajaController::class, 'cierre'])->name('admin.arqueos.cierre')->middleware('auth', 'can:Cierre de Arqueo de Caja');
Route::post('/admin/arqueos/create_cierre', [App\Http\Controllers\ArqueoCajaController::class, 'store_cierre'])->name('admin.arqueos.store_cierre')->middleware('auth');
Route::put('/admin/arqueos/{id}', [App\Http\Controllers\ArqueoCajaController::class, 'update'])->name('admin.arqueos.update')->middleware('auth');
Route::delete('/admin/arqueos/{id}', [App\Http\Controllers\ArqueoCajaController::class, 'destroy'])->name('admin.arqueos.destroy')->middleware('auth', 'can:Eliminar Arqueo de Caja');