<?php
function redirect($uri = "")
{
    header("Location:" . siteUri($uri));
}

function siteUri($uri = "")
{
    return $_ENV["BASE_URL"] . $uri;
}

function niceDD($inp)
{
    echo "<pre>";
    var_dump($inp);
    echo "</pre>";
}

function includeView($path, $data = [])
{
    extract($data);
    $path = str_replace(".", "/", $path);
    include BASE_PATH . "app/views/$path.php";
}