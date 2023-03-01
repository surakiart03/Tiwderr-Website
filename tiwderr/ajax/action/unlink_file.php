<?php
$image_path = json_decode($_POST['path']);

for ($i = 0; $i < count($image_path); $i++) {
    if (is_file('../../' . $image_path[$i])) {
        unlink('../../' . $image_path[$i]);
    }
}

echo 'success';
