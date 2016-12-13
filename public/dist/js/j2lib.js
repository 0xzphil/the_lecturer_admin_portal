var J2lib = J2lib || (function function_name(argument) {
	// body...
	// //Accessible only here
	var privateArray=[];

	//Cannot be called from outside this function
	var privateFunction=function(){
	}

	return {
		show: function (string) {
			// body...
			console.log(string);
		},
		print: function (argument) {
			// body...
			alert('bac');
		},
		ajaxPost: function (idForm, url, callback) {
			// body...
			
		    	// body...
		    	var data = $('#'+ idForm).serialize();
			    console.log(data);
				$.ajax({
			        url: url,
			        type: "POST",
			        contentType : 'application/x-www-form-urlencoded',
			        beforeSend: function (xhr) {
			            var token = $('meta[name="csrf_token"]').attr('content');
			            if (token) {
			                return xhr.setRequestHeader('X-CSRF-TOKEN', token);
			            }
			        },
			        data: data,

			        success: function(data){
			        	console.log(data);
			        	callback();
			        }, 

			        error: function(data){
			        	var errors = $.parseJSON(data.responseText); 
			        	console.log(data);
			            console.log(data.responseText);
			        }
		    	});
    		
		},
		ajaxGet: function (url, callback) {
			$.ajax({
				url: url,
				type: 'GET',
				dataType: 'json',
			})
			.done(function(data) {
				callback(data);
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				console.log("complete");
			});
		}
	}
})();

