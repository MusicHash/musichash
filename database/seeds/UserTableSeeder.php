<?php

use App\Models\User;
use App\Utils\Definitions;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    private $userTable = 'User';
    
    
    /**
     * Generates initial table data for User. Cleans up the table prior to adding.
     * Used only for development mode.
     *
     * @todo Prevent running if debug = false!
     * @return void
     */
    public function run()
    {
        DB::table($this->userTable)->truncate();
        
        $fbUserID = rand(1111111111, 9999999999);
        
        User::create([
            'userType' => Definitions::USER_TYPE_MEMBER,
            'fbID' => $fbUserID,
            'name' => 'Member Generated',
            'email' => 'member.generated@gmail-sample-777.com',
            'enabled' => true,
            'userHash' => md5($fbUserID)
        ]);
    }
}