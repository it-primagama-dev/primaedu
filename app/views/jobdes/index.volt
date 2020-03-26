
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
             <li> <span><i class="fa fa-folder-open"></i>Job Desk di Cabang</span> 
                 <ul>
                     <li> <span><i class="fa fa-folder-open"></i>Job Des Instruktur Honorer</span> 
                         <ul>
                             <li><a href="{{url("img/Job Desk/JD_Cabang_Instruktur Honorer.pdf")}}" >Job Des Instruktur Honorer.pdf</a></li>
                         </ul>
                     </li>
                     <li> <span><i class="fa fa-folder-open"></i> Job Des Instruktur Tetap</span>
                         <ul>
                             <li><a href="{{url("img/Job Desk/JD_Cabang_Instruktur Tetap Cabang.pdf")}}" >Job Des Instruktur Tetap.pdf</a></li>
                         </ul>
                     </li>
                     <li> <span><i class="fa fa-folder-open"></i> Job Des Admin Cabang</span>
                         <ul>
                             <li><a href="{{url("img/Job Desk/JOBDES-ADMINISTRASI CABANG.pdf")}}" >Job Des Admin Cabang.pdf</a></li>
                         </ul>
                     </li>
                     <li> <span><i class="fa fa-folder-open"></i>Job Des Akademik</span>
                         <ul>
                             
                             <ul>
                             <li><a href="{{url("img/Job Desk/JOBDES-AKADEMIK.pdf")}}" >Job Des Akademik.pdf</a></li>
                         </ul>
                         </ul>
                     </li>
                     <li> <span><i class="fa fa-folder-open"></i> Job Des Kepala Cabang</span>
                         <ul>
                             <li><a href="{{url("img/Job Desk/JOBDES-KEPALA CABANG.pdf")}}" >Job Des Kepala Cabang.pdf</a></li>
                         </ul>
                     </li>
                     <li> <span><i class="fa fa-folder-open"></i> Job Des OB</span>
                         <ul>
                             <li><a href="{{url("img/Job Desk/JOBDES-OB.pdf")}}" >Job Des OB.pdf</a></li>
                         </ul>
                     </li>
                 </ul>
             </li>
             
         </ul>
     </div>



{{ end_form() }}
