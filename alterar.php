<?php
session_start();
if($_SESSION["login"] == ''){
    header("location: index?");
    exit;
}
  ?><?php
// Inicialize a sessão
session_start();


  // HTTP/1.1
header("Cache-Control: no-cache, must-revalidate");

 // Date in the past
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

// Incluir arquivo de configuração
require_once 'lib/Database/2connect.php';

// Defina variáveis e inicialize com valores vazios
$username = $stsconta = "";
$username_err = $stsconta_err = "";
 
// Processando dados do formulário quando o formulário é enviado
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
 
    // Validar nova senha
    if(empty(trim($_POST["username"]))){
        $username_err = "Por favor insira a nova senha.";     
    } elseif(strlen(trim($_POST["username"])) < 1){
        $username_err = "A senha deve ter pelo menos 6 caracteres.";
    } else{
        $username = trim($_POST["username"]);
    }
          // Validar nova senha
    if(empty(trim($_POST["password"]))){
        $stsconta_err = "Por favor insira a nova senha.";     
    } elseif(strlen(trim($_POST["password"])) < 1){
        $stsconta_err = "A senha deve ter pelo menos 6 caracteres.";
    } else{
        $stsconta = trim($_POST["password"]);
    }
    // Verifique os erros de entrada antes de atualizar o banco de dados
    if(empty($stsconta_err) && empty ($username_err)){
        // Prepare uma declaração de atualização
        $sql = "UPDATE login SET senha = :password WHERE login = :username";
        
        if($stmt = $pdo->prepare($sql)){
            // Vincule as variáveis à instrução preparada como parâmetros
            $stmt->bindParam(":password", $param_stsconta, PDO::PARAM_STR);
            $stmt->bindParam(":username", $param_id, PDO::PARAM_STR);
            
            // Definir parâmetros
            $param_stsconta = md5($stsconta);
            $param_id = $username;
            
            // Tente executar a declaração preparada
            if($stmt->execute()){
                // Senha atualizada com sucesso. Destrua a sessão e redirecione para a página de login
                header("location: index.php");
                destroy_session();
                exit();
            } else{
                echo "Ops! Algo deu errado. Por favor, tente novamente mais tarde.";
            }

            // Fechar declaração
            unset($stmt);
        }
    }
    
    // Fechar conexão
    unset($pdo);
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
<style>
.swal2-popup.swal2-toast{box-sizing:border-box;grid-column:1/4!important;grid-row:1/4!important;grid-template-columns:1fr 99fr 1fr;padding:1em;overflow-y:hidden;background:#fff;box-shadow:0 0 1px rgba(0,0,0,.075),0 1px 2px rgba(0,0,0,.075),1px 2px 4px rgba(0,0,0,.075),1px 3px 8px rgba(0,0,0,.075),2px 4px 16px rgba(0,0,0,.075);pointer-events:all}.swal2-popup.swal2-toast>*{grid-column:2}.swal2-popup.swal2-toast .swal2-title{margin:.5em 1em;padding:0;font-size:1em;text-align:initial}.swal2-popup.swal2-toast .swal2-loading{justify-content:center}.swal2-popup.swal2-toast .swal2-input{height:2em;margin:.5em;font-size:1em}.swal2-popup.swal2-toast .swal2-validation-message{font-size:1em}.swal2-popup.swal2-toast .swal2-footer{margin:.5em 0 0;padding:.5em 0 0;font-size:.8em}.swal2-popup.swal2-toast .swal2-close{grid-column:3/3;grid-row:1/99;align-self:center;width:.8em;height:.8em;margin:0;font-size:2em}.swal2-popup.swal2-toast .swal2-html-container{margin:.5em 1em;padding:0;font-size:1em;text-align:initial}.swal2-popup.swal2-toast .swal2-html-container:empty{padding:0}.swal2-popup.swal2-toast .swal2-loader{grid-column:1;grid-row:1/99;align-self:center;width:2em;height:2em;margin:.25em}.swal2-popup.swal2-toast .swal2-icon{grid-column:1;grid-row:1/99;align-self:center;width:2em;min-width:2em;height:2em;margin:0 .5em 0 0}.swal2-popup.swal2-toast .swal2-icon .swal2-icon-content{display:flex;align-items:center;font-size:1.8em;font-weight:700}.swal2-popup.swal2-toast .swal2-icon.swal2-success .swal2-success-ring{width:2em;height:2em}.swal2-popup.swal2-toast .swal2-icon.swal2-error [class^=swal2-x-mark-line]{top:.875em;width:1.375em}.swal2-popup.swal2-toast .swal2-icon.swal2-error [class^=swal2-x-mark-line][class$=left]{left:.3125em}.swal2-popup.swal2-toast .swal2-icon.swal2-error [class^=swal2-x-mark-line][class$=right]{right:.3125em}.swal2-popup.swal2-toast .swal2-actions{justify-content:flex-start;height:auto;margin:0;margin-top:.5em;padding:0 .5em}.swal2-popup.swal2-toast .swal2-styled{margin:.25em .5em;padding:.4em .6em;font-size:1em}.swal2-popup.swal2-toast .swal2-success{border-color:#a5dc86}.swal2-popup.swal2-toast .swal2-success [class^=swal2-success-circular-line]{position:absolute;width:1.6em;height:3em;transform:rotate(45deg);border-radius:50%}.swal2-popup.swal2-toast .swal2-success [class^=swal2-success-circular-line][class$=left]{top:-.8em;left:-.5em;transform:rotate(-45deg);transform-origin:2em 2em;border-radius:4em 0 0 4em}.swal2-popup.swal2-toast .swal2-success [class^=swal2-success-circular-line][class$=right]{top:-.25em;left:.9375em;transform-origin:0 1.5em;border-radius:0 4em 4em 0}.swal2-popup.swal2-toast .swal2-success .swal2-success-ring{width:2em;height:2em}.swal2-popup.swal2-toast .swal2-success .swal2-success-fix{top:0;left:.4375em;width:.4375em;height:2.6875em}.swal2-popup.swal2-toast .swal2-success [class^=swal2-success-line]{height:.3125em}.swal2-popup.swal2-toast .swal2-success [class^=swal2-success-line][class$=tip]{top:1.125em;left:.1875em;width:.75em}.swal2-popup.swal2-toast .swal2-success [class^=swal2-success-line][class$=long]{top:.9375em;right:.1875em;width:1.375em}.swal2-popup.swal2-toast .swal2-success.swal2-icon-show .swal2-success-line-tip{-webkit-animation:swal2-toast-animate-success-line-tip .75s;animation:swal2-toast-animate-success-line-tip .75s}.swal2-popup.swal2-toast .swal2-success.swal2-icon-show .swal2-success-line-long{-webkit-animation:swal2-toast-animate-success-line-long .75s;animation:swal2-toast-animate-success-line-long .75s}.swal2-popup.swal2-toast.swal2-show{-webkit-animation:swal2-toast-show .5s;animation:swal2-toast-show .5s}.swal2-popup.swal2-toast.swal2-hide{-webkit-animation:swal2-toast-hide .1s forwards;animation:swal2-toast-hide .1s forwards}.swal2-container{display:grid;position:fixed;z-index:1060;top:0;right:0;bottom:0;left:0;box-sizing:border-box;grid-template-areas:"top-start     top            top-end" "center-start  center         center-end" "bottom-start  bottom-center  bottom-end";grid-template-rows:minmax(-webkit-min-content,auto) minmax(-webkit-min-content,auto) minmax(-webkit-min-content,auto);grid-template-rows:minmax(min-content,auto) minmax(min-content,auto) minmax(min-content,auto);height:100%;padding:.625em;overflow-x:hidden;transition:background-color .1s;-webkit-overflow-scrolling:touch}.swal2-container.swal2-backdrop-show,.swal2-container.swal2-noanimation{background:rgba(0,0,0,.4)}.swal2-container.swal2-backdrop-hide{background:0 0!important}.swal2-container.swal2-bottom-start,.swal2-container.swal2-center-start,.swal2-container.swal2-top-start{grid-template-columns:minmax(0,1fr) auto auto}.swal2-container.swal2-bottom,.swal2-container.swal2-center,.swal2-container.swal2-top{grid-template-columns:auto minmax(0,1fr) auto}.swal2-container.swal2-bottom-end,.swal2-container.swal2-center-end,.swal2-container.swal2-top-end{grid-template-columns:auto auto minmax(0,1fr)}.swal2-container.swal2-top-start>.swal2-popup{align-self:start}.swal2-container.swal2-top>.swal2-popup{grid-column:2;align-self:start;justify-self:center}.swal2-container.swal2-top-end>.swal2-popup,.swal2-container.swal2-top-right>.swal2-popup{grid-column:3;align-self:start;justify-self:end}.swal2-container.swal2-center-left>.swal2-popup,.swal2-container.swal2-center-start>.swal2-popup{grid-row:2;align-self:center}.swal2-container.swal2-center>.swal2-popup{grid-column:2;grid-row:2;align-self:center;justify-self:center}.swal2-container.swal2-center-end>.swal2-popup,.swal2-container.swal2-center-right>.swal2-popup{grid-column:3;grid-row:2;align-self:center;justify-self:end}.swal2-container.swal2-bottom-left>.swal2-popup,.swal2-container.swal2-bottom-start>.swal2-popup{grid-column:1;grid-row:3;align-self:end}.swal2-container.swal2-bottom>.swal2-popup{grid-column:2;grid-row:3;justify-self:center;align-self:end}.swal2-container.swal2-bottom-end>.swal2-popup,.swal2-container.swal2-bottom-right>.swal2-popup{grid-column:3;grid-row:3;align-self:end;justify-self:end}.swal2-container.swal2-grow-fullscreen>.swal2-popup,.swal2-container.swal2-grow-row>.swal2-popup{grid-column:1/4;width:100%}.swal2-container.swal2-grow-column>.swal2-popup,.swal2-container.swal2-grow-fullscreen>.swal2-popup{grid-row:1/4;align-self:stretch}.swal2-container.swal2-no-transition{transition:none!important}.swal2-popup{display:none;position:relative;box-sizing:border-box;grid-template-columns:minmax(0,100%);width:32em;max-width:100%;padding:0 0 1.25em;border:none;border-radius:5px;background:#fff;color:#545454;font-family:inherit;font-size:1rem}.swal2-popup:focus{outline:0}.swal2-popup.swal2-loading{overflow-y:hidden}.swal2-title{position:relative;max-width:100%;margin:0;padding:.8em 1em 0;color:inherit;font-size:1.875em;font-weight:600;text-align:center;text-transform:none;word-wrap:break-word}.swal2-actions{display:flex;z-index:1;box-sizing:border-box;flex-wrap:wrap;align-items:center;justify-content:center;width:auto;margin:1.25em auto 0;padding:0}.swal2-actions:not(.swal2-loading) .swal2-styled[disabled]{opacity:.4}.swal2-actions:not(.swal2-loading) .swal2-styled:hover{background-image:linear-gradient(rgba(0,0,0,.1),rgba(0,0,0,.1))}.swal2-actions:not(.swal2-loading) .swal2-styled:active{background-image:linear-gradient(rgba(0,0,0,.2),rgba(0,0,0,.2))}.swal2-loader{display:none;align-items:center;justify-content:center;width:2.2em;height:2.2em;margin:0 1.875em;-webkit-animation:swal2-rotate-loading 1.5s linear 0s infinite normal;animation:swal2-rotate-loading 1.5s linear 0s infinite normal;border-width:.25em;border-style:solid;border-radius:100%;border-color:#2778c4 transparent #2778c4 transparent}.swal2-styled{margin:.3125em;padding:.625em 1.1em;transition:box-shadow .1s;box-shadow:0 0 0 3px transparent;font-weight:500}.swal2-styled:not([disabled]){cursor:pointer}.swal2-styled.swal2-confirm{border:0;border-radius:.25em;background:initial;background-color:#7066e0;color:#fff;font-size:1em}.swal2-styled.swal2-confirm:focus{box-shadow:0 0 0 3px rgba(112,102,224,.5)}.swal2-styled.swal2-deny{border:0;border-radius:.25em;background:initial;background-color:#dc3741;color:#fff;font-size:1em}.swal2-styled.swal2-deny:focus{box-shadow:0 0 0 3px rgba(220,55,65,.5)}.swal2-styled.swal2-cancel{border:0;border-radius:.25em;background:initial;background-color:#6e7881;color:#fff;font-size:1em}.swal2-styled.swal2-cancel:focus{box-shadow:0 0 0 3px rgba(110,120,129,.5)}.swal2-styled.swal2-default-outline:focus{box-shadow:0 0 0 3px rgba(100,150,200,.5)}.swal2-styled:focus{outline:0}.swal2-styled::-moz-focus-inner{border:0}.swal2-footer{justify-content:center;margin:1em 0 0;padding:1em 1em 0;border-top:1px solid #eee;color:inherit;font-size:1em}.swal2-timer-progress-bar-container{position:absolute;right:0;bottom:0;left:0;grid-column:auto!important;height:.25em;overflow:hidden;border-bottom-right-radius:5px;border-bottom-left-radius:5px}.swal2-timer-progress-bar{width:100%;height:.25em;background:rgba(0,0,0,.2)}.swal2-image{max-width:100%;margin:2em auto 1em}.swal2-close{z-index:2;align-items:center;justify-content:center;width:1.2em;height:1.2em;margin-top:0;margin-right:0;margin-bottom:-1.2em;padding:0;overflow:hidden;transition:color .1s,box-shadow .1s;border:none;border-radius:5px;background:0 0;color:#ccc;font-family:serif;font-family:monospace;font-size:2.5em;cursor:pointer;justify-self:end}.swal2-close:hover{transform:none;background:0 0;color:#f27474}.swal2-close:focus{outline:0;box-shadow:inset 0 0 0 3px rgba(100,150,200,.5)}.swal2-close::-moz-focus-inner{border:0}.swal2-html-container{z-index:1;justify-content:center;margin:1em 1.6em .3em;padding:0;overflow:auto;color:inherit;font-size:1.125em;font-weight:400;line-height:normal;text-align:center;word-wrap:break-word;word-break:break-word}.swal2-checkbox,.swal2-file,.swal2-input,.swal2-radio,.swal2-select,.swal2-textarea{margin:1em 2em 3px}.swal2-file,.swal2-input,.swal2-textarea{box-sizing:border-box;width:auto;transition:border-color .1s,box-shadow .1s;border:1px solid #d9d9d9;border-radius:.1875em;background:inherit;box-shadow:inset 0 1px 1px rgba(0,0,0,.06),0 0 0 3px transparent;color:inherit;font-size:1.125em}.swal2-file.swal2-inputerror,.swal2-input.swal2-inputerror,.swal2-textarea.swal2-inputerror{border-color:#f27474!important;box-shadow:0 0 2px #f27474!important}.swal2-file:focus,.swal2-input:focus,.swal2-textarea:focus{border:1px solid #b4dbed;outline:0;box-shadow:inset 0 1px 1px rgba(0,0,0,.06),0 0 0 3px rgba(100,150,200,.5)}.swal2-file::-moz-placeholder,.swal2-input::-moz-placeholder,.swal2-textarea::-moz-placeholder{color:#ccc}.swal2-file:-ms-input-placeholder,.swal2-input:-ms-input-placeholder,.swal2-textarea:-ms-input-placeholder{color:#ccc}.swal2-file::placeholder,.swal2-input::placeholder,.swal2-textarea::placeholder{color:#ccc}.swal2-range{margin:1em 2em 3px;background:#fff}.swal2-range input{width:80%}.swal2-range output{width:20%;color:inherit;font-weight:600;text-align:center}.swal2-range input,.swal2-range output{height:2.625em;padding:0;font-size:1.125em;line-height:2.625em}.swal2-input{height:2.625em;padding:0 .75em}.swal2-file{width:75%;margin-right:auto;margin-left:auto;background:inherit;font-size:1.125em}.swal2-textarea{height:6.75em;padding:.75em}.swal2-select{min-width:50%;max-width:100%;padding:.375em .625em;background:inherit;color:inherit;font-size:1.125em}.swal2-checkbox,.swal2-radio{align-items:center;justify-content:center;background:#fff;color:inherit}.swal2-checkbox label,.swal2-radio label{margin:0 .6em;font-size:1.125em}.swal2-checkbox input,.swal2-radio input{flex-shrink:0;margin:0 .4em}.swal2-input-label{display:flex;justify-content:center;margin:1em auto 0}.swal2-validation-message{align-items:center;justify-content:center;margin:1em 0 0;padding:.625em;overflow:hidden;background:#f0f0f0;color:#666;font-size:1em;font-weight:300}.swal2-validation-message::before{content:"!";display:inline-block;width:1.5em;min-width:1.5em;height:1.5em;margin:0 .625em;border-radius:50%;background-color:#f27474;color:#fff;font-weight:600;line-height:1.5em;text-align:center}.swal2-icon{position:relative;box-sizing:content-box;justify-content:center;width:5em;height:5em;margin:2.5em auto .6em;border:.25em solid transparent;border-radius:50%;border-color:#000;font-family:inherit;line-height:5em;cursor:default;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none}.swal2-icon .swal2-icon-content{display:flex;align-items:center;font-size:3.75em}.swal2-icon.swal2-error{border-color:#f27474;color:#f27474}.swal2-icon.swal2-error .swal2-x-mark{position:relative;flex-grow:1}.swal2-icon.swal2-error [class^=swal2-x-mark-line]{display:block;position:absolute;top:2.3125em;width:2.9375em;height:.3125em;border-radius:.125em;background-color:#f27474}.swal2-icon.swal2-error [class^=swal2-x-mark-line][class$=left]{left:1.0625em;transform:rotate(45deg)}.swal2-icon.swal2-error [class^=swal2-x-mark-line][class$=right]{right:1em;transform:rotate(-45deg)}.swal2-icon.swal2-error.swal2-icon-show{-webkit-animation:swal2-animate-error-icon .5s;animation:swal2-animate-error-icon .5s}.swal2-icon.swal2-error.swal2-icon-show .swal2-x-mark{-webkit-animation:swal2-animate-error-x-mark .5s;animation:swal2-animate-error-x-mark .5s}.swal2-icon.swal2-warning{border-color:#facea8;color:#f8bb86}.swal2-icon.swal2-warning.swal2-icon-show{-webkit-animation:swal2-animate-error-icon .5s;animation:swal2-animate-error-icon .5s}.swal2-icon.swal2-warning.swal2-icon-show .swal2-icon-content{-webkit-animation:swal2-animate-i-mark .5s;animation:swal2-animate-i-mark .5s}.swal2-icon.swal2-info{border-color:#9de0f6;color:#3fc3ee}.swal2-icon.swal2-info.swal2-icon-show{-webkit-animation:swal2-animate-error-icon .5s;animation:swal2-animate-error-icon .5s}.swal2-icon.swal2-info.swal2-icon-show .swal2-icon-content{-webkit-animation:swal2-animate-i-mark .8s;animation:swal2-animate-i-mark .8s}.swal2-icon.swal2-question{border-color:#c9dae1;color:#87adbd}.swal2-icon.swal2-question.swal2-icon-show{-webkit-animation:swal2-animate-error-icon .5s;animation:swal2-animate-error-icon .5s}.swal2-icon.swal2-question.swal2-icon-show .swal2-icon-content{-webkit-animation:swal2-animate-question-mark .8s;animation:swal2-animate-question-mark .8s}.swal2-icon.swal2-success{border-color:#a5dc86;color:#a5dc86}.swal2-icon.swal2-success [class^=swal2-success-circular-line]{position:absolute;width:3.75em;height:7.5em;transform:rotate(45deg);border-radius:50%}.swal2-icon.swal2-success [class^=swal2-success-circular-line][class$=left]{top:-.4375em;left:-2.0635em;transform:rotate(-45deg);transform-origin:3.75em 3.75em;border-radius:7.5em 0 0 7.5em}.swal2-icon.swal2-success [class^=swal2-success-circular-line][class$=right]{top:-.6875em;left:1.875em;transform:rotate(-45deg);transform-origin:0 3.75em;border-radius:0 7.5em 7.5em 0}.swal2-icon.swal2-success .swal2-success-ring{position:absolute;z-index:2;top:-.25em;left:-.25em;box-sizing:content-box;width:100%;height:100%;border:.25em solid rgba(165,220,134,.3);border-radius:50%}.swal2-icon.swal2-success .swal2-success-fix{position:absolute;z-index:1;top:.5em;left:1.625em;width:.4375em;height:5.625em;transform:rotate(-45deg)}.swal2-icon.swal2-success [class^=swal2-success-line]{display:block;position:absolute;z-index:2;height:.3125em;border-radius:.125em;background-color:#a5dc86}.swal2-icon.swal2-success [class^=swal2-success-line][class$=tip]{top:2.875em;left:.8125em;width:1.5625em;transform:rotate(45deg)}.swal2-icon.swal2-success [class^=swal2-success-line][class$=long]{top:2.375em;right:.5em;width:2.9375em;transform:rotate(-45deg)}.swal2-icon.swal2-success.swal2-icon-show .swal2-success-line-tip{-webkit-animation:swal2-animate-success-line-tip .75s;animation:swal2-animate-success-line-tip .75s}.swal2-icon.swal2-success.swal2-icon-show .swal2-success-line-long{-webkit-animation:swal2-animate-success-line-long .75s;animation:swal2-animate-success-line-long .75s}.swal2-icon.swal2-success.swal2-icon-show .swal2-success-circular-line-right{-webkit-animation:swal2-rotate-success-circular-line 4.25s ease-in;animation:swal2-rotate-success-circular-line 4.25s ease-in}.swal2-progress-steps{flex-wrap:wrap;align-items:center;max-width:100%;margin:1.25em auto;padding:0;background:inherit;font-weight:600}.swal2-progress-steps li{display:inline-block;position:relative}.swal2-progress-steps .swal2-progress-step{z-index:20;flex-shrink:0;width:2em;height:2em;border-radius:2em;background:#2778c4;color:#fff;line-height:2em;text-align:center}.swal2-progress-steps .swal2-progress-step.swal2-active-progress-step{background:#2778c4}.swal2-progress-steps .swal2-progress-step.swal2-active-progress-step~.swal2-progress-step{background:#add8e6;color:#fff}.swal2-progress-steps .swal2-progress-step.swal2-active-progress-step~.swal2-progress-step-line{background:#add8e6}.swal2-progress-steps .swal2-progress-step-line{z-index:10;flex-shrink:0;width:2.5em;height:.4em;margin:0 -1px;background:#2778c4}[class^=swal2]{-webkit-tap-highlight-color:transparent}.swal2-show{-webkit-animation:swal2-show .3s;animation:swal2-show .3s}.swal2-hide{-webkit-animation:swal2-hide .15s forwards;animation:swal2-hide .15s forwards}.swal2-noanimation{transition:none}.swal2-scrollbar-measure{position:absolute;top:-9999px;width:50px;height:50px;overflow:scroll}.swal2-rtl .swal2-close{margin-right:initial;margin-left:0}.swal2-rtl .swal2-timer-progress-bar{right:0;left:auto}@-webkit-keyframes swal2-toast-show{0%{transform:translateY(-.625em) rotateZ(2deg)}33%{transform:translateY(0) rotateZ(-2deg)}66%{transform:translateY(.3125em) rotateZ(2deg)}100%{transform:translateY(0) rotateZ(0)}}@keyframes swal2-toast-show{0%{transform:translateY(-.625em) rotateZ(2deg)}33%{transform:translateY(0) rotateZ(-2deg)}66%{transform:translateY(.3125em) rotateZ(2deg)}100%{transform:translateY(0) rotateZ(0)}}@-webkit-keyframes swal2-toast-hide{100%{transform:rotateZ(1deg);opacity:0}}@keyframes swal2-toast-hide{100%{transform:rotateZ(1deg);opacity:0}}@-webkit-keyframes swal2-toast-animate-success-line-tip{0%{top:.5625em;left:.0625em;width:0}54%{top:.125em;left:.125em;width:0}70%{top:.625em;left:-.25em;width:1.625em}84%{top:1.0625em;left:.75em;width:.5em}100%{top:1.125em;left:.1875em;width:.75em}}@keyframes swal2-toast-animate-success-line-tip{0%{top:.5625em;left:.0625em;width:0}54%{top:.125em;left:.125em;width:0}70%{top:.625em;left:-.25em;width:1.625em}84%{top:1.0625em;left:.75em;width:.5em}100%{top:1.125em;left:.1875em;width:.75em}}@-webkit-keyframes swal2-toast-animate-success-line-long{0%{top:1.625em;right:1.375em;width:0}65%{top:1.25em;right:.9375em;width:0}84%{top:.9375em;right:0;width:1.125em}100%{top:.9375em;right:.1875em;width:1.375em}}@keyframes swal2-toast-animate-success-line-long{0%{top:1.625em;right:1.375em;width:0}65%{top:1.25em;right:.9375em;width:0}84%{top:.9375em;right:0;width:1.125em}100%{top:.9375em;right:.1875em;width:1.375em}}@-webkit-keyframes swal2-show{0%{transform:scale(.7)}45%{transform:scale(1.05)}80%{transform:scale(.95)}100%{transform:scale(1)}}@keyframes swal2-show{0%{transform:scale(.7)}45%{transform:scale(1.05)}80%{transform:scale(.95)}100%{transform:scale(1)}}@-webkit-keyframes swal2-hide{0%{transform:scale(1);opacity:1}100%{transform:scale(.5);opacity:0}}@keyframes swal2-hide{0%{transform:scale(1);opacity:1}100%{transform:scale(.5);opacity:0}}@-webkit-keyframes swal2-animate-success-line-tip{0%{top:1.1875em;left:.0625em;width:0}54%{top:1.0625em;left:.125em;width:0}70%{top:2.1875em;left:-.375em;width:3.125em}84%{top:3em;left:1.3125em;width:1.0625em}100%{top:2.8125em;left:.8125em;width:1.5625em}}@keyframes swal2-animate-success-line-tip{0%{top:1.1875em;left:.0625em;width:0}54%{top:1.0625em;left:.125em;width:0}70%{top:2.1875em;left:-.375em;width:3.125em}84%{top:3em;left:1.3125em;width:1.0625em}100%{top:2.8125em;left:.8125em;width:1.5625em}}@-webkit-keyframes swal2-animate-success-line-long{0%{top:3.375em;right:2.875em;width:0}65%{top:3.375em;right:2.875em;width:0}84%{top:2.1875em;right:0;width:3.4375em}100%{top:2.375em;right:.5em;width:2.9375em}}@keyframes swal2-animate-success-line-long{0%{top:3.375em;right:2.875em;width:0}65%{top:3.375em;right:2.875em;width:0}84%{top:2.1875em;right:0;width:3.4375em}100%{top:2.375em;right:.5em;width:2.9375em}}@-webkit-keyframes swal2-rotate-success-circular-line{0%{transform:rotate(-45deg)}5%{transform:rotate(-45deg)}12%{transform:rotate(-405deg)}100%{transform:rotate(-405deg)}}@keyframes swal2-rotate-success-circular-line{0%{transform:rotate(-45deg)}5%{transform:rotate(-45deg)}12%{transform:rotate(-405deg)}100%{transform:rotate(-405deg)}}@-webkit-keyframes swal2-animate-error-x-mark{0%{margin-top:1.625em;transform:scale(.4);opacity:0}50%{margin-top:1.625em;transform:scale(.4);opacity:0}80%{margin-top:-.375em;transform:scale(1.15)}100%{margin-top:0;transform:scale(1);opacity:1}}@keyframes swal2-animate-error-x-mark{0%{margin-top:1.625em;transform:scale(.4);opacity:0}50%{margin-top:1.625em;transform:scale(.4);opacity:0}80%{margin-top:-.375em;transform:scale(1.15)}100%{margin-top:0;transform:scale(1);opacity:1}}@-webkit-keyframes swal2-animate-error-icon{0%{transform:rotateX(100deg);opacity:0}100%{transform:rotateX(0);opacity:1}}@keyframes swal2-animate-error-icon{0%{transform:rotateX(100deg);opacity:0}100%{transform:rotateX(0);opacity:1}}@-webkit-keyframes swal2-rotate-loading{0%{transform:rotate(0)}100%{transform:rotate(360deg)}}@keyframes swal2-rotate-loading{0%{transform:rotate(0)}100%{transform:rotate(360deg)}}@-webkit-keyframes swal2-animate-question-mark{0%{transform:rotateY(-360deg)}100%{transform:rotateY(0)}}@keyframes swal2-animate-question-mark{0%{transform:rotateY(-360deg)}100%{transform:rotateY(0)}}@-webkit-keyframes swal2-animate-i-mark{0%{transform:rotateZ(45deg);opacity:0}25%{transform:rotateZ(-25deg);opacity:.4}50%{transform:rotateZ(15deg);opacity:.8}75%{transform:rotateZ(-5deg);opacity:1}100%{transform:rotateX(0);opacity:1}}@keyframes swal2-animate-i-mark{0%{transform:rotateZ(45deg);opacity:0}25%{transform:rotateZ(-25deg);opacity:.4}50%{transform:rotateZ(15deg);opacity:.8}75%{transform:rotateZ(-5deg);opacity:1}100%{transform:rotateX(0);opacity:1}}body.swal2-shown:not(.swal2-no-backdrop):not(.swal2-toast-shown){overflow:hidden}body.swal2-height-auto{height:auto!important}body.swal2-no-backdrop .swal2-container{background-color:transparent!important;pointer-events:none}body.swal2-no-backdrop .swal2-container .swal2-popup{pointer-events:all}body.swal2-no-backdrop .swal2-container .swal2-modal{box-shadow:0 0 10px rgba(0,0,0,.4)}@media print{body.swal2-shown:not(.swal2-no-backdrop):not(.swal2-toast-shown){overflow-y:scroll!important}body.swal2-shown:not(.swal2-no-backdrop):not(.swal2-toast-shown)>[aria-hidden=true]{display:none}body.swal2-shown:not(.swal2-no-backdrop):not(.swal2-toast-shown) .swal2-container{position:static!important}}body.swal2-toast-shown .swal2-container{box-sizing:border-box;width:360px;max-width:100%;background-color:transparent;pointer-events:none}body.swal2-toast-shown .swal2-container.swal2-top{top:0;right:auto;bottom:auto;left:50%;transform:translateX(-50%)}body.swal2-toast-shown .swal2-container.swal2-top-end,body.swal2-toast-shown .swal2-container.swal2-top-right{top:0;right:0;bottom:auto;left:auto}body.swal2-toast-shown .swal2-container.swal2-top-left,body.swal2-toast-shown .swal2-container.swal2-top-start{top:0;right:auto;bottom:auto;left:0}body.swal2-toast-shown .swal2-container.swal2-center-left,body.swal2-toast-shown .swal2-container.swal2-center-start{top:50%;right:auto;bottom:auto;left:0;transform:translateY(-50%)}body.swal2-toast-shown .swal2-container.swal2-center{top:50%;right:auto;bottom:auto;left:50%;transform:translate(-50%,-50%)}body.swal2-toast-shown .swal2-container.swal2-center-end,body.swal2-toast-shown .swal2-container.swal2-center-right{top:50%;right:0;bottom:auto;left:auto;transform:translateY(-50%)}body.swal2-toast-shown .swal2-container.swal2-bottom-left,body.swal2-toast-shown .swal2-container.swal2-bottom-start{top:auto;right:auto;bottom:0;left:0}body.swal2-toast-shown .swal2-container.swal2-bottom{top:auto;right:auto;bottom:0;left:50%;transform:translateX(-50%)}body.swal2-toast-shown .swal2-container.swal2-bottom-end,body.swal2-toast-shown .swal2-container.swal2-bottom-right{top:auto;right:0;bottom:0;left:auto}@-webkit-keyframes notyf-fadeinup{0%{opacity:0;transform:translateY(25%)}to{opacity:1;transform:translateY(0)}}@keyframes notyf-fadeinup{0%{opacity:0;transform:translateY(25%)}to{opacity:1;transform:translateY(0)}}@-webkit-keyframes notyf-fadeinleft{0%{opacity:0;transform:translateX(25%)}to{opacity:1;transform:translateX(0)}}@keyframes notyf-fadeinleft{0%{opacity:0;transform:translateX(25%)}to{opacity:1;transform:translateX(0)}}@-webkit-keyframes notyf-fadeoutright{0%{opacity:1;transform:translateX(0)}to{opacity:0;transform:translateX(25%)}}@keyframes notyf-fadeoutright{0%{opacity:1;transform:translateX(0)}to{opacity:0;transform:translateX(25%)}}@-webkit-keyframes notyf-fadeoutdown{0%{opacity:1;transform:translateY(0)}to{opacity:0;transform:translateY(25%)}}@keyframes notyf-fadeoutdown{0%{opacity:1;transform:translateY(0)}to{opacity:0;transform:translateY(25%)}}@-webkit-keyframes ripple{0%{transform:scale(0) translateY(-45%) translateX(13%)}to{transform:scale(1) translateY(-45%) translateX(13%)}}@keyframes ripple{0%{transform:scale(0) translateY(-45%) translateX(13%)}to{transform:scale(1) translateY(-45%) translateX(13%)}}.notyf{position:fixed;top:0;left:0;height:100%;width:100%;color:#fff;z-index:9999;display:flex;flex-direction:column;align-items:flex-end;justify-content:flex-end;pointer-events:none;box-sizing:border-box;padding:20px}.notyf__icon--error,.notyf__icon--success{height:21px;width:21px;background:#fff;border-radius:50%;display:block;margin:0 auto;position:relative}.notyf__icon--error:after,.notyf__icon--error:before{content:"";background:currentColor;display:block;position:absolute;width:3px;border-radius:3px;left:9px;height:12px;top:5px}.notyf__icon--error:after{transform:rotate(-45deg)}.notyf__icon--error:before{transform:rotate(45deg)}.notyf__icon--success:after,.notyf__icon--success:before{content:"";background:currentColor;display:block;position:absolute;width:3px;border-radius:3px}.notyf__icon--success:after{height:6px;transform:rotate(-45deg);top:9px;left:6px}.notyf__icon--success:before{height:11px;transform:rotate(45deg);top:5px;left:10px}.notyf__toast{display:block;overflow:hidden;pointer-events:auto;-webkit-animation:notyf-fadeinup .3s ease-in forwards;animation:notyf-fadeinup .3s ease-in forwards;box-shadow:0 3px 7px 0 rgba(0,0,0,.25);position:relative;padding:0 15px;border-radius:2px;max-width:300px;transform:translateY(25%);box-sizing:border-box;flex-shrink:0}.notyf__toast--disappear{transform:translateY(0);-webkit-animation:notyf-fadeoutdown .3s forwards;animation:notyf-fadeoutdown .3s forwards;-webkit-animation-delay:.25s;animation-delay:.25s}.notyf__toast--disappear .notyf__icon,.notyf__toast--disappear .notyf__message{-webkit-animation:notyf-fadeoutdown .3s forwards;animation:notyf-fadeoutdown .3s forwards;opacity:1;transform:translateY(0)}.notyf__toast--disappear .notyf__dismiss{-webkit-animation:notyf-fadeoutright .3s forwards;animation:notyf-fadeoutright .3s forwards;opacity:1;transform:translateX(0)}.notyf__toast--disappear .notyf__message{-webkit-animation-delay:.05s;animation-delay:.05s}.notyf__toast--upper{margin-bottom:20px}.notyf__toast--lower{margin-top:20px}.notyf__toast--dismissible .notyf__wrapper{padding-right:30px}.notyf__ripple{height:400px;width:400px;position:absolute;transform-origin:bottom right;right:0;top:0;border-radius:50%;transform:scale(0) translateY(-51%) translateX(13%);z-index:5;-webkit-animation:ripple .4s ease-out forwards;animation:ripple .4s ease-out forwards}.notyf__wrapper{display:flex;align-items:center;padding-top:17px;padding-bottom:17px;padding-right:15px;border-radius:3px;position:relative;z-index:10}.notyf__icon{width:22px;text-align:center;font-size:1.3em;opacity:0;-webkit-animation:notyf-fadeinup .3s forwards;animation:notyf-fadeinup .3s forwards;-webkit-animation-delay:.3s;animation-delay:.3s;margin-right:13px}.notyf__dismiss{position:absolute;top:0;right:0;height:100%;width:26px;margin-right:-15px;-webkit-animation:notyf-fadeinleft .3s forwards;animation:notyf-fadeinleft .3s forwards;-webkit-animation-delay:.35s;animation-delay:.35s;opacity:0}.notyf__dismiss-btn{background-color:rgba(0,0,0,.25);border:none;cursor:pointer;transition:opacity .2s ease,background-color .2s ease;outline:none;opacity:.35;height:100%;width:100%}.notyf__dismiss-btn:after,.notyf__dismiss-btn:before{content:"";background:#fff;height:12px;width:2px;border-radius:3px;position:absolute;left:calc(50% - 1px);top:calc(50% - 5px)}.notyf__dismiss-btn:after{transform:rotate(-45deg)}.notyf__dismiss-btn:before{transform:rotate(45deg)}.notyf__dismiss-btn:hover{opacity:.7;background-color:rgba(0,0,0,.15)}.notyf__dismiss-btn:active{opacity:.8}.notyf__message{vertical-align:middle;position:relative;opacity:0;-webkit-animation:notyf-fadeinup .3s forwards;animation:notyf-fadeinup .3s forwards;-webkit-animation-delay:.25s;animation-delay:.25s;line-height:1.5em}@media only screen and (max-width:480px){.notyf{padding:0}.notyf__ripple{height:600px;width:600px;-webkit-animation-duration:.5s;animation-duration:.5s}.notyf__toast{max-width:none;border-radius:0;box-shadow:0 -2px 7px 0 rgba(0,0,0,.13);width:100%}.notyf__dismiss{width:56px}}
</style>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <title>Painel de Acesso</title>
</head>

<body>  <!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8">
 
  <title>Conecta4G - Login</title>
<style>
@charset "UTF-8";
/*

=========================================================
* Volt - Free Bootstrap 5 Dashboard
=========================================================

* Product Page: https://themesberg.com/product/admin-dashboard/volt-bootstrap-5-dashboard
* Copyright 2021 Themesberg (https://www.themesberg.com)

* Designed and coded by https://themesberg.com

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software. Please contact us to request a removal. Contact us if you want to remove it.

*/
@import url("https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap");

.datepicker {
    display: none;
}

.datepicker.active {
    display: block;
}

.datepicker-dropdown {
    position: absolute;
    top: 0;
    left: 0;
    z-index: 20;
    padding-top: 4px;
}

.datepicker-dropdown.datepicker-orient-top {
    padding-top: 0;
    padding-bottom: 4px;
}

.datepicker-picker {
    display: inline-block;
    border-radius: 4px;
    background-color: #ffffff;
}

.datepicker-dropdown .datepicker-picker {
    box-shadow: 0 2px 3px rgba(17, 24, 39, 0.1), 0 0 0 1px rgba(17, 24, 39, 0.1);
}

.datepicker-picker span {
    display: block;
    flex: 1;
    border: 0;
    border-radius: 4px;
    cursor: default;
    text-align: center;
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    user-select: none;
}

.datepicker-main {
    padding: 2px;
}

.datepicker-footer {
    box-shadow: inset 0 1px 1px rgba(17, 24, 39, 0.1);
    background-color: #9CA3AF;
}

.datepicker-grid, .datepicker-view .days-of-week, .datepicker-view, .datepicker-controls {
    display: flex;
}

.datepicker-grid {
    flex-wrap: wrap;
}

.datepicker-view .days .datepicker-cell, .datepicker-view .dow {
    flex-basis: 14.2857142857%;
}

.datepicker-view.datepicker-grid .datepicker-cell {
    flex-basis: 25%;
}

.datepicker-cell, .datepicker-view .week {
    height: 2.25rem;
    line-height: 2.25rem;
}

.datepicker-title {
    box-shadow: inset 0 -1px 1px rgba(17, 24, 39, 0.1);
    background-color: #9CA3AF;
    padding: 0.375rem 0.75rem;
    text-align: center;
    font-weight: 700;
}

.datepicker-header .datepicker-controls {
    padding: 2px 2px 0;
}

.datepicker-controls .button {
    display: inline-flex;
    position: relative;
    align-items: center;
    justify-content: center;
    margin: 0;
    border: 1px solid #808998;
    border-radius: 4px;
    box-shadow: none;
    background-color: #ffffff;
    cursor: pointer;
    padding: calc(0.375em - 1px) 0.75em;
    height: 2.25em;
    vertical-align: top;
    text-align: center;
    line-height: 1.5;
    white-space: nowrap;
    color: #1F2937;
    font-size: 1rem;
}

.datepicker-controls .button:focus, .datepicker-controls .button:active {
    outline: none;
}

.datepicker-controls .button:hover {
    border-color: #5b6371;
    color: #1F2937;
}

.datepicker-controls .button:focus {
    border-color: #3273dc;
    color: #1F2937;
}

.datepicker-controls .button:focus:not(:active) {
    box-shadow: 0 0 0 0.125em rgba(50, 115, 220, 0.25);
}

.datepicker-controls .button:active {
    border-color: #384f80;
    color: #1F2937;
}

.datepicker-controls .button[disabled] {
    cursor: not-allowed;
}

.datepicker-header .datepicker-controls .button {
    border-color: transparent;
    font-weight: bold;
}

.datepicker-header .datepicker-controls .button:hover {
    background-color: #f9f9f9;
}

.datepicker-header .datepicker-controls .button:focus:not(:active) {
    box-shadow: 0 0 0 0.125em rgba(255, 255, 255, 0.25);
}

.datepicker-header .datepicker-controls .button:active {
    background-color: #f2f2f2;
}

.datepicker-header .datepicker-controls .button[disabled] {
    box-shadow: none;
}

.datepicker-footer .datepicker-controls .button {
    margin: calc(0.375rem - 1px) 0.375rem;
    border-radius: 2px;
    width: 100%;
    font-size: 0.75rem;
}

.datepicker-controls .view-switch {
    flex: auto;
}

.datepicker-controls .prev-btn,
.datepicker-controls .next-btn {
    padding-right: 0.375rem;
    padding-left: 0.375rem;
    width: 2.25rem;
}

.datepicker-controls .prev-btn.disabled,
.datepicker-controls .next-btn.disabled {
    visibility: hidden;
}

.datepicker-view .dow {
    height: 1.5rem;
    line-height: 1.5rem;
    font-size: 0.875rem;
    font-weight: 700;
}

.datepicker-view .week {
    width: 2.25rem;
    color: #5b6371;
    font-size: 0.75rem;
}

@media (max-width: 22.5rem) {
    .datepicker-view .week {
        width: 1.96875rem;
    }
}

.datepicker-grid {
    width: 15.75rem;
}

@media (max-width: 22.5rem) {
    .calendar-weeks + .days .datepicker-grid {
        width: 13.78125rem;
    }
}

.datepicker-cell:not(.disabled):hover {
    background-color: #f9f9f9;
    cursor: pointer;
}

.datepicker-cell.focused:not(.selected) {
    background-color: #8e96a4;
}

.datepicker-cell.selected, .datepicker-cell.selected:hover {
    background-color: #3273dc;
    color: #fff;
    font-weight: 600;
}

.datepicker-cell.disabled {
    color: #808998;
}

.datepicker-cell.prev:not(.disabled), .datepicker-cell.next:not(.disabled) {
    color: #7a7a7a;
}

.datepicker-cell.prev.selected, .datepicker-cell.next.selected {
    color: #e6e6e6;
}

.datepicker-cell.highlighted:not(.selected):not(.range):not(.today) {
    border-radius: 0;
    background-color: #9CA3AF;
}

.datepicker-cell.highlighted:not(.selected):not(.range):not(.today):not(.disabled):hover {
    background-color: #959ca9;
}

.datepicker-cell.highlighted:not(.selected):not(.range):not(.today).focused {
    background-color: #8e96a4;
}

.datepicker-cell.today:not(.selected) {
    background-color: #00d1b2;
}

.datepicker-cell.today:not(.selected):not(.disabled) {
    color: #fff;
}

.datepicker-cell.today.focused:not(.selected) {
    background-color: #00c4a7;
}

.datepicker-cell.range-end:not(.selected), .datepicker-cell.range-start:not(.selected) {
    background-color: #5b6371;
    color: #fff;
}

.datepicker-cell.range-end.focused:not(.selected), .datepicker-cell.range-start.focused:not(.selected) {
    background-color: #555d69;
}

.datepicker-cell.range-start {
    border-radius: 4px 0 0 4px;
}

.datepicker-cell.range-end {
    border-radius: 0 4px 4px 0;
}

.datepicker-cell.range {
    border-radius: 0;
    background-color: #808998;
}

.datepicker-cell.range:not(.disabled):not(.focused):not(.today):hover {
    background-color: #798293;
}

.datepicker-cell.range.disabled {
    color: #666f7f;
}

.datepicker-cell.range.focused {
    background-color: #727c8d;
}

.datepicker-view.datepicker-grid .datepicker-cell {
    height: 4.5rem;
    line-height: 4.5rem;
}

.datepicker-input.in-edit {
    border-color: #2366d1;
}

.datepicker-input.in-edit:focus, .datepicker-input.in-edit:active {
    box-shadow: 0 0 0.25em 0.25em rgba(35, 102, 209, 0.2);
}

.ct-label {
    fill: rgba(0, 0, 0, 0.4);
    color: rgba(0, 0, 0, 0.4);
    font-size: 0.75rem;
    line-height: 1;
}

.ct-chart-line .ct-label,
.ct-chart-bar .ct-label {
    display: block;
    display: flex;
}

.ct-chart-pie .ct-label,
.ct-chart-donut .ct-label {
    dominant-baseline: central;
}

.ct-label.ct-horizontal.ct-start {
    align-items: flex-end;
    justify-content: flex-start;
    text-align: left;
    text-anchor: start;
}

.ct-label.ct-horizontal.ct-end {
    align-items: flex-start;
    justify-content: flex-start;
    text-align: left;
    text-anchor: start;
}

.ct-label.ct-vertical.ct-start {
    align-items: flex-end;
    justify-content: flex-end;
    text-align: right;
    text-anchor: end;
}

.ct-label.ct-vertical.ct-end {
    align-items: flex-end;
    justify-content: flex-start;
    text-align: left;
    text-anchor: start;
}

.ct-chart-bar .ct-label.ct-horizontal.ct-start {
    align-items: flex-end;
    justify-content: center;
    text-align: center;
    text-anchor: start;
}

.ct-chart-bar .ct-label.ct-horizontal.ct-end {
    align-items: flex-start;
    justify-content: center;
    text-align: center;
    text-anchor: start;
}

.ct-chart-bar.ct-horizontal-bars .ct-label.ct-horizontal.ct-start {
    align-items: flex-end;
    justify-content: flex-start;
    text-align: left;
    text-anchor: start;
}

.ct-chart-bar.ct-horizontal-bars .ct-label.ct-horizontal.ct-end {
    align-items: flex-start;
    justify-content: flex-start;
    text-align: left;
    text-anchor: start;
}

.ct-chart-bar.ct-horizontal-bars .ct-label.ct-vertical.ct-start {
    align-items: center;
    justify-content: flex-end;
    text-align: right;
    text-anchor: end;
}

.ct-chart-bar.ct-horizontal-bars .ct-label.ct-vertical.ct-end {
    align-items: center;
    justify-content: flex-start;
    text-align: left;
    text-anchor: end;
}

.ct-grid {
    stroke: rgba(0, 0, 0, 0.2);
    stroke-width: 1px;
    stroke-dasharray: 2px;
}

.ct-grid-background {
    fill: none;
}

.ct-point {
    stroke-width: 10px;
    stroke-linecap: round;
}

.ct-line {
    fill: none;
    stroke-width: 4px;
}

.ct-area {
    stroke: none;
    fill-opacity: 0.1;
}

.ct-bar {
    fill: none;
    stroke-width: 10px;
}

.ct-slice-donut {
    fill: none;
    stroke-width: 60px;
}

.ct-series-a .ct-point, .ct-series-a .ct-line, .ct-series-a .ct-bar, .ct-series-a .ct-slice-donut {
    stroke: #262B40;
}

.ct-series-a .ct-slice-pie, .ct-series-a .ct-slice-donut-solid, .ct-series-a .ct-area {
    fill: #262B40;
}

.ct-series-b .ct-point, .ct-series-b .ct-line, .ct-series-b .ct-bar, .ct-series-b .ct-slice-donut {
    stroke: #F8BD7A;
}

.ct-series-b .ct-slice-pie, .ct-series-b .ct-slice-donut-solid, .ct-series-b .ct-area {
    fill: #F8BD7A;
}

.ct-series-c .ct-point, .ct-series-c .ct-line, .ct-series-c .ct-bar, .ct-series-c .ct-slice-donut {
    stroke: #2CA58D;
}

.ct-series-c .ct-slice-pie, .ct-series-c .ct-slice-donut-solid, .ct-series-c .ct-area {
    fill: #2CA58D;
}

.ct-series-d .ct-point, .ct-series-d .ct-line, .ct-series-d .ct-bar, .ct-series-d .ct-slice-donut {
    stroke: #31316A;
}

.ct-series-d .ct-slice-pie, .ct-series-d .ct-slice-donut-solid, .ct-series-d .ct-area {
    fill: #31316A;
}

.ct-series-e .ct-point, .ct-series-e .ct-line, .ct-series-e .ct-bar, .ct-series-e .ct-slice-donut {
    stroke: #C96480;
}

.ct-series-e .ct-slice-pie, .ct-series-e .ct-slice-donut-solid, .ct-series-e .ct-area {
    fill: #C96480;
}

.ct-series-f .ct-point, .ct-series-f .ct-line, .ct-series-f .ct-bar, .ct-series-f .ct-slice-donut {
    stroke: #ffffff;
}

.ct-series-f .ct-slice-pie, .ct-series-f .ct-slice-donut-solid, .ct-series-f .ct-area {
    fill: #ffffff;
}

.ct-series-g .ct-point, .ct-series-g .ct-line, .ct-series-g .ct-bar, .ct-series-g .ct-slice-donut {
    stroke: #F8BD7A;
}

.ct-series-g .ct-slice-pie, .ct-series-g .ct-slice-donut-solid, .ct-series-g .ct-area {
    fill: #F8BD7A;
}

.ct-square {
    display: block;
    position: relative;
    width: 100%;
}

.ct-square:before {
    display: block;
    float: left;
    content: "";
    width: 0;
    height: 0;
    padding-bottom: 100%;
}

.ct-square:after {
    content: "";
    display: table;
    clear: both;
}

.ct-square > svg {
    display: block;
    position: absolute;
    top: 0;
    left: 0;
}

.ct-minor-second {
    display: block;
    position: relative;
    width: 100%;
}

.ct-minor-second:before {
    display: block;
    float: left;
    content: "";
    width: 0;
    height: 0;
    padding-bottom: 93.75%;
}

.ct-minor-second:after {
    content: "";
    display: table;
    clear: both;
}

.ct-minor-second > svg {
    display: block;
    position: absolute;
    top: 0;
    left: 0;
}

.ct-major-second {
    display: block;
    position: relative;
    width: 100%;
}

.ct-major-second:before {
    display: block;
    float: left;
    content: "";
    width: 0;
    height: 0;
    padding-bottom: 88.8888888889%;
}

.ct-major-second:after {
    content: "";
    display: table;
    clear: both;
}

.ct-major-second > svg {
    display: block;
    position: absolute;
    top: 0;
    left: 0;
}

.ct-minor-third {
    display: block;
    position: relative;
    width: 100%;
}

.ct-minor-third:before {
    display: block;
    float: left;
    content: "";
    width: 0;
    height: 0;
    padding-bottom: 83.3333333333%;
}

.ct-minor-third:after {
    content: "";
    display: table;
    clear: both;
}

.ct-minor-third > svg {
    display: block;
    position: absolute;
    top: 0;
    left: 0;
}

.ct-major-third {
    display: block;
    position: relative;
    width: 100%;
}

.ct-major-third:before {
    display: block;
    float: left;
    content: "";
    width: 0;
    height: 0;
    padding-bottom: 80%;
}

.ct-major-third:after {
    content: "";
    display: table;
    clear: both;
}

.ct-major-third > svg {
    display: block;
    position: absolute;
    top: 0;
    left: 0;
}

.ct-perfect-fourth {
    display: block;
    position: relative;
    width: 100%;
}

.ct-perfect-fourth:before {
    display: block;
    float: left;
    content: "";
    width: 0;
    height: 0;
    padding-bottom: 75%;
}

.ct-perfect-fourth:after {
    content: "";
    display: table;
    clear: both;
}

.ct-perfect-fourth > svg {
    display: block;
    position: absolute;
    top: 0;
    left: 0;
}

.ct-perfect-fifth {
    display: block;
    position: relative;
    width: 100%;
}

.ct-perfect-fifth:before {
    display: block;
    float: left;
    content: "";
    width: 0;
    height: 0;
    padding-bottom: 66.6666666667%;
}

.ct-perfect-fifth:after {
    content: "";
    display: table;
    clear: both;
}

.ct-perfect-fifth > svg {
    display: block;
    position: absolute;
    top: 0;
    left: 0;
}

.ct-minor-sixth {
    display: block;
    position: relative;
    width: 100%;
}

.ct-minor-sixth:before {
    display: block;
    float: left;
    content: "";
    width: 0;
    height: 0;
    padding-bottom: 62.5%;
}

.ct-minor-sixth:after {
    content: "";
    display: table;
    clear: both;
}

.ct-minor-sixth > svg {
    display: block;
    position: absolute;
    top: 0;
    left: 0;
}

.ct-golden-section {
    display: block;
    position: relative;
    width: 100%;
}

.ct-golden-section:before {
    display: block;
    float: left;
    content: "";
    width: 0;
    height: 0;
    padding-bottom: 61.804697157%;
}

.ct-golden-section:after {
    content: "";
    display: table;
    clear: both;
}

.ct-golden-section > svg {
    display: block;
    position: absolute;
    top: 0;
    left: 0;
}

.ct-major-sixth {
    display: block;
    position: relative;
    width: 100%;
}

.ct-major-sixth:before {
    display: block;
    float: left;
    content: "";
    width: 0;
    height: 0;
    padding-bottom: 60%;
}

.ct-major-sixth:after {
    content: "";
    display: table;
    clear: both;
}

.ct-major-sixth > svg {
    display: block;
    position: absolute;
    top: 0;
    left: 0;
}

.ct-minor-seventh {
    display: block;
    position: relative;
    width: 100%;
}

.ct-minor-seventh:before {
    display: block;
    float: left;
    content: "";
    width: 0;
    height: 0;
    padding-bottom: 56.25%;
}

.ct-minor-seventh:after {
    content: "";
    display: table;
    clear: both;
}

.ct-minor-seventh > svg {
    display: block;
    position: absolute;
    top: 0;
    left: 0;
}

.ct-major-seventh {
    display: block;
    position: relative;
    width: 100%;
}

.ct-major-seventh:before {
    display: block;
    float: left;
    content: "";
    width: 0;
    height: 0;
    padding-bottom: 53.3333333333%;
}

.ct-major-seventh:after {
    content: "";
    display: table;
    clear: both;
}

.ct-major-seventh > svg {
    display: block;
    position: absolute;
    top: 0;
    left: 0;
}

.ct-octave {
    display: block;
    position: relative;
    width: 100%;
}

.ct-octave:before {
    display: block;
    float: left;
    content: "";
    width: 0;
    height: 0;
    padding-bottom: 50%;
}

.ct-octave:after {
    content: "";
    display: table;
    clear: both;
}

.ct-octave > svg {
    display: block;
    position: absolute;
    top: 0;
    left: 0;
}

.ct-major-tenth {
    display: block;
    position: relative;
    width: 100%;
}

.ct-major-tenth:before {
    display: block;
    float: left;
    content: "";
    width: 0;
    height: 0;
    padding-bottom: 40%;
}

.ct-major-tenth:after {
    content: "";
    display: table;
    clear: both;
}

.ct-major-tenth > svg {
    display: block;
    position: absolute;
    top: 0;
    left: 0;
}

.ct-major-eleventh {
    display: block;
    position: relative;
    width: 100%;
}

.ct-major-eleventh:before {
    display: block;
    float: left;
    content: "";
    width: 0;
    height: 0;
    padding-bottom: 37.5%;
}

.ct-major-eleventh:after {
    content: "";
    display: table;
    clear: both;
}

.ct-major-eleventh > svg {
    display: block;
    position: absolute;
    top: 0;
    left: 0;
}

.ct-major-twelfth {
    display: block;
    position: relative;
    width: 100%;
}

.ct-major-twelfth:before {
    display: block;
    float: left;
    content: "";
    width: 0;
    height: 0;
    padding-bottom: 33.3333333333%;
}

.ct-major-twelfth:after {
    content: "";
    display: table;
    clear: both;
}

.ct-major-twelfth > svg {
    display: block;
    position: absolute;
    top: 0;
    left: 0;
}

.ct-double-octave {
    display: block;
    position: relative;
    width: 100%;
}

.ct-double-octave:before {
    display: block;
    float: left;
    content: "";
    width: 0;
    height: 0;
    padding-bottom: 25%;
}

.ct-double-octave:after {
    content: "";
    display: table;
    clear: both;
}

.ct-double-octave > svg {
    display: block;
    position: absolute;
    top: 0;
    left: 0;
}

:root {
    --bs-blue: #2361ce;
    --bs-indigo: #4F46E5;
    --bs-purple: #7C3AED;
    --bs-pink: #EF4683;
    --bs-red: #E11D48;
    --bs-orange: #FBA918;
    --bs-yellow: #f3c78e;
    --bs-green: #10B981;
    --bs-teal: #1E90FF;
    --bs-cyan: #63b1bd;
    --bs-white: #ffffff;
    --bs-gray: #4B5563;
    --bs-gray-dark: #1F2937;
    --bs-gray-100: #F2F4F6;
    --bs-gray-200: #E5E7EB;
    --bs-gray-300: #D1D5DB;
    --bs-gray-400: #9CA3AF;
    --bs-gray-500: #6B7280;
    --bs-gray-600: #4B5563;
    --bs-gray-700: #374151;
    --bs-gray-800: #1F2937;
    --bs-gray-900: #111827;
    --bs-primary: #1F2937;
    --bs-secondary: #f0bc74;
    --bs-tertiary: #31316A;
    --bs-success: #10B981;
    --bs-info: #2361ce;
    --bs-warning: #f3c78e;
    --bs-danger: #E11D48;
    --bs-white: #ffffff;
    --bs-indigo: #4F46E5;
    --bs-purple: #7C3AED;
    --bs-yellow-100: #ffeed6;
    --bs-yellow-200: #f5dbb8;
    --bs-gray-50: #F9FAFB;
    --bs-gray-100: #F2F4F6;
    --bs-gray-200: #E5E7EB;
    --bs-gray-300: #D1D5DB;
    --bs-gray-400: #9CA3AF;
    --bs-gray-500: #6B7280;
    --bs-gray-600: #4B5563;
    --bs-gray-700: #374151;
    --bs-gray-800: #1F2937;
    --bs-gray-900: #111827;
    --bs-primary-rgb: 31, 41, 55;
    --bs-secondary-rgb: 240, 188, 116;
    --bs-tertiary-rgb: 49, 49, 106;
    --bs-success-rgb: 16, 185, 129;
    --bs-info-rgb: 35, 97, 206;
    --bs-warning-rgb: 243, 199, 142;
    --bs-danger-rgb: 225, 29, 72;
    --bs-white-rgb: 255, 255, 255;
    --bs-indigo-rgb: 79, 70, 229;
    --bs-purple-rgb: 124, 58, 237;
    --bs-yellow-100-rgb: 255, 238, 214;
    --bs-yellow-200-rgb: 245, 219, 184;
    --bs-gray-50-rgb: 249, 250, 251;
    --bs-gray-100-rgb: 242, 244, 246;
    --bs-gray-200-rgb: 229, 231, 235;
    --bs-gray-300-rgb: 209, 213, 219;
    --bs-gray-400-rgb: 156, 163, 175;
    --bs-gray-500-rgb: 107, 114, 128;
    --bs-gray-600-rgb: 75, 85, 99;
    --bs-gray-700-rgb: 55, 65, 81;
    --bs-gray-800-rgb: 31, 41, 55;
    --bs-gray-900-rgb: 17, 24, 39;
    --bs-white-rgb: 255, 255, 255;
    --bs-black-rgb: 17, 24, 39;
    --bs-body-color-rgb: 55, 65, 81;
    --bs-body-bg-rgb: 242, 244, 246;
    --bs-font-sans-serif: "Inter", sans-serif;
    --bs-font-monospace: SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
    --bs-gradient: linear-gradient(180deg, rgba(255, 255, 255, 0.15), rgba(255, 255, 255, 0));
    --bs-body-font-family: var(--bs-font-sans-serif);
    --bs-body-font-size: 1rem;
    --bs-body-font-weight: 400;
    --bs-body-line-height: 1.5;
    --bs-body-color: #374151;
    --bs-body-bg: #F2F4F6;
}

*,
*::before,
*::after {
    box-sizing: border-box;
}

@media (prefers-reduced-motion: no-preference) {
    :root {
        scroll-behavior: smooth;
    }
}

body {
    margin: 0;
    font-family: var(--bs-body-font-family);
    font-size: var(--bs-body-font-size);
    font-weight: var(--bs-body-font-weight);
    line-height: var(--bs-body-line-height);
    color: var(--bs-body-color);
    text-align: var(--bs-body-text-align);
    background-color: var(--bs-body-bg);
    -webkit-text-size-adjust: 100%;
    -webkit-tap-highlight-color: rgba(17, 24, 39, 0);
}

hr {
    margin: 1rem 0;
    color: inherit;
    background-color: currentColor;
    border: 0;
    opacity: 0.25;
}

hr:not([size]) {
    height: 0.0625rem;
}

h6, .h6, h5, .h5, h4, .h4, h3, .h3, h2, .h2, h1, .h1 {
    margin-top: 0;
    margin-bottom: 0.5rem;
    font-weight: 500;
    line-height: 1.3;
    color: #1F2937;
}

h1, .h1 {
    font-size: calc(1.375rem + 1.5vw);
}

@media (min-width: 1200px) {
    h1, .h1 {
        font-size: 2.5rem;
    }
}

h2, .h2 {
    font-size: calc(1.325rem + 0.9vw);
}

@media (min-width: 1200px) {
    h2, .h2 {
        font-size: 2rem;
    }
}

h3, .h3 {
    font-size: calc(1.3rem + 0.6vw);
}

@media (min-width: 1200px) {
    h3, .h3 {
        font-size: 1.75rem;
    }
}

h4, .h4 {
    font-size: calc(1.275rem + 0.3vw);
}

@media (min-width: 1200px) {
    h4, .h4 {
        font-size: 1.5rem;
    }
}

h5, .h5 {
    font-size: 1.25rem;
}

h6, .h6 {
    font-size: 1rem;
}

p {
    margin-top: 0;
    margin-bottom: 1rem;
}

abbr[title],
abbr[data-bs-original-title] {
    -webkit-text-decoration: underline dotted;
    text-decoration: underline dotted;
    cursor: help;
    -webkit-text-decoration-skip-ink: none;
    text-decoration-skip-ink: none;
}

address {
    margin-bottom: 1rem;
    font-style: normal;
    line-height: inherit;
}

ol,
ul {
    padding-left: 2rem;
}

ol,
ul,
dl {
    margin-top: 0;
    margin-bottom: 1rem;
}

ol ol,
ul ul,
ol ul,
ul ol {
    margin-bottom: 0;
}

dt {
    font-weight: 500;
}

dd {
    margin-bottom: 0.5rem;
    margin-left: 0;
}

blockquote {
    margin: 0 0 1rem;
}

b,
strong {
    font-weight: 600;
}

small, .small {
    font-size: 0.875em;
}

mark, .mark {
    padding: 0.2em;
    background-color: #fcf8e3;
}

sub,
sup {
    position: relative;
    font-size: 0.75em;
    line-height: 0;
    vertical-align: baseline;
}

sub {
    bottom: -0.25em;
}

sup {
    top: -0.5em;
}

a {
    color: #1F2937;
    text-decoration: none;
}

a:hover {
    color: black;
    text-decoration: none;
}

a:not([href]):not([class]), a:not([href]):not([class]):hover {
    color: inherit;
    text-decoration: none;
}

pre,
code,
kbd,
samp {
    font-family: var(--bs-font-monospace);
    font-size: 1em;
    direction: ltr /* rtl:ignore */;
    unicode-bidi: bidi-override;
}

pre {
    display: block;
    margin-top: 0;
    margin-bottom: 1rem;
    overflow: auto;
    font-size: 0.875em;
}

pre code {
    font-size: inherit;
    color: inherit;
    word-break: normal;
}

code {
    font-size: 0.875em;
    color: #EF4683;
    word-wrap: break-word;
}

a > code {
    color: inherit;
}

kbd {
    padding: 0.2rem 0.4rem;
    font-size: 0.875em;
    color: #ffffff;
    background-color: #111827;
    border-radius: 0.35rem;
}

kbd kbd {
    padding: 0;
    font-size: 1em;
    font-weight: 500;
}

figure {
    margin: 0 0 1rem;
}

img,
svg {
    vertical-align: middle;
}

table {
    caption-side: bottom;
    border-collapse: collapse;
}

caption {
    padding-top: 0.75rem;
    padding-bottom: 0.75rem;
    color: #58677d;
    text-align: left;
}

th {
    text-align: inherit;
    text-align: -webkit-match-parent;
}

thead,
tbody,
tfoot,
tr,
td,
th {
    border-color: inherit;
    border-style: solid;
    border-width: 0;
}

label {
    display: inline-block;
}

button {
    border-radius: 0;
}

button:focus:not(:focus-visible) {
    outline: 0;
}

input,
button,
select,
optgroup,
textarea {
    margin: 0;
    font-family: inherit;
    font-size: inherit;
    line-height: inherit;
}

button,
select {
    text-transform: none;
}

[role=button] {
    cursor: pointer;
}

select {
    word-wrap: normal;
}

select:disabled {
    opacity: 1;
}

[list]::-webkit-calendar-picker-indicator {
    display: none;
}

button,
[type=button],
[type=reset],
[type=submit] {
    -webkit-appearance: button;
}

button:not(:disabled),
[type=button]:not(:disabled),
[type=reset]:not(:disabled),
[type=submit]:not(:disabled) {
    cursor: pointer;
}

::-moz-focus-inner {
    padding: 0;
    border-style: none;
}

textarea {
    resize: vertical;
}

fieldset {
    min-width: 0;
    padding: 0;
    margin: 0;
    border: 0;
}

legend {
    float: left;
    width: 100%;
    padding: 0;
    margin-bottom: 0.5rem;
    font-size: calc(1.275rem + 0.3vw);
    line-height: inherit;
}

@media (min-width: 1200px) {
    legend {
        font-size: 1.5rem;
    }
}

legend + * {
    clear: left;
}

::-webkit-datetime-edit-fields-wrapper,
::-webkit-datetime-edit-text,
::-webkit-datetime-edit-minute,
::-webkit-datetime-edit-hour-field,
::-webkit-datetime-edit-day-field,
::-webkit-datetime-edit-month-field,
::-webkit-datetime-edit-year-field {
    padding: 0;
}

::-webkit-inner-spin-button {
    height: auto;
}

[type=search] {
    outline-offset: -2px;
    -webkit-appearance: textfield;
}

/* rtl:raw:
[type="tel"],
[type="url"],
[type="email"],
[type="number"] {
  direction: ltr;
}
*/
::-webkit-search-decoration {
    -webkit-appearance: none;
}

::-webkit-color-swatch-wrapper {
    padding: 0;
}

::file-selector-button {
    font: inherit;
}

::-webkit-file-upload-button {
    font: inherit;
    -webkit-appearance: button;
}

output {
    display: inline-block;
}

iframe {
    border: 0;
}

summary {
    display: list-item;
    cursor: pointer;
}

progress {
    vertical-align: baseline;
}

[hidden] {
    display: none !important;
}

.lead {
    font-size: 1.25rem;
    font-weight: 300;
}

.display-1 {
    font-size: calc(1.625rem + 4.5vw);
    font-weight: 500;
    line-height: 1.3;
}

@media (min-width: 1200px) {
    .display-1 {
        font-size: 5rem;
    }
}

.display-2 {
    font-size: calc(1.475rem + 2.7vw);
    font-weight: 500;
    line-height: 1.3;
}

@media (min-width: 1200px) {
    .display-2 {
        font-size: 3.5rem;
    }
}

.display-3 {
    font-size: calc(1.375rem + 1.5vw);
    font-weight: 500;
    line-height: 1.3;
}

@media (min-width: 1200px) {
    .display-3 {
        font-size: 2.5rem;
    }
}

.display-4 {
    font-size: calc(1.3125rem + 0.75vw);
    font-weight: 500;
    line-height: 1.3;
}

@media (min-width: 1200px) {
    .display-4 {
        font-size: 1.875rem;
    }
}

.display-5 {
    font-size: 1.2rem;
    font-weight: 500;
    line-height: 1.3;
}

.display-6 {
    font-size: 1rem;
    font-weight: 500;
    line-height: 1.3;
}

.list-unstyled {
    padding-left: 0;
    list-style: none;
}

.list-inline {
    padding-left: 0;
    list-style: none;
}

.list-inline-item {
    display: inline-block;
}

.list-inline-item:not(:last-child) {
    margin-right: 0.5rem;
}

.initialism {
    font-size: 0.875em;
    text-transform: uppercase;
}

.blockquote {
    margin-bottom: 1rem;
    font-size: 1.25rem;
}

.blockquote > :last-child {
    margin-bottom: 0;
}

.blockquote-footer {
    margin-top: -1rem;
    margin-bottom: 1rem;
    font-size: 0.875em;
    color: #4B5563;
}

.blockquote-footer::before {
    content: "— ";
}

.img-fluid {
    max-width: 100%;
    height: auto;
}

.img-thumbnail {
    padding: 0.25rem;
    background-color: #F2F4F6;
    border: 0.0625rem solid #D1D5DB;
    border-radius: 0.5rem;
    box-shadow: 0 2px 5px rgba(140, 152, 164, 0.2);
    max-width: 100%;
    height: auto;
}

.figure {
    display: inline-block;
}

.figure-img {
    margin-bottom: 0.5rem;
    line-height: 1;
}

.figure-caption {
    font-size: 0.875em;
    color: #4B5563;
}

.container,
.container-fluid,
.container-xl,
.container-lg,
.container-md,
.container-sm {
    width: 100%;
    padding-right: var(--bs-gutter-x, 1rem);
    padding-left: var(--bs-gutter-x, 1rem);
    margin-right: auto;
    margin-left: auto;
}

@media (min-width: 576px) {
    .container-sm, .container {
        max-width: 540px;
    }
}

@media (min-width: 768px) {
    .container-md, .container-sm, .container {
        max-width: 720px;
    }
}

@media (min-width: 992px) {
    .container-lg, .container-md, .container-sm, .container {
        max-width: 960px;
    }
}

@media (min-width: 1200px) {
    .container-xl, .container-lg, .container-md, .container-sm, .container {
        max-width: 1140px;
    }
}

.row {
    --bs-gutter-x: 1.5rem;
    --bs-gutter-y: 0;
    display: flex;
    flex-wrap: wrap;
    margin-top: calc(-1 * var(--bs-gutter-y));
    margin-right: calc(-0.5 * var(--bs-gutter-x));
    margin-left: calc(-0.5 * var(--bs-gutter-x));
}

.row > * {
    flex-shrink: 0;
    width: 100%;
    max-width: 100%;
    padding-right: calc(var(--bs-gutter-x) * 0.5);
    padding-left: calc(var(--bs-gutter-x) * 0.5);
    margin-top: var(--bs-gutter-y);
}

.col {
    flex: 1 0 0%;
}

.row-cols-auto > * {
    flex: 0 0 auto;
    width: auto;
}

.row-cols-1 > * {
    flex: 0 0 auto;
    width: 100%;
}

.row-cols-2 > * {
    flex: 0 0 auto;
    width: 50%;
}

.row-cols-3 > * {
    flex: 0 0 auto;
    width: 33.3333333333%;
}

.row-cols-4 > * {
    flex: 0 0 auto;
    width: 25%;
}

.row-cols-5 > * {
    flex: 0 0 auto;
    width: 20%;
}

.row-cols-6 > * {
    flex: 0 0 auto;
    width: 16.6666666667%;
}

.col-auto {
    flex: 0 0 auto;
    width: auto;
}

.col-1 {
    flex: 0 0 auto;
    width: 8.33333333%;
}

.col-2 {
    flex: 0 0 auto;
    width: 16.66666667%;
}

.col-3 {
    flex: 0 0 auto;
    width: 25%;
}

.col-4 {
    flex: 0 0 auto;
    width: 33.33333333%;
}

.col-5 {
    flex: 0 0 auto;
    width: 41.66666667%;
}

.col-6 {
    flex: 0 0 auto;
    width: 50%;
}

.col-7 {
    flex: 0 0 auto;
    width: 58.33333333%;
}

.col-8 {
    flex: 0 0 auto;
    width: 66.66666667%;
}

.col-9 {
    flex: 0 0 auto;
    width: 75%;
}

.col-10 {
    flex: 0 0 auto;
    width: 83.33333333%;
}

.col-11 {
    flex: 0 0 auto;
    width: 91.66666667%;
}

.col-12 {
    flex: 0 0 auto;
    width: 100%;
}

.offset-1 {
    margin-left: 8.33333333%;
}

.offset-2 {
    margin-left: 16.66666667%;
}

.offset-3 {
    margin-left: 25%;
}

.offset-4 {
    margin-left: 33.33333333%;
}

.offset-5 {
    margin-left: 41.66666667%;
}

.offset-6 {
    margin-left: 50%;
}

.offset-7 {
    margin-left: 58.33333333%;
}

.offset-8 {
    margin-left: 66.66666667%;
}

.offset-9 {
    margin-left: 75%;
}

.offset-10 {
    margin-left: 83.33333333%;
}

.offset-11 {
    margin-left: 91.66666667%;
}

.g-0,
.gx-0 {
    --bs-gutter-x: 0;
}

.g-0,
.gy-0 {
    --bs-gutter-y: 0;
}

.g-1,
.gx-1 {
    --bs-gutter-x: 0.25rem;
}

.g-1,
.gy-1 {
    --bs-gutter-y: 0.25rem;
}

.g-2,
.gx-2 {
    --bs-gutter-x: 0.5rem;
}

.g-2,
.gy-2 {
    --bs-gutter-y: 0.5rem;
}

.g-3,
.gx-3 {
    --bs-gutter-x: 1rem;
}

.g-3,
.gy-3 {
    --bs-gutter-y: 1rem;
}

.g-4,
.gx-4 {
    --bs-gutter-x: 1.5rem;
}

.g-4,
.gy-4 {
    --bs-gutter-y: 1.5rem;
}

.g-5,
.gx-5 {
    --bs-gutter-x: 3rem;
}

.g-5,
.gy-5 {
    --bs-gutter-y: 3rem;
}

.g-6,
.gx-6 {
    --bs-gutter-x: 5rem;
}

.g-6,
.gy-6 {
    --bs-gutter-y: 5rem;
}

.g-7,
.gx-7 {
    --bs-gutter-x: 8rem;
}

.g-7,
.gy-7 {
    --bs-gutter-y: 8rem;
}

.g-8,
.gx-8 {
    --bs-gutter-x: 10rem;
}

.g-8,
.gy-8 {
    --bs-gutter-y: 10rem;
}

.g-9,
.gx-9 {
    --bs-gutter-x: 11rem;
}

.g-9,
.gy-9 {
    --bs-gutter-y: 11rem;
}

.g-10,
.gx-10 {
    --bs-gutter-x: 14rem;
}

.g-10,
.gy-10 {
    --bs-gutter-y: 14rem;
}

.g-11,
.gx-11 {
    --bs-gutter-x: 16rem;
}

.g-11,
.gy-11 {
    --bs-gutter-y: 16rem;
}

.g-12,
.gx-12 {
    --bs-gutter-x: 20rem;
}

.g-12,
.gy-12 {
    --bs-gutter-y: 20rem;
}

.g-sm,
.gx-sm {
    --bs-gutter-x: 1rem;
}

.g-sm,
.gy-sm {
    --bs-gutter-y: 1rem;
}

.g-md,
.gx-md {
    --bs-gutter-x: 2rem;
}

.g-md,
.gy-md {
    --bs-gutter-y: 2rem;
}

.g-lg,
.gx-lg {
    --bs-gutter-x: 4rem;
}

.g-lg,
.gy-lg {
    --bs-gutter-y: 4rem;
}

.g-xl,
.gx-xl {
    --bs-gutter-x: 8rem;
}

.g-xl,
.gy-xl {
    --bs-gutter-y: 8rem;
}

@media (min-width: 576px) {
    .col-sm {
        flex: 1 0 0%;
    }

    .row-cols-sm-auto > * {
        flex: 0 0 auto;
        width: auto;
    }

    .row-cols-sm-1 > * {
        flex: 0 0 auto;
        width: 100%;
    }

    .row-cols-sm-2 > * {
        flex: 0 0 auto;
        width: 50%;
    }

    .row-cols-sm-3 > * {
        flex: 0 0 auto;
        width: 33.3333333333%;
    }

    .row-cols-sm-4 > * {
        flex: 0 0 auto;
        width: 25%;
    }

    .row-cols-sm-5 > * {
        flex: 0 0 auto;
        width: 20%;
    }

    .row-cols-sm-6 > * {
        flex: 0 0 auto;
        width: 16.6666666667%;
    }

    .col-sm-auto {
        flex: 0 0 auto;
        width: auto;
    }

    .col-sm-1 {
        flex: 0 0 auto;
        width: 8.33333333%;
    }

    .col-sm-2 {
        flex: 0 0 auto;
        width: 16.66666667%;
    }

    .col-sm-3 {
        flex: 0 0 auto;
        width: 25%;
    }

    .col-sm-4 {
        flex: 0 0 auto;
        width: 33.33333333%;
    }

    .col-sm-5 {
        flex: 0 0 auto;
        width: 41.66666667%;
    }

    .col-sm-6 {
        flex: 0 0 auto;
        width: 50%;
    }

    .col-sm-7 {
        flex: 0 0 auto;
        width: 58.33333333%;
    }

    .col-sm-8 {
        flex: 0 0 auto;
        width: 66.66666667%;
    }

    .col-sm-9 {
        flex: 0 0 auto;
        width: 75%;
    }

    .col-sm-10 {
        flex: 0 0 auto;
        width: 83.33333333%;
    }

    .col-sm-11 {
        flex: 0 0 auto;
        width: 91.66666667%;
    }

    .col-sm-12 {
        flex: 0 0 auto;
        width: 100%;
    }

    .offset-sm-0 {
        margin-left: 0;
    }

    .offset-sm-1 {
        margin-left: 8.33333333%;
    }

    .offset-sm-2 {
        margin-left: 16.66666667%;
    }

    .offset-sm-3 {
        margin-left: 25%;
    }

    .offset-sm-4 {
        margin-left: 33.33333333%;
    }

    .offset-sm-5 {
        margin-left: 41.66666667%;
    }

    .offset-sm-6 {
        margin-left: 50%;
    }

    .offset-sm-7 {
        margin-left: 58.33333333%;
    }

    .offset-sm-8 {
        margin-left: 66.66666667%;
    }

    .offset-sm-9 {
        margin-left: 75%;
    }

    .offset-sm-10 {
        margin-left: 83.33333333%;
    }

    .offset-sm-11 {
        margin-left: 91.66666667%;
    }

    .g-sm-0,
.gx-sm-0 {
        --bs-gutter-x: 0;
    }

    .g-sm-0,
.gy-sm-0 {
        --bs-gutter-y: 0;
    }

    .g-sm-1,
.gx-sm-1 {
        --bs-gutter-x: 0.25rem;
    }

    .g-sm-1,
.gy-sm-1 {
        --bs-gutter-y: 0.25rem;
    }

    .g-sm-2,
.gx-sm-2 {
        --bs-gutter-x: 0.5rem;
    }

    .g-sm-2,
.gy-sm-2 {
        --bs-gutter-y: 0.5rem;
    }

    .g-sm-3,
.gx-sm-3 {
        --bs-gutter-x: 1rem;
    }

    .g-sm-3,
.gy-sm-3 {
        --bs-gutter-y: 1rem;
    }

    .g-sm-4,
.gx-sm-4 {
        --bs-gutter-x: 1.5rem;
    }

    .g-sm-4,
.gy-sm-4 {
        --bs-gutter-y: 1.5rem;
    }

    .g-sm-5,
.gx-sm-5 {
        --bs-gutter-x: 3rem;
    }

    .g-sm-5,
.gy-sm-5 {
        --bs-gutter-y: 3rem;
    }

    .g-sm-6,
.gx-sm-6 {
        --bs-gutter-x: 5rem;
    }

    .g-sm-6,
.gy-sm-6 {
        --bs-gutter-y: 5rem;
    }

    .g-sm-7,
.gx-sm-7 {
        --bs-gutter-x: 8rem;
    }

    .g-sm-7,
.gy-sm-7 {
        --bs-gutter-y: 8rem;
    }

    .g-sm-8,
.gx-sm-8 {
        --bs-gutter-x: 10rem;
    }

    .g-sm-8,
.gy-sm-8 {
        --bs-gutter-y: 10rem;
    }

    .g-sm-9,
.gx-sm-9 {
        --bs-gutter-x: 11rem;
    }

    .g-sm-9,
.gy-sm-9 {
        --bs-gutter-y: 11rem;
    }

    .g-sm-10,
.gx-sm-10 {
        --bs-gutter-x: 14rem;
    }

    .g-sm-10,
.gy-sm-10 {
        --bs-gutter-y: 14rem;
    }

    .g-sm-11,
.gx-sm-11 {
        --bs-gutter-x: 16rem;
    }

    .g-sm-11,
.gy-sm-11 {
        --bs-gutter-y: 16rem;
    }

    .g-sm-12,
.gx-sm-12 {
        --bs-gutter-x: 20rem;
    }

    .g-sm-12,
.gy-sm-12 {
        --bs-gutter-y: 20rem;
    }

    .g-sm-sm,
.gx-sm-sm {
        --bs-gutter-x: 1rem;
    }

    .g-sm-sm,
.gy-sm-sm {
        --bs-gutter-y: 1rem;
    }

    .g-sm-md,
.gx-sm-md {
        --bs-gutter-x: 2rem;
    }

    .g-sm-md,
.gy-sm-md {
        --bs-gutter-y: 2rem;
    }

    .g-sm-lg,
.gx-sm-lg {
        --bs-gutter-x: 4rem;
    }

    .g-sm-lg,
.gy-sm-lg {
        --bs-gutter-y: 4rem;
    }

    .g-sm-xl,
.gx-sm-xl {
        --bs-gutter-x: 8rem;
    }

    .g-sm-xl,
.gy-sm-xl {
        --bs-gutter-y: 8rem;
    }
}

@media (min-width: 768px) {
    .col-md {
        flex: 1 0 0%;
    }

    .row-cols-md-auto > * {
        flex: 0 0 auto;
        width: auto;
    }

    .row-cols-md-1 > * {
        flex: 0 0 auto;
        width: 100%;
    }

    .row-cols-md-2 > * {
        flex: 0 0 auto;
        width: 50%;
    }

    .row-cols-md-3 > * {
        flex: 0 0 auto;
        width: 33.3333333333%;
    }

    .row-cols-md-4 > * {
        flex: 0 0 auto;
        width: 25%;
    }

    .row-cols-md-5 > * {
        flex: 0 0 auto;
        width: 20%;
    }

    .row-cols-md-6 > * {
        flex: 0 0 auto;
        width: 16.6666666667%;
    }

    .col-md-auto {
        flex: 0 0 auto;
        width: auto;
    }

    .col-md-1 {
        flex: 0 0 auto;
        width: 8.33333333%;
    }

    .col-md-2 {
        flex: 0 0 auto;
        width: 16.66666667%;
    }

    .col-md-3 {
        flex: 0 0 auto;
        width: 25%;
    }

    .col-md-4 {
        flex: 0 0 auto;
        width: 33.33333333%;
    }

    .col-md-5 {
        flex: 0 0 auto;
        width: 41.66666667%;
    }

    .col-md-6 {
        flex: 0 0 auto;
        width: 50%;
    }

    .col-md-7 {
        flex: 0 0 auto;
        width: 58.33333333%;
    }

    .col-md-8 {
        flex: 0 0 auto;
        width: 66.66666667%;
    }

    .col-md-9 {
        flex: 0 0 auto;
        width: 75%;
    }

    .col-md-10 {
        flex: 0 0 auto;
        width: 83.33333333%;
    }

    .col-md-11 {
        flex: 0 0 auto;
        width: 91.66666667%;
    }

    .col-md-12 {
        flex: 0 0 auto;
        width: 100%;
    }

    .offset-md-0 {
        margin-left: 0;
    }

    .offset-md-1 {
        margin-left: 8.33333333%;
    }

    .offset-md-2 {
        margin-left: 16.66666667%;
    }

    .offset-md-3 {
        margin-left: 25%;
    }

    .offset-md-4 {
        margin-left: 33.33333333%;
    }

    .offset-md-5 {
        margin-left: 41.66666667%;
    }

    .offset-md-6 {
        margin-left: 50%;
    }

    .offset-md-7 {
        margin-left: 58.33333333%;
    }

    .offset-md-8 {
        margin-left: 66.66666667%;
    }

    .offset-md-9 {
        margin-left: 75%;
    }

    .offset-md-10 {
        margin-left: 83.33333333%;
    }

    .offset-md-11 {
        margin-left: 91.66666667%;
    }

    .g-md-0,
.gx-md-0 {
        --bs-gutter-x: 0;
    }

    .g-md-0,
.gy-md-0 {
        --bs-gutter-y: 0;
    }

    .g-md-1,
.gx-md-1 {
        --bs-gutter-x: 0.25rem;
    }

    .g-md-1,
.gy-md-1 {
        --bs-gutter-y: 0.25rem;
    }

    .g-md-2,
.gx-md-2 {
        --bs-gutter-x: 0.5rem;
    }

    .g-md-2,
.gy-md-2 {
        --bs-gutter-y: 0.5rem;
    }

    .g-md-3,
.gx-md-3 {
        --bs-gutter-x: 1rem;
    }

    .g-md-3,
.gy-md-3 {
        --bs-gutter-y: 1rem;
    }

    .g-md-4,
.gx-md-4 {
        --bs-gutter-x: 1.5rem;
    }

    .g-md-4,
.gy-md-4 {
        --bs-gutter-y: 1.5rem;
    }

    .g-md-5,
.gx-md-5 {
        --bs-gutter-x: 3rem;
    }

    .g-md-5,
.gy-md-5 {
        --bs-gutter-y: 3rem;
    }

    .g-md-6,
.gx-md-6 {
        --bs-gutter-x: 5rem;
    }

    .g-md-6,
.gy-md-6 {
        --bs-gutter-y: 5rem;
    }

    .g-md-7,
.gx-md-7 {
        --bs-gutter-x: 8rem;
    }

    .g-md-7,
.gy-md-7 {
        --bs-gutter-y: 8rem;
    }

    .g-md-8,
.gx-md-8 {
        --bs-gutter-x: 10rem;
    }

    .g-md-8,
.gy-md-8 {
        --bs-gutter-y: 10rem;
    }

    .g-md-9,
.gx-md-9 {
        --bs-gutter-x: 11rem;
    }

    .g-md-9,
.gy-md-9 {
        --bs-gutter-y: 11rem;
    }

    .g-md-10,
.gx-md-10 {
        --bs-gutter-x: 14rem;
    }

    .g-md-10,
.gy-md-10 {
        --bs-gutter-y: 14rem;
    }

    .g-md-11,
.gx-md-11 {
        --bs-gutter-x: 16rem;
    }

    .g-md-11,
.gy-md-11 {
        --bs-gutter-y: 16rem;
    }

    .g-md-12,
.gx-md-12 {
        --bs-gutter-x: 20rem;
    }

    .g-md-12,
.gy-md-12 {
        --bs-gutter-y: 20rem;
    }

    .g-md-sm,
.gx-md-sm {
        --bs-gutter-x: 1rem;
    }

    .g-md-sm,
.gy-md-sm {
        --bs-gutter-y: 1rem;
    }

    .g-md-md,
.gx-md-md {
        --bs-gutter-x: 2rem;
    }

    .g-md-md,
.gy-md-md {
        --bs-gutter-y: 2rem;
    }

    .g-md-lg,
.gx-md-lg {
        --bs-gutter-x: 4rem;
    }

    .g-md-lg,
.gy-md-lg {
        --bs-gutter-y: 4rem;
    }

    .g-md-xl,
.gx-md-xl {
        --bs-gutter-x: 8rem;
    }

    .g-md-xl,
.gy-md-xl {
        --bs-gutter-y: 8rem;
    }
}

@media (min-width: 992px) {
    .col-lg {
        flex: 1 0 0%;
    }

    .row-cols-lg-auto > * {
        flex: 0 0 auto;
        width: auto;
    }

    .row-cols-lg-1 > * {
        flex: 0 0 auto;
        width: 100%;
    }

    .row-cols-lg-2 > * {
        flex: 0 0 auto;
        width: 50%;
    }

    .row-cols-lg-3 > * {
        flex: 0 0 auto;
        width: 33.3333333333%;
    }

    .row-cols-lg-4 > * {
        flex: 0 0 auto;
        width: 25%;
    }

    .row-cols-lg-5 > * {
        flex: 0 0 auto;
        width: 20%;
    }

    .row-cols-lg-6 > * {
        flex: 0 0 auto;
        width: 16.6666666667%;
    }

    .col-lg-auto {
        flex: 0 0 auto;
        width: auto;
    }

    .col-lg-1 {
        flex: 0 0 auto;
        width: 8.33333333%;
    }

    .col-lg-2 {
        flex: 0 0 auto;
        width: 16.66666667%;
    }

    .col-lg-3 {
        flex: 0 0 auto;
        width: 25%;
    }

    .col-lg-4 {
        flex: 0 0 auto;
        width: 33.33333333%;
    }

    .col-lg-5 {
        flex: 0 0 auto;
        width: 41.66666667%;
    }

    .col-lg-6 {
        flex: 0 0 auto;
        width: 50%;
    }

    .col-lg-7 {
        flex: 0 0 auto;
        width: 58.33333333%;
    }

    .col-lg-8 {
        flex: 0 0 auto;
        width: 66.66666667%;
    }

    .col-lg-9 {
        flex: 0 0 auto;
        width: 75%;
    }

    .col-lg-10 {
        flex: 0 0 auto;
        width: 83.33333333%;
    }

    .col-lg-11 {
        flex: 0 0 auto;
        width: 91.66666667%;
    }

    .col-lg-12 {
        flex: 0 0 auto;
        width: 100%;
    }

    .offset-lg-0 {
        margin-left: 0;
    }

    .offset-lg-1 {
        margin-left: 8.33333333%;
    }

    .offset-lg-2 {
        margin-left: 16.66666667%;
    }

    .offset-lg-3 {
        margin-left: 25%;
    }

    .offset-lg-4 {
        margin-left: 33.33333333%;
    }

    .offset-lg-5 {
        margin-left: 41.66666667%;
    }

    .offset-lg-6 {
        margin-left: 50%;
    }

    .offset-lg-7 {
        margin-left: 58.33333333%;
    }

    .offset-lg-8 {
        margin-left: 66.66666667%;
    }

    .offset-lg-9 {
        margin-left: 75%;
    }

    .offset-lg-10 {
        margin-left: 83.33333333%;
    }

    .offset-lg-11 {
        margin-left: 91.66666667%;
    }

    .g-lg-0,
.gx-lg-0 {
        --bs-gutter-x: 0;
    }

    .g-lg-0,
.gy-lg-0 {
        --bs-gutter-y: 0;
    }

    .g-lg-1,
.gx-lg-1 {
        --bs-gutter-x: 0.25rem;
    }

    .g-lg-1,
.gy-lg-1 {
        --bs-gutter-y: 0.25rem;
    }

    .g-lg-2,
.gx-lg-2 {
        --bs-gutter-x: 0.5rem;
    }

    .g-lg-2,
.gy-lg-2 {
        --bs-gutter-y: 0.5rem;
    }

    .g-lg-3,
.gx-lg-3 {
        --bs-gutter-x: 1rem;
    }

    .g-lg-3,
.gy-lg-3 {
        --bs-gutter-y: 1rem;
    }

    .g-lg-4,
.gx-lg-4 {
        --bs-gutter-x: 1.5rem;
    }

    .g-lg-4,
.gy-lg-4 {
        --bs-gutter-y: 1.5rem;
    }

    .g-lg-5,
.gx-lg-5 {
        --bs-gutter-x: 3rem;
    }

    .g-lg-5,
.gy-lg-5 {
        --bs-gutter-y: 3rem;
    }

    .g-lg-6,
.gx-lg-6 {
        --bs-gutter-x: 5rem;
    }

    .g-lg-6,
.gy-lg-6 {
        --bs-gutter-y: 5rem;
    }

    .g-lg-7,
.gx-lg-7 {
        --bs-gutter-x: 8rem;
    }

    .g-lg-7,
.gy-lg-7 {
        --bs-gutter-y: 8rem;
    }

    .g-lg-8,
.gx-lg-8 {
        --bs-gutter-x: 10rem;
    }

    .g-lg-8,
.gy-lg-8 {
        --bs-gutter-y: 10rem;
    }

    .g-lg-9,
.gx-lg-9 {
        --bs-gutter-x: 11rem;
    }

    .g-lg-9,
.gy-lg-9 {
        --bs-gutter-y: 11rem;
    }

    .g-lg-10,
.gx-lg-10 {
        --bs-gutter-x: 14rem;
    }

    .g-lg-10,
.gy-lg-10 {
        --bs-gutter-y: 14rem;
    }

    .g-lg-11,
.gx-lg-11 {
        --bs-gutter-x: 16rem;
    }

    .g-lg-11,
.gy-lg-11 {
        --bs-gutter-y: 16rem;
    }

    .g-lg-12,
.gx-lg-12 {
        --bs-gutter-x: 20rem;
    }

    .g-lg-12,
.gy-lg-12 {
        --bs-gutter-y: 20rem;
    }

    .g-lg-sm,
.gx-lg-sm {
        --bs-gutter-x: 1rem;
    }

    .g-lg-sm,
.gy-lg-sm {
        --bs-gutter-y: 1rem;
    }

    .g-lg-md,
.gx-lg-md {
        --bs-gutter-x: 2rem;
    }

    .g-lg-md,
.gy-lg-md {
        --bs-gutter-y: 2rem;
    }

    .g-lg-lg,
.gx-lg-lg {
        --bs-gutter-x: 4rem;
    }

    .g-lg-lg,
.gy-lg-lg {
        --bs-gutter-y: 4rem;
    }

    .g-lg-xl,
.gx-lg-xl {
        --bs-gutter-x: 8rem;
    }

    .g-lg-xl,
.gy-lg-xl {
        --bs-gutter-y: 8rem;
    }
}

@media (min-width: 1200px) {
    .col-xl {
        flex: 1 0 0%;
    }

    .row-cols-xl-auto > * {
        flex: 0 0 auto;
        width: auto;
    }

    .row-cols-xl-1 > * {
        flex: 0 0 auto;
        width: 100%;
    }

    .row-cols-xl-2 > * {
        flex: 0 0 auto;
        width: 50%;
    }

    .row-cols-xl-3 > * {
        flex: 0 0 auto;
        width: 33.3333333333%;
    }

    .row-cols-xl-4 > * {
        flex: 0 0 auto;
        width: 25%;
    }

    .row-cols-xl-5 > * {
        flex: 0 0 auto;
        width: 20%;
    }

    .row-cols-xl-6 > * {
        flex: 0 0 auto;
        width: 16.6666666667%;
    }

    .col-xl-auto {
        flex: 0 0 auto;
        width: auto;
    }

    .col-xl-1 {
        flex: 0 0 auto;
        width: 8.33333333%;
    }

    .col-xl-2 {
        flex: 0 0 auto;
        width: 16.66666667%;
    }

    .col-xl-3 {
        flex: 0 0 auto;
        width: 25%;
    }

    .col-xl-4 {
        flex: 0 0 auto;
        width: 33.33333333%;
    }

    .col-xl-5 {
        flex: 0 0 auto;
        width: 41.66666667%;
    }

    .col-xl-6 {
        flex: 0 0 auto;
        width: 50%;
    }

    .col-xl-7 {
        flex: 0 0 auto;
        width: 58.33333333%;
    }

    .col-xl-8 {
        flex: 0 0 auto;
        width: 66.66666667%;
    }

    .col-xl-9 {
        flex: 0 0 auto;
        width: 75%;
    }

    .col-xl-10 {
        flex: 0 0 auto;
        width: 83.33333333%;
    }

    .col-xl-11 {
        flex: 0 0 auto;
        width: 91.66666667%;
    }

    .col-xl-12 {
        flex: 0 0 auto;
        width: 100%;
    }

    .offset-xl-0 {
        margin-left: 0;
    }

    .offset-xl-1 {
        margin-left: 8.33333333%;
    }

    .offset-xl-2 {
        margin-left: 16.66666667%;
    }

    .offset-xl-3 {
        margin-left: 25%;
    }

    .offset-xl-4 {
        margin-left: 33.33333333%;
    }

    .offset-xl-5 {
        margin-left: 41.66666667%;
    }

    .offset-xl-6 {
        margin-left: 50%;
    }

    .offset-xl-7 {
        margin-left: 58.33333333%;
    }

    .offset-xl-8 {
        margin-left: 66.66666667%;
    }

    .offset-xl-9 {
        margin-left: 75%;
    }

    .offset-xl-10 {
        margin-left: 83.33333333%;
    }

    .offset-xl-11 {
        margin-left: 91.66666667%;
    }

    .g-xl-0,
.gx-xl-0 {
        --bs-gutter-x: 0;
    }

    .g-xl-0,
.gy-xl-0 {
        --bs-gutter-y: 0;
    }

    .g-xl-1,
.gx-xl-1 {
        --bs-gutter-x: 0.25rem;
    }

    .g-xl-1,
.gy-xl-1 {
        --bs-gutter-y: 0.25rem;
    }

    .g-xl-2,
.gx-xl-2 {
        --bs-gutter-x: 0.5rem;
    }

    .g-xl-2,
.gy-xl-2 {
        --bs-gutter-y: 0.5rem;
    }

    .g-xl-3,
.gx-xl-3 {
        --bs-gutter-x: 1rem;
    }

    .g-xl-3,
.gy-xl-3 {
        --bs-gutter-y: 1rem;
    }

    .g-xl-4,
.gx-xl-4 {
        --bs-gutter-x: 1.5rem;
    }

    .g-xl-4,
.gy-xl-4 {
        --bs-gutter-y: 1.5rem;
    }

    .g-xl-5,
.gx-xl-5 {
        --bs-gutter-x: 3rem;
    }

    .g-xl-5,
.gy-xl-5 {
        --bs-gutter-y: 3rem;
    }

    .g-xl-6,
.gx-xl-6 {
        --bs-gutter-x: 5rem;
    }

    .g-xl-6,
.gy-xl-6 {
        --bs-gutter-y: 5rem;
    }

    .g-xl-7,
.gx-xl-7 {
        --bs-gutter-x: 8rem;
    }

    .g-xl-7,
.gy-xl-7 {
        --bs-gutter-y: 8rem;
    }

    .g-xl-8,
.gx-xl-8 {
        --bs-gutter-x: 10rem;
    }

    .g-xl-8,
.gy-xl-8 {
        --bs-gutter-y: 10rem;
    }

    .g-xl-9,
.gx-xl-9 {
        --bs-gutter-x: 11rem;
    }

    .g-xl-9,
.gy-xl-9 {
        --bs-gutter-y: 11rem;
    }

    .g-xl-10,
.gx-xl-10 {
        --bs-gutter-x: 14rem;
    }

    .g-xl-10,
.gy-xl-10 {
        --bs-gutter-y: 14rem;
    }

    .g-xl-11,
.gx-xl-11 {
        --bs-gutter-x: 16rem;
    }

    .g-xl-11,
.gy-xl-11 {
        --bs-gutter-y: 16rem;
    }

    .g-xl-12,
.gx-xl-12 {
        --bs-gutter-x: 20rem;
    }

    .g-xl-12,
.gy-xl-12 {
        --bs-gutter-y: 20rem;
    }

    .g-xl-sm,
.gx-xl-sm {
        --bs-gutter-x: 1rem;
    }

    .g-xl-sm,
.gy-xl-sm {
        --bs-gutter-y: 1rem;
    }

    .g-xl-md,
.gx-xl-md {
        --bs-gutter-x: 2rem;
    }

    .g-xl-md,
.gy-xl-md {
        --bs-gutter-y: 2rem;
    }

    .g-xl-lg,
.gx-xl-lg {
        --bs-gutter-x: 4rem;
    }

    .g-xl-lg,
.gy-xl-lg {
        --bs-gutter-y: 4rem;
    }

    .g-xl-xl,
.gx-xl-xl {
        --bs-gutter-x: 8rem;
    }

    .g-xl-xl,
.gy-xl-xl {
        --bs-gutter-y: 8rem;
    }
}

@media (min-width: 1400px) {
    .col-xxl {
        flex: 1 0 0%;
    }

    .row-cols-xxl-auto > * {
        flex: 0 0 auto;
        width: auto;
    }

    .row-cols-xxl-1 > * {
        flex: 0 0 auto;
        width: 100%;
    }

    .row-cols-xxl-2 > * {
        flex: 0 0 auto;
        width: 50%;
    }

    .row-cols-xxl-3 > * {
        flex: 0 0 auto;
        width: 33.3333333333%;
    }

    .row-cols-xxl-4 > * {
        flex: 0 0 auto;
        width: 25%;
    }

    .row-cols-xxl-5 > * {
        flex: 0 0 auto;
        width: 20%;
    }

    .row-cols-xxl-6 > * {
        flex: 0 0 auto;
        width: 16.6666666667%;
    }

    .col-xxl-auto {
        flex: 0 0 auto;
        width: auto;
    }

    .col-xxl-1 {
        flex: 0 0 auto;
        width: 8.33333333%;
    }

    .col-xxl-2 {
        flex: 0 0 auto;
        width: 16.66666667%;
    }

    .col-xxl-3 {
        flex: 0 0 auto;
        width: 25%;
    }

    .col-xxl-4 {
        flex: 0 0 auto;
        width: 33.33333333%;
    }

    .col-xxl-5 {
        flex: 0 0 auto;
        width: 41.66666667%;
    }

    .col-xxl-6 {
        flex: 0 0 auto;
        width: 50%;
    }

    .col-xxl-7 {
        flex: 0 0 auto;
        width: 58.33333333%;
    }

    .col-xxl-8 {
        flex: 0 0 auto;
        width: 66.66666667%;
    }

    .col-xxl-9 {
        flex: 0 0 auto;
        width: 75%;
    }

    .col-xxl-10 {
        flex: 0 0 auto;
        width: 83.33333333%;
    }

    .col-xxl-11 {
        flex: 0 0 auto;
        width: 91.66666667%;
    }

    .col-xxl-12 {
        flex: 0 0 auto;
        width: 100%;
    }

    .offset-xxl-0 {
        margin-left: 0;
    }

    .offset-xxl-1 {
        margin-left: 8.33333333%;
    }

    .offset-xxl-2 {
        margin-left: 16.66666667%;
    }

    .offset-xxl-3 {
        margin-left: 25%;
    }

    .offset-xxl-4 {
        margin-left: 33.33333333%;
    }

    .offset-xxl-5 {
        margin-left: 41.66666667%;
    }

    .offset-xxl-6 {
        margin-left: 50%;
    }

    .offset-xxl-7 {
        margin-left: 58.33333333%;
    }

    .offset-xxl-8 {
        margin-left: 66.66666667%;
    }

    .offset-xxl-9 {
        margin-left: 75%;
    }

    .offset-xxl-10 {
        margin-left: 83.33333333%;
    }

    .offset-xxl-11 {
        margin-left: 91.66666667%;
    }

    .g-xxl-0,
.gx-xxl-0 {
        --bs-gutter-x: 0;
    }

    .g-xxl-0,
.gy-xxl-0 {
        --bs-gutter-y: 0;
    }

    .g-xxl-1,
.gx-xxl-1 {
        --bs-gutter-x: 0.25rem;
    }

    .g-xxl-1,
.gy-xxl-1 {
        --bs-gutter-y: 0.25rem;
    }

    .g-xxl-2,
.gx-xxl-2 {
        --bs-gutter-x: 0.5rem;
    }

    .g-xxl-2,
.gy-xxl-2 {
        --bs-gutter-y: 0.5rem;
    }

    .g-xxl-3,
.gx-xxl-3 {
        --bs-gutter-x: 1rem;
    }

    .g-xxl-3,
.gy-xxl-3 {
        --bs-gutter-y: 1rem;
    }

    .g-xxl-4,
.gx-xxl-4 {
        --bs-gutter-x: 1.5rem;
    }

    .g-xxl-4,
.gy-xxl-4 {
        --bs-gutter-y: 1.5rem;
    }

    .g-xxl-5,
.gx-xxl-5 {
        --bs-gutter-x: 3rem;
    }

    .g-xxl-5,
.gy-xxl-5 {
        --bs-gutter-y: 3rem;
    }

    .g-xxl-6,
.gx-xxl-6 {
        --bs-gutter-x: 5rem;
    }

    .g-xxl-6,
.gy-xxl-6 {
        --bs-gutter-y: 5rem;
    }

    .g-xxl-7,
.gx-xxl-7 {
        --bs-gutter-x: 8rem;
    }

    .g-xxl-7,
.gy-xxl-7 {
        --bs-gutter-y: 8rem;
    }

    .g-xxl-8,
.gx-xxl-8 {
        --bs-gutter-x: 10rem;
    }

    .g-xxl-8,
.gy-xxl-8 {
        --bs-gutter-y: 10rem;
    }

    .g-xxl-9,
.gx-xxl-9 {
        --bs-gutter-x: 11rem;
    }

    .g-xxl-9,
.gy-xxl-9 {
        --bs-gutter-y: 11rem;
    }

    .g-xxl-10,
.gx-xxl-10 {
        --bs-gutter-x: 14rem;
    }

    .g-xxl-10,
.gy-xxl-10 {
        --bs-gutter-y: 14rem;
    }

    .g-xxl-11,
.gx-xxl-11 {
        --bs-gutter-x: 16rem;
    }

    .g-xxl-11,
.gy-xxl-11 {
        --bs-gutter-y: 16rem;
    }

    .g-xxl-12,
.gx-xxl-12 {
        --bs-gutter-x: 20rem;
    }

    .g-xxl-12,
.gy-xxl-12 {
        --bs-gutter-y: 20rem;
    }

    .g-xxl-sm,
.gx-xxl-sm {
        --bs-gutter-x: 1rem;
    }

    .g-xxl-sm,
.gy-xxl-sm {
        --bs-gutter-y: 1rem;
    }

    .g-xxl-md,
.gx-xxl-md {
        --bs-gutter-x: 2rem;
    }

    .g-xxl-md,
.gy-xxl-md {
        --bs-gutter-y: 2rem;
    }

    .g-xxl-lg,
.gx-xxl-lg {
        --bs-gutter-x: 4rem;
    }

    .g-xxl-lg,
.gy-xxl-lg {
        --bs-gutter-y: 4rem;
    }

    .g-xxl-xl,
.gx-xxl-xl {
        --bs-gutter-x: 8rem;
    }

    .g-xxl-xl,
.gy-xxl-xl {
        --bs-gutter-y: 8rem;
    }
}

.table {
    --bs-table-bg: transparent;
    --bs-table-accent-bg: transparent;
    --bs-table-striped-color: #374151;
    --bs-table-striped-bg: rgba(17, 24, 39, 0.05);
    --bs-table-active-color: #374151;
    --bs-table-active-bg: rgba(17, 24, 39, 0.1);
    --bs-table-hover-color: #374151;
    --bs-table-hover-bg: rgba(17, 24, 39, 0.075);
    width: 100%;
    margin-bottom: 1rem;
    color: #374151;
    vertical-align: top;
    border-color: #E5E7EB;
}

.table > :not(caption) > * > * {
    padding: 0.75rem 0.5rem;
    background-color: var(--bs-table-bg);
    border-bottom-width: 0.0625rem;
    box-shadow: inset 0 0 0 9999px var(--bs-table-accent-bg);
}

.table > tbody {
    vertical-align: inherit;
}

.table > thead {
    vertical-align: bottom;
}

.table > :not(:first-child) {
    border-top: 0.125rem solid currentColor;
}

.caption-top {
    caption-side: top;
}

.table-sm > :not(caption) > * > * {
    padding: 0.25rem 0.25rem;
}

.table-bordered > :not(caption) > * {
    border-width: 0.0625rem 0;
}

.table-bordered > :not(caption) > * > * {
    border-width: 0 0.0625rem;
}

.table-borderless > :not(caption) > * > * {
    border-bottom-width: 0;
}

.table-borderless > :not(:first-child) {
    border-top-width: 0;
}

.table-striped > tbody > tr:nth-of-type(odd) > * {
    --bs-table-accent-bg: var(--bs-table-striped-bg);
    color: var(--bs-table-striped-color);
}

.table-active {
    --bs-table-accent-bg: var(--bs-table-active-bg);
    color: var(--bs-table-active-color);
}

.table-hover > tbody > tr:hover > * {
    --bs-table-accent-bg: var(--bs-table-hover-bg);
    color: var(--bs-table-hover-color);
}

.table-primary {
    --bs-table-bg: #d2d4d7;
    --bs-table-striped-bg: #c9cbcf;
    --bs-table-striped-color: #1F2937;
    --bs-table-active-bg: #c0c3c7;
    --bs-table-active-color: #1F2937;
    --bs-table-hover-bg: #c5c7cb;
    --bs-table-hover-color: #1F2937;
    color: #1F2937;
    border-color: #c0c3c7;
}

.table-secondary {
    --bs-table-bg: #fcf2e3;
    --bs-table-striped-bg: #f1e8da;
    --bs-table-striped-color: #1F2937;
    --bs-table-active-bg: #e6ded2;
    --bs-table-active-color: #1F2937;
    --bs-table-hover-bg: #ebe3d6;
    --bs-table-hover-color: #1F2937;
    color: #1F2937;
    border-color: #e6ded2;
}

.table-success {
    --bs-table-bg: #cff1e6;
    --bs-table-striped-bg: #c6e7dd;
    --bs-table-striped-color: #1F2937;
    --bs-table-active-bg: #bdddd5;
    --bs-table-active-color: #1F2937;
    --bs-table-hover-bg: #c2e2d9;
    --bs-table-hover-color: #1F2937;
    color: #1F2937;
    border-color: #bdddd5;
}

.table-info {
    --bs-table-bg: #d3dff5;
    --bs-table-striped-bg: #cad6ec;
    --bs-table-striped-color: #1F2937;
    --bs-table-active-bg: #c1cde2;
    --bs-table-active-color: #1F2937;
    --bs-table-hover-bg: #c6d1e7;
    --bs-table-hover-color: #1F2937;
    color: #1F2937;
    border-color: #c1cde2;
}

.table-warning {
    --bs-table-bg: #fdf4e8;
    --bs-table-striped-bg: #f2eadf;
    --bs-table-striped-color: #1F2937;
    --bs-table-active-bg: #e7e0d6;
    --bs-table-active-color: #1F2937;
    --bs-table-hover-bg: #ece5db;
    --bs-table-hover-color: #1F2937;
    color: #1F2937;
    border-color: #e7e0d6;
}

.table-danger {
    --bs-table-bg: #f9d2da;
    --bs-table-striped-bg: #eecad2;
    --bs-table-striped-color: #1F2937;
    --bs-table-active-bg: #e3c1ca;
    --bs-table-active-color: #1F2937;
    --bs-table-hover-bg: #e9c5ce;
    --bs-table-hover-color: #1F2937;
    color: #1F2937;
    border-color: #e3c1ca;
}

.table-light {
    --bs-table-bg: #9CA3AF;
    --bs-table-striped-bg: #969da9;
    --bs-table-striped-color: #1F2937;
    --bs-table-active-bg: #9097a3;
    --bs-table-active-color: #1F2937;
    --bs-table-hover-bg: #939aa6;
    --bs-table-hover-color: #1F2937;
    color: #1F2937;
    border-color: #9097a3;
}

.table-dark {
    --bs-table-bg: #1F2937;
    --bs-table-striped-bg: #2a3441;
    --bs-table-striped-color: #ffffff;
    --bs-table-active-bg: #353e4b;
    --bs-table-active-color: #ffffff;
    --bs-table-hover-bg: #303946;
    --bs-table-hover-color: #ffffff;
    color: #ffffff;
    border-color: #353e4b;
}

.table-responsive {
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
}

@media (max-width: 575.98px) {
    .table-responsive-sm {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }
}

@media (max-width: 767.98px) {
    .table-responsive-md {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }
}

@media (max-width: 991.98px) {
    .table-responsive-lg {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }
}

@media (max-width: 1199.98px) {
    .table-responsive-xl {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }
}

@media (max-width: 1399.98px) {
    .table-responsive-xxl {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }
}

.form-label {
    margin-bottom: 0.5rem;
}

.col-form-label {
    padding-top: 0.5625rem;
    padding-bottom: 0.5625rem;
    margin-bottom: 0;
    font-size: inherit;
    line-height: 1.5;
}

.col-form-label-lg {
    padding-top: 0.5625rem;
    padding-bottom: 0.5625rem;
    font-size: 1.25rem;
}

.col-form-label-sm {
    padding-top: 0.4375rem;
    padding-bottom: 0.4375rem;
    font-size: 0.875rem;
}

.form-text {
    margin-top: 0.25rem;
    font-size: 0.875em;
    color: #58677d;
}

.form-control {
    display: block;
    width: 100%;
    padding: 0.5rem 1rem;
    font-size: 0.875rem;
    font-weight: 400;
    line-height: 1.5;
    color: #6B7280;
    background-color: #ffffff;
    background-clip: padding-box;
    border: 0.0625rem solid #D1D5DB;
    -webkit-appearance: none;
    appearance: none;
    border-radius: 0.5rem;
    box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.07);
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

@media (prefers-reduced-motion: reduce) {
    .form-control {
        transition: none;
    }
}

.form-control[type=file] {
    overflow: hidden;
}

.form-control[type=file]:not(:disabled):not([readonly]) {
    cursor: pointer;
}

.form-control:focus {
    color: #6B7280;
    background-color: #ffffff;
    border-color: #4d6689;
    outline: 0;
    box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.07), 0 0 0 0.18rem rgba(31, 41, 55, 0.25);
}

.form-control::-webkit-date-and-time-value {
    height: 1.5em;
}

.form-control::placeholder {
    color: #4B5563;
    opacity: 1;
}

.form-control:disabled, .form-control[readonly] {
    background-color: #E5E7EB;
    opacity: 1;
}

.form-control::file-selector-button {
    padding: 0.5rem 1rem;
    margin: -0.5rem -1rem;
    margin-inline-end: 1rem;
    color: #6B7280;
    background-color: #ffffff;
    pointer-events: none;
    border-color: inherit;
    border-style: solid;
    border-width: 0;
    border-inline-end-width: 0.0625rem;
    border-radius: 0;
    transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

@media (prefers-reduced-motion: reduce) {
    .form-control::file-selector-button {
        transition: none;
    }
}

.form-control:hover:not(:disabled):not([readonly])::file-selector-button {
    background-color: #f2f2f2;
}

.form-control::-webkit-file-upload-button {
    padding: 0.5rem 1rem;
    margin: -0.5rem -1rem;
    margin-inline-end: 1rem;
    color: #6B7280;
    background-color: #ffffff;
    pointer-events: none;
    border-color: inherit;
    border-style: solid;
    border-width: 0;
    border-inline-end-width: 0.0625rem;
    border-radius: 0;
    -webkit-transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

@media (prefers-reduced-motion: reduce) {
    .form-control::-webkit-file-upload-button {
        -webkit-transition: none;
        transition: none;
    }
}

.form-control:hover:not(:disabled):not([readonly])::-webkit-file-upload-button {
    background-color: #f2f2f2;
}

.form-control-plaintext {
    display: block;
    width: 100%;
    padding: 0.5rem 0;
    margin-bottom: 0;
    line-height: 1.5;
    color: #374151;
    background-color: transparent;
    border: solid transparent;
    border-width: 0.0625rem 0;
}

.form-control-plaintext.form-control-sm, .form-control-plaintext.form-control-lg {
    padding-right: 0;
    padding-left: 0;
}

.form-control-sm {
    min-height: calc(1.5em + 0.875rem);
    padding: 0.375rem 0.625rem;
    font-size: 0.875rem;
    border-radius: 0.5rem;
}

.form-control-sm::file-selector-button {
    padding: 0.375rem 0.625rem;
    margin: -0.375rem -0.625rem;
    margin-inline-end: 0.625rem;
}

.form-control-sm::-webkit-file-upload-button {
    padding: 0.375rem 0.625rem;
    margin: -0.375rem -0.625rem;
    margin-inline-end: 0.625rem;
}

.form-control-lg {
    min-height: calc(1.5em + 1.125rem);
    padding: 0.5rem 1rem;
    font-size: 1.25rem;
    border-radius: 0.5rem;
}

.form-control-lg::file-selector-button {
    padding: 0.5rem 1rem;
    margin: -0.5rem -1rem;
    margin-inline-end: 1rem;
}

.form-control-lg::-webkit-file-upload-button {
    padding: 0.5rem 1rem;
    margin: -0.5rem -1rem;
    margin-inline-end: 1rem;
}

textarea.form-control {
    min-height: calc(1.5em + 1.125rem);
}

textarea.form-control-sm {
    min-height: calc(1.5em + 0.875rem);
}

textarea.form-control-lg {
    min-height: calc(1.5em + 1.125rem);
}

.form-control-color {
    width: 3rem;
    height: auto;
    padding: 0.5rem;
}

.form-control-color:not(:disabled):not([readonly]) {
    cursor: pointer;
}

.form-control-color::-moz-color-swatch {
    height: 1.5em;
    border-radius: 0.5rem;
}

.form-control-color::-webkit-color-swatch {
    height: 1.5em;
    border-radius: 0.5rem;
}

.form-select {
    display: block;
    width: 100%;
    padding: 0.5rem 1rem 0.5rem 1rem;
    -moz-padding-start: calc(1rem - 3px);
    font-size: 0.875rem;
    font-weight: 400;
    line-height: 1.5;
    color: #6B7280;
    background-color: #ffffff;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%231F2937' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right 1rem center;
    background-size: 16px 12px;
    border: 0.0625rem solid #D1D5DB;
    border-radius: 0.5rem;
    box-shadow: inset 0 1px 2px rgba(17, 24, 39, 0.0125);
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    -webkit-appearance: none;
    appearance: none;
}

@media (prefers-reduced-motion: reduce) {
    .form-select {
        transition: none;
    }
}

.form-select:focus {
    border-color: #4d6689;
    outline: 0;
    box-shadow: inset 0 1px 2px rgba(17, 24, 39, 0.0125), 0 0 0 0.18rem rgba(31, 41, 55, 0.25);
}

.form-select[multiple], .form-select[size]:not([size="1"]) {
    padding-right: 1rem;
    background-image: none;
}

.form-select:disabled {
    color: #4B5563;
    background-color: #E5E7EB;
}

.form-select:-moz-focusring {
    color: transparent;
    text-shadow: 0 0 0 #6B7280;
}

.form-select-sm {
    padding-top: 0.375rem;
    padding-bottom: 0.375rem;
    padding-left: 0.625rem;
    font-size: 0.875rem;
    border-radius: 0.5rem;
}

.form-select-lg {
    padding-top: 0.5rem;
    padding-bottom: 0.5rem;
    padding-left: 1rem;
    font-size: 1.25rem;
    border-radius: 0.5rem;
}

.form-check {
    display: block;
    min-height: 1.5rem;
    padding-left: 1.625em;
    margin-bottom: 0.125rem;
}

.form-check .form-check-input {
    float: left;
    margin-left: -1.625em;
}

.form-check-input {
    width: 1.125em;
    height: 1.125em;
    margin-top: 0.1875em;
    vertical-align: top;
    background-color: #F2F4F6;
    background-repeat: no-repeat;
    background-position: center;
    background-size: contain;
    border: 1px solid #D1D5DB;
    -webkit-appearance: none;
    appearance: none;
    -webkit-print-color-adjust: exact;
    color-adjust: exact;
    transition: background-color 0.2s ease-in-out, background-position 0.2s ease-in-out, border-color 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
}

@media (prefers-reduced-motion: reduce) {
    .form-check-input {
        transition: none;
    }
}

.form-check-input[type=checkbox] {
    border-radius: 0.25em;
}

.form-check-input[type=radio] {
    border-radius: 50%;
}

.form-check-input:active {
    filter: brightness(90%);
}

.form-check-input:focus {
    border-color: #4d6689;
    outline: 0;
    box-shadow: 0 0 0 0.18rem rgba(31, 41, 55, 0.25);
}

.form-check-input:checked {
    background-color: #1F2937;
    border-color: #1F2937;
}

.form-check-input:checked[type=checkbox] {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3e%3cpath fill='none' stroke='%23ffffff' stroke-linecap='round' stroke-linejoin='round' stroke-width='3' d='M6 10l3 3l6-6'/%3e%3c/svg%3e");
}

.form-check-input:checked[type=radio] {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='-4 -4 8 8'%3e%3ccircle r='2' fill='%23ffffff'/%3e%3c/svg%3e");
}

.form-check-input[type=checkbox]:indeterminate {
    background-color: #1F2937;
    border-color: #1F2937;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3e%3cpath fill='none' stroke='%23ffffff' stroke-linecap='round' stroke-linejoin='round' stroke-width='3' d='M6 10h8'/%3e%3c/svg%3e");
}

.form-check-input:disabled {
    pointer-events: none;
    filter: none;
    opacity: 0.5;
}

.form-check-input[disabled] ~ .form-check-label, .form-check-input:disabled ~ .form-check-label {
    opacity: 0.5;
}

.form-switch {
    padding-left: 2.75em;
}

.form-switch .form-check-input {
    width: 2.25em;
    margin-left: -2.75em;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='-4 -4 8 8'%3e%3ccircle r='3' fill='%234B5563'/%3e%3c/svg%3e");
    background-position: left center;
    border-radius: 2.25em;
    transition: background-position 0.15s ease-in-out;
}

@media (prefers-reduced-motion: reduce) {
    .form-switch .form-check-input {
        transition: none;
    }
}

.form-switch .form-check-input:focus {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='-4 -4 8 8'%3e%3ccircle r='3' fill='%234d6689'/%3e%3c/svg%3e");
}

.form-switch .form-check-input:checked {
    background-position: right center;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='-4 -4 8 8'%3e%3ccircle r='3' fill='%23ffffff'/%3e%3c/svg%3e");
}

.form-check-inline {
    display: inline-block;
    margin-right: 1rem;
}

.btn-check {
    position: absolute;
    clip: rect(0, 0, 0, 0);
    pointer-events: none;
}

.btn-check[disabled] + .btn, .btn-check:disabled + .btn {
    pointer-events: none;
    filter: none;
    opacity: 0.65;
}

.form-range {
    width: 100%;
    height: 1.36rem;
    padding: 0;
    background-color: transparent;
    -webkit-appearance: none;
    appearance: none;
}

.form-range:focus {
    outline: 0;
}

.form-range:focus::-webkit-slider-thumb {
    box-shadow: 0 0 0 1px #F2F4F6, 0 0 0 0.18rem rgba(31, 41, 55, 0.25);
}

.form-range:focus::-moz-range-thumb {
    box-shadow: 0 0 0 1px #F2F4F6, 0 0 0 0.18rem rgba(31, 41, 55, 0.25);
}

.form-range::-moz-focus-outer {
    border: 0;
}

.form-range::-webkit-slider-thumb {
    width: 1rem;
    height: 1rem;
    margin-top: -0.25rem;
    background-color: #1F2937;
    border: 0;
    border-radius: 1rem;
    box-shadow: 0 0.1rem 0.25rem rgba(17, 24, 39, 0.1);
    -webkit-transition: background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    transition: background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    -webkit-appearance: none;
    appearance: none;
}

@media (prefers-reduced-motion: reduce) {
    .form-range::-webkit-slider-thumb {
        -webkit-transition: none;
        transition: none;
    }
}

.form-range::-webkit-slider-thumb:active {
    background-color: #627fa7;
}

.form-range::-webkit-slider-runnable-track {
    width: 100%;
    height: 0.5rem;
    color: transparent;
    cursor: pointer;
    background-color: #D1D5DB;
    border-color: transparent;
    border-radius: 1rem;
    box-shadow: inset 0 1px 2px rgba(17, 24, 39, 0.0125);
}

.form-range::-moz-range-thumb {
    width: 1rem;
    height: 1rem;
    background-color: #1F2937;
    border: 0;
    border-radius: 1rem;
    box-shadow: 0 0.1rem 0.25rem rgba(17, 24, 39, 0.1);
    -moz-transition: background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    transition: background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    appearance: none;
}

@media (prefers-reduced-motion: reduce) {
    .form-range::-moz-range-thumb {
        -moz-transition: none;
        transition: none;
    }
}

.form-range::-moz-range-thumb:active {
    background-color: #627fa7;
}

.form-range::-moz-range-track {
    width: 100%;
    height: 0.5rem;
    color: transparent;
    cursor: pointer;
    background-color: #D1D5DB;
    border-color: transparent;
    border-radius: 1rem;
    box-shadow: inset 0 1px 2px rgba(17, 24, 39, 0.0125);
}

.form-range:disabled {
    pointer-events: none;
}

.form-range:disabled::-webkit-slider-thumb {
    background-color: #6B7280;
}

.form-range:disabled::-moz-range-thumb {
    background-color: #6B7280;
}

.form-floating {
    position: relative;
}

.form-floating > .form-control,
.form-floating > .form-select {
    height: 3.625rem;
    line-height: 1.25;
}

.form-floating > label {
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    padding: 1rem 1rem;
    pointer-events: none;
    border: 0.0625rem solid transparent;
    transform-origin: 0 0;
    transition: opacity 0.1s ease-in-out, transform 0.1s ease-in-out;
}

@media (prefers-reduced-motion: reduce) {
    .form-floating > label {
        transition: none;
    }
}

.form-floating > .form-control {
    padding: 1rem 1rem;
}

.form-floating > .form-control::placeholder {
    color: transparent;
}

.form-floating > .form-control:focus, .form-floating > .form-control:not(:placeholder-shown) {
    padding-top: 1.625rem;
    padding-bottom: 0.625rem;
}

.form-floating > .form-control:-webkit-autofill {
    padding-top: 1.625rem;
    padding-bottom: 0.625rem;
}

.form-floating > .form-select {
    padding-top: 1.625rem;
    padding-bottom: 0.625rem;
}

.form-floating > .form-control:focus ~ label,
.form-floating > .form-control:not(:placeholder-shown) ~ label,
.form-floating > .form-select ~ label {
    opacity: 0.65;
    transform: scale(0.85) translateY(-0.5rem) translateX(0.15rem);
}

.form-floating > .form-control:-webkit-autofill ~ label {
    opacity: 0.65;
    transform: scale(0.85) translateY(-0.5rem) translateX(0.15rem);
}

.input-group {
    position: relative;
    display: flex;
    flex-wrap: wrap;
    align-items: stretch;
    width: 100%;
}

.input-group > .form-control,
.input-group > .form-select {
    position: relative;
    flex: 1 1 auto;
    width: 1%;
    min-width: 0;
}

.input-group > .form-control:focus,
.input-group > .form-select:focus {
    z-index: 3;
}

.input-group .btn {
    position: relative;
    z-index: 2;
}

.input-group .btn:focus {
    z-index: 3;
}

.input-group-text {
    display: flex;
    align-items: center;
    padding: 0.5rem 0.625rem;
    font-size: 0.875rem;
    font-weight: 400;
    line-height: 1.5;
    color: #6B7280;
    text-align: center;
    white-space: nowrap;
    background-color: #ffffff;
    border: 0.0625rem solid #D1D5DB;
    border-radius: 0.5rem;
}

.input-group-lg > .form-control,
.input-group-lg > .form-select,
.input-group-lg > .input-group-text,
.input-group-lg > .btn {
    padding: 0.5rem 1rem;
    font-size: 1.25rem;
    border-radius: 0.5rem;
}

.input-group-sm > .form-control,
.input-group-sm > .form-select,
.input-group-sm > .input-group-text,
.input-group-sm > .btn {
    padding: 0.375rem 0.625rem;
    font-size: 0.875rem;
    border-radius: 0.5rem;
}

.input-group-lg > .form-select,
.input-group-sm > .form-select {
    padding-right: 2rem;
}

.input-group:not(.has-validation) > :not(:last-child):not(.dropdown-toggle):not(.dropdown-menu),
.input-group:not(.has-validation) > .dropdown-toggle:nth-last-child(n+3) {
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
}

.input-group.has-validation > :nth-last-child(n+3):not(.dropdown-toggle):not(.dropdown-menu),
.input-group.has-validation > .dropdown-toggle:nth-last-child(n+4) {
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
}

.input-group > :not(:first-child):not(.dropdown-menu):not(.valid-tooltip):not(.valid-feedback):not(.invalid-tooltip):not(.invalid-feedback) {
    margin-left: -0.0625rem;
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
}

.valid-feedback {
    display: none;
    width: 100%;
    margin-top: 0.25rem;
    font-size: 0.875em;
    color: #10B981;
}

.valid-tooltip {
    position: absolute;
    top: 100%;
    z-index: 5;
    display: none;
    max-width: 100%;
    padding: 0.5rem 0.55rem;
    margin-top: 0.1rem;
    font-size: 0.875rem;
    color: #1F2937;
    background-color: rgba(16, 185, 129, 0.99);
    border-radius: 0.5rem;
}

.was-validated :valid ~ .valid-feedback,
.was-validated :valid ~ .valid-tooltip,
.is-valid ~ .valid-feedback,
.is-valid ~ .valid-tooltip {
    display: block;
}

.was-validated .form-control:valid, .form-control.is-valid {
    border-color: #10B981;
    padding-right: calc(1.5em + 1rem);
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3e%3cpath fill='%2310B981' d='M2.3 6.73L.6 4.53c-.4-1.04.46-1.4 1.1-.8l1.1 1.4 3.4-3.8c.6-.63 1.6-.27 1.2.7l-4 4.6c-.43.5-.8.4-1.1.1z'/%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right calc(0.375em + 0.25rem) center;
    background-size: calc(0.75em + 0.5rem) calc(0.75em + 0.5rem);
}

.was-validated .form-control:valid:focus, .form-control.is-valid:focus {
    border-color: #10B981;
    box-shadow: 0 0 0 0.18rem rgba(16, 185, 129, 0.25);
}

.was-validated textarea.form-control:valid, textarea.form-control.is-valid {
    padding-right: calc(1.5em + 1rem);
    background-position: top calc(0.375em + 0.25rem) right calc(0.375em + 0.25rem);
}

.was-validated .form-select:valid, .form-select.is-valid {
    border-color: #10B981;
}

.was-validated .form-select:valid:not([multiple]):not([size]), .was-validated .form-select:valid:not([multiple])[size="1"], .form-select.is-valid:not([multiple]):not([size]), .form-select.is-valid:not([multiple])[size="1"] {
    padding-right: 3.5rem;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%231F2937' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e"), url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3e%3cpath fill='%2310B981' d='M2.3 6.73L.6 4.53c-.4-1.04.46-1.4 1.1-.8l1.1 1.4 3.4-3.8c.6-.63 1.6-.27 1.2.7l-4 4.6c-.43.5-.8.4-1.1.1z'/%3e%3c/svg%3e");
    background-position: right 1rem center, center right 2rem;
    background-size: 16px 12px, calc(0.75em + 0.5rem) calc(0.75em + 0.5rem);
}

.was-validated .form-select:valid:focus, .form-select.is-valid:focus {
    border-color: #10B981;
    box-shadow: 0 0 0 0.18rem rgba(16, 185, 129, 0.25);
}

.was-validated .form-check-input:valid, .form-check-input.is-valid {
    border-color: #10B981;
}

.was-validated .form-check-input:valid:checked, .form-check-input.is-valid:checked {
    background-color: #10B981;
}

.was-validated .form-check-input:valid:focus, .form-check-input.is-valid:focus {
    box-shadow: 0 0 0 0.18rem rgba(16, 185, 129, 0.25);
}

.was-validated .form-check-input:valid ~ .form-check-label, .form-check-input.is-valid ~ .form-check-label {
    color: #10B981;
}

.form-check-inline .form-check-input ~ .valid-feedback {
    margin-left: 0.5em;
}

.was-validated .input-group .form-control:valid, .input-group .form-control.is-valid,
.was-validated .input-group .form-select:valid,
.input-group .form-select.is-valid {
    z-index: 1;
}

.was-validated .input-group .form-control:valid:focus, .input-group .form-control.is-valid:focus,
.was-validated .input-group .form-select:valid:focus,
.input-group .form-select.is-valid:focus {
    z-index: 3;
}

.invalid-feedback {
    display: none;
    width: 100%;
    margin-top: 0.25rem;
    font-size: 0.875em;
    color: #E11D48;
}

.invalid-tooltip {
    position: absolute;
    top: 100%;
    z-index: 5;
    display: none;
    max-width: 100%;
    padding: 0.5rem 0.55rem;
    margin-top: 0.1rem;
    font-size: 0.875rem;
    color: #ffffff;
    background-color: rgba(225, 29, 72, 0.99);
    border-radius: 0.5rem;
}

.was-validated :invalid ~ .invalid-feedback,
.was-validated :invalid ~ .invalid-tooltip,
.is-invalid ~ .invalid-feedback,
.is-invalid ~ .invalid-tooltip {
    display: block;
}

.was-validated .form-control:invalid, .form-control.is-invalid {
    border-color: #E11D48;
    padding-right: calc(1.5em + 1rem);
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='none' stroke='%23E11D48' viewBox='0 0 12 12'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23E11D48' stroke='none'/%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right calc(0.375em + 0.25rem) center;
    background-size: calc(0.75em + 0.5rem) calc(0.75em + 0.5rem);
}

.was-validated .form-control:invalid:focus, .form-control.is-invalid:focus {
    border-color: #E11D48;
    box-shadow: 0 0 0 0.18rem rgba(225, 29, 72, 0.25);
}

.was-validated textarea.form-control:invalid, textarea.form-control.is-invalid {
    padding-right: calc(1.5em + 1rem);
    background-position: top calc(0.375em + 0.25rem) right calc(0.375em + 0.25rem);
}

.was-validated .form-select:invalid, .form-select.is-invalid {
    border-color: #E11D48;
}

.was-validated .form-select:invalid:not([multiple]):not([size]), .was-validated .form-select:invalid:not([multiple])[size="1"], .form-select.is-invalid:not([multiple]):not([size]), .form-select.is-invalid:not([multiple])[size="1"] {
    padding-right: 3.5rem;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%231F2937' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e"), url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='none' stroke='%23E11D48' viewBox='0 0 12 12'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23E11D48' stroke='none'/%3e%3c/svg%3e");
    background-position: right 1rem center, center right 2rem;
    background-size: 16px 12px, calc(0.75em + 0.5rem) calc(0.75em + 0.5rem);
}

.was-validated .form-select:invalid:focus, .form-select.is-invalid:focus {
    border-color: #E11D48;
    box-shadow: 0 0 0 0.18rem rgba(225, 29, 72, 0.25);
}

.was-validated .form-check-input:invalid, .form-check-input.is-invalid {
    border-color: #E11D48;
}

.was-validated .form-check-input:invalid:checked, .form-check-input.is-invalid:checked {
    background-color: #E11D48;
}

.was-validated .form-check-input:invalid:focus, .form-check-input.is-invalid:focus {
    box-shadow: 0 0 0 0.18rem rgba(225, 29, 72, 0.25);
}

.was-validated .form-check-input:invalid ~ .form-check-label, .form-check-input.is-invalid ~ .form-check-label {
    color: #E11D48;
}

.form-check-inline .form-check-input ~ .invalid-feedback {
    margin-left: 0.5em;
}

.was-validated .input-group .form-control:invalid, .input-group .form-control.is-invalid,
.was-validated .input-group .form-select:invalid,
.input-group .form-select.is-invalid {
    z-index: 2;
}

.was-validated .input-group .form-control:invalid:focus, .input-group .form-control.is-invalid:focus,
.was-validated .input-group .form-select:invalid:focus,
.input-group .form-select.is-invalid:focus {
    z-index: 3;
}

.btn {
    display: inline-block;
    font-weight: 500;
    line-height: 1.5;
    color: #374151;
    text-align: center;
    vertical-align: middle;
    cursor: pointer;
    -webkit-user-select: none;
    user-select: none;
    background-color: transparent;
    border: 0.0625rem solid transparent;
    padding: 0.5rem 1rem;
    font-size: 0.875rem;
    border-radius: 0.5rem;
    transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

@media (prefers-reduced-motion: reduce) {
    .btn {
        transition: none;
    }
}

.btn:hover {
    color: #374151;
}

.btn-check:focus + .btn, .btn:focus {
    outline: 0;
    box-shadow: 0 0 0 0.18rem rgba(31, 41, 55, 0.25);
}

.btn-check:checked + .btn, .btn-check:active + .btn, .btn:active, .btn.active {
    box-shadow: inset 0 3px 5px rgba(17, 24, 39, 0.125);
}

.btn-check:checked + .btn:focus, .btn-check:active + .btn:focus, .btn:active:focus, .btn.active:focus {
    box-shadow: 0 0 0 0.18rem rgba(31, 41, 55, 0.25), inset 0 3px 5px rgba(17, 24, 39, 0.125);
}

.btn:disabled, .btn.disabled, fieldset:disabled .btn {
    pointer-events: none;
    opacity: 0.65;
    box-shadow: none;
}

.btn-primary {
    color: #ffffff;
    background-color: #1F2937;
    border-color: #1F2937;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.15), 0 1px 1px rgba(17, 24, 39, 0.075);
}

.btn-primary:hover {
    color: #ffffff;
    background-color: #1a232f;
    border-color: #19212c;
}

.btn-check:focus + .btn-primary, .btn-primary:focus {
    color: #ffffff;
    background-color: #1a232f;
    border-color: #19212c;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.15), 0 1px 1px rgba(17, 24, 39, 0.075), 0 0 0 0.18rem rgba(65, 73, 85, 0.5);
}

.btn-check:checked + .btn-primary, .btn-check:active + .btn-primary, .btn-primary:active, .btn-primary.active, .show > .btn-primary.dropdown-toggle {
    color: #ffffff;
    background-color: #19212c;
    border-color: #171f29;
}

.btn-check:checked + .btn-primary:focus, .btn-check:active + .btn-primary:focus, .btn-primary:active:focus, .btn-primary.active:focus, .show > .btn-primary.dropdown-toggle:focus {
    box-shadow: inset 0 3px 5px rgba(17, 24, 39, 0.125), 0 0 0 0.18rem rgba(65, 73, 85, 0.5);
}

.btn-primary:disabled, .btn-primary.disabled {
    color: #ffffff;
    background-color: #1F2937;
    border-color: #1F2937;
}

.btn-secondary {
    color: #1F2937;
    background-color: #f0bc74;
    border-color: #f0bc74;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.15), 0 1px 1px rgba(17, 24, 39, 0.075);
}

.btn-secondary:hover {
    color: #1F2937;
    background-color: #f2c689;
    border-color: #f2c382;
}

.btn-check:focus + .btn-secondary, .btn-secondary:focus {
    color: #1F2937;
    background-color: #f2c689;
    border-color: #f2c382;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.15), 0 1px 1px rgba(17, 24, 39, 0.075), 0 0 0 0.18rem rgba(209, 166, 107, 0.5);
}

.btn-check:checked + .btn-secondary, .btn-check:active + .btn-secondary, .btn-secondary:active, .btn-secondary.active, .show > .btn-secondary.dropdown-toggle {
    color: #1F2937;
    background-color: #f3c990;
    border-color: #f2c382;
}

.btn-check:checked + .btn-secondary:focus, .btn-check:active + .btn-secondary:focus, .btn-secondary:active:focus, .btn-secondary.active:focus, .show > .btn-secondary.dropdown-toggle:focus {
    box-shadow: inset 0 3px 5px rgba(17, 24, 39, 0.125), 0 0 0 0.18rem rgba(209, 166, 107, 0.5);
}

.btn-secondary:disabled, .btn-secondary.disabled {
    color: #1F2937;
    background-color: #f0bc74;
    border-color: #f0bc74;
}

.btn-tertiary {
    color: #ffffff;
    background-color: #31316A;
    border-color: #31316A;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.15), 0 1px 1px rgba(17, 24, 39, 0.075);
}

.btn-tertiary:hover {
    color: #ffffff;
    background-color: #2a2a5a;
    border-color: #272755;
}

.btn-check:focus + .btn-tertiary, .btn-tertiary:focus {
    color: #ffffff;
    background-color: #2a2a5a;
    border-color: #272755;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.15), 0 1px 1px rgba(17, 24, 39, 0.075), 0 0 0 0.18rem rgba(80, 80, 128, 0.5);
}

.btn-check:checked + .btn-tertiary, .btn-check:active + .btn-tertiary, .btn-tertiary:active, .btn-tertiary.active, .show > .btn-tertiary.dropdown-toggle {
    color: #ffffff;
    background-color: #272755;
    border-color: #252550;
}

.btn-check:checked + .btn-tertiary:focus, .btn-check:active + .btn-tertiary:focus, .btn-tertiary:active:focus, .btn-tertiary.active:focus, .show > .btn-tertiary.dropdown-toggle:focus {
    box-shadow: inset 0 3px 5px rgba(17, 24, 39, 0.125), 0 0 0 0.18rem rgba(80, 80, 128, 0.5);
}

.btn-tertiary:disabled, .btn-tertiary.disabled {
    color: #ffffff;
    background-color: #31316A;
    border-color: #31316A;
}

.btn-success {
    color: #1F2937;
    background-color: #10B981;
    border-color: #10B981;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.15), 0 1px 1px rgba(17, 24, 39, 0.075);
}

.btn-success:hover {
    color: #1F2937;
    background-color: #34c494;
    border-color: #28c08e;
}

.btn-check:focus + .btn-success, .btn-success:focus {
    color: #1F2937;
    background-color: #34c494;
    border-color: #28c08e;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.15), 0 1px 1px rgba(17, 24, 39, 0.075), 0 0 0 0.18rem rgba(18, 163, 118, 0.5);
}

.btn-check:checked + .btn-success, .btn-check:active + .btn-success, .btn-success:active, .btn-success.active, .show > .btn-success.dropdown-toggle {
    color: #1F2937;
    background-color: #40c79a;
    border-color: #28c08e;
}

.btn-check:checked + .btn-success:focus, .btn-check:active + .btn-success:focus, .btn-success:active:focus, .btn-success.active:focus, .show > .btn-success.dropdown-toggle:focus {
    box-shadow: inset 0 3px 5px rgba(17, 24, 39, 0.125), 0 0 0 0.18rem rgba(18, 163, 118, 0.5);
}

.btn-success:disabled, .btn-success.disabled {
    color: #1F2937;
    background-color: #10B981;
    border-color: #10B981;
}

.btn-info {
    color: #ffffff;
    background-color: #2361ce;
    border-color: #2361ce;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.15), 0 1px 1px rgba(17, 24, 39, 0.075);
}

.btn-info:hover {
    color: #ffffff;
    background-color: #1e52af;
    border-color: #1c4ea5;
}

.btn-check:focus + .btn-info, .btn-info:focus {
    color: #ffffff;
    background-color: #1e52af;
    border-color: #1c4ea5;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.15), 0 1px 1px rgba(17, 24, 39, 0.075), 0 0 0 0.18rem rgba(68, 121, 213, 0.5);
}

.btn-check:checked + .btn-info, .btn-check:active + .btn-info, .btn-info:active, .btn-info.active, .show > .btn-info.dropdown-toggle {
    color: #ffffff;
    background-color: #1c4ea5;
    border-color: #1a499b;
}

.btn-check:checked + .btn-info:focus, .btn-check:active + .btn-info:focus, .btn-info:active:focus, .btn-info.active:focus, .show > .btn-info.dropdown-toggle:focus {
    box-shadow: inset 0 3px 5px rgba(17, 24, 39, 0.125), 0 0 0 0.18rem rgba(68, 121, 213, 0.5);
}

.btn-info:disabled, .btn-info.disabled {
    color: #ffffff;
    background-color: #2361ce;
    border-color: #2361ce;
}

.btn-warning {
    color: #1F2937;
    background-color: #f3c78e;
    border-color: #f3c78e;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.15), 0 1px 1px rgba(17, 24, 39, 0.075);
}

.btn-warning:hover {
    color: #1F2937;
    background-color: #f5cf9f;
    border-color: #f4cd99;
}

.btn-check:focus + .btn-warning, .btn-warning:focus {
    color: #1F2937;
    background-color: #f5cf9f;
    border-color: #f4cd99;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.15), 0 1px 1px rgba(17, 24, 39, 0.075), 0 0 0 0.18rem rgba(211, 175, 129, 0.5);
}

.btn-check:checked + .btn-warning, .btn-check:active + .btn-warning, .btn-warning:active, .btn-warning.active, .show > .btn-warning.dropdown-toggle {
    color: #1F2937;
    background-color: #f5d2a5;
    border-color: #f4cd99;
}

.btn-check:checked + .btn-warning:focus, .btn-check:active + .btn-warning:focus, .btn-warning:active:focus, .btn-warning.active:focus, .show > .btn-warning.dropdown-toggle:focus {
    box-shadow: inset 0 3px 5px rgba(17, 24, 39, 0.125), 0 0 0 0.18rem rgba(211, 175, 129, 0.5);
}

.btn-warning:disabled, .btn-warning.disabled {
    color: #1F2937;
    background-color: #f3c78e;
    border-color: #f3c78e;
}

.btn-danger {
    color: #ffffff;
    background-color: #E11D48;
    border-color: #E11D48;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.15), 0 1px 1px rgba(17, 24, 39, 0.075);
}

.btn-danger:hover {
    color: #ffffff;
    background-color: #bf193d;
    border-color: #b4173a;
}

.btn-check:focus + .btn-danger, .btn-danger:focus {
    color: #ffffff;
    background-color: #bf193d;
    border-color: #b4173a;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.15), 0 1px 1px rgba(17, 24, 39, 0.075), 0 0 0 0.18rem rgba(230, 63, 99, 0.5);
}

.btn-check:checked + .btn-danger, .btn-check:active + .btn-danger, .btn-danger:active, .btn-danger.active, .show > .btn-danger.dropdown-toggle {
    color: #ffffff;
    background-color: #b4173a;
    border-color: #a91636;
}

.btn-check:checked + .btn-danger:focus, .btn-check:active + .btn-danger:focus, .btn-danger:active:focus, .btn-danger.active:focus, .show > .btn-danger.dropdown-toggle:focus {
    box-shadow: inset 0 3px 5px rgba(17, 24, 39, 0.125), 0 0 0 0.18rem rgba(230, 63, 99, 0.5);
}

.btn-danger:disabled, .btn-danger.disabled {
    color: #ffffff;
    background-color: #E11D48;
    border-color: #E11D48;
}

.btn-white {
    color: #1F2937;
    background-color: #ffffff;
    border-color: #ffffff;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.15), 0 1px 1px rgba(17, 24, 39, 0.075);
}

.btn-white:hover {
    color: #1F2937;
    background-color: white;
    border-color: white;
}

.btn-check:focus + .btn-white, .btn-white:focus {
    color: #1F2937;
    background-color: white;
    border-color: white;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.15), 0 1px 1px rgba(17, 24, 39, 0.075), 0 0 0 0.18rem rgba(221, 223, 225, 0.5);
}

.btn-check:checked + .btn-white, .btn-check:active + .btn-white, .btn-white:active, .btn-white.active, .show > .btn-white.dropdown-toggle {
    color: #1F2937;
    background-color: white;
    border-color: white;
}

.btn-check:checked + .btn-white:focus, .btn-check:active + .btn-white:focus, .btn-white:active:focus, .btn-white.active:focus, .show > .btn-white.dropdown-toggle:focus {
    box-shadow: inset 0 3px 5px rgba(17, 24, 39, 0.125), 0 0 0 0.18rem rgba(221, 223, 225, 0.5);
}

.btn-white:disabled, .btn-white.disabled {
    color: #1F2937;
    background-color: #ffffff;
    border-color: #ffffff;
}

.btn-indigo {
    color: #ffffff;
    background-color: #4F46E5;
    border-color: #4F46E5;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.15), 0 1px 1px rgba(17, 24, 39, 0.075);
}

.btn-indigo:hover {
    color: #ffffff;
    background-color: #433cc3;
    border-color: #3f38b7;
}

.btn-check:focus + .btn-indigo, .btn-indigo:focus {
    color: #ffffff;
    background-color: #433cc3;
    border-color: #3f38b7;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.15), 0 1px 1px rgba(17, 24, 39, 0.075), 0 0 0 0.18rem rgba(105, 98, 233, 0.5);
}

.btn-check:checked + .btn-indigo, .btn-check:active + .btn-indigo, .btn-indigo:active, .btn-indigo.active, .show > .btn-indigo.dropdown-toggle {
    color: #ffffff;
    background-color: #3f38b7;
    border-color: #3b35ac;
}

.btn-check:checked + .btn-indigo:focus, .btn-check:active + .btn-indigo:focus, .btn-indigo:active:focus, .btn-indigo.active:focus, .show > .btn-indigo.dropdown-toggle:focus {
    box-shadow: inset 0 3px 5px rgba(17, 24, 39, 0.125), 0 0 0 0.18rem rgba(105, 98, 233, 0.5);
}

.btn-indigo:disabled, .btn-indigo.disabled {
    color: #ffffff;
    background-color: #4F46E5;
    border-color: #4F46E5;
}

.btn-purple {
    color: #ffffff;
    background-color: #7C3AED;
    border-color: #7C3AED;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.15), 0 1px 1px rgba(17, 24, 39, 0.075);
}

.btn-purple:hover {
    color: #ffffff;
    background-color: #6931c9;
    border-color: #632ebe;
}

.btn-check:focus + .btn-purple, .btn-purple:focus {
    color: #ffffff;
    background-color: #6931c9;
    border-color: #632ebe;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.15), 0 1px 1px rgba(17, 24, 39, 0.075), 0 0 0 0.18rem rgba(144, 88, 240, 0.5);
}

.btn-check:checked + .btn-purple, .btn-check:active + .btn-purple, .btn-purple:active, .btn-purple.active, .show > .btn-purple.dropdown-toggle {
    color: #ffffff;
    background-color: #632ebe;
    border-color: #5d2cb2;
}

.btn-check:checked + .btn-purple:focus, .btn-check:active + .btn-purple:focus, .btn-purple:active:focus, .btn-purple.active:focus, .show > .btn-purple.dropdown-toggle:focus {
    box-shadow: inset 0 3px 5px rgba(17, 24, 39, 0.125), 0 0 0 0.18rem rgba(144, 88, 240, 0.5);
}

.btn-purple:disabled, .btn-purple.disabled {
    color: #ffffff;
    background-color: #7C3AED;
    border-color: #7C3AED;
}

.btn-yellow-100 {
    color: #1F2937;
    background-color: #ffeed6;
    border-color: #ffeed6;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.15), 0 1px 1px rgba(17, 24, 39, 0.075);
}

.btn-yellow-100:hover {
    color: #1F2937;
    background-color: #fff1dc;
    border-color: #fff0da;
}

.btn-check:focus + .btn-yellow-100, .btn-yellow-100:focus {
    color: #1F2937;
    background-color: #fff1dc;
    border-color: #fff0da;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.15), 0 1px 1px rgba(17, 24, 39, 0.075), 0 0 0 0.18rem rgba(221, 208, 190, 0.5);
}

.btn-check:checked + .btn-yellow-100, .btn-check:active + .btn-yellow-100, .btn-yellow-100:active, .btn-yellow-100.active, .show > .btn-yellow-100.dropdown-toggle {
    color: #1F2937;
    background-color: #fff1de;
    border-color: #fff0da;
}

.btn-check:checked + .btn-yellow-100:focus, .btn-check:active + .btn-yellow-100:focus, .btn-yellow-100:active:focus, .btn-yellow-100.active:focus, .show > .btn-yellow-100.dropdown-toggle:focus {
    box-shadow: inset 0 3px 5px rgba(17, 24, 39, 0.125), 0 0 0 0.18rem rgba(221, 208, 190, 0.5);
}

.btn-yellow-100:disabled, .btn-yellow-100.disabled {
    color: #1F2937;
    background-color: #ffeed6;
    border-color: #ffeed6;
}

.btn-yellow-200 {
    color: #1F2937;
    background-color: #f5dbb8;
    border-color: #f5dbb8;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.15), 0 1px 1px rgba(17, 24, 39, 0.075);
}

.btn-yellow-200:hover {
    color: #1F2937;
    background-color: #f7e0c3;
    border-color: #f6dfbf;
}

.btn-check:focus + .btn-yellow-200, .btn-yellow-200:focus {
    color: #1F2937;
    background-color: #f7e0c3;
    border-color: #f6dfbf;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.15), 0 1px 1px rgba(17, 24, 39, 0.075), 0 0 0 0.18rem rgba(213, 192, 165, 0.5);
}

.btn-check:checked + .btn-yellow-200, .btn-check:active + .btn-yellow-200, .btn-yellow-200:active, .btn-yellow-200.active, .show > .btn-yellow-200.dropdown-toggle {
    color: #1F2937;
    background-color: #f7e2c6;
    border-color: #f6dfbf;
}

.btn-check:checked + .btn-yellow-200:focus, .btn-check:active + .btn-yellow-200:focus, .btn-yellow-200:active:focus, .btn-yellow-200.active:focus, .show > .btn-yellow-200.dropdown-toggle:focus {
    box-shadow: inset 0 3px 5px rgba(17, 24, 39, 0.125), 0 0 0 0.18rem rgba(213, 192, 165, 0.5);
}

.btn-yellow-200:disabled, .btn-yellow-200.disabled {
    color: #1F2937;
    background-color: #f5dbb8;
    border-color: #f5dbb8;
}

.btn-gray-50 {
    color: #1F2937;
    background-color: #F9FAFB;
    border-color: #F9FAFB;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.15), 0 1px 1px rgba(17, 24, 39, 0.075);
}

.btn-gray-50:hover {
    color: #1F2937;
    background-color: #fafbfc;
    border-color: #fafbfb;
}

.btn-check:focus + .btn-gray-50, .btn-gray-50:focus {
    color: #1F2937;
    background-color: #fafbfc;
    border-color: #fafbfb;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.15), 0 1px 1px rgba(17, 24, 39, 0.075), 0 0 0 0.18rem rgba(216, 219, 222, 0.5);
}

.btn-check:checked + .btn-gray-50, .btn-check:active + .btn-gray-50, .btn-gray-50:active, .btn-gray-50.active, .show > .btn-gray-50.dropdown-toggle {
    color: #1F2937;
    background-color: #fafbfc;
    border-color: #fafbfb;
}

.btn-check:checked + .btn-gray-50:focus, .btn-check:active + .btn-gray-50:focus, .btn-gray-50:active:focus, .btn-gray-50.active:focus, .show > .btn-gray-50.dropdown-toggle:focus {
    box-shadow: inset 0 3px 5px rgba(17, 24, 39, 0.125), 0 0 0 0.18rem rgba(216, 219, 222, 0.5);
}

.btn-gray-50:disabled, .btn-gray-50.disabled {
    color: #1F2937;
    background-color: #F9FAFB;
    border-color: #F9FAFB;
}

.btn-gray-100 {
    color: #1F2937;
    background-color: #F2F4F6;
    border-color: #F2F4F6;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.15), 0 1px 1px rgba(17, 24, 39, 0.075);
}

.btn-gray-100:hover {
    color: #1F2937;
    background-color: #f4f6f7;
    border-color: #f3f5f7;
}

.btn-check:focus + .btn-gray-100, .btn-gray-100:focus {
    color: #1F2937;
    background-color: #f4f6f7;
    border-color: #f3f5f7;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.15), 0 1px 1px rgba(17, 24, 39, 0.075), 0 0 0 0.18rem rgba(210, 214, 217, 0.5);
}

.btn-check:checked + .btn-gray-100, .btn-check:active + .btn-gray-100, .btn-gray-100:active, .btn-gray-100.active, .show > .btn-gray-100.dropdown-toggle {
    color: #1F2937;
    background-color: #f5f6f8;
    border-color: #f3f5f7;
}

.btn-check:checked + .btn-gray-100:focus, .btn-check:active + .btn-gray-100:focus, .btn-gray-100:active:focus, .btn-gray-100.active:focus, .show > .btn-gray-100.dropdown-toggle:focus {
    box-shadow: inset 0 3px 5px rgba(17, 24, 39, 0.125), 0 0 0 0.18rem rgba(210, 214, 217, 0.5);
}

.btn-gray-100:disabled, .btn-gray-100.disabled {
    color: #1F2937;
    background-color: #F2F4F6;
    border-color: #F2F4F6;
}

.btn-gray-200 {
    color: #1F2937;
    background-color: #E5E7EB;
    border-color: #E5E7EB;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.15), 0 1px 1px rgba(17, 24, 39, 0.075);
}

.btn-gray-200:hover {
    color: #1F2937;
    background-color: #e9ebee;
    border-color: #e8e9ed;
}

.btn-check:focus + .btn-gray-200, .btn-gray-200:focus {
    color: #1F2937;
    background-color: #e9ebee;
    border-color: #e8e9ed;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.15), 0 1px 1px rgba(17, 24, 39, 0.075), 0 0 0 0.18rem rgba(199, 203, 208, 0.5);
}

.btn-check:checked + .btn-gray-200, .btn-check:active + .btn-gray-200, .btn-gray-200:active, .btn-gray-200.active, .show > .btn-gray-200.dropdown-toggle {
    color: #1F2937;
    background-color: #eaecef;
    border-color: #e8e9ed;
}

.btn-check:checked + .btn-gray-200:focus, .btn-check:active + .btn-gray-200:focus, .btn-gray-200:active:focus, .btn-gray-200.active:focus, .show > .btn-gray-200.dropdown-toggle:focus {
    box-shadow: inset 0 3px 5px rgba(17, 24, 39, 0.125), 0 0 0 0.18rem rgba(199, 203, 208, 0.5);
}

.btn-gray-200:disabled, .btn-gray-200.disabled {
    color: #1F2937;
    background-color: #E5E7EB;
    border-color: #E5E7EB;
}

.btn-gray-300 {
    color: #1F2937;
    background-color: #D1D5DB;
    border-color: #D1D5DB;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.15), 0 1px 1px rgba(17, 24, 39, 0.075);
}

.btn-gray-300:hover {
    color: #1F2937;
    background-color: #d8dbe0;
    border-color: #d6d9df;
}

.btn-check:focus + .btn-gray-300, .btn-gray-300:focus {
    color: #1F2937;
    background-color: #d8dbe0;
    border-color: #d6d9df;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.15), 0 1px 1px rgba(17, 24, 39, 0.075), 0 0 0 0.18rem rgba(182, 187, 194, 0.5);
}

.btn-check:checked + .btn-gray-300, .btn-check:active + .btn-gray-300, .btn-gray-300:active, .btn-gray-300.active, .show > .btn-gray-300.dropdown-toggle {
    color: #1F2937;
    background-color: #dadde2;
    border-color: #d6d9df;
}

.btn-check:checked + .btn-gray-300:focus, .btn-check:active + .btn-gray-300:focus, .btn-gray-300:active:focus, .btn-gray-300.active:focus, .show > .btn-gray-300.dropdown-toggle:focus {
    box-shadow: inset 0 3px 5px rgba(17, 24, 39, 0.125), 0 0 0 0.18rem rgba(182, 187, 194, 0.5);
}

.btn-gray-300:disabled, .btn-gray-300.disabled {
    color: #1F2937;
    background-color: #D1D5DB;
    border-color: #D1D5DB;
}

.btn-gray-400 {
    color: #1F2937;
    background-color: #9CA3AF;
    border-color: #9CA3AF;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.15), 0 1px 1px rgba(17, 24, 39, 0.075);
}

.btn-gray-400:hover {
    color: #1F2937;
    background-color: #abb1bb;
    border-color: #a6acb7;
}

.btn-check:focus + .btn-gray-400, .btn-gray-400:focus {
    color: #1F2937;
    background-color: #abb1bb;
    border-color: #a6acb7;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.15), 0 1px 1px rgba(17, 24, 39, 0.075), 0 0 0 0.18rem rgba(137, 145, 157, 0.5);
}

.btn-check:checked + .btn-gray-400, .btn-check:active + .btn-gray-400, .btn-gray-400:active, .btn-gray-400.active, .show > .btn-gray-400.dropdown-toggle {
    color: #1F2937;
    background-color: #b0b5bf;
    border-color: #a6acb7;
}

.btn-check:checked + .btn-gray-400:focus, .btn-check:active + .btn-gray-400:focus, .btn-gray-400:active:focus, .btn-gray-400.active:focus, .show > .btn-gray-400.dropdown-toggle:focus {
    box-shadow: inset 0 3px 5px rgba(17, 24, 39, 0.125), 0 0 0 0.18rem rgba(137, 145, 157, 0.5);
}

.btn-gray-400:disabled, .btn-gray-400.disabled {
    color: #1F2937;
    background-color: #9CA3AF;
    border-color: #9CA3AF;
}

.btn-gray-500 {
    color: #ffffff;
    background-color: #6B7280;
    border-color: #6B7280;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.15), 0 1px 1px rgba(17, 24, 39, 0.075);
}

.btn-gray-500:hover {
    color: #ffffff;
    background-color: #5b616d;
    border-color: #565b66;
}

.btn-check:focus + .btn-gray-500, .btn-gray-500:focus {
    color: #ffffff;
    background-color: #5b616d;
    border-color: #565b66;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.15), 0 1px 1px rgba(17, 24, 39, 0.075), 0 0 0 0.18rem rgba(129, 135, 147, 0.5);
}

.btn-check:checked + .btn-gray-500, .btn-check:active + .btn-gray-500, .btn-gray-500:active, .btn-gray-500.active, .show > .btn-gray-500.dropdown-toggle {
    color: #ffffff;
    background-color: #565b66;
    border-color: #505660;
}

.btn-check:checked + .btn-gray-500:focus, .btn-check:active + .btn-gray-500:focus, .btn-gray-500:active:focus, .btn-gray-500.active:focus, .show > .btn-gray-500.dropdown-toggle:focus {
    box-shadow: inset 0 3px 5px rgba(17, 24, 39, 0.125), 0 0 0 0.18rem rgba(129, 135, 147, 0.5);
}

.btn-gray-500:disabled, .btn-gray-500.disabled {
    color: #ffffff;
    background-color: #6B7280;
    border-color: #6B7280;
}

.btn-gray-600 {
    color: #ffffff;
    background-color: #4B5563;
    border-color: #4B5563;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.15), 0 1px 1px rgba(17, 24, 39, 0.075);
}

.btn-gray-600:hover {
    color: #ffffff;
    background-color: #404854;
    border-color: #3c444f;
}

.btn-check:focus + .btn-gray-600, .btn-gray-600:focus {
    color: #ffffff;
    background-color: #404854;
    border-color: #3c444f;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.15), 0 1px 1px rgba(17, 24, 39, 0.075), 0 0 0 0.18rem rgba(102, 111, 122, 0.5);
}

.btn-check:checked + .btn-gray-600, .btn-check:active + .btn-gray-600, .btn-gray-600:active, .btn-gray-600.active, .show > .btn-gray-600.dropdown-toggle {
    color: #ffffff;
    background-color: #3c444f;
    border-color: #38404a;
}

.btn-check:checked + .btn-gray-600:focus, .btn-check:active + .btn-gray-600:focus, .btn-gray-600:active:focus, .btn-gray-600.active:focus, .show > .btn-gray-600.dropdown-toggle:focus {
    box-shadow: inset 0 3px 5px rgba(17, 24, 39, 0.125), 0 0 0 0.18rem rgba(102, 111, 122, 0.5);
}

.btn-gray-600:disabled, .btn-gray-600.disabled {
    color: #ffffff;
    background-color: #4B5563;
    border-color: #4B5563;
}

.btn-gray-700 {
    color: #ffffff;
    background-color: #374151;
    border-color: #374151;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.15), 0 1px 1px rgba(17, 24, 39, 0.075);
}

.btn-gray-700:hover {
    color: #ffffff;
    background-color: #2f3745;
    border-color: #2c3441;
}

.btn-check:focus + .btn-gray-700, .btn-gray-700:focus {
    color: #ffffff;
    background-color: #2f3745;
    border-color: #2c3441;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.15), 0 1px 1px rgba(17, 24, 39, 0.075), 0 0 0 0.18rem rgba(85, 94, 107, 0.5);
}

.btn-check:checked + .btn-gray-700, .btn-check:active + .btn-gray-700, .btn-gray-700:active, .btn-gray-700.active, .show > .btn-gray-700.dropdown-toggle {
    color: #ffffff;
    background-color: #2c3441;
    border-color: #29313d;
}

.btn-check:checked + .btn-gray-700:focus, .btn-check:active + .btn-gray-700:focus, .btn-gray-700:active:focus, .btn-gray-700.active:focus, .show > .btn-gray-700.dropdown-toggle:focus {
    box-shadow: inset 0 3px 5px rgba(17, 24, 39, 0.125), 0 0 0 0.18rem rgba(85, 94, 107, 0.5);
}

.btn-gray-700:disabled, .btn-gray-700.disabled {
    color: #ffffff;
    background-color: #374151;
    border-color: #374151;
}

.btn-gray-800 {
    color: #ffffff;
    background-color: #1F2937;
    border-color: #1F2937;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.15), 0 1px 1px rgba(17, 24, 39, 0.075);
}

.btn-gray-800:hover {
    color: #ffffff;
    background-color: #1a232f;
    border-color: #19212c;
}

.btn-check:focus + .btn-gray-800, .btn-gray-800:focus {
    color: #ffffff;
    background-color: #1a232f;
    border-color: #19212c;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.15), 0 1px 1px rgba(17, 24, 39, 0.075), 0 0 0 0.18rem rgba(65, 73, 85, 0.5);
}

.btn-check:checked + .btn-gray-800, .btn-check:active + .btn-gray-800, .btn-gray-800:active, .btn-gray-800.active, .show > .btn-gray-800.dropdown-toggle {
    color: #ffffff;
    background-color: #19212c;
    border-color: #171f29;
}

.btn-check:checked + .btn-gray-800:focus, .btn-check:active + .btn-gray-800:focus, .btn-gray-800:active:focus, .btn-gray-800.active:focus, .show > .btn-gray-800.dropdown-toggle:focus {
    box-shadow: inset 0 3px 5px rgba(17, 24, 39, 0.125), 0 0 0 0.18rem rgba(65, 73, 85, 0.5);
}

.btn-gray-800:disabled, .btn-gray-800.disabled {
    color: #ffffff;
    background-color: #1F2937;
    border-color: #1F2937;
}

.btn-gray-900 {
    color: #ffffff;
    background-color: #111827;
    border-color: #111827;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.15), 0 1px 1px rgba(17, 24, 39, 0.075);
}

.btn-gray-900:hover {
    color: #ffffff;
    background-color: #0e1421;
    border-color: #0e131f;
}

.btn-check:focus + .btn-gray-900, .btn-gray-900:focus {
    color: #ffffff;
    background-color: #0e1421;
    border-color: #0e131f;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.15), 0 1px 1px rgba(17, 24, 39, 0.075), 0 0 0 0.18rem rgba(53, 59, 71, 0.5);
}

.btn-check:checked + .btn-gray-900, .btn-check:active + .btn-gray-900, .btn-gray-900:active, .btn-gray-900.active, .show > .btn-gray-900.dropdown-toggle {
    color: #ffffff;
    background-color: #0e131f;
    border-color: #0d121d;
}

.btn-check:checked + .btn-gray-900:focus, .btn-check:active + .btn-gray-900:focus, .btn-gray-900:active:focus, .btn-gray-900.active:focus, .show > .btn-gray-900.dropdown-toggle:focus {
    box-shadow: inset 0 3px 5px rgba(17, 24, 39, 0.125), 0 0 0 0.18rem rgba(53, 59, 71, 0.5);
}

.btn-gray-900:disabled, .btn-gray-900.disabled {
    color: #ffffff;
    background-color: #111827;
    border-color: #111827;
}

.btn-outline-primary {
    color: #1F2937;
    border-color: #1F2937;
}

.btn-outline-primary:hover {
    color: #ffffff;
    background-color: #1F2937;
    border-color: #1F2937;
}

.btn-check:focus + .btn-outline-primary, .btn-outline-primary:focus {
    box-shadow: 0 0 0 0.18rem rgba(31, 41, 55, 0.5);
}

.btn-check:checked + .btn-outline-primary, .btn-check:active + .btn-outline-primary, .btn-outline-primary:active, .btn-outline-primary.active, .btn-outline-primary.dropdown-toggle.show {
    color: #ffffff;
    background-color: #1F2937;
    border-color: #1F2937;
}

.btn-check:checked + .btn-outline-primary:focus, .btn-check:active + .btn-outline-primary:focus, .btn-outline-primary:active:focus, .btn-outline-primary.active:focus, .btn-outline-primary.dropdown-toggle.show:focus {
    box-shadow: inset 0 3px 5px rgba(17, 24, 39, 0.125), 0 0 0 0.18rem rgba(31, 41, 55, 0.5);
}

.btn-outline-primary:disabled, .btn-outline-primary.disabled {
    color: #1F2937;
    background-color: transparent;
}

.btn-outline-secondary {
    color: #f0bc74;
    border-color: #f0bc74;
}

.btn-outline-secondary:hover {
    color: #1F2937;
    background-color: #f0bc74;
    border-color: #f0bc74;
}

.btn-check:focus + .btn-outline-secondary, .btn-outline-secondary:focus {
    box-shadow: 0 0 0 0.18rem rgba(240, 188, 116, 0.5);
}

.btn-check:checked + .btn-outline-secondary, .btn-check:active + .btn-outline-secondary, .btn-outline-secondary:active, .btn-outline-secondary.active, .btn-outline-secondary.dropdown-toggle.show {
    color: #1F2937;
    background-color: #f0bc74;
    border-color: #f0bc74;
}

.btn-check:checked + .btn-outline-secondary:focus, .btn-check:active + .btn-outline-secondary:focus, .btn-outline-secondary:active:focus, .btn-outline-secondary.active:focus, .btn-outline-secondary.dropdown-toggle.show:focus {
    box-shadow: inset 0 3px 5px rgba(17, 24, 39, 0.125), 0 0 0 0.18rem rgba(240, 188, 116, 0.5);
}

.btn-outline-secondary:disabled, .btn-outline-secondary.disabled {
    color: #f0bc74;
    background-color: transparent;
}

.btn-outline-tertiary {
    color: #31316A;
    border-color: #31316A;
}

.btn-outline-tertiary:hover {
    color: #ffffff;
    background-color: #31316A;
    border-color: #31316A;
}

.btn-check:focus + .btn-outline-tertiary, .btn-outline-tertiary:focus {
    box-shadow: 0 0 0 0.18rem rgba(49, 49, 106, 0.5);
}

.btn-check:checked + .btn-outline-tertiary, .btn-check:active + .btn-outline-tertiary, .btn-outline-tertiary:active, .btn-outline-tertiary.active, .btn-outline-tertiary.dropdown-toggle.show {
    color: #ffffff;
    background-color: #31316A;
    border-color: #31316A;
}

.btn-check:checked + .btn-outline-tertiary:focus, .btn-check:active + .btn-outline-tertiary:focus, .btn-outline-tertiary:active:focus, .btn-outline-tertiary.active:focus, .btn-outline-tertiary.dropdown-toggle.show:focus {
    box-shadow: inset 0 3px 5px rgba(17, 24, 39, 0.125), 0 0 0 0.18rem rgba(49, 49, 106, 0.5);
}

.btn-outline-tertiary:disabled, .btn-outline-tertiary.disabled {
    color: #31316A;
    background-color: transparent;
}

.btn-outline-success {
    color: #10B981;
    border-color: #10B981;
}

.btn-outline-success:hover {
    color: #1F2937;
    background-color: #10B981;
    border-color: #10B981;
}

.btn-check:focus + .btn-outline-success, .btn-outline-success:focus {
    box-shadow: 0 0 0 0.18rem rgba(16, 185, 129, 0.5);
}

.btn-check:checked + .btn-outline-success, .btn-check:active + .btn-outline-success, .btn-outline-success:active, .btn-outline-success.active, .btn-outline-success.dropdown-toggle.show {
    color: #1F2937;
    background-color: #10B981;
    border-color: #10B981;
}

.btn-check:checked + .btn-outline-success:focus, .btn-check:active + .btn-outline-success:focus, .btn-outline-success:active:focus, .btn-outline-success.active:focus, .btn-outline-success.dropdown-toggle.show:focus {
    box-shadow: inset 0 3px 5px rgba(17, 24, 39, 0.125), 0 0 0 0.18rem rgba(16, 185, 129, 0.5);
}

.btn-outline-success:disabled, .btn-outline-success.disabled {
    color: #10B981;
    background-color: transparent;
}

.btn-outline-info {
    color: #2361ce;
    border-color: #2361ce;
}

.btn-outline-info:hover {
    color: #ffffff;
    background-color: #2361ce;
    border-color: #2361ce;
}

.btn-check:focus + .btn-outline-info, .btn-outline-info:focus {
    box-shadow: 0 0 0 0.18rem rgba(35, 97, 206, 0.5);
}

.btn-check:checked + .btn-outline-info, .btn-check:active + .btn-outline-info, .btn-outline-info:active, .btn-outline-info.active, .btn-outline-info.dropdown-toggle.show {
    color: #ffffff;
    background-color: #2361ce;
    border-color: #2361ce;
}

.btn-check:checked + .btn-outline-info:focus, .btn-check:active + .btn-outline-info:focus, .btn-outline-info:active:focus, .btn-outline-info.active:focus, .btn-outline-info.dropdown-toggle.show:focus {
    box-shadow: inset 0 3px 5px rgba(17, 24, 39, 0.125), 0 0 0 0.18rem rgba(35, 97, 206, 0.5);
}

.btn-outline-info:disabled, .btn-outline-info.disabled {
    color: #2361ce;
    background-color: transparent;
}

.btn-outline-warning {
    color: #f3c78e;
    border-color: #f3c78e;
}

.btn-outline-warning:hover {
    color: #1F2937;
    background-color: #f3c78e;
    border-color: #f3c78e;
}

.btn-check:focus + .btn-outline-warning, .btn-outline-warning:focus {
    box-shadow: 0 0 0 0.18rem rgba(243, 199, 142, 0.5);
}

.btn-check:checked + .btn-outline-warning, .btn-check:active + .btn-outline-warning, .btn-outline-warning:active, .btn-outline-warning.active, .btn-outline-warning.dropdown-toggle.show {
    color: #1F2937;
    background-color: #f3c78e;
    border-color: #f3c78e;
}

.btn-check:checked + .btn-outline-warning:focus, .btn-check:active + .btn-outline-warning:focus, .btn-outline-warning:active:focus, .btn-outline-warning.active:focus, .btn-outline-warning.dropdown-toggle.show:focus {
    box-shadow: inset 0 3px 5px rgba(17, 24, 39, 0.125), 0 0 0 0.18rem rgba(243, 199, 142, 0.5);
}

.btn-outline-warning:disabled, .btn-outline-warning.disabled {
    color: #f3c78e;
    background-color: transparent;
}

.btn-outline-danger {
    color: #E11D48;
    border-color: #E11D48;
}

.btn-outline-danger:hover {
    color: #ffffff;
    background-color: #E11D48;
    border-color: #E11D48;
}

.btn-check:focus + .btn-outline-danger, .btn-outline-danger:focus {
    box-shadow: 0 0 0 0.18rem rgba(225, 29, 72, 0.5);
}

.btn-check:checked + .btn-outline-danger, .btn-check:active + .btn-outline-danger, .btn-outline-danger:active, .btn-outline-danger.active, .btn-outline-danger.dropdown-toggle.show {
    color: #ffffff;
    background-color: #E11D48;
    border-color: #E11D48;
}

.btn-check:checked + .btn-outline-danger:focus, .btn-check:active + .btn-outline-danger:focus, .btn-outline-danger:active:focus, .btn-outline-danger.active:focus, .btn-outline-danger.dropdown-toggle.show:focus {
    box-shadow: inset 0 3px 5px rgba(17, 24, 39, 0.125), 0 0 0 0.18rem rgba(225, 29, 72, 0.5);
}

.btn-outline-danger:disabled, .btn-outline-danger.disabled {
    color: #E11D48;
    background-color: transparent;
}

.btn-outline-white {
    color: #ffffff;
    border-color: #ffffff;
}

.btn-outline-white:hover {
    color: #1F2937;
    background-color: #ffffff;
    border-color: #ffffff;
}

.btn-check:focus + .btn-outline-white, .btn-outline-white:focus {
    box-shadow: 0 0 0 0.18rem rgba(255, 255, 255, 0.5);
}

.btn-check:checked + .btn-outline-white, .btn-check:active + .btn-outline-white, .btn-outline-white:active, .btn-outline-white.active, .btn-outline-white.dropdown-toggle.show {
    color: #1F2937;
    background-color: #ffffff;
    border-color: #ffffff;
}

.btn-check:checked + .btn-outline-white:focus, .btn-check:active + .btn-outline-white:focus, .btn-outline-white:active:focus, .btn-outline-white.active:focus, .btn-outline-white.dropdown-toggle.show:focus {
    box-shadow: inset 0 3px 5px rgba(17, 24, 39, 0.125), 0 0 0 0.18rem rgba(255, 255, 255, 0.5);
}

.btn-outline-white:disabled, .btn-outline-white.disabled {
    color: #ffffff;
    background-color: transparent;
}

.btn-outline-indigo {
    color: #4F46E5;
    border-color: #4F46E5;
}

.btn-outline-indigo:hover {
    color: #ffffff;
    background-color: #4F46E5;
    border-color: #4F46E5;
}

.btn-check:focus + .btn-outline-indigo, .btn-outline-indigo:focus {
    box-shadow: 0 0 0 0.18rem rgba(79, 70, 229, 0.5);
}

.btn-check:checked + .btn-outline-indigo, .btn-check:active + .btn-outline-indigo, .btn-outline-indigo:active, .btn-outline-indigo.active, .btn-outline-indigo.dropdown-toggle.show {
    color: #ffffff;
    background-color: #4F46E5;
    border-color: #4F46E5;
}

.btn-check:checked + .btn-outline-indigo:focus, .btn-check:active + .btn-outline-indigo:focus, .btn-outline-indigo:active:focus, .btn-outline-indigo.active:focus, .btn-outline-indigo.dropdown-toggle.show:focus {
    box-shadow: inset 0 3px 5px rgba(17, 24, 39, 0.125), 0 0 0 0.18rem rgba(79, 70, 229, 0.5);
}

.btn-outline-indigo:disabled, .btn-outline-indigo.disabled {
    color: #4F46E5;
    background-color: transparent;
}

.btn-outline-purple {
    color: #7C3AED;
    border-color: #7C3AED;
}

.btn-outline-purple:hover {
    color: #ffffff;
    background-color: #7C3AED;
    border-color: #7C3AED;
}

.btn-check:focus + .btn-outline-purple, .btn-outline-purple:focus {
    box-shadow: 0 0 0 0.18rem rgba(124, 58, 237, 0.5);
}

.btn-check:checked + .btn-outline-purple, .btn-check:active + .btn-outline-purple, .btn-outline-purple:active, .btn-outline-purple.active, .btn-outline-purple.dropdown-toggle.show {
    color: #ffffff;
    background-color: #7C3AED;
    border-color: #7C3AED;
}

.btn-check:checked + .btn-outline-purple:focus, .btn-check:active + .btn-outline-purple:focus, .btn-outline-purple:active:focus, .btn-outline-purple.active:focus, .btn-outline-purple.dropdown-toggle.show:focus {
    box-shadow: inset 0 3px 5px rgba(17, 24, 39, 0.125), 0 0 0 0.18rem rgba(124, 58, 237, 0.5);
}

.btn-outline-purple:disabled, .btn-outline-purple.disabled {
    color: #7C3AED;
    background-color: transparent;
}

.btn-outline-yellow-100 {
    color: #ffeed6;
    border-color: #ffeed6;
}

.btn-outline-yellow-100:hover {
    color: #1F2937;
    background-color: #ffeed6;
    border-color: #ffeed6;
}

.btn-check:focus + .btn-outline-yellow-100, .btn-outline-yellow-100:focus {
    box-shadow: 0 0 0 0.18rem rgba(255, 238, 214, 0.5);
}

.btn-check:checked + .btn-outline-yellow-100, .btn-check:active + .btn-outline-yellow-100, .btn-outline-yellow-100:active, .btn-outline-yellow-100.active, .btn-outline-yellow-100.dropdown-toggle.show {
    color: #1F2937;
    background-color: #ffeed6;
    border-color: #ffeed6;
}

.btn-check:checked + .btn-outline-yellow-100:focus, .btn-check:active + .btn-outline-yellow-100:focus, .btn-outline-yellow-100:active:focus, .btn-outline-yellow-100.active:focus, .btn-outline-yellow-100.dropdown-toggle.show:focus {
    box-shadow: inset 0 3px 5px rgba(17, 24, 39, 0.125), 0 0 0 0.18rem rgba(255, 238, 214, 0.5);
}

.btn-outline-yellow-100:disabled, .btn-outline-yellow-100.disabled {
    color: #ffeed6;
    background-color: transparent;
}

.btn-outline-yellow-200 {
    color: #f5dbb8;
    border-color: #f5dbb8;
}

.btn-outline-yellow-200:hover {
    color: #1F2937;
    background-color: #f5dbb8;
    border-color: #f5dbb8;
}

.btn-check:focus + .btn-outline-yellow-200, .btn-outline-yellow-200:focus {
    box-shadow: 0 0 0 0.18rem rgba(245, 219, 184, 0.5);
}

.btn-check:checked + .btn-outline-yellow-200, .btn-check:active + .btn-outline-yellow-200, .btn-outline-yellow-200:active, .btn-outline-yellow-200.active, .btn-outline-yellow-200.dropdown-toggle.show {
    color: #1F2937;
    background-color: #f5dbb8;
    border-color: #f5dbb8;
}

.btn-check:checked + .btn-outline-yellow-200:focus, .btn-check:active + .btn-outline-yellow-200:focus, .btn-outline-yellow-200:active:focus, .btn-outline-yellow-200.active:focus, .btn-outline-yellow-200.dropdown-toggle.show:focus {
    box-shadow: inset 0 3px 5px rgba(17, 24, 39, 0.125), 0 0 0 0.18rem rgba(245, 219, 184, 0.5);
}

.btn-outline-yellow-200:disabled, .btn-outline-yellow-200.disabled {
    color: #f5dbb8;
    background-color: transparent;
}

.btn-outline-gray-50 {
    color: #F9FAFB;
    border-color: #F9FAFB;
}

.btn-outline-gray-50:hover {
    color: #1F2937;
    background-color: #F9FAFB;
    border-color: #F9FAFB;
}

.btn-check:focus + .btn-outline-gray-50, .btn-outline-gray-50:focus {
    box-shadow: 0 0 0 0.18rem rgba(249, 250, 251, 0.5);
}

.btn-check:checked + .btn-outline-gray-50, .btn-check:active + .btn-outline-gray-50, .btn-outline-gray-50:active, .btn-outline-gray-50.active, .btn-outline-gray-50.dropdown-toggle.show {
    color: #1F2937;
    background-color: #F9FAFB;
    border-color: #F9FAFB;
}

.btn-check:checked + .btn-outline-gray-50:focus, .btn-check:active + .btn-outline-gray-50:focus, .btn-outline-gray-50:active:focus, .btn-outline-gray-50.active:focus, .btn-outline-gray-50.dropdown-toggle.show:focus {
    box-shadow: inset 0 3px 5px rgba(17, 24, 39, 0.125), 0 0 0 0.18rem rgba(249, 250, 251, 0.5);
}

.btn-outline-gray-50:disabled, .btn-outline-gray-50.disabled {
    color: #F9FAFB;
    background-color: transparent;
}

.btn-outline-gray-100 {
    color: #F2F4F6;
    border-color: #F2F4F6;
}

.btn-outline-gray-100:hover {
    color: #1F2937;
    background-color: #F2F4F6;
    border-color: #F2F4F6;
}

.btn-check:focus + .btn-outline-gray-100, .btn-outline-gray-100:focus {
    box-shadow: 0 0 0 0.18rem rgba(242, 244, 246, 0.5);
}

.btn-check:checked + .btn-outline-gray-100, .btn-check:active + .btn-outline-gray-100, .btn-outline-gray-100:active, .btn-outline-gray-100.active, .btn-outline-gray-100.dropdown-toggle.show {
    color: #1F2937;
    background-color: #F2F4F6;
    border-color: #F2F4F6;
}

.btn-check:checked + .btn-outline-gray-100:focus, .btn-check:active + .btn-outline-gray-100:focus, .btn-outline-gray-100:active:focus, .btn-outline-gray-100.active:focus, .btn-outline-gray-100.dropdown-toggle.show:focus {
    box-shadow: inset 0 3px 5px rgba(17, 24, 39, 0.125), 0 0 0 0.18rem rgba(242, 244, 246, 0.5);
}

.btn-outline-gray-100:disabled, .btn-outline-gray-100.disabled {
    color: #F2F4F6;
    background-color: transparent;
}

.btn-outline-gray-200 {
    color: #E5E7EB;
    border-color: #E5E7EB;
}

.btn-outline-gray-200:hover {
    color: #1F2937;
    background-color: #E5E7EB;
    border-color: #E5E7EB;
}

.btn-check:focus + .btn-outline-gray-200, .btn-outline-gray-200:focus {
    box-shadow: 0 0 0 0.18rem rgba(229, 231, 235, 0.5);
}

.btn-check:checked + .btn-outline-gray-200, .btn-check:active + .btn-outline-gray-200, .btn-outline-gray-200:active, .btn-outline-gray-200.active, .btn-outline-gray-200.dropdown-toggle.show {
    color: #1F2937;
    background-color: #E5E7EB;
    border-color: #E5E7EB;
}

.btn-check:checked + .btn-outline-gray-200:focus, .btn-check:active + .btn-outline-gray-200:focus, .btn-outline-gray-200:active:focus, .btn-outline-gray-200.active:focus, .btn-outline-gray-200.dropdown-toggle.show:focus {
    box-shadow: inset 0 3px 5px rgba(17, 24, 39, 0.125), 0 0 0 0.18rem rgba(229, 231, 235, 0.5);
}

.btn-outline-gray-200:disabled, .btn-outline-gray-200.disabled {
    color: #E5E7EB;
    background-color: transparent;
}

.btn-outline-gray-300 {
    color: #D1D5DB;
    border-color: #D1D5DB;
}

.btn-outline-gray-300:hover {
    color: #1F2937;
    background-color: #D1D5DB;
    border-color: #D1D5DB;
}

.btn-check:focus + .btn-outline-gray-300, .btn-outline-gray-300:focus {
    box-shadow: 0 0 0 0.18rem rgba(209, 213, 219, 0.5);
}

.btn-check:checked + .btn-outline-gray-300, .btn-check:active + .btn-outline-gray-300, .btn-outline-gray-300:active, .btn-outline-gray-300.active, .btn-outline-gray-300.dropdown-toggle.show {
    color: #1F2937;
    background-color: #D1D5DB;
    border-color: #D1D5DB;
}

.btn-check:checked + .btn-outline-gray-300:focus, .btn-check:active + .btn-outline-gray-300:focus, .btn-outline-gray-300:active:focus, .btn-outline-gray-300.active:focus, .btn-outline-gray-300.dropdown-toggle.show:focus {
    box-shadow: inset 0 3px 5px rgba(17, 24, 39, 0.125), 0 0 0 0.18rem rgba(209, 213, 219, 0.5);
}

.btn-outline-gray-300:disabled, .btn-outline-gray-300.disabled {
    color: #D1D5DB;
    background-color: transparent;
}

.btn-outline-gray-400 {
    color: #9CA3AF;
    border-color: #9CA3AF;
}

.btn-outline-gray-400:hover {
    color: #1F2937;
    background-color: #9CA3AF;
    border-color: #9CA3AF;
}

.btn-check:focus + .btn-outline-gray-400, .btn-outline-gray-400:focus {
    box-shadow: 0 0 0 0.18rem rgba(156, 163, 175, 0.5);
}

.btn-check:checked + .btn-outline-gray-400, .btn-check:active + .btn-outline-gray-400, .btn-outline-gray-400:active, .btn-outline-gray-400.active, .btn-outline-gray-400.dropdown-toggle.show {
    color: #1F2937;
    background-color: #9CA3AF;
    border-color: #9CA3AF;
}

.btn-check:checked + .btn-outline-gray-400:focus, .btn-check:active + .btn-outline-gray-400:focus, .btn-outline-gray-400:active:focus, .btn-outline-gray-400.active:focus, .btn-outline-gray-400.dropdown-toggle.show:focus {
    box-shadow: inset 0 3px 5px rgba(17, 24, 39, 0.125), 0 0 0 0.18rem rgba(156, 163, 175, 0.5);
}

.btn-outline-gray-400:disabled, .btn-outline-gray-400.disabled {
    color: #9CA3AF;
    background-color: transparent;
}

.btn-outline-gray-500 {
    color: #6B7280;
    border-color: #6B7280;
}

.btn-outline-gray-500:hover {
    color: #ffffff;
    background-color: #6B7280;
    border-color: #6B7280;
}

.btn-check:focus + .btn-outline-gray-500, .btn-outline-gray-500:focus {
    box-shadow: 0 0 0 0.18rem rgba(107, 114, 128, 0.5);
}

.btn-check:checked + .btn-outline-gray-500, .btn-check:active + .btn-outline-gray-500, .btn-outline-gray-500:active, .btn-outline-gray-500.active, .btn-outline-gray-500.dropdown-toggle.show {
    color: #ffffff;
    background-color: #6B7280;
    border-color: #6B7280;
}

.btn-check:checked + .btn-outline-gray-500:focus, .btn-check:active + .btn-outline-gray-500:focus, .btn-outline-gray-500:active:focus, .btn-outline-gray-500.active:focus, .btn-outline-gray-500.dropdown-toggle.show:focus {
    box-shadow: inset 0 3px 5px rgba(17, 24, 39, 0.125), 0 0 0 0.18rem rgba(107, 114, 128, 0.5);
}

.btn-outline-gray-500:disabled, .btn-outline-gray-500.disabled {
    color: #6B7280;
    background-color: transparent;
}

.btn-outline-gray-600 {
    color: #4B5563;
    border-color: #4B5563;
}

.btn-outline-gray-600:hover {
    color: #ffffff;
    background-color: #4B5563;
    border-color: #4B5563;
}

.btn-check:focus + .btn-outline-gray-600, .btn-outline-gray-600:focus {
    box-shadow: 0 0 0 0.18rem rgba(75, 85, 99, 0.5);
}

.btn-check:checked + .btn-outline-gray-600, .btn-check:active + .btn-outline-gray-600, .btn-outline-gray-600:active, .btn-outline-gray-600.active, .btn-outline-gray-600.dropdown-toggle.show {
    color: #ffffff;
    background-color: #4B5563;
    border-color: #4B5563;
}

.btn-check:checked + .btn-outline-gray-600:focus, .btn-check:active + .btn-outline-gray-600:focus, .btn-outline-gray-600:active:focus, .btn-outline-gray-600.active:focus, .btn-outline-gray-600.dropdown-toggle.show:focus {
    box-shadow: inset 0 3px 5px rgba(17, 24, 39, 0.125), 0 0 0 0.18rem rgba(75, 85, 99, 0.5);
}

.btn-outline-gray-600:disabled, .btn-outline-gray-600.disabled {
    color: #4B5563;
    background-color: transparent;
}

.btn-outline-gray-700 {
    color: #374151;
    border-color: #374151;
}

.btn-outline-gray-700:hover {
    color: #ffffff;
    background-color: #374151;
    border-color: #374151;
}

.btn-check:focus + .btn-outline-gray-700, .btn-outline-gray-700:focus {
    box-shadow: 0 0 0 0.18rem rgba(55, 65, 81, 0.5);
}

.btn-check:checked + .btn-outline-gray-700, .btn-check:active + .btn-outline-gray-700, .btn-outline-gray-700:active, .btn-outline-gray-700.active, .btn-outline-gray-700.dropdown-toggle.show {
    color: #ffffff;
    background-color: #374151;
    border-color: #374151;
}

.btn-check:checked + .btn-outline-gray-700:focus, .btn-check:active + .btn-outline-gray-700:focus, .btn-outline-gray-700:active:focus, .btn-outline-gray-700.active:focus, .btn-outline-gray-700.dropdown-toggle.show:focus {
    box-shadow: inset 0 3px 5px rgba(17, 24, 39, 0.125), 0 0 0 0.18rem rgba(55, 65, 81, 0.5);
}

.btn-outline-gray-700:disabled, .btn-outline-gray-700.disabled {
    color: #374151;
    background-color: transparent;
}

.btn-outline-gray-800 {
    color: #1F2937;
    border-color: #1F2937;
}

.btn-outline-gray-800:hover {
    color: #ffffff;
    background-color: #1F2937;
    border-color: #1F2937;
}

.btn-check:focus + .btn-outline-gray-800, .btn-outline-gray-800:focus {
    box-shadow: 0 0 0 0.18rem rgba(31, 41, 55, 0.5);
}

.btn-check:checked + .btn-outline-gray-800, .btn-check:active + .btn-outline-gray-800, .btn-outline-gray-800:active, .btn-outline-gray-800.active, .btn-outline-gray-800.dropdown-toggle.show {
    color: #ffffff;
    background-color: #1F2937;
    border-color: #1F2937;
}

.btn-check:checked + .btn-outline-gray-800:focus, .btn-check:active + .btn-outline-gray-800:focus, .btn-outline-gray-800:active:focus, .btn-outline-gray-800.active:focus, .btn-outline-gray-800.dropdown-toggle.show:focus {
    box-shadow: inset 0 3px 5px rgba(17, 24, 39, 0.125), 0 0 0 0.18rem rgba(31, 41, 55, 0.5);
}

.btn-outline-gray-800:disabled, .btn-outline-gray-800.disabled {
    color: #1F2937;
    background-color: transparent;
}

.btn-outline-gray-900 {
    color: #111827;
    border-color: #111827;
}

.btn-outline-gray-900:hover {
    color: #ffffff;
    background-color: #111827;
    border-color: #111827;
}

.btn-check:focus + .btn-outline-gray-900, .btn-outline-gray-900:focus {
    box-shadow: 0 0 0 0.18rem rgba(17, 24, 39, 0.5);
}

.btn-check:checked + .btn-outline-gray-900, .btn-check:active + .btn-outline-gray-900, .btn-outline-gray-900:active, .btn-outline-gray-900.active, .btn-outline-gray-900.dropdown-toggle.show {
    color: #ffffff;
    background-color: #111827;
    border-color: #111827;
}

.btn-check:checked + .btn-outline-gray-900:focus, .btn-check:active + .btn-outline-gray-900:focus, .btn-outline-gray-900:active:focus, .btn-outline-gray-900.active:focus, .btn-outline-gray-900.dropdown-toggle.show:focus {
    box-shadow: inset 0 3px 5px rgba(17, 24, 39, 0.125), 0 0 0 0.18rem rgba(17, 24, 39, 0.5);
}

.btn-outline-gray-900:disabled, .btn-outline-gray-900.disabled {
    color: #111827;
    background-color: transparent;
}

.btn-link {
    font-weight: 400;
    color: #1F2937;
    text-decoration: none;
}

.btn-link:hover {
    color: black;
    text-decoration: none;
}

.btn-link:focus {
    text-decoration: none;
}

.btn-link:disabled, .btn-link.disabled {
    color: #4B5563;
}

.btn-lg, .btn-group-lg > .btn {
    padding: 0.5rem 1rem;
    font-size: 1.25rem;
    border-radius: 0.5rem;
}

.btn-sm, .btn-group-sm > .btn {
    padding: 0.375rem 0.625rem;
    font-size: 0.875rem;
    border-radius: 0.5rem;
}

.fade {
    transition: opacity 0.15s linear;
}

@media (prefers-reduced-motion: reduce) {
    .fade {
        transition: none;
    }
}

.fade:not(.show) {
    opacity: 0;
}

.collapse:not(.show) {
    display: none;
}

.collapsing {
    height: 0;
    overflow: hidden;
    transition: height 0.35s ease;
}

@media (prefers-reduced-motion: reduce) {
    .collapsing {
        transition: none;
    }
}

.collapsing.collapse-horizontal {
    width: 0;
    height: auto;
    transition: width 0.35s ease;
}

@media (prefers-reduced-motion: reduce) {
    .collapsing.collapse-horizontal {
        transition: none;
    }
}

.dropup,
.dropend,
.dropdown,
.dropstart {
    position: relative;
}

.dropdown-toggle {
    white-space: nowrap;
}

.dropdown-toggle::after {
    display: inline-block;
    margin-left: 0.255em;
    vertical-align: 0.255em;
    content: "";
    border-top: 0.3em solid;
    border-right: 0.3em solid transparent;
    border-bottom: 0;
    border-left: 0.3em solid transparent;
}

.dropdown-toggle:empty::after {
    margin-left: 0;
}

.dropdown-menu {
    position: absolute;
    z-index: 1000;
    display: none;
    min-width: 12rem;
    padding: 0.5rem 0;
    margin: 0;
    font-size: 0.875rem;
    color: #374151;
    text-align: left;
    list-style: none;
    background-color: #ffffff;
    background-clip: padding-box;
    border: 0.0625rem solid #E5E7EB;
    border-radius: 0.35rem;
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
}

.dropdown-menu[data-bs-popper] {
    top: 100%;
    left: 0;
    margin-top: 0.125rem;
}

.dropdown-menu-start {
    --bs-position: start;
}

.dropdown-menu-start[data-bs-popper] {
    right: auto;
    left: 0;
}

.dropdown-menu-end {
    --bs-position: end;
}

.dropdown-menu-end[data-bs-popper] {
    right: 0;
    left: auto;
}

@media (min-width: 576px) {
    .dropdown-menu-sm-start {
        --bs-position: start;
    }

    .dropdown-menu-sm-start[data-bs-popper] {
        right: auto;
        left: 0;
    }

    .dropdown-menu-sm-end {
        --bs-position: end;
    }

    .dropdown-menu-sm-end[data-bs-popper] {
        right: 0;
        left: auto;
    }
}

@media (min-width: 768px) {
    .dropdown-menu-md-start {
        --bs-position: start;
    }

    .dropdown-menu-md-start[data-bs-popper] {
        right: auto;
        left: 0;
    }

    .dropdown-menu-md-end {
        --bs-position: end;
    }

    .dropdown-menu-md-end[data-bs-popper] {
        right: 0;
        left: auto;
    }
}

@media (min-width: 992px) {
    .dropdown-menu-lg-start {
        --bs-position: start;
    }

    .dropdown-menu-lg-start[data-bs-popper] {
        right: auto;
        left: 0;
    }

    .dropdown-menu-lg-end {
        --bs-position: end;
    }

    .dropdown-menu-lg-end[data-bs-popper] {
        right: 0;
        left: auto;
    }
}

@media (min-width: 1200px) {
    .dropdown-menu-xl-start {
        --bs-position: start;
    }

    .dropdown-menu-xl-start[data-bs-popper] {
        right: auto;
        left: 0;
    }

    .dropdown-menu-xl-end {
        --bs-position: end;
    }

    .dropdown-menu-xl-end[data-bs-popper] {
        right: 0;
        left: auto;
    }
}

@media (min-width: 1400px) {
    .dropdown-menu-xxl-start {
        --bs-position: start;
    }

    .dropdown-menu-xxl-start[data-bs-popper] {
        right: auto;
        left: 0;
    }

    .dropdown-menu-xxl-end {
        --bs-position: end;
    }

    .dropdown-menu-xxl-end[data-bs-popper] {
        right: 0;
        left: auto;
    }
}

.dropup .dropdown-menu[data-bs-popper] {
    top: auto;
    bottom: 100%;
    margin-top: 0;
    margin-bottom: 0.125rem;
}

.dropup .dropdown-toggle::after {
    display: inline-block;
    margin-left: 0.255em;
    vertical-align: 0.255em;
    content: "";
    border-top: 0;
    border-right: 0.3em solid transparent;
    border-bottom: 0.3em solid;
    border-left: 0.3em solid transparent;
}

.dropup .dropdown-toggle:empty::after {
    margin-left: 0;
}

.dropend .dropdown-menu[data-bs-popper] {
    top: 0;
    right: auto;
    left: 100%;
    margin-top: 0;
    margin-left: 0.125rem;
}

.dropend .dropdown-toggle::after {
    display: inline-block;
    margin-left: 0.255em;
    vertical-align: 0.255em;
    content: "";
    border-top: 0.3em solid transparent;
    border-right: 0;
    border-bottom: 0.3em solid transparent;
    border-left: 0.3em solid;
}

.dropend .dropdown-toggle:empty::after {
    margin-left: 0;
}

.dropend .dropdown-toggle::after {
    vertical-align: 0;
}

.dropstart .dropdown-menu[data-bs-popper] {
    top: 0;
    right: 100%;
    left: auto;
    margin-top: 0;
    margin-right: 0.125rem;
}

.dropstart .dropdown-toggle::after {
    display: inline-block;
    margin-left: 0.255em;
    vertical-align: 0.255em;
    content: "";
}

.dropstart .dropdown-toggle::after {
    display: none;
}

.dropstart .dropdown-toggle::before {
    display: inline-block;
    margin-right: 0.255em;
    vertical-align: 0.255em;
    content: "";
    border-top: 0.3em solid transparent;
    border-right: 0.3em solid;
    border-bottom: 0.3em solid transparent;
}

.dropstart .dropdown-toggle:empty::after {
    margin-left: 0;
}

.dropstart .dropdown-toggle::before {
    vertical-align: 0;
}

.dropdown-divider {
    height: 0;
    margin: 0.5rem 0;
    overflow: hidden;
    border-top: 1px solid #E5E7EB;
}

.dropdown-item {
    display: block;
    width: 100%;
    padding: 0.25rem 1rem;
    clear: both;
    font-weight: 400;
    color: #111827;
    text-align: inherit;
    white-space: nowrap;
    background-color: transparent;
    border: 0;
}

.dropdown-item:hover, .dropdown-item:focus {
    color: #090d15;
    background-color: #F2F4F6;
}

.dropdown-item.active, .dropdown-item:active {
    color: #111827;
    text-decoration: none;
    background-color: #E5E7EB;
}

.dropdown-item.disabled, .dropdown-item:disabled {
    color: #4B5563;
    pointer-events: none;
    background-color: transparent;
}

.dropdown-menu.show {
    display: block;
}

.dropdown-header {
    display: block;
    padding: 0.5rem 1rem;
    margin-bottom: 0;
    font-size: 0.875rem;
    color: #111827;
    white-space: nowrap;
}

.dropdown-item-text {
    display: block;
    padding: 0.25rem 1rem;
    color: #111827;
}

.dropdown-menu-dark {
    color: #D1D5DB;
    background-color: #1F2937;
    border-color: #E5E7EB;
}

.dropdown-menu-dark .dropdown-item {
    color: #D1D5DB;
}

.dropdown-menu-dark .dropdown-item:hover, .dropdown-menu-dark .dropdown-item:focus {
    color: #ffffff;
    background-color: rgba(255, 255, 255, 0.15);
}

.dropdown-menu-dark .dropdown-item.active, .dropdown-menu-dark .dropdown-item:active {
    color: #111827;
    background-color: #E5E7EB;
}

.dropdown-menu-dark .dropdown-item.disabled, .dropdown-menu-dark .dropdown-item:disabled {
    color: #6B7280;
}

.dropdown-menu-dark .dropdown-divider {
    border-color: #E5E7EB;
}

.dropdown-menu-dark .dropdown-item-text {
    color: #D1D5DB;
}

.dropdown-menu-dark .dropdown-header {
    color: #6B7280;
}

.btn-group,
.btn-group-vertical {
    position: relative;
    display: inline-flex;
    vertical-align: middle;
}

.btn-group > .btn,
.btn-group-vertical > .btn {
    position: relative;
    flex: 1 1 auto;
}

.btn-group > .btn-check:checked + .btn,
.btn-group > .btn-check:focus + .btn,
.btn-group > .btn:hover,
.btn-group > .btn:focus,
.btn-group > .btn:active,
.btn-group > .btn.active,
.btn-group-vertical > .btn-check:checked + .btn,
.btn-group-vertical > .btn-check:focus + .btn,
.btn-group-vertical > .btn:hover,
.btn-group-vertical > .btn:focus,
.btn-group-vertical > .btn:active,
.btn-group-vertical > .btn.active {
    z-index: 1;
}

.btn-toolbar {
    display: flex;
    flex-wrap: wrap;
    justify-content: flex-start;
}

.btn-toolbar .input-group {
    width: auto;
}

.btn-group > .btn:not(:first-child),
.btn-group > .btn-group:not(:first-child) {
    margin-left: -0.0625rem;
}

.btn-group > .btn:not(:last-child):not(.dropdown-toggle),
.btn-group > .btn-group:not(:last-child) > .btn {
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
}

.btn-group > .btn:nth-child(n+3),
.btn-group > :not(.btn-check) + .btn,
.btn-group > .btn-group:not(:first-child) > .btn {
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
}

.dropdown-toggle-split {
    padding-right: 0.75rem;
    padding-left: 0.75rem;
}

.dropdown-toggle-split::after, .dropup .dropdown-toggle-split::after, .dropend .dropdown-toggle-split::after {
    margin-left: 0;
}

.dropstart .dropdown-toggle-split::before {
    margin-right: 0;
}

.btn-sm + .dropdown-toggle-split, .btn-group-sm > .btn + .dropdown-toggle-split {
    padding-right: 0.46875rem;
    padding-left: 0.46875rem;
}

.btn-lg + .dropdown-toggle-split, .btn-group-lg > .btn + .dropdown-toggle-split {
    padding-right: 0.75rem;
    padding-left: 0.75rem;
}

.btn-group.show .dropdown-toggle {
    box-shadow: inset 0 3px 5px rgba(17, 24, 39, 0.125);
}

.btn-group.show .dropdown-toggle.btn-link {
    box-shadow: none;
}

.btn-group-vertical {
    flex-direction: column;
    align-items: flex-start;
    justify-content: center;
}

.btn-group-vertical > .btn,
.btn-group-vertical > .btn-group {
    width: 100%;
}

.btn-group-vertical > .btn:not(:first-child),
.btn-group-vertical > .btn-group:not(:first-child) {
    margin-top: -0.0625rem;
}

.btn-group-vertical > .btn:not(:last-child):not(.dropdown-toggle),
.btn-group-vertical > .btn-group:not(:last-child) > .btn {
    border-bottom-right-radius: 0;
    border-bottom-left-radius: 0;
}

.btn-group-vertical > .btn ~ .btn,
.btn-group-vertical > .btn-group:not(:first-child) > .btn {
    border-top-left-radius: 0;
    border-top-right-radius: 0;
}

.nav {
    display: flex;
    flex-wrap: wrap;
    padding-left: 0;
    margin-bottom: 0;
    list-style: none;
}

.nav-link {
    display: block;
    padding: 0.5rem 1rem;
    color: #1F2937;
    transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out;
}

@media (prefers-reduced-motion: reduce) {
    .nav-link {
        transition: none;
    }
}

.nav-link:hover, .nav-link:focus {
    color: #1F2937;
}

.nav-link.disabled {
    color: #4B5563;
    pointer-events: none;
    cursor: default;
}

.nav-tabs {
    border-bottom: 0.0625rem solid #9CA3AF;
}

.nav-tabs .nav-link {
    margin-bottom: -0.0625rem;
    background: none;
    border: 0.0625rem solid transparent;
    border-top-left-radius: 0.5rem;
    border-top-right-radius: 0.5rem;
}

.nav-tabs .nav-link:hover, .nav-tabs .nav-link:focus {
    border-color: #E5E7EB #E5E7EB #9CA3AF;
    isolation: isolate;
}

.nav-tabs .nav-link.disabled {
    color: #4B5563;
    background-color: transparent;
    border-color: transparent;
}

.nav-tabs .nav-link.active,
.nav-tabs .nav-item.show .nav-link {
    color: #374151;
    background-color: #9CA3AF;
    border-color: #9CA3AF;
}

.nav-tabs .dropdown-menu {
    margin-top: -0.0625rem;
    border-top-left-radius: 0;
    border-top-right-radius: 0;
}

.nav-pills .nav-link {
    background: none;
    border: 0;
    border-radius: 0.5rem;
}

.nav-pills .nav-link.active,
.nav-pills .show > .nav-link {
    color: #1F2937;
    background-color: #f8f8f8;
}

.nav-fill > .nav-link,
.nav-fill .nav-item {
    flex: 1 1 auto;
    text-align: center;
}

.nav-justified > .nav-link,
.nav-justified .nav-item {
    flex-basis: 0;
    flex-grow: 1;
    text-align: center;
}

.nav-fill .nav-item .nav-link,
.nav-justified .nav-item .nav-link {
    width: 100%;
}

.tab-content > .tab-pane {
    display: none;
}

.tab-content > .active {
    display: block;
}

.navbar {
    position: relative;
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-between;
    padding-top: 1rem;
    padding-bottom: 1rem;
}

.navbar > .container,
.navbar > .container-fluid,
.navbar > .container-sm,
.navbar > .container-md,
.navbar > .container-lg,
.navbar > .container-xl {
    display: flex;
    flex-wrap: inherit;
    align-items: center;
    justify-content: space-between;
}

.navbar-brand {
    padding-top: 0;
    padding-bottom: 0;
    margin-right: 1rem;
    font-size: 1.25rem;
    white-space: nowrap;
}

.navbar-nav {
    display: flex;
    flex-direction: column;
    padding-left: 0;
    margin-bottom: 0;
    list-style: none;
}

.navbar-nav .nav-link {
    padding-right: 0;
    padding-left: 0;
}

.navbar-nav .dropdown-menu {
    position: static;
}

.navbar-text {
    padding-top: 0.5rem;
    padding-bottom: 0.5rem;
}

.navbar-collapse {
    flex-basis: 100%;
    flex-grow: 1;
    align-items: center;
}

.navbar-toggler {
    padding: 0.4rem 0.6rem;
    font-size: 1.25rem;
    line-height: 1;
    background-color: transparent;
    border: 0.0625rem solid transparent;
    border-radius: 0.5rem;
    transition: box-shadow 0.15s ease-in-out;
}

@media (prefers-reduced-motion: reduce) {
    .navbar-toggler {
        transition: none;
    }
}

.navbar-toggler:hover {
    text-decoration: none;
}

.navbar-toggler:focus {
    text-decoration: none;
    outline: 0;
    box-shadow: 0 0 0 0.18rem;
}

.navbar-toggler-icon {
    display: inline-block;
    width: 1.5em;
    height: 1.5em;
    vertical-align: middle;
    background-repeat: no-repeat;
    background-position: center;
    background-size: 100%;
}

.navbar-nav-scroll {
    max-height: var(--bs-scroll-height, 75vh);
    overflow-y: auto;
}

@media (min-width: 576px) {
    .navbar-expand-sm {
        flex-wrap: nowrap;
        justify-content: flex-start;
    }

    .navbar-expand-sm .navbar-nav {
        flex-direction: row;
    }

    .navbar-expand-sm .navbar-nav .dropdown-menu {
        position: absolute;
    }

    .navbar-expand-sm .navbar-nav .nav-link {
        padding-right: 0.8rem;
        padding-left: 0.8rem;
    }

    .navbar-expand-sm .navbar-nav-scroll {
        overflow: visible;
    }

    .navbar-expand-sm .navbar-collapse {
        display: flex !important;
        flex-basis: auto;
    }

    .navbar-expand-sm .navbar-toggler {
        display: none;
    }

    .navbar-expand-sm .offcanvas-header {
        display: none;
    }

    .navbar-expand-sm .offcanvas {
        position: inherit;
        bottom: 0;
        z-index: 1000;
        flex-grow: 1;
        visibility: visible !important;
        background-color: transparent;
        border-right: 0;
        border-left: 0;
        transition: none;
        transform: none;
    }

    .navbar-expand-sm .offcanvas-top,
.navbar-expand-sm .offcanvas-bottom {
        height: auto;
        border-top: 0;
        border-bottom: 0;
    }

    .navbar-expand-sm .offcanvas-body {
        display: flex;
        flex-grow: 0;
        padding: 0;
        overflow-y: visible;
    }
}

@media (min-width: 768px) {
    .navbar-expand-md {
        flex-wrap: nowrap;
        justify-content: flex-start;
    }

    .navbar-expand-md .navbar-nav {
        flex-direction: row;
    }

    .navbar-expand-md .navbar-nav .dropdown-menu {
        position: absolute;
    }

    .navbar-expand-md .navbar-nav .nav-link {
        padding-right: 0.8rem;
        padding-left: 0.8rem;
    }

    .navbar-expand-md .navbar-nav-scroll {
        overflow: visible;
    }

    .navbar-expand-md .navbar-collapse {
        display: flex !important;
        flex-basis: auto;
    }

    .navbar-expand-md .navbar-toggler {
        display: none;
    }

    .navbar-expand-md .offcanvas-header {
        display: none;
    }

    .navbar-expand-md .offcanvas {
        position: inherit;
        bottom: 0;
        z-index: 1000;
        flex-grow: 1;
        visibility: visible !important;
        background-color: transparent;
        border-right: 0;
        border-left: 0;
        transition: none;
        transform: none;
    }

    .navbar-expand-md .offcanvas-top,
.navbar-expand-md .offcanvas-bottom {
        height: auto;
        border-top: 0;
        border-bottom: 0;
    }

    .navbar-expand-md .offcanvas-body {
        display: flex;
        flex-grow: 0;
        padding: 0;
        overflow-y: visible;
    }
}

@media (min-width: 992px) {
    .navbar-expand-lg {
        flex-wrap: nowrap;
        justify-content: flex-start;
    }

    .navbar-expand-lg .navbar-nav {
        flex-direction: row;
    }

    .navbar-expand-lg .navbar-nav .dropdown-menu {
        position: absolute;
    }

    .navbar-expand-lg .navbar-nav .nav-link {
        padding-right: 0.8rem;
        padding-left: 0.8rem;
    }

    .navbar-expand-lg .navbar-nav-scroll {
        overflow: visible;
    }

    .navbar-expand-lg .navbar-collapse {
        display: flex !important;
        flex-basis: auto;
    }

    .navbar-expand-lg .navbar-toggler {
        display: none;
    }

    .navbar-expand-lg .offcanvas-header {
        display: none;
    }

    .navbar-expand-lg .offcanvas {
        position: inherit;
        bottom: 0;
        z-index: 1000;
        flex-grow: 1;
        visibility: visible !important;
        background-color: transparent;
        border-right: 0;
        border-left: 0;
        transition: none;
        transform: none;
    }

    .navbar-expand-lg .offcanvas-top,
.navbar-expand-lg .offcanvas-bottom {
        height: auto;
        border-top: 0;
        border-bottom: 0;
    }

    .navbar-expand-lg .offcanvas-body {
        display: flex;
        flex-grow: 0;
        padding: 0;
        overflow-y: visible;
    }
}

@media (min-width: 1200px) {
    .navbar-expand-xl {
        flex-wrap: nowrap;
        justify-content: flex-start;
    }

    .navbar-expand-xl .navbar-nav {
        flex-direction: row;
    }

    .navbar-expand-xl .navbar-nav .dropdown-menu {
        position: absolute;
    }

    .navbar-expand-xl .navbar-nav .nav-link {
        padding-right: 0.8rem;
        padding-left: 0.8rem;
    }

    .navbar-expand-xl .navbar-nav-scroll {
        overflow: visible;
    }

    .navbar-expand-xl .navbar-collapse {
        display: flex !important;
        flex-basis: auto;
    }

    .navbar-expand-xl .navbar-toggler {
        display: none;
    }

    .navbar-expand-xl .offcanvas-header {
        display: none;
    }

    .navbar-expand-xl .offcanvas {
        position: inherit;
        bottom: 0;
        z-index: 1000;
        flex-grow: 1;
        visibility: visible !important;
        background-color: transparent;
        border-right: 0;
        border-left: 0;
        transition: none;
        transform: none;
    }

    .navbar-expand-xl .offcanvas-top,
.navbar-expand-xl .offcanvas-bottom {
        height: auto;
        border-top: 0;
        border-bottom: 0;
    }

    .navbar-expand-xl .offcanvas-body {
        display: flex;
        flex-grow: 0;
        padding: 0;
        overflow-y: visible;
    }
}

@media (min-width: 1400px) {
    .navbar-expand-xxl {
        flex-wrap: nowrap;
        justify-content: flex-start;
    }

    .navbar-expand-xxl .navbar-nav {
        flex-direction: row;
    }

    .navbar-expand-xxl .navbar-nav .dropdown-menu {
        position: absolute;
    }

    .navbar-expand-xxl .navbar-nav .nav-link {
        padding-right: 0.8rem;
        padding-left: 0.8rem;
    }

    .navbar-expand-xxl .navbar-nav-scroll {
        overflow: visible;
    }

    .navbar-expand-xxl .navbar-collapse {
        display: flex !important;
        flex-basis: auto;
    }

    .navbar-expand-xxl .navbar-toggler {
        display: none;
    }

    .navbar-expand-xxl .offcanvas-header {
        display: none;
    }

    .navbar-expand-xxl .offcanvas {
        position: inherit;
        bottom: 0;
        z-index: 1000;
        flex-grow: 1;
        visibility: visible !important;
        background-color: transparent;
        border-right: 0;
        border-left: 0;
        transition: none;
        transform: none;
    }

    .navbar-expand-xxl .offcanvas-top,
.navbar-expand-xxl .offcanvas-bottom {
        height: auto;
        border-top: 0;
        border-bottom: 0;
    }

    .navbar-expand-xxl .offcanvas-body {
        display: flex;
        flex-grow: 0;
        padding: 0;
        overflow-y: visible;
    }
}

.navbar-expand {
    flex-wrap: nowrap;
    justify-content: flex-start;
}

.navbar-expand .navbar-nav {
    flex-direction: row;
}

.navbar-expand .navbar-nav .dropdown-menu {
    position: absolute;
}

.navbar-expand .navbar-nav .nav-link {
    padding-right: 0.8rem;
    padding-left: 0.8rem;
}

.navbar-expand .navbar-nav-scroll {
    overflow: visible;
}

.navbar-expand .navbar-collapse {
    display: flex !important;
    flex-basis: auto;
}

.navbar-expand .navbar-toggler {
    display: none;
}

.navbar-expand .offcanvas-header {
    display: none;
}

.navbar-expand .offcanvas {
    position: inherit;
    bottom: 0;
    z-index: 1000;
    flex-grow: 1;
    visibility: visible !important;
    background-color: transparent;
    border-right: 0;
    border-left: 0;
    transition: none;
    transform: none;
}

.navbar-expand .offcanvas-top,
.navbar-expand .offcanvas-bottom {
    height: auto;
    border-top: 0;
    border-bottom: 0;
}

.navbar-expand .offcanvas-body {
    display: flex;
    flex-grow: 0;
    padding: 0;
    overflow-y: visible;
}

.navbar-light .navbar-brand {
    color: #111827;
}

.navbar-light .navbar-brand:hover, .navbar-light .navbar-brand:focus {
    color: #111827;
}

.navbar-light .navbar-nav .nav-link {
    color: rgba(17, 24, 39, 0.9);
}

.navbar-light .navbar-nav .nav-link:hover, .navbar-light .navbar-nav .nav-link:focus {
    color: #111827;
}

.navbar-light .navbar-nav .nav-link.disabled {
    color: rgba(17, 24, 39, 0.9);
}

.navbar-light .navbar-nav .show > .nav-link,
.navbar-light .navbar-nav .nav-link.active {
    color: #111827;
}

.navbar-light .navbar-toggler {
    color: rgba(17, 24, 39, 0.9);
    border-color: rgba(17, 24, 39, 0.1);
}

.navbar-light .navbar-toggler-icon {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%2817, 24, 39, 0.9%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
}

.navbar-light .navbar-text {
    color: rgba(17, 24, 39, 0.9);
}

.navbar-light .navbar-text a,
.navbar-light .navbar-text a:hover,
.navbar-light .navbar-text a:focus {
    color: #111827;
}

.navbar-dark .navbar-brand {
    color: #ffffff;
}

.navbar-dark .navbar-brand:hover, .navbar-dark .navbar-brand:focus {
    color: #ffffff;
}

.navbar-dark .navbar-nav .nav-link {
    color: rgba(255, 255, 255, 0.9);
}

.navbar-dark .navbar-nav .nav-link:hover, .navbar-dark .navbar-nav .nav-link:focus {
    color: white;
}

.navbar-dark .navbar-nav .nav-link.disabled {
    color: rgba(255, 255, 255, 0.9);
}

.navbar-dark .navbar-nav .show > .nav-link,
.navbar-dark .navbar-nav .nav-link.active {
    color: #ffffff;
}

.navbar-dark .navbar-toggler {
    color: rgba(255, 255, 255, 0.9);
    border-color: rgba(255, 255, 255, 0.1);
}

.navbar-dark .navbar-toggler-icon {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 255, 255, 0.9%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
}

.navbar-dark .navbar-text {
    color: rgba(255, 255, 255, 0.9);
}

.navbar-dark .navbar-text a,
.navbar-dark .navbar-text a:hover,
.navbar-dark .navbar-text a:focus {
    color: #ffffff;
}

.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #ffffff;
    background-clip: border-box;
    border: 0.0625rem solid rgba(17, 24, 39, 0.125);
    border-radius: 0.5rem;
}

.card > hr {
    margin-right: 0;
    margin-left: 0;
}

.card > .list-group {
    border-top: inherit;
    border-bottom: inherit;
}

.card > .list-group:first-child {
    border-top-width: 0;
    border-top-left-radius: 0.4375rem;
    border-top-right-radius: 0.4375rem;
}

.card > .list-group:last-child {
    border-bottom-width: 0;
    border-bottom-right-radius: 0.4375rem;
    border-bottom-left-radius: 0.4375rem;
}

.card > .card-header + .list-group,
.card > .list-group + .card-footer {
    border-top: 0;
}

.card-body {
    flex: 1 1 auto;
    padding: 1.25rem 1.5rem;
}

.card-title {
    margin-bottom: 0.875rem;
}

.card-subtitle {
    margin-top: -0.4375rem;
    margin-bottom: 0;
}

.card-text:last-child {
    margin-bottom: 0;
}

.card-link + .card-link {
    margin-left: 1.5rem;
}

.card-header {
    padding: 1.25rem 1.5rem;
    margin-bottom: 0;
    background-color: rgba(17, 24, 39, 0.03);
    border-bottom: 0.0625rem solid rgba(17, 24, 39, 0.125);
}

.card-header:first-child {
    border-radius: 0.4375rem 0.4375rem 0 0;
}

.card-footer {
    padding: 1.25rem 1.5rem;
    background-color: rgba(17, 24, 39, 0.03);
    border-top: 0.0625rem solid rgba(17, 24, 39, 0.125);
}

.card-footer:last-child {
    border-radius: 0 0 0.4375rem 0.4375rem;
}

.card-header-tabs {
    margin-right: -0.75rem;
    margin-bottom: -1.25rem;
    margin-left: -0.75rem;
    border-bottom: 0;
}

.card-header-tabs .nav-link.active {
    background-color: #ffffff;
    border-bottom-color: #ffffff;
}

.card-header-pills {
    margin-right: -0.75rem;
    margin-left: -0.75rem;
}

.card-img-overlay {
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    padding: 1rem;
    border-radius: 0.4375rem;
}

.card-img,
.card-img-top,
.card-img-bottom {
    width: 100%;
}

.card-img,
.card-img-top {
    border-top-left-radius: 0.4375rem;
    border-top-right-radius: 0.4375rem;
}

.card-img,
.card-img-bottom {
    border-bottom-right-radius: 0.4375rem;
    border-bottom-left-radius: 0.4375rem;
}

.card-group > .card {
    margin-bottom: 0.75rem;
}

@media (min-width: 576px) {
    .card-group {
        display: flex;
        flex-flow: row wrap;
    }

    .card-group > .card {
        flex: 1 0 0%;
        margin-bottom: 0;
    }

    .card-group > .card + .card {
        margin-left: 0;
        border-left: 0;
    }

    .card-group > .card:not(:last-child) {
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
    }

    .card-group > .card:not(:last-child) .card-img-top,
.card-group > .card:not(:last-child) .card-header {
        border-top-right-radius: 0;
    }

    .card-group > .card:not(:last-child) .card-img-bottom,
.card-group > .card:not(:last-child) .card-footer {
        border-bottom-right-radius: 0;
    }

    .card-group > .card:not(:first-child) {
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
    }

    .card-group > .card:not(:first-child) .card-img-top,
.card-group > .card:not(:first-child) .card-header {
        border-top-left-radius: 0;
    }

    .card-group > .card:not(:first-child) .card-img-bottom,
.card-group > .card:not(:first-child) .card-footer {
        border-bottom-left-radius: 0;
    }
}

.accordion-button {
    position: relative;
    display: flex;
    align-items: center;
    width: 100%;
    padding: 1rem 1.25rem;
    font-size: 1rem;
    color: #374151;
    text-align: left;
    background-color: transparent;
    border: 0;
    border-radius: 0;
    overflow-anchor: none;
    transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out, border-radius 0.15s ease;
}

@media (prefers-reduced-motion: reduce) {
    .accordion-button {
        transition: none;
    }
}

.accordion-button:not(.collapsed) {
    color: #1c2532;
    background-color: #9CA3AF;
    box-shadow: inset 0 -0.0625rem 0 #9CA3AF;
}

.accordion-button:not(.collapsed)::after {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%231c2532'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
    transform: rotate(180deg);
}

.accordion-button::after {
    flex-shrink: 0;
    width: 1.25rem;
    height: 1.25rem;
    margin-left: auto;
    content: "";
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23374151'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-size: 1.25rem;
    transition: transform 0.2s ease-in-out;
}

@media (prefers-reduced-motion: reduce) {
    .accordion-button::after {
        transition: none;
    }
}

.accordion-button:hover {
    z-index: 2;
}

.accordion-button:focus {
    z-index: 3;
    border-color: #4d6689;
    outline: 0;
    box-shadow: 0 0 0 0.18rem rgba(31, 41, 55, 0.25);
}

.accordion-header {
    margin-bottom: 0;
}

.accordion-item {
    background-color: transparent;
    border: 0.0625rem solid #9CA3AF;
}

.accordion-item:first-of-type {
    border-top-left-radius: 0.5rem;
    border-top-right-radius: 0.5rem;
}

.accordion-item:first-of-type .accordion-button {
    border-top-left-radius: 0.4375rem;
    border-top-right-radius: 0.4375rem;
}

.accordion-item:not(:first-of-type) {
    border-top: 0;
}

.accordion-item:last-of-type {
    border-bottom-right-radius: 0.5rem;
    border-bottom-left-radius: 0.5rem;
}

.accordion-item:last-of-type .accordion-button.collapsed {
    border-bottom-right-radius: 0.4375rem;
    border-bottom-left-radius: 0.4375rem;
}

.accordion-item:last-of-type .accordion-collapse {
    border-bottom-right-radius: 0.5rem;
    border-bottom-left-radius: 0.5rem;
}

.accordion-body {
    padding: 1rem 1.25rem;
}

.accordion-flush .accordion-collapse {
    border-width: 0;
}

.accordion-flush .accordion-item {
    border-right: 0;
    border-left: 0;
    border-radius: 0;
}

.accordion-flush .accordion-item:first-child {
    border-top: 0;
}

.accordion-flush .accordion-item:last-child {
    border-bottom: 0;
}

.accordion-flush .accordion-item .accordion-button {
    border-radius: 0;
}

.breadcrumb {
    display: flex;
    flex-wrap: wrap;
    padding: 0.5rem 1rem;
    margin-bottom: 1rem;
    list-style: none;
    background-color: #E5E7EB;
    border-radius: 0.5rem;
}

.breadcrumb-item + .breadcrumb-item {
    padding-left: 0.5rem;
}

.breadcrumb-item + .breadcrumb-item::before {
    float: left;
    padding-right: 0.5rem;
    color: #4B5563;
    content: var(--bs-breadcrumb-divider, "/") /* rtl: var(--bs-breadcrumb-divider, "/") */;
}

.breadcrumb-item.active {
    color: #4B5563;
}

.pagination {
    display: flex;
    padding-left: 0;
    list-style: none;
}

.page-link {
    position: relative;
    display: block;
    color: #1F2937;
    background-color: #ffffff;
    border: 0.0625rem solid #9CA3AF;
    transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

@media (prefers-reduced-motion: reduce) {
    .page-link {
        transition: none;
    }
}

.page-link:hover {
    z-index: 2;
    color: black;
    background-color: #E5E7EB;
    border-color: #D1D5DB;
}

.page-link:focus {
    z-index: 3;
    color: black;
    background-color: #E5E7EB;
    outline: 0;
    box-shadow: 0 0 0 0.18rem rgba(31, 41, 55, 0.25);
}

.page-item:not(:first-child) .page-link {
    margin-left: -0.0625rem;
}

.page-item.active .page-link {
    z-index: 3;
    color: #ffffff;
    background-color: #1F2937;
    border-color: #1F2937;
}

.page-item.disabled .page-link {
    color: #4B5563;
    pointer-events: none;
    background-color: #ffffff;
    border-color: #D1D5DB;
}

.page-link {
    padding: 0.375rem 0.75rem;
}

.page-item:first-child .page-link {
    border-top-left-radius: 0.5rem;
    border-bottom-left-radius: 0.5rem;
}

.page-item:last-child .page-link {
    border-top-right-radius: 0.5rem;
    border-bottom-right-radius: 0.5rem;
}

.pagination-lg .page-link {
    padding: 0.75rem 1.5rem;
    font-size: 1.25rem;
}

.pagination-lg .page-item:first-child .page-link {
    border-top-left-radius: 1rem;
    border-bottom-left-radius: 1rem;
}

.pagination-lg .page-item:last-child .page-link {
    border-top-right-radius: 1rem;
    border-bottom-right-radius: 1rem;
}

.pagination-sm .page-link {
    padding: 0.25rem 0.5rem;
    font-size: 0.875rem;
}

.pagination-sm .page-item:first-child .page-link {
    border-top-left-radius: 0.35rem;
    border-bottom-left-radius: 0.35rem;
}

.pagination-sm .page-item:last-child .page-link {
    border-top-right-radius: 0.35rem;
    border-bottom-right-radius: 0.35rem;
}

.badge {
    display: inline-block;
    padding: 0.2rem 0.4rem;
    font-size: 0.75em;
    font-weight: 600;
    line-height: 1;
    color: #ffffff;
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
    border-radius: 0.5rem;
}

.badge:empty {
    display: none;
}

.btn .badge {
    position: relative;
    top: -1px;
}

.alert {
    position: relative;
    padding: 1rem 1rem;
    margin-bottom: 1rem;
    border: 0.0625rem solid transparent;
    border-radius: 0.5rem;
}

.alert-heading {
    color: inherit;
}

.alert-link {
    font-weight: 500;
}

.alert-dismissible {
    padding-right: 3rem;
}

.alert-dismissible .btn-close {
    position: absolute;
    top: 0;
    right: 0;
    z-index: 2;
    padding: 1.25rem 1rem;
}

.alert-primary {
    color: #131921;
    background-color: #d2d4d7;
    border-color: #bcbfc3;
}

.alert-primary .alert-link {
    color: #0f141a;
}

.alert-secondary {
    color: #907146;
    background-color: #fcf2e3;
    border-color: #fbebd5;
}

.alert-secondary .alert-link {
    color: #735a38;
}

.alert-tertiary {
    color: #1d1d40;
    background-color: #d6d6e1;
    border-color: #c1c1d2;
}

.alert-tertiary .alert-link {
    color: #171733;
}

.alert-success {
    color: #0a6f4d;
    background-color: #cff1e6;
    border-color: #b7ead9;
}

.alert-success .alert-link {
    color: #08593e;
}

.alert-info {
    color: #153a7c;
    background-color: #d3dff5;
    border-color: #bdd0f0;
}

.alert-info .alert-link {
    color: #112e63;
}

.alert-warning {
    color: #927755;
    background-color: #fdf4e8;
    border-color: #fbeedd;
}

.alert-warning .alert-link {
    color: #755f44;
}

.alert-danger {
    color: #87112b;
    background-color: #f9d2da;
    border-color: #f6bbc8;
}

.alert-danger .alert-link {
    color: #6c0e22;
}

.alert-white {
    color: #797f87;
    background-color: white;
    border-color: white;
}

.alert-white .alert-link {
    color: #61666c;
}

.alert-indigo {
    color: #2f2a89;
    background-color: #dcdafa;
    border-color: #cac8f7;
}

.alert-indigo .alert-link {
    color: #26226e;
}

.alert-purple {
    color: #4a238e;
    background-color: #e5d8fb;
    border-color: #d8c4fa;
}

.alert-purple .alert-link {
    color: #3b1c72;
}

.alert-yellow-100 {
    color: #998f80;
    background-color: #fffcf7;
    border-color: #fffaf3;
}

.alert-yellow-100 .alert-link {
    color: #7a7266;
}

.alert-yellow-200 {
    color: #93836e;
    background-color: #fdf8f1;
    border-color: #fcf4ea;
}

.alert-yellow-200 .alert-link {
    color: #766958;
}

.alert-gray-50 {
    color: #767d85;
    background-color: #fefefe;
    border-color: #fdfefe;
}

.alert-gray-50 .alert-link {
    color: #5e646a;
}

.alert-gray-100 {
    color: #919294;
    background-color: #fcfdfd;
    border-color: #fbfcfc;
}

.alert-gray-100 .alert-link {
    color: #747576;
}

.alert-gray-200 {
    color: #898b8d;
    background-color: #fafafb;
    border-color: #f7f8f9;
}

.alert-gray-200 .alert-link {
    color: #6e6f71;
}

.alert-gray-300 {
    color: #7d8083;
    background-color: #f6f7f8;
    border-color: #f1f2f4;
}

.alert-gray-300 .alert-link {
    color: #646669;
}

.alert-gray-400 {
    color: #5e6269;
    background-color: #ebedef;
    border-color: #e1e3e7;
}

.alert-gray-400 .alert-link {
    color: #4b4e54;
}

.alert-gray-500 {
    color: #40444d;
    background-color: #e1e3e6;
    border-color: #d3d5d9;
}

.alert-gray-500 .alert-link {
    color: #33363e;
}

.alert-gray-600 {
    color: #2d333b;
    background-color: #dbdde0;
    border-color: #c9ccd0;
}

.alert-gray-600 .alert-link {
    color: #24292f;
}

.alert-gray-700 {
    color: #212731;
    background-color: #d7d9dc;
    border-color: #c3c6cb;
}

.alert-gray-700 .alert-link {
    color: #1a1f27;
}

.alert-gray-800 {
    color: #131921;
    background-color: #d2d4d7;
    border-color: #bcbfc3;
}

.alert-gray-800 .alert-link {
    color: #0f141a;
}

.alert-gray-900 {
    color: #0a0e17;
    background-color: #cfd1d4;
    border-color: #b8babe;
}

.alert-gray-900 .alert-link {
    color: #080b12;
}

@keyframes progress-bar-stripes {
    0% {
        background-position-x: 1rem;
    }
}

.progress {
    display: flex;
    height: 1rem;
    overflow: hidden;
    font-size: 0.75rem;
    background-color: #E5E7EB;
    border-radius: 0.5rem;
    box-shadow: inset 0 1px 2px rgba(17, 24, 39, 0.0125);
}

.progress-bar {
    display: flex;
    flex-direction: column;
    justify-content: center;
    overflow: hidden;
    color: #ffffff;
    text-align: center;
    white-space: nowrap;
    background-color: #1F2937;
    transition: width 0.6s ease;
}

@media (prefers-reduced-motion: reduce) {
    .progress-bar {
        transition: none;
    }
}

.progress-bar-striped {
    background-image: linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);
    background-size: 1rem 1rem;
}

.progress-bar-animated {
    animation: 1s linear infinite progress-bar-stripes;
}

@media (prefers-reduced-motion: reduce) {
    .progress-bar-animated {
        animation: none;
    }
}

.list-group {
    display: flex;
    flex-direction: column;
    padding-left: 0;
    margin-bottom: 0;
    border-radius: 0.5rem;
}

.list-group-numbered {
    list-style-type: none;
    counter-reset: section;
}

.list-group-numbered > li::before {
    content: counters(section, ".") ". ";
    counter-increment: section;
}

.list-group-item-action {
    width: 100%;
    color: #374151;
    text-align: inherit;
}

.list-group-item-action:hover, .list-group-item-action:focus {
    z-index: 1;
    color: #374151;
    text-decoration: none;
    background-color: #F2F4F6;
}

.list-group-item-action:active {
    color: #374151;
    background-color: #E5E7EB;
}

.list-group-item {
    position: relative;
    display: block;
    padding: 0.5rem 1rem;
    color: #111827;
    background-color: #ffffff;
    border: 0.0625rem solid rgba(17, 24, 39, 0.125);
}

.list-group-item:first-child {
    border-top-left-radius: inherit;
    border-top-right-radius: inherit;
}

.list-group-item:last-child {
    border-bottom-right-radius: inherit;
    border-bottom-left-radius: inherit;
}

.list-group-item.disabled, .list-group-item:disabled {
    color: #4B5563;
    pointer-events: none;
    background-color: #ffffff;
}

.list-group-item.active {
    z-index: 2;
    color: #ffffff;
    background-color: #1F2937;
    border-color: #1F2937;
}

.list-group-item + .list-group-item {
    border-top-width: 0;
}

.list-group-item + .list-group-item.active {
    margin-top: -0.0625rem;
    border-top-width: 0.0625rem;
}

.list-group-horizontal {
    flex-direction: row;
}

.list-group-horizontal > .list-group-item:first-child {
    border-bottom-left-radius: 0.5rem;
    border-top-right-radius: 0;
}

.list-group-horizontal > .list-group-item:last-child {
    border-top-right-radius: 0.5rem;
    border-bottom-left-radius: 0;
}

.list-group-horizontal > .list-group-item.active {
    margin-top: 0;
}

.list-group-horizontal > .list-group-item + .list-group-item {
    border-top-width: 0.0625rem;
    border-left-width: 0;
}

.list-group-horizontal > .list-group-item + .list-group-item.active {
    margin-left: -0.0625rem;
    border-left-width: 0.0625rem;
}

@media (min-width: 576px) {
    .list-group-horizontal-sm {
        flex-direction: row;
    }

    .list-group-horizontal-sm > .list-group-item:first-child {
        border-bottom-left-radius: 0.5rem;
        border-top-right-radius: 0;
    }

    .list-group-horizontal-sm > .list-group-item:last-child {
        border-top-right-radius: 0.5rem;
        border-bottom-left-radius: 0;
    }

    .list-group-horizontal-sm > .list-group-item.active {
        margin-top: 0;
    }

    .list-group-horizontal-sm > .list-group-item + .list-group-item {
        border-top-width: 0.0625rem;
        border-left-width: 0;
    }

    .list-group-horizontal-sm > .list-group-item + .list-group-item.active {
        margin-left: -0.0625rem;
        border-left-width: 0.0625rem;
    }
}

@media (min-width: 768px) {
    .list-group-horizontal-md {
        flex-direction: row;
    }

    .list-group-horizontal-md > .list-group-item:first-child {
        border-bottom-left-radius: 0.5rem;
        border-top-right-radius: 0;
    }

    .list-group-horizontal-md > .list-group-item:last-child {
        border-top-right-radius: 0.5rem;
        border-bottom-left-radius: 0;
    }

    .list-group-horizontal-md > .list-group-item.active {
        margin-top: 0;
    }

    .list-group-horizontal-md > .list-group-item + .list-group-item {
        border-top-width: 0.0625rem;
        border-left-width: 0;
    }

    .list-group-horizontal-md > .list-group-item + .list-group-item.active {
        margin-left: -0.0625rem;
        border-left-width: 0.0625rem;
    }
}

@media (min-width: 992px) {
    .list-group-horizontal-lg {
        flex-direction: row;
    }

    .list-group-horizontal-lg > .list-group-item:first-child {
        border-bottom-left-radius: 0.5rem;
        border-top-right-radius: 0;
    }

    .list-group-horizontal-lg > .list-group-item:last-child {
        border-top-right-radius: 0.5rem;
        border-bottom-left-radius: 0;
    }

    .list-group-horizontal-lg > .list-group-item.active {
        margin-top: 0;
    }

    .list-group-horizontal-lg > .list-group-item + .list-group-item {
        border-top-width: 0.0625rem;
        border-left-width: 0;
    }

    .list-group-horizontal-lg > .list-group-item + .list-group-item.active {
        margin-left: -0.0625rem;
        border-left-width: 0.0625rem;
    }
}

@media (min-width: 1200px) {
    .list-group-horizontal-xl {
        flex-direction: row;
    }

    .list-group-horizontal-xl > .list-group-item:first-child {
        border-bottom-left-radius: 0.5rem;
        border-top-right-radius: 0;
    }

    .list-group-horizontal-xl > .list-group-item:last-child {
        border-top-right-radius: 0.5rem;
        border-bottom-left-radius: 0;
    }

    .list-group-horizontal-xl > .list-group-item.active {
        margin-top: 0;
    }

    .list-group-horizontal-xl > .list-group-item + .list-group-item {
        border-top-width: 0.0625rem;
        border-left-width: 0;
    }

    .list-group-horizontal-xl > .list-group-item + .list-group-item.active {
        margin-left: -0.0625rem;
        border-left-width: 0.0625rem;
    }
}

@media (min-width: 1400px) {
    .list-group-horizontal-xxl {
        flex-direction: row;
    }

    .list-group-horizontal-xxl > .list-group-item:first-child {
        border-bottom-left-radius: 0.5rem;
        border-top-right-radius: 0;
    }

    .list-group-horizontal-xxl > .list-group-item:last-child {
        border-top-right-radius: 0.5rem;
        border-bottom-left-radius: 0;
    }

    .list-group-horizontal-xxl > .list-group-item.active {
        margin-top: 0;
    }

    .list-group-horizontal-xxl > .list-group-item + .list-group-item {
        border-top-width: 0.0625rem;
        border-left-width: 0;
    }

    .list-group-horizontal-xxl > .list-group-item + .list-group-item.active {
        margin-left: -0.0625rem;
        border-left-width: 0.0625rem;
    }
}

.list-group-flush {
    border-radius: 0;
}

.list-group-flush > .list-group-item {
    border-width: 0 0 0.0625rem;
}

.list-group-flush > .list-group-item:last-child {
    border-bottom-width: 0;
}

.list-group-item-primary {
    color: #131921;
    background-color: #d2d4d7;
}

.list-group-item-primary.list-group-item-action:hover, .list-group-item-primary.list-group-item-action:focus {
    color: #131921;
    background-color: #bdbfc2;
}

.list-group-item-primary.list-group-item-action.active {
    color: #ffffff;
    background-color: #131921;
    border-color: #131921;
}

.list-group-item-secondary {
    color: #907146;
    background-color: #fcf2e3;
}

.list-group-item-secondary.list-group-item-action:hover, .list-group-item-secondary.list-group-item-action:focus {
    color: #907146;
    background-color: #e3dacc;
}

.list-group-item-secondary.list-group-item-action.active {
    color: #ffffff;
    background-color: #907146;
    border-color: #907146;
}

.list-group-item-tertiary {
    color: #1d1d40;
    background-color: #d6d6e1;
}

.list-group-item-tertiary.list-group-item-action:hover, .list-group-item-tertiary.list-group-item-action:focus {
    color: #1d1d40;
    background-color: #c1c1cb;
}

.list-group-item-tertiary.list-group-item-action.active {
    color: #ffffff;
    background-color: #1d1d40;
    border-color: #1d1d40;
}

.list-group-item-success {
    color: #0a6f4d;
    background-color: #cff1e6;
}

.list-group-item-success.list-group-item-action:hover, .list-group-item-success.list-group-item-action:focus {
    color: #0a6f4d;
    background-color: #bad9cf;
}

.list-group-item-success.list-group-item-action.active {
    color: #ffffff;
    background-color: #0a6f4d;
    border-color: #0a6f4d;
}

.list-group-item-info {
    color: #153a7c;
    background-color: #d3dff5;
}

.list-group-item-info.list-group-item-action:hover, .list-group-item-info.list-group-item-action:focus {
    color: #153a7c;
    background-color: #bec9dd;
}

.list-group-item-info.list-group-item-action.active {
    color: #ffffff;
    background-color: #153a7c;
    border-color: #153a7c;
}

.list-group-item-warning {
    color: #927755;
    background-color: #fdf4e8;
}

.list-group-item-warning.list-group-item-action:hover, .list-group-item-warning.list-group-item-action:focus {
    color: #927755;
    background-color: #e4dcd1;
}

.list-group-item-warning.list-group-item-action.active {
    color: #ffffff;
    background-color: #927755;
    border-color: #927755;
}

.list-group-item-danger {
    color: #87112b;
    background-color: #f9d2da;
}

.list-group-item-danger.list-group-item-action:hover, .list-group-item-danger.list-group-item-action:focus {
    color: #87112b;
    background-color: #e0bdc4;
}

.list-group-item-danger.list-group-item-action.active {
    color: #ffffff;
    background-color: #87112b;
    border-color: #87112b;
}

.list-group-item-white {
    color: #797f87;
    background-color: white;
}

.list-group-item-white.list-group-item-action:hover, .list-group-item-white.list-group-item-action:focus {
    color: #797f87;
    background-color: #e6e6e6;
}

.list-group-item-white.list-group-item-action.active {
    color: #ffffff;
    background-color: #797f87;
    border-color: #797f87;
}

.list-group-item-indigo {
    color: #2f2a89;
    background-color: #dcdafa;
}

.list-group-item-indigo.list-group-item-action:hover, .list-group-item-indigo.list-group-item-action:focus {
    color: #2f2a89;
    background-color: #c6c4e1;
}

.list-group-item-indigo.list-group-item-action.active {
    color: #ffffff;
    background-color: #2f2a89;
    border-color: #2f2a89;
}

.list-group-item-purple {
    color: #4a238e;
    background-color: #e5d8fb;
}

.list-group-item-purple.list-group-item-action:hover, .list-group-item-purple.list-group-item-action:focus {
    color: #4a238e;
    background-color: #cec2e2;
}

.list-group-item-purple.list-group-item-action.active {
    color: #ffffff;
    background-color: #4a238e;
    border-color: #4a238e;
}

.list-group-item-yellow-100 {
    color: #998f80;
    background-color: #fffcf7;
}

.list-group-item-yellow-100.list-group-item-action:hover, .list-group-item-yellow-100.list-group-item-action:focus {
    color: #998f80;
    background-color: #e6e3de;
}

.list-group-item-yellow-100.list-group-item-action.active {
    color: #ffffff;
    background-color: #998f80;
    border-color: #998f80;
}

.list-group-item-yellow-200 {
    color: #93836e;
    background-color: #fdf8f1;
}

.list-group-item-yellow-200.list-group-item-action:hover, .list-group-item-yellow-200.list-group-item-action:focus {
    color: #93836e;
    background-color: #e4dfd9;
}

.list-group-item-yellow-200.list-group-item-action.active {
    color: #ffffff;
    background-color: #93836e;
    border-color: #93836e;
}

.list-group-item-gray-50 {
    color: #767d85;
    background-color: #fefefe;
}

.list-group-item-gray-50.list-group-item-action:hover, .list-group-item-gray-50.list-group-item-action:focus {
    color: #767d85;
    background-color: #e5e5e5;
}

.list-group-item-gray-50.list-group-item-action.active {
    color: #ffffff;
    background-color: #767d85;
    border-color: #767d85;
}

.list-group-item-gray-100 {
    color: #919294;
    background-color: #fcfdfd;
}

.list-group-item-gray-100.list-group-item-action:hover, .list-group-item-gray-100.list-group-item-action:focus {
    color: #919294;
    background-color: #e3e4e4;
}

.list-group-item-gray-100.list-group-item-action.active {
    color: #ffffff;
    background-color: #919294;
    border-color: #919294;
}

.list-group-item-gray-200 {
    color: #898b8d;
    background-color: #fafafb;
}

.list-group-item-gray-200.list-group-item-action:hover, .list-group-item-gray-200.list-group-item-action:focus {
    color: #898b8d;
    background-color: #e1e1e2;
}

.list-group-item-gray-200.list-group-item-action.active {
    color: #ffffff;
    background-color: #898b8d;
    border-color: #898b8d;
}

.list-group-item-gray-300 {
    color: #7d8083;
    background-color: #f6f7f8;
}

.list-group-item-gray-300.list-group-item-action:hover, .list-group-item-gray-300.list-group-item-action:focus {
    color: #7d8083;
    background-color: #dddedf;
}

.list-group-item-gray-300.list-group-item-action.active {
    color: #ffffff;
    background-color: #7d8083;
    border-color: #7d8083;
}

.list-group-item-gray-400 {
    color: #5e6269;
    background-color: #ebedef;
}

.list-group-item-gray-400.list-group-item-action:hover, .list-group-item-gray-400.list-group-item-action:focus {
    color: #5e6269;
    background-color: #d4d5d7;
}

.list-group-item-gray-400.list-group-item-action.active {
    color: #ffffff;
    background-color: #5e6269;
    border-color: #5e6269;
}

.list-group-item-gray-500 {
    color: #40444d;
    background-color: #e1e3e6;
}

.list-group-item-gray-500.list-group-item-action:hover, .list-group-item-gray-500.list-group-item-action:focus {
    color: #40444d;
    background-color: #cbcccf;
}

.list-group-item-gray-500.list-group-item-action.active {
    color: #ffffff;
    background-color: #40444d;
    border-color: #40444d;
}

.list-group-item-gray-600 {
    color: #2d333b;
    background-color: #dbdde0;
}

.list-group-item-gray-600.list-group-item-action:hover, .list-group-item-gray-600.list-group-item-action:focus {
    color: #2d333b;
    background-color: #c5c7ca;
}

.list-group-item-gray-600.list-group-item-action.active {
    color: #ffffff;
    background-color: #2d333b;
    border-color: #2d333b;
}

.list-group-item-gray-700 {
    color: #212731;
    background-color: #d7d9dc;
}

.list-group-item-gray-700.list-group-item-action:hover, .list-group-item-gray-700.list-group-item-action:focus {
    color: #212731;
    background-color: #c2c3c6;
}

.list-group-item-gray-700.list-group-item-action.active {
    color: #ffffff;
    background-color: #212731;
    border-color: #212731;
}

.list-group-item-gray-800 {
    color: #131921;
    background-color: #d2d4d7;
}

.list-group-item-gray-800.list-group-item-action:hover, .list-group-item-gray-800.list-group-item-action:focus {
    color: #131921;
    background-color: #bdbfc2;
}

.list-group-item-gray-800.list-group-item-action.active {
    color: #ffffff;
    background-color: #131921;
    border-color: #131921;
}

.list-group-item-gray-900 {
    color: #0a0e17;
    background-color: #cfd1d4;
}

.list-group-item-gray-900.list-group-item-action:hover, .list-group-item-gray-900.list-group-item-action:focus {
    color: #0a0e17;
    background-color: #babcbf;
}

.list-group-item-gray-900.list-group-item-action.active {
    color: #ffffff;
    background-color: #0a0e17;
    border-color: #0a0e17;
}

.btn-close {
    box-sizing: content-box;
    width: 1em;
    height: 1em;
    padding: 0.25em 0.25em;
    color: #111827;
    background: transparent url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23111827'%3e%3cpath d='M.293.293a1 1 0 011.414 0L8 6.586 14.293.293a1 1 0 111.414 1.414L9.414 8l6.293 6.293a1 1 0 01-1.414 1.414L8 9.414l-6.293 6.293a1 1 0 01-1.414-1.414L6.586 8 .293 1.707a1 1 0 010-1.414z'/%3e%3c/svg%3e") center/1em auto no-repeat;
    border: 0;
    border-radius: 0.5rem;
    opacity: 0.5;
}

.btn-close:hover {
    color: #111827;
    text-decoration: none;
    opacity: 0.75;
}

.btn-close:focus {
    outline: 0;
    box-shadow: 0 0 0 0.18rem rgba(31, 41, 55, 0.25);
    opacity: 1;
}

.btn-close:disabled, .btn-close.disabled {
    pointer-events: none;
    -webkit-user-select: none;
    user-select: none;
    opacity: 0.25;
}

.btn-close-white {
    filter: invert(1) grayscale(100%) brightness(200%);
}

.toast {
    width: 350px;
    max-width: 100%;
    font-size: 0.875rem;
    pointer-events: auto;
    background-color: rgba(255, 255, 255, 0.85);
    background-clip: padding-box;
    border: 1px solid rgba(0, 0, 0, 0.1);
    box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
    border-radius: 0.5rem;
}

.toast.showing {
    opacity: 0;
}

.toast:not(.show) {
    display: none;
}

.toast-container {
    width: max-content;
    max-width: 100%;
    pointer-events: none;
}

.toast-container > :not(:last-child) {
    margin-bottom: 1rem;
}

.toast-header {
    display: flex;
    align-items: center;
    padding: 0.25rem 0.75rem;
    color: #4B5563;
    background-color: rgba(255, 255, 255, 0.85);
    background-clip: padding-box;
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    border-top-left-radius: calc(0.5rem - 1px);
    border-top-right-radius: calc(0.5rem - 1px);
}

.toast-header .btn-close {
    margin-right: -0.375rem;
    margin-left: 0.75rem;
}

.toast-body {
    padding: 0.75rem;
    word-wrap: break-word;
}

.modal {
    position: fixed;
    top: 0;
    left: 0;
    z-index: 1050;
    display: none;
    width: 100%;
    height: 100%;
    overflow-x: hidden;
    overflow-y: auto;
    outline: 0;
}

.modal-dialog {
    position: relative;
    width: auto;
    margin: 0.5rem;
    pointer-events: none;
}

.modal.fade .modal-dialog {
    transition: transform 0.3s ease-out;
    transform: translate(0, -50px);
}

@media (prefers-reduced-motion: reduce) {
    .modal.fade .modal-dialog {
        transition: none;
    }
}

.modal.show .modal-dialog {
    transform: none;
}

.modal.modal-static .modal-dialog {
    transform: scale(1.02);
}

.modal-dialog-scrollable {
    height: calc(100% - 1rem);
}

.modal-dialog-scrollable .modal-content {
    max-height: 100%;
    overflow: hidden;
}

.modal-dialog-scrollable .modal-body {
    overflow-y: auto;
}

.modal-dialog-centered {
    display: flex;
    align-items: center;
    min-height: calc(100% - 1rem);
}

.modal-content {
    position: relative;
    display: flex;
    flex-direction: column;
    width: 100%;
    pointer-events: auto;
    background-color: #ffffff;
    background-clip: padding-box;
    border: 0.0625rem solid rgba(17, 24, 39, 0.2);
    border-radius: 0.5rem;
    box-shadow: 0 2px 5px rgba(140, 152, 164, 0.2);
    outline: 0;
}

.modal-backdrop {
    position: fixed;
    top: 0;
    left: 0;
    z-index: 1040;
    width: 100vw;
    height: 100vh;
    background-color: #111827;
}

.modal-backdrop.fade {
    opacity: 0;
}

.modal-backdrop.show {
    opacity: 0.5;
}

.modal-header {
    display: flex;
    flex-shrink: 0;
    align-items: center;
    justify-content: space-between;
    padding: 1rem 1rem;
    border-bottom: 0.0625rem solid #E5E7EB;
    border-top-left-radius: 0.4375rem;
    border-top-right-radius: 0.4375rem;
}

.modal-header .btn-close {
    padding: 0.5rem 0.5rem;
    margin: -0.5rem -0.5rem -0.5rem auto;
}

.modal-title {
    margin-bottom: 0;
    line-height: 1.5;
}

.modal-body {
    position: relative;
    flex: 1 1 auto;
    padding: 1rem;
}

.modal-footer {
    display: flex;
    flex-wrap: wrap;
    flex-shrink: 0;
    align-items: center;
    justify-content: flex-end;
    padding: 0.75rem;
    border-top: 0.0625rem solid #E5E7EB;
    border-bottom-right-radius: 0.4375rem;
    border-bottom-left-radius: 0.4375rem;
}

.modal-footer > * {
    margin: 0.25rem;
}

@media (min-width: 576px) {
    .modal-dialog {
        max-width: 500px;
        margin: 1.75rem auto;
    }

    .modal-dialog-scrollable {
        height: calc(100% - 3.5rem);
    }

    .modal-dialog-centered {
        min-height: calc(100% - 3.5rem);
    }

    .modal-content {
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
    }

    .modal-sm {
        max-width: 300px;
    }
}

@media (min-width: 992px) {
    .modal-lg,
.modal-xl {
        max-width: 800px;
    }
}

@media (min-width: 1200px) {
    .modal-xl {
        max-width: 1140px;
    }
}

.modal-fullscreen {
    width: 100vw;
    max-width: none;
    height: 100%;
    margin: 0;
}

.modal-fullscreen .modal-content {
    height: 100%;
    border: 0;
    border-radius: 0;
}

.modal-fullscreen .modal-header {
    border-radius: 0;
}

.modal-fullscreen .modal-body {
    overflow-y: auto;
}

.modal-fullscreen .modal-footer {
    border-radius: 0;
}

@media (max-width: 575.98px) {
    .modal-fullscreen-sm-down {
        width: 100vw;
        max-width: none;
        height: 100%;
        margin: 0;
    }

    .modal-fullscreen-sm-down .modal-content {
        height: 100%;
        border: 0;
        border-radius: 0;
    }

    .modal-fullscreen-sm-down .modal-header {
        border-radius: 0;
    }

    .modal-fullscreen-sm-down .modal-body {
        overflow-y: auto;
    }

    .modal-fullscreen-sm-down .modal-footer {
        border-radius: 0;
    }
}

@media (max-width: 767.98px) {
    .modal-fullscreen-md-down {
        width: 100vw;
        max-width: none;
        height: 100%;
        margin: 0;
    }

    .modal-fullscreen-md-down .modal-content {
        height: 100%;
        border: 0;
        border-radius: 0;
    }

    .modal-fullscreen-md-down .modal-header {
        border-radius: 0;
    }

    .modal-fullscreen-md-down .modal-body {
        overflow-y: auto;
    }

    .modal-fullscreen-md-down .modal-footer {
        border-radius: 0;
    }
}

@media (max-width: 991.98px) {
    .modal-fullscreen-lg-down {
        width: 100vw;
        max-width: none;
        height: 100%;
        margin: 0;
    }

    .modal-fullscreen-lg-down .modal-content {
        height: 100%;
        border: 0;
        border-radius: 0;
    }

    .modal-fullscreen-lg-down .modal-header {
        border-radius: 0;
    }

    .modal-fullscreen-lg-down .modal-body {
        overflow-y: auto;
    }

    .modal-fullscreen-lg-down .modal-footer {
        border-radius: 0;
    }
}

@media (max-width: 1199.98px) {
    .modal-fullscreen-xl-down {
        width: 100vw;
        max-width: none;
        height: 100%;
        margin: 0;
    }

    .modal-fullscreen-xl-down .modal-content {
        height: 100%;
        border: 0;
        border-radius: 0;
    }

    .modal-fullscreen-xl-down .modal-header {
        border-radius: 0;
    }

    .modal-fullscreen-xl-down .modal-body {
        overflow-y: auto;
    }

    .modal-fullscreen-xl-down .modal-footer {
        border-radius: 0;
    }
}

@media (max-width: 1399.98px) {
    .modal-fullscreen-xxl-down {
        width: 100vw;
        max-width: none;
        height: 100%;
        margin: 0;
    }

    .modal-fullscreen-xxl-down .modal-content {
        height: 100%;
        border: 0;
        border-radius: 0;
    }

    .modal-fullscreen-xxl-down .modal-header {
        border-radius: 0;
    }

    .modal-fullscreen-xxl-down .modal-body {
        overflow-y: auto;
    }

    .modal-fullscreen-xxl-down .modal-footer {
        border-radius: 0;
    }
}

.tooltip {
    position: absolute;
    z-index: 1070;
    display: block;
    margin: 2rem;
    font-family: var(--bs-font-sans-serif);
    font-style: normal;
    font-weight: 400;
    line-height: 1.5;
    text-align: left;
    text-align: start;
    text-decoration: none;
    text-shadow: none;
    text-transform: none;
    letter-spacing: normal;
    word-break: normal;
    word-spacing: normal;
    white-space: normal;
    line-break: auto;
    font-size: 0.875rem;
    word-wrap: break-word;
    opacity: 0;
}

.tooltip.show {
    opacity: 0.99;
}

.tooltip .tooltip-arrow {
    position: absolute;
    display: block;
    width: 0.8rem;
    height: 0.4rem;
}

.tooltip .tooltip-arrow::before {
    position: absolute;
    content: "";
    border-color: transparent;
    border-style: solid;
}

.bs-tooltip-top, .bs-tooltip-auto[data-popper-placement^=top] {
    padding: 0.4rem 0;
}

.bs-tooltip-top .tooltip-arrow, .bs-tooltip-auto[data-popper-placement^=top] .tooltip-arrow {
    bottom: 0;
}

.bs-tooltip-top .tooltip-arrow::before, .bs-tooltip-auto[data-popper-placement^=top] .tooltip-arrow::before {
    top: -1px;
    border-width: 0.4rem 0.4rem 0;
    border-top-color: #1F2937;
}

.bs-tooltip-end, .bs-tooltip-auto[data-popper-placement^=right] {
    padding: 0 0.4rem;
}

.bs-tooltip-end .tooltip-arrow, .bs-tooltip-auto[data-popper-placement^=right] .tooltip-arrow {
    left: 0;
    width: 0.4rem;
    height: 0.8rem;
}

.bs-tooltip-end .tooltip-arrow::before, .bs-tooltip-auto[data-popper-placement^=right] .tooltip-arrow::before {
    right: -1px;
    border-width: 0.4rem 0.4rem 0.4rem 0;
    border-right-color: #1F2937;
}

.bs-tooltip-bottom, .bs-tooltip-auto[data-popper-placement^=bottom] {
    padding: 0.4rem 0;
}

.bs-tooltip-bottom .tooltip-arrow, .bs-tooltip-auto[data-popper-placement^=bottom] .tooltip-arrow {
    top: 0;
}

.bs-tooltip-bottom .tooltip-arrow::before, .bs-tooltip-auto[data-popper-placement^=bottom] .tooltip-arrow::before {
    bottom: -1px;
    border-width: 0 0.4rem 0.4rem;
    border-bottom-color: #1F2937;
}

.bs-tooltip-start, .bs-tooltip-auto[data-popper-placement^=left] {
    padding: 0 0.4rem;
}

.bs-tooltip-start .tooltip-arrow, .bs-tooltip-auto[data-popper-placement^=left] .tooltip-arrow {
    right: 0;
    width: 0.4rem;
    height: 0.8rem;
}

.bs-tooltip-start .tooltip-arrow::before, .bs-tooltip-auto[data-popper-placement^=left] .tooltip-arrow::before {
    left: -1px;
    border-width: 0.4rem 0 0.4rem 0.4rem;
    border-left-color: #1F2937;
}

.tooltip-inner {
    max-width: 200px;
    padding: 0.5rem 0.55rem;
    color: #ffffff;
    text-align: center;
    background-color: #1F2937;
    border-radius: 0.5rem;
}

.popover {
    position: absolute;
    top: 0;
    left: 0 /* rtl:ignore */;
    z-index: 1060;
    display: block;
    max-width: 276px;
    font-family: var(--bs-font-sans-serif);
    font-style: normal;
    font-weight: 400;
    line-height: 1.5;
    text-align: left;
    text-align: start;
    text-decoration: none;
    text-shadow: none;
    text-transform: none;
    letter-spacing: normal;
    word-break: normal;
    word-spacing: normal;
    white-space: normal;
    line-break: auto;
    font-size: 0.875rem;
    word-wrap: break-word;
    background-color: #1F2937;
    background-clip: padding-box;
    border: 0.0625rem solid rgba(17, 24, 39, 0.2);
    border-radius: 1rem;
    box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
}

.popover .popover-arrow {
    position: absolute;
    display: block;
    width: 1rem;
    height: 0.5rem;
}

.popover .popover-arrow::before, .popover .popover-arrow::after {
    position: absolute;
    display: block;
    content: "";
    border-color: transparent;
    border-style: solid;
}

.bs-popover-top > .popover-arrow, .bs-popover-auto[data-popper-placement^=top] > .popover-arrow {
    bottom: -0.5625rem;
}

.bs-popover-top > .popover-arrow::before, .bs-popover-auto[data-popper-placement^=top] > .popover-arrow::before {
    bottom: 0;
    border-width: 0.5rem 0.5rem 0;
    border-top-color: rgba(17, 24, 39, 0.25);
}

.bs-popover-top > .popover-arrow::after, .bs-popover-auto[data-popper-placement^=top] > .popover-arrow::after {
    bottom: 0.0625rem;
    border-width: 0.5rem 0.5rem 0;
    border-top-color: #1F2937;
}

.bs-popover-end > .popover-arrow, .bs-popover-auto[data-popper-placement^=right] > .popover-arrow {
    left: -0.5625rem;
    width: 0.5rem;
    height: 1rem;
}

.bs-popover-end > .popover-arrow::before, .bs-popover-auto[data-popper-placement^=right] > .popover-arrow::before {
    left: 0;
    border-width: 0.5rem 0.5rem 0.5rem 0;
    border-right-color: rgba(17, 24, 39, 0.25);
}

.bs-popover-end > .popover-arrow::after, .bs-popover-auto[data-popper-placement^=right] > .popover-arrow::after {
    left: 0.0625rem;
    border-width: 0.5rem 0.5rem 0.5rem 0;
    border-right-color: #1F2937;
}

.bs-popover-bottom > .popover-arrow, .bs-popover-auto[data-popper-placement^=bottom] > .popover-arrow {
    top: -0.5625rem;
}

.bs-popover-bottom > .popover-arrow::before, .bs-popover-auto[data-popper-placement^=bottom] > .popover-arrow::before {
    top: 0;
    border-width: 0 0.5rem 0.5rem 0.5rem;
    border-bottom-color: rgba(17, 24, 39, 0.25);
}

.bs-popover-bottom > .popover-arrow::after, .bs-popover-auto[data-popper-placement^=bottom] > .popover-arrow::after {
    top: 0.0625rem;
    border-width: 0 0.5rem 0.5rem 0.5rem;
    border-bottom-color: #1F2937;
}

.bs-popover-bottom .popover-header::before, .bs-popover-auto[data-popper-placement^=bottom] .popover-header::before {
    position: absolute;
    top: 0;
    left: 50%;
    display: block;
    width: 1rem;
    margin-left: -0.5rem;
    content: "";
    border-bottom: 0.0625rem solid #19222d;
}

.bs-popover-start > .popover-arrow, .bs-popover-auto[data-popper-placement^=left] > .popover-arrow {
    right: -0.5625rem;
    width: 0.5rem;
    height: 1rem;
}

.bs-popover-start > .popover-arrow::before, .bs-popover-auto[data-popper-placement^=left] > .popover-arrow::before {
    right: 0;
    border-width: 0.5rem 0 0.5rem 0.5rem;
    border-left-color: rgba(17, 24, 39, 0.25);
}

.bs-popover-start > .popover-arrow::after, .bs-popover-auto[data-popper-placement^=left] > .popover-arrow::after {
    right: 0.0625rem;
    border-width: 0.5rem 0 0.5rem 0.5rem;
    border-left-color: #1F2937;
}

.popover-header {
    padding: 0.5rem 1rem;
    margin-bottom: 0;
    font-size: 1rem;
    color: #1F2937;
    background-color: #19222d;
    border-bottom: 0.0625rem solid rgba(17, 24, 39, 0.2);
    border-top-left-radius: 0.9375rem;
    border-top-right-radius: 0.9375rem;
}

.popover-header:empty {
    display: none;
}

.popover-body {
    padding: 1rem 1rem;
    color: #ffffff;
}

.carousel {
    position: relative;
}

.carousel.pointer-event {
    touch-action: pan-y;
}

.carousel-inner {
    position: relative;
    width: 100%;
    overflow: hidden;
}

.carousel-inner::after {
    display: block;
    clear: both;
    content: "";
}

.carousel-item {
    position: relative;
    display: none;
    float: left;
    width: 100%;
    margin-right: -100%;
    -webkit-backface-visibility: hidden;
    backface-visibility: hidden;
    transition: transform 0.6s ease-in-out;
}

@media (prefers-reduced-motion: reduce) {
    .carousel-item {
        transition: none;
    }
}

.carousel-item.active,
.carousel-item-next,
.carousel-item-prev {
    display: block;
}

/* rtl:begin:ignore */
.carousel-item-next:not(.carousel-item-start),
.active.carousel-item-end {
    transform: translateX(100%);
}

.carousel-item-prev:not(.carousel-item-end),
.active.carousel-item-start {
    transform: translateX(-100%);
}

/* rtl:end:ignore */
.carousel-fade .carousel-item {
    opacity: 0;
    transition-property: opacity;
    transform: none;
}

.carousel-fade .carousel-item.active,
.carousel-fade .carousel-item-next.carousel-item-start,
.carousel-fade .carousel-item-prev.carousel-item-end {
    z-index: 1;
    opacity: 1;
}

.carousel-fade .active.carousel-item-start,
.carousel-fade .active.carousel-item-end {
    z-index: 0;
    opacity: 0;
    transition: opacity 0s 0.6s;
}

@media (prefers-reduced-motion: reduce) {
    .carousel-fade .active.carousel-item-start,
.carousel-fade .active.carousel-item-end {
        transition: none;
    }
}

.carousel-control-prev,
.carousel-control-next {
    position: absolute;
    top: 0;
    bottom: 0;
    z-index: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 15%;
    padding: 0;
    color: #ffffff;
    text-align: center;
    background: none;
    border: 0;
    opacity: 0.5;
    transition: opacity 0.15s ease;
}

@media (prefers-reduced-motion: reduce) {
    .carousel-control-prev,
.carousel-control-next {
        transition: none;
    }
}

.carousel-control-prev:hover, .carousel-control-prev:focus,
.carousel-control-next:hover,
.carousel-control-next:focus {
    color: #ffffff;
    text-decoration: none;
    outline: 0;
    opacity: 0.9;
}

.carousel-control-prev {
    left: 0;
}

.carousel-control-next {
    right: 0;
}

.carousel-control-prev-icon,
.carousel-control-next-icon {
    display: inline-block;
    width: 20px;
    height: 20px;
    background-repeat: no-repeat;
    background-position: 50%;
    background-size: 100% 100%;
}

/* rtl:options: {
  "autoRename": true,
  "stringMap":[ {
    "name"    : "prev-next",
    "search"  : "prev",
    "replace" : "next"
  } ]
} */
.carousel-control-prev-icon {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='%23ffffff' viewBox='0 0 8 8'%3e%3cpath d='M5.25 0l-4 4 4 4 1.5-1.5L4.25 4l2.5-2.5L5.25 0z'/%3e%3c/svg%3e");
}

.carousel-control-next-icon {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='%23ffffff' viewBox='0 0 8 8'%3e%3cpath d='M2.75 0l-1.5 1.5L3.75 4l-2.5 2.5L2.75 8l4-4-4-4z'/%3e%3c/svg%3e");
}

.carousel-indicators {
    position: absolute;
    right: 0;
    bottom: 0;
    left: 0;
    z-index: 2;
    display: flex;
    justify-content: center;
    padding: 0;
    margin-right: 15%;
    margin-bottom: 1rem;
    margin-left: 15%;
    list-style: none;
}

.carousel-indicators [data-bs-target] {
    box-sizing: content-box;
    flex: 0 1 auto;
    width: 30px;
    height: 3px;
    padding: 0;
    margin-right: 3px;
    margin-left: 3px;
    text-indent: -999px;
    cursor: pointer;
    background-color: #ffffff;
    background-clip: padding-box;
    border: 0;
    border-top: 10px solid transparent;
    border-bottom: 10px solid transparent;
    opacity: 0.5;
    transition: opacity 0.6s ease;
}

@media (prefers-reduced-motion: reduce) {
    .carousel-indicators [data-bs-target] {
        transition: none;
    }
}

.carousel-indicators .active {
    opacity: 1;
}

.carousel-caption {
    position: absolute;
    right: 15%;
    bottom: 1.25rem;
    left: 15%;
    padding-top: 1.25rem;
    padding-bottom: 1.25rem;
    color: #ffffff;
    text-align: center;
}

.carousel-dark .carousel-control-prev-icon,
.carousel-dark .carousel-control-next-icon {
    filter: invert(1) grayscale(100);
}

.carousel-dark .carousel-indicators [data-bs-target] {
    background-color: #111827;
}

.carousel-dark .carousel-caption {
    color: #111827;
}

@keyframes spinner-border {
    to {
        transform: rotate(360deg) /* rtl:ignore */;
    }
}

.spinner-border {
    display: inline-block;
    width: 2rem;
    height: 2rem;
    vertical-align: -0.125em;
    border: 0.25em solid currentColor;
    border-right-color: transparent;
    border-radius: 50%;
    animation: 0.75s linear infinite spinner-border;
}

.spinner-border-sm {
    width: 1.2rem;
    height: 1.2rem;
    border-width: 0.2em;
}

@keyframes spinner-grow {
    0% {
        transform: scale(0);
    }

    50% {
        opacity: 1;
        transform: none;
    }
}

.spinner-grow {
    display: inline-block;
    width: 2rem;
    height: 2rem;
    vertical-align: -0.125em;
    background-color: currentColor;
    border-radius: 50%;
    opacity: 0;
    animation: 0.75s linear infinite spinner-grow;
}

.spinner-grow-sm {
    width: 1.2rem;
    height: 1.2rem;
}

@media (prefers-reduced-motion: reduce) {
    .spinner-border,
.spinner-grow {
        animation-duration: 1.5s;
    }
}

.clearfix::after {
    display: block;
    clear: both;
    content: "";
}

.link-primary {
    color: #1F2937;
}

.link-primary:hover, .link-primary:focus {
    color: #19212c;
}

.link-secondary {
    color: #f0bc74;
}

.link-secondary:hover, .link-secondary:focus {
    color: #f3c990;
}

.link-tertiary {
    color: #31316A;
}

.link-tertiary:hover, .link-tertiary:focus {
    color: #272755;
}

.link-success {
    color: #10B981;
}

.link-success:hover, .link-success:focus {
    color: #40c79a;
}

.link-info {
    color: #2361ce;
}

.link-info:hover, .link-info:focus {
    color: #1c4ea5;
}

.link-warning {
    color: #f3c78e;
}

.link-warning:hover, .link-warning:focus {
    color: #f5d2a5;
}

.link-danger {
    color: #E11D48;
}

.link-danger:hover, .link-danger:focus {
    color: #b4173a;
}

.link-white {
    color: #ffffff;
}

.link-white:hover, .link-white:focus {
    color: white;
}

.link-indigo {
    color: #4F46E5;
}

.link-indigo:hover, .link-indigo:focus {
    color: #3f38b7;
}

.link-purple {
    color: #7C3AED;
}

.link-purple:hover, .link-purple:focus {
    color: #632ebe;
}

.link-yellow-100 {
    color: #ffeed6;
}

.link-yellow-100:hover, .link-yellow-100:focus {
    color: #fff1de;
}

.link-yellow-200 {
    color: #f5dbb8;
}

.link-yellow-200:hover, .link-yellow-200:focus {
    color: #f7e2c6;
}

.link-gray-50 {
    color: #F9FAFB;
}

.link-gray-50:hover, .link-gray-50:focus {
    color: #fafbfc;
}

.link-gray-100 {
    color: #F2F4F6;
}

.link-gray-100:hover, .link-gray-100:focus {
    color: #f5f6f8;
}

.link-gray-200 {
    color: #E5E7EB;
}

.link-gray-200:hover, .link-gray-200:focus {
    color: #eaecef;
}

.link-gray-300 {
    color: #D1D5DB;
}

.link-gray-300:hover, .link-gray-300:focus {
    color: #dadde2;
}

.link-gray-400 {
    color: #9CA3AF;
}

.link-gray-400:hover, .link-gray-400:focus {
    color: #b0b5bf;
}

.link-gray-500 {
    color: #6B7280;
}

.link-gray-500:hover, .link-gray-500:focus {
    color: #565b66;
}

.link-gray-600 {
    color: #4B5563;
}

.link-gray-600:hover, .link-gray-600:focus {
    color: #3c444f;
}

.link-gray-700 {
    color: #374151;
}

.link-gray-700:hover, .link-gray-700:focus {
    color: #2c3441;
}

.link-gray-800 {
    color: #1F2937;
}

.link-gray-800:hover, .link-gray-800:focus {
    color: #19212c;
}

.link-gray-900 {
    color: #111827;
}

.link-gray-900:hover, .link-gray-900:focus {
    color: #0e131f;
}

.ratio {
    position: relative;
    width: 100%;
}

.ratio::before {
    display: block;
    padding-top: var(--bs-aspect-ratio);
    content: "";
}

.ratio > * {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}

.ratio-1x1 {
    --bs-aspect-ratio: 100%;
}

.ratio-4x3 {
    --bs-aspect-ratio: 75%;
}

.ratio-16x9 {
    --bs-aspect-ratio: 56.25%;
}

.ratio-21x9 {
    --bs-aspect-ratio: 42.8571428571%;
}

.fixed-top {
    position: fixed;
    top: 0;
    right: 0;
    left: 0;
    z-index: 1030;
}

.fixed-bottom {
    position: fixed;
    right: 0;
    bottom: 0;
    left: 0;
    z-index: 1030;
}

.sticky-top {
    position: sticky;
    top: 0;
    z-index: 1020;
}

@media (min-width: 576px) {
    .sticky-sm-top {
        position: sticky;
        top: 0;
        z-index: 1020;
    }
}

@media (min-width: 768px) {
    .sticky-md-top {
        position: sticky;
        top: 0;
        z-index: 1020;
    }
}

@media (min-width: 992px) {
    .sticky-lg-top {
        position: sticky;
        top: 0;
        z-index: 1020;
    }
}

@media (min-width: 1200px) {
    .sticky-xl-top {
        position: sticky;
        top: 0;
        z-index: 1020;
    }
}

@media (min-width: 1400px) {
    .sticky-xxl-top {
        position: sticky;
        top: 0;
        z-index: 1020;
    }
}

.hstack {
    display: flex;
    flex-direction: row;
    align-items: center;
    align-self: stretch;
}

.vstack {
    display: flex;
    flex: 1 1 auto;
    flex-direction: column;
    align-self: stretch;
}

.visually-hidden,
.visually-hidden-focusable:not(:focus):not(:focus-within) {
    position: absolute !important;
    width: 1px !important;
    height: 1px !important;
    padding: 0 !important;
    margin: -1px !important;
    overflow: hidden !important;
    clip: rect(0, 0, 0, 0) !important;
    white-space: nowrap !important;
    border: 0 !important;
}

.stretched-link::after {
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    z-index: 1;
    content: "";
}

.text-truncate {
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.vr {
    display: inline-block;
    align-self: stretch;
    width: 1px;
    min-height: 1em;
    background-color: currentColor;
    opacity: 0.25;
}

.align-baseline {
    vertical-align: baseline !important;
}

.align-top {
    vertical-align: top !important;
}

.align-middle {
    vertical-align: middle !important;
}

.align-bottom {
    vertical-align: bottom !important;
}

.align-text-bottom {
    vertical-align: text-bottom !important;
}

.align-text-top {
    vertical-align: text-top !important;
}

.float-start {
    float: left !important;
}

.float-end {
    float: right !important;
}

.float-none {
    float: none !important;
}

.o-0 {
    opacity: 0 !important;
}

.o-25 {
    opacity: 0.25 !important;
}

.o-50 {
    opacity: 0.5 !important;
}

.o-75 {
    opacity: 0.75 !important;
}

.o-100 {
    opacity: 1 !important;
}

.overflow-auto {
    overflow: auto !important;
}

.overflow-hidden {
    overflow: hidden !important;
}

.overflow-visible {
    overflow: visible !important;
}

.overflow-scroll {
    overflow: scroll !important;
}

.d-inline {
    display: inline !important;
}

.d-inline-block {
    display: inline-block !important;
}

.d-block {
    display: block !important;
}

.d-grid {
    display: grid !important;
}

.d-table {
    display: table !important;
}

.d-table-row {
    display: table-row !important;
}

.d-table-cell {
    display: table-cell !important;
}

.d-flex {
    display: flex !important;
}

.d-inline-flex {
    display: inline-flex !important;
}

.d-none {
    display: none !important;
}

.shadow {
    box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06) !important;
}

.shadow-sm {
    box-shadow: 0 2px 5px rgba(140, 152, 164, 0.2) !important;
}

.shadow-lg {
    box-shadow: 0 1rem 3rem rgba(17, 24, 39, 0.175) !important;
}

.shadow-none {
    box-shadow: none !important;
}

.position-static {
    position: static !important;
}

.position-relative {
    position: relative !important;
}

.position-absolute {
    position: absolute !important;
}

.position-fixed {
    position: fixed !important;
}

.position-sticky {
    position: sticky !important;
}

.top-0 {
    top: 0 !important;
}

.top-50 {
    top: 50% !important;
}

.top-100 {
    top: 100% !important;
}

.bottom-0 {
    bottom: 0 !important;
}

.bottom-50 {
    bottom: 50% !important;
}

.bottom-100 {
    bottom: 100% !important;
}

.start-0 {
    left: 0 !important;
}

.start-50 {
    left: 50% !important;
}

.start-100 {
    left: 100% !important;
}

.end-0 {
    right: 0 !important;
}

.end-50 {
    right: 50% !important;
}

.end-100 {
    right: 100% !important;
}

.translate-middle {
    transform: translate(-50%, -50%) !important;
}

.translate-middle-x {
    transform: translateX(-50%) !important;
}

.translate-middle-y {
    transform: translateY(-50%) !important;
}

.border {
    border: 0.0625rem solid #E5E7EB !important;
}

.border-0 {
    border: 0 !important;
}

.border-top {
    border-top: 0.0625rem solid #E5E7EB !important;
}

.border-top-0 {
    border-top: 0 !important;
}

.border-end {
    border-right: 0.0625rem solid #E5E7EB !important;
}

.border-end-0 {
    border-right: 0 !important;
}

.border-bottom {
    border-bottom: 0.0625rem solid #E5E7EB !important;
}

.border-bottom-0 {
    border-bottom: 0 !important;
}

.border-start {
    border-left: 0.0625rem solid #E5E7EB !important;
}

.border-start-0 {
    border-left: 0 !important;
}

.border-primary {
    border-color: #1F2937 !important;
}

.border-secondary {
    border-color: #f0bc74 !important;
}

.border-tertiary {
    border-color: #31316A !important;
}

.border-success {
    border-color: #10B981 !important;
}

.border-info {
    border-color: #2361ce !important;
}

.border-warning {
    border-color: #f3c78e !important;
}

.border-danger {
    border-color: #E11D48 !important;
}

.border-white {
    border-color: #ffffff !important;
}

.border-indigo {
    border-color: #4F46E5 !important;
}

.border-purple {
    border-color: #7C3AED !important;
}

.border-yellow-100 {
    border-color: #ffeed6 !important;
}

.border-yellow-200 {
    border-color: #f5dbb8 !important;
}

.border-gray-50 {
    border-color: #F9FAFB !important;
}

.border-gray-100 {
    border-color: #F2F4F6 !important;
}

.border-gray-200 {
    border-color: #E5E7EB !important;
}

.border-gray-300 {
    border-color: #D1D5DB !important;
}

.border-gray-400 {
    border-color: #9CA3AF !important;
}

.border-gray-500 {
    border-color: #6B7280 !important;
}

.border-gray-600 {
    border-color: #4B5563 !important;
}

.border-gray-700 {
    border-color: #374151 !important;
}

.border-gray-800 {
    border-color: #1F2937 !important;
}

.border-gray-900 {
    border-color: #111827 !important;
}

.border-1 {
    border-width: 1px !important;
}

.border-2 {
    border-width: 2px !important;
}

.border-3 {
    border-width: 3px !important;
}

.border-4 {
    border-width: 4px !important;
}

.border-5 {
    border-width: 5px !important;
}

.w-25 {
    width: 25% !important;
}

.w-50 {
    width: 50% !important;
}

.w-75 {
    width: 75% !important;
}

.w-100 {
    width: 100% !important;
}

.w-auto {
    width: auto !important;
}

.fmxw-100 {
    max-width: 100px !important;
}

.fmxw-200 {
    max-width: 200px !important;
}

.fmxw-300 {
    max-width: 300px !important;
}

.fmxw-400 {
    max-width: 400px !important;
}

.fmxw-500 {
    max-width: 500px !important;
}

.fmxw-999 {
    max-width: 999px !important;
}

.vw-100 {
    width: 100vw !important;
}

.min-vw-100 {
    min-width: 100vw !important;
}

.h-25 {
    height: 25% !important;
}

.h-50 {
    height: 50% !important;
}

.h-75 {
    height: 75% !important;
}

.h-100 {
    height: 100% !important;
}

.h-auto {
    height: auto !important;
}

.mh-100 {
    max-height: 100% !important;
}

.vh-100 {
    height: 100vh !important;
}

.min-vh-100 {
    min-height: 100vh !important;
}

.flex-fill {
    flex: 1 1 auto !important;
}

.flex-row {
    flex-direction: row !important;
}

.flex-column {
    flex-direction: column !important;
}

.flex-row-reverse {
    flex-direction: row-reverse !important;
}

.flex-column-reverse {
    flex-direction: column-reverse !important;
}

.flex-grow-0 {
    flex-grow: 0 !important;
}

.flex-grow-1 {
    flex-grow: 1 !important;
}

.flex-shrink-0 {
    flex-shrink: 0 !important;
}

.flex-shrink-1 {
    flex-shrink: 1 !important;
}

.flex-wrap {
    flex-wrap: wrap !important;
}

.flex-nowrap {
    flex-wrap: nowrap !important;
}

.flex-wrap-reverse {
    flex-wrap: wrap-reverse !important;
}

.gap-0 {
    gap: 0 !important;
}

.gap-1 {
    gap: 0.25rem !important;
}

.gap-2 {
    gap: 0.5rem !important;
}

.gap-3 {
    gap: 1rem !important;
}

.gap-4 {
    gap: 1.5rem !important;
}

.gap-5 {
    gap: 3rem !important;
}

.gap-6 {
    gap: 5rem !important;
}

.gap-7 {
    gap: 8rem !important;
}

.gap-8 {
    gap: 10rem !important;
}

.gap-9 {
    gap: 11rem !important;
}

.gap-10 {
    gap: 14rem !important;
}

.gap-11 {
    gap: 16rem !important;
}

.gap-12 {
    gap: 20rem !important;
}

.gap-sm {
    gap: 1rem !important;
}

.gap-md {
    gap: 2rem !important;
}

.gap-lg {
    gap: 4rem !important;
}

.gap-xl {
    gap: 8rem !important;
}

.justify-content-start {
    justify-content: flex-start !important;
}

.justify-content-end {
    justify-content: flex-end !important;
}

.justify-content-center {
    justify-content: center !important;
}

.justify-content-between {
    justify-content: space-between !important;
}

.justify-content-around {
    justify-content: space-around !important;
}

.justify-content-evenly {
    justify-content: space-evenly !important;
}

.align-items-start {
    align-items: flex-start !important;
}

.align-items-end {
    align-items: flex-end !important;
}

.align-items-center {
    align-items: center !important;
}

.align-items-baseline {
    align-items: baseline !important;
}

.align-items-stretch {
    align-items: stretch !important;
}

.align-content-start {
    align-content: flex-start !important;
}

.align-content-end {
    align-content: flex-end !important;
}

.align-content-center {
    align-content: center !important;
}

.align-content-between {
    align-content: space-between !important;
}

.align-content-around {
    align-content: space-around !important;
}

.align-content-stretch {
    align-content: stretch !important;
}

.align-self-auto {
    align-self: auto !important;
}

.align-self-start {
    align-self: flex-start !important;
}

.align-self-end {
    align-self: flex-end !important;
}

.align-self-center {
    align-self: center !important;
}

.align-self-baseline {
    align-self: baseline !important;
}

.align-self-stretch {
    align-self: stretch !important;
}

.order-first {
    order: -1 !important;
}

.order-0 {
    order: 0 !important;
}

.order-1 {
    order: 1 !important;
}

.order-2 {
    order: 2 !important;
}

.order-3 {
    order: 3 !important;
}

.order-4 {
    order: 4 !important;
}

.order-5 {
    order: 5 !important;
}

.order-last {
    order: 6 !important;
}

.m-0 {
    margin: 0 !important;
}

.m-1 {
    margin: 0.25rem !important;
}

.m-2 {
    margin: 0.5rem !important;
}

.m-3 {
    margin: 1rem !important;
}

.m-4 {
    margin: 1.5rem !important;
}

.m-5 {
    margin: 3rem !important;
}

.m-6 {
    margin: 5rem !important;
}

.m-7 {
    margin: 8rem !important;
}

.m-8 {
    margin: 10rem !important;
}

.m-9 {
    margin: 11rem !important;
}

.m-10 {
    margin: 14rem !important;
}

.m-11 {
    margin: 16rem !important;
}

.m-12 {
    margin: 20rem !important;
}

.m-sm {
    margin: 1rem !important;
}

.m-md {
    margin: 2rem !important;
}

.m-lg {
    margin: 4rem !important;
}

.m-xl {
    margin: 8rem !important;
}

.m-auto {
    margin: auto !important;
}

.mx-0 {
    margin-right: 0 !important;
    margin-left: 0 !important;
}

.mx-1 {
    margin-right: 0.25rem !important;
    margin-left: 0.25rem !important;
}

.mx-2 {
    margin-right: 0.5rem !important;
    margin-left: 0.5rem !important;
}

.mx-3 {
    margin-right: 1rem !important;
    margin-left: 1rem !important;
}

.mx-4 {
    margin-right: 1.5rem !important;
    margin-left: 1.5rem !important;
}

.mx-5 {
    margin-right: 3rem !important;
    margin-left: 3rem !important;
}

.mx-6 {
    margin-right: 5rem !important;
    margin-left: 5rem !important;
}

.mx-7 {
    margin-right: 8rem !important;
    margin-left: 8rem !important;
}

.mx-8 {
    margin-right: 10rem !important;
    margin-left: 10rem !important;
}

.mx-9 {
    margin-right: 11rem !important;
    margin-left: 11rem !important;
}

.mx-10 {
    margin-right: 14rem !important;
    margin-left: 14rem !important;
}

.mx-11 {
    margin-right: 16rem !important;
    margin-left: 16rem !important;
}

.mx-12 {
    margin-right: 20rem !important;
    margin-left: 20rem !important;
}

.mx-sm {
    margin-right: 1rem !important;
    margin-left: 1rem !important;
}

.mx-md {
    margin-right: 2rem !important;
    margin-left: 2rem !important;
}

.mx-lg {
    margin-right: 4rem !important;
    margin-left: 4rem !important;
}

.mx-xl {
    margin-right: 8rem !important;
    margin-left: 8rem !important;
}

.mx-auto {
    margin-right: auto !important;
    margin-left: auto !important;
}

.my-0 {
    margin-top: 0 !important;
    margin-bottom: 0 !important;
}

.my-1 {
    margin-top: 0.25rem !important;
    margin-bottom: 0.25rem !important;
}

.my-2 {
    margin-top: 0.5rem !important;
    margin-bottom: 0.5rem !important;
}

.my-3 {
    margin-top: 1rem !important;
    margin-bottom: 1rem !important;
}

.my-4 {
    margin-top: 1.5rem !important;
    margin-bottom: 1.5rem !important;
}

.my-5 {
    margin-top: 3rem !important;
    margin-bottom: 3rem !important;
}

.my-6 {
    margin-top: 5rem !important;
    margin-bottom: 5rem !important;
}

.my-7 {
    margin-top: 8rem !important;
    margin-bottom: 8rem !important;
}

.my-8 {
    margin-top: 10rem !important;
    margin-bottom: 10rem !important;
}

.my-9 {
    margin-top: 11rem !important;
    margin-bottom: 11rem !important;
}

.my-10 {
    margin-top: 14rem !important;
    margin-bottom: 14rem !important;
}

.my-11 {
    margin-top: 16rem !important;
    margin-bottom: 16rem !important;
}

.my-12 {
    margin-top: 20rem !important;
    margin-bottom: 20rem !important;
}

.my-sm {
    margin-top: 1rem !important;
    margin-bottom: 1rem !important;
}

.my-md {
    margin-top: 2rem !important;
    margin-bottom: 2rem !important;
}

.my-lg {
    margin-top: 4rem !important;
    margin-bottom: 4rem !important;
}

.my-xl {
    margin-top: 8rem !important;
    margin-bottom: 8rem !important;
}

.my-auto {
    margin-top: auto !important;
    margin-bottom: auto !important;
}

.mt-0 {
    margin-top: 0 !important;
}

.mt-1 {
    margin-top: 0.25rem !important;
}

.mt-2 {
    margin-top: 0.5rem !important;
}

.mt-3 {
    margin-top: 1rem !important;
}

.mt-4 {
    margin-top: 1.5rem !important;
}

.mt-5 {
    margin-top: 3rem !important;
}

.mt-6 {
    margin-top: 5rem !important;
}

.mt-7 {
    margin-top: 8rem !important;
}

.mt-8 {
    margin-top: 10rem !important;
}

.mt-9 {
    margin-top: 11rem !important;
}

.mt-10 {
    margin-top: 14rem !important;
}

.mt-11 {
    margin-top: 16rem !important;
}

.mt-12 {
    margin-top: 20rem !important;
}

.mt-sm {
    margin-top: 1rem !important;
}

.mt-md {
    margin-top: 2rem !important;
}

.mt-lg {
    margin-top: 4rem !important;
}

.mt-xl {
    margin-top: 8rem !important;
}

.mt-auto {
    margin-top: auto !important;
}

.me-0 {
    margin-right: 0 !important;
}

.me-1 {
    margin-right: 0.25rem !important;
}

.me-2 {
    margin-right: 0.5rem !important;
}

.me-3 {
    margin-right: 1rem !important;
}

.me-4 {
    margin-right: 1.5rem !important;
}

.me-5 {
    margin-right: 3rem !important;
}

.me-6 {
    margin-right: 5rem !important;
}

.me-7 {
    margin-right: 8rem !important;
}

.me-8 {
    margin-right: 10rem !important;
}

.me-9 {
    margin-right: 11rem !important;
}

.me-10 {
    margin-right: 14rem !important;
}

.me-11 {
    margin-right: 16rem !important;
}

.me-12 {
    margin-right: 20rem !important;
}

.me-sm {
    margin-right: 1rem !important;
}

.me-md {
    margin-right: 2rem !important;
}

.me-lg {
    margin-right: 4rem !important;
}

.me-xl {
    margin-right: 8rem !important;
}

.me-auto {
    margin-right: auto !important;
}

.mb-0 {
    margin-bottom: 0 !important;
}

.mb-1 {
    margin-bottom: 0.25rem !important;
}

.mb-2 {
    margin-bottom: 0.5rem !important;
}

.mb-3 {
    margin-bottom: 1rem !important;
}

.mb-4 {
    margin-bottom: 1.5rem !important;
}

.mb-5 {
    margin-bottom: 3rem !important;
}

.mb-6 {
    margin-bottom: 5rem !important;
}

.mb-7 {
    margin-bottom: 8rem !important;
}

.mb-8 {
    margin-bottom: 10rem !important;
}

.mb-9 {
    margin-bottom: 11rem !important;
}

.mb-10 {
    margin-bottom: 14rem !important;
}

.mb-11 {
    margin-bottom: 16rem !important;
}

.mb-12 {
    margin-bottom: 20rem !important;
}

.mb-sm {
    margin-bottom: 1rem !important;
}

.mb-md {
    margin-bottom: 2rem !important;
}

.mb-lg {
    margin-bottom: 4rem !important;
}

.mb-xl {
    margin-bottom: 8rem !important;
}

.mb-auto {
    margin-bottom: auto !important;
}

.ms-0 {
    margin-left: 0 !important;
}

.ms-1 {
    margin-left: 0.25rem !important;
}

.ms-2 {
    margin-left: 0.5rem !important;
}

.ms-3 {
    margin-left: 1rem !important;
}

.ms-4 {
    margin-left: 1.5rem !important;
}

.ms-5 {
    margin-left: 3rem !important;
}

.ms-6 {
    margin-left: 5rem !important;
}

.ms-7 {
    margin-left: 8rem !important;
}

.ms-8 {
    margin-left: 10rem !important;
}

.ms-9 {
    margin-left: 11rem !important;
}

.ms-10 {
    margin-left: 14rem !important;
}

.ms-11 {
    margin-left: 16rem !important;
}

.ms-12 {
    margin-left: 20rem !important;
}

.ms-sm {
    margin-left: 1rem !important;
}

.ms-md {
    margin-left: 2rem !important;
}

.ms-lg {
    margin-left: 4rem !important;
}

.ms-xl {
    margin-left: 8rem !important;
}

.ms-auto {
    margin-left: auto !important;
}

.m-n1 {
    margin: -0.25rem !important;
}

.m-n2 {
    margin: -0.5rem !important;
}

.m-n3 {
    margin: -1rem !important;
}

.m-n4 {
    margin: -1.5rem !important;
}

.m-n5 {
    margin: -3rem !important;
}

.m-n6 {
    margin: -5rem !important;
}

.m-n7 {
    margin: -8rem !important;
}

.m-n8 {
    margin: -10rem !important;
}

.m-n9 {
    margin: -11rem !important;
}

.m-n10 {
    margin: -14rem !important;
}

.m-n11 {
    margin: -16rem !important;
}

.m-n12 {
    margin: -20rem !important;
}

.m-nsm {
    margin: -1rem !important;
}

.m-nmd {
    margin: -2rem !important;
}

.m-nlg {
    margin: -4rem !important;
}

.m-nxl {
    margin: -8rem !important;
}

.mx-n1 {
    margin-right: -0.25rem !important;
    margin-left: -0.25rem !important;
}

.mx-n2 {
    margin-right: -0.5rem !important;
    margin-left: -0.5rem !important;
}

.mx-n3 {
    margin-right: -1rem !important;
    margin-left: -1rem !important;
}

.mx-n4 {
    margin-right: -1.5rem !important;
    margin-left: -1.5rem !important;
}

.mx-n5 {
    margin-right: -3rem !important;
    margin-left: -3rem !important;
}

.mx-n6 {
    margin-right: -5rem !important;
    margin-left: -5rem !important;
}

.mx-n7 {
    margin-right: -8rem !important;
    margin-left: -8rem !important;
}

.mx-n8 {
    margin-right: -10rem !important;
    margin-left: -10rem !important;
}

.mx-n9 {
    margin-right: -11rem !important;
    margin-left: -11rem !important;
}

.mx-n10 {
    margin-right: -14rem !important;
    margin-left: -14rem !important;
}

.mx-n11 {
    margin-right: -16rem !important;
    margin-left: -16rem !important;
}

.mx-n12 {
    margin-right: -20rem !important;
    margin-left: -20rem !important;
}

.mx-nsm {
    margin-right: -1rem !important;
    margin-left: -1rem !important;
}

.mx-nmd {
    margin-right: -2rem !important;
    margin-left: -2rem !important;
}

.mx-nlg {
    margin-right: -4rem !important;
    margin-left: -4rem !important;
}

.mx-nxl {
    margin-right: -8rem !important;
    margin-left: -8rem !important;
}

.my-n1 {
    margin-top: -0.25rem !important;
    margin-bottom: -0.25rem !important;
}

.my-n2 {
    margin-top: -0.5rem !important;
    margin-bottom: -0.5rem !important;
}

.my-n3 {
    margin-top: -1rem !important;
    margin-bottom: -1rem !important;
}

.my-n4 {
    margin-top: -1.5rem !important;
    margin-bottom: -1.5rem !important;
}

.my-n5 {
    margin-top: -3rem !important;
    margin-bottom: -3rem !important;
}

.my-n6 {
    margin-top: -5rem !important;
    margin-bottom: -5rem !important;
}

.my-n7 {
    margin-top: -8rem !important;
    margin-bottom: -8rem !important;
}

.my-n8 {
    margin-top: -10rem !important;
    margin-bottom: -10rem !important;
}

.my-n9 {
    margin-top: -11rem !important;
    margin-bottom: -11rem !important;
}

.my-n10 {
    margin-top: -14rem !important;
    margin-bottom: -14rem !important;
}

.my-n11 {
    margin-top: -16rem !important;
    margin-bottom: -16rem !important;
}

.my-n12 {
    margin-top: -20rem !important;
    margin-bottom: -20rem !important;
}

.my-nsm {
    margin-top: -1rem !important;
    margin-bottom: -1rem !important;
}

.my-nmd {
    margin-top: -2rem !important;
    margin-bottom: -2rem !important;
}

.my-nlg {
    margin-top: -4rem !important;
    margin-bottom: -4rem !important;
}

.my-nxl {
    margin-top: -8rem !important;
    margin-bottom: -8rem !important;
}

.mt-n1 {
    margin-top: -0.25rem !important;
}

.mt-n2 {
    margin-top: -0.5rem !important;
}

.mt-n3 {
    margin-top: -1rem !important;
}

.mt-n4 {
    margin-top: -1.5rem !important;
}

.mt-n5 {
    margin-top: -3rem !important;
}

.mt-n6 {
    margin-top: -5rem !important;
}

.mt-n7 {
    margin-top: -8rem !important;
}

.mt-n8 {
    margin-top: -10rem !important;
}

.mt-n9 {
    margin-top: -11rem !important;
}

.mt-n10 {
    margin-top: -14rem !important;
}

.mt-n11 {
    margin-top: -16rem !important;
}

.mt-n12 {
    margin-top: -20rem !important;
}

.mt-nsm {
    margin-top: -1rem !important;
}

.mt-nmd {
    margin-top: -2rem !important;
}

.mt-nlg {
    margin-top: -4rem !important;
}

.mt-nxl {
    margin-top: -8rem !important;
}

.me-n1 {
    margin-right: -0.25rem !important;
}

.me-n2 {
    margin-right: -0.5rem !important;
}

.me-n3 {
    margin-right: -1rem !important;
}

.me-n4 {
    margin-right: -1.5rem !important;
}

.me-n5 {
    margin-right: -3rem !important;
}

.me-n6 {
    margin-right: -5rem !important;
}

.me-n7 {
    margin-right: -8rem !important;
}

.me-n8 {
    margin-right: -10rem !important;
}

.me-n9 {
    margin-right: -11rem !important;
}

.me-n10 {
    margin-right: -14rem !important;
}

.me-n11 {
    margin-right: -16rem !important;
}

.me-n12 {
    margin-right: -20rem !important;
}

.me-nsm {
    margin-right: -1rem !important;
}

.me-nmd {
    margin-right: -2rem !important;
}

.me-nlg {
    margin-right: -4rem !important;
}

.me-nxl {
    margin-right: -8rem !important;
}

.mb-n1 {
    margin-bottom: -0.25rem !important;
}

.mb-n2 {
    margin-bottom: -0.5rem !important;
}

.mb-n3 {
    margin-bottom: -1rem !important;
}

.mb-n4 {
    margin-bottom: -1.5rem !important;
}

.mb-n5 {
    margin-bottom: -3rem !important;
}

.mb-n6 {
    margin-bottom: -5rem !important;
}

.mb-n7 {
    margin-bottom: -8rem !important;
}

.mb-n8 {
    margin-bottom: -10rem !important;
}

.mb-n9 {
    margin-bottom: -11rem !important;
}

.mb-n10 {
    margin-bottom: -14rem !important;
}

.mb-n11 {
    margin-bottom: -16rem !important;
}

.mb-n12 {
    margin-bottom: -20rem !important;
}

.mb-nsm {
    margin-bottom: -1rem !important;
}

.mb-nmd {
    margin-bottom: -2rem !important;
}

.mb-nlg {
    margin-bottom: -4rem !important;
}

.mb-nxl {
    margin-bottom: -8rem !important;
}

.ms-n1 {
    margin-left: -0.25rem !important;
}

.ms-n2 {
    margin-left: -0.5rem !important;
}

.ms-n3 {
    margin-left: -1rem !important;
}

.ms-n4 {
    margin-left: -1.5rem !important;
}

.ms-n5 {
    margin-left: -3rem !important;
}

.ms-n6 {
    margin-left: -5rem !important;
}

.ms-n7 {
    margin-left: -8rem !important;
}

.ms-n8 {
    margin-left: -10rem !important;
}

.ms-n9 {
    margin-left: -11rem !important;
}

.ms-n10 {
    margin-left: -14rem !important;
}

.ms-n11 {
    margin-left: -16rem !important;
}

.ms-n12 {
    margin-left: -20rem !important;
}

.ms-nsm {
    margin-left: -1rem !important;
}

.ms-nmd {
    margin-left: -2rem !important;
}

.ms-nlg {
    margin-left: -4rem !important;
}

.ms-nxl {
    margin-left: -8rem !important;
}

.p-0 {
    padding: 0 !important;
}

.p-1 {
    padding: 0.25rem !important;
}

.p-2 {
    padding: 0.5rem !important;
}

.p-3 {
    padding: 1rem !important;
}

.p-4 {
    padding: 1.5rem !important;
}

.p-5 {
    padding: 3rem !important;
}

.p-6 {
    padding: 5rem !important;
}

.p-7 {
    padding: 8rem !important;
}

.p-8 {
    padding: 10rem !important;
}

.p-9 {
    padding: 11rem !important;
}

.p-10 {
    padding: 14rem !important;
}

.p-11 {
    padding: 16rem !important;
}

.p-12 {
    padding: 20rem !important;
}

.p-sm {
    padding: 1rem !important;
}

.p-md {
    padding: 2rem !important;
}

.p-lg {
    padding: 4rem !important;
}

.p-xl {
    padding: 8rem !important;
}

.px-0 {
    padding-right: 0 !important;
    padding-left: 0 !important;
}

.px-1 {
    padding-right: 0.25rem !important;
    padding-left: 0.25rem !important;
}

.px-2 {
    padding-right: 0.5rem !important;
    padding-left: 0.5rem !important;
}

.px-3 {
    padding-right: 1rem !important;
    padding-left: 1rem !important;
}

.px-4 {
    padding-right: 1.5rem !important;
    padding-left: 1.5rem !important;
}

.px-5 {
    padding-right: 3rem !important;
    padding-left: 3rem !important;
}

.px-6 {
    padding-right: 5rem !important;
    padding-left: 5rem !important;
}

.px-7 {
    padding-right: 8rem !important;
    padding-left: 8rem !important;
}

.px-8 {
    padding-right: 10rem !important;
    padding-left: 10rem !important;
}

.px-9 {
    padding-right: 11rem !important;
    padding-left: 11rem !important;
}

.px-10 {
    padding-right: 14rem !important;
    padding-left: 14rem !important;
}

.px-11 {
    padding-right: 16rem !important;
    padding-left: 16rem !important;
}

.px-12 {
    padding-right: 20rem !important;
    padding-left: 20rem !important;
}

.px-sm {
    padding-right: 1rem !important;
    padding-left: 1rem !important;
}

.px-md {
    padding-right: 2rem !important;
    padding-left: 2rem !important;
}

.px-lg {
    padding-right: 4rem !important;
    padding-left: 4rem !important;
}

.px-xl {
    padding-right: 8rem !important;
    padding-left: 8rem !important;
}

.py-0 {
    padding-top: 0 !important;
    padding-bottom: 0 !important;
}

.py-1 {
    padding-top: 0.25rem !important;
    padding-bottom: 0.25rem !important;
}

.py-2 {
    padding-top: 0.5rem !important;
    padding-bottom: 0.5rem !important;
}

.py-3 {
    padding-top: 1rem !important;
    padding-bottom: 1rem !important;
}

.py-4 {
    padding-top: 1.5rem !important;
    padding-bottom: 1.5rem !important;
}

.py-5 {
    padding-top: 3rem !important;
    padding-bottom: 3rem !important;
}

.py-6 {
    padding-top: 5rem !important;
    padding-bottom: 5rem !important;
}

.py-7 {
    padding-top: 8rem !important;
    padding-bottom: 8rem !important;
}

.py-8 {
    padding-top: 10rem !important;
    padding-bottom: 10rem !important;
}

.py-9 {
    padding-top: 11rem !important;
    padding-bottom: 11rem !important;
}

.py-10 {
    padding-top: 14rem !important;
    padding-bottom: 14rem !important;
}

.py-11 {
    padding-top: 16rem !important;
    padding-bottom: 16rem !important;
}

.py-12 {
    padding-top: 20rem !important;
    padding-bottom: 20rem !important;
}

.py-sm {
    padding-top: 1rem !important;
    padding-bottom: 1rem !important;
}

.py-md {
    padding-top: 2rem !important;
    padding-bottom: 2rem !important;
}

.py-lg {
    padding-top: 4rem !important;
    padding-bottom: 4rem !important;
}

.py-xl {
    padding-top: 8rem !important;
    padding-bottom: 8rem !important;
}

.pt-0 {
    padding-top: 0 !important;
}

.pt-1 {
    padding-top: 0.25rem !important;
}

.pt-2 {
    padding-top: 0.5rem !important;
}

.pt-3 {
    padding-top: 1rem !important;
}

.pt-4 {
    padding-top: 1.5rem !important;
}

.pt-5 {
    padding-top: 3rem !important;
}

.pt-6 {
    padding-top: 5rem !important;
}

.pt-7 {
    padding-top: 8rem !important;
}

.pt-8 {
    padding-top: 10rem !important;
}

.pt-9 {
    padding-top: 11rem !important;
}

.pt-10 {
    padding-top: 14rem !important;
}

.pt-11 {
    padding-top: 16rem !important;
}

.pt-12 {
    padding-top: 20rem !important;
}

.pt-sm {
    padding-top: 1rem !important;
}

.pt-md {
    padding-top: 2rem !important;
}

.pt-lg {
    padding-top: 4rem !important;
}

.pt-xl {
    padding-top: 8rem !important;
}

.pe-0 {
    padding-right: 0 !important;
}

.pe-1 {
    padding-right: 0.25rem !important;
}

.pe-2 {
    padding-right: 0.5rem !important;
}

.pe-3 {
    padding-right: 1rem !important;
}

.pe-4 {
    padding-right: 1.5rem !important;
}

.pe-5 {
    padding-right: 3rem !important;
}

.pe-6 {
    padding-right: 5rem !important;
}

.pe-7 {
    padding-right: 8rem !important;
}

.pe-8 {
    padding-right: 10rem !important;
}

.pe-9 {
    padding-right: 11rem !important;
}

.pe-10 {
    padding-right: 14rem !important;
}

.pe-11 {
    padding-right: 16rem !important;
}

.pe-12 {
    padding-right: 20rem !important;
}

.pe-sm {
    padding-right: 1rem !important;
}

.pe-md {
    padding-right: 2rem !important;
}

.pe-lg {
    padding-right: 4rem !important;
}

.pe-xl {
    padding-right: 8rem !important;
}

.pb-0 {
    padding-bottom: 0 !important;
}

.pb-1 {
    padding-bottom: 0.25rem !important;
}

.pb-2 {
    padding-bottom: 0.5rem !important;
}

.pb-3 {
    padding-bottom: 1rem !important;
}

.pb-4 {
    padding-bottom: 1.5rem !important;
}

.pb-5 {
    padding-bottom: 3rem !important;
}

.pb-6 {
    padding-bottom: 5rem !important;
}

.pb-7 {
    padding-bottom: 8rem !important;
}

.pb-8 {
    padding-bottom: 10rem !important;
}

.pb-9 {
    padding-bottom: 11rem !important;
}

.pb-10 {
    padding-bottom: 14rem !important;
}

.pb-11 {
    padding-bottom: 16rem !important;
}

.pb-12 {
    padding-bottom: 20rem !important;
}

.pb-sm {
    padding-bottom: 1rem !important;
}

.pb-md {
    padding-bottom: 2rem !important;
}

.pb-lg {
    padding-bottom: 4rem !important;
}

.pb-xl {
    padding-bottom: 8rem !important;
}

.ps-0 {
    padding-left: 0 !important;
}

.ps-1 {
    padding-left: 0.25rem !important;
}

.ps-2 {
    padding-left: 0.5rem !important;
}

.ps-3 {
    padding-left: 1rem !important;
}

.ps-4 {
    padding-left: 1.5rem !important;
}

.ps-5 {
    padding-left: 3rem !important;
}

.ps-6 {
    padding-left: 5rem !important;
}

.ps-7 {
    padding-left: 8rem !important;
}

.ps-8 {
    padding-left: 10rem !important;
}

.ps-9 {
    padding-left: 11rem !important;
}

.ps-10 {
    padding-left: 14rem !important;
}

.ps-11 {
    padding-left: 16rem !important;
}

.ps-12 {
    padding-left: 20rem !important;
}

.ps-sm {
    padding-left: 1rem !important;
}

.ps-md {
    padding-left: 2rem !important;
}

.ps-lg {
    padding-left: 4rem !important;
}

.ps-xl {
    padding-left: 8rem !important;
}

.font-monospace {
    font-family: var(--bs-font-monospace) !important;
}

.fs-1 {
    font-size: calc(1.375rem + 1.5vw) !important;
}

.fs-2 {
    font-size: calc(1.325rem + 0.9vw) !important;
}

.fs-3 {
    font-size: calc(1.3rem + 0.6vw) !important;
}

.fs-4 {
    font-size: calc(1.275rem + 0.3vw) !important;
}

.fs-5 {
    font-size: 1.25rem !important;
}

.fs-6 {
    font-size: 1rem !important;
}

.fst-italic {
    font-style: italic !important;
}

.fst-normal {
    font-style: normal !important;
}

.fw-light {
    font-weight: 300 !important;
}

.fw-lighter {
    font-weight: lighter !important;
}

.fw-normal {
    font-weight: 400 !important;
}

.fw-bold {
    font-weight: 500 !important;
}

.fw-bolder {
    font-weight: 600 !important;
}

.fw-extrabold {
    font-weight: 700 !important;
}

.fw-black {
    font-weight: 800 !important;
}

.lh-1 {
    line-height: 1 !important;
}

.lh-sm {
    line-height: 1.25 !important;
}

.lh-base {
    line-height: 1.5 !important;
}

.lh-lg {
    line-height: 2 !important;
}

.text-start {
    text-align: left !important;
}

.text-end {
    text-align: right !important;
}

.text-center {
    text-align: center !important;
}

.text-decoration-none {
    text-decoration: none !important;
}

.text-decoration-underline {
    text-decoration: underline !important;
}

.text-decoration-line-through {
    text-decoration: line-through !important;
}

.text-lowercase {
    text-transform: lowercase !important;
}

.text-uppercase {
    text-transform: uppercase !important;
}

.text-capitalize {
    text-transform: capitalize !important;
}

.text-wrap {
    white-space: normal !important;
}

.text-nowrap {
    white-space: nowrap !important;
}

/* rtl:begin:remove */
.text-break {
    word-wrap: break-word !important;
    word-break: break-word !important;
}

/* rtl:end:remove */
.text-primary {
    --bs-text-opacity: 1;
    color: rgba(var(--bs-primary-rgb), var(--bs-text-opacity)) !important;
}

.text-secondary {
    --bs-text-opacity: 1;
    color: rgba(var(--bs-secondary-rgb), var(--bs-text-opacity)) !important;
}

.text-tertiary {
    --bs-text-opacity: 1;
    color: rgba(var(--bs-tertiary-rgb), var(--bs-text-opacity)) !important;
}

.text-success {
    --bs-text-opacity: 1;
    color: rgba(var(--bs-success-rgb), var(--bs-text-opacity)) !important;
}

.text-info {
    --bs-text-opacity: 1;
    color: rgba(var(--bs-info-rgb), var(--bs-text-opacity)) !important;
}

.text-warning {
    --bs-text-opacity: 1;
    color: rgba(var(--bs-warning-rgb), var(--bs-text-opacity)) !important;
}

.text-danger {
    --bs-text-opacity: 1;
    color: rgba(var(--bs-danger-rgb), var(--bs-text-opacity)) !important;
}

.text-white {
    --bs-text-opacity: 1;
    color: rgba(var(--bs-white-rgb), var(--bs-text-opacity)) !important;
}

.text-indigo {
    --bs-text-opacity: 1;
    color: rgba(var(--bs-indigo-rgb), var(--bs-text-opacity)) !important;
}

.text-purple {
    --bs-text-opacity: 1;
    color: rgba(var(--bs-purple-rgb), var(--bs-text-opacity)) !important;
}

.text-yellow-100 {
    --bs-text-opacity: 1;
    color: rgba(var(--bs-yellow-100-rgb), var(--bs-text-opacity)) !important;
}

.text-yellow-200 {
    --bs-text-opacity: 1;
    color: rgba(var(--bs-yellow-200-rgb), var(--bs-text-opacity)) !important;
}

.text-gray-50 {
    --bs-text-opacity: 1;
    color: rgba(var(--bs-gray-50-rgb), var(--bs-text-opacity)) !important;
}

.text-gray-100 {
    --bs-text-opacity: 1;
    color: rgba(var(--bs-gray-100-rgb), var(--bs-text-opacity)) !important;
}

.text-gray-200 {
    --bs-text-opacity: 1;
    color: rgba(var(--bs-gray-200-rgb), var(--bs-text-opacity)) !important;
}

.text-gray-300 {
    --bs-text-opacity: 1;
    color: rgba(var(--bs-gray-300-rgb), var(--bs-text-opacity)) !important;
}

.text-gray-400 {
    --bs-text-opacity: 1;
    color: rgba(var(--bs-gray-400-rgb), var(--bs-text-opacity)) !important;
}

.text-gray-500 {
    --bs-text-opacity: 1;
    color: rgba(var(--bs-gray-500-rgb), var(--bs-text-opacity)) !important;
}

.text-gray-600 {
    --bs-text-opacity: 1;
    color: rgba(var(--bs-gray-600-rgb), var(--bs-text-opacity)) !important;
}

.text-gray-700 {
    --bs-text-opacity: 1;
    color: rgba(var(--bs-gray-700-rgb), var(--bs-text-opacity)) !important;
}

.text-gray-800 {
    --bs-text-opacity: 1;
    color: rgba(var(--bs-gray-800-rgb), var(--bs-text-opacity)) !important;
}

.text-gray-900 {
    --bs-text-opacity: 1;
    color: rgba(var(--bs-gray-900-rgb), var(--bs-text-opacity)) !important;
}

.text-black {
    --bs-text-opacity: 1;
    color: rgba(var(--bs-black-rgb), var(--bs-text-opacity)) !important;
}

.text-body {
    --bs-text-opacity: 1;
    color: rgba(var(--bs-body-color-rgb), var(--bs-text-opacity)) !important;
}

.text-muted {
    --bs-text-opacity: 1;
    color: #58677d !important;
}

.text-black-50 {
    --bs-text-opacity: 1;
    color: rgba(17, 24, 39, 0.5) !important;
}

.text-white-50 {
    --bs-text-opacity: 1;
    color: rgba(255, 255, 255, 0.5) !important;
}

.text-reset {
    --bs-text-opacity: 1;
    color: inherit !important;
}

.text-opacity-25 {
    --bs-text-opacity: 0.25;
}

.text-opacity-50 {
    --bs-text-opacity: 0.5;
}

.text-opacity-75 {
    --bs-text-opacity: 0.75;
}

.text-opacity-100 {
    --bs-text-opacity: 1;
}

.bg-primary {
    --bs-bg-opacity: 1;
    background-color: rgba(var(--bs-primary-rgb), var(--bs-bg-opacity)) !important;
}

.bg-secondary {
    --bs-bg-opacity: 1;
    background-color: rgba(var(--bs-secondary-rgb), var(--bs-bg-opacity)) !important;
}

.bg-tertiary {
    --bs-bg-opacity: 1;
    background-color: rgba(var(--bs-tertiary-rgb), var(--bs-bg-opacity)) !important;
}

.bg-success {
    --bs-bg-opacity: 1;
    background-color: rgba(var(--bs-success-rgb), var(--bs-bg-opacity)) !important;
}

.bg-info {
    --bs-bg-opacity: 1;
    background-color: rgba(var(--bs-info-rgb), var(--bs-bg-opacity)) !important;
}

.bg-warning {
    --bs-bg-opacity: 1;
    background-color: rgba(var(--bs-warning-rgb), var(--bs-bg-opacity)) !important;
}

.bg-danger {
    --bs-bg-opacity: 1;
    background-color: rgba(var(--bs-danger-rgb), var(--bs-bg-opacity)) !important;
}

.bg-white {
    --bs-bg-opacity: 1;
    background-color: rgba(var(--bs-white-rgb), var(--bs-bg-opacity)) !important;
}

.bg-indigo {
    --bs-bg-opacity: 1;
    background-color: rgba(var(--bs-indigo-rgb), var(--bs-bg-opacity)) !important;
}

.bg-purple {
    --bs-bg-opacity: 1;
    background-color: rgba(var(--bs-purple-rgb), var(--bs-bg-opacity)) !important;
}

.bg-yellow-100 {
    --bs-bg-opacity: 1;
    background-color: rgba(var(--bs-yellow-100-rgb), var(--bs-bg-opacity)) !important;
}

.bg-yellow-200 {
    --bs-bg-opacity: 1;
    background-color: rgba(var(--bs-yellow-200-rgb), var(--bs-bg-opacity)) !important;
}

.bg-gray-50 {
    --bs-bg-opacity: 1;
    background-color: rgba(var(--bs-gray-50-rgb), var(--bs-bg-opacity)) !important;
}

.bg-gray-100 {
    --bs-bg-opacity: 1;
    background-color: rgba(var(--bs-gray-100-rgb), var(--bs-bg-opacity)) !important;
}

.bg-gray-200 {
    --bs-bg-opacity: 1;
    background-color: rgba(var(--bs-gray-200-rgb), var(--bs-bg-opacity)) !important;
}

.bg-gray-300 {
    --bs-bg-opacity: 1;
    background-color: rgba(var(--bs-gray-300-rgb), var(--bs-bg-opacity)) !important;
}

.bg-gray-400 {
    --bs-bg-opacity: 1;
    background-color: rgba(var(--bs-gray-400-rgb), var(--bs-bg-opacity)) !important;
}

.bg-gray-500 {
    --bs-bg-opacity: 1;
    background-color: rgba(var(--bs-gray-500-rgb), var(--bs-bg-opacity)) !important;
}

.bg-gray-600 {
    --bs-bg-opacity: 1;
    background-color: rgba(var(--bs-gray-600-rgb), var(--bs-bg-opacity)) !important;
}

.bg-gray-700 {
    --bs-bg-opacity: 1;
    background-color: rgba(var(--bs-gray-700-rgb), var(--bs-bg-opacity)) !important;
}

.bg-gray-800 {
    --bs-bg-opacity: 1;
    background-color: rgba(var(--bs-gray-800-rgb), var(--bs-bg-opacity)) !important;
}

.bg-gray-900 {
    --bs-bg-opacity: 1;
    background-color: rgba(var(--bs-gray-900-rgb), var(--bs-bg-opacity)) !important;
}

.bg-black {
    --bs-bg-opacity: 1;
    background-color: rgba(var(--bs-black-rgb), var(--bs-bg-opacity)) !important;
}

.bg-body {
    --bs-bg-opacity: 1;
    background-color: rgba(var(--bs-body-bg-rgb), var(--bs-bg-opacity)) !important;
}

.bg-transparent {
    --bs-bg-opacity: 1;
    background-color: transparent !important;
}

.bg-opacity-10 {
    --bs-bg-opacity: 0.1;
}

.bg-opacity-25 {
    --bs-bg-opacity: 0.25;
}

.bg-opacity-50 {
    --bs-bg-opacity: 0.5;
}

.bg-opacity-75 {
    --bs-bg-opacity: 0.75;
}

.bg-opacity-100 {
    --bs-bg-opacity: 1;
}

.bg-gradient {
    background-image: var(--bs-gradient) !important;
}

.user-select-all {
    -webkit-user-select: all !important;
    user-select: all !important;
}

.user-select-auto {
    -webkit-user-select: auto !important;
    user-select: auto !important;
}

.user-select-none {
    -webkit-user-select: none !important;
    user-select: none !important;
}

.pe-none {
    pointer-events: none !important;
}

.pe-auto {
    pointer-events: auto !important;
}

.rounded {
    border-radius: 0.5rem !important;
}

.rounded-0 {
    border-radius: 0 !important;
}

.rounded-1 {
    border-radius: 0.35rem !important;
}

.rounded-2 {
    border-radius: 0.5rem !important;
}

.rounded-3 {
    border-radius: 1rem !important;
}

.rounded-circle {
    border-radius: 50% !important;
}

.rounded-pill {
    border-radius: 50rem !important;
}

.rounded-top {
    border-top-left-radius: 0.5rem !important;
    border-top-right-radius: 0.5rem !important;
}

.rounded-end {
    border-top-right-radius: 0.5rem !important;
    border-bottom-right-radius: 0.5rem !important;
}

.rounded-bottom {
    border-bottom-right-radius: 0.5rem !important;
    border-bottom-left-radius: 0.5rem !important;
}

.rounded-start {
    border-bottom-left-radius: 0.5rem !important;
    border-top-left-radius: 0.5rem !important;
}

.visible {
    visibility: visible !important;
}

.invisible {
    visibility: hidden !important;
}

.blur-0 {
    -webkit-backdrop-filter: blur(0) !important;
    backdrop-filter: blur(0) !important;
}

.blur-1 {
    -webkit-backdrop-filter: blur(1px) !important;
    backdrop-filter: blur(1px) !important;
}

.blur-2 {
    -webkit-backdrop-filter: blur(2px) !important;
    backdrop-filter: blur(2px) !important;
}

.blur-3 {
    -webkit-backdrop-filter: blur(3px) !important;
    backdrop-filter: blur(3px) !important;
}

.blur-4 {
    -webkit-backdrop-filter: blur(4px) !important;
    backdrop-filter: blur(4px) !important;
}

.blur-5 {
    -webkit-backdrop-filter: blur(5px) !important;
    backdrop-filter: blur(5px) !important;
}

.blur-6 {
    -webkit-backdrop-filter: blur(6px) !important;
    backdrop-filter: blur(6px) !important;
}

.blur-7 {
    -webkit-backdrop-filter: blur(7px) !important;
    backdrop-filter: blur(7px) !important;
}

.blur-8 {
    -webkit-backdrop-filter: blur(8px) !important;
    backdrop-filter: blur(8px) !important;
}

.blur-9 {
    -webkit-backdrop-filter: blur(91px) !important;
    backdrop-filter: blur(91px) !important;
}

.blur-10 {
    -webkit-backdrop-filter: blur(10px) !important;
    backdrop-filter: blur(10px) !important;
}

.blur-11 {
    -webkit-backdrop-filter: blur(11px) !important;
    backdrop-filter: blur(11px) !important;
}

.blur-12 {
    -webkit-backdrop-filter: blur(12px) !important;
    backdrop-filter: blur(12px) !important;
}

.blur-13 {
    -webkit-backdrop-filter: blur(13px) !important;
    backdrop-filter: blur(13px) !important;
}

.blur-14 {
    -webkit-backdrop-filter: blur(14px) !important;
    backdrop-filter: blur(14px) !important;
}

.z-0 {
    z-index: 0 !important;
}

.z-1 {
    z-index: 1 !important;
}

.z-2 {
    z-index: 2 !important;
}

.z-3 {
    z-index: 3 !important;
}

.z-999 {
    z-index: 999 !important;
}

.fmxh-100 {
    min-height: 100px !important;
}

.fmxh-200 {
    min-height: 200px !important;
}

.fmxh-300 {
    min-height: 300px !important;
}

.fmxh-400 {
    min-height: 400px !important;
}

.fmxh-500 {
    min-height: 500px !important;
}

.fmxh-999 {
    min-height: 999px !important;
}

@media (min-width: 576px) {
    .float-sm-start {
        float: left !important;
    }

    .float-sm-end {
        float: right !important;
    }

    .float-sm-none {
        float: none !important;
    }

    .d-sm-inline {
        display: inline !important;
    }

    .d-sm-inline-block {
        display: inline-block !important;
    }

    .d-sm-block {
        display: block !important;
    }

    .d-sm-grid {
        display: grid !important;
    }

    .d-sm-table {
        display: table !important;
    }

    .d-sm-table-row {
        display: table-row !important;
    }

    .d-sm-table-cell {
        display: table-cell !important;
    }

    .d-sm-flex {
        display: flex !important;
    }

    .d-sm-inline-flex {
        display: inline-flex !important;
    }

    .d-sm-none {
        display: none !important;
    }

    .vh-sm-100 {
        height: 100vh !important;
    }

    .flex-sm-fill {
        flex: 1 1 auto !important;
    }

    .flex-sm-row {
        flex-direction: row !important;
    }

    .flex-sm-column {
        flex-direction: column !important;
    }

    .flex-sm-row-reverse {
        flex-direction: row-reverse !important;
    }

    .flex-sm-column-reverse {
        flex-direction: column-reverse !important;
    }

    .flex-sm-grow-0 {
        flex-grow: 0 !important;
    }

    .flex-sm-grow-1 {
        flex-grow: 1 !important;
    }

    .flex-sm-shrink-0 {
        flex-shrink: 0 !important;
    }

    .flex-sm-shrink-1 {
        flex-shrink: 1 !important;
    }

    .flex-sm-wrap {
        flex-wrap: wrap !important;
    }

    .flex-sm-nowrap {
        flex-wrap: nowrap !important;
    }

    .flex-sm-wrap-reverse {
        flex-wrap: wrap-reverse !important;
    }

    .gap-sm-0 {
        gap: 0 !important;
    }

    .gap-sm-1 {
        gap: 0.25rem !important;
    }

    .gap-sm-2 {
        gap: 0.5rem !important;
    }

    .gap-sm-3 {
        gap: 1rem !important;
    }

    .gap-sm-4 {
        gap: 1.5rem !important;
    }

    .gap-sm-5 {
        gap: 3rem !important;
    }

    .gap-sm-6 {
        gap: 5rem !important;
    }

    .gap-sm-7 {
        gap: 8rem !important;
    }

    .gap-sm-8 {
        gap: 10rem !important;
    }

    .gap-sm-9 {
        gap: 11rem !important;
    }

    .gap-sm-10 {
        gap: 14rem !important;
    }

    .gap-sm-11 {
        gap: 16rem !important;
    }

    .gap-sm-12 {
        gap: 20rem !important;
    }

    .gap-sm-sm {
        gap: 1rem !important;
    }

    .gap-sm-md {
        gap: 2rem !important;
    }

    .gap-sm-lg {
        gap: 4rem !important;
    }

    .gap-sm-xl {
        gap: 8rem !important;
    }

    .justify-content-sm-start {
        justify-content: flex-start !important;
    }

    .justify-content-sm-end {
        justify-content: flex-end !important;
    }

    .justify-content-sm-center {
        justify-content: center !important;
    }

    .justify-content-sm-between {
        justify-content: space-between !important;
    }

    .justify-content-sm-around {
        justify-content: space-around !important;
    }

    .justify-content-sm-evenly {
        justify-content: space-evenly !important;
    }

    .align-items-sm-start {
        align-items: flex-start !important;
    }

    .align-items-sm-end {
        align-items: flex-end !important;
    }

    .align-items-sm-center {
        align-items: center !important;
    }

    .align-items-sm-baseline {
        align-items: baseline !important;
    }

    .align-items-sm-stretch {
        align-items: stretch !important;
    }

    .align-content-sm-start {
        align-content: flex-start !important;
    }

    .align-content-sm-end {
        align-content: flex-end !important;
    }

    .align-content-sm-center {
        align-content: center !important;
    }

    .align-content-sm-between {
        align-content: space-between !important;
    }

    .align-content-sm-around {
        align-content: space-around !important;
    }

    .align-content-sm-stretch {
        align-content: stretch !important;
    }

    .align-self-sm-auto {
        align-self: auto !important;
    }

    .align-self-sm-start {
        align-self: flex-start !important;
    }

    .align-self-sm-end {
        align-self: flex-end !important;
    }

    .align-self-sm-center {
        align-self: center !important;
    }

    .align-self-sm-baseline {
        align-self: baseline !important;
    }

    .align-self-sm-stretch {
        align-self: stretch !important;
    }

    .order-sm-first {
        order: -1 !important;
    }

    .order-sm-0 {
        order: 0 !important;
    }

    .order-sm-1 {
        order: 1 !important;
    }

    .order-sm-2 {
        order: 2 !important;
    }

    .order-sm-3 {
        order: 3 !important;
    }

    .order-sm-4 {
        order: 4 !important;
    }

    .order-sm-5 {
        order: 5 !important;
    }

    .order-sm-last {
        order: 6 !important;
    }

    .m-sm-0 {
        margin: 0 !important;
    }

    .m-sm-1 {
        margin: 0.25rem !important;
    }

    .m-sm-2 {
        margin: 0.5rem !important;
    }

    .m-sm-3 {
        margin: 1rem !important;
    }

    .m-sm-4 {
        margin: 1.5rem !important;
    }

    .m-sm-5 {
        margin: 3rem !important;
    }

    .m-sm-6 {
        margin: 5rem !important;
    }

    .m-sm-7 {
        margin: 8rem !important;
    }

    .m-sm-8 {
        margin: 10rem !important;
    }

    .m-sm-9 {
        margin: 11rem !important;
    }

    .m-sm-10 {
        margin: 14rem !important;
    }

    .m-sm-11 {
        margin: 16rem !important;
    }

    .m-sm-12 {
        margin: 20rem !important;
    }

    .m-sm-sm {
        margin: 1rem !important;
    }

    .m-sm-md {
        margin: 2rem !important;
    }

    .m-sm-lg {
        margin: 4rem !important;
    }

    .m-sm-xl {
        margin: 8rem !important;
    }

    .m-sm-auto {
        margin: auto !important;
    }

    .mx-sm-0 {
        margin-right: 0 !important;
        margin-left: 0 !important;
    }

    .mx-sm-1 {
        margin-right: 0.25rem !important;
        margin-left: 0.25rem !important;
    }

    .mx-sm-2 {
        margin-right: 0.5rem !important;
        margin-left: 0.5rem !important;
    }

    .mx-sm-3 {
        margin-right: 1rem !important;
        margin-left: 1rem !important;
    }

    .mx-sm-4 {
        margin-right: 1.5rem !important;
        margin-left: 1.5rem !important;
    }

    .mx-sm-5 {
        margin-right: 3rem !important;
        margin-left: 3rem !important;
    }

    .mx-sm-6 {
        margin-right: 5rem !important;
        margin-left: 5rem !important;
    }

    .mx-sm-7 {
        margin-right: 8rem !important;
        margin-left: 8rem !important;
    }

    .mx-sm-8 {
        margin-right: 10rem !important;
        margin-left: 10rem !important;
    }

    .mx-sm-9 {
        margin-right: 11rem !important;
        margin-left: 11rem !important;
    }

    .mx-sm-10 {
        margin-right: 14rem !important;
        margin-left: 14rem !important;
    }

    .mx-sm-11 {
        margin-right: 16rem !important;
        margin-left: 16rem !important;
    }

    .mx-sm-12 {
        margin-right: 20rem !important;
        margin-left: 20rem !important;
    }

    .mx-sm-sm {
        margin-right: 1rem !important;
        margin-left: 1rem !important;
    }

    .mx-sm-md {
        margin-right: 2rem !important;
        margin-left: 2rem !important;
    }

    .mx-sm-lg {
        margin-right: 4rem !important;
        margin-left: 4rem !important;
    }

    .mx-sm-xl {
        margin-right: 8rem !important;
        margin-left: 8rem !important;
    }

    .mx-sm-auto {
        margin-right: auto !important;
        margin-left: auto !important;
    }

    .my-sm-0 {
        margin-top: 0 !important;
        margin-bottom: 0 !important;
    }

    .my-sm-1 {
        margin-top: 0.25rem !important;
        margin-bottom: 0.25rem !important;
    }

    .my-sm-2 {
        margin-top: 0.5rem !important;
        margin-bottom: 0.5rem !important;
    }

    .my-sm-3 {
        margin-top: 1rem !important;
        margin-bottom: 1rem !important;
    }

    .my-sm-4 {
        margin-top: 1.5rem !important;
        margin-bottom: 1.5rem !important;
    }

    .my-sm-5 {
        margin-top: 3rem !important;
        margin-bottom: 3rem !important;
    }

    .my-sm-6 {
        margin-top: 5rem !important;
        margin-bottom: 5rem !important;
    }

    .my-sm-7 {
        margin-top: 8rem !important;
        margin-bottom: 8rem !important;
    }

    .my-sm-8 {
        margin-top: 10rem !important;
        margin-bottom: 10rem !important;
    }

    .my-sm-9 {
        margin-top: 11rem !important;
        margin-bottom: 11rem !important;
    }

    .my-sm-10 {
        margin-top: 14rem !important;
        margin-bottom: 14rem !important;
    }

    .my-sm-11 {
        margin-top: 16rem !important;
        margin-bottom: 16rem !important;
    }

    .my-sm-12 {
        margin-top: 20rem !important;
        margin-bottom: 20rem !important;
    }

    .my-sm-sm {
        margin-top: 1rem !important;
        margin-bottom: 1rem !important;
    }

    .my-sm-md {
        margin-top: 2rem !important;
        margin-bottom: 2rem !important;
    }

    .my-sm-lg {
        margin-top: 4rem !important;
        margin-bottom: 4rem !important;
    }

    .my-sm-xl {
        margin-top: 8rem !important;
        margin-bottom: 8rem !important;
    }

    .my-sm-auto {
        margin-top: auto !important;
        margin-bottom: auto !important;
    }

    .mt-sm-0 {
        margin-top: 0 !important;
    }

    .mt-sm-1 {
        margin-top: 0.25rem !important;
    }

    .mt-sm-2 {
        margin-top: 0.5rem !important;
    }

    .mt-sm-3 {
        margin-top: 1rem !important;
    }

    .mt-sm-4 {
        margin-top: 1.5rem !important;
    }

    .mt-sm-5 {
        margin-top: 3rem !important;
    }

    .mt-sm-6 {
        margin-top: 5rem !important;
    }

    .mt-sm-7 {
        margin-top: 8rem !important;
    }

    .mt-sm-8 {
        margin-top: 10rem !important;
    }

    .mt-sm-9 {
        margin-top: 11rem !important;
    }

    .mt-sm-10 {
        margin-top: 14rem !important;
    }

    .mt-sm-11 {
        margin-top: 16rem !important;
    }

    .mt-sm-12 {
        margin-top: 20rem !important;
    }

    .mt-sm-sm {
        margin-top: 1rem !important;
    }

    .mt-sm-md {
        margin-top: 2rem !important;
    }

    .mt-sm-lg {
        margin-top: 4rem !important;
    }

    .mt-sm-xl {
        margin-top: 8rem !important;
    }

    .mt-sm-auto {
        margin-top: auto !important;
    }

    .me-sm-0 {
        margin-right: 0 !important;
    }

    .me-sm-1 {
        margin-right: 0.25rem !important;
    }

    .me-sm-2 {
        margin-right: 0.5rem !important;
    }

    .me-sm-3 {
        margin-right: 1rem !important;
    }

    .me-sm-4 {
        margin-right: 1.5rem !important;
    }

    .me-sm-5 {
        margin-right: 3rem !important;
    }

    .me-sm-6 {
        margin-right: 5rem !important;
    }

    .me-sm-7 {
        margin-right: 8rem !important;
    }

    .me-sm-8 {
        margin-right: 10rem !important;
    }

    .me-sm-9 {
        margin-right: 11rem !important;
    }

    .me-sm-10 {
        margin-right: 14rem !important;
    }

    .me-sm-11 {
        margin-right: 16rem !important;
    }

    .me-sm-12 {
        margin-right: 20rem !important;
    }

    .me-sm-sm {
        margin-right: 1rem !important;
    }

    .me-sm-md {
        margin-right: 2rem !important;
    }

    .me-sm-lg {
        margin-right: 4rem !important;
    }

    .me-sm-xl {
        margin-right: 8rem !important;
    }

    .me-sm-auto {
        margin-right: auto !important;
    }

    .mb-sm-0 {
        margin-bottom: 0 !important;
    }

    .mb-sm-1 {
        margin-bottom: 0.25rem !important;
    }

    .mb-sm-2 {
        margin-bottom: 0.5rem !important;
    }

    .mb-sm-3 {
        margin-bottom: 1rem !important;
    }

    .mb-sm-4 {
        margin-bottom: 1.5rem !important;
    }

    .mb-sm-5 {
        margin-bottom: 3rem !important;
    }

    .mb-sm-6 {
        margin-bottom: 5rem !important;
    }

    .mb-sm-7 {
        margin-bottom: 8rem !important;
    }

    .mb-sm-8 {
        margin-bottom: 10rem !important;
    }

    .mb-sm-9 {
        margin-bottom: 11rem !important;
    }

    .mb-sm-10 {
        margin-bottom: 14rem !important;
    }

    .mb-sm-11 {
        margin-bottom: 16rem !important;
    }

    .mb-sm-12 {
        margin-bottom: 20rem !important;
    }

    .mb-sm-sm {
        margin-bottom: 1rem !important;
    }

    .mb-sm-md {
        margin-bottom: 2rem !important;
    }

    .mb-sm-lg {
        margin-bottom: 4rem !important;
    }

    .mb-sm-xl {
        margin-bottom: 8rem !important;
    }

    .mb-sm-auto {
        margin-bottom: auto !important;
    }

    .ms-sm-0 {
        margin-left: 0 !important;
    }

    .ms-sm-1 {
        margin-left: 0.25rem !important;
    }

    .ms-sm-2 {
        margin-left: 0.5rem !important;
    }

    .ms-sm-3 {
        margin-left: 1rem !important;
    }

    .ms-sm-4 {
        margin-left: 1.5rem !important;
    }

    .ms-sm-5 {
        margin-left: 3rem !important;
    }

    .ms-sm-6 {
        margin-left: 5rem !important;
    }

    .ms-sm-7 {
        margin-left: 8rem !important;
    }

    .ms-sm-8 {
        margin-left: 10rem !important;
    }

    .ms-sm-9 {
        margin-left: 11rem !important;
    }

    .ms-sm-10 {
        margin-left: 14rem !important;
    }

    .ms-sm-11 {
        margin-left: 16rem !important;
    }

    .ms-sm-12 {
        margin-left: 20rem !important;
    }

    .ms-sm-sm {
        margin-left: 1rem !important;
    }

    .ms-sm-md {
        margin-left: 2rem !important;
    }

    .ms-sm-lg {
        margin-left: 4rem !important;
    }

    .ms-sm-xl {
        margin-left: 8rem !important;
    }

    .ms-sm-auto {
        margin-left: auto !important;
    }

    .m-sm-n1 {
        margin: -0.25rem !important;
    }

    .m-sm-n2 {
        margin: -0.5rem !important;
    }

    .m-sm-n3 {
        margin: -1rem !important;
    }

    .m-sm-n4 {
        margin: -1.5rem !important;
    }

    .m-sm-n5 {
        margin: -3rem !important;
    }

    .m-sm-n6 {
        margin: -5rem !important;
    }

    .m-sm-n7 {
        margin: -8rem !important;
    }

    .m-sm-n8 {
        margin: -10rem !important;
    }

    .m-sm-n9 {
        margin: -11rem !important;
    }

    .m-sm-n10 {
        margin: -14rem !important;
    }

    .m-sm-n11 {
        margin: -16rem !important;
    }

    .m-sm-n12 {
        margin: -20rem !important;
    }

    .m-sm-nsm {
        margin: -1rem !important;
    }

    .m-sm-nmd {
        margin: -2rem !important;
    }

    .m-sm-nlg {
        margin: -4rem !important;
    }

    .m-sm-nxl {
        margin: -8rem !important;
    }

    .mx-sm-n1 {
        margin-right: -0.25rem !important;
        margin-left: -0.25rem !important;
    }

    .mx-sm-n2 {
        margin-right: -0.5rem !important;
        margin-left: -0.5rem !important;
    }

    .mx-sm-n3 {
        margin-right: -1rem !important;
        margin-left: -1rem !important;
    }

    .mx-sm-n4 {
        margin-right: -1.5rem !important;
        margin-left: -1.5rem !important;
    }

    .mx-sm-n5 {
        margin-right: -3rem !important;
        margin-left: -3rem !important;
    }

    .mx-sm-n6 {
        margin-right: -5rem !important;
        margin-left: -5rem !important;
    }

    .mx-sm-n7 {
        margin-right: -8rem !important;
        margin-left: -8rem !important;
    }

    .mx-sm-n8 {
        margin-right: -10rem !important;
        margin-left: -10rem !important;
    }

    .mx-sm-n9 {
        margin-right: -11rem !important;
        margin-left: -11rem !important;
    }

    .mx-sm-n10 {
        margin-right: -14rem !important;
        margin-left: -14rem !important;
    }

    .mx-sm-n11 {
        margin-right: -16rem !important;
        margin-left: -16rem !important;
    }

    .mx-sm-n12 {
        margin-right: -20rem !important;
        margin-left: -20rem !important;
    }

    .mx-sm-nsm {
        margin-right: -1rem !important;
        margin-left: -1rem !important;
    }

    .mx-sm-nmd {
        margin-right: -2rem !important;
        margin-left: -2rem !important;
    }

    .mx-sm-nlg {
        margin-right: -4rem !important;
        margin-left: -4rem !important;
    }

    .mx-sm-nxl {
        margin-right: -8rem !important;
        margin-left: -8rem !important;
    }

    .my-sm-n1 {
        margin-top: -0.25rem !important;
        margin-bottom: -0.25rem !important;
    }

    .my-sm-n2 {
        margin-top: -0.5rem !important;
        margin-bottom: -0.5rem !important;
    }

    .my-sm-n3 {
        margin-top: -1rem !important;
        margin-bottom: -1rem !important;
    }

    .my-sm-n4 {
        margin-top: -1.5rem !important;
        margin-bottom: -1.5rem !important;
    }

    .my-sm-n5 {
        margin-top: -3rem !important;
        margin-bottom: -3rem !important;
    }

    .my-sm-n6 {
        margin-top: -5rem !important;
        margin-bottom: -5rem !important;
    }

    .my-sm-n7 {
        margin-top: -8rem !important;
        margin-bottom: -8rem !important;
    }

    .my-sm-n8 {
        margin-top: -10rem !important;
        margin-bottom: -10rem !important;
    }

    .my-sm-n9 {
        margin-top: -11rem !important;
        margin-bottom: -11rem !important;
    }

    .my-sm-n10 {
        margin-top: -14rem !important;
        margin-bottom: -14rem !important;
    }

    .my-sm-n11 {
        margin-top: -16rem !important;
        margin-bottom: -16rem !important;
    }

    .my-sm-n12 {
        margin-top: -20rem !important;
        margin-bottom: -20rem !important;
    }

    .my-sm-nsm {
        margin-top: -1rem !important;
        margin-bottom: -1rem !important;
    }

    .my-sm-nmd {
        margin-top: -2rem !important;
        margin-bottom: -2rem !important;
    }

    .my-sm-nlg {
        margin-top: -4rem !important;
        margin-bottom: -4rem !important;
    }

    .my-sm-nxl {
        margin-top: -8rem !important;
        margin-bottom: -8rem !important;
    }

    .mt-sm-n1 {
        margin-top: -0.25rem !important;
    }

    .mt-sm-n2 {
        margin-top: -0.5rem !important;
    }

    .mt-sm-n3 {
        margin-top: -1rem !important;
    }

    .mt-sm-n4 {
        margin-top: -1.5rem !important;
    }

    .mt-sm-n5 {
        margin-top: -3rem !important;
    }

    .mt-sm-n6 {
        margin-top: -5rem !important;
    }

    .mt-sm-n7 {
        margin-top: -8rem !important;
    }

    .mt-sm-n8 {
        margin-top: -10rem !important;
    }

    .mt-sm-n9 {
        margin-top: -11rem !important;
    }

    .mt-sm-n10 {
        margin-top: -14rem !important;
    }

    .mt-sm-n11 {
        margin-top: -16rem !important;
    }

    .mt-sm-n12 {
        margin-top: -20rem !important;
    }

    .mt-sm-nsm {
        margin-top: -1rem !important;
    }

    .mt-sm-nmd {
        margin-top: -2rem !important;
    }

    .mt-sm-nlg {
        margin-top: -4rem !important;
    }

    .mt-sm-nxl {
        margin-top: -8rem !important;
    }

    .me-sm-n1 {
        margin-right: -0.25rem !important;
    }

    .me-sm-n2 {
        margin-right: -0.5rem !important;
    }

    .me-sm-n3 {
        margin-right: -1rem !important;
    }

    .me-sm-n4 {
        margin-right: -1.5rem !important;
    }

    .me-sm-n5 {
        margin-right: -3rem !important;
    }

    .me-sm-n6 {
        margin-right: -5rem !important;
    }

    .me-sm-n7 {
        margin-right: -8rem !important;
    }

    .me-sm-n8 {
        margin-right: -10rem !important;
    }

    .me-sm-n9 {
        margin-right: -11rem !important;
    }

    .me-sm-n10 {
        margin-right: -14rem !important;
    }

    .me-sm-n11 {
        margin-right: -16rem !important;
    }

    .me-sm-n12 {
        margin-right: -20rem !important;
    }

    .me-sm-nsm {
        margin-right: -1rem !important;
    }

    .me-sm-nmd {
        margin-right: -2rem !important;
    }

    .me-sm-nlg {
        margin-right: -4rem !important;
    }

    .me-sm-nxl {
        margin-right: -8rem !important;
    }

    .mb-sm-n1 {
        margin-bottom: -0.25rem !important;
    }

    .mb-sm-n2 {
        margin-bottom: -0.5rem !important;
    }

    .mb-sm-n3 {
        margin-bottom: -1rem !important;
    }

    .mb-sm-n4 {
        margin-bottom: -1.5rem !important;
    }

    .mb-sm-n5 {
        margin-bottom: -3rem !important;
    }

    .mb-sm-n6 {
        margin-bottom: -5rem !important;
    }

    .mb-sm-n7 {
        margin-bottom: -8rem !important;
    }

    .mb-sm-n8 {
        margin-bottom: -10rem !important;
    }

    .mb-sm-n9 {
        margin-bottom: -11rem !important;
    }

    .mb-sm-n10 {
        margin-bottom: -14rem !important;
    }

    .mb-sm-n11 {
        margin-bottom: -16rem !important;
    }

    .mb-sm-n12 {
        margin-bottom: -20rem !important;
    }

    .mb-sm-nsm {
        margin-bottom: -1rem !important;
    }

    .mb-sm-nmd {
        margin-bottom: -2rem !important;
    }

    .mb-sm-nlg {
        margin-bottom: -4rem !important;
    }

    .mb-sm-nxl {
        margin-bottom: -8rem !important;
    }

    .ms-sm-n1 {
        margin-left: -0.25rem !important;
    }

    .ms-sm-n2 {
        margin-left: -0.5rem !important;
    }

    .ms-sm-n3 {
        margin-left: -1rem !important;
    }

    .ms-sm-n4 {
        margin-left: -1.5rem !important;
    }

    .ms-sm-n5 {
        margin-left: -3rem !important;
    }

    .ms-sm-n6 {
        margin-left: -5rem !important;
    }

    .ms-sm-n7 {
        margin-left: -8rem !important;
    }

    .ms-sm-n8 {
        margin-left: -10rem !important;
    }

    .ms-sm-n9 {
        margin-left: -11rem !important;
    }

    .ms-sm-n10 {
        margin-left: -14rem !important;
    }

    .ms-sm-n11 {
        margin-left: -16rem !important;
    }

    .ms-sm-n12 {
        margin-left: -20rem !important;
    }

    .ms-sm-nsm {
        margin-left: -1rem !important;
    }

    .ms-sm-nmd {
        margin-left: -2rem !important;
    }

    .ms-sm-nlg {
        margin-left: -4rem !important;
    }

    .ms-sm-nxl {
        margin-left: -8rem !important;
    }

    .p-sm-0 {
        padding: 0 !important;
    }

    .p-sm-1 {
        padding: 0.25rem !important;
    }

    .p-sm-2 {
        padding: 0.5rem !important;
    }

    .p-sm-3 {
        padding: 1rem !important;
    }

    .p-sm-4 {
        padding: 1.5rem !important;
    }

    .p-sm-5 {
        padding: 3rem !important;
    }

    .p-sm-6 {
        padding: 5rem !important;
    }

    .p-sm-7 {
        padding: 8rem !important;
    }

    .p-sm-8 {
        padding: 10rem !important;
    }

    .p-sm-9 {
        padding: 11rem !important;
    }

    .p-sm-10 {
        padding: 14rem !important;
    }

    .p-sm-11 {
        padding: 16rem !important;
    }

    .p-sm-12 {
        padding: 20rem !important;
    }

    .p-sm-sm {
        padding: 1rem !important;
    }

    .p-sm-md {
        padding: 2rem !important;
    }

    .p-sm-lg {
        padding: 4rem !important;
    }

    .p-sm-xl {
        padding: 8rem !important;
    }

    .px-sm-0 {
        padding-right: 0 !important;
        padding-left: 0 !important;
    }

    .px-sm-1 {
        padding-right: 0.25rem !important;
        padding-left: 0.25rem !important;
    }

    .px-sm-2 {
        padding-right: 0.5rem !important;
        padding-left: 0.5rem !important;
    }

    .px-sm-3 {
        padding-right: 1rem !important;
        padding-left: 1rem !important;
    }

    .px-sm-4 {
        padding-right: 1.5rem !important;
        padding-left: 1.5rem !important;
    }

    .px-sm-5 {
        padding-right: 3rem !important;
        padding-left: 3rem !important;
    }

    .px-sm-6 {
        padding-right: 5rem !important;
        padding-left: 5rem !important;
    }

    .px-sm-7 {
        padding-right: 8rem !important;
        padding-left: 8rem !important;
    }

    .px-sm-8 {
        padding-right: 10rem !important;
        padding-left: 10rem !important;
    }

    .px-sm-9 {
        padding-right: 11rem !important;
        padding-left: 11rem !important;
    }

    .px-sm-10 {
        padding-right: 14rem !important;
        padding-left: 14rem !important;
    }

    .px-sm-11 {
        padding-right: 16rem !important;
        padding-left: 16rem !important;
    }

    .px-sm-12 {
        padding-right: 20rem !important;
        padding-left: 20rem !important;
    }

    .px-sm-sm {
        padding-right: 1rem !important;
        padding-left: 1rem !important;
    }

    .px-sm-md {
        padding-right: 2rem !important;
        padding-left: 2rem !important;
    }

    .px-sm-lg {
        padding-right: 4rem !important;
        padding-left: 4rem !important;
    }

    .px-sm-xl {
        padding-right: 8rem !important;
        padding-left: 8rem !important;
    }

    .py-sm-0 {
        padding-top: 0 !important;
        padding-bottom: 0 !important;
    }

    .py-sm-1 {
        padding-top: 0.25rem !important;
        padding-bottom: 0.25rem !important;
    }

    .py-sm-2 {
        padding-top: 0.5rem !important;
        padding-bottom: 0.5rem !important;
    }

    .py-sm-3 {
        padding-top: 1rem !important;
        padding-bottom: 1rem !important;
    }

    .py-sm-4 {
        padding-top: 1.5rem !important;
        padding-bottom: 1.5rem !important;
    }

    .py-sm-5 {
        padding-top: 3rem !important;
        padding-bottom: 3rem !important;
    }

    .py-sm-6 {
        padding-top: 5rem !important;
        padding-bottom: 5rem !important;
    }

    .py-sm-7 {
        padding-top: 8rem !important;
        padding-bottom: 8rem !important;
    }

    .py-sm-8 {
        padding-top: 10rem !important;
        padding-bottom: 10rem !important;
    }

    .py-sm-9 {
        padding-top: 11rem !important;
        padding-bottom: 11rem !important;
    }

    .py-sm-10 {
        padding-top: 14rem !important;
        padding-bottom: 14rem !important;
    }

    .py-sm-11 {
        padding-top: 16rem !important;
        padding-bottom: 16rem !important;
    }

    .py-sm-12 {
        padding-top: 20rem !important;
        padding-bottom: 20rem !important;
    }

    .py-sm-sm {
        padding-top: 1rem !important;
        padding-bottom: 1rem !important;
    }

    .py-sm-md {
        padding-top: 2rem !important;
        padding-bottom: 2rem !important;
    }

    .py-sm-lg {
        padding-top: 4rem !important;
        padding-bottom: 4rem !important;
    }

    .py-sm-xl {
        padding-top: 8rem !important;
        padding-bottom: 8rem !important;
    }

    .pt-sm-0 {
        padding-top: 0 !important;
    }

    .pt-sm-1 {
        padding-top: 0.25rem !important;
    }

    .pt-sm-2 {
        padding-top: 0.5rem !important;
    }

    .pt-sm-3 {
        padding-top: 1rem !important;
    }

    .pt-sm-4 {
        padding-top: 1.5rem !important;
    }

    .pt-sm-5 {
        padding-top: 3rem !important;
    }

    .pt-sm-6 {
        padding-top: 5rem !important;
    }

    .pt-sm-7 {
        padding-top: 8rem !important;
    }

    .pt-sm-8 {
        padding-top: 10rem !important;
    }

    .pt-sm-9 {
        padding-top: 11rem !important;
    }

    .pt-sm-10 {
        padding-top: 14rem !important;
    }

    .pt-sm-11 {
        padding-top: 16rem !important;
    }

    .pt-sm-12 {
        padding-top: 20rem !important;
    }

    .pt-sm-sm {
        padding-top: 1rem !important;
    }

    .pt-sm-md {
        padding-top: 2rem !important;
    }

    .pt-sm-lg {
        padding-top: 4rem !important;
    }

    .pt-sm-xl {
        padding-top: 8rem !important;
    }

    .pe-sm-0 {
        padding-right: 0 !important;
    }

    .pe-sm-1 {
        padding-right: 0.25rem !important;
    }

    .pe-sm-2 {
        padding-right: 0.5rem !important;
    }

    .pe-sm-3 {
        padding-right: 1rem !important;
    }

    .pe-sm-4 {
        padding-right: 1.5rem !important;
    }

    .pe-sm-5 {
        padding-right: 3rem !important;
    }

    .pe-sm-6 {
        padding-right: 5rem !important;
    }

    .pe-sm-7 {
        padding-right: 8rem !important;
    }

    .pe-sm-8 {
        padding-right: 10rem !important;
    }

    .pe-sm-9 {
        padding-right: 11rem !important;
    }

    .pe-sm-10 {
        padding-right: 14rem !important;
    }

    .pe-sm-11 {
        padding-right: 16rem !important;
    }

    .pe-sm-12 {
        padding-right: 20rem !important;
    }

    .pe-sm-sm {
        padding-right: 1rem !important;
    }

    .pe-sm-md {
        padding-right: 2rem !important;
    }

    .pe-sm-lg {
        padding-right: 4rem !important;
    }

    .pe-sm-xl {
        padding-right: 8rem !important;
    }

    .pb-sm-0 {
        padding-bottom: 0 !important;
    }

    .pb-sm-1 {
        padding-bottom: 0.25rem !important;
    }

    .pb-sm-2 {
        padding-bottom: 0.5rem !important;
    }

    .pb-sm-3 {
        padding-bottom: 1rem !important;
    }

    .pb-sm-4 {
        padding-bottom: 1.5rem !important;
    }

    .pb-sm-5 {
        padding-bottom: 3rem !important;
    }

    .pb-sm-6 {
        padding-bottom: 5rem !important;
    }

    .pb-sm-7 {
        padding-bottom: 8rem !important;
    }

    .pb-sm-8 {
        padding-bottom: 10rem !important;
    }

    .pb-sm-9 {
        padding-bottom: 11rem !important;
    }

    .pb-sm-10 {
        padding-bottom: 14rem !important;
    }

    .pb-sm-11 {
        padding-bottom: 16rem !important;
    }

    .pb-sm-12 {
        padding-bottom: 20rem !important;
    }

    .pb-sm-sm {
        padding-bottom: 1rem !important;
    }

    .pb-sm-md {
        padding-bottom: 2rem !important;
    }

    .pb-sm-lg {
        padding-bottom: 4rem !important;
    }

    .pb-sm-xl {
        padding-bottom: 8rem !important;
    }

    .ps-sm-0 {
        padding-left: 0 !important;
    }

    .ps-sm-1 {
        padding-left: 0.25rem !important;
    }

    .ps-sm-2 {
        padding-left: 0.5rem !important;
    }

    .ps-sm-3 {
        padding-left: 1rem !important;
    }

    .ps-sm-4 {
        padding-left: 1.5rem !important;
    }

    .ps-sm-5 {
        padding-left: 3rem !important;
    }

    .ps-sm-6 {
        padding-left: 5rem !important;
    }

    .ps-sm-7 {
        padding-left: 8rem !important;
    }

    .ps-sm-8 {
        padding-left: 10rem !important;
    }

    .ps-sm-9 {
        padding-left: 11rem !important;
    }

    .ps-sm-10 {
        padding-left: 14rem !important;
    }

    .ps-sm-11 {
        padding-left: 16rem !important;
    }

    .ps-sm-12 {
        padding-left: 20rem !important;
    }

    .ps-sm-sm {
        padding-left: 1rem !important;
    }

    .ps-sm-md {
        padding-left: 2rem !important;
    }

    .ps-sm-lg {
        padding-left: 4rem !important;
    }

    .ps-sm-xl {
        padding-left: 8rem !important;
    }

    .text-sm-start {
        text-align: left !important;
    }

    .text-sm-end {
        text-align: right !important;
    }

    .text-sm-center {
        text-align: center !important;
    }
}

@media (min-width: 768px) {
    .float-md-start {
        float: left !important;
    }

    .float-md-end {
        float: right !important;
    }

    .float-md-none {
        float: none !important;
    }

    .d-md-inline {
        display: inline !important;
    }

    .d-md-inline-block {
        display: inline-block !important;
    }

    .d-md-block {
        display: block !important;
    }

    .d-md-grid {
        display: grid !important;
    }

    .d-md-table {
        display: table !important;
    }

    .d-md-table-row {
        display: table-row !important;
    }

    .d-md-table-cell {
        display: table-cell !important;
    }

    .d-md-flex {
        display: flex !important;
    }

    .d-md-inline-flex {
        display: inline-flex !important;
    }

    .d-md-none {
        display: none !important;
    }

    .vh-md-100 {
        height: 100vh !important;
    }

    .flex-md-fill {
        flex: 1 1 auto !important;
    }

    .flex-md-row {
        flex-direction: row !important;
    }

    .flex-md-column {
        flex-direction: column !important;
    }

    .flex-md-row-reverse {
        flex-direction: row-reverse !important;
    }

    .flex-md-column-reverse {
        flex-direction: column-reverse !important;
    }

    .flex-md-grow-0 {
        flex-grow: 0 !important;
    }

    .flex-md-grow-1 {
        flex-grow: 1 !important;
    }

    .flex-md-shrink-0 {
        flex-shrink: 0 !important;
    }

    .flex-md-shrink-1 {
        flex-shrink: 1 !important;
    }

    .flex-md-wrap {
        flex-wrap: wrap !important;
    }

    .flex-md-nowrap {
        flex-wrap: nowrap !important;
    }

    .flex-md-wrap-reverse {
        flex-wrap: wrap-reverse !important;
    }

    .gap-md-0 {
        gap: 0 !important;
    }

    .gap-md-1 {
        gap: 0.25rem !important;
    }

    .gap-md-2 {
        gap: 0.5rem !important;
    }

    .gap-md-3 {
        gap: 1rem !important;
    }

    .gap-md-4 {
        gap: 1.5rem !important;
    }

    .gap-md-5 {
        gap: 3rem !important;
    }

    .gap-md-6 {
        gap: 5rem !important;
    }

    .gap-md-7 {
        gap: 8rem !important;
    }

    .gap-md-8 {
        gap: 10rem !important;
    }

    .gap-md-9 {
        gap: 11rem !important;
    }

    .gap-md-10 {
        gap: 14rem !important;
    }

    .gap-md-11 {
        gap: 16rem !important;
    }

    .gap-md-12 {
        gap: 20rem !important;
    }

    .gap-md-sm {
        gap: 1rem !important;
    }

    .gap-md-md {
        gap: 2rem !important;
    }

    .gap-md-lg {
        gap: 4rem !important;
    }

    .gap-md-xl {
        gap: 8rem !important;
    }

    .justify-content-md-start {
        justify-content: flex-start !important;
    }

    .justify-content-md-end {
        justify-content: flex-end !important;
    }

    .justify-content-md-center {
        justify-content: center !important;
    }

    .justify-content-md-between {
        justify-content: space-between !important;
    }

    .justify-content-md-around {
        justify-content: space-around !important;
    }

    .justify-content-md-evenly {
        justify-content: space-evenly !important;
    }

    .align-items-md-start {
        align-items: flex-start !important;
    }

    .align-items-md-end {
        align-items: flex-end !important;
    }

    .align-items-md-center {
        align-items: center !important;
    }

    .align-items-md-baseline {
        align-items: baseline !important;
    }

    .align-items-md-stretch {
        align-items: stretch !important;
    }

    .align-content-md-start {
        align-content: flex-start !important;
    }

    .align-content-md-end {
        align-content: flex-end !important;
    }

    .align-content-md-center {
        align-content: center !important;
    }

    .align-content-md-between {
        align-content: space-between !important;
    }

    .align-content-md-around {
        align-content: space-around !important;
    }

    .align-content-md-stretch {
        align-content: stretch !important;
    }

    .align-self-md-auto {
        align-self: auto !important;
    }

    .align-self-md-start {
        align-self: flex-start !important;
    }

    .align-self-md-end {
        align-self: flex-end !important;
    }

    .align-self-md-center {
        align-self: center !important;
    }

    .align-self-md-baseline {
        align-self: baseline !important;
    }

    .align-self-md-stretch {
        align-self: stretch !important;
    }

    .order-md-first {
        order: -1 !important;
    }

    .order-md-0 {
        order: 0 !important;
    }

    .order-md-1 {
        order: 1 !important;
    }

    .order-md-2 {
        order: 2 !important;
    }

    .order-md-3 {
        order: 3 !important;
    }

    .order-md-4 {
        order: 4 !important;
    }

    .order-md-5 {
        order: 5 !important;
    }

    .order-md-last {
        order: 6 !important;
    }

    .m-md-0 {
        margin: 0 !important;
    }

    .m-md-1 {
        margin: 0.25rem !important;
    }

    .m-md-2 {
        margin: 0.5rem !important;
    }

    .m-md-3 {
        margin: 1rem !important;
    }

    .m-md-4 {
        margin: 1.5rem !important;
    }

    .m-md-5 {
        margin: 3rem !important;
    }

    .m-md-6 {
        margin: 5rem !important;
    }

    .m-md-7 {
        margin: 8rem !important;
    }

    .m-md-8 {
        margin: 10rem !important;
    }

    .m-md-9 {
        margin: 11rem !important;
    }

    .m-md-10 {
        margin: 14rem !important;
    }

    .m-md-11 {
        margin: 16rem !important;
    }

    .m-md-12 {
        margin: 20rem !important;
    }

    .m-md-sm {
        margin: 1rem !important;
    }

    .m-md-md {
        margin: 2rem !important;
    }

    .m-md-lg {
        margin: 4rem !important;
    }

    .m-md-xl {
        margin: 8rem !important;
    }

    .m-md-auto {
        margin: auto !important;
    }

    .mx-md-0 {
        margin-right: 0 !important;
        margin-left: 0 !important;
    }

    .mx-md-1 {
        margin-right: 0.25rem !important;
        margin-left: 0.25rem !important;
    }

    .mx-md-2 {
        margin-right: 0.5rem !important;
        margin-left: 0.5rem !important;
    }

    .mx-md-3 {
        margin-right: 1rem !important;
        margin-left: 1rem !important;
    }

    .mx-md-4 {
        margin-right: 1.5rem !important;
        margin-left: 1.5rem !important;
    }

    .mx-md-5 {
        margin-right: 3rem !important;
        margin-left: 3rem !important;
    }

    .mx-md-6 {
        margin-right: 5rem !important;
        margin-left: 5rem !important;
    }

    .mx-md-7 {
        margin-right: 8rem !important;
        margin-left: 8rem !important;
    }

    .mx-md-8 {
        margin-right: 10rem !important;
        margin-left: 10rem !important;
    }

    .mx-md-9 {
        margin-right: 11rem !important;
        margin-left: 11rem !important;
    }

    .mx-md-10 {
        margin-right: 14rem !important;
        margin-left: 14rem !important;
    }

    .mx-md-11 {
        margin-right: 16rem !important;
        margin-left: 16rem !important;
    }

    .mx-md-12 {
        margin-right: 20rem !important;
        margin-left: 20rem !important;
    }

    .mx-md-sm {
        margin-right: 1rem !important;
        margin-left: 1rem !important;
    }

    .mx-md-md {
        margin-right: 2rem !important;
        margin-left: 2rem !important;
    }

    .mx-md-lg {
        margin-right: 4rem !important;
        margin-left: 4rem !important;
    }

    .mx-md-xl {
        margin-right: 8rem !important;
        margin-left: 8rem !important;
    }

    .mx-md-auto {
        margin-right: auto !important;
        margin-left: auto !important;
    }

    .my-md-0 {
        margin-top: 0 !important;
        margin-bottom: 0 !important;
    }

    .my-md-1 {
        margin-top: 0.25rem !important;
        margin-bottom: 0.25rem !important;
    }

    .my-md-2 {
        margin-top: 0.5rem !important;
        margin-bottom: 0.5rem !important;
    }

    .my-md-3 {
        margin-top: 1rem !important;
        margin-bottom: 1rem !important;
    }

    .my-md-4 {
        margin-top: 1.5rem !important;
        margin-bottom: 1.5rem !important;
    }

    .my-md-5 {
        margin-top: 3rem !important;
        margin-bottom: 3rem !important;
    }

    .my-md-6 {
        margin-top: 5rem !important;
        margin-bottom: 5rem !important;
    }

    .my-md-7 {
        margin-top: 8rem !important;
        margin-bottom: 8rem !important;
    }

    .my-md-8 {
        margin-top: 10rem !important;
        margin-bottom: 10rem !important;
    }

    .my-md-9 {
        margin-top: 11rem !important;
        margin-bottom: 11rem !important;
    }

    .my-md-10 {
        margin-top: 14rem !important;
        margin-bottom: 14rem !important;
    }

    .my-md-11 {
        margin-top: 16rem !important;
        margin-bottom: 16rem !important;
    }

    .my-md-12 {
        margin-top: 20rem !important;
        margin-bottom: 20rem !important;
    }

    .my-md-sm {
        margin-top: 1rem !important;
        margin-bottom: 1rem !important;
    }

    .my-md-md {
        margin-top: 2rem !important;
        margin-bottom: 2rem !important;
    }

    .my-md-lg {
        margin-top: 4rem !important;
        margin-bottom: 4rem !important;
    }

    .my-md-xl {
        margin-top: 8rem !important;
        margin-bottom: 8rem !important;
    }

    .my-md-auto {
        margin-top: auto !important;
        margin-bottom: auto !important;
    }

    .mt-md-0 {
        margin-top: 0 !important;
    }

    .mt-md-1 {
        margin-top: 0.25rem !important;
    }

    .mt-md-2 {
        margin-top: 0.5rem !important;
    }

    .mt-md-3 {
        margin-top: 1rem !important;
    }

    .mt-md-4 {
        margin-top: 1.5rem !important;
    }

    .mt-md-5 {
        margin-top: 3rem !important;
    }

    .mt-md-6 {
        margin-top: 5rem !important;
    }

    .mt-md-7 {
        margin-top: 8rem !important;
    }

    .mt-md-8 {
        margin-top: 10rem !important;
    }

    .mt-md-9 {
        margin-top: 11rem !important;
    }

    .mt-md-10 {
        margin-top: 14rem !important;
    }

    .mt-md-11 {
        margin-top: 16rem !important;
    }

    .mt-md-12 {
        margin-top: 20rem !important;
    }

    .mt-md-sm {
        margin-top: 1rem !important;
    }

    .mt-md-md {
        margin-top: 2rem !important;
    }

    .mt-md-lg {
        margin-top: 4rem !important;
    }

    .mt-md-xl {
        margin-top: 8rem !important;
    }

    .mt-md-auto {
        margin-top: auto !important;
    }

    .me-md-0 {
        margin-right: 0 !important;
    }

    .me-md-1 {
        margin-right: 0.25rem !important;
    }

    .me-md-2 {
        margin-right: 0.5rem !important;
    }

    .me-md-3 {
        margin-right: 1rem !important;
    }

    .me-md-4 {
        margin-right: 1.5rem !important;
    }

    .me-md-5 {
        margin-right: 3rem !important;
    }

    .me-md-6 {
        margin-right: 5rem !important;
    }

    .me-md-7 {
        margin-right: 8rem !important;
    }

    .me-md-8 {
        margin-right: 10rem !important;
    }

    .me-md-9 {
        margin-right: 11rem !important;
    }

    .me-md-10 {
        margin-right: 14rem !important;
    }

    .me-md-11 {
        margin-right: 16rem !important;
    }

    .me-md-12 {
        margin-right: 20rem !important;
    }

    .me-md-sm {
        margin-right: 1rem !important;
    }

    .me-md-md {
        margin-right: 2rem !important;
    }

    .me-md-lg {
        margin-right: 4rem !important;
    }

    .me-md-xl {
        margin-right: 8rem !important;
    }

    .me-md-auto {
        margin-right: auto !important;
    }

    .mb-md-0 {
        margin-bottom: 0 !important;
    }

    .mb-md-1 {
        margin-bottom: 0.25rem !important;
    }

    .mb-md-2 {
        margin-bottom: 0.5rem !important;
    }

    .mb-md-3 {
        margin-bottom: 1rem !important;
    }

    .mb-md-4 {
        margin-bottom: 1.5rem !important;
    }

    .mb-md-5 {
        margin-bottom: 3rem !important;
    }

    .mb-md-6 {
        margin-bottom: 5rem !important;
    }

    .mb-md-7 {
        margin-bottom: 8rem !important;
    }

    .mb-md-8 {
        margin-bottom: 10rem !important;
    }

    .mb-md-9 {
        margin-bottom: 11rem !important;
    }

    .mb-md-10 {
        margin-bottom: 14rem !important;
    }

    .mb-md-11 {
        margin-bottom: 16rem !important;
    }

    .mb-md-12 {
        margin-bottom: 20rem !important;
    }

    .mb-md-sm {
        margin-bottom: 1rem !important;
    }

    .mb-md-md {
        margin-bottom: 2rem !important;
    }

    .mb-md-lg {
        margin-bottom: 4rem !important;
    }

    .mb-md-xl {
        margin-bottom: 8rem !important;
    }

    .mb-md-auto {
        margin-bottom: auto !important;
    }

    .ms-md-0 {
        margin-left: 0 !important;
    }

    .ms-md-1 {
        margin-left: 0.25rem !important;
    }

    .ms-md-2 {
        margin-left: 0.5rem !important;
    }

    .ms-md-3 {
        margin-left: 1rem !important;
    }

    .ms-md-4 {
        margin-left: 1.5rem !important;
    }

    .ms-md-5 {
        margin-left: 3rem !important;
    }

    .ms-md-6 {
        margin-left: 5rem !important;
    }

    .ms-md-7 {
        margin-left: 8rem !important;
    }

    .ms-md-8 {
        margin-left: 10rem !important;
    }

    .ms-md-9 {
        margin-left: 11rem !important;
    }

    .ms-md-10 {
        margin-left: 14rem !important;
    }

    .ms-md-11 {
        margin-left: 16rem !important;
    }

    .ms-md-12 {
        margin-left: 20rem !important;
    }

    .ms-md-sm {
        margin-left: 1rem !important;
    }

    .ms-md-md {
        margin-left: 2rem !important;
    }

    .ms-md-lg {
        margin-left: 4rem !important;
    }

    .ms-md-xl {
        margin-left: 8rem !important;
    }

    .ms-md-auto {
        margin-left: auto !important;
    }

    .m-md-n1 {
        margin: -0.25rem !important;
    }

    .m-md-n2 {
        margin: -0.5rem !important;
    }

    .m-md-n3 {
        margin: -1rem !important;
    }

    .m-md-n4 {
        margin: -1.5rem !important;
    }

    .m-md-n5 {
        margin: -3rem !important;
    }

    .m-md-n6 {
        margin: -5rem !important;
    }

    .m-md-n7 {
        margin: -8rem !important;
    }

    .m-md-n8 {
        margin: -10rem !important;
    }

    .m-md-n9 {
        margin: -11rem !important;
    }

    .m-md-n10 {
        margin: -14rem !important;
    }

    .m-md-n11 {
        margin: -16rem !important;
    }

    .m-md-n12 {
        margin: -20rem !important;
    }

    .m-md-nsm {
        margin: -1rem !important;
    }

    .m-md-nmd {
        margin: -2rem !important;
    }

    .m-md-nlg {
        margin: -4rem !important;
    }

    .m-md-nxl {
        margin: -8rem !important;
    }

    .mx-md-n1 {
        margin-right: -0.25rem !important;
        margin-left: -0.25rem !important;
    }

    .mx-md-n2 {
        margin-right: -0.5rem !important;
        margin-left: -0.5rem !important;
    }

    .mx-md-n3 {
        margin-right: -1rem !important;
        margin-left: -1rem !important;
    }

    .mx-md-n4 {
        margin-right: -1.5rem !important;
        margin-left: -1.5rem !important;
    }

    .mx-md-n5 {
        margin-right: -3rem !important;
        margin-left: -3rem !important;
    }

    .mx-md-n6 {
        margin-right: -5rem !important;
        margin-left: -5rem !important;
    }

    .mx-md-n7 {
        margin-right: -8rem !important;
        margin-left: -8rem !important;
    }

    .mx-md-n8 {
        margin-right: -10rem !important;
        margin-left: -10rem !important;
    }

    .mx-md-n9 {
        margin-right: -11rem !important;
        margin-left: -11rem !important;
    }

    .mx-md-n10 {
        margin-right: -14rem !important;
        margin-left: -14rem !important;
    }

    .mx-md-n11 {
        margin-right: -16rem !important;
        margin-left: -16rem !important;
    }

    .mx-md-n12 {
        margin-right: -20rem !important;
        margin-left: -20rem !important;
    }

    .mx-md-nsm {
        margin-right: -1rem !important;
        margin-left: -1rem !important;
    }

    .mx-md-nmd {
        margin-right: -2rem !important;
        margin-left: -2rem !important;
    }

    .mx-md-nlg {
        margin-right: -4rem !important;
        margin-left: -4rem !important;
    }

    .mx-md-nxl {
        margin-right: -8rem !important;
        margin-left: -8rem !important;
    }

    .my-md-n1 {
        margin-top: -0.25rem !important;
        margin-bottom: -0.25rem !important;
    }

    .my-md-n2 {
        margin-top: -0.5rem !important;
        margin-bottom: -0.5rem !important;
    }

    .my-md-n3 {
        margin-top: -1rem !important;
        margin-bottom: -1rem !important;
    }

    .my-md-n4 {
        margin-top: -1.5rem !important;
        margin-bottom: -1.5rem !important;
    }

    .my-md-n5 {
        margin-top: -3rem !important;
        margin-bottom: -3rem !important;
    }

    .my-md-n6 {
        margin-top: -5rem !important;
        margin-bottom: -5rem !important;
    }

    .my-md-n7 {
        margin-top: -8rem !important;
        margin-bottom: -8rem !important;
    }

    .my-md-n8 {
        margin-top: -10rem !important;
        margin-bottom: -10rem !important;
    }

    .my-md-n9 {
        margin-top: -11rem !important;
        margin-bottom: -11rem !important;
    }

    .my-md-n10 {
        margin-top: -14rem !important;
        margin-bottom: -14rem !important;
    }

    .my-md-n11 {
        margin-top: -16rem !important;
        margin-bottom: -16rem !important;
    }

    .my-md-n12 {
        margin-top: -20rem !important;
        margin-bottom: -20rem !important;
    }

    .my-md-nsm {
        margin-top: -1rem !important;
        margin-bottom: -1rem !important;
    }

    .my-md-nmd {
        margin-top: -2rem !important;
        margin-bottom: -2rem !important;
    }

    .my-md-nlg {
        margin-top: -4rem !important;
        margin-bottom: -4rem !important;
    }

    .my-md-nxl {
        margin-top: -8rem !important;
        margin-bottom: -8rem !important;
    }

    .mt-md-n1 {
        margin-top: -0.25rem !important;
    }

    .mt-md-n2 {
        margin-top: -0.5rem !important;
    }

    .mt-md-n3 {
        margin-top: -1rem !important;
    }

    .mt-md-n4 {
        margin-top: -1.5rem !important;
    }

    .mt-md-n5 {
        margin-top: -3rem !important;
    }

    .mt-md-n6 {
        margin-top: -5rem !important;
    }

    .mt-md-n7 {
        margin-top: -8rem !important;
    }

    .mt-md-n8 {
        margin-top: -10rem !important;
    }

    .mt-md-n9 {
        margin-top: -11rem !important;
    }

    .mt-md-n10 {
        margin-top: -14rem !important;
    }

    .mt-md-n11 {
        margin-top: -16rem !important;
    }

    .mt-md-n12 {
        margin-top: -20rem !important;
    }

    .mt-md-nsm {
        margin-top: -1rem !important;
    }

    .mt-md-nmd {
        margin-top: -2rem !important;
    }

    .mt-md-nlg {
        margin-top: -4rem !important;
    }

    .mt-md-nxl {
        margin-top: -8rem !important;
    }

    .me-md-n1 {
        margin-right: -0.25rem !important;
    }

    .me-md-n2 {
        margin-right: -0.5rem !important;
    }

    .me-md-n3 {
        margin-right: -1rem !important;
    }

    .me-md-n4 {
        margin-right: -1.5rem !important;
    }

    .me-md-n5 {
        margin-right: -3rem !important;
    }

    .me-md-n6 {
        margin-right: -5rem !important;
    }

    .me-md-n7 {
        margin-right: -8rem !important;
    }

    .me-md-n8 {
        margin-right: -10rem !important;
    }

    .me-md-n9 {
        margin-right: -11rem !important;
    }

    .me-md-n10 {
        margin-right: -14rem !important;
    }

    .me-md-n11 {
        margin-right: -16rem !important;
    }

    .me-md-n12 {
        margin-right: -20rem !important;
    }

    .me-md-nsm {
        margin-right: -1rem !important;
    }

    .me-md-nmd {
        margin-right: -2rem !important;
    }

    .me-md-nlg {
        margin-right: -4rem !important;
    }

    .me-md-nxl {
        margin-right: -8rem !important;
    }

    .mb-md-n1 {
        margin-bottom: -0.25rem !important;
    }

    .mb-md-n2 {
        margin-bottom: -0.5rem !important;
    }

    .mb-md-n3 {
        margin-bottom: -1rem !important;
    }

    .mb-md-n4 {
        margin-bottom: -1.5rem !important;
    }

    .mb-md-n5 {
        margin-bottom: -3rem !important;
    }

    .mb-md-n6 {
        margin-bottom: -5rem !important;
    }

    .mb-md-n7 {
        margin-bottom: -8rem !important;
    }

    .mb-md-n8 {
        margin-bottom: -10rem !important;
    }

    .mb-md-n9 {
        margin-bottom: -11rem !important;
    }

    .mb-md-n10 {
        margin-bottom: -14rem !important;
    }

    .mb-md-n11 {
        margin-bottom: -16rem !important;
    }

    .mb-md-n12 {
        margin-bottom: -20rem !important;
    }

    .mb-md-nsm {
        margin-bottom: -1rem !important;
    }

    .mb-md-nmd {
        margin-bottom: -2rem !important;
    }

    .mb-md-nlg {
        margin-bottom: -4rem !important;
    }

    .mb-md-nxl {
        margin-bottom: -8rem !important;
    }

    .ms-md-n1 {
        margin-left: -0.25rem !important;
    }

    .ms-md-n2 {
        margin-left: -0.5rem !important;
    }

    .ms-md-n3 {
        margin-left: -1rem !important;
    }

    .ms-md-n4 {
        margin-left: -1.5rem !important;
    }

    .ms-md-n5 {
        margin-left: -3rem !important;
    }

    .ms-md-n6 {
        margin-left: -5rem !important;
    }

    .ms-md-n7 {
        margin-left: -8rem !important;
    }

    .ms-md-n8 {
        margin-left: -10rem !important;
    }

    .ms-md-n9 {
        margin-left: -11rem !important;
    }

    .ms-md-n10 {
        margin-left: -14rem !important;
    }

    .ms-md-n11 {
        margin-left: -16rem !important;
    }

    .ms-md-n12 {
        margin-left: -20rem !important;
    }

    .ms-md-nsm {
        margin-left: -1rem !important;
    }

    .ms-md-nmd {
        margin-left: -2rem !important;
    }

    .ms-md-nlg {
        margin-left: -4rem !important;
    }

    .ms-md-nxl {
        margin-left: -8rem !important;
    }

    .p-md-0 {
        padding: 0 !important;
    }

    .p-md-1 {
        padding: 0.25rem !important;
    }

    .p-md-2 {
        padding: 0.5rem !important;
    }

    .p-md-3 {
        padding: 1rem !important;
    }

    .p-md-4 {
        padding: 1.5rem !important;
    }

    .p-md-5 {
        padding: 3rem !important;
    }

    .p-md-6 {
        padding: 5rem !important;
    }

    .p-md-7 {
        padding: 8rem !important;
    }

    .p-md-8 {
        padding: 10rem !important;
    }

    .p-md-9 {
        padding: 11rem !important;
    }

    .p-md-10 {
        padding: 14rem !important;
    }

    .p-md-11 {
        padding: 16rem !important;
    }

    .p-md-12 {
        padding: 20rem !important;
    }

    .p-md-sm {
        padding: 1rem !important;
    }

    .p-md-md {
        padding: 2rem !important;
    }

    .p-md-lg {
        padding: 4rem !important;
    }

    .p-md-xl {
        padding: 8rem !important;
    }

    .px-md-0 {
        padding-right: 0 !important;
        padding-left: 0 !important;
    }

    .px-md-1 {
        padding-right: 0.25rem !important;
        padding-left: 0.25rem !important;
    }

    .px-md-2 {
        padding-right: 0.5rem !important;
        padding-left: 0.5rem !important;
    }

    .px-md-3 {
        padding-right: 1rem !important;
        padding-left: 1rem !important;
    }

    .px-md-4 {
        padding-right: 1.5rem !important;
        padding-left: 1.5rem !important;
    }

    .px-md-5 {
        padding-right: 3rem !important;
        padding-left: 3rem !important;
    }

    .px-md-6 {
        padding-right: 5rem !important;
        padding-left: 5rem !important;
    }

    .px-md-7 {
        padding-right: 8rem !important;
        padding-left: 8rem !important;
    }

    .px-md-8 {
        padding-right: 10rem !important;
        padding-left: 10rem !important;
    }

    .px-md-9 {
        padding-right: 11rem !important;
        padding-left: 11rem !important;
    }

    .px-md-10 {
        padding-right: 14rem !important;
        padding-left: 14rem !important;
    }

    .px-md-11 {
        padding-right: 16rem !important;
        padding-left: 16rem !important;
    }

    .px-md-12 {
        padding-right: 20rem !important;
        padding-left: 20rem !important;
    }

    .px-md-sm {
        padding-right: 1rem !important;
        padding-left: 1rem !important;
    }

    .px-md-md {
        padding-right: 2rem !important;
        padding-left: 2rem !important;
    }

    .px-md-lg {
        padding-right: 4rem !important;
        padding-left: 4rem !important;
    }

    .px-md-xl {
        padding-right: 8rem !important;
        padding-left: 8rem !important;
    }

    .py-md-0 {
        padding-top: 0 !important;
        padding-bottom: 0 !important;
    }

    .py-md-1 {
        padding-top: 0.25rem !important;
        padding-bottom: 0.25rem !important;
    }

    .py-md-2 {
        padding-top: 0.5rem !important;
        padding-bottom: 0.5rem !important;
    }

    .py-md-3 {
        padding-top: 1rem !important;
        padding-bottom: 1rem !important;
    }

    .py-md-4 {
        padding-top: 1.5rem !important;
        padding-bottom: 1.5rem !important;
    }

    .py-md-5 {
        padding-top: 3rem !important;
        padding-bottom: 3rem !important;
    }

    .py-md-6 {
        padding-top: 5rem !important;
        padding-bottom: 5rem !important;
    }

    .py-md-7 {
        padding-top: 8rem !important;
        padding-bottom: 8rem !important;
    }

    .py-md-8 {
        padding-top: 10rem !important;
        padding-bottom: 10rem !important;
    }

    .py-md-9 {
        padding-top: 11rem !important;
        padding-bottom: 11rem !important;
    }

    .py-md-10 {
        padding-top: 14rem !important;
        padding-bottom: 14rem !important;
    }

    .py-md-11 {
        padding-top: 16rem !important;
        padding-bottom: 16rem !important;
    }

    .py-md-12 {
        padding-top: 20rem !important;
        padding-bottom: 20rem !important;
    }

    .py-md-sm {
        padding-top: 1rem !important;
        padding-bottom: 1rem !important;
    }

    .py-md-md {
        padding-top: 2rem !important;
        padding-bottom: 2rem !important;
    }

    .py-md-lg {
        padding-top: 4rem !important;
        padding-bottom: 4rem !important;
    }

    .py-md-xl {
        padding-top: 8rem !important;
        padding-bottom: 8rem !important;
    }

    .pt-md-0 {
        padding-top: 0 !important;
    }

    .pt-md-1 {
        padding-top: 0.25rem !important;
    }

    .pt-md-2 {
        padding-top: 0.5rem !important;
    }

    .pt-md-3 {
        padding-top: 1rem !important;
    }

    .pt-md-4 {
        padding-top: 1.5rem !important;
    }

    .pt-md-5 {
        padding-top: 3rem !important;
    }

    .pt-md-6 {
        padding-top: 5rem !important;
    }

    .pt-md-7 {
        padding-top: 8rem !important;
    }

    .pt-md-8 {
        padding-top: 10rem !important;
    }

    .pt-md-9 {
        padding-top: 11rem !important;
    }

    .pt-md-10 {
        padding-top: 14rem !important;
    }

    .pt-md-11 {
        padding-top: 16rem !important;
    }

    .pt-md-12 {
        padding-top: 20rem !important;
    }

    .pt-md-sm {
        padding-top: 1rem !important;
    }

    .pt-md-md {
        padding-top: 2rem !important;
    }

    .pt-md-lg {
        padding-top: 4rem !important;
    }

    .pt-md-xl {
        padding-top: 8rem !important;
    }

    .pe-md-0 {
        padding-right: 0 !important;
    }

    .pe-md-1 {
        padding-right: 0.25rem !important;
    }

    .pe-md-2 {
        padding-right: 0.5rem !important;
    }

    .pe-md-3 {
        padding-right: 1rem !important;
    }

    .pe-md-4 {
        padding-right: 1.5rem !important;
    }

    .pe-md-5 {
        padding-right: 3rem !important;
    }

    .pe-md-6 {
        padding-right: 5rem !important;
    }

    .pe-md-7 {
        padding-right: 8rem !important;
    }

    .pe-md-8 {
        padding-right: 10rem !important;
    }

    .pe-md-9 {
        padding-right: 11rem !important;
    }

    .pe-md-10 {
        padding-right: 14rem !important;
    }

    .pe-md-11 {
        padding-right: 16rem !important;
    }

    .pe-md-12 {
        padding-right: 20rem !important;
    }

    .pe-md-sm {
        padding-right: 1rem !important;
    }

    .pe-md-md {
        padding-right: 2rem !important;
    }

    .pe-md-lg {
        padding-right: 4rem !important;
    }

    .pe-md-xl {
        padding-right: 8rem !important;
    }

    .pb-md-0 {
        padding-bottom: 0 !important;
    }

    .pb-md-1 {
        padding-bottom: 0.25rem !important;
    }

    .pb-md-2 {
        padding-bottom: 0.5rem !important;
    }

    .pb-md-3 {
        padding-bottom: 1rem !important;
    }

    .pb-md-4 {
        padding-bottom: 1.5rem !important;
    }

    .pb-md-5 {
        padding-bottom: 3rem !important;
    }

    .pb-md-6 {
        padding-bottom: 5rem !important;
    }

    .pb-md-7 {
        padding-bottom: 8rem !important;
    }

    .pb-md-8 {
        padding-bottom: 10rem !important;
    }

    .pb-md-9 {
        padding-bottom: 11rem !important;
    }

    .pb-md-10 {
        padding-bottom: 14rem !important;
    }

    .pb-md-11 {
        padding-bottom: 16rem !important;
    }

    .pb-md-12 {
        padding-bottom: 20rem !important;
    }

    .pb-md-sm {
        padding-bottom: 1rem !important;
    }

    .pb-md-md {
        padding-bottom: 2rem !important;
    }

    .pb-md-lg {
        padding-bottom: 4rem !important;
    }

    .pb-md-xl {
        padding-bottom: 8rem !important;
    }

    .ps-md-0 {
        padding-left: 0 !important;
    }

    .ps-md-1 {
        padding-left: 0.25rem !important;
    }

    .ps-md-2 {
        padding-left: 0.5rem !important;
    }

    .ps-md-3 {
        padding-left: 1rem !important;
    }

    .ps-md-4 {
        padding-left: 1.5rem !important;
    }

    .ps-md-5 {
        padding-left: 3rem !important;
    }

    .ps-md-6 {
        padding-left: 5rem !important;
    }

    .ps-md-7 {
        padding-left: 8rem !important;
    }

    .ps-md-8 {
        padding-left: 10rem !important;
    }

    .ps-md-9 {
        padding-left: 11rem !important;
    }

    .ps-md-10 {
        padding-left: 14rem !important;
    }

    .ps-md-11 {
        padding-left: 16rem !important;
    }

    .ps-md-12 {
        padding-left: 20rem !important;
    }

    .ps-md-sm {
        padding-left: 1rem !important;
    }

    .ps-md-md {
        padding-left: 2rem !important;
    }

    .ps-md-lg {
        padding-left: 4rem !important;
    }

    .ps-md-xl {
        padding-left: 8rem !important;
    }

    .text-md-start {
        text-align: left !important;
    }

    .text-md-end {
        text-align: right !important;
    }

    .text-md-center {
        text-align: center !important;
    }
}

@media (min-width: 992px) {
    .float-lg-start {
        float: left !important;
    }

    .float-lg-end {
        float: right !important;
    }

    .float-lg-none {
        float: none !important;
    }

    .d-lg-inline {
        display: inline !important;
    }

    .d-lg-inline-block {
        display: inline-block !important;
    }

    .d-lg-block {
        display: block !important;
    }

    .d-lg-grid {
        display: grid !important;
    }

    .d-lg-table {
        display: table !important;
    }

    .d-lg-table-row {
        display: table-row !important;
    }

    .d-lg-table-cell {
        display: table-cell !important;
    }

    .d-lg-flex {
        display: flex !important;
    }

    .d-lg-inline-flex {
        display: inline-flex !important;
    }

    .d-lg-none {
        display: none !important;
    }

    .vh-lg-100 {
        height: 100vh !important;
    }

    .flex-lg-fill {
        flex: 1 1 auto !important;
    }

    .flex-lg-row {
        flex-direction: row !important;
    }

    .flex-lg-column {
        flex-direction: column !important;
    }

    .flex-lg-row-reverse {
        flex-direction: row-reverse !important;
    }

    .flex-lg-column-reverse {
        flex-direction: column-reverse !important;
    }

    .flex-lg-grow-0 {
        flex-grow: 0 !important;
    }

    .flex-lg-grow-1 {
        flex-grow: 1 !important;
    }

    .flex-lg-shrink-0 {
        flex-shrink: 0 !important;
    }

    .flex-lg-shrink-1 {
        flex-shrink: 1 !important;
    }

    .flex-lg-wrap {
        flex-wrap: wrap !important;
    }

    .flex-lg-nowrap {
        flex-wrap: nowrap !important;
    }

    .flex-lg-wrap-reverse {
        flex-wrap: wrap-reverse !important;
    }

    .gap-lg-0 {
        gap: 0 !important;
    }

    .gap-lg-1 {
        gap: 0.25rem !important;
    }

    .gap-lg-2 {
        gap: 0.5rem !important;
    }

    .gap-lg-3 {
        gap: 1rem !important;
    }

    .gap-lg-4 {
        gap: 1.5rem !important;
    }

    .gap-lg-5 {
        gap: 3rem !important;
    }

    .gap-lg-6 {
        gap: 5rem !important;
    }

    .gap-lg-7 {
        gap: 8rem !important;
    }

    .gap-lg-8 {
        gap: 10rem !important;
    }

    .gap-lg-9 {
        gap: 11rem !important;
    }

    .gap-lg-10 {
        gap: 14rem !important;
    }

    .gap-lg-11 {
        gap: 16rem !important;
    }

    .gap-lg-12 {
        gap: 20rem !important;
    }

    .gap-lg-sm {
        gap: 1rem !important;
    }

    .gap-lg-md {
        gap: 2rem !important;
    }

    .gap-lg-lg {
        gap: 4rem !important;
    }

    .gap-lg-xl {
        gap: 8rem !important;
    }

    .justify-content-lg-start {
        justify-content: flex-start !important;
    }

    .justify-content-lg-end {
        justify-content: flex-end !important;
    }

    .justify-content-lg-center {
        justify-content: center !important;
    }

    .justify-content-lg-between {
        justify-content: space-between !important;
    }

    .justify-content-lg-around {
        justify-content: space-around !important;
    }

    .justify-content-lg-evenly {
        justify-content: space-evenly !important;
    }

    .align-items-lg-start {
        align-items: flex-start !important;
    }

    .align-items-lg-end {
        align-items: flex-end !important;
    }

    .align-items-lg-center {
        align-items: center !important;
    }

    .align-items-lg-baseline {
        align-items: baseline !important;
    }

    .align-items-lg-stretch {
        align-items: stretch !important;
    }

    .align-content-lg-start {
        align-content: flex-start !important;
    }

    .align-content-lg-end {
        align-content: flex-end !important;
    }

    .align-content-lg-center {
        align-content: center !important;
    }

    .align-content-lg-between {
        align-content: space-between !important;
    }

    .align-content-lg-around {
        align-content: space-around !important;
    }

    .align-content-lg-stretch {
        align-content: stretch !important;
    }

    .align-self-lg-auto {
        align-self: auto !important;
    }

    .align-self-lg-start {
        align-self: flex-start !important;
    }

    .align-self-lg-end {
        align-self: flex-end !important;
    }

    .align-self-lg-center {
        align-self: center !important;
    }

    .align-self-lg-baseline {
        align-self: baseline !important;
    }

    .align-self-lg-stretch {
        align-self: stretch !important;
    }

    .order-lg-first {
        order: -1 !important;
    }

    .order-lg-0 {
        order: 0 !important;
    }

    .order-lg-1 {
        order: 1 !important;
    }

    .order-lg-2 {
        order: 2 !important;
    }

    .order-lg-3 {
        order: 3 !important;
    }

    .order-lg-4 {
        order: 4 !important;
    }

    .order-lg-5 {
        order: 5 !important;
    }

    .order-lg-last {
        order: 6 !important;
    }

    .m-lg-0 {
        margin: 0 !important;
    }

    .m-lg-1 {
        margin: 0.25rem !important;
    }

    .m-lg-2 {
        margin: 0.5rem !important;
    }

    .m-lg-3 {
        margin: 1rem !important;
    }

    .m-lg-4 {
        margin: 1.5rem !important;
    }

    .m-lg-5 {
        margin: 3rem !important;
    }

    .m-lg-6 {
        margin: 5rem !important;
    }

    .m-lg-7 {
        margin: 8rem !important;
    }

    .m-lg-8 {
        margin: 10rem !important;
    }

    .m-lg-9 {
        margin: 11rem !important;
    }

    .m-lg-10 {
        margin: 14rem !important;
    }

    .m-lg-11 {
        margin: 16rem !important;
    }

    .m-lg-12 {
        margin: 20rem !important;
    }

    .m-lg-sm {
        margin: 1rem !important;
    }

    .m-lg-md {
        margin: 2rem !important;
    }

    .m-lg-lg {
        margin: 4rem !important;
    }

    .m-lg-xl {
        margin: 8rem !important;
    }

    .m-lg-auto {
        margin: auto !important;
    }

    .mx-lg-0 {
        margin-right: 0 !important;
        margin-left: 0 !important;
    }

    .mx-lg-1 {
        margin-right: 0.25rem !important;
        margin-left: 0.25rem !important;
    }

    .mx-lg-2 {
        margin-right: 0.5rem !important;
        margin-left: 0.5rem !important;
    }

    .mx-lg-3 {
        margin-right: 1rem !important;
        margin-left: 1rem !important;
    }

    .mx-lg-4 {
        margin-right: 1.5rem !important;
        margin-left: 1.5rem !important;
    }

    .mx-lg-5 {
        margin-right: 3rem !important;
        margin-left: 3rem !important;
    }

    .mx-lg-6 {
        margin-right: 5rem !important;
        margin-left: 5rem !important;
    }

    .mx-lg-7 {
        margin-right: 8rem !important;
        margin-left: 8rem !important;
    }

    .mx-lg-8 {
        margin-right: 10rem !important;
        margin-left: 10rem !important;
    }

    .mx-lg-9 {
        margin-right: 11rem !important;
        margin-left: 11rem !important;
    }

    .mx-lg-10 {
        margin-right: 14rem !important;
        margin-left: 14rem !important;
    }

    .mx-lg-11 {
        margin-right: 16rem !important;
        margin-left: 16rem !important;
    }

    .mx-lg-12 {
        margin-right: 20rem !important;
        margin-left: 20rem !important;
    }

    .mx-lg-sm {
        margin-right: 1rem !important;
        margin-left: 1rem !important;
    }

    .mx-lg-md {
        margin-right: 2rem !important;
        margin-left: 2rem !important;
    }

    .mx-lg-lg {
        margin-right: 4rem !important;
        margin-left: 4rem !important;
    }

    .mx-lg-xl {
        margin-right: 8rem !important;
        margin-left: 8rem !important;
    }

    .mx-lg-auto {
        margin-right: auto !important;
        margin-left: auto !important;
    }

    .my-lg-0 {
        margin-top: 0 !important;
        margin-bottom: 0 !important;
    }

    .my-lg-1 {
        margin-top: 0.25rem !important;
        margin-bottom: 0.25rem !important;
    }

    .my-lg-2 {
        margin-top: 0.5rem !important;
        margin-bottom: 0.5rem !important;
    }

    .my-lg-3 {
        margin-top: 1rem !important;
        margin-bottom: 1rem !important;
    }

    .my-lg-4 {
        margin-top: 1.5rem !important;
        margin-bottom: 1.5rem !important;
    }

    .my-lg-5 {
        margin-top: 3rem !important;
        margin-bottom: 3rem !important;
    }

    .my-lg-6 {
        margin-top: 5rem !important;
        margin-bottom: 5rem !important;
    }

    .my-lg-7 {
        margin-top: 8rem !important;
        margin-bottom: 8rem !important;
    }

    .my-lg-8 {
        margin-top: 10rem !important;
        margin-bottom: 10rem !important;
    }

    .my-lg-9 {
        margin-top: 11rem !important;
        margin-bottom: 11rem !important;
    }

    .my-lg-10 {
        margin-top: 14rem !important;
        margin-bottom: 14rem !important;
    }

    .my-lg-11 {
        margin-top: 16rem !important;
        margin-bottom: 16rem !important;
    }

    .my-lg-12 {
        margin-top: 20rem !important;
        margin-bottom: 20rem !important;
    }

    .my-lg-sm {
        margin-top: 1rem !important;
        margin-bottom: 1rem !important;
    }

    .my-lg-md {
        margin-top: 2rem !important;
        margin-bottom: 2rem !important;
    }

    .my-lg-lg {
        margin-top: 4rem !important;
        margin-bottom: 4rem !important;
    }

    .my-lg-xl {
        margin-top: 8rem !important;
        margin-bottom: 8rem !important;
    }

    .my-lg-auto {
        margin-top: auto !important;
        margin-bottom: auto !important;
    }

    .mt-lg-0 {
        margin-top: 0 !important;
    }

    .mt-lg-1 {
        margin-top: 0.25rem !important;
    }

    .mt-lg-2 {
        margin-top: 0.5rem !important;
    }

    .mt-lg-3 {
        margin-top: 1rem !important;
    }

    .mt-lg-4 {
        margin-top: 1.5rem !important;
    }

    .mt-lg-5 {
        margin-top: 3rem !important;
    }

    .mt-lg-6 {
        margin-top: 5rem !important;
    }

    .mt-lg-7 {
        margin-top: 8rem !important;
    }

    .mt-lg-8 {
        margin-top: 10rem !important;
    }

    .mt-lg-9 {
        margin-top: 11rem !important;
    }

    .mt-lg-10 {
        margin-top: 14rem !important;
    }

    .mt-lg-11 {
        margin-top: 16rem !important;
    }

    .mt-lg-12 {
        margin-top: 20rem !important;
    }

    .mt-lg-sm {
        margin-top: 1rem !important;
    }

    .mt-lg-md {
        margin-top: 2rem !important;
    }

    .mt-lg-lg {
        margin-top: 4rem !important;
    }

    .mt-lg-xl {
        margin-top: 8rem !important;
    }

    .mt-lg-auto {
        margin-top: auto !important;
    }

    .me-lg-0 {
        margin-right: 0 !important;
    }

    .me-lg-1 {
        margin-right: 0.25rem !important;
    }

    .me-lg-2 {
        margin-right: 0.5rem !important;
    }

    .me-lg-3 {
        margin-right: 1rem !important;
    }

    .me-lg-4 {
        margin-right: 1.5rem !important;
    }

    .me-lg-5 {
        margin-right: 3rem !important;
    }

    .me-lg-6 {
        margin-right: 5rem !important;
    }

    .me-lg-7 {
        margin-right: 8rem !important;
    }

    .me-lg-8 {
        margin-right: 10rem !important;
    }

    .me-lg-9 {
        margin-right: 11rem !important;
    }

    .me-lg-10 {
        margin-right: 14rem !important;
    }

    .me-lg-11 {
        margin-right: 16rem !important;
    }

    .me-lg-12 {
        margin-right: 20rem !important;
    }

    .me-lg-sm {
        margin-right: 1rem !important;
    }

    .me-lg-md {
        margin-right: 2rem !important;
    }

    .me-lg-lg {
        margin-right: 4rem !important;
    }

    .me-lg-xl {
        margin-right: 8rem !important;
    }

    .me-lg-auto {
        margin-right: auto !important;
    }

    .mb-lg-0 {
        margin-bottom: 0 !important;
    }

    .mb-lg-1 {
        margin-bottom: 0.25rem !important;
    }

    .mb-lg-2 {
        margin-bottom: 0.5rem !important;
    }

    .mb-lg-3 {
        margin-bottom: 1rem !important;
    }

    .mb-lg-4 {
        margin-bottom: 1.5rem !important;
    }

    .mb-lg-5 {
        margin-bottom: 3rem !important;
    }

    .mb-lg-6 {
        margin-bottom: 5rem !important;
    }

    .mb-lg-7 {
        margin-bottom: 8rem !important;
    }

    .mb-lg-8 {
        margin-bottom: 10rem !important;
    }

    .mb-lg-9 {
        margin-bottom: 11rem !important;
    }

    .mb-lg-10 {
        margin-bottom: 14rem !important;
    }

    .mb-lg-11 {
        margin-bottom: 16rem !important;
    }

    .mb-lg-12 {
        margin-bottom: 20rem !important;
    }

    .mb-lg-sm {
        margin-bottom: 1rem !important;
    }

    .mb-lg-md {
        margin-bottom: 2rem !important;
    }

    .mb-lg-lg {
        margin-bottom: 4rem !important;
    }

    .mb-lg-xl {
        margin-bottom: 8rem !important;
    }

    .mb-lg-auto {
        margin-bottom: auto !important;
    }

    .ms-lg-0 {
        margin-left: 0 !important;
    }

    .ms-lg-1 {
        margin-left: 0.25rem !important;
    }

    .ms-lg-2 {
        margin-left: 0.5rem !important;
    }

    .ms-lg-3 {
        margin-left: 1rem !important;
    }

    .ms-lg-4 {
        margin-left: 1.5rem !important;
    }

    .ms-lg-5 {
        margin-left: 3rem !important;
    }

    .ms-lg-6 {
        margin-left: 5rem !important;
    }

    .ms-lg-7 {
        margin-left: 8rem !important;
    }

    .ms-lg-8 {
        margin-left: 10rem !important;
    }

    .ms-lg-9 {
        margin-left: 11rem !important;
    }

    .ms-lg-10 {
        margin-left: 14rem !important;
    }

    .ms-lg-11 {
        margin-left: 16rem !important;
    }

    .ms-lg-12 {
        margin-left: 20rem !important;
    }

    .ms-lg-sm {
        margin-left: 1rem !important;
    }

    .ms-lg-md {
        margin-left: 2rem !important;
    }

    .ms-lg-lg {
        margin-left: 4rem !important;
    }

    .ms-lg-xl {
        margin-left: 8rem !important;
    }

    .ms-lg-auto {
        margin-left: auto !important;
    }

    .m-lg-n1 {
        margin: -0.25rem !important;
    }

    .m-lg-n2 {
        margin: -0.5rem !important;
    }

    .m-lg-n3 {
        margin: -1rem !important;
    }

    .m-lg-n4 {
        margin: -1.5rem !important;
    }

    .m-lg-n5 {
        margin: -3rem !important;
    }

    .m-lg-n6 {
        margin: -5rem !important;
    }

    .m-lg-n7 {
        margin: -8rem !important;
    }

    .m-lg-n8 {
        margin: -10rem !important;
    }

    .m-lg-n9 {
        margin: -11rem !important;
    }

    .m-lg-n10 {
        margin: -14rem !important;
    }

    .m-lg-n11 {
        margin: -16rem !important;
    }

    .m-lg-n12 {
        margin: -20rem !important;
    }

    .m-lg-nsm {
        margin: -1rem !important;
    }

    .m-lg-nmd {
        margin: -2rem !important;
    }

    .m-lg-nlg {
        margin: -4rem !important;
    }

    .m-lg-nxl {
        margin: -8rem !important;
    }

    .mx-lg-n1 {
        margin-right: -0.25rem !important;
        margin-left: -0.25rem !important;
    }

    .mx-lg-n2 {
        margin-right: -0.5rem !important;
        margin-left: -0.5rem !important;
    }

    .mx-lg-n3 {
        margin-right: -1rem !important;
        margin-left: -1rem !important;
    }

    .mx-lg-n4 {
        margin-right: -1.5rem !important;
        margin-left: -1.5rem !important;
    }

    .mx-lg-n5 {
        margin-right: -3rem !important;
        margin-left: -3rem !important;
    }

    .mx-lg-n6 {
        margin-right: -5rem !important;
        margin-left: -5rem !important;
    }

    .mx-lg-n7 {
        margin-right: -8rem !important;
        margin-left: -8rem !important;
    }

    .mx-lg-n8 {
        margin-right: -10rem !important;
        margin-left: -10rem !important;
    }

    .mx-lg-n9 {
        margin-right: -11rem !important;
        margin-left: -11rem !important;
    }

    .mx-lg-n10 {
        margin-right: -14rem !important;
        margin-left: -14rem !important;
    }

    .mx-lg-n11 {
        margin-right: -16rem !important;
        margin-left: -16rem !important;
    }

    .mx-lg-n12 {
        margin-right: -20rem !important;
        margin-left: -20rem !important;
    }

    .mx-lg-nsm {
        margin-right: -1rem !important;
        margin-left: -1rem !important;
    }

    .mx-lg-nmd {
        margin-right: -2rem !important;
        margin-left: -2rem !important;
    }

    .mx-lg-nlg {
        margin-right: -4rem !important;
        margin-left: -4rem !important;
    }

    .mx-lg-nxl {
        margin-right: -8rem !important;
        margin-left: -8rem !important;
    }

    .my-lg-n1 {
        margin-top: -0.25rem !important;
        margin-bottom: -0.25rem !important;
    }

    .my-lg-n2 {
        margin-top: -0.5rem !important;
        margin-bottom: -0.5rem !important;
    }

    .my-lg-n3 {
        margin-top: -1rem !important;
        margin-bottom: -1rem !important;
    }

    .my-lg-n4 {
        margin-top: -1.5rem !important;
        margin-bottom: -1.5rem !important;
    }

    .my-lg-n5 {
        margin-top: -3rem !important;
        margin-bottom: -3rem !important;
    }

    .my-lg-n6 {
        margin-top: -5rem !important;
        margin-bottom: -5rem !important;
    }

    .my-lg-n7 {
        margin-top: -8rem !important;
        margin-bottom: -8rem !important;
    }

    .my-lg-n8 {
        margin-top: -10rem !important;
        margin-bottom: -10rem !important;
    }

    .my-lg-n9 {
        margin-top: -11rem !important;
        margin-bottom: -11rem !important;
    }

    .my-lg-n10 {
        margin-top: -14rem !important;
        margin-bottom: -14rem !important;
    }

    .my-lg-n11 {
        margin-top: -16rem !important;
        margin-bottom: -16rem !important;
    }

    .my-lg-n12 {
        margin-top: -20rem !important;
        margin-bottom: -20rem !important;
    }

    .my-lg-nsm {
        margin-top: -1rem !important;
        margin-bottom: -1rem !important;
    }

    .my-lg-nmd {
        margin-top: -2rem !important;
        margin-bottom: -2rem !important;
    }

    .my-lg-nlg {
        margin-top: -4rem !important;
        margin-bottom: -4rem !important;
    }

    .my-lg-nxl {
        margin-top: -8rem !important;
        margin-bottom: -8rem !important;
    }

    .mt-lg-n1 {
        margin-top: -0.25rem !important;
    }

    .mt-lg-n2 {
        margin-top: -0.5rem !important;
    }

    .mt-lg-n3 {
        margin-top: -1rem !important;
    }

    .mt-lg-n4 {
        margin-top: -1.5rem !important;
    }

    .mt-lg-n5 {
        margin-top: -3rem !important;
    }

    .mt-lg-n6 {
        margin-top: -5rem !important;
    }

    .mt-lg-n7 {
        margin-top: -8rem !important;
    }

    .mt-lg-n8 {
        margin-top: -10rem !important;
    }

    .mt-lg-n9 {
        margin-top: -11rem !important;
    }

    .mt-lg-n10 {
        margin-top: -14rem !important;
    }

    .mt-lg-n11 {
        margin-top: -16rem !important;
    }

    .mt-lg-n12 {
        margin-top: -20rem !important;
    }

    .mt-lg-nsm {
        margin-top: -1rem !important;
    }

    .mt-lg-nmd {
        margin-top: -2rem !important;
    }

    .mt-lg-nlg {
        margin-top: -4rem !important;
    }

    .mt-lg-nxl {
        margin-top: -8rem !important;
    }

    .me-lg-n1 {
        margin-right: -0.25rem !important;
    }

    .me-lg-n2 {
        margin-right: -0.5rem !important;
    }

    .me-lg-n3 {
        margin-right: -1rem !important;
    }

    .me-lg-n4 {
        margin-right: -1.5rem !important;
    }

    .me-lg-n5 {
        margin-right: -3rem !important;
    }

    .me-lg-n6 {
        margin-right: -5rem !important;
    }

    .me-lg-n7 {
        margin-right: -8rem !important;
    }

    .me-lg-n8 {
        margin-right: -10rem !important;
    }

    .me-lg-n9 {
        margin-right: -11rem !important;
    }

    .me-lg-n10 {
        margin-right: -14rem !important;
    }

    .me-lg-n11 {
        margin-right: -16rem !important;
    }

    .me-lg-n12 {
        margin-right: -20rem !important;
    }

    .me-lg-nsm {
        margin-right: -1rem !important;
    }

    .me-lg-nmd {
        margin-right: -2rem !important;
    }

    .me-lg-nlg {
        margin-right: -4rem !important;
    }

    .me-lg-nxl {
        margin-right: -8rem !important;
    }

    .mb-lg-n1 {
        margin-bottom: -0.25rem !important;
    }

    .mb-lg-n2 {
        margin-bottom: -0.5rem !important;
    }

    .mb-lg-n3 {
        margin-bottom: -1rem !important;
    }

    .mb-lg-n4 {
        margin-bottom: -1.5rem !important;
    }

    .mb-lg-n5 {
        margin-bottom: -3rem !important;
    }

    .mb-lg-n6 {
        margin-bottom: -5rem !important;
    }

    .mb-lg-n7 {
        margin-bottom: -8rem !important;
    }

    .mb-lg-n8 {
        margin-bottom: -10rem !important;
    }

    .mb-lg-n9 {
        margin-bottom: -11rem !important;
    }

    .mb-lg-n10 {
        margin-bottom: -14rem !important;
    }

    .mb-lg-n11 {
        margin-bottom: -16rem !important;
    }

    .mb-lg-n12 {
        margin-bottom: -20rem !important;
    }

    .mb-lg-nsm {
        margin-bottom: -1rem !important;
    }

    .mb-lg-nmd {
        margin-bottom: -2rem !important;
    }

    .mb-lg-nlg {
        margin-bottom: -4rem !important;
    }

    .mb-lg-nxl {
        margin-bottom: -8rem !important;
    }

    .ms-lg-n1 {
        margin-left: -0.25rem !important;
    }

    .ms-lg-n2 {
        margin-left: -0.5rem !important;
    }

    .ms-lg-n3 {
        margin-left: -1rem !important;
    }

    .ms-lg-n4 {
        margin-left: -1.5rem !important;
    }

    .ms-lg-n5 {
        margin-left: -3rem !important;
    }

    .ms-lg-n6 {
        margin-left: -5rem !important;
    }

    .ms-lg-n7 {
        margin-left: -8rem !important;
    }

    .ms-lg-n8 {
        margin-left: -10rem !important;
    }

    .ms-lg-n9 {
        margin-left: -11rem !important;
    }

    .ms-lg-n10 {
        margin-left: -14rem !important;
    }

    .ms-lg-n11 {
        margin-left: -16rem !important;
    }

    .ms-lg-n12 {
        margin-left: -20rem !important;
    }

    .ms-lg-nsm {
        margin-left: -1rem !important;
    }

    .ms-lg-nmd {
        margin-left: -2rem !important;
    }

    .ms-lg-nlg {
        margin-left: -4rem !important;
    }

    .ms-lg-nxl {
        margin-left: -8rem !important;
    }

    .p-lg-0 {
        padding: 0 !important;
    }

    .p-lg-1 {
        padding: 0.25rem !important;
    }

    .p-lg-2 {
        padding: 0.5rem !important;
    }

    .p-lg-3 {
        padding: 1rem !important;
    }

    .p-lg-4 {
        padding: 1.5rem !important;
    }

    .p-lg-5 {
        padding: 3rem !important;
    }

    .p-lg-6 {
        padding: 5rem !important;
    }

    .p-lg-7 {
        padding: 8rem !important;
    }

    .p-lg-8 {
        padding: 10rem !important;
    }

    .p-lg-9 {
        padding: 11rem !important;
    }

    .p-lg-10 {
        padding: 14rem !important;
    }

    .p-lg-11 {
        padding: 16rem !important;
    }

    .p-lg-12 {
        padding: 20rem !important;
    }

    .p-lg-sm {
        padding: 1rem !important;
    }

    .p-lg-md {
        padding: 2rem !important;
    }

    .p-lg-lg {
        padding: 4rem !important;
    }

    .p-lg-xl {
        padding: 8rem !important;
    }

    .px-lg-0 {
        padding-right: 0 !important;
        padding-left: 0 !important;
    }

    .px-lg-1 {
        padding-right: 0.25rem !important;
        padding-left: 0.25rem !important;
    }

    .px-lg-2 {
        padding-right: 0.5rem !important;
        padding-left: 0.5rem !important;
    }

    .px-lg-3 {
        padding-right: 1rem !important;
        padding-left: 1rem !important;
    }

    .px-lg-4 {
        padding-right: 1.5rem !important;
        padding-left: 1.5rem !important;
    }

    .px-lg-5 {
        padding-right: 3rem !important;
        padding-left: 3rem !important;
    }

    .px-lg-6 {
        padding-right: 5rem !important;
        padding-left: 5rem !important;
    }

    .px-lg-7 {
        padding-right: 8rem !important;
        padding-left: 8rem !important;
    }

    .px-lg-8 {
        padding-right: 10rem !important;
        padding-left: 10rem !important;
    }

    .px-lg-9 {
        padding-right: 11rem !important;
        padding-left: 11rem !important;
    }

    .px-lg-10 {
        padding-right: 14rem !important;
        padding-left: 14rem !important;
    }

    .px-lg-11 {
        padding-right: 16rem !important;
        padding-left: 16rem !important;
    }

    .px-lg-12 {
        padding-right: 20rem !important;
        padding-left: 20rem !important;
    }

    .px-lg-sm {
        padding-right: 1rem !important;
        padding-left: 1rem !important;
    }

    .px-lg-md {
        padding-right: 2rem !important;
        padding-left: 2rem !important;
    }

    .px-lg-lg {
        padding-right: 4rem !important;
        padding-left: 4rem !important;
    }

    .px-lg-xl {
        padding-right: 8rem !important;
        padding-left: 8rem !important;
    }

    .py-lg-0 {
        padding-top: 0 !important;
        padding-bottom: 0 !important;
    }

    .py-lg-1 {
        padding-top: 0.25rem !important;
        padding-bottom: 0.25rem !important;
    }

    .py-lg-2 {
        padding-top: 0.5rem !important;
        padding-bottom: 0.5rem !important;
    }

    .py-lg-3 {
        padding-top: 1rem !important;
        padding-bottom: 1rem !important;
    }

    .py-lg-4 {
        padding-top: 1.5rem !important;
        padding-bottom: 1.5rem !important;
    }

    .py-lg-5 {
        padding-top: 3rem !important;
        padding-bottom: 3rem !important;
    }

    .py-lg-6 {
        padding-top: 5rem !important;
        padding-bottom: 5rem !important;
    }

    .py-lg-7 {
        padding-top: 8rem !important;
        padding-bottom: 8rem !important;
    }

    .py-lg-8 {
        padding-top: 10rem !important;
        padding-bottom: 10rem !important;
    }

    .py-lg-9 {
        padding-top: 11rem !important;
        padding-bottom: 11rem !important;
    }

    .py-lg-10 {
        padding-top: 14rem !important;
        padding-bottom: 14rem !important;
    }

    .py-lg-11 {
        padding-top: 16rem !important;
        padding-bottom: 16rem !important;
    }

    .py-lg-12 {
        padding-top: 20rem !important;
        padding-bottom: 20rem !important;
    }

    .py-lg-sm {
        padding-top: 1rem !important;
        padding-bottom: 1rem !important;
    }

    .py-lg-md {
        padding-top: 2rem !important;
        padding-bottom: 2rem !important;
    }

    .py-lg-lg {
        padding-top: 4rem !important;
        padding-bottom: 4rem !important;
    }

    .py-lg-xl {
        padding-top: 8rem !important;
        padding-bottom: 8rem !important;
    }

    .pt-lg-0 {
        padding-top: 0 !important;
    }

    .pt-lg-1 {
        padding-top: 0.25rem !important;
    }

    .pt-lg-2 {
        padding-top: 0.5rem !important;
    }

    .pt-lg-3 {
        padding-top: 1rem !important;
    }

    .pt-lg-4 {
        padding-top: 1.5rem !important;
    }

    .pt-lg-5 {
        padding-top: 3rem !important;
    }

    .pt-lg-6 {
        padding-top: 5rem !important;
    }

    .pt-lg-7 {
        padding-top: 8rem !important;
    }

    .pt-lg-8 {
        padding-top: 10rem !important;
    }

    .pt-lg-9 {
        padding-top: 11rem !important;
    }

    .pt-lg-10 {
        padding-top: 14rem !important;
    }

    .pt-lg-11 {
        padding-top: 16rem !important;
    }

    .pt-lg-12 {
        padding-top: 20rem !important;
    }

    .pt-lg-sm {
        padding-top: 1rem !important;
    }

    .pt-lg-md {
        padding-top: 2rem !important;
    }

    .pt-lg-lg {
        padding-top: 4rem !important;
    }

    .pt-lg-xl {
        padding-top: 8rem !important;
    }

    .pe-lg-0 {
        padding-right: 0 !important;
    }

    .pe-lg-1 {
        padding-right: 0.25rem !important;
    }

    .pe-lg-2 {
        padding-right: 0.5rem !important;
    }

    .pe-lg-3 {
        padding-right: 1rem !important;
    }

    .pe-lg-4 {
        padding-right: 1.5rem !important;
    }

    .pe-lg-5 {
        padding-right: 3rem !important;
    }

    .pe-lg-6 {
        padding-right: 5rem !important;
    }

    .pe-lg-7 {
        padding-right: 8rem !important;
    }

    .pe-lg-8 {
        padding-right: 10rem !important;
    }

    .pe-lg-9 {
        padding-right: 11rem !important;
    }

    .pe-lg-10 {
        padding-right: 14rem !important;
    }

    .pe-lg-11 {
        padding-right: 16rem !important;
    }

    .pe-lg-12 {
        padding-right: 20rem !important;
    }

    .pe-lg-sm {
        padding-right: 1rem !important;
    }

    .pe-lg-md {
        padding-right: 2rem !important;
    }

    .pe-lg-lg {
        padding-right: 4rem !important;
    }

    .pe-lg-xl {
        padding-right: 8rem !important;
    }

    .pb-lg-0 {
        padding-bottom: 0 !important;
    }

    .pb-lg-1 {
        padding-bottom: 0.25rem !important;
    }

    .pb-lg-2 {
        padding-bottom: 0.5rem !important;
    }

    .pb-lg-3 {
        padding-bottom: 1rem !important;
    }

    .pb-lg-4 {
        padding-bottom: 1.5rem !important;
    }

    .pb-lg-5 {
        padding-bottom: 3rem !important;
    }

    .pb-lg-6 {
        padding-bottom: 5rem !important;
    }

    .pb-lg-7 {
        padding-bottom: 8rem !important;
    }

    .pb-lg-8 {
        padding-bottom: 10rem !important;
    }

    .pb-lg-9 {
        padding-bottom: 11rem !important;
    }

    .pb-lg-10 {
        padding-bottom: 14rem !important;
    }

    .pb-lg-11 {
        padding-bottom: 16rem !important;
    }

    .pb-lg-12 {
        padding-bottom: 20rem !important;
    }

    .pb-lg-sm {
        padding-bottom: 1rem !important;
    }

    .pb-lg-md {
        padding-bottom: 2rem !important;
    }

    .pb-lg-lg {
        padding-bottom: 4rem !important;
    }

    .pb-lg-xl {
        padding-bottom: 8rem !important;
    }

    .ps-lg-0 {
        padding-left: 0 !important;
    }

    .ps-lg-1 {
        padding-left: 0.25rem !important;
    }

    .ps-lg-2 {
        padding-left: 0.5rem !important;
    }

    .ps-lg-3 {
        padding-left: 1rem !important;
    }

    .ps-lg-4 {
        padding-left: 1.5rem !important;
    }

    .ps-lg-5 {
        padding-left: 3rem !important;
    }

    .ps-lg-6 {
        padding-left: 5rem !important;
    }

    .ps-lg-7 {
        padding-left: 8rem !important;
    }

    .ps-lg-8 {
        padding-left: 10rem !important;
    }

    .ps-lg-9 {
        padding-left: 11rem !important;
    }

    .ps-lg-10 {
        padding-left: 14rem !important;
    }

    .ps-lg-11 {
        padding-left: 16rem !important;
    }

    .ps-lg-12 {
        padding-left: 20rem !important;
    }

    .ps-lg-sm {
        padding-left: 1rem !important;
    }

    .ps-lg-md {
        padding-left: 2rem !important;
    }

    .ps-lg-lg {
        padding-left: 4rem !important;
    }

    .ps-lg-xl {
        padding-left: 8rem !important;
    }

    .text-lg-start {
        text-align: left !important;
    }

    .text-lg-end {
        text-align: right !important;
    }

    .text-lg-center {
        text-align: center !important;
    }
}

@media (min-width: 1200px) {
    .float-xl-start {
        float: left !important;
    }

    .float-xl-end {
        float: right !important;
    }

    .float-xl-none {
        float: none !important;
    }

    .d-xl-inline {
        display: inline !important;
    }

    .d-xl-inline-block {
        display: inline-block !important;
    }

    .d-xl-block {
        display: block !important;
    }

    .d-xl-grid {
        display: grid !important;
    }

    .d-xl-table {
        display: table !important;
    }

    .d-xl-table-row {
        display: table-row !important;
    }

    .d-xl-table-cell {
        display: table-cell !important;
    }

    .d-xl-flex {
        display: flex !important;
    }

    .d-xl-inline-flex {
        display: inline-flex !important;
    }

    .d-xl-none {
        display: none !important;
    }

    .vh-xl-100 {
        height: 100vh !important;
    }

    .flex-xl-fill {
        flex: 1 1 auto !important;
    }

    .flex-xl-row {
        flex-direction: row !important;
    }

    .flex-xl-column {
        flex-direction: column !important;
    }

    .flex-xl-row-reverse {
        flex-direction: row-reverse !important;
    }

    .flex-xl-column-reverse {
        flex-direction: column-reverse !important;
    }

    .flex-xl-grow-0 {
        flex-grow: 0 !important;
    }

    .flex-xl-grow-1 {
        flex-grow: 1 !important;
    }

    .flex-xl-shrink-0 {
        flex-shrink: 0 !important;
    }

    .flex-xl-shrink-1 {
        flex-shrink: 1 !important;
    }

    .flex-xl-wrap {
        flex-wrap: wrap !important;
    }

    .flex-xl-nowrap {
        flex-wrap: nowrap !important;
    }

    .flex-xl-wrap-reverse {
        flex-wrap: wrap-reverse !important;
    }

    .gap-xl-0 {
        gap: 0 !important;
    }

    .gap-xl-1 {
        gap: 0.25rem !important;
    }

    .gap-xl-2 {
        gap: 0.5rem !important;
    }

    .gap-xl-3 {
        gap: 1rem !important;
    }

    .gap-xl-4 {
        gap: 1.5rem !important;
    }

    .gap-xl-5 {
        gap: 3rem !important;
    }

    .gap-xl-6 {
        gap: 5rem !important;
    }

    .gap-xl-7 {
        gap: 8rem !important;
    }

    .gap-xl-8 {
        gap: 10rem !important;
    }

    .gap-xl-9 {
        gap: 11rem !important;
    }

    .gap-xl-10 {
        gap: 14rem !important;
    }

    .gap-xl-11 {
        gap: 16rem !important;
    }

    .gap-xl-12 {
        gap: 20rem !important;
    }

    .gap-xl-sm {
        gap: 1rem !important;
    }

    .gap-xl-md {
        gap: 2rem !important;
    }

    .gap-xl-lg {
        gap: 4rem !important;
    }

    .gap-xl-xl {
        gap: 8rem !important;
    }

    .justify-content-xl-start {
        justify-content: flex-start !important;
    }

    .justify-content-xl-end {
        justify-content: flex-end !important;
    }

    .justify-content-xl-center {
        justify-content: center !important;
    }

    .justify-content-xl-between {
        justify-content: space-between !important;
    }

    .justify-content-xl-around {
        justify-content: space-around !important;
    }

    .justify-content-xl-evenly {
        justify-content: space-evenly !important;
    }

    .align-items-xl-start {
        align-items: flex-start !important;
    }

    .align-items-xl-end {
        align-items: flex-end !important;
    }

    .align-items-xl-center {
        align-items: center !important;
    }

    .align-items-xl-baseline {
        align-items: baseline !important;
    }

    .align-items-xl-stretch {
        align-items: stretch !important;
    }

    .align-content-xl-start {
        align-content: flex-start !important;
    }

    .align-content-xl-end {
        align-content: flex-end !important;
    }

    .align-content-xl-center {
        align-content: center !important;
    }

    .align-content-xl-between {
        align-content: space-between !important;
    }

    .align-content-xl-around {
        align-content: space-around !important;
    }

    .align-content-xl-stretch {
        align-content: stretch !important;
    }

    .align-self-xl-auto {
        align-self: auto !important;
    }

    .align-self-xl-start {
        align-self: flex-start !important;
    }

    .align-self-xl-end {
        align-self: flex-end !important;
    }

    .align-self-xl-center {
        align-self: center !important;
    }

    .align-self-xl-baseline {
        align-self: baseline !important;
    }

    .align-self-xl-stretch {
        align-self: stretch !important;
    }

    .order-xl-first {
        order: -1 !important;
    }

    .order-xl-0 {
        order: 0 !important;
    }

    .order-xl-1 {
        order: 1 !important;
    }

    .order-xl-2 {
        order: 2 !important;
    }

    .order-xl-3 {
        order: 3 !important;
    }

    .order-xl-4 {
        order: 4 !important;
    }

    .order-xl-5 {
        order: 5 !important;
    }

    .order-xl-last {
        order: 6 !important;
    }

    .m-xl-0 {
        margin: 0 !important;
    }

    .m-xl-1 {
        margin: 0.25rem !important;
    }

    .m-xl-2 {
        margin: 0.5rem !important;
    }

    .m-xl-3 {
        margin: 1rem !important;
    }

    .m-xl-4 {
        margin: 1.5rem !important;
    }

    .m-xl-5 {
        margin: 3rem !important;
    }

    .m-xl-6 {
        margin: 5rem !important;
    }

    .m-xl-7 {
        margin: 8rem !important;
    }

    .m-xl-8 {
        margin: 10rem !important;
    }

    .m-xl-9 {
        margin: 11rem !important;
    }

    .m-xl-10 {
        margin: 14rem !important;
    }

    .m-xl-11 {
        margin: 16rem !important;
    }

    .m-xl-12 {
        margin: 20rem !important;
    }

    .m-xl-sm {
        margin: 1rem !important;
    }

    .m-xl-md {
        margin: 2rem !important;
    }

    .m-xl-lg {
        margin: 4rem !important;
    }

    .m-xl-xl {
        margin: 8rem !important;
    }

    .m-xl-auto {
        margin: auto !important;
    }

    .mx-xl-0 {
        margin-right: 0 !important;
        margin-left: 0 !important;
    }

    .mx-xl-1 {
        margin-right: 0.25rem !important;
        margin-left: 0.25rem !important;
    }

    .mx-xl-2 {
        margin-right: 0.5rem !important;
        margin-left: 0.5rem !important;
    }

    .mx-xl-3 {
        margin-right: 1rem !important;
        margin-left: 1rem !important;
    }

    .mx-xl-4 {
        margin-right: 1.5rem !important;
        margin-left: 1.5rem !important;
    }

    .mx-xl-5 {
        margin-right: 3rem !important;
        margin-left: 3rem !important;
    }

    .mx-xl-6 {
        margin-right: 5rem !important;
        margin-left: 5rem !important;
    }

    .mx-xl-7 {
        margin-right: 8rem !important;
        margin-left: 8rem !important;
    }

    .mx-xl-8 {
        margin-right: 10rem !important;
        margin-left: 10rem !important;
    }

    .mx-xl-9 {
        margin-right: 11rem !important;
        margin-left: 11rem !important;
    }

    .mx-xl-10 {
        margin-right: 14rem !important;
        margin-left: 14rem !important;
    }

    .mx-xl-11 {
        margin-right: 16rem !important;
        margin-left: 16rem !important;
    }

    .mx-xl-12 {
        margin-right: 20rem !important;
        margin-left: 20rem !important;
    }

    .mx-xl-sm {
        margin-right: 1rem !important;
        margin-left: 1rem !important;
    }

    .mx-xl-md {
        margin-right: 2rem !important;
        margin-left: 2rem !important;
    }

    .mx-xl-lg {
        margin-right: 4rem !important;
        margin-left: 4rem !important;
    }

    .mx-xl-xl {
        margin-right: 8rem !important;
        margin-left: 8rem !important;
    }

    .mx-xl-auto {
        margin-right: auto !important;
        margin-left: auto !important;
    }

    .my-xl-0 {
        margin-top: 0 !important;
        margin-bottom: 0 !important;
    }

    .my-xl-1 {
        margin-top: 0.25rem !important;
        margin-bottom: 0.25rem !important;
    }

    .my-xl-2 {
        margin-top: 0.5rem !important;
        margin-bottom: 0.5rem !important;
    }

    .my-xl-3 {
        margin-top: 1rem !important;
        margin-bottom: 1rem !important;
    }

    .my-xl-4 {
        margin-top: 1.5rem !important;
        margin-bottom: 1.5rem !important;
    }

    .my-xl-5 {
        margin-top: 3rem !important;
        margin-bottom: 3rem !important;
    }

    .my-xl-6 {
        margin-top: 5rem !important;
        margin-bottom: 5rem !important;
    }

    .my-xl-7 {
        margin-top: 8rem !important;
        margin-bottom: 8rem !important;
    }

    .my-xl-8 {
        margin-top: 10rem !important;
        margin-bottom: 10rem !important;
    }

    .my-xl-9 {
        margin-top: 11rem !important;
        margin-bottom: 11rem !important;
    }

    .my-xl-10 {
        margin-top: 14rem !important;
        margin-bottom: 14rem !important;
    }

    .my-xl-11 {
        margin-top: 16rem !important;
        margin-bottom: 16rem !important;
    }

    .my-xl-12 {
        margin-top: 20rem !important;
        margin-bottom: 20rem !important;
    }

    .my-xl-sm {
        margin-top: 1rem !important;
        margin-bottom: 1rem !important;
    }

    .my-xl-md {
        margin-top: 2rem !important;
        margin-bottom: 2rem !important;
    }

    .my-xl-lg {
        margin-top: 4rem !important;
        margin-bottom: 4rem !important;
    }

    .my-xl-xl {
        margin-top: 8rem !important;
        margin-bottom: 8rem !important;
    }

    .my-xl-auto {
        margin-top: auto !important;
        margin-bottom: auto !important;
    }

    .mt-xl-0 {
        margin-top: 0 !important;
    }

    .mt-xl-1 {
        margin-top: 0.25rem !important;
    }

    .mt-xl-2 {
        margin-top: 0.5rem !important;
    }

    .mt-xl-3 {
        margin-top: 1rem !important;
    }

    .mt-xl-4 {
        margin-top: 1.5rem !important;
    }

    .mt-xl-5 {
        margin-top: 3rem !important;
    }

    .mt-xl-6 {
        margin-top: 5rem !important;
    }

    .mt-xl-7 {
        margin-top: 8rem !important;
    }

    .mt-xl-8 {
        margin-top: 10rem !important;
    }

    .mt-xl-9 {
        margin-top: 11rem !important;
    }

    .mt-xl-10 {
        margin-top: 14rem !important;
    }

    .mt-xl-11 {
        margin-top: 16rem !important;
    }

    .mt-xl-12 {
        margin-top: 20rem !important;
    }

    .mt-xl-sm {
        margin-top: 1rem !important;
    }

    .mt-xl-md {
        margin-top: 2rem !important;
    }

    .mt-xl-lg {
        margin-top: 4rem !important;
    }

    .mt-xl-xl {
        margin-top: 8rem !important;
    }

    .mt-xl-auto {
        margin-top: auto !important;
    }

    .me-xl-0 {
        margin-right: 0 !important;
    }

    .me-xl-1 {
        margin-right: 0.25rem !important;
    }

    .me-xl-2 {
        margin-right: 0.5rem !important;
    }

    .me-xl-3 {
        margin-right: 1rem !important;
    }

    .me-xl-4 {
        margin-right: 1.5rem !important;
    }

    .me-xl-5 {
        margin-right: 3rem !important;
    }

    .me-xl-6 {
        margin-right: 5rem !important;
    }

    .me-xl-7 {
        margin-right: 8rem !important;
    }

    .me-xl-8 {
        margin-right: 10rem !important;
    }

    .me-xl-9 {
        margin-right: 11rem !important;
    }

    .me-xl-10 {
        margin-right: 14rem !important;
    }

    .me-xl-11 {
        margin-right: 16rem !important;
    }

    .me-xl-12 {
        margin-right: 20rem !important;
    }

    .me-xl-sm {
        margin-right: 1rem !important;
    }

    .me-xl-md {
        margin-right: 2rem !important;
    }

    .me-xl-lg {
        margin-right: 4rem !important;
    }

    .me-xl-xl {
        margin-right: 8rem !important;
    }

    .me-xl-auto {
        margin-right: auto !important;
    }

    .mb-xl-0 {
        margin-bottom: 0 !important;
    }

    .mb-xl-1 {
        margin-bottom: 0.25rem !important;
    }

    .mb-xl-2 {
        margin-bottom: 0.5rem !important;
    }

    .mb-xl-3 {
        margin-bottom: 1rem !important;
    }

    .mb-xl-4 {
        margin-bottom: 1.5rem !important;
    }

    .mb-xl-5 {
        margin-bottom: 3rem !important;
    }

    .mb-xl-6 {
        margin-bottom: 5rem !important;
    }

    .mb-xl-7 {
        margin-bottom: 8rem !important;
    }

    .mb-xl-8 {
        margin-bottom: 10rem !important;
    }

    .mb-xl-9 {
        margin-bottom: 11rem !important;
    }

    .mb-xl-10 {
        margin-bottom: 14rem !important;
    }

    .mb-xl-11 {
        margin-bottom: 16rem !important;
    }

    .mb-xl-12 {
        margin-bottom: 20rem !important;
    }

    .mb-xl-sm {
        margin-bottom: 1rem !important;
    }

    .mb-xl-md {
        margin-bottom: 2rem !important;
    }

    .mb-xl-lg {
        margin-bottom: 4rem !important;
    }

    .mb-xl-xl {
        margin-bottom: 8rem !important;
    }

    .mb-xl-auto {
        margin-bottom: auto !important;
    }

    .ms-xl-0 {
        margin-left: 0 !important;
    }

    .ms-xl-1 {
        margin-left: 0.25rem !important;
    }

    .ms-xl-2 {
        margin-left: 0.5rem !important;
    }

    .ms-xl-3 {
        margin-left: 1rem !important;
    }

    .ms-xl-4 {
        margin-left: 1.5rem !important;
    }

    .ms-xl-5 {
        margin-left: 3rem !important;
    }

    .ms-xl-6 {
        margin-left: 5rem !important;
    }

    .ms-xl-7 {
        margin-left: 8rem !important;
    }

    .ms-xl-8 {
        margin-left: 10rem !important;
    }

    .ms-xl-9 {
        margin-left: 11rem !important;
    }

    .ms-xl-10 {
        margin-left: 14rem !important;
    }

    .ms-xl-11 {
        margin-left: 16rem !important;
    }

    .ms-xl-12 {
        margin-left: 20rem !important;
    }

    .ms-xl-sm {
        margin-left: 1rem !important;
    }

    .ms-xl-md {
        margin-left: 2rem !important;
    }

    .ms-xl-lg {
        margin-left: 4rem !important;
    }

    .ms-xl-xl {
        margin-left: 8rem !important;
    }

    .ms-xl-auto {
        margin-left: auto !important;
    }

    .m-xl-n1 {
        margin: -0.25rem !important;
    }

    .m-xl-n2 {
        margin: -0.5rem !important;
    }

    .m-xl-n3 {
        margin: -1rem !important;
    }

    .m-xl-n4 {
        margin: -1.5rem !important;
    }

    .m-xl-n5 {
        margin: -3rem !important;
    }

    .m-xl-n6 {
        margin: -5rem !important;
    }

    .m-xl-n7 {
        margin: -8rem !important;
    }

    .m-xl-n8 {
        margin: -10rem !important;
    }

    .m-xl-n9 {
        margin: -11rem !important;
    }

    .m-xl-n10 {
        margin: -14rem !important;
    }

    .m-xl-n11 {
        margin: -16rem !important;
    }

    .m-xl-n12 {
        margin: -20rem !important;
    }

    .m-xl-nsm {
        margin: -1rem !important;
    }

    .m-xl-nmd {
        margin: -2rem !important;
    }

    .m-xl-nlg {
        margin: -4rem !important;
    }

    .m-xl-nxl {
        margin: -8rem !important;
    }

    .mx-xl-n1 {
        margin-right: -0.25rem !important;
        margin-left: -0.25rem !important;
    }

    .mx-xl-n2 {
        margin-right: -0.5rem !important;
        margin-left: -0.5rem !important;
    }

    .mx-xl-n3 {
        margin-right: -1rem !important;
        margin-left: -1rem !important;
    }

    .mx-xl-n4 {
        margin-right: -1.5rem !important;
        margin-left: -1.5rem !important;
    }

    .mx-xl-n5 {
        margin-right: -3rem !important;
        margin-left: -3rem !important;
    }

    .mx-xl-n6 {
        margin-right: -5rem !important;
        margin-left: -5rem !important;
    }

    .mx-xl-n7 {
        margin-right: -8rem !important;
        margin-left: -8rem !important;
    }

    .mx-xl-n8 {
        margin-right: -10rem !important;
        margin-left: -10rem !important;
    }

    .mx-xl-n9 {
        margin-right: -11rem !important;
        margin-left: -11rem !important;
    }

    .mx-xl-n10 {
        margin-right: -14rem !important;
        margin-left: -14rem !important;
    }

    .mx-xl-n11 {
        margin-right: -16rem !important;
        margin-left: -16rem !important;
    }

    .mx-xl-n12 {
        margin-right: -20rem !important;
        margin-left: -20rem !important;
    }

    .mx-xl-nsm {
        margin-right: -1rem !important;
        margin-left: -1rem !important;
    }

    .mx-xl-nmd {
        margin-right: -2rem !important;
        margin-left: -2rem !important;
    }

    .mx-xl-nlg {
        margin-right: -4rem !important;
        margin-left: -4rem !important;
    }

    .mx-xl-nxl {
        margin-right: -8rem !important;
        margin-left: -8rem !important;
    }

    .my-xl-n1 {
        margin-top: -0.25rem !important;
        margin-bottom: -0.25rem !important;
    }

    .my-xl-n2 {
        margin-top: -0.5rem !important;
        margin-bottom: -0.5rem !important;
    }

    .my-xl-n3 {
        margin-top: -1rem !important;
        margin-bottom: -1rem !important;
    }

    .my-xl-n4 {
        margin-top: -1.5rem !important;
        margin-bottom: -1.5rem !important;
    }

    .my-xl-n5 {
        margin-top: -3rem !important;
        margin-bottom: -3rem !important;
    }

    .my-xl-n6 {
        margin-top: -5rem !important;
        margin-bottom: -5rem !important;
    }

    .my-xl-n7 {
        margin-top: -8rem !important;
        margin-bottom: -8rem !important;
    }

    .my-xl-n8 {
        margin-top: -10rem !important;
        margin-bottom: -10rem !important;
    }

    .my-xl-n9 {
        margin-top: -11rem !important;
        margin-bottom: -11rem !important;
    }

    .my-xl-n10 {
        margin-top: -14rem !important;
        margin-bottom: -14rem !important;
    }

    .my-xl-n11 {
        margin-top: -16rem !important;
        margin-bottom: -16rem !important;
    }

    .my-xl-n12 {
        margin-top: -20rem !important;
        margin-bottom: -20rem !important;
    }

    .my-xl-nsm {
        margin-top: -1rem !important;
        margin-bottom: -1rem !important;
    }

    .my-xl-nmd {
        margin-top: -2rem !important;
        margin-bottom: -2rem !important;
    }

    .my-xl-nlg {
        margin-top: -4rem !important;
        margin-bottom: -4rem !important;
    }

    .my-xl-nxl {
        margin-top: -8rem !important;
        margin-bottom: -8rem !important;
    }

    .mt-xl-n1 {
        margin-top: -0.25rem !important;
    }

    .mt-xl-n2 {
        margin-top: -0.5rem !important;
    }

    .mt-xl-n3 {
        margin-top: -1rem !important;
    }

    .mt-xl-n4 {
        margin-top: -1.5rem !important;
    }

    .mt-xl-n5 {
        margin-top: -3rem !important;
    }

    .mt-xl-n6 {
        margin-top: -5rem !important;
    }

    .mt-xl-n7 {
        margin-top: -8rem !important;
    }

    .mt-xl-n8 {
        margin-top: -10rem !important;
    }

    .mt-xl-n9 {
        margin-top: -11rem !important;
    }

    .mt-xl-n10 {
        margin-top: -14rem !important;
    }

    .mt-xl-n11 {
        margin-top: -16rem !important;
    }

    .mt-xl-n12 {
        margin-top: -20rem !important;
    }

    .mt-xl-nsm {
        margin-top: -1rem !important;
    }

    .mt-xl-nmd {
        margin-top: -2rem !important;
    }

    .mt-xl-nlg {
        margin-top: -4rem !important;
    }

    .mt-xl-nxl {
        margin-top: -8rem !important;
    }

    .me-xl-n1 {
        margin-right: -0.25rem !important;
    }

    .me-xl-n2 {
        margin-right: -0.5rem !important;
    }

    .me-xl-n3 {
        margin-right: -1rem !important;
    }

    .me-xl-n4 {
        margin-right: -1.5rem !important;
    }

    .me-xl-n5 {
        margin-right: -3rem !important;
    }

    .me-xl-n6 {
        margin-right: -5rem !important;
    }

    .me-xl-n7 {
        margin-right: -8rem !important;
    }

    .me-xl-n8 {
        margin-right: -10rem !important;
    }

    .me-xl-n9 {
        margin-right: -11rem !important;
    }

    .me-xl-n10 {
        margin-right: -14rem !important;
    }

    .me-xl-n11 {
        margin-right: -16rem !important;
    }

    .me-xl-n12 {
        margin-right: -20rem !important;
    }

    .me-xl-nsm {
        margin-right: -1rem !important;
    }

    .me-xl-nmd {
        margin-right: -2rem !important;
    }

    .me-xl-nlg {
        margin-right: -4rem !important;
    }

    .me-xl-nxl {
        margin-right: -8rem !important;
    }

    .mb-xl-n1 {
        margin-bottom: -0.25rem !important;
    }

    .mb-xl-n2 {
        margin-bottom: -0.5rem !important;
    }

    .mb-xl-n3 {
        margin-bottom: -1rem !important;
    }

    .mb-xl-n4 {
        margin-bottom: -1.5rem !important;
    }

    .mb-xl-n5 {
        margin-bottom: -3rem !important;
    }

    .mb-xl-n6 {
        margin-bottom: -5rem !important;
    }

    .mb-xl-n7 {
        margin-bottom: -8rem !important;
    }

    .mb-xl-n8 {
        margin-bottom: -10rem !important;
    }

    .mb-xl-n9 {
        margin-bottom: -11rem !important;
    }

    .mb-xl-n10 {
        margin-bottom: -14rem !important;
    }

    .mb-xl-n11 {
        margin-bottom: -16rem !important;
    }

    .mb-xl-n12 {
        margin-bottom: -20rem !important;
    }

    .mb-xl-nsm {
        margin-bottom: -1rem !important;
    }

    .mb-xl-nmd {
        margin-bottom: -2rem !important;
    }

    .mb-xl-nlg {
        margin-bottom: -4rem !important;
    }

    .mb-xl-nxl {
        margin-bottom: -8rem !important;
    }

    .ms-xl-n1 {
        margin-left: -0.25rem !important;
    }

    .ms-xl-n2 {
        margin-left: -0.5rem !important;
    }

    .ms-xl-n3 {
        margin-left: -1rem !important;
    }

    .ms-xl-n4 {
        margin-left: -1.5rem !important;
    }

    .ms-xl-n5 {
        margin-left: -3rem !important;
    }

    .ms-xl-n6 {
        margin-left: -5rem !important;
    }

    .ms-xl-n7 {
        margin-left: -8rem !important;
    }

    .ms-xl-n8 {
        margin-left: -10rem !important;
    }

    .ms-xl-n9 {
        margin-left: -11rem !important;
    }

    .ms-xl-n10 {
        margin-left: -14rem !important;
    }

    .ms-xl-n11 {
        margin-left: -16rem !important;
    }

    .ms-xl-n12 {
        margin-left: -20rem !important;
    }

    .ms-xl-nsm {
        margin-left: -1rem !important;
    }

    .ms-xl-nmd {
        margin-left: -2rem !important;
    }

    .ms-xl-nlg {
        margin-left: -4rem !important;
    }

    .ms-xl-nxl {
        margin-left: -8rem !important;
    }

    .p-xl-0 {
        padding: 0 !important;
    }

    .p-xl-1 {
        padding: 0.25rem !important;
    }

    .p-xl-2 {
        padding: 0.5rem !important;
    }

    .p-xl-3 {
        padding: 1rem !important;
    }

    .p-xl-4 {
        padding: 1.5rem !important;
    }

    .p-xl-5 {
        padding: 3rem !important;
    }

    .p-xl-6 {
        padding: 5rem !important;
    }

    .p-xl-7 {
        padding: 8rem !important;
    }

    .p-xl-8 {
        padding: 10rem !important;
    }

    .p-xl-9 {
        padding: 11rem !important;
    }

    .p-xl-10 {
        padding: 14rem !important;
    }

    .p-xl-11 {
        padding: 16rem !important;
    }

    .p-xl-12 {
        padding: 20rem !important;
    }

    .p-xl-sm {
        padding: 1rem !important;
    }

    .p-xl-md {
        padding: 2rem !important;
    }

    .p-xl-lg {
        padding: 4rem !important;
    }

    .p-xl-xl {
        padding: 8rem !important;
    }

    .px-xl-0 {
        padding-right: 0 !important;
        padding-left: 0 !important;
    }

    .px-xl-1 {
        padding-right: 0.25rem !important;
        padding-left: 0.25rem !important;
    }

    .px-xl-2 {
        padding-right: 0.5rem !important;
        padding-left: 0.5rem !important;
    }

    .px-xl-3 {
        padding-right: 1rem !important;
        padding-left: 1rem !important;
    }

    .px-xl-4 {
        padding-right: 1.5rem !important;
        padding-left: 1.5rem !important;
    }

    .px-xl-5 {
        padding-right: 3rem !important;
        padding-left: 3rem !important;
    }

    .px-xl-6 {
        padding-right: 5rem !important;
        padding-left: 5rem !important;
    }

    .px-xl-7 {
        padding-right: 8rem !important;
        padding-left: 8rem !important;
    }

    .px-xl-8 {
        padding-right: 10rem !important;
        padding-left: 10rem !important;
    }

    .px-xl-9 {
        padding-right: 11rem !important;
        padding-left: 11rem !important;
    }

    .px-xl-10 {
        padding-right: 14rem !important;
        padding-left: 14rem !important;
    }

    .px-xl-11 {
        padding-right: 16rem !important;
        padding-left: 16rem !important;
    }

    .px-xl-12 {
        padding-right: 20rem !important;
        padding-left: 20rem !important;
    }

    .px-xl-sm {
        padding-right: 1rem !important;
        padding-left: 1rem !important;
    }

    .px-xl-md {
        padding-right: 2rem !important;
        padding-left: 2rem !important;
    }

    .px-xl-lg {
        padding-right: 4rem !important;
        padding-left: 4rem !important;
    }

    .px-xl-xl {
        padding-right: 8rem !important;
        padding-left: 8rem !important;
    }

    .py-xl-0 {
        padding-top: 0 !important;
        padding-bottom: 0 !important;
    }

    .py-xl-1 {
        padding-top: 0.25rem !important;
        padding-bottom: 0.25rem !important;
    }

    .py-xl-2 {
        padding-top: 0.5rem !important;
        padding-bottom: 0.5rem !important;
    }

    .py-xl-3 {
        padding-top: 1rem !important;
        padding-bottom: 1rem !important;
    }

    .py-xl-4 {
        padding-top: 1.5rem !important;
        padding-bottom: 1.5rem !important;
    }

    .py-xl-5 {
        padding-top: 3rem !important;
        padding-bottom: 3rem !important;
    }

    .py-xl-6 {
        padding-top: 5rem !important;
        padding-bottom: 5rem !important;
    }

    .py-xl-7 {
        padding-top: 8rem !important;
        padding-bottom: 8rem !important;
    }

    .py-xl-8 {
        padding-top: 10rem !important;
        padding-bottom: 10rem !important;
    }

    .py-xl-9 {
        padding-top: 11rem !important;
        padding-bottom: 11rem !important;
    }

    .py-xl-10 {
        padding-top: 14rem !important;
        padding-bottom: 14rem !important;
    }

    .py-xl-11 {
        padding-top: 16rem !important;
        padding-bottom: 16rem !important;
    }

    .py-xl-12 {
        padding-top: 20rem !important;
        padding-bottom: 20rem !important;
    }

    .py-xl-sm {
        padding-top: 1rem !important;
        padding-bottom: 1rem !important;
    }

    .py-xl-md {
        padding-top: 2rem !important;
        padding-bottom: 2rem !important;
    }

    .py-xl-lg {
        padding-top: 4rem !important;
        padding-bottom: 4rem !important;
    }

    .py-xl-xl {
        padding-top: 8rem !important;
        padding-bottom: 8rem !important;
    }

    .pt-xl-0 {
        padding-top: 0 !important;
    }

    .pt-xl-1 {
        padding-top: 0.25rem !important;
    }

    .pt-xl-2 {
        padding-top: 0.5rem !important;
    }

    .pt-xl-3 {
        padding-top: 1rem !important;
    }

    .pt-xl-4 {
        padding-top: 1.5rem !important;
    }

    .pt-xl-5 {
        padding-top: 3rem !important;
    }

    .pt-xl-6 {
        padding-top: 5rem !important;
    }

    .pt-xl-7 {
        padding-top: 8rem !important;
    }

    .pt-xl-8 {
        padding-top: 10rem !important;
    }

    .pt-xl-9 {
        padding-top: 11rem !important;
    }

    .pt-xl-10 {
        padding-top: 14rem !important;
    }

    .pt-xl-11 {
        padding-top: 16rem !important;
    }

    .pt-xl-12 {
        padding-top: 20rem !important;
    }

    .pt-xl-sm {
        padding-top: 1rem !important;
    }

    .pt-xl-md {
        padding-top: 2rem !important;
    }

    .pt-xl-lg {
        padding-top: 4rem !important;
    }

    .pt-xl-xl {
        padding-top: 8rem !important;
    }

    .pe-xl-0 {
        padding-right: 0 !important;
    }

    .pe-xl-1 {
        padding-right: 0.25rem !important;
    }

    .pe-xl-2 {
        padding-right: 0.5rem !important;
    }

    .pe-xl-3 {
        padding-right: 1rem !important;
    }

    .pe-xl-4 {
        padding-right: 1.5rem !important;
    }

    .pe-xl-5 {
        padding-right: 3rem !important;
    }

    .pe-xl-6 {
        padding-right: 5rem !important;
    }

    .pe-xl-7 {
        padding-right: 8rem !important;
    }

    .pe-xl-8 {
        padding-right: 10rem !important;
    }

    .pe-xl-9 {
        padding-right: 11rem !important;
    }

    .pe-xl-10 {
        padding-right: 14rem !important;
    }

    .pe-xl-11 {
        padding-right: 16rem !important;
    }

    .pe-xl-12 {
        padding-right: 20rem !important;
    }

    .pe-xl-sm {
        padding-right: 1rem !important;
    }

    .pe-xl-md {
        padding-right: 2rem !important;
    }

    .pe-xl-lg {
        padding-right: 4rem !important;
    }

    .pe-xl-xl {
        padding-right: 8rem !important;
    }

    .pb-xl-0 {
        padding-bottom: 0 !important;
    }

    .pb-xl-1 {
        padding-bottom: 0.25rem !important;
    }

    .pb-xl-2 {
        padding-bottom: 0.5rem !important;
    }

    .pb-xl-3 {
        padding-bottom: 1rem !important;
    }

    .pb-xl-4 {
        padding-bottom: 1.5rem !important;
    }

    .pb-xl-5 {
        padding-bottom: 3rem !important;
    }

    .pb-xl-6 {
        padding-bottom: 5rem !important;
    }

    .pb-xl-7 {
        padding-bottom: 8rem !important;
    }

    .pb-xl-8 {
        padding-bottom: 10rem !important;
    }

    .pb-xl-9 {
        padding-bottom: 11rem !important;
    }

    .pb-xl-10 {
        padding-bottom: 14rem !important;
    }

    .pb-xl-11 {
        padding-bottom: 16rem !important;
    }

    .pb-xl-12 {
        padding-bottom: 20rem !important;
    }

    .pb-xl-sm {
        padding-bottom: 1rem !important;
    }

    .pb-xl-md {
        padding-bottom: 2rem !important;
    }

    .pb-xl-lg {
        padding-bottom: 4rem !important;
    }

    .pb-xl-xl {
        padding-bottom: 8rem !important;
    }

    .ps-xl-0 {
        padding-left: 0 !important;
    }

    .ps-xl-1 {
        padding-left: 0.25rem !important;
    }

    .ps-xl-2 {
        padding-left: 0.5rem !important;
    }

    .ps-xl-3 {
        padding-left: 1rem !important;
    }

    .ps-xl-4 {
        padding-left: 1.5rem !important;
    }

    .ps-xl-5 {
        padding-left: 3rem !important;
    }

    .ps-xl-6 {
        padding-left: 5rem !important;
    }

    .ps-xl-7 {
        padding-left: 8rem !important;
    }

    .ps-xl-8 {
        padding-left: 10rem !important;
    }

    .ps-xl-9 {
        padding-left: 11rem !important;
    }

    .ps-xl-10 {
        padding-left: 14rem !important;
    }

    .ps-xl-11 {
        padding-left: 16rem !important;
    }

    .ps-xl-12 {
        padding-left: 20rem !important;
    }

    .ps-xl-sm {
        padding-left: 1rem !important;
    }

    .ps-xl-md {
        padding-left: 2rem !important;
    }

    .ps-xl-lg {
        padding-left: 4rem !important;
    }

    .ps-xl-xl {
        padding-left: 8rem !important;
    }

    .text-xl-start {
        text-align: left !important;
    }

    .text-xl-end {
        text-align: right !important;
    }

    .text-xl-center {
        text-align: center !important;
    }
}

@media (min-width: 1400px) {
    .float-xxl-start {
        float: left !important;
    }

    .float-xxl-end {
        float: right !important;
    }

    .float-xxl-none {
        float: none !important;
    }

    .d-xxl-inline {
        display: inline !important;
    }

    .d-xxl-inline-block {
        display: inline-block !important;
    }

    .d-xxl-block {
        display: block !important;
    }

    .d-xxl-grid {
        display: grid !important;
    }

    .d-xxl-table {
        display: table !important;
    }

    .d-xxl-table-row {
        display: table-row !important;
    }

    .d-xxl-table-cell {
        display: table-cell !important;
    }

    .d-xxl-flex {
        display: flex !important;
    }

    .d-xxl-inline-flex {
        display: inline-flex !important;
    }

    .d-xxl-none {
        display: none !important;
    }

    .vh-xxl-100 {
        height: 100vh !important;
    }

    .flex-xxl-fill {
        flex: 1 1 auto !important;
    }

    .flex-xxl-row {
        flex-direction: row !important;
    }

    .flex-xxl-column {
        flex-direction: column !important;
    }

    .flex-xxl-row-reverse {
        flex-direction: row-reverse !important;
    }

    .flex-xxl-column-reverse {
        flex-direction: column-reverse !important;
    }

    .flex-xxl-grow-0 {
        flex-grow: 0 !important;
    }

    .flex-xxl-grow-1 {
        flex-grow: 1 !important;
    }

    .flex-xxl-shrink-0 {
        flex-shrink: 0 !important;
    }

    .flex-xxl-shrink-1 {
        flex-shrink: 1 !important;
    }

    .flex-xxl-wrap {
        flex-wrap: wrap !important;
    }

    .flex-xxl-nowrap {
        flex-wrap: nowrap !important;
    }

    .flex-xxl-wrap-reverse {
        flex-wrap: wrap-reverse !important;
    }

    .gap-xxl-0 {
        gap: 0 !important;
    }

    .gap-xxl-1 {
        gap: 0.25rem !important;
    }

    .gap-xxl-2 {
        gap: 0.5rem !important;
    }

    .gap-xxl-3 {
        gap: 1rem !important;
    }

    .gap-xxl-4 {
        gap: 1.5rem !important;
    }

    .gap-xxl-5 {
        gap: 3rem !important;
    }

    .gap-xxl-6 {
        gap: 5rem !important;
    }

    .gap-xxl-7 {
        gap: 8rem !important;
    }

    .gap-xxl-8 {
        gap: 10rem !important;
    }

    .gap-xxl-9 {
        gap: 11rem !important;
    }

    .gap-xxl-10 {
        gap: 14rem !important;
    }

    .gap-xxl-11 {
        gap: 16rem !important;
    }

    .gap-xxl-12 {
        gap: 20rem !important;
    }

    .gap-xxl-sm {
        gap: 1rem !important;
    }

    .gap-xxl-md {
        gap: 2rem !important;
    }

    .gap-xxl-lg {
        gap: 4rem !important;
    }

    .gap-xxl-xl {
        gap: 8rem !important;
    }

    .justify-content-xxl-start {
        justify-content: flex-start !important;
    }

    .justify-content-xxl-end {
        justify-content: flex-end !important;
    }

    .justify-content-xxl-center {
        justify-content: center !important;
    }

    .justify-content-xxl-between {
        justify-content: space-between !important;
    }

    .justify-content-xxl-around {
        justify-content: space-around !important;
    }

    .justify-content-xxl-evenly {
        justify-content: space-evenly !important;
    }

    .align-items-xxl-start {
        align-items: flex-start !important;
    }

    .align-items-xxl-end {
        align-items: flex-end !important;
    }

    .align-items-xxl-center {
        align-items: center !important;
    }

    .align-items-xxl-baseline {
        align-items: baseline !important;
    }

    .align-items-xxl-stretch {
        align-items: stretch !important;
    }

    .align-content-xxl-start {
        align-content: flex-start !important;
    }

    .align-content-xxl-end {
        align-content: flex-end !important;
    }

    .align-content-xxl-center {
        align-content: center !important;
    }

    .align-content-xxl-between {
        align-content: space-between !important;
    }

    .align-content-xxl-around {
        align-content: space-around !important;
    }

    .align-content-xxl-stretch {
        align-content: stretch !important;
    }

    .align-self-xxl-auto {
        align-self: auto !important;
    }

    .align-self-xxl-start {
        align-self: flex-start !important;
    }

    .align-self-xxl-end {
        align-self: flex-end !important;
    }

    .align-self-xxl-center {
        align-self: center !important;
    }

    .align-self-xxl-baseline {
        align-self: baseline !important;
    }

    .align-self-xxl-stretch {
        align-self: stretch !important;
    }

    .order-xxl-first {
        order: -1 !important;
    }

    .order-xxl-0 {
        order: 0 !important;
    }

    .order-xxl-1 {
        order: 1 !important;
    }

    .order-xxl-2 {
        order: 2 !important;
    }

    .order-xxl-3 {
        order: 3 !important;
    }

    .order-xxl-4 {
        order: 4 !important;
    }

    .order-xxl-5 {
        order: 5 !important;
    }

    .order-xxl-last {
        order: 6 !important;
    }

    .m-xxl-0 {
        margin: 0 !important;
    }

    .m-xxl-1 {
        margin: 0.25rem !important;
    }

    .m-xxl-2 {
        margin: 0.5rem !important;
    }

    .m-xxl-3 {
        margin: 1rem !important;
    }

    .m-xxl-4 {
        margin: 1.5rem !important;
    }

    .m-xxl-5 {
        margin: 3rem !important;
    }

    .m-xxl-6 {
        margin: 5rem !important;
    }

    .m-xxl-7 {
        margin: 8rem !important;
    }

    .m-xxl-8 {
        margin: 10rem !important;
    }

    .m-xxl-9 {
        margin: 11rem !important;
    }

    .m-xxl-10 {
        margin: 14rem !important;
    }

    .m-xxl-11 {
        margin: 16rem !important;
    }

    .m-xxl-12 {
        margin: 20rem !important;
    }

    .m-xxl-sm {
        margin: 1rem !important;
    }

    .m-xxl-md {
        margin: 2rem !important;
    }

    .m-xxl-lg {
        margin: 4rem !important;
    }

    .m-xxl-xl {
        margin: 8rem !important;
    }

    .m-xxl-auto {
        margin: auto !important;
    }

    .mx-xxl-0 {
        margin-right: 0 !important;
        margin-left: 0 !important;
    }

    .mx-xxl-1 {
        margin-right: 0.25rem !important;
        margin-left: 0.25rem !important;
    }

    .mx-xxl-2 {
        margin-right: 0.5rem !important;
        margin-left: 0.5rem !important;
    }

    .mx-xxl-3 {
        margin-right: 1rem !important;
        margin-left: 1rem !important;
    }

    .mx-xxl-4 {
        margin-right: 1.5rem !important;
        margin-left: 1.5rem !important;
    }

    .mx-xxl-5 {
        margin-right: 3rem !important;
        margin-left: 3rem !important;
    }

    .mx-xxl-6 {
        margin-right: 5rem !important;
        margin-left: 5rem !important;
    }

    .mx-xxl-7 {
        margin-right: 8rem !important;
        margin-left: 8rem !important;
    }

    .mx-xxl-8 {
        margin-right: 10rem !important;
        margin-left: 10rem !important;
    }

    .mx-xxl-9 {
        margin-right: 11rem !important;
        margin-left: 11rem !important;
    }

    .mx-xxl-10 {
        margin-right: 14rem !important;
        margin-left: 14rem !important;
    }

    .mx-xxl-11 {
        margin-right: 16rem !important;
        margin-left: 16rem !important;
    }

    .mx-xxl-12 {
        margin-right: 20rem !important;
        margin-left: 20rem !important;
    }

    .mx-xxl-sm {
        margin-right: 1rem !important;
        margin-left: 1rem !important;
    }

    .mx-xxl-md {
        margin-right: 2rem !important;
        margin-left: 2rem !important;
    }

    .mx-xxl-lg {
        margin-right: 4rem !important;
        margin-left: 4rem !important;
    }

    .mx-xxl-xl {
        margin-right: 8rem !important;
        margin-left: 8rem !important;
    }

    .mx-xxl-auto {
        margin-right: auto !important;
        margin-left: auto !important;
    }

    .my-xxl-0 {
        margin-top: 0 !important;
        margin-bottom: 0 !important;
    }

    .my-xxl-1 {
        margin-top: 0.25rem !important;
        margin-bottom: 0.25rem !important;
    }

    .my-xxl-2 {
        margin-top: 0.5rem !important;
        margin-bottom: 0.5rem !important;
    }

    .my-xxl-3 {
        margin-top: 1rem !important;
        margin-bottom: 1rem !important;
    }

    .my-xxl-4 {
        margin-top: 1.5rem !important;
        margin-bottom: 1.5rem !important;
    }

    .my-xxl-5 {
        margin-top: 3rem !important;
        margin-bottom: 3rem !important;
    }

    .my-xxl-6 {
        margin-top: 5rem !important;
        margin-bottom: 5rem !important;
    }

    .my-xxl-7 {
        margin-top: 8rem !important;
        margin-bottom: 8rem !important;
    }

    .my-xxl-8 {
        margin-top: 10rem !important;
        margin-bottom: 10rem !important;
    }

    .my-xxl-9 {
        margin-top: 11rem !important;
        margin-bottom: 11rem !important;
    }

    .my-xxl-10 {
        margin-top: 14rem !important;
        margin-bottom: 14rem !important;
    }

    .my-xxl-11 {
        margin-top: 16rem !important;
        margin-bottom: 16rem !important;
    }

    .my-xxl-12 {
        margin-top: 20rem !important;
        margin-bottom: 20rem !important;
    }

    .my-xxl-sm {
        margin-top: 1rem !important;
        margin-bottom: 1rem !important;
    }

    .my-xxl-md {
        margin-top: 2rem !important;
        margin-bottom: 2rem !important;
    }

    .my-xxl-lg {
        margin-top: 4rem !important;
        margin-bottom: 4rem !important;
    }

    .my-xxl-xl {
        margin-top: 8rem !important;
        margin-bottom: 8rem !important;
    }

    .my-xxl-auto {
        margin-top: auto !important;
        margin-bottom: auto !important;
    }

    .mt-xxl-0 {
        margin-top: 0 !important;
    }

    .mt-xxl-1 {
        margin-top: 0.25rem !important;
    }

    .mt-xxl-2 {
        margin-top: 0.5rem !important;
    }

    .mt-xxl-3 {
        margin-top: 1rem !important;
    }

    .mt-xxl-4 {
        margin-top: 1.5rem !important;
    }

    .mt-xxl-5 {
        margin-top: 3rem !important;
    }

    .mt-xxl-6 {
        margin-top: 5rem !important;
    }

    .mt-xxl-7 {
        margin-top: 8rem !important;
    }

    .mt-xxl-8 {
        margin-top: 10rem !important;
    }

    .mt-xxl-9 {
        margin-top: 11rem !important;
    }

    .mt-xxl-10 {
        margin-top: 14rem !important;
    }

    .mt-xxl-11 {
        margin-top: 16rem !important;
    }

    .mt-xxl-12 {
        margin-top: 20rem !important;
    }

    .mt-xxl-sm {
        margin-top: 1rem !important;
    }

    .mt-xxl-md {
        margin-top: 2rem !important;
    }

    .mt-xxl-lg {
        margin-top: 4rem !important;
    }

    .mt-xxl-xl {
        margin-top: 8rem !important;
    }

    .mt-xxl-auto {
        margin-top: auto !important;
    }

    .me-xxl-0 {
        margin-right: 0 !important;
    }

    .me-xxl-1 {
        margin-right: 0.25rem !important;
    }

    .me-xxl-2 {
        margin-right: 0.5rem !important;
    }

    .me-xxl-3 {
        margin-right: 1rem !important;
    }

    .me-xxl-4 {
        margin-right: 1.5rem !important;
    }

    .me-xxl-5 {
        margin-right: 3rem !important;
    }

    .me-xxl-6 {
        margin-right: 5rem !important;
    }

    .me-xxl-7 {
        margin-right: 8rem !important;
    }

    .me-xxl-8 {
        margin-right: 10rem !important;
    }

    .me-xxl-9 {
        margin-right: 11rem !important;
    }

    .me-xxl-10 {
        margin-right: 14rem !important;
    }

    .me-xxl-11 {
        margin-right: 16rem !important;
    }

    .me-xxl-12 {
        margin-right: 20rem !important;
    }

    .me-xxl-sm {
        margin-right: 1rem !important;
    }

    .me-xxl-md {
        margin-right: 2rem !important;
    }

    .me-xxl-lg {
        margin-right: 4rem !important;
    }

    .me-xxl-xl {
        margin-right: 8rem !important;
    }

    .me-xxl-auto {
        margin-right: auto !important;
    }

    .mb-xxl-0 {
        margin-bottom: 0 !important;
    }

    .mb-xxl-1 {
        margin-bottom: 0.25rem !important;
    }

    .mb-xxl-2 {
        margin-bottom: 0.5rem !important;
    }

    .mb-xxl-3 {
        margin-bottom: 1rem !important;
    }

    .mb-xxl-4 {
        margin-bottom: 1.5rem !important;
    }

    .mb-xxl-5 {
        margin-bottom: 3rem !important;
    }

    .mb-xxl-6 {
        margin-bottom: 5rem !important;
    }

    .mb-xxl-7 {
        margin-bottom: 8rem !important;
    }

    .mb-xxl-8 {
        margin-bottom: 10rem !important;
    }

    .mb-xxl-9 {
        margin-bottom: 11rem !important;
    }

    .mb-xxl-10 {
        margin-bottom: 14rem !important;
    }

    .mb-xxl-11 {
        margin-bottom: 16rem !important;
    }

    .mb-xxl-12 {
        margin-bottom: 20rem !important;
    }

    .mb-xxl-sm {
        margin-bottom: 1rem !important;
    }

    .mb-xxl-md {
        margin-bottom: 2rem !important;
    }

    .mb-xxl-lg {
        margin-bottom: 4rem !important;
    }

    .mb-xxl-xl {
        margin-bottom: 8rem !important;
    }

    .mb-xxl-auto {
        margin-bottom: auto !important;
    }

    .ms-xxl-0 {
        margin-left: 0 !important;
    }

    .ms-xxl-1 {
        margin-left: 0.25rem !important;
    }

    .ms-xxl-2 {
        margin-left: 0.5rem !important;
    }

    .ms-xxl-3 {
        margin-left: 1rem !important;
    }

    .ms-xxl-4 {
        margin-left: 1.5rem !important;
    }

    .ms-xxl-5 {
        margin-left: 3rem !important;
    }

    .ms-xxl-6 {
        margin-left: 5rem !important;
    }

    .ms-xxl-7 {
        margin-left: 8rem !important;
    }

    .ms-xxl-8 {
        margin-left: 10rem !important;
    }

    .ms-xxl-9 {
        margin-left: 11rem !important;
    }

    .ms-xxl-10 {
        margin-left: 14rem !important;
    }

    .ms-xxl-11 {
        margin-left: 16rem !important;
    }

    .ms-xxl-12 {
        margin-left: 20rem !important;
    }

    .ms-xxl-sm {
        margin-left: 1rem !important;
    }

    .ms-xxl-md {
        margin-left: 2rem !important;
    }

    .ms-xxl-lg {
        margin-left: 4rem !important;
    }

    .ms-xxl-xl {
        margin-left: 8rem !important;
    }

    .ms-xxl-auto {
        margin-left: auto !important;
    }

    .m-xxl-n1 {
        margin: -0.25rem !important;
    }

    .m-xxl-n2 {
        margin: -0.5rem !important;
    }

    .m-xxl-n3 {
        margin: -1rem !important;
    }

    .m-xxl-n4 {
        margin: -1.5rem !important;
    }

    .m-xxl-n5 {
        margin: -3rem !important;
    }

    .m-xxl-n6 {
        margin: -5rem !important;
    }

    .m-xxl-n7 {
        margin: -8rem !important;
    }

    .m-xxl-n8 {
        margin: -10rem !important;
    }

    .m-xxl-n9 {
        margin: -11rem !important;
    }

    .m-xxl-n10 {
        margin: -14rem !important;
    }

    .m-xxl-n11 {
        margin: -16rem !important;
    }

    .m-xxl-n12 {
        margin: -20rem !important;
    }

    .m-xxl-nsm {
        margin: -1rem !important;
    }

    .m-xxl-nmd {
        margin: -2rem !important;
    }

    .m-xxl-nlg {
        margin: -4rem !important;
    }

    .m-xxl-nxl {
        margin: -8rem !important;
    }

    .mx-xxl-n1 {
        margin-right: -0.25rem !important;
        margin-left: -0.25rem !important;
    }

    .mx-xxl-n2 {
        margin-right: -0.5rem !important;
        margin-left: -0.5rem !important;
    }

    .mx-xxl-n3 {
        margin-right: -1rem !important;
        margin-left: -1rem !important;
    }

    .mx-xxl-n4 {
        margin-right: -1.5rem !important;
        margin-left: -1.5rem !important;
    }

    .mx-xxl-n5 {
        margin-right: -3rem !important;
        margin-left: -3rem !important;
    }

    .mx-xxl-n6 {
        margin-right: -5rem !important;
        margin-left: -5rem !important;
    }

    .mx-xxl-n7 {
        margin-right: -8rem !important;
        margin-left: -8rem !important;
    }

    .mx-xxl-n8 {
        margin-right: -10rem !important;
        margin-left: -10rem !important;
    }

    .mx-xxl-n9 {
        margin-right: -11rem !important;
        margin-left: -11rem !important;
    }

    .mx-xxl-n10 {
        margin-right: -14rem !important;
        margin-left: -14rem !important;
    }

    .mx-xxl-n11 {
        margin-right: -16rem !important;
        margin-left: -16rem !important;
    }

    .mx-xxl-n12 {
        margin-right: -20rem !important;
        margin-left: -20rem !important;
    }

    .mx-xxl-nsm {
        margin-right: -1rem !important;
        margin-left: -1rem !important;
    }

    .mx-xxl-nmd {
        margin-right: -2rem !important;
        margin-left: -2rem !important;
    }

    .mx-xxl-nlg {
        margin-right: -4rem !important;
        margin-left: -4rem !important;
    }

    .mx-xxl-nxl {
        margin-right: -8rem !important;
        margin-left: -8rem !important;
    }

    .my-xxl-n1 {
        margin-top: -0.25rem !important;
        margin-bottom: -0.25rem !important;
    }

    .my-xxl-n2 {
        margin-top: -0.5rem !important;
        margin-bottom: -0.5rem !important;
    }

    .my-xxl-n3 {
        margin-top: -1rem !important;
        margin-bottom: -1rem !important;
    }

    .my-xxl-n4 {
        margin-top: -1.5rem !important;
        margin-bottom: -1.5rem !important;
    }

    .my-xxl-n5 {
        margin-top: -3rem !important;
        margin-bottom: -3rem !important;
    }

    .my-xxl-n6 {
        margin-top: -5rem !important;
        margin-bottom: -5rem !important;
    }

    .my-xxl-n7 {
        margin-top: -8rem !important;
        margin-bottom: -8rem !important;
    }

    .my-xxl-n8 {
        margin-top: -10rem !important;
        margin-bottom: -10rem !important;
    }

    .my-xxl-n9 {
        margin-top: -11rem !important;
        margin-bottom: -11rem !important;
    }

    .my-xxl-n10 {
        margin-top: -14rem !important;
        margin-bottom: -14rem !important;
    }

    .my-xxl-n11 {
        margin-top: -16rem !important;
        margin-bottom: -16rem !important;
    }

    .my-xxl-n12 {
        margin-top: -20rem !important;
        margin-bottom: -20rem !important;
    }

    .my-xxl-nsm {
        margin-top: -1rem !important;
        margin-bottom: -1rem !important;
    }

    .my-xxl-nmd {
        margin-top: -2rem !important;
        margin-bottom: -2rem !important;
    }

    .my-xxl-nlg {
        margin-top: -4rem !important;
        margin-bottom: -4rem !important;
    }

    .my-xxl-nxl {
        margin-top: -8rem !important;
        margin-bottom: -8rem !important;
    }

    .mt-xxl-n1 {
        margin-top: -0.25rem !important;
    }

    .mt-xxl-n2 {
        margin-top: -0.5rem !important;
    }

    .mt-xxl-n3 {
        margin-top: -1rem !important;
    }

    .mt-xxl-n4 {
        margin-top: -1.5rem !important;
    }

    .mt-xxl-n5 {
        margin-top: -3rem !important;
    }

    .mt-xxl-n6 {
        margin-top: -5rem !important;
    }

    .mt-xxl-n7 {
        margin-top: -8rem !important;
    }

    .mt-xxl-n8 {
        margin-top: -10rem !important;
    }

    .mt-xxl-n9 {
        margin-top: -11rem !important;
    }

    .mt-xxl-n10 {
        margin-top: -14rem !important;
    }

    .mt-xxl-n11 {
        margin-top: -16rem !important;
    }

    .mt-xxl-n12 {
        margin-top: -20rem !important;
    }

    .mt-xxl-nsm {
        margin-top: -1rem !important;
    }

    .mt-xxl-nmd {
        margin-top: -2rem !important;
    }

    .mt-xxl-nlg {
        margin-top: -4rem !important;
    }

    .mt-xxl-nxl {
        margin-top: -8rem !important;
    }

    .me-xxl-n1 {
        margin-right: -0.25rem !important;
    }

    .me-xxl-n2 {
        margin-right: -0.5rem !important;
    }

    .me-xxl-n3 {
        margin-right: -1rem !important;
    }

    .me-xxl-n4 {
        margin-right: -1.5rem !important;
    }

    .me-xxl-n5 {
        margin-right: -3rem !important;
    }

    .me-xxl-n6 {
        margin-right: -5rem !important;
    }

    .me-xxl-n7 {
        margin-right: -8rem !important;
    }

    .me-xxl-n8 {
        margin-right: -10rem !important;
    }

    .me-xxl-n9 {
        margin-right: -11rem !important;
    }

    .me-xxl-n10 {
        margin-right: -14rem !important;
    }

    .me-xxl-n11 {
        margin-right: -16rem !important;
    }

    .me-xxl-n12 {
        margin-right: -20rem !important;
    }

    .me-xxl-nsm {
        margin-right: -1rem !important;
    }

    .me-xxl-nmd {
        margin-right: -2rem !important;
    }

    .me-xxl-nlg {
        margin-right: -4rem !important;
    }

    .me-xxl-nxl {
        margin-right: -8rem !important;
    }

    .mb-xxl-n1 {
        margin-bottom: -0.25rem !important;
    }

    .mb-xxl-n2 {
        margin-bottom: -0.5rem !important;
    }

    .mb-xxl-n3 {
        margin-bottom: -1rem !important;
    }

    .mb-xxl-n4 {
        margin-bottom: -1.5rem !important;
    }

    .mb-xxl-n5 {
        margin-bottom: -3rem !important;
    }

    .mb-xxl-n6 {
        margin-bottom: -5rem !important;
    }

    .mb-xxl-n7 {
        margin-bottom: -8rem !important;
    }

    .mb-xxl-n8 {
        margin-bottom: -10rem !important;
    }

    .mb-xxl-n9 {
        margin-bottom: -11rem !important;
    }

    .mb-xxl-n10 {
        margin-bottom: -14rem !important;
    }

    .mb-xxl-n11 {
        margin-bottom: -16rem !important;
    }

    .mb-xxl-n12 {
        margin-bottom: -20rem !important;
    }

    .mb-xxl-nsm {
        margin-bottom: -1rem !important;
    }

    .mb-xxl-nmd {
        margin-bottom: -2rem !important;
    }

    .mb-xxl-nlg {
        margin-bottom: -4rem !important;
    }

    .mb-xxl-nxl {
        margin-bottom: -8rem !important;
    }

    .ms-xxl-n1 {
        margin-left: -0.25rem !important;
    }

    .ms-xxl-n2 {
        margin-left: -0.5rem !important;
    }

    .ms-xxl-n3 {
        margin-left: -1rem !important;
    }

    .ms-xxl-n4 {
        margin-left: -1.5rem !important;
    }

    .ms-xxl-n5 {
        margin-left: -3rem !important;
    }

    .ms-xxl-n6 {
        margin-left: -5rem !important;
    }

    .ms-xxl-n7 {
        margin-left: -8rem !important;
    }

    .ms-xxl-n8 {
        margin-left: -10rem !important;
    }

    .ms-xxl-n9 {
        margin-left: -11rem !important;
    }

    .ms-xxl-n10 {
        margin-left: -14rem !important;
    }

    .ms-xxl-n11 {
        margin-left: -16rem !important;
    }

    .ms-xxl-n12 {
        margin-left: -20rem !important;
    }

    .ms-xxl-nsm {
        margin-left: -1rem !important;
    }

    .ms-xxl-nmd {
        margin-left: -2rem !important;
    }

    .ms-xxl-nlg {
        margin-left: -4rem !important;
    }

    .ms-xxl-nxl {
        margin-left: -8rem !important;
    }

    .p-xxl-0 {
        padding: 0 !important;
    }

    .p-xxl-1 {
        padding: 0.25rem !important;
    }

    .p-xxl-2 {
        padding: 0.5rem !important;
    }

    .p-xxl-3 {
        padding: 1rem !important;
    }

    .p-xxl-4 {
        padding: 1.5rem !important;
    }

    .p-xxl-5 {
        padding: 3rem !important;
    }

    .p-xxl-6 {
        padding: 5rem !important;
    }

    .p-xxl-7 {
        padding: 8rem !important;
    }

    .p-xxl-8 {
        padding: 10rem !important;
    }

    .p-xxl-9 {
        padding: 11rem !important;
    }

    .p-xxl-10 {
        padding: 14rem !important;
    }

    .p-xxl-11 {
        padding: 16rem !important;
    }

    .p-xxl-12 {
        padding: 20rem !important;
    }

    .p-xxl-sm {
        padding: 1rem !important;
    }

    .p-xxl-md {
        padding: 2rem !important;
    }

    .p-xxl-lg {
        padding: 4rem !important;
    }

    .p-xxl-xl {
        padding: 8rem !important;
    }

    .px-xxl-0 {
        padding-right: 0 !important;
        padding-left: 0 !important;
    }

    .px-xxl-1 {
        padding-right: 0.25rem !important;
        padding-left: 0.25rem !important;
    }

    .px-xxl-2 {
        padding-right: 0.5rem !important;
        padding-left: 0.5rem !important;
    }

    .px-xxl-3 {
        padding-right: 1rem !important;
        padding-left: 1rem !important;
    }

    .px-xxl-4 {
        padding-right: 1.5rem !important;
        padding-left: 1.5rem !important;
    }

    .px-xxl-5 {
        padding-right: 3rem !important;
        padding-left: 3rem !important;
    }

    .px-xxl-6 {
        padding-right: 5rem !important;
        padding-left: 5rem !important;
    }

    .px-xxl-7 {
        padding-right: 8rem !important;
        padding-left: 8rem !important;
    }

    .px-xxl-8 {
        padding-right: 10rem !important;
        padding-left: 10rem !important;
    }

    .px-xxl-9 {
        padding-right: 11rem !important;
        padding-left: 11rem !important;
    }

    .px-xxl-10 {
        padding-right: 14rem !important;
        padding-left: 14rem !important;
    }

    .px-xxl-11 {
        padding-right: 16rem !important;
        padding-left: 16rem !important;
    }

    .px-xxl-12 {
        padding-right: 20rem !important;
        padding-left: 20rem !important;
    }

    .px-xxl-sm {
        padding-right: 1rem !important;
        padding-left: 1rem !important;
    }

    .px-xxl-md {
        padding-right: 2rem !important;
        padding-left: 2rem !important;
    }

    .px-xxl-lg {
        padding-right: 4rem !important;
        padding-left: 4rem !important;
    }

    .px-xxl-xl {
        padding-right: 8rem !important;
        padding-left: 8rem !important;
    }

    .py-xxl-0 {
        padding-top: 0 !important;
        padding-bottom: 0 !important;
    }

    .py-xxl-1 {
        padding-top: 0.25rem !important;
        padding-bottom: 0.25rem !important;
    }

    .py-xxl-2 {
        padding-top: 0.5rem !important;
        padding-bottom: 0.5rem !important;
    }

    .py-xxl-3 {
        padding-top: 1rem !important;
        padding-bottom: 1rem !important;
    }

    .py-xxl-4 {
        padding-top: 1.5rem !important;
        padding-bottom: 1.5rem !important;
    }

    .py-xxl-5 {
        padding-top: 3rem !important;
        padding-bottom: 3rem !important;
    }

    .py-xxl-6 {
        padding-top: 5rem !important;
        padding-bottom: 5rem !important;
    }

    .py-xxl-7 {
        padding-top: 8rem !important;
        padding-bottom: 8rem !important;
    }

    .py-xxl-8 {
        padding-top: 10rem !important;
        padding-bottom: 10rem !important;
    }

    .py-xxl-9 {
        padding-top: 11rem !important;
        padding-bottom: 11rem !important;
    }

    .py-xxl-10 {
        padding-top: 14rem !important;
        padding-bottom: 14rem !important;
    }

    .py-xxl-11 {
        padding-top: 16rem !important;
        padding-bottom: 16rem !important;
    }

    .py-xxl-12 {
        padding-top: 20rem !important;
        padding-bottom: 20rem !important;
    }

    .py-xxl-sm {
        padding-top: 1rem !important;
        padding-bottom: 1rem !important;
    }

    .py-xxl-md {
        padding-top: 2rem !important;
        padding-bottom: 2rem !important;
    }

    .py-xxl-lg {
        padding-top: 4rem !important;
        padding-bottom: 4rem !important;
    }

    .py-xxl-xl {
        padding-top: 8rem !important;
        padding-bottom: 8rem !important;
    }

    .pt-xxl-0 {
        padding-top: 0 !important;
    }

    .pt-xxl-1 {
        padding-top: 0.25rem !important;
    }

    .pt-xxl-2 {
        padding-top: 0.5rem !important;
    }

    .pt-xxl-3 {
        padding-top: 1rem !important;
    }

    .pt-xxl-4 {
        padding-top: 1.5rem !important;
    }

    .pt-xxl-5 {
        padding-top: 3rem !important;
    }

    .pt-xxl-6 {
        padding-top: 5rem !important;
    }

    .pt-xxl-7 {
        padding-top: 8rem !important;
    }

    .pt-xxl-8 {
        padding-top: 10rem !important;
    }

    .pt-xxl-9 {
        padding-top: 11rem !important;
    }

    .pt-xxl-10 {
        padding-top: 14rem !important;
    }

    .pt-xxl-11 {
        padding-top: 16rem !important;
    }

    .pt-xxl-12 {
        padding-top: 20rem !important;
    }

    .pt-xxl-sm {
        padding-top: 1rem !important;
    }

    .pt-xxl-md {
        padding-top: 2rem !important;
    }

    .pt-xxl-lg {
        padding-top: 4rem !important;
    }

    .pt-xxl-xl {
        padding-top: 8rem !important;
    }

    .pe-xxl-0 {
        padding-right: 0 !important;
    }

    .pe-xxl-1 {
        padding-right: 0.25rem !important;
    }

    .pe-xxl-2 {
        padding-right: 0.5rem !important;
    }

    .pe-xxl-3 {
        padding-right: 1rem !important;
    }

    .pe-xxl-4 {
        padding-right: 1.5rem !important;
    }

    .pe-xxl-5 {
        padding-right: 3rem !important;
    }

    .pe-xxl-6 {
        padding-right: 5rem !important;
    }

    .pe-xxl-7 {
        padding-right: 8rem !important;
    }

    .pe-xxl-8 {
        padding-right: 10rem !important;
    }

    .pe-xxl-9 {
        padding-right: 11rem !important;
    }

    .pe-xxl-10 {
        padding-right: 14rem !important;
    }

    .pe-xxl-11 {
        padding-right: 16rem !important;
    }

    .pe-xxl-12 {
        padding-right: 20rem !important;
    }

    .pe-xxl-sm {
        padding-right: 1rem !important;
    }

    .pe-xxl-md {
        padding-right: 2rem !important;
    }

    .pe-xxl-lg {
        padding-right: 4rem !important;
    }

    .pe-xxl-xl {
        padding-right: 8rem !important;
    }

    .pb-xxl-0 {
        padding-bottom: 0 !important;
    }

    .pb-xxl-1 {
        padding-bottom: 0.25rem !important;
    }

    .pb-xxl-2 {
        padding-bottom: 0.5rem !important;
    }

    .pb-xxl-3 {
        padding-bottom: 1rem !important;
    }

    .pb-xxl-4 {
        padding-bottom: 1.5rem !important;
    }

    .pb-xxl-5 {
        padding-bottom: 3rem !important;
    }

    .pb-xxl-6 {
        padding-bottom: 5rem !important;
    }

    .pb-xxl-7 {
        padding-bottom: 8rem !important;
    }

    .pb-xxl-8 {
        padding-bottom: 10rem !important;
    }

    .pb-xxl-9 {
        padding-bottom: 11rem !important;
    }

    .pb-xxl-10 {
        padding-bottom: 14rem !important;
    }

    .pb-xxl-11 {
        padding-bottom: 16rem !important;
    }

    .pb-xxl-12 {
        padding-bottom: 20rem !important;
    }

    .pb-xxl-sm {
        padding-bottom: 1rem !important;
    }

    .pb-xxl-md {
        padding-bottom: 2rem !important;
    }

    .pb-xxl-lg {
        padding-bottom: 4rem !important;
    }

    .pb-xxl-xl {
        padding-bottom: 8rem !important;
    }

    .ps-xxl-0 {
        padding-left: 0 !important;
    }

    .ps-xxl-1 {
        padding-left: 0.25rem !important;
    }

    .ps-xxl-2 {
        padding-left: 0.5rem !important;
    }

    .ps-xxl-3 {
        padding-left: 1rem !important;
    }

    .ps-xxl-4 {
        padding-left: 1.5rem !important;
    }

    .ps-xxl-5 {
        padding-left: 3rem !important;
    }

    .ps-xxl-6 {
        padding-left: 5rem !important;
    }

    .ps-xxl-7 {
        padding-left: 8rem !important;
    }

    .ps-xxl-8 {
        padding-left: 10rem !important;
    }

    .ps-xxl-9 {
        padding-left: 11rem !important;
    }

    .ps-xxl-10 {
        padding-left: 14rem !important;
    }

    .ps-xxl-11 {
        padding-left: 16rem !important;
    }

    .ps-xxl-12 {
        padding-left: 20rem !important;
    }

    .ps-xxl-sm {
        padding-left: 1rem !important;
    }

    .ps-xxl-md {
        padding-left: 2rem !important;
    }

    .ps-xxl-lg {
        padding-left: 4rem !important;
    }

    .ps-xxl-xl {
        padding-left: 8rem !important;
    }

    .text-xxl-start {
        text-align: left !important;
    }

    .text-xxl-end {
        text-align: right !important;
    }

    .text-xxl-center {
        text-align: center !important;
    }
}

@media (min-width: 1200px) {
    .fs-1 {
        font-size: 2.5rem !important;
    }

    .fs-2 {
        font-size: 2rem !important;
    }

    .fs-3 {
        font-size: 1.75rem !important;
    }

    .fs-4 {
        font-size: 1.5rem !important;
    }
}

@media print {
    .d-print-inline {
        display: inline !important;
    }

    .d-print-inline-block {
        display: inline-block !important;
    }

    .d-print-block {
        display: block !important;
    }

    .d-print-grid {
        display: grid !important;
    }

    .d-print-table {
        display: table !important;
    }

    .d-print-table-row {
        display: table-row !important;
    }

    .d-print-table-cell {
        display: table-cell !important;
    }

    .d-print-flex {
        display: flex !important;
    }

    .d-print-inline-flex {
        display: inline-flex !important;
    }

    .d-print-none {
        display: none !important;
    }
}
/**
 * = Navigation bars
 */
.navbar-main {
    position: absolute;
    top: 0;
    width: 100%;
    z-index: 100;
}

.navbar-main .navbar-toggler-icon {
    background-image: url("data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'><path stroke='rgba(255, 255, 255, 0.9)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/></svg>");
}

.navbar .navbar-nav .nav-link {
    transition: all 0.8s all 0.2s ease;
}

@media (max-width: 767.98px) {
    .navbar .navbar-nav .nav-link {
        font-size: 1.2rem;
        display: flex;
        -moz-justify-content: space-between;
        -ms-justify-content: space-between;
        justify-content: space-between;
        -ms-flex-pack: space-between;
        -moz-align-items: center;
        -ms-align-items: center;
        align-items: center;
    }
}

.navbar .navbar-nav .nav-item .media:not(:last-child) {
    margin-bottom: 1.5rem;
}

.navbar .navbar-nav .nav-item:focus,
.navbar .navbar-nav .nav-item .nav-link:focus {
    outline: none !important;
}

.navbar .navbar-nav .dropdown .dropdown-menu {
    top: 100%;
}

.navbar .navbar-nav .dropdown .dropdown-menu span {
    width: 30px;
}

.navbar .navbar-nav .dropdown .dropdown-item {
    font-size: 0.875rem;
}

@media (min-width: 992px) {
    .navbar .navbar-nav .dropdown-megamenu,
.navbar .navbar-nav .dropdown-megamenu-sm,
.navbar .navbar-nav .dropdown-megamenu-md {
        min-width: 580px;
    }
}

.navbar .navbar-nav .dropdown-megamenu .megamenu-link,
.navbar .navbar-nav .dropdown-megamenu-sm .megamenu-link,
.navbar .navbar-nav .dropdown-megamenu-md .megamenu-link {
    color: #111827;
    font-weight: 400;
    font-size: 0.875rem;
}

.navbar .navbar-nav .dropdown-megamenu .megamenu-item,
.navbar .navbar-nav .dropdown-megamenu-sm .megamenu-item,
.navbar .navbar-nav .dropdown-megamenu-md .megamenu-item {
    position: relative;
}

.navbar .navbar-nav .dropdown-megamenu .megamenu-item:hover .megamenu-link,
.navbar .navbar-nav .dropdown-megamenu-sm .megamenu-item:hover .megamenu-link,
.navbar .navbar-nav .dropdown-megamenu-md .megamenu-item:hover .megamenu-link {
    color: #1F2937;
}

@media (min-width: 992px) {
    .navbar .navbar-nav .dropdown-megamenu-sm {
        min-width: 320px;
    }
}

@media (min-width: 992px) {
    .navbar .navbar-nav .dropdown-megamenu-md {
        min-width: 960px;
    }
}

@media (min-width: 992px) {
    .navbar .navbar-nav .dropdown-menu .dropdown-toggle .nav-link-arrow {
        transform: rotate(-90deg);
    }

    .navbar .navbar-nav .dropdown.show > .dropdown-toggle .nav-link-arrow {
        transform: rotate(180deg);
    }

    .navbar .navbar-nav .dropdown-toggle:hover .nav-link-arrow {
        transform: rotate(0deg);
    }
}

.navbar .navbar-nav .dropdown-submenu {
    position: relative;
}

.navbar .navbar-nav .dropdown-submenu .dropdown-menu {
    top: 0;
    left: calc(100% - 2px);
    margin-left: 0.1rem;
    margin-right: 0.1rem;
    opacity: 0;
    display: none;
}

.navbar .navbar-nav .dropdown-submenu .dropdown-menu.show {
    opacity: 1;
    pointer-events: all;
    display: block;
}

.navbar .navbar-nav .nav-link-arrow {
    transition: transform 0.2s ease;
}

.navbar-brand {
    font-size: 0.875rem;
    font-weight: 500;
    text-transform: uppercase;
}

.navbar-brand img {
    height: 40px;
}

.navbar-dark .navbar-brand-light {
    display: none;
}

.navbar-dark .navbar-brand {
    color: #ffffff;
}

.navbar-dark > .nav-item:hover > .nav-link {
    color: #1F2937;
}

.navbar-light:not(.headroom--not-top) .btn-outline-soft {
    border-color: #1F2937;
    color: #1F2937;
}

.navbar-light:not(.headroom--not-top) .btn-outline-soft:hover {
    background: #1F2937;
    color: #ffffff;
}

.navbar-light .navbar-toggler-icon {
    background-image: url("data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'><path stroke='rgba(17, 24, 39, 0.9)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/></svg>");
}

.navbar-light .navbar-brand-dark {
    display: none;
}

.navbar-light .navbar-brand {
    color: #1F2937;
}

.dropdown-menu {
    top: 100%;
}

.dropdown-menu span {
    width: 30px;
}

.navbar-transparent {
    background-color: transparent;
    border: 0;
    box-shadow: none;
}

@media (min-width: 992px) {
    .navbar-nav .nav-item [data-toggle=dropdown]::after {
        transition: all 0.2s ease;
    }

    .navbar-nav .nav-item.show [data-toggle=dropdown]::after {
        transform: rotate(180deg);
    }

    .navbar-nav .nav-link i {
        margin-right: 0.3rem;
        font-size: 0.75rem;
    }

    .navbar-nav .nav-link-icon {
        padding-left: 0.5rem;
        padding-right: 0.5rem;
        font-size: 1rem;
    }

    .navbar-nav .nav-link-icon i {
        margin-right: 0;
    }

    .navbar-nav .dropdown-menu {
        opacity: 0;
        pointer-events: none;
        margin: 0;
        border-radius: 0.35rem;
    }

    .navbar-nav .dropdown-menu-end:before {
        right: 20px;
        left: auto;
    }

    .navbar-nav .dropdown-menu-center {
        left: 50%;
        transform: translateX(-50%);
    }

    .navbar-nav .dropdown-menu.show,
.navbar-nav .dropdown-megamenu.show,
.navbar-nav .dropdown-megamenu-md.show {
        opacity: 1;
        pointer-events: auto;
    }

    .navbar-nav .dropdown-menu.close,
.navbar-nav .dropdown-megamenu.close,
.navbar-nav .dropdown-megamenu-md.close {
        display: block;
    }

    .navbar-nav .dropdown-submenu .dropdown-menu {
        transform: none;
    }

    .navbar-nav .dropdown-menu {
        position: relative;
        display: block;
        opacity: 0;
        pointer-events: none;
        transition: all 0.2s ease;
    }

    .navbar-nav .dropdown.show > .dropdown-menu,
.navbar-nav .dropdown-submenu.show > .dropdown-menu {
        display: block;
        opacity: 1;
        pointer-events: auto;
    }

    .navbar-nav .dropdown-menu-inner {
        position: relative;
        padding: 1rem;
    }

    .navbar-transparent .navbar-nav .nav-link.disabled {
        color: rgba(255, 255, 255, 0.9);
    }

    .navbar-transparent .navbar-brand {
        color: rgba(255, 255, 255, 0.9);
    }
}

.navbar-collapse-header {
    display: none;
}

.navbar-collapse {
    width: auto;
}

@media (max-width: 991.98px) {
    .navbar-nav .nav-link {
        padding: 0.625rem 0;
    }

    .navbar-nav .dropdown-menu {
        box-shadow: none;
        width: 100%;
    }

    .navbar-nav .dropdown-menu .media svg {
        width: 30px;
    }

    .dropdown-menu-center {
        right: 0;
        left: auto;
        transform: translate(0, 0);
    }
}

@media (max-width: 991.98px) and (max-width: 991.98px) {
    .dropdown-menu-center {
        transform: translateX(-75%);
    }
}

@media (max-width: 991.98px) {
    .navbar-collapse {
        width: calc(100% - 30px);
        position: absolute;
        top: 0;
        right: 15px;
        z-index: 1050;
        overflow-y: auto;
        height: calc(100vh - 30px) !important;
        opacity: 0;
    }

    .navbar-collapse .navbar-toggler {
        position: relative;
        display: inline-block;
        width: 20px;
        height: 20px;
        padding: 0;
    }

    .navbar-collapse .navbar-toggler span {
        display: block;
        position: absolute;
        width: 100%;
        height: 2px;
        border-radius: 2px;
        opacity: 1;
        background: #283448;
    }

    .navbar-collapse .navbar-collapse-header {
        display: block;
        padding-bottom: 1rem;
        margin-bottom: 1rem;
    }

    .navbar-collapse .collapse-brand img {
        height: 35px;
    }

    .navbar-collapse .collapse-close {
        text-align: right;
    }
}

@media (max-width: 991.98px) {
    .navbar-collapse.collapsing,
.navbar-collapse.show {
        padding: 1.5rem;
        border-radius: 0.35rem;
        background: #ffffff;
        animation: show-navbar-collapse 0.2s ease forwards;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }
}

@media (max-width: 991.98px) {
    .navbar-collapse.collapsing-out {
        animation: hide-navbar-collapse 0.2s ease forwards;
    }
}

.navbar-dashboard {
    border-radius: 0.5rem;
}

.navbar-theme-primary:not(.headroom) {
    background-color: #1F2937;
}

/**
 * = Sections
 */
.section {
    position: relative;
    padding-top: 3rem;
    padding-bottom: 3rem;
}

.section-header {
    position: relative;
    padding-top: 9rem;
    padding-bottom: 3rem;
}

@media (min-width: 576px) {
    .section {
        position: relative;
        padding-top: 5rem;
        padding-bottom: 5rem;
    }

    .section-header {
        position: relative;
        padding-top: 8rem;
        padding-bottom: 8rem;
    }

    .section-header.section-sm {
        padding-top: 4rem;
        padding-bottom: 3rem;
    }

    .section-xl {
        padding-top: 8rem;
        padding-bottom: 8rem;
    }

    .section-lg {
        padding-top: 6rem;
        padding-bottom: 6rem;
    }

    .section-sm {
        padding-top: 3rem;
        padding-bottom: 3rem;
    }
}

@media (min-width: 992px) {
    .section {
        position: relative;
        padding-top: 6rem;
        padding-bottom: 6rem;
    }

    .section-header {
        position: relative;
        padding-top: 10rem;
        padding-bottom: 10rem;
    }

    .section-header.section-sm {
        padding-top: 4rem;
        padding-bottom: 3rem;
    }

    .section-xl {
        padding-top: 10rem;
        padding-bottom: 10rem;
    }

    .section-lg {
        padding-top: 8rem;
        padding-bottom: 8rem;
    }

    .section-sm {
        padding-top: 4rem;
        padding-bottom: 4rem;
    }
}

@media (min-width: 768px) {
    .section-hero {
        height: 100vh;
    }
}

.line-bottom::after {
    content: "";
    display: block;
    width: 80%;
    position: absolute;
    bottom: 0;
    left: 50%;
    margin-left: -40%;
    height: 1px;
    background: radial-gradient(ellipse at center, #9CA3AF 0, rgba(255, 255, 255, 0) 80%);
}

.section-profile-cover {
    height: 580px;
    background-size: cover;
    background-position: center center;
}

@media (max-width: 767.98px) {
    .section-profile-cover {
        height: 400px;
    }
}

.components-section > .form-control + .form-control {
    margin-top: 0.5rem;
}

.components-section > .nav + .nav,
.components-section > .alert + .alert,
.components-section > .navbar + .navbar,
.components-section > .progress + .progress,
.components-section > .progress + .btn,
.components-section .badge,
.components-section .btn {
    margin-top: 0.5rem;
    margin-bottom: 0.5rem;
}

.components-section .btn-group {
    margin-top: 0.5rem;
    margin-bottom: 0.5rem;
}

.components-section .btn-group .btn {
    margin: 0;
}

.components-section .alert {
    margin: 0;
}

.components-section .alert + .alert {
    margin-top: 1.25rem;
}

.components-section .badge {
    margin-right: 0.5rem;
}

.components-section .modal-footer .btn {
    margin: 0;
}

.copy-docs {
    position: absolute;
    top: 5px;
    right: 5px;
    transition: all 0.2s ease;
}

.copy-docs.copied {
    background: #10B981;
}

.copy-docs:hover {
    cursor: pointer;
}

.kanban-container {
    overflow-x: scroll;
    -webkit-overflow-scrolling: touch;
}

/**
 * = Footers
 */
.footer ul {
    margin-bottom: 0;
    padding: 0;
    list-style: none;
}

.footer ul li {
    display: inline-block;
}

.footer ul li a {
    text-decoration: none;
    position: relative;
    display: block;
    color: #374151;
}

.footer ul li a:hover {
    color: #1F2937;
}

.footer ul li .btn {
    margin: 0;
}

.footer ul.links-horizontal:first-child a {
    padding-left: 0;
}

.footer ul.links-horizontal:last-child a {
    padding-right: 0;
}

.footer ul.links-vertical li {
    display: block;
    margin-left: -5px;
    margin-right: -5px;
}

.footer ul.links-vertical li a {
    padding: 5px;
}

.footer ul.links-vertical li a:hover {
    color: inherit !important;
}

.footer ul.icon-box i {
    line-height: 1.7;
}

.footer .social-buttons a,
.footer .social-buttons .btn {
    margin-top: 5px;
    margin-bottom: 5px;
    padding: 0.125rem 0.375rem;
}

.footer .footer-brand {
    font-size: 1.25rem;
    font-weight: 500;
}

.footer .footer-brand img.common {
    height: 40px;
}

.footer .footer-brand img {
    height: 40px;
    width: 40px;
}

.footer .footer-brand:hover, .footer .footer-brand:focus {
    color: #111827;
}

.footer .footer-language-link {
    font-size: 0.875rem;
}

.footer .footer-language-link i {
    font-size: 0.75rem;
}

.footer .copyright {
    font-size: 0.875rem;
}

.footer .pull-center {
    display: inline-block;
    float: none;
}

/**
 * = Sidebars
 */
#doc-index:not(.collapse.show), .doc-sidebar {
    display: none;
}

@media (min-width: 992px) {
    #doc-index {
        display: block;
    }

    .doc-sidebar {
        display: block;
        height: calc(100vh - 2rem);
        overflow-y: scroll;
        position: sticky;
        top: 2rem;
    }

    .doc-sidebar .nav-link[data-toggle=collapse] > .icon {
        transform: rotateZ(-90deg);
        position: relative;
        right: 0.25rem;
    }

    .doc-sidebar .nav .nav-item {
        font-size: 0.875rem;
    }
}
/*
 * Sidebar
*/
.sidebar {
    display: block;
    position: fixed;
    top: 0;
    bottom: 0;
    left: 0;
    z-index: 100;
    max-height: 100%;
    overflow-y: auto;
    width: 100%;
    transition: max-width 0.1s;
}

@media (prefers-reduced-motion: reduce) {
    .sidebar {
        transition: none;
    }
}

@media (min-width: 768px) {
    .sidebar {
        width: 100%;
        max-width: 260px;
    }
}

.sidebar .nav {
    white-space: nowrap;
}

.sidebar .nav-item {
    margin-bottom: 0.2rem;
}

.sidebar .nav-item.active > .nav-link {
    color: #F2F4F6;
    background-color: #374151;
}

.sidebar .nav-item .nav-link {
    color: #ffffff;
    cursor: pointer;
}

.sidebar .nav-item .nav-link:hover {
    color: #F2F4F6;
    background-color: #374151;
}

.sidebar .nav-link + .multi-level {
    margin-top: 0.2rem;
}

.sidebar .nav-link {
    font-size: 1rem;
    vertical-align: middle;
    padding: 0.55rem 0.75rem;
    border-radius: 0.5rem;
}

.sidebar .nav-link .sidebar-icon {
    margin-right: 0.5rem;
    color: #9CA3AF;
}

.sidebar .nav-link .link-arrow {
    font-size: 0.875rem;
}

.sidebar .nav-link[data-bs-toggle=collapse][aria-expanded=true] .link-arrow {
    transform: rotate(90deg);
    transition: all 0.2s ease;
}

.sidebar .nav-link.active {
    color: #F2F4F6;
}

.sidebar .multi-level .nav-link {
    padding-left: 53px;
}

.sidebar .sidebar-text,
.sidebar .link-arrow,
.sidebar .badge,
.sidebar .notification-count {
    opacity: 1;
}

.sidebar .sidebar-text-contracted {
    display: none;
}

.sidebar.contracted {
    max-width: 95px;
}

.sidebar.contracted .sidebar-text,
.sidebar.contracted .link-arrow,
.sidebar.contracted .badge {
    opacity: 0;
}

.sidebar.contracted .notification-count {
    opacity: 1;
    position: absolute;
    top: 0;
    left: 40px;
    width: 18px;
    height: 18px;
    border-radius: 50%;
    font-size: 0.7rem;
    padding: 0.2rem;
}

.sidebar.contracted .nav-item {
    position: relative;
}

.sidebar.contracted .nav-item.active > .nav-link {
    background-color: #363c54;
    width: 44px;
}

.sidebar.contracted .nav-item .nav-link:hover {
    background-color: #1F2937;
}

.sidebar.contracted .sidebar-text-contracted {
    display: inline;
}

.sidebar.contracted .multi-level .nav-link {
    padding-left: 17px;
}

.sidebar.contracted .nav-item {
    white-space: nowrap;
}

.sidebar.contracted .sidebar-icon {
    text-align: center;
}

@media (min-width: 768px) {
    .sidebar.contracted + .content {
        margin-left: 95px;
    }
}

.sidebar-inner {
    position: relative;
    overflow-y: hidden;
}

.sidebar-heading {
    font-size: 0.75rem;
    text-transform: uppercase;
}

.user-card {
    border-bottom: 0.0625rem solid #2e3650;
}

@media (max-width: 575.98px) {
    .sidebar {
        width: 100%;
    }
}

.content {
    overflow: hidden;
    padding: 0 1rem 0 1rem;
    transition: all 0.3s;
}

@media (prefers-reduced-motion: reduce) {
    .content {
        transition: none;
    }
}

@media (min-width: 992px) {
    .content {
        margin-left: 260px;
    }
}

.sidebar-toggle {
    font-size: 1.3rem;
}

.sidebar-toggle:hover, .sidebar-toggle:focus {
    outline: none;
    box-shadow: none;
    background: #D1D5DB;
}

iframe {
    border: 0;
}

figcaption,
figure,
main {
    display: block;
    margin: 0;
}

main {
    overflow: hidden;
}

img {
    max-width: 100%;
}

strong {
    font-weight: 500;
}

button:focus {
    outline: 0;
}

label {
    font-weight: 500;
    margin-bottom: 0.5rem;
}

/**
 * = Accordions
*/
.accordion-button {
    text-align: left;
}

.accordion-button:not(.collapsed)::after {
    background-image: none;
    transform: rotateZ(45deg);
}

.accordion-button::after {
    background-image: none;
    content: "\f067";
    font-family: "Font Awesome 5 Free";
    font-size: 1rem;
    font-weight: 900;
}

.accordion-button:hover {
    background-color: #E5E7EB;
}

.accordion-flush .accordion-button {
    background-color: transparent;
}

.accordion-flush .accordion-button:not(.collapsed) {
    color: #31316A;
}

.accordion-flush .accordion-button:focus {
    border-color: #D1D5DB;
    box-shadow: none;
}

.accordion-flush .accordion-collapse {
    border: 0;
}

/**
 * = Animations
 */
.animate-up-1,
.animate-right-1,
.animate-down-1,
.animate-left-1,
.scale-up-1,
.scale-down-1 {
    transition: all 0.2s ease;
}

.scale-up-1:hover {
    transform: scale(0.5555555556);
}

.scale-up-hover-1:hover .scale {
    transform: scale(0.5555555556);
}

.scale-down-1:hover {
    transform: scale(0.4);
}

.animate-up-1:hover, .animate-hover:hover .animate-up-1 {
    transform: translate(0, -1px);
}

.animate-right-1:hover, .animate-hover:hover .animate-right-1 {
    transform: translate(1px, 0);
}

.animate-down-1:hover, .animate-hover:hover .animate-down-1 {
    transform: translate(0, 1px);
}

.animate-left-1:hover, .animate-hover:hover .animate-left-1 {
    transform: translate(-1px, 0);
}

.animate-up-2,
.animate-right-2,
.animate-down-2,
.animate-left-2,
.scale-up-2,
.scale-down-2 {
    transition: all 0.2s ease;
}

.scale-up-2:hover {
    transform: scale(1.1111111112);
}

.scale-up-hover-2:hover .scale {
    transform: scale(1.1111111112);
}

.scale-down-2:hover {
    transform: scale(0.8);
}

.animate-up-2:hover, .animate-hover:hover .animate-up-2 {
    transform: translate(0, -2px);
}

.animate-right-2:hover, .animate-hover:hover .animate-right-2 {
    transform: translate(2px, 0);
}

.animate-down-2:hover, .animate-hover:hover .animate-down-2 {
    transform: translate(0, 2px);
}

.animate-left-2:hover, .animate-hover:hover .animate-left-2 {
    transform: translate(-2px, 0);
}

.animate-up-3,
.animate-right-3,
.animate-down-3,
.animate-left-3,
.scale-up-3,
.scale-down-3 {
    transition: all 0.2s ease;
}

.scale-up-3:hover {
    transform: scale(1.6666666668);
}

.scale-up-hover-3:hover .scale {
    transform: scale(1.6666666668);
}

.scale-down-3:hover {
    transform: scale(1.2);
}

.animate-up-3:hover, .animate-hover:hover .animate-up-3 {
    transform: translate(0, -3px);
}

.animate-right-3:hover, .animate-hover:hover .animate-right-3 {
    transform: translate(3px, 0);
}

.animate-down-3:hover, .animate-hover:hover .animate-down-3 {
    transform: translate(0, 3px);
}

.animate-left-3:hover, .animate-hover:hover .animate-left-3 {
    transform: translate(-3px, 0);
}

.animate-up-4,
.animate-right-4,
.animate-down-4,
.animate-left-4,
.scale-up-4,
.scale-down-4 {
    transition: all 0.2s ease;
}

.scale-up-4:hover {
    transform: scale(2.2222222224);
}

.scale-up-hover-4:hover .scale {
    transform: scale(2.2222222224);
}

.scale-down-4:hover {
    transform: scale(1.6);
}

.animate-up-4:hover, .animate-hover:hover .animate-up-4 {
    transform: translate(0, -4px);
}

.animate-right-4:hover, .animate-hover:hover .animate-right-4 {
    transform: translate(4px, 0);
}

.animate-down-4:hover, .animate-hover:hover .animate-down-4 {
    transform: translate(0, 4px);
}

.animate-left-4:hover, .animate-hover:hover .animate-left-4 {
    transform: translate(-4px, 0);
}

.animate-up-5,
.animate-right-5,
.animate-down-5,
.animate-left-5,
.scale-up-5,
.scale-down-5 {
    transition: all 0.2s ease;
}

.scale-up-5:hover {
    transform: scale(2.777777778);
}

.scale-up-hover-5:hover .scale {
    transform: scale(2.777777778);
}

.scale-down-5:hover {
    transform: scale(2);
}

.animate-up-5:hover, .animate-hover:hover .animate-up-5 {
    transform: translate(0, -5px);
}

.animate-right-5:hover, .animate-hover:hover .animate-right-5 {
    transform: translate(5px, 0);
}

.animate-down-5:hover, .animate-hover:hover .animate-down-5 {
    transform: translate(0, 5px);
}

.animate-left-5:hover, .animate-hover:hover .animate-left-5 {
    transform: translate(-5px, 0);
}

.animate-up-6,
.animate-right-6,
.animate-down-6,
.animate-left-6,
.scale-up-6,
.scale-down-6 {
    transition: all 0.2s ease;
}

.scale-up-6:hover {
    transform: scale(3.3333333336);
}

.scale-up-hover-6:hover .scale {
    transform: scale(3.3333333336);
}

.scale-down-6:hover {
    transform: scale(2.4);
}

.animate-up-6:hover, .animate-hover:hover .animate-up-6 {
    transform: translate(0, -6px);
}

.animate-right-6:hover, .animate-hover:hover .animate-right-6 {
    transform: translate(6px, 0);
}

.animate-down-6:hover, .animate-hover:hover .animate-down-6 {
    transform: translate(0, 6px);
}

.animate-left-6:hover, .animate-hover:hover .animate-left-6 {
    transform: translate(-6px, 0);
}

.animate-up-7,
.animate-right-7,
.animate-down-7,
.animate-left-7,
.scale-up-7,
.scale-down-7 {
    transition: all 0.2s ease;
}

.scale-up-7:hover {
    transform: scale(3.8888888892);
}

.scale-up-hover-7:hover .scale {
    transform: scale(3.8888888892);
}

.scale-down-7:hover {
    transform: scale(2.8);
}

.animate-up-7:hover, .animate-hover:hover .animate-up-7 {
    transform: translate(0, -7px);
}

.animate-right-7:hover, .animate-hover:hover .animate-right-7 {
    transform: translate(7px, 0);
}

.animate-down-7:hover, .animate-hover:hover .animate-down-7 {
    transform: translate(0, 7px);
}

.animate-left-7:hover, .animate-hover:hover .animate-left-7 {
    transform: translate(-7px, 0);
}

.animate-up-8,
.animate-right-8,
.animate-down-8,
.animate-left-8,
.scale-up-8,
.scale-down-8 {
    transition: all 0.2s ease;
}

.scale-up-8:hover {
    transform: scale(4.4444444448);
}

.scale-up-hover-8:hover .scale {
    transform: scale(4.4444444448);
}

.scale-down-8:hover {
    transform: scale(3.2);
}

.animate-up-8:hover, .animate-hover:hover .animate-up-8 {
    transform: translate(0, -8px);
}

.animate-right-8:hover, .animate-hover:hover .animate-right-8 {
    transform: translate(8px, 0);
}

.animate-down-8:hover, .animate-hover:hover .animate-down-8 {
    transform: translate(0, 8px);
}

.animate-left-8:hover, .animate-hover:hover .animate-left-8 {
    transform: translate(-8px, 0);
}

.animate-up-9,
.animate-right-9,
.animate-down-9,
.animate-left-9,
.scale-up-9,
.scale-down-9 {
    transition: all 0.2s ease;
}

.scale-up-9:hover {
    transform: scale(5.0000000004);
}

.scale-up-hover-9:hover .scale {
    transform: scale(5.0000000004);
}

.scale-down-9:hover {
    transform: scale(3.6);
}

.animate-up-9:hover, .animate-hover:hover .animate-up-9 {
    transform: translate(0, -9px);
}

.animate-right-9:hover, .animate-hover:hover .animate-right-9 {
    transform: translate(9px, 0);
}

.animate-down-9:hover, .animate-hover:hover .animate-down-9 {
    transform: translate(0, 9px);
}

.animate-left-9:hover, .animate-hover:hover .animate-left-9 {
    transform: translate(-9px, 0);
}

@keyframes show-navbar-collapse {
    0% {
        opacity: 0;
        transform: scale(0.95);
        transform-origin: 100% 0;
    }

    100% {
        opacity: 1;
        transform: scale(1);
    }
}

@keyframes hide-navbar-collapse {
    from {
        opacity: 1;
        transform: scale(1);
        transform-origin: 100% 0;
    }

    to {
        opacity: 0;
        transform: scale(0.95);
    }
}

@keyframes show-navbar-dropdown {
    0% {
        opacity: 0;
        transform: translate(0, 10px) perspective(200px) rotateX(-2deg);
        transition: visibility 0.45s, opacity 0.45s, transform 0.45s;
    }

    100% {
        transform: translate(0, 0);
        opacity: 1;
    }
}

@keyframes hide-navbar-dropdown {
    from {
        opacity: 1;
    }

    to {
        opacity: 0;
        transform: translate(0, 10px);
    }
}

@keyframes show-dropdown {
    0% {
        opacity: 0;
        transform-origin: perspective(200px) rotateX(-2deg);
        transition: visibility 0.45s, opacity 0.5s;
    }

    100% {
        opacity: 1;
    }
}

@keyframes hide-dropdown {
    from {
        opacity: 1;
    }

    to {
        opacity: 0;
        transform: translate(0, 10px);
    }
}

.bell-shake.shaking {
    animation: bellshake 0.5s cubic-bezier(0.36, 0.07, 0.19, 0.97) both;
    -webkit-backface-visibility: hidden;
    backface-visibility: hidden;
    transform-origin: top right;
}

:root {
    --animate-duration: 1s;
    --animate-delay: 1s;
    --animate-repeat: 1;
}

.animate__animated {
    animation-duration: 1s;
    animation-duration: var(--animate-duration);
    animation-fill-mode: both;
}

.animate__jackInTheBox {
    animation-name: jackInTheBox;
}

@keyframes bellshake {
    0% {
        transform: rotate(0);
    }

    15% {
        transform: rotate(5deg);
    }

    30% {
        transform: rotate(-5deg);
    }

    45% {
        transform: rotate(4deg);
    }

    60% {
        transform: rotate(-4deg);
    }

    75% {
        transform: rotate(2deg);
    }

    85% {
        transform: rotate(-2deg);
    }

    92% {
        transform: rotate(1deg);
    }

    100% {
        transform: rotate(0);
    }
}

@keyframes jackInTheBox {
    from {
        opacity: 0;
        transform: scale(0.1) rotate(30deg);
        transform-origin: center bottom;
    }

    50% {
        transform: rotate(-10deg);
    }

    70% {
        transform: rotate(3deg);
    }

    to {
        opacity: 1;
        transform: scale(1);
    }
}

.animate__jackInTheBox {
    animation-name: jackInTheBox;
}

[class*=shadow] {
    transition: all 0.2s ease;
}

.alert-heading {
    font-weight: 500;
}

.alert-icon {
    margin-bottom: 0.5rem;
}

.alert-icon span {
    font-size: 2rem;
}

/**
 * = Avatars
 */
.avatar + .avatar-content {
    display: inline-block;
    margin-left: 0.75rem;
}

.avatar-sm {
    width: 1.5rem;
    height: 1.5rem;
}

.avatar-sm img {
    width: 1.5rem;
    height: 1.5rem;
}

.avatar {
    width: 2rem;
    height: 2rem;
}

.avatar img {
    width: 2rem;
    height: 2rem;
}

.avatar-md {
    width: 3rem;
    height: 3rem;
}

.avatar-md img {
    width: 3rem;
    height: 3rem;
}

.avatar-lg {
    width: 4.5rem;
    height: 4.5rem;
}

.avatar-lg img {
    width: 4.5rem;
    height: 4.5rem;
}

.avatar-xl {
    width: 8rem;
    height: 8rem;
}

@media (max-width: 991.98px) {
    .avatar-xl {
        width: 4.5rem;
        height: 4.5rem;
    }
}

.avatar-offline::before,
.avatar-online::before {
    position: absolute;
    border: 2px solid #ffffff;
    background-color: #10B981;
    display: block;
    top: 2px;
    left: 39px;
    content: "";
    border-radius: 50%;
    height: 10px;
    width: 10px;
}

.avatar-offline::before {
    background-color: #E11D48;
}

.avatar-group .avatar {
    position: relative;
    z-index: 0;
}

.avatar-group .avatar img {
    border: 2px solid #ffffff;
}

.avatar-group .avatar:hover {
    z-index: 3;
}

.avatar-group .avatar + .avatar {
    margin-left: -1rem;
}

/**
 * = Badges
 */
.badge {
    font-size: 0.75em;
    font-weight: 600;
}

.badge a {
    color: #ffffff;
}

.badge.super-badge {
    vertical-align: super;
}

.badge-pill {
    padding-right: 0.875em;
    padding-left: 0.875em;
}

.badge-inline {
    margin-right: 0.625rem;
}

.badge-inline + span {
    top: 2px;
    position: relative;
}

.badge-inline + span > a {
    text-decoration: underline;
}

.badge-sm {
    padding: 0.2rem 0.6rem;
}

.badge-lg {
    font-size: 1.25rem;
    padding: 0.35rem 0.85rem;
}

.btn .badge-corner {
    position: absolute;
    top: -50%;
    right: 0.5rem;
    transform: translate(50%, 50%);
    margin: 0;
    border: 3px solid;
    padding-left: 0.5rem;
    padding-right: 0.5rem;
}

.wi-tags a {
    display: inline-block;
    padding: 0.125rem 0.875rem;
    margin: 0.25rem;
    line-height: 2;
    font-size: 0.875rem;
    box-shadow: 0 2px 5px rgba(140, 152, 164, 0.2);
    background-color: #ffffff;
}

.pixel-pro-badge {
    position: relative;
    font-size: 0.875rem;
    text-transform: uppercase;
    font-weight: 500;
    right: -11px;
    padding: 4px 12px;
    top: -30px;
    background: #ffffff;
    border-radius: 0.35rem;
    box-shadow: 0 2px 5px rgba(140, 152, 164, 0.2);
}

@media (max-width: 575.98px) {
    .pixel-pro-badge {
        font-size: 1rem;
        right: -13px;
        padding: 5px 10px;
        top: -23px;
    }
}

.subscription-badge {
    top: -19px;
    right: -12px;
    font-size: 0.75rem;
}

/*
* = Buttons
*/
.btn.btn-circle {
    border-radius: 50%;
}

.btn.btn-md {
    padding: 0.65rem 1.25rem;
}

.btn.btn-xs {
    padding: 0.2rem 0.35rem;
    font-size: 0.55rem;
    box-shadow: none;
}

.btn.large-form-btn {
    padding: 1.2rem 1rem;
}

.btn.dashed-outline {
    border-style: dashed;
}

.btn-icon-only {
    width: 2.575rem;
    height: 2.575rem;
    padding: 0;
    display: flex;
    -moz-justify-content: center;
    -ms-justify-content: center;
    justify-content: center;
    -ms-flex-pack: center;
    -moz-align-items: center;
    -ms-align-items: center;
    align-items: center;
}

.btn-icon-only.btn-xs {
    width: 1.7rem;
    height: 1.7rem;
}

.btn-icon-only.btn-sm, .btn-group-sm > .btn-icon-only.btn {
    width: 2rem;
    height: 2rem;
}

.btn-upgrade-pro {
    position: fixed;
    bottom: 15px;
    right: 15px;
    width: 190px;
}

@media (min-width: 768px) {
    .btn-upgrade-pro {
        left: 35px;
    }
}

.btn-primary:hover {
    background-color: #161d27;
    border-color: #161d27;
}

.btn-secondary:hover {
    background-color: #eeb15d;
    border-color: #eeb15d;
}

.btn-tertiary:hover {
    background-color: #292959;
    border-color: #292959;
}

.btn-success:hover {
    background-color: #0ea271;
    border-color: #0ea271;
}

.btn-info:hover {
    background-color: #1f57b8;
    border-color: #1f57b8;
}

.btn-warning:hover {
    background-color: #f1bc77;
    border-color: #f1bc77;
}

.btn-danger:hover {
    background-color: #ca1a41;
    border-color: #ca1a41;
}

.btn-white:hover {
    background-color: #f2f2f2;
    border-color: #f2f2f2;
}

.btn-indigo:hover {
    background-color: #3a30e2;
    border-color: #3a30e2;
}

.btn-purple:hover {
    background-color: #6c23eb;
    border-color: #6c23eb;
}

.btn-yellow-100:hover {
    background-color: #ffe3bd;
    border-color: #ffe3bd;
}

.btn-yellow-200:hover {
    background-color: #f2d0a2;
    border-color: #f2d0a2;
}

.btn-gray-50:hover {
    background-color: #eaedf1;
    border-color: #eaedf1;
}

.btn-gray-100:hover {
    background-color: #e3e7ec;
    border-color: #e3e7ec;
}

.btn-gray-200:hover {
    background-color: #d7dae0;
    border-color: #d7dae0;
}

.btn-gray-300:hover {
    background-color: #c3c8d0;
    border-color: #c3c8d0;
}

.btn-gray-400:hover {
    background-color: #8e96a4;
    border-color: #8e96a4;
}

.btn-gray-500:hover {
    background-color: #5f6672;
    border-color: #5f6672;
}

.btn-gray-600:hover {
    background-color: #404954;
    border-color: #404954;
}

.btn-gray-700:hover {
    background-color: #2d3542;
    border-color: #2d3542;
}

.btn-gray-800:hover {
    background-color: #161d27;
    border-color: #161d27;
}

.btn-gray-900:hover {
    background-color: #090d15;
    border-color: #090d15;
}

.btn-facebook {
    color: #ffffff;
    background-color: #3b5999;
    border-color: #3b5999;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.15), 0 1px 1px rgba(17, 24, 39, 0.075);
}

.btn-facebook:hover {
    color: #ffffff;
    background-color: #324c82;
    border-color: #2f477a;
}

.btn-check:focus + .btn-facebook, .btn-facebook:focus {
    color: #ffffff;
    background-color: #324c82;
    border-color: #2f477a;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.15), 0 1px 1px rgba(17, 24, 39, 0.075), 0 0 0 0.18rem rgba(88, 114, 168, 0.5);
}

.btn-check:checked + .btn-facebook, .btn-check:active + .btn-facebook, .btn-facebook:active, .btn-facebook.active, .show > .btn-facebook.dropdown-toggle {
    color: #ffffff;
    background-color: #2f477a;
    border-color: #2c4373;
}

.btn-check:checked + .btn-facebook:focus, .btn-check:active + .btn-facebook:focus, .btn-facebook:active:focus, .btn-facebook.active:focus, .show > .btn-facebook.dropdown-toggle:focus {
    box-shadow: inset 0 3px 5px rgba(17, 24, 39, 0.125), 0 0 0 0.18rem rgba(88, 114, 168, 0.5);
}

.btn-facebook:disabled, .btn-facebook.disabled {
    color: #ffffff;
    background-color: #3b5999;
    border-color: #3b5999;
}

.btn-facebook.btn-link {
    color: #3b5999;
    background: transparent;
    box-shadow: none;
    border: 0;
    border-style: none;
}

.btn-facebook.btn-link:hover, .btn-facebook.btn-link:focus, .btn-facebook.btn-link.active {
    background-color: transparent !important;
    box-shadow: none;
    border: 0;
    color: #3b5999;
}

.btn-twitter {
    color: #1F2937;
    background-color: #1da1f2;
    border-color: #1da1f2;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.15), 0 1px 1px rgba(17, 24, 39, 0.075);
}

.btn-twitter:hover {
    color: #1F2937;
    background-color: #3faff4;
    border-color: #34aaf3;
}

.btn-check:focus + .btn-twitter, .btn-twitter:focus {
    color: #1F2937;
    background-color: #3faff4;
    border-color: #34aaf3;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.15), 0 1px 1px rgba(17, 24, 39, 0.075), 0 0 0 0.18rem rgba(29, 143, 214, 0.5);
}

.btn-check:checked + .btn-twitter, .btn-check:active + .btn-twitter, .btn-twitter:active, .btn-twitter.active, .show > .btn-twitter.dropdown-toggle {
    color: #1F2937;
    background-color: #4ab4f5;
    border-color: #34aaf3;
}

.btn-check:checked + .btn-twitter:focus, .btn-check:active + .btn-twitter:focus, .btn-twitter:active:focus, .btn-twitter.active:focus, .show > .btn-twitter.dropdown-toggle:focus {
    box-shadow: inset 0 3px 5px rgba(17, 24, 39, 0.125), 0 0 0 0.18rem rgba(29, 143, 214, 0.5);
}

.btn-twitter:disabled, .btn-twitter.disabled {
    color: #1F2937;
    background-color: #1da1f2;
    border-color: #1da1f2;
}

.btn-twitter.btn-link {
    color: #1da1f2;
    background: transparent;
    box-shadow: none;
    border: 0;
    border-style: none;
}

.btn-twitter.btn-link:hover, .btn-twitter.btn-link:focus, .btn-twitter.btn-link.active {
    background-color: transparent !important;
    box-shadow: none;
    border: 0;
    color: #1da1f2;
}

.btn-google {
    color: #ffffff;
    background-color: #DB4337;
    border-color: #DB4337;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.15), 0 1px 1px rgba(17, 24, 39, 0.075);
}

.btn-google:hover {
    color: #ffffff;
    background-color: #ba392f;
    border-color: #af362c;
}

.btn-check:focus + .btn-google, .btn-google:focus {
    color: #ffffff;
    background-color: #ba392f;
    border-color: #af362c;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.15), 0 1px 1px rgba(17, 24, 39, 0.075), 0 0 0 0.18rem rgba(224, 95, 85, 0.5);
}

.btn-check:checked + .btn-google, .btn-check:active + .btn-google, .btn-google:active, .btn-google.active, .show > .btn-google.dropdown-toggle {
    color: #ffffff;
    background-color: #af362c;
    border-color: #a43229;
}

.btn-check:checked + .btn-google:focus, .btn-check:active + .btn-google:focus, .btn-google:active:focus, .btn-google.active:focus, .show > .btn-google.dropdown-toggle:focus {
    box-shadow: inset 0 3px 5px rgba(17, 24, 39, 0.125), 0 0 0 0.18rem rgba(224, 95, 85, 0.5);
}

.btn-google:disabled, .btn-google.disabled {
    color: #ffffff;
    background-color: #DB4337;
    border-color: #DB4337;
}

.btn-google.btn-link {
    color: #DB4337;
    background: transparent;
    box-shadow: none;
    border: 0;
    border-style: none;
}

.btn-google.btn-link:hover, .btn-google.btn-link:focus, .btn-google.btn-link.active {
    background-color: transparent !important;
    box-shadow: none;
    border: 0;
    color: #DB4337;
}

.btn-instagram {
    color: #ffffff;
    background-color: #e4405f;
    border-color: #e4405f;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.15), 0 1px 1px rgba(17, 24, 39, 0.075);
}

.btn-instagram:hover {
    color: #ffffff;
    background-color: #c23651;
    border-color: #b6334c;
}

.btn-check:focus + .btn-instagram, .btn-instagram:focus {
    color: #ffffff;
    background-color: #c23651;
    border-color: #b6334c;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.15), 0 1px 1px rgba(17, 24, 39, 0.075), 0 0 0 0.18rem rgba(232, 93, 119, 0.5);
}

.btn-check:checked + .btn-instagram, .btn-check:active + .btn-instagram, .btn-instagram:active, .btn-instagram.active, .show > .btn-instagram.dropdown-toggle {
    color: #ffffff;
    background-color: #b6334c;
    border-color: #ab3047;
}

.btn-check:checked + .btn-instagram:focus, .btn-check:active + .btn-instagram:focus, .btn-instagram:active:focus, .btn-instagram.active:focus, .show > .btn-instagram.dropdown-toggle:focus {
    box-shadow: inset 0 3px 5px rgba(17, 24, 39, 0.125), 0 0 0 0.18rem rgba(232, 93, 119, 0.5);
}

.btn-instagram:disabled, .btn-instagram.disabled {
    color: #ffffff;
    background-color: #e4405f;
    border-color: #e4405f;
}

.btn-instagram.btn-link {
    color: #e4405f;
    background: transparent;
    box-shadow: none;
    border: 0;
    border-style: none;
}

.btn-instagram.btn-link:hover, .btn-instagram.btn-link:focus, .btn-instagram.btn-link.active {
    background-color: transparent !important;
    box-shadow: none;
    border: 0;
    color: #e4405f;
}

.btn-pinterest {
    color: #ffffff;
    background-color: #bd081c;
    border-color: #bd081c;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.15), 0 1px 1px rgba(17, 24, 39, 0.075);
}

.btn-pinterest:hover {
    color: #ffffff;
    background-color: #a10718;
    border-color: #970616;
}

.btn-check:focus + .btn-pinterest, .btn-pinterest:focus {
    color: #ffffff;
    background-color: #a10718;
    border-color: #970616;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.15), 0 1px 1px rgba(17, 24, 39, 0.075), 0 0 0 0.18rem rgba(199, 45, 62, 0.5);
}

.btn-check:checked + .btn-pinterest, .btn-check:active + .btn-pinterest, .btn-pinterest:active, .btn-pinterest.active, .show > .btn-pinterest.dropdown-toggle {
    color: #ffffff;
    background-color: #970616;
    border-color: #8e0615;
}

.btn-check:checked + .btn-pinterest:focus, .btn-check:active + .btn-pinterest:focus, .btn-pinterest:active:focus, .btn-pinterest.active:focus, .show > .btn-pinterest.dropdown-toggle:focus {
    box-shadow: inset 0 3px 5px rgba(17, 24, 39, 0.125), 0 0 0 0.18rem rgba(199, 45, 62, 0.5);
}

.btn-pinterest:disabled, .btn-pinterest.disabled {
    color: #ffffff;
    background-color: #bd081c;
    border-color: #bd081c;
}

.btn-pinterest.btn-link {
    color: #bd081c;
    background: transparent;
    box-shadow: none;
    border: 0;
    border-style: none;
}

.btn-pinterest.btn-link:hover, .btn-pinterest.btn-link:focus, .btn-pinterest.btn-link.active {
    background-color: transparent !important;
    box-shadow: none;
    border: 0;
    color: #bd081c;
}

.btn-youtube {
    color: #ffffff;
    background-color: #cd201f;
    border-color: #cd201f;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.15), 0 1px 1px rgba(17, 24, 39, 0.075);
}

.btn-youtube:hover {
    color: #ffffff;
    background-color: #ae1b1a;
    border-color: #a41a19;
}

.btn-check:focus + .btn-youtube, .btn-youtube:focus {
    color: #ffffff;
    background-color: #ae1b1a;
    border-color: #a41a19;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.15), 0 1px 1px rgba(17, 24, 39, 0.075), 0 0 0 0.18rem rgba(213, 65, 65, 0.5);
}

.btn-check:checked + .btn-youtube, .btn-check:active + .btn-youtube, .btn-youtube:active, .btn-youtube.active, .show > .btn-youtube.dropdown-toggle {
    color: #ffffff;
    background-color: #a41a19;
    border-color: #9a1817;
}

.btn-check:checked + .btn-youtube:focus, .btn-check:active + .btn-youtube:focus, .btn-youtube:active:focus, .btn-youtube.active:focus, .show > .btn-youtube.dropdown-toggle:focus {
    box-shadow: inset 0 3px 5px rgba(17, 24, 39, 0.125), 0 0 0 0.18rem rgba(213, 65, 65, 0.5);
}

.btn-youtube:disabled, .btn-youtube.disabled {
    color: #ffffff;
    background-color: #cd201f;
    border-color: #cd201f;
}

.btn-youtube.btn-link {
    color: #cd201f;
    background: transparent;
    box-shadow: none;
    border: 0;
    border-style: none;
}

.btn-youtube.btn-link:hover, .btn-youtube.btn-link:focus, .btn-youtube.btn-link.active {
    background-color: transparent !important;
    box-shadow: none;
    border: 0;
    color: #cd201f;
}

.btn-slack {
    color: #1F2937;
    background-color: #3aaf85;
    border-color: #3aaf85;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.15), 0 1px 1px rgba(17, 24, 39, 0.075);
}

.btn-slack:hover {
    color: #1F2937;
    background-color: #58bb97;
    border-color: #4eb791;
}

.btn-check:focus + .btn-slack, .btn-slack:focus {
    color: #1F2937;
    background-color: #58bb97;
    border-color: #4eb791;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.15), 0 1px 1px rgba(17, 24, 39, 0.075), 0 0 0 0.18rem rgba(54, 155, 121, 0.5);
}

.btn-check:checked + .btn-slack, .btn-check:active + .btn-slack, .btn-slack:active, .btn-slack.active, .show > .btn-slack.dropdown-toggle {
    color: #1F2937;
    background-color: #61bf9d;
    border-color: #4eb791;
}

.btn-check:checked + .btn-slack:focus, .btn-check:active + .btn-slack:focus, .btn-slack:active:focus, .btn-slack.active:focus, .show > .btn-slack.dropdown-toggle:focus {
    box-shadow: inset 0 3px 5px rgba(17, 24, 39, 0.125), 0 0 0 0.18rem rgba(54, 155, 121, 0.5);
}

.btn-slack:disabled, .btn-slack.disabled {
    color: #1F2937;
    background-color: #3aaf85;
    border-color: #3aaf85;
}

.btn-slack.btn-link {
    color: #3aaf85;
    background: transparent;
    box-shadow: none;
    border: 0;
    border-style: none;
}

.btn-slack.btn-link:hover, .btn-slack.btn-link:focus, .btn-slack.btn-link.active {
    background-color: transparent !important;
    box-shadow: none;
    border: 0;
    color: #3aaf85;
}

.btn-dribbble {
    color: #ffffff;
    background-color: #ea4c89;
    border-color: #ea4c89;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.15), 0 1px 1px rgba(17, 24, 39, 0.075);
}

.btn-dribbble:hover {
    color: #ffffff;
    background-color: #c74174;
    border-color: #bb3d6e;
}

.btn-check:focus + .btn-dribbble, .btn-dribbble:focus {
    color: #ffffff;
    background-color: #c74174;
    border-color: #bb3d6e;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.15), 0 1px 1px rgba(17, 24, 39, 0.075), 0 0 0 0.18rem rgba(237, 103, 155, 0.5);
}

.btn-check:checked + .btn-dribbble, .btn-check:active + .btn-dribbble, .btn-dribbble:active, .btn-dribbble.active, .show > .btn-dribbble.dropdown-toggle {
    color: #ffffff;
    background-color: #bb3d6e;
    border-color: #b03967;
}

.btn-check:checked + .btn-dribbble:focus, .btn-check:active + .btn-dribbble:focus, .btn-dribbble:active:focus, .btn-dribbble.active:focus, .show > .btn-dribbble.dropdown-toggle:focus {
    box-shadow: inset 0 3px 5px rgba(17, 24, 39, 0.125), 0 0 0 0.18rem rgba(237, 103, 155, 0.5);
}

.btn-dribbble:disabled, .btn-dribbble.disabled {
    color: #ffffff;
    background-color: #ea4c89;
    border-color: #ea4c89;
}

.btn-dribbble.btn-link {
    color: #ea4c89;
    background: transparent;
    box-shadow: none;
    border: 0;
    border-style: none;
}

.btn-dribbble.btn-link:hover, .btn-dribbble.btn-link:focus, .btn-dribbble.btn-link.active {
    background-color: transparent !important;
    box-shadow: none;
    border: 0;
    color: #ea4c89;
}

.btn-dropbox {
    color: #ffffff;
    background-color: #1E90FF;
    border-color: #1E90FF;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.15), 0 1px 1px rgba(17, 24, 39, 0.075);
}

.btn-dropbox:hover {
    color: #ffffff;
    background-color: #1a7ad9;
    border-color: #1873cc;
}

.btn-check:focus + .btn-dropbox, .btn-dropbox:focus {
    color: #ffffff;
    background-color: #1a7ad9;
    border-color: #1873cc;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.15), 0 1px 1px rgba(17, 24, 39, 0.075), 0 0 0 0.18rem rgba(64, 161, 255, 0.5);
}

.btn-check:checked + .btn-dropbox, .btn-check:active + .btn-dropbox, .btn-dropbox:active, .btn-dropbox.active, .show > .btn-dropbox.dropdown-toggle {
    color: #ffffff;
    background-color: #1873cc;
    border-color: #176cbf;
}

.btn-check:checked + .btn-dropbox:focus, .btn-check:active + .btn-dropbox:focus, .btn-dropbox:active:focus, .btn-dropbox.active:focus, .show > .btn-dropbox.dropdown-toggle:focus {
    box-shadow: inset 0 3px 5px rgba(17, 24, 39, 0.125), 0 0 0 0.18rem rgba(64, 161, 255, 0.5);
}

.btn-dropbox:disabled, .btn-dropbox.disabled {
    color: #ffffff;
    background-color: #1E90FF;
    border-color: #1E90FF;
}

.btn-dropbox.btn-link {
    color: #1E90FF;
    background: transparent;
    box-shadow: none;
    border: 0;
    border-style: none;
}

.btn-dropbox.btn-link:hover, .btn-dropbox.btn-link:focus, .btn-dropbox.btn-link.active {
    background-color: transparent !important;
    box-shadow: none;
    border: 0;
    color: #1E90FF;
}

.btn-twitch {
    color: #ffffff;
    background-color: #4B367C;
    border-color: #4B367C;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.15), 0 1px 1px rgba(17, 24, 39, 0.075);
}

.btn-twitch:hover {
    color: #ffffff;
    background-color: #402e69;
    border-color: #3c2b63;
}

.btn-check:focus + .btn-twitch, .btn-twitch:focus {
    color: #ffffff;
    background-color: #402e69;
    border-color: #3c2b63;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.15), 0 1px 1px rgba(17, 24, 39, 0.075), 0 0 0 0.18rem rgba(102, 84, 144, 0.5);
}

.btn-check:checked + .btn-twitch, .btn-check:active + .btn-twitch, .btn-twitch:active, .btn-twitch.active, .show > .btn-twitch.dropdown-toggle {
    color: #ffffff;
    background-color: #3c2b63;
    border-color: #38295d;
}

.btn-check:checked + .btn-twitch:focus, .btn-check:active + .btn-twitch:focus, .btn-twitch:active:focus, .btn-twitch.active:focus, .show > .btn-twitch.dropdown-toggle:focus {
    box-shadow: inset 0 3px 5px rgba(17, 24, 39, 0.125), 0 0 0 0.18rem rgba(102, 84, 144, 0.5);
}

.btn-twitch:disabled, .btn-twitch.disabled {
    color: #ffffff;
    background-color: #4B367C;
    border-color: #4B367C;
}

.btn-twitch.btn-link {
    color: #4B367C;
    background: transparent;
    box-shadow: none;
    border: 0;
    border-style: none;
}

.btn-twitch.btn-link:hover, .btn-twitch.btn-link:focus, .btn-twitch.btn-link.active {
    background-color: transparent !important;
    box-shadow: none;
    border: 0;
    color: #4B367C;
}

.btn-paypal {
    color: #1F2937;
    background-color: #ecb32c;
    border-color: #ecb32c;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.15), 0 1px 1px rgba(17, 24, 39, 0.075);
}

.btn-paypal:hover {
    color: #1F2937;
    background-color: #efbe4c;
    border-color: #eebb41;
}

.btn-check:focus + .btn-paypal, .btn-paypal:focus {
    color: #1F2937;
    background-color: #efbe4c;
    border-color: #eebb41;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.15), 0 1px 1px rgba(17, 24, 39, 0.075), 0 0 0 0.18rem rgba(205, 158, 46, 0.5);
}

.btn-check:checked + .btn-paypal, .btn-check:active + .btn-paypal, .btn-paypal:active, .btn-paypal.active, .show > .btn-paypal.dropdown-toggle {
    color: #1F2937;
    background-color: #f0c256;
    border-color: #eebb41;
}

.btn-check:checked + .btn-paypal:focus, .btn-check:active + .btn-paypal:focus, .btn-paypal:active:focus, .btn-paypal.active:focus, .show > .btn-paypal.dropdown-toggle:focus {
    box-shadow: inset 0 3px 5px rgba(17, 24, 39, 0.125), 0 0 0 0.18rem rgba(205, 158, 46, 0.5);
}

.btn-paypal:disabled, .btn-paypal.disabled {
    color: #1F2937;
    background-color: #ecb32c;
    border-color: #ecb32c;
}

.btn-paypal.btn-link {
    color: #ecb32c;
    background: transparent;
    box-shadow: none;
    border: 0;
    border-style: none;
}

.btn-paypal.btn-link:hover, .btn-paypal.btn-link:focus, .btn-paypal.btn-link.active {
    background-color: transparent !important;
    box-shadow: none;
    border: 0;
    color: #ecb32c;
}

.btn-behance {
    color: #ffffff;
    background-color: #0057ff;
    border-color: #0057ff;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.15), 0 1px 1px rgba(17, 24, 39, 0.075);
}

.btn-behance:hover {
    color: #ffffff;
    background-color: #004ad9;
    border-color: #0046cc;
}

.btn-check:focus + .btn-behance, .btn-behance:focus {
    color: #ffffff;
    background-color: #004ad9;
    border-color: #0046cc;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.15), 0 1px 1px rgba(17, 24, 39, 0.075), 0 0 0 0.18rem rgba(38, 112, 255, 0.5);
}

.btn-check:checked + .btn-behance, .btn-check:active + .btn-behance, .btn-behance:active, .btn-behance.active, .show > .btn-behance.dropdown-toggle {
    color: #ffffff;
    background-color: #0046cc;
    border-color: #0041bf;
}

.btn-check:checked + .btn-behance:focus, .btn-check:active + .btn-behance:focus, .btn-behance:active:focus, .btn-behance.active:focus, .show > .btn-behance.dropdown-toggle:focus {
    box-shadow: inset 0 3px 5px rgba(17, 24, 39, 0.125), 0 0 0 0.18rem rgba(38, 112, 255, 0.5);
}

.btn-behance:disabled, .btn-behance.disabled {
    color: #ffffff;
    background-color: #0057ff;
    border-color: #0057ff;
}

.btn-behance.btn-link {
    color: #0057ff;
    background: transparent;
    box-shadow: none;
    border: 0;
    border-style: none;
}

.btn-behance.btn-link:hover, .btn-behance.btn-link:focus, .btn-behance.btn-link.active {
    background-color: transparent !important;
    box-shadow: none;
    border: 0;
    color: #0057ff;
}

.btn-reddit {
    color: #ffffff;
    background-color: #E84422;
    border-color: #E84422;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.15), 0 1px 1px rgba(17, 24, 39, 0.075);
}

.btn-reddit:hover {
    color: #ffffff;
    background-color: #c53a1d;
    border-color: #ba361b;
}

.btn-check:focus + .btn-reddit, .btn-reddit:focus {
    color: #ffffff;
    background-color: #c53a1d;
    border-color: #ba361b;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.15), 0 1px 1px rgba(17, 24, 39, 0.075), 0 0 0 0.18rem rgba(235, 96, 67, 0.5);
}

.btn-check:checked + .btn-reddit, .btn-check:active + .btn-reddit, .btn-reddit:active, .btn-reddit.active, .show > .btn-reddit.dropdown-toggle {
    color: #ffffff;
    background-color: #ba361b;
    border-color: #ae331a;
}

.btn-check:checked + .btn-reddit:focus, .btn-check:active + .btn-reddit:focus, .btn-reddit:active:focus, .btn-reddit.active:focus, .show > .btn-reddit.dropdown-toggle:focus {
    box-shadow: inset 0 3px 5px rgba(17, 24, 39, 0.125), 0 0 0 0.18rem rgba(235, 96, 67, 0.5);
}

.btn-reddit:disabled, .btn-reddit.disabled {
    color: #ffffff;
    background-color: #E84422;
    border-color: #E84422;
}

.btn-reddit.btn-link {
    color: #E84422;
    background: transparent;
    box-shadow: none;
    border: 0;
    border-style: none;
}

.btn-reddit.btn-link:hover, .btn-reddit.btn-link:focus, .btn-reddit.btn-link.active {
    background-color: transparent !important;
    box-shadow: none;
    border: 0;
    color: #E84422;
}

.btn-github {
    color: #ffffff;
    background-color: #222222;
    border-color: #222222;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.15), 0 1px 1px rgba(17, 24, 39, 0.075);
}

.btn-github:hover {
    color: #ffffff;
    background-color: #1d1d1d;
    border-color: #1b1b1b;
}

.btn-check:focus + .btn-github, .btn-github:focus {
    color: #ffffff;
    background-color: #1d1d1d;
    border-color: #1b1b1b;
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.15), 0 1px 1px rgba(17, 24, 39, 0.075), 0 0 0 0.18rem rgba(67, 67, 67, 0.5);
}

.btn-check:checked + .btn-github, .btn-check:active + .btn-github, .btn-github:active, .btn-github.active, .show > .btn-github.dropdown-toggle {
    color: #ffffff;
    background-color: #1b1b1b;
    border-color: #1a1a1a;
}

.btn-check:checked + .btn-github:focus, .btn-check:active + .btn-github:focus, .btn-github:active:focus, .btn-github.active:focus, .show > .btn-github.dropdown-toggle:focus {
    box-shadow: inset 0 3px 5px rgba(17, 24, 39, 0.125), 0 0 0 0.18rem rgba(67, 67, 67, 0.5);
}

.btn-github:disabled, .btn-github.disabled {
    color: #ffffff;
    background-color: #222222;
    border-color: #222222;
}

.btn-github.btn-link {
    color: #222222;
    background: transparent;
    box-shadow: none;
    border: 0;
    border-style: none;
}

.btn-github.btn-link:hover, .btn-github.btn-link:focus, .btn-github.btn-link.active {
    background-color: transparent !important;
    box-shadow: none;
    border: 0;
    color: #222222;
}

/**
 * = Breadcrumbs
 */
.breadcrumb-item {
    font-size: 0.75rem;
}

.breadcrumb-item, .breadcrumb-item a {
    color: #374151;
    font-weight: 400;
    font-size: 0.75rem;
}

@media (min-width: 576px) {
    .breadcrumb-item, .breadcrumb-item a {
        font-size: 0.875rem;
    }
}

.breadcrumb-item.active {
    font-weight: 400;
}

.breadcrumb-transparent {
    background: transparent;
    padding: 0;
}

.breadcrumb-primary {
    background: #1F2937;
}

.breadcrumb-primary .breadcrumb-item.active {
    color: #ffffff;
}

.breadcrumb-primary.breadcrumb-transparent {
    background: transparent;
}

.breadcrumb-primary.breadcrumb-transparent .breadcrumb-item.active {
    color: #1F2937;
}

.breadcrumb-secondary {
    background: #f0bc74;
}

.breadcrumb-secondary .breadcrumb-item.active {
    color: #ffffff;
}

.breadcrumb-secondary.breadcrumb-transparent {
    background: transparent;
}

.breadcrumb-secondary.breadcrumb-transparent .breadcrumb-item.active {
    color: #f0bc74;
}

.breadcrumb-tertiary {
    background: #31316A;
}

.breadcrumb-tertiary .breadcrumb-item.active {
    color: #ffffff;
}

.breadcrumb-tertiary.breadcrumb-transparent {
    background: transparent;
}

.breadcrumb-tertiary.breadcrumb-transparent .breadcrumb-item.active {
    color: #31316A;
}

.breadcrumb-success {
    background: #10B981;
}

.breadcrumb-success .breadcrumb-item.active {
    color: #ffffff;
}

.breadcrumb-success.breadcrumb-transparent {
    background: transparent;
}

.breadcrumb-success.breadcrumb-transparent .breadcrumb-item.active {
    color: #10B981;
}

.breadcrumb-info {
    background: #2361ce;
}

.breadcrumb-info .breadcrumb-item.active {
    color: #ffffff;
}

.breadcrumb-info.breadcrumb-transparent {
    background: transparent;
}

.breadcrumb-info.breadcrumb-transparent .breadcrumb-item.active {
    color: #2361ce;
}

.breadcrumb-warning {
    background: #f3c78e;
}

.breadcrumb-warning .breadcrumb-item.active {
    color: #ffffff;
}

.breadcrumb-warning.breadcrumb-transparent {
    background: transparent;
}

.breadcrumb-warning.breadcrumb-transparent .breadcrumb-item.active {
    color: #f3c78e;
}

.breadcrumb-danger {
    background: #E11D48;
}

.breadcrumb-danger .breadcrumb-item.active {
    color: #ffffff;
}

.breadcrumb-danger.breadcrumb-transparent {
    background: transparent;
}

.breadcrumb-danger.breadcrumb-transparent .breadcrumb-item.active {
    color: #E11D48;
}

.breadcrumb-white {
    background: #ffffff;
}

.breadcrumb-white .breadcrumb-item.active {
    color: #ffffff;
}

.breadcrumb-white.breadcrumb-transparent {
    background: transparent;
}

.breadcrumb-white.breadcrumb-transparent .breadcrumb-item.active {
    color: #ffffff;
}

.breadcrumb-indigo {
    background: #4F46E5;
}

.breadcrumb-indigo .breadcrumb-item.active {
    color: #ffffff;
}

.breadcrumb-indigo.breadcrumb-transparent {
    background: transparent;
}

.breadcrumb-indigo.breadcrumb-transparent .breadcrumb-item.active {
    color: #4F46E5;
}

.breadcrumb-purple {
    background: #7C3AED;
}

.breadcrumb-purple .breadcrumb-item.active {
    color: #ffffff;
}

.breadcrumb-purple.breadcrumb-transparent {
    background: transparent;
}

.breadcrumb-purple.breadcrumb-transparent .breadcrumb-item.active {
    color: #7C3AED;
}

.breadcrumb-yellow-100 {
    background: #ffeed6;
}

.breadcrumb-yellow-100 .breadcrumb-item.active {
    color: #ffffff;
}

.breadcrumb-yellow-100.breadcrumb-transparent {
    background: transparent;
}

.breadcrumb-yellow-100.breadcrumb-transparent .breadcrumb-item.active {
    color: #ffeed6;
}

.breadcrumb-yellow-200 {
    background: #f5dbb8;
}

.breadcrumb-yellow-200 .breadcrumb-item.active {
    color: #ffffff;
}

.breadcrumb-yellow-200.breadcrumb-transparent {
    background: transparent;
}

.breadcrumb-yellow-200.breadcrumb-transparent .breadcrumb-item.active {
    color: #f5dbb8;
}

.breadcrumb-gray-50 {
    background: #F9FAFB;
}

.breadcrumb-gray-50 .breadcrumb-item.active {
    color: #ffffff;
}

.breadcrumb-gray-50.breadcrumb-transparent {
    background: transparent;
}

.breadcrumb-gray-50.breadcrumb-transparent .breadcrumb-item.active {
    color: #F9FAFB;
}

.breadcrumb-gray-100 {
    background: #F2F4F6;
}

.breadcrumb-gray-100 .breadcrumb-item.active {
    color: #ffffff;
}

.breadcrumb-gray-100.breadcrumb-transparent {
    background: transparent;
}

.breadcrumb-gray-100.breadcrumb-transparent .breadcrumb-item.active {
    color: #F2F4F6;
}

.breadcrumb-gray-200 {
    background: #E5E7EB;
}

.breadcrumb-gray-200 .breadcrumb-item.active {
    color: #ffffff;
}

.breadcrumb-gray-200.breadcrumb-transparent {
    background: transparent;
}

.breadcrumb-gray-200.breadcrumb-transparent .breadcrumb-item.active {
    color: #E5E7EB;
}

.breadcrumb-gray-300 {
    background: #D1D5DB;
}

.breadcrumb-gray-300 .breadcrumb-item.active {
    color: #ffffff;
}

.breadcrumb-gray-300.breadcrumb-transparent {
    background: transparent;
}

.breadcrumb-gray-300.breadcrumb-transparent .breadcrumb-item.active {
    color: #D1D5DB;
}

.breadcrumb-gray-400 {
    background: #9CA3AF;
}

.breadcrumb-gray-400 .breadcrumb-item.active {
    color: #ffffff;
}

.breadcrumb-gray-400.breadcrumb-transparent {
    background: transparent;
}

.breadcrumb-gray-400.breadcrumb-transparent .breadcrumb-item.active {
    color: #9CA3AF;
}

.breadcrumb-gray-500 {
    background: #6B7280;
}

.breadcrumb-gray-500 .breadcrumb-item.active {
    color: #ffffff;
}

.breadcrumb-gray-500.breadcrumb-transparent {
    background: transparent;
}

.breadcrumb-gray-500.breadcrumb-transparent .breadcrumb-item.active {
    color: #6B7280;
}

.breadcrumb-gray-600 {
    background: #4B5563;
}

.breadcrumb-gray-600 .breadcrumb-item.active {
    color: #ffffff;
}

.breadcrumb-gray-600.breadcrumb-transparent {
    background: transparent;
}

.breadcrumb-gray-600.breadcrumb-transparent .breadcrumb-item.active {
    color: #4B5563;
}

.breadcrumb-gray-700 {
    background: #374151;
}

.breadcrumb-gray-700 .breadcrumb-item.active {
    color: #ffffff;
}

.breadcrumb-gray-700.breadcrumb-transparent {
    background: transparent;
}

.breadcrumb-gray-700.breadcrumb-transparent .breadcrumb-item.active {
    color: #374151;
}

.breadcrumb-gray-800 {
    background: #1F2937;
}

.breadcrumb-gray-800 .breadcrumb-item.active {
    color: #ffffff;
}

.breadcrumb-gray-800.breadcrumb-transparent {
    background: transparent;
}

.breadcrumb-gray-800.breadcrumb-transparent .breadcrumb-item.active {
    color: #1F2937;
}

.breadcrumb-gray-900 {
    background: #111827;
}

.breadcrumb-gray-900 .breadcrumb-item.active {
    color: #ffffff;
}

.breadcrumb-gray-900.breadcrumb-transparent {
    background: transparent;
}

.breadcrumb-gray-900.breadcrumb-transparent .breadcrumb-item.active {
    color: #111827;
}

.breadcrumb-text-light .breadcrumb-item, .breadcrumb-text-light .breadcrumb-item a {
    color: #ffffff;
}

.breadcrumb-text-light .breadcrumb-item:before {
    color: #ffffff;
}

/**
 * = Cards
 */
.card {
    position: relative;
}

.card .card-header {
    background: transparent;
}

.card.hover-state:hover {
    background-color: #E5E7EB;
}

.card .profile-cover {
    background-repeat: no-repeat;
    background-position: top center;
    background-size: cover;
    height: 200px;
}

.message-wrapper .card,
.task-wrapper .card {
    border: 0;
}

.customer-testimonial .content-wrapper:before {
    content: "";
    position: absolute;
    top: 25px;
    left: -1px;
    margin-left: 0.75rem;
    border: 8px solid #111827;
    border-color: transparent #e0e6ec #e0e6ec transparent;
    box-sizing: border-box;
    transform-origin: 0 0;
    transform: rotate(135deg);
    box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
}

.card-footer {
    background-color: transparent;
}

.card-stats {
    padding-left: 1.9rem;
}

.card .card-blockquote {
    position: relative;
    padding: 2rem;
}

.card .card-blockquote .svg-bg {
    display: block;
    position: absolute;
    width: 100%;
    height: 95px;
    top: -94px;
    left: 0;
}

.page-preview {
    display: block;
    position: relative;
}

.page-preview .show-on-hover {
    position: absolute;
    bottom: 0;
    background: rgba(31, 41, 55, 0.85);
    padding: 10px 0;
    width: 100%;
    left: 0;
    opacity: 0;
    transition: 0.2s;
}

@media (prefers-reduced-motion: reduce) {
    .page-preview .show-on-hover {
        transition: none;
    }
}

.page-preview:hover {
    z-index: 1;
}

.page-preview:hover .show-on-hover {
    opacity: 1;
}

.theme-settings {
    z-index: 99;
    position: fixed;
    right: 15px;
    bottom: 0;
}

.theme-settings, .theme-settings .card-body {
    border-bottom-right-radius: 0;
    border-bottom-left-radius: 0;
}

.theme-settings-close {
    position: absolute;
    top: 8px;
    right: 8px;
    font-size: 0.65rem;
}

.btn-close.theme-settings-close {
    background: transparent url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23ffffff'%3e%3cpath d='M.293.293a1 1 0 011.414 0L8 6.586 14.293.293a1 1 0 111.414 1.414L9.414 8l6.293 6.293a1 1 0 01-1.414 1.414L8 9.414l-6.293 6.293a1 1 0 01-1.414-1.414L6.586 8 .293 1.707a1 1 0 010-1.414z'/%3e%3c/svg%3e") center/1em auto no-repeat;
    border: 0;
    border-radius: 0.5rem;
    opacity: 0.5;
}

.theme-settings-expand {
    right: 15px;
    bottom: 0;
    height: 0;
    transition: 0.3s height;
}

@media (prefers-reduced-motion: reduce) {
    .theme-settings-expand {
        transition: none;
    }
}

.theme-settings-expand.show {
    height: 40px;
}

.theme-settings-expand:hover {
    background: #4B5563;
    cursor: pointer;
}

/**
 * = Bootstrap carousels
 */
.carousel-caption, .carousel-caption h5, .carousel-caption .h5 {
    color: #ffffff;
}

.carousel-indicators li {
    height: 10px;
    width: 10px;
    border-radius: 50%;
    background: transparent;
    border: 2px solid #ffffff;
}

.carousel-indicators .active {
    opacity: 1;
    background: #ffffff;
}

.carousel-control-prev-icon,
.carousel-control-next-icon {
    width: auto;
    height: auto;
    font-weight: 900;
}

.carousel-control-prev-icon {
    background-image: none;
}

.carousel-control-prev-icon::before {
    content: "\f060";
    font-family: "Font Awesome 5 Free";
    font-size: 2rem;
}

.carousel-control-next-icon {
    background-image: none;
}

.carousel-control-next-icon:before {
    font-family: "Font Awesome 5 Free";
    content: "\f061";
    font-size: 2rem;
}

/**
 * = Close
 */
.close {
    transition: all 0.2s ease;
}

.close > span:not(.sr-only) {
    display: block;
    height: 1.25rem;
    width: 1.25rem;
    background-color: transparent;
    color: rgba(0, 0, 0, 0.6);
    line-height: 17px;
    border-radius: 50%;
    font-size: 1.25rem;
    transition: all 0.2s ease;
}

.close:hover, .close:focus {
    background-color: transparent;
    color: rgba(0, 0, 0, 0.9);
    outline: none;
}

.close:hover span:not(.sr-only), .close:focus span:not(.sr-only) {
    background-color: transparent;
}

/**
 * = Custom forms
 */
.custom-control-label:before {
    box-shadow: none;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.custom-control-label span {
    position: relative;
    top: 2px;
}

.custom-control-label {
    margin-bottom: 0;
}

.custom-control-input:active ~ .custom-control-label::before {
    border-color: #1F2937;
}

.custom-file-label {
    background-color: #f3f3f5;
}

.custom-file-label::after {
    background-color: #f3f3f5;
}

.custom-select {
    font-size: 0.875rem;
    box-shadow: none;
}

.custom-select.custom-select-shadow {
    box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.07);
    transition: box-shadow 0.15s ease;
}

.custom-select.custom-select-shadow:focus {
    box-shadow: 0.1rem 0.1rem 0 rgba(229, 231, 235, 0.5);
}

.custom-select:hover {
    cursor: pointer;
}

.rating-star.star-lg label {
    margin-bottom: 0.5rem;
}

.rating-star.star-lg label::before {
    font-size: 1.5rem;
}

.rating-star label {
    position: relative;
    margin-bottom: 0;
    cursor: pointer;
    color: #9CA3AF;
}

.rating-star label:before {
    content: "\f005";
    font-family: "Font Awesome 5 Free";
    font-weight: 900;
    transition: all 0.2s ease;
    font-size: 1.0625rem;
}

.rating-star input {
    position: absolute;
    z-index: -1;
    opacity: 0;
}

.rating-star > input:checked ~ label {
    color: #f3c78e;
}

.rating-star > label:hover {
    color: #f3c78e;
}

.rating-star > label:hover ~ label {
    color: #f3c78e;
}

.ct-bar {
    stroke-linecap: round;
    stroke-width: 10px;
}

.ct-label {
    fill: #374151;
    color: #374151;
    font-size: 0.75rem;
    margin-top: 6px;
    font-weight: 500;
}

.ct-slice-pie {
    stroke: #ffffff;
    stroke-width: 3px;
}

.ct-chart-donut .ct-series {
    stroke: #ffffff;
    stroke-width: 3px;
}

.ct-chart-pie .ct-label, .ct-chart-donut .ct-label {
    font-size: 0.75rem;
    font-weight: 500;
}

.small-chart {
    margin-left: -1rem;
}

.ct-chart-pie .ct-label, .ct-chart-donut .ct-label {
    color: #ffffff;
    fill: #ffffff;
    font-size: 1rem;
    font-weight: 500;
}

.ct-series-g .ct-grid {
    stroke: #F8BD7A;
    stroke-width: 2px;
    stroke-dasharray: 2px;
}

.ct-series-g .ct-label.ct-horizontal.ct-end {
    margin-left: -9px;
    margin-top: 10px;
    color: #1F2937;
}

.dropdown-menu .dropdown-header,
.dropdown-menu .dropdown-item {
    padding: 0.5rem 1rem;
    font-size: 0.875rem;
}

.dropdown-menu .dropdown-header .dropdown-icon,
.dropdown-menu .dropdown-item .dropdown-icon {
    height: 1.25rem;
    width: 1.25rem;
}

.dropdown-menu .dropdown-header {
    color: #111827;
    font-weight: 500;
}

.dropdown-menu .dropdown-item {
    transition: all 0.2s ease;
    font-weight: 400;
}

.show .dropdown-menu {
    animation: show-dropdown 0.2s ease forwards;
}

.dropdown-menu.dropdown-menu-xs {
    min-width: 120px;
    max-width: 120px;
    box-shadow: 0 2px 5px rgba(140, 152, 164, 0.2);
}

.dropdown-menu-sm {
    min-width: 100px;
    border: 1rem;
}

.dropdown-menu-md {
    min-width: 180px;
    border: 1rem;
}

.dropdown-menu-lg {
    min-width: 350px;
    border-radius: 1rem;
}

@media (max-width: 575.98px) {
    .dropdown-menu-lg {
        min-width: 300px;
    }
}

[data-toggle]:hover {
    cursor: pointer;
}

.dropdown-toggle:after, .dropend .dropdown-toggle:after, .dropstart .dropdown-toggle:before, .dropup .dropdown-toggle:after {
    display: none;
}

/**
 * = Icon boxes
 */
.icon {
    height: 2rem;
}

.icon.icon-xxs {
    height: 1rem;
}

.icon.icon-xs {
    height: 1.25rem;
}

.icon.icon-sm {
    height: 1.5rem;
}

.icon.icon-lg {
    height: 3.5rem;
}

.icon.icon-xl {
    height: 4.5rem;
}

.icon.icon-xxl {
    height: 6rem;
}

.icon.active-dot svg {
    height: 0.7rem;
}

.icon-shape {
    width: 4rem;
    height: 4rem;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

.icon-shape svg {
    height: 2rem;
}

.icon-shape.icon-xxs {
    width: 1.5rem;
    height: 1.5rem;
}

.icon-shape.icon-xxs svg {
    height: 1rem;
}

.icon-shape.icon-xs {
    width: 2.5rem;
    height: 2.5rem;
}

.icon-shape.icon-xs svg {
    height: 1.25rem;
}

.icon-shape.icon-sm {
    width: 3.275rem;
    height: 3.275rem;
}

.icon-shape.icon-sm svg {
    height: 1.5rem;
}

.icon-shape.icon-lg {
    width: 5rem;
    height: 5rem;
}

.icon-shape.icon-lg svg {
    height: 3.5rem;
}

.icon-shape.icon-xl {
    width: 6rem;
    height: 6rem;
}

.icon-shape.icon-xl svg {
    height: 4.5rem;
}

.icon-shape.icon-xxl {
    width: 7.5rem;
    height: 7.5rem;
}

.icon-shape.icon-xxl svg {
    height: 6rem;
}

.rating-star:hover {
    cursor: pointer;
    color: #f3c78e;
}

.toggle-icon {
    height: 1.875rem;
}

.w--20 {
    width: 20px;
}

.calendar {
    width: 3.125rem;
    line-height: 1;
    flex-direction: column;
    text-align: center;
    border-radius: 0.5rem;
}

.calendar .calendar-month {
    background-color: #E11D48;
    color: #ffffff;
    border-radius: 0.5rem 0.5rem 0 0;
    padding: 0.275rem;
    font-weight: 500;
}

.calendar .calendar-day {
    font-size: 1.5rem;
    padding: 0.25rem;
    background-color: #F2F4F6;
    border-top: 0;
    border-radius: 0 0 0.5rem 0.5rem;
    color: #1F2937;
    font-weight: 500;
}

.dot {
    width: 12px;
    height: 12px;
}

.bell-dot {
    display: inline-block;
    position: absolute;
    top: -11px;
    right: 6px;
    height: 10px;
    width: 10px;
    border: 2px solid #F2F4F6;
}

.notification-bell.unread::before {
    position: absolute;
    content: "";
    background-color: #E11D48;
    right: 12px;
    top: 7px;
    height: 0.75rem;
    width: 0.75rem;
    border-radius: 50%;
    border: 2px solid #F2F4F6;
}

.bootstrap-big-icon {
    position: absolute;
    opacity: 0.05;
    transform: rotate(17deg);
}

@media (min-width: 992px) {
    .bootstrap-big-icon {
        right: -20%;
        bottom: 6%;
    }
}

@media (min-width: 1200px) {
    .bootstrap-big-icon {
        right: -10%;
        bottom: 6%;
    }
}

.github-big-icon {
    position: absolute;
    right: 80px;
}

.github-big-icon svg {
    color: #9CA3AF;
    height: 800px;
    opacity: 0.2;
}

.icon-shape-primary {
    color: #1F2937;
    background-color: rgba(31, 41, 55, 0.3);
}

.icon-shape-secondary {
    color: #f0bc74;
    background-color: rgba(240, 188, 116, 0.3);
}

.icon-shape-tertiary {
    color: #31316A;
    background-color: rgba(49, 49, 106, 0.3);
}

.icon-shape-success {
    color: #10B981;
    background-color: rgba(16, 185, 129, 0.3);
}

.icon-shape-info {
    color: #2361ce;
    background-color: rgba(35, 97, 206, 0.3);
}

.icon-shape-warning {
    color: #f3c78e;
    background-color: rgba(243, 199, 142, 0.3);
}

.icon-shape-danger {
    color: #E11D48;
    background-color: rgba(225, 29, 72, 0.3);
}

.icon-shape-white {
    color: #ffffff;
    background-color: rgba(255, 255, 255, 0.3);
}

.icon-shape-indigo {
    color: #4F46E5;
    background-color: rgba(79, 70, 229, 0.3);
}

.icon-shape-purple {
    color: #7C3AED;
    background-color: rgba(124, 58, 237, 0.3);
}

.icon-shape-yellow-100 {
    color: #ffeed6;
    background-color: rgba(255, 238, 214, 0.3);
}

.icon-shape-yellow-200 {
    color: #f5dbb8;
    background-color: rgba(245, 219, 184, 0.3);
}

.icon-shape-gray-50 {
    color: #F9FAFB;
    background-color: rgba(249, 250, 251, 0.3);
}

.icon-shape-gray-100 {
    color: #F2F4F6;
    background-color: rgba(242, 244, 246, 0.3);
}

.icon-shape-gray-200 {
    color: #E5E7EB;
    background-color: rgba(229, 231, 235, 0.3);
}

.icon-shape-gray-300 {
    color: #D1D5DB;
    background-color: rgba(209, 213, 219, 0.3);
}

.icon-shape-gray-400 {
    color: #9CA3AF;
    background-color: rgba(156, 163, 175, 0.3);
}

.icon-shape-gray-500 {
    color: #6B7280;
    background-color: rgba(107, 114, 128, 0.3);
}

.icon-shape-gray-600 {
    color: #4B5563;
    background-color: rgba(75, 85, 99, 0.3);
}

.icon-shape-gray-700 {
    color: #374151;
    background-color: rgba(55, 65, 81, 0.3);
}

.icon-shape-gray-800 {
    color: #1F2937;
    background-color: rgba(31, 41, 55, 0.3);
}

.icon-shape-gray-900 {
    color: #111827;
    background-color: rgba(17, 24, 39, 0.3);
}

/**
 * = Images
 */
.image-xl {
    height: 20rem;
}

.image-xl img {
    height: 20rem;
}

.image-lg {
    height: 12rem;
}

.image-lg img {
    height: 12rem;
}

.image-md {
    height: 5.5rem;
}

.image-md img {
    height: 5.5rem;
}

.image-sm {
    height: 3rem;
}

.image-sm img {
    height: 3rem;
}

.image-xs {
    height: 1.5rem;
}

.image-xs img {
    height: 1.5rem;
}

.image-small {
    height: 1rem;
}

.image-small img {
    height: 1rem;
}

.full-image {
    height: 100%;
}

.language-flag {
    width: auto;
    height: 1rem;
    margin-right: 0.4rem;
    position: relative;
    top: -2px;
}

.home-pattern {
    fill: #F2F4F6;
}

.form-bg-image {
    background-repeat: no-repeat !important;
    background-position: top center !important;
}

/**
 * = List groups
 */
.list-group-space .list-group-item {
    margin-bottom: 1.5rem;
    border-radius: 0.5rem;
}

.list-group-item {
    border: 0;
}

.list-group-item.active {
    z-index: 2;
    color: #ffffff;
    background-color: #1F2937;
    border-color: #1F2937;
}

.list-group-item i {
    width: 1rem;
}

.list-group-img {
    width: 3rem;
    height: 3rem;
    border-radius: 50%;
    vertical-align: top;
    margin: -0.1rem 1.2rem 0 -0.2rem;
}

.list-group-content {
    flex: 1;
    min-width: 0;
}

.list-group-content > p {
    color: #6B7280;
    line-height: 1.5;
    margin: 0.2rem 0 0;
}

.list-group-heading {
    font-size: 1rem;
    color: #1F2937;
}

.list-group-heading > small, .list-group-heading > .small {
    float: right;
    color: #6B7280;
    font-weight: 500;
}

.list-group.simple-list .list-group-item {
    background: transparent;
    border: none;
    padding: 0.375rem 0.125rem;
}

.list-group.simple-list .list-group-item i {
    vertical-align: middle;
    width: 35px;
    display: inline-block;
}

.news-list .row > [class*=col] {
    padding: 0 0.25rem;
}

.news-list > li:not(:last-child) {
    margin-bottom: 0.75rem;
}

.news-list img {
    min-height: 100%;
    -o-object-fit: cover;
    object-fit: cover;
}

/**
 * = Modals
 */
.modal.static-example {
    position: relative;
    display: block;
}

.modal-content {
    border: 0;
    border-radius: 0.5rem;
}

.modal-fluid .modal-dialog {
    margin-top: 0;
    margin-bottom: 0;
}

.modal-fluid .modal-content {
    border-radius: 0;
}

.modal-primary .modal-title {
    color: color-yiq(#1F2937);
}

.modal-primary .modal-header,
.modal-primary .modal-footer {
    border-color: rgba(31, 41, 55, 0.075);
}

.modal-primary .modal-content {
    background-color: #1F2937;
    color: color-yiq(#1F2937);
}

.modal-primary .modal-content .heading {
    color: color-yiq(#1F2937);
}

.modal-primary .close > span:not(.sr-only) {
    color: #ffffff;
}

.modal-secondary .modal-title {
    color: color-yiq(#f0bc74);
}

.modal-secondary .modal-header,
.modal-secondary .modal-footer {
    border-color: rgba(240, 188, 116, 0.075);
}

.modal-secondary .modal-content {
    background-color: #f0bc74;
    color: color-yiq(#f0bc74);
}

.modal-secondary .modal-content .heading {
    color: color-yiq(#f0bc74);
}

.modal-secondary .close > span:not(.sr-only) {
    color: #ffffff;
}

.modal-tertiary .modal-title {
    color: color-yiq(#31316A);
}

.modal-tertiary .modal-header,
.modal-tertiary .modal-footer {
    border-color: rgba(49, 49, 106, 0.075);
}

.modal-tertiary .modal-content {
    background-color: #31316A;
    color: color-yiq(#31316A);
}

.modal-tertiary .modal-content .heading {
    color: color-yiq(#31316A);
}

.modal-tertiary .close > span:not(.sr-only) {
    color: #ffffff;
}

.modal-success .modal-title {
    color: color-yiq(#10B981);
}

.modal-success .modal-header,
.modal-success .modal-footer {
    border-color: rgba(16, 185, 129, 0.075);
}

.modal-success .modal-content {
    background-color: #10B981;
    color: color-yiq(#10B981);
}

.modal-success .modal-content .heading {
    color: color-yiq(#10B981);
}

.modal-success .close > span:not(.sr-only) {
    color: #ffffff;
}

.modal-info .modal-title {
    color: color-yiq(#2361ce);
}

.modal-info .modal-header,
.modal-info .modal-footer {
    border-color: rgba(35, 97, 206, 0.075);
}

.modal-info .modal-content {
    background-color: #2361ce;
    color: color-yiq(#2361ce);
}

.modal-info .modal-content .heading {
    color: color-yiq(#2361ce);
}

.modal-info .close > span:not(.sr-only) {
    color: #ffffff;
}

.modal-warning .modal-title {
    color: color-yiq(#f3c78e);
}

.modal-warning .modal-header,
.modal-warning .modal-footer {
    border-color: rgba(243, 199, 142, 0.075);
}

.modal-warning .modal-content {
    background-color: #f3c78e;
    color: color-yiq(#f3c78e);
}

.modal-warning .modal-content .heading {
    color: color-yiq(#f3c78e);
}

.modal-warning .close > span:not(.sr-only) {
    color: #ffffff;
}

.modal-danger .modal-title {
    color: color-yiq(#E11D48);
}

.modal-danger .modal-header,
.modal-danger .modal-footer {
    border-color: rgba(225, 29, 72, 0.075);
}

.modal-danger .modal-content {
    background-color: #E11D48;
    color: color-yiq(#E11D48);
}

.modal-danger .modal-content .heading {
    color: color-yiq(#E11D48);
}

.modal-danger .close > span:not(.sr-only) {
    color: #ffffff;
}

.modal-white .modal-title {
    color: color-yiq(#ffffff);
}

.modal-white .modal-header,
.modal-white .modal-footer {
    border-color: rgba(255, 255, 255, 0.075);
}

.modal-white .modal-content {
    background-color: #ffffff;
    color: color-yiq(#ffffff);
}

.modal-white .modal-content .heading {
    color: color-yiq(#ffffff);
}

.modal-white .close > span:not(.sr-only) {
    color: #ffffff;
}

.modal-indigo .modal-title {
    color: color-yiq(#4F46E5);
}

.modal-indigo .modal-header,
.modal-indigo .modal-footer {
    border-color: rgba(79, 70, 229, 0.075);
}

.modal-indigo .modal-content {
    background-color: #4F46E5;
    color: color-yiq(#4F46E5);
}

.modal-indigo .modal-content .heading {
    color: color-yiq(#4F46E5);
}

.modal-indigo .close > span:not(.sr-only) {
    color: #ffffff;
}

.modal-purple .modal-title {
    color: color-yiq(#7C3AED);
}

.modal-purple .modal-header,
.modal-purple .modal-footer {
    border-color: rgba(124, 58, 237, 0.075);
}

.modal-purple .modal-content {
    background-color: #7C3AED;
    color: color-yiq(#7C3AED);
}

.modal-purple .modal-content .heading {
    color: color-yiq(#7C3AED);
}

.modal-purple .close > span:not(.sr-only) {
    color: #ffffff;
}

.modal-yellow-100 .modal-title {
    color: color-yiq(#ffeed6);
}

.modal-yellow-100 .modal-header,
.modal-yellow-100 .modal-footer {
    border-color: rgba(255, 238, 214, 0.075);
}

.modal-yellow-100 .modal-content {
    background-color: #ffeed6;
    color: color-yiq(#ffeed6);
}

.modal-yellow-100 .modal-content .heading {
    color: color-yiq(#ffeed6);
}

.modal-yellow-100 .close > span:not(.sr-only) {
    color: #ffffff;
}

.modal-yellow-200 .modal-title {
    color: color-yiq(#f5dbb8);
}

.modal-yellow-200 .modal-header,
.modal-yellow-200 .modal-footer {
    border-color: rgba(245, 219, 184, 0.075);
}

.modal-yellow-200 .modal-content {
    background-color: #f5dbb8;
    color: color-yiq(#f5dbb8);
}

.modal-yellow-200 .modal-content .heading {
    color: color-yiq(#f5dbb8);
}

.modal-yellow-200 .close > span:not(.sr-only) {
    color: #ffffff;
}

.modal-gray-50 .modal-title {
    color: color-yiq(#F9FAFB);
}

.modal-gray-50 .modal-header,
.modal-gray-50 .modal-footer {
    border-color: rgba(249, 250, 251, 0.075);
}

.modal-gray-50 .modal-content {
    background-color: #F9FAFB;
    color: color-yiq(#F9FAFB);
}

.modal-gray-50 .modal-content .heading {
    color: color-yiq(#F9FAFB);
}

.modal-gray-50 .close > span:not(.sr-only) {
    color: #ffffff;
}

.modal-gray-100 .modal-title {
    color: color-yiq(#F2F4F6);
}

.modal-gray-100 .modal-header,
.modal-gray-100 .modal-footer {
    border-color: rgba(242, 244, 246, 0.075);
}

.modal-gray-100 .modal-content {
    background-color: #F2F4F6;
    color: color-yiq(#F2F4F6);
}

.modal-gray-100 .modal-content .heading {
    color: color-yiq(#F2F4F6);
}

.modal-gray-100 .close > span:not(.sr-only) {
    color: #ffffff;
}

.modal-gray-200 .modal-title {
    color: color-yiq(#E5E7EB);
}

.modal-gray-200 .modal-header,
.modal-gray-200 .modal-footer {
    border-color: rgba(229, 231, 235, 0.075);
}

.modal-gray-200 .modal-content {
    background-color: #E5E7EB;
    color: color-yiq(#E5E7EB);
}

.modal-gray-200 .modal-content .heading {
    color: color-yiq(#E5E7EB);
}

.modal-gray-200 .close > span:not(.sr-only) {
    color: #ffffff;
}

.modal-gray-300 .modal-title {
    color: color-yiq(#D1D5DB);
}

.modal-gray-300 .modal-header,
.modal-gray-300 .modal-footer {
    border-color: rgba(209, 213, 219, 0.075);
}

.modal-gray-300 .modal-content {
    background-color: #D1D5DB;
    color: color-yiq(#D1D5DB);
}

.modal-gray-300 .modal-content .heading {
    color: color-yiq(#D1D5DB);
}

.modal-gray-300 .close > span:not(.sr-only) {
    color: #ffffff;
}

.modal-gray-400 .modal-title {
    color: color-yiq(#9CA3AF);
}

.modal-gray-400 .modal-header,
.modal-gray-400 .modal-footer {
    border-color: rgba(156, 163, 175, 0.075);
}

.modal-gray-400 .modal-content {
    background-color: #9CA3AF;
    color: color-yiq(#9CA3AF);
}

.modal-gray-400 .modal-content .heading {
    color: color-yiq(#9CA3AF);
}

.modal-gray-400 .close > span:not(.sr-only) {
    color: #ffffff;
}

.modal-gray-500 .modal-title {
    color: color-yiq(#6B7280);
}

.modal-gray-500 .modal-header,
.modal-gray-500 .modal-footer {
    border-color: rgba(107, 114, 128, 0.075);
}

.modal-gray-500 .modal-content {
    background-color: #6B7280;
    color: color-yiq(#6B7280);
}

.modal-gray-500 .modal-content .heading {
    color: color-yiq(#6B7280);
}

.modal-gray-500 .close > span:not(.sr-only) {
    color: #ffffff;
}

.modal-gray-600 .modal-title {
    color: color-yiq(#4B5563);
}

.modal-gray-600 .modal-header,
.modal-gray-600 .modal-footer {
    border-color: rgba(75, 85, 99, 0.075);
}

.modal-gray-600 .modal-content {
    background-color: #4B5563;
    color: color-yiq(#4B5563);
}

.modal-gray-600 .modal-content .heading {
    color: color-yiq(#4B5563);
}

.modal-gray-600 .close > span:not(.sr-only) {
    color: #ffffff;
}

.modal-gray-700 .modal-title {
    color: color-yiq(#374151);
}

.modal-gray-700 .modal-header,
.modal-gray-700 .modal-footer {
    border-color: rgba(55, 65, 81, 0.075);
}

.modal-gray-700 .modal-content {
    background-color: #374151;
    color: color-yiq(#374151);
}

.modal-gray-700 .modal-content .heading {
    color: color-yiq(#374151);
}

.modal-gray-700 .close > span:not(.sr-only) {
    color: #ffffff;
}

.modal-gray-800 .modal-title {
    color: color-yiq(#1F2937);
}

.modal-gray-800 .modal-header,
.modal-gray-800 .modal-footer {
    border-color: rgba(31, 41, 55, 0.075);
}

.modal-gray-800 .modal-content {
    background-color: #1F2937;
    color: color-yiq(#1F2937);
}

.modal-gray-800 .modal-content .heading {
    color: color-yiq(#1F2937);
}

.modal-gray-800 .close > span:not(.sr-only) {
    color: #ffffff;
}

.modal-gray-900 .modal-title {
    color: color-yiq(#111827);
}

.modal-gray-900 .modal-header,
.modal-gray-900 .modal-footer {
    border-color: rgba(17, 24, 39, 0.075);
}

.modal-gray-900 .modal-content {
    background-color: #111827;
    color: color-yiq(#111827);
}

.modal-gray-900 .modal-content .heading {
    color: color-yiq(#111827);
}

.modal-gray-900 .close > span:not(.sr-only) {
    color: #ffffff;
}

/**
 * = Navs
 */
.nav-link {
    color: #1F2937;
}

.nav-link:hover, .nav-link.active {
    color: #1F2937;
}

.nav-link:hover img, .nav-link.active img {
    opacity: inherit;
    transition: all 0.2s ease;
}

.nav-link span {
    position: relative;
}

.nav-tabs .nav-item {
    margin-bottom: 0;
}

.nav-tabs .nav-link {
    border: 0;
    padding: 1rem 1rem;
    background-color: #ffffff;
}

.nav-tabs .nav-link.active {
    color: #ffffff;
    background-color: #1F2937;
}

.nav-tabs.nav-dark .nav-link.active {
    color: #ffffff;
    background-color: #12358a;
}

.nav-tabs.nav-light .nav-link.active {
    color: #111827;
    background-color: #9CA3AF;
}

.nav-tabs.nav-light .nav-link:hover {
    color: #111827;
}

.nav-pills .nav-item:not(:last-child) {
    padding-right: 1rem;
}

.nav-pills .nav-link {
    padding: 0.75rem 0.85rem;
    transition: all 0.2s ease;
    box-shadow: none;
    border: 1px solid #9CA3AF;
}

.nav-pills .nav-link.avatar-link {
    border: 0;
}

.nav-pills .nav-link:hover {
    color: #1F2937;
}

.nav-pills .nav-link.active,
.nav-pills .show > .nav-link {
    color: #1F2937;
    background-color: #f8f8f8;
    border-color: #1F2937;
}

.nav-pills.rounded .nav-link {
    border-radius: 30px;
}

.nav-pills.rounded.vertical-tab .nav-link {
    margin-bottom: 0.625rem;
    min-width: 100px;
}

.nav-pills.rounded.vertical-tab .nav-item:not(:last-child) {
    padding-right: 0;
}

.nav-pills.bordered-pill-md .nav-link {
    border: 0.125rem solid #E5E7EB;
    font-weight: 500;
}

.nav-pills.vertical-tab .nav-link {
    margin-bottom: 0.625rem;
}

.nav-pills.vertical-tab .nav-item:not(:last-child) {
    padding-right: 0;
}

.nav-pills .nav-item {
    margin-bottom: 1rem;
}

@media (max-width: 575.98px) {
    .nav-pills:not(.nav-pills-circle) .nav-item {
        padding-right: 0;
    }
}

.nav-pill-circle .nav-link {
    display: flex;
    text-align: center;
    height: 80px;
    width: 80px;
    padding: 0;
    box-shadow: none;
    border-radius: 50%;
    align-items: center;
    justify-content: center;
}

.nav-pill-circle .nav-link.avatar-link {
    box-shadow: none;
}

.nav-pill-circle.vertical-tab .nav-link-icon i,
.nav-pill-circle.vertical-tab .nav-link-icon svg {
    font-size: 1.5rem;
}

.nav-pill-circle.vertical-tab .nav-item:not(:last-child) {
    padding-right: 0;
}

.nav-pill-circle .nav-link-icon i,
.nav-pill-circle .nav-link-icon svg {
    font-size: 1.25rem;
    margin: 0;
    display: block;
}

.nav-pill-square .nav-link {
    text-align: center;
    min-width: 80px;
    box-shadow: none;
    display: flex;
    align-items: center;
    justify-content: center;
}

.nav-pill-square.vertical-tab .nav-link {
    margin-bottom: 0.625rem;
    min-width: 100px;
}

.nav-pill-square.vertical-tab .nav-item:not(:last-child) {
    padding-right: 0;
}

.nav-pill-square .nav-link-icon i,
.nav-pill-square .nav-link-icon svg {
    font-size: 1.25rem;
    margin: 0;
    display: block;
    line-height: 50px;
}

.nav-wrapper {
    padding: 1rem 0;
    border-top-left-radius: 0.5rem;
    border-top-right-radius: 0.5rem;
}

.nav-wrapper + .card {
    border-top-left-radius: 0;
    border-top-right-radius: 0;
    border-bottom-right-radius: 0.5rem;
    border-bottom-left-radius: 0.5rem;
}

.tab-content > .tab-pane {
    display: none;
}

.tab-content > .tab-pane pre {
    padding: 0;
    margin: 0;
}

.tab-content > .active {
    display: block;
}

@media (min-width: 992px) {
    .nav-pills .nav-item {
        margin-bottom: 0;
    }
}

/**
 * = Paginations
 */
.circle-pagination .page-link,
.circle-pagination span {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 34px;
    height: 34px;
    padding: 0;
    border-radius: 50%;
}

/**
 * = Popovers
 */
.popover {
    border: 0;
}

.popover-header {
    font-weight: 500;
}

.popover-primary {
    background-color: #1F2937;
}

.popover-primary .popover-header {
    background-color: #1F2937;
    color: color-yiq(#1F2937);
}

.popover-primary .popover-body {
    color: color-yiq(#1F2937);
}

.popover-primary .popover-header {
    border-color: rgba(31, 41, 55, 0.2);
}

.popover-primary.bs-popover-top .arrow::after, .popover-primary.bs-popover-auto[data-popper-placement^=top] .arrow::after {
    border-top-color: #1F2937;
}

.popover-primary.bs-popover-end .arrow::after, .popover-primary.bs-popover-auto[data-popper-placement^=right] .arrow::after {
    border-right-color: #1F2937;
}

.popover-primary.bs-popover-bottom .arrow::after, .popover-primary.bs-popover-auto[data-popper-placement^=bottom] .arrow::after {
    border-bottom-color: #1F2937;
}

.popover-primary.bs-popover-start .arrow::after, .popover-primary.bs-popover-auto[data-popper-placement^=left] .arrow::after {
    border-left-color: #1F2937;
}

.popover-secondary {
    background-color: #f0bc74;
}

.popover-secondary .popover-header {
    background-color: #f0bc74;
    color: color-yiq(#f0bc74);
}

.popover-secondary .popover-body {
    color: color-yiq(#f0bc74);
}

.popover-secondary .popover-header {
    border-color: rgba(240, 188, 116, 0.2);
}

.popover-secondary.bs-popover-top .arrow::after, .popover-secondary.bs-popover-auto[data-popper-placement^=top] .arrow::after {
    border-top-color: #f0bc74;
}

.popover-secondary.bs-popover-end .arrow::after, .popover-secondary.bs-popover-auto[data-popper-placement^=right] .arrow::after {
    border-right-color: #f0bc74;
}

.popover-secondary.bs-popover-bottom .arrow::after, .popover-secondary.bs-popover-auto[data-popper-placement^=bottom] .arrow::after {
    border-bottom-color: #f0bc74;
}

.popover-secondary.bs-popover-start .arrow::after, .popover-secondary.bs-popover-auto[data-popper-placement^=left] .arrow::after {
    border-left-color: #f0bc74;
}

.popover-tertiary {
    background-color: #31316A;
}

.popover-tertiary .popover-header {
    background-color: #31316A;
    color: color-yiq(#31316A);
}

.popover-tertiary .popover-body {
    color: color-yiq(#31316A);
}

.popover-tertiary .popover-header {
    border-color: rgba(49, 49, 106, 0.2);
}

.popover-tertiary.bs-popover-top .arrow::after, .popover-tertiary.bs-popover-auto[data-popper-placement^=top] .arrow::after {
    border-top-color: #31316A;
}

.popover-tertiary.bs-popover-end .arrow::after, .popover-tertiary.bs-popover-auto[data-popper-placement^=right] .arrow::after {
    border-right-color: #31316A;
}

.popover-tertiary.bs-popover-bottom .arrow::after, .popover-tertiary.bs-popover-auto[data-popper-placement^=bottom] .arrow::after {
    border-bottom-color: #31316A;
}

.popover-tertiary.bs-popover-start .arrow::after, .popover-tertiary.bs-popover-auto[data-popper-placement^=left] .arrow::after {
    border-left-color: #31316A;
}

.popover-success {
    background-color: #10B981;
}

.popover-success .popover-header {
    background-color: #10B981;
    color: color-yiq(#10B981);
}

.popover-success .popover-body {
    color: color-yiq(#10B981);
}

.popover-success .popover-header {
    border-color: rgba(16, 185, 129, 0.2);
}

.popover-success.bs-popover-top .arrow::after, .popover-success.bs-popover-auto[data-popper-placement^=top] .arrow::after {
    border-top-color: #10B981;
}

.popover-success.bs-popover-end .arrow::after, .popover-success.bs-popover-auto[data-popper-placement^=right] .arrow::after {
    border-right-color: #10B981;
}

.popover-success.bs-popover-bottom .arrow::after, .popover-success.bs-popover-auto[data-popper-placement^=bottom] .arrow::after {
    border-bottom-color: #10B981;
}

.popover-success.bs-popover-start .arrow::after, .popover-success.bs-popover-auto[data-popper-placement^=left] .arrow::after {
    border-left-color: #10B981;
}

.popover-info {
    background-color: #2361ce;
}

.popover-info .popover-header {
    background-color: #2361ce;
    color: color-yiq(#2361ce);
}

.popover-info .popover-body {
    color: color-yiq(#2361ce);
}

.popover-info .popover-header {
    border-color: rgba(35, 97, 206, 0.2);
}

.popover-info.bs-popover-top .arrow::after, .popover-info.bs-popover-auto[data-popper-placement^=top] .arrow::after {
    border-top-color: #2361ce;
}

.popover-info.bs-popover-end .arrow::after, .popover-info.bs-popover-auto[data-popper-placement^=right] .arrow::after {
    border-right-color: #2361ce;
}

.popover-info.bs-popover-bottom .arrow::after, .popover-info.bs-popover-auto[data-popper-placement^=bottom] .arrow::after {
    border-bottom-color: #2361ce;
}

.popover-info.bs-popover-start .arrow::after, .popover-info.bs-popover-auto[data-popper-placement^=left] .arrow::after {
    border-left-color: #2361ce;
}

.popover-warning {
    background-color: #f3c78e;
}

.popover-warning .popover-header {
    background-color: #f3c78e;
    color: color-yiq(#f3c78e);
}

.popover-warning .popover-body {
    color: color-yiq(#f3c78e);
}

.popover-warning .popover-header {
    border-color: rgba(243, 199, 142, 0.2);
}

.popover-warning.bs-popover-top .arrow::after, .popover-warning.bs-popover-auto[data-popper-placement^=top] .arrow::after {
    border-top-color: #f3c78e;
}

.popover-warning.bs-popover-end .arrow::after, .popover-warning.bs-popover-auto[data-popper-placement^=right] .arrow::after {
    border-right-color: #f3c78e;
}

.popover-warning.bs-popover-bottom .arrow::after, .popover-warning.bs-popover-auto[data-popper-placement^=bottom] .arrow::after {
    border-bottom-color: #f3c78e;
}

.popover-warning.bs-popover-start .arrow::after, .popover-warning.bs-popover-auto[data-popper-placement^=left] .arrow::after {
    border-left-color: #f3c78e;
}

.popover-danger {
    background-color: #E11D48;
}

.popover-danger .popover-header {
    background-color: #E11D48;
    color: color-yiq(#E11D48);
}

.popover-danger .popover-body {
    color: color-yiq(#E11D48);
}

.popover-danger .popover-header {
    border-color: rgba(225, 29, 72, 0.2);
}

.popover-danger.bs-popover-top .arrow::after, .popover-danger.bs-popover-auto[data-popper-placement^=top] .arrow::after {
    border-top-color: #E11D48;
}

.popover-danger.bs-popover-end .arrow::after, .popover-danger.bs-popover-auto[data-popper-placement^=right] .arrow::after {
    border-right-color: #E11D48;
}

.popover-danger.bs-popover-bottom .arrow::after, .popover-danger.bs-popover-auto[data-popper-placement^=bottom] .arrow::after {
    border-bottom-color: #E11D48;
}

.popover-danger.bs-popover-start .arrow::after, .popover-danger.bs-popover-auto[data-popper-placement^=left] .arrow::after {
    border-left-color: #E11D48;
}

.popover-white {
    background-color: #ffffff;
}

.popover-white .popover-header {
    background-color: #ffffff;
    color: color-yiq(#ffffff);
}

.popover-white .popover-body {
    color: color-yiq(#ffffff);
}

.popover-white .popover-header {
    border-color: rgba(255, 255, 255, 0.2);
}

.popover-white.bs-popover-top .arrow::after, .popover-white.bs-popover-auto[data-popper-placement^=top] .arrow::after {
    border-top-color: #ffffff;
}

.popover-white.bs-popover-end .arrow::after, .popover-white.bs-popover-auto[data-popper-placement^=right] .arrow::after {
    border-right-color: #ffffff;
}

.popover-white.bs-popover-bottom .arrow::after, .popover-white.bs-popover-auto[data-popper-placement^=bottom] .arrow::after {
    border-bottom-color: #ffffff;
}

.popover-white.bs-popover-start .arrow::after, .popover-white.bs-popover-auto[data-popper-placement^=left] .arrow::after {
    border-left-color: #ffffff;
}

.popover-indigo {
    background-color: #4F46E5;
}

.popover-indigo .popover-header {
    background-color: #4F46E5;
    color: color-yiq(#4F46E5);
}

.popover-indigo .popover-body {
    color: color-yiq(#4F46E5);
}

.popover-indigo .popover-header {
    border-color: rgba(79, 70, 229, 0.2);
}

.popover-indigo.bs-popover-top .arrow::after, .popover-indigo.bs-popover-auto[data-popper-placement^=top] .arrow::after {
    border-top-color: #4F46E5;
}

.popover-indigo.bs-popover-end .arrow::after, .popover-indigo.bs-popover-auto[data-popper-placement^=right] .arrow::after {
    border-right-color: #4F46E5;
}

.popover-indigo.bs-popover-bottom .arrow::after, .popover-indigo.bs-popover-auto[data-popper-placement^=bottom] .arrow::after {
    border-bottom-color: #4F46E5;
}

.popover-indigo.bs-popover-start .arrow::after, .popover-indigo.bs-popover-auto[data-popper-placement^=left] .arrow::after {
    border-left-color: #4F46E5;
}

.popover-purple {
    background-color: #7C3AED;
}

.popover-purple .popover-header {
    background-color: #7C3AED;
    color: color-yiq(#7C3AED);
}

.popover-purple .popover-body {
    color: color-yiq(#7C3AED);
}

.popover-purple .popover-header {
    border-color: rgba(124, 58, 237, 0.2);
}

.popover-purple.bs-popover-top .arrow::after, .popover-purple.bs-popover-auto[data-popper-placement^=top] .arrow::after {
    border-top-color: #7C3AED;
}

.popover-purple.bs-popover-end .arrow::after, .popover-purple.bs-popover-auto[data-popper-placement^=right] .arrow::after {
    border-right-color: #7C3AED;
}

.popover-purple.bs-popover-bottom .arrow::after, .popover-purple.bs-popover-auto[data-popper-placement^=bottom] .arrow::after {
    border-bottom-color: #7C3AED;
}

.popover-purple.bs-popover-start .arrow::after, .popover-purple.bs-popover-auto[data-popper-placement^=left] .arrow::after {
    border-left-color: #7C3AED;
}

.popover-yellow-100 {
    background-color: #ffeed6;
}

.popover-yellow-100 .popover-header {
    background-color: #ffeed6;
    color: color-yiq(#ffeed6);
}

.popover-yellow-100 .popover-body {
    color: color-yiq(#ffeed6);
}

.popover-yellow-100 .popover-header {
    border-color: rgba(255, 238, 214, 0.2);
}

.popover-yellow-100.bs-popover-top .arrow::after, .popover-yellow-100.bs-popover-auto[data-popper-placement^=top] .arrow::after {
    border-top-color: #ffeed6;
}

.popover-yellow-100.bs-popover-end .arrow::after, .popover-yellow-100.bs-popover-auto[data-popper-placement^=right] .arrow::after {
    border-right-color: #ffeed6;
}

.popover-yellow-100.bs-popover-bottom .arrow::after, .popover-yellow-100.bs-popover-auto[data-popper-placement^=bottom] .arrow::after {
    border-bottom-color: #ffeed6;
}

.popover-yellow-100.bs-popover-start .arrow::after, .popover-yellow-100.bs-popover-auto[data-popper-placement^=left] .arrow::after {
    border-left-color: #ffeed6;
}

.popover-yellow-200 {
    background-color: #f5dbb8;
}

.popover-yellow-200 .popover-header {
    background-color: #f5dbb8;
    color: color-yiq(#f5dbb8);
}

.popover-yellow-200 .popover-body {
    color: color-yiq(#f5dbb8);
}

.popover-yellow-200 .popover-header {
    border-color: rgba(245, 219, 184, 0.2);
}

.popover-yellow-200.bs-popover-top .arrow::after, .popover-yellow-200.bs-popover-auto[data-popper-placement^=top] .arrow::after {
    border-top-color: #f5dbb8;
}

.popover-yellow-200.bs-popover-end .arrow::after, .popover-yellow-200.bs-popover-auto[data-popper-placement^=right] .arrow::after {
    border-right-color: #f5dbb8;
}

.popover-yellow-200.bs-popover-bottom .arrow::after, .popover-yellow-200.bs-popover-auto[data-popper-placement^=bottom] .arrow::after {
    border-bottom-color: #f5dbb8;
}

.popover-yellow-200.bs-popover-start .arrow::after, .popover-yellow-200.bs-popover-auto[data-popper-placement^=left] .arrow::after {
    border-left-color: #f5dbb8;
}

.popover-gray-50 {
    background-color: #F9FAFB;
}

.popover-gray-50 .popover-header {
    background-color: #F9FAFB;
    color: color-yiq(#F9FAFB);
}

.popover-gray-50 .popover-body {
    color: color-yiq(#F9FAFB);
}

.popover-gray-50 .popover-header {
    border-color: rgba(249, 250, 251, 0.2);
}

.popover-gray-50.bs-popover-top .arrow::after, .popover-gray-50.bs-popover-auto[data-popper-placement^=top] .arrow::after {
    border-top-color: #F9FAFB;
}

.popover-gray-50.bs-popover-end .arrow::after, .popover-gray-50.bs-popover-auto[data-popper-placement^=right] .arrow::after {
    border-right-color: #F9FAFB;
}

.popover-gray-50.bs-popover-bottom .arrow::after, .popover-gray-50.bs-popover-auto[data-popper-placement^=bottom] .arrow::after {
    border-bottom-color: #F9FAFB;
}

.popover-gray-50.bs-popover-start .arrow::after, .popover-gray-50.bs-popover-auto[data-popper-placement^=left] .arrow::after {
    border-left-color: #F9FAFB;
}

.popover-gray-100 {
    background-color: #F2F4F6;
}

.popover-gray-100 .popover-header {
    background-color: #F2F4F6;
    color: color-yiq(#F2F4F6);
}

.popover-gray-100 .popover-body {
    color: color-yiq(#F2F4F6);
}

.popover-gray-100 .popover-header {
    border-color: rgba(242, 244, 246, 0.2);
}

.popover-gray-100.bs-popover-top .arrow::after, .popover-gray-100.bs-popover-auto[data-popper-placement^=top] .arrow::after {
    border-top-color: #F2F4F6;
}

.popover-gray-100.bs-popover-end .arrow::after, .popover-gray-100.bs-popover-auto[data-popper-placement^=right] .arrow::after {
    border-right-color: #F2F4F6;
}

.popover-gray-100.bs-popover-bottom .arrow::after, .popover-gray-100.bs-popover-auto[data-popper-placement^=bottom] .arrow::after {
    border-bottom-color: #F2F4F6;
}

.popover-gray-100.bs-popover-start .arrow::after, .popover-gray-100.bs-popover-auto[data-popper-placement^=left] .arrow::after {
    border-left-color: #F2F4F6;
}

.popover-gray-200 {
    background-color: #E5E7EB;
}

.popover-gray-200 .popover-header {
    background-color: #E5E7EB;
    color: color-yiq(#E5E7EB);
}

.popover-gray-200 .popover-body {
    color: color-yiq(#E5E7EB);
}

.popover-gray-200 .popover-header {
    border-color: rgba(229, 231, 235, 0.2);
}

.popover-gray-200.bs-popover-top .arrow::after, .popover-gray-200.bs-popover-auto[data-popper-placement^=top] .arrow::after {
    border-top-color: #E5E7EB;
}

.popover-gray-200.bs-popover-end .arrow::after, .popover-gray-200.bs-popover-auto[data-popper-placement^=right] .arrow::after {
    border-right-color: #E5E7EB;
}

.popover-gray-200.bs-popover-bottom .arrow::after, .popover-gray-200.bs-popover-auto[data-popper-placement^=bottom] .arrow::after {
    border-bottom-color: #E5E7EB;
}

.popover-gray-200.bs-popover-start .arrow::after, .popover-gray-200.bs-popover-auto[data-popper-placement^=left] .arrow::after {
    border-left-color: #E5E7EB;
}

.popover-gray-300 {
    background-color: #D1D5DB;
}

.popover-gray-300 .popover-header {
    background-color: #D1D5DB;
    color: color-yiq(#D1D5DB);
}

.popover-gray-300 .popover-body {
    color: color-yiq(#D1D5DB);
}

.popover-gray-300 .popover-header {
    border-color: rgba(209, 213, 219, 0.2);
}

.popover-gray-300.bs-popover-top .arrow::after, .popover-gray-300.bs-popover-auto[data-popper-placement^=top] .arrow::after {
    border-top-color: #D1D5DB;
}

.popover-gray-300.bs-popover-end .arrow::after, .popover-gray-300.bs-popover-auto[data-popper-placement^=right] .arrow::after {
    border-right-color: #D1D5DB;
}

.popover-gray-300.bs-popover-bottom .arrow::after, .popover-gray-300.bs-popover-auto[data-popper-placement^=bottom] .arrow::after {
    border-bottom-color: #D1D5DB;
}

.popover-gray-300.bs-popover-start .arrow::after, .popover-gray-300.bs-popover-auto[data-popper-placement^=left] .arrow::after {
    border-left-color: #D1D5DB;
}

.popover-gray-400 {
    background-color: #9CA3AF;
}

.popover-gray-400 .popover-header {
    background-color: #9CA3AF;
    color: color-yiq(#9CA3AF);
}

.popover-gray-400 .popover-body {
    color: color-yiq(#9CA3AF);
}

.popover-gray-400 .popover-header {
    border-color: rgba(156, 163, 175, 0.2);
}

.popover-gray-400.bs-popover-top .arrow::after, .popover-gray-400.bs-popover-auto[data-popper-placement^=top] .arrow::after {
    border-top-color: #9CA3AF;
}

.popover-gray-400.bs-popover-end .arrow::after, .popover-gray-400.bs-popover-auto[data-popper-placement^=right] .arrow::after {
    border-right-color: #9CA3AF;
}

.popover-gray-400.bs-popover-bottom .arrow::after, .popover-gray-400.bs-popover-auto[data-popper-placement^=bottom] .arrow::after {
    border-bottom-color: #9CA3AF;
}

.popover-gray-400.bs-popover-start .arrow::after, .popover-gray-400.bs-popover-auto[data-popper-placement^=left] .arrow::after {
    border-left-color: #9CA3AF;
}

.popover-gray-500 {
    background-color: #6B7280;
}

.popover-gray-500 .popover-header {
    background-color: #6B7280;
    color: color-yiq(#6B7280);
}

.popover-gray-500 .popover-body {
    color: color-yiq(#6B7280);
}

.popover-gray-500 .popover-header {
    border-color: rgba(107, 114, 128, 0.2);
}

.popover-gray-500.bs-popover-top .arrow::after, .popover-gray-500.bs-popover-auto[data-popper-placement^=top] .arrow::after {
    border-top-color: #6B7280;
}

.popover-gray-500.bs-popover-end .arrow::after, .popover-gray-500.bs-popover-auto[data-popper-placement^=right] .arrow::after {
    border-right-color: #6B7280;
}

.popover-gray-500.bs-popover-bottom .arrow::after, .popover-gray-500.bs-popover-auto[data-popper-placement^=bottom] .arrow::after {
    border-bottom-color: #6B7280;
}

.popover-gray-500.bs-popover-start .arrow::after, .popover-gray-500.bs-popover-auto[data-popper-placement^=left] .arrow::after {
    border-left-color: #6B7280;
}

.popover-gray-600 {
    background-color: #4B5563;
}

.popover-gray-600 .popover-header {
    background-color: #4B5563;
    color: color-yiq(#4B5563);
}

.popover-gray-600 .popover-body {
    color: color-yiq(#4B5563);
}

.popover-gray-600 .popover-header {
    border-color: rgba(75, 85, 99, 0.2);
}

.popover-gray-600.bs-popover-top .arrow::after, .popover-gray-600.bs-popover-auto[data-popper-placement^=top] .arrow::after {
    border-top-color: #4B5563;
}

.popover-gray-600.bs-popover-end .arrow::after, .popover-gray-600.bs-popover-auto[data-popper-placement^=right] .arrow::after {
    border-right-color: #4B5563;
}

.popover-gray-600.bs-popover-bottom .arrow::after, .popover-gray-600.bs-popover-auto[data-popper-placement^=bottom] .arrow::after {
    border-bottom-color: #4B5563;
}

.popover-gray-600.bs-popover-start .arrow::after, .popover-gray-600.bs-popover-auto[data-popper-placement^=left] .arrow::after {
    border-left-color: #4B5563;
}

.popover-gray-700 {
    background-color: #374151;
}

.popover-gray-700 .popover-header {
    background-color: #374151;
    color: color-yiq(#374151);
}

.popover-gray-700 .popover-body {
    color: color-yiq(#374151);
}

.popover-gray-700 .popover-header {
    border-color: rgba(55, 65, 81, 0.2);
}

.popover-gray-700.bs-popover-top .arrow::after, .popover-gray-700.bs-popover-auto[data-popper-placement^=top] .arrow::after {
    border-top-color: #374151;
}

.popover-gray-700.bs-popover-end .arrow::after, .popover-gray-700.bs-popover-auto[data-popper-placement^=right] .arrow::after {
    border-right-color: #374151;
}

.popover-gray-700.bs-popover-bottom .arrow::after, .popover-gray-700.bs-popover-auto[data-popper-placement^=bottom] .arrow::after {
    border-bottom-color: #374151;
}

.popover-gray-700.bs-popover-start .arrow::after, .popover-gray-700.bs-popover-auto[data-popper-placement^=left] .arrow::after {
    border-left-color: #374151;
}

.popover-gray-800 {
    background-color: #1F2937;
}

.popover-gray-800 .popover-header {
    background-color: #1F2937;
    color: color-yiq(#1F2937);
}

.popover-gray-800 .popover-body {
    color: color-yiq(#1F2937);
}

.popover-gray-800 .popover-header {
    border-color: rgba(31, 41, 55, 0.2);
}

.popover-gray-800.bs-popover-top .arrow::after, .popover-gray-800.bs-popover-auto[data-popper-placement^=top] .arrow::after {
    border-top-color: #1F2937;
}

.popover-gray-800.bs-popover-end .arrow::after, .popover-gray-800.bs-popover-auto[data-popper-placement^=right] .arrow::after {
    border-right-color: #1F2937;
}

.popover-gray-800.bs-popover-bottom .arrow::after, .popover-gray-800.bs-popover-auto[data-popper-placement^=bottom] .arrow::after {
    border-bottom-color: #1F2937;
}

.popover-gray-800.bs-popover-start .arrow::after, .popover-gray-800.bs-popover-auto[data-popper-placement^=left] .arrow::after {
    border-left-color: #1F2937;
}

.popover-gray-900 {
    background-color: #111827;
}

.popover-gray-900 .popover-header {
    background-color: #111827;
    color: color-yiq(#111827);
}

.popover-gray-900 .popover-body {
    color: color-yiq(#111827);
}

.popover-gray-900 .popover-header {
    border-color: rgba(17, 24, 39, 0.2);
}

.popover-gray-900.bs-popover-top .arrow::after, .popover-gray-900.bs-popover-auto[data-popper-placement^=top] .arrow::after {
    border-top-color: #111827;
}

.popover-gray-900.bs-popover-end .arrow::after, .popover-gray-900.bs-popover-auto[data-popper-placement^=right] .arrow::after {
    border-right-color: #111827;
}

.popover-gray-900.bs-popover-bottom .arrow::after, .popover-gray-900.bs-popover-auto[data-popper-placement^=bottom] .arrow::after {
    border-bottom-color: #111827;
}

.popover-gray-900.bs-popover-start .arrow::after, .popover-gray-900.bs-popover-auto[data-popper-placement^=left] .arrow::after {
    border-left-color: #111827;
}

/**
 * = Progress bars
 */
.progress-wrapper {
    position: relative;
}

.progress-bar {
    box-shadow: none;
    border-radius: 0;
    height: auto;
}

.progress {
    height: 6px;
    margin-bottom: 1rem;
    overflow: hidden;
    background-color: #E5E7EB;
    font-size: 0.75rem;
    font-weight: 500;
    box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
}

.progress-xl {
    height: 0.8rem;
}

.progress-lg {
    height: 0.6rem;
}

.progress-sm {
    height: 0.2rem;
}

.progress-info {
    display: flex;
    -moz-align-items: center;
    -ms-align-items: center;
    align-items: center;
    -moz-justify-content: space-between;
    -ms-justify-content: space-between;
    justify-content: space-between;
    -ms-flex-pack: space-between;
    margin-bottom: 0.5rem;
}

.progress-info .progress-label span {
    display: inline-block;
    color: #1F2937;
    font-size: 0.875rem;
    font-weight: 500;
}

.progress-info .progress-percentage {
    text-align: right;
}

.progress-info .progress-percentage span {
    display: inline-block;
    color: #6B7280;
    font-size: 0.75rem;
    font-weight: 500;
}

.info-xl .progress-label span,
.info-xl .progress-percentage span {
    font-size: 0.875rem;
}

.info-xl .progress-percentage {
    text-align: right;
}

.progress-tooltip {
    background: #1F2937;
    color: #ffffff;
    font-weight: 500;
    padding: 0.25rem 0.375rem;
    line-height: 1;
    font-size: 0.75rem;
    position: relative;
    border-radius: 0.35rem;
}

.progress-tooltip:after {
    content: " ";
    position: absolute;
    top: 100%;
    left: 10px;
    border: solid transparent;
    height: 0;
    width: 0;
    pointer-events: none;
    border-top-color: #111827;
    border-width: 6px;
}

@keyframes animate-positive {
    0% {
        width: 0%;
    }
}

.progress-info .bg-primary::after {
    border-top-color: #1F2937;
}

.progress-info .bg-secondary::after {
    border-top-color: #f0bc74;
}

.progress-info .bg-tertiary::after {
    border-top-color: #31316A;
}

.progress-info .bg-success::after {
    border-top-color: #10B981;
}

.progress-info .bg-info::after {
    border-top-color: #2361ce;
}

.progress-info .bg-warning::after {
    border-top-color: #f3c78e;
}

.progress-info .bg-danger::after {
    border-top-color: #E11D48;
}

.progress-info .bg-white::after {
    border-top-color: #ffffff;
}

.progress-info .bg-indigo::after {
    border-top-color: #4F46E5;
}

.progress-info .bg-purple::after {
    border-top-color: #7C3AED;
}

.progress-info .bg-yellow-100::after {
    border-top-color: #ffeed6;
}

.progress-info .bg-yellow-200::after {
    border-top-color: #f5dbb8;
}

.progress-info .bg-gray-50::after {
    border-top-color: #F9FAFB;
}

.progress-info .bg-gray-100::after {
    border-top-color: #F2F4F6;
}

.progress-info .bg-gray-200::after {
    border-top-color: #E5E7EB;
}

.progress-info .bg-gray-300::after {
    border-top-color: #D1D5DB;
}

.progress-info .bg-gray-400::after {
    border-top-color: #9CA3AF;
}

.progress-info .bg-gray-500::after {
    border-top-color: #6B7280;
}

.progress-info .bg-gray-600::after {
    border-top-color: #4B5563;
}

.progress-info .bg-gray-700::after {
    border-top-color: #374151;
}

.progress-info .bg-gray-800::after {
    border-top-color: #1F2937;
}

.progress-info .bg-gray-900::after {
    border-top-color: #111827;
}

/**
 * = Shapes
 */
.avatar-sm {
    width: 1.5rem;
    height: 1.5rem;
}

.avatar-md {
    width: 3rem;
    height: 3rem;
}

.avatar-lg {
    width: 4.5rem;
    height: 4.5rem;
}

/**
 * = Datepickers
 */
.datepicker .datepicker-cell.selected,
.datepicker .datepicker-cell.selected:hover {
    background: #1F2937;
}

/**steps
 * = Accordions
 */
.step {
    position: relative;
    margin-bottom: 4rem;
    border-radius: 6px;
}

.step .step-shape {
    display: inline-flex;
    width: 7rem;
    height: 7rem;
    text-align: center;
    -moz-align-items: center;
    -ms-align-items: center;
    align-items: center;
    -moz-justify-content: center;
    -ms-justify-content: center;
    justify-content: center;
    -ms-flex-pack: center;
}

.step .step-shape i, .step .step-shape svg {
    font-size: 2rem;
}

.step .step-shape .step-number {
    position: absolute;
    font-weight: 500;
    top: -10px;
    width: 32px;
    height: 32px;
    border-width: 0.125rem;
    border-style: solid;
    line-height: 1.7;
}

.step .step-shape.bordered {
    border-width: 0.125rem;
    border-style: solid;
}

.step .step-shape.bordered .step-number {
    background-color: #ffffff;
    top: -12px;
}

.step .step-shape.rounded-circle .step-number {
    margin-right: 1.275rem;
}

.step .icon-lg {
    font-size: 4.5rem;
}

.step .back-layer {
    display: flex;
    position: absolute;
    font-size: 12rem;
    z-index: 0;
    top: 0;
}

.table thead th {
    padding-top: 0.75rem;
    padding-bottom: 0.75rem;
    font-size: 0.75rem;
    text-transform: uppercase;
    font-weight: 600;
    border-top: 0;
}

.table th {
    font-weight: 500;
    padding: 1rem;
}

.table td .progress {
    height: 3px;
    width: 120px;
    margin: 0;
}

.table td,
.table th {
    font-size: 0.875rem;
    white-space: nowrap;
}

.table.user-table thead th {
    border-top: 0;
}

.table.align-items-center td,
.table.align-items-center th {
    vertical-align: middle;
}

.table .thead-dark th {
    background-color: #1F2937;
    color: #ffffff;
}

.table .thead-dark th a {
    color: #1F2937;
}

.table .thead-light th {
    background-color: #F2F4F6;
    color: #1F2937;
}

.table .thead-light th a {
    color: #1F2937;
}

.table-hover tr {
    transition: all 0.2s ease;
}

@media (prefers-reduced-motion: reduce) {
    .table-hover tr {
        transition: none;
    }
}

.table-flush td,
.table-flush th {
    border-left: 0;
    border-right: 0;
}

.table-flush tbody tr:first-child td,
.table-flush tbody tr:first-child th {
    border-top: 0;
}

.table-flush tbody tr:last-child td,
.table-flush tbody tr:last-child th {
    border-bottom: 0;
}

.card .table {
    margin-bottom: 0;
}

.card .table td,
.card .table th {
    padding-left: 1.5rem;
    padding-right: 1.5rem;
}

.table [data-sort] {
    cursor: pointer;
}

.table .custom-toggle {
    display: block;
}

.table .thead-dark [data-sort]::after {
    content: url("data:image/svg+xml;utf8,<svg width='6' height='10' viewBox='0 0 6 10' fill='none' xmlns='http://www.w3.org/2000/svg'><path fill-rule='evenodd' clip-rule='evenodd' d='M3 0L6 4H0L3 0ZM3 10L0 6H6L3 10Z' fill='%231F2937'/></svg>");
    margin-left: 0.25rem;
}

.table .thead-light [data-sort]::after {
    content: url("data:image/svg+xml;utf8,<svg width='6' height='10' viewBox='0 0 6 10' fill='none' xmlns='http://www.w3.org/2000/svg'><path fill-rule='evenodd' clip-rule='evenodd' d='M3 0L6 4H0L3 0ZM3 10L0 6H6L3 10Z' fill='%231F2937'/></svg>");
    margin-left: 0.25rem;
}

.dataTables_wrapper .dataTables_info {
    padding-left: 1.5rem;
}

.dataTables_wrapper .dataTables_paginate {
    padding-right: 1.5rem;
}

.dataTables_wrapper .dataTables_length label {
    padding-left: 1.5rem;
}

.dataTables_wrapper .dataTables_filter {
    padding-right: 1.5rem;
}

.dataTable-top,
.dataTable-bottom {
    display: flex;
    width: 100%;
    justify-content: space-between;
}

@media (max-width: 767.98px) {
    .dataTable-top,
.dataTable-bottom {
        flex-direction: column;
    }

    .dataTable-top .dataTable-info,
.dataTable-bottom .dataTable-info {
        margin-bottom: 1rem;
    }
}

.dataTable-top {
    padding: 0 0 1rem 0;
}

.dataTable-bottom {
    padding: 1.5rem 0 0 0;
}

.dataTable-pagination {
    display: flex;
    padding-left: 0;
    list-style: none;
}

.dataTable-pagination a {
    padding: 0.375rem 0.75rem;
}

.dataTable-pagination li:first-child a {
    border-top-left-radius: 0.5rem;
    border-bottom-left-radius: 0.5rem;
}

.dataTable-pagination li:last-child a {
    border-top-right-radius: 0.5rem;
    border-bottom-right-radius: 0.5rem;
}

.dataTable-pagination > li:not(:first-child) a {
    margin-left: -0.0625rem;
}

.dataTable-pagination > li.active a {
    z-index: 3;
    color: #ffffff;
    background-color: #1F2937;
    border-color: #1F2937;
}

.dataTable-pagination > li.disabled a {
    color: #4B5563;
    pointer-events: none;
    background-color: #ffffff;
    border-color: #D1D5DB;
}

.dataTable-pagination > li a {
    position: relative;
    display: block;
    color: #1F2937;
    background-color: #ffffff;
    border: 0.0625rem solid #9CA3AF;
}

.dataTable-pagination > li a:hover {
    z-index: 2;
    color: black;
    background-color: #E5E7EB;
    border-color: #D1D5DB;
}

.dataTable-pagination > li a:focus {
    z-index: 3;
    outline: 0;
    box-shadow: 0 0 0 0.18rem rgba(31, 41, 55, 0.25);
}

.dataTable-selector {
    display: inline-block;
    width: auto;
    height: calc(1.5em + 1.125rem);
    padding: 0.5rem 2rem 0.5rem 1rem;
    font-size: 0.875rem;
    font-weight: 400;
    line-height: 1.5;
    color: #6B7280;
    vertical-align: middle;
    background-color: #ffffff;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%231F2937' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right 1rem center;
    background-size: 16px 12px;
    border: 0.0625rem solid #D1D5DB;
    border-radius: 0.5rem;
    box-shadow: inset 0 1px 2px rgba(17, 24, 39, 0.0125);
    -webkit-appearance: none;
    appearance: none;
}

.dataTable-selector:focus {
    border-color: #4d6689;
    outline: 0;
    box-shadow: inset 0 1px 2px rgba(17, 24, 39, 0.0125), 0 0 0 0.18rem rgba(31, 41, 55, 0.25);
}

.dataTable-selector:focus::-ms-value {
    color: #6B7280;
    background-color: #ffffff;
}

.dataTable-selector[multiple], .dataTable-selector[size]:not([size="1"]) {
    height: auto;
    padding-right: 1rem;
    background-image: none;
}

.dataTable-selector:disabled {
    color: #4B5563;
    background-color: #E5E7EB;
}

.dataTable-selector:-moz-focusring {
    color: transparent;
    text-shadow: 0 0 0 #6B7280;
}

.dataTable-input {
    display: block;
    width: 100%;
    min-height: calc(1.5em + 1.125rem);
    padding: 0.5rem 1rem;
    font-size: 0.875rem;
    font-weight: 400;
    line-height: 1.5;
    color: #6B7280;
    background-color: #ffffff;
    background-clip: padding-box;
    border: 0.0625rem solid #D1D5DB;
    -webkit-appearance: none;
    appearance: none;
    border-radius: 0.5rem;
    box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.07);
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

@media (prefers-reduced-motion: reduce) {
    .dataTable-input {
        transition: none;
    }
}

.dataTable-input:focus {
    color: #6B7280;
    background-color: #ffffff;
    border-color: #4d6689;
    outline: 0;
    box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.07), 0 0 0 0.18rem rgba(31, 41, 55, 0.25);
}

.dataTable-input::placeholder {
    color: #4B5563;
    opacity: 1;
}

.dataTable-input:disabled, .dataTable-input[readonly] {
    background-color: #E5E7EB;
    opacity: 1;
}

/**
 * = Typography
 */
h1, h2, h3, h4, h5, h6,
.h1, .h2, .h3, .h4, .h5, .h6 {
    font-family: "Inter", sans-serif;
    font-weight: 500;
}

p, ol li, ul li, .p {
    font-family: var(--bs-font-sans-serif);
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.6;
}

a, .text-action {
    color: #1F2937;
    transition: all 0.2s ease;
}

a:hover, .text-action:hover {
    color: black;
    cursor: pointer;
}

.lead + .btn-wrapper {
    margin-top: 3rem;
}

@media (max-width: 767.98px) {
    .lead {
        font-size: 1rem;
    }
}

.line-through {
    -webkit-text-decoration: line-through;
    text-decoration: line-through;
}

.text-italic {
    font-style: italic !important;
}

.description {
    font-size: 0.875rem;
}

.hover\:underline:hover {
    text-decoration: underline;
}

.heading {
    font-size: 2rem;
    font-weight: 500;
}

@media (max-width: 767.98px) {
    .display-2 {
        font-size: 1.875rem;
    }
}

@media (max-width: 991.98px) {
    .display-3 {
        font-size: 1.875rem;
    }
}

@media (max-width: 575.98px) {
    .display-4 {
        font-size: 1.5rem;
    }
}

.blockquote {
    font-style: italic;
}

@media (max-width: 767.98px) {
    .blockquote.blockquote-large {
        font-size: 1.25rem;
    }
}

.blockquote .blockquote-footer {
    font-size: 0.875rem;
    font-weight: 600;
}

@media (max-width: 767.98px) {
    .blockquote .blockquote-footer {
        font-size: 1.25rem;
    }
}

.font-small {
    font-size: 0.875rem;
    font-weight: 300;
}

.font-base {
    font-size: 1rem;
    font-weight: 300;
}

.font-medium {
    font-size: 1.25rem;
    font-weight: 300;
}

code[class*=language-], pre[class*=language-] {
    text-shadow: none;
    font-family: var(--bs-font-sans-serif);
    font-weight: 500;
}

.text-primary, .text-primary:hover {
    color: #1F2937 !important;
}

.text-primary a:not(.btn), .text-primary h1, .text-primary h2, .text-primary h3, .text-primary h4, .text-primary h5, .text-primary h6, .text-primary .h1, .text-primary .h2, .text-primary .h3, .text-primary .h4, .text-primary .h5, .text-primary .h6, .text-primary .display-1, .text-primary .display-2, .text-primary .display-3, .text-primary .display-4 {
    color: #1F2937;
}

.text-primary .text-muted {
    color: rgba(31, 41, 55, 0.7) !important;
}

.text-secondary, .text-secondary:hover {
    color: #f0bc74 !important;
}

.text-secondary a:not(.btn), .text-secondary h1, .text-secondary h2, .text-secondary h3, .text-secondary h4, .text-secondary h5, .text-secondary h6, .text-secondary .h1, .text-secondary .h2, .text-secondary .h3, .text-secondary .h4, .text-secondary .h5, .text-secondary .h6, .text-secondary .display-1, .text-secondary .display-2, .text-secondary .display-3, .text-secondary .display-4 {
    color: #f0bc74;
}

.text-secondary .text-muted {
    color: rgba(240, 188, 116, 0.7) !important;
}

.text-tertiary, .text-tertiary:hover {
    color: #31316A !important;
}

.text-tertiary a:not(.btn), .text-tertiary h1, .text-tertiary h2, .text-tertiary h3, .text-tertiary h4, .text-tertiary h5, .text-tertiary h6, .text-tertiary .h1, .text-tertiary .h2, .text-tertiary .h3, .text-tertiary .h4, .text-tertiary .h5, .text-tertiary .h6, .text-tertiary .display-1, .text-tertiary .display-2, .text-tertiary .display-3, .text-tertiary .display-4 {
    color: #31316A;
}

.text-tertiary .text-muted {
    color: rgba(49, 49, 106, 0.7) !important;
}

.text-success, .text-success:hover {
    color: #10B981 !important;
}

.text-success a:not(.btn), .text-success h1, .text-success h2, .text-success h3, .text-success h4, .text-success h5, .text-success h6, .text-success .h1, .text-success .h2, .text-success .h3, .text-success .h4, .text-success .h5, .text-success .h6, .text-success .display-1, .text-success .display-2, .text-success .display-3, .text-success .display-4 {
    color: #10B981;
}

.text-success .text-muted {
    color: rgba(16, 185, 129, 0.7) !important;
}

.text-info, .text-info:hover {
    color: #2361ce !important;
}

.text-info a:not(.btn), .text-info h1, .text-info h2, .text-info h3, .text-info h4, .text-info h5, .text-info h6, .text-info .h1, .text-info .h2, .text-info .h3, .text-info .h4, .text-info .h5, .text-info .h6, .text-info .display-1, .text-info .display-2, .text-info .display-3, .text-info .display-4 {
    color: #2361ce;
}

.text-info .text-muted {
    color: rgba(35, 97, 206, 0.7) !important;
}

.text-warning, .text-warning:hover {
    color: #f3c78e !important;
}

.text-warning a:not(.btn), .text-warning h1, .text-warning h2, .text-warning h3, .text-warning h4, .text-warning h5, .text-warning h6, .text-warning .h1, .text-warning .h2, .text-warning .h3, .text-warning .h4, .text-warning .h5, .text-warning .h6, .text-warning .display-1, .text-warning .display-2, .text-warning .display-3, .text-warning .display-4 {
    color: #f3c78e;
}

.text-warning .text-muted {
    color: rgba(243, 199, 142, 0.7) !important;
}

.text-danger, .text-danger:hover {
    color: #E11D48 !important;
}

.text-danger a:not(.btn), .text-danger h1, .text-danger h2, .text-danger h3, .text-danger h4, .text-danger h5, .text-danger h6, .text-danger .h1, .text-danger .h2, .text-danger .h3, .text-danger .h4, .text-danger .h5, .text-danger .h6, .text-danger .display-1, .text-danger .display-2, .text-danger .display-3, .text-danger .display-4 {
    color: #E11D48;
}

.text-danger .text-muted {
    color: rgba(225, 29, 72, 0.7) !important;
}

.text-white, .text-white:hover {
    color: #ffffff !important;
}

.text-white a:not(.btn), .text-white h1, .text-white h2, .text-white h3, .text-white h4, .text-white h5, .text-white h6, .text-white .h1, .text-white .h2, .text-white .h3, .text-white .h4, .text-white .h5, .text-white .h6, .text-white .display-1, .text-white .display-2, .text-white .display-3, .text-white .display-4 {
    color: #ffffff;
}

.text-white .text-muted {
    color: rgba(255, 255, 255, 0.7) !important;
}

.text-indigo, .text-indigo:hover {
    color: #4F46E5 !important;
}

.text-indigo a:not(.btn), .text-indigo h1, .text-indigo h2, .text-indigo h3, .text-indigo h4, .text-indigo h5, .text-indigo h6, .text-indigo .h1, .text-indigo .h2, .text-indigo .h3, .text-indigo .h4, .text-indigo .h5, .text-indigo .h6, .text-indigo .display-1, .text-indigo .display-2, .text-indigo .display-3, .text-indigo .display-4 {
    color: #4F46E5;
}

.text-indigo .text-muted {
    color: rgba(79, 70, 229, 0.7) !important;
}

.text-purple, .text-purple:hover {
    color: #7C3AED !important;
}

.text-purple a:not(.btn), .text-purple h1, .text-purple h2, .text-purple h3, .text-purple h4, .text-purple h5, .text-purple h6, .text-purple .h1, .text-purple .h2, .text-purple .h3, .text-purple .h4, .text-purple .h5, .text-purple .h6, .text-purple .display-1, .text-purple .display-2, .text-purple .display-3, .text-purple .display-4 {
    color: #7C3AED;
}

.text-purple .text-muted {
    color: rgba(124, 58, 237, 0.7) !important;
}

.text-yellow-100, .text-yellow-100:hover {
    color: #ffeed6 !important;
}

.text-yellow-100 a:not(.btn), .text-yellow-100 h1, .text-yellow-100 h2, .text-yellow-100 h3, .text-yellow-100 h4, .text-yellow-100 h5, .text-yellow-100 h6, .text-yellow-100 .h1, .text-yellow-100 .h2, .text-yellow-100 .h3, .text-yellow-100 .h4, .text-yellow-100 .h5, .text-yellow-100 .h6, .text-yellow-100 .display-1, .text-yellow-100 .display-2, .text-yellow-100 .display-3, .text-yellow-100 .display-4 {
    color: #ffeed6;
}

.text-yellow-100 .text-muted {
    color: rgba(255, 238, 214, 0.7) !important;
}

.text-yellow-200, .text-yellow-200:hover {
    color: #f5dbb8 !important;
}

.text-yellow-200 a:not(.btn), .text-yellow-200 h1, .text-yellow-200 h2, .text-yellow-200 h3, .text-yellow-200 h4, .text-yellow-200 h5, .text-yellow-200 h6, .text-yellow-200 .h1, .text-yellow-200 .h2, .text-yellow-200 .h3, .text-yellow-200 .h4, .text-yellow-200 .h5, .text-yellow-200 .h6, .text-yellow-200 .display-1, .text-yellow-200 .display-2, .text-yellow-200 .display-3, .text-yellow-200 .display-4 {
    color: #f5dbb8;
}

.text-yellow-200 .text-muted {
    color: rgba(245, 219, 184, 0.7) !important;
}

.text-gray-50, .text-gray-50:hover {
    color: #F9FAFB !important;
}

.text-gray-50 a:not(.btn), .text-gray-50 h1, .text-gray-50 h2, .text-gray-50 h3, .text-gray-50 h4, .text-gray-50 h5, .text-gray-50 h6, .text-gray-50 .h1, .text-gray-50 .h2, .text-gray-50 .h3, .text-gray-50 .h4, .text-gray-50 .h5, .text-gray-50 .h6, .text-gray-50 .display-1, .text-gray-50 .display-2, .text-gray-50 .display-3, .text-gray-50 .display-4 {
    color: #F9FAFB;
}

.text-gray-50 .text-muted {
    color: rgba(249, 250, 251, 0.7) !important;
}

.text-gray-100, .text-gray-100:hover {
    color: #F2F4F6 !important;
}

.text-gray-100 a:not(.btn), .text-gray-100 h1, .text-gray-100 h2, .text-gray-100 h3, .text-gray-100 h4, .text-gray-100 h5, .text-gray-100 h6, .text-gray-100 .h1, .text-gray-100 .h2, .text-gray-100 .h3, .text-gray-100 .h4, .text-gray-100 .h5, .text-gray-100 .h6, .text-gray-100 .display-1, .text-gray-100 .display-2, .text-gray-100 .display-3, .text-gray-100 .display-4 {
    color: #F2F4F6;
}

.text-gray-100 .text-muted {
    color: rgba(242, 244, 246, 0.7) !important;
}

.text-gray-200, .text-gray-200:hover {
    color: #E5E7EB !important;
}

.text-gray-200 a:not(.btn), .text-gray-200 h1, .text-gray-200 h2, .text-gray-200 h3, .text-gray-200 h4, .text-gray-200 h5, .text-gray-200 h6, .text-gray-200 .h1, .text-gray-200 .h2, .text-gray-200 .h3, .text-gray-200 .h4, .text-gray-200 .h5, .text-gray-200 .h6, .text-gray-200 .display-1, .text-gray-200 .display-2, .text-gray-200 .display-3, .text-gray-200 .display-4 {
    color: #E5E7EB;
}

.text-gray-200 .text-muted {
    color: rgba(229, 231, 235, 0.7) !important;
}

.text-gray-300, .text-gray-300:hover {
    color: #D1D5DB !important;
}

.text-gray-300 a:not(.btn), .text-gray-300 h1, .text-gray-300 h2, .text-gray-300 h3, .text-gray-300 h4, .text-gray-300 h5, .text-gray-300 h6, .text-gray-300 .h1, .text-gray-300 .h2, .text-gray-300 .h3, .text-gray-300 .h4, .text-gray-300 .h5, .text-gray-300 .h6, .text-gray-300 .display-1, .text-gray-300 .display-2, .text-gray-300 .display-3, .text-gray-300 .display-4 {
    color: #D1D5DB;
}

.text-gray-300 .text-muted {
    color: rgba(209, 213, 219, 0.7) !important;
}

.text-gray-400, .text-gray-400:hover {
    color: #9CA3AF !important;
}

.text-gray-400 a:not(.btn), .text-gray-400 h1, .text-gray-400 h2, .text-gray-400 h3, .text-gray-400 h4, .text-gray-400 h5, .text-gray-400 h6, .text-gray-400 .h1, .text-gray-400 .h2, .text-gray-400 .h3, .text-gray-400 .h4, .text-gray-400 .h5, .text-gray-400 .h6, .text-gray-400 .display-1, .text-gray-400 .display-2, .text-gray-400 .display-3, .text-gray-400 .display-4 {
    color: #9CA3AF;
}

.text-gray-400 .text-muted {
    color: rgba(156, 163, 175, 0.7) !important;
}

.text-gray-500, .text-gray-500:hover {
    color: #6B7280 !important;
}

.text-gray-500 a:not(.btn), .text-gray-500 h1, .text-gray-500 h2, .text-gray-500 h3, .text-gray-500 h4, .text-gray-500 h5, .text-gray-500 h6, .text-gray-500 .h1, .text-gray-500 .h2, .text-gray-500 .h3, .text-gray-500 .h4, .text-gray-500 .h5, .text-gray-500 .h6, .text-gray-500 .display-1, .text-gray-500 .display-2, .text-gray-500 .display-3, .text-gray-500 .display-4 {
    color: #6B7280;
}

.text-gray-500 .text-muted {
    color: rgba(107, 114, 128, 0.7) !important;
}

.text-gray-600, .text-gray-600:hover {
    color: #4B5563 !important;
}

.text-gray-600 a:not(.btn), .text-gray-600 h1, .text-gray-600 h2, .text-gray-600 h3, .text-gray-600 h4, .text-gray-600 h5, .text-gray-600 h6, .text-gray-600 .h1, .text-gray-600 .h2, .text-gray-600 .h3, .text-gray-600 .h4, .text-gray-600 .h5, .text-gray-600 .h6, .text-gray-600 .display-1, .text-gray-600 .display-2, .text-gray-600 .display-3, .text-gray-600 .display-4 {
    color: #4B5563;
}

.text-gray-600 .text-muted {
    color: rgba(75, 85, 99, 0.7) !important;
}

.text-gray-700, .text-gray-700:hover {
    color: #374151 !important;
}

.text-gray-700 a:not(.btn), .text-gray-700 h1, .text-gray-700 h2, .text-gray-700 h3, .text-gray-700 h4, .text-gray-700 h5, .text-gray-700 h6, .text-gray-700 .h1, .text-gray-700 .h2, .text-gray-700 .h3, .text-gray-700 .h4, .text-gray-700 .h5, .text-gray-700 .h6, .text-gray-700 .display-1, .text-gray-700 .display-2, .text-gray-700 .display-3, .text-gray-700 .display-4 {
    color: #374151;
}

.text-gray-700 .text-muted {
    color: rgba(55, 65, 81, 0.7) !important;
}

.text-gray-800, .text-gray-800:hover {
    color: #1F2937 !important;
}

.text-gray-800 a:not(.btn), .text-gray-800 h1, .text-gray-800 h2, .text-gray-800 h3, .text-gray-800 h4, .text-gray-800 h5, .text-gray-800 h6, .text-gray-800 .h1, .text-gray-800 .h2, .text-gray-800 .h3, .text-gray-800 .h4, .text-gray-800 .h5, .text-gray-800 .h6, .text-gray-800 .display-1, .text-gray-800 .display-2, .text-gray-800 .display-3, .text-gray-800 .display-4 {
    color: #1F2937;
}

.text-gray-800 .text-muted {
    color: rgba(31, 41, 55, 0.7) !important;
}

.text-gray-900, .text-gray-900:hover {
    color: #111827 !important;
}

.text-gray-900 a:not(.btn), .text-gray-900 h1, .text-gray-900 h2, .text-gray-900 h3, .text-gray-900 h4, .text-gray-900 h5, .text-gray-900 h6, .text-gray-900 .h1, .text-gray-900 .h2, .text-gray-900 .h3, .text-gray-900 .h4, .text-gray-900 .h5, .text-gray-900 .h6, .text-gray-900 .display-1, .text-gray-900 .display-2, .text-gray-900 .display-3, .text-gray-900 .display-4 {
    color: #111827;
}

.text-gray-900 .text-muted {
    color: rgba(17, 24, 39, 0.7) !important;
}

article img {
    margin: 40px 0;
}

article p, article ul, article ol, article blockquote {
    margin-bottom: 20px;
}

article p, article ul li, article ol li {
    font-size: 1.2rem;
}

article h1, article h2, article h3, article h4, article h5, article h6,
article .h1, article .h2, article .h3, article .h4, article .h5, article .h6 {
    margin-bottom: 30px;
}

.folder-structure li {
    font-size: 1.2rem;
}

.truncate-text {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

/**
 * = Timelines
 */
.list-group-timeline .list-group-item {
    position: relative;
}

.list-group-timeline .list-group-item .col-auto {
    z-index: 999;
}

.list-group-timeline .list-group-item:not(:last-child)::before {
    content: "";
    position: absolute;
    top: 1rem;
    left: 2.5rem;
    height: 100%;
    border-left: 1px solid #9CA3AF;
}

.tooltip-inner {
    box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
}

.chartist-tooltip {
    position: absolute;
    display: inline-block;
    opacity: 0;
    min-width: 5em;
    padding: 0.5em;
    background: #F2F4F6;
    border: 1px solid #F2F4F6;
    border-radius: 0.5rem;
    color: #1F2937;
    font-weight: 500;
    text-align: center;
    pointer-events: none;
    z-index: 1;
    transition: all 0.2s ease;
}

.chartist-tooltip:before {
    content: "";
    position: absolute;
    top: 100%;
    left: 50%;
    width: 0;
    height: 0;
    margin-left: -15px;
    border: 15px solid transparent;
    border-top-color: #F2F4F6;
}

.chartist-tooltip.tooltip-show {
    opacity: 1;
}

.ct-area, .ct-line {
    pointer-events: none;
}

[data-simplebar] {
    position: fixed;
    flex-direction: column;
    flex-wrap: wrap;
    justify-content: flex-start;
    align-content: flex-start;
    align-items: flex-start;
}

.simplebar-wrapper {
    overflow: hidden;
    width: inherit;
    height: inherit;
    max-width: inherit;
    max-height: inherit;
}

.simplebar-mask {
    direction: inherit;
    position: absolute;
    overflow: hidden;
    padding: 0;
    margin: 0;
    left: 0;
    top: 0;
    bottom: 0;
    right: 0;
    width: auto !important;
    height: auto !important;
    z-index: 0;
}

.simplebar-offset {
    direction: inherit !important;
    box-sizing: inherit !important;
    resize: none !important;
    position: absolute;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
    padding: 0;
    margin: 0;
    -webkit-overflow-scrolling: touch;
}

.simplebar-content-wrapper {
    direction: inherit;
    box-sizing: border-box !important;
    position: relative;
    display: block;
    height: 100%;
  /* Required for horizontal native scrollbar to not appear if parent is taller than natural height */
    width: auto;
    max-width: 100%;
  /* Not required for horizontal scroll to trigger */
    max-height: 100%;
  /* Needed for vertical scroll to trigger */
    scrollbar-width: none;
    -ms-overflow-style: none;
}

.simplebar-content-wrapper::-webkit-scrollbar,
.simplebar-hide-scrollbar::-webkit-scrollbar {
    width: 0;
    height: 0;
}

.simplebar-content:before,
.simplebar-content:after {
    content: " ";
    display: table;
}

.simplebar-placeholder {
    max-height: 100%;
    max-width: 100%;
    width: 100%;
    pointer-events: none;
}

.simplebar-height-auto-observer-wrapper {
    box-sizing: inherit !important;
    height: 100%;
    width: 100%;
    max-width: 1px;
    position: relative;
    float: left;
    max-height: 1px;
    overflow: hidden;
    z-index: -1;
    padding: 0;
    margin: 0;
    pointer-events: none;
    flex-grow: inherit;
    flex-shrink: 0;
    flex-basis: 0;
}

.simplebar-height-auto-observer {
    box-sizing: inherit;
    display: block;
    opacity: 0;
    position: absolute;
    top: 0;
    left: 0;
    height: 1000%;
    width: 1000%;
    min-height: 1px;
    min-width: 1px;
    overflow: hidden;
    pointer-events: none;
    z-index: -1;
}

.simplebar-track {
    z-index: 1;
    position: absolute;
    right: 0;
    bottom: 0;
    pointer-events: none;
    overflow: hidden;
}

[data-simplebar].simplebar-dragging .simplebar-content {
    pointer-events: none;
    user-select: none;
    -webkit-user-select: none;
}

[data-simplebar].simplebar-dragging .simplebar-track {
    pointer-events: all;
}

.simplebar-scrollbar {
    position: absolute;
    left: 0;
    right: 0;
    min-height: 10px;
}

.simplebar-scrollbar:before {
    position: absolute;
    content: "";
    background: black;
    border-radius: 7px;
    left: 2px;
    right: 2px;
    opacity: 0;
    transition: opacity 0.2s 0.5s linear;
}

.simplebar-scrolling .simplebar-scrollbar:before,
.simplebar-hover .simplebar-scrollbar:before,
.simplebar-mouse-entered .simplebar-scrollbar:before {
    opacity: 0.5;
    transition-delay: 0s;
    transition-duration: 0s;
}

.simplebar-scrollbar.simplebar-visible:before {
  /* When hovered, remove all transitions from drag handle */
    opacity: 0.5;
    transition-delay: 0s;
    transition-duration: 0s;
}

.simplebar-track.simplebar-vertical {
    top: 0;
    width: 11px;
}

.simplebar-scrollbar:before {
    top: 2px;
    bottom: 2px;
    left: 2px;
    right: 2px;
}

.simplebar-track.simplebar-horizontal {
    left: 0;
    height: 11px;
}

.simplebar-track.simplebar-horizontal .simplebar-scrollbar {
    right: auto;
    left: 0;
    top: 0;
    bottom: 0;
    min-height: 0;
    min-width: 10px;
    width: auto;
}

/* Rtl support */
[data-simplebar-direction=rtl] .simplebar-track.simplebar-vertical {
    right: auto;
    left: 0;
}

.simplebar-dummy-scrollbar-size {
    direction: rtl;
    position: fixed;
    opacity: 0;
    visibility: hidden;
    height: 500px;
    width: 500px;
    overflow-y: hidden;
    overflow-x: scroll;
    -ms-overflow-style: scrollbar !important;
}

.simplebar-dummy-scrollbar-size > div {
    width: 200%;
    height: 200%;
    margin: 10px 0;
}

.simplebar-hide-scrollbar {
    position: fixed;
    left: 0;
    visibility: hidden;
    overflow-y: scroll;
    scrollbar-width: none;
    -ms-overflow-style: none;
}

.simplebar-scrollbar::before {
    background-color: #0d1116;
}

@media (min-width: 992px) {
    .form-control.form-control-lg {
        padding: 1rem 1rem;
    }
}

.search-bar .form-control {
    width: 280px;
    transition: width 0.2s ease-in-out;
}

@media (max-width: 575.98px) {
    .search-bar .form-control {
        width: 120px;
    }

    .search-bar .form-control:focus {
        width: 150px;
    }
}

.form-check-input.round-check[type=checkbox] {
    border-radius: 50%;
}

.form-switch {
    padding-left: 2.75em;
}

.form-switch .form-check-input {
    height: 1.275em;
}

.input-group .form-control:focus {
    border-color: #D1D5DB;
}

.input-group .form-control:focus + .input-group-text {
    border-color: #D1D5DB;
}

.input-group-text {
    box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.07);
}

.form-select .form-select-lg {
    padding: 0.5rem 2rem 0.5rem 1rem;
}

.file-field input[type=file] {
    max-width: 230px;
    position: absolute;
    cursor: pointer;
    filter: alpha(opacity=0);
    opacity: 0;
    padding-bottom: 30px;
}

.file-field svg {
    cursor: pointer;
}

.datepicker-dropdown {
    z-index: 9999;
}
/*# sourceMappingURL=volt.css.map */
body {
  background: linear-gradient( 132deg, #0083aa, #bf1861);
  font-family: Arial, Helvetica, Sans-Serif;
  overflow: hidden;
}

.area-login {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  justify-content: center;
  align-items: center;
}

.login {
  margin-top: -100px;
  display: flex;
  flex-direction: column;
  align-items: center;
  background-color: #08090a3d;
  border-radius: 15px;
  width: 365px;
  height: 390px;
  padding: 25px;
}

.login form {
  display: flex;
  width: 100%;
  flex-direction: column;
}

.login input {
  margin-top: 10px;
  background-color: #4e4e53;
  padding-left: 10px;
  color: #cbd0f7;
  border: none;
  height: 45px;
  outline: none;
  border-radius: 6px;
}

.login img {
  width: 100px;
  height: auto;
}

.input::placeholder {
  color: #cbd0f7;
  font-size: 14px;
  padding-left: 10px;
}

form [type="submit"] {
  display: block;
  background-color: #5568fe;
  font-size: 20px;
  text-transform: uppercase;
  font-weight: bold;
  cursor: pointer;
}

p {
  color: #cbd0f7;
  margin-top: 5px;
}

a {
  color: #9c50d6;
  text-decoration: none;
  margin-left: 10px;
}

h1 {
  color: #cbd0f7;
  font-size: 20px;
  margin-bottom: 5px;
  margin-top: 5px;
}
</style>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
 

<body>
  <section class="area-login">
    <div class="login">
      <div>
       <img class="mt-0" src="/assets/img/logoinfo.png" width="150" height="150">
      </div>
      <div>
        <h1>Alterar Senha <svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="11.000000pt" height="11.000000pt" viewBox="0 0 48.000000 48.000000" preserveAspectRatio="xMidYMid meet"> <g transform="matrix(0.1, 0, 0, -0.1, 0.613139, 48.262775)" fill="#3390ec" stroke="none"> <rect x="105.986" y="-337.226" width="237.372" height="203.212" style="stroke: rgb(0, 0, 0); fill: rgb(255, 255, 255);" transform="matrix(1, 0, 0, -1, 0, 0)"></rect> <g transform="matrix(1, 0, 0, 1, -15.766434, 2.627754)" fill="#3390ec" stroke="none"> <path d="M157 444 c-16 -32 -21 -35 -55 -32 l-37 3 3 -37 c3 -34 0 -39 -32 -55 l-35 -16 20 -34 21 -33 -21 -33 -20 -34 35 -16 c32 -16 35 -21 32 -55 l-3 -37 37 3 c34 3 39 0 55 -32 l16 -35 34 20 33 21 33 -21 34 -20 16 35 c16 32 21 35 55 32 l37 -3 -3 37 c-3 34 0 39 32 55 l35 16 -20 34 -21 33 21 33 20 34 -35 16 c-32 16 -35 21 -32 55 l3 37 -37 -3 c-34 -3 -39 0 -55 32 l-16 35 -34 -20 -33 -21 -33 21 -34 20 -16 -35z m191 -142 c2 -7 -28 -45 -67 -85 l-72 -71 -42 42 c-39 39 -41 43 -24 59 16 16 18 16 40 -5 l23 -22 49 51 c49 49 83 60 93 31z"></path> </g> </g> </svg></h1>
      </div><?php 
//iniciando a conexão com o banco de dados 
// Incluir arquivo de configuração
require_once 'lib/Database/2connect.php';

 $compare = $_SESSION['login'];
 $consulta = "SELECT * FROM login WHERE login = '$compare'";  $conn = $mysqli->query($consulta) or die($mysqli->error); 
 
?> 
      	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="sign-in-form">
    <table border="1"> 
       <select class="form-control" name="username"><option>Selecione um usuário</option>
       <div>
  <?php while($dado = $conn->fetch_array()) { ?> 
 <option  value="<?php echo $dado['login'] ?>"><?php echo $dado['login']; echo '  ';  ?></option>
  <?php } ?>
 
 </select></table>
        </br>
       <input type="text" value="" class="form-control" placeholder="Senha nova" name="password" >
       
        <input type="submit"  value="Registrar">     
      </form>
    
    </div>
    
  </section>
</body>
</html>


