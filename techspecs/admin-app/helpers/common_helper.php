<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('pr'))
{
	function pr($arr,$e=1)
	{
		if(is_array($arr))
		{
			echo "<pre>";
			print_r($arr);
			echo "</pre>";
		}
		else
		{
			echo "<br>Not an array...<br>";
			echo "<pre>";
			var_dump($arr);
			echo "</pre>";
	
		}
		if($e==1)
		    exit();
		else
		    echo "<br>";
	}
}

if ( ! function_exists('sub_word'))
{
    function sub_word($str, $limit) {
            $text = explode(' ', $str, $limit);
            if (count($text)>=$limit)
            {
                    array_pop($text);
                    $text = implode(" ",$text).'...';
            }
            else
            {
                    $text = implode(" ",$text);
            }
            $text = preg_replace('`\[[^\]]*\]`','',$text);
            return strip_tags($text);
    }
}

if (!function_exists('send_email'))
{
	function send_email($to, $from, $from_name, $subject, $message, $attachment_file='')
	{
		$CI = & get_instance();
		
		$CI->load->library('email');
		
		$CI->email->clear();
		$config['mailtype'] = "html";
		$CI->email->initialize($config);
		
		$CI->email->to($to);
		$CI->email->from($from, $from_name);
		$CI->email->subject($subject);
		
		if($attachment_file != '')
		{
			$CI->email->attach($attachment_file);
		}
		$CI->email->message($message);
		
		
		$CI->email->send();
		return true;
	}
}

if (!function_exists('image_upload'))
{
	function image_upload(&$upload_config, &$thumb_config)
	{
		
		$CI = & get_instance();		
		$CI->load->library('Upload');
		
		$field_name 			= $upload_config['field_name'];
		$file_upload_path 		= $upload_config['file_upload_path'];
		$max_size 			= $upload_config['max_size'];
		$max_width 			= $upload_config['max_width'];
		$max_height 			= $upload_config['max_height'];
		$allowed_types 			= $upload_config['allowed_types'];
		
		$thumb_create 			= $thumb_config['thumb_create'];
		$thumb_file_upload_path 	= $thumb_config['thumb_file_upload_path'];
		$thumb_width 			= $thumb_config['thumb_width'];
		$thumb_height 			= $thumb_config['thumb_height'];
		
		$config['upload_path'] 	= $file_upload_path;
		//pr($config);
		
		if($allowed_types != '') {
			$config['allowed_types'] 	= $allowed_types;
		}
		
		if($max_size != '') {
			$config['max_size']		= $max_size;
		} else {
			$config['max_size']		= '';
		}
		
		if($max_width != '') {
			$config['max_width']		= $max_width;
		} else {
			$config['max_width']		= '';
		}
		
		if($max_height != '') {
			$config['max_height']		= $max_height;
		} else {
			$config['max_height']		= '';
		}
		
		if(isset($upload_config['encrypt_name'])) {
			$config['encrypt_name']		= $upload_config['encrypt_name'];
		} else {
			$config['encrypt_name']		= true;
		}
		    
		$uploaded_file_name = '';
		//$CI->upload->set_config($config); initialize
		$CI->upload->initialize($config);
		$i_upload = $CI->upload->do_upload($field_name,true);
		$CI->session->set_userdata('upload_err',$CI->upload->display_errors());
		$upload_config['upload_err'] = $CI->upload->display_errors();
		
		if($i_upload)
		{
			$uploaded_file_name = $CI->upload->file_name;
			
			if($thumb_create)
			{
				$config['source_image']		= $file_upload_path.$uploaded_file_name;
				$config['new_image'] 		= $file_upload_path.$thumb_file_upload_path.$uploaded_file_name;
				$config['create_thumb'] 	= TRUE;
				$config['maintain_ratio']	= TRUE;
				$config['width']	 	= $thumb_width;
				$config['height']		= $thumb_height;
				$config['thumb_marker']		= '';
				$CI->load->library('image_lib', $config); 
				$CI->image_lib->resize();
				$CI->image_lib->clear();
			}
			else
			{
				//return true;
			}
		}
		else
		{
			return false;
		}
		//echo 'upload failed'; die;
		//echo $uploaded_file_name; die;
		return $uploaded_file_name;
	}
}


if (!function_exists('multiple_image_upload'))
{
	function multiple_image_upload(&$upload_config, &$thumb_config)
	{
		
		$CI = & get_instance();
		$field_name 			= $upload_config['field_name'];
		$file_upload_path 		= $upload_config['file_upload_path'];
		$max_size 			= $upload_config['max_size'];
		$max_width 			= $upload_config['max_width'];
		$max_height 			= $upload_config['max_height'];
		$allowed_types 			= $upload_config['allowed_types'];
		
		$thumb_create 			= $thumb_config['thumb_create'];
		$thumb_file_upload_path 	= $thumb_config['thumb_file_upload_path'];
		$thumb_width 			= $thumb_config['thumb_width'];
		$thumb_height 			= $thumb_config['thumb_height'];
		
		$uploadedImageArr = array();
		$filesCount = count($_FILES[$field_name]['name']);
		for($i = 0; $i < $filesCount; $i++){
			
		    $_FILES['imageFile']['name'] = $_FILES[$field_name]['name'][$i];
		    $_FILES['imageFile']['type'] = $_FILES[$field_name]['type'][$i];
		    $_FILES['imageFile']['tmp_name'] = $_FILES[$field_name]['tmp_name'][$i];
		    $_FILES['imageFile']['error'] = $_FILES[$field_name]['error'][$i];
		    $_FILES['imageFile']['size'] = $_FILES[$field_name]['size'][$i];
 		    
		    
			$config['upload_path'] 	= $file_upload_path;
		
			if($allowed_types != '') {
				$config['allowed_types'] 	= $allowed_types;
			}
			
			if($max_size != '') {
				$config['max_size']		= $max_size;
			} else {
				$config['max_size']		= '';
			}
			
			if($max_width != '') {
				$config['max_width']		= $max_width;
			} else {
				$config['max_width']		= '';
			}
			
			if($max_height != '') {
				$config['max_height']		= $max_height;
			} else {
				$config['max_height']		= '';
			}
			
			if(isset($upload_config['encrypt_name'])) {
				$config['encrypt_name']		= $upload_config['encrypt_name'];
			} else {
				$config['encrypt_name']		= true;
			}
			    
			$uploaded_file_name = '';
			
			$CI->upload->initialize($config);
			$i_upload = $CI->upload->do_upload('imageFile',true);
			$CI->session->set_userdata('upload_err',$CI->upload->display_errors());
			$upload_config['upload_err'] = $CI->upload->display_errors();
			//print_r($CI->upload->display_errors());
			//echo $file_upload_path;
			//die();
			if($i_upload)
			{
				$CI->load->library('image_lib');
				$uploaded_file_name = $CI->upload->file_name;
				$uploadedImageArr[] = $uploaded_file_name;
				if($thumb_create)
				{
					$config['source_image']		= $file_upload_path.$uploaded_file_name;
					$config['new_image'] 		= $file_upload_path.$thumb_file_upload_path.$uploaded_file_name;
					$config['create_thumb'] 	= TRUE;
					$config['maintain_ratio']	= TRUE;
					$config['width']	 	= $thumb_width;
					$config['height']		= $thumb_height;
					$config['thumb_marker']		= '';
					
					$CI->image_lib->initialize($config);					
					$CI->image_lib->resize();					
					$CI->image_lib->clear();
				}
				
			}
			else
			{
				return false;
			}
			
		}
		
		return $uploadedImageArr;
	}
}

if (!function_exists('file_upload'))
{
	function file_upload(&$file_upload_config)
	{
		$CI = & get_instance();
		$CI->load->library('Upload');
		
		$field_name 		= $file_upload_config['field_name'];
		$file_upload_path 	= $file_upload_config['file_upload_path'];
		$max_size 			= $file_upload_config['max_size'];
		$allowed_types 		= $file_upload_config['allowed_types'];
		
		$config['upload_path'] 	= $file_upload_path;
		
		if($allowed_types != '')
		{
			$config['allowed_types'] 	= $allowed_types;
		}
		
		if($max_size != '')
		{
			$config['max_size']		= $max_size;
		}
		
		if(isset($file_upload_config['encrypt_name']))
		{
			$config['encrypt_name']		= $file_upload_config['encrypt_name'];
		}
		else
		{
			$config['encrypt_name']		= true;
		}
		
		$uploaded_file_name = '';
		$CI->upload->set_config($config);
		$i_upload = $CI->upload->do_upload($field_name,true);
		
		//echo $CI->upload->display_errors(); die();
		$CI->session->set_userdata('upload_err',$CI->upload->display_errors());
		
		$file_upload_config['upload_err'] = $CI->upload->display_errors();
		
		if($i_upload) {
			$uploaded_file_name = $CI->upload->file_name;
			
		} 
		return $uploaded_file_name;
	}
}

/* This function is to create thumb from a already uploaded file
*/
if (!function_exists('create_file_thumb'))
{
	function create_file_thumb($uploaded_file_name, &$upload_config, &$thumb_config)
	{

		$CI = & get_instance();
		$CI->load->library('image_lib');
		
		$file_upload_path 		= $upload_config['file_upload_path'];
		$thumb_file_upload_path 	= $thumb_config['thumb_file_upload_path'];
		$thumb_width 			= $thumb_config['thumb_width'];
		$thumb_height 			= $thumb_config['thumb_height'];
		
		$config['source_image']		= $file_upload_path.$uploaded_file_name;
		$config['new_image'] 		= $thumb_file_upload_path.$uploaded_file_name;
		$config['create_thumb'] 	= TRUE;
		$config['maintain_ratio']	= TRUE;
		$config['width']	 		= $thumb_width;
		$config['height']			= $thumb_height;
		
		$CI->load->library('image_lib', $config);
		$CI->image_lib->initialize($config);
		$CI->image_lib->resize();
    
		//echo $CI->image_lib->display_errors();exit();
		
		return true;
		
		/**************************/
		
	}
}



if (!function_exists('video_upload'))
{
	function video_upload(&$upload_config)
	{
		
		//pr($upload_config,0);
		/*
			$upload_video_config['field_name']= 'property_video';
			$upload_video_config['file_upload_path'] 	= 'propertyvideos/';
			$upload_video_config['max_size']			= '';					
			$upload_video_config['allowed_types']		= 'avi|mpeg|flv|wmv|mov|wmv';
		 */
		
		$CI = & get_instance();
		
		$CI->load->library('Upload');
		
		$field_name 		= $upload_config['field_name'];
		$file_upload_path 	= $upload_config['file_upload_path'];
		$max_size 			= $upload_config['max_size'];
		$allowed_types 		= $upload_config['allowed_types'];
		
		
		$config['upload_path'] 	= $file_upload_path;
		//echo $config['upload_path']; die;
		
		if($allowed_types != '') {
			$config['allowed_types'] 	= $allowed_types;
		}
		
		if($max_size != '') {
			$config['max_size']		= $max_size;
		} else {
			$config['max_size']		= '';
		}
		
		
		if(isset($upload_config['encrypt_name']))
		{
			$config['encrypt_name']		= $upload_config['encrypt_name'];
		}
		else
		{
			$config['encrypt_name']		= true;
		}
                
		$uploaded_file_name = '';
		$CI->upload->set_config($config);
		//echo 'before upload';
		$i_upload = $CI->upload->do_upload($field_name,true);
				//echo 'after upload'; die;
				
		$CI->session->set_userdata('upload_err',$CI->upload->display_errors());
		$upload_config['upload_err'] = $CI->upload->display_errors();
		//echo $upload_config['upload_err']; die;
		
		if($i_upload)
		{
			//echo 'hi'; die;
			$uploaded_file_name = $CI->upload->file_name;
			
			
		}
		else
		{
			return false;
		}
		//echo 'upload failed'; die;
		//echo $uploaded_file_name; die;
		return $uploaded_file_name;
	}
}

if (!function_exists('file_download'))
{
	function file_download($file_name_path, $original_file_name='') 
	{
		if(isset($original_file_name)) {
			$file_name = $original_file_name;
		} else {
			$file_name = $file_name_path;
		}
		$mime = 'application/force-download';
		header('Pragma: public');    
		header('Expires: 0');        
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Cache-Control: private',false);
		header('Content-Type: '.$mime);
		header('Content-Disposition: attachment; filename="'.basename($file_name).'"');
		header('Content-Transfer-Encoding: binary');
		header('Connection: close');
		readfile($file_name_path);
		return true;
		
	}
}

/* This function is used for creation of PDF
 * @param  strings : view_file_name, output_file_name_path, output_option,
 * landscape_portrait and paper_size
 * @return NULL
 */
if (!function_exists('generate_pdf'))
{
	function generate_pdf($view_file_name, $output_file_name_path='', $output_option, $landscape_portrait='', $paper_size='')
	{
		$CI = & get_instance();
		$CI->load->library('pdf');
		
		// set document information
		$CI->pdf->SetAuthor('Author');
		$CI->pdf->SetTitle('Title');
		$CI->pdf->SetSubject('Subject');
		$CI->pdf->SetKeywords('keywords');
		
		// set font
		$CI->pdf->SetFont('helvetica', 'N', 6);
		
                $CI->pdf->setPrintHeader(false);
		$CI->pdf->setPrintFooter(false);
                
                // add a page
                if($landscape_portrait != '' && $paper_size != '')
                {
			// set default monospaced font
			$CI->pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
			// set margins
			//$CI->pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
			$CI->pdf->SetMargins(10, 10, 10);
			// set auto page breaks
			$CI->pdf->SetAutoPageBreak(TRUE, 0);
			$CI->pdf->AddPage($landscape_portrait, $paper_size);
                }
                else
                {
                    $CI->pdf->AddPage();
                }
		
		// write html on PDF
		$CI->pdf->writeHTML($view_file_name, true, false, true, false, '');
		ob_clean();
		
		//Close and output PDF document
		$CI->pdf->Output($output_file_name_path, $output_option);
	}
}


if(!function_exists('array_sort_by_column')){
	function array_sort_by_column(&$arr, $col, $dir = SORT_ASC) {
	    $sort_col = array();
	    foreach ($arr as $key=> $row) {
		$sort_col[$key] = $row[$col];
	    }	
	    array_multisort($sort_col, $dir, $arr);
	}
}

if(!function_exists('currentClass')){
	function currentClass(){
		$CI = & get_instance();
		$class = $CI->router->class;
		return  $class;
	}
}

if(!function_exists('currentMethod')){
	function currentMethod(){
		$CI = & get_instance();
		$method = $CI->router->method;
		return  $method;
	}
}
if(!function_exists('isFileExist'))
{
	function isFileExist($file_path)
	{
		$ch	= curl_init($file_path);
		curl_setopt($ch, CURLOPT_NOBODY, true);
		curl_exec($ch);
		
		$retcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		
		if($retcode == 200)
		{
		    return  $file_path;
		}
		else
		{
		    return  FRONT_IMAGE_PATH.'no_img.jpg';
		}
		// $retcode >= 400 -> not found, $retcode = 200, found.
		curl_close($ch);
		
	}
}
if(!function_exists('dayDiff')){
	function dayDiff($startdate,$enddate){
		$startTimeStamp = strtotime($startdate);
		$endTimeStamp = strtotime($enddate);
		
		$timeDiff = abs($endTimeStamp - $startTimeStamp);
		
		$numberDays = $timeDiff/86400;  // 86400 seconds in one day
		
		// and you might want to convert to integer
		$numberDays = intval($numberDays);
		
		return $numberDays;
	}
}

if(!function_exists('dbDate')){
	function dbDate($date,$seprator){
		$date_arr = explode($seprator,$date);
		$date = '';
		if(is_array($date_arr)){
			$date  = $date_arr[2].'-'.$date_arr[1].'-'.$date_arr[0];
		}
		return $date;
	}
}

if(!function_exists('getFileNewName')){
    function getFileNewName($file_name){
        $new_file_name = '';
        if($file_name){
            $file_info = pathinfo($file_name);
            if(is_array($file_info)){
                $rand_text = rand(0,999999);
                $file_info['filename'] = str_replace(' ','_',$file_info['filename']);
                $new_file_name = $file_info['filename'].'_'.$rand_text.'.'.$file_info['extension'];
            }
        }
        return $new_file_name;
    }
}

if(!function_exists('getLatLong'))
{
	function getLatLong($address)
	{
		$address = str_replace(" ", "+", $address);
	    
		$json = file_get_contents("http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false");
		$json = json_decode($json);
		
		$arr_lat_long = array();
	    
		$lat = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
		$long = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
		
		$arr_lat_long[0] = $lat;
		$arr_lat_long[1] = $long;
		
		return $arr_lat_long;
	}
}

if(!function_exists('imageCrop'))
{
	function imageCrop($config)
	{
		
		$file_path  	= $config['file_path'];
		$x  		= $config['x'];
		$y  		= $config['y'];
		$w  		= $config['w'];
		$h  		= $config['h'];
		$targ_w  	= $config['targ_w'];
		$targ_h  	= $config['targ_h'];//exit();
		$quality  	= $config['quality'];
		$uploaded_path	= $config['uploaded_path'];
		$image_type	= $config['image_type'];
		$img_r		= '';	
		if($image_type == 'image/jpeg'|| strtolower($image_type) == 'image/jpg')
		{
			$img_r 		= imagecreatefromjpeg($file_path);
		}
		else if($image_type == 'image/png')
		{
			$img_r 		= imagecreatefrompng($file_path);
		}
		else if($image_type == 'image/gif')
		{
			$img_r 		= imagecreatefromgif($file_path);
		}

		$dst_r 		= ImageCreateTrueColor( $targ_w, $targ_h );			
		imagecopyresampled($dst_r,$img_r,0,0,$x,$y,$targ_w,$targ_h,$w,$h);
		if($image_type == 'image/jpeg' || strtolower($image_type) == 'image/jpg')
		{
			header('Content-type: image/jpeg');
			imagejpeg($dst_r,$uploaded_path,$quality);
		}
		else if($image_type == 'image/png')
		{
			header('Content-type: image/png');
			imagepng($dst_r,$uploaded_path,9);
		}
		else if($image_type == 'image/gif')
		{
			header('Content-type: image/gif');
			imagegif($dst_r,$uploaded_path,$quality);
		}
			
		return true;
	}
}


if(!function_exists('imageCropCustom'))
{
	function imageCropCustom($config)
	{
		
		$file_path  	= $config['file_path'];
		$x  		= $config['x'];
		$y  		= $config['y'];
		$w  		= $config['w'];
		$h  		= $config['h'];
		$targ_w  	= $config['targ_w'];
		$targ_h  	= $config['targ_h'];//exit();
		$quality  	= $config['quality'];
		$uploaded_path	= $config['uploaded_path'];
		$image_type	= $config['image_type'];
		$img_r		= '';	
		if($image_type == 'image/jpeg'|| strtolower($image_type) == 'image/jpg')
		{
			$img_r 		= imagecreatefromjpeg($file_path);
		}
		else if($image_type == 'image/png')
		{
			$img_r 		= imagecreatefrompng($file_path);
		}
		else if($image_type == 'image/gif')
		{
			$img_r 		= imagecreatefromgif($file_path);
		}

		$dst_r 		= ImageCreateTrueColor( $targ_w, $targ_h );			
		imagecopyresampled($dst_r,$img_r,0,0,$x,$y,$targ_w,$targ_h,$w,$h);
		if($image_type == 'image/jpeg' || strtolower($image_type) == 'image/jpg')
		{
			header('Content-type: image/jpeg');
			imagejpeg($dst_r,$uploaded_path,$quality);
		}
		else if($image_type == 'image/png')
		{
			header('Content-type: image/png');
			imagepng($dst_r,$uploaded_path,9);
		}
		else if($image_type == 'image/gif')
		{
			header('Content-type: image/gif');
			imagegif($dst_r,$uploaded_path,$quality);
		}
			
		return true;
	}
}

