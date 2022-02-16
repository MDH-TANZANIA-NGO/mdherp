@extends('layouts.app')
@section('content')

<!-- Row-->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">#MDH-PROC-2021-287</h3>
            </div>
            <div class="card-body">
                <div class="">
                    <h4 class="mb-1">Hi <strong>{{ access()->user()->full_name_formatted }}</strong>,</h4>
                    You have requested Amount of <strong>$450.00</strong> (USD) which is equivalent to <strong>900,000</strong> (TZS) for activity:
                    <p>AK1.1.1- Purchase Laptops & supplies to facilitate scale up of PMD, Community data needs for program monitoring</p>
                </div>

                <div class="card-body pl-0 pr-0">
                    <div class="row">
                        <div class="col-sm-6">
                            <span>Expense No.</span><br>
                            <strong>#MDH-PROC-2021-287</strong>
                        </div>
                        <div class="col-sm-6 text-right">
                            <span>Requested Date</span><br>
                            <strong>Aug 10, 2019 - 12:20 pm</strong>
                        </div>
                    </div>
                </div>
                <div class="dropdown-divider"></div>
                <div class="row pt-4">
                    <div class="col-lg-6 ">
                        <p class="h3">Project Details:</p>
                        <address>
                            <strong>Project name: </strong><span class="text-primary" >Afya Kwanza</span><br>
                            <strong>Sub Program area:</strong>  <span class="text-primary" >C&T NSD 01 </span><br>
                            <strong>Numeric Output: </strong> <span class="text-primary" >200</span><br>
                            <strong>Output unit:</strong> <span class="text-primary" >  Pieces</span><br>
                        </address>
                    </div>
{{--                    <div class="col-lg-6 text-right">--}}
{{--                        <p class="h3">Invoice To</p>--}}
{{--                        <address>--}}
{{--                            Street Address<br>--}}
{{--                            State, City<br>--}}
{{--                            Region, Postal Code<br>--}}
{{--                            ctr@example.com--}}
{{--                        </address>--}}
{{--                    </div>--}}
                </div>
                <div class="table-responsive push">
                    <table class="table table-bordered table-hover">
                        <tr class=" ">
                            <th class="text-center " style="width: 1%"></th>
                            <th>Requested Item</th>
                            <th class="text-center" style="width: 1%">Qnt</th>
                            <th class="text-right" style="width: 1%">Unit</th>
                            <th class="text-right" style="width: 1%">Amount</th>
                        </tr>
                        <tr>
                            <td class="text-center">1</td>
                            <td>
                                <p class="font-w600 mb-1">Dell Lattitude 3410</p>
                                <div class="text-muted">8 GB RAM 500 SSD GB Storage Processor 2.7GHZ Cor-i 7</div>
                            </td>
                            <td class="text-center">2</td>
                            <td class="text-right">$60.00</td>
                            <td class="text-right">$120.00</td>
                        </tr>



                        <tr>
                            <td colspan="4" class="font-w600 text-right">Total TZS</td>
                            <td class="text-right">240,000.00</td>
                        </tr>
                        <tr>
                            <td colspan="4" class="font-weight-bold text-uppercase text-right">Total USD</td>
                            <td class="font-weight-bold text-right">$120.00</td>
                        </tr>
                        <tr>
                            <td colspan="5" class="text-right">
                                <button type="button" class="btn btn-primary" onClick="javascript:window.print();"><i class="si si-folder-alt"></i> Save </button>
                                <button type="button" class="btn btn-secondary" onClick="javascript:window.print();"><i class="si si-paper-plane"></i> Submit</button>
                                <button type="button" class="btn btn-info" onClick="javascript:window.print();"><i class="si si-printer"></i> Print </button>
                            </td>
                        </tr>
                    </table>
                </div>
                <p class="text-muted text-center">Thank you very much for doing business with us. We look forward to working with you again!</p>
            </div>
        </div>
    </div>
</div>
<!-- End row-->

@endsection
