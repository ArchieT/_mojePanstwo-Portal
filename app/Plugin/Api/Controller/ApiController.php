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
		$this->title = 'API - Buduj aplikacje w oparciu o dane publiczne';
    }
    
    public function bdl()
    {
		$this->title = 'API - Bank Danych Lokalnych';
    }

    public function view($slug)
    {
        $uiRoot = Router::url(array('plugin' => 'api', 'controller' => 'api', 'action' => 'view', 'slug' => $slug), false);

        $this->chapter_selected = '';
        $this->set(compact('uiRoot', 'slug'));
        
        
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
			'label' => 'Bank Danych Lokalnych',
			'href' => '/api/bdl',
			'id' => 'bdl',
			'icon' => 'icon-datasets-dot',
		);
        
		
		$output = array(
			'items' => $items,
			'selected' => ($this->chapter_selected=='view') ? false : $this->chapter_selected,
		);

		return $output;

	}
}