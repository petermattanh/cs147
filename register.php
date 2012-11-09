<?php session_start(); ?>
<!DOCTYPE html> 
<html> 
<?php include('header.php'); ?>  
<body> 

<div data-role="page" data-theme="a" id="register">

      <div data-role="header" data-theme="a">
      <h1>Registration</h1>
   </div><!-- /header -->
   <?php
         if(isset($_SESSION['error'])) {
            echo '<p class="error"> '.$_SESSION['error'].'</p>';
            unset($_SESSION['error']);
         }
         else {
            echo 'Please select your account username password:';
         }
   ?>


   <div data-role="content" data-theme="a">
   <form action="post_register.php" method="post" data-ajax="false">

         <div data-role="fieldcontain" data-theme="a">
            <label>Username: <input type="text" name="username" id="username"/></label>
         </div>
      
         <div data-role="fieldcontain" data-theme="a">
            <label>Password: <input type="password" name="password" autocapitalize="off" /></label>
         </div>
         
         <input type="submit" value="Sign Up!" data-disabled="false"/>
   </form>        
   </div><!-- /content -->

</div><!-- /page -->

</body>
</html>