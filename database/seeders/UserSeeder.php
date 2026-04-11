<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder {
    public function run() {
        User::updateOrCreate(['email'=>'admin@selorejo.desa.id'], ['name'=>'Administrator', 'password'=>Hash::make('admin123'),'role'=>'admin']);
        User::updateOrCreate(['email'=>'operator@selorejo.desa.id'], ['name'=>'Operator Desa', 'password'=>Hash::make('operator123'),'role'=>'operator']);
    }
}
