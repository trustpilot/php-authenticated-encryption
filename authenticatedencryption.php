<?php
class Trustpilot {
    // To get the keys, base64 decode the keys you copy from the Trustpilot site: base64_decode('dfkkdfj....');
    // The payload should be a JSON object with your order data:
    // $payload = [
    //     'email' => 'john@doe.com',
    //     'name' => 'John Doe',
    //     'ref' => '1234'
    // ];
    // $payload = json_encode($payload);
    public function encryptPayload($payload, $encrypt_key, $auth_key){
        // Generate an Initialization Vector (IV) according to the block size (128 bits)
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('AES-128-CBC'));

        //Encrypting the JSON with the encryptkey and IV with AES-CBC with key size of 256 bits, openssl_encrypt uses PKCS7 padding as default
        $payload_encrypted = openssl_encrypt($payload, 'AES-256-CBC', $encrypt_key, OPENSSL_RAW_DATA, $iv);

        //Create a signature of the ciphertext.
        $HMAC = hash_hmac('sha256', ($iv . $payload_encrypted), $auth_key, true);

        //Now base64-encode the IV + ciphertext + HMAC:
        $base64_payload = base64_encode(($iv . $payload_encrypted . $HMAC));

        return urlencode($base64_payload);
    }
}
?>
