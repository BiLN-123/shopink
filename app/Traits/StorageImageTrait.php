<?php
    namespace App\Traits;
    use Illuminate\Support\Str;
    use Illuminate\Support\Facades\Storage;

trait StorageImageTrait{
     public function storageTraitUpload($request, $fieldName, $folderName)
     {
         if($request->hasFile($fieldName)!=null){
             $file = $request->$fieldName;
             $fileNameOrigin = $file->getClientOriginalName();
             $fileNameHash = Str::random(20).'.'.$file->getClientOriginalExtension();
             $filePath = $request->file($fieldName)->storeAs('public/'. $folderName . '/' . auth()->id(), $fileNameHash);  //Lưu ảnh vào thư mục product
             $dataUploadTrait = [
                 '$file_name' => $fileNameOrigin,
                 'file_path' => Storage::url($filePath)
             ];
             return $dataUploadTrait;
         }
         return null;
     }
 }


