<?php /** @noinspection PhpUndefinedVariableInspection */ ?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<link href="<?= base_url('./assets/css/style.css') ?>" rel="stylesheet" type="text/css">
		<title><?= $titre ?></title>
	</head>
	<body class="bg-dark-blue text-white">
		<header class="border-b-4 border-deep-blue text-center py-4 lg:px-4 mb-10">
			<nav
				class="bg-black/55 py-4 rounded-full mx-auto max-w-7xl px-6 flex items-center justify-between shadow-lg shadow-gray-700/20 relative z-10">
				<!-- Logo -->
				<div class="flex items-center">
					<a href="/">
						<img loading="lazy" src="<?= base_url('./assets/images/logoHeader.png') ?>" alt="Logo La Borne Arcade"
							class="h-[80px] w-auto  absolute top-[2%] left-0 transform -translate-x-0 z-10">
					</a>
				</div>
				
				<!-- Liens -->
				<ul class="flex space-x-8 text-white font-medium items-center">
					<li><a href="/bornes" class="link-underline link-underline-black">Trouver ma borne</a></li>
					<li><a href="/borne-perso" class="link-underline link-underline-black">Personnaliser ma borne</a></li>
					<li><a href="/qui-sommes-nous" class="link-underline link-underline-black">À propos</a></li>
					<li><a href="/faq" class="link-underline link-underline-black">FAQ</a></li>
					<li><a href="/blog-articles" class="link-underline link-underline-black">Blog</a></li>
					<?php if (session()->has('user')): ?>
						<li class="flex items-center">
							<a href="/profile"
								class="relative inline-flex items-center justify-center w-10 h-10 overflow-hidden rounded-full bg-gray-600">
								<span
									class="font-medium text-gray-300 uppercase"><?= substr(session()->get('user')['email'], 0, 4) ?></span>
							</a>
						</li>
					<?php else: ?>
						<li class="flex items-center">
							<a href="/connexion"
								class="relative inline-flex items-center justify-center w-10 h-10 overflow-hidden rounded-full bg-gray-600 pl-1">
								<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
									stroke="currentColor" class="size-6">
									<path stroke-linecap="round" stroke-linejoin="round"
										d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
								</svg>
							</a>
						</li>
					<?php endif; ?>
				</ul>
			</nav>
		</header>
