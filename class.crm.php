<?php
/**
 * API methods
 */
class CRM {
    const CPA_HOST = "http://cpa.trafa.red";

    /**
     * Campaign visitors counter
     * Async request, via socket
     * @return boolean Socket result
     */
    static public function campaign_counter() {
        return true;
        
        /*
        $url = self::CPA_HOST . "/StatVisites";

        $params = array(
            "_SERVER" => $_SERVER,
            "_COOKIE" => $_COOKIE
        );

        $parts = parse_url($url);
     
        if (!$fp = fsockopen($parts['host'], isset($parts['port']) ? $parts['port'] : 80)) {
            return false;
        }

        $data = http_build_query($params, '', '&');

        fwrite($fp, "POST " . (!empty($parts['path']) ? $parts['path'] : '/') . " HTTP/1.1\r\n");
        fwrite($fp, "Host: " . $parts['host'] . "\r\n");
        fwrite($fp, "Content-Type: application/x-www-form-urlencoded\r\n");
        fwrite($fp, "Content-Length: " . strlen($data) . "\r\n");
        fwrite($fp, "Connection: Close\r\n\r\n");
        fwrite($fp, $data);
        fclose($fp);

        return true;
        */
    }

    /**
     * Get landing settings
     * @return array
     */
    static public function getLandingSettings() {
        $query = array(
            "uid" => 1,
            "key" => "ea256056ff4ae90621df039880d76f29"
        );

        $query = array_merge($query, (array) $_GET);

        $attr = http_build_query($query);
        
        $content = file_get_contents(self::CPA_HOST . "/Api/getLandingSettings?" . $attr);
        
        $content = json_decode($content, true);
        
        if (json_last_error() != JSON_ERROR_NONE) {
            return array();
        }
        
        if (!$content["success"]) {
            return array();
        }
        
        return $content["data"];
    }

    /**
     * landing E-mail
     */
    public function landingMailSend() {

        $attr = http_build_query(array(
            "key" => "ea256056ff4ae90621df039880d76f29",
            "uid" => 1
        ));

        $url = self::CPA_HOST . "/Api/getlandingSubscription?" . $attr;

        $params = array(
            "_SERVER" => $_SERVER,
            "email" => $_POST['email'],
            "fio" => $_POST['fio'],
            "offer" => $_POST['offer']
        );

        $data = http_build_query($params, '', '&');

        if ($curl = curl_init()) {
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            $out = curl_exec($curl);

            echo $out;

            curl_close($curl);
        }
    }
}