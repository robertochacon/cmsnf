<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Reporte de licencias medicas</title>
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
                font-size: 12px;
                margin: 36pt;
            }

            table, th, td {
                border: 1px solid black;
                border-collapse: collapse;
                padding: 3px;
            }
            th {
                text-align: center;
            }
            td {
                text-align: left;
            }
        </style>
    </head>

    <body>

        <div>

            <center>
                @if($invoice->logo)
                    <img src="{{ $invoice->getLogo() }}" alt="logo" height="100">
                    <h2>DIRECCIÓN GENERAL DE CUERPO MEDICO Y SANIDAD NAVAL, ARD.</h2>
                @endif
                <hr>
                <h2><b>Reporte de licencias medicas</b></h2>
                <hr>
            </center>



            <div style="width: 100%;padding:5px;box-sizing:border-box;">
                @if ($invoice->buyer->licences)

                <table class="table" style="width:100%">
                    <caption style="text-align: left;"><h4>Lista de licencias medicas</h4></caption>
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Cédula</th>
                        <th scope="col">Teléfono</th>
                        <th scope="col">Dias</th>
                        <th scope="col">Fecha inicio</th>
                        <th scope="col">Fecha final</th>
                        <th scope="col">Estado</th>
                      </tr>
                    </thead>
                    <tbody>

                    @if (count($invoice->buyer->licences) > 1)

                        @foreach($invoice->buyer->licences as $key => $value)
                            <tr>
                                <td style="text-align: center;">{{ $key+1 }}</td>
                                <td>{{ $value["name"] ?? "N/A" }}</td>
                                <td>{{ $value["identification"] ?? "N/A" }}</td>
                                <td>{{ $value["phone"] ?? "N/A" }}</td>
                                <td>{{ $value["days"] ?? "N/A" }}</td>
                                <td>{{ $value["date_start"] ?? "N/A" }}</td>
                                <td>{{ $value["date_end"] ?? "N/A" }}</td>
                                <td>{{ $value["status"] ?? "N/A" }}</td>
                            </tr>
                        @endforeach

                    @else
                        <tr>
                            <td colspan="8" style="text-align: center;">Registros no disponibles.</td>
                        </tr>
                    @endif


                    </tbody>
                </table>

                @endif
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
