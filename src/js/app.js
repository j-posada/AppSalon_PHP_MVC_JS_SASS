let paso = 1;


document.addEventListener('DOMContentLoaded', function () {
	iniciarApp();
});

function iniciarApp() {
	tabs();
}

function mostrarSeccion() {

	// Ocular la sección actual
	const seccionAnterior = document.querySelector(' .mostrar');
	if (seccionAnterior) {
		seccionAnterior.classList.remove('mostrar');
	}
	// Mostras la sección pulsada
	const seccion = document.querySelector(`#paso-${paso}`);
	seccion.classList.add('mostrar');
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