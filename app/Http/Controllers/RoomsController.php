<?php
//
//namespace App\Http\Controllers;
//
//use App\Models\rooms;
//use Illuminate\Http\Request;
//
//class RoomsController extends Controller
//{
//    private $room;
//    public function __construct(rooms $rooms)
//    {
//        $this->room = $rooms;
//    }
//    public function index(){
//        $rooms = $this->room->paginate(10);
//        return view('admin.rooms.index', compact('rooms'));
//    }
//
//    public function create()
//    {
//        // Trả về view để hiển thị form thêm mới phòng
//        return view('admin.rooms.add');
//    }
//
//    public function store(Request $request)
//    {
//        rooms::create([
//            'name' => $request->name,
//            'id' => $request->id
//        ]);
//
//        return redirect()->route('rooms.index')->with('success', 'Thêm mới phòng thành công');
//    }
//}
