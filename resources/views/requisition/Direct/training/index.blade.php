

@if($requisition->training->count() >0)
    @include('requisition.Direct.training.forms.event.edit')
@include('requisition.Direct.training.forms.create')

@else
    @include('requisition.Direct.training.forms.event.create')

@endif
