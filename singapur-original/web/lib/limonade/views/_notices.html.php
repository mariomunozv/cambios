<? if(!empty($notices)): ?>
<div class="lim-debug lim-notices">
  <h4> &#x2192; Notices and warnings</h4>
  <dl>
  <? $cpt = 1; foreach($notices as $notice): ?>
    <dt>[<? echo $cpt.'. '.error_type($notice['errno'])?>]</dt>
    <dd>
    <? echo $notice['errstr']?> in <strong><code><? echo $notice['errfile']?></code></strong> 
    line <strong><code><? echo $notice['errline']?></code></strong>
    </dd>
  <? $cpt++; endforeach; ?>
  </dl>
  <hr>
</div>
<? endif; ?>