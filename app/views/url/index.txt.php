<?php $return = ($result) ? 'url=' . $result : 'error=' . Session::flash('url.error'); ?>
<?php echo trim($return); ?>