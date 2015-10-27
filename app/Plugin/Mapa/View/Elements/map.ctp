<?
$this->Combinator->add_libs('css', $this->Less->css('dataobject', array('plugin' => 'Dane')));
$this->Combinator->add_libs('css', $this->Less->css('dataobjectpage', array('plugin' => 'Dane')));
$this->Combinator->add_libs('css', $this->Less->css('DataBrowser', array('plugin' => 'Dane')));
$this->Combinator->add_libs('css', $this->Less->css('mapa', array('plugin' => 'Mapa')));

$this->Combinator->add_libs('js', 'Dane.DataBrowser.js');
$this->Combinator->add_libs('js', 'Mapa.mapa');

switch (Configure::read('Config.language')) {
    case 'pol':
        $lang = "pl-PL";
        break;
    case 'eng':
        $lang = "en-EN";
        break;
};
echo $this->Html->script('//maps.googleapis.com/maps/api/js?v=3.21&libraries=geometry&sensor=false&language=' . $lang, array('block' => 'scriptBlock'));
echo $this->Html->script('../plugins/cropit/dist/jquery.cropit.js', array('block' => 'scriptBlock'));
?>
<div class="objectsPage">
    <div class="dataBrowser margin-top-0<? if (isset($class)) echo " " . $class; ?>">
        <? if (!isset($widget)) { ?>
            <div class="searcher-app">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-8 col-md-9 col-lg-10 nopadding">
                            <?
                            $_params = array(
                                'dataBrowser' => array(
                                    'autocompletion' => array(
                                        'dataset' => 'miejsca',
                                    ),
                                    'searchTitle' => 'Szukaj adresu, miejscowości lub kodu pocztowego...',
                                    'searchAction' => '/mapa',
                                    'searchTag' => array(
                                        'href' => '/mapa',
                                        'label' => 'Mapa',
                                    )
                                ),
                            );
                            echo $this->element('Dane.DataBrowser/browser-searcher', $_params);
                            ?>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-3 col-lg-2">
                            <btn class="btn btn-icon btn-default localizeMe"><span
                                    class="icon glyphicon"
                                    aria-hidden="true"></span>Zlokalizuj
                                mnie
                            </btn>
                        </div>
                    </div>
                </div>
            </div>

            <? if (isset($app_menu)) { ?>
                <div class="apps-menu">
                    <div class="container">
                        <ul>
                            <? foreach ($app_menu[0] as $a) { ?>
                                <li>
                                    <a<? if (isset($a['active']) && $a['active']) { ?> class="active"<? } ?>
                                        href="<?= $a['href'] ?>"><?= $a['title'] ?></a>
                                </li>
                            <? } ?>
                        </ul>
                    </div>
                </div>
            <? }
        } ?>

        <div class="container">
            <div id="mapBrowser"
                 class="row dataBrowserContent"
                 <? if (@$mapParams['viewport']) { ?>data-viewport="<?= htmlspecialchars(json_encode($mapParams['viewport'])) ?>"<? } ?>
                 <? if (@$mapParams['data']) { ?>data-typ_id="<?= $mapParams['data']['miejsca.typ_id'] ?>"<? } ?>
                 <? if (@$mapParams['data']) { ?>data-object_id="<?= $mapParams['data']['miejsca.object_id'] ?>"<? } ?>
                 <? if (@$mapParams['data']) { ?>data-data="<?= htmlspecialchars(json_encode($mapParams['data'])) ?>"<? } ?>>

                <div class="map<? if (!isset($mapParams) && !isset($dataBrowser)) { ?> nodetails<? } ?>"></div>

                <? if (isset($dataBrowser) && isset($this->request->query['q'])) { ?>

                    <div class="details">
                        <div class="title">

                            <h1><?= isset($this->request->query['q']) ? $this->request->query['q'] : 'Mapa' ?></h1>

                        </div>

                        <ul class="main">

                            <? if (@$dataBrowser['hits']) { ?>
                                <li class="accord">
                                    <header>
                                        <span class="arrow"></span>

                                        <h2>Wyniki wyszukiwania:</h2>
                                    </header>
                                    <section class="dcontent">
                                        <ul class="scrollZone">
                                            <? foreach ($dataBrowser['hits'] as $item) { ?>
                                                <li>
                                                    <a href="/mapa/miejsce/<?= $item->getId() ?><? if (isset($widget)) echo '?widget';
                                                    if (isset($_GET["redirect"])) echo '&redirect'; ?>"><?= $item->getTitle() ?></a>
                                                </li>
                                            <? } ?>
                                        </ul>
                                    </section>
                                </li>
                            <? } ?>

                        </ul>

                    </div>

                <? } elseif (isset($mapParams)) { ?>

                    <div class="details" itemscope itemtype="http://schema.org/Place">
                        <div class="title">
                            <? if (@$mapParams['mode'] == 'place') { ?>
                                <? if (($mapParams['data']['typ_id'] == '4') && isset($mapParams['data']['miejsca.miejscowosc_typ'])) { ?>
                                    <p class="_label"><?= $mapParams['data']['miejsca.miejscowosc_typ'] ?></p>
                                <? } elseif (($mapParams['data']['typ_id'] == '3') && isset($mapParams['data']['miejsca.gmina_typ_id'])) { ?>
                                    <p class="_label">
                                        <?
                                        if ($mapParams['data']['miejsca.gmina_typ_id'] == '1')
                                            echo "Gmina miejska";
                                        elseif ($mapParams['data']['miejsca.gmina_typ_id'] == '2')
                                            echo "Gmina wiejska";
                                        elseif ($mapParams['data']['miejsca.gmina_typ_id'] == '3')
                                            echo "Gmina miejsko-wiejska";
                                        elseif ($mapParams['data']['miejsca.gmina_typ_id'] == '4')
                                            echo "Miasto stołeczne";
                                        ?>
                                    </p>
                                <? } elseif (($mapParams['data']['typ_id'] == '5')) { ?>
                                    <p class="_label"><?= $mapParams['data']['miejsca.ulica_cecha'] ?></p>
                                <? } ?>
                            <? } elseif (@$mapParams['mode'] == 'code') { ?>
                                <p class="_label">Kod pocztowy</p>
                            <? } ?>

                            <h1><?= $mapParams['title'] ?></h1>
                            <?
                            if (@$mapParams['mode'] == 'place') {
                                $typ_id = (int)$mapParams['data']['typ_id'];
                                if ($typ_id > 1) { ?>
                                    <ul class="meta">
                                        <? if ($typ_id > 4) { ?>
                                            <li>
                                                <label>Miejscowość:</label>
                                                <a href="/mapa/miejsce/<?= $mapParams['data']['miejsca.miejscowosc_miejsce_id'] ?><? if (isset($widget)) echo '?widget';
                                                if (isset($_GET["redirect"])) echo '&redirect'; ?>"><?= ($mapParams['data']['miejscowosc']) ?></a>
                                            </li>
                                        <? } ?>

                                        <? if (($typ_id > 3)) { ?>
                                            <li>
                                                <label>Gmina:</label>
                                                <? if (!isset($widget)) { ?>
                                                    <a href="/dane/gminy/<?= $mapParams['data']['miejsca.gmina_id'] ?>"
                                                       target="_blank"><span class="glyphicon glyphicon-share"
                                                                             aria-hidden="true"></span></a>
                                                <? } ?>
                                                <a href="/mapa/miejsce/<?= $mapParams['data']['miejsca.gmina_miejsce_id'] ?><? if (isset($widget)) echo '?widget';
                                                if (isset($_GET["redirect"])) echo '&redirect'; ?>"><?= ($mapParams['data']['gmina']) ?></a>
                                            </li>
                                        <? } ?>

                                        <? if ($typ_id > 2) { ?>
                                            <li>
                                                <label>Powiat:</label>
                                                <? if (!isset($widget)) { ?>
                                                    <a href="/dane/powiaty/<?= $mapParams['data']['miejsca.powiat_id'] ?>"
                                                       target="_blank"><span class="glyphicon glyphicon-share"
                                                                             aria-hidden="true"></span></a>
                                                <? } ?>
                                                <a href="/mapa/miejsce/<?= $mapParams['data']['miejsca.powiat_miejsce_id'] ?><? if (isset($widget)) echo '?widget';
                                                if (isset($_GET["redirect"])) echo '&redirect'; ?>"><?= ($mapParams['data']['powiat']) ?></a>
                                            </li>
                                        <? } ?>

                                        <? if ($typ_id > 1) { ?>
                                            <li>
                                                <label>Województwo:</label>
                                                <? if (!isset($widget)) { ?>
                                                    <a href="/dane/wojewodztwa/<?= $mapParams['data']['miejsca.wojewodztwo_id'] ?>"
                                                       target="_blank"><span class="glyphicon glyphicon-share"
                                                                             aria-hidden="true"></span></a>
                                                <? } ?>
                                                <a href="/mapa/miejsce/<?= $mapParams['data']['miejsca.wojewodztwo_miejsce_id'] ?><? if (isset($widget)) echo '?widget';
                                                if (isset($_GET["redirect"])) echo '&redirect'; ?>"><?= strtolower($mapParams['data']['wojewodztwo']) ?></a>
                                            </li>
                                        <? } ?>

                                        <? if (count($mapParams['codes']) < 3) { ?>
                                            <li>
                                                <label>Kod pocztowy:</label>
                                                <a href="/mapa/<?= $mapParams['codes'][0]['key'] ?><? if (isset($widget)) echo '?widget';
                                                if (isset($_GET["redirect"])) echo '&redirect'; ?>"><?= $mapParams['codes'][0]['key'] ?></a>
                                            </li>
                                        <? } ?>

                                    </ul>
                                <? } ?>
                            <? } elseif (@$mapParams['mode'] == 'code') { ?>

                                <? if (
                                    isset($mapParams['miejscowosc']) ||
                                    isset($mapParams['gmina']) ||
                                    isset($mapParams['powiat']) ||
                                    isset($mapParams['wojewodztwo'])
                                ) { ?>

                                    <ul class="meta">

                                        <? if (isset($mapParams['ulica'])) { ?>
                                            <li>
                                                <label>Ulica:</label>
                                                <a href="/mapa/miejsce/<?= $mapParams['ulica']['miejsce_id'] ?><? if (isset($widget)) echo '?widget';
                                                if (isset($_GET["redirect"])) echo '&redirect'; ?>"><?= ($mapParams['ulica']['label']) ?></a>
                                            </li>
                                        <? } ?>

                                        <? if (isset($mapParams['miejscowosc'])) { ?>
                                            <li>
                                                <label>Miejscowość:</label>
                                                <a href="/mapa/miejsce/<?= $mapParams['miejscowosc']['miejsce_id'] ?><? if (isset($widget)) echo '?widget';
                                                if (isset($_GET["redirect"])) echo '&redirect'; ?>"><?= ($mapParams['miejscowosc']['label']) ?></a>
                                            </li>
                                        <? } ?>

                                        <? if (isset($mapParams['gmina'])) { ?>
                                            <li>
                                                <label>Gmina:</label>
                                                <a href="/mapa/miejsce/<?= $mapParams['gmina']['miejsce_id'] ?><? if (isset($widget)) echo '?widget';
                                                if (isset($_GET["redirect"])) echo '&redirect'; ?>"><?= ($mapParams['gmina']['label']) ?></a>
                                            </li>
                                        <? } ?>

                                        <? if (isset($mapParams['powiat'])) { ?>
                                            <li>
                                                <label>Powiat:</label>
                                                <a href="/mapa/miejsce/<?= $mapParams['powiat']['miejsce_id'] ?><? if (isset($widget)) echo '?widget';
                                                if (isset($_GET["redirect"])) echo '&redirect'; ?>"><?= ($mapParams['powiat']['label']) ?></a>
                                            </li>
                                        <? } ?>

                                        <? if (isset($mapParams['wojewodztwo'])) { ?>
                                            <li>
                                                <label>Województwo:</label>
                                                <a href="/mapa/miejsce/<?= $mapParams['wojewodztwo']['miejsce_id'] ?><? if (isset($widget)) echo '?widget';
                                                if (isset($_GET["redirect"])) echo '&redirect'; ?>"><?= strtolower($mapParams['wojewodztwo']['label']) ?></a>
                                            </li>
                                        <? } ?>
                                    </ul>

                                <? } ?>

                            <? } ?>
                        </div>

                        <ul class="main">
                            <? if (isset($widget)) {
                                echo $this->element('Mapa.wybory', array("widget" => $widget, "mapParams" => $mapParams));
                            } ?>

                            <? if (@$mapParams['children']['wojewodztwa']) { ?>
                                <li class="accord">
                                    <header>
                                        <span class="arrow"></span>

                                        <h2>Województwa:</h2>
                                    </header>
                                    <section class="dcontent">
                                        <? if (count(@$mapParams['children']['wojewodztwa']) > 3) { ?>
                                            <input type="text" placeholder="Szukaj..."
                                                   class="form-control hasclear input-sm searcher"/>
                                        <? } ?>

                                        <ul class="scrollZone">
                                            <? foreach ($mapParams['children']['wojewodztwa'] as $item) { ?>
                                                <li>
                                                    <a href="/mapa/miejsce/<?= $item['miejsca.id'] ?><? if (isset($widget)) echo '?widget';
                                                    if (isset($_GET["redirect"])) echo '&redirect'; ?>"><?= $item['miejsca.wojewodztwo'] ?></a>
                                                </li>
                                            <? } ?>
                                        </ul>
                                    </section>
                                </li>
                            <? } ?>

                            <? if (@$mapParams['children']['powiaty']) { ?>
                                <li class="accord">
                                    <header>
                                        <span class="arrow"></span>

                                        <h2>Powiaty:</h2>
                                    </header>
                                    <section class="dcontent">
                                        <? if (count(@$mapParams['children']['powiaty']) > 3) { ?>
                                            <input type="text" placeholder="Szukaj..."
                                                   class="form-control hasclear input-sm searcher"/>
                                        <? } ?>

                                        <ul class="scrollZone">
                                            <? foreach ($mapParams['children']['powiaty'] as $item) { ?>
                                                <li>
                                                    <a href="/mapa/miejsce/<?= $item['miejsca.id'] ?><? if (isset($widget)) echo '?widget';
                                                    if (isset($_GET["redirect"])) echo '&redirect'; ?>"><?= $item['miejsca.powiat'] ?></a>
                                                </li>
                                            <? } ?>
                                        </ul>
                                    </section>
                                </li>
                            <? } ?>

                            <? if (@$mapParams['children']['gminy']) { ?>
                                <li class="accord">
                                    <header>
                                        <span class="arrow"></span>

                                        <h2>Gminy:</h2>
                                    </header>
                                    <section class="dcontent">
                                        <? if (count(@$mapParams['children']['gminy']) > 3) { ?>
                                            <input type="text" placeholder="Szukaj..."
                                                   class="form-control hasclear input-sm searcher"/>
                                        <? } ?>

                                        <ul class="scrollZone">
                                            <? foreach ($mapParams['children']['gminy'] as $item) { ?>
                                                <li>
                                                    <a href="/mapa/miejsce/<?= $item['miejsca.id'] ?><? if (isset($widget)) echo '?widget';
                                                    if (isset($_GET["redirect"])) echo '&redirect'; ?>"><?= $item['miejsca.gmina'] ?></a>
                                                </li>
                                            <? } ?>
                                        </ul>
                                    </section>
                                </li>
                            <? } ?>

                            <? if (@$mapParams['children']['miejscowosci']) { ?>
                                <li class="accord">
                                    <header>
                                        <span class="arrow"></span>

                                        <h2>Miejscowości:</h2>
                                    </header>
                                    <section class="dcontent">
                                        <? if (count(@$mapParams['children']['miejscowosci']) > 3) { ?>
                                            <input type="text" placeholder="Szukaj..."
                                                   class="form-control hasclear input-sm searcher"/>
                                        <? } ?>

                                        <ul class="scrollZone">
                                            <? foreach ($mapParams['children']['miejscowosci'] as $item) { ?>
                                                <li>
                                                    <a href="/mapa/miejsce/<?= $item['miejsca.id'] ?><? if (isset($widget)) echo '?widget';
                                                    if (isset($_GET["redirect"])) echo '&redirect'; ?>"><?= $item['miejsca.miejscowosc'] ?></a>
                                                </li>
                                            <? } ?>
                                        </ul>
                                    </section>
                                </li>
                            <? } ?>

                            <? if (@$mapParams['children']['miejsca']) { ?>
                                <li class="accord">
                                    <header>
                                        <span class="arrow"></span>

                                        <h2>Miejsca:</h2>
                                    </header>
                                    <section class="dcontent">
                                        <? if (count(@$mapParams['children']['miejsca']) > 3) { ?>
                                            <input type="text" placeholder="Szukaj..."
                                                   class="form-control hasclear input-sm searcher"/>
                                        <? } ?>

                                        <ul class="scrollZone">
                                            <? foreach ($mapParams['children']['miejsca'] as $item) { ?>
                                                <li>
                                                    <a href="/mapa/miejsce/<?= $item['id'] ?><? if (isset($widget)) echo '?widget';
                                                    if (isset($_GET["redirect"])) echo '&redirect'; ?>"><?= $item['nazwa'] ?></a>

                                                    <?
                                                    if (@$item['numery']) {
                                                        ?>
                                                        <ul class="adresy">
                                                            <?
                                                            foreach ($item['numery'] as $n) {
                                                                if (@$n['wszystkie']) {
                                                                    ?>
                                                                    <li>Wszystkie adresy</li>
                                                                    <?
                                                                } else {

                                                                    $parts = array();

                                                                    if (@$n['gte'])
                                                                        $parts[] = 'od numeru ' . $n['gte'];

                                                                    if (@$n['lte'])
                                                                        $parts[] = 'do numeru ' . $n['lte'];
                                                                    else
                                                                        $parts[] = 'do końca';

                                                                    if (@$n['e'])
                                                                        $parts[] = 'numer ' . $n['e'];

                                                                    if (@$n['mode'] == 'parzyste')
                                                                        $parts[] = 'parzyste';
                                                                    elseif (@$n['mode'] == 'nieparzyste')
                                                                        $parts[] = 'nieparzyste';

                                                                    if (empty($parts))
                                                                        continue;

                                                                    ?>
                                                                    <li><?= implode(', ', $parts) ?></li>
                                                                    <?
                                                                }
                                                            }
                                                            ?>
                                                        </ul>
                                                        <?
                                                    } else {
                                                        ?>
                                                        <ul class="adresy">
                                                            <li>Wszystkie adresy</li>
                                                        </ul>
                                                    <? } ?>

                                                </li>
                                            <? } ?>
                                        </ul>
                                    </section>
                                </li>
                            <? } ?>

                            <? if (@$mapParams['children']['ulice']) { ?>
                                <li class="accord">
                                    <header>
                                        <span class="arrow"></span>

                                        <h2>Ulice:</h2>
                                    </header>
                                    <section class="dcontent">
                                        <? if (count(@$mapParams['children']['ulice']) > 3) { ?>
                                            <input type="text" placeholder="Szukaj..."
                                                   class="form-control hasclear input-sm searcher"/>
                                        <? } ?>

                                        <ul class="scrollZone">
                                            <? foreach ($mapParams['children']['ulice'] as $item) { ?>
                                                <li>
                                                    <a href="/mapa/miejsce/<?= $item['miejsca.id'] ?><? if (isset($widget)) echo '?widget';
                                                    if (isset($_GET["redirect"])) echo '&redirect'; ?>"><?= $item['miejsca.ulica'] ?></a>
                                                </li>
                                            <? } ?>
                                        </ul>
                                    </section>
                                </li>
                            <? } ?>

                            <? if (@$mapParams['points']) { ?>
                                <li class="accord">
                                    <header>
                                        <span class="arrow"></span>

                                        <h2>Numery:</h2>
                                    </header>
                                    <section class="dcontent">
                                        <? if (count(@$mapParams['points']) > 3) { ?>
                                            <input type="text" placeholder="Szukaj..."
                                                   class="form-control hasclear input-sm searcher"/>
                                        <? } ?>

                                        <ul class="scrollZone _points">
                                            <? foreach ($mapParams['points'] as $item) { ?>
                                                <li data-kod="<?= @$item['kod'] ?>"
                                                    data-obwod_id="<?= @$item['parl_obwod_id'] ?>"
                                                    name="<?= str_replace('/', '\\', $item['numer']) ?>" itemprop="geo"
                                                    itemscope
                                                    itemtype="http://schema.org/GeoCoordinates">
                                                    <a href='#<?= urlencode(str_replace('/', '\\', $item['numer'])) ?>'><?= $item['numer'] ?></a>
                                                    <meta itemprop="latitude"
                                                          content="<?= $item['lat'] ?>"/>
                                                    <meta itemprop="longitude"
                                                          content="<?= $item['lon'] ?>"/>
                                                </li>
                                            <? } ?>
                                        </ul>
                                    </section>
                                </li>
                            <? } ?>
                            <? if (!isset($widget)) {
                                echo $this->element('Mapa.wybory', array("widget" => null, "mapParams" => $mapParams));
                            } ?>
                        </ul>
                    </div>
                    <? if (isset($widget)) { ?>
                        <ul class="legend">
                            <li><strong>Legenda</strong></li>
                            <li><img src="/mapa/img/marker-blur@2x.png" alt=""/>Punkty adresowe</li>
                            <li><img src="/mapa/img/marker-komisja.svg" alt=""/>Komisje wyborcze</li>
                        </ul>
                    <? } ?>
                <? } ?>
            </div>
        </div>
    </div>
</div>
