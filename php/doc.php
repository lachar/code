<?php

/*
 * 压缩zip
 *
 * $files=array('file1.jpg', 'file2.jpg', 'file3.gif');
 * create_zip($files, 'zip_file.zip', true);
 * */
function create_zip($files = array(),$destination = '',$overwrite = false) {
    if(file_exists($destination) && !$overwrite) { return false; }
    $valid_files = array();
    if(is_array($files)) {
        foreach($files as $file) {
            if(file_exists($file)) {
                $valid_files[] = $file;
            }
        }
    }
    if(count($valid_files)) {
        $zip = new ZipArchive();
        if($zip->open($destination,$overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) !== true) {
            return false;
        }
        foreach($valid_files as $file) {
            $zip->addFile($file,$file);
        }

        $zip->close();

        return file_exists($destination);
    }
    else
    {
        return false;
    }
}

/*
 * 解压
 *
 * */
function unzip($location,$newLocation)
{
    if(exec("unzip $location",$arr)){
        mkdir($newLocation);
        for($i = 1;$i< count($arr);$i++){
            $file = trim(preg_replace("~inflating: ~","",$arr[$i]));
            copy($location.'/'.$file,$newLocation.'/'.$file);
            unlink($location.'/'.$file);
        }
            return TRUE;
        }else{
        return FALSE;
    }
}

/*
 * 缩放图片
 * */
function resize_image($filename, $tmpname, $xmax, $ymax)
{
    $ext = explode(".", $filename);
    $ext = $ext[count($ext)-1];

    if($ext == "jpg" || $ext == "jpeg")
        $im = imagecreatefromjpeg($tmpname);
    elseif($ext == "png")
        $im = imagecreatefrompng($tmpname);
    elseif($ext == "gif")
        $im = imagecreatefromgif($tmpname);

    $x = imagesx($im);
    $y = imagesy($im);

    if($x <= $xmax && $y >= $ymax)
        return $im;

    if($x >= $y) {
    $newx = $xmax;
    $newy = $newx * $y / $x;
}
    else {
    $newy = $ymax;
    $newx = $x / $y * $newy;
}

    $im2 = imagecreatetruecolor($newx, $newy);
    imagecopyresized($im2, $im, 0, 0, 0, 0, floor($newx), floor($newy), $x, $y);
    return $im2;
}