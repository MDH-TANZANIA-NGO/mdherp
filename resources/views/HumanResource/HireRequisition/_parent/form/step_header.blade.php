<div class="row">
    <div class="col-sm-12 col-lg-12 col-xl-12 col-md-12 mb-3">
        <div class="tags">
            <span class="tag tag-rounded" style="background-color: #fff; font-size: 16px">JOB TITLE:  {{ $job_title->name }} </span>
		</div>
    </div>
</div>
<div class="card card-primary add_requisition_body">
	<div class=" tab-menu-heading card-header sw-theme-dots">
		<div class="tabs-menu">
			<ul class="nav panel-tabs">
				<li class="nav-item"><a href="#processing" class="nav-link {{ ($step == 1) ? 'active':'disabled' }}" data-toggle="tab">1.General</a></li>
				<li class="nav-item"><a href="#personal_requirement" class="nav-link {{ ($step == 2) ? 'active':'disabled' }} " data-toggle="tab">2.Personal Requirement</a></li>
				<li class="nav-item"><a href="#employement_condition" class="nav-link {{ ($step == 3) ? 'active':'disabled' }}" data-toggle="tab">3.Employment Condition</a></li>
				<li class="nav-item"><a href="#returned" class="nav-link {{ ($step == 4) ? 'active':'disabled' }}" data-toggle="tab">4.Criteria</a></li>
				<li class="nav-item"><a href="#returned" class="nav-link {{ ($step == 5) ? 'active':'disabled' }}" data-toggle="tab">5.Review</a></li>
			</ul>
		</div>
	</div>
	<div class="card tabs-menu-body" style="background-color:#FFFFFF">
		<div class="tab-content">