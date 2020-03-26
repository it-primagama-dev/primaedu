
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
             <li> <span><i class="fa fa-folder-open"></i>JUKNIS dan JUKLAK</span>
        <ul>
          <li><span><i class="fa fa-folder-open"></i>User Manual Prima Edu</span>
            <ul>
                             <li><a href="{{url("img/User Manual Prima Edu.pdf")}}" >User Manual Prima Edu.pdf</a></li>
                         </ul>
          </li>
          <li> <span><i class="fa fa-folder-open"></i> JUKNIS Order Smart Book 2019-2020</span>
                         <ul>
                             <li><a href="{{url("img/Juknis Pemesanan Buku 1920.pdf")}}" >JUKNIS Order Smart Book 2019-2020.pdf</a></li>
                         </ul>
                     </li>
           <li><span><i class="fa fa-folder-open"></i>Juknis Pembayaran</span>
            <ul>
              <li><span><i class="fa fa-folder-open"></i>Cara Mengoperasikan Mesin EDC</span>
                <ul>
                  <li><a href="{{url("img/Cara mengoperasikan mesin EDC.pdf")}}" >Cara mengoperasikan mesin EDC.pdf</a></li>
                </ul>
              </li>
              <li><span><i class="fa fa-folder-open"></i>User Manual Penggunaan EDC</span>
                <ul>
                  <li><a href="{{url("img/user manual cabang.pdf")}}" >user manual cabang.pdf</a></li>
                </ul>
              </li>
              <li><span><i class="fa fa-folder-open"></i>Barcode Kwitansi Pembayaran Siswa</span>
                <ul>
                  <li><a href="https://youtu.be/1BPHkvN63N8" target="_blank">Juknis Kwitansi</a></li>
                </ul>
              </li>
            </ul>
          </li>
          <li><span><i class="fa fa-folder-open"></i>REFUND</span>
            <ul>
              <li><span><i class="fa fa-folder-open"></i>Juknis REFUND</span>
                <ul>
                  <li><a href="https://youtu.be/Xcc9rTSniu0" target="_blank">Juknis Refund</a></li>
                </ul>
                <ul>
                  <li><a href="https://youtu.be/5NJaERYVQ9o" target="_blank">Refund Kelebihan Dana</a></li>
                </ul>
                <ul>
                  <li><a href="https://youtu.be/KnsYpiEJMNI" target="_blank">Refund Deposit</a></li>
                </ul>
              </li>
            </ul>
          </li>
          <li><span><i class="fa fa-folder-open"></i>Service Excellence Primagama</span>
                <ul>
                  <li><a href="{{url("img/Script Service Excellence Primagama.pptx")}}" >Script Service Excellence Primagama.pptx</a></li>
                </ul>
                <ul>
                  <li><a href="https://youtu.be/IwkF5XT_yrU" target="_blank">Video Script Service Excellence Primagama</a></li>
                </ul>
          </li>
        </ul>
       </li>
         </ul>
     </div>



{{ end_form() }}
