<?php

namespace App\Models\API;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class EventUserAPI extends Authenticatable
{
    use HasApiTokens, Notifiable, HasRoles;

    protected $table = "event_user";
    protected $guarded = [];
    public $timestamps = false;


}
