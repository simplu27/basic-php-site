<?php
/*
 * Structure of this script is bit complicated, here is the explanation:
 *
 * 1. Check Request Method: --> POST or GET?
 * 2. If POST: handle user input, send email, redirect to thank you message by sending a GET with ?status=thanks
 * 3. If Not POST: Do we have GET?
 * 4.       YES: check if status=thanks. If so, display thank you message.
 *          NO:  display the form.
 */
// handling the data submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$name    = trim(filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING));
	$email   = trim(filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL));
	$details = trim(filter_input(INPUT_POST, "details", FILTER_SANITIZE_SPECIAL_CHARS));


	if ($name == "" || $email == "" || $details == "") {
		echo "Please fill in your name, email address, and your suggestion.";
		exit;
	}
	if ($_POST["address"] != "") {
		// Spam by robot!
		echo "Bad form input";
		exit;
	}
// construct email body
	$email_body = "<pre>
Hello $name!

Thank you for contacting us. We have received your message, and we will get back to you as soon as we can!

This is the message you left:

---------------------------------------------
$details
---------------------------------------------

Please do not reply to this email, as this is an automated email and no one is monitoring it.

Have a nice day!

Charlie Guan</pre>";

	// Send email here using PHP Mailer.
	require("inc/PHPMailer/class.phpmailer.php");
	$mail = new PHPMailer;
	if (!$mail->validateAddress($email)) {
		echo "Invalid Email Address";
		exit;
	}
	$mail->setFrom($email, $name);
	$mail->addAddress('charliegdev@gmail.com', 'Charlie Guan');     // Add a recipient

	$mail->isHTML(true);                                  // Set email format to HTML

	$mail->Subject = 'Personal Media Library Suggestion from $name';
	$mail->Body    = $email_body;

	if (!$mail->send()) {
		echo 'Message could not be sent.';
		echo 'Mailer Error: ' . $mail->ErrorInfo;
		exit;
	}
	// Redirect to thank you message.
	header("location:suggest.php?status=thanks");
}

// displaying form
$pageTitle = 'Suggest a Media Item';
$section   = "suggest";
include("inc/header.php");
?>
<div class="section page">
	<div class="wrapper">
		<h1>Suggest a Media Item</h1>

		<?php
		// display thank you message after submission
		if (isset($_GET["status"]) && $_GET['status'] == 'thanks') {
			?>
			<div class="section page">
				<h1>Thank you</h1>
				<p>Thank you for your suggestion!</p>
			</div>
		<?php } else { ?>

			<!-- display suggestion form -->
			<p>If you think there is something I&rsquo;m missing, let me know! Complete the form to send me an
				email.</p>
			<form method="post" action="suggest.php">
				<table>
					<tr>
						<th><label for="name">Name</label></th>
						<td><input type="text" id="name" name="name"/></td>
					</tr>
					<tr>
						<th><label for="email">Email</label></th>
						<td><input type="text" id="email" name="email"/></td>
					</tr>
					<tr>
						<th><label for="details">Suggest Item Details</label></th>
						<td><textarea id="details" name="details"></textarea></td>
					</tr>
					<!-- Spam honey pot field -->
					<tr style="display:none">
						<th><label for="address">Address</label></th>
						<td><input type="text" id="address" name="address"/>
							<p>Please leave this field blank.</p>
						</td>
					</tr>
				</table>
				<input type="submit" value="Send"/>
			</form>
		<?php } ?>
	</div>
</div>

<?php include("inc/footer.php"); ?>
