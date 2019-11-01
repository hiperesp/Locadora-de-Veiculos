		<script>
<?php
foreach(Notification::$list as $notification) {
?>
addAlert('<?php echo $notification->title; ?>', '<?php echo $notification->content; ?>', <?php echo $notification->negative===true?"true":"false"; ?>);
<?php
}
?>
		</script>
	</body>
</html>
