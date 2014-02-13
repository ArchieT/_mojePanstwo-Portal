<?
if (!isset($left_column_width))
    $left_column_width = 10;

if (!isset($right_column_width))
    $right_column_width = 2;
?>
<div id="docsToolbar">
    <div class="toolbarSticker">
        <div class="container">
            <div class="row">
                <div class="toolbarActions col-md-<?= $left_column_width ?>">
                    <div class="docPages form-group">
                        <span
                            class="control-label"><?php echo __d('dane', 'LC_DANE_TOOLBAR_STRONA'); ?></span>
                        <input type="text" name="document_page" value="1" class="form-control"
                               autocomplete="off"/>
                        <span
                            class="control-label"><?php echo __d('dane', 'LC_DANE_TOOLBAR_STRONA_Z') . ' ' . $document->getPagesCount(); ?></span>
                    </div>
                    <?php if ($document->getPackagesCount() > 1) { ?>
                        <div class="docPagesAll">
                            <span><?php echo __d('dane', 'LC_DANE_TOOLBAR_LOADING_NEW'); ?></span>
                            <a href="#">
                                <?php echo __d('dane', 'LC_DANE_TOOLBAR_LOADING_ALL'); ?>
                            </a>
                        </div>
                    <?php } ?>
                    <div class="docDownload">
                        <a class="btn btn-default"
                           href="//sejmometr.pl/doc/<?php echo $document->getId(); ?>"><?php echo __d('dane', 'LC_DANE_TOOLBAR_DOWNLOAD'); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>