<?php
require_once ('database/database.php');
class Album
{

    //Devuelve todos los albums
    public static function getAlbum()
    {
        $db = new Connection();
        $query = "SELECT a.*, g.genero, gr.grupo FROM album a INNER JOIN genero g ON a.genero = g.id_genero INNER JOIN grupo gr ON a.grupo = gr.id_grupo";
        $result = $db->query($query);
        if ($result->num_rows) {
            while ($row = $result->fetch_assoc()) { 
                $datos[] = [
                    'id_album' => $row['id_album'],
                    'album' => $row['album'],
                    'genero' => $row['genero'],
                    'grupo' => $row['grupo'],
                    'anyo' => $row['anyo']
                ];
            }
            return $datos;
        }
    }

    public static function getGenres(){
        $db = new Connection();
        $query = "SELECT * FROM genero";
        $result = $db->query($query);
        if ($result->num_rows) {
            while ($row = $result->fetch_assoc()) {
                $datos[] = [
                    'id_genero' => $row['id_genero'],
                    'genero' => $row['genero']
                ];
            }   
            return $datos;
        }
    }

    public static function getGroups(){
        $db = new Connection();
        $query = "SELECT * FROM grupo";
        $result = $db->query($query);
        if ($result->num_rows) {
            while ($row = $result->fetch_assoc()) {
                $datos[] = [
                    'id_grupo' => $row['id_grupo'],
                    'grupo' => $row['grupo']
                ];
            }   
            return $datos;
        }
    }

    //Devuelve la lista de canciones de un album
    public static function getAlbumSongs($id_album){
        $db = new Connection();
        $query = "SELECT * FROM canciones c WHERE album = $id_album";
        $result = $db->query($query);
        if ($result->num_rows) {
            while ($row = $result->fetch_assoc()) {
                $datos[] = [
                    'id_cancion' => $row['id_cancion'],
                    'cancion' => $row['cancion']
                ];
            }
            return $datos;
        }
    }

    //Devuelve la información de un album al buscar por nombre 
    public static function getAlbumId($id_album)
    {
        $db = new Connection();
        $query = "SELECT a.*, g.genero, gr.grupo, a.anyo FROM album a INNER JOIN genero g ON a.genero = g.id_genero INNER JOIN grupo gr ON a.grupo = gr.id_grupo WHERE id_album = $id_album";
        $result = $db->query($query);
        if ($result->num_rows) {
            while ($row = $result->fetch_assoc()) {
                $datos[] = [
                    'id_album' => $row['id_album'],
                    'album' => $row['album'],
                    'genero' => $row['genero'],
                    'grupo' => $row['grupo'],
                    'anyo' => $row['anyo']
                ];
            }
            return $datos;
        }
    }

    //Devuelve la lista de albums por año
    public static function getAlbumYear($anyo)
    {
        $db = new Connection();
        $query = "SELECT * FROM album WHERE anyo = $anyo";
        $result = $db->query($query);
        if ($result->num_rows) {
            while ($row = $result->fetch_assoc()) {
                $datos[] = [
                    'id_album' => $row['id_album'],
                    'nombre' => $row['album'],
                    'genero' => $row['genero'],
                    'grupo' => $row['grupo'],
                    'anyo' => $row['anyo']
                ];
            }
            return $datos;
        }
    }

    //Devuelve la lista de albums por genero
    public static function getAlbumGenre($genero)
    {
        $db = new Connection();
        $query = "SELECT a.*, g.genero, gr.grupo FROM album a INNER JOIN genero g ON a.genero = g.id_genero INNER JOIN grupo gr ON a.grupo = gr.id_grupo WHERE a.genero = $genero";
        $result = $db->query($query);
        if ($result->num_rows) {
            while ($row = $result->fetch_assoc()) {
                $datos[] = [
                    'id_album' => $row['id_album'],
                    'album' => $row['album'],
                    'genero' => $row['genero'],
                    'grupo' => $row['grupo'],
                    'anyo' => $row['anyo']
                ];
            }
            return $datos;
        }
    }

    //Devuelve la lista de albums de un grupo
    public static function getAlbumGroup($grupo)
    {
        $db = new Connection();
        $query = "SELECT a.*, g.genero, gr.grupo     FROM album a INNER JOIN grupo gr ON a.grupo = gr.id_grupo INNER JOIN genero g ON a.genero = g.id_genero WHERE a.grupo = $grupo";
        $result = $db->query($query);
        if ($result->num_rows) {
            while ($row = $result->fetch_assoc()) {
                $datos[] = [
                    'id_album' => $row['id_album'],
                    'album' => $row['album'],
                    'genero' => $row['genero'],
                    'grupo' => $row['grupo'],
                    'anyo' => $row['anyo']
                ];
            }
            return $datos;
        }
    }

    //Devuelve la lista de canciones de un album
    public static function getSongList($id_album)
    {
        $db = new Connection();
        $query = "SELECT * FROM canciones c WHERE album = $id_album";
        $result = $db->query($query);
        if ($result->num_rows) {
            while ($row = $result->fetch_assoc()) {
                $datos[] = [
                    'id_cancion' => $row['id_cancion'],
                    'cancion' => $row['cancion'],
                ];
            }
            return $datos;
        }
    }

    public static function insertAlbum($album, $genero, $grupo, $anyo)
    {
        $db = new Connection();
        $query = "INSERT INTO album (album, genero, grupo, anyo) VALUES ('" . $album . "', $genero, $grupo, $anyo)";
        $db->query($query);
        if ($db->affected_rows) {
            return true;
        } else {
            return false;
        }
    }

    public static function insertGroup($grupo)
    {
        $db = new Connection();
        $query = "INSERT INTO grupo (grupo) VALUES ('" . $grupo . "')";
        $db->query($query);
        if ($db->affected_rows) {
            return true;
        } else {
            return false;
        }
    }

    public static function insertGenre($genero)
    {
        $db = new Connection();
        $query = "INSERT INTO genero (genero) VALUES ('" . $genero . "')";
        $db->query($query);
        if ($db->affected_rows) {
            return true;
        } else {
            return false;
        }
    }

    public static function deleteAlbum($id_album)
    {
        $db = new Connection();
        $query = "DELETE FROM album WHERE album = $id_album";
        $db->query($query);
        if ($db->affected_rows) {
            return true;
        } else {
            return false;
        }
    }

    public static function updateAlbum($id_album, $album, $genero, $grupo, $anyo)
    {
        $db = new Connection();
        $query = "UPDATE album SET album = '".$album."', genero = $genero, grupo = $grupo, anyo = $anyo WHERE id_album = $id_album";
        $db->query($query);
        if ($db->affected_rows) {
            return true;
        } else {
            return false;
        }
    }

    public static function deleteSong($id_cancion)
    {
        $db = new Connection();
        $query = "DELETE FROM cancion WHERE id = $id_cancion";
        $db->query($query);
        if ($db->affected_rows) {
            return true;
        } else {
            return false;
        }
    }

    public static function updateSong($id_cancion, $cancion)
    {
        $db = new Connection();
        $query = "UPDATE cancion SET cancion = '$cancion' WHERE id = $id_cancion";
        $db->query($query);
        if ($db->affected_rows) {
            return true;
        } else {
            return false;
        }
    }
}
