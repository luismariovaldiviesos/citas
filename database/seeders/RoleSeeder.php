<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'administrador',
            'guard_name' => 'web',
        ]);

        Role::create([
            'name' => 'empleado',
            'guard_name' => 'web',
        ]);

        Role::create([
            'name' => 'visitante',
            'guard_name' => 'web',
        ]);


        // permisos citas

        Permission::create([
            'name' => 'crear_cita',
            'guard_name' => 'web',
        ]);
        Permission::create([
            'name' => 'ver_cita',
            'guard_name' => 'web',
        ]);
        Permission::create([
            'name' => 'buscar_cita',
            'guard_name' => 'web',
        ]);
        Permission::create([
            'name' => 'editar_cita',
            'guard_name' => 'web',
        ]);
        Permission::create([
            'name' => 'eliminar_cita',
            'guard_name' => 'web',
        ]);

        // permisos clinica

        Permission::create([
            'name' => 'crear_clinica',
            'guard_name' => 'web',
        ]);
        Permission::create([
            'name' => 'ver_clinica',
            'guard_name' => 'web',
        ]);
        Permission::create([
            'name' => 'buscar_clinica',
            'guard_name' => 'web',
        ]);
        Permission::create([
            'name' => 'editar_clinica',
            'guard_name' => 'web',
        ]);
        Permission::create([
            'name' => 'eliminar_clinica',
            'guard_name' => 'web',
        ]);
        // permisos estado

        Permission::create([
            'name' => 'crear_estado',
            'guard_name' => 'web',
        ]);
        Permission::create([
            'name' => 'ver_estado',
            'guard_name' => 'web',
        ]);
        Permission::create([
            'name' => 'buscar_estado',
            'guard_name' => 'web',
        ]);
        Permission::create([
            'name' => 'editar_estado',
            'guard_name' => 'web',
        ]);
        Permission::create([
            'name' => 'eliminar_estado',
            'guard_name' => 'web',
        ]);

        // permisos medico

        Permission::create([
            'name' => 'crear_medico',
            'guard_name' => 'web',
        ]);
        Permission::create([
            'name' => 'ver_medico',
            'guard_name' => 'web',
        ]);
        Permission::create([
            'name' => 'buscar_medico',
            'guard_name' => 'web',
        ]);
        Permission::create([
            'name' => 'editar_medico',
            'guard_name' => 'web',
        ]);
        Permission::create([
            'name' => 'eliminar_medico',
            'guard_name' => 'web',
        ]);

        // permisos pacientes

        Permission::create([
            'name' => 'crear_paciente',
            'guard_name' => 'web',
        ]);
        Permission::create([
            'name' => 'ver_paciente',
            'guard_name' => 'web',
        ]);
        Permission::create([
            'name' => 'buscar_paciente',
            'guard_name' => 'web',
        ]);
        Permission::create([
            'name' => 'editar_paciente',
            'guard_name' => 'web',
        ]);
        Permission::create([
            'name' => 'eliminar_paciente',
            'guard_name' => 'web',
        ]);

         // permisos pago

         Permission::create([
            'name' => 'crear_pago',
            'guard_name' => 'web',
        ]);
        Permission::create([
            'name' => 'ver_pago',
            'guard_name' => 'web',
        ]);
        Permission::create([
            'name' => 'buscar_pago',
            'guard_name' => 'web',
        ]);
        Permission::create([
            'name' => 'editar_pago',
            'guard_name' => 'web',
        ]);
        Permission::create([
            'name' => 'eliminar_pago',
            'guard_name' => 'web',
        ]);

        // permisos tratamiento

        Permission::create([
            'name' => 'crear_tratamiento',
            'guard_name' => 'web',
        ]);
        Permission::create([
            'name' => 'ver_tratamiento',
            'guard_name' => 'web',
        ]);
        Permission::create([
            'name' => 'buscar_tratamiento',
            'guard_name' => 'web',
        ]);
        Permission::create([
            'name' => 'editar_tratamiento',
            'guard_name' => 'web',
        ]);
        Permission::create([
            'name' => 'eliminar_tratamiento',
            'guard_name' => 'web',
        ]);

        // permisos usuario

        Permission::create([
            'name' => 'crear_usuario',
            'guard_name' => 'web',
        ]);
        Permission::create([
            'name' => 'ver_usuario',
            'guard_name' => 'web',
        ]);
        Permission::create([
            'name' => 'buscar_usuario',
            'guard_name' => 'web',
        ]);
        Permission::create([
            'name' => 'editar_usuario',
            'guard_name' => 'web',
        ]);
        Permission::create([
            'name' => 'eliminar_usuario',
            'guard_name' => 'web',
        ]);


    }
}
