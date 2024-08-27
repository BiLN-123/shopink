<?php

namespace App\Http\Controllers;

use App\Components\Recusive;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductTag;
use App\Models\Tag;
use App\Traits\StorageImageTrait;
use Illuminate\Http\Request;

class AdminProductController extends Controller
{
    use StorageImageTrait;
    private $category;
    private $product;
    public function __construct(Category $category, Product $product)
    {
        $this->category = $category;
        $this->product = $product;
    }

    public function index()
    {
//        $userId = session('user_id');
        return view('admin.product.index');//, compact('userId'));
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
    public function store(Request $request){
        //$userId = session('user_id'); // Lấy user ID từ session
//        dd($request->image_path);
        $dataProductCreate = [
            'name' => $request->name,
            'price' => $request->price,
            'content' => $request->contents,
            'user_id' => 1,
            'category_id' => $request->category_id,
        ];
        $dataUploadFeatureImage = $this->storageTraitUpload($request, 'feature_image_path', 'product');
        if(!empty($dataUploadFeatureImage)){
            $dataProductCreate['feature_image_name'] = $dataUploadFeatureImage['file_name'];
            $dataProductCreate['feature_image_path'] = $dataUploadFeatureImage['file_path'];
        }
        $product = $this->product->create($dataProductCreate);
        //dd($product);



        //Insert data to product_images
        if( $request->hasFile('image_path')){
            foreach ($request ->image_path as $fileItem){
                $dataProductImageDetail = $this->storageTraitUploadMultiple($fileItem, 'product');
//                dd($dataProductImageDetail);
                $product->images()->create([
                    'image_path' => $dataProductImageDetail['file_path'],
                    'image_name' => $dataProductImageDetail['file_name'],
                ]); //cách này sử dụng eloquent relationship
//                ProductImage::create([
//                    'product_id' => $product->id,
//                     'image_path' => $dataProductImageDetail['file_path'],
//                    'image_name' => $dataProductImageDetail['file_name'],
//                ]); cách thông thường
            }
        }



        //Insert tags for product
        foreach ($request->tags as $tagItem){
            $tagInstance = Tag::firstOrCreate(['name' => $tagItem]);
            ProductTag::create([
                'product_id' => $product->id,
                'tag_id' => $tagInstance->id
            ]);
        }
    }
}
