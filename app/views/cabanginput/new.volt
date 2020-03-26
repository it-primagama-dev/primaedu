<h1>{{ rpt_title }}</h1>

{{ content() }}

{{ form("cabanginput/save", "method":"post",  "autocomplete" : "off") }}
<h1>
    {{ link_to("cabanginput/index", '<i class="icon-arrow-left-3 fg-darker smaller"></i>') }}
    Pilih Cabang
</h1>
<h3 style="margin: 4px 0">Area : {{ rpt_area }}, Cabang : {{ rpt_cabang }}</h3>
<div class="grid fluid">
	<legend>Kepemilikan Cabang</legend>
    <div class="row no-margin">
        <div class="span3">
			{% if result1 is not empty %}
			{% for list in result1 %}
			<hidden>
			<input type="hidden" id="recID" name="recID" value="{{ list.KodeAreaCabang}}" readonly >
			</hidden>
			{% endfor %}
			{% endif %}
			{% if result2 is not empty %}
			{% for list in result2 %}
			<input type="text" id="NamaFSEE" name="NamaFSEE" value="{{ list.KodeCabang}}">
       		{% endfor %}
        	{% endif %}
            <label for="NamaFSEE">Nama FSEE</label>
            <div class="input-control text" data-role="input-control">
				<input type="text" id="NamaFSEE" name="NamaFSEE" value="{{ list.NamaFSEE}}">
            </div>

        </div>
        <div class="span3">
            <label for="Statuskepemilikan">Status Kepemilikan</label>
			<input type="radio" name="rab" id="rad1" value="Perorangan" class="rab"/> Perorangan <br>
			<input type="radio" name="rab" id="rad2" value="CV" class="rab"/> CV <br>
			<input type="radio" name="rab" id="rad3" value="PT" class="rab"/> PT <br>
			<input type="radio" name="rab" id="rad4" value="4" class="rab"/> Yang lain....
				<!-- form yang mau ditampilkan-->
				<div id="form4" style="display:none">
					Yang lain.... <input name="yanglain1" type="text"/>
				</div>
			<!-- tambahkan jquery-->
			<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
			<script type="text/javascript">
				$(function(){
					$(":radio.rab").click(function(){
						$("#form3, #form4").hide()
						if($(this).val() == "4"){
							$("#form4").show();
						}
					});
				});
			</script>
        </div>
		<div class="span3">
				<label for="Direktur">Direktur</label>
				<div class="input-control text" data-role="input-control">
                <input type="text" id="Direktur" name="Direktur" value="{{ list.Direktur}}">
				</div>
			</div>
        </div>
		<div class="row no-margin">
        <div class="span6">
            <label for="AlamatSurat">Alamat Surat</label>
			<div class="input-control textarea" data-role="input-control" name = "AlamatSurat">
				{{ text_area("AlamatSurat") }}
			</div>
        </div>
    </div>
	
	<div class="row no-margin">
		<div class="span3">
            <label for="BadanUsaha">Badan Usaha</label>
            <div class="input-control text" data-role="input-control">
                <input type="text" id="BadanUsaha" name="BadanUsaha" value="{{ list.BadanUsaha}}">
            </div>
        </div>
		<div class="span3">
            <label for="Telp">No Telepon</label>
            <div class="input-control text" data-role="input-control">
                <input type="text" id="Telp" name="Telp" value="{{ list.Telp}}">
            </div>
        </div>
    </div>
	<div class="row no-margin">
        <div class="span3">
            <label for="SIUP">SIUP</label>
            <div class="input-control text" data-role="input-control">
                <input type="text" id="SIUP" name="SIUP" value="{{ list.SIUP}}">
            </div>
        </div>
        <div class="span3">
            <label for="NPWP">NPWP</label>
            <div class="input-control text" data-role="input-control">
                <input type="text" id="NPWP" name="NPWP" value="{{ list.NPWP}}">
            </div>
        </div>
		<div class="span3">
            <label for="TDP">TDP</label>
            <div class="input-control text" data-role="input-control">
                <input type="text" id="TDP" name="TDP" value="{{ list.TDP}}">
            </div>
        </div>
	</div>
	<div class="row no-margin">
		<div class="span3">
            <label for="NoKTP">NoKTP</label>
            <div class="input-control text" data-role="input-control">
                <input type="text" id="NoKTP" name="NoKTP" value="{{ list.NoKTP}}">
            </div>
        </div>
        <div class="span6">
			<label for="DataKTP">Data KTP</label>
			<div class="input-control textarea" data-role="input-control">
				{{ text_area("DataKTP") }}
			</div>
		</div>
	</div>
	
	<legend>Organisasi Cabang</legend>
	<div class="row no-margin">
        <div class="span3 ">
			<label for="KepalaCabang">Kepala Cabang</label>
			<div class="input-control text" data-role="input-control">
                <input type="text" id="KepalaCabang" name="KepalaCabang" value="{{ list.KepalaCabang}}">
            </div>
		</div>
		<div class="span3">
            <label for="TelpKpCb">No Telepon / Hp Kepala Cabang</label>
            <div class="input-control text" data-role="input-control">
                <input type="text" id="TelpKpCb" name="TelpKpCb" value="{{ list.TelpKpCb}}">
            </div>
        </div>
		<div class="span5">
            <label for="AlamatKpCb">Alamat Kepala Cabang</label>
			<div class="input-control textarea" data-role="input-control">
				{{ text_area("AlamatKpCb") }}
			</div>
        </div>
	</div>
	<div class="row no-margin">
        <div class="span3 ">
			<label for="PAC">PAC</label>
			<div class="input-control text" data-role="input-control">
                <input type="text" id="PAC" name="PAC" value="{{ list.PAC}}">
            </div>
		</div>
		<div class="span3">
            <label for="TelpPAC">No Telepon / Hp PAC</label>
            <div class="input-control text" data-role="input-control">
                <input type="text" id="telpPAC" name="telpPAC" value="{{ list.TelpPAC}}">
            </div>
        </div>
	</div>
	<div class="row no-margin">
		<div class="span3">
			<label for="SDM">I-Smart Tetap</label>
			<div class="input-control text" data-role="input-control">
                <input type="text" id="ismart" name="ismart" value="{{ list.Ismart}}">
            </div>
		</div>
		<div class="span3">
            <label for="TelpPAC">No Telepon / Hp I-Smart</label>
            <div class="input-control text" data-role="input-control">
                <input type="text" id="TelpIsmart" name="TelpIsmart" value="{{ list.TelpIsmart}}">
            </div>
        </div>
        
	</div>
	
	<div class="row no-margin">
	<div class="span3">
	<legend>Bentuk bangunan</legend>
		<input type="radio" name="rac" id="rad1" value="Rumah" class="rac"/> Rumah
		<input type="radio" name="rac" id="rad2" value="Ruko" class="rac"/> Ruko
		<input type="radio" name="rac" id="rad3" value="3" class="rac"/> Yang lain....
			<!-- form yang mau ditampilkan-->
				<div id="form3" style="display:none">
					Yang lain.... <input name="YBentuk" type="text"/>
				</div>
			<!-- tambahkan jquery-->
			<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
			<script type="text/javascript">
				$(function(){
					$(":radio.rac").click(function(){
						$("#form2, #form3").hide()
						if($(this).val() == "3"){
							$("#form3").show();
						}
					});
				});
			</script>
	</div>	
	
	<div class="span3">
	<legend>Status bangunan</legend>
		<input type="radio" name="rad" id="rad1" value="Milik Sendiri" class="rad"/> Milik Sendiri
		<input type="radio" name="rad" id="rad2" value="Sewa" class="rad"/> Sewa
		<input type="radio" name="rad" id="rad3" value="3" class="rad"/> Yang lain....
			<!-- form yang mau ditampilkan-->
			<div id="form2" style="display:none">
				Harga sewa = <input name="sewa" type="text"/></ br></ br>
				Awal sewa = <input name="awal" type="text"/></ br></ br>
				Akhir sewa = <input name="akhir" type="text"/></ br>
			</div>
			<div id="form3" style="display:none">
				Yang lain.... <input name="input" type="text"/>
			</div>
		<!-- tambahkan jquery-->
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
		<script type="text/javascript">
			$(function(){
				$(":radio.rad").click(function(){
					$("#form2, #fo").hide()
					if($(this).val() == "Sewa"){
						$("#form2").show();
					}else
					if($(this).val() == "3"){
						$("#form3").show();
					}
				});
			});gq
		</script>
	</div>
</div>

         {{ submit_button("Simpan") }}
    </div>
</div>
{{ end_form() }}


{% if rpt_auth['areaparent'] is null %}
<script type="text/javascript">
$(document).ready(function(){
    optCabang();
    $('#Area').on('change', function(){optCabang();});
});
function optCabang() {
    url = '{{ url('rptrekapjenjang/getcabang/') }}' + $('#Area').val();
    $.get(url).done(function(data){$('#Cabang').html(data);});
}
</script>
{% endif %}
{% if jatuhtempo is defined %}
<table class="table bordered striped hovered">
    <thead>
        <tr>
            <th width="5%">Kode Area Cabang </th>
            <th>Nama Cabang</th>
            <th>Tanggal Berlaku</th>
            <th>Tanggal Berakhir</th>
            <th width="10%">Action</th>
        </tr>
    </thead>
    <tbody>
			{% if result is not empty %}
					{% for list in result %}
					
                <tr>
                    <td>{{ list.RecID }}</td>
					<td>{{ list.NamaAreaCabang }}</td>
					<td>{{ list.TanggalBerlaku }}</td>
					<td>{{ list.TanggalBerakhir }}</td>
                    <td>{{list.TgPembayaran}}</td>
						<a href="{{ url('pembayaranfranchise/index'~list.RecID)}}">Edit </a>
						
                    </td>
                </tr>
            {% endfor %}
        {% endif %}
    </tbody>
</table>
{%endif%}