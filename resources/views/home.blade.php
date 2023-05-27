@extends('adminlte::page')
@section('title', 'Dashboard')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
                <section id="about" class="bg-light" style="padding-top:20px">
                    
            <div class="row" style="padding-bottom: 50px;">
                <div class="col-md-2 col-sm-12">
                    <img src="{{asset('images/akreditas.png')}}" class="img-rounded" width="90%" alt="" data-aos="fade-right">
                </div>
                <div class="col-md-10 col-sm-12">
                    <h3>Visi</h3>
                    <p style="padding: 0px 0px;" data-aos="fade-left">
                    Menjadi Sekolah Menengah Kejuruan yang menghasilkan lulusan yang religius, budaya, Berkualitas, Kreatif dan Inovatif serta menciptakan lulusan yang mampu bersaing di Pasar Global Tahun 2022
                    </p>
                </div>
            </div>
            <div class="row" style="padding-bottom: 50px;">
                <div class="col-md-2 col-sm-12">
                    <img src="{{asset('images/bangunan.png')}}" class="img-rounded" width="90%" alt="" data-aos="fade-right">
                </div>
                <div class="col-md-10 col-sm-12">
                    <h3>Misi</h3>
                    <ul style="padding: 20px 0px;" data-aos="fade-left">
                <li>Melengkapi Sarana dan Prasarana Praktek untuk pembelajaran pendidikan yang berkualitas dilandasi dengan iman dan taqwa.</li>
                <li>Meningkatkan proses pendidikan yang berorientasi pada kompetensi profesional dengan memanfaatkan TI (Teknologi Informasi) sebagai media informasi.</li>
                <li>Menerapkan pola pembelajaran yang berorientasi pada dunia usaha dan industri dengan mengembangkan unit-unit produksi dan kelas wirausaha.</li>
                <li>Meningkatkan kerjasama dengan DU/DI sebagai sarana praktek pembelajaran.</li>
                <li>Meningkatkan budaya lokal untuk membentuk karakter bangsa.</li>
                </ul>
                </div>
            </div>
    </section>
                </div>


@stop
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script>
        AOS.init();
</script>