<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ci_jwt {

    public $header = '{"alg":"HS256","typ":"JWT"}';
    private $alg;
    private $hash;
    private $data;

    private function base64url_encode($data) {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    private function base64url_decode($data) {
        return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
    }

    public function encode($header, $payload, $key) {
        $this->data = $this->base64url_encode($header) . '.' . $this->base64url_encode($payload);
        return $this->data . '.' . $this->JWS($header, $key);
    }

    public function decode($token, $key) {
        $list = explode('.', $token);
        $header = isset($list[0]) ? $list[0] : '';
        $payload = isset($list[1]) ? $list[1] : '';
        $signature = isset($list[2]) ? $list[2] : '';
        $this->data = $header . '.' . $payload;
        if ($signature == $this->JWS($this->base64url_decode($header), $key)) {
            return $this->base64url_decode($payload);
        } else {
            return null;
        }
    }

    private function setAlgorithm($algorithm) {
        switch ($algorithm[0]) {
            case 'n':
                $this->alg = 'plaintext';
                break;
            case 'H':
                $this->alg = 'HMAC';
                break;
            default: exit("RSA and ECDSA not implemented yet!");
        }
        switch ($algorithm[2]) {
            case 'a':
                $this->alg = 'plaintext';
                break;
            case 2:
                $hash = 'sha256';
                break;
            case 3:
                $hash = 'sha384';
                break;
            case 5:
                $hash = 'sha512';
                break;
        }
        if (in_array($hash, hash_algos()))
            $this->hash = $hash;
    }

    private function JWS($header, $key) {
        $json = json_decode($header);
        if (isset($json->alg)) {
            $this->setAlgorithm($json->alg);
            if ($this->alg == 'plaintext') {
                return '';
            }
            return $this->base64url_encode(hash_hmac($this->hash, $this->data, $key, true));
        } else {
            return '';
        }
    }

    public function jwt_encode($data, $key) {
        $payload = json_encode($data);
        return $this->encode($this->header, $payload, $key);
    }

    public function jwt_decode($token, $key) {
        $json = $this->decode($token, $key);
        if ($json != null) {
            return json_decode($this->decode($token, $key));
        } else {
            return null;
        }
    }

}
