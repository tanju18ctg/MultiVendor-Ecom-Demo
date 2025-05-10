<?php

//use for send data

use Intervention\Image\Facades\Image;

function send_data($data, $code = 404)
{
    $response = [
        'status' => true,
        // 'message' => $message,
        'data' =>  $data,
    ];
    return response()->json($response, $code);
}

function send_msg($msg, $status_type, $code = 404)
{
    $response = [
        'status' => $status_type,
        'message' => $msg,
    ];
    return response()->json($response, $code);
}


//use for send success message
function send_succ_msg($msg, $code = 404)
{
    $response = [
        'status' => true,
        'message' => $msg,
    ];
    return response()->json($response, $code);
}

//use for send data
function send_err_msg($msg, $code = 404)
{
    $response = [
        'status' => true,
        'message' => $msg,
    ];
    return response()->json($response, $code);
}

function send_validation_err_msg($msg, $code = 422)
{
    $response = [
        'errors' => $msg,
    ];
    return response()->json($response, $code);
}

/**
 * MAKE AVATAR FUNCTION
 */
if (!function_exists('makeAvatar')) {

    function makeAvatar($fontPath, $dest, $char)
    {
        $path = $dest;
        $image = imagecreate(200, 200);
        $red = rand(0, 255);
        $green = rand(0, 255);
        $blue = rand(0, 255);
        imagecolorallocate($image, $red, $green, $blue);
        $textcolor = imagecolorallocate($image, 255, 255, 255);
        imagettftext($image, 100, 0, 50, 150, $textcolor, $fontPath, $char);
        imagepng($image, $path);
        imagedestroy($image);
        return $path;
    }
}

if (!function_exists('uploadImage')) {
    function uploadImage($image, $path, $name, $size)
    {
        $size = $size ? $size : $size = [400, 400];

        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $name = $name ? $name : date('mdYHis') . substr(str_shuffle(str_repeat($pool, 5)), 0, 16) . '_' . $size[0] . '_' . $size[1];

        $fileName = $name . '.' . $image->getClientOriginalExtension();
        $fullPath = $path . '/' . $fileName;
        Image::make($image)->resize($size[0], $size[1])->save($fullPath);

        $savePath = '/' . $fullPath;
        return $savePath;
    }
}
