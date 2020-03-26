<h1>{{ rpt_title }}</h1>

{{ content() }}

{{ form("Rptabsensi/view", "method":"post", "target" : "_blank") }}

<div class="grid fluid">
    {% if rpt_auth['areaparent'] is null %}
        <div class="row">
            {% if rpt_auth['areacabang'] == 0 %}
                <div class="span4">
                    <label for="ViewType">Area</label>
                    <div class="input-control select">
                        {{ select("Area", area, "using" : ["RecID", "NamaAreaCabang"]) }}
                    </div>
                </div>
            {% else %}
                {{ hidden_field("Area") }}
            {% endif %}
        </div>
        <div class="row no-margin">
            <div class="span4">
                <label for="ViewType">Cabang</label>
                <div class="input-control select">
                    <select id="Cabang" name="Cabang"></select>
                </div>
            </div>
        </div>
    {% endif %}
    
    <div class="row no-margin">
        <div class="span4">
            <legend class="no-margin">Periode Laporan Per-Siswa</legend>
        </div>
    </div>
	
	<style type="text/css">
    table .td-input input[type=text]
    {
        width:400px;

    }
    table .td-input
    {
        padding-bottom:10px;
    }
    #msg{color:#ff0000;text-align:left;padding-top:20px}
    .input-control.text,.input-control.select{padding:0px 10px}
    label{text-align:left;padding-left:10px}
</style>
<div class="grid fluid">	
		
			<div class="row grid fluid">
				<div class="span2">
					<label for="DateFrom">Dari Tanggal</label>
					<div class="input-control text" data-role="datepicker" data-format="yyyy-mm-dd">
						{{ text_field("DateFrom") }}
					</div>
				</div>
				<div class="span2">
					<label for="DateTo">Sampai Tanggal</label>
					<div class="input-control text" data-role="datepicker" data-format="yyyy-mm-dd">
						{{ text_field("DateTo") }}
					</div>
				</div>
			</div>        
		<div class="row">
			<button onclick="">Tampilkan</button>
		</div>
	</div>		
      {{ end_form() }}
	  
				
		
	
	{{ end_form() }}	


{% if rpt_auth['areaparent'] is null %}
    <script type="text/javascript">
        $(document).ready(function () {
            optCabang();
            $('#Area').on('change', function () {
                optCabang();
            });
        });
        function optCabang() {
            url = '{{ url('Rptabsensi/getcabang/') }}' + $('#Area').val();
            $.get(url).done(function (data) {
                $('#Cabang').html(data);
            });
        }
    </script>
{% endif %}

{% if nosiswa is defined %}
    <script type='text/javascript'>
        document.getElementById('Siswa').value = "{{ nosiswa }}";
        inqPembayaran(document.getElementById('Siswa').value, true);
    </script>
{% endif %}
{{ stylesheet_link('css/select2.custom.min.css') }}
{{ javascript_include('js/select2.min.js') }}
<script type="text/javascript">
    $(function () {
        $('#Siswa').select2();
    });
</script>