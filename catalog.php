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
			<h1>
				<?php
				// Display something like "Full Catalog > Books"
				if ($section != null) {
					echo "<a href='catalog.php'>Full Catalog</a> &gt; ";
				}
				echo $pageTitle;
				?>
			</h1>
			<ul class="items">
				<?php
				// Display all the items in current category.
				$currentCatEntries = array_category($catalog, $section);
				foreach ($currentCatEntries as $id) {
					echo get_item_html($id, $catalog[ $id ]);
				}
				?>
			</ul>
		</div>
	</div>
<?php include("inc/footer.php"); ?>