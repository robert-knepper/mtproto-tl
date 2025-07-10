<?php

namespace BlackHammer\MtprotoTl\Simple;
class Encoder
{

    static function encode_my_request($data, $count)
    {
        $id = pack("V", 0x12345678); 
        $data_len = strlen($data);
        return $id .
            pack("V", $data_len) . $data .
            pack("V", $count);
    }

    static function decode_my_request($binary)
    {
        $id = unpack("V", substr($binary, 0, 4))[1];
        $data_len = unpack("V", substr($binary, 4, 4))[1];
        $data = substr($binary, 8, $data_len);
        $count = unpack("V", substr($binary, 8 + $data_len, 4))[1];
        return [
            'id' => $id,
            'data' => $data,
            'count' => $count
        ];
    }


}