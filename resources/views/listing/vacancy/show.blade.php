@extends('layouts.public')
@section('content')

    <div class="row mt-8">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $listing->title }}</h3>
                </div>
                <div class="card-body">
                    {{ Markdown::parse($listing->content) }}
                    <strong>Education and Qualifications</strong>
                    {{ Markdown::parse($listing->education_and_qualification) }}
                    <strong>Practical Experience</strong>
                    {{ Markdown::parse($listing->practical_experience) }}
                    <strong>Other Special Qualities and Skills </strong>
                    {{ Markdown::parse($listing->other_qualities) }}
                    <strong>Employment Condition </strong>
                    {{ Markdown::parse($listing->special_employment_condition) }}
                </div>
                <div class="card-footer">
                    <a href="#" class="btn btn-primary float-right">
                        APPLY
                    </a>
                </div>
            </div>
        </div>

@endsection
