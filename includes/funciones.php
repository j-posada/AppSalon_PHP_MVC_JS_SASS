<?php

function debuguear($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapa / Sanitizar el HTML
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

//funcion que revisa que el usuario esté autenticado

function isAuth() : void {
	if (!isset($_SESSION['login'])) {
		header('Location: /');
	}
}
function isAdmin() : void {
	if (!isset($_SESSION['admin'])) {
		header('Location: /');
	}
}

function moneyFormat($price,$curr) {
    $currencies['EUR'] = array(2, ',', '.');        // Euro
    $currencies['ESP'] = array(2, ',', '.');        // Euro
    $currencies['USD'] = array(2, '.', ',');        // US Dollar

    return number_format($price, ...$currencies[$curr]);
}