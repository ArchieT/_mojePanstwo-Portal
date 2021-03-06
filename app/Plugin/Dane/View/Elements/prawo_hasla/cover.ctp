<?
$this->Combinator->add_libs('css', $this->Less->css('zamowienia', array('plugin' => 'ZamowieniaPubliczne')));
$this->Combinator->add_libs('js', '../plugins/highstock/js/highstock');
$this->Combinator->add_libs('js', '../plugins/highstock/locals');
$this->Combinator->add_libs('js', 'Dane.DataBrowser.js');

$options = array(
    'mode' => 'init',
);
?>
<div class="row margin-top-10">
<div class="col-md-9">
	
	
	<div class="appBanner margin-top--25 margin-bottom-30">
        <form method="get" action="<?= $object->getUrl() ?>/wszystkie">
            <div class="appSearch form-group">
                <div class="input-group">
                    <input name="q" class="form-control" placeholder="Szukaj w tym temacie..." type="text">
					<span class="input-group-btn">
						<button type="submit" class="btn btn-primary input-md">
                            <span class="glyphicon glyphicon-search"></span>
                        </button>
					</span>
                </div>
            </div>
        </form>
    </div>
	
    <? if (@$dataBrowser['aggs']['prawo']['ustawy']['top']['hits']['hits']) { ?>
        <div class="block block-simple">
            <header>
	            <a class="link-discrete" href="<?= $object->getUrl() ?>/ustawy">Ustawy</a>
	            <p class="search_counter"><?= pl_dopelniacz($dataBrowser['aggs']['prawo']['ustawy']['doc_count'], 'wynik', 'wyniki', 'wyników') ?></p>
            </header>
            <section class="aggs-init">

                <div class="dataAggs">
                    <div class="agg agg-Dataobjects">
                        <? if ($dataBrowser['aggs']['prawo']['ustawy']['top']['hits']['hits']) { ?>
                            <ul class="dataobjects margin-sides-10">
                                <? foreach ($dataBrowser['aggs']['prawo']['ustawy']['top']['hits']['hits'] as $doc) { ?>
                                    <li class="margin-bottom-10">
                                        <?
                                        echo $this->Dataobject->render($doc, 'default');
                                        ?>
                                    </li>
                                <? } ?>
                            </ul>
                            <div class="buttons text-center margin-top-10">
                                <a href="<?= $object->getUrl() ?>/ustawy" class="btn btn-primary btn-xs">Więcej ustaw &raquo;</a>
                            </div>
                        <? } ?>

                    </div>
                </div>
            </section>
        </div>
    <? } ?>

    <? if (@$dataBrowser['aggs']['prawo']['rozporzadzenia']['top']['hits']['hits']) { ?>
        <div class="block block-simple">
            <header>
	            <a class="link-discrete" href="<?= $object->getUrl() ?>/rozporzadzenia">Rozporządzenia</a>
	            <p class="search_counter"><?= pl_dopelniacz($dataBrowser['aggs']['prawo']['rozporzadzenia']['doc_count'], 'wynik', 'wyniki', 'wyników') ?></p>
            </header>
            <section class="aggs-init">

                <div class="dataAggs">
                    <div class="agg agg-Dataobjects">
                        <? if ($dataBrowser['aggs']['prawo']['rozporzadzenia']['top']['hits']['hits']) { ?>
                            <ul class="dataobjects margin-sides-10">
                                <? foreach ($dataBrowser['aggs']['prawo']['rozporzadzenia']['top']['hits']['hits'] as $doc) { ?>
                                    <li class="margin-bottom-10">
                                        <?
                                        echo $this->Dataobject->render($doc, 'default');
                                        ?>
                                    </li>
                                <? } ?>
                            </ul>
                            <div class="buttons text-center margin-top-10">
                                <a href="<?= $object->getUrl() ?>/rozporzadzenia" class="btn btn-primary btn-xs">Więcej rozporządzeń &raquo;</a>
                            </div>
                        <? } ?>

                    </div>
                </div>
            </section>
        </div>
    <? } ?>

    <? if (@$dataBrowser['aggs']['prawo']['inne']['top']['hits']['hits']) { ?>
        <div class="block block-simple">
            <header>
	            <a class="link-discrete" href="<?= $object->getUrl() ?>/inne">Pozostałe akty prawne</a>
	            <p class="search_counter"><?= pl_dopelniacz($dataBrowser['aggs']['prawo']['inne']['doc_count'], 'wynik', 'wyniki', 'wyników') ?></p>
            </header>
            <section class="aggs-init">

                <div class="dataAggs">
                    <div class="agg agg-Dataobjects">
                        <? if ($dataBrowser['aggs']['prawo']['inne']['top']['hits']['hits']) { ?>
                            <ul class="dataobjects margin-sides-10">
                                <? foreach ($dataBrowser['aggs']['prawo']['inne']['top']['hits']['hits'] as $doc) { ?>
                                    <li class="margin-bottom-10">
                                        <?
                                        echo $this->Dataobject->render($doc, 'default');
                                        ?>
                                    </li>
                                <? } ?>
                            </ul>
                            <div class="buttons text-center margin-top-10">
                                <a href="<?= $object->getUrl() ?>/inne" class="btn btn-primary btn-xs">Pozostałe akty prawne &raquo;</a>
                            </div>
                        <? } ?>

                    </div>
                </div>
            </section>
        </div>
    <? } ?>

</div>
</div>
