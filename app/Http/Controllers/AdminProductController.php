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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdminProductController extends Controller
{
    use StorageImageTrait;
    private $category;
    private $product;
    private $tag;
    private $productImage;
    private $productTag;
    public function __construct(Category $category, Product $product, Tag $tag, ProductTag $productTag, ProductImage $productImage)
    {
        $this->category = $category;
        $this->product = $product;
        $this->tag = $tag;
        $this->productImage = $productImage;
        $this->productTag = $productTag;
    }

    public function index()
    {
//        $userId = session('user_id');
        $products = $this->product->latest()->paginate(5);
        return view('admin.product.index', compact('products'));
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


        try{
            DB::beginTransaction(); //Sử dụng beginTransaction và commit để bắt đầu và kết thúc một transaction,
            // một khi chạy hết mới được insert vào CSDL còn bị lỗi ở 1 đoạn nào đó sẽ rollback và log ra lỗi không insert vào CSDL
            //$userId = session('user_id'); // Lấy user ID từ session
//        dd($request->image_path);
            $dataProductCreate = [
                'name' => $request->name,
                'price' => $request->price,
                'content' => $request->contents,
                'user_id' => 1,//auth()->id(),
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


//            dd($request->tags);
//            Insert tags for product----------------------
            if(!empty($request->tags)){
                foreach ($request->tags as $tagItem){
                    $tagInstance = $this->tag->firstOrCreate(['name' => $tagItem]); //Tag::firstOrCreate, sử dụng firstOrCreate để kiểm tra xem tag đã tồn tại chưa, nếu chưa thì tạo mới còn đã tồn tại thì thêm vào không khả dụng
//Sử dụng phương thức firstOrCreate của Eloquent để tìm kiếm tag với tên tương ứng trong cơ sở dữ liệu.
//Nếu tag đã tồn tại, phương thức này sẽ trả về instance của tag đó.
//Nếu tag không tồn tại, phương thức này sẽ tạo một tag mới với tên tương ứng và trả về instance của tag mới tạo.
//            $this->productTag->create([ //ProductTag::create
//                'product_id' => $product->id,
//                'tag_id' => $tagInstance->id
//            ]);
                    $tagIds[] = $tagInstance->id;
                }
            }
            $product->tags()->attach($tagIds); //-------------------sử dụng attach để thêm dữ liệu vào bảng trung gian product_tags
            //Sử dụng phương thức attach của Eloquent để gắn các tag có ID trong mảng $tagIds vào sản phẩm.
            //Phương thức attach sẽ thêm các bản ghi vào bảng trung gian product_tags với product_id và tag_id.

//            if (!empty($request->tags)) {
//                foreach ($request->tags as $tagItem) {
//                    $tagInstance = $this->tag->firstOrNew(['name' => $tagItem]);
//                    if (!$tagInstance->exists) {
//                        $tagInstance->save();
//                    }
//                    $tagIds[] = $tagInstance->name;
//                }
//            }
//            $product->tags()->attach($tagIds);

            DB::commit();
            return redirect()->route('product.index');
        }
        catch(\Exception $exception)
        {
            DB::rollBack(); //
            Log::error('Message: ' . $exception->getMessage() . '   ................Line' . $exception->getLine());
        }
    }

    public function edit($id) {
        //$htmlOption = $this->getCategory($parentId = '');
        $product = $this->product->find($id);
        $htmlOption = $this->getCategory($product->category_id);
        return view('admin.product.edit', compact('product', 'htmlOption'));
    }


//Update product------------------------------------------------------------
    public function update(Request $request, $id){

        try{
            DB::beginTransaction();
            $dataProductUpdate = [
                'name' => $request->name,
                'price' => $request->price,
                'content' => $request->contents,
                'user_id' => 1,//auth()->id(),
                'category_id' => $request->category_id,
            ];
            $dataUploadFeatureImage = $this->storageTraitUpload($request, 'feature_image_path', 'product');
            if(!empty($dataUploadFeatureImage)){
                $dataProductUpdate['feature_image_name'] = $dataUploadFeatureImage['file_name'];
                $dataProductUpdate['feature_image_path'] = $dataUploadFeatureImage['file_path'];
            }
             $this->product->find($id)->update($dataProductUpdate);
            //dd($product);
            $product = $this->product->find($id);



            //Insert data to product_images
            if( $request->hasFile('image_path')){
                $this->productImage->where('product_id', $id)->delete();
                foreach ($request ->image_path as $fileItem){
                    $dataProductImageDetail = $this->storageTraitUploadMultiple($fileItem, 'product');
//                dd($dataProductImageDetail);
                    $product->images()->create([
                        'image_path' => $dataProductImageDetail['file_path'],
                        'image_name' => $dataProductImageDetail['file_name'],
                    ]); //cách này sử dụng eloquent relationship
                }
            }



//            Insert tags for product----------------------
//            dd($request->tags);
            if(!empty($request->tags)){
                foreach ($request->tags as $tagItem){
                    $tagInstance = $this->tag->firstOrCreate(['name' => $tagItem]);
                    $tagIds[] = $tagInstance->id;
                }
            }
            $product->tags()->sync($tagIds);

            DB::commit();
            return redirect()->route('product.index');
        }
        catch(\Exception $exception)
        {
            DB::rollBack(); //
            Log::error('Message: ' . $exception->getMessage() . '   ................Line' . $exception->getLine());
        }
    }
    public function delete($id)
    {
        $this->product->find($id)->delete();
        return redirect()->route('product.index');
    }

}
