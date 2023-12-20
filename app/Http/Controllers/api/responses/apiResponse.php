<?php
namespace App\Http\Controllers\api\responses;

trait apiResponse{
    public function apiResponse($data = null, $msg = null, $status = null){
        $arr = [
            'data' => $data,
            'message' => $msg,
            'status' => $status
        ];
        return response($arr);
    }
}