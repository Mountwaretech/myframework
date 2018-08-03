<?php
/*template manager*/
global $qisk; 
$get_query_vars=$qisk->query_vars();
 $get_page_templ=get_page_template($get_query_vars["qisk_page_id"]);   

 if($get_page_templ!=NULL)
{   
   $page_template=get_qisk_theme_root()."/qisk-theme/".$get_page_templ->_page_template;  

 if(file_exists($page_template))
 {
   include $page_template;
 } 
 else
 {
    include get_404_page();
 }
}
else
{
    
  include get_404_page();  
}
