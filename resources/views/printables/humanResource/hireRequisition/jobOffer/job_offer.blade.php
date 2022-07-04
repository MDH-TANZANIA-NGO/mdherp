<html>
<head>
    <meta http-equiv=Content-Type content="text/html; charset=UTF-8">
    <style type="text/css">
        .bold-text{
            font-weight : bolder;
        }
        .text-italic {
            font-style: italic;
        }
        .signature{
            top: 0px;
        }
        .signature .print-info{
            float: right;
            text-align: right !important;
            font-size: 12px;
        }
        .page-break {
            page-break-after: always;
        }
        .content {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
            font-weight: lighter;
        }

        .content .header {
            float: left;
            width: 100%;
            height: 60px;
        }
        .content .header .top {
            /*width : 138px; <!-- -120 -->*/
            /*height: 21px;*/
            width: 20%;
            float: left;
            margin-left: 40%;
        }
        .content .header .logo {
            width: 100%;
            float: left;
        }
        .content .header .document-title {
            width: 100%;
            text-align: center;
            margin-top: 70px;
            margin-bottom: 15px;
        }
        .content .header .address {
            width: 100%;
            text-align: center;
            border-bottom: solid 1px #000;
        }
        .content .container {
            margin-top: 150px;
        }
        .summary-info {
            widht: 100%;
        }
        table{
            widht: 100%;
        }
        .fixed-width {
            width: 25%;
        }
        .text-left {
            text-align: left !important;
        }
        .text-title {
            font-weight: bold;
            font-size: 10px;
        }

        .content .container .workflow{
            height: auto;
            margin-bottom: 10px;
        }
        .content .container .workflow table{
            /*display: block;*/
            width: 98%;
            margin-top: 10px;
            margin-bottom: 10px;
            margin-left: 1%;
            /*border: 1px solid #000;*/
        }
        .content .container .workflow table th{
            text-indent: 10px;
            margin-left: 1px;
        }
        .content .container .workflow table td{
            text-indent: 10px;
            border-bottom: 1px solid #000;
        }
        .h3{
            margin-top: 10px;
            margin-bottom: 10px;
            width: 98%;
            margin-left: 1%;
        }
        -->
    </style>
</head>
<body>
@if(access()->user()->designation)
    <div class="signature">
        <div class="print-info">Printed By :<b>{{ access()->user()->full_name_formatted }}</b><br>
            {{ access()->user()->title }}<br>
            {{ \Carbon\Carbon::now() }}
        </div>
    </div>
@endif
    <div class="content">
        <!--START Head Information -->
        <div class="header">
            <div class="top">
                <img class="logo" src="data:image/png;base64,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" />
            </div>
            <div class="document-title bold-text">JOB OFFER | {{ $job_offer->number }}</div>
            <div class="address text-italic">Management and Development for Health | Plot #802, Mwai Kibaki Road Mikocheni Dar es Salaam, Tanzania<br> +255 22 277 1656/1615 | mdh@mdh.or.tz</div>
        </div>
        <!--END Head Information -->



        <!--START container -->
        <div class="container">


        </div>
        <!--END container -->


    </div>

</body>
</html>
