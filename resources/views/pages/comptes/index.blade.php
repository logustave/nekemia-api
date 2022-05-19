@extends('layouts.template')
@section('body')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h4>Liste des Comptes Admins</h4>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nom & prenom</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">pseudo</th>

                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Mail</th>

{{--                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>--}}
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date creation</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h4 class="mb-0 text-sm">full_name</h4>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0">pseudo</p>
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0">mail</p>
                                </td>

{{--                                <td class="align-middle text-center text-sm">--}}
{{--                                    <span class="badge badge-sm bg-gradient-success">Online</span>--}}
{{--                                </td>--}}
                                <td class="align-middle text-center">
                                    <span class="text-secondary text-xs font-weight-bold">23/04/18</span>
                                </td>

                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
