<?
$this->Combinator->add_libs('css', $this->Less->css('dataobject', array('plugin' => 'Dane')));
$this->Combinator->add_libs('css', $this->Less->css('DataBrowser', array('plugin' => 'Dane')));
$this->Combinator->add_libs('css', $this->Less->css('pomoc', array('plugin' => 'Pomoc')));

echo $this->Html->css($this->Less->css('app'));

echo $this->element('headers/main');
echo $this->element('app/sidebar');
?>

<div class="app-content-wrap">
	<div class="objectsPage">
	    <div class="dataBrowser margin-top-0<? if (isset($class)) echo " " . $class; ?>">
	
	        <div class="container">
	            <div class="dataBrowserContent">
	
	                <div class="col-xs-12 col-sm-8 col-md-4-5 norightpadding">
	
	                        <div class="appBanner">
	                            <h1 class="appTitle">Pomoc</h1>
	
	                            <p class="appSubtitle">Ochrona danych osobowych</p>
	                        </div>
	                        <div class="dataWrap">
		                        <div class="daneOsobowe block block-simple col-xs-12">
		                            <section>
		                                <div class="text">
		                                    <p>
		                                        Na portalu mojePaństwo gromadzimy i przetwarzamy wiele danych publicznych czyli
		                                        pochodzących od urzędów publicznych. Szczególną grupą tych danych są informacje
		                                        pochodzące z Krajowego Rejestru Sądowego i Monitora Sądowego i Gospodarczego.
		                                        Część tych danych ma charakter nie tylko danych publicznych, ale również danych
		                                        osobowych.
		                                    </p>
		                                    <p>
		                                        Publikowanie takich informacji w przystępnych formatach ma na celu wspieranie
		                                        jawności i pewności obrotu gospodarczego. Odpowiada to działalności statutowej
		                                        Fundacji ePaństwo, która jest wydawcą portalu. Pragniemy również zwrócić uwagę,
		                                        że zakres danych osobowych przetwarzanych przez Fundację jest tożsamy z zakresem
		                                        danych osobowych ujawnionych w Krajowym Rejestrze Sądowym oraz Monitorze Sądowym
		                                        i Gospodarczym, których funkcjonowanie reguluje ustawa o Krajowym Rejestrze
		                                        Sądowym.
		                                    </p>
		                                    <p>
		                                        Dane osobowe udostępniane na portalu mojePaństwo dotyczą wyłącznie życia
		                                        zawodowego, a publikowane przez nas dane: imię, nazwisko oraz rok urodzenia osób
		                                        zarejestrowanych w Krajowym Rejestrze Sądowym, pozwalają korzystającym z portalu
		                                        użytkownikom rozróżnić osoby, których szukają.
		                                    </p>
		                                    <p><strong>Sposób pozyskania danych.</strong><br/>Portal mojepanstwo.pl wydawany
		                                        jest
		                                        przez Fundację ePaństwo zarejestrowaną pod numerem KRS 0000359730 i&nbsp;zawiera
		                                        różne dane publiczne w tym te, które publikowane są na podstawie ustawy z&nbsp;dnia
		                                        20 sierpnia 1997&nbsp;r. o Krajowym Rejestrze Sądowym (Dz.U. z&nbsp;2015&nbsp;r.
		                                        poz. 1142) w Krajowym Rejestrze Sądowym (dalej: KRS) oraz&nbsp;Monitorze Sądowym
		                                        i&nbsp;Gospodarczym
		                                        (dalej: Monitor). Zgodnie z&nbsp;art. 8 ust. 1 powołanej ustawy rejestr jest
		                                        jawny,
		                                        a istotą Monitora Sądowego i&nbsp;Gospodarczego jest umieszczenie go obiegu
		                                        publicznym (art. 13). Fundacja pozyskuje dane z&nbsp;powszechnie dostępnych
		                                        źródeł i&nbsp;publikuje
		                                        ich kopie na wydawanych przez siebie portalu.</p>
		
		                                    <p><strong>Charakter pozyskanych danych.</strong><br/>Fundacja pozyskuje i&nbsp;publikuje
		                                        dane, które w zakresie w jakim dotyczą osób fizycznych stanowią dane osobowe, o
		                                        których mowa w art. 6 ust. 1 ustawy o ochronie danych osobowych. Są to imię,
		                                        nazwisko, rok urodzenia, nr PESEL oraz powiązany z&nbsp;tymi danymi podmiot i&nbsp;pełniona
		                                        w nim funkcja podlegający rejestracji w KRS lub ogłoszeniu w Monitorze.</p>
		
		                                    <p><strong>Przetwarzanie i&nbsp;rozpowszechnianie danych.</strong><br/>Przetwarzając
		                                        dane Fundacja korzysta z&nbsp;przesłanki wskazanej w art. 23 ust. pkt 5 ustawy
		                                        o ochronie danych osobowych tj. gdy jest to niezbędne dla wypełnienia prawnie
		                                        usprawiedliwionych celów realizowanych przez administratorów danych albo
		                                        odbiorców
		                                        danych, a przetwarzanie nie narusza praw i&nbsp;wolności osoby, której dane
		                                        dotyczą.
		                                        Zwrócić należy również uwagę, że prawo do rozpowszechnianiatego typu informacji,
		                                        będących jednocześnie informacjami publicznymi z uwagi na ich charakter,
		                                        gwarantowane jest art. 54 ust. 1 Konstytucji Rzeczypospolitej Polskiej z&nbsp;dnia
		                                        2
		                                        kwietnia 1997&nbsp;r. (Dz.U. 1997 nr 78 poz.483 z&nbsp;późn. zm.) oraz art. 2a
		                                        ust.
		                                        2 ustawy z&nbsp;dnia 6 września 2001&nbsp;r. o dostępie do informacji publicznej
		                                        (Dz.U. 2014 poz. 782 z&nbsp;późn. zm.).</p>
		                                </div>
		                            </section>
		                        </div>
	                        </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
</div>