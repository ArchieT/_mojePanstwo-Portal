	<?

App::uses('ApplicationsController', 'Controller');

class ApiController extends ApplicationsController
{
    public $helpers = array();

    public $components = array();

	public $settings = array(
		'id' => 'api',
	);
	
    public function beforeFilter()
    {
        parent::beforeFilter();
    }

    public function index()
    {
		// $this->menu_selected = 'view';
		$this->title = 'API - Buduj aplikacje w oparciu o dane publiczne';
    }

    public function view($slug)
    {
        $uiRoot = Router::url(array('plugin' => 'api', 'controller' => 'api', 'action' => 'view', 'slug' => $slug), false);

        $this->chapter_selected = '';
        $this->set(compact('uiRoot', 'slug'));
        
        
    }

    public function info()
    {
		$this->title = 'Informacje ogólne o API';
    }
    
    public function getMenu()
    {
	    
	    $menu = array(
		    'items' => array(
			    array(
				    'label' => 'Start',
					'icon' => array(
						'src' => 'glyphicon',
						'id' => 'home',
					),
			    ),
			    array(
				    'id' => 'technical_info',
				    'label' => 'Opis techniczny',
			    ),
                array(
                    'id' => 'bdl',
                    'label' => 'Statystyki'
                )
		    ),
		    'base' => '/api',
	    );
	    return $menu;
	    
    }
    
    public function getChapters() {

		$mode = false;
		$items = array();
		$app = $this->getApplication( $this->settings['id'] );
				
		$items[] = array(
			'label' => 'API',
			'href' => '/' . $this->settings['id'],
			'class' => '_label',
			'icon' => 'appIcon',
			'appIcon' => $app['icon'],
		);
		
		$items[] = array(
			'label' => 'Informacje ogólne',
			'href' => '/api/info',
			'id' => 'info',
			'icon' => 'icon-datasets-dot',
		);
        
		
		$output = array(
			'items' => $items,
			'selected' => ($this->chapter_selected=='view') ? false : $this->chapter_selected,
		);

		return $output;

	}
}