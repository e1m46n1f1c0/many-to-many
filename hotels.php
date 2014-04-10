<?php include "includes/part_header.php"; ?>

<h1>hotel details</h1>

<?php

// an id has been passed in so display the details of that specific hotel
if (isset($_GET['id'])) {
	$hotel_id = $_GET['id'];

	$result = mysql_query('SELECT * FROM hotels WHERE id = '.$hotel_id);
	while ($row = mysql_fetch_assoc($result)) {
		echo '<h3>'.$row['title'].'<h3>';
		echo '<p>'.$row['desc'].'<p>';	
	}

	echo "<h4>Categories</h4>";
	echo "<ul>";
	$result = mysql_query('SELECT categories.* 
							FROM categories, hotel_categories 
							WHERE categories.id = hotel_categories.category_id
							AND hotel_categories.hotel_id = '.$hotel_id);
	while ($row = mysql_fetch_assoc($result)) {
		echo '<li>'.$row['title'].'</li>';
	}
	echo "</ul>";
}	

// no id found so display all of the hotels
else {
	$result = mysql_query('SELECT * FROM hotels');
	echo "<ul>";
	while ($row = mysql_fetch_assoc($result)) {
		echo '<li><a href="hotels.php?id='.$row['id'].'">'.$row['title'].'</a></li>';	
	}
	echo "</ul>";	
}
?>

<?php include "includes/part_footer.php"; ?>