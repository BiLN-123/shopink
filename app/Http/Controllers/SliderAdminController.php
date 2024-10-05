<?php

namespace App\Http\Controllers;

use App\Http\Requests\sliderAdd;
use App\Models\Slider;
use Illuminate\Http\Request;
use App\Traits\StorageImageTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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

    public function edit($id){
        $sliders = $this->slider->find($id);
        return view('admin.slider.edit', compact('sliders'));
    }

    public function update(Request $request, $id){
        try {
            DB::beginTransaction();
            $dataImageSliderUpdate = [
                'name' => $request->name,
                'description' => $request->description,
            ];
            $dataImageSlider =  $this->storageTraitUpload($request, 'image_path', 'slider');
            if(!empty($dataImageSlider)) {
                $dataImageSliderUpdate['image_name'] = $dataImageSlider['file_name'];
                $dataImageSliderUpdate['image_path'] = $dataImageSlider['file_path']; //file_name và file_path lấy từ hàm storageTraitUpload
            }
            $this->slider->find($id)->update($dataImageSliderUpdate);
            DB::commit();
            return redirect()->route('slider.index')->with('success', 'Cập nhật ảnh slider thành công');
        }
        catch (\Exception $exception){
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . '   ................Line' . $exception->getLine());
        }

    }

    public function delete($id)
    {
//        $this->product->find($id)->delete();
//        return redirect()->route('product.index');
        try{
            $this->slider->find($id)->delete();
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
