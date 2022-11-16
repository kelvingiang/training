<?php
class HtmlCheckbox{

	/*
	 * $name 	: Tên của phần tử checkbox
	* $attr 	: Các thuộc tính của phần tử checkbox
	* 		   	  Id - style - width - class - value ...
	* $options	: Các phần sẽ bổ xung khi phát sinh trường hợp mới
	* 			  [current_value]
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
		
		//Kiểm tra xem có check hay không
		$checked = '';
		if(isset($options['current_value'])){
			if($options['current_value'] == $value){
				$checked = ' checked="checked" ';
			}
		}
		
		//Tạo phần tử HTML
		$html = '<input type="checkbox" name="'. $name . '" ' 
				. $strAttr . ' value="' . $value . '" ' . $checked  . ' />';
	
		return $html;
	}
	
}