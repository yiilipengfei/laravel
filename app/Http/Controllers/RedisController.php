<?php 
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Username;
use App\Http\Requests;
use Sensitive;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session; 

class RedisController extends Controller{
	public function __construct(){
		$this->ablout = new Username;
	}

	public function redislogin(){
		return view('redis/login');
	}

	public function redisinsert(){
		$data = Input::get();

		$arr = $this->ablout->redislogin($data);
		if($arr){
			session()->put('username',$data['username']);
			return redirect('redisshow');
		}else{
			echo "登录失败";
		}
	}
	public function redisshow(){
		//$username = session()->get('username');
		//echo $username;die;
		return view('redis/show');
	}
	public function redisadd(){
		$data = Input::all();

		$arr = $this->ablout->redisadd($data);
		if($arr){
			$data = json_encode($data);
			Redis::lpush('schedule',$data);
			echo Redis::lpop('schedule');
			//return redirect('rediszhang');
			echo "成功";
		}else{
			echo "失败";
		}
	}
	/*public function rediszhang(){
				//Redis::lpush('123','123');

		$username = 'zhangsan';
		$arr = $this->ablout->rediszhang($username);
		
		
		//$sched = Redis::lpop('schedule');
		//print_r($sched);die;
		return redirect('redisxiaoxi');
		//$shi = '2017-11-30 15:03:38';
		//echo strtotime($shi);
		//echo '<br/>';
		//echo time();
		
	}
	public function redisxiaoxi(){
		//$sched = Redis::lpop('schedule');
		$arr = $this->ablout->redisxiaoxi();
		echo $arr;
	}*/
}

 ?>