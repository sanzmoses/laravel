<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\ApiResponse;
use App\Events\MobileApp;
use App\Events\SosApp;
use App\Sms;
use App\Send;
use App\User;
use App\Admin;
use App\Events\Stats;

class SendController extends Controller
{

	public function __construct(){
		$this->middleware('auth:admin')->except('get');
	}
    
	public function create(){

		//if send through the txt msg form
		if(isset(request()->num) || request()->city != null){
			(request()->city != null)? $r = request()->city : $r = request()->num;
			
			$sender = 'SOSnetwork App';
			$recipient = $r;
			$body = request('body');
		}
		else{
			//if blast messages [All, Admin, Users]
			$id = request('body');
			$sms = Sms::find($id);

			$sender = $sms->sender;
			$recipient = $sms->recipient;
			$body = $sms->body;
		}

		// dd($sms->recipient);
		Send::create([
			'sender'=>$sender,
			'recipient'=>$recipient,
			'body'=>$body
		]);

		session()->flash('message', 'This may take a minute to send!');
		return redirect('/sms');

	}

	public function get($code){
		// dd(request()->all());
		header("Access-Control-Allow-Origin: *");
		
		//broadcast event for dashboard confirmation
		(request('call') == 1) ? event(new MobileApp("connected")) : $nothing = 0;
		//broadcast after the app finishes the first msg sent
		(request('status') != "none") ? event(new SosApp(request()->status)): $nothing = 0;

		
		if($code != 123456789){
			return "Unauthorize!";
		}
		else{
			event(new Stats('sms'));

			$sms = Send::all();

			if($sms->isEmpty()){
				return "No results";
			}

			//fire truncate event for SEND table
			event(new ApiResponse());

			foreach($sms as $sm){
				$sms = $sm;
			} 

			$array = array(
				'sender'=>$sms->sender,
				'body'=>$sms->body,
				'num'=>[]
			);

			if($sms->recipient == "Users"){
				$array['num'] = User::pluck('phone_number');
				$array['name'] = User::pluck('name');
			}
			else if($sms->recipient == "Admins"){
				$array['num'] = Admin::pluck('phone_number');
				$array['name'] = Admin::pluck('name');
			}
			else if($sms->recipient == "All"){
				$user = User::pluck('phone_number');
				$name = User::pluck('name');
				$numbers = $user->merge(Admin::pluck('phone_number'));
				$names = $name->merge(Admin::pluck('name'));
				$array['num'] = $numbers;
				$array['name'] = $names;
			}else if(is_numeric($sms->recipient)){
				$array['num'][0] = $sms->recipient;
				$array['name'][0] = '';
			}
			else{
				$user = User::where('city', $sms->recipient)->pluck('phone_number');
				$name = User::where('city', $sms->recipient)->pluck('name');
				$array['num'] = $user;
				$array['name'] = $name;
			}

			return $array;
		}
	}

	public function destroy(Send $sms){
		$sms->delete();

		session()->flash('message', 'Pending message removed!');
		return redirect('/sms');
	}

}
