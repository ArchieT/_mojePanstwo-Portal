<div class="row-blocks">
    <div class="block-group col-xs-12">
        <? if (
            (
                ($details['oferty_data_stop']) &&
                ($details['oferty_data_stop'] != '0000-00-00')
            ) ||
            @$details['oferty_miejsce']
        ) {
            ?>

            <div class="block">
                <div class="block-header">
                    <h2 class="label">Składanie ofert</h2>
                </div>

                <div class="content">
                    <div class="textBlock">
                        <p>Oferty można składać do
                            <strong><?= $this->Czas->dataSlownie($details['oferty_data_stop']) ?></strong>, do
                            godziny
                            <strong><?= $details['oferty_godz'] ?></strong><? if (@$details['oferty_miejsce']) { ?>, w:<? } ?>
                        </p>
                        <? if (@$details['oferty_miejsce']) { ?><p><?= $details['oferty_miejsce'] ?></p><? } ?>
                    </div>
                </div>

            </div>

        <? } ?>


        <? if (@$details['siwz_www'] || @$details['siwz_adres']) { ?>
            <div class="block">
                <div class="block-header">
                    <h2 class="label">Specyfikacja Istotnych Warunków Zamówienia</h2>
                </div>

                <div class="content">
                    <div class="textBlock">
                        <? if (@$details['siwz_www']) { ?><p><a target="_blank"
                                                                href="<?= $details['siwz_www'] ?>"><?= $details['siwz_www'] ?></a>
                            </p><? } ?>
                        <? if (@$details['siwz_adres']) { ?><p><?= $details['siwz_adres'] ?></p><? } ?>
                    </div>
                </div>

            </div>
        <? } ?>

        <? if ($details['przedmiot']) { ?>
            <div class="block">
                <div class="block-header">
                    <h2 class="label">Przedmiot zamówienia</h2>
                </div>
                <div class="content">
                    <div><?php echo(nl2br($details['przedmiot'])); ?></div>
                </div>
            </div>
        <? } ?>

        <?
        foreach ($text_details as $key => $value) {
            if ($value) {
                ?>
                <div class="block">
                    <div class="block-header">
                        <h2 class="label"><?php echo __d('dane', __('LC_DANE_VIEW_ZAMOWIENIAPUBLICZNE_' . $key)); ?></h2>
                    </div>

                    <div class="content">
                        <div><?php echo(nl2br($value)); ?></div>
                    </div>
                </div>
                <?
            }
        } ?>
    </div>
</div>
