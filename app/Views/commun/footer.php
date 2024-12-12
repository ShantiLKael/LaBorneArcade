<a href="/panier" class="fixed bottom-3 right-3 md:bottom-10 md:right-10">
<?php if (!session()->has('user') && session()->has('panier')): ?>
	<p class="flex h-2 w-2 font-bold items-center justify-center mt-4 rounded-full bg-red-500 p-3 text-xs text-white">
		<?= count(session()->get('panier')) ?></p>
<?php endif; ?>
<div
	class="p-4 lg:p-5 rounded-full bg-green-600 hover:bg-green-500 shadow-lg shadow-green-900 focus:outline-none focus:ring-1 focus:ring-green-400 focus:ring-offset-2">
	<!-- SVG du caddie -->
	<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
		class="file: h-6 w-6 lg:h-8 md:w-8">
		<path stroke-linecap="round" stroke-linejoin="round"
			d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
	</svg>
</div>
</a>

<?php if (isset($confiance) && $confiance) : ?>
<!-- Ils nous font confiance. -->
<section class="max-w-xl mx-auto mt-10 mb-10">
	<div class="bg-gradient-to-r from-dark-teal to-medium-blue text-center pt-4">
		<h3 class="text-lg text-white font-semibold mb-4">Ils nous font confiance</h3>
		<div class="grid grid-cols-3 sm:grid-cols-6 gap-4 p-5 items-center justify-center">
			<img loading="lazy" src="./assets/images/logos/fanta.png" alt="Fanta" class="h-11 mx-auto">
			
			<img loading="lazy" src="./assets/images/logos/galerie-lafayette.png" alt="Galerie LaFayette" class="h-11 mx-auto">
			<img loading="lazy" src="./assets/images/logos/decathlon.png" alt="Decathlon" class="h-7 mx-auto">
			<img loading="lazy" src="./assets/images/logos/orange.png" alt="Orange" class="h-10 mx-auto">
			<img loading="lazy" src="./assets/images/logos/twitter.webp" alt="Twitter" class="h-11 mx-auto">
			<img loading="lazy" src="./assets/images/logos/otacos.png" alt="Otacos" class="h-11 mx-auto">
		</div>
		<div class="bg-white p-3 grid grid-cols-5 gap-2 justify-center">
			<img loading="lazy" src="./assets/images/logos/printemps.png" alt="Printers" class="h-11 mx-auto">
			<img loading="lazy" src="./assets/images/logos/bnp.png" alt="BNP Paribas" class="h-11 mx-auto">
			<img loading="lazy" src="./assets/images/logos/mini.png" alt="Mini" class="h-9 mx-auto">
			<img loading="lazy" src="./assets/images/logos/bestwestern.png" alt="Best Western" class="h-11 mx-auto">
			<img loading="lazy" src="./assets/images/logos/enedis.png" alt="Enedis" class="h-11 mx-auto">
		</div>
	</div>
</section>
<?php endif; ?>

<!-- Footer -->
<footer class="py-5 text-gray-100">
	<div class="max-w-6xl mx-auto">
		<div class="text-center md:text-right md:px-3 text-sm pb-6">
			<a href="<?php echo base_url('/qui-sommes-nous') ?>" class="hover:text-light-teal">À propos</a>
			<span class="mx-2">|</span>
			<a href="<?php echo base_url('/contact') ?>" class="hover:text-light-teal">Me contacter</a>
			<span class="mx-2">|</span>
			<a href="<?php echo base_url('/condition-de-vente') ?>" class="hover:text-light-teal">CGV</a>
			<span class="mx-2">|</span>
			<a href="<?php echo base_url('/blog-articles') ?>" class="hover:text-light-teal">Blog</a>
		</div>

		<!-- Liens -->
		<div class="flex flex-col sm:flex-row sm:px-10 justify-between items-center border-t border-white/50 pt-6">
			<div class="flex gap-4 mb-4 sm:mb-0 sm:px-3">

				<!-- WhatsApp -->
				<a href="https://wa.me/33768534626" class="text-gray-100 text-xs hover:text-light-teal">
					<svg class="w-9 h-11" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
						fill="none" viewBox="0 0 24 24">
						<path fill="currentColor" fill-rule="evenodd"
							d="M12 4a8 8 0 0 0-6.895 12.06l.569.718-.697 2.359 2.32-.648.379.243A8 8 0 1 0 12 4ZM2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10a9.96 9.96 0 0 1-5.016-1.347l-4.948 1.382 1.426-4.829-.006-.007-.033-.055A9.958 9.958 0 0 1 2 12Z"
							clip-rule="evenodd" />
						<path fill="currentColor"
							d="M16.735 13.492c-.038-.018-1.497-.736-1.756-.83a1.008 1.008 0 0 0-.34-.075c-.196 0-.362.098-.49.291-.146.217-.587.732-.723.886-.018.02-.042.045-.057.045-.013 0-.239-.093-.307-.123-1.564-.68-2.751-2.313-2.914-2.589-.023-.04-.024-.057-.024-.057.005-.021.058-.074.085-.101.08-.079.166-.182.249-.283l.117-.14c.121-.14.175-.25.237-.375l.033-.066a.68.68 0 0 0-.02-.64c-.034-.069-.65-1.555-.715-1.711-.158-.377-.366-.552-.655-.552-.027 0 0 0-.112.005-.137.005-.883.104-1.213.311-.35.22-.94.924-.94 2.16 0 1.112.705 2.162 1.008 2.561l.041.06c1.161 1.695 2.608 2.951 4.074 3.537 1.412.564 2.081.63 2.461.63.16 0 .288-.013.4-.024l.072-.007c.488-.043 1.56-.599 1.804-1.276.192-.534.243-1.117.115-1.329-.088-.144-.239-.216-.43-.308Z" />
					</svg>
				</a>

				<!-- Instagram -->
				<a href="https://www.instagram.com/la_borne/" class="text-gray-100 text-xs hover:text-light-teal">
					<svg class="w-10 h-11" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
						fill="none" viewBox="0 0 24 24">
						<path fill="currentColor" fill-rule="evenodd"
							d="M3 8a5 5 0 0 1 5-5h8a5 5 0 0 1 5 5v8a5 5 0 0 1-5 5H8a5 5 0 0 1-5-5V8Zm5-3a3 3 0 0 0-3 3v8a3 3 0 0 0 3 3h8a3 3 0 0 0 3-3V8a3 3 0 0 0-3-3H8Zm7.597 2.214a1 1 0 0 1 1-1h.01a1 1 0 1 1 0 2h-.01a1 1 0 0 1-1-1ZM12 9a3 3 0 1 0 0 6 3 3 0 0 0 0-6Zm-5 3a5 5 0 1 1 10 0 5 5 0 0 1-10 0Z"
							clip-rule="evenodd" />
					</svg>
				</a>

				<!-- Facebook -->
				<a href="https://www.facebook.com/LaBorneArcade"
					class="text-gray-100 text-xs hover:text-light-teal hover:border-light-teal">
					<svg class="w-7 h-11 fill-current" role="img" xmlns="http://www.w3.org/2000/svg"
						viewBox="0 0 24 24">
						<path
							d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
					</svg>
				</a>
			</div>
		</div>

		<!-- Copyright -->
		<div class="text-center text-sm mt-4">
			&copy; 2024 La Borne Arcade
		</div>
	</div>
</footer>
</body>
</html>
