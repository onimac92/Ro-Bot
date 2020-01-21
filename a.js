function x() {
	$("#user").prop("disabled", true);
	$("[type=submit]").prop("disabled", true);
	if (typeof id == "undefined") {
		//id = false;
		id = $("#id").val();
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
		data: {user:user, id:id, cookie:cookie},
		success: function (data) {
			bot    = decodeURIComponent(data.bot);
			user   = data.user;
			id	   = data.id;
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
