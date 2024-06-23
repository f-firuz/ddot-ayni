@extends('layouts.admin')
@section('content')
<div class="content ">
    <div class="row">
        <div class="col-lg-12">
            <div style="min-height: 350px;" class="card shadow p-3 mb-5 bg-body-tertiary rounded">
                <div class="card-header " style="color: #ff6a00; font-weight: bold ; background-color:white;">
                    Профиль
                </div>

                <div class="card-body">
                    @if(session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif


                    <div class="profiles-container ">
                        <div class="profiles-block">
                            <div class="card border-0" style="width: 18rem;">
                                <img src="https://png.pngtree.com/png-vector/20220709/ourmid/pngtree-businessman-user-avatar-wearing-suit-with-red-tie-png-image_5809521.png" class="card-img-top bd-placeholder-img rounded-circle" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title text-center">ФИО - {{ auth()->user()->name }}</h5>
                                </div>
                            </div>
                        </div>
                        <div class="profiles-block">
                            <form class="row g-3">
                                <p>
                                    <!-- <div class="col-md-6">
                                    <label for="inputEmail4" class="form-label">Имя</label>
                                    <input type="email" class="form-control" id="name" name="name">
                                </div> -->
                                </p>
                                <div class="col-md-6">
                                    <label for="inputEmail4" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email">
                                </div>
                                <div class="col-md-6">
                                    <label for="inputPassword4" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password">
                                </div>


                                <div class="col-12 pt-3">
                                    <button type="submit" class="btn btn-outline-dark">Сохранить</button>
                                </div>
                            </form>

                        </div>
                    </div>
                    <div class="container">
                        <h3 class="text-center pb-4">Сегодняшние уроки</h3>
                        <table class="table">
                            <thead>
                                <th>№</th>
                                <th>ФИО</th>
                                <th>Факультет</th>
                                <th>Специальности</th>
                                <th>Предмет</th>
                                <th>Аудитория</th>
                            </thead>
                            <tbody>
                                @foreach ($less as $key => $lessons )
                                    <tr>
                                        <td>{{$lessons->id}}</td>
                                        <td>{{$lessons->teacher->name }}</td>
                                        <td>{{$lessons->facultets->name}}</td>
                                        <td>{{$lessons->specialtys->name}}</td>
                                        <td>{{$lessons->subjects->name}}</td>
                                        <td>{{$lessons->audiences->name}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent

@endsection