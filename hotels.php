<?php include "includes/part_header.php"; ?>

<h1>Hotel Details</h1>

<?php

// an id has been passed in so display the details of that specific hotel
if (isset($_GET['id'])) {
	$hotel_id = $_GET['id'];

	$result = mysql_query('SELECT * FROM hotels WHERE id = '.$hotel_id);
	while ($row = mysql_fetch_assoc($result)) {
		echo '<h3>'.$row['title'].'<h3>';
		echo '<p>'.$row['description'].'<p>';	
	}

	echo "<h4>Categories</h4>";
	echo "<ul>";
	$result = mysql_query('SELECT categories.* 
							FROM categories, hotel_categories 
							WHERE categories.id = hotel_categories.category_id
							AND hotel_categories.hotel_id = '.$hotel_id);
	while ($row = mysql_fetch_assoc($result)) {
		echo '<li>';
		echo $row['title'];
		echo '</li>';
	}
	echo "</ul>";
	
	
	echo '<a href="controller.php?action=delete-hotel&id='.$hotel_id.'">Delete Hotel</a>';
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

<hr/>

<h2>Add a new Hotel</h2>

<form action="controller.php" method="post" class="clearfix">
	<input type="hidden" name="action" value="create-hotel"/>
	
	<label for="title">Hotel Name:</label>
	<input type="text" id="title" name="title"/>
	
	<label for="description">Hotel Description:</label>
	<input type="text" id="description" name="description"/>
	
	<label for="categories">Hotel Categories:</label>
	<select id="categories" name="categories[]" multiple size="3">
		<?php 
		$result = mysql_query('SELECT * FROM categories');
		while ($row = mysql_fetch_assoc($result)) {
			echo '<option value="'.$row['id'].'">';
			echo $row['title'];
			echo '</option>';
		}
		?>
	</select>
	<input type="submit" value="Add"/>
</form>

<?php include "includes/part_footer.php"; ?>