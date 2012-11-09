<?php session_start();?>

<!DOCTYPE html> 
<html>
<?php include('header.php'); ?>	
<body> 

<div data-role="page" data-theme="a" id="taskedit" class="buttonNav" data-add-back-btn="true">
	<div data-role="header" data-theme="a">
		<h1>Edit TaskList!</h1>
	</div><!-- /header -->
	<?php
		if(isset($_SESSION['last_page'])) {
			echo '<p> Congratualtions! You have successfully registered! Now get started by setting up your TaskList! </p>';
		}
	?>
	<div data-role="content" data-theme="a">
		<div style="background-color:#cfcfcf;">
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
				<div data-role="fieldcontain" data-theme="a">
					<input type="submit" id="sbmt" value="Add To List!" data-disabled="false" disabled/>
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
							$("#category").append("<option class='iii' value='auto'>Auto</option><option class='iii' value='animals'>Animals</option><option class='iii' value='comedy'>Comedy</option><option class='iii' value='entertainment'>Entertainment</option><option class='iii' value='games'>Games</option><option class='iii' value='howto'>How-To</option><option class='iii' value='movies'>Movies</option><option class='iii' value='news'>News</option><option class='iii' value='people'>People</option><option class='iii' value='sports'>Sports</option><option class='iii' value='trailers'>Trailers</option><option class='iii' value='travel'>Travel</option>");
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
		</div>		
		<div>
			<form name="delete" id="delete" action="deletetask.php" method="post" data-ajax="false">
				<?php echo $taskListHtml; ?>
			</form>
		</div>

	</div><!-- /content -->
	<div data-role="popup" id="help">
		<a href="#" data-rel="back" data-role="button" data-theme="a" data-icon="delete" data-iconpos="notext" class="ui-btn-right">Close</a>
	...popup contents go here...
	</div>
	<?php include('settings_footer.php'); ?>
</div>
<!-- End of home page -->


</body>
</html>