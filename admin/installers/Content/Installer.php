<?php

use Sirius\Admin\Installer as InstallManager;


class Installer extends InstallManager
{

    public $tables = array(
        'contents'
    );

    public $routes = array(
        'tr' => array(
            'route' => array(
                '@uri/[a-zA-Z0-9_-]+/([0-9]+)' => 'ContentController/view/$1',
            ),
            'uri' => 'icerik'
        ),
        'en' => array(
            'route' => array(
                '@uri/[a-zA-Z0-9_-]+/([0-9]+)' => 'ContentController/view/$1',
            ),
            'uri' => 'content'
        ),
    );

}