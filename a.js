function x() {
	$("#user").prop("disabled", true);
	$("[type=submit]").prop("disabled", true);
	//console.log(idd);
	//console.log(cookie);
	if (typeof idd == "undefined") {
		//id = false;
		idd = $("#id").val();
		if (typeof cookie == "undefined") {
			cookie = false;
		}
	}
	user = $("#user").val();
	$('#user').val('');
	user = user.charAt(0).toUpperCase() + user.slice(1);
	$("<p id='u'>"+user+".</p>").insertBefore('#user');
	console.log("Usuario: "+user);
	$.ajax({
		url: 'x.php',
		type: 'get',
		data: {user:user, id:idd, cookie:cookie},
		success: function (data) {
			bot    = decodeURIComponent(data.bot);
			user   = data.user;
			idd    = data.id;
			cookie = data.cookie;
			$("<p id='m'>"+bot+"</p>").insertBefore('#user');
			$("#user").prop("disabled", false);
			$("[type=submit]").prop("disabled", false);
			$("#user").focus();
			console.log("Maquina: "+bot);
		},
		error: function(jqXHR, textStatus, errorThrown){
			console.log("No hay conexion");
		}
	})
}

function z() {
	if (event.keyCode==13) {
		user = $("#user").val();
		if (user.trim().length !== 0) {
			x();
		}
	}
}
