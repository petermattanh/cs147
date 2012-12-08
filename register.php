<?php session_start(); ?>
<!DOCTYPE html> 
<html> 
<?php include('header.php'); ?>  
<body> 

<div data-role="page" data-theme="a" id="register">

   <div data-role="header" data-theme="a">
      <a href="login.php" data-role="button" data-ajax="false" data-icon="back" class="ui-btn-left">Back</a>
      <h1>Registration</h1>
   </div><!-- /header -->
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
  <div data-role="popup" id="signup" data-ajax="false">
    <a href="#" data-rel="back" data-role="button" data-theme="a" data-icon="delete" data-iconpos="notext" class="ui-btn-right">Close</a>
    <p>Welcome to <?php echo $title; ?>! This app allows you to manage your free time! </p>
    <p>First, get started by entering your email and password! Your email Usernames and passwords may contain any alphabetic (a-z) or numeric (0-9) characters. Please remember that passwords are case-sensitive! </p> 
    <p>Next, set up a tasklist of items you want to do in your free time! Our app allows you to read different articles or watch youtube videos. You can choose to initialize your tasklist now or use our defaults and come back to it later.</p>
  </div>
   
  <div data-role="popup" id="sethelp">
    <a href="#" data-rel="back" data-role="button" data-theme="a" data-icon="delete" data-iconpos="notext" class="ui-btn-right">Close</a>
    <p>In order for <?php echo $title; ?> to figure out what content to give you to view in your free time, you will have to set up two things:</b>
    <p>1) A <b>TASK LIST</b> of items that you want to get done in your free time.</p>
    <p>2) A <b>list of timeblocks</b>, chunked amounts of free time that you know you'll have free on a consistent basis, so you can avoid manually inputing them each time you use <?php echo $title; ?>. </p>  
  </div>
   <div data-role="content" data-theme="a">
      <p><a href="#Announcements" data-role="button" data-icon="info" data-iconpos="notext" data-rel="popup" data-inline="true">Notice</a><b>Announcements!</b></p>
      <p>Please input your email and select a password. Your email will also be your username. Please remember that passwords are case-sensitive. <a href="#signup" data-role="button" data-icon="info" data-iconpos="notext" data-rel="popup" data-inline="true">Help</a></p>
   
   <form action="post_register.php" method="post" data-ajax="false">

         <div data-role="fieldcontain" data-theme="a">
            <label>Username:<input type="text" name="username" id="username"/></label>
         </div>
      
         <div data-role="fieldcontain" data-theme="a">
            <label>Password: <input type="password" name="password" autocapitalize="off" /></label>
         </div>
       
         <div data-role="fieldcontain" data-theme="a">
         	<legend>Would you like to initialize your user settings now or skip this step and use our default settings (you can change these at a later time)? <p>Click <a href="#sethelp" data-role="button" data-icon="info" data-iconpos="notext" data-rel="popup" data-inline="true">here</a> for more info as to what these settings are.</p></legend>
         	<fieldset data-role="controlgroup" data-mini="true">
    			<input type="radio" name="default" id="own" value="no" checked="checked" />
    			<label for="own">Self Initialize</label>

				<input type="radio" name="default" id="use" value="yes"  />
    			<label for="use">Use Default</label>
    		</fieldset>
    	</div>

      <input type="submit" value="Create my account!" data-disabled="false"/>
   </form>
<script type='text/javascript'>
  window.setTimeout("$('#sethelp').popup('open')", 200);

</script>
    
    
   </div><!-- /content -->

</div><!-- /page -->

</body>
</html>