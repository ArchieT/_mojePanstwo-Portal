<?php

App::uses('AppController', 'Controller');

/**
 * @property Collection Collection
 */
class CollectionsController extends AppController {

    public $components = array('RequestHandler');
    public $uses = array('Collections.Collection');

    public function beforeFilter() {
        parent::beforeFilter();

        if(!$this->Auth->user())
            throw new ForbiddenException;
    }

    public function edit($id) {
        $this->set('response', $this->Collection->edit($id, $this->request->data));
        $this->set('_serialize', array('response'));
    }

    public function get($id) {
        $this->set('response', $this->Collection->get($id));
        $this->set('_serialize', array('response'));
    }

    public function create() {
        $this->set('response', $this->Collection->create($this->request->data));
        $this->set('_serialize', array('response'));
    }

    public function addObject($id, $object_id) {
        $this->set('response', $this->Collection->addObject($id, $object_id));
        $this->set('_serialize', array('response'));
    }

    /**
     * To samo co addObject z tym, że tu wysyłamy w POST wszyskie dane tj.
     * id (collections.id), object_id (objects.id), note (str)
     */
    public function addObjectData() {
        $this->set('response', $this->Collection->addObjectData($this->request->data));
        $this->set('_serialize', array('response'));
    }

    public function removeObject($id, $object_id) {
        $this->set('response', $this->Collection->removeObject($id, $object_id));
        $this->set('_serialize', array('response'));
    }

    public function removeObjects($id) {
        $this->set('response', $this->Collection->removeObjects($id, $this->request->data));
        $this->set('_serialize', array('response'));
    }

}
