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
                <h1><b>Información de paciente</b></h1>
            </center>

            <div style="width: 100%;padding:5px;box-sizing:border-box;">
                @if ($invoice->buyer->patient->younger)
                    <div style="width: 100%;">
                        <h2><b>Información personal del menor</b></h2>
                    </div>
                    <hr>
                    <div style="width: 100%;padding:10px;box-sizing:border-box;">
                        <h3 style="margin-top: -10px;"><b>Nombre del menor:</b> {{ $invoice->buyer->patient->child[0]['name'] }}</h3>
                        <h3 style="margin-top: -10px;"><b>Edad:</b> {{ $invoice->buyer->patient->child[0]['age'] }}</h3>
                        <h3 style="margin-top: -10px;"><b>Genero:</b> {{ $invoice->buyer->patient->child[0]['sexo'] }}</h3>
                        <h3 style="margin-top: -10px;"><b>Tipo de sangre:</b> {{ $invoice->buyer->patient->child[0]['blood'] }}</h3>
                    </div>
                @endif
            </div>

            <div style="width: 100%;padding:5px;box-sizing:border-box;margin-top:-10px;">
                @if ($invoice->buyer->patient->younger)
                    <div style="width: 100%;">
                        <h2><b>Información del tutor</b></h2>
                    </div>
                @else
                    <div style="width: 100%;">
                        <h2><b>Información personal</b></h2>
                    </div>
                @endif

                <hr>
                <div style="width: auto;padding:10px;box-sizing:border-box;float: left;">
                    <h3 style="margin-top: -10px;"><b>Nombre:</b> {{ $invoice->buyer->patient->name }}</h3>
                    <h3 style="margin-top: -10px;"><b>Cédula:</b> {{ $invoice->buyer->patient->identification }}</h3>
                    <h3 style="margin-top: -10px;"><b>Genero:</b> {{ $invoice->buyer->patient->sexo }}</h3>
                    <h3 style="margin-top: -10px;"><b>Edad:</b> {{ $invoice->buyer->patient->age }}</h3>
                </div>
                <div style="width: auto;padding:10px;box-sizing:border-box;float: left;">
                    @if (!$invoice->buyer->patient->younger)
                        <h3 style="margin-top: -10px;"><b>Tipo de sangre:</b> {{ $invoice->buyer->patient->blood }}</h3>
                    @endif
                    <h3 style="margin-top: -10px;"><b>Teléfono:</b> {{ $invoice->buyer->patient->phone }}</h3>
                    <h3 style="margin-top: -10px;"><b>Dirección:</b> {{ $invoice->buyer->patient->address }}</h3>
                </div>

                @if ($invoice->buyer->patient->military)
                    <div style="width: auto;padding:10px;box-sizing:border-box;">
                        <h3 style="margin-top: -10px;"><b>Institución:</b> {{ $invoice->buyer->institution->name }}</h3>
                        <h3 style="margin-top: -10px;"><b>Rango:</b> {{ $invoice->buyer->patient->range }}</h3>
                    </div>
                @endif
            </div>

            <div style="width: 100%;padding:5px;box-sizing:border-box;">
                <br>
                <h2><b>Consultas medicas</b></h2>
                <hr>
                <br>
                <h2><b>Emergencias medicas</b></h2>
                <hr>
                <br>
            </div>

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
