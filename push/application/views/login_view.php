<?php 
	$this->load->helper('url'); 
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>LOGIN - DIPACOMMERCE PUSH SERVICE</title>
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
	<div data-role="page" data-title="LOGIN - DIPACOMMERCE PUSH SERVICE">
		<div data-role="header">
			<h2>Login</h2>
		</div>
		<div class="ui-content">
			<div class="ui-grid-b">
    			<div class="ui-block-a"></div>
    			<div class="ui-block-b"> 
					<label for="username">Email</label>
					<input data-clear-btn="true" name="email" id="email" value="<?php echo isset($username) ? $username : ''?>" autocomplete="off" type="text">
					<label for="password">Password</label>
					<input data-clear-btn="true" name="password" id="password" value="<?php echo isset($password) ? $password : ''?>" autocomplete="off" type="password">
					<button id="submit" class="ui-btn">Login</button>
    			</div>
    			<div class="ui-block-c"></div>
			</div><!-- /grid-b -->
			<input type="hidden" id="url" value="<?php echo $url;?>" name="url">
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