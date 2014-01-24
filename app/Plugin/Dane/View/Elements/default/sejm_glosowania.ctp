<?php $this->Combinator->add_libs('js', 'highcharts/highcharts'); ?>
<?php $this->Combinator->add_libs('js', 'highcharts/locals'); ?>
<?php $this->Combinator->add_libs('js', 'highcharts/modules/exporting'); ?>
<?php $this->Combinator->add_libs('js', 'Dane.highcharts-sejmglosowania'); ?>

<?
$wynikiKlubowe = $object->loadLayer('wynikiKlubowe');
$chartData = array(
    array(
        'id' => 'z',
        'count' => $object->getData('z'),
        'label' => 'Za',
    ),
    array(
        'id' => 'p',
        'count' => $object->getData('p'),
        'label' => 'Przeciw',
    ),
    array(
        'id' => 'w',
        'count' => $object->getData('w'),
        'label' => 'Wstrzymania',
    ),
    array(
        'id' => 'n',
        'count' => $object->getData('n'),
        'label' => 'Nieobecności',
    ),
);
$dictionary = array(
    '1' => array('Za', 'z'),
    '2' => array('Przeciw', 'p'),
    '3' => array('Wstrzymanie', 'w'),
    '4' => array('Brak kworum', 'n'),
);
?>


<div class="row">
    <div class="content col-md-12">
        <p class="header">
            <?php echo __d('dane', 'LC_DANE_SEJM_GLOSOWANIA_VOTING', true); ?>
            <strong><?php echo $item['data']['numer'] ?></strong>
        </p>

        <p class="title">
            <a href="<?php echo $this->Html->url(array('plugin' => 'Dane', 'controller' => $item['dataset'], 'action' => 'view', 'id' => $item['object_id'])); ?>"
               title="<?php echo $item['data']['tytul'] ?>"><?php echo $item['data']['tytul'] ?></a>
        </p>

        <div class="row">
            <div class="col-md-4 sejm_glosowania">
                <p class="wynikGlosowania <?= $dictionary[$object->getData('wynik_id')][1]; ?> label"><?= $dictionary[$object->getData('wynik_id')][0]; ?></p>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <td><?php echo sprintf(__d('dane', 'LC_DANE_KLUBY_GLOSUJACE'), $dictionary[$object->getData('wynik_id')][0]); ?></td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($wynikiKlubowe[$object->getData('wynik_id')] as $wynik) { ?>
                        <tr>
                            <td>
                                <div class="col-md-3 text-center">
                                    <img class="kluby"
                                         src="http://resources.sejmometr.pl/s_kluby/<?php echo $wynik['klub_id']; ?>_a_t.png"/>
                                </div>
                                <div class="col-md-9">
                                    <a href="<?php echo $this->Html->url(array('plugin' => 'Dane', 'controller' => 'sejm_kluby', 'action' => 'view', 'id' => $wynik['klub_id'])); ?>">
                                        <?php echo $wynik['klub_nazwa']; ?>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="col-md-8">
                <div class="highchart" data-wynikiKlubowe='<?= json_encode($chartData) ?>'></div>
            </div>
        </div>
    </div>
</div>