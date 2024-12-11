<html lang="fr">
<head>
	<link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.0/dist/tailwind.min.css" rel="stylesheet">
	<!-- <link href="/assets/css/style.css" rel="stylesheet" type="text/css"> -->
	<title><?= $titre ?></title>
</head>
<body class="bg-[#ebf0ea] text-dark-blue">
<header class="flex h-screen">
	<!-- Navbar -->
	<nav id="navbar" class="bg-black text-white fixed top-0 left-0 h-full w-0 md:w-1/5 transition-all duration-300 md:static md:h-auto flex flex-col px-6 py-4 shadow-lg shadow-gray-700/20 z-50">
		<!-- Logo -->
		<div class="flex items-center mb-6">
			<img loading="lazy" src="chemin-vers-logo.png" alt="Logo La Borne Arcade" class="h-10 w-auto">
		</div>

		<!-- Liens -->
		<ul id="nav-links" class="hidden md:flex flex-col space-y-4 text-white font-medium">
			<li><a href="/admin/bornes" class="link-underline link-underline-black">Ajouter une borne</a></li>
			<li><a href="/admin/theme" class="link-underline link-underline-black">Thème</a></li>
			<li><a href="/admin/matiere" class="link-underline link-underline-black">Matière</a></li>
			<li><a href="/admin/option" class="link-underline link-underline-black">Option</a></li>
			<li><a href="/admin/joystick" class="link-underline link-underline-black">Joystick</a></li>
			<li><a href="/admin/TMolding" class="link-underline link-underline-black">TMolding</a></li>
			<li><a href="/admin/bouton" class="link-underline link-underline-black">Bouton</a></li>
			<li><a href="/admin/contact" class="link-underline link-underline-black">Contact</a></li>
			<li><a href="/admin/articles" class="link-underline link-underline-black">Articles</a></li>
			<li><a href="/admin/faqs" class="link-underline link-underline-black">FAQs</a></li>
		</ul>
	</nav>

	<!-- Bouton hamburger -->
	<div class="md:hidden fixed top-4 left-4 z-50">
		<button id="menu-btn" class="text-white bg-black px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-gray-300">
			☰
		</button>
	</div>

	<!-- Contenu principal -->
	<div class="flex-1 md:ml-[20%] bg-[#d8dfd7] text-dark-blue p-8">
		<main>
			<!-- Votre contenu ici -->
			<h1>Bienvenue sur la page admin</h1>
			<p>Cliquez sur le bouton pour voir la navigation mobile.</p>
		</main>
	</div>
</header>

<script>
	const menuBtn = document.getElementById('menu-btn');
	const navbar = document.getElementById('navbar');

	// Toggle la navbar en mode mobile
	menuBtn.addEventListener('click', () => {
		if (navbar.classList.contains('w-0')) {
			navbar.style.width = '70%';
			navbar.classList.remove('w-0');
		} else {
			navbar.style.width = '0';
			navbar.classList.add('w-0');
		}
	});
</script>