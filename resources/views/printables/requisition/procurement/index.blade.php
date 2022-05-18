<html>
<head>
    <meta http-equiv=Content-Type content="text/html; charset=UTF-8">
    <style type="text/css">
        .header{
            top: 0px;
        }
        .header .print-info{
            float: right;
            text-align: right !important;
            font-size: 12px;
        }
        .page-break {
            page-break-after: always;
        }
        -->
    </style>
</head>
<body>
@if(access()->user()->designation)
    <div class="header">
        <div class="print-info">Printed By :<b>{{ access()->user()->full_name_formatted }}</b><br>
            {{ access()->user()->title }}<br>
            {{ \Carbon\Carbon::now() }}
        </div>
    </div>
@endif
</body>
</html>
