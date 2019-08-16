<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
               
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

        
        <script  src="../Scripts/bootbox/bootbox.js?5a" ></script>
       
        
    </head>    
    
    <body>
        <?php  


        if(@!include_once __DIR__ . "/../Config/Configuracao.php"){ //Include que contém configurações padrões do sistema.
            $ResultRequest["Modo"]        = "Include";
            $ResultRequest["Error"]    = true;
            $ResultRequest["Codigo"]   = 10000;
            $ResultRequest["Mensagem"] = "O arquivo de Configuração não foi encontrado. ";

            echo "<script defer='defer'>bootbox.alert('". $ResultRequest["Codigo"]. ": " . $ResultRequest["Mensagem"] ."')</script>";

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

            echo "<script defer='defer'>bootbox.alert('". $ResultRequest["Codigo"]. ": " . $ResultRequest["Mensagem"] ."')</script>";
            exit;
        }

        try{

            ConfigSystema::getStartTimeTotal();
            $URL            = $_REQUEST["URL"];
            $Requisicao     = $_REQUEST["pgweb"];

            $Saida = explode('/', $Requisicao);
            $Total = count($Saida) - 1;
            /**
             * Verifica se a busca é por texto ou númerica.
             * Campo = 0 - ID da página
             * Campo = 1 - É o título da página.
             */
            $Campo = is_numeric($Saida[$Total]) ==true  ? 0 : 1;
            $Saida = $Saida[$Total];

            class LoadPages{
                
                private $CarregarTabela = null;
                private $Cabecalhos = null;
                private $CamposPWEB = null;
                private $PageEncontrada = false;
                private $DIVsPWEB = null;
                private $Privilegios = null;
                private $idPWEB = null;
                private $TempoTabelaPaginaWEB = 0, 
                        $TempoTabelaDIVs = 0, 
                        $TempoTabelaCabecalhos = 0, 
                        $TempoTabelaPriv = 0;
                /**
                 * Busca a página de internet requisitada na URL
                 * @param type $Cmp
                 * @param type $Sd
                 */
                function __construct($Cmp/*$Campo*/, $Sd/*$Saida*/) {
                    $FiltroPW[0] = false;
                    $FiltroPW[1][0][0] = $Cmp;
                    $FiltroPW[1][0][1] = "=";
                    $FiltroPW[1][0][2] = $Sd;
                    $FiltroPW[1][0][3] = 2;
                    
                    $TmpInicial = round(microtime(true) * 1000);
                    
                    $this->CarregarTabela = new paginaweb();
                    $this->CarregarTabela->setUsuario("Alexandre");
                    $this->CarregarTabela->setFiltros($FiltroPW);
                    $this->CarregarTabela->Select();
                    $this->PageEncontrada = $this->CarregarTabela->getInfoPaginacao()["TotalLinhas"] == 0 ? false: true;
                    
                    
                    $this->CamposPWEB = $this->CarregarTabela->getArrayDados();
                    $this->idPWEB = $this->CamposPWEB[0][0];
                    
                    $TmpFinal = round(microtime(true) * 1000);
                    $this->TempoTabelaPaginaWEB = ($TmpFinal - $TmpInicial) / 1000 . " Segundos <->". ($TmpFinal - $TmpInicial). " MicroSegundos"; 
                    
                    $this->CarregarTabela = null;
                }
                
                /**
                 * Carrega os a configuração das partes que serão visualizadas no browser.
                 */
                private function getDIVsPWEB() {
                    $FiltroPWEBDIV[0] = false;
                    $FiltroPWEBDIV[1][0][0] = 1;
                    $FiltroPWEBDIV[1][0][1] = "=";
                    $FiltroPWEBDIV[1][0][2] = $this->idPWEB;
                    $FiltroPWEBDIV[1][0][3] = 2;

                    $TmpInicial = round(microtime(true) * 1000);

                    $this->CarregarTabela = new pwebdiv();
                    $this->CarregarTabela->setUsuario("Alexandre");
                    $this->CarregarTabela->setFiltros($FiltroPWEBDIV);
                    $this->CarregarTabela->Select();
                    $this->DIVsPWEB = $this->CarregarTabela->getArrayDados();

                    $TmpFinal = round(microtime(true) * 1000);
                    $this->TempoTabelaDIVs = ($TmpFinal - $TmpInicial) / 1000 . " Segundos <->". ($TmpFinal - $TmpInicial). " MicroSegundos"; 
                    
                    $this->CarregarTabela = null;
                }
                
                private function getCabecalhosPadrao() {
                    $FiltroPWEBCP[0] = false;
                    $FiltroPWEBCP[1][0][0] = 1;
                    $FiltroPWEBCP[1][0][1] = "=";
                    $FiltroPWEBCP[1][0][2] = $this->idPWEB;
                    $FiltroPWEBCP[1][0][3] = 2;

                    $TmpInicial = round(microtime(true) * 1000);

                    $this->CarregarTabela = new pwcabecalhopadrao();
                    $this->CarregarTabela->setUsuario("Alexandre");
                    $this->CarregarTabela->setFiltros($FiltroPWEBCP);
                    $this->CarregarTabela->Select();
                    $this->Cabecalhos = $this->CarregarTabela->getArrayDados();

                    $TmpFinal = round(microtime(true) * 1000);
                    $this->TempoTabelaCabecalhos = ($TmpFinal - $TmpInicial) / 1000 . " Segundos <->". ($TmpFinal - $TmpInicial). " MicroSegundos"; 

                    $this->CarregarTabela = null;

                }
                
                private function getPrivPWEB() {
                    $FiltroPWEBPRIV[0] = false;
                    $FiltroPWEBPRIV[1][0][0] = 1;
                    $FiltroPWEBPRIV[1][0][1] = "=";
                    $FiltroPWEBPRIV[1][0][2] = $this->idPWEB;
                    $FiltroPWEBPRIV[1][0][3] = 2;

                    $TmpInicial = round(microtime(true) * 1000);

                    $this->CarregarTabela = new pwebpriv();
                    $this->CarregarTabela->setUsuario("Alexandre");
                    $this->CarregarTabela->setFiltros($FiltroPWEBPRIV);
                    $this->CarregarTabela->Select();
                    $this->Privilegios = $this->CarregarTabela->getArrayDados();

                    $TmpFinal = round(microtime(true) * 1000);
                    $this->TempoTabelaPriv = ($TmpFinal - $TmpInicial) / 1000 . " Segundos <->". ($TmpFinal - $TmpInicial). " MicroSegundos"; 
                    
                    $this->CarregarTabela = null;
                }
                
                public function getPaginaExiste(){
                    return $this->PageEncontrada;
                }


                }
            
        $Pagina = new LoadPages($Campo, $Saida);

        } catch (Exception $ex) {
            $ResultRequest["Modo"]      = "LoadPage";
            $ResultRequest["Error"]     = true;
            $ResultRequest["Codigo"]    = $ex->getCode();
            $ResultRequest["Mensagem"]  = $ex->getMessage();
            $ResultRequest["Trace"]     = $ex->getTraceAsString();
            $ResultRequest["File"]      = $ex->getFile();

            echo "<script defer='defer'>bootbox.alert('". $ResultRequest["Codigo"]. ": " . $ResultRequest["Mensagem"] ."')</script>";

        }

?>
        <?php
           if($Pagina->getPaginaExiste()){
        ?>
            <div  class="Barra-Menu-Superior" id='Barra-Menu-Superior'></div>


            <div class="Pagina-Central" style="display: table" id='Pagina-Central'>
                <div class="BLE" style="display: table-cell" id='BLE'></div>
                <div class="BCD" style="display: table-cell" id='BCD'></div>
                <div class="BLD" style="display: table-cell" id='BLD'></div>
            </div>
            <div class="Barra-Status" id='Barra-Status' onmouseup=""></div>
        <?php
           }
        ?> 
            
    </body>
</html>
