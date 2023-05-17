@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                <section id="about" class="bg-light">
            <div class="row" style="padding-bottom: 50px;">
                <div class="col-md-2 col-sm-12">
                    <img src="{{asset('images/akreditas.png')}}" class="img-rounded" width="90%" alt="" data-aos="fade-right">
                </div>
                <div class="col-md-10 col-sm-12">
                    <h3>Terakreditasi (B) BAN-PT</h3>
                    <p style="padding: 0px 0px;" data-aos="fade-left">
                        Akreditasi Institusi Perguruan Tinggi untuk Universitas Suryakancana dengan Nomor SK: 204/SK/BAN-PT/Akred/PT/X/2018
                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Id, ea amet laborum cumque ad delectus dolore maxime quia sit autem maiores harum fuga eius at libero quibusdam eos deleniti nisi!
                    </p>
                </div>
            </div>
            <div class="row" style="padding-bottom: 50px;">
                <div class="col-md-2 col-sm-12">
                    <img src="{{asset('images/bangunan.png')}}" class="img-rounded" width="90%" alt="" data-aos="fade-right">
                </div>
                <div class="col-md-10 col-sm-12">
                    <h3>Kampus Luas, Suasa Asri & Fasilitas Lengkap</h3>
                    <p style="padding: 20px 0px;" data-aos="fade-left">
                        Universitas Suryakancana berdiri diatas lahan seluas hampir 5 Ha, mempunyai lingkungan yang asri, dengan fasilitas yang jarang dimiliki kampus lain adalah berupa lapangan sepak bola.
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aliquid impedit fugit aut maxime exercitationem ratione iste odit possimus, id tempore velit quisquam architecto eum ex at dolor, delectus nisi deleniti?
                    </p>
                </div>
            </div>
            <div class="row" style="padding-bottom: 50px;">
                <div class="col-md-2 col-sm-12">
                    <img src="{{asset('images/medal.png')}}" class="img-rounded" width="90%" alt="" data-aos="fade-right">
                </div>
                <div class="col-md-10 col-sm-12">
                    <h3>Beasiswa Mahasiswa</h3>
                    <p style="padding: 20px 0px;" data-aos="fade-left">
                        Saat ini terdapat berbagai macam beasiswa yang dapat dimanfaatkan mahasiswa baik dari Pemerintah Daerah, Pemerintah Propinsi maupun Pusat.
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Facere ratione sint reprehenderit laborum corporis corrupti maxime ea laudantium iusto vero, suscipit perferendis cumque! Commodi, pariatur. Ullam labore magni molestias excepturi.
                    </p>
                </div>
            </div>
        </div>
    </section>
                </div>
            </div>
        </div>
    </div>

@endsection
