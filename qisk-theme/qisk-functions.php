<?php
/*15/07/2016 11:01 PM
modified by Balamurugan */
/*function for qisk*/

function header_err_resolve()
	{
	ob_get_clean();
  //ob_start('compress_output',0,PHP_OUTPUT_HANDLER_FLUSHABLE);
 }

    /* function compress_output($buffer) {
     $search = array(
		 '/(http:)/',
        '/\>[^\S ]+/s',
				'/[^\S ]+\</s',
				'/(\s)+/s',
				'/<!--(.|\s)*?-->/'
		  );
     $replace = array(
		'https:',
        '>',
				'<',
				'\\1',
				''
		);
		$buffer = preg_replace($search, $replace, $buffer);
   return $buffer;
    } 
function un_compress_output($buffer)
{
  return $buffer;
}*/
function img_to_data($image_file)
{
 	 $type = pathinfo($image_file, PATHINFO_EXTENSION);
	 $data= file_get_contents($image_file);
 	 $image_file = 'data:image/' . $type . ';base64,' . base64_encode($data);
 
 return	$image_file;
}
function minify_css($str){
    # remove comments first (simplifies the other regex)
    $re1 = <<<'EOS'
(?sx)
  # quotes
  (
    "(?:[^"\\]++|\\.)*+"
  | '(?:[^'\\]++|\\.)*+'
  )
|
  # comments
  /\* (?> .*? \*/ )
EOS;

    $re2 = <<<'EOS'
(?six)
  # quotes
  (
    "(?:[^"\\]++|\\.)*+"
  | '(?:[^'\\]++|\\.)*+'
  )
|
  # ; before } (and the spaces after it while we're here)
  \s*+ ; \s*+ ( } ) \s*+
|
  # all spaces around meta chars/operators
  \s*+ ( [*$~^|]?+= | [{};,>~+-] | !important\b ) \s*+
|
  # spaces right of ( [ :
  ( [[(:] ) \s++
|
  # spaces left of ) ]
  \s++ ( [])] )
|
  # spaces left (and right) of :
  \s++ ( : ) \s*+
  # but not in selectors: not followed by a {
  (?!
    (?>
      [^{}"']++
    | "(?:[^"\\]++|\\.)*+"
    | '(?:[^'\\]++|\\.)*+' 
    )*+
    {
  )
|
  # spaces at beginning/end of string
  ^ \s++ | \s++ \z
|
  # double spaces to single
  (\s)\s+
EOS;

    $str = preg_replace("%$re1%", '$1', $str);
    return preg_replace("%$re2%", '$1$2$3$4$5$6$7', $str);
}
add_qiskaction('init', 'header_err_resolve');
/*set default timezone*/
date_default_timezone_set('UTC');
/*qisk actions
functions load on page
*/

function add_qiskaction($type, $function_name)
	{
	/*initialize functions*/
	if ($type == "init")
		{
		if (function_exists($function_name))
			{
			$function_name();
			}
		}

	/*filters*/
	if ($type == "filter")
		{
		if (function_exists($function_name))
			{
			$function_name();
			}
		}
	}

/*check theme file exists*/

function check_themeFIle_exist($file_type, $file_name)
	{
	if ($file_type == "header")
		{
		return file_exists(get_qisk_theme_root() . "/qisk-theme/header-" . $file_name . ".php");
		}

	if ($file_type == "footer")
		{
		return file_exists(get_qisk_theme_root() . "/qisk-theme/footer-" . $file_name . ".php");
		}
	}

/*headers*/

function get_qisk_header($file_join = NULL)
	{
	if ($file_join != NULL)
		{
		if (check_themeFIle_exist("header", $file_join))
			{
			include get_qisk_theme_root() . "/qisk-theme/header-" . $file_join . ".php";

			}
		  else
			{
			include (get_qisk_theme_root() . "/qisk-theme/header.php");

			}
		}
	  else
		{
		include (get_qisk_theme_root() . "/qisk-theme/header.php");

		}
	}

/*headers*/  

function get_qisk_footer($file_join = NULL)
	{
	if ($file_join != NULL)
		{
		if (check_themeFIle_exist("footer", $file_join))
			{
			include get_qisk_theme_root() . "/qisk-theme/footer-" . $file_join . ".php";

			}
		  else
			{
			include get_qisk_theme_root() . "/qisk-theme/footer.php";

			}
		}
	  else
		{
		include get_qisk_theme_root() . "/qisk-theme/footer.php";

		}
	}

/*qiskfile handling*/
/*qisk theme root*/

function get_qisk_theme_root()
	{
	return dirname(__DIR__);
	}
function get_qisk_template_root()
	{
    return get_qisk_theme_root()."/qisk-theme/page-templates";
	}
    function get_qisk_functions_root()
	{
    return get_qisk_theme_root()."/qisk-theme/functions";
	}
/*qisk home path*/

function get_qisk_homepath()
	{
    	return getcwd();
	}

function curr_protocol()
	{
	$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
	return $protocol;
	}

/*qisk home url*/

function qisk_home_url()
	{
	return curr_protocol() . $_SERVER['HTTP_HOST'];
	}

/*current page url*/

function get_qisk_page_url()
	{
	/*SCRIPT_URI*/
	return qisk_home_url() . $_SERVER['REQUEST_URI'];
	}
    
/*404 error page*/

function get_404_page()
	{
	$page_not_found = get_qisk_theme_root() . "/qisk-theme/qisk-404.php";
	return $page_not_found;
	}

/*funct for identify device*/

function get_device_tm()
	{ 
			global $device;
			$device_type = $device->deviceType(); 
        if($device_type=="mobile")
        {
            $device_n = "mobile";
        }
        else
        {
            $device_n = "web";
        }
 	    return $device_n;
	}

/*function for rewrite_rule*/
function rewrite_tags()
	{ 

	  

	

		$rewrite_rule[] = add_rewrite_rule('^login/?$', 'index.php?qisk_page_id=2&page_type=login_page', '0'); 
		$rewrite_rule[] = add_rewrite_rule('^glb_data_func/?$', 'index.php?qisk_page_id=3', '0'); 
		$rewrite_rule[] = add_rewrite_rule('^user-listing/?$', 'index.php?qisk_page_id=11&page_type=user_managment', '0');

		$rewrite_rule[] = add_rewrite_rule('^stall-listing?$', 'index.php?qisk_page_id=4&page_type=stall_listing', '0'); 
		
   
		$rewrite_rule[] = add_rewrite_rule('^reports_management/?$', 'index.php?qisk_page_id=7&page_type=report_management', '0');
		$rewrite_rule[] = add_rewrite_rule('^report_func/?$', 'index.php?qisk_page_id=8&page_type=report_func', '0');
		$rewrite_rule[] = add_rewrite_rule('^profile/?$', 'index.php?qisk_page_id=9&page_type=report_func', '0'); 

		$rewrite_rule[] = add_rewrite_rule('^pdf-generator/?$', 'index.php?qisk_page_id=10&page_type=pdf', '0');

		/* Master page template */ 
		$rewrite_rule[] = add_rewrite_rule('^master/([A-Za-z0-9_-]+)/?$', 'index.php?qisk_page_id=12&page_type=master&data_type=$matches[1]', '0');
		$rewrite_rule[] = add_rewrite_rule('^branch-listing/?$', 'index.php?qisk_page_id=5&page_type=branch-listing', '0'); 

		$rewrite_rule[] = add_rewrite_rule('^student_listing/?$', 'index.php?qisk_page_id=13&page_type=student_listing', '0'); 
		
		/* product page template */ 
		$rewrite_rule[] = add_rewrite_rule('^product_category/?$', 'index.php?qisk_page_id=14&page_type=product_category', '0');
		$rewrite_rule[] = add_rewrite_rule('^product_listing/?$', 'index.php?qisk_page_id=15&page_type=product_listing', '0');
		$rewrite_rule[] = add_rewrite_rule('^prod_func/?$', 'index.php?qisk_page_id=16&page_type=report_func', '0');
		
		$rewrite_rule[] = add_rewrite_rule('^card_setting/?$', 'index.php?qisk_page_id=17&page_type=payment_listing', '0'); 	
		$rewrite_rule[] = add_rewrite_rule('^payment_history/?$', 'index.php?qisk_page_id=18&page_type=payment_history', '0'); 	
		
		$rewrite_rule[] = add_rewrite_rule('^ads-listing/?$', 'index.php?qisk_page_id=20&page_type=stall_management', '0'); 
		$rewrite_rule[] = add_rewrite_rule('^terminal-listing/?$', 'index.php?qisk_page_id=21&page_type=terminal_listing', '0');	

    /* page function file*/
	 /*survey*/
   uasort($rewrite_rule, 'sortBy_rewrite_rule');
  	return $rewrite_rule;
	}
       function sortBy_rewrite_rule($data_arr1,$data_arr2) 
  {
      $array_key1=array_keys($data_arr1);
     
      $array_key2=array_keys($data_arr2);
       if (intval($data_arr1[$array_key1[0]]['priority']) == intval($data_arr2[$array_key2[0]]['priority'])) {

        return 0;
    }
    return (intval($data_arr1[$array_key1[0]]['priority']) > intval($data_arr2[$array_key2[0]]['priority'])) ? -1 : 1;
  }
/*add rewrite rule*/

function add_rewrite_rule($pattern, $subject, $priority)
	{
	$rewrite_rules[$pattern] = array("subject"=>$subject,"priority"=>$priority);
	return $rewrite_rules;
	}
include "functions/qisk_pro_glb.php";
