<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $tabel = "admins";
    protected $primaryKey = "id";
    protected $fillable = [
        'name',
        'username',
        'email',
        'image',
        'level',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
