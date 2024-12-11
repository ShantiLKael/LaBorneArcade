<html lang="fr">
<head>
	<link href="/assets/css/style.css" rel="stylesheet" type="text/css">
	<title><?= $titre ?></title>
</head>
<body class="bg-[#d8dfd7] text-dark-blue">
<header class="border-b-4 border-deep-blue flex h-scree">
    <nav id="navbar" class="bg-black text-white fixed top-0 left-0 h-full w-0 md:w-1/5 transition-all duration-300 md:static md:h-auto md:w-1/5 flex flex-col md:flex md:items-start px-6 py-4 shadow-lg shadow-gray-700/20 z-50">
        <!-- Logo -->
        <div class="flex items-center">
            <img loading="lazy" src="chemin-vers-logo.png" alt="Logo La Borne Arcade" class="h-10 w-auto">
        </div>
        <!-- Bouton hamburger (mobile) -->
        <button
            id="menu-btn"
            class="block md:hidden text-white focus:outline-none focus:ring-2 focus:ring-gray-300">☰
        </button>
        <!-- Liens -->
        <ul class="flex space-x-8 text-white font-medium items-center">
            <li><a href="/admin/bornes"          class="link-underline link-underline-black">Ajouter une borne</a></li>
            <li><a href="/admin/theme"     class="link-underline link-underline-black">Thème</a></li>
            <li><a href="/admin/matiere" class="link-underline link-underline-black">Matière</a></li>
            <li><a href="/admin/option"             class="link-underline link-underline-black">Option</a></li>
            <li><a href="/admin/joystick"   class="link-underline link-underline-black">Joystick</a></li>
            <li><a href="/admin/TMolding" class="link-underline link-underline-black">TMolding</a></li>
            <li><a href="/admin/bouton"             class="link-underline link-underline-black">Bouton</a></li>
            <li><a href="/admin/contact"   class="link-underline link-underline-black">contact</a></li>
            <li><a href="/admin/articles"   class="link-underline link-underline-black">articles</a></li>
            <li><a href="/admin/faqs"   class="link-underline link-underline-black">faqs</a></li>
            <?php if (session()->has('user')) : ?>
                <li class="flex items-center">
                    <a href="/profile" class="relative inline-flex items-center justify-center w-10 h-10 overflow-hidden rounded-full bg-gray-600">
                        <span class="font-medium text-gray-300 uppercase"><?= substr(session()->get('user')['email'], 0, 4) ?></span>
                    </a>
                </li>
            <?php else : ?>
            <li class="flex items-center">
                <a href="/connexion" class="relative inline-flex items-center justify-center w-10 h-10 overflow-hidden rounded-full bg-gray-600 pl-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                    </svg>
                </a>
            </li>
            <?php endif; ?>
        </ul>
    </nav>
</header>

<script>
    const menuBtn = document.getElementById('menu-btn');
    const navbar = document.getElementById('navbar');

    // Affiche ou cache la navbar en mode mobile
    menuBtn.addEventListener('click', () => {
        navbar.style.width = navbar.style.width === '0px' || navbar.style.width === '' ? '70%' : '0';
    });
</script>
