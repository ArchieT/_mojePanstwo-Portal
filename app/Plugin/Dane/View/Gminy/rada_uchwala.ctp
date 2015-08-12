<?
echo $this->Combinator->add_libs('css', $this->Less->css('view-gminy', array('plugin' => 'Dane')));
if ($object->getId() == '903') {
    $this->Combinator->add_libs('css', $this->Less->css('view-gminy-krakow', array('plugin' => 'Dane')));
}

echo $this->Element('dataobject/pageBegin', array(
    'titleTag' => 'p',
));

echo $this->Element('Dane.dataobject/subobject', array(
    'menu' => isset($_submenu) ? $_submenu : false,
    'object' => $uchwala,
    'objectOptions' => array(
        'bigTitle' => true,
        'truncate' => 1024,
    )
));

$docs = $uchwala->getLayer('docs');

?>
    <div class="prawo margin-sides-10">


            <div class="row">
				
				<div class="col-md-10">

                    <?= $this->Document->place(
                        isset($dokument_id) && $dokument_id ?
                            $dokument_id : $uchwala->getData('dokument_id')
                    ) ?>
                </div>
				
                <div class="col-md-2">
					
					<? if( count($docs)>1 ) {?> 
                    <p>Pliki powiązane:</p>

                    <ul class="nav nav-pills nav-stacked">
                        <?php foreach($docs as $i => $doc_id) { ?>
                            <? $dokument_id = ($file == ($i + 1)) ? $doc_id : false; ?>
                            <li role="presentation" <?= ($file == ($i + 1)) ? 'class="active"' : ''; ?>>
                                <a href="<?= $uchwala->getUrl() ?>?file=<?= ($i + 1) ?>">
                                    Plik #<?= ($i + 1) ?>
                                </a>
                            </li>
                        <? } ?>
                    </ul>
                    <? } ?>
                    
                    <p class="margin-sides-5 margin-top-10"><a href="http://www.bip.krakow.pl/?dok_id=167&sub_dok_id=167&sub=uchwala&query=id=<?= $uchwala->getData('sid') ?>&typ=u" target="_blank"><span class="glyphicon glyphicon-share"></span> Źródło</a></p>
                    
                </div>

                

            </div>

        


    </div>
<?
echo $this->Element('dataobject/pageEnd');