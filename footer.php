<!-- Change footer later
<div data-role="footer" data-id="samebar" class="nav-glyphish-example" data-position="fixed" data-tap-toggle="false">
	<div data-role="navbar" class="nav-glyphish-example" data-grid="c">
		<ul>
			<li><a href="index.php" id="home" data-icon="custom" class="ui-btn-active">Home</a></li>
			<li><a href="login.php" id="key" data-icon="custom">Login</a></li>
			<li><a href="filter.php" id="beer" data-icon="custom">Filter</a></li>
			<li><a href="#" id="skull" data-icon="custom">Settings</a></li>
		</ul>
	</div>
</div> -->

<script type="text/javascript">
// This handles all the swiping between each page. You really
// needn't understand it all.
	//Need to get rid of swipe events!
	/*
$(document).on('pageshow', 'div:jqmData(role="page")', function(){
	var page = $(this), nextpage, prevpage;
	// check if the page being shown already has a binding
	if ( page.jqmData('bound') != true ) {
		// if not, set blocker
		page.jqmData('bound', true)
		// bind
		.on('swipeleft.paginate', function() {
			console.log("binding to swipe-left on "+page.attr('id'));
            nextpage = page.next('div[data-role="page"]');
            if (nextpage.length > 0) {
                $.mobile.changePage(nextpage,{transition: "slide"}, false, true);
            }
        })
		.on('swiperight.paginate', function(){
			console.log("binding to swipe-right "+page.attr('id'));
			prevpage = page.prev('div[data-role="page"]');
			if (prevpage.length > 0) {
				$.mobile.changePage(prevpage, {transition: "slide", reverse: true}, true, true);
	        };
   		});
    }
});*/

/* 
You can initialize a cookie as below
$.cookie('cookieName', 'cookieValue');

You can remove a cookie as below
$.removeCookie('username');
*/


/* The script below will insert the username wherever it finds the
 * #username id */
if($.cookie('username') != null){//This checks whether the username cookie exists.
	$('#username').text($.cookie('username'));
} else {
	$('#username').text("ERROR: NO USERNAME FOUND");
}

</script>
