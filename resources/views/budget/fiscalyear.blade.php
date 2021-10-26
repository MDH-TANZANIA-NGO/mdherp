<!-- Large Modal -->
<div class="col-lg-12 col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="row">

                <div class="col-6" >
                    <label class="form-label">Project Code</label>
                    <input type="text" class="form-control" name="code" placeholder="ie. AK2" required>
                </div>

                <div class="col-6">
                    <label class="form-label">Project Title</label>
                    <input type="text" class="form-control" name="title" placeholder="ie. AFYA Kwanza" required>
                </div>


            </div>

            &nbsp;

            <div class="row">

                <div class="col-6">
                    <label class="form-label">Project Type</label>
                    <select class="form-control select2 custom-select" aria-describedby="" required name="type"><option selected="selected" value="">Select</option><option value="13">care and treatment</option><option value="14">specific</option></select>
                </div>

                <div class="col-6 hidden" id="region_holder">
                    <label class="form-label">Select Region(s)</label>
                    <select class="form-control select2 custom-select" multiple disabled required name="regions[]"><option value="1">Arusha</option><option value="2">Dar es Salaam</option><option value="3">Dodoma</option><option value="4">Geita</option><option value="5">Iringa</option><option value="6">Kagera</option><option value="7">Katavi</option><option value="8">Kigoma</option><option value="9">Kilimanjaro</option><option value="10">Lindi</option><option value="11">Manyara</option><option value="12">Mara</option><option value="13">Mbeya</option><option value="14">Morogoro</option><option value="15">Mtwara</option><option value="16">Mwanza</option><option value="17">Njombe</option><option value="18">Pemba North</option><option value="19">Pemba South</option><option value="20">Pwani</option><option value="21">Rukwa</option><option value="22">Ruvuma</option><option value="23">Shinyanga</option><option value="24">Simiyu</option><option value="25">Singida</option><option value="26">Tabora</option><option value="27">Tanga</option><option value="28">Zanzibar North</option><option value="29">Zanzibar South and Central</option><option value="30">Zanzibar Urban West</option><option value="31">Songwe</option><option value="32">Unguja South</option><option value="33">Unguja North</option></select>
                </div>

            </div>

            &nbsp;

            <div class="row">
                <div class="col-6">
                    <label class="form-label">Start Date</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                            </div>
                        </div><input class="form-control" name="start_year" type="date" min="1997-01-01" required>
                    </div>
                </div>

                <div class="col-6">
                    <label class="form-label">End Date</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fa fa-calendar tx-16 lh-0 op-6"></i>
                            </div>
                        </div><input class="form-control" name="end_year"  type="date" min="1997-01-01" required>
                    </div>
                </div>

            </div>
