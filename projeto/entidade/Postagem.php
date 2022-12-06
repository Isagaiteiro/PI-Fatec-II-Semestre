<?php
require_once './data-base/Database.php';

class Postagem
{

    public $id;

    public $titulo;

    public $tema;

    public $url;

    public $conteudo;

    public $data;

    public $tipo;

    public $curtir;

    public $idUsuario;
   
    public function Cadastrar()
    {
        $db = new Database('postagem');
        return $db->insert([
            'titulo' => "'$this->titulo'",
            'tema' => "'$this->tema'",
            'url' => "'$this->url'",
            'conteudo' => "'$this->conteudo'",
            'postdate' => "'$this->data'",
            'tipo' => "'$this->tipo'",
            'curtir' => "'$this->curtir'",
            'id_usuario' => "'$this->idUsuario'",
        ]);
    }

    public function getPostagemByUser($idUser)
    {
        return (new Database('postagem'))->select("id_usuario = '$idUser'", 'postdate desc');
    }

    public function getPostagemById($idPost, $idUse)
    {
        return (new Database('postagem'))->select("idpostagem = '$idPost' AND id_usuario = $idUse");
    }

    public function getAll()
    {
        return (new Database('visao_geral'))->select(null,'postdate desc');
    }

    public function getByTemaTipo($tt, $t)
    {
        return (new Database('visao_geral'))->select("$tt LIKE '$t%'",'postdate desc');
    }

    public function Update()
    {
        return (new Database('postagem'))->update("idpostagem = $this->id", [
            'titulo' => "'$this->titulo'",
            'tema' => "'$this->tema'",
            'url' => "'$this->url'",
            'conteudo' => "'$this->conteudo'",
            'tipo' => "'$this->tipo'"
        ]);
    }
    public function Excluir($idP, $idU)
    {
        return (new Database('postagem'))->delete("idpostagem = '$idP' AND id_usuario = '$idU'");
    }
}
?>