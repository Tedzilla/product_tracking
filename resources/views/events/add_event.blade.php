@extends('layouts.app')

@section('content')

    <div class="container" id="page-intro">
        <div class="row justify-content-center">
            <div class="col-12">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li style="font-size: 2em">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="col-lg-12"><h1>Events</h1></div>
                <div class="mt50">
                    <form action="{{ route('search_events')  }}" method="GET">
                        <div class="col-12">
                            <div class="col-md-2"><label>&nbsp;</label>
                                <button type="submit" class="btn btn-secondary btn-link-opacity"
                                        style="width: 100%;background-color:#9FE2BF;" id="search">Search
                                </button>
                            </div>
                            <div class="col-md-10"><label>&nbsp;</label><input
                                    placeholder="Search by Serial No. / Article No." type="text" name="search"
                                    class="form-control" id="search_val" required></div>
                        </div>
                    </form>
                    <br><br><br>
                    <br/><br/><br/><br/><br/>
                    <hr>
                    <form action="{{ route('add_events') }}" method="POST">
                        @csrf
                        <div class="col-md-8">
                            <p>

                                <label>Date of the event *</label>
                                <span id="error_date" style="color: #fc4103;"></span>
                                <input placeholder="Date of the event (Format: 31-01-2000)" type="text" name="created_at"
                                       class="form-control" required="true" id="date_of_the_event"
                                       value="{{ $history[0]->created_at ?? '' }}">
                            </p><br/>
                            <p><label>Variety</label><input placeholder="Variety (exact description)" type="text"
                                                            name="name" class="form-control" required="true"
                                                            id="description"
                                                            value="{{ $history[0]['data']->name ?? '' }}"></p><br/>
                            <p><label>CIP</label><input placeholder="CIP (cents / piece)" type="text" name="price_per_piece"
                                                        class="form-control" required="true" id="cents_piece"
                                                        value="{{ $history[0]['data']->price_per_piece ?? '' }}">
                            </p>
                            <br/>
                            <p><label>Content</label><input placeholder="Content (pieces)" type="text" name="pieces"
                                                            class="form-control" required="true" id="pieces"
                                                            value="{{ $history[0]['data']->pieces ?? '' }}"></p>
                            <br/>
                            <p><label>Package price</label><input placeholder="Package price (EUR)" type="text"
                                                                  name="package_price" class="form-control" required="true"
                                                                  id="price"
                                                                  value="{{ $history[0]['data']->package_price ?? '' }}">
                            </p><br/>
                        </div>
                        <p><input type="hidden" id="product_id" name="product_id" value="{{$history[0]->product_id ?? ''}}"></p><br/>
                        <div class="col-md-4">
                            <p><label>Serial No.</label><input placeholder="Serial No." type="text" name="serial_number"
                                                               class="form-control" required="true" id="serial_no"
                                                               readonly
                                                               value="{{ $history[0]['serial_number'] ?? '' }}">
                            </p><br/>
                            <p><label>Article No.</label><input placeholder="Article No." type="text" name="artikul_number"
                                                                class="form-control" required="true" id="article_no"
                                                                readonly
                                                                value="{{ $history[0]['artikul_number'] ?? '' }}">
                            </p><br/>

                            <p><label>Status</label><select name="status" class="form-control" required="true"
                                                            id="event_status">
                                    <option
                                        {{old('status',$history[0]['data']->status ?? '')=="active"? 'selected':''}}  value="active">
                                        Active
                                    </option>
                                    <option
                                        {{old('job_status',$history[0]['data']->status ?? '')=="inactive"? 'selected':''}} value="inactive">
                                        Inactive
                                    </option>
                                    <option
                                        {{old('job_status',$history[0]['data']->status ?? '')=="deleted"? 'selected':''}} value="deleted">
                                        Deleted
                                    </option>
                                </select></p>
                            <br/>

                            <p><label>State</label><select name="state" class="form-control" required="true"
                                                           id="event_state">
                                    <option
                                        {{old('state',$history[0]['data']->state ?? '')=="new"? 'selected':''}}  value="new">
                                        New
                                    </option>
                                    <option
                                        {{old('state',$history[0]['data']->state ?? '')=="announced"? 'selected':''}}  value="announced">
                                        Announced
                                    </option>
                                    <option
                                        {{old('state',$history[0]['data']->state ?? '')=="terminated"? 'selected':''}}  value="terminated">
                                        Terminated
                                    </option>
                                </select></p>
                            <br/>

                            <p>
                                <button type="submit" class="btn btn-secondary btn-link-opacity" style="width: 100%"
                                        id="add_event">Add Event
                                </button>
                            </p>
                        </div>
                    </form>
                    <div class="col-md-12">
                        <hr>
                    </div>
                    <div class="col-12">
                        <div class="col-lg-12">
                            @if(isset($history) && isset($history[1]))
                                <table id="events_log" class="table table-bordered nowrap" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>Date of the event</th>
                                        <th>Serial No.</th>
                                        <th>Article No.</th>
                                        <th>Variety (exact description)</th>
                                        <th>CIP (cents / piece)</th>
                                        <th>Content (pieces)</th>
                                        <th>Package price (EUR)</th>
                                        <th>Status</th>
                                        <th>State</th>
                                    </tr>
                                    </thead>

                                    @foreach($history as $id => $event)
                                        <?php if ($id < 1) {
                                            continue;
                                        }?>
                                        <tr>
                                            <td>{{$event['created_at']}}</td>
                                            <td>{{$event['serial_number']}}</td>
                                            <td>{{$event['artikul_number']}}</td>
                                            <td>{{$event['data']->name}}</td>
                                            <td>{{$event['data']->price_per_piece}}</td>
                                            <td>{{$event['data']->pieces}}</td>
                                            <td>{{$event['data']->package_price}}</td>
                                            <td>{{$event['data']->status}}</td>
                                            <td>{{$event['data']->state}}</td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
