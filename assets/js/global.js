/* Global JavaScript File for working with jQuery library */

// execute when the HTML file's (document object model: DOM) has loaded

$(document).ready(function() {


	$('.edit_project').editable('http://localhost/~kb468/conductor/index.php/project/save/', { 
		//type      : 'textarea',
		//id   : 'elementid',
 	        //name : 'newvalue',
		cancel    : 'Cancel',
		submit    : 'OK',
		//indicator : '<img src="img/indicator.gif">',
		tooltip   : 'Click to edit...'
	});
	
    });


