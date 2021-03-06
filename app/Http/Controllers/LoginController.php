<?php
namespace App\Http\Controllers;
use Activation;
use App\Users;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Illuminate\Http\Request;
use Sentinel;
use Session;
use Socialite;
use URL;

class LoginController extends Controller {
	public function index() {
		return view('back.auth.login');
	}
	public function redirectToFacebook() {
		Session::put('url.intended', URL::previous());
		return Socialite::driver('facebook')->redirect();
	}
	public function handleFacebookCallback(Request $request) {
		if (!$request->has('code') || $request->has('denied')) {
			return redirect(Session::get('url.intended'));
		} else {
			$user = Socialite::driver('facebook')->user();
			//dd($user);
			$cek_user = Users::where('email', $user->email);
			if ($cek_user->count() > 0) {
				$result      = $cek_user->first();
				$credentials = [
					'email'    => $result->email,
					'password' => $user->id,
				];
				if (Sentinel::authenticate($credentials)) {
					return redirect(Session::get('url.intended'));
					Session::forget('url.intended');
				} else {
					return back()->with('error', "Wrong Credentials.");
				}
			} else {
				$provider = 'facebook';
				if ($user->user['gender'] == 'male') {
					$jenis_kelamin = 'male';
				} else {
					$jenis_kelamin = 'female';
				}
				$user_role     = 2;
				$user_sentinel = Sentinel::registerAndActivate(array(
						'email'         => $user->email,
						'name'          => $user->name,
						'provider'      => $provider,
						'client_id'     => $user->id,
						'jenis_kelamin' => $jenis_kelamin,
						'client_secret' => $user->token,
						'avatar'        => $user->avatar_original,
						'password'      => $user->id,
						'status'        => 1,
						'provider_url'  => $user->profileUrl,
					));

				$activation = Activation::create($user_sentinel);
				$role       = Sentinel::findRoleById($user_role);
				$role->users()->attach($user_sentinel);

				$credentials = [
					'email'    => $user->email,
					'password' => $user->id,
				];
				if (Sentinel::authenticate($credentials)) {
					return redirect(Session::get('url.intended'));
					Session::forget('url.intended');
				} else {
					return back()->with('error', "Wrong Credentials.");
				}

				return back()->with('success', 'Login Success.');
			}

		}
	}
	public function postLogin(Request $request) {
		$this->validate($request, [
				'email_username' => 'required',
				'password'       => 'required|min:5',
			]);
		$credentials = [
			'login'    => $request->email_username,
			'password' => $request->password,
		];
		try {
			if (Sentinel::authenticate($credentials)) {
				$cek_role   = Sentinel::getUser()->roles()->first()->id;
				$cek_status = Sentinel::getUser();
				if ($cek_status->status == 1) {
					return redirect('/backadmin/dashboard');
				} else {
					return redirect('/login')->with('error', "Account Disabled")->withInput();
				}
			} else {
				return back()->with('error', "Wrong Credentials.")->withInput();
			}
		} catch (ThrottlingException $e) {
			$delay = $e->getDelay();
			return redirect()->back()->with('error', "Banned for $delay seconds. Tell your administrator")->withInput();
		} catch (NotActivatedException $e) {
			$link = $request->email_username;
			return redirect()->back()->with('error_activate', $link)->withInput();
		}
	}
	public function logout() {
		Sentinel::logout();
		return redirect('/');
	}
}
