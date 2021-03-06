<?php
$this->Combinator->add_libs('js', '../plugins/highstock/js/highstock');
$this->Combinator->add_libs('js', '../plugins/highstock/locals');

$this->Combinator->add_libs('css', $this->Less->css('sections', array('plugin' => 'Finanse')));
$this->Combinator->add_libs('js', 'Finanse.dzialy.js');
?>

<div class="container">

    <div class="row">
        <div class="col-md-12">
            <h1 class="pull-left">Wydatki gmin w Polsce</h1>
        </div>
    </div>


    <div class="col-md-10 col-md-offset-1 text-center">
        <div class="row banner">

            <p>W drugim kwartale 2014 r. polskie gminy wydały łącznie:</p>

            <p class="number"><?= $this->Waluta->slownie($data['stats']['sum']) ?></p>

        </div>
    </div>


    <div class="col-md-8 col-md-offset-2 text-center">
        <div class="row teryt">

            <p>Poniżej widzisz wydatki gmin, według kategorii budżetowych. Możesz też sprawdzić wydatki swojej gminy i
                zobaczyć je w kontekście wydatków innych gmin, o podobnej liczbie mieszkańców.</p>

            <div class="form-group">
                <div class="col-md-8 col-md-offset-2">
                    <div class="input-group">
                        <input id="teryt_search_input" class="form-control" type="text" placeholder="Szukaj gminy..."
                               value="">
						<span class="input-group-btn">
							<input type="submit" class="btn btn-primary btn-default" value="Szukaj"/>
						</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="mpanel" id="teryt_info" style="display: none;">
    <div class="container">

        <div class="pull-left">
            <p class="title"></p>

            <p class="desc">Jakieś informacje o wybranej gminie. Ta warstwa powinna się przyklejać do górnego brzegu
                okna roboczego.</p>
        </div>
        <div class="pull-right"><a href="#close" class="closeTerytInfo">x</a>
        </div>

    </div>
</div>

<div class="container">
    <div class="mpanel" id="sections">
        <ul id="sections">
            <? foreach ($data['sections'] as $section) { ?>
                <li class="section" data-id="<?= $section['id'] ?>">
                    <div class="row">
                        <div class="col-md-2 text-right icon">
                            <img src="/finanse/img/sections/<?= $section['id'] ?>.svg" onerror="imgFixer(this)"/>
                        </div>
                        <div class="col-md-10">
                            <div class="row row-header">
                                <div class="title col-md-12">
                                    <div class="col-md-10">
                                        <h3 class="name"><?= $section['nazwa'] ?></h3>
                                    </div>
                                    <div class="col-md-2 text-center">
                                        <p class="value"><?= number_format_h($section['sum_section']) ?></p>
                                    </div>
                                </div>
                                <div class="histogram_cont">
                                    <div class="histogram"
                                         data-init="<?= htmlspecialchars(json_encode($section['buckets'])) ?>">
                                    </div>
                                </div>
                                <div class="gradient_cont">
                                    <span class="gradient"></span>
                                    <ul class="addons">
                                        <li class="min">
                                            <span class="n"><?= $section['min_nazwa'] ?></span>
                                            <span class="v"><?= _number($section['min']) ?></span>
                                        </li>
                                        <li class="max">
                                            <span class="n"><?= $section['max_nazwa'] ?></span>
                                            <span class="v"><?= _number($section['max']) ?></span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            <? } ?>
        </ul>
    </div>
</div>
