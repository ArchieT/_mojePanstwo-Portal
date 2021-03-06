<?php $this->Combinator->add_libs('css', $this->Less->css('pisma-button', array('plugin' => 'Pisma'))) ?>
<?php $this->Combinator->add_libs('js', 'Pisma.pisma-button.js') ?>

<fieldset>
    <div class="form-group szablony">
        <label for="szablonSelect" class="col-lg-2 control-label">Szablon</label>

        <div class="col-lg-10">
            <div class="radio">
                <input name="szablon_id" value="0" checked="" type="radio" id="brak">
                <label for="brak">Brak szablonu</label>
            </div>
            <div class="radio">
                <input id="wniosek_35" name="szablon_id" value="35"
                       type="radio"<?php if (!empty($pismo['szablon_id']) && $pismo['szablon_id'] == 35) {
                    echo ' checked';
                } ?>>
                <label for="wniosek_35">Wniosek o udostępnienie informacji publicznej</label>
            </div>
            <div class="radio">
                <input id="wniosek_40" name="szablon_id" value="40"
                       type="radio"<?php if (!empty($pismo['szablon_id']) && $pismo['szablon_id'] == 40) {
                    echo ' checked';
                } ?>>
                <label for="wniosek_40">Skarga na bezczynność organu</label>
            </div>
            <div class="radio">
                <input id="wniosek_82" name="szablon_id" value="82"
                       type="radio"<?php if (!empty($pismo['szablon_id']) && $pismo['szablon_id'] == 82) {
                    echo ' checked';
                } ?>>
                <label for="wniosek_82">Petycja</label>
            </div>
            <?php if (!empty($pismo['szablon_id']) && $pismo['szablon_id'] != 35 && $pismo['szablon_id'] != 40) { ?>
                <div class="radio">
                    <input id="wniosek_<?php echo $pismo['szablon_id'] ?>" name="szablon_id"
                           value="<?php echo $pismo['szablon_id'] ?>" type="radio" checked="checked">
                    <label for="wniosek_<?php echo $pismo['szablon_id'] ?>"><?php echo $pismo['nazwa'] ?></label>
                </div>
            <?php }; ?>

            <div class="templates_browser">
                <a href="#" class="pisma-list-button pisma-list-button-no-jump">Zobacz wszystkie szablony &raquo;</a>
            </div>
        </div>
    </div>
</fieldset>

<fieldset>
    <div class="form-group adresaci">
        <label for="adresatSelect" class="col-lg-2 control-label">Adresat</label>

        <div class="col-lg-10">
            <div class="suggesterBlockPisma">
            <?= $this->Element('Pisma.searcher', array('q' => '', 'dataset' => 'pisma_adresaci', 'placeholder' => 'Zacznij pisać aby znaleźć adresata...')) ?>
            </div>
            <span
                class="help-block">Na podstawie wybranego adresata, uzupełnimy dane teleadresowe w Twoim piśmie.</span>
        </div>

        <input type="hidden" name="adresat_id"<?php if (!empty($pismo['adresat_id'])) {
            echo ' value="' . $pismo['adresat_id'] . '"';
        } ?>>

    </div>
</fieldset>
