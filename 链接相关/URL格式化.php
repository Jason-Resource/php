<?php
$title = '������';
$apiUrl = 'http://example.com/lyricsapi&songtitle=%s';

echo sprintf($apiUrl, urlencode($title));