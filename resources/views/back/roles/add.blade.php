@extends('back.yield.app')
@section('content')
<!-- START BREADCRUMB -->
<ul class="breadcrumb">
	<li><a href="#">Home</a></li>
	<li><a href="{{url('/backadmin/roles')}}">Roles</a></li>
	<li class="active">Add</li>
</ul>
<!-- END BREADCRUMB -->
<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">
	<!-- START WIDGETS -->
	<div class="row">
		<div class="col-md-12">
			@if ($message = Session::get('success'))
			<div class="alert alert-success alert-block">
				<button type="button" class="close" data-dismiss="alert">×</button>
				<strong>{{ $message }}</strong>
			</div>
			@elseif($message = Session::get('Failed'))
			<div class="alert alert-danger alert-block eror">
				<button type="button" class="close" data-dismiss="alert">×</button>
				<strong>{{ $message }}</strong>
			</div>
			@endif @if(count($errors)>0)
			<div class="alert alert-danger eror">
				<ul>
					@foreach($errors->all() as $error)
					<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
			@endif
			<div class="panel panel-default">
				<div style="padding:20px;" class="col-md-12">
					<div class="panel-body panel-body-table">
						<form id="form-add-roles" action="{{url('/backadmin/roles/')}}" method="POST" class="form-horizontal" role="form">
							{{csrf_field()}}
							{!! method_field('POST') !!}
							<div class="col-md-12">
								<div class="preview"></div>
								<div class="progress" style="display:none; overflow: hidden;">
									<div class="progress-bar" role="progressbar" aria-valuenow="0"
										aria-valuemin="0" aria-valuemax="100" style="width:0%">
										0%
									</div>
								</div>
								<div class="mess" style="display:block; overflow: hidden;"></div>
							</div>
							<div class="col-md-12 mb-20 mt-20">
								<div class="form-group">
									<label class="col-md-2 control-label">Nama level</label>
									<div class="col-md-10">
										<input type="text" class="form-control" placeholder="Nama level" name="name"  value=""/>
									</div>
								</div>
								<div class="col-md-12 col-xs-12">
									<table id="roles" class="table table-striped">
										<tbody>
											<!--
											Manage User
											==================-->
											<tr>
												<th colspan="4">Kelola Menu</th>
											</tr>
											<tr>
												<td >Dashboard</td>
												<td >Food Categories</td>
												<td >Media Library</td>
												<td >Subscribers</td>
												<td >Home Sliders</td>
												<td >Stores</td>
												<td >Comments</td>
												<td >Videos</td>
												<td >Foods</td>
												<td >Roles</td>
												<td >Users</td>
												<td >Abjad Categories</td>
												<td >Referensi Cemilan</td>
											</tr>
											<tr>
												<td>
													<div class="form-group">
														<label class="col-md-1 control-label"></label>
														<div class="col-md-11">
															<label class="switch">
																<input type="checkbox"  name="permissions[dashboard]" value='"dashboard":true' checked="true"
																/>
																<span></span>
															</label>
														</div>
													</div>
												</td>
												<td>
													<div class="form-group">
														<label class="col-md-1 control-label"></label>
														<div class="col-md-11">
															<label class="switch">
																<input type="checkbox" name="permissions[categories]" value='"categories":true' checked="true"/>
																<span></span>
															</label>
														</div>
													</div>
												</td>
												<td>
													<div class="form-group">
														<label class="col-md-1 control-label"></label>
														<div class="col-md-11">
															<label class="switch">
																<input type="checkbox" name="permissions[mediaLibrary]" value='"mediaLibrary":true' checked="true"/>
																<span></span>
															</label>
														</div>
													</div>
												</td>
												<td>
													<div class="form-group">
														<label class="col-md-1 control-label"></label>
														<div class="col-md-11">
															<label class="switch">
																<input type="checkbox" name="permissions[subscribers]"  value='"subscribers":true' checked="true"/>
																<span></span>
															</label>
														</div>
													</div>
												</td>
												<td>
													<div class="form-group">
														<label class="col-md-1 control-label"></label>
														<div class="col-md-11">
															<label class="switch">
																<input type="checkbox" name="permissions[homeSliders]"  value='"homeSliders":true' checked="true"/>
																<span></span>
															</label>
														</div>
													</div>
												</td>
												<td>
													<div class="form-group">
														<label class="col-md-1 control-label"></label>
														<div class="col-md-11">
															<label class="switch">
																<input type="checkbox" name="permissions[stores]"  value='"stores":true' checked="true"/>
																<span></span>
															</label>
														</div>
													</div>
												</td>
												<td>
													<div class="form-group">
														<label class="col-md-1 control-label"></label>
														<div class="col-md-11">
															<label class="switch">
																<input type="checkbox" name="permissions[comments]"  value='"comments":true' checked="true"/>
																<span></span>
															</label>
														</div>
													</div>
												</td>
												<td>
													<div class="form-group">
														<label class="col-md-1 control-label"></label>
														<div class="col-md-11">
															<label class="switch">
																<input type="checkbox" name="permissions[videos]"  value='"videos":true' checked="true"/>
																<span></span>
															</label>
														</div>
													</div>
												</td>
												<td>
													<div class="form-group">
														<label class="col-md-1 control-label"></label>
														<div class="col-md-11">
															<label class="switch">
																<input type="checkbox" name="permissions[foods]"  value='"foods":true' checked="true"/>
																<span></span>
															</label>
														</div>
													</div>
												</td>
												<td>
													<div class="form-group">
														<label class="col-md-1 control-label"></label>
														<div class="col-md-11">
															<label class="switch">
																<input type="checkbox" name="permissions[roles]"  value='"roles":true' checked="true"/>
																<span></span>
															</label>
														</div>
													</div>
												</td>
												<td>
													<div class="form-group">
														<label class="col-md-1 control-label"></label>
														<div class="col-md-11">
															<label class="switch">
																<input type="checkbox" name="permissions[users]"  value='"users":true' checked="true"/>
																<span></span>
															</label>
														</div>
													</div>
												</td>
												<td>
													<div class="form-group">
														<label class="col-md-1 control-label"></label>
														<div class="col-md-11">
															<label class="switch">
																<input type="checkbox" name="permissions[categories_abjad]"  value='"categories_abjad":true' checked="true"/>
																<span></span>
															</label>
														</div>
													</div>
												</td>
												<td>
													<div class="form-group">
														<label class="col-md-1 control-label"></label>
														<div class="col-md-11">
															<label class="switch">
																<input type="checkbox" name="permissions[referensiCemilan]"  value='"referensiCemilan":true' checked="true"/>
																<span></span>
															</label>
														</div>
													</div>
												</td>
											</tbody>
										</table>
										<div class="form-group pad-20-t">
											<div class="col-md-12">
												<label class="col-md-3 control-label"></label>
												<p class="text-right">
													<button type="submit" class="submit btn btn-primary bg-cokelat">Save Changes</button>
												</p>
											</div>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- END PAGE CONTENT WRAPPER -->
	@stop
	@push('scripts')
<script type="text/javascript" src="{{url('/').mix('back_assets/js/scripts/roles_add.min.js')}}"></script>
	@endpush