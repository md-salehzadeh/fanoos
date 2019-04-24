<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        window.Laravel = { csrfToken: 'csrf_token()' }
    </script>
	<title>Fanoos CMS</title>

	<link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons' rel="stylesheet">
	<link href='/css/admin/rtl.css' rel="stylesheet">
	<link href='/css/admin/main.css' rel="stylesheet">
</head>

<body>
    <div id="app">
		<!--AdminLayout :user-id='@json(auth()->user()->id)' :user-name='@json(auth()->user()->firstname)'></AdminLayout-->
		<Admin :user-id='@json(auth()->user()->id)' :user-name='@json(auth()->user()->firstname)'></Admin>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
