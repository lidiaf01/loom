
import './bootstrap';
import './navigation';
import './modal-toast';

// Script global para acordeón de ajustes
document.addEventListener('DOMContentLoaded', function() {
	document.querySelectorAll('.toggle-accordion').forEach(function(btn) {
		btn.addEventListener('click', function() {
			const content = btn.parentElement.querySelector('.accordion-content');
			if (content) content.classList.toggle('hidden');
		});
	});
});
