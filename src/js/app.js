let paso = 1;

const cita = {
	nombre: "",
	fecha: "",
	hora: "",
	servicios: []
}

document.addEventListener('DOMContentLoaded', function () {
	iniciarApp();
});

function iniciarApp() {
	mostrarSeccion(); // Muestra y oculta las secciones. (Firt time)
	tabs(); // Cabmia la sección cuando se presionen los tabs
	botonesPaginador(); // Inicia botones del paginador.
	bt_paginaSiguiente();
	bt_paginaAnterior();
	consultarAPI();
	nombreCliente();

	seleccionarFecha();
	seleccionarHora();
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
	else {
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

function bt_paginaAnterior() {
	const bt_paginaAnterior = document.querySelector('#anterior');
	bt_paginaAnterior.addEventListener('click', function () {
		paso--;
		botonesPaginador();
	});
}

async function consultarAPI() {

	try {
		const url = 'http://localhost:3000/api/servicios';
		const resultado = await fetch(url);
		const servicios = await resultado.json();
		mostrarServicios(servicios);

	} catch (error) {
		console.log(error);
	}


	function mostrarServicios(servicios) {
		servicios.forEach(servicio => {
			const { id, nombre, precio } = servicio;

			const nombreServicio = document.createElement('P');
			nombreServicio.classList.add('nombre-servicio');
			nombreServicio.textContent = nombre;

			const precioServicio = document.createElement('P');
			precioServicio.classList.add('precio-servicio');
			precioServicio.textContent = precio + ' €';

			const servicioDiv = document.createElement('DIV');
			servicioDiv.classList.add('servicio');
			servicioDiv.dataset.idServicio = id;
			servicioDiv.appendChild(nombreServicio);
			servicioDiv.appendChild(precioServicio);

			servicioDiv.onclick = function () {
				seleccionarServicio(servicio, servicioDiv);
			}

			document.querySelector('#servicios').appendChild(servicioDiv);

		})
	}

}
function seleccionarServicio(servicio, div) {
	const { id } = servicio;
	const { servicios } = cita;

	if (servicios.some(agregado => agregado.id === servicio.id)) {
		// Retiro servicio
		cita.servicios = servicios.filter(agregado => agregado.id != servicio.id);
		div.classList.remove('seleccionado');
	}
	else {
		//Agrego servicio
		cita.servicios = [...servicios, servicio];
		div.classList.add('seleccionado');

	}

	//const divServicio = document.querySelector(`[data-id-servicio="${id}"]`); 
	//divServicio.classList.add('seleccionado');
	//div.classList.add('seleccionado');
}

function nombreCliente() {
	cita.nombre = document.querySelector('#nombre').value;
}

function seleccionarFecha() {
	const inputFecha = document.querySelector('#fecha');
	inputFecha.addEventListener('input', function (e) {
		const dia = new Date(e.target.value).getUTCDay();

		if ([6, 0].includes(dia)) {
			e.target.value = '';
			mostrarAlerta('Fines de semana no permitidos', 'error');
		}
		else {
			cita.fecha = e.target.value;
		}
	})
}

function seleccionarHora() {
	const inputHora = document.querySelector('#hora');
	inputHora.step = '900';
	inputHora.addEventListener('input', function (e) {
		const hora = (e.target.value).split(':')[0];
		console.log(hora)
		if (hora < 10 || hora > 19){ 
			e.target.value = '';
			mostrarAlerta('Fuera de horario de apertura, de 10 a 19h','error')

		}
		else{
			cita.hora = e.target.value;
		}

	})
}

function mostrarAlerta(mensaje, tipo) {
	// revisa que no tengamo ya una alerta.
	if (document.querySelector(".alerta")) {
		return;
	}

	const alerta = document.createElement('DIV');
	alerta.textContent = mensaje;
	alerta.classList.add('alerta');
	alerta.classList.add(tipo);

	const formulario = document.querySelector('.formulario');
	formulario.appendChild(alerta);

	setTimeout(() => {
		alerta.remove();
	}, 2500);

}

