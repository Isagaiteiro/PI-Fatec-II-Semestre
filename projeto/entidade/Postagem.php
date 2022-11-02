<?php
require_once './data-base/Database.php';

class Postagem{

    public $id;

    public $tema;

    public $url;

    public $conteudo;

    public $data;

    public $idTipo;

    public $idUsuario;

    public function Cadastrar() {
        $db = new Database('usuario');
        return $db->insert([
                            'tema'=> "'$this->tema'",
                            'url'=> "'$this->url'",
                            'conteudo'=> "'$this->conteudo'",
                            'postdate'  => "'$this->data'",
                            'id_tipo'  => "'$this->idTipo'",
                            'id_usuario'  => "'$this->idUsuario'",
                        ]);
    }
        
    public function getPostagemByUser($idUser){
        return (new Database('postagem'))->select("id_usuario = '$idUser'");
    }

    public function getAll(){
        return (new Database('postagem'))->select();
    }
}
?>