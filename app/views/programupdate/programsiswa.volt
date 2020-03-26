<table class="table bordered striped hovered" align="center">
    <thead>
        <tr>
            <th>No.</th>
            <th>VA</th>
            <th>Nama Siswa</th>
            <th>Program Saat Ini</th>
            <th>Aksi / Pilih Program</th>
        </tr>
    </thead>                        
                            {% if resultt is not empty %}
                            {% for list in resultt %}
    <tbody>
            <tr>
                <td align="center">{{ loop.index }}</td>
                <td align="center">{{ list.VirtualAccount }} 

<input type="hidden" id="psiswa" name="psiswa[{{ list.Id }}]" value="{{ list.Id }}"</input></td>
                <td>{{ list.NamaSiswa }}</td>
                <td align="center">{{ list.NamaProgram }}</td>

                <td align="center">

                        <div class="row">
                            <div class="span4">
                                <div class="input-control select">
                                <select id="Program" name="Program[{{ list.Id }}]">
                                <option value="">---Pilih Program---</option>
                            {% if program is not empty %}
                            {% for list1 in program %}
                                <option value="{{ list1.RecID }}">{{ list1.NamaProgram }}</option>
                            {% endfor %}
                            {%endif%}
                                </select>
                                </div>
                            </div>
                        </div>
                </td>
            </tr>
    </tbody>
                        {% endfor %}
                        {%endif%}
</table>

