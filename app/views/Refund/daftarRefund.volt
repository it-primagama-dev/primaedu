{{ content() }}

<h1>
    <i class="icon-arrow-left-3 fg-darker smaller"></i>
    Koreksi Transfer
</h1>

<div class="tab-control" data-role="tab-control" data-effect="fade">
    <ul class="tabs">
        <li class="active"><a href="#_tab1" onclick="initTab('_tab1')">Koreksi VA Siswa</a></li>
        <li><a href="#_tab2" onclick="initTab('_tab2')">Koreksi Kelebihan Nominal</a></li>
        <li><a href="#_tab3" onclick="initTab('_tab3')">Koreksi Transfer Double</a></li>
        <li><a href="#_tab4" onclick="initTab('_tab4')">Koreksi Deposit</a></li>
    </ul>

    <div class="frames">
        <div class="frame" id="_tab1">{{ partial('refund/list-refund-siswa') }}</div>
        <div class="frame" id="_tab2">{{ partial('refund/list-refund-nominal') }}</div>
        <div class="frame" id="_tab3">{{ partial('refund/list-refund-double') }}</div>
        <div class="frame" id="_tab4">{{ partial('refund/list-refund-cabang') }}</div>

    </div>
</div>
<script>
    function initTab(tab) {
        localStorage.setItem('_tab_actived', tab);
    }
    $(document).ready(function () {
        var tab_actived = localStorage.getItem('_tab_actived');
        if(tab_actived !== null){
            $(".tabs > li.active").removeClass("active");
            $('a[href="#'+tab_actived+'"]').parent("li").addClass("active");
            $('.tabs a[href="#' + tab_actived + '"]').trigger('click');
        }
        //console.log(tab_actived);
    });
</script>