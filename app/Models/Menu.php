<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use softDeletes;
    protected $guarded = [];
//    protected $fillable = [
//        'name',
//        'parent_id',
//        'slug',
//    ];
}
