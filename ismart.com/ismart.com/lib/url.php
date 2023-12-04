<?php
function redirect_to($url = '?mod=home&act=main'){
    if(!empty($url)){
        header("Location: {$url}");
    }
}
function base_url($url = "") {
    global $config;
    return $config['base_url'].$url;
}

?>

