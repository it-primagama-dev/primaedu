
{{ content() }}

{{ form("area/search", "method":"post", "autocomplete" : "off") }}

<style>
.tree {
    min-height:20px;
    padding:19px;
    margin-bottom:20px;
    background-color:#fbfbfb;
    -webkit-border-radius:4px;
    -moz-border-radius:4px;
    border-radius:4px;
    -webkit-box-shadow:inset 0 1px 1px rgba(0, 0, 0, 0.05);
    -moz-box-shadow:inset 0 1px 1px rgba(0, 0, 0, 0.05);
    box-shadow:inset 0 1px 1px rgba(0, 0, 0, 0.05)
}
.tree li {
    list-style-type:none;
    margin:0;
    padding:10px 5px 0 5px;
    position:relative
}
.tree li::before, .tree li::after {
    content:'';
    left:-20px;
    position:absolute;
    right:auto
}
.tree li::before {
    border-left:1px solid #999;
    bottom:50px;
    height:100%;
    top:0;
    width:1px
}
.tree li::after {
    border-top:1px solid #999;
    height:20px;
    top:30px;
    width:25px
}
.tree li span {
    -moz-border-radius:5px;
    -webkit-border-radius:5px;
    border:1px solid #999;
    border-radius:5px;
    display:inline-block;
    padding:3px 8px;
    text-decoration:none
}
.tree li.parent_li>span {
    cursor:pointer;
  color: 'blue'
}
.tree>ul>li::before, .tree>ul>li::after {
    border:0
}
.tree li:last-child::before {
    height:30px
}
.tree li.parent_li>span:hover, .tree li.parent_li>span:hover+ul li span {
    background:#eee;
    border:1px solid #94a0b4;
    color:#000
}
</style>

<script> $(function () {
      $('.tree li:has(ul)').addClass('parent_li').find(' > span').attr('title', 'Collapse this branch');
      $('.tree li.parent_li > span').on('click', function (e) {
          var children = $(this).parent('li.parent_li').find(' > ul > li');
          if (children.is(":visible")) {
              children.hide('fast');
              $(this).attr('title', 'Expand this branch').find(' > i').addClass('fa-folder').removeClass('fa-folder-open');
          } else {
              children.show('fast');
              $(this).attr('title', 'Collapse this branch').find(' > i').addClass('fa-folder-open').removeClass('fa-folder');
          }
          e.stopPropagation();
      });
  });
</script>

<script src="assets/js/build/pdf.js"></script>
<script src="assets/js/build/pdf.worker.js"></script>


<div class="tree ">
         <ul>
             <li> <span><i class="fa fa-folder-open"></i>Rekrutmen Dan Seleksi</span>
        <ul>
          <li><span><i class="fa fa-folder-open"></i>Manual Panduan Wawancara</span>
            <ul>
                <li><a href="{{url("img/HRD/Manual Panduan Wawancara.docx")}}" >Manual Panduan Wawancara.docx</a></li>
            </ul>
          </li>
          <li><span><i class="fa fa-folder-open"></i>SOP</span>
            <ul>
              <li><a href="{{url("img/HRD/SOP Rekruitment & Seleksi.pdf")}}" >SOP Rekruitment & Seleksi.pdf</a></li>
            </ul>
          </li>
          <li> <span><i class="fa fa-folder-open"></i> FORM</span>
                <ul>
                  <li><a href="{{url("img/HRD/Form Aplikasi Lamaran Kerja.docx")}}" >Form Aplikasi Lamaran Kerja.docx</a></li>
                </ul>
                <ul>
                  <li><a href="{{url("img/HRD/Form Checklist Induction Program.docx")}}" >Form Checklist Induction Program.docx</a></li>
                </ul>
                <ul>
                  <li><a href="{{url("img/HRD/Form Checklist Kelengkapan Data Calon Karyawan.docx")}}" >Form Checklist Kelengkapan Data Calon Karyawan.docx</a></li>
                </ul>
                <ul>
                  <li><a href="{{url("img/HRD/Form Penilaian Karyawan.xls")}}" >Form Penilaian Karyawan.xls</a></li>
                </ul>
                <ul>
                  <li><a href="{{url("img/HRD/Form Permintaan Karyawan.docx")}}" >Form Permintaan Karyawan.docx</a></li>
                </ul>
                <ul>
                  <li><a href="{{url("img/HRD/Form Permintaan Perlengkapan Kerja Karyawan Baru.docx")}}" >Form Permintaan Perlengkapan Kerja Karyawan Baru.docx</a></li>
                </ul>
                <ul>
                  <li><a href="{{url("img/HRD/Form Wawancara.docx")}}" >Form Wawancara.docx</a></li>
                </ul>
                <ul>
                  <li><a href="{{url("img/HRD/Formulir Cek Referensi.docx")}}" >Formulir Cek Referensi.docx</a></li>
                </ul>
                <ul>
                  <li><a href="{{url("img/HRD/Personality Test_Soal & Jawaban.xls")}}" >Personality Test_Soal & Jawaban.xls</a></li>
                </ul>

          </li>
           <li><span><i class="fa fa-folder-open"></i>Surat</span>
              <ul>
                  <li><a href="{{url("img/HRD/Perjanjian Kerja Waktu Tertentu.docx")}}" >Perjanjian Kerja Waktu Tertentu.docx</a></li>
              </ul>
              <ul>
                  <li><a href="{{url("img/HRD/Surat Keputusan Karyawan Tetap.docx")}}" >Surat Keputusan Karyawan Tetap.docx</a></li>
              </ul>
              <ul>
                  <li><a href="{{url("img/HRD/Surat Pemberitahuan Masa Percobaan.docx")}}" >Surat Pemberitahuan Masa Percobaan.docx</a></li>
              </ul> 
              <ul>
                  <li><a href="{{url("img/HRD/Surat Penawaran Kerja Kandidat.docx")}}" >Surat Penawaran Kerja Kandidat.docx</a></li>
              </ul>
              
              </li>
              
            </ul>
          </li>
        </ul>
       </li>
         </ul>
     </div>



{{ end_form() }}
