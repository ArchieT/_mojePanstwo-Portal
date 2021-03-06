<?
$this->Combinator->add_libs('css', $this->Less->css('htmlexDocMain_v2'));
$this->Combinator->add_libs('css', $this->Less->css('doc'));
$this->Combinator->add_libs('js', 'Docs/edit');
$this->Combinator->add_libs('css', $this->Less->css('Docs/edit'));
?>
<div class="navbar navbar-fixed-top ">
    <div class="middle nav navbar-nav navbar-right">
        <div class="docs-toolbar" role="toolbar">
            <button type="button" class="btn btn-lg btn-primary load-all"><span
                class="glyphicon glyphicon-save"></span></button>
            <button type="button" class="btn btn-lg btn-primary check-main"><span
                    class="glyphicon glyphicon-unchecked altcheckbox" id="checkbox-main"></span><span
                    class="btn-counter checked-counter">0</span></button>
            <div class="btn-group">
                <button type="button" class="btn btn-lg btn-primary rotate-left-main"
                        aria-label="rotate-left">
                    <i
                        class="fa fa-undo"></i></button>
                <button type="button" class="btn btn-lg btn-primary rotate-right-main"
                        aria-label="rotate-right"><i
                        class="fa fa-repeat"></i></button>
            </div>
            <div class="dropdown spistresci-menu">
                <button type="button" class="btn btn-lg btn-primary dropdown-toggle"
                        id="spis_tresci_dokumentu"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span
                        class="glyphicon glyphicon-list"></span> <span class="caret"></span><span
                        class="btn-counter bookmark-counter">
                        <? if (isset($bookmarks)) {
                            echo count($bookmarks);
                        } else { ?>
                            0
                        <? } ?></span></button>
                </button>
                <ul class="dropdown-menu spistresci" aria-labelledby="spis_tresci_dokumentu">
                    <? if (isset($bookmarks)){
                    foreach ($bookmarks as $key => $bookmark){
                    ?>
                    <li><a href='#pf<?= $key ?>' class="<?= $key ?>"><?= $bookmark['tytul'] ?></a></li>
                        <?
                        }
                        } ?>
                </ul>
            </div>


            <button type="button" class="btn btn-lg btn-success save-doc"><span
                    class="glyphicon glyphicon-ok"></span></button>
            <button type="button" class="btn btn-lg btn-danger cancel-changes"><span
                    class="glyphicon glyphicon-remove"></span></button>
        </div>
    </div>
</div>

<div class="container">

    <h1><?= $doc['Document']['filename'] ?></h1>

    <div class="row objectsPage">

        <div class="col-md-2">

            <ul class="fields">
                <li>
                    <p class="_label">Extension</p>

                    <p class="_value"><?= $doc['Document']['fileextension'] ?></p>
                </li>
                <li>
                    <p class="_label">Size</p>

                    <p class="_value"><?= human_filesize($doc['Document']['filesize']) ?></p>
                </li>
                <li>
                    <p class="_label">Pages</p>

                    <p class="_value"><?= $doc['Document']['pages_count'] ?></p>
                </li>
                <li>
                    <p class="_label">Packages</p>

                    <p class="_value"><?= $doc['Document']['packages_count'] ?></p>
                </li>
                <li>
                    <p class="_label">CSS</p>

                    <p class="_value"><a
                            href="http://mojepanstwo.pl/htmlex/<?= $doc['Document']['id'] ?>/<?= $doc['Document']['id'] ?>.css"
                            target="_blank">LINK</a></p>
                </li>
                <li>
                    <p class="_label">Source</p>

                    <p class="_value"><a href="<?= $doc['Document']['url'] ?>" target="_blank">LINK</a></p>
                </li>


            </ul>

        </div>
        <div class="col-md-10 objectsPageContent">
            <div class="row">
                <?= $this->Document->place($doc['Document']['id']) ?>
            </div>
        </div>
    </div>
</div>

<div id="document_bookmark_modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"
                        aria-hidden="true">&times;</button>
                <h2 class="modal-title">Dodaj/Edytuj zakładkę</h2>
            </div>
            <div class="modal-body">
                <div class="col-sm-11">
                    <div class="row">
                        <div class="col-sm-2"><label class="">Tytuł:</label></div>
                        <div class="col-sm-10"><input class="form-control bookmark-title" value=""></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2"><label>Opis:</label></div>
                        <div class="col-sm-10"><input class="form-control bookmark-desc" value=""></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-md btn-primary btn-icon" id="bookmark-save-btn"><i
                        class="icon glyphicon glyphicon-ok"></i>Zapisz
                </button>
                <a class="cancel-modal" data-dismiss="modal">Anuluj</a>
            </div>
        </div>
    </div>
</div>
<div class="hidden" data-name="bookmarks-list" data-value='<?= json_encode($bookmarks) ?>'>
            </div>


