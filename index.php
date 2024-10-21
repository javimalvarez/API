<link rel="stylesheet" type="text/css" href="styles/estilos.css">
<?php
require_once('models/album.php');
include_once("html/header.html");
include_once("html/footer.html");

$date=date("Y-m-d H:i:s");

echo "<div class='contenedor'><form action='" . $_SERVER['PHP_SELF'] . "' method='POST'><br/>
<button id='ver' name='ver' type='submit'>Consultar base de datos</button></form>";
echo "<div class='contenedor'>
<form id='formulario-consulta' action='" . $_SERVER['PHP_SELF'] . "' method='GET'>
<div class='contenedor' style='border: 2px solid black; border-radius: 10px; padding: 5px'><label>Consulta aquí las canciones de un albúm</label>
<fielset><input type='number' name='id_album' placeholder='id_album'>
<input type='submit' name='consulta' value='consultar'></fielset></form></div>";
if (isset($_POST['ver'])) {
    echo"<span style='text-align: center;'>Esta es la información que consta en la base de datos<br/> fecha: $date</span>";
    echo "<div class='contenedor'><form action='" . $_SERVER['PHP_SELF'] . "' method='POST'><br/><h3 style='text-align: center'>Albumes</h3>
    <span>(puedes borrar cualquier albúm pulsando en el icono de la papelera)</span><br/><br/>
   <table><tr><th></th><th>Album</th><th>Grupo</th><th>Genero</th><th>Año</th><th></th></tr>";
    foreach (Album::getAlbum() as $album) {
        echo "<tr><td>" . $album['id_album'] . "</td><td>" . $album['album'] . "</td><td>" . $album['grupo'] . "</td><td>" . $album['genero'] . "</td><td>" . $album['anyo'] . "</td><td><button style='border: none; background-color: transparent;' name=eliminar><img src='img/trash.svg'></button></td></tr>";
    }
    echo "</table><h3 style='text-align: center'>Generos</h3>
<table>";
#Se encarga de eliminar el botón de ver la base de datos
    echo"<script>document.getElementById('ver').remove();document.getElementById('formulario-consulta').remove();</script>";
    foreach (Album::getGenres() as $genero) {
        echo "<tr><td>"
            . $genero['id_genero'] . "</td><td>"
            . $genero['genero'] . "</td></tr>";
    }
    echo "</table><h3 style='text-align: center'>Grupos</h3>
<table>";
    foreach (Album::getGroups() as $grupo) {
        echo "<tr><td>"
            . $grupo['id_grupo'] . "</td><td>"
            . $grupo['grupo'] . "</td></tr>";
    }
    echo "</table><table>";
}
echo "</form></div>";


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
            echo"<script>window.alert('Mostrando canciones del album ".$album['album']." de ".$album['grupo']."')</script>";
            echo "<ol>";
            foreach ($canciones as $song) {
                echo "<li>"
                    . $song['cancion'] . "</li>";
            }
            echo "</ol>";
        } else {
            echo"<script>window.alert('Mostrando canciones del album ".$album['album']." de ".$album['grupo']."')</script>";
            echo "No hay canciones";
        }

        echo "</td></tr>";
    }
    echo "</table></div>";
    echo"<script>document.getElementById('formulario-consulta').remove();document.getElementById('ver').remove();</script>";
} else if (isset($_GET['id_album']) && empty($_GET['id_album'])) {
    echo "<script>alert('No has seleccionado ningún album');</script>";
}
?>

