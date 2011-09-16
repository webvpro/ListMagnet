google.friendconnect.container.initOpenSocialApi({
    site: gfc_site_id,
    onload: function(securityToken) {  
	    if (!window.timesloaded) {
	      window.timesloaded = 1;
	     } else {
	      window.timesloaded++;
	    }
	    if (window.timesloaded > 1) {
	      window.top.location.href = "/ubrpgmobile";
	    }
	  }
  });

  
 
  
  //events
    $('#twitter-login-button').live('click', function(e){
    	$.mobile.pageLoading();
    	window.location='/ubrpgmobile/signin';
    	return false;
    })
	
	$('a#sign-out-button').live('click',function(e){
		$.mobile.pageLoading();
		e.preventDefault();
	   auth_type = $('a#sign-out-button').attr('auth_type');
	   if(auth_type == 'Facebook'){
	     	FB.Connect.logout(function() { window.top.location.href='/ubrpgmobile/signout' }); 
	     	//window.top.location.href='/ubrpgmobile/signout'
	     	return false;
	   } else if(auth_type == 'Twitter'){
	     	window.top.location.href='/ubrpgmobile/signout'
	     	return false;

	   } else if(auth_type == 'Google'){
	    	window.top.location.href ='/ubrpgmobile/signout'
	     	return false;

	   }
	});
	
	
	$('input#member-name-input').live('keyup',function(e){
		$this=$(e.target);
		if($this.val().length >= 4){
			
		$.ajax({
		  url: "/signup",
		  cache: false,
		  type: 'POST',
		  data: {member_name:$this.val()},
		  dataType:'html',
		  success: function(html){
		   $('#form-message').html(html);
		   
		   
		  },
		  error: function(){
			  alert(this.textStatus);
		  }
		});
		
		} else {
			$('#form-message').html('');
		}
	});

	$(document).bind("mobileinit", function(){
  		$.mobile.ajaxFormsEnabled = false ;
  		
	});

  	