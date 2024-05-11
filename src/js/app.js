let paso = 1;


document.addEventListener('DOMContentLoaded', function () {
	iniciarApp();
});

function iniciarApp() {
	mostrarSeccion(); // Muestra y oculta las secciones. (Firt time)
	tabs(); // Cabmia la sección cuando se presionen los tabs
	botonesPaginador(); // Agrega o quita los botones del paginador.
	bt_paginaSiguiente();
	bt_paginaAnterior();
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
			botonesPaginador();			//console.log("diste click en el botón: "+ boton.innerHTML);
		});
	});
}

function botonesPaginador() {
	const paginaAnterior = document.querySelector('#anterior');
	const paginaSiguinete = document.querySelector('#siguiente');

	if (paso === 1) {
		paginaAnterior.classList.add('ocultar');
		paginaSiguinete.classList.remove('ocultar')

	} else if (paso === 3) {
		paginaAnterior.classList.remove('ocultar');
		paginaSiguinete.classList.add('ocultar')
	}
	else{
		paginaAnterior.classList.remove('ocultar');
		paginaSiguinete.classList.remove('ocultar')
	}
	mostrarSeccion();
}

function bt_paginaSiguiente() {
	const bt_paginaSiguiente = document.querySelector('#siguiente');
	bt_paginaSiguiente.addEventListener('click', function () {
		paso++;	
		
		botonesPaginador();
	});

}

function bt_paginaAnterior () {
	const bt_paginaAnterior = document.querySelector('#anterior');
	bt_paginaAnterior.addEventListener('click', function () {
		paso--;	
		botonesPaginador();
	});
}