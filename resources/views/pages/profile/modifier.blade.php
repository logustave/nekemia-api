@extends('layouts.template')
@section('body')
    <div class="row ">
        <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
            <div class="card z-index-0">
                <div class="card-header text-center pt-4">
                    <h5>Modifier mon mot de passe</h5>
                </div>

                <div class="card-body">
                    <form role="form text-left"  method="post" action="{{route("editPassword")}}">
                            @csrf
{{--                        <div class="mb-3">--}}
{{--                            <label>nom et prenom:</label>--}}
{{--                            <input type="text" name="full_name" value="nom et prenom" class="form-control" placeholder="nom & prenom" aria-label="Name" aria-describedby="email-addon">--}}
{{--                        </div>--}}

{{--                        <div class="mb-3">--}}
{{--                            <label>pseudo:</label>--}}
{{--                            <input type="text" name="pseudo" value="xxx0000" class="form-control" placeholder="pseudo" aria-label="Name" aria-describedby="email-addon">--}}
{{--                        </div>--}}

{{--                        <div class="mb-3">--}}
{{--                            <label>email:</label>--}}
{{--                            <input type="email" name="email" value="xxx0000" class="form-control" placeholder="email" aria-label="Name" aria-describedby="email-addon">--}}
{{--                        </div>--}}

                        <div class="mb-3">
                            <label>Ancien mot de passe:</label>
                            <input type="password" name="old"  class="form-control" placeholder="mot de passe" aria-label="Name" aria-describedby="email-addon">
                        </div>
                        <div class="mb-3">
                            <label>nouveau mot de passe:</label>
                            <input type="password" name="new"  class="form-control" placeholder="mot de passe" aria-label="Name" aria-describedby="email-addon">
                        </div>
                        <div class="mb-3">
                            <label>confirmation mot de passe:</label>
                            <input type="password" name="repeat" class="form-control" placeholder="mot de passe" aria-label="Name" aria-describedby="email-addon">
                        </div>
                        <input type="hidden" name="id" value="{{ Session::get('user.id')[0]}}" class="form-control" placeholder="label" aria-label="Name" aria-describedby="email-addon">

                        <div class="row text-center">
                            <div class="text-center col-md-6">
                                <button type="submit"  class="btn bg-success text-white">Modifier</button>
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

@endsection
