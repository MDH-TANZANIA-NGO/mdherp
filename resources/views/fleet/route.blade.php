@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col-lg-12">
        <table class='table' id="kuku">
            <thead>
                <tr>
                    <th> username </th>
                     <th> email </th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
<script>
// var myHeaders = new Headers();
// myHeaders.append("Content-Type", "application/json");
// var requestOptions = {
//     method: "get",
//     headers: myHeaders,
//     redirect: "follow",
    
// };

// fetch("https://v1.nocodeapi.com/felypara/fbsdk/oBNZcwJSyidBuUfA/getAllUsers", requestOptions)
//     .then(response => response.json())
//     //.then(response => response.text())

//     //document.getElementById('email').innerHTML = response.providerData;
//     //document.getElementById('author').innerHTML = '- ' + response.originator.name + ' -';
//     .then(result => console.log(result))
//     .catch(error => console.log('error', error));


var settings = {
    "url": "https://v1.nocodeapi.com/felypara/fbsdk/oBNZcwJSyidBuUfA/getAllUsers",
    "method": "get",
    "timeout": 0,
    "headers": {
        "Content-Type": "application/json"
    },
};

$.ajax(settings).done(function (response) {
    var html = '';
    $.each(response.users,function(key,value){
        html += '<tr>'
        html += '<td>' + value.uid +'</td><td>'+ value.email+'</td>';
        html += '</tr>';
    });
    $("#kuku tbody").html(html);
    
});
</script>
@endsection
