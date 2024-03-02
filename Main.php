<?php

namespace IdnoPlugins\Aside {

    class Main extends \Idno\Common\Plugin
    {

        function registerPages()
        {
            \Idno\Core\Idno::site()->routes()->addRoute('/note/edit/?', '\IdnoPlugins\Aside\Pages\Edit');
            \Idno\Core\Idno::site()->routes()->addRoute('/note/edit/:id/?', '\IdnoPlugins\Aside\Pages\Edit');
            \Idno\Core\Idno::site()->routes()->addRoute('/note/delete/:id/?', '\IdnoPlugins\Aside\Pages\Delete');
            \Idno\Core\Idno::site()->routes()->addRoute('/note/:id/.*', '\Idno\Pages\Entity\View');
        }

        function registerTranslations()
        {

            \Idno\Core\Idno::site()->language()->register(
                new \Idno\Core\GetTextTranslation(
                    'text', dirname(__FILE__) . '/languages/'
                )
            );
        }

    }

}
