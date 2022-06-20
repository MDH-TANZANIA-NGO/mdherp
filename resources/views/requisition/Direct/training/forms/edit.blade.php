{!! Form::open(['route' => ['training.update', $training_cost], 'method' => 'put',]) !!}
<!-- Row -->
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">TRAINING  FORM</h3>
                <div class="card-options ">
                    <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                    <a href="#" class="card-options-remove" data-toggle="card-remove"><i class="fe fe-x"></i></a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table card-table table-vcenter text-nowrap" >
                        <thead  class="bg-info text-white">
                        <tr >
{{--                            <th class="text-white">Participant</th>--}}
                            <th class="text-white">Days</th>
                            <th class="text-white">Destination</th>
                            <th class="text-white">Perdiem Rate</th>
                            <th class="text-white">Transport</th>
                            <th class="text-white">Others</th>
                            <th class="text-white">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
{{--                            <td>	 <select class="form-control select2-show-search" name="user_id" data-placeholder="Choose one (with searchbox)" required = "required">--}}
{{--                                    <option value="">{{$training_cost->user_id}}</option>--}}
{{--                                    @foreach($user_id as $user_id)--}}
{{--                                        <option value="{{$user_id->id}}">{{$user_id->first_name}} {{$user_id->last_name}}</option>--}}

{{--                                    @endforeach--}}
{{--                                </select></td>--}}
                            <td>{!! Form::number('no_days',$training_cost->no_days,['class' => 'form-control', 'required']) !!}</td>
                            <td>{!! Form::select('district_id',$districts, $training_cost->district_id,['class' => 'form-control select2-show-search', 'required']) !!}</td>

                            <td>{!! Form::select('perdiem_rate',$mdh_rates, $training_cost->perdiem_rate,['class' => 'form-control select2-show-search', 'required']) !!}</td>
                            <td> {!! Form::number('transportation',$training_cost->transportation,['class' => 'form-control', 'required']) !!}</td>
                            <td>{!! Form::number('other_cost',$training_cost->other_cost,['class' => 'form-control', 'required']) !!}</td>
                            <td><button type="submit" class="btn btn-outline-info">Update</button> </td>
                        </tr>



                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!--End  Row -->

{!! Form::close() !!}
