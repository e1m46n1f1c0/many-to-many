<?php include "includes/part_header.php"; ?>

<h1>Categories</h1>


<?php

// an id has been passed in so display the hotels with that specific category
if (isset($_GET['id'])) {
	$category_id = $_GET['id'];
	
	//display the category
	$result = mysql_query('SELECT * FROM categories WHERE id = '.$category_id);
	while ($row = mysql_fetch_assoc($result)) 
		echo '<h4>'.$row['title'].'</h4>';
	
	
	// display all the hotels that have this category
	echo '<ul>';
	$result = mysql_query('SELECT hotels.* 
							FROM hotels, hotel_categories
							WHERE hotels.id = hotel_categories.hotel_id
							AND hotel_categories.category_id = '.$category_id);
	while ($row = mysql_fetch_assoc($result)) {
		echo '<li><a href="hotels.php?id='.$row['id'].'">'.$row['title'].'</a></li>';
	}
	echo '</ul>';
}

// no id found so display all of the categories
else {
	echo '<ul>';
	$result = mysql_query('SELECT * FROM categories');							
	while ($row = mysql_fetch_assoc($result)) {
		echo '<li><a href="categories.php?id='.$row['id'].'">'.$row['title'].'</a></li>';
	}
	echo '</ul>';
}
?>


<?php include "includes/part_footer.php"; ?>