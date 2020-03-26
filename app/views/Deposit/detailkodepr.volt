                        {% if resultt is not empty %}
                            {% for list in resultt %}
                                    <br>
                                  <td colspan='4' align='right' ><b>Deposit Saat Ini :</b></td>
                                    {% set TotalDeposit = list.Deposit+list.DepositLain %}
                                    <td><u>Rp {{ TotalDeposit|number_format(0,',','.')}} -</u></td> <br>
                                    <font color="red" size="2px"><b>*Note : Deposit tsb adalah akumulasi dari deposit kelebihan bayar dan deposit lainnya.</b></font>
                                    <td><input type="hidden" id="kodeprdeposit" name="kodeprdeposit" value="{{ list.PurchReqId }}"></td>
                                    <br></br>
                                
                        {% endfor %}
                        {% else %}
                                    <br>
                             <td colspan='4' align='right' ><b>Deposit Cabang Saat Ini :</b></td>
                            <td><u>Rp {{ 0 }} -</u></td> 
                            <td><input type="hidden" id="kodeprdeposit" name="kodeprdeposit" value="{{ list.PurchReqId }}"></td>
                                    <br></br>
                        {%endif%}

{% if result is not empty %}
    <div class="row no-margin">
        <div class="span4">
            <label for="ViewType">Nominal (Deposit Lainnya)</label>
            <div class="input-control select">
                <select name="Nominal" id="Nominal">
                    <option value="">--</option>
                    {% for i in result %}
                    <option value="{{ i.Deposite|number_format(2,',','.') }}">{{ i.NoSuratPernyataan }}- Rp.{{ i.Deposite|number_format(2,',','.') }}</option>
                    {% endfor %}
                </select>
                <input type="hidden" id="NoSuratPernyataan" name="NoSuratPernyataan" value="{{ i.NoSuratPernyataan }}">
            </div>
        </div>
    </div>
{% else %}
    <div class="row no-margin">
        <div class="span4">
            <label for="Nominal">Nominal (Deposit Lainnya)</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("Nominal", "maxlength" : 30, "class": "Idr", "placeholder":"Wajib Diisi") }}
            </div>
        </div>
    </div>
{%endif%}

<script>
$(document).ready(function(){
    $(".Idr").autoNumeric('init', {aSign: 'Rp ', aDec: ',', aSep: '.'});
});
</script>