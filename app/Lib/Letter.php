<?

namespace MP\Lib;

class Letter
{
    public $force_hl_fields = false;
    public $data;
    public $static;
    public $layers = array();
    public $contexts = array();
    public $id;
    public $dataset;
    public $object_id;
    public $global_id;
    public $slug;
    public $hl = null;
    public $classes = array();
    public $subscribtion = false;
    public $inner_hits = array();
    public $options = array();
    public $page = array();
	protected $schema = array();
    protected $_routes = array(
        'date' => 'data',
        'title' => 'title',
        'shortTitle' => 'title',
        'description' => 'opis',
        'label' => 'label',
        'titleAddon' => false,
        'position' => false,
    );
    protected $routes = array(
	    'shortTitle' => 'title',
	    'title' => 'title',
	    'position' => false,
	    'titleAddon' => false,
	    'description' => 'description',
    );
	protected $hl_fields = array();
	protected $tiny_label = '';

    public function __construct($params = array(), $options = array())
    {


        $this->options = $options;
        $this->data = $params['_source'];
        $this->id = $params['_id'];
        // $this->slug = $params['slug'];

    }

	public function getSubscribtion() {
		return (boolean) $this->subscribtion;
	}

	public function getMetaDescription($preset = false) {

		$parts = $this->getMetaDescriptionParts($preset);

		if( empty($parts) )
			return false;
		else {
			$parts = array_filter($parts);
			return implode(' <span class="sep">-</span> ', $parts);
		}

	}

    public function getMetaDescriptionParts($preset = false)
    {
	    
	    $output = array();
	    
	    if( $v = $this->getData('to_label') )
	    	$output[] = $v;
	    	
	    if( $v = $this->getData('created_at') )
	    	$output[] = dataSlownie( $v );
	    	
        return $output;
    }

	public function getMataDate() {
		return false;
	}

	public function getClasses() {
		$output = $this->classes;
		$output[] = 'objclass';
		$output[] = 'obj-letter';
		if( $this->getDataset() )
			$output[] = $this->getDataset();
		return $output;
	}

    public function getDataset()
    {
        return @$this->dataset;
    }

	public function getLayers()
	{
		return $this->layers;
	}

    public function getScore()
    {
        if ($score = $this->getLayer('score'))
            return (float)@$score['value'];
        return 0;
    }

    public function getLayer($layer)
    {
        return array_key_exists($layer, $this->layers) ? $this->layers[$layer] : false;
    }

    public function getPage($field = '*') {
        return $field == '*' ? $this->page : @$this->page[$field];
    }

    public function getStatic($field = '*')
    {
	    if( isset($this->static) && !empty($this->static) )
	        return $field == '*' ? $this->static : @$this->static[$field];
	    else
	    	return false;
    }

    public function getGlobalId()
    {
        return $this->getData('alphaid');
    }

    public function getDate()
    {
        return @substr($this->getData($this->routes['date']), 0, 10);
    }

    public function getData($field = '*')
    {
        return $field == '*' ? $this->data : @$this->data[$field];
    }

    public function getTime()
    {
        return @$this->getData($this->routes['time']);
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function getTitle()
    {
        return $this->getData($this->routes['title']);
    }

    public function getShortTitle()
    {
        return $this->getData($this->routes['shortTitle']);
    }

    public function getDescription()
    {
        return $this->getData($this->routes['description']);
    }

    public function getPosition()
    {
	    return $this->getData($this->routes['position']);
    }

    public function getTitleAddon()
    {
        return $this->getData($this->routes['titleAddon']);
    }

    public function getSideLabel()
    {
        return false;
    }

    public function getShortLabel()
    {
        return $this->getData($this->routes['label']);
    }

    public function getFullLabel()
    {
        return $this->getLabel();
    }

    public function getLabel()
    {
        return $this->getData($this->routes['label']);
    }

    public function getHlText()
    {
        return str_replace("\r", "<br/>", $this->hl);
    }

    public function getUrl($options = array())
    {
		
        return '/moje-pisma/' . $this->getData('alphaid') . ',' . $this->getData('slug');

    }

    public function getId()
    {
        return $this->getData('alphaid');
    }

    public function getSentence() {

	    return @$this->contexts[0]['sentence'];

    }

    public function getAction() {

	    return @$this->contexts[0]['action'];

    }

    public function getCreator($field = '*') {

	    $creator = @$this->contexts[0]['creator'];

	    if( $field=='*' )
	    	return $creator;
	    else
	    	return @$creator[ $field ];

    }

    public function getThumbnailUrl($size = 'default')
    {
        return 'http://pisma.sds.tiktalik.com/thumbs/' . $this->getData('hash') . '.png';
    }

	public function getIcon()
    {
	    $class = strtolower(array_pop(explode('\\', get_class($this))));
        return '<span class="object-icon icon-datasets-' . $class . '"></span>';
    }

    public function getHeaderThumbnailUrl($size = 'default')
    {
        return false;
    }

    public function hasHighlights()
    {
        return true;
    }

    public function forceHighlightsFields()
    {
	    return false;
    }

    public function getHighlightsFields()
    {
	    return array();
    }

    public function getTinyLabel() {
	    return $this->tiny_label;
    }

	public function getHiglightedFields( $fields = false, $fieldsPush = false )
	{
		$output = array();

		if( is_array($fieldsPush) )
			$fieldsPush = $fieldsPush[0];

		$fields = ($fields===false) ? $this->hl_fields : $fields;
		if(
			$fieldsPush &&
			!in_array($fieldsPush, $fields) &&
			( $schema = $this->getSchemaForFieldname( $fieldsPush ) ) &&
			!( isset($schema[3]) && isset($schema[3]['noHl']) && $schema[3]['noHl'] )
		)
			array_unshift($fields, $fieldsPush);


		if( !empty($fields) )
			foreach( $fields as $fieldname )
				if( $schema = $this->getSchemaForFieldname( $fieldname ) )
					$output[ $fieldname ] = array(
						'label' => $schema[1],
						'type' => isset($schema[2]) ? $schema[2] : 'string',
						'value' => $this->getData($fieldname),
						'options' => isset($schema[3]) ? $schema[3] : 'string',
					);

        return $output;
    }

    public function getSchemaForFieldname($fieldname)
    {
        $output = false;

        if ($fieldname && !empty($this->schema)) {
            foreach ($this->schema as $s) {
                if ($s[0] == $fieldname) {
                    $output = $s;
                    break;
                }
            }
        }

		return $output;
	}

	public function addRoutes( $routes = array() )
	{
		$this->routes = array_merge($this->routes, $routes);
	}

	public function setOptions($options)
	{
		$this->options = array_merge($this->options, $options);
		return $this->options;
	}

    public function __call($func, $arg)
    {

	    // debug('__call'); debug($func);

        $func = str_replace('get', '', $func);
        $func = lcfirst($func);
        if (!empty($arg)) {
            $arg = array_pop($arg);
            return (isset($this->{$func}[$arg])) ? $this->{$func}[$arg] : false;
        }
        return $this->$func;
    }

    public function getBreadcrumbs()
    {
	    return array();
    }

    public function getDefaultColumnsSizes() {
	    return array(2, 10);
    }

}
