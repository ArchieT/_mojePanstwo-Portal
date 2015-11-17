<?php
$this->Combinator->add_libs('css', $this->Less->css('podatki', array('plugin' => 'Podatki')));

$this->Combinator->add_libs('js', '../plugins/highstock/js/highstock');
$this->Combinator->add_libs('js', '../plugins/highstock/js/highcharts-more');
$this->Combinator->add_libs('js', '../plugins/highstock/locals');

$this->Combinator->add_libs('js', 'Podatki.podatki.js');
?>

<form id="podatki" method="post">
    <div class="container">
        <div class="appBanner">
            <h1 class="appTitle"><?= __d('podatki', 'LC_PODATKI_HEADLINE'); ?></h1>

            <p class="appSubtitle"><?= __d('podatki', 'LC_PODATKI_SUBHEADLINE'); ?></p>
        </div>

        <div class="sections">
            <div class="section">
                <div class="row"
                     data-number="<?= (isset($post['umowa_o_prace'])) ? count($post['umowa_o_prace']) : 1 ?>">
                    <div class="col-xs-10 col-sm-6 col-sm-offset-2 col-md-5 col-md-offset-0 text-right">
                        <label data-toggle="tooltip" data-placement="top"
                               title="<?= __d('podatki', 'LC_PODATKI_INFO_FULL'); ?>"
                               for="przychody_umowa_o_prace_1"><?= __d('podatki', 'LC_PODATKI_PRZYCHODY_UMOWA_O_PRACE'); ?>
                            :</label>
                    </div>
                    <div class="col-xs-10 col-sm-6 col-sm-offset-2 col-md-2 col-md-offset-0 text-center inputpadding">
                        <input type="number" pattern="[0-9]+([\.|,][0-9]{2}+)?" step="0.01"
                               name="umowa_o_prace[]"
                               title="<?= __d('podatki', 'LC_PODATKI_INPUT_FLOAT'); ?>" class="form-control"
                               id="przychody_umowa_o_prace_1"
                               value="<?= @$post['umowa_o_prace'][0]; ?>">
                    </div>
                    <div class="col-xs-10 col-sm-4 col-md-3 button_container">
                        <a href="#<?= str_replace(' ', '_', strtolower(__d('podatki', 'LC_PODATKI_ADD_NEW_UMOWA'))); ?>"
                           class="btn btn-link btn-xs" data-type="przychody_umowa_o_prace">
                            <i class="icon glyphicon glyphicon-plus"></i><?= __d('podatki', 'LC_PODATKI_ADD_NEW_UMOWA'); ?>
                        </a>
                    </div>
                </div>
                <? if (isset($post['umowa_o_prace'][1])) {
                    for ($i = 1; $i <= count($post['umowa_o_prace']); $i++) {
                        if (!empty($post['umowa_o_prace'][$i]) && $post['umowa_o_prace'][$i] !== 0) {
                            ?>
                            <div class="additional row" data-number="<?= $i; ?>">
                                <div
                                    class="col-xs-10 col-sm-6 col-sm-offset-2 col-md-2 col-md-offset-5 text-center inputpadding">
                                    <input type="number" class="form-control" patern="[0-9]+([.|,][0-9]{2}+)?"
                                           step="0.01" name="umowa_o_prace[]"
                                           title="<?= __d('podatki', 'LC_PODATKI_INPUT_FLOAT'); ?>"
                                           id="przychody_umowa_o_prace_<?= $i; ?>"
                                           value="<?= @$post['umowa_o_prace'][$i]; ?>">
                                </div>
                                <div class="col-xs-2 col-sm-4 col-md-3">
                                    <a class="closeAdditional glyphicon glyphicon-remove" aria-hidden="true"
                                       href="#usuń"></a>
                                </div>
                            </div>
                            <?
                        }
                    }
                } ?>
            </div>

            <div class="section">
                <div class="row"
                     data-number="<?= (isset($post['umowa_zlecenie'])) ? count($post['umowa_zlecenie']) : 1 ?>">
                    <div class="col-xs-10 col-sm-6 col-sm-offset-2 col-md-5 col-md-offset-0 text-right">
                        <label data-toggle="tooltip" data-placement="top"
                               title="<?= __d('podatki', 'LC_PODATKI_INFO_FULL'); ?>"
                               for="przychody_umowa_zlecenie_1"><?= __d('podatki', 'LC_PODATKI_PRZYCHODY_UMOWA_ZLECENIE'); ?>
                            :</label>
                    </div>
                    <div class="col-xs-10 col-sm-6 col-sm-offset-2 col-md-2 col-md-offset-0 text-center inputpadding">
                        <input type="number" pattern="[0-9]+([\.|,][0-9]{2}+)?" step="0.01"
                               name="umowa_zlecenie[]"
                               title="<?= __d('podatki', 'LC_PODATKI_INPUT_FLOAT'); ?>" class="form-control"
                               id="przychody_umowa_zlecenie_1"
                               value="<?= @$post['umowa_zlecenie'][0]; ?>">
                    </div>
                    <div class="col-xs-10 col-sm-4 col-md-3 button_container">
                        <a href="#<?= str_replace(' ', '_', strtolower(__d('podatki', 'LC_PODATKI_ADD_NEW_UMOWA'))); ?>"
                           class="btn btn-link btn-xs" data-type="przychody_umowa_zlecenie">
                            <i class="icon glyphicon glyphicon-plus"></i><?= __d('podatki', 'LC_PODATKI_ADD_NEW_UMOWA'); ?>
                        </a>
                    </div>
                </div>
                <? if (isset($post['umowa_zlecenie'][1])) {
                    for ($i = 1; $i <= count($post['umowa_zlecenie']); $i++) {
                        if (!empty($post['umowa_zlecenie'][$i]) && $post['umowa_zlecenie'][$i] !== 0) {
                            ?>
                            <div class="additional row" data-number="<?= $i; ?>">
                                <div
                                    class="col-xs-10 col-sm-6 col-sm-offset-2 col-md-2 col-md-offset-5 text-center inputpadding">
                                    <input type="number" class="form-control" patern="[0-9]+([.|,][0-9]{2}+)?"
                                           step="0.01" name="umowa_zlecenie[]"
                                           title="<?= __d('podatki', 'LC_PODATKI_INPUT_FLOAT'); ?>"
                                           id="przychody_umowa_zlecenie_<?= $i; ?>"
                                           value="<?= @$post['umowa_zlecenie'][$i]; ?>">
                                </div>
                                <div class="col-xs-2 col-sm-4 col-md-3">
                                    <a class="closeAdditional glyphicon glyphicon-remove" aria-hidden="true"
                                       href="#usuń"></a>
                                </div>
                            </div>
                            <?
                        }
                    }
                } ?>
            </div>

            <div class="section">
                <div class="row"
                     data-number="<?= (isset($post['umowa_o_dzielo'])) ? count($post['umowa_o_dzielo']) : 1 ?>">
                    <div class="col-xs-10 col-sm-6 col-sm-offset-2 col-md-5 col-md-offset-0 text-right">
                        <label data-toggle="tooltip" data-placement="top"
                               title="<?= __d('podatki', 'LC_PODATKI_INFO_FULL'); ?>"
                               for="przychody_umowa_o_dzielo_1"><?= __d('podatki', 'LC_PODATKI_PRZYCHODY_UMOWA_DZIELO'); ?>
                            :</label>
                    </div>
                    <div class="col-xs-10 col-sm-6 col-sm-offset-2 col-md-2 col-md-offset-0 text-center inputpadding">
                        <input type="number" pattern="[0-9]+([\.|,][0-9]{2}+)?" step="0.01"
                               name="umowa_o_dzielo[]"
                               title="<?= __d('podatki', 'LC_PODATKI_INPUT_FLOAT'); ?>" class="form-control"
                               id="przychody_umowa_o_dzielo_1"
                               value="<?= @$post['umowa_o_dzielo'][0]; ?>">
                    </div>
                    <div class="col-xs-10 col-sm-4 col-md-3 button_container">
                        <a href="#<?= str_replace(' ', '_', strtolower(__d('podatki', 'LC_PODATKI_ADD_NEW_UMOWA'))); ?>"
                           class="btn btn-link btn-xs" data-type="przychody_umowa_o_dzielo">
                            <i class="icon glyphicon glyphicon-plus"></i><?= __d('podatki', 'LC_PODATKI_ADD_NEW_UMOWA'); ?>
                        </a>
                    </div>
                </div>
                <? if (isset($post['umowa_o_dzielo'][1])) {
                    for ($i = 1; $i <= count($post['umowa_o_dzielo']); $i++) {
                        if (!empty($post['umowa_o_dzielo'][$i]) && $post['umowa_o_dzielo'][$i] !== 0) {
                            ?>
                            <div class="additional row" data-number="<?= $i; ?>">
                                <div
                                    class="col-xs-10 col-sm-6 col-sm-offset-2 col-md-2 col-md-offset-5 text-center inputpadding">
                                    <input type="number" class="form-control" patern="[0-9]+([.|,][0-9]{2}+)?"
                                           step="0.01" name="umowa_o_dzielo[]"
                                           title="<?= __d('podatki', 'LC_PODATKI_INPUT_FLOAT'); ?>"
                                           id="przychody_umowa_o_dzielo_<?= $i; ?>"
                                           value="<?= @$post['umowa_o_dzielo'][$i]; ?>">
                                </div>
                                <div class="col-xs-2 col-sm-4 col-md-3">
                                    <a class="closeAdditional glyphicon glyphicon-remove" aria-hidden="true"
                                       href="#usuń"></a>
                                </div>
                            </div>
                            <?
                        }
                    }
                } ?>
            </div>
            <div class="section dzialalnoscGospodarcza">
                <? $dzialanoscGospExist = ((isset($post['dzialalnosc_gospodarcza']) && !empty($post['dzialalnosc_gospodarcza'][0])) || (isset($post['dzialalnosc_gospodarcza_koszt']) && !empty($post['dzialalnosc_gospodarcza_koszt'][0]))) ? true : false; ?>

                <p class="text-center<? if ($dzialanoscGospExist) { ?> hide<? } ?>">
                    <a href="#">Prowadzisz jednosobową działalność gospodarczą?</a>
                </p>

                <div class="row"<? if (!$dzialanoscGospExist) { ?> style="display: none"<? } ?>>
                    <div class="col-xs-10 col-sm-4 col-sm-offset-8 col-md-3 col-md-offset-7">
                        <a class="closeAdditional glyphicon glyphicon-remove show" aria-hidden="true"
                           href="#zamknij"></a>
                    </div>
                    <div class="col-xs-10 col-sm-6 col-sm-offset-2 col-md-5 col-md-offset-0 text-right">
                        <label
                            for="przychody_dzialalnosc_gospodarcza_1"><?= __d('podatki', 'LC_PODATKI_PRZYCHODY_DZIALALNOSC_GOSPODARCZA'); ?></label>
                    </div>
                    <div class="col-xs-10 col-sm-6 col-sm-offset-2 col-md-2 col-md-offset-0 text-center inputpadding">
                        <input type="number" pattern="[0-9]+([\.|,][0-9]{2}+)?" step="0.01"
                               name="dzialalnosc_gospodarcza[]"
                               title="<?= __d('podatki', 'LC_PODATKI_INPUT_FLOAT'); ?>" class="form-control"
                               id="przychody_dzialalnosc_gospodarcza_1"
                               value="<?= @$post['dzialalnosc_gospodarcza'][0] ?>">
                    </div>
                    <div class="col-xs-10 col-sm-6 col-sm-offset-2 col-md-3 col-md-offset-5 checkbox">
                        <input type="hidden" id="warunki_preferencyjne_1_hidden" value="N"
                               name="warunki_preferencyjne[]">
                        <input type="checkbox" id="warunki_preferencyjne_1" value="Y"
                               name="warunki_preferencyjne[]"<? if (isset($post['warunki_preferencyjne']) && $post['warunki_preferencyjne'][0] == 'Y') echo ' checked'; ?>>
                        <label
                            for="warunki_preferencyjne_1"><?= __d('podatki', 'LC_PODATKI_WARUNKI_PREFERENCYJNE'); ?></label>
                    </div>
                    <div class="col-xs-10 col-sm-6 col-sm-offset-2 col-md-5 col-md-offset-0 text-right">
                        <label
                            for="przychody_dzialalnosc_gospodarcza_koszt_1"><?= __d('podatki', 'LC_PODATKI_PRZYCHODY_DZIALALNOSC_GOSPODARCZA_KOSZT'); ?></label>
                    </div>
                    <div class="col-xs-10 col-sm-6 col-sm-offset-2 col-md-2 col-md-offset-0 text-center inputpadding">
                        <input type="number" pattern="[0-9]+([\.|,][0-9]{2}+)?" step="0.01"
                               name="dzialalnosc_gospodarcza_koszt[]"
                               title="<?= __d('podatki', 'LC_PODATKI_INPUT_FLOAT'); ?>" class="form-control"
                               id="przychody_dzialalnosc_gospodarcza_koszt_1"
                               value="<?= @$post['dzialalnosc_gospodarcza_koszt'][0] ?>">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="main_button_container text-center">
        <button class="btn btn-success btn-lg btn-icon" type="submit"><i
                class="icon glyphicon glyphicon-refresh"></i><span>Oblicz</span>
        </button>
    </div>

    <div class="stripe scroll<?php if ($result == false) { ?>blocked" style="display: none;<? } ?>">
        <div class="container">
            <h2><? if (isset($result['netto'])) {
                    echo __d('podatki', 'LC_PODATKI_RESULTS_MIESIECZNIE_ODPROWADZASZ_DO_PANSTWA') . ' ' . number_format($result['brutto'] - $result['netto'], 2, '.', ' ') . ' zł';
                } ?></h2>

            <div
                class="row chart_area"<? if (isset($result)) { ?> data-result='<?= json_encode($result) ?>'<? } ?>>
                <div class="col-xs-12 col-md-6 pie"></div>
                <div class="col-xs-12 col-md-6 legend">
                    <? if (isset($result)) { ?>
                        <div class="position"><span
                                style="background-color: <?= $result['zus_color'] ?>"></span><?= __d('podatki', 'LC_PODATKI_RESULTS_PIE_ZUS') ?>
                            : <strong><?= $result['zus'] ?> zł</strong>
                        </div>
                        <div class="position"><span
                                style="background-color: <?= $result['zdrow_color'] ?>"></span><?= __d('podatki', 'LC_PODATKI_RESULTS_PIE_ZDROW') ?>
                            : <strong><?= $result['zdrow'] ?> zł</strong>
                        </div>
                        <div class="position"><span
                                style="background-color: <?= $result['pit_color'] ?>"></span><?= __d('podatki', 'LC_PODATKI_RESULTS_PIE_PIT') ?>
                            : <strong><?= $result['pit'] ?> zł</strong>
                        </div>
                        <div class="position"><span
                                style="background-color: <?= $result['vat_color'] ?>"></span><?= __d('podatki', 'LC_PODATKI_RESULTS_PIE_VAT') ?>
                            *
                            : <strong><?= $result['vat'] ?> zł</strong>
                        </div>
                        <div class="position"><span
                                style="background-color: <?= $result['akcyza_color'] ?>"></span><?= __d('podatki', 'LC_PODATKI_RESULTS_PIE_AKCYZA') ?>
                            *
                            : <strong><?= $result['akcyza'] ?> zł</strong>
                        </div>
                    <? } ?>
                </div>
            </div>

            <div class="row items">
                <h2 class="text-center"><?= __d('podatki', 'LC_PODATKI_RESULTS_WYDAWANE_PODATKI'); ?>:</h2>

                <div class="block col-xs-12 col-sm-6 col-md-3">
                    <div data-id="5" class="item more">
                        <a data-title="Oświata i wychowanie" class="inner" href="#5">
                            <div class="logo">
                                <i class="icon-dzialy-5"></i>
                            </div>
                            <div class="details">
                                <span class="detail">262&nbsp;mln</span>
                            </div>
                            <div class="title">
                                <div class="nazwa">Oświata i wychowanie</div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="block col-xs-12 col-sm-6 col-md-3">
                    <div data-id="5" class="item more">
                        <a data-title="Oświata i wychowanie" class="inner" href="#5">
                            <div class="logo">
                                <i class="icon-dzialy-5"></i>
                            </div>
                            <div class="details">
                                <span class="detail">262&nbsp;mln</span>
                            </div>
                            <div class="title">
                                <div class="nazwa">Oświata i wychowanie</div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="main_button_container text-center">
            <a class="btn btn-info btn-lg btn-icon" href="/podatki"><i
                    class="icon glyphicon glyphicon-repeat"></i><span>Nowe obliczenia</span>
            </a>
        </div>

        <div class="footer">
            <div class="container">
                <p><?= __d('podatki', 'LC_PODATKI_INFORMATION'); ?></p>

                <p>* - <?= __d('podatki', 'LC_PODATKI_RESULTS_INFO_NUMBERS_TABEL_TAX'); ?></p>
            </div>
        </div>
    </div>
</form>
