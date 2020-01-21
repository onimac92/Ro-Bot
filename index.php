<!DOCTYPE html>
<html>
<head>
	<title>Ro-Bot</title>
	<meta charset="utf-8">
	<link rel="shortcut icon" href="favicon.ico">
	<script src="jquery.js" type="text/javascript"></script>
	<script src="a.js" type="text/javascript"></script>
	<style type="text/css">
	* {
		font-family: Lato,Tahoma,Arial,serif;
		font-size: 0.95rem;
	}
	#m {
		color: #34bb08;
		font-weight: bold;
	}
	#u {
		color: #0869bb;
		font-weight: bold;
	}
	#inner {
	  display: table;
	  margin: 0 auto;
	}
	#outer {
	  width:100%
	}
	</style>
</head>
<body>
	<div id="outer">
		<div id="inner">
			<input onkeyup="z()" autocomplete="off" id="user">
			<input style="display: none;" autocomplete="off" id="id" placeholder="ID">
			<button onclick="x()" type="submit">Enviar</button>
		</div>
	</div>
</body>
</html>
