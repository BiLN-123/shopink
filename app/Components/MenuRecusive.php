<?php

namespace App\Components;

use App\Models\Menu;

class MenuRecusive{
    private $html;
    public function __construct(){
        $this->html = '';
    }

    public function menuRecusiveAdd($parentId = 0, $subMark = '')
    {
        $data = Menu::where('parent_id', $parentId)->get(); //lấy ra tất cả các menu có parent_id = đầu tiên
        // tiêếp theo là lặp qua từng menu để lấy ra các menu con của nó
        foreach ($data as $dataItem){
            $this->html .= '<option value="'. $dataItem->id .'"> '. $subMark . $dataItem->name .' </option>';
            $this->menuRecusiveAdd($dataItem->id, $subMark . '--');
        }
        return $this->html;
    }

    public function menuRecusiveEdit($parentIdMenuEdit ,$parentId = 0, $subMark = '')
    {
        $data = Menu::where('parent_id', $parentId)->get(); //lấy ra tất cả các menu có parent_id = đầu tiên
        // tiêếp theo là lặp qua từng menu để lấy ra các menu con của nó
        foreach ($data as $dataItem){
            if($parentIdMenuEdit == $dataItem->id){
                $this->html .= '<option selected value="'. $dataItem->id .'"> '. $subMark . $dataItem->name .' </option>';
            }
            else{
                $this->html .= '<option value="'. $dataItem->id .'"> '. $subMark . $dataItem->name .' </option>';
            }
            $this->menuRecusiveEdit($parentIdMenuEdit, $dataItem->id, $subMark . '--');
        }
        return $this->html;
    }
}
