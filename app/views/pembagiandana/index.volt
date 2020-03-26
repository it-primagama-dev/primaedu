
{{ content() }}

<h1>
    Pembagian Dana 89-11
</h1>

{{ form("pembagiandana", "method":"post") }}

<div class="grid fluid">
    <div class="row">
        <div class="span3">
            <label for="Bank">Nama Bank</label>
            <div class="input-control select">
                {{ select_static("Bank", ["BCA" : "BCA", "CardBCA" : "CardBCA", "CardBRI" : "CardBRI", "MANDIRI" : "MANDIRI"]) }}
            </div>
        </div>
        <div class="span3">
            <label for="Tanggal">Tanggal Import</label>
            <div class="input-control text" data-role="datepicker" data-format="yyyy-mm-dd" data-date="{{ date }}">
                {{ text_field("Tanggal", "type" : "text") }}
            </div>
        </div>
    </div>
    <div class="row no-margin">
        <div class="span6">
            {{ submit_button("Generate") }}
        </div>
    </div>
    <div class="row">
        <div class="span6 text-center">
            {{ flash.output() }}
        </div>
    </div>
</div>

{{ end_form() }}

{% if trans is defined %}
    <div class="grid fluid">
    <div class="grid fluid">
        <div class="row">
            <div class="span12">
                <a href="{{ link89 }}" target="_blank" class="on-left-more"><div class="button bg-emerald fg-white">Download File 89<br/>(BCA)</div></a>
				<a href="{{ link89edc}}" target="_blank" class="on-left-more"><div class="button bg-emerald fg-white">Download File 89<br/>(BCA EDC)</div></a>
                <a href="{{ link89edcbri}}" target="_blank" class="on-left-more"><div class="button bg-emerald fg-white">Download File 89 <br/>(BRI EDC )</div></a>
				<a href="{{ link89nonbca }}" target="_blank" class="on-left-more"><div class="button bg-emerald fg-white">Download File 89<br/>(Non-BCA)</div></a>
                <a href="{{ link11 }}" target="_blank" class="on-left-more"><div class="button bg-emerald fg-white">Download File 11<br/>(All)</div></a>
				<a href="{{ link11edc }}" target="_blank" class="on-left-more"><div class="button bg-emerald fg-white">Download File 11<br/>(BCA EDC)</div></a>
				<a href="{{ link11edcbri }}" target="_blank" class="on-left-more"><div class="button bg-emerald fg-white">Download File 11<br/>(BCA EDC BRI)</div></a>
            </div>
        </div>
    </div>

    <table class="table bordered striped hovered">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode / Nama Cabang</th>
                <th>No Rekening BCA</th>
                <th>No Rekening Non-BCA</th>
                <th>Jumlah Total</th>
                <th>Jumlah 89%</th>
                <th>Jumlah 11%</th>
            </tr>
        </thead>
        <tbody>
            {% for pembayaran in trans %}
                {% if pembayaran.rekbca is empty and pembayaran.reknonbca is empty %}<tr class="error">{% else %}<tr>{% endif %}
                    <td class="text-center">{{ loop.index }}</td>
                    <td>{{ pembayaran.cabang }}</td>
                {% if pembayaran.rekbca is empty %}
                    <td class="text-center">-</td>
                {% else %}
                    <td class="text-center" data-hint-position="top"
                        data-hint="Detail Rekening|{{ 'BCA<br/>' ~ pembayaran.namabca }}">
                        {{ pembayaran.rekbca }}
                    </td>
                {% endif %}
                {% if pembayaran.reknonbca is empty %}
                    <td class="text-center">-</td>
                {% else %}
                    <td class="text-center" data-hint-position="top"
                        data-hint="Detail Rekening|{{ pembayaran.namabank ~ '<br/>' ~ pembayaran.namanonbca }}">
                        {{ pembayaran.reknonbca }}
                    </td>
                {% endif %}
                    <td class="idrCurrency text-right">{{ pembayaran.jumlahtotal }}</td>
                    <td class="idrCurrency text-right">{{ pembayaran.jumlah89 }}</td>
                    <td class="idrCurrency text-right">{{ pembayaran.jumlah11 }}</td>
                </tr>
            {% endfor %}
        </tbody>
    </table>
{% endif %}
