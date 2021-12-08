<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuModel;
use App\Models\QuotationModel;
use App\Models\CustomerModel;

class QuotationController extends Controller
{
    public function __construct(){
        $this->MenuModel = new MenuModel();
        $this->QuotationModel = new QuotationModel();
        $this->CustomerModel = new CustomerModel();
    }

    public function bataldrafquot($id)
    {            
        $data = [
            'hapus' => 1,
            'iduser' => session('iduser'),
        ];
        $this->QuotationModel->batalData($data,$id);
        return $this->detailquotation($id);
    }

    public function detailquotation($id)
    {        
        $cari=$this->QuotationModel->cariIdKepala($id)[0];
        $Customer=$this->QuotationModel->EditDetailQuotation($cari);        
        foreach ($Customer as $key => $p) {            
            if($p->id==$id){                
                $Customer1=$Customer[$key];
                break;
            }            
        }
        
        $data = [
            'nama' => 'Quotation',
            'section1' => 'Detail',
            'menu' => $this->MenuModel->DataMenu(),
            'submenu' => $this->MenuModel->DataSubmenu(),
            'Customer' => $Customer1,
            'DraftDetailQuotation' => $this->QuotationModel->EditDetailQuotation($cari),
            'AllMasCustomer' => $this->CustomerModel->AllMasCustomer(),
        ];                
        return view('vquotation',$data);
    }

    public function create()
    {
        $TopCustomer=$this->QuotationModel->TopCustomer();
        // $noQdraft=1;                        
        // $FormatQdraft='ruri';
        // $sessionidcustomer=1;
        $noQdraft=(is_null(session('NomorQuotation')))?(count($TopCustomer)==0)?0:$TopCustomer[0]->Nomor_Quotation+1:session('NomorQuotation');                                
        $FormatQdraft=(is_null(session('FormatNomor')))?(count($TopCustomer)==0)?'':$TopCustomer[0]->Format_Nomor:session('FormatNomor');
        $sessionidcustomer=is_null(session('idcustomer'))?'':session('idcustomer');
        $data = [
            'nama' => 'Quotation',
            'section1' => 'Baru',
            'menu' => $this->MenuModel->DataMenu(),
            'submenu' => $this->MenuModel->DataSubmenu(),
            'TopCustomer' => [$noQdraft,$FormatQdraft,$sessionidcustomer],
            'DraftDetailQuotation' => $this->QuotationModel->DraftDetailQuotation($noQdraft),
            'AllMasCustomer' => $this->CustomerModel->AllMasCustomer(),
        ];       
        return view('vquotation',$data);
    }

    public function index()
    {
        $data = [
            'nama' => 'Quotation',
            'section1' => 'Header',
            'menu' => $this->MenuModel->DataMenu(),
            'submenu' => $this->MenuModel->DataSubmenu(),
            'KepalaQuotation' => $this->QuotationModel->KepalaQuotation(),
        ];
        return view('vquotation',$data)->with('idcustomer',0);
    }

    public function store(Request $request)
    {
        $request->validate([
            'Nama_Barang' => 'required|min:3|max:20',
            'Nomor_Quotation' => 'required|max:4',
            'Format_Nomor' => 'required|max:20',
            'Merk_Barang' => 'required|min:3|max:20',
            'Quantity_Barang' => 'required|min:1|max:6',
            'Harga_Barang' => 'required|min:3|max:15',
            'Tanggal_Quotation' => 'required',
            'Nama_Customer' => 'required|not_in:0',
        ],[
            'Nomor_Quotation.max'=>'maximal 4 karakter',
            'Nomor_Quotation.required'=>'wajib pilih !!',
            'Format_Nomor.max'=>'maximal 20 karakter',            
            'Format_Nomor.required'=>'wajib pilih !!',
            'Nama_Customer.not_in'=>'wajib pilih !!',
            'Nama_Barang.required'=>'wajib diisi !!',
            'Nama_Barang.unique'=>'Sudah ada',            
            'Nama_Barang.min'=>'minimal 3 karakter',            
            'Nama_Barang.max'=>'maximal 20 karakter',
            'Merk_Barang.required'=>'wajib diisi !!',
            'Merk_Barang.min'=>'minimal 3 karakter',
            'Merk_Barang.max'=>'maximal 20 karakter',
            'Quantity_Barang.required'=>'wajib diisi !!',
            'Quantity_Barang.min'=>'minimal 1 karakter',
            'Quantity_Barang.max'=>'maximal 6 karakter',            
            'Harga_Barang.required'=>'wajib diisi !!',
            'Harga_Barang.min'=>'minimal 3 karakter',
            'Harga_Barang.max'=>'maximal 15 karakter',
            'Tanggal_Quotation.required'=>'wajib diisi !!',
        ]);

        $data = [
            'Nomor_Quotation' => $request->Nomor_Quotation,
            'Format_Nomor' => $request->Format_Nomor,
            'idcustomer' => $request->Nama_Customer,
            'Nama_Barang' => $request->Nama_Barang,
            'Merk_Barang' => $request->Merk_Barang,
            'Quantity_Barang' => $request->Quantity_Barang,
            'Harga_Barang' => $request->Harga_Barang,
            'Tanggal_Quotation' => $request->Tanggal_Quotation,
            'Keterangan' => $request->Keterangan,
            'status' => 'quot',
            'iduser' => $request->iduser,
        ];
        $this->QuotationModel->addData($data);
        return redirect()->route('addquotation')->with('pesan','Data berhasil ditambahkan')
        ->with(['idcustomer'=>$request->Nama_Customer,'NomorQuotation'=>$request->Nomor_Quotation,'FormatNomor'=>$request->Format_Nomor]);
    }    

}
