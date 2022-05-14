
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
                        <label>Nom & prenoms:</label>
                        full_name
                    </div>
                    <div class="mb-3">
                        <label>pseudo:</label>
                        Nom
                    </div>
                    <div class="mb-3">
                        <label>email:</label>
                        Nom
                    </div>
                    <div class="mb-3 text-md">
                        <label>date de creation:</label>
                        12/01/2002

                    </div>

                    <div class="row text-center">
                        <div class="text-center col-md-6">
                            <a type="button" href="/profile/modifier/1" class="btn bg-success text-white">Modifier</a>
                        </div>

                        <div class="text-center col-md-5">
                            <button type="button" class="btn bg-gradient-danger w-100">Supprimer</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
