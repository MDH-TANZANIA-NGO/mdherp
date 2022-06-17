@extends('layouts.app')
@section('content')


    <div class="align-content-center" style="background-color: rgb(238, 241, 248); height: 40px;">
        <div class="row text-center" style="font-size: large">
            <span class="col-12 text-center font-weight-bold" style="margin-top: 10px"><b>Listing </b></span>
        </div>
    </div>

    <!-- start: page -->
    <div class="row mb-2">
        <div class="col-lg-12">
            @include('includes.workflow.workflow_track', ['current_wf_track' => $current_wf_track])
        </div>
    </div>

    <div class="row">
        <div class="card">
           <div class="card-header">
               {{$listing->title}}
           </div>
            <div class="card-body">
                <p><strong>Department: </strong> {{ $listing->department->title }}</p>
                <p><strong>Number of Employees: </strong> {{ $listing->number }}</p>


                <p><strong>Position Summary</strong></p>
                {!! $listing->content !!}

                <p><strong>Education and Qualification</strong></p>
                {!! $listing->education_and_qualification !!}

                <p><strong> Practical Experience</strong></p>
                {!! $listing->practical_experience !!}

                <p><strong> Other Qualities</strong></p>
                {!! $listing->other_qualities !!}

                <p><strong> Special Qualities and Skills</strong></p>
                {!! $listing->other_qualities !!}

                <p><strong> Special Employment Condition</strong></p>
                {!! $listing->special_employment_condition !!}

                <p><strong>Employment Condition: </strong> {{ $listing->employment->name }}</p>


                <p><strong>Working Tools</strong></p>
                <ol>
                    @foreach($listing->workingTools as $working_tool)
                        <li>{{ $working_tool->name }}</li>
                    @endforeach
                </ol>

            </div>
        </div>
    </div>

@endsection
