<?php
// Visit counter — IP-based rate limiting (no session needed, works anywhere in the page)
$counterFile = dirname(__DIR__) . '/data/counter.txt';
$timeout     = 3600; // 1 hour

$ip       = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
$tmpFile  = sys_get_temp_dir() . '/pcm_visit_' . md5($ip) . '.tmp';

if (!file_exists($tmpFile) || (time() - filemtime($tmpFile)) > $timeout) {
    touch($tmpFile);
    $count = file_exists($counterFile) ? (int) file_get_contents($counterFile) : 0;
    file_put_contents($counterFile, $count + 1);
}
?>
