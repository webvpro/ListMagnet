<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
      "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
  <title>UBRPG Combat Tactics Tools</title> 
  <link rel="stylesheet" href="http://code.jquery.com/mobile/1.0a3/jquery.mobile-1.0a3.min.css" />

  <link rel="stylesheet" href="/theme/all/css/all.css" />
   <script src="http://code.jquery.com/jquery-latest.min.js"></script>

   
   
   
   <script src="http://static.ak.connect.facebook.com/js/api_lib/v0.4/FeatureLoader.js.php" type="text/javascript"></script>
 
  <script type="text/javascript" src="http://www.google.com/jsapi"></script>
 <script type="text/javascript">
    google.load('friendconnect', '0.8');
  </script>

  <script src="http://platform.twitter.com/anywhere.js?id=<?=$tweet_consumer_key?>&v=1" type="text/javascript"></script>

  <script>
  	// configs
  	var gfc_site_id ='<?=$gfc_site_id?>';
  	var facebook_api_key='<?=$facebook_api_key?>';
  </script>
  <script src="/javascript/apps/ubrpg/app.account.js"></script>
  <script src="/javascript/apps/ubrpg/combat.points.js"></script>
  <script src="http://code.jquery.com/mobile/1.0a3/jquery.mobile-1.0a3.min.js"></script>
  <script>
  	$.mobile.pageLoading();
  </script>
</head> 
<body> 
<div data-role="page" id="home" data-theme="b">

  <div id="header" data-role="header" data-position="fixed" data-theme="a">
   <h1>Combat Tactics Tool</h1>
    <a id="sign-out-button" href="#" class="ui-btn-right" auth_type="<?=$auth_type?>" data-icon="delete" data-theme="e">Sign Out</a>
   </div><!-- /header -->

  <div id="main-content" data-role="content" > 
    
    	<ul id="melee-tactics" data-role="listview" data-inset="true" data-split-theme="e"  data-split-icon="minus"  class="ui-listview" role="listbox"> 
    		<li data-role="list-divider">Melee Tatics</li>
    		
    	</ul>
		
  </div><!-- /content -->

 <div id="footer" data-role="footer" data-position="fixed" data-theme="a">
    <h1>Play RPGs</h1>
  </div><!-- /footer -->
</div><!-- /page -->
<div id="fb-root"></div>

  

	<script type="text/javascript">
		FB.init(facebook_api_key, "/xd_receiver.htm");
		
		$.mobile.pageLoading( true );
		
	</script>
</body>
</html>