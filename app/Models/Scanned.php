<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scanned extends Model
{
    use HasFactory;
    protected $table = "scanneds";
    protected $guarded = [];
}
