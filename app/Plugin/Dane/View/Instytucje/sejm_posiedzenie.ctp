<?

$this->Combinator->add_libs('css', $this->Less->css('sejm-posiedzenie', array('plugin' => 'Dane')));

echo $this->Element('dataobject/pageBegin', array(
    'titleTag' => 'p',
));

echo $this->Element('Dane.dataobject/subobject', array(
    'object' => $posiedzenie,
    'menu' => $_submenu,
));

echo $this->Element('Dane.DataBrowser/browser');
echo $this->Element('dataobject/pageEnd');