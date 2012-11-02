<!DOCTYPE html> 
<html> 
<?php include('header.php'); ?>	
<body> 

<div data-role="page" data-theme="b" id="register">

	<div data-role="header">
		<h1>Set Up Your Account!</h1>
	</div><!-- /header -->

	<div data-role="content">
		<form action="post_register.php" method="post">

		<div data-role="fieldcontain">
			<label>Username: <input type="text" name="username" id="username"/></label>
		</div>
		<div data-role="fieldcontain">
			<label>Password: <input type="password" name="password" autocapitalize="off" /></label>
    	</div>
    	
    	<div data-role="collapsible">
   			<h3>Set Up Time Block</h3>
   			<label>Enter Time Block:<input type="number" name="timeblock" min="1" max="60" /></label>
		</div>
		
		<div data-role="collapsible">
   			<h3>Set Up Tasks</h3>
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
   					
		<input type="submit" value="Save" />
	    	
		</form>	

	</div><!-- /content -->

</div><!-- /page -->

</body>
</html>