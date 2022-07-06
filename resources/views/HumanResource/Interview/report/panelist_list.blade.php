 <?php
    $sql = "select
                users.id,
                concat_ws(
                    ' ',
                    users.first_name,
                    users.middle_name,
                    users.last_name
                ) as full_name,
                users.email
            from
                hr_interview_panelists
                inner join users on users.id = hr_interview_panelists.id
        where hr_interview_panelists.interview_id IN ('".implode("','",$interviews->pluck('id')->toArray()). "')";
   $panelists =  \DB::select($sql);   
    ?>
    {{ is_array($interviews->pluck('id')) }}
 <div class="row">
     <div class="card">
         <div class="card-header">
             <h3 class="card-title">PANELISTS</h3>
         </div>
         <div class="card-body">
             <table class="table table-bordered table-stripped">
                 <thead>
                     <th> # </th>
                     <th> Name </th>
                     <th> Email </th>
                 </thead>
                 <tbody>
                    @foreach($panelists  as $key=>$panelist)
                     <tr>
                         <td>{{ $key + 1 }}</td>
                         <td>{{ $panelist->full_name}}</td>
                         <td>{{ $panelist->email}}</td>
                     </tr>
                     @endforeach
                 </tbody>
             </table>
         </div>
     </div>
 </div>