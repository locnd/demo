<?php

resizeImagesInFolder(dirname(__FILE__).'/from', 1);
echo "Success.";

function toFolder($dir) {
    if (!is_dir($dir)) {
        mkdir($dir);
        chmod($dir, 0777);
    }
}

function getExtention($file) {
    $parser = explode('.', $file);
    return strtolower(end($parser));
}
function getFolderName($folder) {
    $parser = explode('/', $folder);
    return end($parser);
}
function moveFile($from, $to) {
    rename($from, $to);
    echo ' --- move ---> ' . str_replace(dirname(__FILE__).'/','',$to) . "\n"."<br>"."\n";
}
function resizeImagesInFolder($dir, $i) {
    $image = new SimpleImage();
    $to_folder = str_replace('/from','/to', $dir);
    if (!is_dir($to_folder)) {
        toFolder($to_folder);
    }
    $files = scandir($dir);
    $videoStt = 0;
    $keepName = ['Coca', 'Tmp', 'Memory', 'Photos', 'ĐH Sư Phạm HN', 'Neolab 001', '2006-09-26'];
    $videos = ['mp4', 'mkv', 'mov'];
    $keepType = ['gif'];
    foreach ($files as $key => $file) {
        if ($file != '.' && $file != '..') {
            $ext = getExtention($file);
            if (is_dir($dir . '/' . $file)) {
                resizeImagesInFolder($dir . '/' . $file, 1);
                continue;
            }
            echo str_replace(dirname(__FILE__).'/','',$dir . '/' . $file);
            if ($i < 10) {
                $new = $to_folder . '/00' . $i . '.' . $ext;
            } elseif ($i < 100) {
                $new = $to_folder . '/0' . $i . '.' . $ext;
            } else {
                $new = $to_folder . '/' . $i . '.' . $ext;
            }
            if (in_array($ext, $videos)) {
                $videoStt++;
                $new = $to_folder . '/video ' . $videoStt . '.' . $ext;
                if ($videoStt < 10) {
                    $new = $to_folder . '/video 0' . $videoStt . '.' . $ext;
                }
            }
            if (in_array(getFolderName($dir), $keepName)) {
                $new = $to_folder . '/' . $file;
            }
            if (in_array($ext, $videos) || in_array($ext, $keepType)) {
                moveFile($dir . '/' . $file, $new);
                $i++;
                continue;
            }
            $image->load( $dir . '/' . $file);
            if ($image->getHeight() <= 1920 || $image->getWidth() <= 1920) {
                moveFile($dir . '/' . $file, $new);
                $i++;
                continue;
            }
            if ($image->getHeight() < $image->getWidth()) {
                $image->resizeToWidth(1920);
            } else {
                $image->resizeToHeight(1920);
            }
            $image->save($new);
            echo ' --- resize ---> ' . str_replace(dirname(__FILE__).'/','',$new) . "\n"."<br>"."\n";
            $i++;
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
