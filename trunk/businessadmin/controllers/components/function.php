<?php

class FunctionComponent
{
	function khongdau($text,$key='-'){
		//global $ibforums;
		//Charachters must be in ASCII and certain ones aint allowed
		$text = html_entity_decode ($text);
		$text = preg_replace("/(ä|à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $text);
		$text = str_replace("ç","c",$text);
		$text = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $text);
		$text = preg_replace("/(ì|í|î|ị|ỉ|ĩ)/", 'i', $text);
		$text = preg_replace("/(ö|ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $text);
		$text = preg_replace("/(ü|ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $text);
		$text = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $text);
		$text = preg_replace("/(đ)/", 'd', $text);
		//CHU HOA
		$text = preg_replace("/(Ä|À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $text);
		$text = str_replace("Ç","C",$text);
		$text = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $text);
		$text = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $text);
		$text = preg_replace("/(Ö|Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $text);
		$text = preg_replace("/(Ü|Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $text);
		$text = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $text);
		$text = preg_replace("/(Đ)/", 'D', $text);
		//Special string
		$text = preg_replace("/(̀|́|̉|$|>)/", '', $text);
		$text = preg_replace ("'<[\/\!]*?[^<>]*?>'si", "", $text);
		
		$text = str_replace(" / ",$key,$text);
		$text = str_replace("/",$key,$text);
		$text = str_replace("?",$key,$text);
		$text = str_replace('"',$key,$text);
		$text = str_replace('"',$key,$text);
		$text = str_replace(":",$key,$text);
		$text = str_replace(" - ",$key,$text);
		$text = str_replace("_",$key,$text);
		$text = str_replace(" ",$key,$text);
		$text = str_replace("\"",$key,$text);
		$text = str_replace( ",", $key, $text);
		$text = str_replace( "ß", "ss", $text);
		$text = str_replace( "&", "", $text);
		$text = str_replace( "%", "", $text);
		
		$text = str_replace("----",$key,$text);
		$text = str_replace("---",$key,$text);
		$text = str_replace("--",$key,$text);
		return $text;
	}
		
	function thu($thu="")
	{
		switch (date(w))
		{
			case 0: $thu="Chủ nhật";
					break;
			case 1: $thu="Thứ hai";
					break;
			case 2: $thu="Thứ ba";
					break;
			case 3: $thu="Thứ tư";
					break;
			case 4: $thu="Thứ năm";
					break;
			case 5: $thu="Thứ sáu";
					break;
			default: 
					$thu="Thứ bảy";
		}
		return $thu;
	}
	
	function giatien($num)
	{
		return @number_format($num,0,',','.');
	}
	
	function laygia($text)
	{
		$trans = array (' ' => '', ',' => '', '.' => '');
		$result = strtr ( $text, $trans ); // Chuỗi đã được bỏ dấu  
		return strtolower($result);
	}
	
	function image_thumb($text)
	{
		$mang=explode('/images/',$text);
		$str=$mang[0].'/_thumbs/Images/'.$mang[1];
		return $str;
	}
	
	function diachi(){
		$adr = ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') ? 'https://' : 'http://';
		$adr .= isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : getenv('HTTP_HOST');
		$adr .= isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : getenv('REQUEST_URI');
		return $adr;
	}
}

?>