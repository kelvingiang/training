<?php

class MyHtml
{

	public function __construct($options = null)
	{
	}

	public function btn_media_script($button_id, $input_id)
	{
		$script = "<script>
		jQuery(document).ready(function($){
		$('#{$button_id}').zendvnBtnMedia('{$input_id}');
		});
                                 </script>";
		return $script;
	}
	public function pTag($value = '', $attr = array(), $options = null)
	{
		$strAttr = '';
		if (count($attr) > 0) {
			foreach ($attr as $key => $val) {
				if ($key != "type" && $key != 'value') {
					$strAttr .= ' ' . $key . '="' . $val . '" ';
				}
			}
		}
		return '<p ' . $strAttr . ' >' . $value . '</p>';
	}

	public function label($value = '', $attr = array(), $options = null)
	{
		$strAttr = '';
		if (count($attr) > 0) {
			foreach ($attr as $key => $val) {
				if ($key != "type" && $key != 'value') {
					$strAttr .= ' ' . $key . '="' . $val . '" ';
				}
			}
		}
		return '<label ' . $strAttr . ' >' . $value . ':</label>';
	}

	//Phần t�?TEXTBOX
	public function textbox($name = '', $value = '', $attr = array(), $options = null)
	{
		require_once DIR_CLASS  . 'html/HtmlTextbox.php';
		return HtmlTextbox::create($name, $value, $attr, $options);
	}

	//Phần t�?FILEUPLOAD
	public function fileupload($name = '', $value = '', $attr = array(), $options = null)
	{
		require_once DIR_CLASS  . 'html/HtmlFileupload.php';
		return HtmlFileupload::create($name, $value, $attr, $options);
	}

	//Phần t�?PASSWORD
	public function password($name = '', $value = '', $attr = array(), $options = null)
	{
		require_once DIR_CLASS  . 'html/HtmlPassword.php';
		return HtmlPassword::create($name, $value, $attr, $options);
	}

	//Phần t�?HIDDEN
	public function hidden($name = '', $value = '', $attr = array(), $options = null)
	{
		require_once DIR_CLASS  . 'html/HtmlHidden.php';
		return HtmlHidden::create($name, $value, $attr, $options);
	}

	//Phần t�?BUTTON - SUBMIT - RESET
	public function button($name = '', $value = '', $attr = array(), $options = null)
	{
		require_once DIR_CLASS  . 'html/HtmlButton.php';
		return HtmlButton::create($name, $value, $attr, $options);
	}

	//Phần t�?TEXTAREA
	public function textarea($name = '', $value = '', $attr = array(), $options = null)
	{
		require_once DIR_CLASS . 'html/HtmlTextarea.php';
		return HtmlTextarea::create($name, $value, $attr, $options);
	}

	//Phần t�?RADIO
	public function radio($name = '', $value = '', $attr = array(), $options = null)
	{
		require_once DIR_CLASS  . 'html/HtmlRadio.php';
		return HtmlRadio::create($name, $value, $attr, $options);
	}

	//Phần t�?CHECKBOX
	public function checkbox($name = '', $value = '', $attr = array(), $options = null)
	{
		require_once DIR_CLASS  . 'html/HtmlCheckbox.php';
		return HtmlCheckbox::create($name, $value, $attr, $options);
	}

	//Phần t�?SELECTBOX
	public function selectbox($name = '', $value = '', $attr = array(), $options = null)
	{
		require_once DIR_CLASS  . 'html/HtmlSelectbox.php';
		return HtmlSelectbox::create($name, $value, $attr, $options);
	}
}