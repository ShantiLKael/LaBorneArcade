
<html lang="fr">
<head>
	<!-- Import Tailwind CSS -->
	<link href="/assets/css/style.css" rel="stylesheet" type="text/css">
	<title><?= $titre ?></title>
</head>
<body class="bg-[#ebf0ea] text-dark-blue">
<header class="flex h-screen">
	<!-- Navbar -->
	<nav id="navbar" class="bg-black text-white fixed top-0 left-0 h-full w-0 md:w-1/5 transition-all duration-300 z-50 flex flex-col px-6 py-4 shadow-lg shadow-gray-700/20">
		<!-- Logo -->
		<div class="flex items-center mb-6">
			<img loading="lazy" src="chemin-vers-logo.png" alt="Logo La Borne Arcade" class="h-10 w-auto">
		</div>

		<!-- Liens -->
		<ul id="nav-links" class="flex flex-col space-y-8 text-white font-bold">
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
	<div class="flex-1 md:ml-[20%] bg-[#ebf0ea] p-8">
		<main>
			<!-- Contenu ici -->
			<h1 class="text-center text-3xl font-bold">Bienvenue sur la page admin</h1>
			<p class="text-center mt-4">Cliquez sur le bouton pour voir la navigation mobile.</p>
		</main>
	</div>
</header>

<script>
	const menuBtn = document.getElementById('menu-btn');
	const navbar = document.getElementById('navbar');

	// Gestion de l'ouverture et fermeture de la navbar
	menuBtn.addEventListener('click', () => {
		navbar.style.width = navbar.style.width === '0px' || navbar.style.width === '' ? '70%' : '0';
	});
</script>