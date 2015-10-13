<?php
	if (!$_G['uid']) die();
	$votes = $_POST['vote'];
	$vote_items = implode('|', $votes);
	if (count($vote_items) == 0) {
		$alert = "你还没有选择作品！";
	}
	if (count($vote_items) > 2) {
		$alert = "只能投 2 票！";
	}
	else {
		$alert = "投票成功！";
		$sql = "INSERT INTO `pic_vote` (`vote_uid`, `vote_items`) VALUES ('{$_G['uid']}', '{$vote_items}') ON DUPLICATE KEY UPDATE `vote_items` = '{$vote_items}'";
		DB::query($sql);
	}
?>
<script>
	alert("<?php echo $alert; ?>");
	window.history.go(-1);
</script>