<?php

class HtmlSelectbox{

	/*
	* $name 	: Tên của phần tử Selectbox
	* $attr 	: Các thuộc tính của phần tử textbox
	* 		   	  Id - style - width - class - value ...
	* 			 
	* $options	: Các phần sẽ bổ xung khi phát sinh trường hợp mới
	*  			  [data]: là phần tử sẽ chứa một mảng value và label của <option>
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
		$strValue = '';
		if(is_array($value)){		
			$strValue = implode("|", $value);
		}else{
			$strValue = $value;
		}
		//echo $strValue;
		
		//3. Tạo value và label của <option>
		$strOption = '';
		$data = $options['data'];
		if(count($data)){
			foreach ($data as $key => $val){
				$selected = '';
				if(preg_match('/^(' . $strValue .')$/i', $key)){
					$selected = ' selected="selected" ';
				}
				$strOption .= '<option value="' . $key . '" ' . $selected . ' >' . $val . '</option>';
			}
		}
		
		//Tạo phần tử HTML
		$html = '<select name="'. $name . '" ' . $strAttr . ' >'
				. $strOption
				. '</select>';
		
		return $html;
	}
	
}
