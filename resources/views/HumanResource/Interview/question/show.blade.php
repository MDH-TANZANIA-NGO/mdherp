<div class="card">
    <div class="card-header">
        <h3 class="card-title">INTERVIEW QUESTIONS</h3>
    </div>
    <div class="card-body">
        <div class="row mt-3">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <table class="table table-bordered table-stripped">
                    <thead>
                        <tr>
                            <th> #</th>
                            <th> Question </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $total_questions = 0; ?>
                        @foreach($questions as $key=>$question)
                        <tr>
                            <td> {{($key+1) }}</td>
                            <td> {{ $question->question }} </td>
                        </tr>
                        <?php $total_questions = ($key + 1); ?>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>