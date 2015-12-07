<?php

$dir = 'picture';

if (!is_dir('cover')) {
    toFolder('cover');
}
resizeImagesInFolder($dir, 1);
echo "Success.";

function toFolder($dir) {
    if (!is_dir($dir)) {
        mkdir($dir);
        chmod($dir, 0777);
    }
}

function resizeImagesInFolder($dir, $i) {
    if (!is_dir('cover/' . $dir)) {
        toFolder('cover/' . $dir);
    }

    $files = scandir($dir);
    foreach ($files as $key => $file) {
        if ($file != '.' && $file != '..') {
            if (!is_dir($dir . '/' . $file)) {
                echo $dir . '/' . $file;
                $image = new SimpleImage();
                $image->load($dir . '/' . $file);
                if ($image->getHeight() < $image->getWidth()) {
                    $image->resizeToWidth(1024);
                } else {
                    $image->resizeToHeight(1024);
                }
                if ($i < 10) {
                    $new = 'cover/' . $dir . '/00' . $i . '.' . $image->type;
                } elseif ($i < 100) {
                    $new = 'cover/' . $dir . '/0' . $i . '.' . $image->type;
                } else {
                    $new = 'cover/' . $dir . '/' . $i . '.' . $image->type;
                }
                $image->save($new);
                echo ' ---------> ' . $new . '<br>';
                $i++;
            } else {
                resizeImagesInFolder($dir . '/' . $file, 1);
            }
        }
    }
}

class SimpleImage {

    var $image;
    var $image_type;
    var $type;

    function load($filename) {
        $image_info = getimagesize($filename);
        $info = pathinfo($filename);
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
