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
                <p style="float:left;"><b style="text-decoration: underline;">Num.</b> 2801/</p>
                <p style="float: right;">20-08-2023.</p>
            </div>

            <p>
                <br><br><br>
                Deli Director General del Cuerpo Médico y Sanidad Naval, ARD.
                <br><br>
                Cortesmente, por indicacion de la I.N Psiquatra <b>ANA RUIZ</b> y ARD. EXq• 397-89, le concede licencia Medica por un periodo de (30) dias àl I.C. <b>FRANCISY. DUVERGE MONTES</b>, ARD, S/N "CUERPO MEDICO' ARD., Céd:001-1754266-2, Tel.: 809-802-9192, por presentar como Dx: I) "DEPRESION MAYOR GRAVE" el cual la pasara en la calle 4TA NO. 23 EDIF Eribeth 1, prado oriental, Santo Domingo Este., esta Licencia Medica comienza su erectividad las 08:00 horas del dla de la techa y termina a la misma nora del dia dia 19-09-2023.
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
