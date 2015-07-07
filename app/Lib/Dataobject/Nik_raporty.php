<?

namespace MP\Lib;
require_once('DocDataObject.php');

class Nik_raporty extends DocDataObject
{
	
	protected $tiny_label = 'Raport NIK';
	
	protected $schema = array(
		array('data_publikacji', 'Data publikacji', 'date'),
		array('data_moderacji', 'Data moderacji', 'date'),
	);
	
    protected $routes = array(
        'title' => 'tytul',
        'shortTitle' => 'tytul',
        'date' => 'data_publikacji',
    );
	
	protected $hl_fields = array(
    	'data_publikacji', 'data_moderacji',
    );

    public function getLabel()
    {
        return 'Raport Najwyższej Izby Kontroli';
    }
    
    public function getThumbnailUrl($size = '2')
    {
        $dokument_id = $this->getData('dokument_id');
        return $dokument_id ? 'http://docs.sejmometr.pl/thumb/' . $size . '/' . $dokument_id . '.png' : false;
    }
    
    public function getMetaDescriptionParts($preset = false)
	{
			
		$output = array();
				
		if( $this->getDate() )
			$output[] = dataSlownie($this->getDate());
		
		return $output;
		
	}

}