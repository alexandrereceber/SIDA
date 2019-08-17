<?php
/**
 * @author Alexandre José da Silva Marques
 * @Criado: 12/01/2019
 * @filesource
 * 
 */

/**
 * ESQUEMA DAS TABELAS PARA USO DESSA FUNCIONALIDADE
 * CRIADO: 17/08/2019
 * MODIFICADO:

 * ESQUEMA 0 - PAGINAWEB - Modificação
 * 
 * CREATE TABLE `paginaweb` (
 `idPWEB` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Chave Primária',
 `URLPagina` varchar(200) NOT NULL COMMENT 'Nome de identificação da pagina WEB',
 `CodigoHTML` longtext NOT NULL COMMENT 'Código HTML da página',
 `Status` tinyint(1) NOT NULL,
 `dtCriado` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
 `dtModificado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
 PRIMARY KEY (`idPWEB`),
 KEY `URLPagina` (`URLPagina`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8
 */

/**
 * ESQUEMA DAS TABELAS PARA USO DESSA FUNCIONALIDADE
 * CRIADO: 14/01/2019
 * MODIFICADO:

 * ESQUEMA 1 - PAGINAWEB
 *
 * CREATE TABLE `paginaweb` (
 `idPWEB` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Chave Primária',
 `URLPagina` varchar(200) NOT NULL COMMENT 'Nome de identificação da pagina WEB',
 `PWTitulo` varchar(100) NOT NULL COMMENT 'Título da página WEB',
 `PWStyle` text NOT NULL COMMENT 'Style da página',
 `PWScript` text NOT NULL COMMENT 'Scripts que serão executados na página',
 `PWIMG` varchar(200) NOT NULL COMMENT 'Imagem que será apresentada na guia da página',
 `PWBMS` text NOT NULL COMMENT 'Linguagem de marcação responsável pela barra de menu superior',
 `PWBLE` text NOT NULL COMMENT 'Linguagem de marcação responsável pela barra lateral esquerda',
 `PWBLD` text NOT NULL COMMENT 'Linguagem de marcação responsável pela barra lateral direita',
 `PWBST` text NOT NULL COMMENT 'Linguagem de marcação responsável pela barra de status',
 `PWCNT` text NOT NULL COMMENT 'Linguagem de marcação responsável pela barra de conteúdo central',
 `Status` enum('Ativar','Desativar') NOT NULL,
 `dtCriado` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
 `dtModificado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
 PRIMARY KEY (`idPWEB`),
 KEY `URLPagina` (`URLPagina`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8


 * ESQUEMA DAS TABELAS PARA USO DESSA FUNCIONALIDADE
 * CRIADO: 14/01/2019
 * MODIFICADO:

 * 
 *  
 * ESQUEMA 2 - pwcabecalhopadrao

 *CREATE TABLE `pwcabecalhopadrao` (
 `idTPD` int(11) NOT NULL AUTO_INCREMENT,
 `chExtPWEB` int(11) NOT NULL,
 `TPD` text NOT NULL,
 `dtCriado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
 `dtModificado` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
 PRIMARY KEY (`idTPD`),
 KEY `chExtPWEB` (`chExtPWEB`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8


 * ESQUEMA DAS TABELAS PARA USO DESSA FUNCIONALIDADE
 * CRIADO: 14/01/2019
 * MODIFICADO:


 * ESQUEMA - 3 - pwebdiv

 *CREATE TABLE `pwebdiv` (
 `idPWEBDIV` int(11) NOT NULL AUTO_INCREMENT,
 `chExtPWEB` int(11) NOT NULL,
 `BTY` enum('Sim','Não') NOT NULL DEFAULT 'Sim' COMMENT 'Barra de Style da página',
 `BSC` enum('Sim','Não') NOT NULL DEFAULT 'Sim' COMMENT 'Scripts',
 `BMS` enum('Sim','Não') NOT NULL DEFAULT 'Sim' COMMENT 'Barra de Menu Superior',
 `BLE` enum('Sim','Não') NOT NULL DEFAULT 'Sim' COMMENT 'Barra Lateral Esquerda',
 `BLD` enum('Sim','Não') NOT NULL DEFAULT 'Sim' COMMENT 'Barra Lateral Direita',
 `BST` enum('Sim','Não') NOT NULL DEFAULT 'Sim' COMMENT 'Barra de Status',
 `BCT` enum('Sim','Não') NOT NULL DEFAULT 'Sim' COMMENT 'Barra de conteúdo central',
 `dtCriado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
 `dtModificado` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
 PRIMARY KEY (`idPWEBDIV`),
 KEY `chExtPWEB` (`chExtPWEB`),
 CONSTRAINT `chvPWEBDIV` FOREIGN KEY (`chExtPWEB`) REFERENCES `paginaweb` (`idPWEB`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8


 * ESQUEMA DAS TABELAS PARA USO DESSA FUNCIONALIDADE
 * CRIADO: 14/01/2019
 * MODIFICADO:


 *CREATE TABLE `pwebpriv` (
 `idPWBPRIV` int(11) NOT NULL AUTO_INCREMENT,
 `chExtPWEB` int(11) NOT NULL,
 `chExtUser` int(11) NOT NULL,
 `Privilegio` enum('Visualizar','Editar') NOT NULL,
 `dtCriado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
 `dtModificado` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
 PRIMARY KEY (`idPWBPRIV`),
 KEY `chExtUser` (`chExtUser`),
 KEY `chExtPWEB` (`chExtPWEB`),
 CONSTRAINT `chvPWEBLogin` FOREIGN KEY (`chExtUser`) REFERENCES `login` (`idLogin`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8

 */

if(@!include_once __DIR__ . "/../../Config/Configuracao.php"){ //Include que contém configurações padrões do sistema.
    $ResultRequest["Modo"]        = "Include";
    $ResultRequest["Error"]    = true;
    $ResultRequest["Codigo"]   = 10000;
    $ResultRequest["Mensagem"] = "O arquivo de Configuração não foi encontrado. ";
    
    echo json_encode($ResultRequest);
    exit;
}; 
/**
 * Inclui o arquivo que contém as classes com o nome das tabelas do banco de dados AcessoBancoDados::get_BaseDados()
 */
if(!@include_once ConfigSystema::get_Path_Systema() . '/BancoDados/TabelasBD/'. AcessoBancoDados::get_BaseDados() .'.php'){
    $ResultRequest["Modo"]        = "Include";
    $ResultRequest["Error"]    = true;
    $ResultRequest["Codigo"]   = 10001;
    $ResultRequest["Mensagem"] = "A configuração do banco de dados não foi encontrado. ";
    
    echo json_encode($ResultRequest); 
    exit;
}
error_reporting(0);

try{
   
    ConfigSystema::getStartTimeTotal();
    $URL            = $_REQUEST["URL"];
    $Requisicao     = $_REQUEST["Req"];
    $Metodo         = $_REQUEST["Metodo"];
    $SSL            = $_REQUEST["SSL"];
    $Formato        = $_REQUEST["sendRetorno"]  == "" ? "JSON" : $_REQUEST["sendRetorno"]; //Atribui um formato padrão

    $Operacao       = OperacaoTable::getMD5ForOperacao($_REQUEST["sendModoOperacao"]);
    
    $PaginaWEB = $_REQUEST["PWEB"];
    
    if($PaginaWEB["Tipo"] == "GET"){
        $Saida = explode('/', $Requisicao);
        $Total = count($Saida) - 1;
        /**
         * Verifica se a busca é por texto ou númerica.
         * Campo = 0 - ID da página
         * Campo = 1 - É o título da página.
         */
        $Campo = is_numeric($Saida[$Total]) ==true  ? 0 : 1;
        $Saida = $Saida[$Total];
        
    }else if($PaginaWEB["Tipo"] == "POST"){
        $Campo = 1;
        $Saida = $PaginaWEB["CarregarPagina"];
    }else{

    }
    
    //-------------------Página WEb-------------------------------
    $FiltroPW[0] = false;
    $FiltroPW[1][0][0] = $Campo;
    $FiltroPW[1][0][1] = "=";
    $FiltroPW[1][0][2] = $Saida;
    $FiltroPW[1][0][3] = 2;
    
    $CarregarPagina = new paginaweb();
    $CarregarPagina->StartClock();
    $CarregarPagina->setUsuario("Alexandre");
    $CarregarPagina->setFiltros($FiltroPW);
    $CarregarPagina->Select();
    $CarregarPagina->EndClock();
    $ResultRequest["paginaweb"] = $CarregarPagina->getArrayDados();
    $idPWEB = $ResultRequest["paginaweb"][0][0];

    //-------------------Visualização dos segmentos da página-------------------------------
    
    $FiltroPWEBDIV[0] = false;
    $FiltroPWEBDIV[1][0][0] = 1;
    $FiltroPWEBDIV[1][0][1] = "=";
    $FiltroPWEBDIV[1][0][2] = $idPWEB;
    $FiltroPWEBDIV[1][0][3] = 2;

    $CarregarPagina = new pwebdiv();
    $CarregarPagina->StartClock();
    $CarregarPagina->setUsuario("Alexandre");
    $CarregarPagina->setFiltros($FiltroPWEBDIV);
    $CarregarPagina->Select();
    $CarregarPagina->EndClock();
    $ResultRequest["pwebdiv"] = $CarregarPagina->getArrayDados();

    //-------------------Visualização do cabeçalho padrão-------------------------------

    $FiltroPWEBCP[0] = false;
    $FiltroPWEBCP[1][0][0] = 1;
    $FiltroPWEBCP[1][0][1] = "=";
    $FiltroPWEBCP[1][0][2] = $idPWEB;
    $FiltroPWEBCP[1][0][3] = 2;

    $CarregarPagina = new pwcabecalhopadrao();
    $CarregarPagina->StartClock();
    $CarregarPagina->setUsuario("Alexandre");
    $CarregarPagina->setFiltros($FiltroPWEBCP);
    $CarregarPagina->Select();
    $CarregarPagina->EndClock();
    $ResultRequest["pwcabecalhopadrao"] = $CarregarPagina->getArrayDados();

    //-------------------Verifica se o usuário tem privilégio de visualização-------------------------------

    $FiltroPWEBPRIV[0] = false;
    $FiltroPWEBPRIV[1][0][0] = 1;
    $FiltroPWEBPRIV[1][0][1] = "=";
    $FiltroPWEBPRIV[1][0][2] = $idPWEB;
    $FiltroPWEBPRIV[1][0][3] = 2;

    $CarregarPagina = new pwebpriv();
    $CarregarPagina->StartClock();
    $CarregarPagina->setUsuario("Alexandre");
    $CarregarPagina->setFiltros($FiltroPWEBPRIV);
    $CarregarPagina->Select();
    $CarregarPagina->EndClock();
    $ResultRequest["pwebpriv"] = $CarregarPagina->getArrayDados();
    
    $ResultRequest["Indexador"]         = time();
    
    $ResultRequest["Modo"]             = "S";
    $ResultRequest["Error"] = false;


   /**
    * Armazena o tempo gasto com o processamento até esse ponto. Excluir Dados
    */
    $ResultRequest["TempoTotal"]["BancoDados"]   =  $CarregarPagina->getTempoTotal();
    $ResultRequest["TempoTotal"]["SitemaTotal"]  =  ConfigSystema::getTimeTotal();

    echo json_encode($ResultRequest);

} catch (Exception $ex) {
    $ResultRequest["Modo"]      = "LoadPage";
    $ResultRequest["Error"]     = true;
    $ResultRequest["Codigo"]    = $ex->getCode();
    $ResultRequest["Mensagem"]  = $ex->getMessage();
    $ResultRequest["Trace"]     = $ex->getTraceAsString();
    $ResultRequest["File"]      = $ex->getFile();

    echo json_encode($ResultRequest);
}
