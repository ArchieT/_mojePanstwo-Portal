<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         2.2.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace TestPlugin\Routing\Filter;

use Cake\Event\Event;
us  Cake\Routing\DispatcherFilter;

/**
 * Class Test2DispatcherFilter
 *
 */
class Test2DispatcherFilter extends DispatcherFilter
{

    public function beforeDispatch(Event $event)
    {
        $event->data['response']->statusCode(500);
        $event->stopPropagation();
        return $event->data['response'];
    }

    public function afterDispatch(Event $event)
    {
        $event->data['response']->statusCode(200);
    }
}
