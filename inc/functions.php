<?php
/**
 * Created by PhpStorm.
 * User: charlieguan
 * Date: 2016-03-28
 * Time: 9:58 PM
 */
function get_item_html($id, $item) {
	return "<li><a href='#'><img src='"
	       . $item["img"]
	       . "' alt='"
	       . $item["title"]
	       . "'/><p>View Details</p></a></li>";
}