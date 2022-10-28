<?php
	
	/**
	* Очистка данних
	*/
	function clean($data) {
		return htmlspecialchars(strip_tags(addslashes(trim($data))));
	}

	/**
	 * Очистка тексту зі слешами
	 */
	function viewStr($value = false) {
		return ($value) ? stripslashes($value) : false;
	}

	/**
	 * Відправка листів
	 * @param  boolean $sendEmail      [ Email куди відправляти лист ]
	 * @param  string  $emailSignature [ Від кого ]
	 * @param  boolean $name           [ Ім'я ]
	 * @param  boolean $subject        [ Тема ]
	 * @param  boolean $message        [ Текст повідомлення ]
	 */
	function sendEmail (
			$sendEmail = false,
			$subject = false,
			$name = false,
			$emailSignature = 'no-email@email.net',
			$message = false) {

		// Додаткові заголовки
		$headers .= 'MIME-Version: 1.0\r\n'.'Content-type: text/html; charset=utf-8\r\n';
		$headers .= 'From: '. viewStr($name) . ' <'. $emailSignature .'>\r\n';
		$headers .= 'X-Mailer: PHP/' . phpversion();

		// Відправка форми
		return mail($sendEmail, $subject, viewStr($message), $headers);
	}
	


	// Тільки, якщо є відправка форми, відпрацьовуємо код
	if(clean($_POST['email'])) {
		
		// Кому будемо відправляти?
		$sendEmail = (clean($_POST['sendEmail'])) ? clean($_POST['sendEmail']) : 'mycompany@gmail.com';
		$subject   = (clean($_POST['subject'])) ? clean($_POST['subject']) : 'Моя тема листа';
	
		// Наша інформація
		$name  = (clean($_POST['name'])) ? clean($_POST['name']) : 'Vadim Guk';
		$email = (clean($_POST['email'])) ? clean($_POST['email']) : 'hukvadim@gmail.com';
	
		// Формуємо листа / email шаблон
		$message = (clean($_POST['message'])) ? clean($_POST['message']) : 'Повідомлення!!!';
	
		// Відправляємо листа
		sendEmail($sendEmail, $subject, $name, $email, $message);
		echo 'success';
		
	} else {
		echo 'Форма не відправлена';
	}
