@extends('layouts.app')

@section('content')
    <div class="row mb-2">
        <div class="col-lg-12">
            @include('includes.workflow.workflow_track', ['current_wf_track' => $current_wf_track])
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{$job_offer->number}}</h3>
                </div>
                <div class="card-body">
                    <div class="">
                        <h4 class="mb-1">Hi <strong>Jessica Allen</strong>,</h4>
                        This is the receipt for a payment of <strong>$450.00</strong> (USD) for your works
                    </div>

                    <div class="card-body pl-0 pr-0">
                        <div class="row">
                            <div class="col-sm-6">
                                <span>Payment No.</span><br>
                                <strong>INV23456-234</strong>
                            </div>
                            <div class="col-sm-6 text-right">
                                <span>Payment Date</span><br>
                                <strong>Aug 10, 2019 - 12:20 pm</strong>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown-divider"></div>
                    <div class="row pt-4">
                        <div class="col-lg-6 ">
                            <p class="h3">Client Inc</p>
                            <address>
                                Street Address<br>
                                State, City<br>
                                Region, Postal Code<br>
                                ltd@example.com
                            </address>
                        </div>
                        <div class="col-lg-6 text-right">
                            <p class="h3">Invoice To</p>
                            <address>
                                Street Address<br>
                                State, City<br>
                                Region, Postal Code<br>
                                ctr@example.com
                            </address>
                        </div>
                    </div>
                    <div class="table-responsive push">
                        <table class="table table-bordered table-hover">
                            <tbody><tr class=" ">
                                <th class="text-center " style="width: 1%"></th>
                                <th>Product</th>
                                <th class="text-center" style="width: 1%">Qnt</th>
                                <th class="text-right" style="width: 1%">Unit</th>
                                <th class="text-right" style="width: 1%">Amount</th>
                            </tr>
                            <tr>
                                <td class="text-center">1</td>
                                <td>
                                    <p class="font-w600 mb-1">Logo Creation</p>
                                    <div class="text-muted">Logo and business cards design</div>
                                </td>
                                <td class="text-center">2</td>
                                <td class="text-right">$60.00</td>
                                <td class="text-right">$120.00</td>
                            </tr>
                            <tr>
                                <td class="text-center">2</td>
                                <td>
                                    <p class="font-w600 mb-1">Online Store Design &amp; Development</p>
                                    <div class="text-muted">Design/Development for all popular modern browsers</div>
                                </td>
                                <td class="text-center">3</td>
                                <td class="text-right">$80.00</td>
                                <td class="text-right">$240.00</td>
                            </tr>
                            <tr>
                                <td class="text-center">3</td>
                                <td>
                                    <p class="font-w600 mb-1">App Design</p>
                                    <div class="text-muted">Promotional mobile application</div>
                                </td>
                                <td class="text-center">1</td>
                                <td class="text-right">$40.00</td>
                                <td class="text-right">$40.00</td>
                            </tr>
                            <tr>
                                <td colspan="4" class="font-w600 text-right">Subtotal</td>
                                <td class="text-right">$400.00</td>
                            </tr>
                            <tr>
                                <td colspan="4" class="font-w600 text-right">Vat Rate</td>
                                <td class="text-right">20%</td>
                            </tr>
                            <tr>
                                <td colspan="4" class="font-w600 text-right">Vat Due</td>
                                <td class="text-right">$50.00</td>
                            </tr>
                            <tr>
                                <td colspan="4" class="font-weight-bold text-uppercase text-right">Total Due</td>
                                <td class="font-weight-bold text-right">$450.00</td>
                            </tr>
                            <tr>
                                <td colspan="5" class="text-right">
                                    <button type="button" class="btn btn-primary" onclick="javascript:window.print();"><i class="si si-wallet"></i> Pay Invoice</button>
                                    <button type="button" class="btn btn-secondary" onclick="javascript:window.print();"><i class="si si-paper-plane"></i> Send Invoice</button>
                                    <button type="button" class="btn btn-info" onclick="javascript:window.print();"><i class="si si-printer"></i> Print Invoice</button>
                                </td>
                            </tr>
                            </tbody></table>
                    </div>
                    <p class="text-muted text-center">Thank you very much for doing business with us. We look forward to working with you again!</p>
                </div>
            </div>
        </div>
    </div>
@endsection
