<?
$this->Combinator->add_libs( 'css', $this->Less->css( 'view-twitteraccounts', array( 'plugin' => 'Dane' ) ) );
$this->Combinator->add_libs( 'css', $this->Less->css( 'dataobjectslider', array( 'plugin' => 'Dane' ) ) );

$this->Combinator->add_libs( 'js', '../plugins/highcharts/js/highcharts' );
$this->Combinator->add_libs( 'js', '../plugins/highcharts/locals' );
$this->Combinator->add_libs( 'js', 'Dane.view-twitteraccounts' );

echo $this->Element( 'dataobject/pageBegin' );
?>

	<div class="row">

		<div class="col-lg-3 objectSide">
			<div class="objectSideInner">
				<?=
				$this->element( 'Dane.objects/twitter_accounts/side_div', array(
					'object' => $object,
				) ) ?>
			</div>
		</div>

		<div class="col-lg-9 objectMain">
			<div class="object">
				<div class="block-group">
					<?=
					$this->element( 'Dane.objects/twitter_accounts/main_div', array(
						'object' => $object,
						'twitts' => $twitts,
					) ) ?>
				</div>
			</div>
		</div>

	</div>

<?= $this->Element( 'dataobject/pageEnd' ); ?>