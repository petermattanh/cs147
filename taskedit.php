<?php 
	session_start();
	require('show_tasklist.php');
?>

<!DOCTYPE html> 
<html>
<?php include('header.php'); ?>	
<body> 

<div data-role="page" data-theme="a" id="taskedit" class="buttonNav" data-add-back-btn="true">
	<div data-role="popup" id="Announcements">
		<a href="#" data-rel="back" data-role="button" data-theme="a" data-icon="delete">Close</a>
		<p>November 24th 2012</p>
		<p>Time Hacks version 1.0 currently allows subscriptions to the New York Times, the Washington Post, and the Economist.</p>
		<p>Version 2.0 will allow:
			<ul style="list-style:none;">
			<li>- Syncing to an E-Reader(e.g. Kindle) to add books to the task list</li>
			<li>- Blog and Magazine Subscriptions</li>
			<li>- Subscriptions to audio intake(podcast, audio ebooks, etc.);</li>
		</ul>
		</p>
	</div>

	<div data-role="popup" id="explain">
		<a href="#" data-rel="back" data-role="button" data-theme="a" data-icon="delete">Close</a>
		<p>A task list is a list of tasks or <b>goals</b> that you want to have accomplished or kept up to date with.</p>
		<li>For example, if one of your goals is keeping up to date with <b>The Economist</b> articles on <b>world</b> news, then you would select <b>1. "Read"</b> for reading content, <b>2. "Economist"</b> as your source of reading, and <b>3. "world"</b> as the category of news you want.</li>
		<li>Another example is if you like to watch comedy videos on Youtube.  You would choose <b>1. "Watch", 2. "Youtube", 3. "Comedy"</b>
		<p>Finally, your priority is how "badly" you want to accomplish this task.  If you value keeping up with the Economist world news more than you value watching comedy videos on YouTube, then you can place a higher priority rating for the Economist than you Youtube. (e.g., you can put Economist as "High" priority and Youtube as "Medium" or "Low" priority).</p>
		</p>
		<p>When you are finished adding your tasks, click on "Finished!" at the bottom right corner of the screen.</p>
	</div>
	<div data-role="header" data-theme="a">
		<h1>Edit TaskList!</h1>
	</div><!-- /header -->
	<?php
		if(isset($_SESSION['last_page'])) {
			echo '<p> Congratualtions! You have successfully registered! Now get started by setting up your TaskList! </p>';
			$_SESSION['last_page'] = 2;
		}
	?>
	<div data-role="content" data-theme="a">
		<p><a href="#Announcements" data-role="button" data-icon="info" data-iconpos="notext" data-rel="popup" data-inline="true">Notice</a><b>Announcements!</b></p>
		<p><a href="#explain" data-role="button" data-icon="info" data-iconpos="notext" data-rel="popup" data-inline="true">What do I do?></a><b>What do I do?</b></p>
		<!-- <a href="#notice" data-role="button" data-icon="info" data-rel="popup" data-inline="true">Some of the options are giving me errors</a> -->
			<form name="taskform" id="taskform" action="post_task_list.php" method="post" data-ajax="false">
			<div data-role='fieldcontain' data-theme='a'>
				<fieldset data-role="controlgroup" class="ui-hide-label">
					<label for="todo">Task</label>
					<select name="todo" id="todo">
					<option>1. Choose your task.</option>
  						<option value="read">Read</option>
  						<option value="watch">Watch</option>
					</select>
					<label for="source">Source</label>
					<select name="source" id="source" disabled>
					<option>2. Choose your source.</option>
					</select>
					<label for="category">Category</label>
					<select name="category" id="category" disabled>
					<option>3. Choose your category.</option>
					</select>
					<label for="priority">Priority</label>
					<select name="priority" id="priority" disabled>
					<option>4. Assign a priority rating.</option>
					<option value="3">High</option>
					<option value="2">Medium</option>
					<option value="1">Low</option>
					</select>
				</fieldset>
				<div data-role="fieldcontain" data-theme="b">
					<input type="submit" id="sbmt" value="Add To List!" data-disabled="false" data-theme="b" disabled/>
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
							if(document.getElementById("todo").selectedIndex == 2) {
								$("#source").append("<option class='ii' value='youtube'>Youtube</option>");
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
						else if(document.getElementById("todo").selectedIndex == 2) {
							
							$("#category").append("<option class='iii' value='auto'>Autos</option><option class='iii' value='animals'>Animals</option><option class='iii' value='comedy'>Comedy</option><option class='iii' value='entertainment'>Entertainment</option><option class='iii' value='games'>Games</option><option class='iii' value='howto'>How-To</option><option class='iii' value='movies'>Movies</option><option class='iii' value='news'>News</option><option class='iii' value='people'>People</option><option class='iii' value='sports'>Sports</option><option class='iii' value='trailers'>Trailers</option><option class='iii' value='travel'>Travel</option>");
						} else if(document.getElementById("todo").selectedIndex == 3) {
							$('#priority').selectmenu('enable');
							$("#category").selectmenu('disable');
						}
					}

					});
					$('#category').change(function() {
					$('#search').hide();
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
		<h2> Task Edit Help </h2>
		<a href="#" data-rel="back" data-role="button" data-theme="a" data-icon="delete" data-iconpos="notext" class="ui-btn-right">Close</a>
		<div data-role="collapsible-set">

			<div data-role="collapsible" data-collapsed="true">
				<h3>What am I doing here?</h3>
				<p>Set up a list of tasks that you would like to do in your free time and rank their importance!</p>
			</div>
			<div data-role="collapsible">
				<h3>How do I do it?</h3>
				<div data-role="collapsible" data-collapsed="true">
					<h3>Add Task</h3>
					<p>First, choose <b>how</b> you'd like to 
					<p>Second, choose the <b>source</b> from which you want this content to come from.</p>
					<p>Third, choose a <b>category</b> for what type of content you'd like to view. </p>
					<p>Finally, rank <b>how important</b> this task is to you and click "Add to List" to save the task to your tasklist!</p>
				</div>
				<div data-role="collapsible" data-collapsed="true">
					<h3>Delete Task</h3>
					</p>Click on the button with the task you want to delete inside the tasklist to remove it.</p>
				</div>		
			</div>

			<div data-role="collapsible" data-collapsed="true">
				<h3>Other tips</h3>
				<p>You cannot proceed to the next step without completing the previous one! </p>
			</div>
	
		</div>
		<?php
		/*
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
		*/
		?>
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