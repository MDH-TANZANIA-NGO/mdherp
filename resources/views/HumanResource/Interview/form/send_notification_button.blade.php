@if(isset($schedules) && count($schedules))
    @if(!Session::has('msg'))
        <span class="tag tag-rounded pull-right"> <input type="submit" value="Send Notification" class="btn btn-primary"></span>
    @endif
@endif