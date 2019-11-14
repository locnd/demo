<?php

$dir = '/var/www/demo/resize/pictures';
resizeImagesInFolder($dir);
echo "Success.";

function toFolder($dir) {
    if (!is_dir($dir)) {
        mkdir($dir);
        chmod($dir, 0777);
    }
}

function resizeImagesInFolder($dir) {
    $to_folder = str_replace('/var/www/demo/resize/pictures', '/var/www/demo/resize/done', $dir);
    toFolder($to_folder);

    $files = scandir($dir);
    $i = 0;
    foreach ($files as $file) {
        if ($file != '.' && $file != '..' && $file != 'temp.txt') {
            if (is_dir($dir . '/' . $file)) {
                resizeImagesInFolder($dir . '/' . $file);
            } else {
                echo $dir . '/' . $file;
                $i++;
                $image = new SimpleImage();
                $image->load($dir . '/' . $file);
                if ($image->getHeight() < $image->getWidth()) {
                    $image->resizeToWidth(1920);
                } else {
                    $image->resizeToHeight(1920);
                }
                // $new = 'cover/' . $dir . '/'.$image->name;
                if ($i < 10) {
                    $new = $to_folder . '/00' . $i . '.' . strtolower($image->type);
                } elseif ($i < 100) {
                    $new = $to_folder . '/0' . $i . '.' . strtolower($image->type);
                } else {
                    $new = $to_folder . '/' . $i . '.' . strtolower($image->type);
                }
                $image->save($new);
                echo ' ---------> ' . $new . PHP_EOL. '<br>'. PHP_EOL;
            }
        }
    }
}

class SimpleImage {

    var $image;
    var $image_type;
    var $type;
    var $name;

    function load($filename) {
        $image_info = getimagesize($filename);
        $info = pathinfo($filename);
        $this->name = $info['basename'];
        $this->type = $info['extension'];
        $this->image_type = $image_info[2];
        if ($this->image_type == IMAGETYPE_JPEG) {
            $this->image = imagecreatefromjpeg($filename);
        } elseif ($this->image_type == IMAGETYPE_GIF) {
            $this->image = imagecreatefromgif($filename);
        } elseif ($this->image_type == IMAGETYPE_PNG) {
            $this->image = imagecreatefrompng($filename);
        }
    }

    function save($filename, $image_type = IMAGETYPE_JPEG, $compression = 75, $permissions = null) {
        if ($image_type == IMAGETYPE_JPEG) {
            imagejpeg($this->image, $filename, $compression);
        } elseif ($image_type == IMAGETYPE_GIF) {
            imagegif($this->image, $filename);
        } elseif ($image_type == IMAGETYPE_PNG) {
            imagepng($this->image, $filename);
        }
        if ($permissions != null) {
            chmod($filename, $permissions);
        }
    }

    function output($image_type = IMAGETYPE_JPEG) {
        if ($image_type == IMAGETYPE_JPEG) {
            imagejpeg($this->image);
        } elseif ($image_type == IMAGETYPE_GIF) {
            imagegif($this->image);
        } elseif ($image_type == IMAGETYPE_PNG) {
            imagepng($this->image);
        }
    }

    function getWidth() {
        return imagesx($this->image);
    }

    function getHeight() {
        return imagesy($this->image);
    }

    function resizeToHeight($height) {
        $ratio = $height / $this->getHeight();
        $width = $this->getWidth() * $ratio;
        $this->resize($width, $height);
    }

    function resizeToWidth($width) {
        $ratio = $width / $this->getWidth();
        $height = $this->getheight() * $ratio;
        $this->resize($width, $height);
    }

    function scale($scale) {
        $width = $this->getWidth() * $scale / 100;
        $height = $this->getheight() * $scale / 100;
        $this->resize($width, $height);
    }

    function resize($width, $height) {
        $new_image = imagecreatetruecolor($width, $height);
        imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());
        $this->image = $new_image;
    }

}
