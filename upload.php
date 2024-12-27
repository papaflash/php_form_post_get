<?php
declare(strict_types=1);

if (empty($_POST['file_name']) || empty($_FILES['content'])) {
    header('Location: .\index.html');
}else if($_FILES['content']['size'] > ini_get('upload_max_filesize')) {
    $message = "Файл слишком большой! Максимальный размер: " . ini_get('upload_max_filesize');
    echo "<script type='text/javascript'>alert('$message');</script>";
}else{
    saveUpload();
}

function saveUpload(): void
{
    define('UPLOAD_DIR', '');
    $ext = pathinfo($_FILES['content']['name'], PATHINFO_EXTENSION);
    $name = $_POST['file_name'] . '.' . $ext;
    $source = $_FILES['content']['tmp_name'];
    $destination = './uploads/' . $name;
    if(move_uploaded_file($source, $destination)){
        echo "<p style='font-size:22px'>Файл успешно загружен: " . realpath($destination). "<br>"
            . "Размер файла: " . $_FILES['content']['size'] . " Байт" ."</p>";
    }else{
        echo "Не удалось загрузить файл";
    }
}