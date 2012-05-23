/* Global JavaScript File for working with jQuery library */

// execute when the HTML file's (document object model: DOM) has loaded

$(document).ready(function() {


	$('.edit_project').editable('http://localhost/~kb468/conductor/index.php/ajax/save_project/', { 
		//type      : 'textarea',
		//id   : 'elementid',
 	        //name : 'newvalue',
		//cancel    : 'Cancel',
		submit    : 'OK',
 		    event   : "dblclick",
		//indicator : '<img src="img/indicator.gif">',
		tooltip   : 'Click to edit...'
	});

	$('.edit_project_status').editable('http://localhost/~kb468/conductor/index.php/ajax/save_project/', { 
		//type      : 'textarea',
		//id   : 'elementid',
 	        //name : 'newvalue',
		loadurl : 'http://localhost/~kb468/conductor/index.php/ajax/project_statuses/',
		    //cancel    : 'Cancel',
 		    event   : "dblclick",
 	        type   : 'select',
		submit    : 'OK',
		//indicator : '<img src="img/indicator.gif">',
		tooltip   : 'Click to edit...'
	});

	$('.edit_project_analysis').editable('http://localhost/~kb468/conductor/index.php/ajax/save_project/', { 
		//type      : 'textarea',
		//id   : 'elementid',
 	        //name : 'newvalue',
		loadurl : 'http://localhost/~kb468/conductor/index.php/ajax/analyses/',
		    //cancel    : 'Cancel',
 		    event   : "dblclick",
 	        type   : 'select',
		submit    : 'OK',
		//indicator : '<img src="img/indicator.gif">',
		tooltip   : 'Click to edit...'
	});



	$('.edit_analysis').editable('http://localhost/~kb468/conductor/index.php/ajax/save_analysis/', { 
		//type      : 'textarea',
		//id   : 'elementid',
 	        //name : 'newvalue',
		//cancel    : 'Cancel',
		submit    : 'OK',
 		    event   : "dblclick",
		//indicator : '<img src="img/indicator.gif">',
		tooltip   : 'Click to edit...'
	});
	
    });


