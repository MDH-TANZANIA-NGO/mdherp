
@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            {!! Form::open(['route' => ['training.updateBulk']]) !!}
            <div class="card-header">

                <input type="text" value="{{$requisition->uuid}}" hidden name="requisition_uuid">
               @if($requisition->trainingCost()->get()->count() > 0)
               <button type="submit" class="btn btn-success" style="margin-left: 2%"><i class="fa fa-save"></i> Save</button>
                @else
                    <a class="btn btn-danger txt-white" href="{{route('requisition.initiate', $requisition->uuid)}}"><i class="fa fa-arrow-left"></i> Back</a>
                @endif
                <div class="card-options ">
                    <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                    <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th class="wd-15p">Full Name</th>
                            <th class="wd-10p">Phone</th>
                            <th class="wd-10p">Perdiem</th>
                            <th class="wd-10p">Transport</th>
                            <th class="wd-10p">Others</th>
                            <th class="wd-25p">Others Description</th>
{{--                            <th class="wd-15p">Total</th>--}}
                            {{--                            <th class="wd-15p">District</th>--}}
                            <th class="wd-4p">Action</th>

                        </tr>
                        </thead>
                        <tbody>

                        @foreach($favourites_costs as $key=> $cost)
                            <tr>

                                <td> {!! Form::select('participant_uid[]',$gofficer, $cost->participant_uid, ['class' => 'form-control select2-show-search', 'required','placeholder'=>'Select Participant']) !!}
                                </td>
                                <td>{{$cost->user->phone}}</td>
                                {!! Form::number('requisition_training_id[]',$cost->training_id,['class' => 'form-control', 'hidden']) !!}
                                {!! Form::text('uuid[]',$cost->uuid,['class' => 'form-control', 'hidden']) !!}

                                <td>  {!! Form::select('perdiem_rate_id[]',$grate, $cost->perdiem_rate_id,['class' => 'form-control select2-show-search', 'placeholder'=>'Select Perdiem Rate']) !!}
</td>
                                <td>
                                    {!! Form::number('transportation[]',$cost->transportation,['class' => 'form-control', 'placeholder' => 'ie. 100,000']) !!}
</td>
                                <td>
                                    {!! Form::number('other_cost[]',$cost->other_cost,['class' => 'form-control', 'placeholder' => 'ie. 100,000']) !!}
</td>
                                <td>  {!! Form::text('others_description[]',$cost->others_description,['class' => 'form-control', 'placeholder' => '']) !!}
</td>
{{--                                <td>{{number_2_format($cost->total_amount)}}</td>--}}
                                {{--                                <td>{{$participants->user->facilities->name}}</td>--}}
                                {{--                                <td>{{$participants->user->district->name}}</td>--}}
                                <td>
                                    <a  href="{{route('training.removeParticipant', $cost->uuid)}}" class="btn btn-outline-danger" onclick="if (confirm('Are you sure you want to delete?')){return true} else {return false}"> <i class="fa fa-minus-circle"></i> Remove</a></td>

                            </tr>

                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>








@endsection
@push('after-scripts')
    <script>
        $(document).ready(function (){
            $("#example").dataTable()
            $("#items").dataTable()
        })
    </script>

@endpush
