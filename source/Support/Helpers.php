<?php

/**
 * Config site
 *
 * @param string $param
 * @return string
 */
function site(string $param = null): string
{
    if ($param && !empty(SITE[$param])) {
        return SITE[$param];
    }

    return SITE["root"];
}

/**
 * Image Text
 *
 * @param string $imageUrl
 * @return string
 */
function routeImage(string $imageUrl): string
{
    return "https://via.placeholder.com/1200x628/002B36/FFFFFF?text={$imageUrl}";
}

/**
 * Return asset
 *
 * @param string $path
 * @return string
 */
function asset(string $path, string $template= "", $time = true): string
{
    $file =  SITE["root"] . "/views/{$template}/assets/{$path}";
    $fileOnDir = dirname(__DIR__, 1) . "/views/{$template}/assets/{$path}";

    if ($time && file_exists($fileOnDir)) {
        $file .= "?time=" . filemtime($fileOnDir);
    }
    return $file;
}

/**
 * Message info
 *
 * @param string $type
 * @param string $message
 * @return string|null
 */
function flash(string $type = null, string $message = null): ?string
{
    if ($type && $message) {
        $_SESSION["flash"] = [
            "type" => $type,
            "message" => $message
        ];

        return null;
    }

    if (!empty($_SESSION["flash"]) && $flash = $_SESSION["flash"]) {
        unset($_SESSION["flash"]);
        return "<div class=\"message {$flash["type"]}\">{$flash["message"]}</div>";
    }

    return null;
}


/**
 * @param string $price
 * @return string
 */
function str_price(?string $price): string
{
    return number_format((!empty($price) ? $price : 0), 2, ",", ".");
}

/**
 * @param string $price
 * @return string
 */
function str_percentage(?string $price): string
{
    return number_format((!empty($price) ? $price : 0), 2, ",", ".");
}

function percentage_sub(float $percentage)
{
    return $percentage/100;
}