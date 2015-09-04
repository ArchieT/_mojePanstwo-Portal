<?

Router::connect('/finanse/gminy/:gmina_id/budzet/:typ/dzialy/:id', array(
    'plugin' => 'Finanse',
    'controller' => 'Gminy',
    'action' => 'dzial'
), array(
    'id' => '([0-9]+)',
    'gmina_id' => '([0-9]+)',
    'typ' => '(wydatki|dochody)',
    'pass' => array('id', 'gmina_id', 'typ')
));

Router::connect('/finanse/gminy/:gmina_id/budzet/:typ/dzialy', array(
    'plugin' => 'Finanse',
    'controller' => 'Gminy',
    'action' => 'dzialy'
), array(
    'gmina_id' => '([0-9]+)',
    'typ' => '(wydatki|dochody)',
    'pass' => array('gmina_id', 'typ')
));

Router::connect('/finanse/samorzad', array('plugin' => 'FinanseGmin', 'controller' => 'FinanseGmin', 'action' => 'index'));
Router::connect('/finanse/samorzad/:action', array('plugin' => 'FinanseGmin', 'controller' => 'FinanseGmin'));

Router::connect('/finanse', array('plugin' => 'Finanse', 'controller' => 'Finanse', 'action' => 'view'));
Router::connect('/finanse/:action', array('plugin' => 'Finanse', 'controller' => 'Finanse'));
