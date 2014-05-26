<h1><?php echo $api['name'] ?></h1>

<p><?php echo $api['description'] ?></p>

<p>Interaktywna dokumentacja zbudowana przy użyciu <a href="https://github.com/wordnik/swagger-ui" target="_blank">Swagger UI</a></p>


<div class="swagger-section">
    <div id="message-bar" class="swagger-ui-wrap">&nbsp;</div>
    <div id="swagger-ui-container" class="swagger-ui-wrap"></div>
</div>

<?
$this->Html->css(array(
    //'/api/swagger/css/reset',
    '/api/swagger/css/screen'
), array('inline' => 'false', 'block' => 'cssBlock'));

$this->Html->script(array(
    '/api/swagger/lib/swagger',
    '/api/swagger/lib/shred.bundle',
    '/api/swagger/lib/jquery.slideto.min',
    '/api/swagger/lib/jquery.wiggle.min',
    '/api/swagger/lib/jquery.ba-bbq.min',
    '/api/swagger/lib/handlebars-1.0.0',
    '/api/swagger/lib/underscore-min',
    '/api/swagger/lib/backbone-min',
    //'/api/swagger/lib/highlight.7.3.pack',
    '/api/swagger/swagger-ui',
     // enabling this will enable oauth2 implicit scope support
     // '/api/swagger/lib/swagger-oauth',
), array('inline' => 'false', 'block' => 'scriptBlock'));

$this->Html->scriptBlock('
    window.swaggerUi = new SwaggerUi({
    url: "' . $api["swagger_url"] . '",
    dom_id: "swagger-ui-container",
    docExpansion: "list"
    });

    window.swaggerUi.load();
',
array('inline' => 'false', 'block' => 'scriptBlock'));
?>