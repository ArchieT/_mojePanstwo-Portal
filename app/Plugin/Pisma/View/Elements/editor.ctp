<?php echo $this->Html->css('../plugins/bootstrap3-wysiwyg/dist/bootstrap3-wysihtml5.min', array('block' => 'cssBlock')); ?>

<?php echo $this->Html->script('../plugins/bootstrap3-wysiwyg/dist/bootstrap3-wysihtml5.all', array('block' => 'scriptBlock')); ?>
<?php echo $this->Html->script('../plugins/bootstrap3-wysiwyg/dist/locales/bootstrap-wysihtml5.pl-PL', array('block' => 'scriptBlock')); ?>

<?php $this->Combinator->add_libs('css', $this->Less->css('pisma', array('plugin' => 'Pisma'))) ?>
<?php $this->Combinator->add_libs('js', 'Pisma.jquery.autosize.min.js') ?>
<?php $this->Combinator->add_libs('js', 'Pisma.jquery_steps.js') ?>
<?php $this->Combinator->add_libs('js', 'Pisma.pisma.js') ?>

<?php
if (!empty($pismo['szablon_id'])) $pismo_init['szablon_id'] = $pismo['szablon_id'];
if (!empty($pismo['adresat_id'])) $pismo_init['adresat_id'] = $pismo['adresat_id'];
?>


<div id="stepper"<? if (!empty($pismo_init)) echo ' data-pismo=' . json_encode($pismo_init); ?>>

    <h2>Wybierz szablon pisma</h2>
    <section>

        <div class="container szablony">

            <div class="col-xs-12 col-md-10 col-md-offset-1">

                <p class="hint-title">Wybierz szablon, aby ułatwić tworzenie pisma. Na podstawie wybranego szablonu,
                    umieścimy w Twoim piśmie odpowiednie formułki prawne i inne informacje. Jeśli nie chcesz
                    wybierać szablonu - przejdź dalej.</p>

                <div id="chosen-template" class="block" style="display: none;">
                    <div class="block-header">
                        <h2 class="label pull-left">Wybrany szablon</h2>

                        <div class="pull-right">
                            <button class="btn btn-danger btn-xs">Usuń wybór</button>
                        </div>
                    </div>
                    <div class="content">
                        <ul class="ul-raw"></ul>
                    </div>
                </div>
				
				<? foreach( $templatesGroups as $group ) { ?>
                <div class="block search ">
                    <div class="block-header">
                        <h2 class="label"><?= $group['nazwa'] ?></h2>
                    </div>
                    <div class="list content">
                        <ul class="ul-raw">
                            <? 
                            foreach ($group['templates'] as $template) {
                                ?>
                                <li data-id="<?= $template['id'] ?>"
                                    data-title="<?= addslashes($template['nazwa']) ?>" class="row">
                                    <div class="pull-left col-md-11">
                                        <p class="title"><a href="/dane/pisma_szablony/<?= $template['id'] ?>"><?= $template['nazwa'] ?></a></p>
                                        <p style="display: none;" class="desc"><?= $template['opis'] ?></p>
                                    </div>
                                    <div class="pull-right  col-md-1">
                                        <button class="btn btn-success btn-xs">Wybierz</button>
                                    </div>
                                </li>
                            <? } ?>
                        </ul>
                    </div>
                </div>
                <? } ?>

            </div>

        </div>

    </section>

    <h2>Wybierz adresata</h2>
    <section>

        <div class="container adresaci">

            <div class="col-xs-12 col-md-10 col-md-offset-1">

                <p class="hint-title">Wybierz adresata, do którego chcesz napisać. To pozwoli automatycznie wypełnić
                    dane teleadresowe w Twoim piśmie.</p>

                <div id="chosen-addressee" class="block" style="display: none;">
                    <div class="block-header">
                        <h2 class="label pull-left">Wybrany adresat</h2>

                        <div class="pull-right">
                            <button class="btn btn-danger btn-xs">Usuń wybór</button>
                        </div>
                    </div>
                    <div class="content">
                        <ul class="ul-raw"></ul>
                    </div>
                </div>

                <div class="block">
                    <div class="block-header">
                        <input class="search" type="text" name="adresat" placeholder="Szukaj adresata..."/>
                    </div>
                    <div class="list content" style="display: none"></div>
                </div>

            </div>

        </div>

    </section>

    <h2>Wpisz treść</h2>
    <section>
        <div class="container edit">

            <div class="row">
                <div class="col-xs-12 col-md-10">
                    <? echo $this->Element('Pisma.render'); ?>
                </div>
                <div class="col-xs-12 col-md-2">
                    <div class="editor-tooltip">

                        <div class="hints alert alert-info" style="margin-top: 40px;">
                            <ul>
                                <li>Skup się</li>
                                <li>Pisz zwięźle</li>
                                <li>Nie obrażaj</li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>

    <h2>Zapisz i wyślij</h2>
    <section>
        <div class="container preview">

            <div class="col-xs-12 col-md-10 col-md-offset-1">
				<p class="hint-title">To jest Twoje gotowe pismo! Możesz je teraz wysłać do adresata lub tylko zapisać. <br/>Twoje pismo jest prywatne - tylko Ty masz do niego dostęp. Po zapisaniu, będziesz mógł je zanonimizować i upublicznić.</p>
			</div>
			
            <form id="finalForm" action="/pisma/nowe" method="post">
                <input name="miejscowosc" type="hidden" maxlength="127"/>
                <input name="data_pisma" type="hidden" maxlength="10"/>
                <textarea name="nadawca" class="hide" maxlength="511"></textarea>
                <input name="adresat_id" type="hidden"/>
                <input name="adresat" type="hidden" maxlength="511"/>
                <input name="szablon_id" type="hidden"/>
                <input name="tytul" type="hidden" maxlength="511"/>
                <input name="tresc" type="hidden"/>
                <textarea class="hide" name="podpis" maxlength="255"/></textarea>
                <input name="nazwa" type="hidden" value="Nowe pismo"/>
				
				<? /*
                <div class="row">
                    <div class="col-xs-12 col-md-10">
                        <fieldset>
                            <div class="form-group">
                                <label for="inputTtitle" class="col-lg-2 control-label">Nazwa pisma</label>

                                <div class="col-lg-10">
                                    <input name="nazwa" class="form-control" id="inputTtitle" autocomplete="off"
                                           maxlength="255" required="required"
                                           type="text"<?php if (!empty($pismo['nazwa'])) echo ' value="' . $pismo['nazwa'] . '"' ?>>

                                    <p class="desc">Adresat pisma nie zobaczy powyższego tytułu. Będzie on używany tylko
                                        do organizacji Twoich pism.</p>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
                */ ?>

                <div class="row previewRender">
                    <div class="col-xs-12 col-md-10">
                        <div id="editor-cont" class="loading"></div>
                    </div>
                    <div class="col-xs-12 col-md-2">
                        <div class="editor-tooltip">

                            <ul class="form-buttons">
                                <li class="inner-addon">
                                    <i class="glyphicon glyphicon-send"></i>
                                    <input type="submit" name="send" value="Zapisz i wyślij"
                                           class="btn btn-primary"/>
                                </li>
                                <li class="inner-addon">
                                    <i class="glyphicon glyphicon-saved"></i>
                                    <input type="submit" name="save" value="Zapisz" class="btn btn-primary"/>
                                </li>
                                <li class="inner-addon">
                                    <i class="glyphicon glyphicon-print"></i>
                                    <input type="submit" name="print" value="Wydrukuj" class="btn btn-primary"/>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
