<?

namespace MP\Lib;
require_once('DocDataObject.php');

class Kolekcje extends DocDataObject
{

	protected $tiny_label = 'Kolekcje';

    protected $routes = array(
        'title' => 'nazwa',
        'shortTitle' => 'nazwa',
    );

    public function getLabel()
    {
        return 'Kolekcja';
    }

	public function getUrl()
	{
		return '/moje-kolekcje/' . $this->getId();
	}

	public function getThumbnailUrl($size = '2')
    {
	    if( $this->getData('photo') )
	        return 'http://sds.tiktalik.com/portal/' . $size . '/pages/dzialania/' . $this->getId() . '.jpg';
	    else
	    	return false;
    }

    public function getDescription()
    {
	    return $this->getData('podsumowanie');
    }

    public function getMetaDescriptionParts($preset = false)
	{

		$output = array();

		if( $this->getData('data_utworzenia') )
			$output[] = dataSlownie($this->getData('data_utworzenia'));

		return $output;

	}

	public function getDefaultColumnsSizes() {
	    return array(4, 8);
    }

}