<!doctype html>
<html>

<head>
    <!-- <meta charset="utf-8"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    @vite('resources/css/app.css')

    <style>
        ul {
            list-style: disc;
            margin-left: 1rem;
        }

        ol {
            list-style: decimal;
            margin-left: 1rem;
        }
    </style>
</head>

<body class="font-serif">
    <div id="print" class="container mx-auto my-0">
        <div class="grid grid-cols-4 place-items-center -mb-12">
            <div class="col-auto w-full overflow-y-hidden">
                <img class="object-none object-center h-48 w-80" src="{{ asset('images/logo.svg') }}" alt="logo">
            </div>
            <div class="col-span-3 w-full text-center">
                <h1 class="font-bold leading-tight text-sky-700 text-xl">LPPL RADIO BROMO FM 92,3 MHZ</h1>
                <p class="text-xs font-bold">(Lembaga Penyiaran Publik Lokal Kabupaten Probolinggo)</p>
                <p class="text-xs font-bold">Gedung Islamic Centre Lantai Dasar</p>
                <p class="text-xs font-bold">Jl. Rengganis No.1 Kraksaan Kabupaten Probolinggo</p>
                <p class="text-xs font-bold">Telp. (0335) 842743, Email: bromofm_radio@yahoo.com</p>
            </div>
        </div>
        <hr class="border-2 border-black mb-1">
        <hr class="border border-black">
        <h2 class="text-sm text-center tracking-widest mt-4">SURAT KETERANGAN</h2>
        <p class="text-sm text-center mt-2">Nomor: {{ $report->reference_number }}</p>
        <p class="text-xs indent-8 mt-4 text-justify">Bersama in kami memberitahukan dengan hormat bahwa telah disiarkan
            Berita
            Kehilangan
            dari SPKT {{ $report->police_station }}, yang dilaporkan pada {{ $report->getReportDate() }} sebagai
            berikut:</p>
        <table class="mx-auto text-xs mt-2">
            <tr>
                <td>Nama</td>
                <td class="font-bold"> : {{ $report->name }}</td>
            </tr>
            <tr>
                <td>NIK</td>
                <td> : {{ $report->nik }}</td>
            </tr>
            <tr>
                <td>Tempat tanggal lahir</td>
                <td> : {{ $report->birthplace }} {{ date('d-m-Y', strtotime($report->birthdate)) }}</td>
            </tr>
            <tr>
                <td>Kewarganegaraan</td>
                <td> : {{ $report->citizen }}</td>
            </tr>
            <tr>
                <td>Pekerjaan</td>
                <td> : {{ $report->profession }}</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td> : {{ $report->address }}</td>
            </tr>
        </table>
        <p>Kehilangan:</p>
        <div class="text-justify text-xs">
            {!! $report->content !!}
        </div>
        <p class="text-xs text-justify indent-8 mt-2">Demikianlah surat bukti siar ini dibuat dengan sebenarnya
            berdasarkan SURAT
            TANDA LAPOR
            KEHILANGAN dari SPKT {{ $report->police_station }}.</p>

        <div class="flex justify-end mt-2">
            <div class="text-center text-xs">
                <p class="mb-2">{{ $report->getDate() }}</p>
                <p>LPPL BROMOFM</p>
                <p>KABUPATEN PROBOLINGGO</p>
                <p>Kepala Studio</p>
                <p class="underline underline-offset-0 mt-10">Sony Wahyu Wirawan, S.I.Kom</p>
                <p>NIP. 19830210201101006</p>
            </div>
        </div>
    </div>
    {{-- <button onclick="generatePDF()">Save</button> --}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"
        integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        function generatePDF() {
            const element = document.getElementById('print');
            const opt = {
                margin: [-0.4, 1],
                filename: 'document.pdf',
                image: {
                    type: 'jpeg',
                    quality: 0.98
                },
                html2canvas: {
                    scale: 2,
                    height: 1024
                },
                jsPDF: {
                    unit: 'in',
                    format: 'letter',
                    orientation: 'portrait'
                }
            };

            html2pdf().set(opt).from(element).save();
        }

        generatePDF();
    </script>
</body>

</html>