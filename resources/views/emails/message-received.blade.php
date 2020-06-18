<!DOCTYPE html>
<html lang="es">
<head>
	<title>Message</title>
</head>
<body>
	<p>Recibido el mensaje de: {{ $msg['name']}} - {{ $msg['email'] }}</p>
	<p><strong>Asunto: </strong>{{ $msg['asunt'] }}</p>
	<p><strong>Mensaje: </strong>{{ $msg['message'] }}</p>
</body>
</html>
