
{{ content() }}

<style type="text/css">
    @media print{@page {size: A4 landscape}}
</style>
<table class="tablePrint" style="width:100%;">
    <tr>
        <td colspan="7">
            <table style="width:100%;">
                <tr>
                    <td align="center"><img src="{{ url('img/logo_new_web.png') }}" width="220"></td>
                    <td align="center" width="75%">
                        <h2><u>{{ rpt_title }}</u></h2>
                    </td>
                    <td width="20%" align="right">
                        <a href="#" id="downloadBtn" class="btn btn-primary pull-right">Download</a>
                        <a href="javascript::void();" onclick="window.print();" id="printLink" class="btn btn-success pull-right">Print</a>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <h3 style="margin: 4px 0">Cabang: {% for list  in result1  %}{{ list.KodeAreaCabang}}- {{ list.NamaAreaCabang}}{% endfor %}</h3>
                    </td>
                    <td>
                        <h3 class="text-right" style="margin:4px 0"></h3>
                    </td>
                </tr>
            </table>    
        </td>
    </tr>
    <tr>
        <td colspan="7"><hr color="#000000"/></td>
    </tr>
</table>
<table class="table bordered hovered table2excel" style="table-layout: fixed; border-collapse: collapse">
    <thead>
        <tr style="background-color:#6495ED;">
            <th width="220px" rowspan="2">Nama Transaksi</th>
            <th width="220px" rowspan="2">Tanggal </th>
            <th width="220px" rowspan="2">Jumlah </th>
            <th width="220px" rowspan="2">Cash In</th>
            <th width="220px" rowspan="2">Cash Out</th>
        </tr>
    </thead>
    <tbody>
        {% if result2 is not empty %}
        <tr><td></td></tr>
        <tr style="background-color:#000099; color:#ffffff"><td><b>I. CASH IN </td></tr>
        {% for list in result3 %}
                <tr>
                    <td style="background-color:#D3D3D3"><b>Uang Bimbingan 100%</td>
                    <td class="text-center">-</td>
                    <td class="text-center">{{ (list.Jumlah )|number_format(0,',','.') }}{% set sumjum1+=list.Jumlah%}</td>
                    <td class="text-center">-</td>
                    <td></td>
                </tr>
           {% endfor %}<tr style="background-color:#D3D3D3"><td><b>Pendaftaran Siswa</td></tr>
            {% for list in result2 %}{% if list.TypeId=="TP-02"  %}
                    <td class="text-center">{{ (list.Description) }}</td>
                    <td class="text-center">{{ (list.Tanggal)}}</td>
                    <td class="text-center">{{ (list.Jumlah )|number_format(0,',','.') }}{% set sumjum1+=list.Jumlah%}</td>
                    <td></td><td></td>
                     </tr>
           {% endif %}
           {% endfor %} 
           <tr style="background-color:#D3D3D3"><td><b>Cash In Lain-Lain  </td></tr>
            {% for list in result2 %}{% if list.TypeId=="TP-03"  %}
                    <td class="text-center">{{ (list.Description) }}</td>
                    <td class="text-center">{{ (list.Tanggal)}}</td>
                    <td class="text-center">{{ (list.Jumlah )|number_format(0,',','.') }}{% set sumjum1+=list.Jumlah%}</td>
                    <td></td><td></td>
                     </tr>
           {% endif %}
           {% endfor %} 
           <tr style="background-color: #B0C4DE;">
           <td ></td><td></td>
           <td class="text-center"><b> Jumlah Cash In </b></td>
           <td class="text-center" ><b> {{sumjum1 |number_format(0,',','.')}} </b> </td><td></td>
           </tr>
           <tr style="background-color:#000099; color:#ffffff"><td><b>II. CASH OUT </td></tr>
           <tr style="background-color:#D3D3D3"><td><b>Franchise Fee</td></tr>
             {% for list in result2 %}{% if list.TypeId=="TP-04"  %}
                <tr>
                    <td class="text-center">{{ (list.Description) }}</td>
                    <td class="text-center">{{ (list.Tanggal)}}</td>
                    <td class="text-center">{{ (list.Jumlah )|number_format(0,',','.') }}{% set sumjum2+=list.Jumlah%}</td>
                    <td></td><td></td>
                </tr>
           {% endif %}
           {% endfor %}
            <tr style="background-color:#D3D3D3"><td><b>Pembelian Sarana Belajar Utama</td></tr>
             {% for list in result2 %}{% if list.TypeId=="TP-05"  %}
                <tr>
                    <td class="text-center">{{ (list.Description) }}</td>
                    <td class="text-center">{{ (list.Tanggal)}}</td>
                    <td class="text-center">{{ (list.Jumlah )|number_format(0,',','.') }}{% set sumjum2+=list.Jumlah%}</td>
                    <td></td><td></td>
                </tr>
           {% endif %}
           {% endfor %}
           {% for list in result4 %}
                <tr>
                    <td style="background-color:#D3D3D3"><b>Management Fee 10% + 1% PPN</td>
                    <td class="text-center">-</td>
                    <td class="text-center">{{ (list.Jumlah )|number_format(0,',','.') }}{% set sumjum2+=list.Jumlah%}</td>
                    <td class="text-center">-</td>
                    <td></td>
                </tr>
           {% endfor %}
           <tr style="background-color: #B0C4DE;"><td>
           <td></td></td>
           <td class="text-center"><b> Jumlah Cash Out Ke Pusat</b></td></td><td></td>
           <td class="text-center"><b> {{sumjum2 |number_format(0,',','.')}} </b> </td>
           </tr>
           <tr style="background-color:#000099; color:#ffffff"><td><b>A. AKTIVA TETAP </td></tr>
           <tr style="background-color:#D3D3D3"><td><b>Pembelian Aktiva Tetap</td></tr>
           {% for list in result2 %}{% if list.TypeId=="TP-08" %}
                <tr>
                    <td class="text-center">{{ (list.Description) }}</td>
                    <td class="text-center">{{ (list.Tanggal)}}</td>
                    <td class="text-center">{{ (list.Jumlah )|number_format(0,',','.') }}{% set sumjum31+=list.Jumlah%}</td>
                    </td><td></td></td><td></td>
                </tr>
           {% endif %}
           {% endfor %}
           <tr style="background-color: #B0C4DE;">
            <td></td></td><td></td></td>
           <td class="text-center"><b> Jumlah Cash Out Aktiva Tetap</b></td></td><td></td>
           <td class="text-center"><b> {{sumjum31 |number_format(0,',','.')}} </b> </td>
           </tr>
           <tr style="background-color:#000099; color:#ffffff"><td><b>B. KEWAJIBAN KEUANGAN</td><tr>
           <tr style="background-color:#D3D3D3"><td><b>Pembayaran Hutang </td></tr>
           {% for list in result2 %}{% if list.TypeId=="TP-06" %}
                <tr>
                    <td class="text-center">{{ (list.Description) }}</td>
                    <td class="text-center">{{ (list.Tanggal)}}</td>
                    <td class="text-center">{{ (list.Jumlah )|number_format(0,',','.') }}{% set sumjum32+=list.Jumlah%}</td>
                    <td></td><td></td>
                </tr>
           {% endif %}
           {% endfor %}
           <tr style="background-color:#D3D3D3"><td><b>Pembayaran  Bunga & Admin Bank </td></tr>
           {% for list in result2 %}{% if list.TypeId=="TP-07" %}
                <tr>
                    <td class="text-center">{{ (list.Description) }}</td>
                    <td class="text-center">{{ (list.Tanggal)}}</td>
                    <td class="text-center">{{ (list.Jumlah )|number_format(0,',','.') }}{% set sumjum32+=list.Jumlah%}</td>
                    <td></td><td></td>
                </tr>
           {% endif %}
           {% endfor %}
            <tr style="background-color: #B0C4DE;">
            <td></td><td></td>
           <td class="text-center"><b> Jumlah Cash Out Kewajiban Keuangan</b></td><td></td>
           <td class="text-center" ><b> {{sumjum32 |number_format(0,',','.')}} </b> </td>
           </tr>
           <tr style="background-color:#000099; color:#ffffff"><td><b>C. BIAYA OPERASIONAL</td><tr>
           <tr ><td colspan="5"><b>1. BIAYA PEMASARAN</td><tr>
           <tr style="background-color:#D3D3D3"><td><b>Biaya Sarana</td><tr>
            {% for list in result5 %}{% if list.TypeId=="TP-09" %}
                <tr>
                    <td class="text-center">{{ (list.Description) }}</td>
                    <td class="text-center">{{ (list.Tanggal)}}</td>
                    <td class="text-center">{{ (list.Jumlah )|number_format(0,',','.') }}{% set sumjum41+=list.Jumlah%}</td>
                    <td></td><td></td>
                </tr>
           {% endif %}
           {% endfor %}
            <tr style="background-color:#D3D3D3"><td><b>Biaya Event </td><tr>
            {% for list in result5 %}{% if list.TypeId=="TP-10" %}
                <tr>
                    <td class="text-center">{{ (list.Description) }}</td>
                    <td class="text-center">{{ (list.Tanggal)}}</td>
                    <td class="text-center">{{ (list.Jumlah )|number_format(0,',','.') }}{% set sumjum41+=list.Jumlah%}</td>
                    <td></td><td></td>
                </tr>
           {% endif %}
           {% endfor %}
           <tr style="background-color:#D3D3D3"><td><b>Biaya Riset , Humas & Kerjasama </td><tr>
            {% for list in result5 %}{% if list.TypeId=="TP-11" %}
                <tr>
                    <td class="text-center">{{ (list.Description) }}</td>
                    <td class="text-center">{{ (list.Tanggal)}}</td>
                    <td class="text-center">{{ (list.Jumlah )|number_format(0,',','.') }}{% set sumjum41+=list.Jumlah%}</td>
                    <td></td><td></td>
                </tr>
           {% endif %}
           {% endfor %}
            <tr style="background-color:#D3D3D3"><td><b>Biaya Iuran Pemasaran Bersama</td><tr>
            {% for list in result5 %}{% if list.TypeId=="TP-12" %}
                <tr>
                    <td class="text-center">{{ (list.Description) }}</td>
                    <td class="text-center">{{ (list.Tanggal)}}</td>
                    <td class="text-center">{{ (list.Jumlah )|number_format(0,',','.') }}{% set sumjum41+=list.Jumlah%}</td>
                    <td></td><td></td>
                </tr>
           {% endif %}
           {% endfor %}
           <tr style="background-color:#D3D3D3"><td><b>Biaya Pemasaran Lain-lain</td><tr>
            {% for list in result5 %}{% if list.TypeId=="TP-31" %}
                <tr>
                    <td class="text-center">{{ (list.Description) }}</td>
                    <td class="text-center">{{ (list.Tanggal)}}</td>
                    <td class="text-center">{{ (list.Jumlah )|number_format(0,',','.') }}{% set sumjum41+=list.Jumlah%}</td>
                    <td></td><td></td>
                </tr>
           {% endif %}
           {% endfor %}
            <tr style="background-color: #B0C4DE;">
           <td></td><td></td>
           <td class="text-center"><b> Jumlah  Biaya Pemasaran</b></td><td></td>
           <td class="text-center"><b> {{sumjum41 |number_format(0,',','.')}} </b> </td>
           </tr>
           <tr><td colspan="5"><b>2. BIAYA AKADEMIK</td><tr>
           <tr style="background-color:#D3D3D3"><td><b>Biaya Honorarium Instruktur Smart</td><tr>
            {% for list in result5 %}{% if list.TypeId=="TP-13" %}
                <tr>
                    <td class="text-center">{{ (list.Description) }}</td>
                    <td class="text-center">{{ (list.Tanggal)}}</td>
                    <td class="text-center">{{ (list.Jumlah )|number_format(0,',','.') }}{% set sumjum42+=list.Jumlah%}</td><td></td><td></td>
                </tr>
           {% endif %}
           {% endfor %}
           <tr style="background-color:#D3D3D3"><td><b>Biaya Suplemen Sarana Belajar</td><tr>
            {% for list in result5 %}{% if list.TypeId=="TP-14" %}
                <tr>
                    <td class="text-center">{{ (list.Description) }}</td>
                    <td class="text-center">{{ (list.Tanggal)}}</td>
                    <td class="text-center">{{ (list.Jumlah )|number_format(0,',','.') }}{% set sumjum42+=list.Jumlah%}</td><td></td><td></td>
                </tr>
           {% endif %}
           {% endfor %}
            <tr style="background-color:#D3D3D3"><td><b>Biaya Evaluasi Belajar</td><tr>
            {% for list in result5 %}{% if list.TypeId=="TP-15" %}
                <tr>
                    <td class="text-center">{{ (list.Description) }}</td>
                    <td class="text-center">{{ (list.Tanggal)}}</td>
                    <td class="text-center">{{ (list.Jumlah )|number_format(0,',','.') }}{% set sumjum42+=list.Jumlah%}</td><td></td><td></td>
                </tr>
           {% endif %}
           {% endfor %}
           <tr style="background-color:#D3D3D3"><td><b>Biaya Iuran Bersama Akademik</td><tr>
            {% for list in result5 %}{% if list.TypeId=="TP-16" %}
                <tr>
                    <td class="text-center">{{ (list.Description) }}</td>
                    <td class="text-center">{{ (list.Tanggal)}}</td>
                    <td class="text-center">{{ (list.Jumlah )|number_format(0,',','.') }}{% set sumjum42+=list.Jumlah%}</td><td></td><td></td>
                </tr>
           {% endif %}
           {% endfor %}
           <tr style="background-color:#D3D3D3"><td><b>Biaya  Akademik Lain - Lain</td><tr>
            {% for list in result5 %}{% if list.TypeId=="TP-19" %}
                <tr>
                    <td class="text-center">{{ (list.Description) }}</td>
                    <td class="text-center">{{ (list.Tanggal)}}</td>
                    <td class="text-center">{{ (list.Jumlah )|number_format(0,',','.') }}{% set sumjum42+=list.Jumlah%}</td><td></td><td></td>
                </tr>
           {% endif %}
           {% endfor %}
          <tr style="background-color: #B0C4DE;">
           <td></td><td></td>
           <td class="text-center"><b> Jumlah  Biaya Akademik</b></td><td></td>
           <td class="text-center"><b> {{sumjum42 |number_format(0,',','.')}} </b> </td>
           </tr>
           <tr><td colspan="5"><b>3. BIAYA DIKLAT & KEPEGAWAIAN</td><tr>
           <tr style="background-color:#D3D3D3"><td><b>Biaya Pokok Karyawan</td><tr>
           {% for list in result5 %}{% if list.TypeId=="TP-20" %}
                <tr>
                    <td class="text-center">{{ (list.Description) }}</td>
                    <td class="text-center">{{ (list.Tanggal)}}</td>
                    <td class="text-center">{{ (list.Jumlah )|number_format(0,',','.') }}{% set sumjum43+=list.Jumlah%}</td><td></td><td></td>
                </tr>
           {% endif %}
           {% endfor %}
           <tr style="background-color:#D3D3D3"><td><b>Biaya Iuran Bersama Kepersonaliaan</td><tr>
           {% for list in result5 %}{% if list.TypeId=="TP-21" %}
                <tr>
                    <td class="text-center">{{ (list.Description) }}</td>
                    <td class="text-center">{{ (list.Tanggal)}}</td>
                    <td class="text-center">{{ (list.Jumlah )|number_format(0,',','.') }}{% set sumjum43+=list.Jumlah%}</td><td></td><td></td>
                </tr>
           {% endif %}
           {% endfor %}
           <tr style="background-color:#D3D3D3"><td><b>Biaya Perjalanan Dinas</td><tr>
           {% for list in result5 %}{% if list.TypeId=="TP-22" %}
                <tr>
                    <td class="text-center">{{ (list.Description) }}</td>
                    <td class="text-center">{{ (list.Tanggal)}}</td>
                    <td class="text-center">{{ (list.Jumlah )|number_format(0,',','.') }}{% set sumjum43+=list.Jumlah%}</td><td></td><td></td>
                </tr>
           {% endif %}
           {% endfor %}
           <tr style="background-color:#D3D3D3"><td><b>Biaya Rekrut & Pelatihan SDM</td><tr>
           {% for list in result5 %}{% if list.TypeId=="TP-23" %}
                <tr>
                    <td class="text-center">{{ (list.Description) }}</td>
                    <td class="text-center">{{ (list.Tanggal)}}</td>
                    <td class="text-center">{{ (list.Jumlah )|number_format(0,',','.') }}{% set sumjum43+=list.Jumlah%}</td><td></td><td></td>
                </tr>
           {% endif %}
           {% endfor %}
           <tr style="background-color:#D3D3D3"><td><b> Biaya Kepersonaliaan Lain - Lain</td><tr>
           {% for list in result5 %}{% if list.TypeId=="TP-24" %}
                <tr>
                    <td class="text-center">{{ (list.Description) }}</td>
                    <td class="text-center">{{ (list.Tanggal)}}</td>
                    <td class="text-center">{{ (list.Jumlah )|number_format(0,',','.') }}{% set sumjum43+=list.Jumlah%}</td><td></td><td></td>
                </tr>
           {% endif %}
           {% endfor %}
          <tr style="background-color: #B0C4DE;">
           <td></td><td></td>
           <td class="text-center"><b> Jumlah  Biaya Diklat & Kepegawaian</b></td><td></td>
           <td class="text-center" ><b> {{sumjum43 |number_format(0,',','.')}} </b> </td>
           </tr>
            <tr><td colspan="5"><b>4. BIAYA KERUMAHTANGGAAN & UMUM</td><tr>
           <tr style="background-color:#D3D3D3"><td><b>Biaya Sewa Gedung</td><tr>
           {% for list in result5 %}{% if list.TypeId=="TP-25" %}
                <tr>
                    <td class="text-center">{{ (list.Description) }}</td>
                    <td class="text-center">{{ (list.Tanggal)}}</td>
                    <td class="text-center">{{ (list.Jumlah )|number_format(0,',','.') }}{% set sumjum44+=list.Jumlah%}</td><td></td><td></td>
                </tr>
           {% endif %}
           {% endfor %}
            <tr style="background-color:#D3D3D3"><td><b>Biaya Listrik , Air & Telepon</td><tr>
           {% for list in result5 %}{% if list.TypeId=="TP-26" %}
                <tr>
                    <td class="text-center">{{ (list.Description) }}</td>
                    <td class="text-center">{{ (list.Tanggal)}}</td>
                    <td class="text-center">{{ (list.Jumlah )|number_format(0,',','.') }}{% set sumjum44+=list.Jumlah%}</td><td></td><td></td>
                </tr>
           {% endif %}
           {% endfor %}
           <tr style="background-color:#D3D3D3"><td><b>Biaya Supplies Kantor</td><tr>
           {% for list in result5 %}{% if list.TypeId=="TP-28" %}
                <tr>
                    <td class="text-center">{{ (list.Description) }}</td>
                    <td class="text-center">{{ (list.Tanggal)}}</td>
                    <td class="text-center">{{ (list.Jumlah )|number_format(0,',','.') }}{% set sumjum44+=list.Jumlah%}</td><td></td><td></td>
                </tr>
           {% endif %}
           {% endfor %}
           <tr style="background-color:#D3D3D3"><td><b>Biaya Umum</td><tr>
           {% for list in result5 %}{% if list.TypeId=="TP-29" %}
                <tr>
                    <td class="text-center">{{ (list.Description) }}</td>
                    <td class="text-center">{{ (list.Tanggal)}}</td>
                    <td class="text-center">{{ (list.Jumlah )|number_format(0,',','.') }}{% set sumjum44+=list.Jumlah%}</td><td></td><td></td>
                </tr>
           {% endif %}
           {% endfor %}
           <tr style="background-color:#D3D3D3"><td><b>Biaya Kerumahtanggaan & Dapur </td><tr>
           {% for list in result5 %}{% if list.TypeId=="TP-30" %}
                <tr>
                    <td class="text-center">{{ (list.Description) }}</td>
                    <td class="text-center">{{ (list.Tanggal)}}</td>
                    <td class="text-center">{{ (list.Jumlah )|number_format(0,',','.') }}{% set sumjum44+=list.Jumlah%}</td><td></td><td></td>
                </tr>
           {% endif %}
           {% endfor %}
          <tr style="background-color: #B0C4DE;">
           <td></td><td></td>
           <td class="text-center"><b> Jumlah  Biaya Diklat & Kepegawaian</b></td><td></td>
           <td class="text-center"><b> {{sumjum44 |number_format(0,',','.')}} </b> </td>
           </tr>
           <tr>
           <td><br></td><td></td><td></td><td></td><td></td>
           </tr>
           <tr>
           <td></td><td></td>
           <td class="text-center"><b> Jumlah  Keseluruhan Cash In</b></td>
           <td class="text-center"><b> {{sumjum1 |number_format(0,',','.')}} </b> </td><td></td>
           </tr>
           <tr>
           <td></td><td></td>
           <td class="text-center"><b> Jumlah  Keseluruhan Cash Out</b></td><td></td>
           <td class="text-center"><b> {% set sumjumtotco= sumjum2+sumjum31+sumjum32+sumjum41+sumjum42+sumjum43+sumjum44%} {{sumjumtotco|number_format(0,',','.')}} </b> </td>
           </tr>
            <tr >
           <td class="text-center" colspan="3"><b> SURPLUS/DEFISIT</b></td><td></td>
           <td class="text-center"><b> {% set sumjumdef=sumjum1-sumjumtotco%} {{sumjumdef|number_format(0,',','.')}} </b> </td>
           </tr>
        {% else %}
            <tr>
                <td colspan="12" align="center">- Tidak Ada Data -</td>
            </tr>
        {% endif %}
    </tbody>
</table>
{#
{% if page.total_pages > 1 %}
<div class="place-left">{{ "halaman "~page.current~" dari "~page.total_pages }}</div>
<div class="place-right">
    {{ link_to("rptlaporancashinoutdetail/view", "First", 'class':'button') }}
    {{ link_to("rptlaporancashinoutdetail/view?page="~page.before, "Previous", 'class':'button') }}
    {{ link_to("rptlaporancashinoutdetail/view?page="~page.next, "Next", 'class':'button') }}
    {{ link_to("rptlaporancashinoutdetail/view?page="~page.last, "Last", 'class':'button') }}
</div>
{% endif %}
#}
<script>
    $('#downloadBtn').on('click', function () {
        $(".table2excel").table2excel({
            exclude: ".noExl",
            name: "Primaedu",
            filename: "{{ rpt_title }}.xls"
        });
    });
</script>
