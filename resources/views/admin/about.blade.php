@extends('layouts.admin')

@section('admin')
    @include('inc.admin.action-navbar')

    <div>
        <table class="table table-striped custom-table table-sm">
            <thead class="thead-dark">
            <tr>
                <th scope="col"></th>
                <th scope="col">Project Title</th>
                <th scope="col">Categoty</th>
                <th scope="col">Description</th>
                <th scope=""></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th scope="row" class="text-center">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
                <td class="text-center">
                    <a href="#">
                        <i class="fa fa-times text-danger mx-1"></i>
                    </a>

                    <a href="#">
                        <i class="fa fa-pencil text-success mx-1"></i>
                    </a>
                </td>
            </tr>
            <tr>
                <th scope="row" class="text-center">2</th>
                <td>Jacob</td>
                <td>Thornton</td>
                <td>@fat</td>
                <td class="text-center">
                    <a href="#">
                        <i class="fa fa-times text-danger mx-1"></i>
                    </a>

                    <a href="#">
                        <i class="fa fa-pencil text-success mx-1"></i>
                    </a>
                </td>
            </tr>
            <tr>
                <th scope="row" class="text-center">3</th>
                <td>Larry</td>
                <td>the Bird</td>
                <td>@twitter</td>
                <td class="text-center">
                    <a href="#">
                        <i class="fa fa-times text-danger mx-1"></i>
                    </a>

                    <a href="#">
                        <i class="fa fa-pencil text-success mx-1"></i>
                    </a>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
@endsection
