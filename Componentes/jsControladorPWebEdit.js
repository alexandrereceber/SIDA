/* 
 * Busca a página WEB no banco de dados.
 * Criado: 12/01/2019
 */

/**
 * Classe que busca no banco de dados, a página via GET ou POST
 * @type JSController
 */
class CPWeb extends JSController{
    constructor(Caminho){
        super(Caminho);
        this.NomeInstancia = null; //Nome do objeto instanciado na memória.
        this.DadosEnvio.TipoObjeto = "PaginaWEB";
    }
    
    /**
     * 
     * @param {array} Erros
     * @returns {void}
     */
    TratarErros(Erros){
        bootbox.alert("<h3>"+ Erros.Mensagem +"</h3>")
    } 
    
    
    /**
     * Método que envia para o servidor as informações da página que será carregada via banco de dados.
     * @param string Pagina Nome da página que o sistema irá carregar.
     * @returns JSON
     */
    async LoadPaginaWEB(Pagina){
        var Page = Pagina || false, Retorno, TratarResposta;
        
        if(Page != false){
            this.DadosEnvio.sendModoOperacao = "2a2dc21af693c43131fe9dfd23277bd6";
            this.DadosEnvio.PWEB = {Tipo: "POST", CarregarPagina: Pagina}; //Define que a página que será carregar é a que esta definida na variável;
        }else{
            this.DadosEnvio.sendModoOperacao = "2a2dc21af693c43131fe9dfd23277bd6";
            this.DadosEnvio.PWEB = {Tipo: "GET"}; //Define que a página será carregada através do endereço da barra de navegação;
            
        }
        
        TratarResposta = await this.Atualizar();
        if(TratarResposta.Error != false){
            this.TratarErros(TratarResposta, "Inserir");
            return false;
        }
        let paginaweb = "", pwebdiv = "", pwebCPD = "", pwebpriv = "";
        paginaweb = TratarResposta.paginaweb;
        if(paginaweb.length == 0){
//            $("body").html("<div style='text-align: center'><img src='"+ Padrao.getHostServer() + "/sistemaonline/Imagens/LoadPages/error-404.png'></div>");
            return
        }else{
            document.head.childNodes.forEach(function(i,p,v){
                //---------------TÍTULO DA GUIA------------------------------------
                if(i.nodeName == "TITLE"){
                    i.innerHTML = paginaweb[0][2];
                }
            })
        }
        pwebdiv = TratarResposta.pwebdiv;
        pwebpriv = TratarResposta.pwebpriv;
        pwebCPD = TratarResposta.pwcabecalhopadrao;
    
        
        //---------------------BARRA DE MENU SUPERIOR------------------------------
        try{
            if(pwebdiv[0][4] == "Sim"){
                if((paginaweb[0][6]) != ""){
                    $("#Barra-Menu-Superior").removeClass("Barra-Menu-Superior")
                    $("#Barra-Menu-Superior").html(paginaweb[0][6]);
                }else{
                    $("#Barra-Menu-Superior").addClass("Barra-Menu-Superior")
                    $("#Barra-Menu-Superior").html("<img src='"+ Padrao.getHostServer() + "/sistemaonline/Imagens/LoadPages/empyt84x80.png'>");
                }
            }else{
                $("#Barra-Menu-Superior").html("");
                //$("#Barra-Menu-Superior").css("display","none");
            }
        }catch(err){
              $("#Barra-Menu-Superior").html("<link href=\"https://fonts.googleapis.com/icon?family=Material+Icons\" rel=\"stylesheet\"><i title=\""+ err.message +"\" class=\"material-icons\" style=\"font-size:100px; color: #0008f954\">error</i>");
        }
        //---------------------BARRA DE MENU LATERAL ESQUERDA------------------------------
        try{
            if(pwebdiv[0][5] == "Sim"){
                if((paginaweb[0][7]) != ""){
                    $("#BLE").removeClass("BLE")
                    $("#BLE").html(paginaweb[0][7]);
                }else{
                    $("#BLE").addClass("BLE")
                    $("#BLE").html("<img src='"+ Padrao.getHostServer() + "/sistemaonline/Imagens/LoadPages/empyt84x80.png'>");
                }
            }else{
                $("#BLE").html("");
                //$("#BLE").css("display","none");
            }
        }catch(err){
              $("#BLE").html("<link href=\"https://fonts.googleapis.com/icon?family=Material+Icons\" rel=\"stylesheet\"><i title=\""+ err.message +"\" class=\"material-icons\" style=\"font-size:100px; color: #0008f954\">error</i>");
        }        
        //---------------------------------------------------
        //---------------------BARRA DE CONTEUDO------------------------------
        try{
            if(pwebdiv[0][8] == "Sim"){
                if((paginaweb[0][10]) != ""){
                    $("#BCD").removeClass("BCD")
                    $("#BCD").html(paginaweb[0][10]);
                }else{
                    $("#BCD").addClass("BCD")
                    $("#BCD").html("<img src='"+ Padrao.getHostServer() + "/sistemaonline/Imagens/LoadPages/empyt84x80.png'>");
                }
            }else{
                $("#BCD").html("");
                //$("#BCD").css("display","none");
            }
         }catch(err){
            $("#BCD").html("<link href=\"https://fonts.googleapis.com/icon?family=Material+Icons\" rel=\"stylesheet\"><i title=\""+ err.message +"\" class=\"material-icons\" style=\"font-size:100px; color: #0008f954\">error</i>");
        }
        //---------------------------------------------------
        //---------------------BARRA DE MENU LATERAL DIREITA------------------------------
        try{
            if(pwebdiv[0][6] == "Sim"){
                if((paginaweb[0][8]) != ""){
                    $("#BLD").removeClass("BLD")
                    $("#BLD").html(paginaweb[0][8]);
                }else{
                    $("#BLD").addClass("BLD")
                    $("#BLD").html("<img src='"+ Padrao.getHostServer() + "/sistemaonline/Imagens/LoadPages/empyt84x80.png'>");
                }
            }else{
                $("#BLD").html("");
                //$("#BLD").css("display","none");
            }
        }catch(err){
            $("#BLD").html("<link href=\"https://fonts.googleapis.com/icon?family=Material+Icons\" rel=\"stylesheet\"><i title=\""+ err.message +"\" class=\"material-icons\" style=\"font-size:100px; color: #0008f954\">error</i>");
        }
        //---------------------------------------------------
        //---------------------BARRA DE STATUS------------------------------
        try{
            if(pwebdiv[0][7] == "Sim"){
                if((paginaweb[0][9]) != ""){
                    $("#Barra-Status").removeClass("Barra-Status")
                    $("#Barra-Status").html(paginaweb[0][9]);
                }else{
                    $("#Barra-Status").addClass("Barra-Status")
                    $("#Barra-Status").html("<img src='"+ Padrao.getHostServer() + "/sistemaonline/Imagens/LoadPages/empyt84x80.png'>");
                }

            }else{
                $("#Barra-Status").html("");
                //$("#Barra-Status").css("display","none");
            }
        }catch(err){
            $("#Barra-Status").html("<link href=\"https://fonts.googleapis.com/icon?family=Material+Icons\" rel=\"stylesheet\"><i title=\""+ err.message +"\" class=\"material-icons\" style=\"font-size:100px; color: #0008f954\">error</i>");
        }        //---------------------------------------------------
        
    }
};

var ControladorPaginaWEB = new CPWeb("http://"+ Padrao.getHostServer() +"/SistemaOnline/ControladorPages/");
//ControladorPaginaWEB.LoadPaginaWEB();


class ControladorPaginaWEBAtualizar extends JSController{
    constructor(Caminho){
        super(Caminho);
        this.NomeInstancia = null; //Nome do objeto instanciado na memória.
    }
    
    async atualizar(){
        this.DadosEnvio.sendModoOperacao = "1b24931707c03902dad1ae4b42266fd6";//
        this.DadosEnvio.sendTabelas = "9e9524af7942ab2ca5efc37ea3738659";
        
        return await this.Atualizar();
    }
    
    async EnviarFormularioEditar(){
        var Campos = [], BarraMenuSuperior = "", BarraLateralEsquerda = null, BarraLateralDireita = null, BarraConteudo = null, BarraStatus = null;

        this.DadosEnvio.sendCamposAndValores = Campos;
        this.DadosEnvio.sendChavesPrimarias = [[0,ControladorPaginaWEB.ResultSet.paginaweb[0][0]]];
        
        BarraMenuSuperior       = document.getElementById("Barra-Menu-Superior").innerHTML;
        BarraLateralEsquerda    = document.getElementById("BLE").innerHTML;;
        BarraLateralDireita     = document.getElementById("BLD").innerHTML;
        BarraConteudo           = document.getElementById("BCD").innerHTML;
        BarraStatus             = document.getElementById("Barra-Status").innerHTML;
        
        this.DadosEnvio.sendCamposAndValores[0] = {name:"PWBMS", value: BarraMenuSuperior};
        this.DadosEnvio.sendCamposAndValores[1] = {name:"PWBLD", value: BarraLateralEsquerda};
        this.DadosEnvio.sendCamposAndValores[2] = {name:"PWBLE", value: BarraLateralDireita};
        this.DadosEnvio.sendCamposAndValores[3] = {name:"PWBST", value: BarraStatus};
        this.DadosEnvio.sendCamposAndValores[4] = {name:"PWCNT", value: BarraConteudo};

       var TratarResposta = await CPaginaWEBAtualizar.atualizar();
        
        if(TratarResposta.Error != false){
            this.TratarErros(TratarResposta);
            return false;
        }        
    }    
}

var CPaginaWEBAtualizar = new ControladorPaginaWEBAtualizar("http://"+ Padrao.getHostServer() +"/SistemaOnline/ControladorTabelas/");