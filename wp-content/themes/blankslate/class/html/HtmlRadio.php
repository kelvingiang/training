<?php

class HtmlRadio{

	/*
	* $name 	: Tên của phần tử Radio
	* $attr 	: Các thuộc tính của phần tử Radio
	* 		   	  Id - style - width - class - value ...
	* 			 
	* $options	: Các phần sẽ bổ xung khi phát sinh trường hợp mới
	*  			  [data]: là phần tử sẽ chứa một mảng value và label của phần tử radio
	*  			  [separator]: Giá trị phân cách của các nút radio
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
		
		
		//2. Kiểm tra giá trị của $value
		$strValue = $value;
		
		//3.Kiểm tra ký tự phân cách giữa các nút radio
		if(!isset($options['separator'])){
			$options['separator'] = ' ';
		}
		
		//4. Tạo các nút radio
		$html = '';
		$data = $options['data'];
		if(count($data)){
			foreach ($data as $key => $val){
				$checked = '';
				if(preg_match('/^(' . $strValue .')$/i', $key)){
					$checked = ' checked="checked" ';
				}				
				$html  .= '<input type="radio" name="' . $name . '" ' . $checked . ' value="' . $key . '"/>' 
						  . $val  . $options['separator'];
			}
		}
			
		return $html;
	}
	
}
