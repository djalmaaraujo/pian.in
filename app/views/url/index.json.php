<?php header("Content-type: application/json"); ?>
<?php $return = ($result) ? array('url' => '"' . $result . '"') : array('error' => Session::flash('url.error')); ?>
<?php echo json_encode(array('result' => $return)); ?>