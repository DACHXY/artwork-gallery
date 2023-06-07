<?php
session_start();

// 未登入
if ($_SESSION["logged_in"] == false) {
    session_destroy();
    header("Location: /login");
    exit();
}

@require_once $_SERVER['DOCUMENT_ROOT'] . "/helper/helper.php";
@require_once $_SERVER['DOCUMENT_ROOT'] . "/db/context.php";
@include $_SERVER['DOCUMENT_ROOT'] . "/db/dbConnect.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['image'])) {
        $file = $_FILES['image'];
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);

        // 获取文件相关信息
        $fileName = generateUUID();
        $fileTmpPath = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];

        $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/www/images/avatars/';
        $targetFilePath = $uploadDir . $fileName . "." . $extension;

        if (move_uploaded_file($fileTmpPath, $targetFilePath)) {
            $email = $_SESSION["email"];
            $user_id = $_SESSION["id"];
            $user = getUserByEmail($pdo, $email)[0];
            $old_avatar = $user["avatar"];
            if ($old_avatar != "/www/images/avatars/default.jpg") {
                if (file_exists($_SERVER['DOCUMENT_ROOT'] . $old_avatar)) {
                    if (unlink($old_avatar)) {
                        echo '檔案已成功刪除';
                    } else {
                        echo '無法刪除檔案。';
                    }
                }
            }

            $new_avatar = "/www/images/avatars/$fileName.$extension";
            // 上傳成功, 更新頭貼
            $new_user = [
                "avatar" => $new_avatar
            ];

            updateUser($pdo, $new_user, $user_id);
            $_SESSION["avatar"] = $new_avatar;
        } else {
            Header("location: /me?error=You+have+not+selected+any+file");
            exit();
        }
    }
    Header("location: /me?edit=success");
    exit();
} else {
    Header("location: /me");
    exit();
}
?>