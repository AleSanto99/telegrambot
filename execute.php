		<?php
		//file necessari ad inviare foto, doc e audio
		require 'class-http-request.php';
		require 'functions.php';
		//modificare col vostro token del bot
		$api="641702648:AAEnoIfs9k21Sa2SzTvmSt3TJSMq8fwQl_o";
		
		
		//prendo quello che mi è arrivato e lo salvo nella variabile content
		$content = file_get_contents("php://input");
		//decodifico quello che mi è arrivato
		$update = json_decode($content, true);
		//se non sono riuscito a decodificarlo mi fermo
		if(!$update)
		{
		  exit;
		}

        //altrimenti proseguo e vado a leggere il messaggio salvandolo nella variabile 
		//message
		$message = isset($update['message']) ? $update['message'] : "";
		//facciamo la stessa cosa anche per l'id del mess.
		$messageId = isset($message['message_id']) ? $message['message_id'] : "";
		//l'id della chat che servirà al nostro bot per sapere a chi risponder
		$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
		//il nome dell'utente che ha scritto
		$firstname = isset($message['chat']['first_name']) ? $message['chat']['first_name'] : "";
		//il cognome
		$lastname = isset($message['chat']['last_name']) ? $message['chat']['last_name'] : "";
		//lo username
		$username = isset($message['chat']['username']) ? $message['chat']['username'] : "";
		//la data
		$date = isset($message['date']) ? $message['date'] : "";
		//ed il testo del messaggio
		$text = isset($message['text']) ? $message['text'] : "";
        //eliminiamo gli spazi con trim e convertiamo in minuscolo con la funz strtolower
		
		$text = trim($text);
		$text = strtolower($text);
        
		//$text = json_encode($message);
		 //costruiamo la risposta del nostro bot
		 //l'header è sempre uguale ed indica che sarà un messaggio con codifica
		 //JSON
		header("Content-Type: application/json");
		//i parametri sono cosa voglio mandare indietro al mio utente, rimando il testo che
		//ho ricevuto e che si trova nella variabile $text
		$parameters = array('chat_id' => $chatId, "text" => $text);
		if($text == "data"){
			$text="La data odierna è: ".date("d.m.y");
			$parameters = array('chat_id' => $chatId, "text" => $text);
		}
		if($text == "foto"){
			$foto[0]="foto.png";
			$foto[1]="foto1.png";
			$foto[2]="foto2.png";
			$num = rand(0,2);
			sendFoto($chatId,"foto.png",false,"la mia foto", $api);
		}
		if($text=="barz"){
			$barz[0]="Un cavallo va dal benzinaioe chiede:'il fieno peravore'";
			$barz[1]="Qual è la differenza tra il sushi e un ebreo? Che il sushi è crudo";
			$barz[2]="E Dio disse: 'pagherai con il sangue' e la donna rispose: 'posso pagare a rate?'e fu così inventato il ciclo!"; 
		
			
			$i = (0,3);
			$parameters = array('chat_id' => $chatId, "text" => $barz[$i]);
			//$parameters = array('chat_id' => $chatId, "text" => $barz[$i]);
		}

		/*if($text=="audio"){
			sendAudio($chatId,"audio.mp3",false
				  }*/
		/*if($text ="foto"){
			//sendFoto($ChatId, "foto.png", false, "La mia Foto", $api);
		}*/
	
		
		//aggiungo il comando di invio
		//e lo invio
		
		$parameters["method"] = "sendMessage";
        echo json_encode($parameters);
		
		
		
		
		
		
		?>
		
		
		
		
		
		

		
		
		
