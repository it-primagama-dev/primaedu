
{{ content() }}

<h1>
    {{ link_to("pembayaranfranchise/index", '<i class="icon-arrow-left-3 fg-darker smaller"></i>') }}
	Pembayaran Franchise
</h1>

{% set group = 0 %}
{{ form("Pembayaranfranchise/edit", "method":"post",  "autocomplete" : "off") }}

<table class="table bordered striped hovered">
    <thead>
        <tr>
            <th width="5%">Kode Area Cabang </th>
            <th>Nama Cabang</th>
            <th>Tanggal Berlaku</th>
            <th>Tanggal Berakhir</th>
			<th>Nilai Franchise</th>
			<th>Pembayaran</th>
			<th>Kekurangan</th>
        </tr>
    </thead>
    <tbody>
			{% if result1 is not empty %}
			{% for listt in result1 %}
					
                <tr>
                    <td>{{ listt.RecID }}</td>
					<td>{{ listt.NamaAreaCabang }}</td>
					<td>{{ listt.TanggalBerlaku }}</td>
					<td>{{ listt.TanggalBerakhir }}</td>
					<td>Rp {{ listt.Total |number_format(0,',','.') }}</td>
                    <td>Rp {{ listt.Pembayaran |number_format(0,',','.')}}</td>
					{% set sub1 = listt.Total-listt.Pembayaran %}
					<td>Rp {{ sub1|number_format(0,',','.')}}</td>
                </tr>
			 {% endfor %}
                    {% else %}

                        <tr>
                            <td colspan="12" align="center">- Tidak Ada Data -</td>
                        </tr>

                {% if loop.last %}
                   
             {% endif %}

            {% endif %}
    </tbody>
</table>
{% if result1 is not empty %}
{% for list in result1 %}
<div class="grid fluid">
		<hidden>
		 <input type="hidden" id="recID" name="recID" value="{{ list.RecID}}" readonly >
		</hidden>
		<hidden>
		 <input type="hidden" id="kodeAreaCabang" name="kodeAreaCabang" value="{{ list.KodeAreaCabang}}" readonly >
		</hidden>
<div class="grid fluid">
<div class="row">
<label for="TanggalBerlaku">Tanggal Berlaku</label>
	<div class="span1">
       <div class="input-control text" data-role="input-control">
			 <input type="text" id="hariBerlaku" name="hariBerlaku" value="{{ list.hariBerlaku}}" readonly >
       </div>
	</div>
	<div class="span1">
		<div class="input-control text" data-role="input-control">
			<input type="text" id="bulanBerlaku" name="bulanBerlaku" value="{{ list.bulanBerlaku }}" readonly style="float:left" ></input>
		</div>
	</div>
	<div class="span1">
		<div class="input-control text" data-role="input-control">
			<input type="text" id="tahunBerlaku" name="tahunBerlaku" value="{{ list.tahunBerlaku }}" style="float:left" ></input>
		</div>
	</div>
</div>
<div class="grid fluid">
<div class="row">
<label for="TanggalBerakhir">Tanggal Berakhir</label>
	<div class="span1">
        <div class="input-control text">
			 <input type="text" id="hariBerirakhir" name="hariBerakhir" value="{{ list.hariBerakhir }}" readonly >
        </div>
	</div>
	<div class="span1">
		<div class="input-control text">
			<input type="text" id="bulanBerakhir" name="bulanBerakhir" value="{{ list.bulanBerakhir }}" readonly style="float:left" ></input>
		</div>
	</div>
	<div class="span1">
		<div class="input-control text">
			<input type="text" id="tahunBerakhir" name="tahunBerakhir" value="{{ list.tahunBerakhir }}" readonly style="float:left" ></input>
		</div>
	</div>
    </div>
</div>
{% set sub3 = list.NilaiFranchisee*10/100 %}
{% set sub4 = list.NilaiFranchisee + sub3 %}
{% set sub5 = list.NilaiFranchisee + sub3 - sub1 %}
{% set sub6 = list.FFID + 1 %}
</div>
<input type="text" id="FFID" name="FFID" value="PF-{{list.kodeAreaCabang}}-{{ sub6 }}" readonly >
<div class="row no-margin">
	<div class="span3">
        <label for="NilaiFranchisee">Nilai Franchisee</label>
		<hidden>
        <div class="input-control text" data-role="input-control" class = "idrCurrency">
            <input type="text" id="NilaiFranchisee" name="NilaiFranchisee" value="{{ list.NilaiFranchisee}}" ></input>
        </div>
		</hidden>
    </div>
	<div class="span3">
        <label for="pajak">PPn</label>
        <div class="input-control text">
            <input type="text" name="pajak" id="pajak" value="{{sub3}}"  readonly="readonly"> </input>
        </div>
    </div>
</div>
<div class="row no-margin">
	<div class="span3">
        <label for="total">Nilai Franchise + PPn</label>
        <div class="input-control text">
            <input type="text" name="total" id="total"  readonly="readonly" value="{{sub4}}"> </input>
        </div>
    </div>
	<div class="span3">
        <label for="TglMou">Tanggal MOU</label>
        <div class="input-control text" data-role="datepicker" data-effect="slide" data-format="yyyy-mm-dd">
            <input type="text" id="TglMou" name="TglMou" value="{{ list.TglMou }}"></input>
        </div>
    </div>
</div>
<div class="row no-margin">
	<div class="span6 ">
		<label for="Keterangan">Keterangan</label>
		<div class="input-control textarea" data-role="input-control">
            {{ text_area("Keterangan") }}
        </div>
	</div>
</div>
	 <div class="row no-margin">
         {{ submit_button("Submit") }}
    </div>
	
<script>
    $(document).ready(function() {
        $('#NilaiFranchisee').keyup(function(){
        var NilaiFranchisee=parseInt($('#NilaiFranchisee').val());
		
        var pajak= NilaiFranchisee*10/100;
        $('#pajak').val(pajak);
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#NilaiFranchisee').keyup(function(){
        var NilaiFranchisee=parseInt($('#NilaiFranchisee').val());
		var pajak=parseInt($('#pajak').val());
        var total= NilaiFranchisee + pajak ;
        $('#total').val(total);
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#NilaiFranchisee').keyup(function(){
        var NilaiFranchisee=parseInt($('#NilaiFranchisee').val());
		var pajak=parseInt($('#pajak').val());
        var total= NilaiFranchisee + pajak - sub1 ;
        $('#total').val(total);
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#tahunBerlaku').keyup(function(){
        var tahunBerlaku=parseInt($('#tahunBerlaku').val());
        var tahunBerakhir= tahunBerlaku + 5;
        $('#tahunBerakhir').val(tahunBerakhir);
        });
    });
</script>
		
{% endfor %}
{% endif %}
