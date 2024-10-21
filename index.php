<link rel="stylesheet" type="text/css" href="styles/estilos.css">
<?php
require_once('models/album.php');
include_once("html/header.html");
include_once("html/footer.html");

echo "<div class='contenedor'><form action='" . $_SERVER['PHP_SELF'] . "' method='POST'>
<button name='ver' type='submit'>Consultar información de la base de datos</button>";
if (isset($_POST['ver'])) {
    echo "<h3>Albumes</h3>
   <table><tr><th></th><th>Album</th><th>Grupo</th><th>Genero</th><th>Año</th><th></th></tr>
    ";
    foreach (Album::getAlbum() as $album) {
        echo "<tr><td>" . $album['id_album'] . "</td><td>" . $album['album'] . "</td><td>" . $album['grupo'] . "</td><td>" . $album['genero'] . "</td><td>" . $album['anyo'] . "</td><td><button name=eliminar><img src='img/trash.svg'></button></td></tr>";
    }
    echo "</table><h3>Generos</h3>
<table><tr><th></th><th></th></tr>";
    foreach (Album::getGenres() as $genero) {
        echo "<tr><td>"
            . $genero['id_genero'] . "</td><td>"
            . $genero['genero'] . "</td></tr>";
    }
    echo "</table><h3>Grupos</h3>
<table><tr><th></th><th></th></tr>";
    foreach (Album::getGroups() as $grupo) {
        echo "<tr><td>"
            . $grupo['id_grupo'] . "</td><td>"
            . $grupo['grupo'] . "</td></tr>";
    }
    echo "</table><table>";
}
echo "</form></div>";
echo "<div class='contenedor'>
<form action='" . $_SERVER['PHP_SELF'] . "' method='GET'>
<input type='number' name='id_album' placeholder='id_album'>
<input type='submit' name='consulta' value='consultar canciones album'>";
if (isset($_GET['consulta']) && isset($_GET['id_album']) && !empty($_GET['id_album'])) {
    $response = file_get_contents("http://localhost/DAW_M07/api/api.php?id_album=" . $_GET['id_album']);
    $datos = json_decode($response, true);

    echo "<table id='songs'><tr><th></th><th>Album</th><th>Grupo</th><th>Genero</th><th>Año</th><th>Canciones del album</th></tr>";
    foreach ($datos as $album) {
        echo "<tr><td>"
            . $album['id_album'] . "</td><td>"
            . $album['album'] . "</td><td>"
            . $album['grupo'] . "</td><td>"
            . $album['genero'] . "</td><td>"
            . $album['anyo'] . "</td>
        <td>";
        $canciones = Album::getSongList($_GET['id_album']);
        if (!empty($canciones)) {
            echo "<ol>";
            foreach ($canciones as $song) {
                echo "<li>"
                    . $song['cancion'] . "</li>";
            }
            echo "</ol>";
        } else {
            echo "No hay canciones";
        }

        echo "</td></tr>";
    }
    echo "</table></form></div>";
} else if (isset($_GET['id_album']) && empty($_GET['id_album'])) {
    echo "<script>alert('No has seleccionado ningún album');</script>";
}
?>