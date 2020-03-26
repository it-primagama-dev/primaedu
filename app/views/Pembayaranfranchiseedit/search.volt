
{{ content() }}

<h1>
    {{ link_to("pembayaranfranchise/index", '<i class="icon-arrow-left-3 fg-darker smaller"></i>') }}
	Pembayaran Franchise
</h1>

{% set group = 0 %}
{{ form("Pembayaranfranchiseedit/save", "method":"post",  "autocomplete" : "off") }}

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
                    <td>{{ listt.KodeAreaCabang }}</td>
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
			 <input type="text" id="hariBerlaku" name="hariBerlaku" value="{{ list.hariBerlaku}}" >
       </div>
	</div>
	<div class="span1">
		<div class="input-control text" data-role="input-control">
			<input type="text" id="bulanBerlaku" name="bulanBerlaku" value="{{ list.bulanBerlaku }}" style="float:left" ></input>
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
			 <input type="text" id="hariBerirakhir" name="hariBerakhir" value="{{ list.hariBerakhir }}" >
        </div>
	</div>
	<div class="span1">
		<div class="input-control text">
			<input type="text" id="bulanBerakhir" name="bulanBerakhir" value="{{ list.bulanBerakhir }}" style="float:left" ></input>
		</div>
	</div>
	<div class="span1">
		<div class="input-control text">
			<input type="text" id="tahunBerakhir" name="tahunBerakhir" value="{{ list.tahunBerakhir }}" style="float:left" ></input>
		</div>
	</div>
    </div>
</div>
{% set sub3 = list.NilaiFranchisee - list.Diskon * 10 / 100 %}
{% set sub4 = sub7 + sub3 %}
{% set sub5 = list.NilaiFranchisee + sub3 - sub1 %}
{% set sub6 = list.FFID + 1 %}
{% set sub7 = list.NilaiFranchisee - list.Diskon %}

</div>
<input type="hidden" id="FFID" name="FFID" value="{{ list.FranchiseFeeId }}" readonly style="float:left" ></input>
<div class="row no-margin">
	<div class="span3">
        <label for="NilaiFranchisee">Nilai Franchisee</label>
        <div class="input-control text" data-role="input-control" class = "idrCurrency">
            <input type="text" id="NilaiFranchisee" name="NilaiFranchisee" value="{{ list.NilaiFranchisee}}" ></input>
        </div>
    </div>
	<div class="span3">
        <label for="Diskon">Diskon</label>
        <div class="input-control text" data-role="input-control" class = "idrCurrency">
            <input type="text" id="Diskon" name="Diskon" value="{{ list.Diskon}}" ></input>
        </div>
    </div>
	<div class="span3">
        <label for="Dpp">Dpp</label>
        <div class="input-control text" data-role="input-control" class = "idrCurrency">
            <input type="text" id="Dpp" name="Dpp" value="{{ sub7}}" readonly="readonly"></input>
        </div>
    </div>
</div>
<div class="row no-margin">
	<div class="span3">
        <label for="pajak">PPn</label>
        <div class="input-control text">
            <input type="text" name="pajak" id="pajak" value="{{sub3}}"  readonly="readonly"> </input>
        </div>
    </div>
	<div class="span3">
        <label for="Total">Nilai Franchise + PPn</label>
        <div class="input-control text">
            <input type="text" name="Total" id="Total"  readonly="readonly" value="{{list.Total}}" > </input>
        </div>
    </div>
</div> 
<div class="row no-margin">
	<div class="span6 ">
		<label for="Keterangan">Keterangan</label>
		<div class="input-control textarea" data-role="input-control">
		<textarea type="text" name="Keterangan" class = "textarea" cols="50" rows="10" value="{{list.keterangan}}">
		{{list.keterangan}}
		</textarea>  
        </div>
	</div>
</div>
	 <div class="row no-margin">
         {{ submit_button("Submit") }}
    </div>

<script>
    $(document).ready(function() {
        $('#Diskon').keyup(function(){
        var NilaiFranchisee=parseInt($('#NilaiFranchisee').val());
		var Diskon=parseInt($('#Diskon').val());
        var Dpp= NilaiFranchisee - Diskon;
        $('#Dpp').val(Dpp);
        });
    });
</script>	
<script>
    $(document).ready(function() {
        $('#Diskon').keyup(function(){
        var Dpp=parseInt($('#Dpp').val());
		
        var pajak= Dpp*10/100;
        $('#pajak').val(pajak);
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#Diskon').keyup(function(){
        var Dpp=parseInt($('#Dpp').val());
		var pajak=parseInt($('#pajak').val());
        var Total= Dpp + pajak ;
        $('#Total').val(Total);
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#Diskon').keyup(function(){
        var NilaiFranchisee=parseInt($('#NilaiFranchisee').val());
		var pajak=parseInt($('#pajak').val());
        var Total= NilaiFranchisee + pajak - sub1 ;
        $('#Total').val(Total);
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