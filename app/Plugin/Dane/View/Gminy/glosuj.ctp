<?
$this->Combinator->add_libs('css', $this->Less->css('dataobject', array('plugin' => 'Dane')));
$this->Combinator->add_libs('css', $this->Less->css('dataobjectpage', array('plugin' => 'Dane')));
$this->Combinator->add_libs('css', $this->Less->css('DataBrowser', array('plugin' => 'Dane')));
echo $this->Combinator->add_libs('css', $this->Less->css('view-gminy', array('plugin' => 'Dane')));
$this->Combinator->add_libs('css', $this->Less->css('view-gminy-krakow', array('plugin' => 'Dane')));
$this->Combinator->add_libs('js', '../plugins/highstock/js/highstock');
$this->Combinator->add_libs('js', '../plugins/highstock/locals');
$this->Combinator->add_libs('js', 'Dane.view-gminy-krakow-aktywnosci');
echo $this->Element('dataobject/pageBegin', array(
    'titleTag' => 'p',
)); ?>

    <h1 class="subheader">Głosuj</h1>

    <div class="row">
        <div class="col-md-12">
            <? if(isset($vote) && isset($completed) && $completed === true) { ?>

                Zakończono głosowanie!
                <a href="?reset">Reset</a>

            <? } elseif(isset($vote)) { ?>

                <div class="alert alert-info" role="alert">
                    Nie zakończyłeś/aś jeszcze głosować.
                    Potrzebujemy co najmniej 10 głosów.
                    <a class="alert-link" href="<?= (isset($domainMode) && $domainMode == 'MP' ? '/dane/gminy/903,krakow/druki/' . $next : '/druki/' . $next) ?>">
                        Przejdź do następnego projektu
                    </a>
                    aby kontynuować lub <a class="alert-link" href="?reset">rozpocznij od nowa</a>.
                </div>

            <? } else { ?>
                <p>Zagłosuj na 10 ostatnich projektów uchwał i zobacz do którego radnego jest Ci najbliżej!</p>
                <form action="" method="post">
                    <input class="btn btn-primary" type="submit" value="Start" name="start"/>
                </form>
            <? } ?>
        </div>
    </div>


<?= $this->Element('dataobject/pageEnd');