
<?php
	session_start();
	$link = mysql_connect('mysql-user-master.stanford.edu', 'ccs147mmau', 'iekaenie');
	mysql_select_db('c_cs147_mmau');
	
	include('header.php'); 
//	include('connect.php');

	define("WP", "washingtonpost");
	define("E", "economist");
	define("NYT", "nytimes");
	define("YT", "youtube");
?>
<!DOCTYPE html> 
<html>
<body> 

<?php
	$_SESSION['list'][WP] = 1;
	$_SESSION['list'][E] = 1;
	$_SESSION['list'][NYT] = 1;
	$_SESSION['list'][YT] = 3;
	
	$_SESSION['categories'][WP] = array("business", "local", "world", "entertainment", "politics", "sports");
	$_SESSION['categories'][E] = array("world", "business", "culture");
	$_SESSION['categories'][NYT] = array("world", "business", "national", "technolog");
	$_SESSION['categories'][YT] = array("Entertainment", "Autos", "Animals", "Sports", "Travel", "Games", "People", "Comedy", "News", "Howto", "Movies", "Trailers");
	
	//Cookie exists by the time this page exists.
	$timeLeft = intval($_GET['time']) * 60;
	
	while(true){
			while(true){
				/* All websites have some priority rating from one to three,
				 * with three being the highest.  Higher priority ratings
				 * are more likely to appear in tasks. */
				$activity = "READ"; //Set activity to reading.
				$chance = rand(0, $_SESSION['list'][WP]);				
				if($chance >= 1){
					$length = count($_SESSION['categories'][WP]);
					$index = rand(0, $length - 1);
					$source = WP;
					$category = $_SESSION['categories'][WP][$index];
					break;
				}
				
				$chance = rand(0, $_SESSION['list'][E]);
				if($chance >= 1){
					$length = count($_SESSION['categories'][E]);
					$index = rand(0, $length - 1);
					$source = E;
					$category = $_SESSION['categories'][E][$index];
					break;
				}
				
				$chance = rand(0, $_SESSION['list'][NYT]);
				if($chance >= 1){
					$length = count($_SESSION['categories'][NYT]);
					$index = rand(0, $length - 1);
					$source = NYT;
				
					$category = $_SESSION['categories'][NYT][$index];
					break;
				}
				
				$activity = "WATCH";
				$chance = rand(0, $_SESSION['list'][YT]);
				if($chance >= 1){
					$length = count($_SESSION['categories'][YT]);
					
					$index = rand(0, $length - 1);
					$source = YT;
				
					$category = $_SESSION['categories'][YT][$index];
					break;
				}
				
			}
			
		$query = "SELECT * FROM ".$source." WHERE category = '".$category."' AND duration <=".$timeLeft." LIMIT 10";
		
		if($result = mysql_query($query)){
			//At least one result must exist.
			$numResults = mysql_num_rows($result);
			$randRow = rand(1, $numResults);
			for($i = 0; $i < $randRow; $i++){
				$row = mysql_fetch_assoc($result);
			}	
			$title = $row['title'];
			break;
		}
	}
			
?>

<div data-role="page" data-theme="b" id="task" class="buttonNav" data-add-back-btn="true">

	<div data-role="header" data-theme="b">
		<h1><?php echo $activity; ?></h1>
		<p href="#" id="timer" style="background-color: white; border: 1px solid black; border-radius: 5px; padding: 3px; cursor:pointer;" onclick="thTimer.toggleDisplay()" class="ui-btn-right"></p>
	</div><!-- /header -->

	<div data-role="content">
		<h1> <?php echo $source; ?> </h1>
	<h2><?php echo $title; ?></h2>
	
	<?php
		if($activity == "WATCH"){
			echo "<iframe width='420' height='315' 
			src='http://www.youtube.com/embed/".$row['videoId']."' frameborder='0' 
			allowfullscreen></iframe>";
		}
		
		if($activity == "READ"){
			echo $row['content'];
		}
		
		echo $source;
		echo $category;
		echo "should echo";
	?>
	<p>
		<a href="time.php?time=5" id="nextPage" data-ajax="false"> Give me another </a>
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