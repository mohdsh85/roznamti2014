$(function()
{
	// Variable to store your files
	var files;

	// Add events
	$('input[type=file]').on('change', prepareUpload);
	$('form').on('submit', uploadFiles);
	// Grab the files and set them to our variable
	function prepareUpload(event)
	{
		files = event.target.files;
	}

	// Catch the form submit and upload the files
	function uploadFiles(event)
	{
		if(!document.getElementById('uploadingFileResult'))
			return true;
		event.stopPropagation(); // Stop stuff happening
        event.preventDefault(); // Totally stop stuff happening
		document.getElementById('uploadingFileResult').innerHTML='<img src="img/preloader-flat.gif" border=0 width="32" height="10" />';
		document.getElementById('file_lable_required').style.display='none';

        // START A LOADING SPINNER HERE

        // Create a formdata object and add the files
        var fileLabel=document.getElementById('file_lable').value;
		if(fileLabel=='')
		{
			document.getElementById('file_lable_required').style.display='block';
			document.getElementById('uploadingFileResult').innerHTML='';
			return false;
		}
		var data = new FormData();
		$.each(files, function(key, value)
		{
			data.append(key, value);
			data.append('file_lable_required', fileLabel);
		});
        $.ajax({
            url: 'submit.php?files',
            type: 'POST',
            data: data,
            cache: false,
            dataType: 'json',
            processData: false, // Don't process the files
            contentType: false, // Set content type to false as jQuery will tell the server its a query string request
            success: function(data, textStatus, jqXHR)
            {
            	if(typeof data.error === 'undefined')
            	{
            		// Success so call function to process the form
            		submitForm(event, data);
            	}
            	else
            	{
            		// Handle errors here
            		//console.log('ERRORS: ' + data.error);
					document.getElementById('uploadingFileResult').innerHTML='' + data.error;
            	}
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
            	// Handle errors here
            //	console.log('ERRORS: ' + textStatus);
					document.getElementById('uploadingFileResult').innerHTML='' + textStatus;
            	// STOP LOADING SPINNER
            }
        });
    }

    function submitForm(event, data)
	{
		// Create a jQuery object from the form
		$form = $(event.target);
		
		// Serialize the form data
		var formData = $form.serialize();
		
		// You should sterilise the file names
		$.each(data.files, function(key, value)
		{
			formData = formData + '&filenames[]=' + value;
		});

		$.ajax({
			url: 'submit.php',
            type: 'POST',
            data: formData,
            cache: false,
            dataType: 'json',
            success: function(data, textStatus, jqXHR)
            {
            	if(typeof data.error === 'undefined')
            	{
            		// Success so call function to process the form
            		//console.log('SUCCESS: ' + data.success);
					document.getElementById('uploadingFileResult').innerHTML=' ' + data.success;
					//document.getElementById('RecentAddedRecords').pre+='data';
					
					$( "#RecentAddedRecords" ).prepend( '<div class="recordRow" id="newRecord"><img src="img/preloader-flat.gif" width="32px" height="10px" border="0" /></div>' );
					
					lastRecord();///calling trigger
            	}
            	else
            	{
            		// Handle errors here
            		//console.log('ERRORS: ' + data.error);
					document.getElementById('uploadingFileResult').innerHTML='' + data.error;
            	}
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
            	// Handle errors here
            	//console.log('ERRORS: ' + textStatus);
				document.getElementById('uploadingFileResult').innerHTML='' + textStatus;
            },
            complete: function()
            {
            	// STOP LOADING SPINNER
            }
		});
	}
});