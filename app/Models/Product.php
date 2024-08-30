<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id');//hasMany là quan hệ 1-n với bảng product_images với khóa ngoại là product_id
    }
    public function tags()
    {
        return $this
            ->belongsToMany(Tag::class, 'product_tags', 'product_id', 'tag_id')//belongsToMany là quan hệ n-n với bảng tags thông qua bảng trung gian product_tags
            ->withTimestamps(); //Sử dụng timestamp thêm thời gian tạo và cập nhật trên CSDL
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');//belongsTo là quan hệ n-1 với bảng categories với khóa ngoại là category_id
    }
}
