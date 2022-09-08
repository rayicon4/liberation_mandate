<?php
require_once('connect.php');

class SendEmail extends DB{

	public function sendEmailNewRegistration1($u, $ope)
	{			

		if(isset($u))
		{
			$name = ucwords(strtolower($u['surname']." ".$u['othernames']));
			$b2 .= '<h2 style="color:orange">Liberators</h2>';
			$b2 .= '<h3 ><b>Hello '.$name.'</b></h3>';
			$b2 .= '<p>Thank you for joining the Liberators. Your account details ae as follows. Please feel free to login any time and be part of our many raffle draws.</p>';
			$b2 .= '<p>By completing this regidtrstion you are qualify to participate in any of our raffle draws.</p>';
			$b2 .= '<p>Email:<b>   '.$u['email'].'</b></p>';
			$b2 .= '<p>Mobile Number:<b>   '.$u['phone'].'</b></p>';
			$b2 .= '<p>Password:<b>   '.$ope.'</b></p>';
			$b2 .= '<p>Thank you</p>';

			return $this->mailsend('Registration', $b2, $u['email'], $u['id'], 2);
		}
		else{
			return 1;
		}
	}
		
	public function sendEmailNewRegistration($id, $pass)
	{			
		$t = $this->selectOne('clients', NILL, array('id'=>$id));

		if(isset($t) && is_numeric($t->id))
		{
			$name = ucwords(strtolower($t->surname." ".$t->othernames));
			$b2 .= '<h2 style="color:orange">Liberators</h2>';
			$b2 .= '<h3 ><b>Hello '.$name.'</b></h3>';
			$b2 .= '<p>Thank you for joining the Liberators. Your account details ae as follows. Please feel free to login any time and be part of our many raffle draws.</p>';
			$b2 .= '<p>By completing this regidtrstion you are qualify to participate in any of our raffle draws.</p>';
			$b2 .= '<p>Email:<b>   '.$t->emal.'</b></p>';
			$b2 .= '<p>Mobile Number:<b>   '.$t->email.'</b></p>';
			$b2 .= '<p>Password:<b>   '.$n.'</b></p>';
			$b2 .= '<p>Thank you</p>';

			return $this->mailsend('Registration', $b2, $t->email, $id, 2);
		}
		else{
			return 1;
		}
	}
	public function sendEmailPasswordReset($id, $pass)
	{			
		$t = $this->selectOne('clients', NILL, array('id'=>$id));
		if(isset($t) && is_numeric($t))
		{
			$name = ucwords(strtolower($t->surname." ".$t->othernames));
			
			
			$b2 .= '<h2 style="color:orange">Liberators</h2>';
			$b2 .= '<h3 ><b>Hello '.$name.'</b></h3>';
			$b2 .= '<p>Your Liberators password reset details</p>';
			$b2 .= '<p>Email:<b>   '.$t->emal.'</b></p>';
			$b2 .= '<p>Mobile Number:<b>   '.$t->emal.'</b></p>';
			$b2 .= '<p>Password:<b>   '.$pass.'</b></p>';
			$b2 .= '<p>Thank you</p>';

			return $this->mailsend('Password Reset', $b2, $id, 2);
		}
	}
	public function sendEmailPasswordChange($id, $pass)
	{			
		$t = $this->selectOne('clients', NILL, array('id'=>$id));
		if(isset($t) && is_numeric($t))
		{
			$name = ucwords(strtolower($t->surname." ".$t->othernames));
			
			$b2 .= '<h2 style="color:orange">Liberators</h2>';
			$b2 .= '<h3 ><b>Hello '.$name.'</b></h3>';
			$b2 .= '<p>Your Liberators password hass been changed</p>';
			$b2 .= '<p>Email:<b>   '.$t->emal.'</b></p>';
			$b2 .= '<p>Mobile Number:<b>   '.$t->phone.'</b></p>';
			$b2 .= '<p>Password:<b>   '.$pass.'</b></p>';
			echo $b2 .= '<p>Thank you</p>';

			return $this->mailsend('Change of Password', $b2, $id, 2);
			
		}
	}
	public function sendEmailWinning($id, $logID, $winID)
	{			
		$t = $this->selectOne('clients', NILL, array('id'=>$id));
		if(isset($t) && is_numeric($t))
		{
			$name = ucwords(strtolower($t->surname." ".$t->othernames));
			
			
			$b2 .= '<h2 style="color:orange">Liberators</h2>';
			$b2 .= '<h3 ><b>Congratulations !!! '.$name.'</b></h3>';
			$b2 .= '<p>You just won a with liberators please visit to claim your winnings</p>';
			$b2 .= '<p>Winning Code:<b>   '.$t->email.'</b></p>';
			$b2 .= '<p>Mobile Number:<b>   '.$t->email.'</b></p>';
			$b2 .= '<p>Thank you</p>';

			$this->mailsend('Password Reset', $b2, $id, 2);
		}
	}
	public function sendSmsMembershipId($u)
	{
		$type = 1;
		$id = $u['id2'];
		$phone = $u['phone'];
		$msg ='Congratulations, your Membership ID is: '.$u['id2'];
		$this->smssend($id, $phone, $msg, $type);
	}
	public function sendSmsNewRegistration($id, $pass)
	{
		$type = 1;
		$k = $this->selectOne('clients', NULL, array('id' => $id));
		$id = $k->id;
		$phone = $k->phone;
		$msg ='Welcome to Liberators: Password is '.$pass;
		$this->smssend($id, $phone, $msg, $type);
	}
	public function sendSmsPasswordReset($id, $pass)
	{
		$type = 2;
		$k = $this->selectOne('clients', NULL, array('id' => $id));
		$id = $k->id;
		$phone = $k->phone;
		$msg ='Your new password is '.$pass;
		$this->smssend($id, $phone, $msg, $type);		
	}
	public function sendSmsPasswordChange($id, $pass)
	{
		$type = 3;
		$k = $this->selectOne('clients', NULL, array('id' => $id));
		$id = $k->id;
		$phone = $k->phone;
		$msg ='Password changed to '.$pass;
		$this->smssend($id, $phone, $msg, $type);	
	}
	public function sendSmsWinning($id, $logid, $liberatorID)
	{
		$type = 4;
		$k = $this->selectOne('clients', NULL, array('id' => $id));
		$id = $k->id;
		$phone = $k->phone;
		$msg ='Congrats, you have won. Please go to the redemption center for your gift';
		//$msg ='Congratulation ! Raffle ID '.$this->enrcode(str_pad($liberatorID, 2, '0', STR_PAD_LEFT).str_pad($logid, 6, '0', STR_PAD_LEFT)).' won vist our site www.liberators.com.ng for more info. ';
		$this->smssend($id, $phone, $msg, $type);	
	}
	public function sendSmsLog($id, $logid, $liberatorID)
	{
		$type = 7;
		$k = $this->selectOne('clients', NULL, array('id' => $id));
		$id = $k->id;
		$phone = $k->phone;
		$msg =' Successful Log: !  Raffle ID '.$this->enrcode(str_pad($liberatorID, 2, '0', STR_PAD_LEFT).str_pad($logid, 6, '0', STR_PAD_LEFT)).' Best of luck';;
		$this->smssend($id, $phone, $msg, $type);	
	}
	public function sendSmsLog1($id, $logid, $liberatorID, $phone)
	{
		$type = 7;
		$msg =' Successful Log: !  Raffle ID '.$this->enrcode(str_pad($liberatorID, 2, '0', STR_PAD_LEFT).str_pad($logid, 6, '0', STR_PAD_LEFT)).' Best of luck';;
		$this->smssend($id, $phone, $msg, $type);	
	}
	public function mailsend($subject, $msg, $email, $id, $type)
	{
		$msg ='<img src="http://www.liberators.com/search/img/logo.fw.png" height="100px" width="100px">'.$msg;

						
						require '../PHPMailer/PHPMailerAutoload.php';
						$mail = new PHPMailer;
						//Tell PHPMailer to use SMTP
						$mail  = new PHPMailer();
						//Tell PHPMailer to use SMTP
						//$mail->isSMTP();
						//Enable SMTP debugging
						// 0 = off (for production use)
						// 1 = client messages
						// 2 = client and server messages
						//$mail->SMTPDebug = 2;

						//Ask for HTML-friendly debug output
						$mail->Debugoutput = 'html';                               // Enable verbose debug output						                               // Set mailer to use SMTP
						$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
						$mail->ssl = false; 
						$mail->authentication = false; 
						$mail->SMTPAuth = true; 
				                
						$mail->Username = 'covenantpolyelibrary@gmail.com';                 // SMTP username
						$mail->Password = 'covenant2017';                           // SMTP password
						$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
						$mail->Port = 587;                                             // TCP port to connect to
						$mail->setFrom('liberty_2018@gmail.com', 'Liberators');
						$mail->addAddress($e, 'FrontDesk');     // Add a recipient
						$mail->addAddress('doyinspc2@yahoo.com');               // Name is optional
						$mail->addReplyTo('liberty_2018@gmail.com@gmail.com', 'Information');
						//$mail->AddEmbeddedImage('../search/img/logo.fw.png', 'logo_2u');
						//$mail->addCC('cc@example.com');
						//$mail->addBCC('bcc@example.com');
						//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
						//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
						$mail->isHTML(true);                                  // Set email format to HTML

						$mail->Subject = $subject;
						$mail->Body    = $msg;
						//$mail->AltBody = $c;

						if(!$mail->send()) { 
						   return 'Mailer Error: ' . $mail->ErrorInfo;
						} else {
						   return 0;
						}
						
	}
	public function smssendx($id, $phone, $msg, $type)
	{
		$data = array(
        'username' => 'Liberators',
        'password' => 'liberators2018',
        'sender'  => 'Liberator',
        'to'  => $phone,
		'message'  => $msg,
		'reqid'  => 1,
		'format'  => 'json',
		'unique' => 0,
		'route_id'=> 1

		);

	    // Send the POST request with cURL
	    $ch = curl_init('http://panel.xwireless.net/API/WebSMS/Http/v1.0a/index.php?');
	    curl_setopt($ch, CURLOPT_POST, true);
	    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);

	    $result = curl_exec($ch); 

	    if(curl_exec($ch) === false) 
	    {
	    	$this->insert('sms_db_fail', array('m_id'=>$id, 'msg'=>$msg) );
	    } 
	    else 
	    {
	    	$this->insert(
	    		'sms_db_success', 
		    		array(
		    			'm_size' =>curl_getinfo($ch,CURLINFO_SIZE_DOWNLOAD),
		    			'm_head' =>curl_getinfo($ch,CURLINFO_SIZE_DOWNLOAD),
		    			'm_id' => $id,
		    			'msg' => $msg,
		    			'm_type' =>$type 
		    		));
	    }
	    curl_close($ch);  
	}

	public function smssend_old($id, $phone, $msg, $type)
	{
	
		$username = urlencode('doyinspc2@gmail.com');
		$password = urlencode('!@#$james414');
		$message = $msg;
		$sender = 'Liberator';
		$mobile = $phone;

	    // Send the POST request with cURL
	    $url = "http://portal.nigerianbulksms.com/api/?username=".$username."&password=".$password."&message=".$message."&sender=".$sender."&mobiles=".$mobile;
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		$resp = curl_exec($ch);
		

	    //$result = curl_exec($ch); 

	    if($resp === false) 
	    {
	    	$this->insert('sms_db_fail', array('m_id'=>$id, 'msg'=>$msg) );
	    	//return 0;
	    } 
	    else 
	    {
	    	$this->insert(
	    		'sms_db_success', 
		    		array(
		    			'm_size' =>curl_getinfo($ch,CURLINFO_SIZE_DOWNLOAD),
		    			'm_head' =>curl_getinfo($ch,CURLINFO_SIZE_DOWNLOAD),
		    			'm_id' => $id,
		    			'msg' => $msg,
		    			'm_type' =>$type 
		    		));
	    	//return 1;
	    }

	    curl_close($ch);

	     
	}
	public function smssend($id, $phone, $msg, $type)
	{
		if($phone !=null && $phone != '' && $msg !=null && $msg != ''){
           $sms_msg = "";
		   $owneremail="chikkyabby@gmail.com"; /* Your Email that you registered with*/
           $apikey="2ae37ce1593a69dd6e2e3d8e762646f29c356adf"; //api key generated
           $sendto=$phone; /* destination number */
           $sender="Liberator"; /* Your sender id */
		   
		   $msg .= ". From Liberator";
		   
           
           $url = "http://api.ebulksms.com:8080/sendsms?"
           . "username=" . UrlEncode($owneremail)
           . "&apikey=" . UrlEncode($apikey)
           . "&sender=" . UrlEncode($sender)
           . "&messagetext=" . UrlEncode($msg)
           . "&flash=" . UrlEncode("0")
           . "&recipients=" . UrlEncode($sendto);
           
           if ($f = @fopen($url, "r"))
           {
			   $answer = fgets($f, 255);
			   if ($answer)
			   {
					$sms_msg= "SMS to $sendto was successful.";
					$this->insert(
					'sms_db_success', 
						array(
							'm_id' => $id,
							'msg' => $msg,
							'm_type' =>$type 
						)
					);
			   }
			   else
			   {
					$sms_msg= "an error has occurred: [$answer].";
					$this->insert('sms_db_fail', array('m_id'=>$id, 'msg'=>$msg) );
			   }
           }
           else
           {
			   $sms_msg= "Error: URL could not be opened.";
			   $this->insert('sms_db_fail', array('m_id'=>$id, 'msg'=>$msg) );
           }
       }
	   
	   return $sms_msg;
	   
	     
	}
	

	
}




?>