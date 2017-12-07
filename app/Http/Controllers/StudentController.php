<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
// 接值Input
use Illuminate\Support\Facades\Input;
//DB//sql
use Illuminate\Support\Facades\DB;
//session  request实例
use Illuminate\Http\Request;
//引用dfa自动过滤词
use Sensitive;

class StudentController extends Controller{

 //登录页面
 public function login()
 {
  if(Input::all())
  {  
     //接值（单个）
       $username = Input::get('username');
       $password = Input::get('password');
       //接值（所有）
       $input = Input::all();
       //查询数据库
       $res=DB::select("select * from user where username = '$username' and password=".$password);
       if($res)
       {
         //存储一个session
        session(['key' =>$username]);
        echo "<script>alert('登陆成功'),location.href='index'</script>";


       }
       else
       {
        echo "<script>alert('账号或密码错误'),location.href='login'</script>";die;
       }
  }
  else
  {
     return view('student/login');
  }
  
 }
  
  //展示页面
  public function index()
  {
    $value = session('key');

    //查询数据库
    $res=DB::select("select * from liuyan");
    $res=DB::table('liuyan')->get();
    return view('student/index',['res'=>$res,'value'=>$value]);

  }
  
  // ajax添加
   public function add()
   { 
      $post=Input::all();
      unset($post['_token']);
     //dfa过滤
     $interference = ['&', '*'];
     $filename = 'D:\phpstudy\WWW\WAMP\01128\app\Http\Controllers\words.txt'; //每个敏感词独占一行
     Sensitive::interference($interference); //添加干扰因子
     Sensitive::addwords($filename); //需要过滤的敏感词
     $txt = $post['content'];
     $post['content'] = Sensitive::filter($txt);
     $txt1 = $post['title'];
     $post['title'] = Sensitive::filter($txt1);

      $res = DB::table('liuyan')->insert($post);
      if($res)
      {
        echo 1;
      }
      else
      {
        echo 0;
      }
   }
   //ajax删除
   public function delete()
   { 
     //接id
     $id=input::get('id');
     $res=DB::table('liuyan')->where('id','=',$id)->delete();
     if($res)
     {
      echo 1;
     }
   }
   //修改默认
   public function update()
   {
      $res=DB::table('liuyan')->where('id','=',Input::get('id'))->first();
      return view('student/update',['res'=>$res]);
   }
   //修改
   public function up()
   {
       $post=Input::all();
       unset($post['_token']);
       $res=DB::table('liuyan')->where('id',$post['id'])->update($post);
       if($res)
       {
        echo "<script>alert('修改成功'),location.href='index'</script>";
       }

   }
}






