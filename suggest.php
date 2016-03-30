<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$name    = $_POST["name"];
	$email   = $_POST["email"];
	$details = $_POST["details"];

// construct email body
	$email_body .= "<pre>
Hello $name!

Thank you for contacting us. We have received your message, and we will get back to you as soon as we can!

This is the message you left:

---------------------------------------------
$details
---------------------------------------------

Please do not reply to this email, as this is an automated email and no one is monitoring it.

Have a nice day!

Charlie Guan</pre>";
	ob_start();
	echo $email_body;

// Send email here. Do this later.
	header("location:suggest.php?status=thanks");
}


$pageTitle = 'Suggest a Media Item';
$section   = "suggest";
include("inc/header.php");
?>

<div class="section page">
	<div class="wrapper">
		<h1>Suggest a Media Item</h1>
		<?php if (isset($_GET["status"]) && $_GET['status'] == 'thanks') { ?>
			<div class="section page">
				<h1>Thank you</h1>
				<p>Thank you for your suggestion!</p>
			</div>
		<?php } else { ?>
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
				</table>
				<input type="submit" value="Send"/>
			</form>
		<?php } ?>
	</div>
</div>

<?php include("inc/footer.php"); ?>
