<?php

namespace App\Http\Controllers;

use App\Components\Recusive;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminProductController extends Controller
{
    private $category;
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function index()
    {
        return view('admin.product.index');
    }

    public function create()//Hàm naỳ dùng để lấy dữ liệu từ db và trả về view form thêm mới
    {
        $htmlOption = $this->getCategory($parentId = '');
        return view("admin.product.add", compact('htmlOption'));
    }

    public function getCategory($parentId){ //hàm này dùng để lấy dữ liệu từ db và trả về view form Category
        $data = $this->category->all();
        $recusive = new Recusive($data);
        $htmlOption = $recusive->categoryRecuse($parentId);
        return $htmlOption;
    }
}
