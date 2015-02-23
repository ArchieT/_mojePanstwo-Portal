<?php $this->Combinator->add_libs('css', $this->Less->css('home')) ?>
<?php $this->Combinator->add_libs('js', 'home') ?>

<div id="home" class="fullPageHeight"
     style="background-image: url('/img/home/backgrounds/home-background-default.jpg')">
    <div class="_handler container">
        <div class="startWindow col-xs-12 col-md-10 col-md-offset-1">
            <div class="windowSet">
                <div class="basicOptions">
                    <div class="col-xs-12 col-sm-6 part">
                        <div class="observeBrick mainBrick">
                            <div class="title">Obserwuj</div>
                            <span class="line"></span>

                            <div class="description">
                                Lorem ipsum dolor sit amet enim. Etiam ullamcorper. Suspendisse a pellentesque dui, non
                                felis. Maecenas malesuada elit lectus felis, malesuada ultricies. Curabitur et ligula.
                            </div>
                            <div class="action">
                                <a href="/obserwuj" target="_self" class="btn btn-primary btn-lg">Zacznij obserwować</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 part">
                        <div class="shoutBrick mainBrick">
                            <div class="title">Komunikuj</div>
                            <span class="line"></span>

                            <div class="description">
                                Lorem ipsum dolor sit amet enim. Etiam ullamcorper. Suspendisse a pellentesque dui, non
                                felis. Maecenas malesuada elit lectus felis, malesuada ultricies. Curabitur et ligula.
                            </div>
                            <div class="action">
                                <a href="/pisma" target="_self" class="btn btn-primary btn-lg">Napisz pismo</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="popularApps">
                    <a class="homePageIcon col-xs-12 col-sm-3 col-md-2" href="/dane" target="_self">
                        <img class="svg" alt="Dane" src="/dane/icon/dane.svg">

                        <p>Dane</p>
                    </a>
                    <a class="homePageIcon col-xs-12 col-sm-3 col-md-2" href="/kto_tu_rzadzi" target="_self">
                        <img class="svg" alt="Kto tu rządzi?" src="/KtoTuRzadzi/icon/kto_tu_rzadzi.svg">

                        <p>Kto tu rządzi?</p>
                    </a>
                    <a class="homePageIcon col-xs-12 col-sm-3 col-md-2" href="/krs" target="_self">
                        <img class="svg" alt="Krajowy Rejestr Sądowy" src="/krs/icon/krs.svg">

                        <p>Krajowy Rejestr Sądowy</p>
                    </a>
                    <a class="homePageIcon col-xs-12 col-sm-3 col-md-2" href="/prawo" target="_self">
                        <img class="svg" alt="Prawo" src="/prawo/icon/prawo.svg">

                        <p>Prawo</p>
                    </a>
                    <a class="homePageIcon col-xs-12 col-sm-3 col-md-2" href="/media" target="_self">
                        <img class="svg" alt="Media" src="/media/icon/media.svg">

                        <p>Media</p>
                    </a>
                    <a class="homePageIcon allApps col-xs-12 col-sm-3 col-md-2" href="/aplikacje" target="_self">
                        <i class="_mPAppIcon" data-icon-new="&#xe800;" alt="Wszystkie aplikacje"></i>

                        <p>Wszystkie aplikacje</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>