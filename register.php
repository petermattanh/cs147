<?php session_start(); ?>
<!DOCTYPE html> 
<html> 
<?php include('header.php'); ?>  
<body> 

<div data-role="page" data-theme="a" id="register">

   <div data-role="header" data-theme="a">
      <a href="login.php" data-role="button" data-ajax="false" data-icon="back" class="ui-btn-left">Back to login</a>
      <h1>Registration</h1>
   </div><!-- /header -->
   
	<div data-role="popup" id="signup">
		<a href="#" data-rel="back" data-role="button" data-theme="a" data-icon="delete" data-iconpos="notext" class="ui-btn-right">Close</a>
		<p>Select a username and password by which to sign in when you use <?php echo $title; ?>! Usernames and passwords may contain any alphabetic (a-z) or numeric (0-9) characters. Please remember that passwords are case-sensitive! </p>	
	</div>
   <?php
         if(isset($_SESSION['error'])) {
            echo '<p class="error"> '.$_SESSION['error'].'</p>';
            unset($_SESSION['error']);
         }
         else {
            echo 'Please select your account username password: <a href="#signup" data-role="button" data-icon="info" data-iconpos="notext" data-rel="popup" data-inline="true">shelp</a>';
         }
   ?>
   
	<div data-role="popup" id="sethelp">
		<a href="#" data-rel="back" data-role="button" data-theme="a" data-icon="delete" data-iconpos="notext" class="ui-btn-right">Close</a>
		<p>In order for <?php echo $title; ?> to figure out what content to give you to view in your free time, you will have to set up two things:</b>
		<p>1) A <b>tasklist</b> of items that you want to get done in your free time.</p>
		<p>2) A <b>list of timeblocks</b>, chuncked amounts of free time that you know you'll have free on a consistent basis, so you can avoid manually inputing them each time you use <?php echo $title; ?>. </p>	
	</div>

   <div data-role="content" data-theme="a">
   <form action="post_register.php" method="post" data-ajax="false">

         <div data-role="fieldcontain" data-theme="a">
            <label>Username:<input type="text" name="username" id="username"/></label>
         </div>
      
         <div data-role="fieldcontain" data-theme="a">
            <label>Password: <input type="password" name="password" autocapitalize="off" /></label>
         </div>
       
         <div data-role="fieldcontain" data-theme="a">
         	<legend>Would you like to initialize your user settings now or skip this step and use our default settings (you can change these at a later time)? <p><a href="#sethelp" data-role="button" data-icon="info" data-iconpos="notext" data-rel="popup" data-inline="true">sethelp</a> Click for more info.</p></legend>
         	<fieldset data-role="controlgroup" data-mini="true">
    			<input type="radio" name="default" id="own" value="no" checked="checked" />
    			<label for="own">Self Initialize</label>

				<input type="radio" name="default" id="use" value="yes"  />
    			<label for="use">Use Default</label>
    		</fieldset>
    	</div>

         
         <input type="submit" value="Create my account!" data-disabled="false"/>
   </form>        
   </div><!-- /content -->

</div><!-- /page -->

</body>
</html>