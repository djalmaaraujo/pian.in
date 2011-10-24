<?php header("Content-type: text/xml"); ?>
<result>
<?php if ($result): ?>
	<url><?php echo $result; ?></url>
<?php else: ?>
	<error><?php echo Session::flash('url.error'); ?></error>
<?php endif; ?>
</result>