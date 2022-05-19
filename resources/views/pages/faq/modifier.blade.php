@extends('layouts.template')
@section('body')
    <div class="row ">
        <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
            <div class="card z-index-0">
                <div class="card-header text-center pt-4">
                    <h5>Informations</h5>
                </div>

                <div class="card-body">
                    <form role="form text-left" method="post" action="{{route("editFaq")}}">
                        {{csrf_field()}}
                        <div class="mb-3">
                            <input type="text" name="{{$objet["question"]}}" value="faq" class="form-control" placeholder="question" aria-label="Name" aria-describedby="email-addon">
                        </div>
                        <div class="mb-3">
                            <textarea name="{{$objet["answer"]}}"  class="form-control" placeholder="reponse" style="resize: none" rows="5">reponse</textarea>
                        </div>

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
