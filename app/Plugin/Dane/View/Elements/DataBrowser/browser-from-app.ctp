<?
echo $this->Html->css($this->Less->css('app'));

$displayAggs = isset($displayAggs) ? (boolean) $displayAggs : true;
$columns = isset($columns) ? $columns : array(9, 3);

echo $this->element('headers/main');
?>


<div class="app-sidebar">

	
</div>
<div class="app-content-wrap">
	
	
	<div class="objectsPage">
		<div class="dataBrowser margin-top-0<? if (isset($class)) echo " " . $class; ?>">
	
			
	
			<div class="container">
	            <div class="dataBrowserContent">
	
	                <?
	
	                    $options = array(
	                        'displayAggs' => false,
	                        'columns' => $columns,
	                        'searcher' => true,
	                    );
						
						/*
	                    if(isset($menu)) {
	                        $options['menu'] = $menu;
	                    }
	                    */
	
	                ?>
	
				    <?= $this->element('Dane.DataBrowser/browser-content', $options); ?>
	
			    </div>
			</div>
	
		</div>
	</div>
	
</div>
