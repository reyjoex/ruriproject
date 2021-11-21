<?php

namespace App\Http\Controllers;

use App\Models\VendorModel;
use Illuminate\Http\Request;
use App\Models\MenuModel;

class VendorController extends Controller
{
    public function __construct(){
        $this->MenuModel = new MenuModel();
        $this->VendorModel = new VendorModel();       
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'nama' => 'Vendor',
            'section1' => 'Daftar',
            'menu' => $this->MenuModel->DataMenu(),
            'submenu' => $this->MenuModel->DataSubmenu(),
            'allMasVendor' => $this->VendorModel->AllMasVendor(),
        ];
        return view('vvendor',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'nama' => 'Vendor',
            'section1' => 'Baru',
            'menu' => $this->MenuModel->DataMenu(),
            'submenu' => $this->MenuModel->DataSubmenu(),
            'allMasVendor' => $this->VendorModel->AllMasVendor(),
        ];       
        return view('vvendor',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'Vendor_Name' => 'required|unique:masterVendor,Vendor_Name|min:3|max:20',
            'Vendor_Address' => 'required|min:3|max:50',
            'City' => 'required|min:3|max:20',
            'Phone_Vendor' => 'required|min:3|max:15',
            'Postal_Code_Vendor' => 'required|min:3|max:15',
            'Fax_Vendor' => 'required|min:3|max:15',
            'HP_Vendor' => 'required|min:3|max:20',
            'Email_Vendor' => 'required|min:3|max:20',
        ],[
            'Vendor_Name.required'=>'wajib diisi !!',
            'Vendor_Name.unique'=>'Sudah ada',            
            'Vendor_Name.min'=>'minimal 3 karakter',
            'Vendor_Name.max'=>'maximal 50 karakter',
            'Vendor_Address.required'=>'wajib diisi !!',
            'Vendor_Address.min'=>'minimal 3 karakter',
            'Vendor_Address.max'=>'maximal 50 karakter',
            'City.required'=>'wajib diisi !!',
            'City.min'=>'minimal 3 karakter',
            'City.max'=>'maximal 20 karakter',
            'Phone_Vendor.required'=>'wajib diisi !!',
            'Phone_Vendor.min'=>'minimal 3 karakter',
            'Phone_Vendor.max'=>'maximal 15 karakter',
            'Postal_Code_Vendor.required'=>'wajib diisi !!',
            'Postal_Code_Vendor.min'=>'minimal 3 karakter',
            'Postal_Code_Vendor.max'=>'maximal 15 karakter',
            'Fax_Vendor.required'=>'wajib diisi !!',
            'Fax_Vendor.min'=>'minimal 3 karakter',
            'Fax_Vendor.max'=>'maximal 15 karakter',
            'HP_Vendor.required'=>'wajib diisi !!',
            'HP_Vendor.min'=>'minimal 3 karakter',
            'HP_Vendor.max'=>'maximal 15 karakter',
            'Email_Vendor.required'=>'wajib diisi !!',
            'Email_Vendor.min'=>'minimal 3 karakter',
            'Email_Vendor.max'=>'maximal 20 karakter',            
        ]);

        $data = [
            'Vendor_Name' => $request->Vendor_Name,
            'Vendor_Address' => $request->Vendor_Address,
            'City' => $request->City,
            'Phone_Vendor' => $request->Phone_Vendor,
            'Postal_Code_Vendor' => $request->Postal_Code_Vendor,
            'Fax_Vendor' => $request->Fax_Vendor,
            'HP_Vendor' => $request->HP_Vendor,
            'Email_Vendor' => $request->Email_Vendor,
            'iduser' => $request->iduser,
        ];
        $this->VendorModel->addData($data);
        return redirect()->route('vendor')->with('pesan','Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VendorModel  $vendorModel
     * @return \Illuminate\Http\Response
     */
    public function show(VendorModel $vendorModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VendorModel  $vendorModel
     * @return \Illuminate\Http\Response
     */
    public function edit($vendor)
    {
        $data = [
            'nama' => 'Vendor',
            'section1' => 'Edit',
            'menu' => $this->MenuModel->DataMenu(),
            'submenu' => $this->MenuModel->DataSubmenu(),
            'satuMasVendor' =>  json_decode(json_encode($this->VendorModel->SatuMasVendor($vendor)[0]), true),
        ];       
        return view('vvendor',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VendorModel  $vendorModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'Vendor_Name' => 'required|min:3|max:20',
            'Vendor_Address' => 'required|min:3|max:50',
            'City' => 'required|min:3|max:20',
            'Phone_Vendor' => 'required|min:3|max:15',
            'Postal_Code_Vendor' => 'required|min:3|max:15',
            'Fax_Vendor' => 'required|min:3|max:15',
            'HP_Vendor' => 'required|min:3|max:15',
            'Email_Vendor' => 'required|min:3|max:20',
        ],[
            'Vendor_Name.required'=>'wajib diisi !!',
            'Vendor_Name.unique'=>'Sudah ada',            
            'Vendor_Name.min'=>'minimal 3 karakter',
            'Vendor_Name.max'=>'maximal 50 karakter',
            'Vendor_Address.required'=>'wajib diisi !!',
            'Vendor_Address.min'=>'minimal 3 karakter',
            'Vendor_Address.max'=>'maximal 50 karakter',
            'Fax_Vendor.required'=>'wajib diisi !!',
            'Fax_Vendor.min'=>'minimal 3 karakter',
            'Fax_Vendor.max'=>'maximal 15 karakter',
            'HP_Vendor.required'=>'wajib diisi !!',
            'HP_Vendor.min'=>'minimal 3 karakter',
            'HP_Vendor.max'=>'maximal 15 karakter',
            'Email_Vendor.required'=>'wajib diisi !!',
            'Email_Vendor.min'=>'minimal 3 karakter',
            'Email_Vendor.max'=>'maximal 20 karakter',            
        ]);

        $data = [
            'id' => $request->id,
            'Vendor_Name' => $request->Vendor_Name,
            'Vendor_Address' => $request->Vendor_Address,
            'City' => $request->City,
            'Phone_Vendor' => $request->Phone_Vendor,
            'Postal_Code_Vendor' => $request->Postal_Code_Vendor,
            'Fax_Vendor' => $request->Fax_Vendor,
            'HP_Vendor' => $request->HP_Vendor,
            'Email_Vendor' => $request->Email_Vendor,
            'iduser' => $request->iduser,
        ];      
        $this->VendorModel->updatedata($data);
        return redirect()->route('vendor')->with('pesan','Data berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VendorModel  $vendorModel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->VendorModel->hapusData($id);
        return redirect()->route('vendor')->with('pesan','Data berhasil dihapus');
    }
}
