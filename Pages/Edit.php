<?php

namespace IdnoPlugins\Aside\Pages {

    use Idno\Core\Autosave;

    class Edit extends \Idno\Common\Page
    {

        function getContent()
        {

            $this->createGatekeeper();    // This functionality is for logged-in users only

            // Are we loading an entity?
            if (!empty($this->arguments)) {
                $object = \IdnoPlugins\Aside\Note::getByID($this->arguments[0]);
            } else {
                $object = new \IdnoPlugins\Aside\Note();
                $autosave = new \Idno\Core\Autosave();
                foreach (array(
                    'title', 'body'
                ) as $field) {
                    $object->$field = $autosave->getValue('aside', $field);
                }
            }

            if (!$object) $this->noContent();

            if ($owner = $object->getOwner()) {
                $this->setOwner($owner);
            }

            $t = \Idno\Core\Idno::site()->template();
            $edit_body = $t->__(array(
                'object' => $object
            ))->draw('entity/Note/edit');

            $body = $t->__(['body' => $edit_body])->draw('entity/editwrapper');

            if (empty($object->_id)) {
                $title = \Idno\Core\Idno::site()->language()->_('Write an aside');
            } else {
                $title = \Idno\Core\Idno::site()->language()->_('Edit aside');
            }

            if (!empty($this->xhr)) {
                echo $body;
            } else {
                $t->__(array('body' => $body, 'title' => $title))->drawPage();
            }
        }

        function postContent()
        {
            $this->createGatekeeper();

            $new = false;
            if (!empty($this->arguments)) {
                $object = \IdnoPlugins\Aside\Note::getByID($this->arguments[0]);
            }
            if (empty($object)) {
                $object = new \IdnoPlugins\Aside\Note();
            }

            if ($object->saveDataFromInput()) {
                (new \Idno\Core\Autosave())->clearContext('aside');
                //$this->forward(\Idno\Core\Idno::site()->config()->getURL() . 'content/all/');
                //$this->forward($object->getDisplayURL());
                $forward = $this->getInput('forward-to', $object->getDisplayURL());
                $this->forward($forward);
            }

        }

    }

}
