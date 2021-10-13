<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Jenssegers\Mongodb\Auth\User as Authenticatable;
use Jenssegers\Mongodb\Eloquent\Model;

class User extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

//    protected $primaryKey = 'id';
//    protected $connection = 'mongodb';
//    protected $collection = 'laravel-vue-db';
//    protected $guarded=[];
    public $fillable = [
        'id',
        '_id',
        'name',
        'email'
    ];

}
