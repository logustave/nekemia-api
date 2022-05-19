@extends('layouts.template')
@section('body')
    <div class="row ">
        <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
            <div class="card z-index-0">
                <div class="card-header text-center pt-4">
                    <h5>Informations</h5>
                </div>

                <div class="card-body">
                    <form role="form text-left" method="post" action="{{route("createCompte")}}">
                        {{csrf_field()}}
                        <div class="mb-3">
                            <label>Nom & prenom:</label>
                            <input type="text" name="full_name" class="form-control" placeholder="nom prenom" aria-label="Name" aria-describedby="email-addon">
                        </div>
                        <div class="mb-3">
                            <label>pseudo:</label>
                            <input type="text" name="pseudo"  class="form-control" placeholder="pseudo" aria-label="Name" aria-describedby="email-addon">
                        </div>
                        <div class="mb-3">
                            <label>contact:</label>
                            <input type="number" name="contact"  class="form-control" placeholder="contact" aria-label="Name" aria-describedby="email-addon">
                        </div>
                        <div class="mb-3">
                            <label>email:</label>
                            <input type="text" name="email"  class="form-control" placeholder="email" aria-label="Name" aria-describedby="email-addon">
                        </div>
                        <div class="row text-center">
                            <div class="text-center col-md-6">
                                <button type="submit"  class="btn bg-success text-white">Creer</button>
                            </div>
                            <div class="text-center col-md-5">
                                <a type="button" class="btn bg-gradient-danger w-100" href="{{url()->previous()}}">Retour</a>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <style>
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
@endsection
