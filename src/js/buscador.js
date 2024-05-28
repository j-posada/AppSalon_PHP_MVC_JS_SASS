document.addEventListener('DOMContentLoaded', function () {

	iniciarApp();
});

function iniciarApp() {
	buscarPorFecha();
}

function buscarPorFecha() {
	const fechaInput = document.querySelector('#fecha');
	fechaInput.addEventListener('change', function (e) {
		const fechaSeleccionada = e.target.value;
		console.log("digo");
		window.location = `?fecha=${fechaSeleccionada}`;

	})

}