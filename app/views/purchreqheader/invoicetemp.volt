
<legend><h1>
    Invoice
<small class="on-right">Detail Invoice</small>
</h1></legend>


{{ content() }}
{% set total =0 %}
{% if pr is not empty %}
    <table class="table bordered hovered" id="header">
        <thead>
            <tr>
                <th>Kode Pembelian</th>
                <th>Tanggal Approved</th>
                <th>Deskripsi</th>
                <th>Requester</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ pr.PurchReqId }}</td>
                <td>{{ pr.ApprovalDate }}</td>
                <td>{{ pr.PurchReqName }}</td>
                <td>{{ pr.Requester }}</td>
                <td>{{ pr.Status }}</td>
            </tr>
        </tbody>
    </table>

    {% if pr.Purchreqline is not empty %}
        <legend>
            <small class="on-right text-bold fg-darker">Detil Pembelian</small>
        </legend>
        <table class="table bordered hovered" id="detail">
            <thead>
                <tr>
                    <th rowspan="2">No</th>
                    <th rowspan="2">Kode Barang</th>
                    <th rowspan="2">Nama Barang</th>
                    <th colspan="3">Jumlah (Qty.)</th>
                </tr>
                <tr>
                    <th>Pembelian</th>
                    <th>Harga + Ongkir</th>
                    <th>Harga Total</th>
                </tr>
            </thead>
            <tbody>
                {% for line in pr.Purchreqline %}
                    <tr data-prlines="{{ line.RecId }}">
                        <td>{{ loop.index }}</td>
                        <td>{{ line.ItemId }}</td> 
                        <td>{{ line.ItemName }}</td>
                        <td>{{ line.Qty }}</td>
                        <td>Rp {{line.price|number_format(0,',','.')}}</td>
                        <td>{% set harga =line.Qty*line.price %}Rp {{harga |number_format(0,',','.')}}{% set total +=harga %}</td>
                        <td></td>
                        {% endfor %}
                    </tr>
                    <tr>
                        <td colspan='5' align='right' ><b>Jumlah Tagihan</b></td>
                        <td>Rp {{ total|number_format(0,',','.')  }}</td> 
                        <td></td>
                        
                    </tr>
                    <tr>{% if result is not empty %}
                            {% for list in result %}
                                  <td colspan='5' align='right' ><b>Deposit Kelebihan Bayar</b></td>
                                    <td><u>Rp {{ list.Deposit|number_format(0,',','.')}} -</u></td> 
                                    <td></td>
                                
                        {% endfor %}
                        {% else %}
                             <td colspan='4' align='right' ><b>Deposit Kelebihan Bayar</b></td>
                            <td><u>Rp {{ 0 }} -</u></td> 
                            <td></td>
                    {%endif%}
                    </tr>
                    </tr>
                    <tr>{% if result is not empty %}
                            {% for list in result %}
                                  <td colspan='5' align='right' ><b>Deposit Lainnya</b></td>
                                    <td><u>Rp {{ list.DepositLain|number_format(0,',','.')}} -</u></td> 
                                    <td></td>
                                
                        {% endfor %}
                        {% else %}
                             <td colspan='4' align='right' ><b>Deposit Lainnya</b></td>
                            <td><u>Rp {{ 0 }} -</u></td> 
                            <td></td>
                    {%endif%}
                    </tr>

                    
                    <tr>
                                    {% set deposit = list.Deposit %}
                                    {% set depositlainnya = list.DepositLain %}
                                    {% if deposit > total %}
                                  <td colspan='5' align='right' ><b>Total Tagihan</b></td>
                                    <td><b>{% set jumlah=total-deposit-depositlainnya%}Rp {{ 0|number_format(0,',','.')  }}</b></td> 
                                  <td></td>      
                                    {% else %}
                                  <td colspan='5' align='right' ><b>Total Tagihan</b></td>
                                  {% set jumlah=total-deposit-depositlainnya%}
                                    <td><b>Rp {{ jumlah|number_format(0,',','.')  }}</b></td> 
                                  <td></td> 
                                    {% endif %}
                    <tr>
                                    {% set deposit = list.Deposit %}
                                    {% set depositlainnya = list.DepositLain %}
                                    {% if deposit > total %}
                    <tr>
                                  <td colspan='5' align='right' ><b> Sisa Deposit</b></td>
                                    <td><b>{% set jumlahsisadeposit=deposit+depositlainnya-total%}<u>Rp {{ jumlahsisadeposit|number_format(0,',','.')  }}</u></b></td> 
                                  <td></td>
                    <tr>      
                                    {% else %}
                                    {% endif %}
                
                
            </tbody>
        </table>
    {% endif %}
{% endif %}

{{ form("purchreqheader/searchorder", "method":"post") }}
<input type="hidden" name="Purchreqheader" value="{{ pr.RecId }}">
<input type="submit" class="button primary place-right" value="Simpan dan Lanjutkan Pembelian">
{{ end_form() }}