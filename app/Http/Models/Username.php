<?php

namespace App;
use Illuminate\Support\Facades\DB;  
use Illuminate\Database\Eloquent\Model;

class Username extends Model
{
    public function add($data){
    	$bool=DB::insert("insert into username(username,password)   
            values(?,?)",[$data['username'],$data['password']]);  
    	return $bool;
    }
      public function show(){
      	$student=DB::select("select * from username");   
    	return $student;
      }
      public function del($id){
      	$num=DB::delete("delete from username where id=$id");   
    	return $num;
      }
      
      public function updata($id){
        $aa=DB::select("select * from username where id=$id");   
      	return $aa;
      }
      public function updates($data){
        $bool=DB::update('update username set username= ?,password = ? where id= ? ',[$data['username'],$data['password'],$data['id']]); 
        return $bool; 
      }

      public function redislogin($data){
        $student=DB::select("select * from username where username='".$data['username']."'and password='".$data['password']."'");   
      return $student;
      }
      public function redisadd($data){
        $arr['username'] = 'zhangsan';
        $bool=DB::insert("insert into schedule(sched,times,isset,username)   
            values(?,?,?,'".$arr['username']."')",[$data['sched'],$data['times'],$data['isset']]);  
      return $bool;
      }
      public function rediszhang($username){
        $student=DB::select("select * from schedule where username ='".$username."' and isset='1'");   
        return json_encode($student);
      }
       public function redisxiaoxi(){

         /* $arr = json_decode($sched,true);
            // var_dump($arr);die;
          foreach ($arr as $key => $value) {
           $all =  DB::insert("insert into xiaoxi(sched,times,username) values('".$value['sched']."','".$value['times']."','".$value['username']."')");
           
          }*/
          return 111;
       
         // return $all;
       }
}
