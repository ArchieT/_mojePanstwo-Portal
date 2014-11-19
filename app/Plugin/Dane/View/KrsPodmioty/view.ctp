<?
if (isset($odpis) && $odpis) {
    $this->Html->meta(array(
        'http-equiv' => "refresh",
        'content' => "0;URL='$odpis'"
    ), null, array('inline' => false));
}

echo $this->Element('dataobject/pageBegin');

echo $this->Html->script('Dane.d3/d3', array('block' => 'scriptBlock'));

$this->Combinator->add_libs('css', $this->Less->css('view-krspodmioty', array('plugin' => 'Dane')));
$this->Combinator->add_libs('css', $this->Less->css('dataobjectslider', array('plugin' => 'Dane')));
$this->Combinator->add_libs('js', 'Dane.view-krspodmioty');
$this->Combinator->add_libs('js', 'graph-krs');

?>
<? if ($dzialy = $object->getLayer('pkd_dzialy')) { ?>
    <ul class="chart-blocks">
        <? foreach ($dzialy as $dzial) { ?>

            <li style="background-color: #<?= $dzial['color'] ?>; width: <?= $dzial['score'] * 100 ?>%"><a href="#"
                                                                                                           title="<?= addslashes($dzial['nazwa']) ?>"><?= $dzial['nazwa'] ?></a>
            </li>

        <? } ?>
    </ul>
<? } ?>

    <div class="krsPodmioty row">
    <div class="col-lg-3 objectSide">
        <div class="objectSideInner">
            <ul class="dataHighlights side">


                <? if ($object->getData('wykreslony')) { ?>
                    <li class="dataHighlight">
                        <span class="label label-danger">Podmiot wykreślony z KRS</span>
                    </li>
                <? } ?>

                <? if ($object->getData('krs')) { ?>
                    <li class="dataHighlight big">
                        <p class="_label">Numer KRS</p>

                        <p class="_value"><?= $object->getData('krs'); ?></p>
                    </li>
                <? } ?>

                <? if ($object->getData('nip')) { ?>
                    <li class="dataHighlight big">
                        <p class="_label">Numer NIP</p>

                        <p itemprop="taxID" class="_value"><?= $object->getData('nip'); ?></p>
                    </li>
                <? } ?>

                <? if ($object->getData('regon')) { ?>
                    <li class="dataHighlight big">
                        <p class="_label">Numer REGON</p>

                        <p class="_value"><?= $object->getData('regon'); ?></p>
                    </li>
                <? } ?>


                <? if ($object->getData('wartosc_kapital_zakladowy')) { ?>
                    <li class="dataHighlight topborder">
                        <p class="_label">Kapitał zakładowy</p>

                        <p class="_value"><?= number_format_h($object->getData('wartosc_kapital_zakladowy')); ?> PLN</p>
                    </li>
                <? } ?>

                <? if ($object->getData('wartosc_czesc_kapitalu_wplaconego')) { ?>
                    <li class="dataHighlight">
                        <p class="_label">Część kapitału wpłaconego</p>

                        <p class="_value"><?= number_format_h($object->getData('wartosc_czesc_kapitalu_wplaconego')); ?> PLN</p>
                    </li>
                <? } ?>

                <? if ($object->getData('wartosc_kapital_docelowy')) { ?>
                    <li class="dataHighlight">
                        <p class="_label">Kapitał docelowy</p>

                        <p class="_value"><?= number_format_h($object->getData('wartosc_kapital_docelowy')); ?> PLN</p>
                    </li>
                <? } ?>

                <? if ($object->getData('wartosc_nominalna_podwyzszenia_kapitalu')) { ?>
                    <li class="dataHighlight">
                        <p class="_label">Wartość nominalna podwyższenia kapitału</p>

                        <p class="_value"><?= number_format_h($object->getData('wartosc_nominalna_podwyzszenia_kapitalu')); ?> PLN</p>
                    </li>
                <? } ?>


                <? if ($object->getData('data_rejestracji')) { ?>
                    <li class="dataHighlight inl topborder">
                        <p class="_label">Data rejestracji</p>

                        <p class="_value" ><?= $this->Czas->dataSlownie($object->getData('data_rejestracji'), array(
	                        	'itemprop' => 'foundingDate',
	                        )); ?></p>
                    </li>
                <? } ?>

                <? /* if ($object->getData('data_dokonania_wpisu')) { ?>
                    <li class="dataHighlight inl">
                        <p class="_label">Data ostatniego wpisu</p>

                        <p class="_value"><?= $this->Czas->dataSlownie($object->getData('data_dokonania_wpisu')); ?></p>
                    </li>
                <? } */ ?>


                <?
                if ($www = $object->getData('www')) {
                    $url = (stripos($www, 'http') === false) ? 'http://' . $www : $www;
                    ?>
                    <li class="dataHighlight inl topborder">
                        <p class="_label">Strona WWW</p>

                        <p class="_value"><a target="_blank" title="<?= addslashes($object->getTitle()) ?>"
                                             href="<?= $url ?>"><?= $www; ?></a></p>
                    </li>
                <? } ?>

                <? if ($email = $object->getData('email')) { ?>
                    <li class="dataHighlight inl">
                        <p class="_label">Adres e-mail</p>

                        <p itemprop="email" class="_value"><a target="_blank" href="mailto:<?= $email ?>"><?= $email; ?></a></p>
                    </li>
                <? } ?>
            </ul>

            <ul class="dataHighlights side hide">
                <? if ($object->getData('forma_prawna_str')) { ?>
                    <li class="dataHighlight inl topborder">
                        <p class="_label">Forma prawna</p>

                        <p class="_value"><?= $object->getData('forma_prawna_str'); ?></p>
                    </li>
                <? } ?>

                <? if ($object->getData('oznaczenie_sadu')) { ?>
                    <li class="dataHighlight">
                        <p class="_label">Oznaczenie sądu</p>

                        <p class="_value"><?= $object->getData('oznaczenie_sadu'); ?></p>
                    </li>
                <? } ?>

                <? if ($object->getData('sygnatura_akt')) { ?>
                    <li class="dataHighlight">
                        <p class="_label">Sygnatura akt</p>

                        <p class="_value"><?= $object->getData('sygnatura_akt'); ?></p>
                    </li>
                <? } ?>

                <? if ($object->getData('wczesniejsza_rejestracja_str')) { ?>
                    <li class="dataHighlight inl">
                        <p class="_label">Wcześniejsza rejestracja</p>

                        <p class="_value"><?= $object->getData('wczesniejsza_rejestracja_str'); ?></p>
                    </li>
                <? } ?>

            </ul>

            <p class="text-center showHideSide">
                <a class="a-more">Więcej &darr;</a>
                <a class="a-less hide">Mniej &uarr;</a>
            </p>


            <? if (!$object->getData('wykreslony')) { ?>
                <div class="banner">
                    <?php echo $this->Html->image('Dane.banners/krspodmioty_banner.png', array(
                        'width' => '69',
                        'alt' => 'Aktualny odpis z KRS za darmo',
                        'class' => 'pull-right'
                    )); ?>
                    <p>Pobierz aktualny odpis z KRS <strong>za darmo</strong></p>
                    <a href="/dane/krs_podmioty/<?= $object->getId() ?>/odpis" class="btn btn-primary">Kliknij aby
                        pobrać</a>
                </div>
            <? } ?>
        </div>
    </div>


    <div class="col-lg-9 objectMain">
    <div class="object">


    <? if ($object->getData('wykreslony')) { ?>
        <div class="alert alert-dismissable alert-danger">
            <button type="button" class="close" data-dismiss="alert">×</button>
            Prezentowane dane dotyczą chwili, w której podmiot był wykreślany z KRS.
        </div>
    <? } ?>

    <?
    $adres = $object->getData('adres_ulica');
    $adres .= ' ' . $object->getData('adres_numer');
    $adres .= ', ' . $object->getData('adres_miejscowosc');
    $adres .= ', Polska';
    ?>

    <?php if(
	    	($object->getData('adres_ulica')) && 
	    	($object->getData('adres_numer')) && 
	    	($object->getData('adres_miejscowosc'))
	    ) { ?>
        <div class="block">
            <div class="block-header">
                <h2 class="label">Adres</h2>

                <div class="mapsOptions pull-right">
                    <button
                        class="googleMap btn btn-sm btn-default"><?= __d('dane', 'LC_DANE_VIEW_KRSPODMIOTY_OTWORZ_MAPE') ?></button>
                    <button
                        class="streetView btn btn-sm btn-default"><?= __d('dane', 'LC_DANE_VIEW_KRSPODMIOTY_OTWORZ_MAPE_STREET') ?></button>
                </div>
            </div>

            <div class="profile_baner" data-adres="<?= urlencode($adres) ?>">
                <div class="bg">
                    <img
                        src="http://maps.googleapis.com/maps/api/staticmap?center=<?= urlencode($adres) ?>&markers=<?= urlencode($adres) ?>&zoom=15&sensor=false&size=640x155&scale=2&feature:road"/>

                    <div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress" class="content">
                        <p itemprop="streetAddress">
                            ul. <?= $object->getData('adres_ulica') ?> <?= $object->getData('adres_numer') ?><? if ($object->getData('adres_lokal')) { ?>/<?= $object->getData('adres_lokal') ?><? } ?></p>
                        <? if ($object->getData('adres_poczta') != $object->getData('adres_miejscowosc')) { ?>
                            <p><?= $object->getData('adres_miejscowosc') ?></p><? } ?>
                        <p><span itemprop="postalCode"><?= $object->getData('adres_kod_pocztowy') ?></span> <span itemprop="addressLocality"><?= $object->getData('adres_poczta') ?></span></p>

                        <p><?= $object->getData('adres_kraj') ?></p>
                    </div>
                </div>
                <div class="googleView">
                    <script>
                        var googleMapAdres = '<?= $adres ?>';
                    </script>
                    <div id="googleMap"></div>
                    <div id="streetView"></div>
                </div>
            </div>
        </div>
    <?php } ?>

    <?php if ($object->getId() == '481129') { ?>
        <div class="special banner">
            <a title="Zobacz umowy podpisywane przez Komitet Konkursowy Kraków 2022"
               href="/dane/krs_podmioty/481129/umowy">
                <img src="/Dane/img/krakow_special_banner.png" width="885" height="85"/>
            </a>
        </div>
    <?php } ?>

    <div class="block-group">

        <? if ($object->getData('cel_dzialania')) { ?>
            <div class="dzialanie block">

                <div class="block-header"><h2 class="label">Cel działania</h2></div>

                <div class="content normalizeText textBlock">
                    <?= $object->getData('cel_dzialania') ?>
                </div>
            </div>
        <? } ?>

        <? if ($object->getData('sposob_reprezentacji')) { ?>
            <div class="reprezentacja block">
                <div class="block-header"><h2 class="label">Sposób reprezentacji</h2></div>

                <div class="content normalizeText textBlock">
                    <?= $object->getData('sposob_reprezentacji') ?>
                </div>
            </div>
        <? } ?>

        <div class="organy block">
            <div>
                <?

                $organy_count = count($organy);
                if ($organy_count) {

                if ($organy_count == 1) {
                    $column_width = 12;
                } elseif ($organy_count == 2) {
                    $column_width = 6;
                } elseif ($organy_count == 3) {
                    $column_width = 4;
                } else {
                    $column_width = 6;
                }

                ?>
                <? foreach ($organy as $organ) { ?>
                <div class="col-lg-<?= $column_width ?> nopadding">
                    <div class="small nobottomborder">
                        <div class="block-header"><h2 class="label" id="<?= $organ['idTag'] ?>"
                                                      class="normalizeText"><?= $organ['title'] ?></h2></div>
                        <? /* if (isset($organ['label']) && $organ['label']) { ?>
                                    <p class="label label-primary"><?= $organ['label'] ?></p>
                                <? } */
                        ?>

                        <? if ($organ['content']) { ?>
                        <div class="list-group less-borders">
                            <? foreach ($organ['content'] as $osoba) { ?>

                            <? if (@$osoba['osoba_id']) { ?>
                            <a class="list-group-item" href="/dane/krs_osoby/<?= $osoba['osoba_id'] ?>" itemprop="member" itemscope itemtype="http://schema.org/Person">
                                <? } elseif (@$osoba['krs_id']) { ?>
                                <a class="list-group-item" href="/dane/krs_podmioty/<?= $osoba['krs_id'] ?>" itemprop="member" itemscope itemtype="http://schema.org/Organization">
                                    <? } else { ?>
                                    <div class="list-group-item">
                                        <? } ?>

                                        <h4 class="list-group-item-heading">
                                            <span itemprop="name"><?= $osoba['nazwa'] ?></span>
                                            <? if (
                                                ($osoba['privacy_level'] != '1') &&
                                                $osoba['data_urodzenia'] &&
                                                $osoba['data_urodzenia'] != '0000-00-00'
                                            ) {
                                                ?>
                                                <span class="wiek">
                                                    <?= substr($osoba['data_urodzenia'], 0, 4) ?>'
                                                </span>
                                            <? } ?>
                                        </h4>

                                        <?
                                        if (isset($osoba['funkcja']) && $osoba['funkcja']) {

                                            if ($organ['idTag'] == 'reprezentacja') {

                                                $useLabel = true;
                                                $class = 'warning';
                                                foreach (array('prezes', 'prezydent', 'przewodnicząc') as $phr) {
                                                    if (stripos($osoba['funkcja'], ltrim($phr)) === 0) {
                                                        $class = 'danger';
                                                        break;
                                                    }
                                                }

                                            } else {

                                                $useLabel = false;

                                            }

                                            ?>
                                            <p class="list-group-item-text <? if ($useLabel) { ?> label label-<?= $class ?><? } ?>">
                                                <?= $osoba['funkcja'] ?>
                                            </p>
                                        <? } ?>

                                        <? if (@$osoba['osoba_id'] || @$osoba['krs_id']) { ?>
                                </a>
                                <? } else { ?>

                        </div>
                    <? } ?>
                    <? } ?>
                    </div>
                    <? } ?>
                </div>
            </div>
            <? } ?>
            <? } ?>
        </div>

    </div>


    <? if ($wspolnicy = $object->getLayer('wspolnicy')) { ?>

    <div class="wspolnicy block">
        <div class="block-header"><h2 class="label">Udziały w tej firmie posiadają:</h2></div>

        <div id="wspolnicy_graph">
            <div class="list-group less-borders wspolnicy">
                <? foreach ($wspolnicy as $osoba) { ?>

                <? if (@$osoba['osoba_id']) { ?>
                <a class="list-group-item row" href="/dane/krs_osoby/<?= $osoba['osoba_id'] ?>">
                    <? } elseif (@$osoba['krs_id']) { ?>
                    <a class="list-group-item row" href="/dane/krs_podmioty/<?= $osoba['krs_id'] ?>">
                        <? } else { ?>
                        <div class="list-group-item row">
                            <? } ?>

                            <h4 class="list-group-item-heading col-xs-6">
                                <?= $osoba['nazwa'] ?>
                                <? if (
                                    ($osoba['privacy_level'] != '1') &&
                                    $osoba['data_urodzenia'] &&
                                    $osoba['data_urodzenia'] != '0000-00-00'
                                ) {
                                    ?>
                                    <span class="wiek">
                                        <?= pl_dopelniacz(pl_wiek($osoba['data_urodzenia']), 'rok', 'lata', 'lat') ?>
                                    </span>
                                <? } ?>
                            </h4>

                            <? if (isset($osoba['funkcja']) && $osoba['funkcja']) { ?>
                                <p class="list-group-item-text normalizeText col-xs-6">
                                    <?= $osoba['funkcja'] ?>
                                </p>
                            <? } ?>

                            <? if (@$osoba['osoba_id'] || @$osoba['krs_id']) { ?>
                    </a>
                    <? } else { ?>

            </div>
            <? } ?>
            <? } ?>
        </div>
    </div>
    </div>

    <? } ?>
	    
	<? if ($firmy = $object->getLayer('firmy')) { ?>

    <div class="wspolnicy block">
        <div class="block-header"><h2 class="label">Ta firma posiada udziały w:</h2></div>

        <div id="wspolnicy_graph">
            <div class="list-group less-borders wspolnicy">
                <? foreach ($firmy as $firma) { ?>
					
					<a class="list-group-item row" href="/dane/krs_podmioty/<?= $firma['id'] ?>">
						<div class="list-group-item row">

                            <h4 class="list-group-item-heading col-xs-6">
                                <?= $firma['nazwa'] ?>
                            </h4>

                            <? if (isset($firma['udzialy_str']) && $firma['udzialy_str']) { ?>
                                <p class="list-group-item-text normalizeText col-xs-6">
                                    <?= $firma['udzialy_str'] ?>
                                </p>
                            <? } ?>
						</div>
					</a>
					
              <? } ?>
	        </div>
	    </div>
    </div>

    <? } ?>
		
		
	<?
	if ($historia) { 
	
		$lastDate = false;
		$lastLocation = false;
		$lastSublocation = false;
		
	?>
	<div class="object">
	    <div id="historia" class="block historia">
	       
	       <div class="block-header">
	       		<h2 class="label">Ostatnie wpisy do KRS <span class="subtitle"><?= $this->Czas->dataSlownie($object->getData('data_ostatni_wpis')) ?></span></h2>
	       </div>
		   
		   
	        <div class="content">
	            
	            <ul>
	                <? 
	                foreach( $historia as $h ) {
			               
			            	$location = $h->getData('nr_dz') . '-' . $h->getData('nr_rub');
			                $sublocation = $h->getData('nr_dz') . '-' . $h->getData('nr_rub') . '-' . $h->getData('nr_sub');
			               			               
		            ?>
	                <li>
	                	
	                	<div class="row">
		                	<div class="col-md-12">
			                			
			                	<? if( $location!==$lastLocation ) { $lastSublocation = false; ?>                	
			                	<div class="location">
				                	<span class="title"><?= $h->getData('opis') ?></span> 
				                	<span class="desc pull-right">Dział <?= $h->getData('nr_dz') ?>, Rubryka <?= $h->getData('nr_rub') ?></span>
				                </div>
				                <? } ?>
			                	
			                	<? if( $h->getData('opis_sub') && ($sublocation!==$lastSublocation) ) { ?>
			                	<div class="sublocation col-md-offset-1">
				                	<span><?= preg_replace('/([0-9]{11})/', '---', $h->getData('opis_sub')) ?></span> 
				                	<? if( $h->getData('nr_sub') ) { ?><span class="desc pull-right">Pozycja <?= $h->getData('nr_sub') ?></span><? } ?>
			                	</div>
			                	<? } ?>
				                
				                <div class="row col-md-offset-2">
					                
					                <div class="col-xs-2">
						                
						                <? if( $h->getData('mode') == 'ADD' ) { ?>
						                	<p class="status label label-success">Dodać</p>
						                <? } elseif( $h->getData('mode') == 'REMOVE' ) { ?>
						                	<p class="status label label-danger">Usunąć</p>
						                <? } elseif( $h->getData('mode') == 'CHANGE' ) { ?>
						                	<p class="status label label-warning">Zmienić</p>
						                <? } ?>
						                
					                </div><div class="col-xs-10">
						                <div class="content_">
						                	<? if( $h->getData('label') ) echo '<span class="_label">' . $h->getData('label') . ':</span> '; ?> 
						                	<? if( $h->getData('label') ) {?><span class="_value"><? } ?>
						                	
						                	<?
							                	if( $h->getData('tresc_html') )
							                		echo $h->getData('tresc_html');
							                	else
								                	echo preg_replace('/([0-9]{11})/', '---', $h->getData('tresc'));
							                ?>
						                	
						                	
						                	<? if( $h->getData('label') ) {?></span><? } ?>
						                	<? if( $h->getData('tresc_poprzednia') ) echo '<span class="_lastvalue" data-placement="top" data-toggle="tooltip" title="' . addslashes( 'Poprzednia wartość: ' . $h->getData('tresc_poprzednia') ) . '"></span> '; ?> 
					                	</div>
					                </div>
				                </div>			                	
			                	
			                	
		                	</div>
	                	</div>
	                </li>
	                
	                <?
		                	$lastDate = $h->getDate();
		                	$lastLocation = $location;
		                	$lastSublocation = $sublocation;
		                	
		                }
		            ?>  
	            </ul>
	            
	            <p class="block-btns">
		            <a class="btn btn-default btn-sm" href="<?= $object->getUrl(); ?>/historia">Pełna historia zmian &raquo;</a>
	            </p>
	            
	        </div>
	    </div>
	</div>
	<? } ?>
	
	
    <div class="powiazania block">
        <div class="block-header"><h2 class="label">Powiązania</h2></div>

        <div id="connectionGraph" class="loading" data-id="<?php echo $object->getId() ?>"></div>
    </div>


    <? if ($zamowienia) { ?>
        <div id="zamowienia" class="block">
            <div class="block-header">
                <h2 class="label pull-left">Realizowane zamówienia publiczne</h2>
                <a class="btn btn-default btn-sm pull-right"
                   href="<?= $object->getUrl() ?>/zamowienia">Zobacz wszystkie</a>
            </div>

            <div class="content">
                <div class="dataobjectsSliderRow row">
                    <div>
                        <?php echo $this->dataobjectsSlider->render($zamowienia, array(
                            'perGroup' => 3,
                            'rowNumber' => 1,
                            'labelMode' => 'none',
                            'dfFields' => array('data'),
                        )) ?>
                    </div>
                </div>
            </div>
        </div>
    <? } ?>
    
    <? if ($dotacje) { ?>
        <div id="zamowienia" class="block">
            <div class="block-header">
                <h2 class="label pull-left">Udzielone dotacje</h2>
                <a class="btn btn-default btn-sm pull-right"
                   href="<?= $object->getUrl() ?>/dotacje">Zobacz wszystkie</a>
            </div>

            <div class="content">
                <div class="dataobjectsSliderRow row">
                    <div>
                        <?php echo $this->dataobjectsSlider->render($dotacje, array(
                            'perGroup' => 3,
                            'rowNumber' => 1,
                            'labelMode' => 'none',
                            'dfFields' => array('data'),
                        )) ?>
                    </div>
                </div>
            </div>
        </div>
    <? } ?>


    <? if ($dzialalnosci) { ?>
        <div class="dzialalnosci block">
            <div class="block-header"><h2 id="<?= $dzialalnosci['idTag'] ?>"
                                          class="label"><?= $dzialalnosci['title'] ?></h2></div>

            <div class="content normalizeText">
                <div class="list-group less-borders">
                    <? foreach ($dzialalnosci['content'] as $d) { ?>
                        <li class="list-group-item"><?= $d['str'] ?></li>
                    <? } ?>
                </div>
            </div>
        </div>
    <? } ?>

    </div>
    </div>
    </div>

<?= $this->Element('dataobject/pageEnd'); ?>