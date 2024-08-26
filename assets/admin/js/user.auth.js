$(function() {
   $("#frmLogin").validate({
   ignore: [],
	 rules: {
  	  userEmail: {
		  required: true,
		  email:true 
	  },
    userPswd:{
       required: true 
    }
	},
	messages: {
      username:'Please enter your email.',
	    password:'Please enter your password.'
	 },
	});
	
	$('#btnLogin').click(function() 
	{
    var el = $(this);
		if($('#frmLogin').valid()) 
		{
		   $('#btnLogin').html('Loading...');
		}
		
		return false;
	});
 
});