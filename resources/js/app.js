import './bootstrap';
import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';
require('datatables.net-bs5');

window.Alpine = Alpine;
Alpine.plugin(focus);
Alpine.start();

document.addEventListener('DOMContentLoaded', (event) => {
    console.log('Document is ready');
    // Tu lógica de JavaScript personalizada
    const buttons = document.querySelectorAll('.btn-custom');
    buttons.forEach(button => {
        button.addEventListener('click', () => {
            alert('Button clicked!');
        });
    });
});
