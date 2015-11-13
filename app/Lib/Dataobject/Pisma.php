<?

namespace MP\Lib;
require_once('DocDataObject.php');

class Pisma extends DataObject
{

    protected $routes = array(
        'title' => 'name',
        'shortTitle' => 'name',
    );

    public function getLabel()
    {
        return 'Kolekcja';
    }

	public function getUrl()
	{
		if( $this->getOptions('public') )
			return $this->getOptions('base_url') . '/kolekcje/' . $this->getId();
		else
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

		if( $this->getData('items_count') )
			$output[] = pl_dopelniacz($this->getData('items_count'), 'dokument', 'dokumenty', 'dokument�w');
		else
			$output[] = 'Kolekcja jest pusta';

		return $output;

	}

	public function getDefaultColumnsSizes() {
	    return array(4, 8);
    }

}
