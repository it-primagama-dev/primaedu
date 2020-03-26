{{ content() }}

<h1>
    {{ link_to("registrasi", '<i class="icon-arrow-left-3 fg-darker smaller"></i>') }}
    Kepemilikan Cabang
</h1>

{{ form("registrasi/proses", "method":"post", "id":"registrasi-form") }}
{% if memberarea is defined %}
    {{ hidden_field("RecID") }}
{% endif %}
<div class="tab-control" data-role="tab-control" data-effect="fade">
    <ul class="tabs">
        <li class="active"><a href="#_tab1">Perorangan</a></li>
        <li class="active"><a href="#_tab2">Badan Usaha</a></li>
    </ul>
 
    <div class="frames">
        <div class="frame" id="_tab1">{{ partial('cabanginput/badanusaha') }}</div>
        <div class="frame" id="_tab2">{{ partial('cabanginput/perorangan') }}</div>
    </div>
</div>
{{ end_form() }}
