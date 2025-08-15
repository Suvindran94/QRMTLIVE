<?php
namespace App;

use Illuminate\Notifications\Notifiable;
use Laravel\Scout\Searchable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class barcodelist extends Authenticatable
{
    use Notifiable;
    use Searchable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function searchableAs()
    {
        return 'users_index';
    }
}