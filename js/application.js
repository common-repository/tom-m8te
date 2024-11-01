jQuery(function() {
	jQuery("body").on("click", "a.delete, td.delete a.delete", function() {
	    if (confirm("Are you sure?")) {
	        return true;
	    } else {
	    	return false;
	    }
	});
});