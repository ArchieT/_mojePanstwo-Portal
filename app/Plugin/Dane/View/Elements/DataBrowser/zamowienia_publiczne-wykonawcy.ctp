<?
if ($data) {
    foreach ($data['buckets'] as &$b) {
        $b['label'] = $b['nazwa'];
    }
}
?>

<? if (!isset($this->request->query['conditions'][$map['field']])) { ?>
    <div class="agg agg-Dataobjects"<? if (isset($id)) {
        echo ' data-agg_id=' . $id;
    } ?>>
        <ul class="dataobjects col-xs-12 nopadding">
            <li class="col-xs-12 nopadding">
                <? foreach ($data['buckets'] as $bucket) { ?>
                    <div class="objectRender readed objclass zamowienia_publiczne_wykonawcy col-xs-12">
                        <div class="data col-xs-12 nopadding">
                            <div class="content">
                                <span class="object-icon icon-datasets-zamowienia_publiczne_wykonawcy"></span>
                                <div class="object-icon-side ">
                                    <p class="title">
                                        <a href="/dane/krs_podmioty/{id}"
                                           title="<?= $bucket['nazwa']['buckets'][0]['key'] ?>"><?= $bucket['nazwa']['buckets'][0]['key'] ?></a>
                                    </p>
                                    <p class="meta meta-desc"><?= number_format_h($bucket['suma']['value']) ?> zł</p>
                                </div>
                            </div>
                        </div>
                    </div>
                <? } ?>
            </li>
        </ul>
    </div>
<? } else { ?>
    asd2
    <p class="label-browser">
        <a href="<?= $map['cancelRequest']; ?>" aria-label="Close">
            <span class="label label-primary">
                <span aria-hidden="true">&times;</span>&nbsp;
                <?= $data['buckets'][0]['label']['buckets'][0]['key']; ?>
            </span>
        </a>
    </p>
<? } ?>
