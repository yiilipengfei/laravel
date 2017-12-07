<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
</head>
<body>
<form action="add" method="post" >
<center>
欢迎<b>{{$value}}</b>登录,<a>退出登录</a>
  <table>
    <tr>{{csrf_field()}}
      <td>标题</td> 
      <td><input type="text" name="title" id="title"></td>
    </tr>
    <tr>
      <td>评论</td>
      <td><textarea name="content" id="content"></textarea></td>
    </tr>
    <tr>
      <td><input type="button" value="添加" id="sub"></td>
      <td><input type="reset" value="重置"></td>
    </tr>
  </table>
  </center>
</form>
<br/>
<center>
<table border="1px">
    <tr>
      <td>id</td>
      <td>标题</td>
      <td>评论</td>
      <td>发布人</td>
      <td>操作</td>

    </tr>
    <?php
       foreach($res as $val):
    ?>
    <tr>
        <td>{{$val->id}}</td>
      <td>{{$val->title}}</td>
      <td>{{$val->content}}</td>
      <td>{{$val->username}}</td>
      <td>
        <!-- <a href="delete?id={{$val->id}}">删除</a> -->
        <a href="javascript:void(0)" id="{{$val->id}}" class="key">删除</a>
                <a href="update?id={{$val->id}}">修改</a>
      </td>

    </tr>
    <?php
         endforeach;
    ?>
  </table>
</center>
</body>
</html>
<script type="text/javascript" src="http://localhost/laravel5.2/public/js/jquery.js"></script>
<script type="text/javascript">
 //添加
 $('#sub').on('click',function(){
    
    var title=$('#title').val();
    var content=$('#content').val();
    $.ajax({
        type:'get',
        url:'add',
        data:{title:title,content:content},
        success:function(e)
        {
              if(e==1)
              {
                location.href="index";
              }
        }

    })
 })
 //删除
 $('.key').on('click',function(){
   var obj=$(this);
   var id=obj.attr('id');//当前对象的 id属性值
   $.ajax({
       type:'get',
       data:{id:id},
       url:'delete',
       success:function(e)
       {
        if(e==1)
        {
          obj.parents("tr").remove();
        }
       }
   })
 })
</script>