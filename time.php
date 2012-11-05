<!DOCTYPE html> 
<html>
<?php
	include('header.php'); 
	include('../connect.php'); 
?>	
<body> 

<?php
		srand(time()); // seed shizz
		$videoNum = rand(1, 6);

		$timeLeft = intval($_GET['time']) * 60;

		$activity = "Reading Economist";
		$activityName = "Artile Title";

		$url = 'http://www.economist.com/news/leaders/21565623-america-could-do-better-barack-obama-sadly-mitt-romney-does-not-fit-bill-which-one';
		$startTag        = '<div id="ec-article-body" class="clearfix">';
		$endTag          = '<!-- /#ec-article-body -->';

		$query = "SELECT * FROM youtube WHERE id=$videoNum";
		$query = mysql_query($query, $con);

		$row = mysql_fetch_assoc($query);
		$videoName = $row['name'];
		$videoId   = $row['videoID'];
		$videoUrl  = $row['url'];
		$duration  = intval($row['duration']);
		$videoHtml = '<iframe width="420" height="315" src="http://www.youtube.com/embed/'.$videoId.'" frameborder="0" allowfullscreen></iframe>';

?>

<div data-role="page" data-theme="b" id="task" class="buttonNav" data-add-back-btn="true">

	<div data-role="header" data-theme="b">
		<h1><?php echo $activity; ?></h1>
	</div><!-- /header -->

	<div data-role="content">	
		<h3><?php echo $activityName; ?> <h3>
		
		<p>Time left: <?php echo $timeLeft; ?> </p>
		<?php 
			displayArticleContents($url, $startTag, $endTag);
		?>
		<p><a href="index.php" data-direction="reverse" data-role="button" data-theme="b">Back to Home page</a></p>	
		
	</div><!-- /content -->
	
	<?php include('footer.php'); ?>
</div>
<!-- Settings page -->
<?php include('settings.php'); ?>
</body>
</html>