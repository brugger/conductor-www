/* Global JavaScript File for working with jQuery library */

// execute when the HTML file's (document object model: DOM) has loaded

$(document).ready(function() {


	$('.edit').editable('http://www.example.com/save.php', { 
		//type      : 'textarea',
		cancel    : 'Cancel',
		submit    : 'OK',
		//indicator : '<img src="img/indicator.gif">',
		tooltip   : 'Click to edit...'
	});
	
    });


