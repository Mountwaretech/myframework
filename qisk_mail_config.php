<?php

require_once('mail_stp_phpmailer/class.phpmailer.php');
		include("mail_stp_phpmailer/class.smtp.php");
        class qisk_mailSetup extends PHPMailer
        {
            public $qisk_mail;
           function __construct($host=SMTPHOST,$connec_type=CONNECTYPE,$port=SMTPPORT,$username=SMTPUSER,$password=SMTPPASS,$smtp_from=SMTPFROM)
            {
               $this->smtp_from=$smtp_from;
                                   
                                     
           $this->isSMTP();
             $this->Host = $host; 
         $this->SMTPSecure = $connec_type;  
             $this->Port = $port;
          $this->SMTPAuth = true; 
          $this->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
           $this->From = $smtp_from;   
          $this->Username = $username;              
        $this->Password = $password;             
         $this->SMTPKeepAlive = true; 
         $this->CharSet = 'utf-8';  
        /* $this->SMTPDebug =3; */
         
           }
           public function sent_qiskmail($to,$subject,$body,$message,$caption_lbl,$bcc=NULL)
           {
            $this->setFrom($this->smtp_from, $caption_lbl);    
        $this->addReplyTo($this->smtp_from, $caption_lbl);  
               $toaddress=$to[0];
               $to_name=$to[1];
              $this->addAddress($toaddress,$to_name); 
              if($bcc!=NULL)
              {
                  foreach($bcc as $bcckey => $bccval)
                  {
                $this->AddBcc($bccval["addr"],trim($bccval["name"])); 
                  }
              } 
             $this->WordWrap = 50;                                
        $this->isHTML(true); 
        $this->Subject = $subject;
        $this->Body    = $body;
        $this->msgHTML($message);
         $sendmail=$this->send();
        
         $this->clearAddresses();
         $this->ClearCCs();
         $this->ClearBCCs();
         $this->ClearAllRecipients();
        
        if(!$sendmail) { 
              return FALSE;
             }
        if($sendmail){ 
              return TRUE;
            }
        
           }
        }
$GLOBALS['qisk_mail']=new qisk_mailSetup();