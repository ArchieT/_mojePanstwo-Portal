<?
$this->Combinator->add_libs('js', '../plugins/highstock/js/highstock');
$this->Combinator->add_libs('js', '../plugins/highstock/locals');

$counter_field = isset( $map['counter_field'] ) ? $map['counter_field'] : 'doc_count';

?>

<? if (!isset($this->request->query['conditions'][$map['field']])) { ?>
    <div class="agg agg-ColumnsHorizontal" data-choose-request="<?= $map['chooseRequest']; ?>"
         data-chart="<?= htmlentities(json_encode($data)) ?>" data-counter_field="<?= $counter_field ?>">
        <div class="chart"></div>
    </div>
<? } else { ?>
    <p class="label-browser">
        <a href="<?= $map['cancelRequest']; ?>" aria-label="Close">
            <span class="label label-primary">
                <span aria-hidden="true">&times;</span>&nbsp;
                <? $key = $data['buckets'][0]['label']['buckets'][0]['key']; ?>
                <?= strlen($key) > 40 ? substr($key, 0, 40) . '..' : $key; ?>
            </span>
        </a>
    </p>
<? } ?>
