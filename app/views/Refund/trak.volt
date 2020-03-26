<h1>
    <form action="downloadSurat/{{nosurat}}" method="POST">
    {{ link_to("refund", '<i class="icon-arrow-left-3 fg-darker smaller"></i>') }} TRACKING DETAIL
    <button type="submit" style="background:none;font-size:24px;font-weight:bold">{{ nosurat }}</button>
    </form>
</h1>

{{ content() }}


<table class="table bordered hovered" id="header">
    <thead>
        <tr>
            <th bgcolor="#000080"><font Color="#FFFFFF"><b> No. </font></th>
            <th bgcolor="#000080"> <font Color="#FFFFFF"><b> Description </font></th>
            <th bgcolor="#000080"><font Color="#FFFFFF"><b> Shipment Status</font></th>
            <th bgcolor="#000080"><font Color="#FFFFFF"><b> Date</font></th>
            <th bgcolor="#000080"><font Color="#FFFFFF"><b> Time</font></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td  bgcolor="#FFFFCC">1</td>
            <td  bgcolor="#FFFFCC"><b>Approve Account Receivable<b></td>
                        {% if TrackFinance is not empty %}
                            <td style="text-align:center">{% if TrackFinance=="REJECTED" %} {{TrackFinance}} <br/>({{Keterangan}}) {% else %} {{TrackFinance}} {% endif %}</td>
                            <td style="text-align:center">{% if TrackFinance=="PENDING" %} - {% else %} {{ tgl }} {% endif %}</td>
                            <td style="text-align:center">{% if TrackFinance=="PENDING" %} - {% else %} {{ jam }} {% endif %}</td>
                        {% endif %}
                        </tr>
                        {% if JenisRefund != 'Deposite' %}
                        <tr>
                            <td  bgcolor="#FFFFCC">2</td>
                            <td  bgcolor="#FFFFCC">Approve Finance</td>
                            {% if TrackGM is not empty %}
                                <td style="text-align:center">{{ TrackGM }}</td>
                                <td style="text-align:center">{% if TrackGM=="PENDING" %} - {% else %} {{ tglGM }} {% endif %}</td>
                                <td style="text-align:center">{% if TrackGM=="PENDING" %} - {% else %} {{ jamGM }} {% endif %}</td>
                            {% endif %}
                        </tr>
                        {% endif %}
                        </tbody>
                        </table>