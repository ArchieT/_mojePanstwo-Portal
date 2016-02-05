<div class="row">

	<div class="col-xs-12">

        <div class="<? if ($dataWrap) { ?>dataWrap <? } ?>">
						
			<? if( isset($dataBrowser['browserTitleElement']) && $dataBrowser['browserTitleElement'] ) { ?>
				<?= $this->element($dataBrowser['browserTitleElement']) ?>
			<? } elseif( isset($dataBrowser['browserTitle']) ) { ?>
				<h1 class="smaller"><?= $dataBrowser['browserTitle'] ?></h1>
			<? } ?>
			
			
			<div class="appBanner margin-top-20 margin-bottom-30">
				<div class="appSearch form-group margin-top-20">
			        <form action="" method="get">
			            <div class="input-group">
			                <input name="q" class="form-control" placeholder="Szukaj..." type="text" <? if( isset($this->request->query['q']) ) {?>value="<?= $this->request->query['q'] ?>"<? } ?> />
							<span class="input-group-btn">
								<button type="submit" class="btn btn-primary input-md">
			                        <span class="glyphicon glyphicon-search"></span>
			                    </button>
							</span>
			            </div>
			        </form>
		        </div>
			</div>
			
			<div class="row">
				<div class="col-md-12">
			
		            <?
		            if (isset($dataBrowser['beforeBrowserElement']))
		                echo $this->element($dataBrowser['beforeBrowserElement']);
		            ?>
					
		            <?= $this->element('Dane.DataBrowser/browser-content-filters', array(
		                'paging' => $params,
		                'paginatorPhrases' => isset($paginatorPhrases) ? $paginatorPhrases : false,
		                'nopaging' => isset($nopaging) ? (boolean) $nopaging : false,
		                'searcher' => isset($searcher) ? (boolean) $searcher : true,
		            )) ?>
					
					<?
		            if (isset($dataBrowser['beforeBrowserElements']))
		                echo $this->element($dataBrowser['beforeBrowserElements']);
		            ?>
		            
				</div>
			</div>
			
        </div>
	
	</div>
	
</div>