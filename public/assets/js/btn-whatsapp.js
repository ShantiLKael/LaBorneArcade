const whatsappBtn = document.getElementById('whatsapp-button');
whatsappBtn.style.cursor = "pointer";
whatsappBtn.addEventListener('click', 
	function()
	{
		let message = document.getElementById('message').value;
		open('https://wa.me/33768534626?text=' + esc(message));
	}
);
