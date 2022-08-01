<div class ="row">
    <div class="container lst">
        <div class="input-group hdtuto control-group lst" >

            <div class="col-md-3 col-lg-3 col-xl-3" >
                <input type="file" accept="application/pdf" name="attachments[]" class="form-control">
            </div>

            <div class="col-md-3 col-lg-3 col-xl-3" >
                <input type="number" id="" name="amount_attachment[]" placeholder="Total Amount of the receipts" class="form-control">
            </div>

            <div class="col-md-3 col-lg-3 col-xl-3" >
                {!! Form::select('attachment_type[]', $attachment_type, null, ['class' =>'form-control select2-show-search ', 'placeholder' => __('label.select') , 'aria-describedby' => '', 'required']) !!}
            </div>

            <div class="input-group-btn col-md-3 col-lg-3 col-xl-3">
                <button class="btn btn-success att_button" type="button"><i class=""></i>Add attachment field</button>
            </div>
        </div>

        <div id="increment"></div>

    </div>
</div>
@push('after-scripts')
    <script>
        calculate = function (a_paid, a_spent, a_variance) {
            var amount_advanced = (document.getElementById(a_paid).value);
            var amount_spent = parseFloat(document.getElementById(a_spent).value).toFixed(2);
            var amount_variance = amount_advanced - amount_spent;
            (document.getElementById(a_variance).value) = (amount_variance);

        }

        $(document).ready(function() {
            $(".att_button").click(function(event){
                event.preventDefault();
                // var lsthmtl = $(".clone").html();
                // $(".increment").after(lsthmtl);
                let $increment = $("#increment");

                $increment.prepend('' +
                    '<div class="hdtuto control-group lst input-group remuv" style="margin-top:10px">'+
                    '<div class="col-md-3 col-lg-3 col-xl-3" >'+
                    '<input type="file" accept="application/pdf" name="attachments[]" class="form-control">'+
                    '</div>'+

                    '<div class="col-md-3 col-lg-3 col-xl-3" >'+
                    '<input type="number" id="" name="amount_attachment[]" placeholder="Total Amount of the receipts"  class="form-control">'+
                    '</div>'+

                    '<div class="col-md-3 col-lg-3 col-xl-3" >'+
                    '{!! Form::select("attachment_type[]", $attachment_type, null, ["class" =>"form-control select2-show-search", "placeholder" => __("label.select") , "aria-describedby" => "", "required"]) !!}'+
                    '</div>'+

                    '<div class="input-group-btn col-md-3 col-lg-3 col-xl-3" >'+
                    '<button class="btn btn-danger att_button_rem" type="button"><i class=""></i>Remove attachment field</button>'+
                    '</div>'+
                    '</div>')

            });
            $("body").on("click",".att_button_rem",function(){
                $(this).parents(".remuv").remove();
            });
        });

        /* $(document).ready(function() {
             var max_fields      = 6; //maximum input boxes allowed
             var wrapper         = $(".increment"); //Fields wrapper
             var add_button      = $(".btn-success"); //Add button ID

             var x = 1; //initlal text box count
             $(add_button).click(function(e){ //on add input button click
                 e.preventDefault();
                 if(x < max_fields){ //max input box allowed
                     x++; //text box increment
                     $(wrapper).append('<div class="input-group-btn">'
                         +'<button class="btn btn-danger remove_field" type="button">'+
                         +'<i class="fldemo glyphicon glyphicon-remove"></i> Remove</button>'+
                         +'</div>');
                     var lsthmtl = $(".clone").html();
                     $(".increment").after(lsthmtl);//add input box
                 }
             });

             $(wrapper).on("click",".btn-danger", function(e){ //user click on remove text
                 e.preventDefault(); $(this).parent('div').remove(); x--;
             })
         });*/

    </script>


@endpush
