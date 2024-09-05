<?php

function obtenerLibros() {
    $libros = [
        [
            'titulo' => '1984',
            'autor' => 'George Orwell',
            'anio_publicacion' => 1949,
            'genero' => 'Distopía',
            'descripcion' => 'Una novela sobre un futuro totalitario en el que el gobierno controla cada aspecto de la vida de sus ciudadanos.'
        ],
        [
            'titulo' => 'Matar a un ruiseñor',
            'autor' => 'Harper Lee',
            'anio_publicacion' => 1960,
            'genero' => 'Ficción',
            'descripcion' => 'La historia de una niña que vive en el sur de Estados Unidos durante la Gran Depresión y enfrenta temas de racismo e injusticia.'
        ],
        [
            'titulo' => 'Cien años de soledad',
            'autor' => 'Gabriel García Márquez',
            'anio_publicacion' => 1967,
            'genero' => 'Realismo mágico',
            'descripcion' => 'La saga de la familia Buendía en el ficticio pueblo de Macondo, explorando temas de amor, guerra y soledad.'
        ],
        [
            'titulo' => 'Orgullo y prejuicio',
            'autor' => 'Jane Austen',
            'anio_publicacion' => 1813,
            'genero' => 'Romántico',
            'descripcion' => 'Una novela sobre las complejidades del amor y el matrimonio en la Inglaterra del siglo XIX, centrada en la familia Bennet.'
        ],
        [
            'titulo' => 'El gran Gatsby',
            'autor' => 'F. Scott Fitzgerald',
            'anio_publicacion' => 1925,
            'genero' => 'Novela',
            'descripcion' => 'La historia de Jay Gatsby y su obsesión con la riqueza y el amor en el contexto del Jazz Age de Estados Unidos.'
        ],
        [
            'titulo' => 'Crimen y castigo',
            'autor' => 'Fiódor Dostoyevski',
            'anio_publicacion' => 1866,
            'genero' => 'Novela psicológica',
            'descripcion' => 'La historia de un joven estudiante que comete un asesinato y lucha con su conciencia y la moralidad de su acción.'
        ],
        [
            'titulo' => 'Los hermanos Karamazov',
            'autor' => 'Fiódor Dostoyevski',
            'anio_publicacion' => 1880,
            'genero' => 'Novela filosófica',
            'descripcion' => 'Un análisis profundo de la moralidad, la religión y la familia a través de la historia de los hermanos Karamazov.'
        ],
        [
            'titulo' => 'La sombra del viento',
            'autor' => 'Carlos Ruiz Zafón',
            'anio_publicacion' => 2001,
            'genero' => 'Novela',
            'descripcion' => 'Un joven descubre un libro en un misterioso cementerio de libros olvidados y se ve envuelto en una trama de intriga y secretos.'
        ],
        [
            'titulo' => 'El Hobbit',
            'autor' => 'J.R.R. Tolkien',
            'anio_publicacion' => 1937,
            'genero' => 'Fantasía',
            'descripcion' => 'La aventura de Bilbo Baggins en una épica búsqueda para recuperar un tesoro guardado por el dragón Smaug.'
        ],
        [
            'titulo' => 'El nombre de la rosa',
            'autor' => 'Umberto Eco',
            'anio_publicacion' => 1980,
            'genero' => 'Misterio histórico',
            'descripcion' => 'Una novela de misterio ambientada en una abadía medieval, donde un fraile investiga una serie de muertes inexplicables.'
        ]
    ];

    return $libros;
}


function mostrarDetallesLibros($libros) {
    $html = "";
    foreach ($libros as $libro) {
        $html .= "<div class='mos-libro'>";
        $html .= "<h3>" . htmlspecialchars($libro['titulo']) . "</h3>";
        $html .= "<p><strong>Autor:</strong> " . htmlspecialchars($libro['autor']) . "</p>";
        $html .= "<p><strong>Año de publicación:</strong> " . htmlspecialchars($libro['anio_publicacion']) . "</p>";
        $html .= "<p><strong>Género:</strong> " . htmlspecialchars($libro['genero']) . "</p>";
        $html .= "<p><strong>Descripción:</strong> " . htmlspecialchars($libro['descripcion']) . "</p>";
        $html .= "</div>";
    }

    return $html;
}



//mostrarDetallesLibros(obtenerLibros());
?>