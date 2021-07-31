<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Http\Requests;
// use App\Models\Category;
use App\Models\Promo;
use Session;
use Illuminate\Support\Facades\Redirect;

session_start();
class PromoController extends Controller
{
  public function isAdmin() {
    $admin_id = Session::get('admin_id');
    if($admin_id) {
      return Redirect::to('dashboard');
    } else {
      return Redirect::to('admin')->send();
    }
  }
  public function add_promo() {
    $this->isAdmin();
    return view('admin.add_promo');
  }
  public function view_promo() {
    $this->isAdmin();
    $all_promos = Promo::all();
    $manage_promo = view('admin.view_promo')->with('all_promos', $all_promos);
    return view('admin_layout')->with('admin.view_promo', $manage_promo);
  }
  public function save_promo(Request $request) {
    $this->isAdmin();
    $data = $request->all();

    $promo = new Promo();
    $promo->promo_name = $data['promo_name'];
    $promo->promo_status = $data['promo_status'];

    $get_image = $request->file('promo_image');
    if($get_image){
      $get_name_image = $get_image->getClientOriginalName();
      $name_image = current(explode('.',$get_name_image));
      $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
      $get_image->move('storage/upload/promo',$new_image);
      $promo->promo_image = $new_image;
      $promo->save();
      Session::put('msg', 'Add promo successfully');
      return Redirect::to('add-promo');
    }
    $promo->promo_image ='';
    $promo->save();
    Session::put('msg', 'Add promo successfully');
    return Redirect::to('add-promo');
  }
  public function edit_promo($promo_id){
    $this->isAdmin();
    $edit_promo = Promo::where('promo_id', $promo_id)->first();
    $manage_promo = view('admin.edit_promo')->with('edit_promo', $edit_promo);
    return view('admin_layout')->with('admin.edit_promo', $manage_promo);
  }
  public function save_update_promo(Request $request, $promo_id) {
    $this->isAdmin();
    $data = $request->all();

    $promo = Promo::find($promo_id);
    $promo->promo_name = $data['promo_name'];
    $promo->promo_status = $data['promo_status'];

    $get_image = $request->file('promo_image');
    if($get_image){
      $get_name_image = $get_image->getClientOriginalName();
      $name_image = current(explode('.',$get_name_image));
      $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
      $get_image->move('storage/upload/promo',$new_image);
      $promo->promo_image = $new_image;
      $promo->save();
      Session::put('msg', 'Update promo successfully');
      return Redirect::to('view-promo');
    }
    $promo->save();
    Session::put('msg', 'Update promo successfully');
    return Redirect::to('view-promo');
  }
  public function delete_promo($promo_id){
    $this->isAdmin();
    promo::where('promo_id', $promo_id)->delete();
    Session::put('msg', 'Delete promo successfully');
    return Redirect::to('view-promo');
  }
}
