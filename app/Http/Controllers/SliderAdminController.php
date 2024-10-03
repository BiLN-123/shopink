<?php

namespace App\Http\Controllers;

use App\Http\Requests\sliderAdd;
use App\Models\Slider;
use Illuminate\Http\Requests;
use App\Traits\StorageImageTrait;

class SliderAdminController extends Controller
{
    use StorageImageTrait;
    private $slider;
    public function __construct(Slider $slider)
    {
        $this->slider = $slider;
    }

    public function index(){
        $sliders = $this->slider->latest()->paginate(5);
        return view('admin.slider.index', compact('sliders'));
    }

    public function create(){
        return view('admin.slider.add');
    }

    public function store(sliderAdd $request){
        $dataInsert = [
            'name' => $request->name,
            'description' => $request->description,
        ];
        $dataImageSlider = $this->storageTraitUpload($request, 'image_path', 'slider');
        if(!empty($dataImageSlider)) {
            $dataInsert['image_name'] = $dataImageSlider['file_name'];
            $dataInsert['image_path'] = $dataImageSlider['file_path']; //file_name và file_path lấy từ hàm storageTraitUpload
        }
        $this->slider->create($dataInsert);
        return redirect()->route('slider.index')->with('success', 'Thêm mới ảnh slider thành công');
    }

}
