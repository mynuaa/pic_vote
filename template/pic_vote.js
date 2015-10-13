function rule( limit ){
	var arr = document.querySelectorAll('.selected');
	var votes = arr.length;
	if(votes > limit){
		alert("只能投 "+limit+" 票！");
		return false;
	}
	if(votes == 0){
		alert("还未投票！");
		return false;
	}
	return true;
}