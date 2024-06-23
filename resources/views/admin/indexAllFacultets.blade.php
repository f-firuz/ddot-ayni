
@extends('layouts.admin')
@section('content')
<div class=" shadow p-3 " style="background-color: white">
            <form class="row gx-3 gy-1 align-items-center pb-2"
                  method="POST" action="{{ route("admin.getAllfacultets.index") }}" enctype="multipart/form-data">
                @csrf
                <div class="col-sm-8">
                    <label class="visually-hidden" for="faculties">Факультеты</label>
                    <select class="form-select form-control {{ $errors->has('name') ? 'is-invalid' : '' }} " id="faculties" name="faculties"  required >
                        <option selected ></option>
                        @foreach($facultets as $key => $spec)
                            <option value="{{$spec->id }}">{{$spec->name}}</option>
                        @endforeach
                    </select>
              
                </div>
                <div class="col-sm-3">
                    <label class="visually-hidden" for="cour">Курсы</label>
                    <select class="form-select form-control" id="cours" name="cours"  required>
                        <option selected></option>
                        @foreach($cours as $key => $cour)
                            <option value="{{$cour->id}}">{{$cour->cours}}</option>
                        @endforeach
                    </select>
                </div>

            
                
                <div class="col-auto mt-4">
                    <button type="submit" class="btn text-white"  style="background-color:#f59128">Поиск</button>
                </div>
            </form>
        </div>


@endsection
@section('scripts')
    @parent
@endsection

<style>
    form {
        font-size: 0.8em;
    }
    form select  option{
        font-size: 0.8em;
    }
</style>