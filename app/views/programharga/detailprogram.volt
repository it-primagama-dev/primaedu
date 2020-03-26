<br>
<table class="table bordered striped hovered" align="center">
    <thead>
        <tr>
            <th>No.</th>
            <th>Nama Program</th>
            <th>Harga Bimbingan</th>
            <th>Harga Pendaftaran</th>
            <th>Tanggal Berlaku</th>
        </tr>
    </thead>                        
                                                     {% if resultt is not empty %}
                            {% for list in resultt %}
    <tbody>
            <tr>
                <td align="center">{{ loop.index }}</td>
                <td>
                <input type="hidden" id="Program" name="Program[{{ list.RecID }}]" value="{{ list.RecID }}">
                {{ list.NamaProgram }}</td>
                <td align="center">
                <div class="input-control text" data-role="input-control">
                <input type="text" id="Bimbingan" name="Bimbingan[{{ list.RecID }}]" value="" class="idrCurrency"> 
                </div>
                </td>
                <td align="center">
                <div class="input-control text" data-role="input-control">
                <input type="text" id="Pendaftaran" name="Pendaftaran[{{ list.RecID }}]" value="" class="idrCurrency">
                </div>
                </td>
                <td align="center"> 
            <div class="input-control text" data-role="datepicker" data-format="yyyy-mm-dd">
                <input type="date" id="Tanggal" name="Tanggal[{{ list.RecID }}]" value="">
            </div>
                </td>
            </tr>
    </tbody>
                        {% endfor %}
                        {%endif%}
</table>
<input type="submit" class="command-button primary" id="submit" name="submit" value="Simpan"/>
