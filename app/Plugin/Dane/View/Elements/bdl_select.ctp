<?php $this->Combinator->add_libs('css', $this->Less->css('bdl-select', array('plugin' => 'Dane'))); ?>
<?php $this->Combinator->add_libs('js', 'Dane.bdl-select'); ?>

<div class="row">
    <form id="filters_form" data-expand="<?= $expand_dimension ?>" class="bdl-select col-xs-12">
        <div class="ul row">
            <? foreach ($dims as $key => $d) {
                if ($key != $expand_dimension) {
                    ?>
                    <div class="li col-xs-11 col-sm-6 col-md-3">
                        <p class="label"><? if( !isset($dimension) ) {?><a class="link-discrete" href="<?= $object->getUrl() ?>?i=<?= $key ?>"><? } ?> <?= $d['label'] ?><? if( !isset($dimension) ) {?></a><? } ?>:</p>

                        <p class="value">
                            <select onchange="document.getElementById('filters_form').submit();"
                                    name="d<?= $d['order'] ?>">
                                <? foreach ($d['options'] as $o) { ?>
                                    <option<? if (@$o['selected'] == true) { ?> selected="selected"<?php } ?>
                                        value="<?= $o['id'] ?>"><?= $o['value'] ?></option>
                                <? } ?>
                            </select>
                        </p>
                    </div>
                <? } elseif (isset($redirect) && $redirect) { ?>
                    <div class="li" style="display: none;">
                        <p class="label"><?= $d['label'] ?>:</p>

                        <p class="value">
                            <select onchange="document.getElementById('filters_form').submit();"
                                    name="d<?= $d['order'] ?>">
                                <? foreach ($d['options'] as $o) { ?>
                                    <option<? if (@$o['selected'] == true) { ?> selected="selected"<?php } ?>
                                        value="<?= $o['id'] ?>"><?= $o['value'] ?></option>
                                <? } ?>
                            </select>
                            <input name="d" value="1"/>
                        </p>
                    </div>
                <? } ?>
            <? } ?>
        </div>
    </form>
</div>
