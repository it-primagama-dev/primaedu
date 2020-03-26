<legend>
<h2>{{ rpt_title }}</h2>
</legend>
{{ content() }}
<div class="grid fluid">
    <div class="row">
        <div class="span4" style="text-align:center;">
{{ form("cabang/reportaktif", "method":"post", "Target":"_blank") }}
        <button onclick="">Tampilkan Data Cabang Aktif</button>        
{{ end_form() }}
        </div>
        <div class="span4" style="text-align:center;">        
{{ form("cabang/reportnonaktif", "method":"post", "Target":"_blank") }}
        <button onclick="">Tampilkan Data Cabang Non-Aktif</button>
{{ end_form() }}
        </div>
    </div>
</div>

