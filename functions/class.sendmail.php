<?php 


if(!class_exists('Form_Send_Mail')){

	class Form_Send_Mail{

		public function sendMail($subject, $msg, $from, $nomefrom, $destino, $nomedestino){

			require_once(JG_MAIL_PATH . 'class/mailer/class.phpmailer.php');
			$mail = new PHPMailer();
			
			$mail->IsSMTP();
			$mail->SMTPAuth = true;
			$mail->Host = 'yourserver.com';
			$mail->Port = 'yourport';
			
			$mail->Username = 'user@server.com';
			$mail->Password = 'yourPassword';
			
			$mail->From = $from; 
			$mail->FromName = $nomefrom;
			
			$mail->IsHTML(true);
			$mail->Subject = utf8_decode($subject);
			$mail->Body = utf8_decode($msg);
			$mail->AddAddress($destino, utf8_decode($nomedestino));
			
			if($mail->Send()){
				return true;
			}else{
				return false;
			}
		}


	}


}