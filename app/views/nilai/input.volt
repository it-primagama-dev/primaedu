<style> .width-auto { width: auto !important; } </style>

{{ content() }}

<h1>
    <a href="#" id="backlink" data-parm="{{ program.RecID }}">
        <i class="icon-arrow-left-3 fg-darker smaller"></i>
    </a>
    Upload Nilai
    <small class="on-right">{{ program.NamaProgram }}</small>
    <small class="place-right">
        {{ link_to('nilai/download/'~program.RecID, 'Download Template<i class="icon-download-2 on-right smaller"></i>', 'target': '_blank') }}
    </small>
</h1>

{{ form("nilai/upload", "method":"post", "enctype":"multipart/form-data") }}
<div class="grid fluid">
    <div class="row no-margin">
        <div class="span4">
            <label for="Nilai">Input</label>
            <div class="input-control select" data-role="input-control">
                {{ select_static('Nilai', [
'Nilai1': 'Nilai 1','Nilai2': 'Nilai 2','Nilai3': 'Nilai 3','Nilai4': 'Nilai 4','Nilai5': 'Nilai 5',
'Nilai6': 'Nilai 6','Nilai7': 'Nilai 7','Nilai8': 'Nilai 8','Nilai9': 'Nilai 9','Nilai10': 'Nilai 10'
]) }}
            </div>
        </div>
    </div>
    <div class="row no-margin">
        <div class="span4">
            <label for="File">File Excel</label>
            <div class="input-control file" data-role="input-control">
                {{ file_field('File', 'type' : 'file') }}
                <button class="btn-file"></button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="span4">
            {{ hidden_field('ProgramSiswa', 'value': program.RecID) }}
            {{ submit_button('Simpan') }}
        </div>
    </div>
</div>
{{ end_form() }}
{% if false %}
    <table class="table bordered striped hovered condensed text-center">
        <thead>
            <tr>
                <th rowspan="2" width="4%">No.</th>
                <th rowspan="2" width="11%">Kode Siswa</th>
                <th rowspan="2">Nama Siswa</th>
                <th rowspan="2" width="15%">Bidang Studi</th>
                <th colspan="10">Nilai</th>
                <th rowspan="2" width="12%">Action</th>
            </tr>
            <tr>
                <th width="3%">1</th>
                <th width="3%">2</th>
                <th width="3%">3</th>
                <th width="3%">4</th>
                <th width="3%">5</th>
                <th width="3%">6</th>
                <th width="3%">7</th>
                <th width="3%">8</th>
                <th width="3%">9</th>
                <th width="3%">10</th>
            </tr>
        </thead>
    </table>
{% endif %}

{{ form("nilai/search", "method": "post", "id": "backform") }}
{{ hidden_field("ProgramSiswa", 'value': program.RecID) }}
{{ end_form() }}

<script>
    $('#backlink').on('click', function () {
        $('#backform').submit();
    });
</script>
