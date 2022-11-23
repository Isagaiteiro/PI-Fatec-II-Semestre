<?php
require_once './data-base/Database.php';

class Usuario
{

    public $id;

    public $nome;

    public $email;

    public $foto;

    public $senha;

    public function Cadastrar()
    {
        $db = new Database('usuario');
        return $db->insert([
            'nome' => "'$this->nome'",
            'email' => "'$this->email'",
            'foto' => "'$this->foto'",
            'senha' => "'$this->senha'"
        ]);
    }

    public function getUsuario($email)
    {
        return (new Database('usuario'))->select("email = '$email'");
    }

    public function Update()
    {
        return (new Database('usuario'))->update("id = $this->id", [
            'nome' => "'$this->nome'",
            'email' => "'$this->email'",
            'foto' => "'$this->foto'",
            'senha' => "'$this->senha'"
        ]);
    }

    public function Excluir()
    {
        return (new Database('usuario'))->delete('id = ' . $this->id);
    }
}
?>