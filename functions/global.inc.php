<?php
/**
 * Include all functions loaders
*/

require_once __DIR__ . '/query/load.php';
require_once __DIR__ . '/security.php';
require_once __DIR__ . '/various.php';

function parseBBCode(string $text): string
{
    // Sécurité de base (empêche le HTML injecté)
    $text = htmlspecialchars($text, ENT_QUOTES, 'UTF-8');

    $bbcode = [
        '/\[b\](.*?)\[\/b\]/is'       => '<strong>$1</strong>',
        '/\[i\](.*?)\[\/i\]/is'       => '<em>$1</em>',
        '/\[u\](.*?)\[\/u\]/is'       => '<u>$1</u>',
        '/\[s\](.*?)\[\/s\]/is'       => '<s>$1</s>',
        '/\[quote\](.*?)\[\/quote\]/is' => '<blockquote>$1</blockquote>',
        '/\[code\](.*?)\[\/code\]/is' => '<pre><code>$1</code></pre>',
        '/\[url=(.*?)\](.*?)\[\/url\]/is' => '<a href="$1" target="_blank" rel="noopener">$2</a>',

    ];

    foreach ($bbcode as $pattern => $replace) {
        $text = preg_replace($pattern, $replace, $text);
    }

    return nl2br($text);
}

function e(string $text): void
{
    echo parseBBCode($text);
}

function getLikeCount(int $numArt): int
{
    $result = sql_select(
        'LIKEART',
        'COUNT(*) AS total',
        "numArt = $numArt"
    );

    return (int)($result[0]['total'] ?? 0);
}

?>