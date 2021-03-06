<?php

App::uses('ApplicationsController', 'Controller');

class KrsController extends ApplicationsController
{
	
	public $init_data = array(
		array('krs_podmioty', '388899'),
		array('krs_podmioty', '10186'),
		array('krs_podmioty', '100679'),
	);
	
    public $settings = array(
        'id' => 'krs',
        'title' => 'Krajowy Rejestr Sądowy',
        'shortTitle' => 'KRS',
        'subtitle' => 'Dane gospodarcze o firmach i osobach',
        'headerImg' => 'krs',
    );

    public $mainMenuLabel = 'Przeglądaj';
    
    public $forms = array(
	    14 => array(
		    'title' => 'Spółki z ograniczoną odpowiedzialnością (sp. z o.o.)',
		    'desc' => '<p class="p">Przedsiębiorstwa utworzone przez jedną lub więcej osób, zwanych wspólnikami. Wspólnicy nie odpowiadają za zobowiązania spółki wobec wierzycieli. Odpowiada za nie sama spółka swoim majątkiem utworzonym z wkładów wspólników.</p>',
		    'latest' => 'Ostatnio zarejestrowane spółki z o.o.',
	    ),
	    15 => array(
		    'title' => 'Stowarzyszenia',
		    'desc' => '<p class="p">Organizacje społeczne powoływane przez grupę osób mających wspólne cele lub zainteresowania. Stowarzyszenia są dobrowolne i działają w celach niezarobkowych. Samodzielnie określają swoje cele, programy działania i struktury organizacyjne. Ich działalność opiera się na pracy społecznej swoich członków.</p>',
		    'latest' => 'Ostatnio zarejestrowane stowarzyszenia',
	    ),
	    11 => array(
		    'title' => 'Spółki jawne',
		    'desc' => '<p class="p">Przedsiębiorstwa pod własną firmą, nie posiadające osobowości prawnej. Odpowiedzialność za zobowiązania spółki ponoszą wszyscy wspólnicy, bez ograniczeń, całym swoim majątkiem, zarówno obecnym, jak i przyszłym.</p>',
		    'latest' => 'Ostatnio zarejestrowane spółki jawne',
	    ),
	    12 => array(
		    'title' => 'Spółki komandytowe',
		    'desc' => '<p class="p">Spółki osobowe mające na celu prowadzenie przedsiębiorstwa pod własną firmą, w której za zobowiązania spółki wobec wierzycieli odpowiada w sposób nieograniczony co najmniej jeden wspólnik (komplementariusz), a odpowiedzialność co najmniej jednego wspólnika jest ograniczona (komandytariusz).</p>',
		    'latest' => 'Ostatnio zarejestrowane spółki komandytowe',
	    ),
	    1 => array(
		    'title' => 'Fundacje',
		    'desc' => '<p class="p">Organizacje pozarządowe, dysponujące kapitałem przeznaczonym na określony cel oraz statutem zawierającym reguły dysponowania tym kapitałem. W odróżnieniu od stowarzyszeń, fundacje nie mają członków. O celu, majątku, zasadach działania decydują ich twórcy (fundatorzy).</p>',
		    'latest' => 'Ostatnio zarejestrowane fundacje',
	    ),
	    9 => array(
		    'title' => 'Spółdzielnie',
		    'desc' => '<p class="p">Dobrowolne zrzeszenia nieograniczonej liczby członków, w celu prowadzenia przediębiorstwa na zasadach prawa spółdzielczego. Każda osoba po spełnieniu odpowiednich przesłanek ujętych w statucie bądź przepisie prawa, może przystąpić do spółdzielni. Członkowie spółdzielni nie odpowiadają za jej zobowiązania.</p>',
		    'latest' => 'Ostatnio zarejestrowane spółdzielnie',
	    ),
	    10 => array(
		    'title' => 'Spółki akcyjne',
		    'desc' => '<p class="p">Spółki kapitałowe, których forma opiera się na obiegu akcji będących w posiadaniu akcjonariuszy. Kapitał zakładowy składa się z wkładów założycieli, którzy stają się współwłaścicielami spółki. Akcjonariusze nie odpowiadają za zobowiązania spółki, ryzyko ponoszą jedynie do wysokości wniesionego kapitału oraz czerpią zyski (np. w postaci dywidendy).</p>.',
		    'latest' => 'Ostatnio zarejestrowane spółki akcyjne',
	    ),
	    18 => array(
		    'title' => 'Związki zawodowe',
		    'desc' => '<p class="p">Masowe organizacje społeczne zrzeszające na zasadzie dobrowolności ludzi pracy najemnej. Ich celem jest obrona interesów społeczno-ekonomicznych. Tworzone mogą być według kryteriów gałęzi produkcji, zawodu lub regionu, w którym operują. Związki mogą też rozwijać działalność samopomocową, edukacyjną czy kulturalną.</p>',
		    'latest' => 'Ostatnio zarejestrowane związki zawodowe',
	    ),
    );
    
    public function getChapters() {

		$mode = false;
		$items = array(
			array(
				'id' => 'organizacje',
				'href' => '/krs/organizacje',
				'label' => 'Organizacje',
				'icon' => 'icon-datasets-krs_podmioty',
			),
			array(
				'id' => 'osoby',
				'href' => '/krs/osoby',
				'label' => 'Osoby',
				'icon' => 'icon-datasets-krs_osoby',
			),
			array(
				'id' => 'msig',
				'href' => '/krs/msig',
				'label' => 'Monitor Sądowy i Gospodarczy',
				'icon' => 'icon-datasets-msig',
			),
		);

        $output = array(
			'items' => $items,
			'selected' => ($this->chapter_selected=='view') ? false : $this->chapter_selected,
		);

		return $output;

	}
	
    public function prepareMetaTags()
    {
        parent::prepareMetaTags();
        $this->setMeta('og:image', FULL_BASE_URL . '/krs/img/social/krs.jpg');
    }

    public function view()
    {
		
		$r = rand(0, count($this->init_data)-1);
		$init_data = $this->init_data[ $r ];
		$this->set('init_data', $init_data);
				
		$this->loadModel('Dane.Dataobject');
		$object = $this->Dataobject->find('first', array(
			'conditions' => array(
				'dataset' => $init_data[0],
				'id' => $init_data[1],
			),
		));
		$this->set('init_object', $object);

        $datasets = $this->getDatasets('krs');

        $options = array(
            'searchTag' => array(
	            'href' => '/krs',
	            'label' => 'KRS',
            ),
            'autocompletion' => array(
                'dataset' => 'krs_podmioty,krs_osoby',
            ),
            'conditions' => array(
                'dataset' => array_keys($datasets)
            ),
            'cover' => array(
                'cache' => true,
                'view' => array(
                    'plugin' => 'Krs',
                    'element' => 'cover',
                ),
                'aggs' => array(
                    'krs_podmioty' => array(
                        'filter' => array(
                            'term' => array(
                                'dataset' => 'krs_podmioty',
                            ),
                        ),
                        'aggs' => array(
                            'dzialalnosci' => array(
	                            'nested' => array(
		                            'path' => 'krs_podmioty-dzialalnosci',
	                            ),
	                            'aggs' => array(
		                            'sekcja' => array(
			                            'terms' => array(
				                            'field' => 'krs_podmioty-dzialalnosci.pkd2007.sekcja.symbol',
				                            'size' => 20,
			                            ),
			                            'aggs' => array(
				                            'nazwa' => array(
					                            'terms' => array(
						                            'field' => 'krs_podmioty-dzialalnosci.pkd2007.sekcja.nazwa',
						                            'size' => 1,
					                            ),
				                            ),
			                            ),
		                            ),
	                            ),
                            ),
                            /*
                            'formy' => array(
                                'terms' => array(
                                    'field' => 'data.krs_podmioty.forma_prawna_id',
                                    'exclude' => array(
                                        'pattern' => '0'
                                    ),
                                    'size' => 8,
                                ),
                                'aggs' => array(
                                    'organizacje' => array(
			                            'top_hits' => array(
				                            'size' => 3,
				                            'fielddata_fields' => array('dataset', 'id'),
			                            ),
		                            ),
                                ),
                            ),
                            'kapitalizacja' => array(
                                'range' => array(
                                    'field' => 'data.krs_podmioty.wartosc_kapital_zakladowy',
                                    'ranges' => array(
                                        array('from' => 1, 'to' => 5000),
                                        array('from' => 5000, 'to' => 10000),
                                        array('from' => 10000, 'to' => 50000),
                                        array('from' => 50000, 'to' => 100000),
                                        array('from' => 100000, 'to' => 500000),
                                        array('from' => 500000, 'to' => 1000000),
                                        array('from' => 1000000, 'to' => 5000000),
                                        array('from' => 5000000, 'to' => 10000000),
                                        array('from' => 10000000),
                                    ),
                                ),
                            ),
                            'date' => array(
                                'date_histogram' => array(
                                    'field' => 'date',
                                    'interval' => 'year',
                                    'format' => 'yyyy-MM-dd',
                                ),
                            ),
                            */
                        ),
                    ),
                    'dataset' => array(
	                    'terms' => array(
	                        'field' => 'dataset',
	                    ),
	                    'visual' => array(
	                        'skin' => 'datasets',
	                        'class' => 'special',
	                        'field' => 'dataset',
	                        'dictionary' => $datasets,
	                    ),
	                ),
                ),
            ),
            'perDatasets' => true,
            'appObserve' => 1,
            'browserTitle' => 'Wyniki wyszukiwania w Krajowym Rejestrze Sądowym:',
        );
		
		$this->set('forms', $this->forms);
        $this->Components->load('Dane.DataBrowser', $options);
        $this->title = 'Krajowy Rejestr Sądowy';
        $this->render('Dane.Elements/DataBrowser/browser-from-app');

    }
    
    public function pkd()
    {
	    
	    if( @$this->request->params['id'] ) {
	    	
	    	$this->loadModel('Krs.Krs');
	    	$sekcja = $this->Krs->getPKDSection( $this->request->params['id'] );
	    	
		    $this->title = $sekcja['nazwa'] . ' | KRS';
	        $this->loadDatasetBrowser('krs_podmioty', array(
	            'browserTitle' => 'Organizacje w sekcji "' . $sekcja['nazwa'] . '"',
	            'conditions' => array(
	                'dataset' => 'krs_podmioty',
	                '>krs_podmioty-dzialalnosci' => array(
		                'przewazajaca' => true,
		                'pkd2007.sekcja.symbol' => $this->request->params['id']
	                )
	            ),
	        ));
        
        }
    }

} 