<?php $this->Combinator->add_libs('css', $this->Less->css('letters', array('plugin' => 'Start'))) ?>
<?php $this->Combinator->add_libs('js', 'Start.letters.js') ?>

<?= $this->element('Start.pageBegin'); ?>

<? if (!$this->Session->read('Auth.User.id')) { ?>
    <div class="col-xs-12">
        <div class="alert-identity alert alert-dismissable alert-success">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <h4>Uwaga!</h4>

            <p>Nie jesteś zalogowany. Twoje pisma będą przechowywane na tym urządzeniu przez 24 godziny. <a
                    class="_specialCaseLoginButton" href="/login">Zaloguj się</a>, aby trwale przechowywać pisma na
                swoim koncie.</p>
        </div>
    </div>
<? } ?>

<ul class="breadcrumb">
  <li><a href="/moje-kolekcje">Moje Pisma</a></li>
  <li class="active">Tworzenie nowego pisma</li>
</ul>

<div class="well bs-component mp-form">
  <form action="/moje-pisma" method="post" class="form-horizontal">
  <input type="hidden" name="adresat_id"<?php if (!empty($pismo['adresat_id'])) {
        echo ' value="' . $pismo['adresat_id'] . '"';
    } ?>>
    <fieldset>      
       <legend>Wybierz szablon i adresata nowego pisma:</legend>
      <div class="form-group form-row">
        <label class="col-lg-2 control-label">Szablon</label>
        <div class="col-lg-10">
          <div class="radio">
                <input name="szablon_id" value="0" checked="" type="radio" id="brak">
                <label for="brak">Brak szablonu</label>
            </div>
            <div class="radio">
                <input id="wniosek_35" name="szablon_id" value="35"
                       type="radio"<?php if (!empty($pismo['szablon_id']) && $pismo['szablon_id'] == 35) {
                    echo ' checked';
                } ?>>
                <label for="wniosek_35">Wniosek o udostępnienie informacji publicznej</label>
            </div>
            <div class="radio">
                <input id="wniosek_40" name="szablon_id" value="40"
                       type="radio"<?php if (!empty($pismo['szablon_id']) && $pismo['szablon_id'] == 40) {
                    echo ' checked';
                } ?>>
                <label for="wniosek_40">Skarga na bezczynność organu</label>
            </div>
            <div class="radio">
                <input id="wniosek_82" name="szablon_id" value="82"
                       type="radio"<?php if (!empty($pismo['szablon_id']) && $pismo['szablon_id'] == 82) {
                    echo ' checked';
                } ?>>
                <label for="wniosek_82">Petycja</label>
            </div>
            <?php if (!empty($pismo['szablon_id']) && $pismo['szablon_id'] != 35 && $pismo['szablon_id'] != 40) { ?>
                <div class="radio">
                    <input id="wniosek_<?php echo $pismo['szablon_id'] ?>" name="szablon_id"
                           value="<?php echo $pismo['szablon_id'] ?>" type="radio" checked="checked">
                    <label for="wniosek_<?php echo $pismo['szablon_id'] ?>"><?php echo $pismo['nazwa'] ?></label>
                </div>
            <?php }; ?>
			
			<? /*
            <div class="radio templates_browser">
                <a href="#" class="pisma-list-button pisma-list-button-no-jump">Zobacz wszystkie szablony &raquo;</a>
            </div>
            */ ?>
        </div>
      </div>
      <div class="form-group form-row">
        <label for="inputEmail" class="col-lg-2 control-label">Adresat</label>
        <div class="col-lg-10">
          <div class="suggesterBlockPisma">
                <?= $this->element('Start.letters-searcher', array('q' => '', 'dataset' => 'pisma_adresaci', 'placeholder' => 'Zacznij pisać aby znaleźć adresata...')) ?>
            </div>
            <span
                class="help-block">Na podstawie wybranego adresata, uzupełnimy dane teleadresowe w Twoim piśmie.</span>
        </div>
      </div>
      <div class="form-group form-row">
        <div class="col-lg-10 col-lg-offset-2">
          <button type="submit" class="createBtn btn btn-md btn-primary btn-icon"><i
            class="icon glyphicon glyphicon-pencil"></i>Stwórz pismo
	      </button>
        </div>
      </div>
    </fieldset>
  </form>
</div>


<?= $this->element('Start.pageEnd'); ?>
