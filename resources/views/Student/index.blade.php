@extends('layouts.studentLayout')
@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
<div class="content">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img class="d-block w-100" src="{{ asset('images/car1.jpeg') }}"  alt="First slide">
              </div>
              <div class="carousel-item">
                <img class="d-block w-100" src="{{ asset('images/car2.jpeg') }}" alt="Second slide">
              </div>
              <div class="carousel-item">
                <img class="d-block w-100" src="{{ asset('images/car0.jpeg') }}" alt="Third slide">
              </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="content">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h5 class="card-title m-0">
                Panel notificaciones
              </h5>
            </div>
            <div class="card-body table-responsive">
              <div class="row">
                <div class="col-6">
                  <div class="callout callout-info">
                    <h5>Notificacion</h5>
  
                    <p>Informacion de notificacion</p>
                  </div>
                </div>
                <div class="col-6">
                  <div class="callout callout-info">
                    <h5>Notificacion</h5>
  
                    <p>Informacion de notificacion</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>  
  </div>  
@endsection
@section('script')
<script>
    $(document).ready(function ()
{
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
})
</script>
@endsection