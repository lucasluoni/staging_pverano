<?php require_once('../../../wp-load.php');

// define variables and set to empty values
$nameErr = $emailErr = $subjectErr = $messageErr = "";
$name = $email = $gender = $subject = $message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
	if (empty($_POST["name"])) {
		$nameErr = "O nome é obrigatório";
		} else {
		$name = test_input($_POST["name"]);
		// check if name only contains letters and whitespace
		if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
		  $nameErr = "Apenas letras e espaços são permitidos";
		}
	}

	if (empty($_POST["email"])) {
		$emailErr = "O email é obrigatório";
		} else {
		$email = test_input($_POST["email"]);
		// check if e-mail address is well-formed
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		  $emailErr = "Formato de email inválido";
		}
	}

	if (empty($_POST["subject"])) {
		$subjectErr = "O assunto é obrigatório";
		} else {
		$subject = test_input($_POST["subject"]);
		// check if name only contains letters and whitespace
		if (!preg_match("/^[a-zA-Z ]*$/",$subject)) {
		  $subjectErr = "Apenas letras e espaços são permitidos";
		}
	}

	if (empty($_POST["message"])) {
		$messageErr = "Escreva sua mensagem";
		} else {
		$message = test_input($_POST["message"]);
	}

}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

$formcontent="De: $name \nE-mail: $email \nAssunto: $subject \n\nMensagem: $message";
$recipient = 'Bcc: <'. get_option('admin_email') . '>'. "\r\n";
$assunto = "Contato do site da Mikka Marcenaria";
$mailheader = "From: $email \r\n";
if (mail($recipient, $assunto, $formcontent, $mailheader)) {
	?>
		<script>
			alert("Sua mensagem foi enviada. Obrigado pelo contato.");
			location.href = '<?php echo home_url( '/' ); ?>';
		</script>
	<?php
} else {	
	?>
		<script>
			alert("Sua mensagem não foi enviada. Por favor, tente novamente.");
			location.href = '<?php echo get_site_url() . '/contato'; ?>';
		</script>
	<?php
}