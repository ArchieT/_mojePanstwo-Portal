<div class="objectRender col-xs-12 <?php echo $object->getDataset(); ?>" oid="<?php echo $object->getId() ?>">
    <div class="row">
        <div class="data col-xs-12">
            <div class="row">

                <div class="attachment col-xs-12 col-sm-3 text-center">
                    <?php if ($object->getUrl() != false) { ?>
                    <a class="thumb_cont" href="http://przejrzystykrakow.pl">
                        <?php } ?>
                        <img class="thumb" src="/dane/img/customObject/krakow/logo_pkrk.png"
                             alt="Logo <?= strip_tags($object->getTitle()) ?>" onerror="imgFixer(this)"/>
                        <?php if ($object->getUrl() != false) { ?>
                    </a>
                <?php } ?>
                </div>

                <div class="content col-xs-12 col-sm-9">

                    <<?= $titleTag ?> class="title trimTitle<? if ($bigTitle) { ?> big<? } ?>"
                    title="<?= htmlspecialchars($object->getShortTitle()) ?>"
                    data-trimlength="200">
                    <?php if (($object->getUrl() != false) && !empty($this->request)) { ?>
                    <a href="http://przejrzystykrakow.pl" title="<?= strip_tags($object->getTitle()) ?>">
                        <?php } ?>
                        Przejrzysty Kraków
                        <?php if (($object->getUrl() != false) && !empty($this->request)) { ?>
                    </a>
                <?php } ?>
                </<?= $titleTag ?>>

                <p class="header">
                    Program Przejrzysty Kraków, prowadzony przez <a href="/dane/krs_podmioty/325617">Fundację
                        Stańczyka</a>, ma na celu wieloaspektowy monitoring życia publicznego w Krakowie. W ramach
                    programu prowadzony jest obecnie monitoring Rady Miasta i Dzielnic Krakowa.
                </p>

            </div>

        </div>
    </div>
</div>
</div>
