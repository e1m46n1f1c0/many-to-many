<?php 
include "includes/setup.php";

$action = $_REQUEST['action'];



if ($action=="create-hotel") {
	// get the passed in variables
	$title = $_REQUEST['title'];
	$description = $_REQUEST['description'];
	$categories = $_REQUEST['categories'];
	
	// add a new row to the database
	mysql_query("INSERT INTO hotels (title, description) VALUES ('".$title."', '".$description."')");
	
	// get the id of the new row
	$sql = "SELECT id FROM hotels WHERE title = '".$title."' AND description = '".$description."'";
	$result = mysql_query($sql);
	while ($row = mysql_fetch_assoc($result)) {
		$id = $row['id'];

		// then save it with the category selections 
		foreach ($categories as $cat) {
			$sql = "INSERT INTO hotel_categories (hotel_id, category_id) VALUES ('".$id."', '".$cat."')";
			mysql_query($sql);
		}		
	}
	
	header( 'Location: hotels.php' ) ;	
}



else if ($action=="delete-hotel") {
	// get the id of the hotel to delete
	$id = $_REQUEST['id'];

	// remove the row from the database and its associated categories
	mysql_query("DELETE FROM hotels WHERE id = ".$id);
	mysql_query("DELETE FROM hotel_categories WHERE hotel_id = ".$id);
	
	header( 'Location: hotels.php' ) ;
}

?>