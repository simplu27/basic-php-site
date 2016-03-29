<?php
/**
 * Created by PhpStorm.
 * User: charlieguan
 * Date: 2016-03-28
 * Time: 9:58 PM
 */
function get_item_html($id, $item) {
	return "<li><a href='details.php?id="
	       . $id
	       . "'><img src='"
	       . $item["img"]
	       . "' alt='"
	       . $item["title"]
	       . "'/><p>View Details</p></a></li>";
}

function array_category($catalog, $category) {

	$output = [];
	foreach ($catalog as $id => $item) {
		// if we don't specify a category, just use every entry. Otherwise, convert
		// category string to lower case for comparison.
		if ($category == null OR strtolower($category) == strtolower($item["category"])) {
			$titleChosen = $item["title"];
			// Trim the "The " "A " "An " at the left, so we won't sort by those words.
			// It's fine to change our title since we aren't displaying/returning them anyway.
			$titleChosen = ltrim($titleChosen, "The ");
			$titleChosen = ltrim($titleChosen, "A ");
			$titleChosen = ltrim($titleChosen, "An ");

			// make an associate array with $id as key, and $titleChosen as value. Later we'll
			// sort the array using its value's string alphabetical order, and only return its $id.
			$output[ $id ] = $titleChosen;
		}
	}
	asort($output);

	return array_keys($output);
}