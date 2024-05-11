let paso = 1;


document.addEventListener('DOMContentLoaded', function () {
	iniciarApp();
});

function iniciarApp() {
	mostrarSeccion();
	tabs();
}

function mostrarSeccion() {

	// Ocular la sección actual
	const seccionAnterior = document.querySelector('.mostrar');
	if (seccionAnterior) {
		seccionAnterior.classList.remove('mostrar');
	}
	// Quita el focus del botón actual
	const tabAnterior = document.querySelector('.actual');
	if (tabAnterior) {
		tabAnterior.classList.remove('actual');
	}

	// Mostras la sección pulsada
	const seccion = document.querySelector(`#paso-${paso}`);
	seccion.classList.add('mostrar');

	// Cambiar focus del botón pulsado.
	const tab = document.querySelector(`[data-paso="${paso}"]`);
	tab.classList.add('actual');
}

function tabs() {
	const botones = document.querySelectorAll('.tabs button');

	botones.forEach(boton => {
		boton.addEventListener('click', function (e) {
			paso = parseInt(e.target.dataset.paso);
			mostrarSeccion();
			//console.log("diste click en el botón: "+ boton.innerHTML);
		});
	});
}