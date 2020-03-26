<legend>
<h2>{{ rpt_title }}</h2>
</legend>
{{ content() }}

{{ form("RptOperasional/viewpwe", "method":"post", "Target":"_blank") }}

<div class="grid fluid">
    <!--
    <div class="row">
        <div class="span4">
            <label for="ViewType">Tahun Ajaran</label>
            <div class="input-control select">
                {{ select("tahun", tahun, "using" : ["RecID", "Description"],'useEmpty': true, 'emptyText': '---', 'emptyValue': '') }}
            </div>
        </div>
    </div>
-->
    <!--<div class="row">
        <div class="span2">
            <label for="ViewType">Dari Tahun</label>
            <div class="input-control select">
                <select name="dari_tahun">
                    <option>-- Pilih --</option>
                    {% for index, item in tahun %}
                        <option value="{{item}}">{{item}}</option>
                    {%  endfor %}
                </select>
            </div>
        </div>
        <div class="span2">
            <label for="ViewType">Sampai Tahun</label>
            <div class="input-control select">
                <select name="sampai_tahun">
                    <option>-- Pilih --</option>
                    {% for index, item in tahun %}
                        <option value="{{item}}">{{item}}</option>
                    {%  endfor %}
                </select>
            </div>
        </div>
    </div>-->
    <div class="row no-margin">
        <div class="span2">
            <label for="Tanggal">Dari Tanggal</label>
            <div class="input-control text" data-role="datepicker" data-format="yyyy-mm-dd">
                {{ text_field("DateFrom") }}
            </div>
        </div>
        <div class="span2">
            <label for="Tanggal">Sampai Tanggal</label>
            <div class="input-control text" data-role="datepicker" data-format="yyyy-mm-dd">
                {{ text_field("DateTo") }}
            </div>
        </div>
    </div>
    <div class="row">
        <button onclick="">Tampilkan</button>
    </div>
{{ end_form() }}

