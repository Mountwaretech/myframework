<?php
/*qisouk theme development*/

include(dirname(__FILE__)."/qisk-maintanance_status.php");
if(qisk_maintanance_mode)
{
 include "qisk-maintanance-mode.php"; 
}
else
{

include "qisk-theme-core-setting.php";
   
}


