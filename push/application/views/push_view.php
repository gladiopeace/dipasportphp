<?php 
	$this->load->helper('url'); 
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ADMIN - DIPACOMMERCE PUSH SERVICE</title>
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.4/jquery.mobile-1.4.4.min.css">
<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="http://code.jquery.com/mobile/1.4.4/jquery.mobile-1.4.4.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>asserts/js/dipa.js"></script>
<style type="text/css">
.modal {
    display:    none;
    position:   fixed;
    z-index:    1000;
    top:        0;
    left:       0;
    height:     100%;
    width:      100%;
    background: rgba( 255, 255, 255, .8 ) 
                url('http://i.stack.imgur.com/FhHRx.gif') 
                50% 50% 
                no-repeat;
}

/* When the body has the loading class, we turn
   the scrollbar off with overflow:hidden */
body.loading {
    overflow: hidden;   
}

/* Anytime the body has the loading class, our
   modal element will be visible */
body.loading .modal {
    display: block;
}
</style>
</head>
<body>
	<div data-role="page" data-title="ADMIN - DIPACOMMERCE PUSH SERVICE">
		<div data-role="header">
			<h2>Push Message</h2>
			<a id="dipa-logout" href="#" class="show-page-loading-msg ui-btn ui-corner-all ui-btn-inline ui-mini footer-button-left ui-btn-icon-left ui-icon-power">Logout</a>
    		<p href="#" class="ui-btn-right ui-btn-inline ui-mini footer-button-left">Welcome, <?php echo isset($user) ? $user : ""?></p>
		</div>
		<div class="ui-content">
			<div class="ui-grid-b">
	    			<div class="ui-block-a"></div>
	    			<div class="ui-block-b"> 
	    				<div data-role="tabs" id="tabs">
	    					<div data-role="navbar">
	    						<ul>
	    							<li class="ui-block-a ui-state-default ui-corner-top ui-tabs-active ui-state-active">
	    								<a href="#push" data-ajax="false" class="ui-btn-active ui-link ui-btn ui-tabs-anchor">Push message</a>
	    							</li>
	    							<li><a href="#lastnews" data-ajax="false">Last news</a></li>
	    						</ul>
	    					</div>
	    				
		    				<div id="push" class="ui-body-d ui-content">
								<ul data-role="listview">
									<li data-role="list-divider">Platforms</li>
									<li>
										<label for="push-android">Android</label>
				    					<select name="push-android" id="push-android" data-role="flipswitch" data-mini="true" data-corners="false">
				        					<option value="off">Off</option>
				        					<option selected="selected" value="on">On</option>
				    					</select>
										<label for="push-ios">iOS</label>
				    					<select name="push-ios" id="push-ios" data-role="flipswitch" data-mini="true" data-corners="false">
				        					<option value="off">Off</option>
				        					<option selected="selected" value="on">On</option>
				    					</select>
				    					<!--
				    					<label for="push-wp">Windows Phone</label>
				    					<select name="push-wp" id="push-wp" data-role="flipswitch" data-mini="true" data-corners="false" disabled="disabled">
				        					<option selected="selected" value="off">Off</option>
				        					<option value="on">On</option>
				    					</select>
				    					-->
									</li>
									
									<!-- Messages -->
									<li data-role="list-divider">Push Message to send</li>
									<li>
										<label for="lang-italian">Italian</label>
					    				<textarea name="lang-italian" id="lang-italian" data-clear-btn="true" rows="20"></textarea>
				    					<label for="lang-english">English</label>
				    					<textarea name="lang-english" id="lang-english" data-clear-btn="true" rows="20"></textarea>
				    				</li>
				    				
				    				<!-- Send -->
				    				<li>
				    					<button id="send" class="ui-btn">SEND</button>
				    				</li>
			    				</ul>
			    			</div>
			    			<div id="lastnews" class="ui-body-d ui-content">
			    				<ul data-role="listview">
									<!-- Turn on/off last news -->
				    				<li data-role="list-divider">Last news</li>
				    				<li>
				    					<select name="last-news" id="last-news" data-role="flipswitch" data-mini="true" data-corners="false">
				        					<option value="off">Off</option>
				        					<option selected="selected" value="on">On</option>
				    					</select>
				    				</li>
				    				<!-- Send -->
				    				<li>
				    					<button id="updatelastnews" class="ui-btn" onclick="updatelastnew(this)">UPDATE</button>
				    				</li>
								</ul>
			    			</div>
		    			</div> <!-- End div tabs -->
	    			</div>
	    			<div class="ui-block-c"></div>
			</div><!-- /grid-b -->
				
		</div>
		<div data-role="footer">
		</div>
		<!-- Alert -->
		<div data-role="popup" id="positionWindow" data-overlay-theme="a" class="ui-content" data-theme="b">
			<p></p>
		</div>
		<!-- loading -->
		<div class="modal"><!-- Place at bottom of page --></div>
	</div>
</body>
</html>