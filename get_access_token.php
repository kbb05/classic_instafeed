<?php 
    $client_id = '621531509267014';
    // $redirect_uri = '/connect.php';
    $redirect_uri = 'https://classicdesigns.studio/classic-instafeed/connect.php';
    $scope ="user_profile,user_media";
    $authorization_url = "https://api.instagram.com/oauth/authorize?client_id=" . $client_id . "&redirect_uri=" . $redirect_uri . "&scope=" . $scope . "&response_type=code";
    // echo $authorization_url;
    header("Location:".$authorization_url);
?>