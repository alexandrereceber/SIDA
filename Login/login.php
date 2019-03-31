<?php
    

?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
    <title>Acessar Sistema</title>
        <meta charset="UTF-8">
        <meta http-equiv="CACHE-CONTROL" content="Private">
        <meta http-equiv="CACHE-CONTROL" content="cache">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <!-- Exibe o ícone tipos de usuários na aba do navegador -->
        <link rel="shortcut icon" href="login.png" type="image/jpg">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" >
        <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css" >
        <link   rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

        <link rel="stylesheet" href="./Login/TL.css?yy5">

        <script defer src="https://code.getmdl.io/1.3.0/material.min.js" ></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" defer></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" defer></script>
        <script  src="./Scripts/bootbox/bootbox.js?5s" defer="defer"></script>

        <script src="./Scripts/jsControlador/jsConstroller.js?dssdd" defer="defer"></script>     
        <script src="./Login/verificarLogin.js?2hd" defer></script>

        
    </head>
    <body>
       
        <div class="Caixa_Fundo">
            <div class="Caixa_Flutuante">
                <form action="#" onsubmit="EnviarDados(this)">
                    <div class="Caixa_User_Pass">
                        <div class="Linha_Titulo">
                           <i class="material-icons" style="font-size: 7vw;color: #2802f7b8;">person</i>
                        </div>
                        <div class="Linha_Username">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input" type="text" id="user" name="username" >
                              <label class="mdl-textfield__label" for="Username" >Usuário</label>
                            </div>
                        </div>
                        <div class="Linha_Password">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input" type="password" id="sample3" name="password" >
                              <label class="mdl-textfield__label" for="Password" >Senha</label>
                            </div>
                        </div>
                        <div class="Linha_CPassword" id="RepeteSenha">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input" type="password" id="sample3" name="Contrapassword" >
                              <label class="mdl-textfield__label" for="Password" >Repetir Senha</label>
                            </div>
                        </div>
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                            <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="android" style="text-align: left;color: #00000087;">
                                <input type="checkbox" id="android" class="mdl-checkbox__input" onchange="setCadastrar(this)" />
                              <span class="mdl-checkbox__label">1° Acesso</span> <!-- Checkbox Label -->
                            </label>                            
                        </div>
                        <div class="Linha_BotaoEnvio">
                            <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent LoginCadastrar">
                              Acessar
                            </button>   
                        </div>
                    </div>                    

                    <div id="Linha_Password">

                    </div>
                </form>                 
            </div>
        </div>


        <dialog class="mdl-dialog">
          <h4 class="mdl-dialog__title">Mensagem</h4>
          <div class="mdl-dialog__content">
            <p>
              Texto
            </p>
          </div>
          <div class="mdl-dialog__actions">
            <button type="button" class="mdl-button close">Close</button>
          </div>
        </dialog>
    
        <div id="Barra-de-Mensagem" class="mdl-js-snackbar mdl-snackbar">
          <div class="mdl-snackbar__text"></div>
          <button class="mdl-snackbar__action" type="button"></button>
        </div>
    </body>
</html>
