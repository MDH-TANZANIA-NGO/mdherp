@extends('layouts.public')
@section('content')


                <div class="col-12 justify-content-center">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Vacancies</h3>
                        </div>
                        <div class="card-body">
                            <div class="list-group">
                                @foreach( $listings as $listing)
                                    <a href="{{route('vacancy', $listing->uuid)}}" class="list-group-item list-group-item-action flex-column align-items-start">
                                        <div class="d-flex w-100">
                                            <h5 class="mb-1">{{$listing->title}}</h5>
                                            <small class="float-right">{{ $listing->created_at->diffForHumans() }}</small>
                                        </div>
                                        <p class="mb-1">Employment Type : {{ ucfirst($listing->vacancy_type) }}</p>
                                        <small>{{$listing->location}}</small>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>


                </div>

@endsection
