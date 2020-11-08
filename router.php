<?php
    $_controller = "home";
    $_action = "index";
    $_params = [];
    if( isset($_SERVER['REQUEST_URI']) ){
        $url = explode("/", $_SERVER['REQUEST_URI']);
        if(isset($url[2])){
            $_controller = $url[2];
        }
        if(isset($url[3])){
            $actionandparams = $url[3];
            if(isset($actionandparams) == true && strpos($actionandparams,'?') == false){
                $_action = $actionandparams;
            }
            else
            if(isset($actionandparams) == true && strpos($actionandparams,'?') == true){
                $action = explode('?', $actionandparams)[0];
                $params = explode('?', $actionandparams)[1];
                if(isset($action)){
                    $_action = $action;
                }
                if(isset($params) == true && strpos($params,'&') == false){
                    if(strpos($params, '=') != false){
                        $key = explode('=', $params)[0];
                        $value = explode('=', $params)[1];
                        if(isset($key) && $key != ''){
                            $_params[$key] = $value;
                        }  
                    }
                }
                else
                if(isset($params) == true && strpos($params,'&') == true){
                    $arr_param = explode("&", $params);
                    foreach ( $arr_param as $param) {
                        if(isset(explode('=', $param)[0]) && isset(explode('=', $param)[1])){
                            $key = explode('=', $param)[0];
                            $value = explode('=', $param)[1];
                            if(isset($key) && $key != ''){
                                $_params[$key] = $value;
                            }
                        }
                    }
                }
            }
        }
    } 

    print_r($_params);

    if(file_exists("./controllers/".$_controller."/".$_action.".php")){
        require_once("./controllers/".$_controller."/".$_action.".php");
    }
    else{
        echo "404 not found";
    }
?>