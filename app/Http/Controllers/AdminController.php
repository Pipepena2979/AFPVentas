<?php

namespace App\Http\Controllers;

use App\Models\ArqueoCaja;
use App\Models\Categoria;
use App\Models\Cliente;
use App\Models\Compra;
use App\Models\Empresa;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\User;
use App\Models\Venta;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    public function index() {

        $total_roles = Role::count();
        $total_usuarios = User::count();
        $total_categorias = Categoria::count();
        $total_productos = Producto::count();
        $total_proveedores = Proveedor::count();
        $total_compras = Compra::count();
        $total_clientes = Cliente::count();
        $total_ventas = Venta::count();
        $total_arqueosCaja = ArqueoCaja::count();
        $empresa_id = Auth::check() ? Auth::user()->empresa_id : redirect()->route('login')->send();
        $empresa = Empresa::where('id', $empresa_id)->first();

        // Datos para el gráfico de roles
        $roles = Role::withCount('users')->get();
        $labelsRoles = $roles->pluck('name')->toArray(); // Nombres de los roles
        $dataRoles = $roles->pluck('users_count')->toArray(); // Cantidad de usuarios por rol

        /* Datos para el gráfico de categorías */
        $categorias = Categoria::withCount('productos')->get();
        $labelsCategorias = $categorias->pluck('nombre')->toArray(); // Nombres de las categorias
        $dataCategorias = $categorias->pluck('productos_count')->toArray(); // Cantidad de productos por categoria

        /* Datos para el grafico de empresa */
        // Calcular el total general
        $totalGeneral = $total_compras + $total_ventas + $total_proveedores + $total_clientes + $total_arqueosCaja;

        // Calcular los porcentajes
        $porcentajeCompras = ($total_compras / $totalGeneral) * 100;
        $porcentajeVentas = ($total_ventas / $totalGeneral) * 100;
        $porcentajeProveedores = ($total_proveedores / $totalGeneral) * 100;
        $porcentajeClientes = ($total_clientes / $totalGeneral) * 100;
        $porcentajeArqueosCaja = ($total_arqueosCaja / $totalGeneral) * 100;

        // Estructurar los datos para el gráfico
        $dataEmpresa = [
            [
                'name' => 'Compras',
                'y' => $porcentajeCompras
            ],
            [
                'name' => 'Ventas',
                'y' => $porcentajeVentas
            ],
            [
                'name' => 'Proveedores',
                'y' => $porcentajeProveedores
            ],
            [
                'name' => 'Clientes',
                'y' => $porcentajeClientes
            ],
            [
                'name' => 'Arqueos de Caja',
                'y' => $porcentajeArqueosCaja
            ]
        ];

        return view('admin.index', compact('empresa', 'total_roles', 'total_usuarios', 'total_categorias', 'total_productos', 'total_proveedores', 'total_compras', 'total_clientes', 'total_ventas', 'total_arqueosCaja', 'labelsRoles', 'dataRoles', 'labelsCategorias', 'dataCategorias', 'dataEmpresa'));
    }
}
