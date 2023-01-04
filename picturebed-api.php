<?php
$allowedExts = array('gif', 'jpeg', 'jpg', 'png');
$maxFileSize = 10;  // MB


$temp = explode('.', $_FILES['file']['name']);
$extension = end($temp);

$msg = array(
    'status' => 0,
    'msg' => null,
    'src' => null
);

if (($_FILES['file']['size'] < $maxFileSize * 1024 * 1024) && in_array($extension, $allowedExts))
{
    if ($_FILES['file']['error'] > 0)
    {
        $msg['status'] = -2;
        $msg['msg'] = $_FILES['file']['error'];
        echo json_encode($msg, 256);
    }
    else
    {   
        $msg['status'] = -114514;
        $msg['msg'] = '未知错误.';

        $folder_name = md5(hash('sha512', date('Y/m/d')));
        $file_save_name = md5(hash('sha512', md5_file($_FILES['file']['tmp_name']))) . '.' . $extension;

        $URL = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . '/' . $folder_name . '/' . $file_save_name;
        
        
        if (file_exists($folder_name))
        {
            if (file_exists($folder_name . '/' . $file_save_name))
            {
                $msg['status'] = -3;
                $msg['msg'] = '文件已存在.';
                $msg['src'] = $URL;
            }
            else
            {
                move_uploaded_file($_FILES['file']['tmp_name'], $folder_name . '/' . $file_save_name);
                $msg['status'] = 200;
                $msg['msg'] = 'ok';
                $msg['src'] = $URL;
            }
        }
        else
        {
            if(mkdir($folder_name, 0777)) {
                move_uploaded_file($_FILES['file']['tmp_name'], $folder_name . '/' . $file_save_name);
                $msg['status'] = 200;
                $msg['msg'] = 'ok';
                $msg['src'] = $URL;
            }
        }

        echo json_encode($msg, 256);
    }
}
else
{
    $msg['status'] = -1;
    $msg['msg'] = '未知的文件格式' . $extension . $_FILES['file']['type'];
    echo json_encode($msg,256);
}

