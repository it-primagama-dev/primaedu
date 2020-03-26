<legend>
<h2>
<?php echo $this->tag->linkTo(array("barcode/report", '<i class="icon-arrow-left-3 fg-darker smaller"> </i>')); ?> 
Data Jumlah Order Cabang dan Jumlah Barcode Cabang</h2> 
<li>Cabang : {{ KodeCabang }} - {{ NamaCabang.NamaAreaCabang }}</li>
</legend>
{{ content() }}

{% set sumD1 = 0 %}{% set sumD2 = 0 %}{% set sumD3 = 0 %}
{% set subD1 = 0 %}{% set subD2 = 0 %}{% set subD3 = 0 %}
{% set lastarea = '' %}{% set currarea = '' %}

    <tr>
        <td colspan="7">
            <table class="table bordered striped hovered">
                <thead>
                    <tr>
                        <th width="5%">#</th>
                        <th width="27%">PR</th>
                        <th width="15%">Jumlah Order</th>
                        <th width="15%">Jumlah Barcode</th>
                        <th width="5%">Action</th>
                    </tr>
                </thead>

                <tbody>
                    {% if result is not empty %}
                        {% for list in result %}

                             {% set Order+= list.JumlahOrder %}
                             {% set Barcode+= list.JumlahBarcode %}

                                <tr>

                                {% if list.JumlahOrder == list.JumlahBarcode %}

								<td class="text-center">{{ loop.index }}</td>
                                <td class="text-center">{{ list.PurchReqId }}</td>
                                <td class="text-right">{{ list.JumlahOrder|number_format(0,',','.') }}</td>
                                <td class="text-right">{{ list.JumlahBarcode }}</td>
                                <td class="text-center">
                                <a href="{{ url('barcode/detailpr/') }}{{ list.PurchReqId }}">Detail</a>
                                </td>

                                {% else %}

                                <td class="text-center">{{ loop.index }}</td>
                                <td class="text-center">{{ list.PurchReqId }}</td>
                                <td bgcolor='red' class="text-right">{{ list.JumlahOrder|number_format(0,',','.') }}</td>
                                <td bgcolor='red' class="text-right">{{ list.JumlahBarcode }}</td>
                                <td class="text-center">
                                <a href="{{ url('barcode/detailpr/') }}{{ list.PurchReqId }}">Detail</a>
                                </td>

                                {% endif %}
                                </tr>
                        {% endfor %}
                    {% else %}

                        <tr>
                            <td colspan="12" align="center">- Tidak Ada Data -</td>
                        </tr>


                    {% endif %}

					<tr>
                        <th colspan='2' align='center'>Jumlah Total</th>
                        <th  align='right'> {{ Order|number_format(0,',','.') }}</th>
                        <th  align='right'> {{ Barcode|number_format(0,',','.') }}</th>
                        <th  align='right'></th>
                        
                    <tr>

                </tbody>
            </table>

        </td>
    </tr>
