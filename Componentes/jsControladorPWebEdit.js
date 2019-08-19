
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
    
    EnviarFormularioEditar(){
        if(addObjeto.getModoEdicao()){
            bootbox.alert("<h3>Favor sair do modo de edição!<h3>");
            return false;
        }
        
        bootbox.confirm("<h3>Tem certeza que deseja realizar essa operação?</h3>",async function(r){
            if(r){
                var Campos = [], CodigoHTMLPWEB = "", CodigoHTMLHead = "", CodigoLimpo = null;

                CPaginaWEBAtualizar.DadosEnvio.sendCamposAndValores = Campos;
                CPaginaWEBAtualizar.DadosEnvio.sendChavesPrimarias = [[0,IDPWEB]];

                CodigoHTMLHead  = document.head.innerHTML;
                CodigoHTMLPWEB  = $("#CodigoHTMLPWEB").html().trim();

                CPaginaWEBAtualizar.DadosEnvio.sendCamposAndValores[0] = {name:"CodigoHTML", value: CodigoHTMLPWEB};

               var TratarResposta = await CPaginaWEBAtualizar.atualizar();

                if(TratarResposta.Error != false){
                    CPaginaWEBAtualizar.TratarErros(TratarResposta);
                    return false;
                }         
            }
        })
        
    }    
}

var CPaginaWEBAtualizar = new ControladorPaginaWEBAtualizar("http://"+ Padrao.getHostServer() +"/SistemaOnline/ControladorTabelas/");
