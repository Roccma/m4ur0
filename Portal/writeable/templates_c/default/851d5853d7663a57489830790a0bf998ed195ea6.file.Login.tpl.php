<?php /* Smarty version Smarty-3.1.19, created on 2019-01-04 10:49:08
         compiled from "/var/www/html/Sirenis/Portal/layouts/default/templates/Portal/Login.tpl" */ ?>
<?php /*%%SmartyHeaderCode:4767992795c2f3a244f4567-53423060%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '851d5853d7663a57489830790a0bf998ed195ea6' => 
    array (
      0 => '/var/www/html/Sirenis/Portal/layouts/default/templates/Portal/Login.tpl',
      1 => 1546598508,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '4767992795c2f3a244f4567-53423060',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5c2f3a2453b2c2_59004730',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5c2f3a2453b2c2_59004730')) {function content_5c2f3a2453b2c2_59004730($_smarty_tpl) {?>
<style type="text/css">
    .navbar-inverse{
        display: none !important;
    }
    body{
        overflow: hidden;
        background : url('layouts/default/resources/images/homeBack.jpg') no-repeat;
        background-size: cover;
        font-family: 'Lato', sans-serif;
    }

    #credentials_container{
        width: 30%;
        border-radius: 15px;
        background: rgba(255, 255, 255, .8);
        padding: 15px 30px;
        box-sizing: border-box;
        -webkit-box-shadow: 2px 17px 41px -11px rgba(0,0,0,0.75);
        -moz-box-shadow: 2px 17px 41px -11px rgba(0,0,0,0.75);
        box-shadow: 2px 17px 41px -11px rgba(0,0,0,0.75);      
        font-size: 15px;  
        margin: auto;
        margin-top: 5%;
    }

    input[type="text"], input[type="password"], select option, button {
        font-size: 15px !important;
        padding: 5px 10px;

    }

    .form-control{
        height: auto !important;
    }

    .img_sirenis{
        width: 100%;
        margin-bottom: 25px;
    }

    .contenedorBotones{
        padding-top: 25px !important;
    }

    .text-danger{
        font-weight: bold;
        text-align: center;
    }

    .modal-dialog{
        width: 355px;
    }

    .modal{
        overflow: hidden;
    }

    #btnForgotPassword{
        width: 100%;
    }

    input[name = "email"]{
        font-size: 14px !important;
    }

    .modal-header .close{
      font-size: 25px !important;
      outline: 0 !important;
    }
</style>
<div class="container-fluid">
    <br>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">&nbsp;</div>
                <div id = "credentials_container">
                    <div>
                        <form class="form-horizontal" novalidate="novalidate" ng-submit="makeAutoComplete();login(loginForm.$valid)" name="loginForm">
                            <div class="col-sm-12">
                                <img class = "img_sirenis" src = "layouts/default/resources/images/sirenis_azul.png"/>
                            </div>
                            <h4 style="text-align:center;font-weight: bold;"><strong>{{titleLogin}}</strong></h4>
                            <br>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input type="text" ng-model-options="{updateOn:'blur'}" ng-pattern='/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/' class="form-control"  ng-model="username" name="username" ng-required="true" autofill="autofill" placeholder = "{{'E-mail' | translate}}">
                                    </div>
                                    <span class="text-danger" ng-if="loginForm.username.$error.pattern" style = "margin-top: 9px; text-align: center; width: 100%; display: block;"><i class = "glyphicon glyphicon-warning-sign"></i>&nbsp;&nbsp;{{invalidEmail}}</span>                                    
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                        <input type="password" class="form-control"  ng-model="password" name="password" placeholder = "{{passwordPlaceholder}}" ng-required="true" />
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <select class = "form-control select" ng-model="language" style = "font-size: 15px">
                                        <option value = "en_us">English</option>
                                        <option value = "es_es">Español</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group" ng-if="loginFailed && !loginForm.username.$error.pattern">
                                </label>
                                <div class="col-sm-12 text-danger"><i class = "glyphicon glyphicon-warning-sign"></i>&nbsp;&nbsp;{{errorLogin}}</div>
                            </div>
                              <div class="form-group" ng-if="noUserName">
                                <label ng-hide="loginForm.username.$dirty && loginForm.username.$viewValue!==''" for="  " class="col-sm-4">
                                </label>
                                <div class="col-sm-12 text-danger" ng-hide="loginForm.username.$dirty && loginForm.username.$viewValue!==''"><i class = "glyphicon glyphicon-warning-sign"></i>&nbsp;&nbsp;{{emptyEmail}}</div>
                            </div>

                              <div class="form-group" ng-if="noPassword">
                                <label ng-hide="loginForm.username.$invalid && loginForm.username.$viewValue!==''" for="  " class="col-sm-4">
                                </label>
                                <div class="col-sm-12 text-danger" ng-hide="loginForm.username.$invalid && loginForm.username.$viewValue!==''"><i class = "glyphicon glyphicon-warning-sign"></i>&nbsp;&nbsp;&nbsp;{{emptyPassword}}</div>
                            </div>
                            <div class="form-group" class = "contenedorBotones" style = "padding-top: 25px">
                                <div class = "col-sm-12">
                                    <button type="submit" class="btn btn-success" style = "width: 100%"><i class = "glyphicon glyphicon-log-in"></i>&nbsp;&nbsp;&nbsp;<span>{{loginButton}}</span></button>
                                </div>
                                <div class="col-sm-12">
                                    
                                    <a  style = "width: 100%; text-align: center;" href="#" class="text-info forgot-password" ng-click="forgotPassword()">
                                        {{contraseniaOlvidada}}
                                    </a>
                                </div>
                            </div>
                            
                        </form>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">&nbsp;</div>
            </div>
        </div>
    </div>
</div>

    <script type="text/ng-template" id="forgotPassword.template">
        <div class="modal-header" style = "background: #5f88c0; border-radius: 5px 5px 0 0">
        <button type="button" class="close" ng-click="cancel()" title="Close">×</button>
        <h4 class="modal-title" style = "font-weight: bold; text-align: center; color: white">Contraseña olvidada</h4>
        </div>
        <form name="forgotPassword" ng-submit="updatePassword()" class="form-horizontal" role="form">
        <div class="modal-body">
        <div class="form-group">
        <div class="col-sm-12">
        <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
            <input ng-model="data.email" placeholder = "Ingrese su correo electrónico" name="email" ng-pattern='/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/' type="email" class="form-control" required></input>
        
        </div>

        <span class="text-danger" style = "font-size: 14px; margin-top: 9px; text-align: center; width: 100%; display: block;"  ng-show="data.email===undefined"><i class = "glyphicon glyphicon-warning-sign"></i>&nbsp;&nbsp;Ingrese un e-mail válido</span>
        
        </div>
        </div>
        <button id = "btnForgotPassword" style = "font-size: 14px" class="btn btn-success" type="submit" enabled = "false">Enviar</button>
        </div>
      </form>
    </script>

    <script type="text/ng-template" id="forgotPasswordEnglish.template">
        <div class="modal-header" style = "background: #5f88c0; border-radius: 5px 5px 0 0">
        <button type="button" class="close" ng-click="cancel()" title="Close">×</button>
        <h4 class="modal-title" style = "font-weight: bold; text-align: center; color: white">Forgot password</h4>
        </div>
        <form name="forgotPassword" ng-submit="updatePassword()" class="form-horizontal" role="form">
        <div class="modal-body">
        <div class="form-group">
        <div class="col-sm-12">
        <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
            <input ng-model="data.email" placeholder = "Please enter your e-mail" name="email" ng-pattern='/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/' type="email" class="form-control" required></input>
        
        </div>

        <span class="text-danger" style = "font-size: 14px; margin-top: 9px; text-align: center; width: 100%; display: block;"  ng-show="data.email===undefined"><i class = "glyphicon glyphicon-warning-sign"></i>&nbsp;&nbsp;Please enter a valid e-mail address</span>
        
        </div>
        </div>
        <button id = "btnForgotPassword" style = "font-size: 14px" class="btn btn-success" type="submit" enabled = "false">Send</button>
        </div>
      </form>
    </script>

<?php }} ?>
