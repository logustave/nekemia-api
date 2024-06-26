
@extends('layouts.template')
@section('body')
    <div class="row ">
        <div class="card">
            <div class="card-header text-center pt-4">
                <h5>Informations</h5>
            </div>

            <div class="card-body">
                <form role="form text-left" enctype="multipart/form-data" method="post"  action="{{route('createBlog')}}">
                    @csrf

                    <div class="mb-3">
                        <label>nom de l'auteur:</label>

                        <input type="text" name="full_name" class="form-control" placeholder="John Doe" aria-label="Name">
                    </div>
                    <div class="mb-3">
                        <label>Categorie:</label>
                        <select name="category_id">
                            @foreach($object as $q)
                                <option value="{{$q['id']}}">{{$q['label']}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Titre:</label>
                        <input type="text" name="title" class="form-control" placeholder="titre.." aria-label="Name">
                    </div>
                    <div class="mb-3">
                        <label>Image:</label>
                        <input type="file" name="cover_path" class="form-control" aria-label="Name">
                    </div>
                    <div class="mb-3">
                        <label>Description:</label>
                        <textarea name="content"  class="form-control" id="summernote" placeholder="description..."
                                  style="resize: none" rows="8"></textarea>
                    </div>

                    <input type="hidden" name="creator_id" value="1" class="form-control" placeholder="label" aria-label="Name" aria-describedby="email-addon">


                    <div class="text-center">
                        <button type="submit" class="btn bg-success text-white w-50 my-4 mb-2">Valider</button>
                    </div>
                </form>
            </div>
        </div>

    </div>

@endsection
