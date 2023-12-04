<?php
function redirect_to($url = '?mod=home&act=main'){
    if(!empty($url)){
        header("Location: {$url}");
    }
}
?>

