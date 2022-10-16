<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $roles = [
        //     [
        //         'name' => 'Admin',
        //         'guard_name' => 'adm',
        //         'created_at' => Carbon::now(),
        //         'updated_at' => Carbon::now(),
        //     ],
        //     [
        //         'name' => 'Supervisor Senior',
        //         'guard_name' => 'spv_senior',
        //         'created_at' => Carbon::now(),
        //         'updated_at' => Carbon::now(),
        //     ],
        //     [
        //         'name' => 'Supervisor',
        //         'guard_name' => 'spv',
        //         'created_at' => Carbon::now(),
        //         'updated_at' => Carbon::now(),
        //     ],
        //     [
        //         'name' => 'Operator',
        //         'guard_name' => 'opr',
        //         'created_at' => Carbon::now(),
        //         'updated_at' => Carbon::now(),
        //     ]
        // ];
        // DB::table('roles')->insert($roles);
    }
}
