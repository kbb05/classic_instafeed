<?php 
    $client_id = '621531509267014';
    $client_secret ='548cad755c73a68833ab731632a880cf';
    $redirect_uri = 'https://classicdesigns.studio/connect.php';
    $code = $_GET['code'];

    $url = "https://api.instagram.com/oauth/access_token";
    $access_token_parameters = array(
        'client_id'                =>     $client_id,
        'client_secret'            =>     $client_secret,
        'grant_type'               =>     'authorization_code',
        'redirect_uri'             =>     $redirect_uri,
        'code'                     =>     $code
    );

    $curl = curl_init($url);    // we init curl by passing the url
    curl_setopt($curl,CURLOPT_POST,true);   // to send a POST request
    curl_setopt($curl,CURLOPT_POSTFIELDS,$access_token_parameters);   // indicate the data to send
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);   // to return the transfer as a string of the return value of curl_exec() instead of outputting it out directly.
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);   // to stop cURL from verifying the peer's certificate.
    $result = curl_exec($curl);   // to perform the curl session
    curl_close($curl);   // to close the curl session
    $result = json_decode($result, true);
    $userid = $result['user_id'];

    $url = "https://graph.instagram.com/access_token";
    $long_term_access_token_parameters = array(
        'client_secret' =>  $client_secret,
        'grant_type'    =>  'ig_exchange_token',
        'access_token'  =>  $result['access_token'],
    );

    $curl = curl_init($url."?".http_build_query($long_term_access_token_parameters));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    $result = curl_exec($curl);
    curl_close($curl);
    $result = json_decode($result, true);
    $result['user_id'] = $userid;
    
    header("Location:https://classicapp.myshopify.com/admin/apps/instagram_feed-1/?" .  http_build_query($result));
?>