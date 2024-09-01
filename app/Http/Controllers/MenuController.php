<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
    use App\Models\Menu;
    use App\Components\MenuRecusive;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

    class MenuController extends Controller
    {
        private $menuRecusive;
        private $menu;
        public function __construct(MenuRecusive $menuRecusive, Menu $menu){
            $this->menuRecusive = $menuRecusive;
            $this->menu = $menu;
        }

    public function index()
        {
//            $menus = Menu::latest()->paginate(6); //sử dụng latest để lấy ra dữ liệu mới nhất mới tạo, sử dụng paginate để phân trang, //đối ngược với latest là oldest
            $menus = $this->menu->paginate(10);
            return view('admin.menus.index', compact('menus'));
        }

    public function create()
        {//hàm này dùng để lấy dữ liệu từ db và trả về view form thêm mới
            $optionSelect = $this->menuRecusive->menuRecusiveAdd();

            return view('admin.menus.add', compact('optionSelect'));
        }

    public function store(Request $request)
        {
            $this->menu->create([
                'name' => $request->name,
                'parent_id' => $request->parent_id,
                'slug' => Str::slug($request->name),
            ]);

            return redirect()->route('menus.index');
        }
    public function edit($id)
        {
            $menuFollowIdEdit = $this->menu->find($id);
            $optionSelect = $this->menuRecusive->menuRecusiveEdit($menuFollowIdEdit->parent_id);
            return view('admin.menus.edit', compact('optionSelect', 'menuFollowIdEdit'));
        }

    public function update($id, Request $request){
            $this->menu->find($id)->update
            ([
                'name' => $request->name,
                'parent_id' => $request->parent_id,
                'slug' => Str::slug($request->name),
            ]);
        return redirect()->route('menus.edit', ['id' => $id]);
    }

    public function delete($id){
//            $this->menu->find($id)->delete();
//            return redirect()->route('menus.index');
        try{
            $this->menu->find($id)->delete();
            return response()->json([
                'code' => 200,
                'message' => 'success',
            ], status: 200);
        }
        catch (\Exception $exception){
            Log::error('Message: ' . $exception->getMessage() . '   ................Line' . $exception->getLine());
            return response()->json([
                'code' => 500,
                'message' => 'fail',
            ], status: 500);
        }
    }
}
