<?php
class HtmlPassword{

	/*
	* $name 	: Tên của phần tử password
	* $attr 	: Các thuộc tính của phần tử password
	* 		   	  Id - style - width - class - value ...
	* $options	: Các phần sẽ bổ xung khi phát sinh trường hợp mới
	*/
	
	public static function create($name = '', $value = '', $attr = array(), $options = null){
	
		$html = '';
	
		//1. Tạo chuỗi thuộc tính từ tham số $attr
		$strAttr = '';
		if(count($attr)> 0){
			foreach ($attr as $key => $val){
				if($key != "type" && $key != 'value'){
					$strAttr .= ' ' . $key . '="' . $val . '" ';
				}
			}
		}
	
		//Tạo phần tử HTML
		$html = '<input type="password" name="'. $name . '" ' . $strAttr . ' value="' . $value . '" />';
	
		return $html;
	}

}

