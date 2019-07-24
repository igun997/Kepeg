@extends("app.layout_kepeg")
@section("title",$title)
@section("content")
<div class="col-lg-12">
  <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-file"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Cuti</span>
                <span class="info-box-number">
                  {{\App\Models\Cuti::count()}}
                </span>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-file"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Kenaikan</span>
                <span class="info-box-number">
                  {{\App\Models\Kenaikan::count()}}
                </span>
              </div>
            </div>
          </div>
          <div class="clearfix hidden-md-up"></div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-file"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Pensiun</span>
                <span class="info-box-number">
                  {{\App\Models\Pensiun::count()}}
                </span>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-file"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Mutasi</span>
                <span class="info-box-number">
                  {{\App\Models\Mutasi::count()}}
                </span>
              </div>
            </div>
          </div>
  </div>

</div>
<div class="col-lg-12">
  <div class="card">
    <div class="card-header">
      <h5 class="m-0">Statistik</h5>
    </div>
    <div class="card-body">
        {!! $chart->render() !!}
    </div>
  </div>
</div>

@endsection
