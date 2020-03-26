<table class="table bordered striped hovered" align="center">
    <thead>
        <tr>
            <th>No.</th>
            <th>Kode Cabang</th>
            <th>Nama Cabang</th>
            <th>Sektor Cabang</th>
            <th>Aksi / Pilih Sektor</th>
        </tr>
    </thead>                        
                            {% if resultt is not empty %}
                            {% for list in resultt %}
    <tbody>
            <tr>
                <td align="center">{{ loop.index }}</td>
                <td align="center">{{ list.KodeAreaCabang }} 
            <input type="hidden" id="Cabang" name="Cabang[{{ list.RecID }}]" value="{{ list.RecID }}"</input></td>
                <td>{{ list.NamaAreaCabang }}</td>
                {% if list.Sektor == '' OR list.Sektor == '0' %}
                <td align="center"><font color="red">Belum Ditentukan</font></td>
                {% else %}
                <td align="center">Sektor {{ list.Sektor }}</td>
                {% endif %}
                <td align="center">
               [ <input type="radio" id="sektor" name="Sektor[{{ list.RecID }}]" value="1" 
               {% if list.Sektor == 1 %} checked {% else %} {% endif %}> <strong>1</strong>  </input> ].
               [ <input type="radio" id="sektor" name="Sektor[{{ list.RecID }}]" value="2" 
               {% if list.Sektor == 2 %} checked {% else %} {% endif %}> <strong>2</strong>  </input> ].
                [ <input type="radio" id="sektor" name="Sektor[{{ list.RecID }}]" value="3" 
               {% if list.Sektor == 3 %} checked {% else %} {% endif %}> <strong>3 </strong> </input> ].
               [ <input type="radio" id="sektor" name="Sektor[{{ list.RecID }}]" value="4" 
               {% if list.Sektor == 4 %} checked {% else %} {% endif %}> <strong>4</strong>  </input> ].
               [ <input type="radio" id="sektor" name="Sektor[{{ list.RecID }}]" value="5" 
               {% if list.Sektor == 5 %} checked {% else %} {% endif %}> <strong>5</strong>  </input> ].
                </td>
            </tr>
    </tbody>
                        {% endfor %}
                        {%endif%}
</table>

