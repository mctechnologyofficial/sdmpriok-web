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

        // create permissions
        Permission::create(['name' => 'add employee']);
        Permission::create(['name' => 'edit employee']);
        Permission::create(['name' => 'add question']);
        Permission::create(['name' => 'edit question']);
        Permission::create(['name' => 'fill question']);
        Permission::create(['name' => 'give answer']);

        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'admin']);
        $role1->givePermissionTo('add employee');
        $role1->givePermissionTo('edit employee');

        $role2 = Role::create(['name' => 'supervisor']);
        $role2->givePermissionTo('add question');
        $role2->givePermissionTo('edit question');

        $role3 = Role::create(['name' => 'operator']);
        // gets all permissions via Gate::before rule; see AuthServiceProvider
        $role3->givePermissionTo('fill question');
        $role3->givePermissionTo('give answer');

        // create demo users
        $user = \App\Models\User::factory()->create([
            'name' => 'Admin example user',
            'email' => 'admin@example.com',
            'phone' => '08112233445577',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('password'),
            'role_id' => $role1->id,
            'team_id' => 1
        ]);
        $user->assignRole($role1);

        $user = \App\Models\User::factory()->create([
            'name' => 'Supervisor example user',
            'email' => 'supervisor@example.com',
            'phone' => '08112233445566',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('password'),
            'role_id' => $role1->id,
            'team_id' => 1
        ]);
        $user->assignRole($role2);

        $user = \App\Models\User::factory()->create([
            'name' => 'Example Operator User',
            'email' => 'operator@example.com',
            'phone' => '0823343441100',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('password'),
            'role_id' => $role1->id,
            'team_id' => 1
        ]);
        $user->assignRole($role3);
    }
}
