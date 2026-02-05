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
    curl_close($ch);
    return $result;
}

function cookie_notice(){
    if (!isset($_COOKIE['user_cookie_consent'])) {
        ?>
        <script>
        function acceptCookies() {
            document.cookie = "user_cookie_consent=accepted; path=/; max-age=" + (365 * 24 * 60 * 60);
            location.reload();
        }

        function rejectCookies() {
            window.location.href = "https://www.google.com";
        }
        </script>

        <div id="cookie-banner"
             style="position: fixed; bottom: 0; left: 0; right: 0;
                    background-color: #333; color: white;
                    padding: 20px; text-align: center;
                    z-index: 9999;
                    box-shadow: 0 -2px 10px rgba(0,0,0,0.3);">

            <?php if (isset($_GET['cookie_required'])): ?>
                <div style="color:#ff4d4d; font-weight:bold; margin-bottom:10px;">
                    Veuillez accepter au préalable les cookies
                </div>
            <?php endif; ?>

            <p style="margin: 0 0 15px 0;">Acceptez-vous les cookies ?</p>

            <div style="margin-bottom: 15px; font-size: 0.9em;">
                <a href="/views/frontend/rgpd/rgpd.php" style="color: #c7a14a; text-decoration: none; margin-right: 15px;">RGPD</a>
                <a href="/views/frontend/rgpd/cgu.php" style="color: #c7a14a; text-decoration: none;">CGU</a>
            </div>

            <button onclick="acceptCookies()"
                style="background-color: #4CAF50; color: white;
                       border: none; padding: 10px 20px;
                       cursor: pointer; margin-right: 10px;
                       border-radius: 4px;">
                Accepter les cookies obligatoires
            </button>

            <button onclick="rejectCookies()"
                style="background-color: #f44336; color: white;
                       border: none; padding: 10px 20px;
                       cursor: pointer; border-radius: 4px;">
                Refuser et quitter le site
            </button>
        </div>
        <?php
    }
}

function cookie_wall() {

    if (!isset($_COOKIE['user_cookie_consent'])) {

        $currentPage = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        if ($currentPage !== '/' && $currentPage !== '/index.php') {
            header('Location: /?cookie_required=1');
            exit;
        }
    }
}
?>
