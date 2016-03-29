<?php
if ($_GET["cat"] == "books") {
	$pageTitle = "Books";
	$section   = "books";
} elseif ($_GET["cat"] == "movies") {
	$pageTitle = "Movies";
	$section   = "movies";
} elseif ($_GET["cat"] == "music") {
	$pageTitle = "Music";
	$section   = "music";
} else {
	$pageTitle = "Full Catalog";
	$section   = null;
}

include("inc/data.php");
include("inc/functions.php");

include("inc/header.php"); ?>
	<div class="section catalog page">
		<div class="wrapper">
			<h1><?php echo $pageTitle; ?></h1>
			<ul class="items">
				<?php
				foreach ($catalog as $id => $item) {
					echo get_item_html($id, $item);
				}
				?>
			</ul>
		</div>

	</div>
<?php include("inc/footer.php"); ?>