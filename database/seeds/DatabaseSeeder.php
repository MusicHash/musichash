<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->setup();
        
        $this->call(UserTableSeeder::class);
        $this->call(AgentTableSeeder::class);
        
        $this->tearDown();
    }
    
    
    private function setup()
    {
        Model::unguard();
        
        // prevent foreign key check before seeders run - DEBUG ONLY
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
    }
    
    
    private function tearDown()
    {
        // revert
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        Model::reguard();
    }
}