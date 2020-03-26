{% if leveluser == 21 and cekkonfirm != 0 %}

<marquee scrollamount="15"><h3><left><font color="red">Ada {{ cekkonfirm }} Konfirmasi Pembayaran Baru / Belum di Respon !!! </font></left></h3></marquee>

{% elseif leveluser == 13 and cekapproval != 0%}

<marquee scrollamount="15"><h3><left><font color="red">Ada {{ cekapproval }} Pembelian Smartbook Baru / Belum di Respon !!! </font></left></h3></marquee>

{% elseif leveluser == 11 %}

<marquee scrollamount="10"><h3><left><font color="green">Informasi Logistik : Yth Cabang Primagama, pemesanan buku sudah dapat dilakukan pada sistem PrimaEdu, silahkan pilih menu "Pemesanan Buku" -> "Permintaan Pemesanan", dan juknis dapat dilihat pada tombol "Bantuan ?". Terima Kasih.</font></left></h3></marquee>

{% else %}

{% endif %}
<div class="grid fluid">
    <div class="row no-margin">
        <div class="span12">
            {{ headercontent }}
        </div>
    </div>
    <div class="row">
        <div class="span12">
            {% if panel %}
                <div class="panel">
                    <div class="panel-header bg-gray fg-white">
                        <i class="icon-arrow-right-5 on-left"></i>
                        {{ paneltitle }}
                    </div>
                    <div class="panel-content">
                        {{ panelcontent }}
                    </div>
                </div>
            {% endif %}
        </div>
    </div>
</div>

