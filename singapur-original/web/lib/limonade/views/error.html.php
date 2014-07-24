  <h1><? echo h(error_http_status($errno));?></h1>
  <? if($is_http_error): ?>
  <p><? echo h($errstr)?></p>
  <? endif; ?>
  
  <? echo  render('_debug.html.php', null, $vars); ?>