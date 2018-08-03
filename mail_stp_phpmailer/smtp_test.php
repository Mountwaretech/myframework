<?php
define('SMTPHOST', 'server13.hostwhitelabel.com');
define('SMTPUSER', 'support@yoursouk.com');
define('SMTPPASS', 'YouRSouk@2016#dev');
define('CONNECTYPE', 'tls');
define('SMTPPORT', '587');
define('SMTPFROM', 'support@yoursouk.com');
    require_once('class.phpmailer.php');
		include("class.smtp.php");
class qisk_mailSetup extends PHPMailer
{
    public $qisk_mail;
   function __construct()
    {
    $this->isSMTP();
     $this->Host = SMTPHOST; 
 $this->SMTPSecure = CONNECTYPE;  
     $this->Port = SMTPPORT;
  $this->SMTPAuth = true; 
 $this->Username = SMTPUSER;              
$this->Password = SMTPPASS;             
 $this->SMTPKeepAlive = true; 
 $this->CharSet = 'utf-8';           
$this->SMTPDebug =3; 

   }
    public function sent_qiskmail($to,$subject,$body,$message,$caption_lbl,$bcc=NULL,$attachment=NULL)
   {
     $qisk_mail=new qisk_mailSetup();
     $qisk_mail->setFrom(SMTPFROM, $caption_lbl);    
$qisk_mail->addReplyTo(SMTPFROM, $caption_lbl);  
       $toaddress=$to[0];
       $to_name=$to[1];
      $qisk_mail->addAddress($toaddress,$to_name); 
      if($bcc!=NULL)
      {
          foreach($bcc as $bcckey => $bccval)
          {
        $qisk_mail->addBCC($bccval["addr"],trim($bccval["name"])); 
          }
      }
      if($attachment!=NULL)
      {
      $qisk_mail->addAttachment($attachment); 
      } 
     $qisk_mail->WordWrap = 50;                                
$qisk_mail->isHTML(true); 
$qisk_mail->Subject = $subject;
$qisk_mail->Body    = $body;
$qisk_mail->AltBody = htmlentities($body);
$qisk_mail->msgHTML($message);
 $sendmail=$qisk_mail->send();
if(!$sendmail) {  exit;  return FALSE;}
if($sendmail){  return TRUE;}
$qisk_mail->ClearBCCs();

   }
}
$user_email_id="davincikart@hotmail.com";
$GLOBALS['qisk_mail']=new qisk_mailSetup();
    $qisk_mail->sent_qiskmail(array($user_email_id,$user_email_id),"Forgotten Password Reset","","test","new mail from yoursouk",NULL,file_get_contents("https://camo.githubusercontent.com/0d858d6dac4d3f6fab7d42de2c09d32ee2de9c5b/68747470733a2f2f7261772e6769746875622e636f6d2f5048504d61696c65722f5048504d61696c65722f6d61737465722f6578616d706c65732f696d616765732f7068706d61696c65722e706e67"));
?>