<?php
	session_start();
	$link = mysql_connect('mysql-user-master.stanford.edu', 'ccs147pphan92', 'aihietho');
	mysql_select_db('c_cs147_pphan92');
	
//	include('connect.php');

	define("WP", "washingtonpost");
	define("E", "economist");
	define("NYT", "nytimes");
	define("YT", "youtube");
	
	
	define("T", "text");
	define("V", "video");

	//The cookie should exist by the time this page comes up, but for now
	//here are hard coded values.
	$_SESSION['sources'] = array(WP, E, NYT, YT);
	$_SESSION['source_medium'] = array(WP=>T, E=>T, NYT=>T, YT=>V);
	$_SESSION['preferences'] = array(WP=>1, E=>1, NYT=>1, YT=>1);
	
	$_SESSION['categories'][WP] = array("business", "local", "world", "entertainment", "politics", "sports");
	$_SESSION['categories'][E] = array("world", "business", "culture");
	$_SESSION['categories'][NYT] = array("world", "business", "national", "technology");
	$_SESSION['categories'][YT] = array("Entertainment", "Autos", "Animals", "Sports", "Travel", "Games", "People", "Comedy", "News", "Howto", "Movies", "Trailers");

	/*$_SESSION['list'][WP] = 1;
	$_SESSION['list'][E] = 1;
	$_SESSION['list'][NYT] = 1;
	$_SESSION['list'][YT] = 3;*/
	
	$timeLeft = intval($_GET['time']);
	
	while(true){
			while(true){
				$numSources = count($_SESSION['sources']);
				for($i = 0; $i < $numSources; $i++){
					$source = $_SESSION['sources'][$i];
					$priority = $_SESSION['preferences'][$source];
					$chance = rand(0, 9);
					if($priority == 1) $chance -= 8;
					if($priority == 2) $chance -= 6;
					if($priority == 3) $chance -= 4;
					//Find a better way to do priorities if there is time.
					
					if($chance >= 1){
						$numCategories = count($_SESSION['categories'][$source]);
						$index = rand(0, ($numCategories - 1));
						$category = $_SESSION['categories'][$source][$index];
						break 2;//Breaks out of for loop and while loop.
					}
				}
			}
			
		$query = "SELECT * FROM ".$source." WHERE category = '".$category."' AND duration <=".$timeLeft." LIMIT 10";
		if($result = mysql_query($query)){
			//At least one result must exist.
			$numResults = mysql_num_rows($result);
			$randRow = rand(1, $numResults);
			for($i = 0; $i < $randRow; $i++){ $row = mysql_fetch_assoc($result); }	
			
			if($title = $row['title']){
				$content_medium = $_SESSION['source_medium'][$source];
				break 1;
			}
		}
	}
	$storyTitle = $title;
					
?>
<!DOCTYPE html> 
<html>
<?php include('header.php'); ?>	
<body> 

<div data-role="page" data-theme="a" id="task" class="buttonNav" data-add-back-btn="true">

	<div data-role="header" data-theme="a" data-position="fixed">
		<h1><?php
			if($content_medium == "text") echo "READING";
			if($content_medium == "video") echo "WATCHING";
			?>
		</h1>
		<p href="#" id="timer" onclick="thTimer.toggleDisplay()" class="ui-btn-right" style="color:#000000;"></p>

		<p><div align="center" data-role="controlgroup" data-type="horizontal">

			<a href="index.php" data-role="button" data-icon="home" data-ajax="false">Home</a>			
			<a href=<?php echo "content.php?time=$timeLeft"; ?> id="nextHeader" data-role="button" data-icon="arrow-r" data-ajax="false" onclick="thTimer.setHref()">Next</a>
		</div></p>

	</div><!-- /header -->
	
	<div data-role="content">
		<h1> <?php
			$_SESSION['last_source'] = $source;
			if($source == "washingtonpost") echo "The Washington Post";
			if($source == "economist") echo "The Economist";
			if($source == "nytimes") echo "The New York Times"
			 ?> 
		</h1>
		<h2><?php 
			$_SESSION['last_title'] = $storyTitle;
			echo $storyTitle; 
			?></h2>
	
		<?php
			$_SESSION['last_content'] = $content_medium;
			if($content_medium == "video") echo "<iframe width='420' height='315' src='http://www.youtube.com/embed/".$row['videoId']."' frameborder='0' allowfullscreen></iframe>";
			if($content_medium == "text") echo $row['content'];
		?>
		<p>
			<a href=<?php echo "content.php?time=$timeLeft"; ?> id="nextPage" data-ajax="false" onclick="thTimer.setHref()"> Give me another </a>
		</p>
	</div><!-- /content -->
	<div data-role="popup" id="help">
		<a href="#" data-rel="back" data-role="button" data-theme="a" data-icon="delete" data-iconpos="notext" class="ui-btn-right">Close</a>
		<p>Welcome to the contents page! Here, you will be shown materials to read or watched based on the items you added to your task list and the amount of free time you indicated you have. The timer at the top right hand corner keeps track of how much time has elapsed. Click on the timer to hide it. Alternatively, tap the screen once to hide the entire header. Tap the screen again to bring the header back.
		<p><b>Home:</b> To navigate back to the home screen to change your desired time block, simply click the "home" button.

		<p><b>Next:</b> Click "next" to go navigate to new content if you want to skip or have finished viewing this content.</p>
	</div>
	
	<?php include('footer.php'); ?>
</div>
	<script type="text/javascript">
		window.onload = thTimer.initTimer('nextHeader', 'nextPage', 'timer', <?php echo $_GET['time']; ?>);
	</script>
	<!-- Settings page -->
<?php include('settings.php'); ?>
</body>

</html>