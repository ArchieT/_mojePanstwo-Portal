<div class="objectRender<?= ($alertsStatus) ? " unreaded" : " readed"; ?>" oid="<?php echo $object->getId() ?>"
     gid="<?php echo $object->getGlobalId() ?>">
    <?
    $dictionary = array(
        '1' => array('Za', 'z'),
        '2' => array('Przeciw', 'p'),
        '3' => array('Wstrzymanie', 'w'),
        '4' => array('Nieobecność', 'n'),
    );

    $glos = $dictionary[$object->getData('glos_id')];
    ?>

    <div class="row">

        <div class="col-md-1 avatar">
            <a href="/dane/poslowie/<?= $object->getData('posel_id') ?>">
                <img src="http://resources.sejmometr.pl/mowcy/a/1/<?= $object->getData('mowca_id') ?>.jpg"
                     onerror="imgFixer(this)"/>
            </a>
        </div>
        <div class="col-md-8">
            <p class="title"><a
                    href="/dane/poslowie/<?= $object->getData('posel_id') ?>"><?= $object->getData('poslowie.nazwa') ?></a>
            </p>

            <p>
                <img alt="<?= $object->getData('sejm_kluby.nazwa') ?>"
                     src="http://resources.sejmometr.pl/s_kluby/<?= $object->getData('klub_id') ?>_a_t.png"
                     onerror="imgFixer(this)"/>
            </p>
        </div>
        <div class="col-md-3 text-right">
            <div class="voted btn btn-default btn-glos-<?= $object->getData('glos_id') ?>"
                 data-glos="<?= $object->getData('glos_id') ?>"><?= $glos[0] ?></div>
        </div>
    </div>
</div>
