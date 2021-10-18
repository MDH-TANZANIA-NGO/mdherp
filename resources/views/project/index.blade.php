@extends('layouts.app')
@section('content')
    <div class="row">
        <span class="col-12 text-center">PROJECTS</span>
    </div>
    @include('project.form.create')
    <div class="row">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                    <tr>
                        <th class="wd-15p">#</th>
                        <th class="wd-15p">CODE</th>
                        <th class="wd-20p">NAME</th>
                        <th class="wd-15p">START YEAR</th>
                        <th class="wd-10p">END YEAR</th>
                        <th class="wd-25p">BUDGET</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>1</td>
                        <td>Chloe</td>
                        <td>System Developer</td>
                        <td>2018/03/12</td>
                        <td>$654,765</td>
                        <td>b.Chloe@datatables.net</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Bond</td>
                        <td>Account Manager</td>
                        <td>2012/02/21</td>
                        <td>$543,654</td>
                        <td>d.bond@datatables.net</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Carr</td>
                        <td>Technical Manager</td>
                        <td>20011/02/87</td>
                        <td>$86,000</td>
                        <td>h.carr@datatables.net</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Dyer</td>
                        <td>Javascript Developer</td>
                        <td>2014/08/23</td>
                        <td>$456,123</td>
                        <td>l.dyer@datatables.net</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Hill</td>
                        <td>Sales Manager</td>
                        <td>2010/7/14</td>
                        <td>$432,230</td>
                        <td>k.hill@datatables.net</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Hudson</td>
                        <td>Sales Assistant</td>
                        <td>2015/10/16</td>
                        <td>$654,300</td>
                        <td>d.hudson@datatables.net</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Chandler</td>
                        <td>Integration Specialist</td>
                        <td>2012/08/06</td>
                        <td>$137,500</td>
                        <td>h.chandler@datatables.net</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Ince</td>
                        <td>junior Manager</td>
                        <td>2012/11/23</td>
                        <td>$345,789</td>
                        <td>j.ince@datatables.net</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Ellison</td>
                        <td>Junior Javascript Developer</td>
                        <td>2010/03/19</td>
                        <td>$205,500</td>
                        <td>l.ellison@datatables.net</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
