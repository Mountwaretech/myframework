<?php
 
require(dirname( __FILE__ )."/qisk-config.php");
/*error reporting*/
if(qisk_DEBUG)
{
error_reporting(E_ALL);
ini_set("display_errors", 1);
}
include (dirname( __FILE__ )."/qisk-theme/qisk-functions.php");
/*mail configure*/
include (dirname( __FILE__ )."/qisk_mail_config.php");


/*caution:change base_url to live*/
$GLOBALS['base_url']=qisk_home_url();

/*data base connection*/
 
class qisk_db
{
  private static $main_var = NULL;
  function __construct($DB_HOST=DB_HOST,$DB_NAME=DB_NAME,$DB_USERNAME=DB_USERNAME,$DB_PASSWORD=DB_PASSWORD)
    {
 $this->db_host=$DB_HOST;
  $this->db_name=$DB_NAME;
  $this->db_username=$DB_USERNAME;
  $this->db_pass=$DB_PASSWORD;
   $this->charset=DB_CHARSET;   
  $this->connec=0;
        if (!$this->connec)
    {
    $this->connec= new PDO("mysql:host=".$this->db_host.";dbname=". $this->db_name.";charset=".DB_CHARSET."", $this->db_username, $this->db_pass);
        
    $this->connec->setAttribute(PDO::ATTR_EMULATE_PREPARES, 1);    
    $this->connec->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	                        
   }
      
   
 }


 /*fetch results*/
    public function get_results($getquery,$param=NULL,$type=NULL)
         {
           
             try
			{
             $PDO_connect=$this->connec;
			$data_query=$PDO_connect->prepare($getquery);
         if($param!=NULL)
         {
            foreach($param as $param_name => &$param_value) 
            {
             $data_query->bindParam(':'.$param_name, $param_value);
            }
         }
            $data_query->execute();
            if($type==NULL)
            {
              $fetch_type=PDO::FETCH_OBJ; 
               
            }
            if($type=="_A")
            {
                $fetch_type=PDO::FETCH_ASSOC; 
            }
             $fetch_data=$data_query->fetchAll($fetch_type);
            return $fetch_data;
              
			}
catch( PDOException $Exc ) {
      echo $Exc->getMessage();  
             die();
                 return FALSE;
                 }
			
            
         }
         /*action results such like insert , update,delete and alter
        return value  last insert row id
         */
         public function query($getquery,$param=NULL)
         {
             try
			{
             $PDO_connect=$this->connec;
            $data_query=$PDO_connect->prepare($getquery);
           
           
           /*for insertion*/
            if (strpos(strtolower($getquery),'insert') !== false)
             {
                $data_query->execute($param);
        
    return $PDO_connect->lastInsertId();
                }
                
                 /*for update,delete,etc*/
                else{
                   
                      if($param!=NULL)
         {
         foreach($param as $param_name => &$param_value) 
            {
          $data_query->bindParam(':'.$param_name, $param_value);
            }
         }
            $data_query->execute();
                    return $data_query;
                }
            }
         
			catch( PDOException $Exc ) { 
          echo $Exc->getMessage();
           die();
        return FALSE;}    }
}
$GLOBALS['qisk_db']=new qisk_db(); 
 
/*qisk table prefix*/
class qisk_main_prefix
{
   public static function get_qisk_mainTable_prefix()
    {
       
        return $qisk_main_prefix="qisk";
    }
}
/*qiskical main table prefix for handle queries
*/
$GLOBALS['qiskTBL']=qisk_main_prefix::get_qisk_mainTable_prefix();

class qisk_predefined_func

	{
        function __construct()
        {
            $this->rewrite_tag=rewrite_tags();
        }
	public function query_vars()
		{
		$rew_tags = $this->rewrite_tag;
      	$query_vars = NULL;
		foreach($rew_tags as $tags)
        {
			 foreach($tags as $tag_key => $tag_val)
				{
				$url_param = parse_url($_SERVER['REQUEST_URI']);
				if (array_key_exists("query", $url_param))
					{
					preg_match($tag_key . "^", str_replace("?", "", str_replace($url_param['query'], "", $_SERVER['REQUEST_URI'])) , $preg_matches);
					}
				  else
					{
					preg_match($tag_key . "^", str_replace("?", "", $_SERVER['REQUEST_URI']) , $preg_matches);
					}
              	if ($preg_matches != NULL)
					{
                        $url_param_tag = parse_url($tag_val['subject']);
                       
					$query_string = $url_param_tag['query'];
					parse_str($query_string, $query_vars);
                    $query_vars_key = array_keys($query_vars);
					$count_query = count($query_vars);
					$init = 0;
                      for ($init = 0; $init < $count_query; $init++)
						{
						if (strpos($query_vars[$query_vars_key[$init]], "\$matches") !== false)
							{
							preg_match("^\d^", $query_vars[$query_vars_key[$init]], $matches);
                            if (isset($preg_matches[$matches["0"]]))
								{
								$query_param_val = $preg_matches[$matches["0"]];
								}
							  else
								{
								$query_param_val = "";
								}

							$query_vars[$query_vars_key[$init]] = $query_param_val;
                            
							}
                           
						}
                         break;
                    }
                  
				}
            }
           return $query_vars;
        }
       
	}
$GLOBALS['qisk']=new qisk_predefined_func();
/*qiskical initial loading functions*/
if(!function_exists("get_option"))
{
 function get_option($data)
 {
    
     global $qisk_db;
   
     $params=array("opt_name"=>$data); 
$get_option=$qisk_db->get_results("select * from ".DB_PREFIX."_options where option_name=:opt_name ",$params);
if($get_option!=NULL)
{
$option_val=$get_option[0]->option_value;
return $option_val;
}
    
 }   
}
  

 
 /*get qiskical site url */
function qisk_site_url( $path = '', $scheme = NULL ) {
  
        return get_site_url($path, $scheme );
	}
    /*get site url based on scheme*/
function get_site_url($path = '', $scheme = NULL ) {
    $url = get_option( 'siteurl' );
        if($scheme==NULL)
        {
            if($path=='')
            {
             return $url;   
            }
             else{
              return $url."/".$path;   
             } 
      
        }
        if($scheme!=NULL)
        {
            if(check_scheme($scheme))
            {
             if($path=='')
            {
             return $url;   
            }
             else{
              return $url."/".$path;   
             } 
            }
            else
            {
             return $url;      
            }
        }
	      
	}
    /*check schema*/
    function check_scheme($scheme)
    {
        if($scheme=="rpc")
        {
            return TRUE;
        }
        elseif($scheme=="http")
        {
           return TRUE;  
        }
         elseif($scheme=="https")
        {
           return TRUE;  
        }
        else
        {
            return FALSE;
        }
    }
    /*get page_template*/
    function get_page_template($page_id=NULL)
    {        if($page_id!=NULL)        {       global $qisk_db;  $params=array("post_id"=>$page_id);
 
        $get_page_template=$qisk_db->get_results("select * from ".DB_PREFIX."_posts where id=:post_id ",$params);  
        
              if($get_page_template!=NULL)        {     
                  return $get_page_template[0];        
                  }       
                   }
    }
/*home template exist or not*/
function check_home_template()
{
     global $qisk_db;  $params=array("post_type"=>"home");
        $get_page_template=$qisk_db->get_results("select _page_template from ".DB_PREFIX."_posts where type=:post_type",$params);
        if($get_page_template!=NULL)
        {
           return $get_page_template[0];    
        }         
}

class getIp_loc_data
 {
	 function __construct()
     {
         $ip = client_ip();
         $ip_url="https://freegeoip.net/json/" . $ip;
          $header = array();          
        $ch = curl_init(); 
         curl_setopt_array($ch, array( 
            CURLOPT_URL => $ip_url,     
            CURLOPT_HTTPHEADER => $header,
            CURLOPT_POST => FALSE,
            CURLOPT_RETURNTRANSFER => TRUE
        ));    
        $output = curl_exec($ch);
        curl_close($ch);
           $this->loc_data = json_decode($output);
           if(isset($this->loc_data->time_zone))
           {
           $this->loc_data->time_zone = $this->loc_data->time_zone;
           }
           else
           {
            $this->loc_data->time_zone = "UTC";
           }
     }  
} 

$GLOBALS['Ip_loc_data'] = new getIp_loc_data();

class get_BrachData
 {
	 function __construct()
     {
        global $qisk_db;  
        $get_branch_data=$qisk_db->get_results("select branch_listData.* from smart_admin inner join branch_listData  on smart_admin.ref_branch_uniqueid=branch_listData.branch_uniqueid where smart_admin.user_unique_id='".sql_quote_string($_SESSION['admin_unique_id'])."' ");
        if($get_branch_data!=NULL)
        {
            $this->branch_uniqueid = $get_branch_data[0]->branch_uniqueid;
            $this->branch_name = $get_branch_data[0]->branch_name;
            $this->branch_code = $get_branch_data[0]->branch_code;
            $this->date_of_add = $get_branch_data[0]->date_of_add;
        } 
     }
}
$GLOBALS['branch_data'] = new get_BrachData();