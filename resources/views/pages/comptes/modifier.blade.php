@extends('layouts.template')
@section('body')
    <div class="row ">
        <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
            <div class="card z-index-0">
                <div class="card-header text-center pt-4">
                    <h5>Informations</h5>
                </div>

                <div class="card-body">
                    <form role="form text-left" method="post" action="{{route("editAdmin")}}">
                        {{csrf_field()}}
                        <div class="mb-3">
                            <label>Nom & prenom:</label>
                            <input type="text" name="full_name" value="{{$object['full_name']}}" class="form-control" placeholder="label" aria-label="Name" aria-describedby="email-addon">
                        </div>
                        <div class="mb-3">
                            <label>contact:</label>
                            <input type="number" name="contact" value="{{$object['contact']}}" class="form-control" placeholder="label" aria-label="Name" aria-describedby="email-addon">
                        </div>
                        <input type="hidden" name="id" value="{{$object['id']}}" class="form-control" placeholder="label" aria-label="Name" aria-describedby="email-addon">


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
