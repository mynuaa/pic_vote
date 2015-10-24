<?

$sql = "SELECT * FROM " . DB::table('pic_vote');
$result = DB::fetch_all($sql);
$count = [];
foreach ($result as $value) {
	if ($value['vote_items'] == '') continue;
	foreach (explode('|', $value['vote_items']) as $item) {
		$item = intval($item);
		if (isset($count[$item])) $count[$item]++;
		else $count[$item] = 1;
	}
}
arsort($count);
$countStr = '';
$i = 0;
foreach ($count as $key => $value) {
	$i++;
	$countStr .= "<div><b>#{$i}</b> 作品 {$key} ： {$value} 票</div>";
	$pic = DB::fetch_first("SELECT `pic_describe`, `pic_url` FROM `wechat_pic_url` WHERE `pic_id` = {$key}");
	$url = preg_replace('/http:\/\/mmbiz\.qpic\.cn\/mmbiz\//', '/photo/', $pic['pic_url']);
	$url = preg_replace('/\/0/', '.jpg', $url);
	$thumb = preg_replace('/\/photo\//', '/photo/thumb_', $url);
	if ($pic['pic_describe'] == '') $pic['pic_describe'] = '暂无描述……';
	$countStr .= "<div>{$pic['pic_describe']}</div>";
	$countStr .= "<img src='{$thumb}' style='max-width:100px;width:50%'><hr>";
}
include template('pic_vote:result');

?>