<?php
namespace helpers;
use function helpers\asset;

function get_header()
{
    include_once(__DIR__ . '/../../public_html/views/partials/metas.php');
}

function get_navbar() {
    include_once(__DIR__ . '/../../public_html/views/partials/navbar.php');
}

function get_footer()
{
    include_once(__DIR__ . '/../../public_html/views/partials/footer.php');
    include_once(__DIR__ . '/../../public_html/views/partials/scripts.php');
    echo '<script src="' . asset('js/app.js') . '"></script>';
}