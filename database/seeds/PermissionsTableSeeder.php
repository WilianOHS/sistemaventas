<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create([
            'name'=>'Navegar usuarios',
            'slug'=>'users.index',
            'description'=>'Lista y navega por todos los usuarios del sistema',
        ]);
        Permission::create([
            'name'=>'Ver detalle de usuario',
            'slug'=>'users.show',
            'description'=>'Ve en detalle cada usuario del sistema',
        ]);
        Permission::create([
            'name'=>'Edición de usuarios',
            'slug'=>'users.edit',
            'description'=>'Editar cualquier dato de un  usuario del sistema',
        ]);
        Permission::create([
            'name'=>'Creación de usuarios',
            'slug'=>'users.create',
            'description'=>'Crear cualquier dato de un  usuario del sistema',
        ]);
        Permission::create([
            'name'=>'Eliminar usuarios',
            'slug'=>'users.destroy',
            'description'=>'Eliminar cualquier dato de un  usuario del sistema',
        ]);
        
        Permission::create([
            'name'=>'Navegar roles',
            'slug'=>'roles.index',
            'description'=>'Lista y navega por todos los roles del sistema',
        ]);
        Permission::create([
            'name'=>'Ver detalle de rol',
            'slug'=>'roles.show',
            'description'=>'Ver en detalle cada rol del sistema',
        ]);
        Permission::create([
            'name'=>'Edición de roles',
            'slug'=>'roles.edit',
            'description'=>'Editar cualquier dato de un  rol del sistema',
        ]);
        Permission::create([
            'name'=>'Creación de roles',
            'slug'=>'roles.create',
            'description'=>'Crear cualquier dato de un  rol del sistema',
        ]);
        Permission::create([
            'name'=>'Eliminar roles',
            'slug'=>'roles.destroy',
            'description'=>'Eliminar cualquier dato de un  rol del sistema',
        ]);
        
        Permission::create([
            'name'=>'Navegar categorias',
            'slug'=>'categories.index',
            'description'=>'Lista y navega por todos las categorías del sistema',
        ]);
        Permission::create([
            'name'=>'Ver detalle de categoria',
            'slug'=>'categories.show',
            'description'=>'Ver en detalle cada categoría del sistema',
        ]);
        Permission::create([
            'name'=>'Edición de categorias',
            'slug'=>'categories.edit',
            'description'=>'Editar cualquier dato de un  categoría del sistema',
        ]);
        Permission::create([
            'name'=>'Creación de categorias',
            'slug'=>'categories.create',
            'description'=>'Crear cualquier dato de un  categoría del sistema',
        ]);
        Permission::create([
            'name'=>'Eliminar categorias',
            'slug'=>'categories.destroy',
            'description'=>'Eliminar cualquier dato de un  categoría del sistema',
        ]);
        Permission::create([
            'name'=>'Navegar clientes',
            'slug'=>'clients.index',
            'description'=>'Lista y navega por todos las clientes del sistema',
        ]);
        Permission::create([
            'name'=>'Ver detalle de cliente',
            'slug'=>'clients.show',
            'description'=>'Ver en detalle cada cliente del sistema',
        ]);
        Permission::create([
            'name'=>'Edición de clientes',
            'slug'=>'clients.edit',
            'description'=>'Editar cualquier dato de un  cliente del sistema',
        ]);
        Permission::create([
            'name'=>'Creación de clientes',
            'slug'=>'clients.create',
            'description'=>'Crear cualquier dato de un  cliente del sistema',
        ]);
        Permission::create([
            'name'=>'Eliminar clientes',
            'slug'=>'clients.destroy',
            'description'=>'Eliminar cualquier dato de un  cliente del sistema',
        ]);
        Permission::create([
            'name'=>'Navegar productos',
            'slug'=>'products.index',
            'description'=>'Lista y navega por todos los productos del sistema',
        ]);
        Permission::create([
            'name'=>'Ver detalle de producto',
            'slug'=>'products.show',
            'description'=>'Ver en detalle cada producto del sistema',
        ]);
        Permission::create([
            'name'=>'Edición de productos',
            'slug'=>'products.edit',
            'description'=>'Editar cualquier dato de un  producto del sistema',
        ]);
        Permission::create([
            'name'=>'Creación de productos',
            'slug'=>'products.create',
            'description'=>'Crear cualquier dato de un  producto del sistema',
        ]);
        Permission::create([
            'name'=>'Eliminar productos',
            'slug'=>'products.destroy',
            'description'=>'Eliminar cualquier dato de un  producto del sistema',
        ]);
        Permission::create([
            'name'=>'Navegar proveedores',
            'slug'=>'providers.index',
            'description'=>'Lista y navega por todos las proveedores del sistema',
        ]);
        Permission::create([
            'name'=>'Ver detalle de proveedor',
            'slug'=>'providers.show',
            'description'=>'Ver en detalle cada proveedor del sistema',
        ]);
        Permission::create([
            'name'=>'Edición de proveedores',
            'slug'=>'providers.edit',
            'description'=>'Editar cualquier dato de un  proveedor del sistema',
        ]);
        Permission::create([
            'name'=>'Creación de proveedores',
            'slug'=>'providers.create',
            'description'=>'Crear cualquier dato de un  proveedor del sistema',
        ]);
        Permission::create([
            'name'=>'Eliminar proveedores',
            'slug'=>'providers.destroy',
            'description'=>'Eliminar cualquier dato de un  proveedor del sistema',
        ]);
        Permission::create([
            'name'=>'Navegar compras',
            'slug'=>'purchases.index',
            'description'=>'Lista y navega por todos las compras del sistema',
        ]);
        Permission::create([
            'name'=>'Ver detalle de compra',
            'slug'=>'purchases.show',
            'description'=>'Ver en detalle cada compra del sistema',
        ]);
        Permission::create([
            'name'=>'Creación de compras',
            'slug'=>'purchases.create',
            'description'=>'Crear cualquier dato de un  compra del sistema',
        ]);
        Permission::create([
            'name'=>'Navegar ventas',
            'slug'=>'sales.index',
            'description'=>'Lista y navega por todos las ventas del sistema',
        ]);
        Permission::create([
            'name'=>'Ver detalle de venta',
            'slug'=>'sales.show',
            'description'=>'Ver en detalle cada venta del sistema',
        ]);
        Permission::create([
            'name'=>'Creación de ventas',
            'slug'=>'sales.create',
            'description'=>'Crear cualquier dato de un  venta del sistema',
        ]);
        Permission::create([
            'name'=>'Descargar PDF reporte de compras',
            'slug'=>'purchases.pdf',
            'description'=>'Puede descargar todos los reportes de las compras en PDF.',
        ]);
        Permission::create([
            'name'=>'Descargar PDF reporte de ventas',
            'slug'=>'sales.pdf',
            'description'=>'Puede descargar todos los reportes de las ventas en PDF.',
        ]);
        Permission::create([
            'name'=>'Imprimir boleta de venta',
            'slug'=>'sales.print',
            'description'=>'Puede imprimir boletas de todas las ventas.',
        ]);
        Permission::create([
            'name'=>'Ver datos de la empresa',
            'slug'=>'business.index',
            'description'=>'Navega por los datos de la empresa.',
        ]);
        Permission::create([
            'name'=>'Edición de la empresa',
            'slug'=>'business.edit',
            'description'=>'Editar cualquier dato de la empresa.',
        ]);
        Permission::create([
            'name'=>'Ver datos de la impresora',
            'slug'=>'printers.index',
            'description'=>'Navega por los datos de la impresora.',
        ]);
        Permission::create([
            'name'=>'Edición de la impresora',
            'slug'=>'printers.edit',
            'description'=>'Editar cualquier dato de la impresora.',
        ]);
        Permission::create([
            'name'=>'Subir archivo de compra',
            'slug'=>'upload.purchases',
            'description'=>'Puede subir comprobantes de una compra.',
        ]);
        Permission::create([
            'name'=>'Cambiar estado de producto',
            'slug'=>'change.status.products',
            'description'=>'Permite cambiar el estado de un producto.',
        ]);
        Permission::create([
            'name'=>'Cambiar estado de compra',
            'slug'=>'change.status.purchases',
            'description'=>'Permite cambiar el estado de un compra.',
        ]);
        Permission::create([
            'name'=>'Cambiar estado de venta',
            'slug'=>'change.status.sales',
            'description'=>'Permite cambiar el estado de un venta.',
        ]);
        Permission::create([
            'name'=>'Reporte por día',
            'slug'=>'reports.day',
            'description'=>'Permite ver los reportes de ventas por día.',
        ]);
        Permission::create([
            'name'=>'Reporte por fechas',
            'slug'=>'reports.date',
            'description'=>'Permite ver los reportes de ventas por fechas.',
        ]);
    }
}
