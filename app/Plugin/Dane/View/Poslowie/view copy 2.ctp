<?
$this->Combinator->add_libs('css', $this->Less->css('view-poslowie', array('plugin' => 'Dane')));
$this->Combinator->add_libs('js', 'jquery-tags-cloud-min');
$this->Combinator->add_libs('js', 'Dane.view-poslowie.js');

echo $this->Element('dataobject/pageBegin');
?>


    <div class="poslowie row">
        <div class="col-md-3 objectSide">
            <div class="objectSideInner">
                <ul class="dataHighlights side">

                    <? if ($object->getData('data_wygasniecia_mandatu') && ($object->getData('data_wygasniecia_mandatu') != '0000-00-00')) { ?>
                        <li class="dataHighlight">
                            <span class="label label-default">Ta osoba nie jest już posłem</span>
                        </li>
                        <li class="dataHighlight">
                            <p class="_label">Data wygaśnięcia mandatu</p>

                            <div>
                                <p class="_value"><?= $this->Czas->dataSlownie($object->getData('data_wygasniecia_mandatu')); ?></p>
                            </div>
                        </li>
                    <? } ?>

                    <? if ($object->getData('data_slubowania') && ($object->getData('data_slubowania') != '0000-00-00')) { ?>
                        <li class="dataHighlight">
                            <p class="_label">Data ślubowania</p>

                            <div>
                                <p class="_value"><?= $this->Czas->dataSlownie($object->getData('data_slubowania')); ?></p>
                            </div>
                        </li>
                    <? } ?>


                    <li class="dataHighlight big<? if (($object->getData('data_wygasniecia_mandatu') && ($object->getData('data_wygasniecia_mandatu') != '0000-00-00')) || ($object->getData('data_slubowania') && ($object->getData('data_slubowania') != '0000-00-00'))) { ?> topborder<? } ?>">
                        <p class="_label">Liczba wystąpień na forum Sejmu</p>

                        <div>
                            <p class="_value pull-left"><?= $object->getData('liczba_wypowiedzi'); ?></p>
                            <? if ($object->getData('liczba_wypowiedzi')) { ?><p class="pull-right nopadding"><a
                                    class="btn btn-sm btn-default"
                                    href="/dane/poslowie/<?= $object->getId() ?>/wystapienia">Zobacz &raquo;</a>
                                </p><? } ?>
                        </div>
                    </li>

                    <li class="dataHighlight big">
                        <p class="_label">Frekwencja na głosowaniach</p>

                        <div>
                            <p class="_value pull-left"><?= $object->getData('frekwencja'); ?>%</p>

                            <p class="pull-right nopadding"><a class="btn btn-sm btn-default"
                                                               href="/dane/poslowie/<?= $object->getId() ?>/glosowania/?glos_id[]=4">Zobacz &raquo;</a>
                            </p>
                        </div>
                    </li>

                    <li class="dataHighlight big">
                        <p class="_label">Zbuntowanie</p>

                        <div>
                            <p class="_value pull-left"><?= $object->getData('zbuntowanie'); ?>%</p>

                            <p class="pull-right nopadding"><a class="btn btn-sm btn-default"
                                                               href="/dane/poslowie/<?= $object->getId() ?>/glosowania?bunt[]=1">Zobacz &raquo;</a>
                            </p>
                        </div>

                    </li>

                    <li class="dataHighlight big topborder">
                        <p class="_label">Liczba podpisanych projektów ustaw</p>

                        <div>
                            <p class="_value pull-left"><?= $object->getData('liczba_projektow_ustaw'); ?></p>
                            <? if ($object->getData('liczba_projektow_ustaw')) { ?><p class="pull-right nopadding"><a
                                    class="btn btn-sm btn-default"
                                    href="/dane/poslowie/<?= $object->getId() ?>/prawo_projekty?typ_id[]=1">Zobacz &raquo;</a>
                                </p><? } ?>
                        </div>
                    </li>

                    <li class="dataHighlight big">
                        <p class="_label">Liczba podpisanych projektów uchwał</p>

                        <div>
                            <p class="_value pull-left"><?= $object->getData('liczba_projektow_uchwal'); ?></p>
                            <? if ($object->getData('liczba_projektow_uchwal')) { ?><p class="pull-right nopadding"><a
                                    class="btn btn-sm btn-default"
                                    href="/dane/poslowie/<?= $object->getId() ?>/prawo_projekty?typ_id[]=2">Zobacz &raquo;</a>
                                </p><? } ?>
                        </div>
                    </li>

                    <li class="dataHighlight big">
                        <p class="_label">Liczba wysłanych interpelacji</p>

                        <div>
                            <p class="_value pull-left"><?= $object->getData('liczba_interpelacji'); ?></p>
                            <? if ($object->getData('liczba_interpelacji')) { ?><p class="pull-right nopadding"><a
                                    class="btn btn-sm btn-default"
                                    href="/dane/poslowie/<?= $object->getId() ?>/interpelacje">Zobacz &raquo;</a>
                                </p><? } ?>
                        </div>
                    </li>
                </ul>
            </div>
        </div>


        <div class="col-md-9 objectMain">

            <div class="objectSearch">
                <div class="input-group">
                    <form method="get" action="/dane/poslowie/<?= $object->getId() ?>/wystapienia">
                        <input type="text"
                               placeholder="Szukaj w aktywnościach <?= $object->getData('dopelniacz'); ?>..."
                               autocomplete="off" class="form-control ui-autocomplete-input" name="q">
                        <input type="submit" style="display: none;" name="submit" value="search">
		            <span class="input-group-btn">
		                <button data-icon="" type="submit" class="btn btn-success btn-lg"></button>
		            </span>
                    </form>
                </div>
            </div>

            <div class="object">

                <div class="block-group col-xs-12">


                    <? if ($projekty_za) { ?>
                        <div id="projekty_za" class="block">
                            <div class="block-header">
                                <h2 class="label za pull-left">Projekty, za którymi głosował poseł</h2>
                                <a class="btn btn-default btn-sm pull-right"
                                   href="/dane/poslowie/<?= $object->getId() ?>/prawo_projekty_za">Zobacz wszystkie</a>
                            </div>

                            <div class="content">
                                <div class="dataobjectsSliderRow row">
                                    <div>
                                        <?php echo $this->dataobjectsSlider->render($projekty_za, array(
                                            'perGroup' => 2,
                                            'rowNumber' => 1,
                                            'dfFields' => array('data'),
                                        )) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <? } ?>

                    <? if ($projekty_przeciw) { ?>
                        <div id="projekty_przeciw" class="block">
                            <div class="block-header">
                                <h2 class="label przeciw pull-left">Projekty, przeciwko którym głosował poseł</h2>
                                <a class="btn btn-default btn-sm pull-right"
                                   href="/dane/poslowie/<?= $object->getId() ?>/prawo_projekty_przeciw">Zobacz
                                    wszystkie</a>
                            </div>

                            <div class="content">
                                <div class="dataobjectsSliderRow row">
                                    <div>
                                        <?php echo $this->dataobjectsSlider->render($projekty_przeciw, array(
                                            'perGroup' => 2,
                                            'rowNumber' => 1,
                                            'dfFields' => array('data'),
                                        )) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <? } ?>

                    <? if ($projekty_wstrzymania) { ?>
                        <div id="projekty_wstrzymania" class="block">
                            <div class="block-header">
                                <h2 class="label wstrzymanie pull-left">Projekty, nad którymi poseł wstrzymał się od
                                    głosu</h2>
                                <a class="btn btn-default btn-sm pull-right"
                                   href="/dane/poslowie/<?= $object->getId() ?>/prawo_projekty_wstrzymanie">Zobacz
                                    wszystkie</a>
                            </div>

                            <div class="content">
                                <div class="dataobjectsSliderRow row">
                                    <div>
                                        <?php echo $this->dataobjectsSlider->render($projekty_wstrzymania, array(
                                            'perGroup' => 2,
                                            'rowNumber' => 1,
                                            'dfFields' => array('data'),
                                        )) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <? } ?>

                    <? if ($poslowie_nieobecni) { ?>
                        <div id="projekty_nieobecni" class="block">
                            <div class="block-header">
                                <h2 class="label nieobecnosc pull-left">Projekty, dla których poseł nie przyszedł na
                                    głosowanie</h2>
                                <a class="btn btn-default btn-sm pull-right"
                                   href="/dane/poslowie/<?= $object->getId() ?>/prawo_projekty_nieobecnosc">Zobacz
                                    wszystkie</a>
                            </div>

                            <div class="content">
                                <div class="dataobjectsSliderRow row">
                                    <div>
                                        <?php echo $this->dataobjectsSlider->render($poslowie_nieobecni, array(
                                            'perGroup' => 2,
                                            'rowNumber' => 1,
                                            'dfFields' => array('data'),
                                        )) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <? } ?>


                    <? if (isset($terms) && !empty($terms)) { ?>
                        <div class="block">
                            <div class="block-header">
                                <h2 class="label">Charakterystyczne słowa w wystąpieniach</h2>
                            </div>

                            <ul class="objectTagsCloud row">
                                <?
                                foreach ($terms as $term) {
                                    $href = '/dane/poslowie/' . $object->getId() . '/wystapienia?q=' . addslashes($term['key']);
                                    ?>
                                    <li style="font-size: <?= $term['size'] ?>px;"><a
                                            href="<?= $href ?>"><?= $term['key'] ?></a></li>
                                <? } ?>
                            </ul>

                        </div>
                    <? } ?>
                </div>
            </div>
        </div>
    </div>


<?= $this->Element('dataobject/pageEnd'); ?>
