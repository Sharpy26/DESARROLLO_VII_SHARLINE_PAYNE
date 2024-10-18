<?php
function sanitizarNombre($nombre) {
    return htmlspecialchars(trim($nombre), ENT_QUOTES, 'UTF-8');
}

function sanitizarEmail($email) {
    return filter_var(trim($email), FILTER_SANITIZE_EMAIL);
}

function sanitizarEdad($edad) {
    return filter_var($edad, FILTER_SANITIZE_NUMBER_INT);
}

function sanitizarSitioWeb($sitioWeb) {
    return filter_var(trim($sitioWeb), FILTER_SANITIZE_URL);
}

function sanitizarGenero($genero) {
    return htmlspecialchars(trim($genero), ENT_QUOTES, 'UTF-8');
}

function sanitizarIntereses($intereses) {
    return array_map(function($interes) {
        return htmlspecialchars(trim($interes), ENT_QUOTES, 'UTF-8');
    }, $intereses);
}

function sanitizarComentarios($comentarios) {
    return htmlspecialchars(trim($comentarios), ENT_QUOTES, 'UTF-8');
}

function sanitizarFechaNacimiento($fechaNacimiento) {
    return htmlspecialchars(trim($fechaNacimiento), ENT_QUOTES, 'UTF-8');
}
?>