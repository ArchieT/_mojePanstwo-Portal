<?
$this->Combinator->add_libs('css', $this->Less->css('media', array('plugin' => 'Media')));
$this->Combinator->add_libs('js', 'jquery-tags-cloud-min');
$this->Combinator->add_libs('js', 'Media.media');
?>



<div id="media">
    <? include('templates/pages/media.ctp'); ?>
    <? include('templates/pages/prawo.ctp'); ?>
    <? include('templates/pages/kontrowersje.ctp'); ?>
    <? include('templates/pages/wnioski.ctp'); ?>
    <? include('templates/pages/ofundacji.ctp'); ?>
    <? include('templates/pages/dodatek_najpopularniejsi.ctp'); ?>
</div>