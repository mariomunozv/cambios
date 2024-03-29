<? if(option('env') > ENV_PRODUCTION && option('debug')): ?>
  <? if(!$is_http_error): ?>
  <p>[<? echo error_type($errno)?>]
  	<? echo $errstr?> (in <strong><? echo $errfile?></strong> line <strong><? echo $errline?></strong>)
  	</p>
  	<? endif; ?>


  <? if($debug_args = set('_lim_err_debug_args')): ?>
  <h2 id="debug-arguments">Debug arguments</h2>
  	<pre><code><? echo h(print_r($debug_args, true))?></code></pre>
  <? endif; ?>
  
  <h2 id="limonade-options">Options</strong></h2>
  <pre><code><? echo h(print_r(option(), true))?></code></pre>
  <p class="bt top"><a href="#header">[ &#x2191; ]</a></p>
  
  <h2 id="environment">Environment</h2>
  <pre><code><? echo h(print_r(env(), true))?></code></pre>
  <p class="bt top"><a href="#header">[ &#x2191; ]</a></p>
  
  <h2 id="debug-backtrace">Backtrace</h2>
  <pre><code><? echo h(print_r(debug_backtrace(), true))?></code></pre>
  <p class="bt top"><a href="#header">[ &#x2191; ]</a></p>

  <div id="debug-menu">
    
    <? if($debug_args = set('_lim_err_debug_args')): ?>
    <a href="#debug-arguments">Debug arguments</a> |
    <? endif; ?>
    <a href="#limonade-options">Options</a> |
    <a href="#environment">Environment</a> |
    <a href="#debug-backtrace">Backtrace</a> |
    <a href="#header">[ &#x2191; ]</a>
  </div>
  
<? endif; ?>