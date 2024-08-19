<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    //sử dụng fillable để bảo vệ dữ liệu và đc phép insert vào db
    protected $fillable = [
        'name',
        'parent_id',
        'slug',
    ];
}
