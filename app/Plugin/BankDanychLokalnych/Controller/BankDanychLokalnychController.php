<?php

App::uses('Sanitize', 'Utility');

class BankDanychLokalnychController extends AppController
{
    public function index()
    {
        $application = $this->getApplication();
        $this->set('title_for_layout', $application['Application']['name']);
    }
}