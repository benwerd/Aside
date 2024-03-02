<?php

namespace IdnoPlugins\Aside {

    class ContentType extends \Idno\Common\ContentType
    {

        public $title = 'Aside';
        public $category_title = 'Asides';
        public $entity_class = 'IdnoPlugins\\Aside\\Note';
        public $logo = '<i class="fa-solid fa-ellipsis"></i>';
        public $indieWebContentType = array('article','aside');

    }

}

