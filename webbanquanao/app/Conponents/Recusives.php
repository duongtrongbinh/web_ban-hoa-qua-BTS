<?php
namespace App\Conponents;


class Recusives{
    private $data;
    private $value_id;
    private $htmlSelect  = "";
    public function __construct($data){
        $this->data = $data;
    }
    public function categoryRecusive($parentid,$id = 0, $text = ""){
        foreach ($this->data as $value) {
            // dd($value->parent_id);
            if(($value->parent_id) == $id){
                if((!empty($parentid)) && ($parentid == $value->id)){
                $this->htmlSelect .= "<option selected value=".$value->id.">" .$text . $value->name . "</option>";
                }else{
                $this->htmlSelect .= "<option value=".$value->id.">" .$text . $value->name . "</option>";
                }
                $this->categoryRecusive($parentid,$value->id, $text. '-');
            }
        }
        return $this->htmlSelect;
    }




}
