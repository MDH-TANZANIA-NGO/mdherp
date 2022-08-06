 <div class="row">
     <div class="card">
         <div class="card-header">
             <h3 class="card-title">Recommendation Comment</h3>
         </div>
         <div class="card-body">
              
                    @foreach($comments  as $comment)
                        {!! $comment->comment !!}
                     @endforeach
             
         </div>
     </div>
 </div>