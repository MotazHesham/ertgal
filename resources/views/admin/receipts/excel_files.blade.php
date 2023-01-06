@extends('layouts.app')

@section('content')

<!-- Basic Data Tables -->
<!--===================================================-->
<div class="panel">
    <div class="panel-heading" style="padding:10px">
        <h3 class="text-center">{{__('Excel Files')}}</h3>
    </div>
    <div class="panel-body">
        <table class="table table-striped table-bordered demo-dt-basic" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{__('Type')}}</th>
                    <th>{{__('Results')}}</th>
                    <th>{{__('Uploaded File')}}</th>
                    <th>{{__('Result File')}}</th>
                    <th>{{__('Created At')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($excel_files as $key => $row)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>
                            {{$row->type}}
                        </td>
                        <td>
                            @foreach(json_decode($row->results) as $key => $res)
                                <span class="badge @if($key == 'accepted') badge-success @else badge-danger @endif">
                                    {{$key}} => {{$res}}
                                </span>
                            @endforeach
                        </td>
                        <td><a href="{{asset($row->uploaded_file)}}" class="btn btn-warning">Download</a></td>
                        <td><a href="{{asset($row->result_file)}}" class="btn btn-success">Download</a></td>
                        <td>{{$row->created_at}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>

@endsection
