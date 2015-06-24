<?
$file_exists = false;
if (isset($file)) {
    $path = App::path('Plugin');
    $file_exists = file_exists($path[0] . '/Dane/View/Elements/' . $file . '.ctp');
}

$shortTitle = (isset($options['forceTitle'])) ? $options['forceTitle'] : $object->getShortTitle();

if (in_array($object->getDataset(), array(
    'krakow_posiedzenia_punkty',
    'rady_gmin_debaty',
    'rady_gmin_wystapienia'
))) {
    $object_content_sizes = array(3, 9);
} else {
    $object_content_sizes = array(2, 10);
}

$this->Dataobject->setObject($object);
?>

<div class="objectRender<? if ($alertsStatus) {
    echo " unreaded";
} else {
    echo " readed";
} ?><? if ($classes = $object->getClasses()) {
    echo " " . implode(' ', $classes);
} ?>"
     oid="<?php echo $object->getId() ?>" gid="<?php echo $object->getGlobalId() ?>">

    <div class="row">
        <div class="col-xs-1 action text-center">
            <span class="<?php if ($object->getDataset() && $object->getAction()) {
                echo 'mpIcon icon-dataset-' . $object->getCreator('dataset') . ' icon-action-' . $object->getAction();
            } else {
                echo 'glyphicon glyphicon-volume-up';
            } ?>"></span>
        </div>
        <div class="data col-xs-11">
            <div class="feed-header">
                <? if ($object->getCreator('url')) { ?>
                    <div class="thumb_cont">
                        <img alt="<?= addslashes($object->getCreator('name')) ?>"
                             src="<?= $object->getCreator('url') ?>" class="thumb" onerror="imgFixer(this)"/>
                    </div>
                <? } ?>

                <div class="inner">
                    <? if ($sentence = $object->getSentence()) { ?>
                        <p class="sentence"><?= $sentence ?></p>
                        <p class="date"><?= $this->Czas->dataSlownie($object->getDate()) ?></p>
                    <? } ?>
                </div>
            </div>

            <div class="row marginTop-sm">
                <?
                if ($file_exists) {
                    echo $this->element('Dane.' . $file, array(
                        'object' => $object,
                        'hlFields' => $hlFields,
                        'hlFieldsPush' => $hlFieldsPush,
                        'defaults' => $defaults,
                    ));
                } else {
                    if ($object->getThumbnailUrl($thumbSize)) {
                        $size = $object_content_sizes[0];
                        if ($object->getPosition()) {
                            $size--;
                        }

                        ?>
                        <div
                            class="attachment col-xs-<?= $size + 2 ?> col-sm-<?= $size + 1 ?> col-sm-<?= $size ?> text-center">
                            <?php if ($object->getUrl() != false) { ?>
                            <a class="thumb_cont" href="<?= $object->getUrl() ?>">
                                <?php } ?>
                                <img class="thumb pull-right" src="<?= $object->getThumbnailUrl($thumbSize) ?>"
                                     alt="<?= strip_tags($object->getTitle()) ?>" onerror="imgFixer(this)"/>
                                <?php if ($object->getUrl() != false) { ?>
                            </a>
                        <?php } ?>
                        </div>
                        <div class="content col-md-<?= $object_content_sizes[1] ?>">

                            <? if ($alertsButtons) { ?>
                                <div class="alertsButtons pull-right">
                                    <input class="btn btn-xs read" type="button"
                                           value="<?php echo __d('powiadomienia', 'LC_POWIADOMIENIA_OPTIONS_ALERT_BUTTON_READ'); ?>"/>
                                    <input class="btn btn-xs unread" type="button"
                                           value="<?php echo __d('powiadomienia', 'LC_POWIADOMIENIA_OPTIONS_ALERT_BUTTON_UNREAD'); ?>"/>
                                </div>
                            <? } ?>

                            <? if ($object->force_hl_fields || $forceLabel) { ?>
                                <p class="header">
                                    <?= $object->getLabel(); ?>
                                </p>
                            <? } ?>

                            <p class="title">
                                <?php if ($object->getUrl() != false) { ?>
                                <a href="<?= $object->getUrl() ?>" title="<?= strip_tags($object->getTitle()) ?>">
                                    <?php } ?>
                                    <?= $this->Text->truncate($shortTitle, 200) ?>
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

                            <? if ($alertsButtons) { ?>
                                <div class="alertsButtons pull-right">
                                    <input class="btn btn-xs read" type="button"
                                           value="<?php echo __d('powiadomienia', 'LC_POWIADOMIENIA_OPTIONS_ALERT_BUTTON_READ'); ?>"/>
                                    <input class="btn btn-xs unread" type="button"
                                           value="<?php echo __d('powiadomienia', 'LC_POWIADOMIENIA_OPTIONS_ALERT_BUTTON_UNREAD'); ?>"/>
                                </div>
                            <? } ?>

                            <? if ($object->force_hl_fields || $forceLabel) { ?>
                                <p class="header">
                                    <?= $object->getLabel(); ?>
                                </p>
                            <? } ?>

                            <p class="title">
                                <?php if ($object->getUrl() != false){ ?>
                                <a href="<?= $object->getUrl() ?>" title="<?= strip_tags($object->getTitle()) ?>">
                                    <?php } ?>
                                    <?= $shortTitle ?>
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
                <? } ?>
            </div>
        </div>
    </div>
    <?php if ($object->hasHighlights() && $object->getHlText()) { ?>
        <div class="row">
            <div class="text-highlights alert alert-info">
                <?php echo(closetags($object->getHlText())); ?>
            </div>
        </div>
    <?php } ?>
</div>