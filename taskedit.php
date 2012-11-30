<?php 
	session_start();
	require('show_tasklist.php');
?>

<!DOCTYPE html> 
<html>
<?php include('header.php'); ?>	
<body> 

<div data-role="page" data-theme="a" id="taskedit" class="buttonNav" data-add-back-btn="true">
	<div data-role="header" data-theme="a">
		<h1>Edit Your Activities!</h1>
	</div><!-- /header -->
	<?php
		if(isset($_SESSION['last_page'])) {
			echo '<p> You have successfully registered! To get started, choose what content you want to see. </p>';
			$_SESSION['last_page'] = 2;
		}
	?>
	<div data-role="content" data-theme="a">
			<form name="taskform" id="taskform" action="post_task_list.php" method="post" data-ajax="false">
			<div data-role='fieldcontain' data-theme='a'>
				<fieldset data-role="controlgroup" class="ui-hide-label">
					<label for="todo">Task</label>
					<select name="todo" id="todo">
					<option>1. Pick what you would like to do.</option>
  						<option value="read">Read</option>
  						<option value="watch">Watch</option>
					</select>
					<label for="source">Source</label>
					<select name="source" id="source" disabled>
					<option>2. Pick the site you wan to see.</option>
					</select>
					<label for="category">Category</label>
					<select name="category" id="category" disabled>
					<option>3. Pick the type of things you want to see.</option>
					</select>
					<label for="priority">Priority</label>
					<select name="priority" id="priority" disabled>
					<option>4. Pick how often you want to see it.</option>
					<option value="3">Often</option>
					<option value="2">Sometimes</option>
					<option value="1">Rarely</option>
					</select>
				</fieldset>	
				<div data-role="fieldcontain" data-theme="b">
					<input type="submit" id="sbmt" value="Save this actvity!" data-disabled="false" data-theme="b" disabled/>
				</div>
				<script>
					$('#todo').change(function() {
					$("option").remove(".ii");
					$('#source').selectmenu('refresh', true);
					$("option").remove(".iii");
					$('#category').selectmenu('refresh', true);
					$("#category").selectmenu('disable');
					$("#priority").selectmenu('disable');
					$("#sbmt").button('disable');					
					if (document.getElementById("todo").selectedIndex == 0) {
						$("#source").selectmenu('disable');
					}
					else
					{
						$("#source").selectmenu('enable');
						if (document.getElementById("todo").selectedIndex == 1) {
						$("#source").append("<option class='ii' value='economist'>The Economist</option><option class='ii' value='nytimes'>The New York Times</option><option class='ii' value='washingtonpost'>The Washington Post</option>");
						}
						else{
							$("#source").append("<option class='ii'>Youtube</option>");
						}
					}					
       				});
       				
       				$('#source').change(function() {
					$("option").remove(".iii");
					$('#category').selectmenu('refresh', true);
					$("#priority").selectmenu('disable');
					$("#sbmt").button('disable');					
					if (document.getElementById("source").selectedIndex == 0) {
						$("#category").selectmenu('disable');
					}
					else{
						$("#category").selectmenu('enable');
						if (document.getElementById("todo").selectedIndex == 1) 
						{
							$("#category").append("<option class='iii' value='business'>Business</option><option class='iii' value='world'>World</option>");
							if (document.getElementById("source").selectedIndex == 1) {
							$("#category").append("<option class='iii' value='culture'>Culture</option>");
							}
							if (document.getElementById("source").selectedIndex == 2) {
								$("#category").append("<option class='iii' value='national'>National</option><option class='iii' value='technology'>Technology</option>");
							}
							if (document.getElementById("source").selectedIndex == 3){
								$("#category").append("<option class='iii' value='entertainment'>Entertainment</option><option class='iii' value='lifestyle'>Lifestyle</option><option class='iii' value='local'>Local</option><option class='iii' value='politics'>Politics</option><option class='iii' value='sports'>Sports</option>");
							}
						} 
						else {
							$("#category").append("<option class='iii' value='auto'>Autos</option><option class='iii' value='animals'>Animals</option><option class='iii' value='comedy'>Comedy</option><option class='iii' value='entertainment'>Entertainment</option><option class='iii' value='games'>Games</option><option class='iii' value='howto'>How-To</option><option class='iii' value='movies'>Movies</option><option class='iii' value='news'>News</option><option class='iii' value='people'>People</option><option class='iii' value='sports'>Sports</option><option class='iii' value='trailers'>Trailers</option><option class='iii' value='travel'>Travel</option>");
						}
					}

					});
					$('#category').change(function() {
					$("#priority").selectmenu('disable');
					$("#sbmt").button('disable');					
					if (document.getElementById("category").selectedIndex > 0){
						$("#priority").selectmenu('enable');
					}	
					});
					$('#priority').change(function() {
					if (document.getElementById("priority").selectedIndex == 0){
						$("#sbmt").button('disable');					
					}
					else {
						$("#sbmt").button('enable');
					}
					});
				</script>
			</form>
			<p><b>Your Tasklist:</b></p>
				<?php echo $taskListHtml; ?>


	</div><!-- /content -->
	<div data-role="popup" id="help">
		<a href="#" data-rel="back" data-role="button" data-theme="a" data-icon="delete" data-iconpos="notext" class="ui-btn-right">Close</a>
		<p>Set up a list of tasks that you would like to do in your free time and rank their importance!</p>
		<p><b>Adding:</b></p>
		<p>First, choose <b>how</b> you'd like to 
		<p>Second, choose the <b>source</b> from which you want this content to come from.</p>
		<p>Third, choose a <b>category</b> for what type of content you'd like to view. </p>
		<p>Finally, rank <b>how important</b> this task is to you and click "Add to List" to save the task to your tasklist!</p>
		<p>Please note that you cannot proceed to the next step without completing the previous one!</p>
		<p><b>Deleting:</b></p>
		<p>Click on the button with the task you want to delete inside the tasklist to remove it.</p>
			<?php
			if(!isset($_SESSION['last_page'])) {
			echo '<p> When finished, click "Finished" to return to the settings menu! </p>';
		}
	?>

	</div>
	<?php include('settings_footer.php'); ?>
</div>
<!-- End of home page -->


</body>
</html>