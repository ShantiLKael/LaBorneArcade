<!DOCTYPE html>
<html lang="fr">
<head>
    <!-- Import Tailwind CSS -->
    <link href="/assets/css/style.css" rel="stylesheet" type="text/css">
    <title><?= $titre ?></title>
</head>
<body class="bg-[#ebf0ea] text-dark-blue">
<header class="flex">
    <!-- Navbar -->
    <nav id="navbar" class="bg-black text-white fixed top-0 left-0 h-screen w-[250px] z-50 flex flex-col px-6 py-4 shadow-lg shadow-gray-700/20 transition-all">
        <br><h1 class="font-bold">Administrateur</h1>
        <!-- Liens -->
        <ul id="nav-links" class="flex flex-col space-y-4 text-white font-bold text-lg">
            <li class="m-5"><a href="/admin/bornes" class="px-4 py-2 rounded hover:bg-gray-700 transition">Ajouter une borne</a></li>
            <li class="m-5"><a href="/admin/theme" class="px-4 py-2 rounded hover:bg-gray-700 transition">Thème</a></li>
            <li class="m-5"><a href="/admin/matiere" class="px-4 py-2 rounded hover:bg-gray-700 transition">Matière</a></li>
            <li class="m-5"><a href="/admin/option" class="px-4 py-2 rounded hover:bg-gray-700 transition">Option</a></li>
            <li class="m-5"><a href="/admin/joystick" class="px-4 py-2 rounded hover:bg-gray-700 transition">Joystick</a></li>
            <li class="m-5"><a href="/admin/TMolding" class="px-4 py-2 rounded hover:bg-gray-700 transition">TMolding</a></li>
            <li class="m-5"><a href="/admin/bouton" class="px-4 py-2 rounded hover:bg-gray-700 transition">Bouton</a></li>
            <li class="m-5"><a href="/admin/contact" class="px-4 py-2 rounded hover:bg-gray-700 transition">Contact</a></li>
            <li class="m-5"><a href="/admin/articles" class="px-4 py-2 rounded hover:bg-gray-700 transition">Articles</a></li>
            <li class="m-5"><a href="/admin/faqs" class="px-4 py-2 rounded hover:bg-gray-700 transition">FAQs</a></li>
        </ul>
    </nav>

    <!-- Bouton hamburger -->
    <div class="md:hidden fixed top-4 left-4 z-50">
        <button id="menu-btn" class="text-white bg-black px-4 py-2 rounded focus:outline-none" onclick="boutonHam()">☰</button>
    </div>
</header>

<script>
    function boutonHam() {
        const navbar = document.getElementById("navbar");
        if (navbar.style.width === "250px") {
            navbar.style.width = "0";
        } else {
            navbar.style.width = "250px";
        }
    }
</script>