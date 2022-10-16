<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions for admin
        Permission::create(['name' => 'admin home']);
        Permission::create(['name' => 'set employee']);
        Permission::create(['name' => 'set team']);
        Permission::create(['name' => 'set role']);
        Permission::create(['name' => 'mentoring']);
        Permission::create(['name' => 'monitoring']);
        Permission::create(['name' => 'set slider']);
        Permission::create(['name' => 'set competency']);

        // create permission for supervisor
        Permission::create(['name' => 'spv home']);
        Permission::create(['name' => 'coaching mentoring']);
        Permission::create(['name' => 'competency tools spv']);
        Permission::create(['name' => 'assesment chart']);

        // create permission for operator
        Permission::create(['name' => 'operator home']);
        Permission::create(['name' => 'competency tools operator']);
        Permission::create(['name' => 'competency score']);

        // create roles admin and assign existing permissions
        $role1 = Role::create(['name' => 'admin']);
        $role1->givePermissionTo('admin home');
        $role1->givePermissionTo('set employee');
        $role1->givePermissionTo('set team');
        $role1->givePermissionTo('set role');
        $role1->givePermissionTo('mentoring');
        $role1->givePermissionTo('monitoring');
        $role1->givePermissionTo('set slider');
        $role1->givePermissionTo('set competency');

        // create roles supervisor and assign permission to this roles
        $role2 = Role::create(['name' => 'supervisor']);
        $role2->givePermissionTo('spv home');
        $role2->givePermissionTo('coaching mentoring');
        $role2->givePermissionTo('competency tools spv');
        $role2->givePermissionTo('assesment chart');

        // create roles operator and assign permission to this roles
        $role3 = Role::create(['name' => 'operator']);
        // gets all permissions via Gate::before rule; see AuthServiceProvider
        $role3->givePermissionTo('operator home');
        $role3->givePermissionTo('competency tools operator');
        $role3->givePermissionTo('competency score');

        // create demo users
        $user = \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'phone' => '08112233445577',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('password'),
            'team_id' => 1
        ]);
        $user->assignRole($role1);

        $user = \App\Models\User::factory()->create([
            'name' => 'Supervisor',
            'email' => 'supervisor@gmail.com',
            'phone' => '08112233445566',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('password'),
            'team_id' => 2
        ]);
        $user->assignRole($role2);

        $user = \App\Models\User::factory()->create([
            'name' => 'Operator',
            'email' => 'operator@gmail.com',
            'phone' => '0823343441100',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('password'),
            'team_id' => 3
        ]);
        $user->assignRole($role3);
    }
}
