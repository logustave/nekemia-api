
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
                        <label>Question:</label>
                        {{$object['question']}}
                    </div>
                    <div class="mb-3">
                        <label>Reponse:</label>
                        {{$object['answer']}}
                    </div>
                    <div class="mb-3 text-md">
                        <label>date de publication:</label>
                        {{date('d-m-Y',strtotime($object['created_at']))}}
                    </div>

                    <div class="row text-center">
                        <div class="text-center col-md-6">
                            <a type="button" href="{{route("pageEditFaq",['id'=>$object['id']])}}" class="btn bg-success text-white">Modifier</a>
                        </div>

                        <div class="text-center col-md-5">
                            <a  href="{{route("deleteFaq",['id'=>$object['id']])}}" type="button" class="btn bg-gradient-danger ">Supprimer</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
