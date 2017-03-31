# Trustpilot authenticated encryption for PHP

Library for authenticated encryption used with Trustpilot.

# Usage

Include the Trustpilot class, and invoke it:

```php
    // To get the keys, base64 decode the keys you copy from the Trustpilot site:
    $encrypt_key = base64_decode('dfkkdfj....');
    $auth_key = base64_decode('dj83lshi....');
    // The payload should be a JSON object with your order data:
    $payload = [
        'email' => 'john@doe.com',
        'name' => 'John Doe',
        'ref' => '1234'
    ];
    $payload = json_encode($payload);
    $trustpilot = new Trustpilot; 
    $encryptedData = $trustpilot-> {'encryptPayload'}($payload, $encrypt_key, $auth_key);
    $trustpilot_invitation_link = "https://www.trustpilot.com/evaluate-bgl/<domainName>?p=" . $encryptedData
```
