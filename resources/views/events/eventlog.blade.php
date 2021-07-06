@extends('layouts.app')

@section('content')
    <div class="container" id="page-intro">
        <div class="row justify-content-center">
            <div class="col-12">
                <h1>Events log</h1>
                <div class="mt50">
                    <table id="events_log" class="table table-bordered nowrap" style="width:100%">
                        <thead>
                        <tr>
                            <th>@sortablelink('created_at', 'Date created')</th>
                            <th>@sortablelink('serial_number', 'Serial number')</th>
                            <th>Article No.</th>
                            <th>Variety (exact description)</th>
                            <th>CIP (cents / piece)</th>
                            <th>Content (pieces)</th>
                            <th>Package price (EUR)</th>
                            <th>Status</th>
                            <th>State</th>
                            @can('deactivate')
                            <th>Set Inactive</th>
                            @endcan
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($events as $id => $history)
                            <?php
                                $history_data = json_decode($history['data']);
                                $inactive_class = ( ! $history['active']) ? ' class="warning" ' : '';
                            ?>
                            <tr<?php echo $inactive_class;?>>
                                <td>{{$history['created_at']}}</td>
                                <td>{{$history['serial_number']}}</td>
                                <td>{{$history['artikul_number']}}</td>
                                <td>{{$history_data->name}}</td>
                                <td>{{$history_data->price_per_piece}}</td>
                                <td>{{$history_data->pieces}}</td>
                                <td>{{$history_data->package_price}}</td>
                                <td>{{$history_data->status}}</td>
                                <td>{{$history_data->state}}</td>
                                @can('deactivate')
                                <td><button type="button" onclick="setStatus(this.id)" class="btn btn-default"
                                                id="{{$history['id']}}" value= aria-label="" ><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button></td>
                                @endcan
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <form action="{{ route('events') }}" method="GET">
                    <label>Page Size</label><select name="page_size" class="form-control" onchange="this.form.submit()">
                        <option {{old('page_size', Request::get('page_size'))=="20"? 'selected':''}} value="20">20</option>
                        <option {{old('page_size', Request::get('page_size'))=="40"? 'selected':''}} value="40">40</option>
                        <option {{old('page_size', Request::get('page_size'))=="80"? 'selected':''}}  value="80">80</option>
                    </select>
                </form>
                {!! $events->appends(\Request::except('page'))->render() !!}
            </div>
        </div>
    </div>
@endsection

<script type="application/javascript">
    function setStatus(id) {
        let _token = $('meta[name="csrf-token"]').attr('content');
        let this_obj = document.getElementById(id);
        $.ajax({
            type: 'POST',
            url: '{{ route("deactivate") }}',
            data: {
                _token: _token,
                'id': id
            },
            success: function (data) {
                data['success'] == 1 ?
                    this_obj.parentElement.parentElement.classList.remove('warning') :
                    this_obj.parentElement.parentElement.classList.add('warning');
            }
        });
    }
</script>
