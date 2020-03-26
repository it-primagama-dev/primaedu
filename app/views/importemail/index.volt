{{ content() }}

<h1>
    Daftar
    <small class="on-right">Email</small>
</h1>

<div class="tab-control" data-role="tab-control" data-effect="fade">
    <ul class="tabs">
        <li class="active"><a href="#_tab1">Data belum dikirim email</a></li>
        <li><a href="#_tab2">Data sudah dikirim email</a></li>
    </ul>
 
    <div class="frames">
        <div class="frame" id="_tab1">{{ partial('importemail/belum-kirim') }}</div>
        <div class="frame" id="_tab2">{{ partial('importemail/sudah-kirim') }}</div>
    </div>
</div>