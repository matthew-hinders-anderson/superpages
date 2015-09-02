jQuery(document).ready(function($){
	
	jQuery('.countdownHolder').each(function(index){
		var clock = $(this).find('#clock');
			var date = $(this).find('#spcd_date').val();
		clock.countdown(date, function(event) {
		
		var $this = clock.html(event.strftime(''
		+ '<table class="countdown">'
		+ '<tr><td><span>%w</span></td>'
		+ '<td><span>%d</span></td>'
		+ '<td><span>%H</span></td>'
		+ '<td><span>%M</span></td>'
		+ '<td><span>%S</span></td></tr><tr><th>Weeks</th><th>Days</th><th>Hours</th><th>Minutes</th><th>Seconds</th></tr></table>'));

	});
	});
});