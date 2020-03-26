<h1>
    {{ link_to("pbadmin/index", '<i class="icon-arrow-left-3 fg-darker smaller"></i>') }}
    Inquiry Pembayaran
    <small>View</small>
</h1>

{{ content() }}

{% set group = '' %}
{% if cabang %}
    <h2 class="place-right"><small>Cabang : {{ cabang.KodeNamaAreaCabang }}</small></h2>
{% endif %}
{% if pembayaran|length > 0 %}
    <table class="table bordered hovered condensed">
        <thead>
            <tr>
                <th>#</th>
                <th>Kode Siswa</th>
                <th>Nama Siswa</th>
                <th>Tipe Pembayaran</th>
                <th>Total Biaya</th>
                <th>Sisa Pembayaran</th>
                <th>Jatuh Tempo</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            {% for list in pembayaran %}
                {% if group != list.Program %}
                    <tr class="bg-steel fg-white">
                        <td>&nbsp;</td>
                        <td colspan="7"><i class="icon-next on-left-more"></i>{{ list.Program|upper }}</td>
                    </tr>
                    {% set group = list.Program %}
                {% endif %}
                <tr>
                    <td>{{ loop.index }}</td>
                    <td>{{ list.KodeSiswa }}</td>
                    <td>{{ list.NamaSiswa }}</td>
                    <td class="text-center">
                        {% if list.PembayaranTipe != 'Lunas' %}
                            {{ list.PembayaranTipe~' - '~list.AngsuranKe }}
                        {% else %}
                            {{ list.PembayaranTipe }}
                        {% endif %}
                    </td>
                    <td class="text-right">{{ list.JumlahTotal|number_format(0,',','.') }}</td>
                    <td class="text-right">{{ list.SisaPembayaran|number_format(0,',','.') }}</td>
                    <td class="text-center">{{ list.JatuhTempo|default('-') }}</td>
                    <td class="text-center" data-pembayaran="{{ list.Pembayaran }}">{{ link_to("pbadmin/view#", 'Detail') }}</td>
                </tr>
            {% endfor %}
        </tbody>
    </table>
{% endif %}
{{ form("pbadmin/detail", "method":"post") }}
    {{ hidden_field("RecID") }}
    {{ hidden_field("Cabang") }}
    {{ hidden_field("Siswa") }}
{{ end_form() }}
<script>
    $('table').on('click', 'a', function(){
        $('#RecID').val($(this).parent().attr('data-pembayaran'));
        $('form').submit();
    });
</script>