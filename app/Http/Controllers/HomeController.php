<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuModel;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->MenuModel = new MenuModel();
    }

    public function index(){
        session(['iduser' => 1]);
        $data = [
            'nama' => 'Home',
            'section1' => '',
            'menu' => $this->MenuModel->DataMenu(),
            'submenu' => $this->MenuModel->DataSubmenu(),
        ];
        return view('home',$data);
    }
}
