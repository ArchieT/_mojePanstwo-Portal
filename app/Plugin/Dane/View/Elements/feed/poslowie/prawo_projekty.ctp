<?

$hlFields = array('autorzy_html');


$thumbSize = 2;
$size = 2;

if ($object->getThumbnailUrl($thumbSize)) {
?>

    <div class="attachment col-md-<?= $size ?> text-center">
        <?php if ($object->getUrl() != false) { ?>
        <a class="thumb_cont" href="<?= $object->getUrl() ?>">
            <?php } ?>
            <img class="thumb pull-right" onerror="imgFixer(this)"
                 src="<?= $object->getThumbnailUrl($thumbSize) ?>"
                 alt="<?= strip_tags($object->getTitle()) ?>"/>
            <?php if ($object->getUrl() != false) { ?>
        </a>
    <?php } ?>

    </div>
    <div class="content col-md-<?= 12 - $size ?>">


        <? if ($object->force_hl_fields || $forceLabel) { ?>
            <p class="header">
                <?= $object->getLabel(); ?>
            </p>
        <? } ?>

        <p class="title">
            <?php if ($object->getUrl() != false) { ?>
            <a href="<?= $object->getUrl() ?>" title="<?= strip_tags($object->getTitle()) ?>">
                <?php } ?>
                <?= $this->Text->truncate($object->getShortTitle(), 200) ?>
                <?php if ($object->getUrl() != false) { ?>
            </a> <?
        }
        if ($object->getTitleAddon()) {
            echo '<small>' . $object->getTitleAddon() . '</small>';
        } ?>
        </p>
        
        <?= $this->Dataobject->highlights($hlFields, $hlFieldsPush, $defaults) ?>

        <? if ($object->getDescription()) { ?>
            <div class="description">
                <?= $object->getDescription() ?>
            </div>
        <? } ?>

    </div>

<? } else { ?>
    <div class="content<? if ($object->getPosition()) { ?> col-md-11<? } ?>">


        <? if ($object->force_hl_fields || $forceLabel) { ?>
            <p class="header">
                <?= $object->getLabel(); ?>
            </p>
        <? } ?>

        <p class="title">
            <?php if ($object->getUrl() != false){ ?>
            <a href="<?= $object->getUrl() ?>" title="<?= strip_tags($object->getTitle()) ?>">
                <?php } ?>
                <?= $object->getShortTitle() ?>
                <?php if ($object->getUrl() != false){ ?>
            </a> <?
        }
        if ($object->getTitleAddon()) {
            echo '<small>' . $object->getTitleAddon() . '</small>';
        } ?>
        </p>
        
        <?= $this->Dataobject->highlights($hlFields, $hlFieldsPush, $defaults) ?>

        <? if ($object->getDescription()) { ?>
            <div class="description">
                <?= $this->Text->truncate($object->getDescription(), 250) ?>
            </div>
        <? } ?>

    </div>
<? } ?>