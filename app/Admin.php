<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Carbon\Carbon;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $table = 'admins';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','email','role','password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function logs(){
        return $this->hasMany('App\Logs','emp_id','id');
    }

    public function isAdmin(){
        if(\Auth::user()->role == 'admin'){
            return true;
        }
        else{
            return false;
        }
    }

    public function isGod(){
        if(\Auth::user()->role == 'god'){
            return true;
        }
        else{
            return false;
        }
    }

    public function isSpectator(){
        if(\Auth::user()->role == 'spectator'){
            return true;
        }
        else{
            return false;
        }
    }

    public function authorized(){
        if(\Auth::user()->role == 'god' || \Auth::user()->role == 'admin' || \Auth::user()->role == 'spectator'){
            return true;
        }
        else{
            return false;
        }
    }
}
