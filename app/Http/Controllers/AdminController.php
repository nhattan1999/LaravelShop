<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Admin;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();
class AdminController extends Controller
{
    public function isAdmin() {
      $admin_id = Session::get('admin_id');
      if($admin_id) {
        return Redirect::to('dashboard');
      } else {
        return Redirect::to('admin')->send();
      }
    }
    public function index() {
      return view('admin_login');
    }
    public function show_dashboard() {
      $this->isAdmin();
      return view('admin.dashboard');
    }
    public function dashboard(Request $request) {

      $result = Admin::where('admin_email', $request->admin_email)->where('admin_password', md5($request->admin_password))->first();
      if($result) {
        Session::put('admin_name', $result->admin_name);
        Session::put('admin_id', $result->admin_id);
        return Redirect::to('/dashboard');
      } else {
        Session::put('msg', 'Email or Password is INCORRECT!!!');
        return Redirect::to('/admin');
      }
      return view('admin.dashboard');
    }
    public function logout() {
      $this->isAdmin();
      Session::put('admin_name', null);
      Session::put('admin_id', null);
      return Redirect::to('/admin');
    }

}
