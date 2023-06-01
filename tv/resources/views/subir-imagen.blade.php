@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('Carga de imágenes') }}
                        <button type="button" class="btn btn-primary" data-toggle="modal"
                            data-target="#nuevoModal">Nuevo</button>

                        <!-- Modal -->
                        <div class="modal fade" id="nuevoModal" tabindex="-1" role="dialog"
                            aria-labelledby="nuevoModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="nuevoModalLabel">Cargar Imagen</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('guardar-imagen') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <input type="file" name="imagen">
                                            <button type="submit" class="btn btn-primary">Subir Imagen</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <table id="myTable" class="display">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Nombre</th>
                                    <th>URL</th>
                                    <th>Miniatura</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datos as $registro)
                                    <tr>
                                        <td> {{ $registro->id }} </td>
                                        <td> {{ $registro->nombre }} </td>
                                        <td> {{ $registro->url }} </td>
                                        <td> <img src="{{ asset($registro->url) }}" width="100" height="100"></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <!-- Incluye jQuery -->

    <!-- Incluye los scripts de Bootstrap -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
@endsection
