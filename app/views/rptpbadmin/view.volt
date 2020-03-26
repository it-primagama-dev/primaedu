<style type="text/css">
    @media print{@page {size: A4 landscape}}
</style>



{{ content() }}


{% set group = '' %}
{% if cabang %}



<style type="text/css">
    @media print{@page {size: A4 landscape}}
</style>
<table class="tablePrint" style="width:100%;">
    <tr>
        <td colspan="7">
            <table style="width:100%;">
                <tr>
                    <td align="center"><img src="{{ url('img/logo_new_web.png') }}" width="220"></td>
                    <td align="center" width="75%">
                        <h2>Inquiry Pembayaran</h2>
                    </td>
                    <td width="20%" align="right">
                        <a href="#" id="downloadBtn" class="btn"><img src="{{ url('img/Excel-icon.png') }}"></a>
                   <a href="javascript::void();" onclick="window.print();" id="printLink" class="btn"><img src="{{ url('img/printer-icon.png') }}"></a>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <h3 style="margin: 4px 0">Cabang : {{ cabang.KodeNamaAreaCabang }}</h3>
                    </td>
                    <td>&nbsp;</td>
                </tr>
            </table>    
        </td>
    </tr>
    <tr>
        <td colspan="7"><hr color="#000000"/></td>
    </tr>
</table>




{% endif %}


{% if pembayaran|length > 0 %}
  <table class="table bordered hovered table2excel" style="table-layout: fixed; border-collapse: collapse">

        <thead>
            <tr>
                <th width="35px">#</th>
                <th width="100px">Kode Siswa</th>
                <th width="200px">Nama Siswa</th>
                <th width="150px">Tipe Pembayaran</th>
                <th width="150px">Total Biaya</th>
                <th width="150px">Sisa Pembayaran</th>
                <th width="150px">Jatuh Tempo</th>
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
                </tr>
            {% endfor %}
        </tbody>
    </table>
{% endif %}
<script>
    $('#downloadBtn').on('click', function () {
        $(".table2excel").table2excel({
            exclude: ".noExl",
            name: "Primaedu",
            filename: "Inquiry Pembayaran"
        });
    });
</script>
