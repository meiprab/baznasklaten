@section('title',$title)
@extends('layout.app')
@section('content')
@php
use Carbon\Carbon;
@endphp
<div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="shop-breadcrumb">

                            <div class="breadcrumb-main">
                                <h4 class="text-capitalize breadcrumb-title">Data Kasbon </h4>
                                <div class="breadcrumb-action justify-content-center flex-wrap">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="#"><i class="las la-home"></i>Kasbon </a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Data Kasbon </li>
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
        
                <div class="row">
                    <div class="col-lg-12">
                        <div class="userDatatable orderDatatable sellerDatatable global-shadow mb-30 py-30 px-sm-30 px-20 radius-xl w-100">
                            <div class="project-top-wrapper d-flex justify-content-between flex-wrap mb-25 mt-n10">
                                <div class="d-flex align-items-center flex-wrap justify-content-center">
                                    <div class="project-search order-search  global-shadow mt-10">
                                        <form action="{{ route('pendistribusian.kasbon.searchpd') }}" class="order-search__form">
                                            <img src="{{ asset('assets/img/svg/search.svg') }}" alt="search" class="svg">
                                            <input class="form-control me-sm-2 border-0 box-shadow-none" type="search" name="keyword" placeholder="Filter by keyword" aria-label="Search">
                                        </form>
                                    </div>
                                </div>
                                <div class="content-center">
                                    <div class="button-group m-0 mt-sm-0 mt-10 order-button-group">
                                    <a href="{{ route('pendistribusian.kasbon.exportpd',['keyword'=>request('keyword')]) }}">  <button type="button" class="btn btn-warning btn-xs btn-squared">Export</button></a>

                                    <a href="{{ route('pendistribusian.kasbon.createpd') }}">  <button type="button" class="btn btn-info btn-xs btn-squared">Tambah Data</button></a>
</div>
                                </div>
                            </div>
                            <div class="table-responsive">
                            <table class="table table-border-horizontal">
                  <thead>
                     <tr>
                        <th scope="col">Nomor Transaksi</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Status</th>
                        <th scope="col">Pengajuan</th>
                        <th scope="col">Diterima</th>
                        <th scope="col" width="15%"><center>Aksi</center></th>
                     </tr>
                  </thead>
                  <tbody>
                    
                     @foreach($data as $key => $d)
                     <?php 
                     $tanggal = Carbon::parse($d['tanggal'])->format('d F Y');
                     ?>
                     <tr>
                        <td>{{ $d->kode_kasbon }}</td>
                        <td>{{ $tanggal }}</td>

                        <td>{!! $d->status == 'A' ? '<span class="badge rounded  badge-primary">ACC</span>' : ($d->status == 'N' ? '<span class="badge rounded  badge-danger">Tidak ACC</span>' : '<span class="badge rounded  badge-warning">On Proses </span>') !!}</td>         
                    
                        <td>{{ 'Rp ' . number_format($d->jumlah, 0, ',', '.')}}</td>
                   
                        <td>{{ 'Rp ' . number_format($d->jml, 0, ',', '.')}}</td>
                        <td style="text-align: right;">
                           <?php
                        if(empty($d->jml)) {
                         
                        ?>

                        <?php if($d->status=='N') { ?>
                            <span class="badge rounded  badge-danger">Silahkan buat pengajuan baru</span>

                            <?php } else { ?>
                          <ul class="orderDatatable_actions mb-0 d-flex flex-wrap float-end">
                          <li>
                                                   <a href="{{ route('pendistribusian.kasbon.cetakkeuangan', $d->id) }}" class="detail">
                                                       <i class="uil uil-print"></i>
                                                   </a>
                                                </li>
                                               <li>
                                                   <a href="{{ route('pendistribusian.kasbon.editpd', $d->id) }}" class="edit">
                                                       <i class="uil uil-edit"></i>
                                                   </a>
                                               </li>
                                               <li>
                                                   <a href="{{ route('pendistribusian.kasbon.destroypd', $d->id) }}"  onclick="return confirm('Apakah Anda Yakin ?');"  class="remove">
                                                       <i class="uil uil-trash-alt"></i>
                                                   </a>
                                               </li>
                                           </ul>
                                           <?php } ?>
                        <?php } else { 
                                                $tgl = Carbon::parse($d['tgl'])->format('d F Y');

               ?>
                      <a href="{{ route('pendistribusian.kasbon.cetakkeuangan', $d->id) }}">     <span class="badge rounded-pill badge-success">{{ $tgl }}</span></a>
                           <?php } ?>

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


