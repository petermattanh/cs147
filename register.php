<!DOCTYPE html> 
<html> 
<?php include('header.php'); ?>	
<body> 

<div data-role="page" data-theme="b" id="register">

	<div data-role="header">
		<h1>Set Up Your Account!</h1>
	</div><!-- /header -->

	<div data-role="content">
		<form action="post_register.php" method="post" data-ajax="false">

		<div data-role="fieldcontain">
			<label for="username">Username: </label> 
			<input type="text" name="username" id="username"/>
		</div>
		<div data-role="fieldcontain">
			<label for="password">Password: </label>
			<input type="password" name="password" autocapitalize="off" />
    	</div>
    	
    	<div data-role="collapsible">
   			<h3>Set Up Time Block</h3>
   			<label for="timeblock">Enter Time Block: </label>
   			<input type="number" name="timeblock" min="1" max="60" />
		</div>
		
		<div data-role="collapsible">
   			<h3>Set Up Tasks</h3>
   			<div data-role="collapsible">
   				<h2>Read</h2>
   				<label for="washingtonpost">
   					The Washington Post 
   				</label>
   				<input type="checkbox" name="washingtonpost" />
   				<label for="washingtonpost_priority" class="select">Set Priority:</label>
				<select name="washingtonpost_priority" id="PriorityLevel" data-mini="true">
   					<option value="high">High</option>
   					<option value="medium">Medium</option>
   					<option value="low">Low</option>
				</select> 

   			</div>
   		    <div data-role="collapsible">
   				<h2>Watch</h2>
   				<label for="youtube">Youtube </label>
   				<input type="checkbox" name="youtube" />
   				<select name="youtube_priority" id="PriorityLevel" data-mini="true">
   					<option value="high">High</option>
   					<option value="medium">Medium</option>
   					<option value="low">Low</option>
				</select>
   			</div>
   	    
   	    </div>
   					
		<input type="submit" value="Save" data-disabled="false"/>
	    	
		</form>	

	</div><!-- /content -->

</div><!-- /page -->

</body>
</html>