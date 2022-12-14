<?php

namespace App\Models\API;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class UserAPI extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = "users";
    protected $guarded = [];
    public $timestamps = false;

    public function events()
    {
        return $this->belongsToMany(EventAPI::class);
    }

}
