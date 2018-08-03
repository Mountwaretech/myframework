<?php
/*global declaration*/
/* 19/08/2016 12:51AM  Worked In Last Schedule
created: M.BALA
date:20/07/2016 7:51 PM
modified:M.BALA  */
@session_start();
/*checkout functions*/

function pic_size_css($image_data)
	{
    $logo_size = getimagesize($image_data);
	$pic_width = $logo_size[0];
	$pic_height = $logo_size[1];
   if ($pic_width > $pic_height)
		{
		$pic_size_css = "height:100%;width:auto";
		}

	if ($pic_width < $pic_height)
		{
		$pic_size_css = "height:auto;width:100%";
		}

	    return $pic_size_css;
	}
   


/*check phone number valid*/
function check_valid_phone_num($phone_num,$country_code)
{
    $opts = array(
  'http'=>array(
    'method'=>"GET")
);

$context = stream_context_create($opts);
$fields=array("access_key"=>"d6b3beffb59940365f3b431e1dcf28a8",
"number"=>$phone_num,
"country_code"=>$country_code);
$field_data=http_build_query($fields);
 $check_phone_num_data = file_get_contents('http://apilayer.net/api/validate?'.$field_data, false, $context);
   $phone_num_valid=json_decode($check_phone_num_data);
   if($phone_num_valid->success||$phone_num_valid->valid)
  {
      return TRUE; 
  }
  else
  {
      return FALSE;
  }
}
function sortbycase($array, $case_arr,$default_val=NULL){
    $a_sort=NULL;
    if($case_arr!=NULL)
    {
        foreach($case_arr as $c_arr)
        {
      if(array_key_exists($c_arr,$array)){
            $a_sort[$c_arr] = $array->$c_arr;
           unset($array->$c_arr);
       }
       if($default_val!=NULL)
       {
            if(array_key_exists($default_val,$array))
           {
               unset($array->$default_val);
           }
       }
        }
        if($array!=NULL)
        {
             foreach($case_arr as $c_arr)
            {
              foreach($array as $key=>$val){
                if($c_arr!=$key){
                  $a_sort[$key] = $array->$key;
                 }
          
                    }
            }
        }
    }
    else
    {
     $a_sort= $array;  
    }
    return $a_sort;
}


/*create unique_id*/
function create_uniq_id($id,$limit=5)
{
   $randomnum=rand();

    $randomstring = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ".$randomnum.""), 0, $limit);
     $random=$randomstring.$id;
    return $random; 
}

    function ordinal_nums($num)
{
     if ( ($num / 10) % 10 != 1 )
    {
         switch( $num % 10 )
        {
            case 1: return $num . 'st';
            case 2: return $num . 'nd';
            case 3: return $num . 'rd';  
        }
    }
    return $num . 'th';
}
  

function get_countryDataset()
{
    
  global $base_url;
   $get_url=CLIENT_DOMAIN."/assets/data/country_data.json";
        $header = array();         
      $ch = curl_init(); 
       curl_setopt_array($ch, array( 
          CURLOPT_URL => $get_url,     
          CURLOPT_HTTPHEADER => $header,
          CURLOPT_POST => FALSE,
          CURLOPT_RETURNTRANSFER => TRUE
      ));    
      $output = curl_exec($ch);
      curl_close($ch);

 $get_country_data=json_decode($output);
 return $get_country_data;
    }