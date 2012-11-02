<?php

<!DOCTYPE html> 
<html>
<?php include('header.php'); ?>	
<body> 
<?php
	include_once('../connect.php');
	/* Need some variable that has the time, I'm going to call it time for now */
	/* Need some kind of time variable that is passed when user presses
	 * a button. Most likely will use something like
	 * $_POST['time'] */
		
		$queryW = "SELECT * FROM washingtonpost WHERE duration <='{$time}'";
		$queryY = "SELECT * FROM youtube WHERE duration <='{$time}'";
		
		/* In case there's no time, choose a random category using code below. */
		srand(1);
		$category = rand(0, 1); //We only have two categories at the moment.
		
		
		/* The code below just loops through the array of results and puts
		 * it in an iframe. 
		 * You will probably have to put this in the content div along
		 * with the code below for selection.
		$result = mysql_query($query);
		while ($row = mysql_fetch_assoc($result)) {
			echo "<iframe>".$row["url"]."<iframe>";
		} */
		
		/* However, there are few videos or articles that fill up > ten
		 * minutes, so we'll need to go through several of the results. */
		/* The functionality in cookies is unimplemented, so
		 * here is the pseudocode that can be done in php. */
		 GET highestRatedCategory //OR SORT results BY rating
		 FOREACH entry IN category
		 ECHO embeddedContent
		 PAUSE FOR duration //OR WAIT FOR nextButtonClicked
		 
		 /* Here is what you would echo for youtube */
		 "<iframe width='420' height='315' 
		 src='http://www.youtube.com/embed/".$row['videoID']." frameborder='0' 
		 allowfullscreen></iframe>";
		 	
?>

<div data-role="page" data-theme="b" id="home">
	<div data-role="header" data-theme="b">
		<h1><?php echo $title; ?></h1>
	</div><!-- /header -->

	<div data-role="content">
		<h2>Welcome <?php echo $_SESSION['username']; ?> </h2>
		
		
		
	</div><!-- /content -->
	<?php include('footer.php'); ?>
</div>
<!-- End of home page -->

<?php include('time.php'); ?>

<!-- Settings page -->
<?php include('settings.php'); ?>

</body>
</html>