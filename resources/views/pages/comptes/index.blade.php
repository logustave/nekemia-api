@extends('layouts.template')
@section('body')
    <div class="row">
        <div class="col-12">
            <a type="button" href="{{route("pageAddCompte")}}" class="btn bg-warning text-white">Ajouter</a>

            <div class="card mb-4">

                <div class="card-header pb-0">
                    <h4>Liste des Comptes Admins</h4>

                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nom et prenom</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">pseudo</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">contact</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">email</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date creation</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($admin as $q)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h4 class="mb-0 text-sm">{{$q['full_name']}}</h4>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{$q['pseudo']}}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{$q['contact']}}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{$q['email']}}</p>
                                        </td>

                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{date('d-m-Y',strtotime($q['created_at']))}}</span>
                                        </td>
                                        <td>
                                        <a class="px-3 mb-0 btn btn-outline-primary" href="{{route("seeAdmin",['id'=>$q['id']])}}"
                                           type="button">Voir</a>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
