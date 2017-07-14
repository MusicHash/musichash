<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\User;

class CreateUserTable extends Migration
{
    private $tableName = 'User';
    
    /**
     * Creates the users table for the members
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->tableName)) return;
        
        Schema::create($this->tableName, function(Blueprint $table)
        {
            $table->increments('userID');
            $table->string('fbID', 32)->default('');
            $table->string('userHash', 32)->default('');
            $table->string('name', 255)->default('');
            $table->string('email', 255)->default('');
            $table->integer('userType');
            $table->dateTime('lastLogin')->default('0000-00-00 00:00:00');
            $table->boolean('enabled');
            $table->index('userHash');
            
            $table->timestamp(User::CREATED_AT);
            $table->timestamp(User::UPDATED_AT);
        });
        
    }
    
    
    /**
     * Rollback .. called when something went wrong.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop($this->tableName);
    }
}
