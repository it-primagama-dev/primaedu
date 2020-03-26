<legend>
<h1>{{ rpt_title }}</h1>
</legend>

{{ content() }} 

{{ form("RptDetailFranchise/viewyear", "method":"post", "target" : "_blank") }}

<div class="grid fluid">
    <div class="row">
        <div class="span4">
            <label for="ViewType">Tahun Berakhir</label>
            <div class="input-control select">
            <select name="tahun">
			<option value= ''>---</option>
            <?php
            for($i='2015'; $i<=date('Y')+10; $i++){
            echo"<option value= '$i'>$i</option>";}
            ?>
            </select>
			</div>
        </div>
    </div>
    <div class="row">
        <button onclick="">Tampilkan</button>
    </div>
</div>
{{ end_form() }}
