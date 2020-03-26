
                        {% if resultt is not empty %}
                        {% for list in resultt %}
                        <input type="hidden" id="kodeprdeposit" name="kodeprdeposit" value="{{ list.PurchReqId }}">      
                        {% endfor %}

                        <input type="hidden" id="pindahdeposit" name="pindahdeposit" value="{{ pr }}">      

                        {%endif%}