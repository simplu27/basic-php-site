<?php
$pageTitle = 'Suggest a Media Item';
$section   = "suggest";
include("inc/header.php");
?>
<div class="section page">
	<div class="wrapper">
		<h1>Suggest a Media Item</h1>
		<p>If you think there is something I&rsquo;m missing, let me know! Complete the form to send me an email.</p>
		<form method="post" action="process.php">
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
			<input type="submit" value="Send" />
		</form>
	</div>
</div>

<?php include("inc/footer.php"); ?>
