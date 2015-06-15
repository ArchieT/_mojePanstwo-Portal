<?php $this->Combinator->add_libs('css', $this->Less->css('view-gminy', array('plugin' => 'Dane'))); ?>
<?php $this->Combinator->add_libs('css', $this->Less->css('dataobjectslider', array('plugin' => 'Dane'))) ?>
<?php $this->Combinator->add_libs('css', $this->Less->css('DataBrowser', array('plugin' => 'Dane'))); ?>
<?php $this->Combinator->add_libs('js', '../plugins/highcharts/js/highcharts'); ?>
<?php $this->Combinator->add_libs('js', '../plugins/highcharts/locals'); ?>
<?php $this->Combinator->add_libs('js', 'Dane.view-gminy'); ?>

<?php if ($object->getId() == '903') {
    $this->Combinator->add_libs('css', $this->Less->css('view-gminy-krakow', array('plugin' => 'Dane')));
    echo $this->Html->script('//maps.googleapis.com/maps/api/js?v=3.exp', array('block' => 'scriptBlock'));
    $this->Combinator->add_libs('js', 'Dane.view-gminy-krakow');
} ?>

<? echo $this->Element('dataobject/pageBegin'); ?>

<div class="objectsPage">

    <h1 class="subheader">Rada Miasta Kraków</h1>
	
	<? if (isset($_submenu) && !empty($_submenu)) { ?>
	    <div class="menuTabsCont">
	        <?
	        if (!isset($_submenu['base']))
	            $_submenu['base'] = $object->getUrl();
	        echo $this->Element('Dane.dataobject/menuTabs', array(
	            'menu' => $_submenu,
	        ));
	        ?>
	    </div>
	<? } ?>
	
    <? $options = array();
    if (isset($title))
        $options['title'] = $title;

    echo $this->Element('Dane.DataBrowser/browser', $options);
    ?>
</div>

<?= $this->Element('dataobject/pageEnd'); ?>
