<?php
/*4:11pm*/
/*global declaration*/
@session_start();

    
class data_url

	{
    public function get_url($type)
		{
			global $base_url;
			switch ($type)
			{
		case "loader-img-popup":
			$url = $base_url . "/images/ldr_img-def-416.gif";
			break;

		case "lnk-loader_image":
			$url = $base_url . "/images/ldr_img-def-416.gif";
			break;

		case "productImage":
			$url = $base_url . "/assets/img/default_img.jpg";
			break;

		   case "userImage":
			$url = $base_url . "/assets/images/user_default.jpg";
			break;
			}

		return $url;
		}
	}

$GLOBALS['image_url'] = new data_url();
 

/*string rearrange*/

  function string_rearrange($string)
	{
	 return ucfirst(strtolower($string));
	}

/*change string*/

function change_string($string, $type)
	{
	if ($type == "sms")
		{
		$str_len = strlen($string) - 2;
		$str_slice = str_split($string, $str_len);
		$new_string = str_repeat('*', max(0, $str_len)) . $str_slice[1];
		}

	if ($type == "email")
		{
		$str_exp = explode("@", $string);
		$get_first_letter = substr($string, 0, 2);
		$last_letter = substr($str_exp[0], -1);
		$str_len = strlen($str_exp[0]) - 3;
		$new_string = $get_first_letter . str_repeat('*', max(0, $str_len)) . $last_letter . "@" . $str_exp[1];
		}

	return $new_string;
	}

 

 
/*funct for single value url encode/decode
encode with single value
decode with single value
*/

function single_Dataencode($single_data, $type)
	{
	if ($type == "encode")
		{
		return urlencode(base64_encode($single_data));
		}

	if ($type == "decode")
		{
		return base64_decode(urldecode($single_data));
		}
	}

/*check user role*/
 
function data_array_to_obj($array)
	{
	if (!is_array($array))
		{
		return $array;
		}

	$object = new stdClass();
	if (is_array($array) && count($array) > 0)
		{
		foreach($array as $name => $value)
			{
			$name = trim($name);
			if ($name != "")
				{
				$object->$name = data_array_to_obj($value);
				}
			}

		return $object;
		}
	  else
		{
		return "";
		}
	}
 

/*funct for css js external file include*/


/* validate email*/

function is_validemail($email)
	{
	$pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/";
	preg_match($pattern, $email, $matches);
	if ($matches != NULL)
		{
		return TRUE;
		}
	  else
		{
		return FALSE;
		}
	}

function is_validurl($url)
	{ 
	// Remove all illegal characters from a url 
	$url = filter_var($url, FILTER_SANITIZE_URL);  
	// Validate url 
	if (!filter_var($url, FILTER_VALIDATE_URL) === false)
		{
		 return TRUE;
		}
	  else
		{
		 return FALSE;
		}
	}

/*funct for image data encode and decode
*/

function data_encode($data, $type)
	{
	if ($type == "encode")
		{
		return strtr(rtrim(base64_encode($data) , '=') , '+/', '-_');
		}

	if ($type == "decode")
		{
		return base64_decode(strtr($data, '-_', '+/'));
		}
	}

/*replace apostrephe*/

function sql_quote_string($string)
	{
		return trim(str_replace("'", "\'", mb_convert_encoding ($string,"UTF-8")));
	}
 
/*image upload*/

function qisk_image_upload($logo, $folder_assign, $crop_x = NULL, $crop_y = NULL, $crop_width = NULL, $crop_height = NULL)
	{
	$length = 10;
	$randomnum = rand();
	$randomstring = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ" . $randomnum . "") , 0, $length);
	$random = $randomstring . date("ydHis") . ".jpg";
	$logo_type = $logo['type'];
	if (is_array($logo))
		{
		$logo_name = $logo['name'];
		$logo_temp_name = $logo['tmp_name'];
		$logo_type = $logo['type'];
		}
	  else
		{
		$logo_name = $logo;
		$logo_type = "image/jpeg";
		$logo_temp_name = $logo;
		}

	$logo_size = getimagesize($logo_temp_name);
	$pic_width = $logo_size[0];
	$pic_height = $logo_size[1];
	if ($crop_x == NULL)
		{
		$crop_x = 0;
		}

	if ($crop_y == NULL)
		{
		$crop_y = 0;
		}

	if ($crop_width == NULL)
		{
		$crop_width = $pic_width;
		}

	if ($crop_height == NULL)
		{
		$crop_height = $pic_height;
        }
         
	if ($logo_name != "")
		{
		$site_path = str_replace("/admin015", "/images", get_qisk_homepath());
		$base_url = str_replace("admin015", "images", qisk_home_url());
		if (!file_exists($site_path . "/" . $folder_assign))
			{
			mkdir($site_path . "/" . $folder_assign, 0777, true);
			}

		$dir_path = $site_path . "/" . $folder_assign;
		if ($logo_type == "image/PNG")
			{
			$movefile = imagecreatefrompng($logo_temp_name);
			}
		elseif ($logo_type == "image/png")
			{
			$movefile = imagecreatefrompng($logo_temp_name);
			}
		elseif ($logo_type == "image/JPEG")
			{
			$movefile = imagecreatefromjpeg($logo_temp_name);
			}
		elseif ($logo_type == "image/jpeg")
			{
			$movefile = imagecreatefromjpeg($logo_temp_name);
			}
		elseif ($logo_type == "image/JPG")
			{
			$movefile = imagecreatefromjpeg($logo_temp_name);
			}
		elseif ($logo_type == "image/jpg")
			{
			$movefile = imagecreatefromjpeg($logo_temp_name);
			}
		elseif ($logo_type == "image/GIF")
			{
			$movefile = imagecreatefromgif($logo_temp_name);
			}
		elseif ($logo_type == "image/gif")
			{
			$movefile = imagecreatefromgif($logo_temp_name);
			}
		  else
			{
			$movefile = imagecreatefromgif($logo_temp_name);
			}

		if ($movefile)
			{
			$empty_img = imagecreatetruecolor($crop_width, $crop_height);
			$white_bg = imagecolorallocate($empty_img, 255, 255, 255);
			if ($logo_type == "image/png")
				{
				imagefilledrectangle($empty_img, 0, 0, $crop_width, $crop_height, $white_bg);
				}
			  else
				{
				imagefill($empty_img, 0, 0, $white_bg);
				}

			imagecopyresampled($empty_img, $movefile, 0, 0, $crop_x, $crop_y, $crop_width, $crop_height, $crop_width, $crop_height);
			if ($crop_width > $crop_height)
				{
				$to_crop_array = array(
					'x' => 0,
					'y' => 0,
					'width' => $crop_height,
					'height' => $crop_height
				);
				$empty_img = imagecrop($empty_img, $to_crop_array);
				}

			$movedfile = imagejpeg($empty_img, $site_path . "/" . $folder_assign . "/" . $random, 100);
			if ($movedfile)
				{
				return $logoname = $base_url . "/" . $folder_assign . "/" . $random;
				}
			}
		}
	}

function image_url_data()
	{
	global $qisk_db, $qisk, $qiskTBL, $base_url;
	$image_path_url = IMAGES_PORT;
	return $image_path_url;
	}

/*full image upload*/

function qisk_full_image_upload($logo,$folder_assign,$old_image=NULL, $crop_x = NULL, $crop_y = NULL, $crop_width = NULL, $crop_height = NULL)
	{
		$image_set=array();
	
	if (is_array($logo))
		{
		$logo_name = $logo['name'];
		$logo_temp_name = $logo['tmp_name'];
		$logo_type = $logo['type'];
		}
	  else
		{
		$logo_name = $logo;
		$logo_type = "image/jpeg";
		$logo_temp_name = $logo;
		}

	$logo_size = getimagesize($logo_temp_name);
	$pic_width = $logo_size[0];
	$pic_height = $logo_size[1];
	if ($crop_x == NULL)
		{
		$crop_x = 0;
		}

	if ($crop_y == NULL)
		{
		$crop_y = 0;
		}

	if ($crop_width == NULL)
		{
		$crop_width = $pic_width;
		}

	if ($crop_height == NULL)
		{
		$crop_height = $pic_height;
		}

	if ($logo_name != "")
		{
		/* Folder change */
	 //$site_path = str_replace("/admin", "/img21", get_qisk_homepath());

	    $site_path = get_qisk_homepath();

		/* Domain  change */
		$base_url = IMAGE_PORT;

		// $base_url = image_url_data();
	
		if (!file_exists($site_path . "/" . $folder_assign))
			{
			   mkdir($site_path . "/" . $folder_assign, 0777, true);
			}

 $logo_type = strtolower($logo_type);
		
      
		if ($logo_type == "image/png")
			{
		     	$movefile = imagecreatefrompng($logo_temp_name);
			}
		elseif ($logo_type == "image/jpeg")
			{
			   $movefile = imagecreatefromjpeg($logo_temp_name);
			}
		elseif ($logo_type == "image/jpg")
			{
			   $movefile = imagecreatefromjpeg($logo_temp_name);
			}
		elseif ($logo_type == "image/gif")
			{
			   $movefile = imagecreatefromgif($logo_temp_name);
			}
			elseif ($logo_type == "image/webp")
			{
			   $movefile = imagecreatefromwebp($logo_temp_name);
			}
		  else
			{
			$movefile = imagecreatefromgif($logo_temp_name);
			}
   
		if ($movefile)
			{
			$empty_img = imagecreatetruecolor($crop_width, $crop_height);
			$white_bg = imagecolorallocate($empty_img, 255, 255, 255);
			if ($logo_type == "image/png")
				{
				imagefilledrectangle($empty_img, 0, 0, $crop_width, $crop_height, $white_bg);
				}
			  else
				{
				imagefill($empty_img, 0, 0, $white_bg);
				}
$quality=70; 
			imagecopyresampled($empty_img, $movefile, 0, 0, $crop_x, $crop_y, $crop_width, $crop_height, $crop_width, $crop_height);
            $length = 10;
            $randomnum = rand();
            $randomstring = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ" . $randomnum . "") , 0, $length);
            $random = $randomstring . date("ydHis") . ".jpg";
            $logoname = $base_url . "/" . $folder_assign . "/" . $random;	 
			$movedfile = imagejpeg($empty_img, $site_path . "/" . $folder_assign . "/" . $random, $quality);
			
			if ($movedfile)
				 {
					 if($old_image!=NULL)
					 {
						 unlink($old_image);
					 }
				   ob_start (); 
				   imagejpeg($empty_img,NULL, $quality);
				   imagedestroy($empty_img);
				   $image_data = ob_get_contents (); 
				   $image_data_base64 = base64_encode ($image_data);	
				   
				   ob_end_clean (); 
				   $logoname = $base_url . "/" . $folder_assign . "/" . $random;
				   $image_set = array("image_url"=>$logoname,"image_data"=>"data:image/jpeg;base64,".$image_data_base64);
				   
				}
			  }  
		}
		return $image_set;
	} 

function admin_default_timezone()
	{
	return "UTC";
	}

/*time and date from timezone*/

function get_date_time($date = NULL, $utc_offset = NULL)
	{
	if ($utc_offset == NULL)
		{
		$utc_offset = date_default_timezone_get();
		}

	if ($date == NULL)
		{
		$curr_date = new DateTime();
		$date = $curr_date->format("Y-m-d H:i:s");
		}

	$new_date = new DateTime($date);
	$new_date->setTimeZone(new DateTimeZone($utc_offset));
	return $new_date;
	}

function image_qisk_site_url()
	{
	return IMAGES_PORT;
	}

function get_image_url()
	{
	return IMAGES_PORT;
	}

function get_main_domain()
	{
	return MAIN_DOMAIN;
	}

/* log file create in function */

function create_user_unique_id($user_id)
{
    return "hydac_log" . $user_id . "tm";
}

function log_maintain($process = NULL)
	{
	$ip = client_ip();
	$useremil = get_user_data();
	$date = new DateTime();
	$curr_date = $date->format("d/M/Y H:i:s");
	$server_method = $_SERVER['REQUEST_METHOD'];
	$server_pro = $_SERVER['SERVER_PROTOCOL'];
	$req_uri = $_SERVER['REQUEST_URI'];
	$red_status = $_SERVER['REDIRECT_STATUS'];
	$memory = number_format((memory_get_usage() / 1024) , 2, ".", "");
	/* Ip address using  location get */
	$loc_data = file_get_contents("http://freegeoip.net/json/" . $ip);
	$loc_value = json_decode($loc_data);
	$country_name = $loc_value->country_name;
	$region_name = $loc_value->region_name;
	$city = $loc_value->city;
	$data_create = $ip . " '" . $country_name . "," . $region_name . "," . $city . "' admin " . $useremil . " [" . $curr_date . "] '" . $server_method . " " . $req_uri . " " . $server_pro . "' " . $red_status . " " . $memory . "KB " . $_SERVER['HTTP_USER_AGENT'] . " " . $process . "\n";
	$site_path = get_qisk_homepath();
	if (!file_exists($site_path . "/log"))
		{
		mkdir($site_path . "/log", 0777, true);
		}

	$dir_path = $site_path . "/log";
	$file_name = $dir_path . "/" . date("Y-m-d") . ".log";
	if (!file_exists($file_name))
		{
		file_put_contents($file_name, $data_create, FILE_APPEND | LOCK_EX);
		chmod($file_name, 0777);
		}
	  else
		{
		file_put_contents($file_name, $data_create, FILE_APPEND | LOCK_EX);
		}
	}

 
function randomstring($length = 10) 
	{
	$randomnum = rand();
	$item_code = rand(11111, 999999);
	$date = date('YmdHis');
	$randomstring = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ" . $randomnum . "") , 0, $length).$date;
	return $randomstring;
	}

function permission_admin_msg()
	{
?>
<style>
    div#prevnt_accss_bx {
    background-color: #f8f8f8;
    width: auto;
    height: 100%;
    padding: 30px;
}
    body
    {
        margin: 0;
        padding: 0;
        
    }
</style>
<section id="main-content">
<section class="wrapper">
              <!-- page start-->
              <div class="row">
                  <div class="col-lg-12">
<div id="prevnt_accss_bx">You dont have the permission to access this page. Please contact the administrator.</div>
                      </div>
                  </div>
    </section>
    </section>
<?php
	}

function randomstring_num()
	{
	$length = 10;
	$randomnum = rand();
	$item_code = rand(11111, 999999);
	$date = date('Y-m-d H:i:s');
	$randomstring = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ" . $randomnum . "") , 0, $length);
	return $randomstring;
	}

/* get currentdatetime */

function get_currentDateTime()
	{
	global $Ip_loc_data;
	$loc_data = $Ip_loc_data->loc_data;
	$curr_date = get_date_time(NULL, $loc_data->time_zone);
	return $curr_date;
	}

/*smart timestamp*/

function get_smart_timestamp($datetime, $time_zone=NULL)
	{
		if($time_zone!=NULL)
		{
	global $Ip_loc_data;
	 if($Ip_loc_data!=NULL)
	{
	  if($Ip_loc_data->loc_data)
	  {
		$time_zone= $Ip_loc_data->loc_data->time_zone;
	  }
	} 
		}
	$curr_date = get_date_time(NULL, $time_zone);
	$time_date = get_date_time($datetime, $time_zone);
	$diff_date = $time_date->diff($curr_date);
	if ($diff_date->days == 0)
		{
		if ($diff_date->h == 0 && $diff_date->i == 0)
			{
			if ($diff_date->s < 15)
				{
				$output = "just now";
				}
			  else
				{
				$output = $diff_date->s . "sec ago";
				}
			}
		elseif ($diff_date->h == 0 && $diff_date->i > 0)
			{
			$output = $diff_date->i . "min ago";
			}
		elseif ($diff_date->h > 0)
			{
			$output = $diff_date->h . "h ago";
			}
		  else
			{
			$output = $diff_date->h . "h ago";
			}
		}
	elseif ($diff_date->days == 1)
		{
		if ($diff_date->h <= 13)
			{
			if (intval($time_date->format("G")) >= 0 and intval($time_date->format("G")) < 23)
				{
				$output = "yesterday at " . $time_date->format("g:ia");
				}
			  else
				{
				$output = $time_date->format("M j") . " at " . $time_date->format("g:ia");
				}
			}
		  else
			{
			$output = $time_date->format("M j") . " at " . $time_date->format("g:ia");
			}
		}
	elseif ($diff_date->days > 1 && $diff_date->y == 0)
		{
		$output = $time_date->format("M j") . " at " . $time_date->format("g:ia");
		}
	  else
		{
		$output = $time_date->format("j M, Y") . " at " . $time_date->format("g:ia");
		}

	return $output;
	}

function client_ip()
	{
	if (!empty($_SERVER['HTTP_CLIENT_IP']))
		{
		$ip = $_SERVER['HTTP_CLIENT_IP'];
		}
	elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
		{
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		}
	  else
		{
		$ip = $_SERVER['REMOTE_ADDR'];
		}

	return $ip;
	}

/* token create in functions */

function get_accessToken($length)
	{
	$key = '';
	$keys = array_merge(range(0, 9) , range('a', 'z') , range('A', 'Z'));
	for ($i = 0; $i < $length; $i++)
		{
		$key.= $keys[array_rand($keys) ];
		}

	return $key;
	}

function crypto_rand_secure($min, $max)
	{
	$range = $max - $min;
	if ($range < 1) return $min; // not so random...
	$log = ceil(log($range, 2));
	$bytes = (int)($log / 8) + 1; // length in bytes
	$bits = (int)$log + 1; // length in bits
	$filter = (int)(1 << $bits) - 1; // set all lower bits to 1
	do
		{
		$rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
		$rnd = $rnd & $filter; // discard irrelevant bits
		}

	while ($rnd > $range);
	return $min + $rnd;
	}

function getToken($length)
	{
	$token = "";
	$codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	$codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
	$codeAlphabet.= "0123456789";
	$max = strlen($codeAlphabet); // edited
	for ($i = 0; $i < $length; $i++)
		{
		$token.= $codeAlphabet[crypto_rand_secure(0, $max - 1) ];
		}

	return $token;
	}

	function random_password( $length = 10 )
	 {
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
		$password = substr( str_shuffle( $chars ), 0, $length );
		return $password;
	}

/*upload file*/

function qisk_file_upload($file, $folder_assign)
	{
	global $base_url, $qisk_db;
	$resp_data = NULL;
	if ($file != NULL)
		{
			$file_name = $file['name'];
			$file_temp_name = $file['tmp_name'];
			$file_type = $file['type'];
			$length = 15;
		$randomnum = rand();
		$randomstring = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ" . $randomnum . "") , 0, $length);
		$imageFileType = pathinfo($file_name, PATHINFO_EXTENSION);
		$new_file_name = $randomstring . "." . $imageFileType; 
        $site_path=str_replace("/admin","/front",get_qisk_homepath());
		if (!file_exists($site_path . "/" . $folder_assign))
			{
			    mkdir($site_path . "/" . $folder_assign, 0777, true);
			}
		$move_file = move_uploaded_file($file_temp_name, $site_path . "/" . $folder_assign . "/" . $new_file_name);
		if ($move_file)
			{   
              $path_url = $site_path . "/" . $folder_assign . "/" . $new_file_name;
              $url = MAIN_DOMAIN . "/" . $folder_assign . "/" . $new_file_name;
              $resp_data = array("path_url"=>$path_url,"url"=>$url);
			}
		}

	return $resp_data;
    }
    

	

	
   function strip_string_words_continue($string, $limit = NULL)
	{
	$string = strip_tags($string);
	if ($limit != NULL)
		{
		if (strlen($string) > $limit)
			{
			$string = substr($string, 0, $limit)."...";
			 }
		}
   
	return $string;
    }
    

function JS_CSS_UNIQ_ID()
{
	global $qisk_db;
	$get_js_css_uniq_id = $qisk_db->get_results("select option_value from ".DB_PREFIX."_options where option_name='JS_CSS_UNIQ_ID' ");
	if($get_js_css_uniq_id!=NULL)
	{
	   return $get_js_css_uniq_id[0]->option_value;
	}
}

function image_remove($image_url)
{
if ($image_url != "")
    {
        // $site_path=str_replace("/admin","/front",get_qisk_homepath());
        // $base_url=str_replace("qatar","qatarfactory",qisk_home_url());
         $site_path = get_qisk_homepath();

		/* Domain  change */
		$base_url = IMAGE_PORT;
        $image = str_replace($base_url, $site_path, $image_url);
        return unlink($image);
    }
}
function change_url_para($chng_url_name)
{
    if($chng_url_name!=NULL)
    {
        $url_name = strtolower(str_replace("'", "", preg_replace("/[^A-Za-z0-9\-_']/", "-",$chng_url_name)));
        $url_name = preg_replace('/-+/', '-', $url_name);
    }
    return $url_name;
}

	

// require_once "vendor/autoload.php";
include "detect_device/detect.php";
/*include file check in process */
include "header-data-functions.php";
/* Main global functions */
include "qisk_main_functions.php";

/* global main functions */
include "global_main_function.php"; 
include "user-data-functions.php"; 

include "report_data_functions.php"; 

 
 include "product_data_functions.php"; 

