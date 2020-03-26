<h1>Laporan Franchise Tahun Berakhir</h1>

{{ content() }} 

{{ form("RptDetailFranchiseeTanggal/view", "method":"post", "target" : "_blank") }}

{% if rpt_auth['areaparent'] is null %}
<div class="grid fluid">
    <div class="row no-margin">
        <div class="span4">
            <legend class="no-margin">Periode Berakhir Cabang</legend>
        </div>
    </div>
    <div class="row no-margin">
        <div class="span2">
            <label for="Tanggal">Dari Tahun</label>
            <select name="tahun1">
            <?php
            for($i='2015'; $i<=date('Y')+10; $i++){
            echo"<option value= '$i'>$i</option>";}
            ?>
            </select>
        </div>
        <div class="span2">
            <label for="Tanggal">Sampai Tahun</label>
            <select name="tahun2">
            <?php
            for($i='2015'; $i<=date('Y')+10; $i++){
            echo"<option value= '$i'>$i</option>";}
            ?>
            </select>
        </div>
    </div>
    <div class="row">
        <button onclick="">Tampilkan</button>
    </div>
</div>
{% endif %}
{{ end_form() }}
