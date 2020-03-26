<center><h3>Mohon untuk melengkapi data pembayaran siswa berdasarkan
</br> tahun ajaran 2015/2016 atau 2016/2017</h3>
</center>

{{ content() }}

{{ form("TransaksiSiswa/view", "method":"post") }}

<div class="grid fluid">
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
    

    <div class="row">
        <center><button onclick="">Tampilkan</button> </center>
    </div>
</div>
{{ end_form() }}

