<?

$path        = App::path( 'Plugin' );
$file        = $path[0] . '/Dane/View/Elements/' . $theme . '/' . $object->getDataset() . '.ctp';
$file_exists = file_exists( $file );


$object_content_sizes = array( 6, 6 );


?>
<div class="objectRender col-md-12 <?php echo $object->getDataset(); ?>" oid="<?php echo $item['data']['id'] ?>">
	<div class="row">

		<div class="formatDate col-md-2">
			<?php echo( $this->Dataobject->getDate() ); ?>
		</div>

		<div class="data col-md-<?= $this->Dataobject->getDate() ? '10' : '12' ?>">
			<div class="row">

				<div class="attachment col-md-<?= $object_content_sizes[0] ?> text-center">
					<a href="<?= $object->getUrl() ?>">
						<img onerror="imgFixer(this)" src="<?= $object->getThumbnailUrl() ?>"
						     alt="<?= strip_tags( $object->getTitle() ) ?>"/>
					</a>
				</div>
				<div class="content col-md-<?= $object_content_sizes[1] ?>">
					<p class="header">
						<?= $object->getLabel(); ?>
					</p>

					<p class="title">
						<a href="<?= $object->getUrl() ?>"
						   title="<?= strip_tags( $object->getTitle() ) ?>"><?= $object->getShortTitle() ?></a>
					</p>

					<p class="line signature"><?php echo 'Liczba debat' . ': '; ?>
						<strong><?= $object->getData( 'liczba_debat' ) ?></strong>
					</p>


				</div>

			</div>

		</div>
	</div>
</div>