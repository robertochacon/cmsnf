<!DOCTYPE html>
<html lang="en">
    <head>
        <title>{{ $invoice->name }}</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

        <style type="text/css" media="screen">
            html {
                font-family: sans-serif;
                line-height: 1.15;
                margin: 0;
            }

            body {
                font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
                font-weight: 400;
                line-height: 1.5;
                color: #212529;
                text-align: left;
                background-color: #fff;
                font-size: 10px;
                margin: 36pt;
            }

            /* .subhead{
                width: 100%;
                display: flex;
                justify-content: space-between;
            }
            .subhead p{
                width: auto;
            } */
        </style>
    </head>

    <body>

        <div>
            <center>
                <h4><b style="text-decoration: underline;">LICENCIA MEDICA</b></h4>
            </center>

            <div class="subhead">
                <p style="float:left;"><b style="text-decoration: underline;">Num. {{ $invoice->buyer->patient->id }}</b></p>
                <p style="float: right;">{{ $invoice->buyer->patient->created_at->format('d/m/Y') }}</p>
            </div>

            <p>
                <br><br><br>
                Deli Director General del Cuerpo Médico y Sanidad Naval, ARD.
                <br><br>
                Cortesmente, por indicacion de <b>{{ Auth::user()->name }}</b> y ARD. EXq• 397-89, le concede licencia Medica por un periodo de ({{ $invoice->buyer->patient->days }}) dias àl I.C. <b>{{ $invoice->buyer->patient->name }}</b>, ARD, S/N "CUERPO MEDICO' ARD., Céd:{{ $invoice->buyer->patient->identification }}, Tel.: {{ $invoice->buyer->patient->phone }}, por presentar como Dx: I) "DEPRESION MAYOR GRAVE" el cual la pasara en {{ $invoice->buyer->patient->address }}, esta Licencia Medica comienza su erectividad las 08:00 horas del dia de la fecha y termina a la misma hora del dia {{ $invoice->buyer->patient->date_end }}.
            </p>
        </div>

        <script type="text/php">
            if (isset($pdf) && $PAGE_COUNT > 1) {
                $text = "{{ __('invoices::invoice.page') }} {PAGE_NUM} / {PAGE_COUNT}";
                $size = 10;
                $font = $fontMetrics->getFont("Verdana");
                $width = $fontMetrics->get_text_width($text, $font, $size) / 2;
                $x = ($pdf->get_width() - $width);
                $y = $pdf->get_height() - 35;
                $pdf->page_text($x, $y, $text, $font, $size);
            }
        </script>
    </body>
</html>
