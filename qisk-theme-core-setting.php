<?php
/*qisouk core setting*/
require (dirname(__FILE__) . "/qisk-load.php");

$url_param = parse_url($_SERVER['REQUEST_URI']);

if (array_key_exists("query", $url_param))
	{
	$curr_page = str_replace("?", "", str_replace($url_param['query'], "", get_qisk_page_url()));
	}
  else
	{
	 $curr_page = str_replace("?", "", get_qisk_page_url());
    }
   
if($curr_page==get_option("siteurl")||$curr_page==qisk_home_url()."/")
{
     
	if (check_home_template() != NULL)
		{ 
		$page_template = get_qisk_theme_root() . "/qisk-theme/" . check_home_template()->_page_template;
		if (file_exists($page_template))
			{
			  include $page_template;
			}
		  else
			{
               include dirname(__FILE__) . "/qisk-theme/index.php"; 
			} 
		}
	  else
		{
		include dirname(__FILE__) . "/qisk-theme/index.php";

		}
	}
  else
	{
	include dirname(__FILE__) . "/qisk-includes/qisk-template-manager.php";
	}
 
