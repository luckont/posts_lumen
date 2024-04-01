<?php

namespace App\Support;

class Message
{
    public static function resMsg($data = null, $msg = null, $statusCode)
    {
        if ($data) {
            $res['data'] = $data;
        };
        if ($msg) {
            $res['msg'] = $msg;
        };
        return response()->json($res, $statusCode);
    }
}
