<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    protected $fillable = [
        'name', 'email', 'password','visible_password',
        'address','occupation','phone','is_admin'
    ];

    private $limit = 10;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function storeUser($data){
        $data['visible_password'] = $data['password'];
        $data['password'] = bcrypt($data['password']);
        $data['is_admin'] = 0;
        return User::create($data);
    }

    public function allUsers(){
        return User::latest()->paginate($this->limit);
    }

    public function findUser($id){
        return User::find($id);
    }

    public function updateUser($id,$data){
        $data['visible_password'] = $data['password'];
        $data['password'] = bcrypt($data['password']);
        return User::find($id)->fill($data)->save();
    }

    public function deleteUser($id){
        $user = User::find($id)->delete();
    }
}
