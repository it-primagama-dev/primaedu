{{ content() }}
<html>
    <head>
        {{ get_title() }}
        {{ assets.outputCss('cssHeader') }}
        {{ assets.outputJs('jsHeader') }}
    </head>
    <body class="metro">
        <div class="content padding-top-60" style="padding-left:25%;padding-right:25%">
            {{ form("absensi/RFID","onsubmit": "test()") }}
            <div class="grid fluid">
                <div class="row">
                    <div class="span4" style="margin-top:inherit">
                        {{ link_to("absensi/index", '<img src="'~url('/img/logo_new_web.png')~'">') }}
                    </div>
                    <div class="span8" style="margin-top:inherit">
                        <h1>Presensi Siswa</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="span12">
                        <label for="KodeSiswa">Kartu Siswa</label>
                        <div class="input-control text" data-role="input-control">
                            {{ text_field("KodeSiswa", "type": "number") }}
                        </div>
                    </div>
                </div>
                {{ flash.output() }}
            </div>
            {{ end_form() }}
        </div>
        <script type="text/javascript">
            $(document).ready(function () {
                input = document.getElementById("KodeSiswa");
                input.value = "";
                input.focus();
            });
            $(".alert").fadeTo(5000, 500).slideUp(500, function () {
                $(this).alert('close');
            });
        </script>
        {{ javascript_include('js/metro.min.js') }}
        {{ javascript_include('js/custom.min.js') }}
    </body>
</html>