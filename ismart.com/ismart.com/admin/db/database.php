<?php

// Hàm kết nối dữ liệu
function db_connect() {
    global $conn;
    $db = func_get_arg(0);
    $conn = mysqli_connect($db['hostname'], $db['username'], $db['password'], $db['database']);
    if (!$conn) {
        die("Kết nối không thành công " . mysqli_connect_error());
    }
//    else{
//        echo "Connect thành công";
//    }
}

//Thực thi chuổi truy vấn
function db_query($query_string) {
    global $conn;
    $result = mysqli_query($conn, $query_string);
    if (!$result) {
        db_sql_error('Query Error', $query_string);
    }
    return $result;
}

// Lấy một dòng trong CSDL
function db_fetch_row($query_string) {
    global $conn;
    $result = array();
    $mysqli_result = db_query($query_string);
    $result = mysqli_fetch_assoc($mysqli_result);
    mysqli_free_result($mysqli_result);
    return $result;
}

//Lấy một mảng trong CSDL
function db_fetch_array($query_string) {
    global $conn;
    $result = array();
    $mysqli_result = db_query($query_string);
    while ($row = mysqli_fetch_assoc($mysqli_result)) {
        $result[] = $row;
    }
    mysqli_free_result($mysqli_result);
    return $result;
}

//Lấy số bản ghi
function db_num_rows($query_string) {
    global $conn;
    $mysqli_result = db_query($query_string);
    return mysqli_num_rows($mysqli_result);
}

function db_insert($table, $data) {
    global $conn;
    $fields = "(" . implode(", ", array_keys($data)) . ")";
    $values = "";
    foreach ($data as $field => $value) {
        if ($value === NULL)
            $values .= "NULL, ";
        else
            $values .= "'" . escape_string($value) . "', ";
    }
    $values = substr($values, 0, -2);
    db_query("
            INSERT INTO `{$table}` $fields
            VALUES($values)
        ");
    return mysqli_insert_id($conn);
}

function insert($table, array $data) {
    global $conn;
    $sql = "INSERT INTO {$table} ";
    $columns = implode(',', array_keys($data));
    $values = "";
    $sql .= '(' . $columns . ')';
    foreach ($data as $field => $value) {
        if (is_string($value)) {
            $values .= "'" . mysqli_real_escape_string($conn, $value) . "',";
        } else {
            $values .= mysqli_real_escape_string($conn, $value) . ',';
        }
    }
    $values = substr($values, 0, -1);
    $sql .= " VALUES (" . $values . ')';
    // _debug($sql);die;
    mysqli_query($conn, $sql) or die("Lỗi  query  insert ----" . mysqli_error($conn));
    return mysqli_insert_id($conn);
}

function db_update($table, $data, $where) {
    global $conn;
    $sql = "";
    foreach ($data as $field => $value) {
        if ($value === NULL)
            $sql .= "$field=NULL, ";
        else
            $sql .= "$field='" . escape_string($value) . "', ";
    }
    $sql = substr($sql, 0, -2);
    db_query("
            UPDATE `{$table}`
            SET $sql
            WHERE $where
   ");
    return mysqli_affected_rows($conn);
}

function update($table, array $data, array $conditions) {
    global $conn;
    $sql = "UPDATE {$table}";

    $set = " SET ";

    $where = " WHERE ";

    foreach ($data as $field => $value) {
        if (is_string($value)) {
            $set .= $field . '=' . '\'' . mysqli_real_escape_string($conn, xss_clean($value)) . '\',';
        } else {
            $set .= $field . '=' . mysqli_real_escape_string($conn, xss_clean($value)) . ',';
        }
    }

    $set = substr($set, 0, -1);


    foreach ($conditions as $field => $value) {
        if (is_string($value)) {
            $where .= $field . '=' . '\'' . mysqli_real_escape_string($conn, xss_clean($value)) . '\' AND ';
        } else {
            $where .= $field . '=' . mysqli_real_escape_string($conn, xss_clean($value)) . ' AND ';
        }
    }

    $where = substr($where, 0, -5);

    $sql .= $set . $where;
    // _debug($sql);die;

    mysqli_query($conn, $sql) or die("Lỗi truy vấn Update -- " . mysqli_error());

    return mysqli_affected_rows($conn);
}

function deleteblog($table, $id){
    global $conn;
    $sql = "DELETE FROM {$table} WHERE id_dm = $id ";
    mysqli_query($conn, $sql) or die(" Lỗi Truy Vấn delete   --- " . mysqli_error($conn));
    return mysqli_affected_rows($conn);
}
function deletebill($table, $id) {
    global $conn;
    $sql = "DELETE FROM {$table} WHERE bill_id = $id ";

    mysqli_query($conn, $sql) or die(" Lỗi Truy Vấn delete   --- " . mysqli_error($conn));
    return mysqli_affected_rows($conn);
}
function deletebill_detail($table, $id)  {
    global $conn;
    $sql = "DELETE FROM {$table} WHERE bill_id = $id ";
    mysqli_query($conn, $sql) or die(" Lỗi Truy Vấn delete   --- " . mysqli_error($conn));
    return mysqli_affected_rows($conn);
}

function db_delete($table, $where) {
    global $conn;
    $query_string = "DELETE FROM `{$table}` WHERE $where";
    db_query($query_string);
    return mysqli_affected_rows($conn);
}

function deletecategory($table, $id) /* >0 xóa thành công <0 xóa thất cbại */ {
    global $conn;
    $sql = "DELETE FROM {$table} WHERE cat_id = $id ";

    mysqli_query($conn, $sql) or die(" Lỗi Truy Vấn delete   --- " . mysqli_error($conn));
    return mysqli_affected_rows($conn);
}

function fetchsql($sql) {
    global $conn;
    $result = mysqli_query($conn, $sql) or die("Lỗi  truy vấn sql " . mysqli_error($conn));
    $data = [];
    if ($result) {
        while ($num = mysqli_fetch_assoc($result)) {
            $data[] = $num;
        }
    }
    return $data;
}

function fetchID($table, $id) { // lấy tất cả các sản phẩm có id mình chuyền vào
    global $conn;
    $sql = "SELECT * FROM {$table} WHERE bill_id = $id ";
    $result = mysqli_query($conn, $sql) or die("Lỗi  truy vấn fetchID " . mysqli_error($conn));
    return mysqli_fetch_assoc($result);
}

function fetchID_product($table, $id) { // lấy tất cả các sản phẩm có id mình chuyền vào
    global $conn;
    $sql = "SELECT * FROM {$table} WHERE id = $id ";
    $result = mysqli_query($conn, $sql) or die("Lỗi  truy vấn fetchID " . mysqli_error($conn));
    return mysqli_fetch_assoc($result);
}

function fetchAll($table)/* chuyền vào tên bảng sẽ lấy hết dữ liệu của bảng */ {
    global $conn;
    $sql = "SELECT * FROM {$table} WHERE 1";
    $result = mysqli_query($conn, $sql) or die("Lỗi Truy Vấn fetchAll " . mysqli_error($conn));
    $data = [];
    if ($result) {
        while ($num = mysqli_fetch_assoc($result)) {
            $data[] = $num;
        }
    }
    return $data;
}

function fetchOne($table, $query) {
    global $conn;
    $sql = "SELECT * FROM {$table} WHERE ";
    $sql .= $query;
    $sql .= "LIMIT 1";
    $result = mysqli_query($conn, $sql) or die("Lỗi  truy vấn fetchOne " . mysqli_error($this->link));
    return mysqli_fetch_assoc($result);
}

function escape_string($str) {
    global $conn;
    return mysqli_real_escape_string($conn, $str);
}

// Hiển thị lỗi SQL

function db_sql_error($message, $query_string = "") {
    global $conn;

    $sqlerror = "<table width='100%' border='1' cellpadding='0' cellspacing='0'>";
    $sqlerror .= "<tr><th colspan='2'>{$message}</th></tr>";
    $sqlerror .= ($query_string != "") ? "<tr><td nowrap> Query SQL</td><td nowrap>: " . $query_string . "</td></tr>\n" : "";
    $sqlerror .= "<tr><td nowrap> Error Number</td><td nowrap>: " . mysqli_errno($conn) . " " . mysqli_error($conn) . "</td></tr>\n";
    $sqlerror .= "<tr><td nowrap> Date</td><td nowrap>: " . date("D, F j, Y H:i:s") . "</td></tr>\n";
    $sqlerror .= "<tr><td nowrap> IP</td><td>: " . getenv("REMOTE_ADDR") . "</td></tr>\n";
    $sqlerror .= "<tr><td nowrap> Browser</td><td nowrap>: " . getenv("HTTP_USER_AGENT") . "</td></tr>\n";
    $sqlerror .= "<tr><td nowrap> Script</td><td nowrap>: " . getenv("REQUEST_URI") . "</td></tr>\n";
    $sqlerror .= "<tr><td nowrap> Referer</td><td nowrap>: " . getenv("HTTP_REFERER") . "</td></tr>\n";
    $sqlerror .= "<tr><td nowrap> PHP Version </td><td>: " . PHP_VERSION . "</td></tr>\n";
    $sqlerror .= "<tr><td nowrap> OS</td><td>: " . PHP_OS . "</td></tr>\n";
    $sqlerror .= "<tr><td nowrap> Server</td><td>: " . getenv("SERVER_SOFTWARE") . "</td></tr>\n";
    $sqlerror .= "<tr><td nowrap> Server Name</td><td>: " . getenv("SERVER_NAME") . "</td></tr>\n";
    $sqlerror .= "</table>";
    $msgbox_messages = "<meta http-equiv=\"refresh\" content=\"9999\">\n<table class='smallgrey' cellspacing=1 cellpadding=0>" . $sqlerror . "</table>";
    echo $msgbox_messages;
    exit;
}

?>