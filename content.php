<?php
//	session_start();
	$link = mysql_connect('mysql-user-master.stanford.edu', 'ccs147pphan92', 'aihietho');
	mysql_select_db('c_cs147_pphan92');
	
	include('header.php'); 
//	include('connect.php');

	define("WP", "washingtonpost");
	define("E", "economist");
	define("NYT", "nytimes");
	define("YT", "youtube");
	
	
	define("T", "text");
	define("V", "video");
?>
<!DOCTYPE html> 
<html>
<body> 

<?php
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
			
?>

<div data-role="page" data-theme="b" id="task" class="buttonNav" data-add-back-btn="true">

	<div data-role="header" data-theme="b">
		<h1><?php
			if($content_medium == "text") echo "READING";
			if($content_medium == "video") echo "WATCHING";
			?>
		</h1>
		<p href="#" id="timer" onclick="thTimer.toggleDisplay()" class="ui-btn-right"></p>
	</div><!-- /header -->

	<div data-role="content">
		<h1> <?php echo $source; ?> </h1>
		<h2><?php echo $title; ?></h2>
	
		<?php
			if($content_medium == "video") echo "<iframe width='420' height='315' src='http://www.youtube.com/embed/".$row['videoId']."' frameborder='0' allowfullscreen></iframe>";
			if($content_medium == "text") echo $row['content'];
		?>
		<p>
			<a href="content.php?time=5" id="nextPage" data-ajax="false"> Give me another </a>
		</p>
		
		<script type="text/javascript">
			window.onload = thTimer.initTimer('nextPage', 'timer', <?php echo $_GET['time']; ?>);
		</script>
	</div><!-- /content -->
	
	<?php include('footer.php'); ?>
	</div>
	
	<!-- Settings page -->
<?php include('settings.php'); ?>
</body>

</html>