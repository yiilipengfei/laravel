<script type="text/javascript" src="js/js/laydate.js"></script>
<form action="redisadd" method="post">
	
	日程安排：<textarea name="sched" id="" cols="30" rows="10"></textarea><br/>
	时间：<input placeholder="请输入日期" name="times" class="laydate-icon" onClick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})"><br/>
	提醒：<input type="radio" value="1" name="isset">
	不提醒：<input type="radio" value="0" name="isset"><br/>
	<input type="submit" value="添加">
</form>