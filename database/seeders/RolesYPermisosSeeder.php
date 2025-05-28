<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RolesYPermisosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //resetear cache de roles y permisos
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        //ADMIN Y SECRE
        // admin: crea usuarios con cualquier rol
        $pAdminCrearUsuario = Permission::create(['name' => 'admin.crear_usuario']);
        // secre: crear usuario exepto admin
        $pScreCrearUsuario = Permission::create(['name' => 'secre.crear_usuario']);
        // admin ver todos los usuarios
        $pVerTodosUsuarios = Permission::create(['name' => 'admin.ver_todos_usuarios']);
        // secre ve una lista de usuarios
        $pVerListaUsuarios = Permission::create(['name' => 'secre.ver_lista_usuarios']);
        // BODEGA
        // bodega: crear y listar categorias y productos
        $pCrearCategoria = Permission::create(['name' => 'categoria.crear']);
        $pListarCategoria = Permission::create(['name' => 'categoria.listar']);
        $pCrearProducto = Permission::create(['name' => 'producto.crear']);
        $pListarProducto = Permission::create(['name' => 'producto.listar']);

        // VENTAS
        //cajera Crear ventas, seleccionar productos y cantidades. Ver listado de ventas propias.
        $pCrearventa = Permission::create(['name' => 'venta.crear']);
        $pVerVentasPropias = Permission::create(['name' => 'venta.ver_propias']);
        // admin: ver todas las ventas
        $pVerTodasLasVentas = Permission::create(['name' => 'venta.ver_todas']);
        
        // Crear roles y asignar permisos
        // Admin
        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo([
            $pAdminCrearUsuario,
            $pVerTodosUsuarios,
            $pVerTodasLasVentas,
        ]);

        // Secre
        $secreRole = Role::create(['name' => 'secre']);
        $secreRole->givePermissionTo([
            $pScreCrearUsuario,
            $pVerListaUsuarios
        ]);
        // Bodega
        $bodegaRole = Role::create(['name' => 'bodega']);
        $bodegaRole->givePermissionTo([
            $pCrearCategoria,
            $pListarCategoria,
            $pCrearProducto,
            $pListarProducto
        ]);
        // Cajera
        $cajeraRole = Role::create(['name' => 'cajera']);
        $cajeraRole->givePermissionTo([
            $pCrearventa,
            $pVerVentasPropias
        ]);
        
    }
}
