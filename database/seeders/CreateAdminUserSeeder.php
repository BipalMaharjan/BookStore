<?php

namespace Database\Seeders;

use App\Models\Seller;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Customer;
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
            'name' => 'Test',
            'email' => 'test@gmail.com',
            'password' => bcrypt('test1234')
        ]);

        $role = Role::create(['name' => 'Admin']);
        $permissions = Permission::pluck('id','id')->all();
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);
        $role->revokePermissionTo('book-buy');

        $user = User::create([
            'name' => 'seller',
            'email' => 'seller@gmail.com',
            'password' => bcrypt('seller1234')
        ]);
        Seller::create([
            'user_id'=>$user->id,
            'shop_name'=>'shop',
            'commission'=>25.00,
        ]);

        $role = Role::create(['name' => 'Seller']);
        $role->givePermissionTo('book-list','book-create','book-edit','book-delete');
        $user->assignRole([$role->id]);

        $user = User::create([
            'name' => 'customer',
            'email' => 'customer@gmail.com',
            'password' => bcrypt('customer1234')
        ]);
        Customer::create([
            'user_id'=>$user->id
        ]);

        $role = Role::create(['name' => 'Customer']);
        $role->givePermissionTo('book-list','book-buy');

        $user->assignRole([$role->id]);

    }
}
