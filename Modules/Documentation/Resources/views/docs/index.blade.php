<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Fanoos Documentation</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="description" content="Description">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

	<!-- themes -->
	<link rel="stylesheet" href="//unpkg.com/docsify/lib/themes/vue.css">
	<!--link rel="stylesheet" href="//unpkg.com/docsify/lib/themes/buble.css"-->
	<!--link rel="stylesheet" href="//unpkg.com/docsify/lib/themes/dark.css"-->
	<!--link rel="stylesheet" href="//unpkg.com/docsify/lib/themes/pure.css"-->

	<!--link rel="stylesheet" href="https://unpkg.com/docsify-themeable/dist/css/theme-simple.css"-->
	<!--link rel="stylesheet" href="https://unpkg.com/docsify-themeable/dist/css/theme-simple-dark.css"-->
	<!--link rel="stylesheet" href="https://unpkg.com/docsify-themeable/dist/css/theme-defaults.css"-->
	
	<link rel="stylesheet" href="{{ Module::asset('documentation:styles/styles.css') }}">
	<link rel="stylesheet" href="{{ Module::asset('documentation:styles/rtl.css') }}">
</head>

<body>
	<div id="app"></div>
	<script>
		window.$docsify = {
			name: 'Fanoos CMS',
			nameLink: '/docs/',
			// logo: '/assets/images/logo.png',
			repo: '',
			loadSidebar: true,
			subMaxLevel: 2,
			coverpage: true,
			onlyCover: true,
			auto2top: true,
			//themeColor: '#f1dc24',
			routerMode: 'history',
			search: 'auto'
		}
	</script>
	<script src="//unpkg.com/docsify/lib/docsify.min.js"></script>

	<!-- language highlight - css, html and javascript is on by default -->
	<script src="//unpkg.com/prismjs/components/prism-bash.min.js"></script>
	<script src="//unpkg.com/prismjs/components/prism-php.min.js"></script>
	<script src="//unpkg.com/prismjs/components/prism-sql.min.js"></script>
	<script src="//unpkg.com/prismjs/components/prism-twig.min.js"></script>
</body>

</html>