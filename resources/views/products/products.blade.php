@extends('layouts.app')

@section('content')
<div class="container-fluid" id="products">
<div class="container">
   <form id="search_products" action="/public/products/search_products" method="POST">
      {{ csrf_field() }}
      <div class="row justify-content-center">
         <div class="col">
             <h1>total products: {{\App\Models\Product::count()}}</h1>
            <div class="search-box d-flex justify-content-center">
               <div class="dropdown  show mr-3"> <a class="radio-filter-dd" href="#" role="button" id="dropdownFilter"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> </a>
                  <div class="dropdown-menu" aria-labelledby="dropdownFilter">
                     <div class="d-flex radio-filter-box">
                        <div class="radio-filter radio-filter-status">
                           <h4>Status</h4>
                           <div class="custom-control custom-radio">
                              <input class="custom-control-input" type="radio" name="statusFilter"
                                                       id="statusAll" value="active,inactive,deleted" checked>
                              <label class="custom-control-label" for="statusAll"> All </label>
                           </div>
                           <div class="custom-control custom-radio">
                              <input class="custom-control-input" type="radio" name="statusFilter"
                                                       id="statusActive"
                                                       value="active" {{old('status_search', Request::get('status_search'))=="active"? 'checked':''}}>
                              <label class="custom-control-label" for="statusActive"> Aktive </label>
                           </div>
                           <div class="custom-control custom-radio">
                              <input class="custom-control-input" type="radio" name="statusFilter"
                                                       id="statusInaktive"
                                                       value="inactive" {{old('status_search', Request::get('status_search'))=="inactive"? 'checked':''}}>
                              <label class="custom-control-label" for="statusInaktive"> Inaktive </label>
                           </div>
                           <div class="custom-control custom-radio">
                              <input class="custom-control-input" type="radio" name="statusFilter"
                                                       id="statusDeleted"
                                                       value="deleted" {{old('status_search', Request::get('status_search'))=="deleted"? 'checcked':''}} >
                              <label class="custom-control-label" for="statusDeleted"> Deleted </label>
                           </div>
                           <select name="status_search" class="form-control" id="add_product_status"
                                                    hidden="">
                              <option value="active,inactive,deleted">all</option>
                              <option
                                                    {{old('status_search', Request::get('status_search'))=="active"? 'selected':''}} value="active">

                                                    Aktive

                              </option>
                              <option
                                                    {{old('status_search', Request::get('status_search'))=="inactive"? 'selected':''}} value="inactive">

                                                    Inaktiv

                              </option>
                              <option
                                                    {{old('status_search', Request::get('status_search'))=="deleted"? 'selected':''}} value="deleted">

                                                    Gelöscht

                              </option>
                           </select>
                        </div>
                        <div class="radio-filter radio-filter-state">
                           <h4>State</h4>
                           <div class="custom-control custom-radio">
                              <input class="custom-control-input" type="radio" name="stateFilter"
                                                       id="stateAll" value="active,inactive,deleted" checked>
                              <label class="custom-control-label" for="stateAll"> All </label>
                           </div>
                           <div class="custom-control custom-radio">
                              <input class="custom-control-input" type="radio" name="stateFilter"
                                                       id="stateNew"
                                                       value="new" {{old('state_search', Request::get('state_search'))=="new"? 'checked':''}}>
                              <label class="custom-control-label" for="stateNew"> New </label>
                           </div>
                           <div class="custom-control custom-radio">
                              <input class="custom-control-input" type="radio" name="stateFilter"
                                                       id="stateAnnounced"
                                                       value="announced" {{old('state_search', Request::get('state_search'))=="announced"? 'checked':''}}>
                              <label class="custom-control-label" for="stateAnnounced"> Announced </label>
                           </div>
                           <div class="custom-control custom-radio">
                              <input class="custom-control-input" type="radio" name="stateFilter"
                                                       id="stateTerminated"
                                                       value="terminated" {{old('state_search', Request::get('state_search'))=="terminated"? 'checked':''}}>
                              <label class="custom-control-label" for="stateTerminated"> Discontinued </label>
                           </div>
                           <select name="state_search" class="form-control" id="add_product_state"
                                                    hidden="">
                              <option value="new,announced,terminated">all</option>
                              <option
                                                    {{old('state_search', Request::get('state_search'))=="new"? 'selected':''}} value="new">

                                                    Neu

                              </option>
                              <option
                                                    {{old('state_search', Request::get('state_search'))=="announced"? 'selected':''}} value="announced">

                                                    Angekündigt

                              </option>
                              <option
                                                    {{old('state_search', Request::get('state_search'))=="terminated"? 'selected':''}} value="terminated">

                                                    Abgekündigt

                              </option>
                           </select>
                        </div>
                     </div>
                     <div class="w-100 text-center mt-3">
                        <button class="btn orange" id="send-form">Apply</button>
                     </div>
                  </div>
               </div>
               <div class="text-search-box form-group d-flex">
                  <div class="text-search">
                     <input placeholder="Search..." type="text" name="name_search" class="form-control"
                                           id="search_val" value="{{Request::get('name_search')}}">
                  </div>
                  <button type="submit" class="btn orange" id="search" name="search" value="1">Search </button>
               </div>
            </div>
         </div>
      </div>
   </form>
   <div class="row">
      <div class="col d-flex justify-content-between">
         <h1 class="align-self-center">Products List</h1>
         <div class="">
            <button type="button" class="btn orange" data-toggle="modal" data-target="#productModal"> Add product </button>
            <div class="modal" id="productModal" tabindex="-1" role="dialog"
                             aria-labelledby="productModalLabel" aria-hidden="true">
               <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-body">
                        <div class="d-flex justify-content-between mb-3">
                           <h2 class="modal-title" id="productModalLabel">Add new product</h2>
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                        </div>
                        @if ($errors->any())
                        @if ($errors->has('create'))
                        <script type="text/javascript">
                                                    $(document).ready(function () {
                                                        $('#productModal').modal('show');
                                                    });
                                                </script>
                        @endif
                        <div class="alert alert-danger">
                           <ul>
                              @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                              @endforeach
                           </ul>
                        </div>
                        @endif
                        <form action="{{ action('ProductController@create') }}" method="post"
                                              id="add-product">
                           @csrf
                           <div class="form-group row">
                              <div class="col-lg-8 mb-1">
                                 <label for="name">Product description:</label>
                                 <input type="text" id="name" name="name" class="form-control"
                                                           value="{{old('name')}}">
                              </div>
                              <div class="col-lg-4 mb-1">
                                 <label for="article">Article No:</label>
                                 <br>
                                 <input type="text" id="article" name="artikul_number"
                                                           class="form-control" value="{{old('artikul_number')}}">
                              </div>
                              <div class="col-lg-4 mb-1">
                                 <label for="sprice">Single price (cents/piece):</label>
                                 <input type="text" id="sprice" name="price_per_piece"
                                                           class="form-control" value="{{old('price_per_piece')}}">
                              </div>
                              <div class="col-lg-4 mb-1">
                                 <label for="pieces">Content (pieces):</label>
                                 <input type="text" id="pieces" name="pieces" class="form-control"
                                                           value="{{old('pieces')}}">
                              </div>
                              <div class="col-lg-4 mb-1">
                                 <label for="pprice">Package price (EUR):</label>
                                 <input type="text" id="price" name="package_price"
                                                           class="form-control" value="{{old('package_price')}}">
                              </div>
                              <div class="col-lg-6 mb-1">
                                 <label for="status">Status</label>
                                 <select id="status" name="status" class="form-control">
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                    <option value="deleted">Deleted</option>
                                 </select>
                              </div>
                              <div class="col-lg-6 mb-1">
                                 <label for="state">State</label>
                                 <select id="state" name="state" class="form-control">
                                    <option value="new">New</option>
                                    <option value="announced">Announced</option>
                                    <option value="discounted">Discounted</option>
                                 </select>
                              </div>
                              <div class="col-6 text-right mt-3">
                                 <button data-dismiss="modal" class="btn grey" id="clearForm"> {{ __('Cancel') }} </button>
                              </div>
                              <div class="col-6 mt-3">
                                 <button type="submit" class="btn orange"> {{ __('Save') }} </button>
                              </div>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

<div class="tableHolder my-3">
<table class="tableList">
   <thead>
      <tr>
         <th class="add_br" scope="col" data-sort="current_number">@sortablelink('current_number', 'Serial No')</th>
         <th scope="col" data-sort="name">@sortablelink('name', 'Product description')</th>
         <th class="add_br" scope="col" data-sort="artikul_number">@sortablelink('artikul_number', 'Article No')</th>
         <th class="add_br" scope="col" data-sort="price_per_piece">@sortablelink('price_per_piece', 'Single price (cents)')</th>
         <th class="add_br" scope="col" data-sort="pieces">@sortablelink('pieces', 'Content (pieces)')</th>
         <th class="add_br" scope="col" data-sort="package_price">@sortablelink('package_price', 'Package price (EUR)')</th>
         <th scope="col" data-sort="status">@sortablelink('status', 'Status')</th>
         <th scope="col" data-sort="state">@sortablelink('state', 'State')</th>
         <th scope="col" ></th>
      </tr>
   </thead>
   <tbody>

   @foreach($products as $product)
   <tr>
      <td>{{ $product['current_number'] }}</td>
      <td>{{ $product['name'] }}</td>
      <td>{{ $product['artikul_number'] }}</td>
      <td><span class="piece_price">{{ $product['price_per_piece'] }}</span></td>
      <td>{{ $product['pieces'] }}</td>
      <td><span class="pack_price">{{ $product['package_price'] }}</span></td>
      <td class="{{ $product['status'] }} prod_status">{{ $product['status'] }}</td>
      <td  class='text-capitalize'>{{ $product['state'] }}</td>
		<td>
			<div class="dropdown align-self-center">
               <div class="dropdown-toggle" id="dropdownProductEdit" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<img src="{{ asset('images/more_options_dots.svg') }}" alt="Edit menu">
				</div>
               <div class="dropdown-menu" aria-labelledby="dropdownProductEdit">
						@if($product->history && count($product->history) > 1)
						<a id="history-btn" type="button" class="dropdown-item" data-toggle="modal"
                                    data-target="#historyModal"
                                    data-attr="{{ $product->history }}"> History </a>
						@else
						<a id="edit-btn" type="button" class="dropdown-item" data-toggle="modal"
                                data-target="#editModal"
                                data-attr="{{ $product }}"> Edit </a>
						@endif
					</div>
            </div>
			</td></tr>
   @endforeach
      </tbody>

</table>
</div>
	<div class="d-flex justify-content-between">
<form action="{{ route('products') }}" method="GET">
	<div class="d-flex">
		<p>Display:</p>
		<select name="page_size" class="form-control" onchange="this.form.submit()">
			<option {{old('page_size', Request::get('page_size'))=="20"? 'selected':''}} value="20">
			20
			</option>
			<option {{old('page_size', Request::get('page_size'))=="40"? 'selected':''}} value="40">
			40
			</option>
			<option {{old('page_size', Request::get('page_size'))=="80"? 'selected':''}}  value="80">
			80
			</option>
		</select>
	</div>
</form>
{!! $products->appends(\Request::except('page'))->render() !!}
		</div>
<script>
            $(document).on('click', '#history-btn', function () {
                let history = $(this).attr('data-attr');
                let product_history = JSON.parse(history);
                let product_html_history = '';

                if (!jQuery.isEmptyObject(product_history)) {
                    $.each(product_history, function (index, history_data) {
                        let h_data = JSON.parse(history_data.data);
							  console.log(history_data);
                        product_html_history += "<tr>";
                        product_html_history += "<td>" + history_data.created_at + "</td>";
                        product_html_history += "<td>" + history_data.serial_number + "</td>";
                        product_html_history += "<td>" + history_data.artikul_number + "</td>";
                        product_html_history += "<td>" + h_data.name + "</td>";
                        product_html_history += "<td>" + h_data.price_per_piece + "</td>";
                        product_html_history += "<td>" + h_data.pieces + "</td>";
                        product_html_history += "<td>" + h_data.package_price + "</td>";
                        product_html_history += "<td class='prod_status "+h_data.status+"'>" + h_data.status + "</td>";
                        product_html_history += "<td class='text-capitalize'>" + h_data.state + "</td>";
                        product_html_history += "</tr>";
							  	product_html_history_name = h_data.name;
                    });
                }
                if (!product_html_history) {
                    product_html_history = '<tr><td colspan="9">No history data</td></tr>';
                }
                $("#product_history_table tbody").html(product_html_history);
                //$("#historyModalLabel").html(product_html_history_name);
            });

            $(document).on('click', '#edit-btn', function () {
                let product = $(this).attr('data-attr');
                let product_data = JSON.parse(product);
                let product_html = '@csrf';
                if (!jQuery.isEmptyObject(product_data)) {
                    			product_html += '<div class="form-group row">';
                           product_html +=   '<div class="col-lg-8 mb-1">';
                           product_html +=      '<label for="name">Product description:</label>';
                           product_html +=      '<input type="text" id="name" name="name" class="form-control"  value="'+ product_data.name +'">';
                           product_html +=   '</div>';
                           product_html +=   '<div class="col-lg-4 mb-1">';
                           product_html +=      '<label for="article">Article No:</label>' ;
                           product_html +=      '<input type="text" id="article" name="artikul_number" class="form-control" value="'+ product_data.artikul_number +'">';
                           product_html +=   '</div>';
                           product_html +=   '<div class="col-lg-4 mb-1">';
                           product_html +=      '<label for="sprice">Single price (cents/piece):</label>';
                           product_html +=      '<input type="text" id="sprice" name="price_per_piece" class="form-control" value="'+ product_data.price_per_piece +'">';
                           product_html +=   '</div>';
                           product_html +=   '<div class="col-lg-4 mb-1">';
                           product_html +=      '<label for="pieces">Content (pieces):</label>';
                           product_html +=      '<input type="text" id="pieces" name="pieces" class="form-control" value="'+ product_data.pieces +'">';
                           product_html +=   '</div>';
                           product_html +=   '<div class="col-lg-4 mb-1">';
                           product_html +=      '<label for="pprice">Package price (EUR):</label>';
                           product_html +=      '<input type="text" id="price" name="package_price" class="form-control" value="'+ product_data.package_price +'">';
                           product_html +=   '</div>';
                           product_html +=   '<div class="col-lg-6 mb-1">';
                           product_html +=      '<label for="status_select">Status</label>';
                           product_html +=      '<select id="status_select" name="status" class="form-control">';
                           product_html +=         '<option value="active">Active</option>';
                           product_html +=         '<option value="inactive">Inactive</option>';
                           product_html +=         '<option value="deleted">Deleted</option>';
                           product_html +=      '</select>';
                           product_html +=   '</div>';
                           product_html +=   '<div class="col-lg-6 mb-1">';
                           product_html +=      '<label for="state_select">State</label>';
                           product_html +=      '<select id="state_select" name="state" class="form-control">';
                           product_html +=         '<option value="new">New</option>';
                           product_html +=         '<option value="announced">Announced</option>';
                           product_html +=         '<option value="discounted">Discounted</option>';
                           product_html +=      '</select>';
                           product_html +=   '</div>';
                           product_html +=   '<div class="col-6 text-right mt-3">';
                           product_html +=      '<button data-dismiss="modal" class="btn grey" id="clearForm"> Cancel </button>';
                           product_html +=   '</div>';
                           product_html +=   '<div class="col-6 mt-3">';
                           product_html +=      '<button type="submit" class="btn orange" id="edit_product">Edit Product </button>';
                           product_html +=   '</div>';
                           product_html += '</div>';
						 			product_html += "<input type='hidden' id='product_id' name='product_id' value='" + product_data.id + "'>";
                }

                $("#editModal form").html(product_html);
                setSelected("status_select", product_data.status);
                setSelected("state_select", product_data.state);
            });
        function setSelected($selector, $value){
            $("#" + $selector + " option").filter(function() {
                if ($(this).val().trim() == $value){
                    $(this).prop('selected', true);
                }
            });
        }
        </script>
<div class="modal" id="historyModal" tabindex="-1" role="dialog"
                             aria-labelledby="historyModalLabel" aria-hidden="true">
               <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-body">
                        <div class="d-flex justify-content-between mb-3">
                           <h2 class="modal-title" id="historyModalLabel"> History data</h2>
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                        </div>
								<div class="tableHolder mt-3">
									<table id="product_history_table" class="tableList">
										<thead>
											<tr>
												<th>Date</th>
												<th>Serial<br> No</th>
												<th>Article <br>No</th>
												<th>Variety<br> (exact description)</th>
												<th>CIP<br> (cents / piece)</th>
												<th>Content <br>(pieces)</th>
												<th>Package price <br>(EUR)</th>
												<th>Status</th>
												<th>State</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>1</td>
												<td>2</td>
												<td>3</td>
												<td>4</td>
												<td>5</td>
												<td>6</td>
												<td>7</td>
												<td>8</td>
											</tr>
										</tbody>
									</table>

									</div>
                     </div>
                  </div>
               </div>
            </div>
	<div class="modal" id="editModal" tabindex="-1" role="dialog"
                             aria-labelledby="editModalLabel" aria-hidden="true">
               <div class="modal-dialog" role="document">
                  <div class="modal-content">
                     <div class="modal-body">
                        <div class="d-flex justify-content-between mb-3">
                           <h2 class="modal-title" id="editModalLabel">Edit product</h2>
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                        </div>
								<form action="{{ action('ProductController@update') }}" method="post">
								</form>
								</div>
                  </div>
               </div>
            </div>
	</div>
@endsection
