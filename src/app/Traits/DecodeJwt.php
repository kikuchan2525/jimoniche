<?php

declare(strict_types=1);

namespace App\Traits;

use Exception;

trait DecodeJwt
{
    public function decodeJWT($jwt) {
        // JWTを分割
        $parts = explode('.', $jwt);
    
        if (count($parts) !== 3) {
            throw new Exception('Invalid token format');
        }
    
        // ヘッダーとペイロードをBase64URLデコード
        $header = $this->base64UrlDecode($parts[0]);
        $payload = $this->base64UrlDecode($parts[1]);
    
        // デコードしたヘッダーとペイロードをJSONとして戻す
        $header = json_decode($header, true);
        $payload = json_decode($payload, true);
    
        // 結果を返す
        return [
            'payload' => $payload,
        ];
    }

    public function base64UrlDecode($data) {
        $remainder = strlen($data) % 4;
        if ($remainder) {
            $padlen = 4 - $remainder;
            $data .= str_repeat('=', $padlen);
        }
    
        return base64_decode(strtr($data, '-_', '+/'));
    }
}