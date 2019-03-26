<?php

/* 
 * Verifica o usuário e senha
 * Esquema da tabela que deverá ser criada em todos os banco de dados.
 * 
 * CREATE TABLE `login` (
 `idLogin` int(11) NOT NULL AUTO_INCREMENT,
 `usuario` varchar(50) NOT NULL,
 `senha` varchar(100) NOT NULL,
 `tipousuario` enum('Comum','Gerente','Administrador') NOT NULL,
 `habilitado` bit(1) NOT NULL,
 `tentativa` tinyint(4) NOT NULL,
 `dtCriado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
 PRIMARY KEY (`idLogin`),
 UNIQUE KEY `usuario` (`usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1
 */


/**
 * Criado: 30/10/2018
 * Modificado: 
 */
/**
 * Recebe todas as requisições referentes ao login.
 * @Autor 04953988612
 */

error_reporting(0);
if(@!include_once "../Config/Configuracao.php"){ //Include que contém configurações padrões do sistema.
    $ResultRequest["Modo"]        = "Include";
    $ResultRequest["Error"]       = true;
    $ResultRequest["Codigo"]      = 3588;
    $ResultRequest["Mensagem"]    = "O arquivo de configuração não foi encontrado. Controller";
    
    echo json_encode($ResultRequest);
    exit;
}; 

/**
 * Inclui o arquivo que contém as classes com o nome das tabelas do banco de dados AcessoBancoDados::get_BaseDados()
 */
if(!@include_once ConfigSystema::get_Path_Systema() . '/BancoDados/TabelasBD/'. AcessoBancoDados::get_BaseDados() .'.php'){
    $ResultRequest["Modo"]        = "Include";
    $ResultRequest["Error"]       = true;
    $ResultRequest["Codigo"]      = 3589;
    $ResultRequest["Mensagem"]    = "A configuração do banco de dados não foi encontrado. Controller";
    
    echo json_encode($ResultRequest); 
    exit;
}

/**
 * Armazena o tempo inicial do processamento.
 */
ConfigSystema::getStartTimeTotal();

$URL            = $_REQUEST["URL"];
$Requisicao     = $_REQUEST["Req"];
$Metodo         = $_REQUEST["Metodo"];
$SSL            = $_REQUEST["SSL"];
$Usuario        = $_POST["sendUsuario"];
$Senha          = md5($_POST["sendSenha"]);

try {
    $SelecionarDados = new login();

    $SelecionarDados->setUsuario("alexandre");
    $FiltroCampos = [
                        [
                            [
                                0=>0,
                                1=>"=",
                                2=>$Usuario
                            ],
                            [
                                0=>1,
                                1=>"=",
                                2=>$Senha,
                                3=> 1
                            ]
                        ]
                    ];
    $SelecionarDados->setFiltros($FiltroCampos);
    $SelecionarDados->Select();
    $Saida = $SelecionarDados->getArrayDados()[0];
    
    if($Saida[3] != 1){
        throw new Exception("O usuário não existe ou não está habilitado no sistema. Favor entrar em contato com o administrador.", 3592);
        exit;
    }
    
    if(count($Saida) == 0){
        throw new Exception("Usuário e senha inválidos.", 3590);
    }
    
    $SDados["Active"]   = true;
    $SDados["Username"] = $Usuario;
    $SDados["Password"] = $Senha;
    $SDados["Tusuario"] = $Saida[2];
    $SDados["Tempo"]    = time();
    $SDados["ID"]       = md5($Saida[0]);

    session_save_path( __DIR__ . "/../Account/Sessoes");

    session_id($SDados["ID"]);
    $AbrirSessao = session_start();
    /**
     * Verifica se já existe uma mesma sessão aberta. Caso exista o sistema apaga os dados anteriores;
     */
    $Ativo = $_SESSION[$SDados["ID"]]["Active"];
    if($Ativo){
        $_SESSION[$SDados["ID"]] = [];
    }
    
    $_SESSION[$SDados["ID"]] = json_encode($SDados);
    $Chave = base64_encode(json_encode($SDados));
    
 switch ($Saida[2]) {
     case "Gerente":
         $ResultRequest["Error"] = false;
         $ResultRequest["Modo"] = "S";
         $ResultRequest["Chave"] = $Chave;
         $ResultRequest["TipoUsuario"] = "Gerente";
         $ResultRequest["Tentativas"] = $SDados["tentativa"];
         $ResultRequest["Header"] = ConfigSystema::getHttp_Systema(). $Saida[2] ."?s=" . $Chave;
         echo json_encode($ResultRequest);
         break;

     default:
         session_destroy();
        throw new Exception("Esse usuário foi autenticado, mas não possui nenhum perfil de acesso. Favor entrar em contato com o administrador.", 3591);
         break;
 }


} catch (Exception $ex) {
    $ResultRequest["Modo"]      = "L";
    $ResultRequest["Error"]     = true;
    $ResultRequest["Codigo"]    = $ex->getCode();
    $ResultRequest["Mensagem"]  = $ex->getMessage();
    $ResultRequest["Tracer"]    = $ex->getTraceAsString();
    $ResultRequest["File"]      = $ex->getFile();

    echo json_encode($ResultRequest);
} 

