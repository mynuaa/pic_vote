<?php 
	$sql = "SELECT * FROM " . DB::table('wechat_pic_url') . " WHERE `pic_deleted` = 0 ORDER BY RAND()";
	$result = DB::fetch_all($sql);
	for ($i = 0; $i < count($result); $i++) {
		$result[$i]['pic_url'] = str_replace('http://mmbiz.qpic.cn/mmbiz/', '/source/plugin/pic_vote/photo/', $result[$i]['pic_url']);
		$result[$i]['pic_url'] = preg_replace('/\/0$/', '.jpg', $result[$i]['pic_url']);
		$result[$i]['thumb'] = preg_replace('/\/photo\//', '/source/plugin/pic_vote/photo/thumb_', $result[$i]['pic_url']);
		$result[$i]['encoded_url'] = urlencode($result[$i]['pic_url']);
		$result[$i]['pic_describe'] = preg_replace('/^$/', '作者很懒，没有写描述……', $result[$i]['pic_describe']);
		$result[$i]['pic_describe'] = preg_replace('/\n/', '<br>', $result[$i]['pic_describe']);
	}
	$vote_var = $_G['cache']['plugin']['pic_vote'];
	$limit = $vote_var['limit']; 
	$sql = "SELECT `vote_items` FROM " . DB::table('pic_vote') . " WHERE `vote_uid` = {$_G['uid']}";
	$votes = DB::result_first($sql);
	$votes = $votes ? $votes : '';
	include template('pic_vote:vote');
?>