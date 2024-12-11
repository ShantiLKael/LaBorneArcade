<html lang="fr">
<head>
	<!-- Import Tailwind CSS -->
	<link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.0/dist/tailwind.min.css" rel="stylesheet">
	<link href="/assets/css/style.css" rel="stylesheet" type="text/css">
	<title><?= $titre ?></title>
</head>
<body class="bg-[#ebf0ea] text-dark-blue">
<header class="flex flex-col md:flex-row h-screen">
	<!-- Navbar -->
	<nav id="navbar" class="bg-black text-white fixed top-0 left-0 h-screen w-3/4 md:w-1/5 transition-all duration-300 z-50 flex flex-col px-6 py-4 shadow-lg shadow-gray-700/20">
		<!-- Logo -->
		<div class="flex items-center mb-6">
			<img loading="lazy" src="chemin-vers-logo.png" alt="Logo La Borne Arcade" class="h-10">
		</div>
		<h1 class="font-bold text-lg md:text-xl">Administrateur</h1>
		<br>
		<!-- Liens -->
		<ul id="nav-links" class="flex flex-col space-y-4">
			<li>
				<a href="/admin/bornes" class="block px-4 py-2 rounded bg-gray-800 hover:bg-gray-700 transition duration-200">
					Ajouter une borne
				</a>
			</li>
			<li>
				<a href="/admin/theme" class="block px-4 py-2 rounded bg-gray-800 hover:bg-gray-700 transition duration-200">
					Thème
				</a>
			</li>
			<li>
				<a href="/admin/matiere" class="block px-4 py-2 rounded bg-gray-800 hover:bg-gray-700 transition duration-200">
					Matière
				</a>
			</li>
			<!-- Ajoutez d'autres liens ici -->
		</ul>
	</nav>

	<!-- Bouton hamburger -->
	<div class="md:hidden fixed top-4 left-4 z-50">
		<button id="menu-btn" class="text-white bg-black px-4 py-2 rounded focus:outline-none focus:ring-2 focus:ring-gray-300">
			☰
		</button>
	</div>

	<!-- Contenu principal -->
	<main class="flex-1 md:ml-[20%] p-8">
		<?= $this->renderSection('content') ?>
	</main>
</header>

<script>
	const menuBtn = document.getElementById('menu-btn');
	const navbar = document.getElementById('navbar');

	menuBtn.addEventListener('click', () => {
		if (navbar.classList.contains('hidden')) {
			navbar.classList.remove('hidden');
			navbar.style.width = '70%';
		} else {
			navbar.classList.add('hidden');
			navbar.style.width = '0';
		}
	});
</script>