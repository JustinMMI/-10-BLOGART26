<?php
// curl function
function curl($url, $type, $data = null, $headers = null){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $type);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    if($data){
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    }
    if($headers){
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    }
    $result = curl_exec($ch);
    if(curl_errno($ch)){
        echo 'Error:' . curl_error($ch);
    }
    curl_close($ch);
    return $result;
}

// Cookies functions
function cookie_notice(){
    if (!isset($_COOKIE['user_cookie_consent'])) {
        ?>
                <script>
        function acceptCookies() {
            document.cookie = "user_cookie_consent=accepted; path=/; max-age=" + (365 * 24 * 60 * 60);
            var banner = document.getElementById("cookie-banner");
            if (banner) {
                banner.remove();
            }
        }
        function rejectCookies() {
            window.location.href = "https://www.google.com";
        }
        </script>
        <div id="cookie-banner" style="position: fixed; bottom: 0; left: 0; right: 0; background-color: #333; color: white; padding: 20px; text-align: center; z-index: 9999; box-shadow: 0 -2px 10px rgba(0,0,0,0.3);">
            <p style="margin: 0 0 15px 0;">Acceptez-vous les cookies ?</p>
            <button onclick="acceptCookies()" style="background-color: #4CAF50; color: white; border: none; padding: 10px 20px; cursor: pointer; margin-right: 10px; border-radius: 4px;">Accepter les cookies obligatoires</button>
            <button onclick="rejectCookies()" style="background-color: #f44336; color: white; border: none; padding: 10px 20px; cursor: pointer; border-radius: 4px;">Refuser et quitter le site</button>
        </div>
        <?php
    }
}
?>