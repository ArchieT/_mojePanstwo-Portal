<div class="row">

    <div class="attachment col-md-4">
        <a href="<?= $object->getUrl() ?>">
            <img src="<?= $object->getThumbnailUrl('1') ?>" alt="<?= strip_tags($object->getTitle()) ?>"
                 onerror="imgFixer(this)"/>
        </a>

        <a href="/dane/twitter_accounts/<?= $object->getData('twitter_accounts.id') ?>"><?= $object->getData('twitter_accounts.name'); ?></a>
    </div>
    <div class="content col-md-8">
        <p class="header">
            <?= $object->getLabel(); ?> z <?= $this->Czas->dataSlownie($object->getTime()); ?>
        </p>

        <div class="line quote">
            <blockquote class="_">
                <?php echo $item['data']['html'] ?>
            </blockquote>
        </div>

    </div>

</div>