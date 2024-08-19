<?php
namespace App\Components;

use App\Models\Category;
use App\Controllers\CategoryController;

class Recusive{
    private $data;
    private $htmlSelect = '';

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function categoryRecuse($parentId, $id = 0, $text = '')
    {
        foreach ($this->data as $value){
            if($value['parent_id'] == $id){
                if( !empty($parentId) && $parentId == $value['id']){ 
                    $this->htmlSelect .= "<option selected value='" . $value['id'] . "'>". $text .$value['name'] ."</option>";
                }
                else{
                    $this->htmlSelect .= "<option value='" . $value['id'] . "'>". $text .$value['name'] ."</option>";
                }
                
                $this->categoryRecuse($parentId ,$value['id'], $text .'--'); //sử dụng đệ quy để lặp lại hàm categoryRecuse
            }
        }
        return $this->htmlSelect;
    }

}

