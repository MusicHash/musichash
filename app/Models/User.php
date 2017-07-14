<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

/**
 * User model class
 *
 * Represents the User states
 */
class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;
    
    const CREATED_AT = 'dateCreated';
    const UPDATED_AT = 'dateUpdated';
    
    protected $table = 'User';
    protected $primaryKey = 'userID';
    protected $guarded = ['userID', 'lastLogin'];
    protected $dates = ['dateCreated', 'dateUpdated', 'lastLogin'];
    
    
    /**
     * Finds user based on facebook userid.
     *
     * @param string $ID
     * @return User/null
     */
    public static function getByFB($ID)
    {
        return User::where('fbID', '=', $ID)->first();
    }
}