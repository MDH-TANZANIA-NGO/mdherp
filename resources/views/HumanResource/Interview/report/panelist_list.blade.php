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
                     <th> Title </th>
                     <th> Email </th>
                 </thead>
                 <tbody>
                    @foreach($panelists  as $key=>$panelist)
                     <tr>
                         <td>{{ $key + 1 }}</td>
                         <td>{{ $panelist->full_name}}</td>
                         <td>{{ $panelist->title}}</td>
                         <td>{{ $panelist->email}}</td>
                     </tr>
                     @endforeach
                 </tbody>
             </table>
         </div>
     </div>
 </div>
