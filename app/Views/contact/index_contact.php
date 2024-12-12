<?= /** @noinspection PhpUndefinedVariableInspection */
view('commun/header', ['titre' => $titre]) ?>
<!-- Section Contactez Nous -->
<section class="text-gray-300 text-xs py-12">
<div class="max-w-5xl mx-auto px-5 sm:px-0">
	<h2 class="text-center text-3xl font-extrabold text-gray-300 mb-10 ml-10">Contactez nous</h2>
	<div class="grid grid-cols-1 lg:grid-cols-2">
	
	<!-- Rectangle de gauche -->
	<div class="bg-medium-blue p-6">
		<h3 class="uppercase text-xl font-semibold mb-8">Une question, un devis ?<br>Appelez-nous !</h3>
		<div class="space-y-4">
			<div class="flex items-center space-x-4">
				<a target="_blank" id="whatsapp-button" class="bg-green-700 hover:bg-green-600 p-2">
					<svg class="w-6 h-6 text-gray-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
					<path fill="currentColor" fill-rule="evenodd" d="M12 4a8 8 0 0 0-6.895 12.06l.569.718-.697 2.359 2.32-.648.379.243A8 8 0 1 0 12 4ZM2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10a9.96 9.96 0 0 1-5.016-1.347l-4.948 1.382 1.426-4.829-.006-.007-.033-.055A9.958 9.958 0 0 1 2 12Z" clip-rule="evenodd"/>
					<path fill="currentColor" d="M16.735 13.492c-.038-.018-1.497-.736-1.756-.83a1.008 1.008 0 0 0-.34-.075c-.196 0-.362.098-.49.291-.146.217-.587.732-.723.886-.018.02-.042.045-.057.045-.013 0-.239-.093-.307-.123-1.564-.68-2.751-2.313-2.914-2.589-.023-.04-.024-.057-.024-.057.005-.021.058-.074.085-.101.08-.079.166-.182.249-.283l.117-.14c.121-.14.175-.25.237-.375l.033-.066a.68.68 0 0 0-.02-.64c-.034-.069-.65-1.555-.715-1.711-.158-.377-.366-.552-.655-.552-.027 0 0 0-.112.005-.137.005-.883.104-1.213.311-.35.22-.94.924-.94 2.16 0 1.112.705 2.162 1.008 2.561l.041.06c1.161 1.695 2.608 2.951 4.074 3.537 1.412.564 2.081.63 2.461.63.16 0 .288-.013.4-.024l.072-.007c.488-.043 1.56-.599 1.804-1.276.192-.534.243-1.117.115-1.329-.088-.144-.239-.216-.43-.308Z"/>
					</svg>
				</a>
				<div>
					<p class="font-bold text-gray-300 text-xl">Whatsapp</p>
					<p class="text-lg text-gray-300 ">07 68 53 46 26</p>
				</div>
			</div>
			<div class="flex items-center space-x-4">
				<a href="mailto:contact@LaBorneArcade.com" class="bg-green-700 hover:bg-green-600 p-2">
					<svg class="w-6 h-6 text-gray-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
					<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16v-5.5A3.5 3.5 0 0 0 7.5 7m3.5 9H4v-5.5A3.5 3.5 0 0 1 7.5 7m3.5 9v4M7.5 7H14m0 0V4h2.5M14 7v3m-3.5 6H20v-6a3 3 0 0 0-3-3m-2 9v4m-8-6.5h1"/>
					</svg>
				</a>
				<div>
					<p class="font-bold text-gray-300 text-xl">E-mail</p>
					<p class="text-lg text-gray-300 ">Contact@LaBorneArcade.com</p>
				</div>
			</div>
			<div class="flex items-center space-x-4">
				<a href="tel:+33768534626" target="_blank" class="bg-green-700 hover:bg-green-600 p-2">
					<svg class="w-6 h-6 text-gray-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
					<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.427 14.768 17.2 13.542a1.733 1.733 0 0 0-2.45 0l-.613.613a1.732 1.732 0 0 1-2.45 0l-1.838-1.84a1.735 1.735 0 0 1 0-2.452l.612-.613a1.735 1.735 0 0 0 0-2.452L9.237 5.572a1.6 1.6 0 0 0-2.45 0c-3.223 3.2-1.702 6.896 1.519 10.117 3.22 3.221 6.914 4.745 10.12 1.535a1.601 1.601 0 0 0 0-2.456Z"/>
					</svg>
				</a>
				<div>
					<p class="font-bold text-gray-300 text-xl">Telephone</p>
					<p class="text-lg text-gray-300 ">07 68 53 46 26</p>
				</div>
			</div>
		</div>
	</div>
	
	<!-- Rectangle de droite -->
	<div class="bg-gray-800 p-6">
		<h3 class="uppercase mb-8 text-xl font-semibold">Envoyer nous votre message</h3>
		<?= form_open('/contact',['class' => 'space-y-4']); ?>
			<div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
				<div>
					<?= form_label('Nom', 'nom', ['class' => 'block text-gray-300 text-lg text-gray-300  font-medium mb-1 ml-1']); ?>
					
					<?= form_input([
						'name'          => 'nom',
						'id'            => 'nom',
						'class'         => 'w-full bg-gray-700 text-gray-300 text-xs rounded-lg border px-4 py-2 mb-2 focus:outline-none focus:ring-2 border-gray-600 focus:ring-green-500',
						'value'         => set_value('nom'),
						'required'
					]); ?>
				</div>
				<div>
					<?= form_label('Entreprise', 'entreprise', ['class' => 'block text-gray-300 text-lg text-gray-300  font-medium mb-1 ml-1']); ?>
					
					<?= form_input([
						'name'          => 'entreprise',
						'id'            => 'entreprise',
						'class'         => 'w-full bg-gray-700 text-gray-300 text-xs rounded-lg border px-4 py-2 mb-2 focus:outline-none focus:ring-2 border-gray-600 focus:ring-green-500',
						'value'         => set_value('entreprise'),
						'required'
					]); ?>
				</div>
			</div>
			<div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
				<div>
					<?= form_label('Téléphone', 'phone', ['class' => 'block text-gray-300 text-lg text-gray-300  font-medium mb-1 ml-1']); ?>
					
					<?php
					$focusRIng = (validation_show_error('phone')) ? 'border-red-600 focus:ring-red-500' : 'border-gray-600 focus:ring-green-500';
					echo form_input([
						'name'          => 'phone',
						'id'            => 'phone-number',
						'class'         => 'w-full bg-gray-700 text-gray-300 text-xs rounded-lg border px-4 py-2 mb-2 focus:outline-none focus:ring-2 '.$focusRIng,
						'value'         => set_value('phone'),
					]); ?>
					
					<span class="items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
						<?= validation_show_error('phone') ?>
					</span>
				</div>
				<div>
					<?= form_label('Email <span class="text-green-500/30">(*)</span>', 'email', ['class' => 'block text-gray-300 text-lg text-gray-300  font-medium mb-1 ml-1']); ?>
					
					<?php
					$focusRIng = (validation_show_error('email')) ? 'border-red-600 focus:ring-red-500' : 'border-gray-600 focus:ring-green-500';
					echo form_input([
						'name'          => 'email',
						'id'            => 'email',
						'class'         => 'w-full bg-gray-700 text-gray-300 text-xs rounded-lg border px-4 py-2 mb-2 focus:outline-none focus:ring-2 '.$focusRIng,
						'value'         => set_value('email', session()->has('user') ? session()->get('user')['email'] : ''),
						'aria-required' => 'true',
						'required'
					]); ?>
					
					<span class="items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
						<?= validation_show_error('email') ?>
					</span>
				</div>
			</div>
			<div>
					<?= form_label('Message <span class="text-green-500/30">(*)</span>', 'message', ['class' => 'block text-gray-300 text-lg text-gray-300  font-medium mb-1 ml-1']); ?>
					
					<?php
					$focusRIng = (validation_show_error('message')) ? 'border-red-600 focus:ring-red-500' : 'border-gray-600 focus:ring-green-500';
					echo form_textarea([
						'name'          => 'message',
						'id'            => 'message',
						'rows'          => '5',
						'class'         => 'w-full bg-gray-700 text-gray-300 text-xs rounded-lg border px-4 py-2 mb-2 focus:outline-none focus:ring-2 '.$focusRIng,
						'value'         => set_value('message', $message),
						'aria-required' => 'true',
						'required'
					]); ?>
					
					<span class="items-center font-medium tracking-wide text-red-500 text-xs mt-1 ml-1">
						<?= validation_show_error('message') ?>
					</span>
			</div>
			<?= form_submit('submit', 'Envoyer', "class='w-full bg-green-700 text-gray-300 text-xs font-semibold rounded-lg px-4 py-2 mb-2  hover:bg-green-500/60 cursor-pointer'"); ?>

		<?= form_close(); ?>
	</div>

	</div>
</div>
</section>

<script src="./assets/js/btn-whatsapp.js"></script>
<?= view('commun/footer') ?>
