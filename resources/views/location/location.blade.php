@extends('layouts.app')
@section('content')

<head>
    <title>Current Location Details </title>
    <style>
        .box {
            margin: auto;
            width: 50%;
            border: 3px dashed green;
            padding: 10px;
            text-align: center;
        }
    </style>
</head>

<body style="text-align: center;">
    <h1 style="text-align: center;">Current Location Details </h1>
    <div class="box">
        <h3>IP: {{ $data->ip }}</h3>
        <h3>Country Name: {{ $data->countryName }}</h3>
        <h3>Country Code: {{ $data->countryCode }}</h3>
        <h3>Region Code: {{ $data->regionCode }}</h3>
        <h3>Region Name: {{ $data->regionName }}</h3>
        <h3>City Name: {{ $data->cityName }}</h3>
        <h3>Zipcode: {{ $data->zipCode }}</h3>
        <h3>Latitude: {{ $data->latitude }}</h3>
        <h3>Longitude: {{ $data->longitude }}</h3>
    </div>
</body>
@endsection