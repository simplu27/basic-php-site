<?php
if ($_GET["cat"] == "books") {
	$pageTitle = "Books";
	$section = "books";
} elseif ($_GET["cat"] == "movies") {
	$pageTitle = "Movies";
	$section = "movies";
} elseif ($_GET["cat"] == "music") {
	$pageTitle = "Music";
	$section = "music";
} else {
	$pageTitle = "Full Catalog";
	$section = null;
}



include("inc/header.php"); ?>
	<div class="section page">
		<h1><?php echo $pageTitle; ?></h1>
	</div>
<?php include("inc/footer.php"); ?>