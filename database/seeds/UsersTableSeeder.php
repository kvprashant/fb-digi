<?php
 
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder {
 
    public function run()
    {
        Eloquent::unguard();

        DB::table('users')->delete();
 
        User::create(array(
            'username' => 'prashant',
            'email' => 'prashant@example.com',
            'password' => Hash::make('love6435')
        ));
 
        User::create(array(
            'username' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('4619love')
        ));
    }
 
}