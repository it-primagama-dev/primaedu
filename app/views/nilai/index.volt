<h1>Cari Nilai Siswa</h1>

{{ content() }}

{{ form("nilai/search", "method":"post") }}

<div class="grid fluid">
    <div class="row">
        <div class="span4">
            <label for="ProgramSiswa">Program Siswa</label>
            <div class="input-control select" data-role="input-control">
                {{ select('ProgramSiswa', program, 'using': ['RecID', 'NamaProgram']) }}
            </div>
        </div>
    </div>
    {{ submit_button("Cari") }}
</div>

{{ end_form() }}
