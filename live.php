<?php
require_once 'jitendraunatti.php';
global $SCARLET_WITCH, $MJ;
$ROLEX = [
    'User-Agent: Mozilla/5.0 (QtEmbedded; U; Linux; C) AppleWebKit/533.3 (KHTML, like Gecko) MAG200 stbapp ver: 2 rev: 250 Safari/533.3',
    'Connection: Keep-Alive',
];
if (@$_REQUEST['id']) {
    $ANTMAN = json_decode(doctor_strange($_REQUEST['id']), true);
    if ($ANTMAN['JITENDRAUNATTI']['Statuscode'] !== 200) {
        if (strpos($ANTMAN['JITENDRAUNATTI']['data'], 'Authorization failed') !== false) {
            @unlink($DARK_SIDE . "/login.jitendraunatti");
            header("Location: " . $_SERVER['REQUEST_URI']);
            exit;
        }
    }
    $stream = $ANTMAN['JITENDRAUNATTI']['cmd'];
    if (strpos($stream, "http") !== false) {
        if ($MJ['Proxy'] == "DIRECT") {
            header("Location: " .  $stream);
            exit();
        }
        $DOCTOR_STRANGE = jitendraunatti($stream, $ROLEX, "GET", null, 0, 1, 0, 0, true);
        $CHRISTINE =  $DOCTOR_STRANGE["JITENDRAUNATTI"]["data"];
        $status_code = (int)($DOCTOR_STRANGE["JITENDRAUNATTI"]["info"]["http_code"]);
        if ($status_code == "301" || $status_code == "302") {
            $VISION = dirname(explode('?', $stream)[0]) . "/";
            $WALTER = 'live.php?token=' . base64_decode(hex2bin("536b6c5552553545556b46665331564e5156493d"))  . '&jitendraunatti=' .  scarlet_witch("encrypt", $VISION) .  '&wanda=' . scarlet_witch("encrypt", $stream) . "\n";
            header("Location: " .  $WALTER);
            exit();
        }
        if ((strpos($stream, "http") !== false) && $status_code == "200") {
            $VISION = dirname(explode('?', $stream)[0]) . "/";
            header("Content-Type: application/vnd.apple.mpegurl");
            $CASSIE = '';
            $JPD = explode("\n", $DOCTOR_STRANGE['JITENDRAUNATTI']['data']);
            foreach ($JPD as $WANDA) {
                if (empty($WANDA)) continue;
                if (strpos($WANDA, 'URI="') !== false) {
                    $CASSIE .= str_replace('URI="', 'URI="live.php?token=' . base64_decode(hex2bin("536b6c5552553545556b46665331564e5156493d")) .  '&wanda=' .  scarlet_witch("encrypt", $VISION), $WANDA) . "\n";
                } elseif (strpos($WANDA, '.m3u8') !== false && strpos($WANDA, '#') === false) {
                    $CASSIE .= 'live.php?token=' . base64_decode(hex2bin("536b6c5552553545556b46665331564e5156493d")) . '&jitendraunatti=' .  scarlet_witch("encrypt", $VISION) . '&wanda=' . scarlet_witch("encrypt", $VISION . $WANDA) . "\n";
                } elseif (strpos($WANDA, '.ts') !== false && strpos($WANDA, '#') === false) {
                    $CASSIE .= 'live.php?token=' . base64_decode(hex2bin("536b6c5552553545556b46665331564e5156493d")) . '&jitendraunatti=' .  scarlet_witch("encrypt", $VISION) . '&cassie=' . scarlet_witch("encrypt", $VISION . $WANDA) . "\n";
                } else {
                    $CASSIE .= $WANDA . "\n";
                }
            }
            exit(trim(str_replace(["#EXTM3U"], ["#EXTM3U\n#DEVELOPED_BY_{$SCARLET_WITCH['JITENDRA_UNIVERSE']["x-developed-by"]}\n#AUTHOR-{$SCARLET_WITCH['JITENDRA_UNIVERSE']["token"]}"], $CASSIE)));
        } else {
            header("Location: " .  $stream);
            exit;
        }
    } else {
        header("Location: " . $SCARLET_WITCH['meta_data']["fallback_video"]);
        exit;
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
} elseif (!empty($_REQUEST['wanda']) && $_REQUEST['token'] == base64_decode(hex2bin("536b6c5552553545556b46665331564e5156493d"))) {
    $DOCTOR_STRANGE = jitendraunatti(scarlet_witch("decrypt", $_REQUEST['wanda']), $ROLEX, "GET", null, 0, 1, 0, 0, true);
    $CHRISTINE =  $DOCTOR_STRANGE["JITENDRAUNATTI"]["data"];
    $status_code = (int)($DOCTOR_STRANGE["JITENDRAUNATTI"]["info"]["http_code"]);
    $VISION = scarlet_witch("decrypt", $_REQUEST['jitendraunatti']);
    if ((strpos($VISION, "http") !== false) && $status_code == "200") {
        header("Content-Type: application/vnd.apple.mpegurl");
        $CASSIE = '';
        $JPD = explode("\n", $DOCTOR_STRANGE['JITENDRAUNATTI']['data']);
        foreach ($JPD as $WANDA) {
            if (empty($WANDA)) continue;
            if (strpos($WANDA, '.ts') !== false && strpos($WANDA, '#') === false) {
                $CASSIE .= 'live.php?token=' . base64_decode(hex2bin("536b6c5552553545556b46665331564e5156493d")) . '&cassie=' . scarlet_witch("encrypt", $VISION . $WANDA) . "\n";
            } else {
                $CASSIE .= $WANDA . "\n";
            }
        }
        exit(trim(str_replace(["#EXTM3U"], ["#EXTM3U\n#DEVELOPED_BY_{$SCARLET_WITCH['JITENDRA_UNIVERSE']["x-developed-by"]}\n#AUTHOR-{$SCARLET_WITCH['JITENDRA_UNIVERSE']["token"]}"], $CASSIE)));
    }
} elseif (!empty($_REQUEST['cassie']) && $_REQUEST['token'] == base64_decode(hex2bin("536b6c5552553545556b46665331564e5156493d"))) {
    // Stream the segment straight through instead of buffering it, so large VOD
    // segments are not cut off by a fixed timeout (which made players restart).
    @set_time_limit(0);
    @ini_set('zlib.output_compression', '0');
    while (ob_get_level() > 0) {
        ob_end_clean();
    }
    $HEADERS = $ROLEX;
    if (!empty($_SERVER['HTTP_RANGE'])) {
        $HEADERS[] = 'Range: ' . $_SERVER['HTTP_RANGE'];
    }
    $IRON_MAN = curl_init(scarlet_witch("decrypt", $_REQUEST['cassie']));
    curl_setopt($IRON_MAN, CURLOPT_HTTPHEADER, $HEADERS);
    curl_setopt($IRON_MAN, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($IRON_MAN, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($IRON_MAN, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($IRON_MAN, CURLOPT_CONNECTTIMEOUT, 10);
    // No overall timeout; abort only if the upstream stalls (< 1 KB/s for 30s).
    curl_setopt($IRON_MAN, CURLOPT_TIMEOUT, 0);
    curl_setopt($IRON_MAN, CURLOPT_LOW_SPEED_LIMIT, 1024);
    curl_setopt($IRON_MAN, CURLOPT_LOW_SPEED_TIME, 30);
    $SENT_STATUS = false;
    curl_setopt($IRON_MAN, CURLOPT_HEADERFUNCTION, function ($ch, $line) use (&$SENT_STATUS) {
        if (preg_match('#^HTTP/\S+\s+(\d{3})#', $line, $m)) {
            // A new status line starts each response in a redirect chain.
            http_response_code((int)$m[1]);
            header_remove('Content-Length');
            header_remove('Content-Range');
            $SENT_STATUS = true;
        } elseif (preg_match('/^(Content-Type|Content-Length|Content-Range|Accept-Ranges):/i', $line)) {
            header(trim($line), true);
        }
        return strlen($line);
    });
    curl_setopt($IRON_MAN, CURLOPT_WRITEFUNCTION, function ($ch, $chunk) {
        echo $chunk;
        flush();
        return connection_aborted() ? 0 : strlen($chunk);
    });
    header("Content-Type: video/mp2t");
    curl_exec($IRON_MAN);
    if (curl_errno($IRON_MAN) && !$SENT_STATUS && !headers_sent()) {
        http_response_code(502);
    }
    @curl_close($IRON_MAN);
} else {
    header("Location: " . $SCARLET_WITCH['meta_data']["fallback_video"]);
    exit;
}
