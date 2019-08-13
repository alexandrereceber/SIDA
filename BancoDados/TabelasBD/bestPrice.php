<?php
/**
 * Possue algumas configurações, muito importantes, sobre o sistema. Exm.: Nome e senha da base de dados, nome do
 * banco de dados que será utilizado pelo sistema e outras configurações.
 */
include_once dirname(__DIR__) ."/../Config/Configuracao.php"; 

/**
 * Inclui o modelo abstrato de uma tabela no banco de dados.
 */
if(@!include_once ConfigSystema::get_Path_Systema() . '/BancoDados/TabelasBD/ModeloTabelas.php'){ 
    $ResultRequest["Erros"]["Modo"]        = "Include";
    $ResultRequest["Erros"][0]             = true;
    $ResultRequest["Erros"][1]             = 7000;
    $ResultRequest["Erros"][2]             = "O arquivo de configuração não foi encontrado.";
    
    echo json_encode($ResultRequest);
    exit;
}; 

/**
 * Classe que será utilizada para todo o sistema que exija login.
 * Essa classe poderá ser alterada de maneira a se encaixar no modelo atual de login.
 *
 * @author 04953988612
 */
class Produtos extends ModeloTabelas{
    /**
     * Mapeia os campos da tabela - Muito importante caso se queira visualizar somente campo necessários
     */
    private $Campos =  [
           
            [
              /**
               * Esse índice é utilizado em todo o sistema, através dele o sistema pode buscar o nome, real do campo,
               * e outras informações.
               */
               "Index"          => 0,
               /**
                * Nome real do campo dentro da tabela no banco de dados. É utilizado pelo sistema para criar as intruções
                * SQL de CRUD.
                */
               "Field"          => "idProdutos",
               /**
                * É o nome que será utilizado no sistema como label ou sejá o nome que será exibido dentro da página.
                * Muito utilizado na formação dos campos de insersão e edição HTML.
                */
               "CodNome"        => "ID",
                /**
                 * Tipo de conteúdo e de campo que será utilizado para edição ou visualização dentro dos componentes
                 * Js na página WEB via HTML. Atualmente está mapeado o text e imagem no componente tableHTML. Mas os componentes poderão
                 * ser implementados com qualquer tipo, desde que cada um trate-os.
                 */
               "TypeConteudo"   => ["text"],
                /**
                 * Habilita ou não o uso de filtro pelo campo. [true|false]
                 */
               "Filter"         => true,       
                /**
                 * Informa ao sistema que o campo atual é uma chave primária e se ela será exibida ou não ao usuário.
                 */
               "Key"            => [true, true],
                /**
                 * Informa ao sistema que esse campo possue uma chave extrangeira vinculada.
                 */
               "ChvExt"         => [    
                                        /**
                                         * TExt - Tabela Extrangeira
                                         * Informa ao sistema que o campo atual possue uma tabela extrangeira.
                                         */
                                        "TExt" => false,
                                        /**
                                         * Nome da tabela extrangeira.
                                         */
                                        "Tabela"=> "",
                                        /**
                                         * Índice do campo da tabela extrangeira que está vinculado à este campo.
                                         */
                                        "IdxCampoVinculado"=> 0, 
                                        /**
                                         * Índice da função que representa esta relação.
                                         */
                                        "Funcao"=> 0,
                                        /**
                                         * Nome do botão que será exibido na tabela HTML.
                                         */
                                        "NomeBotao"=> ""
                                    ],
                /**
                 * Campo com funções ainda não definidos.
                 */
               "Mask"           => false,
                /**
                 * Informa ao sistema se o campo será editável ou não.
                 */
               "Editar"         => false,
                /**
                 * Informa se o campo será visível na tabela HTML.
                 */
               "Visible"        => true,
                /**
                 * Campo com utilização futura. Apesar do regexr ser implementado via método dentro de cada class.
                 */
               "Regex"          => [Exist=> false, Regx=> ""],
                /**
                 * Subarray - informa se o campo será atualizável
                 */
               "Formulario"     => [
                                        /**
                                         * Informa ao sistema que o campo será atualizável.
                                         */
                                        "Exibir"=> false,
                                        /**
                                         * Texto explicativo que ficará dentro do campo input type text
                                         */
                                        "Placeholder"=> "", 
                                        /**
                                         * Tipo de componente que será visualizado no formulário. inputbox, select
                                         */
                                        "TypeComponente"=>"",
                                        /**
                                         * Usado conjuntamente com o campo anterior.
                                         */
                                        "TypeConteudo"=> ["text"],
                                        /**
                                         * Nome do campo que será exportado para o controller, esse campo deverá ter o nome diferente do nome
                                         * original por motivo de segurança
                                         */
                                        "Name" => "username", 
                                        /**
                                         * Regex do campo input text
                                         */
                                        "Patterns"=> "",
                                        /**
                                         * Informação que será exibida quando o cursor fixa em cima do componente.
                                         */
                                        "Titles" => "",
                                        /**
                                         * Campo terá preenchimento obrigatório.
                                         */
                                        "Required" => "",
                                        /**
                                         * Tamanho do campo
                                         */
                                        "width" => "50px",
                                        "height"=>"",
                                        /**
                                         * Salto dos números na caixa do tipo number
                                         */
                                        "step"=>"",
                                        /**
                                         * 
                                         */
                                        "size"=>"",
                                        /**
                                         * Número mínimo dentro da caixa do tipo number
                                         */
                                        "min"=>"",
                                        /**
                                         * Número máximo dentro da caixa do tipo number
                                         */
                                        "max"=>"",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        /**
                                         * Autofocus
                                         */
                                        "autofocus"=> true,
                                        "checked"=>"",
                                        "dirname"=>"",
                                        /**
                                         * Campo será somente leitura
                                         */
                                        "readonly"=>""
                                    ],
               /**
                * Informa ao sistema que o campo deverá, via tabela html, a opção de ordernar o campo.
                */
               "OrdemBY"        => true
           ]   ,
            [
               "Index"          => 1,                                   //Ordem dos campos
               "Field"          => "Nomes",                       //Nome original do campo (String)
               "CodNome"        => "NOme",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["texto"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => true,                               //Exibe ícone para realizar filtro por campo
               "Key"            => [false, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => false,
                                        "Tabela"=> "",
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> 0, 
                                        "NomeBotao"=> ""
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => true,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => [Exist=> false, Regx=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> false,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"", 
                                        "TypeConteudo"=> ["text"], 
                                        "Name" => "password", 
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => "",
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"",
                                        "max"=>"",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>""
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ]
        ];
    private $Privilegios = [["Alexandre","Select/Insert/Update/Delete"],["Pedro","Select"]];
    private $TipoPaginacao = ["Simples"=>false, "SaltoPagina"=> true, "Filtros"=>true, "BRefresh"=>true];
    
    public function ModoPaginacao() {
        return $this->TipoPaginacao;
    }
    
    public function getVirtual() {
        return false;
    }

    public function getNomeReal() {
        return "historico";
    }

    public function setNomeTabela() {
        $this->NomeTabela = __CLASS__ ;
    }

    public function getCampos() {
        return $this->Campos;
    }

    public function getPrivilegios() {
        return $this->Privilegios;
    }

    public function getTituloTabela() {
        return "USUÁRIOS CADASTRADOS NO SISTEMA";
    }

    public function getLimite() {
        return 30;
    }

    public function getMostrarContador() {
        return true;
    }

    public function showColumnsIcones() {
        $Habilitar = true;
        $Icones = [
                        //["NomeColuna"=> "<i class='fa fa-bluetooth' style='font-size:20px'></i>","NomeBotao"=>"Localizar", "Icone" => "fa fa-search", "Func" => 0, "Tipo" => "Bootstrap", "tooltip"=> "busca"]
                    ];
        $ShowColumns[0] = $Habilitar;
        $ShowColumns[1] = $Icones;
        
        return $ShowColumns;
        
    }
    /**
     * A idéia do método é possibilitar o retorno de valor padrão baseado em qualquer outro método.
     * @param int $idx
     * @return boolean
     */
    public function getValorPadrao($idx) {
        $ValorPadraoCampos[0] = [Exist=>false, Valor=>"sim"];
        $ValorPadraoCampos[1] = [Exist=>true, Valor=>"sim"];
        $ValorPadraoCampos[2] = [Exist=>true, Valor=>"sim"];
        $ValorPadraoCampos[3] = [Exist=>false, Valor=>"sim"];
        
        return $ValorPadraoCampos[$idx];
    }

    public function getPrivBD() {
        
    }
    /**
     * Método muito importante para o sistema. 
     * Através deste método, podemos criar os filtros padrões de cada campo.
     * O método foi criado com o intuito de se poder criar qualquer tipo de filtro padrão.
     * Ex.: $Filtro[0] = ["like","%fd%"]
     */
    public function getFiltrosCampo() {
        
    }

    public function Jobs($Tipo, &$ConjuntoDados) {
        
    }

    public function getTotalPageVisible() {
        
    }

    public function validarConteudoCampoRegex(&$Dados) {
        foreach ($Dados as $key => $value) {
            $Valido = preg_match("/script|<script>|!|;/i", $Dados[$key]["value"]);
            if($Valido){ 
                $Campo = $Dados[$key]["name"];
                throw new PDOException("O conteúdo do campo: $Campo contém valores inválidos!", 10001);
            }

        }
    }

}
