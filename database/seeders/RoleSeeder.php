<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{

    public function run()
    {
        // Role: creación de roles
        $role1 = Role::create(['name' => 'Admin']);
        $role2 = Role::create(['name' => 'Usuario']);
        $role3 = Role::create(['name' => 'Despachador']);

        Permission::create(['name' => 'admin.home', 'description' => 'Ver Dashboard'])->syncRoles([$role1, $role2, $role3]);
        
        Permission::create(['name' => 'admin.backup.index', 'description' => 'Crear Backup'])->syncRoles([$role1]);
        
        //Permission::create(['name' => 'admin.panel', 'description' => 'Admin Panel'])->syncRoles([$role1]);

        // Permission: users
        Permission::create(['name' => 'admin.users.index', 'description' => 'Usuarios: Ver listado'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.users.edit', 'description' => 'Usuarios: Asignar un rol'])->syncRoles([$role1]);
        
        // Permission: roles
        Permission::create(['name' => 'admin.roles.index', 'description' => 'Roles: Ver listado'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.roles.create', 'description' => 'Roles: Crear'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.roles.edit', 'description' => 'Roles: Editar'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.roles.destroy', 'description' => 'Roles: Eliminar'])->syncRoles([$role1]);
        
        // Permission: centrotrabajos
        Permission::create(['name' => 'admin.centrotrabajos.index', 'description' => 'Centro de Trabajo: Ver listado'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.centrotrabajos.create', 'description' => 'Centro de Trabajo: Crear'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.centrotrabajos.edit', 'description' => 'Centro de Trabajo: Editar'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.centrotrabajos.destroy', 'description' => 'Centro de Trabajo: Eliminar'])->syncRoles([$role1]);
        
        // Permission: categories
        Permission::create(['name' => 'admin.categories.index', 'description' => 'Categorias: Ver listado'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.categories.create', 'description' => 'Categorias: Crear'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.categories.edit', 'description' => 'Categorias: Editar'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.categories.destroy', 'description' => 'Categorias: Eliminar'])->syncRoles([$role1]);
        
        // Permission: equipos
        Permission::create(['name' => 'admin.equipos.index', 'description' => 'Equipos: Ver listado'])->syncRoles([$role1, $role3]);
        Permission::create(['name' => 'admin.equipos.create', 'description' => 'Equipos: Crear'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.equipos.edit', 'description' => 'Equipos: Editar'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.equipos.destroy', 'description' => 'Equipos: Eliminar'])->syncRoles([$role1]);
        
        // Permission: marcas
        Permission::create(['name' => 'admin.marcas.index', 'description' => 'Marcas: Ver listado'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.marcas.create', 'description' => 'Marcas: Crear'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.marcas.edit', 'description' => 'Marcas: Editar'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.marcas.destroy', 'description' => 'Marcas: Eliminar'])->syncRoles([$role1]);
        
        // Permission: modelos
        Permission::create(['name' => 'admin.modelos.index', 'description' => 'Modelos: Ver listado'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.modelos.create', 'description' => 'Modelos: Crear'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.modelos.edit', 'description' => 'Modelos: Editar'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.modelos.destroy', 'description' => 'Modelos: Eliminar'])->syncRoles([$role1]);
        
        // Permission: equipos asignados
        Permission::create(['name' => 'admin.equiposcon.index', 'description' => 'Equipos Asignados: Ver listado'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'admin.equiposcon.create', 'description' => 'Equipos Asignados: Editar'])->syncRoles([$role1, $role2, $role3]);
        
        // Permission: equipos no asignados
        Permission::create(['name' => 'admin.equipossin.index', 'description' => 'Equipos No Asignados: Ver listado'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.equipossin.create', 'description' => 'Equipos No Asignados: Editar'])->syncRoles([$role1]);
        
        // Permission: reportes de equipos
        Permission::create(['name' => 'admin.equiposreportes.index', 'description' => 'Equipos Reportes: Ver listado'])->syncRoles([$role1, $role2, $role3]);
        
        // Permission: despachador
        Permission::create(['name' => 'admin.equiposdespachos.index', 'description' => 'Equipos despachador: Principal'])->syncRoles([$role1, $role3]);

    }
}
