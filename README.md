# Sample Zoom Meeting SDK PHP Signature Generator

This is a sample PHP code that generates an encrypted SDK JSON Web Token (JWT) for Zoom Meeting SDK. This helps developers to quickly generate JWT token using the [SDK App Type](https://marketplace.zoom.us/docs/guides/build/sdk-app/) credentials. You can refer to [SDK Authorization](https://marketplace.zoom.us/docs/sdk/native-sdks/auth/) for SDK JWT details.

JWT is generated based on the following core parts as stated in the [documentation](https://marketplace.zoom.us/docs/sdk/native-sdks/auth#generate-the-sdk-jwt). Please create an environment file to store your SDK Key and Secret.

For JWT Token generation, [PHP-JWT](https://github.com/firebase/php-jwt) library is used to encode and decode JSON Web Tokens (JWT) in PHP, conforming to RFC 7519. For more JWT libraries and examples, see [JWT.io](https://jwt.io/libraries).

Example
-------
```php
use \Firebase\JWT\JWT;

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
```