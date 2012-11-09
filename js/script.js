/* Javascript functions go here */
// $(document).bind("mobileinit", function(){
//   $.mobile.page.prototype.options.addBackBtn = true;
// });


var thTimer = {};

thTimer.minutes = 0;
thTimer.seconds = 0;
thTimer.timer = '';
thTimer.show = true;

thTimer.tick = function() {
	thTimer.seconds--;
	if(thTimer.seconds < 0) {
		thTimer.minutes--;
		if(thTimer.minutes < 0) {
			// time is up
			alert('yo!');
			return;
		} else {
			thTimer.seconds = 59;
		}
	}

	window.setTimeout("thTimer.tick()", 1000);
	if(thTimer.show) thTimer.updateDisplay();
}

thTimer.updateDisplay = function() {
	var seconds = thTimer.seconds;
	if(seconds == 60) {
		seconds = '00';
	} else if(seconds < 10) {
		seconds = '0' + seconds;
	}
	var minutes = thTimer.minutes;

	if(minutes == 0) {
		minutes = '00';
	} else if(minutes < 10) {
		minutes = '0' + minutes;
	}
	
	thTimer.timer.innerHTML = minutes + ':'+ seconds;
}

thTimer.toggleDisplay = function() {
	thTimer.show = !thTimer.show;
	if(thTimer.show) {
		thTimer.updateDisplay();
	} else {
		thTimer.timer.innerHTML = 'Unhide timer';
	}
}

thTimer.initTimer = function(id, time) {
	thTimer.timer = document.getElementById(id);
	thTimer.minutes = time;
	thTimer.seconds = 0;

	window.setTimeout("thTimer.tick()", 1000);

}

