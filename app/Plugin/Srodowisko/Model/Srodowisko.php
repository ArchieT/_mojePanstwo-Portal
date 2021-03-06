<?

class Srodowisko extends AppModel
{

    public $useDbConfig = 'mpAPI';
		
    public function getData($param, $rank = 'latest')
    {
        $data = $this->getDataSource()->request('srodowisko/data?param=' . $param. '&rank=' . $rank);
        return $data;
    }

    public function getChartData($data)
    {
        return $this->getDataSource()->request('srodowisko/srodowisko/getData', array(
            'data' => $data,
            'method' => 'POST'
        ));
    }

    public function getRankingData($data)
    {
        return $this->getDataSource()->request('srodowisko/srodowisko/getRankingData', array(
            'data' => $data,
            'method' => 'POST'
        ));
    }

}
