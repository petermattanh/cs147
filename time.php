<div data-role="page" data-theme="b" id="task" class="buttonNav" data-add-back-btn="true">
	<?php include_once('../connect.php'); 
		//$queryW = "SELECT * FROM washingtonpost WHERE duration <='15'";
		srand(time()); // seed shizz
		$videoNum = rand(1, 6);

		$query = "SELECT * FROM youtube WHERE id=$videoNum";
		$query = mysql_query($query, $con);

		$row = mysql_fetch_assoc($query);
		$videoName = $row['name'];
		$videoId = $row['videoID'];
		$videoUrl = $row['url'];
		$timeLeft = intval($row['duration']);
		$videoHtml = '<iframe width="250" height="125" src="http://www.youtube.com/embed/'.$videoId.'" frameborder="0" allowfullscreen></iframe>';

	?>
	<div data-role="header" data-theme="b">
		<h1>Watching Youtube</h1>
	</div><!-- /header -->

	<div data-role="content">	
		<h3>Watching <?php echo $videoName; ?> <h3>
		<?php echo $videoHtml; ?>
		<p>Time left: <?php echo $timeLeft; ?> </p>
		<p><a href="#home" data-direction="reverse" data-role="button" data-theme="b">Back to Home page</a></p>	
		
	</div><!-- /content -->
	
	<?php include('footer.php'); ?>
</div>

