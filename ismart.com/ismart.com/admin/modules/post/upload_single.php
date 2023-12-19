<?php

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //Bước 1: Tạo thư mục lưu file
    $error = array();
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES['file']['name']);
    // Kiểm tra kiểu file hợp lệ
    $type_file = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
    $type_fileAllow = array('png', 'jpg', 'jpeg', 'gif');
    if (!in_array(strtolower($type_file), $type_fileAllow)) {
        $error['file'] = "The file you just selected is not supported by the system, please select an image";
    }
    //Check file size
    $size_file = $_FILES['file']['size'];
    if ($size_file > 5242880) {
        $error['file'] = "The file you selected cannot exceed 5MB";
    }
// Check if the file exists on the system
    if (file_exists($target_file)) {
        $error['file'] = "The file you selected already exists on the system";
    }
//
    if (empty($error)) {
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
           
            $flag = true;
            echo json_encode(array('status' => 'ok', 'file_path' => $target_file));
        } else {
            echo json_encode(array('status' => 'error'));
        }
    } else {
        echo json_encode(array('status' => 'error'));
    }
}
?>