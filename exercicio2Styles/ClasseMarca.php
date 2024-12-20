<?php

class ClasseMarca
{
    /* Atributos */
    private $idMarca; // Armazena o ID do marca
    private $nome;     // Armazena o nome do marca
    private $produtos;  // Armazena as produtos associadas ao marca

    /* Getters */
    // Método que retorna o ID do marca
    public function getidMarca()
    {
        return $this->idMarca;
    }

    // Método que retorna o nome do marca
    public function getNome()
    {
        return $this->nome;
    }


    // Método que retorna as produtos associadas ao marca
    public function getprodutos()
    {
        return $this->produtos;
    }

    /* Setters */
    // Método que define o valor do ID do marca
    public function setidMarca($idMarca)
    {
        $this->idMarca = $idMarca;
    }

    // Método que define o valor do nome do marca
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

     // Método que define as produtos associadas ao marca
    public function setprodutos($produtos)
    {
        $this->produtos = $produtos;
    }

    /* Método Construtor */
    // Método construtor que pode ser utilizado para inicializar o objeto (neste caso, está vazio)
    public function __construct() {}

    /* 
    Implementar os métodos do CRUD
    C - CREATE - Insert - inserirMarca
    R - READ - Select 
    U - UPDATE - alterarMarca
    D - DELETE - excluirMarca
    */

    /* Método inserirMarca */
    public function inserirMarca($nome)
    {
        // Requer o arquivo de conexão com o banco de dados
        require("conexaobd.php");

        // Comando SQL para chamar a função armazenada "inserirMarca" no banco de dados
        $comando = "SELECT inserirMarca(:nome) AS Resultado;";

        // Prepara a consulta SQL
        $stmt  = $pdo->prepare($comando);

        // Vincula os parâmetros "" e "nome" com os valores recebidos como argumento
        $stmt->bindParam(":nome", $nome);

        // Executa a consulta
        $stmt->execute();

        // Inicializa a variável $resultado como null
        $resultado = null;

        // Itera sobre o resultado da consulta, obtendo o valor retornado pela função armazenada
        foreach ($stmt as $linha) {
            $resultado =  $linha["Resultado"];
        }

        // Retorna o resultado da função armazenada
        return $resultado;
    }

    /* Método alterarMarca */
    public function alterarMarca($idMarca, $nome)
    {
        // Requer o arquivo de conexão com o banco de dados
        require("conexaobd.php");

        // Comando SQL para chamar a função armazenada "alterarMarca" no banco de dados
        $comando = "SELECT alterarMarca(:idMarca,:nome) AS Resultado;";

        // Prepara a consulta SQL
        $stmt = $pdo->prepare($comando);

        // Vincula os parâmetros "idMarca", "" e "nome" com os valores recebidos como argumento
        $stmt->bindParam(":idMarca", $idMarca);
        $stmt->bindParam(":nome", $nome);

        // Executa a consulta
        $stmt->execute();

        // Inicializa a variável $resultado como null
        $resultado = null;

        // Itera sobre o resultado da consulta, obtendo o valor retornado pela função armazenada
        foreach ($stmt as $linha) {
            $resultado =  $linha["Resultado"];
        }

        // Retorna o resultado da função armazenada
        return $resultado;
    }

    /* Método excluirMarca */
    public function excluirMarca($idMarca)
    {
        // Requer o arquivo de conexão com o banco de dados
        require("conexaobd.php");

        // Comando SQL para chamar a função armazenada "excluirMarca" no banco de dados
        $comando = "SELECT excluirMarca(:idMarca) AS Resultado;";

        // Prepara a consulta SQL
        $stmt = $pdo->prepare($comando);

        // Vincula o parâmetro "idMarca" com o valor recebido como argumento
        $stmt->bindParam(":idMarca", $idMarca);

        // Executa a consulta
        $stmt->execute();

        // Inicializa a variável $resultado como null
        $resultado = null;

        // Itera sobre o resultado da consulta, obtendo o valor retornado pela função armazenada
        foreach ($stmt as $linha) {
            $resultado =  $linha["Resultado"];
        }

        // Retorna o resultado da função armazenada
        return $resultado;
    }

    /* Método consultarMarca */
    public function consultarMarca($idMarca)
    {
        // Requer o arquivo de conexão com o banco de dados
        require("conexaobd.php");
        // Variável $consulta o select a ser executado
        $consulta="SELECT * FROM viewMarcas WHERE idMarca=:idMarca";
        // Preparar para executar a consulta
        $stmt = $pdo->prepare($consulta);
        // Definir o parâmetro
        $stmt->bindParam(":idMarca",$idMarca);
        // Executar o comando
        $stmt->execute();
        foreach($stmt as $linha){
            $this->idMarca = $linha["IDMARCA"];
            $this->nome = $linha["NOME"];
			$this->produtos = $linha["PRODUTOS"];
        }
    }

    /* Método listarMarcas */
    public function listarMarcas()
    {
        // Requer o arquivo de conexão com o banco de dados
        require("conexaobd.php");
        // Variável $consulta o select a ser executado
        $consulta="SELECT * FROM viewMarcas";
        // Preparar para executar a consulta
        $stmt = $pdo->prepare($consulta);
        // Executar o comando
        $stmt->execute();
        // Retornar o resultado da consulta
        return $stmt;
    }
}
