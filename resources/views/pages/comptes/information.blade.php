
@extends('layouts.template')
@section('body')
    <div class="row ">
        <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
            <div class="card z-index-0">
                <div class="card-header text-center pt-4">
                    <h5>Informations</h5>
                </div>

                <div class="card-body">
                    <div class="mb-3">
                        <label>nom & prenom:</label>
                        {{$object['full_name']}}
                    </div>
                    <div class="mb-3">
                        <label>pseudo:</label>
                        {{$object['pseudo']}}
                    </div>
                    <div class="mb-3">
                        <label>contact:</label>
                        {{$object['contact']}}
                    </div>
                    <div class="mb-3">
                        <label>email:</label>
                        {{$object['email']}}
                    </div>
                    <div class="mb-3 text-md">
                        <label>date de creation:</label>
                        {{date('d-m-Y',strtotime($object['created_at']))}}

                    </div>

                    <div class="row text-center">
                        <div class="text-center col-md-6">
                            <a type="button" href="{{route("pageEditCompte",['id'=>$object['id']])}}" class="btn bg-success text-white">Modifier</a>
                        </div>

                        <div class="text-center col-md-6">
                            <a type="button" class="btn bg-gradient-danger w-100" href="{{route("deleteCompte",['id'=>$object['id']])}}">Supprimer</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
