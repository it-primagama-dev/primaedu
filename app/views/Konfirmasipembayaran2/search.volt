
{{ content() }}


<div align="left">
    <h1>Konfimasi Pembayaran</h1>
</div>

{% set group = 0 %}
{{ form("Konfirmasipembayaran2/create", "method":"post",  "autocomplete" : "off") }}
 
<h1>
    <small class="place-right">
		<a href="{{ url('Konfirmasipembayaran2/nominal')}}">
		Detail Pembayaran<i class="icon-plus on-right smaller"></i></a>
    </small>
</h1>
 
{% if result1 is not empty %}
{% for list in result1 %}
<div class="row no-margin">
<div class="grid fluid">
		
		 <hidden>
		 <input type="hidden" id="recID" name="recID" value="{{ list.RecID}}" readonly >
		 </hidden>
		
		<hidden>
		 <input type="hidden" id="kodeAreaCabang" name="kodeAreaCabang" value="{{ list.KodeAreaCabang}}" readonly >
		</hidden>
		{% if result1 is not empty %}
		{% for list in result1 %}
		<hidden>
		 <input type="hidden" id="TahunMulai" name="TahunMulai" value="{{ list.TahunMulai}}" readonly >
		</hidden>
		
		 <input type="hidden" id="pf" name="pf" value="{{list.pf}}" readonly>
		
		{% endfor %}
		{% endif %}
</div>
<div class="row no-margin">
<label for="Deskripsi">Deskripsi / Keterangan</label>
	<div class="span6">
       <div class="input-control text" data-role="input-control">
			 <input type="text" id="deskripsi" name="deskripsi" >
       </div>
	</div>
</div>
<div class="grid fluid">
<table  width="100px">
	<tr><td >
		<label for="Bank">Nama Bank
            <div class="input-control text" data-role="input-control">
                <select name="bank" id="Bank" onchange="myFunction()">
					<option value="BCA"> BCA</option>
					<option value="Mandiri"> MANDIRI</option>
					<option value="">-other-</option>
					
				</select>
            </div>
		</td>
		<td id="demo" hidden> 
			
		<label for="Bank">Input Nama Bank</label>
            <div class="input-control text" data-role="input-control">
                <?php echo $this->tag->textField(array("Bank", "size" => 30)) ?>
            </div>			
	</td></tr>
</table>
<div class="span3">
	<label for="PurchReqDate">Tanggal</label>
    <div class="input-control text" data-role="datepicker" data-effect="slide" data-format="yyyy-mm-dd">
        <input type="text" id="PurchReqDate" name="PurchReqDate" ></input>
    </div>

{% set sub3 = list.NilaiFranchisee*10/100 %}
{% set sub4 = list.NilaiFranchisee + sub3 %}
{% set sub5 = list.NilaiFranchisee + sub3 - sub1 %}
</div>
<div class="row no-margin">
	<div class="span3">
    <label for="Nominal">Jumlah yang di bayarkan</label>
        <div class="input-control text" data-role="input-control">
            <input type="text" id="Nominal" name="Nominal" class="idrCurrency"></input>
        </div>	
    </div>
</div>
<div class="row no-margin">
	 <div class="row no-margin">
         {{ submit_button("Submit") }}
    </div>
</div>
	
{% endfor %}
{% endif %}

<script>
function myFunction() {
    var x = document.getElementById("Bank").value;
	if(x==""){
		 document.getElementById("demo").style.display = "block";
	}
}
</script>
