<?php



namespace Database\Seeders;



use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class SeederUserAdmin extends Seeder

{
  /**

   * Run the database seeds.

   *

   * @return void

   */

  public function run(){

    $user = User::create([

      'name'   => 'Admin',

      'email'  => 'admin@admin.com',

      'password' => bcrypt('12345678')

    ]);


    $permissions = Permission::pluck('id', 'id')->all();

    $role = Role::create([

      'name' => 'Admininstrador',
    ]);

    $role->syncPermissions($permissions);

    $user->assignRole([$role=>id]);
  }

}
