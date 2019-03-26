/* 
 * Envia os dados para verificar se o usuário esta ou não cadastrado no sistema.
 */
var dialog = document.querySelector('dialog');
var showDialogButton = document.querySelector('#show-dialog');
if (! dialog.showModal) {
  dialogPolyfill.registerDialog(dialog);
}
dialog.querySelector('.close').addEventListener('click', function() {
  dialog.close();
});
    
async function EnviarDados(obj){
    event.preventDefault();
    var Campos = $(obj).serializeArray(), sendUsuario = "", sendSenha = "";
    
    sendUsuario = obj[0].value == "" ? true : false;
    sendSenha   = obj[1].value == "" ? true : false;
        
    var snackbarContainer = document.querySelector('#Barra-de-Mensagem');
    var handler = function() {};    
    var data = {
      message: '',
      timeout: 3000,
      actionHandler: handler,
      actionText: 'OK'
    };
        
    if(sendUsuario){
        obj[0].focus();
        data.message = "Usuário necessário."
        snackbarContainer.MaterialSnackbar.showSnackbar(data);        
        return false;
    }
    if(sendSenha){
        obj[1].focus();
        data.message = "senha necessário."
        snackbarContainer.MaterialSnackbar.showSnackbar(data);        
        return false;
    }

    sendUsuario = obj[0].value;
    sendSenha   = obj[1].value;
    
    var Dados = new JSController("http://"+ Padrao.getHostServer() +"/sistemaonline/Validar/"), Result = "";
    Dados.DadosEnvio.sendUsuario    = sendUsuario;
    Dados.DadosEnvio.sendSenha      = sendSenha;

    Result = await Dados.Atualizar();   
    if(Result.Error != false){
        switch (Result.Codigo) {
            case 1049:
                Result.Mensagem = "Banco de dados não encontrado. Favor entrar em contato com o administrador."
                break;

            case 3589:
                break;

            case 3590:
                break;

            case 3591:
                break;

            case 3592:
                break;

            default:
                Result.Mensagem = "Error não tratado ou inesperado. Favor entrar em contato com o administrador."
                break;
        }
        
        $(".mdl-dialog__content").html("<h4>" +  Result.Mensagem + "</h4>");
        dialog.showModal();
    }else{
        window.location = Dados.ResultSet.Header;
    }
    
}