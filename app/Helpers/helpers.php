<?php
if (!function_exists('getYoutubeId')) {
    function getYoutubeId($url) {
        // Mendukung format watch?v=, youtu.be/, embed/, v/
        if (preg_match('/(?:youtu.be\/|youtube.com\/(?:watch\?v=|embed\/|v\/))([\w-]{11})/', $url, $matches)) {
            return $matches[1];
        }
        // Fallback: ambil ID dari parameter v
        $parts = parse_url($url);
        if (!empty($parts['query'])) {
            parse_str($parts['query'], $query);
            if (!empty($query['v'])) {
                return $query['v'];
            }
        }
        return null;
    }
}
