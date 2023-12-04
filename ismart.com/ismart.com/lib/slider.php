<?php

function get_list_slider(){
    $result = db_fetch_array("select * from slider where status = 1");
    return $result;
}

