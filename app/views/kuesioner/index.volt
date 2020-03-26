<nav class="navigation-bar blue">
    <nav class="navigation-bar-content">
        <span class="element logo"><img src="{{ url('img/logo_new_putih_web.png') }}"></span>
        <span class="element-divider"></span>
        <a class="element brand" href="#">PRIMA EDU</a>
        <span class="element-divider"></span>
        <span class="element">{{ kodecabang~' - '~namacabang }}</span>
        <span class="element-divider"></span>
        <ul class="element-menu place-right">
            <li>
                <a class="dropdown-toggle icon-cog" href="#"></a>
                <ul class="dropdown-menu place-right" data-role="dropdown">
                    <li><a href="{{ url('chpass/index') }}">Ganti Password</a></li>
                    <li class="divider"></li>
                    <li><a href="{{ url.get('session/end') }}">Logout</a></li>
                </ul>
            </li>
        </ul>
        <span class="element-divider place-right"></span>
        <span class="element place-right">{{ user['fullname'] }}</span>
        <span class="element-divider place-right"></span>
    </nav>
</nav>

<div class="container">
    <div id="wrapper" class="column">
        <div class="wrap margin-left-200">
            <div class="wrap">
                <div class="content-wrapper">
                    <div class="content">
<br>
                    <pre>
                <strong><b><u>Pengantar:</u></b></strong>

                Yth Bapak/Ibu Manajer Cabang Primagama
                Salam sejahtera,

                Dalam rangka untuk meningkatkan layanan kepada cabang, maka mohon kesediaan Bapak/Ibu untuk melakukan pengisian angket <i>“Performance Assessment”</i> 
                bagi <b>Area Manajer (AM)</b> di wilayah cabang Bapak/Ibu. Mohon angket ini dapat diisi dengan sesungguhnya demi kebaikan Primagama kedepannya.
                Terima kasih atas kerjasama yang baik selama ini, semoga Primagama semakin jaya.

                Aamiin
                Direksi PEPB

                                                                             <b>  ANGKET PERFORMA
                                                                                AREA MANAGER </b>
                    </pre>

 {{ form("kuesioner/selesai", "method":"post", "id":"myform") }}
    <table class="table bordered striped hovered" style="width: 100%; border-collapse: collapse">
    <thead>
        <tr>
            <th width="5%">No.</th>
            <th width="80%%">Pertanyaan</th>
            <th width="15%">Jawaban</th>
         </tr>
    </thead> 
    <tbody>
                {% if result1 is not empty %}
                {% for list1 in result1 %}

                <tr>
                <td align="center">{{ loop.index }}</td>
                <td>
                <input type="hidden" id="IdPertanyaan" name="IdPertanyaan[{{ list1.RecID }}]" value="{{ list1.RecID }}">
                {{ list1.Pertanyaan }}</input>
                </td>

                <td>
                {% for list in result %}

                <br><input type="radio" id="IdPilihan" name="IdPilihan[{{ list1.RecID }}]" value="{{ list.IdPilihan }}"> {{ list.Pilihan }}</input></br><br>


                <input type="hidden" id="KuesionerKe" name="KuesionerKe" value="{{ list1.KuesionerKe }}">

                {% endfor %}
                </td>
                </tr>
    {% endfor %}
    {% endif %}

    </tbody>
    </table>

    <table class="table bordered striped hovered" style="width: 100%; border-collapse: collapse">
    <thead>

            <th width="5%">#</th>
       <th width="80%">  <label for="isaran"><strong>Saran dan Masukkan :</strong></label> </th>

    </thead>

    <tbody>
    <tr align="center">
    <td> 11
    </td>
    <td>
            <div class="span15">
                <div class="input-control textarea" data-role="input-control">
                   {{ text_area("saran", "placeholder" : "Ketik disini Saran dan Masukkan...") }}
                </div>
            </div>
    </td>


    </tr>


    </tbody>
    </table>

    <input type="submit" class="command-button primary" id="submit" name="submit" value="Simpan" onclick="return validateForm()"/>
    {{ end_form() }}
</div>
</div>
</div>
</div>
</div>
</div>
<script type="text/javascript">

function validateForm() {
    var x = document.getElementById("myform").elements.namedItem("IdPilihan[{{ list1.RecID }}]").value;
    if (x == null || x == "") {
        alert("Maaf, Anda belum menjawab semua pertanyaan");
        window.location.reload();
        return false;
    }
}

</script>