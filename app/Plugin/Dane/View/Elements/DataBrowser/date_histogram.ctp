<?
$this->Combinator->add_libs('js', '../plugins/highcharts/js/highcharts');
$this->Combinator->add_libs('js', '../plugins/highcharts/locals');
?>

<div id="browser_histogram"></div>
<script type="text/javascript">
    if(_histogram_data === undefined)
        var _histogram_data = <?= json_encode($data); ?>
</script>