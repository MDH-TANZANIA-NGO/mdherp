@extends('layouts.app')
@section('content')
@if(isset($initiate))
@include('HumanResource.HireRequisition._parent.datatables.index')
@endif
<div class="panel panel-primary">
	<div class=" tab-menu-heading card-header sw-theme-dots">
		Post Advertisement 
	</div>
	<div class="panel-body tabs-menu-body" style="background-color:#FFFFFF">
		@if(isset($initiate))
		<form action="{{route('hirerequisition.addRequisition',$uuid)}}" method="post">
			@else
			<form action="{{route('hirerequisition.store')}}" method="post">
				@endif
				@csrf
				<!-- Large Modal -->
				<div class="col-lg-12 col-md-12">
					<table id="table access_processing" class="table table-striped table-bordered" style="width:100%">
						<thead>
							<tr>
								<th class="wd-15p">#</th>
								<th class="wd-15p">TITLE</th>
								<th class="wd-25p">CREATED AT</th>
								<!-- <th class="wd-25p">CREATED BY</th> -->
								<th class="wd-25p">APPROVED ON</th>
								<th class="wd-25p">ACTION</th>
							</tr>
						</thead>
						<tbody>
							@foreach($advertisements as $key=>$advertisements)
							<tr class="wd-15p">
								<td>{{$key+1}}</td>
								<td>{{	$advertisements->title}}</td>
								<td>{{  $advertisements->created_at }}</td>
								 
								<td>{{  $advertisements->created_at }}</td>
								<td><a href="{{ route('advertisement.publish',$advertisements->uuid) }}"> Post Advertisement </a></td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</form>
	</div>
</div>
@endsection
@push('after-scripts')
<style>
	.breadcrumb1 {
		background-color: rgb(152, 186, 217);
		border-radius: 0;
	}

	.breadcrumb1 li {
		margin: 0;
	}

	.gray {
		background-color: #f2f5fb;
	}
</style>
@endpush