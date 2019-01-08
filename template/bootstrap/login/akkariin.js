var csrf_ip = "";
var randhost = rnd(0, 999999999);
htmlobj2 = $.ajax({
	url: "https://api.akkariin.com:24443/getip/",
	type: 'GET',
	async: true,
	error: function() {
		htmlobj3 = $.ajax({
			url: "https://mc.akkariin.com:24443/getip/",
			type: 'GET',
			async: true,
			error: function() {
				showmsg("CSRF 验证失败，请稍后重试或联系管理员")
			},
			success: function() {
				csrf_ip = htmlobj3.responseText;
				return;
			}
		});
	},
	success: function() {
		csrf_ip = htmlobj2.responseText;
		if(csrf_ip == "127.0.0.1") {
			htmlobj3 = $.ajax({
				url: "https://mc.akkariin.com:24443/getip/",
				type: 'GET',
				async: true,
				error: function() {
					showmsg("CSRF 验证失败，请稍后重试或联系管理员")
				},
				success: function() {
					csrf_ip = htmlobj3.responseText;
				}
			});
		}
	}
});
function login() {
	$(".full-width").html('<i class="fa fa-circle-o-notch fa-spin"></i>');
	var urname = $("#username").val();
	var passwd = $("#password").val();
	htmlobj = $.ajax({
		url: "/?src=" + srcsite + "&type=login&referer=" + referer,
		type: 'POST',
		async: true,
		error: function() {
			showmsg(htmlobj.responseText);
			$(".full-width").html('继续');
		},
		success: function() {
			window.location = htmlobj.responseText;
		},
		data: {
			username: urname,
			password: passwd,
			useraddr: csrf_ip
		}
	});
};
function register() {
	$(".full-width").html('<i class="fa fa-circle-o-notch fa-spin"></i>');
	var urname = document.getElementById("username").value;
	var passwd = document.getElementById("password").value;
	var uemail = document.getElementById("email").value;
	var userqq = document.getElementById("qq").value;
	htmlobj = $.ajax({
		url: "/?src=" + srcsite + "&type=register",
		type: 'POST',
		async: true,
		error: function() {
			showmsg(htmlobj.responseText);
			$(".full-width").html('继续');
		},
		success: function() {
			window.location = "/";
		},
		data: {
			username: urname,
			password: passwd,
			emailadd: uemail,
			qqnumber: userqq,
			useraddr: csrf_ip
		}
	});
};
function findpass() {
	$(".full-width").html('<i class="fa fa-circle-o-notch fa-spin"></i>');
	var urname = document.getElementById("username").value;
	htmlobj = $.ajax({
		url: "/?src=" + srcsite + "&type=findpass",
		type: 'POST',
		async: true,
		error: function() {
			showmsg(htmlobj.responseText);
			$(".full-width").html('继续');
		},
		success: function() {
			showmsg(htmlobj.responseText);
			$(".full-width").html('继续');
		},
		data: {
			username: urname,
			useraddr: csrf_ip
		}
	});
};
function rnd(n, m){
	var random = Math.floor(Math.random()*(m-n+1)+n);
	return random;
}
var isopenmsgbox = false;
function showmsg(text) {
	$("#messagebg").fadeIn(300);
	$("#msgcontent").html(text);
	isopenmsgbox = true;
}
function closemsg(){
	if(isopenmsgbox) {
		$("#messagebg").fadeOut(300);
		isopenmsgbox = false;
	}
};
function progressshow(text) {
	$("#messagebg").fadeIn(300);
	$("#msgcontent").text(text);
}
function progressunshow() {
	$("#messagebg").fadeOut(300);
}
function changeheadimg() {
	var user = $("#username").val();
	$.ajax({
		type: 'get',
		url: 'https://natfrp.org/?do=headimg&user=' + user,
		dataType: "json",
		complete: function (obj, result) {
			if(result == 'parsererror') {
				$("#headimg").fadeOut();
				headimg.src = 'https://natfrp.org/?do=headimg&user=' + user;
				$("#headimg").fadeIn(500);
				return;
			} else {
				$("#headimg").fadeOut();
				headimg.src = 'https://natfrp.org/images/default.jpg';
				$("#headimg").fadeIn(500);
			}
		}
	});
}
window.onload = function() {
	switch(page) {
		case "login":
			var change_h = 350;
			var change_m = 273;
			break;
		case "register":
			var change_h = 350;
			var change_m = 273;
			break;
		case "findpass":
			var change_h = 350;
			var change_m = 273;
			break;
	}
	/*setInterval(function() {
		if(document.body.clientWidth > 512) {
			if(document.body.clientHeight > 670) {
				var window_h = document.body.clientHeight / 2;
				var top = window_h - change_h;
				$(".box-login").attr('style', 'position: relative;top: ' + top + 'px');
				$(".box-home").attr('style', 'position: relative;top: ' + top + 'px');
			} else {
				var window_h = document.body.clientHeight / 2;
				var top = window_h - change_m;
				$(".box-login").attr('style', 'position: relative;top: ' + top + 'px');
				$(".box-home").attr('style', 'position: relative;top: ' + top + 'px');
			}
		} else {
			$(".box-login").attr('style', '');
		}
	}, 1);*/
}