<legend>
<h2>Data Jumlah Order Cabang dan Jumlah Barcode Cabang</h2>
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
                        <th width="27%">Cabang</th>
                        <th width="15%">Jumlah Order</th>
                        <th width="15%">Jumlah Barcode</th>
                        <th width="15%">Jumlah Barcode (2013)</th>
                        <th width="8%">Action</th>
                    </tr>
                </thead>

                <tbody>
                    {% if result is not empty %}
                        {% for list in result %}

                             {% set Order+= list.JumlahOrder %}
                             {% set Barcode+= list.JumlahBarcode %}
                             {% set Barcode2013+= list.JumlahBarcode2013 %}
                             {% set NotSinkron+= list.JumlahOrder != list.JumlahBarcode %}

                                <tr>

                                {% if list.JumlahOrder == list.JumlahBarcode %}

								<td class="text-center">{{ loop.index }}</td>
                                <td class="text-left">{{ list.KodeAreaCabang }} - {{ list.NamaAreaCabang }}</td>
                                <td class="text-right">{{ list.JumlahOrder|number_format(0,',','.') }}</td>
                                <td class="text-right">{{ list.JumlahBarcode }}</td>
								<td class="text-right">{{ list.JumlahBarcode2013 }}</td>
                                <td class="text-center">
                                <a href="{{ url('barcode/detailreport/') }}{{ list.KodeAreaCabang }}">Detail</a>
                                </td>

                                {% else %}

                                <td class="text-center">{{ loop.index }}</td>
                                <td class="text-left">{{ list.KodeAreaCabang }} - {{ list.NamaAreaCabang }}</td>
                                <td bgcolor='red' class="text-right">{{ list.JumlahOrder|number_format(0,',','.') }}</td>
                                <td bgcolor='red' class="text-right">{{ list.JumlahBarcode }}</td>
                                <td class="text-right">{{ list.JumlahBarcode2013 }}</td>
                                <td class="text-center">
                                <a href="{{ url('barcode/detailreport/') }}{{ list.KodeAreaCabang }}">Detail</a>
                                </td>

                                {% endif %}
                                </tr>
                        {% endfor %}
                        <marquee scrollamount="15"><h4><left><font color="red">
                        {{ NotSinkron }} Cabang Tidak Sinkron...
                        </font></left></h4></marquee>
                          
                          <br>
                    {% else %}

                        <tr>
                            <td colspan="12" align="center">- Tidak Ada Data -</td>
                        </tr>


                    {% endif %}

					<tr>
                        <th colspan='2' align='center'>Jumlah Total</th>
                        <th  align='right'> {{ Order|number_format(0,',','.') }}</th>
                        <th  align='right'> {{ Barcode|number_format(0,',','.') }}</th>
                        <th  align='right'> {{ Barcode2013|number_format(0,',','.') }}</th>
                        <th  align='right'></th>
                        
                    <tr>

                </tbody>
            </table>

        </td>
    </tr>
