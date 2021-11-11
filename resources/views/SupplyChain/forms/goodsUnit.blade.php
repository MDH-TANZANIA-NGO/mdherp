{!! Form::open(['route' => 'project.store', 'method' => 'post',]) !!}
<!-- Large Modal -->
<div class="col-lg-12 col-md-12">
    <div class="card">


        <div class="card-header" style="background-color: rgb(238, 241, 248)">
            <div class="row text-center">
                <span class="col-12 text-center font-weight-bold">Unit Configuration</span>
            </div>

            <div class="card-options ">
                <a href="#" class="card-options-collapse" data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
            </div>

        </div>


        <div class="card-body">
            <div class="row">

                <div class="col-6" >
                    <label class="form-label">Title</label>
                   <input type="text" class="form-control" name="title" placeholder="Title">
                </div>

                <div class="col-6">
                    <label class="form-label">Abbreviation</label>
                    <input type="text" class="form-control" name="abbreviation" placeholder="i.e KG" required>
                    @error('abbreviation')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>
                    @enderror
                </div>


            </div>

            &nbsp;



            &nbsp;




            &nbsp;
            <div class="row">

                <div class="col-12">
                    <div style="text-align: center;">

                        <button type="submit" class="btn btn-azure"  >Register Unit</button>

                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

{!! Form::close() !!}






