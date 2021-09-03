<?php 


if(!class_exists('Form_Send_Mail')){

	class Form_Send_Mail{

		public function sendMail($subject, $msg, $from, $nomefrom, $destino, $nomedestino){

			require_once(JG_MAIL_PATH . 'class/mailer/class.phpmailer.php');
			$mail = new PHPMailer();//Instancia a classe do phpmailer
			
			$mail->IsSMTP();//habilita envio smtp
			$mail->SMTPAuth = true;//envio autenticado
			$mail->Host = 'saborladecasa.com';
			$mail->Port = '25';
			
			//aqui começamos o envio do e-mail
			$mail->Username = 'geral@saborladecasa.com';
			$mail->Password = 'Flamengo2511';
			
			$mail->From = $from; // email de quem envia
			$mail->FromName = $nomefrom;// nome de quem envia
			
			$mail->IsHTML(true);//é html o tipo de mensagem
			$mail->Subject = utf8_decode($subject);//assunto a ser enviado
			$mail->Body = utf8_decode($msg);// mensagem propriamente dita
			$mail->AddAddress($destino, utf8_decode($nomedestino));//seta o destino do e-mail
			
			if($mail->Send()){
				return true;
			}else{
				return false;
			}
		}


	}


}