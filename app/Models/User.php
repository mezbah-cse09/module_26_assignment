<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    public function isAdmin()
    {
        return $this->role === 'Admin';
    }

    public function isCustomer()
    {
        return $this->role === 'Customer';
    }

    public function rentals(){
        return $this->hasMany(Rental::class,'user_id');
    }


    //use in controller 
    
    // $user = User::find($userId);

    // if ($user->isAdmin()) {
    //     return view('admin.dashboard');
    // } elseif ($user->isCustomer()) {
    //     return view('customer.dashboard');
    // }

}
