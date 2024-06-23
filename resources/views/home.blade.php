@extends('layouts.admin')
@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-12 p-3">
            <div class="card  p-3 mb-5 bg-body-tertiary rounded">
            <div class="card-header " style="color: #ff6a00; font-weight: bold ; background-color:white;" >
                    Главная
                </div>

                <div class="card-body" style="height: calc(80vh - 55px);">



                <div class="row">
                    <div class="col-sm-4 mb-3 mb-sm-0">
                        <div class="card  ">
                            <div class="card-body">
                                <h5 class="card-title  text-"  >Факультеты</h5>
                                <p class="card-text">14</p>
                                <a href="#" class="btn  btn-p text-white " style="background-color:#f59128" >Вперед <i class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card  ">
                            <div class="card-body">
                                <h5 class="card-title">Специальносты </h5>
                                <p class="card-text">76</p>
                                <a href="#" class="btn  text-white" style="background-color:#f59128">Вперед <i class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card  ">
                            <div class="card-body">
                                <h5 class="card-title">Курсы</h5>
                                <p class="card-text">5</p>
                                <a href="#" class="btn text-white" style="background-color:#f59128"> Вперед<i class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4 mb-3 mb-sm-0">
                        <div class="card  ">
                            <div class="card-body">
                                <h5 class="card-title">Договорной</h5>
                                <p class="card-text">5000</p>
                                <a href="#" class="btn text-white" style="background-color:#f59128">Вперед <i class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card  ">
                            <div class="card-body">
                                <h5 class="card-title">Бюджет</h5>
                                <p class="card-text">200</p>
                                <a href="#" class="btn text-white" style="background-color:#f59128">Вперед <i class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                   
                </div>



                
                    @if(session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent

@endsection
