@extends('layouts.template')
@section('body')
    <div class="row ">
        <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
            <div class="card z-index-0">
                <div class="card-header text-center pt-4">
                    <h5>Informations</h5>
                </div>

                <div class="card-body">
                    <form role="form text-left" method="post" action="{{route("editCategory")}}">
                        {{csrf_field()}}
                        <div class="mb-3">
                            <label>Nom:</label>
                            <input type="text" name="label" value="{{$object['label']}}" class="form-control" placeholder="label" aria-label="Name" aria-describedby="email-addon">
                        </div>
                        <div class="mb-3">
                            <label>Description:</label>
                            <textarea name="description"  class="form-control" placeholder="Description" style="resize: none" rows="5">{{$object['description']}}</textarea>
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

@endsection
