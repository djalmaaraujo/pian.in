<?php
if (!$success = Session::flash('url.success')):
	echo $form->create('');
	echo $form->input('url', array(
		'type' => 'text',
		'label' => false,
		'placeholder' => 'http://',
		'div' => false
	));
	echo $form->input('submit', array(
		'type' => 'submit',
		'value' => 'Gerar URL',
		'label' => false,
		'div' => false
	));
	echo $form->close();
?>
<div class="clear"></div>
<p>Cole sua URL no espaço branco e gere seu link curtin.</p>

<?php if ($flash = Session::flash('url.error')): ?>
	<div class="alert"><?php echo $flash; ?></div>
<?php endif; ?>
<?php else: ?>
	<div class="result"><?php echo $success; ?></div>
	<p>Copie seu link ou <a href="/">gere um link curtin.</a></p>
<?php endif; ?>