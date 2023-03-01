<?php

$file_name = $_FILES['file']['name'];

if (move_uploaded_file($_FILES['file']['tmp_name'], "upload/user_avatar/" . $file_name)) {
    echo "ไปเบิ่งไฟล์จ้า";
} else {
    echo "เซฟไม่เข้าแมะสู";
}

?>