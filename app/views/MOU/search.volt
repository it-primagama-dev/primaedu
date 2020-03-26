
{{ content() }}

<h1>
    {{ link_to("pembayaranfranchiseedit/index", '<i class="icon-arrow-left-3 fg-darker smaller"></i>') }}
	Pembayaran Franchise
</h1>

{% set group = 0 %}
{{ form("MOU/save", "method":"post",  "autocomplete" : "off") }}

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
</div>
{% set sub3 = sub7 * 10 / 100 %}
{% set sub4 = sub7 + sub3 %}
{% set sub5 = list.NilaiFranchisee + sub3 - sub1 %}
{% set sub6 = list.FFID + 1 %}
{% set sub7 = list.NilaiFranchisee - list.Diskon %}

</div>
<input type="hidden" id="FFID" name="FFID" value="{{ list.FranchiseFeeId }}" readonly style="float:left" ></input>

<div class="row no-margin">
	<div class="span3">
        <label for="Total">No MOU Franchise Fee</label>
        <div class="input-control text">
            <input type="text" name="NoMOU" id="NoMOU" value="{{list.NoMOU}}" > </input>
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
	{#keterangan#}
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