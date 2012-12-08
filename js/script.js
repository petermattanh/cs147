/* Javascript functions go here */
// $(document).bind("mobileinit", function(){
//   $.mobile.page.prototype.options.addBackBtn = true;
// });


var thTimer = {};

thTimer.minutes = 0;
thTimer.seconds = 0;
thTimer.timer = '';
thTimer.nextHeader = '';
thTimer.nextPage = '';
thTimer.show = true;

thTimer.tick = function() {
	thTimer.seconds--;
	if(thTimer.seconds < 0) {
		thTimer.minutes--;
		if(thTimer.minutes < 0) {
			$("#snooze").popup("open");
			$("#mask").fadeIn(500);
			return;
		} else {
			thTimer.seconds = 59;
		}
	}

	window.setTimeout("thTimer.tick()", 1000);
	if(thTimer.show) thTimer.updateDisplay();
}

thTimer.setHref = function() {
	var timeLeftInSeconds = thTimer.minutes * 60 + thTimer.seconds;
	thTimer.nextPage.href = "content.php?time=" + timeLeftInSeconds;
	thTimer.nextHeader.href = thTimer.nextPage.href;
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

thTimer.procrastinate = function() {
	thTimer.seconds = 0;
	thTimer.minutes = 5;
	$("#snooze").popup('close');
	$("#mask").fadeOut(500);
	window.setTimeout("thTimer.tick()", 1000);
}

thTimer.initTimer = function(nextHeader, next, id, time) {
	thTimer.nextHeader = document.getElementById(nextHeader);
	thTimer.nextPage = document.getElementById(next);
	thTimer.timer = document.getElementById(id);
	thTimer.minutes = Math.floor(time/60);
	thTimer.seconds = time % 60;

	window.setTimeout("thTimer.tick()", 1000);

}

