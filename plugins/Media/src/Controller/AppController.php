<?php

namespace Media\Controller;

use App\Controller\AppController as BaseController;
use Cake\Event\Event;
use Cake\I18n\I18n;

class AppController extends BaseController
{

    /**
     * beforeFilter callback
     *
     * @return void
     */
    public function beforeFilter(Event $event) {
        parent::beforeFilter($event);
        I18n::locale('fr_FR');
    }
}
