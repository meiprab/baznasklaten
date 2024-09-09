@section('title',$title)
@extends('layout.app')
@section('content')
<div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="shop-breadcrumb">

                            <div class="breadcrumb-main">
                                <h4 class="text-capitalize breadcrumb-title">Data Pengajuan Pengesahan </h4>
                                <div class="breadcrumb-action justify-content-center flex-wrap">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="#"><i class="las la-home"></i>Keuangan </a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Pengajuan Pengesahan</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
               <!-- Display success message -->
            <div class="container-fluid">

            
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('warning'))
        <div class="alert alert-warning">
            {{ session('warning') }}
        </div>
    @endif
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif


    <div class="row ">
                  


   


        




        
                <div class="row">
                    <div class="col-lg-12">


                        <div class="userDatatable orderDatatable sellerDatatable global-shadow mb-30 py-30 px-sm-30 px-20 radius-xl w-100">
                           
                            <div class="table-responsive">
                                <table class="table mb-0 table-borderless border-0">
                                    <thead>
                                        <tr class="userDatatable-header">
                                           <th scope="col">Nomor Pengajuan</th>
                                           <th scope="col">Tanggal Permohonan</th>
                                           <th scope="col">Status</th>
                                           <th scope="col">Keterangan</th>
                                           <th scope="col" width="10%"><center>Aksi</center></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data as $key => $d)
                                    <tr>
                                        <td>{{ $d->nomor_pengajuan }}</td>
                                        <td>{{ date('d F Y', strtotime($d->tanggal)) }}</td>
                                        <td>
                                        Pending : {{ $d->pendding }} <br/>
                                        Revisi : {{ $d->revisi }} <br/>
                                        Sukses : {{ $d->sukses }}

                                        
                                        </td>
                                        <td>{{ $d->keterangan }}</td>
                                     
                                    
                        
                                            <td>
                                            <ul class="orderDatatable_actions mb-0 d-flex flex-wrap float-end">   
                                     
                                            <li>
                                                <a href="{{ route('keuangan.tasaruf.cetakdetaillihatpengajuanku', $d->id) }}" class="view">
                                                   <i class="uil uil-print"></i>
                                                </a>
                                             </li>

                                             <li>
                                                <a href="{{ route('keuangan.tasaruf.detaillihatpengajuanku', $d->id) }}" class="view">
                                                   <i class="uil uil-folder"></i>
                                                </a>
                                             </li>
                                   
                                          

                                            
                                            
                                            
                                            </ul>
        
        
                                        </td>
                                        </tr>
                                        @endforeach
                                     



                                    </tbody>
                                </table>
                            </div>

                            <div class="d-flex justify-content-end mt-15 pt-25 border-top">

                              <nav class="dm-page ">
                                <ul class="dm-pagination d-flex">
                                    {{ $data->onEachSide(2)->withQueryString()->links('pagination') }}
                                </ul>
                              </nav>


                           </div>
                            
                        </div>
                    </div>
    </div>
</div>
@endsection


