<?

$hlFields = array('data_wejscia_w_zycie');
$forceLabel = false;

$thumbSize = 2;
$size = 2;

if ($object->getThumbnailUrl($thumbSize)) {
    ?>

    <div class="attachment col-xs-<?= $size + 1 ?> col-sm-<?= $size ?> text-center">
        <?php if ($object->getUrl() != false) { ?>
    <?php if ($object->getData('dokument_id')) { ?>
        <span class="glyphicon glyphicon-search documentFastCheck" aria-hidden="true"
              data-documentid="<?= $object->getData('dokument_id'); ?>" data-toogle="modal"
              data-target="#documentFastCheckModal"></span>
    <?php } ?>
        <a class="thumb_cont" href="<?= $object->getUrl() ?>/tresc">
            <?php } ?>
            <object data="/error/brak.gif" type="image/png">
                <img class="thumb pull-right" src="<?= $object->getThumbnailUrl($thumbSize) ?>"
                     alt="<?= strip_tags($object->getTitle()) ?>"/>
            </object>
            <?php if ($object->getUrl() != false) { ?>
        </a>
    <?php } ?>

    </div>
    <div class="content col-xs-<?= 12 - $size - 1 ?> col-md-<?= 12 - $size ?>">


        <? if ($object->force_hl_fields || $forceLabel) { ?>
            <p class="header">
                <?= $object->getLabel(); ?>
            </p>
        <? } ?>

        <p class="title">
            <?php if ($object->getUrl() != false) { ?>
            <a href="<?= $object->getUrl() ?>/tresc" title="<?= strip_tags($object->getTitle()) ?>">
                <?php } ?>
                <?= $object->getData('sygnatura') ?>
                <?php if ($object->getUrl() != false) { ?>
            </a> <?
        }
        if ($object->getTitleAddon()) {
            echo '<small>' . $object->getTitleAddon() . '</small>';
        } ?>
        </p>


        <?= $this->Dataobject->highlights($hlFields, $hlFieldsPush, $defaults) ?>


    </div>
<? } ?>