let paso = 1;

const cita = {
	id: '',
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

	idCliente();
	nombreCliente();

	seleccionarFecha();
	seleccionarHora();

	mostrarResumen();
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

	if (document.querySelector('.btreservar')) {
		document.querySelector('.btreservar').remove();
	}

	if (paso === 1) {
		paginaAnterior.classList.add('ocultar');
		paginaSiguinete.classList.remove('ocultar');


	} else if (paso === 3) {
		paginaAnterior.classList.remove('ocultar');
		paginaSiguinete.classList.add('ocultar');
		mostrarResumen();
	}
	else {
		paginaAnterior.classList.remove('ocultar');
		paginaSiguinete.classList.remove('ocultar');

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
function idCliente() {
	cita.id = document.querySelector('#id').value;
}

function seleccionarFecha() {
	const inputFecha = document.querySelector('#fecha');
	inputFecha.addEventListener('input', function (e) {
		const dia = new Date(e.target.value).getUTCDay();

		if ([6, 0].includes(dia)) {
			e.target.value = '';
			mostrarAlerta('Fines de semana no permitidos', 'error', '.formulario');
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

		if (hora < 10 || hora > 19) {
			e.target.value = '';
			mostrarAlerta('Fuera de horario de apertura, de 10 a 19h', 'error', '.formulario')

		}
		else {
			cita.hora = e.target.value;
		}

	})
}

function mostrarResumen() {
	const resumen = document.querySelector(".datos-resumen");

	if (document.querySelector(".alerta")) {
		(document.querySelector(".alerta")).remove();
	}

	if (document.querySelector(".datos-resumen")) {
		(document.querySelector(".datos-resumen")).innerHTML = null;
	}

	if (Object.values(cita).includes("") || (cita.servicios.length === 0)) {
		mostrarAlerta('Elige al menos un servicio y la fecha y la hora', 'error', '.datos-resumen', false);
		return;
	}

	const { nombre, fecha, hora, servicios } = cita;

	//
	const headinSeccionServicios = document.createElement('H3');
	headinSeccionServicios.innerHTML = ("Servicios Asociados");
	resumen.appendChild(headinSeccionServicios);
	servicios.forEach(servicio => {
		const { id, nombre, precio } = servicio;
		const contenedorServicio = document.createElement('DIV');
		contenedorServicio.classList.add("contenedor-servicio");

		const textServicio = document.createElement('P');
		textServicio.textContent = nombre;

		const precioServicio = document.createElement('P');
		precioServicio.innerHTML = `<span>Precio: </span> ${precio}`;

		contenedorServicio.appendChild(textServicio);
		contenedorServicio.appendChild(precioServicio);

		resumen.appendChild(contenedorServicio);
	})

	const headinSeccionDatosCita = document.createElement('H3');
	headinSeccionDatosCita.innerHTML = ("Datos Cita");
	resumen.appendChild(headinSeccionDatosCita);

	const nombreCliente = document.createElement('P');
	nombreCliente.innerHTML = `<span>Nombre: </span>  ${nombre}`;


	const opciones = { weekday: "long", year: "numeric", month: "long", day: "numeric" };
	const fechaFormateada = new Date(fecha.replaceAll("-", "/")).toLocaleDateString("es-ES", opciones);

	const fechaCita = document.createElement('P');
	fechaCita.innerHTML = `<span>Fecha: </span>  ${fechaFormateada}`;

	const horaCita = document.createElement('P');
	horaCita.innerHTML = `<span>Hora: </span>  ${hora}`;

	//Añadir Botón Reservar
	const bt_reservar = document.createElement('BUTTON');
	bt_reservar.classList.add('boton', 'btreservar');
	bt_reservar.textContent = 'Reservar cita'
	bt_reservar.onclick = function () {
		crearCita();
	}
	document.querySelector('.paginacion').appendChild(bt_reservar)

	resumen.appendChild(nombreCliente);
	resumen.appendChild(fechaCita);
	resumen.appendChild(horaCita);
}

function mostrarAlerta(mensaje, tipo, elemento, autolimpiar = true) {
	// revisa que no tengamo ya una alerta.
	if (document.querySelector(".alerta")) {
		(document.querySelector(".alerta")).remove();
	}

	const alerta = document.createElement('DIV');
	alerta.textContent = mensaje;
	alerta.classList.add('alerta');
	alerta.classList.add(tipo);

	const referencia = document.querySelector(elemento);
	referencia.appendChild(alerta);

	if (autolimpiar) {
		setTimeout(() => {
			alerta.remove();
		}, 2500);
	}
}

async function crearCita() {

	const { id, nombre, fecha, hora, servicios } = cita;

	const idServicios = servicios.map(servicio => servicio.id)
	const datos = new FormData();

	datos.append('usuarioId', id)
	datos.append('fecha', fecha);
	datos.append('hora', hora);
	datos.append('servicios', idServicios);
	//petición hacia la api
	const url = 'http://localhost:3000/api/citas';

	const respuesta = await fetch(url, {
		method: 'POST',
		body: datos
	});

	console.log(await respuesta.json());
	//console.log([...datos]);
}