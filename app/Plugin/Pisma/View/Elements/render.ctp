<?php $this->Combinator->add_libs('css', $this->Less->css('pisma_render', array('plugin' => 'Pisma'))) ?>

<div id="editor-cont">

    <div class="editor-controls">
        <div class="control control-date">
            <input type="text" class="datepicker" <?php if (!empty($pismo['data_pisma'])) {
                $months = ['stycznia', 'lutego', 'marca', 'kwietnia', 'maja', 'czerwca', 'lipca', 'sierpnia', 'września', 'października', 'listopada', 'grudnia'];
                $data_proc = explode('-', $pismo['data_pisma']);
                $data_slownie = $data_proc[2] . ' ' . $months[$data_proc[1] - 1] . ' ' . $data_proc[0];

                echo 'value="' . $data_slownie . '"';
            } ?>>
            <input type="hidden" id="datepickerAlt" value="<?php if (!empty($pismo['data_pisma'])) {
                echo $pismo['data_pisma'];
            } else {
                echo date('Y-m-d');
            } ?>">
            <input type="text" class="city empty" placeholder="Wybierz miejscowość" maxlength="127"
                   style="display: none;">
        </div>

        <div class="control control-sender">
            <?php if (empty($pismo['nadawca'])) { ?>
                <textarea class="nadawca empty" placeholder="Wpisz dane nadawcy..." rows="1" maxlength="511"></textarea>
            <? } else { ?>
                <div class="pre"><?= str_replace("\n", '<br/>', $pismo['nadawca']) ?></div>
            <? } ?>
            <textarea class="sprawa empty hide" placeholder="Wpisz znak sprawy" rows="1"></textarea>
        </div>

        <div class="control control-addressee"><span class="empty">Wybierz adresata</span></div>

        <div class="control control-template">
            <?php if (empty($pismo['tytul'])) { ?>
                <span class="empty">Wybierz szablon pisma</span>
            <? } else { ?>
                <?= $pismo['tytul'] ?>
            <? } ?>
        </div>

    </div>

    <div id="editor">
        <? if (!empty($pismo['tresc'])) {
            echo $pismo['tresc'];
        } ?>
    </div>

    <div class="editor-controls">
        <div class="control control-signature">
            <?php if (empty($pismo['podpis'])) { ?>
                <textarea class="podpis empty" placeholder="Podpisz się" rows="1" maxlength="255"></textarea>
            <? } else { ?>
                <div class="pre"><?= str_replace("\n", '<br/>', $pismo['podpis']) ?></div>
            <? } ?>
        </div>
    </div>

</div>