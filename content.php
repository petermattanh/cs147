<?php
	session_start();
	$link = mysql_connect('mysql-user-master.stanford.edu', 'ccs147pphan92', 'aihietho');
	mysql_select_db('c_cs147_pphan92');

	define("WP", "washingtonpost");
	define("E", "economist");
	define("NYT", "nytimes");
	define("YT", "youtube");
	define("T", "text");
	define("V", "video");

	//Session storage should be defined by the time this page is reached: 'lists' and 'categories'
	$_SESSION['sources'] = array(WP, E, NYT, YT);
	$_SESSION['source_medium'] = array(WP=>T, E=>T, NYT=>T, YT=>V);
	$maxTries = 10;

	$timeLeft = intval($_GET['time']);


	for($numQueries = 0; $numQueries < $maxTries; $numQueries++) {
		if(count($_SESSION['list'])<= 0){
			$title = "No websites have been selected!";
			break 1;
		}
	
	
			for($numTries = 0; $numTries < $maxTries; $numTries++) {
				$numSources = count($_SESSION['sources']);
				for($i = 0; $i < $numSources; $i++){
					$source = $_SESSION['sources'][$i];
					if($source == "youtube") $source = "Youtube";//Crappy modularity here
					$priority = $_SESSION['list'][$source];
					$chance = rand(0, 9);
					if($priority == 1) $chance -= 8;
					if($priority == 2) $chance -= 6;
					if($priority == 3) $chance -= 4;
					//Find a better way to do priorities if there is time.
					
					if($chance >= 1 && $priority != null){
						$numCategories = count($_SESSION['categories'][$source]);
						$index = rand(0, ($numCategories - 1));
						$category = $_SESSION['categories'][$source][$index];
						break 2;//Breaks out of for loop and while loop.
					}
				}
			}
		if($source == "Youtube") $source = "youtube"; //Crappy modularity here
		if($source == 'economist' && $category == 'business') $category .= '-finance';
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
<body> 
<?php include('header.php'); ?>


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
		<?php include('snooze_popup.php'); ?>
		<h1 style="font-family:'Impact';"> <?php
			$_SESSION['last_source'] = $source;
			if($source == "washingtonpost") echo "The Washington Post";
			if($source == "economist") echo "The Economist";
			if($source == "nytimes") echo "The New York Times";
			if($source == "youtube") echo "YouTube";
			 ?> 
		</h1>
		<h2 style="font-family:'Charcoal';"><?php 
					echo $storyTitle; 
			?></h2>
		
		<?php
			if($content_medium == "video") {
				echo "<iframe width='420' height='315' src='http://www.youtube.com/embed/".$row['videoId']."' frameborder='0' allowfullscreen></iframe>";
			}
			if($content_medium == "text") echo $row['content'];
		?>
		<p>
			<a href=<?php echo "content.php?time=$timeLeft"; ?> id="nextPage" data-ajax="false" onclick="thTimer.setHref()"> Give me another </a>
		</p>
	</div><!-- /content -->
	<div data-role="popup" id="help">
		<h2> Content Help </h2>
		<a href="#" data-rel="back" data-role="button" data-theme="a" data-icon="delete" data-iconpos="notext" class="ui-btn-right">Close</a>
		<div data-role="collapsible-set">

			<div data-role="collapsible">
				<h3>What am I doing here?</h3>
				<p>Welcome to the contents page! Here, you will be shown materials to read or watched based on the items you added to your task list and the amount of free time you indicated you have.The timer at the top right hand corner keeps track of how much time has elapsed.</p>
			</div>
			
			<div data-role="collapsible">
				<h3>Tips</h3>
				<p><b>Timer:</b> The timer at the top right hand corner keeps track of how much time has elapsed. Click on the timer to hide it. Alternatively, tap the screen once to hide the entire header. Tap the screen again to bring the header back.</p>
				<p><b>Home:</b> To navigate back to the home screen to change your desired time block, simply click the "home" button.

				<p><b>Next:</b> Click "next" to go navigate to new content if you want to skip or have finished viewing this content.</p>
			</div>
	
		</div>
		<?php /*
		<a href="#" data-rel="back" data-role="button" data-theme="a" data-icon="delete" data-iconpos="notext" class="ui-btn-right">Close</a>
		<p>Welcome to the contents page! Here, you will be shown materials to read or watched based on the items you added to your task list and the amount of free time you indicated you have. The timer at the top right hand corner keeps track of how much time has elapsed. Click on the timer to hide it. Alternatively, tap the screen once to hide the entire header. Tap the screen again to bring the header back.
		<p><b>Home:</b> To navigate back to the home screen to change your desired time block, simply click the "home" button.

		<p><b>Next:</b> Click "next" to go navigate to new content if you want to skip or have finished viewing this content.</p>
		*/ ?>
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