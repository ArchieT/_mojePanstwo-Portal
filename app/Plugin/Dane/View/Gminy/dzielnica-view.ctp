<?
echo $this->Combinator->add_libs('css', $this->Less->css('view-gminy', array('plugin' => 'Dane')));
if ($object->getId() == '903') {
    $this->Combinator->add_libs('css', $this->Less->css('view-gminy-krakow', array('plugin' => 'Dane')));
}

echo $this->Element('dataobject/pageBegin', array(
    'titleTag' => 'p',
));
?>

    <div class="subobjectPage nopadding margin-top-20">

        <?
        echo $this->Element('Dane.dataobject/subobject', array(
            'object' => $dzielnica,
            'objectOptions' => array(
                'bigTitle' => true,
                'hlFields' => array(),
            )
        ));

        if (!isset($_submenu['base']))
            $_submenu['base'] = $object->getUrl();

        $options = array();
        if (isset($title))
            $options['title'] = $title;
        $options['menu'] = $_submenu;
        echo $this->Element('Dane.DataBrowser/browser', $options);
        ?>

    </div>

<?php
echo $this->Element('dataobject/pageEnd', array(
    'titleTag' => 'p',
));
?>
