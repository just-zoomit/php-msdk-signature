<?php

/**
 * Below are the fields required for the JWT payload
 * appKey: Your SDK Key. Required for Native, optional for Web.
 * sdkKey: Your SDK Key. Required for Web, optional for Native.
 * sdkSecret Required, your SDK API Secret
 * mn: The Zoom Meeting or Webinar Number. Required for Web, optional for Native.
 * role: The user role. Required for Web, optional for Native. Values: 0 to specify participant, 1 to specify host.
 * iat: The current timestamp in epoch format. Required.
 * exp: JWT expiration date. Required. Values: Min = 1800 seconds greater than iat value, max = 48 hours greater than iat value. In epoch format.
 * tokenExp: JWT expiration date. Required. Values: Min = 1800 seconds greater than iat value, max = 48 hours greater than iat value. In epoch format.
 * 
 * Source: https://marketplace.zoom.us/docs/sdk/native-sdks/auth/
 */
function generateSignature($sdkKey, $sdkSecret, $meetingNumber, $role) {
    $iat = time();
    $exp = $iat + 60 * 60 * 2;
    $token_payload = [
        'appKey' => $sdkKey,
        'sdkKey' => $sdkKey,
        'mn' => $meetingNumber,
        'role' => $role,
        'iat' => $iat,
        'exp' => $exp,
        'tokenExp' => $exp
    ];

    $jwt = JWT::encode($token_payload, $sdkSecret, 'HS256');
    
    return $jwt;
}

echo(generateSignature($_ENV['SDK_KEY'], $_ENV['SDK_SECRET'], 12345678912, 0));