<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\User;
use App\Models\Role;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
     
      // $permission = Permission::insert([
      //   ['name'=> 'View Role' , 'description'=> 'User can view role'],
      //   ['name'=> 'View User', 'description'=> 'User can view user'],
      //   ['name'=> 'View Todo', 'description'=> 'User can view todo']
      // ]);


        $role = Role::firstOrCreate([
            'name'=>'Admin',
        ]);

    
        // $role->permissions()->sync([1,2,3]);

        User::factory()->create([
            'name' => 'Super Stephanie',
            'email' => 'steph@gmail.com',
            'role_id'=> $role->id,
        ]);
    }
}
