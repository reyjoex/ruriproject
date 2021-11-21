@extends('layout.vtemplate')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title col-11">{{ $section1 }}</h3>
                        @if ($section1  == 'Daftar')
                            <a href="addvendor" class="badge badge-primary badge-pill">Tambah</a>
                        @else
                            <a href="{{ url('masvendor') }}" class="badge badge-primary badge-pill">Kembali</a>
                        @endif
                    </div>
                    <div class="card-body scroll">
                        @if(session('pesan'))
                            <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h5><i class="icon fas fa-check"></i>Sukses!</h5>                            
                            {{ session('pesan') }}.
                            </div>
                        @endif
                        @if ($section1  == 'Daftar')
                            <table id="tblmasvendor" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Vendor Name</th>
                                        <th>City</th>   
                                        <th>Phone Vendor</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($allMasVendor as $index =>  $data)                                        
                                    <tr>
                                        <td class="tdw50">{{$index+1}}</td>
                                        <td><a href="detailvendor/{{$data->id}}">{{$data->Vendor_Name}}</a></td>
                                        <td>{{$data->City}}</td>
                                        <td>{{$data->Phone_Vendor}}</td>
                                        <td class="tdw105">
                                            <a href="editvendor/{{$data->id}}" class="badge rounded-pill bg-success">Edit</a>
                                            <a href="destroyvendor/{{$data->id}}" class="badge rounded-pill bg-danger">Hapus</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @elseif ($section1  == 'Edit')
                            <form action="/updatevendor" method="post">
                                @csrf
                                <input type="hidden" id="id" name="id" value="{{ $satuMasVendor['id'] }}">
                                <input type="hidden" id="iduser" name="iduser" value="1">
                                <div class="row">
                                <div class="col col-sm-5">
                                    <div class="form-group row">
                                        <label for="Vendor_Name" class="col-sm-5 col-form-label">Vendor Name</label>
                                        <div class="col-sm-7">
                                            <input type="text" value="{{ $satuMasVendor['Vendor_Name'] }}" class="form-control @error('Vendor_Name') is-invalid @enderror" id="Vendor_Name" name="Vendor_Name" placeholder="Vendor Name">
                                            @error('Vendor_Name')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="Vendor_Address" class="col-sm-5 col-form-label">Vendor Address</label>
                                        <div class="col-sm-7">
                                            <input type="text" value="{{ $satuMasVendor['Vendor_Address'] }}" class="form-control @error('Vendor_Address') is-invalid @enderror" id="Vendor_Address" name="Vendor_Address" placeholder="Fiscal Address">
                                            @error('Vendor_Address')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="City" class="col-sm-5 col-form-label">City</label>
                                        <div class="col-sm-7">
                                            <input type="text" value="{{ $satuMasVendor['City'] }}" class="form-control @error('City') is-invalid @enderror" id="City" name="City" placeholder="City">
                                            @error('City')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="Phone_Vendor" class="col-sm-5 col-form-label">Phone Vendor</label>
                                        <div class="col-sm-7">
                                            <input type="text" value="{{ $satuMasVendor['Phone_Vendor'] }}" class="form-control @error('Phone_Vendor') is-invalid @enderror" id="Phone_Vendor" name="Phone_Vendor" placeholder="Phone Vendor">
                                            @error('Phone_Vendor')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col col-sm-5">                                        
                                    <div class="form-group row">
                                        <label for="Postal_Code_Vendor" class="col-sm-5 col-form-label">Postal Code Vendor</label>
                                        <div class="col-sm-7">
                                            <input type="text" value="{{ $satuMasVendor['Postal_Code_Vendor'] }}" class="form-control @error('Postal_Code_Vendor') is-invalid @enderror" id="Postal_Code_Vendor" name="Postal_Code_Vendor" placeholder="Postal Code Vendor">
                                            @error('Postal_Code_Vendor')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="Fax_Vendor" class="col-sm-5 col-form-label">Fax Vendor</label>
                                        <div class="col-sm-7">
                                            <input type="text" value="{{ $satuMasVendor['Fax_Vendor'] }}" class="form-control @error('Fax_Vendor') is-invalid @enderror" id="Fax_Vendor" name="Fax_Vendor" placeholder="Fax Vendor">
                                            @error('Fax_Vendor')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>                                       
                                    <div class="form-group row">
                                        <label for="HP_Vendor" class="col-sm-5 col-form-label">HP Vendor</label>
                                        <div class="col-sm-7">
                                            <input type="text" value="{{ $satuMasVendor['HP_Vendor'] }}" class="form-control @error('HP_Vendor') is-invalid @enderror" id="HP_Vendor" name="HP_Vendor" placeholder="HP Vendor">
                                            @error('HP_Vendor')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>                                       
                                    <div class="form-group row">
                                        <label for="Email_Vendor" class="col-sm-5 col-form-label">Email Vendor</label>
                                        <div class="col-sm-7">
                                            <input type="text" value="{{ $satuMasVendor['Email_Vendor'] }}" class="form-control @error('Email_Vendor') is-invalid @enderror" id="Email_Vendor" name="Email_Vendor" placeholder="Email Vendor">
                                            @error('Email_Vendor')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>                                       
                                </div>
                                </div>                                
                                <div class="row">
                                    <div class="col col-sm-1">
                                        <input type="submit" value="Update">
                                    </div>
                                    <div class="col">
                                        <input type="submit" value="Cancel">
                                    </div>
                                </div>
                            </form>                        
                        @elseif ($section1  == 'Detail')
                            <form action="showvendor" method="post">
                                @csrf                                
                                <div class="row">
                                    <div class="col col-sm-5">
                                        <div class="form-group row">
                                            <label for="Vendor_Name" class="col-sm-5 col-form-label">Vendor Name</label>
                                            <div class="col-sm-7">
                                                <input type="text" value="{{ $satuMasVendor['Vendor_Name'] }}" class="form-control @error('Vendor_Name') is-invalid @enderror" id="Vendor_Name" name="Vendor_Name" placeholder="Vendor Name">
                                                @error('Vendor_Name')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="Vendor_Address" class="col-sm-5 col-form-label">Vendor Address</label>
                                            <div class="col-sm-7">
                                                <input type="text" value="{{ $satuMasvendor['Vendor_Address'] }}" class="form-control @error('Vendor_Address') is-invalid @enderror" id="Vendor_Address" name="Vendor_Address" placeholder="Fiscal Address">
                                                @error('Vendor_Address')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="City" class="col-sm-5 col-form-label">City</label>
                                            <div class="col-sm-7">
                                                <input type="text" value="{{ $satuMasVendor['City'] }}" class="form-control @error('City') is-invalid @enderror" id="City" name="City" placeholder="City">
                                                @error('City')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="Phone_Vendor" class="col-sm-5 col-form-label">Phone Vendor</label>
                                            <div class="col-sm-7">
                                                <input type="text" value="{{ $satuMasVendor['Phone_Vendor'] }}" class="form-control @error('Phone_Vendor') is-invalid @enderror" id="Phone_Vendor" name="Phone_Vendor" placeholder="Phone Vendor">
                                                @error('Phone_Vendor')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col col-sm-5">                                        
                                        <div class="form-group row">
                                            <label for="Postal_Code_Vendor" class="col-sm-5 col-form-label">Postal Code Vendor</label>
                                            <div class="col-sm-7">
                                                <input type="text" value="{{ $satuMasVendor['Postal_Code_Vendor'] }}" class="form-control @error('Postal_Code_Vendor') is-invalid @enderror" id="Postal_Code_Vendor" name="Postal_Code_Vendor" placeholder="Postal Code Vendor">
                                                @error('Postal_Code_Vendor')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="Fax_Vendor" class="col-sm-5 col-form-label">Fax Vendor</label>
                                            <div class="col-sm-7">
                                                <input type="text" value="{{ $satuMasVendor['Fax_Vendor'] }}" class="form-control @error('Fax_Vendor') is-invalid @enderror" id="Fax_Vendor" name="Fax_Vendor" placeholder="Fax Vendor">
                                                @error('Fax_Vendor')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>                                       
                                        <div class="form-group row">
                                            <label for="HP_Vendor" class="col-sm-5 col-form-label">HP Vendor</label>
                                            <div class="col-sm-7">
                                                <input type="text" value="{{ $satuMasVendor['HP_Vendor'] }}" class="form-control @error('HP_Vendor') is-invalid @enderror" id="HP_Vendor" name="HP_Vendor" placeholder="HP Vendor">
                                                @error('HP_Vendor')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>                                       
                                        <div class="form-group row">
                                            <label for="Email_Vendor" class="col-sm-5 col-form-label">Email Vendor</label>
                                            <div class="col-sm-7">
                                                <input type="text" value="{{ $satuMasVendor['Email_Vendor'] }}" class="form-control @error('Email_Vendor') is-invalid @enderror" id="Email_Vendor" name="Email_Vendor" placeholder="Email Vendor">
                                                @error('Email_Vendor')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>                                       
                                    </div>                                    
                                </div>                                
                            </form>

                        @else
                            <form action="storevendor" method="post">
                                @csrf
                                <input type="hidden" id="iduser" name="iduser" value="1">
                                <div class="row">
                                    <div class="col col-sm-5">
                                        <div class="form-group row">
                                            <label for="Vendor_Name" class="col-sm-5 col-form-label">Vendor Name</label>
                                            <div class="col-sm-7">
                                                <input type="text" value="{{ old('Vendor_Name') }}" class="form-control @error('Vendor_Name') is-invalid @enderror" id="Vendor_Name" name="Vendor_Name" placeholder="Vendor Name">
                                                @error('Vendor_Name')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="Vendor_Address" class="col-sm-5 col-form-label">Vendor Address</label>
                                            <div class="col-sm-7">
                                                <input type="text" value="{{ old('Vendor_Address') }}" class="form-control @error('Vendor_Address') is-invalid @enderror" id="Vendor_Address" name="Vendor_Address" placeholder="Vendor Address">
                                                @error('Vendor_Address')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="City" class="col-sm-5 col-form-label">City</label>
                                            <div class="col-sm-7">
                                                <input type="text" value="{{ old('City') }}" class="form-control @error('City') is-invalid @enderror" id="City" name="City" placeholder="City">
                                                @error('City')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="Phone_Vendor" class="col-sm-5 col-form-label">Phone Vendor</label>
                                            <div class="col-sm-7">
                                                <input type="text" value="{{ old('Phone_Vendor') }}" class="form-control @error('Phone_Vendor') is-invalid @enderror" id="Phone_Vendor" name="Phone_Vendor" placeholder="Phone Vendor">
                                                @error('Phone_Vendor')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col col-sm-5">                                        
                                        <div class="form-group row">
                                            <label for="Postal_Code_Vendor" class="col-sm-5 col-form-label">Postal Code Vendor</label>
                                            <div class="col-sm-7">
                                                <input type="text" value="{{ old('Postal_Code_Vendor') }}" class="form-control @error('Postal_Code_Vendor') is-invalid @enderror" id="Postal_Code_Vendor" name="Postal_Code_Vendor" placeholder="Postal Code Vendor">
                                                @error('Postal_Code_Vendor')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="Fax_Vendor" class="col-sm-5 col-form-label">Fax Vendor</label>
                                            <div class="col-sm-7">
                                                <input type="text" value="{{ old('Fax_Vendor') }}" class="form-control @error('Fax_Vendor') is-invalid @enderror" id="Fax_Vendor" name="Fax_Vendor" placeholder="Fax Vendor">
                                                @error('Fax_Vendor')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="HP_Vendor" class="col-sm-5 col-form-label">HP Vendor</label>
                                            <div class="col-sm-7">
                                                <input type="text" value="{{ old('HP_Vendor') }}" class="form-control @error('HP_Vendor') is-invalid @enderror" id="HP_Vendor" name="HP_Vendor" placeholder="HP Vendor">
                                                @error('HP_Vendor')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="Email_Vendor" class="col-sm-5 col-form-label">Email Vendor</label>
                                            <div class="col-sm-7">
                                                <input type="text" value="{{ old('Email_Vendor') }}" class="form-control @error('Email_Vendor') is-invalid @enderror" id="Email_Vendor" name="Email_Vendor" placeholder="Email Vendor">
                                                @error('Email_Vendor')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                
                                <div class="row">
                                    <div class="col col-sm-1">
                                        <input type="submit" value="Simpan">
                                    </div>
                                    <div class="col">
                                        <input type="submit" value="Cancel">
                                    </div>
                                </div>
                            </form>
                        @endif
                    </div>
                </div> <!-- card -->
            </div>
        </div> <!-- row -->
    </div>
</section>    
@endsection
