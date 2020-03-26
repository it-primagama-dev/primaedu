{{ content() }}

<h1>
    <?php echo $this->tag->linkTo(array("Konfirmasipembayaran/index", '<i class="icon-arrow-left-3 fg-darker smaller"></i>')); ?>
    Konfirmasi Pembayaran
    <small class="on-right">Input detail pembayaran</small>
</h1>

</h1>


{% if memberarea is defined %}
    {{ hidden_field("RecID") }}
{% endif %}
<div class="tab-control" data-role="tab-control" data-effect="fade">
    <ul class="tabs">
        <li class="active"><a href="#_tab1">Pembayaran Buku</a></li>
        <li><a href="#_tab2">Pembayaran Franchise</a></li>
    </ul>
 
    <div class="frames">
        <div class="frame" id="_tab1">{{ partial('Konfirmasipembayaran2/new') }}</div>
        <div class="frame" id="_tab2">{{ partial('konfirmasipembayaran2/franchise') }}</div>
    </div>
</div>