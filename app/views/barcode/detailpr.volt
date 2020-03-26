<legend>
<h2>
<?php echo $this->tag->linkTo(array("barcode/detailreport/"."$KdCabang"."", '<i class="icon-arrow-left-3 fg-darker smaller"> </i>')); ?> 
Data Jumlah Order Cabang dan Jumlah Barcode Cabang</h2> 
<li>{{ PR }}</li>
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
                        <th width="27%">Nama Item</th>
                        <th width="15%">Jumlah Order</th>
                        <th width="15%">Jumlah Barcode</th>
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
                                <td class="text-center">{{ list.NamaItem }}</td>
                                <td class="text-right">{{ list.JumlahOrder|number_format(0,',','.') }}</td>
                                <td class="text-right">{{ list.JumlahBarcode }}</td>

                                {% else %}

                                <td class="text-center">{{ loop.index }}</td>
                                <td class="text-center">{{ list.NamaItem }}</td>
                                <td bgcolor='red' class="text-right">{{ list.JumlahOrder|number_format(0,',','.') }}</td>
                                <td bgcolor='red' class="text-right">{{ list.JumlahBarcode }}</td>

                                {% endif %}
                                </tr>
                        {% endfor %}

                                <tr>
                                    <th colspan='2' align='center'>Jumlah Total</th>
                                    <th  align='right'> {{ Order|number_format(0,',','.') }}</th>
                                    <th  align='right'> {{ Barcode|number_format(0,',','.') }}</th>
                                    
                                <tr>
                    {% else %}

                        {% if result2 is not empty %}
                            {% for list in result2 %}

                             {% set Order+= list.JumlahOrder %}
                             {% set Barcode+= list.JumlahBarcode %}

                                <tr>

                                {% if list.JumlahOrder == list.JumlahBarcode %}

                                <td class="text-center">{{ loop.index }}</td>
                                <td class="text-center">{{ list.NamaItem }}</td>
                                <td class="text-right">{{ list.JumlahOrder|number_format(0,',','.') }}</td>
                                <td class="text-right">{{ list.JumlahBarcode }}</td>

                                {% else %}

                                <td class="text-center">{{ loop.index }}</td>
                                <td class="text-center">{{ list.NamaItem }}</td>
                                <td bgcolor='red' class="text-right">{{ list.JumlahOrder|number_format(0,',','.') }}</td>
                                <td bgcolor='red' class="text-right">{{ list.JumlahBarcode }}</td>

                                {% endif %}
                                </tr>
                        {% endfor %}
                                <tr>
                                    <th colspan='2' align='center'>Jumlah Total</th>
                                    <th  align='right'> {{ Order|number_format(0,',','.') }}</th>
                                    <th  align='right'> {{ Barcode|number_format(0,',','.') }}</th>
                                    
                                <tr>
                    {% else %}

                        <tr>
                            <td colspan="12" align="center">- Tidak Ada Data -</td>
                        </tr>


                    {% endif %}


                    {% endif %}


                    

                </tbody>
            </table>

        </td>
    </tr>
