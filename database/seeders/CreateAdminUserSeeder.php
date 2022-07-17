<?php

namespace Database\Seeders;

use App\Models\Major;
use App\Models\StudentGroup;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
        	'first_name' => 'Kemhout', 
            'last_name' => 'Lem', 
        	'email' => 'admin@gmail.com',
        	'password' => bcrypt('123456')
        ]);
        
        $role = Role::create(['name' => 'Student']);
        $role = Role::create(['name' => 'Admin']);

        //$major = Major::create(['full_name' => 'All',
        //'short_name' => 'All']);
        $permissions = Permission::pluck('id','id')->all();  
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);
        
    }
}
