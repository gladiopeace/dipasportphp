$(document).bind('pageinit', function() {
	$body = $("body");

	$(document).on({
	    ajaxStart: function() { $body.addClass("loading");    },
	     ajaxStop: function() { $body.removeClass("loading"); }    
	});
	
	$("#submit").click(function(e){
		// Validate username and password are empty
		$email = $("#email").val();
		$password = $("#password").val();
		if($email.length == 0){
			$("div#positionWindow p").text("Insert your username");
			$( "#positionWindow" ).popup("open");
		}else if($password.length == 0){
			$("div#positionWindow p").text("Insert your password");
			$( "#positionWindow" ).popup("open");
		}else{
			$url = $("#url").val();
			// Login
			$.ajax({
				url: $url,
				//url: "index.php/login/access",
				type: "POST",
				data: {"email" : $email, "password" : $password},
				success: function(a, b){
					$.ajax({
						url: "/services/push/index.php/login",
						type: "POST",
						data: {"login" : a},
						success: function(aa, bb){
							if(aa != 0){
								$("div#positionWindow p").text("Login failed. Try again !");
								$( "#positionWindow" ).popup("open");
							}else{
								window.location.href = window.location.href; 
							}
						}
					});
					//window.location.href = "push";
				},
				error: function(a, b, c){
					console.log(a);
					console.log(b);
					console.log(c);
				}
			});
		}
	});
	
	$('#send').click(function(){
		$platform_android = $('#push-android');
		$platform_ios = $('#push-ios');

		$msg_it = $('#lang-italian').val();
		$msg_uk = $('#lang-english').val();
		
		if(!$platform_android.parent().hasClass('ui-flipswitch-active') && !$platform_ios.parent().hasClass('ui-flipswitch-active')){
			alert('Please select at least one platform to push message');
		}else{
			$android = $platform_android.parent().hasClass('ui-flipswitch-active') ? 1 : -1;
			$ios = $platform_ios.parent().hasClass('ui-flipswitch-active') ? 2 : -1;
			
			$platform = 0; // all platform
			if($android > 0){
				$platform = $android;
			}			
			if($ios > 1){
				$platform = $ios;
			}
			
			if($android > 0 && $ios > 1){
				$platform = 0;
			}
			
			if($msg_it.length == 0 || $msg_uk.length == 0){
				alert('Please input the content for both languages');
			}else{
				$.ajax({
					url: 'index.php/push/send/' + $platform,
					type: 'POST',
					data: {'lang-italian':$msg_it, 'lang-english':$msg_uk},
					success: function(data, status){
						if(data == '1'){
							alert('Push success!');
						}else{
							alert('No message to sent');
						}
					}
				});
			}
		}
	});
});

$(document).on("click", "#dipa-logout", function(){
	$.ajax({
		url: "/services/push/index.php/login/logout",
		type: "POST",
		success: function(aa, bb){
			window.location.href = window.location.href;
		}
	});
});

function redirect(){
	window.location.href = "push"; 
}

function updatelastnew(thiz){
	$lastNews = $('#last-news');
	$isLastNews = $lastNews.parent().hasClass('ui-flipswitch-active') ? 1 : 0;
	$.ajax({
		url: 'index.php/push/send/0',
		type: 'POST',
		data: {'lang-italian':'', 'lang-english':'', 'last-news':$isLastNews},
		success: function(data, status){
			if(data == '1'){
				alert('Update last news success!');
			}else{
				alert('No update');
			}
		}
	});
}