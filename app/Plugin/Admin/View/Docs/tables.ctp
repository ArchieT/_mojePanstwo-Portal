<?
$this->Combinator->add_libs('js', 'Admin.doctable');
?><!DOCTYPE HTML>
<html lang="en">
    <head>
        <title>Document Tables</title>
        <?= $this->Html->css('../libs/bootstrap/3.3.4/css/bootstrap.min.css'); ?>
        <?= $this->Html->css($this->Less->css('docs-tables', array('plugin' => 'Admin'))); ?>
    </head>
    <body>
        <div class="doctable" data-doc="<?= htmlspecialchars($docJSON) ?>">
            <div class="preview"></div>
            <div class="toolbar">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-sm btn-primary saveDocTables">Zapisz</button>
                            <div class="btn-group pull-right viewSelect" data-toggle="buttons">
                                <label class="btn btn-sm btn-default active">
                                    <input type="radio" name="view" value="document" autocomplete="off" checked> Dokument
                                </label>
                                <label class="btn btn-sm btn-default">
                                    <input type="radio" name="view" value="data" autocomplete="off"> Dane
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?= $this->Html->script('../libs/jquery/2.1.4/jquery-2.1.4.min.js') ?>
        <?= $this->Html->script('../libs/bootstrap/3.3.4/js/bootstrap.min.js') ?>
        <?= $this->Combinator->scripts('js') ?>
    </body>
</html>
