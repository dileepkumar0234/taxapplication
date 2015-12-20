<?php
	include_once('class.phpmailer.php');
		
	function sendMail($to,$subject,$message,$fromAddress='',$fromUserName='',$toName='',$bcc='',$upload_dir='', $filename='')
	{	
		
		$mail = new PHPMailer();
		$mail->IsSMTP(); // send via SMTP
		$mail->Host     = "smtp.gmail.com"; // SMTP servers
		$mail->SMTPAuth   = true; // enable SMTP authentication
		$mail->SMTPSecure = "ssl"; // use ssl
		//$mail->Host = "mail.vivateachers.org"; // GMAIL's SMTP server
		$mail->Port  = 465; // SMTP port used by GMAIL server
		$mail->IsHTML(true); // [optional] send as HTML
		$mail->Username = "chandra.jampana@gmail.com";  // SMTP username
		$mail->Password = "CHANDRA8143155535!"; // SMTP password
		$mail->ClearAddresses();
		$find = strpos($to,',');		
		
		if($find)
		{
			$ids = explode(',',$to);
			for($i=0;$i<count($ids);$i++)
			{
				$mail->AddAddress($ids[$i]);
			}
		}
		else
		{
			$mail->AddAddress($to);
		}	
		
		if($fromAddress!=''){
			$mail->From     = $fromAddress;
		} else {
			$mail->From     = "chandra.jampana@gmail.com";
		}
		if($fromUserName!=''){
			$mail->FromName = $fromUserName;
		} else {
			$mail->FromName = "MediCart";	
		}
		
		$mail->WordWrap = 50; 
		$mail->IsHTML(true);
		
		$mail->Subject = $subject;			
		$mail->Body = $message;
		if($upload_dir!='')
		{
			foreach($upload_dir as $uploaddirs)
			{
			$mail->AddAttachment($uploaddirs, $filename); 
			}
		}
		if($mail->Send())
		{
		
			return 1;	
		}
		else
		{
			return 0;	
		}
		
	}
?>