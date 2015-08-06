$(document).ready(function() {
	if (navigator.geolocation) {
		
        navigator.geolocation.getCurrentPosition(function(position){
        	
        	
        	$('#lat').val(position.coords.latitude);
    	    $('#long').val(position.coords.longitude);	
        });
    } else { 
        alert("Geolocation is not supported by this browser.");
        return false;
    }
});

