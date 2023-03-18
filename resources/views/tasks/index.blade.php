@extends('layouts.master')
@section('content')
    <section id="basic-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Ticket</h4>
                        @can('create tasks')
                            <a href="{{route('tasks.create')}}" class="btn btn-primary pull-right"><i
                                    class="feather icon-plus-square"></i> Add</a>
                        @endcan
                    </div>
                    <div class="card-content">
                        <div class="card-body card-dashboard">
                            {{--                            <p class="card-text"></p>--}}
                            <div class="table-responsive">
                                <table class="table" id="example">
                                    {{--                                <table class="table zero-configuration">--}}
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>name</th>
                                        <th>User</th>
                                        <th>File</th>
                                        <th>Status</th>
                                        <th>Options</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $('#example').DataTable({
                "ajax": {
                    'url': '{{route('tasks.index')}}',
                },
                order: [[0, 'DESC']],
                processing: true,
                serverSide: true,
                columns: [
                    {data: 'id'},
                    {data: 'text'},
                    {data: 'user'},
                    {data: 'image'},
                    {data: 'status'},
                    {data: 'options'},
                ],
            });
        });
    </script>

@endsection
