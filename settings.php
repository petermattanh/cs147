<div data-theme="b" data-role="page" id="settings" class="buttonNav" data-add-back-btn="true">
	<div data-role="page" data-theme="b" id="login">

		<div data-role="header">
			<h1>Settings</h1>
		</div><!-- /header -->
	
		<div data-role="content">
			<form action="post_settings.php" method="post">
	    	
	    	<div data-role="collapsible">
	   			<h3>Edit Time Blocks</h3>
				<label>Enter Time Block:<input type="number" name="timeblock" min="1" max="60" /></label>
			</div>
			
			<div data-role="collapsible">
	   			<h3>Edit Tasks</h3>
	   			<div data-role="collapsible">
	   				<h2>Read</h2>
	   				<label><input type="checkbox" name="youtube" /> The Washington Post </label>
	   				<label for="select-choice-min" class="select">Shipping method:</label>
					<select name="washingtonpost_priority" id="PriorityLevel" data-mini="true">
	   					<option value="high">High</option>
	   					<option value="medium">Medium</option>
	   					<option value="low">Low</option>
					</select> 
	
	   			</div>
	   		    <div data-role="collapsible">
	   				<h2>Watch</h2>
	   				<label><input type="checkbox" name="washingtonpost" /> Youtube </label>
	   				<select name="youtube_priority" id="PriorityLevel" data-mini="true">
	   					<option value="high">High</option>
	   					<option value="medium">Medium</option>
	   					<option value="low">Low</option>
					</select>
	   			</div>
	   	    
	   	    </div>
	   					
			<input type="submit" value="Save&raquo;" />
		    	
			</form>	
	
		</div><!-- /content -->
	
	</div><!-- /page -->
	<?php include('footer.php'); ?>
</body>
</html>