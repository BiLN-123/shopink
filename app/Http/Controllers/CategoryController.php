<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryAddRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Components\Recusive;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    private $category;
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function getCategory($parentId){ //hàm này dùng để lấy dữ liệu từ db và trả về view form Category
        $data = $this->category->all();
        $recusive = new Recusive($data);
        $htmlOption = $recusive->categoryRecuse($parentId);
        return $htmlOption;
    }

    public function create() //Hàm naỳ dùng để lấy dữ liệu từ db và trả về view form thêm mới
    {
        $htmlOption = $this->getCategory($parentId = '');
        return view('admin.category.add', compact('htmlOption'));
    }

    public function index() {
        $categories = $this->category->latest()->paginate(5); //sử dụng latest để lấy ra dữ liệu mới nhất mới tạo, sử dụng paginate để phân trang, //đối ngược với latest là oldest
        return view('admin.category.index', compact('categories')); // sử dụng compact để truyền dữ liệu từ controller sang view
    }

    public function store(CategoryAddRequest $request) //Hàm này dùng để lưu dữ liệu vào db
    {
        $this->category->create([
           'name' => $request->name,
           'parent_id' => $request->parent_id,
            'slug' => Str::slug($request->name),
        ]);
        return redirect()->route('categories.index')->with('success', 'Thêm mới danh mục thành công');
    }

    public function edit($id) //Hàm này dùng để lấy dữ liệu từ db và trả về view form sửa
    {
        $category = $this->category->find($id);
        $htmlOption = $this->getCategory($category->parent_id);
        return view('admin.category.edit', compact('category', ('htmlOption')));
    }

    public function update($id, Request $request){
        $this->category->find($id)->update(
            [
            'name' => $request->name,
            'parent_id' => $request->parent_id,
             'slug' => Str::slug($request->name),
             ]
        );
        return redirect()->route('categories.index')->with('success', 'Cập nhật danh mục thành công');
    }

    public function delete($id) //Hàm này dùng để xóa dữ liệu
    {
//        $this->category->find($id)->delete();
//        return redirect()->route('categories.index');
        try{
            $this->category->find($id)->delete();
            return response()->json([
                'code' => 200,
                'message' => 'success',

            ], status: 200);
        }
        catch(\Exception $exception){
            Log::error('Message: ' . $exception->getMessage() . '   ................Line' . $exception->getLine());
            return response()->json([
                'code' => 500,
                'message' => 'fail',

            ], status: 500);
        }
    }
}

