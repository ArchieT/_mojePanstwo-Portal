<?
echo $this->Combinator->add_libs('css', $this->Less->css('view-gminy', array('plugin' => 'Dane')));
if ($object->getId() == '903') {
    $this->Combinator->add_libs('css', $this->Less->css('view-gminy-krakow', array('plugin' => 'Dane')));
}

echo $this->Element('dataobject/pageBegin', array(
    'titleTag' => 'p',
));

echo $this->Element('Dane.dataobject/subobject', array(
    'object' => $umowa,
    'objectOptions' => array(
        'bigTitle' => true,
    )
));
?>

<div class="row">
	<div class="col-sm-9">
		
		<?= $this->Document->place($umowa->getData('dokument_id')) ?>
		
	</div>
</div>

<?
echo $this->Element('dataobject/pageEnd');