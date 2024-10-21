<?php
require_once ('models/album.php');

header('Content-Type: application/json');
switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        if (isset($_GET['id_album'])) {
            echo json_encode(Album::getAlbumId($_GET['id_album']));
        }
        else if(isset($_GET['genero'])){
            echo json_encode(Album::getAlbumGenre($_GET['genero']));
        }
        else if(isset($_GET['anyo'])){
            echo json_encode(Album::getAlbumYear($_GET['anyo']));
        }
        else if(isset($_GET['grupo'])){
            echo json_encode(Album::getAlbumGroup($_GET['grupo']));
        }   
        break;

    case 'POST':
        $data=json_decode(file_get_contents('php://input'));
        if ($data!=null) {
            if(isset($data->album)&&isset($data->genero)&&isset($data->grupo)&&isset($data->anyo)){
                if(Album::insertAlbum($data->album, $data->genero, $data->grupo, $data->anyo)){
                    http_response_code(200);
                    echo 'ALBUM CREADO';
                }
                else{
                    http_response_code(405);
                }
            }
            else if (isset ($data->genero)) {
                if (Album::insertGenre($data->genero)) {
                    http_response_code(200);
                    echo 'GENERO CREADO';
                }
                else {
                    http_response_code(405);
                }
            }
            else if (isset ($data->grupo)) {
                if (Album::insertGroup($data->grupo)) {
                    http_response_code(200);
                    echo 'GRUPO CREADO';
                }
                else {
                    http_response_code(405);
                }
            }
        }
        else{
            http_response_code(400);
            echo 'BAD REQUEST';
        }
        break;
        case 'PUT':
            $data=json_decode(file_get_contents('php://input'));
            if ($data!=null) {
                if(isset($data->id_album)&&isset($data->album)&&isset($data->genero)&&isset($data->grupo)&&isset($data->anyo)){
                    if(Album::updateAlbum($data->id_album,$data->album, $data->genero, $data->grupo, $data->anyo)){
                        http_response_code(200);
                        echo 'ALBUM ACTUALIZADO';
                    }
                    else{
                        http_response_code(405);
                    }
                }
                else if (isset ($data->id_cancion) && isset ($data->cancion)) {
                    if (Album::updateSong($data->id_cancion, $data->cancion)) {
                        http_response_code(200);
                        echo 'TÍTULO CANCION CAMBIADO';
                    }
                    else {
                        http_response_code(405);
                    }
                }
            }
            else{
                http_response_code(400);
                echo 'BAD REQUEST';
            }
            break;

    case 'DELETE':
       if (isset($_GET['id_album'])) {
            if (Album::deleteAlbum($_GET['id_album'])) {
                http_response_code(200);
                echo 'ALBUM ELIMINADO';
            }
            else {
                http_response_code(405);
            }
        }
        else if (isset($_GET['id_cancion'])) {
            if (Album::deleteSong($_GET['id_cancion'])) {
                http_response_code(200);
                echo 'TÍTULO CANCION ELIMINADO';
            }
            else {
                http_response_code(405);
            }
        }
        break;
    default:
        echo 'METODO NO SOPORTADO';
        break;
}
?>