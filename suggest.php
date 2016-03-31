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
	$name     = trim(filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING));
	$email    = trim(filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL));
	$category = trim(filter_input(INPUT_POST, "category", FILTER_SANITIZE_EMAIL));
	$title    = trim(filter_input(INPUT_POST, "title", FILTER_SANITIZE_STRING));
	$format   = trim(filter_input(INPUT_POST, "format", FILTER_SANITIZE_STRING));
	$genre    = trim(filter_input(INPUT_POST, "genre", FILTER_SANITIZE_STRING));
	$year     = trim(filter_input(INPUT_POST, "year", FILTER_SANITIZE_STRING));
	$details = trim(filter_input(INPUT_POST, "details", FILTER_SANITIZE_SPECIAL_CHARS));

	if ($name == "" || $email == "" || $category == "" || $title == "") {
		$error_message = "Please fill in required fields: Name, Email, Category, Title.";
	}
	if (!isset($error_message) && $_POST["address"] != "") {
		// Spam by robot!
		$error_message = "Bad form input";
	}

	// Send email here using PHP Mailer.
	require("inc/PHPMailer/class.phpmailer.php");
	$mail = new PHPMailer;
	if (!isset($error_message) && !$mail->validateAddress($email)) {
		$error_message = "Invalid Email Address";
	}

	if (!isset($error_message)) {
		// construct email body
		$email_body = "<pre>
Hello $name!

Thank you for contacting us. We have received your message, and we will get back to you as soon as we can!

This is the new item you suggested:

---------------------------------------------
Name: $name
Email: $email
Suggested Item: 
	Category: $category
	Title: $title
	Format: $format
	Genre: $genre
	Year: $year
	Details: $detail
---------------------------------------------

Please do not reply to this email, as this is an automated email and no one is monitoring it.

Have a nice day!

Charlie Guan</pre>";
		$mail->setFrom($email, $name);
		$mail->addAddress('charliegdev@gmail.com', 'Charlie Guan');     // Add a recipient

		$mail->isHTML(true);                                  // Set email format to HTML

		$mail->Subject = 'Personal Media Library Suggestion from $name';
		$mail->Body    = $email_body;

		if ($mail->send()) {
			// Redirect to thank you message.
			header("location:suggest.php?status=thanks");
			exit;
		} else {
			$error_message = "Message could not be sent. Mailer Error: $mail->ErrorInfo";
		}
	}
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
			<!-- display introduction message or error message -->
			<?php
			if (isset($error_message)) {
				echo "<p class='message'>$error_message</p>";
			} else {
				echo "<p>If you think there is something I&rsquo;m missing, let me know! Complete the form to send me an
				email.</p>";
			}
			?>
			<form method="post" action="suggest.php">
				<table>
					<tr>
						<th><label for="name">Name *</label></th>
						<td><input type="text" id="name" name="name"/></td>
					</tr>
					<tr>
						<th><label for="email">Email *</label></th>
						<td><input type="text" id="email" name="email"/></td>
					</tr>
					<tr>
						<th><label for="category">Category *</label></th>
						<td>
							<select id="category" name="category">
								<option value="">Select a category</option>
								<option value="books">Books</option>
								<option value="movies">Movies</option>
								<option value="music">Music</option>
							</select>
						</td>
					</tr>
					<tr>
						<th><label for="title">Title *</label></th>
						<td><input type="text" id="title" name="title"/></td>
					</tr>
					<!-- Display different drop downs according to the category selected. -->
					<tr>
						<th><label for="format">Format</label></th>
						<td>
							<select id="format" name="format">
								<option value="">Select a category</option>
								<optgroup label="Books">
									<option value="Audio">Audio</option>
									<option value="Ebook">Ebook</option>
									<option value="Hardback">Hardback</option>
									<option value="Paperback">Paperback</option>
								</optgroup>
								<optgroup label="Movies">
									<option value="Blu-ray">Blu-ray</option>
									<option value="DVD">DVD</option>
									<option value="Streaming">Streaming</option>
									<option value="VHS">VHS</option>
								</optgroup>
								<optgroup label="Music">
									<option value="Cassette">Cassette</option>
									<option value="CD">CD</option>
									<option value="MP3">MP3</option>
									<option value="Vinyl">Vinyl</option>
								</optgroup>
							</select>
						</td>
					</tr>
					<tr>
						<th>
							<label for="genre">Genre</label>
						</th>
						<td>
							<select name="genre" id="genre">
								<option value="">Select One</option>
								<optgroup label="Books">
									<option value="Action">Action</option>
									<option value="Adventure">Adventure</option>
									<option value="Comedy">Comedy</option>
									<option value="Fantasy">Fantasy</option>
									<option value="Historical">Historical</option>
									<option value="Historical Fiction">Historical Fiction</option>
									<option value="Horror">Horror</option>
									<option value="Magical Realism">Magical Realism</option>
									<option value="Mystery">Mystery</option>
									<option value="Paranoid">Paranoid</option>
									<option value="Philosophical">Philosophical</option>
									<option value="Political">Political</option>
									<option value="Romance">Romance</option>
									<option value="Saga">Saga</option>
									<option value="Satire">Satire</option>
									<option value="Sci-Fi">Sci-Fi</option>
									<option value="Tech">Tech</option>
									<option value="Thriller">Thriller</option>
									<option value="Urban">Urban</option>
								</optgroup>
								<optgroup label="Movies">
									<option value="Action">Action</option>
									<option value="Adventure">Adventure</option>
									<option value="Animation">Animation</option>
									<option value="Biography">Biography</option>
									<option value="Comedy">Comedy</option>
									<option value="Crime">Crime</option>
									<option value="Documentary">Documentary</option>
									<option value="Drama">Drama</option>
									<option value="Family">Family</option>
									<option value="Fantasy">Fantasy</option>
									<option value="Film-Noir">Film-Noir</option>
									<option value="History">History</option>
									<option value="Horror">Horror</option>
									<option value="Musical">Musical</option>
									<option value="Mystery">Mystery</option>
									<option value="Romance">Romance</option>
									<option value="Sci-Fi">Sci-Fi</option>
									<option value="Sport">Sport</option>
									<option value="Thriller">Thriller</option>
									<option value="War">War</option>
									<option value="Western">Western</option>
								</optgroup>
								<optgroup label="Music">
									<option value="Alternative">Alternative</option>
									<option value="Blues">Blues</option>
									<option value="Classical">Classical</option>
									<option value="Country">Country</option>
									<option value="Dance">Dance</option>
									<option value="Easy Listening">Easy Listening</option>
									<option value="Electronic">Electronic</option>
									<option value="Folk">Folk</option>
									<option value="Hip Hop/Rap">Hip Hop/Rap</option>
									<option value="Inspirational/Gospel">Insirational/Gospel</option>
									<option value="Jazz">Jazz</option>
									<option value="Latin">Latin</option>
									<option value="New Age">New Age</option>
									<option value="Opera">Opera</option>
									<option value="Pop">Pop</option>
									<option value="R&B/Soul">R&amp;B/Soul</option>
									<option value="Reggae">Reggae</option>
									<option value="Rock">Rock</option>
								</optgroup>
							</select>
						</td>
					</tr>
					<tr>
						<th><label for="year">Year</label></th>
						<td><input type="text" id="year" name="year"/></td>
					</tr>
					<tr>
						<th><label for="details">Additional Details</label></th>
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
