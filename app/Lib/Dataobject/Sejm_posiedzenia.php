<?

namespace MP\Lib;

class Sejm_posiedzenia extends DataObject
{
	
	protected $tiny_label = 'Sejm';
	
    protected $routes = array(
        'shortTitle' => 'numer',
        'date' => 'data_start',
        'label' => 'label',
        'description' => false,
    );
	
	protected $schema = array(
		array('data_start', ''),
	);

	
    public function getLabel()
    {
        return 'Posiedzenie Sejmu';
    }

    public function getTitle()
    {
	    	    
    	if( $this->getData('numer') )
	        return 'Posiedzenie Sejmu nr ' . $this->getData('numer');
	    else
	    	return str_replace('Posiedzenie Sejmu nr ', '', $this->getData('tytul'));
    }
    
    public function getShortTitle()
    {
        return $this->getTitle();
    }
    
    public function hasHighlights()
    {
        return false;
    }
    
    public function getTitleAddon()
    {
	    	    
	    $parts = array(
		    dataSlownie( $this->getData('data_start') ),
	    );
	    
	    if(
		    $this->getData('data_stop') && 
		    ( $this->getData('data_stop') != $this->getData('data_start') )
	    )
	    	$parts[] = dataSlownie( $this->getData('data_stop') );
	    
	    return implode(' - ', $parts);
    }
	
	public function getUrl()
	{
		return '/dane/instytucje/3214,sejm/posiedzenia/' . $this->getId();
	}
	
}