<?php
class HtmlButton{
	
	/*
	 * $name 	: Tên của phần tử button
	 * $attr 	: Các thuộc tính của phần tử button 
	 * 		   	  Id - style - width - class - value ...
	 * $options	: Các phần sẽ bổ xung khi phát sinh trường hợp mới
	 * 			  [type]: button - submit - reset
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
		
		//Dinh dang kieu nut
		if(!isset($options['type'])){
			$type = 'submit';
		}else{		
			$type = $options['type'];
		}
		
		//Tạo phần tử HTML
		$html = '<input type="' . $type .'" name="'. $name . '" ' . $strAttr . ' value="' . $value . '" />';
	
		return $html;
	}

}
