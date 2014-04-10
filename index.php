<?php include "includes/part_header.php"; ?>

<h1>Home</h1>

<p>Displaying the latest hotel</p>

<ul>
	<?php
	$result = mysql_query('SELECT * FROM hotels LIMIT 1');
	while ($row = mysql_fetch_assoc($result)) {
		echo '<li><a href="hotels.php?id='.$row['id'].'">'.$row['title'].'</a></li>';
	}
	?>
</ul>

<?php include "includes/part_footer.php"; ?>