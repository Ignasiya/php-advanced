<?php

require '/vendor/autoload.php';

use League\OAuth2\Client\Provider\Google;

session_start();

$provider = new Google([
    'clientId'     => '{google-client-id}',
    'clientSecret' => '{google-client-secret}',
    'redirectUri'  => 'https://example.com/callback-url',
]);

if (empty($_GET['code'])) {

    $authUrl = $provider->getAuthorizationUrl();
    $_SESSION['oauth2state'] = $provider->getState();
    header('Location: ' . $authUrl);
    exit;

} elseif (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {

    unset($_SESSION['oauth2state']);
    exit('Invalid state');

} else {

    $token = $provider->getAccessToken('authorization_code', [
        'code' => $_GET['code']
    ]);
}