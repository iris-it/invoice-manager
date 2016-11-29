<?php

use App\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the users seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->delete();
        $statement = "ALTER TABLE roles AUTO_INCREMENT = 1;";
        DB::unprepared($statement);
        Schema::disableForeignKeyConstraints();

        Role::create([
            'id' => '1',
            'name' => 'admin',
            'label' => 'Administrateur',
            'description' => 'Administrateur de l\'application'
        ]);

        Role::create([
            'id' => '2',
            'name' => 'manager',
            'label' => 'Manager',
            'description' => 'Manager d\'une organization'
        ]);

        Role::create([
            'id' => '3',
            'name' => 'user',
            'label' => 'Utilisateur',
            'description' => 'Utilisateur de l`\'application'
        ]);

    }
}