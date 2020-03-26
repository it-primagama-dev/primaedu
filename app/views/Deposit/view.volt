<h1>
    Invoice
    <small class="on-right">Detail Invoice</small>
</h1>

{{ content() }}
{% if pr is not empty %}
    <table class="table bordered hovered" id="header">
        <thead>
            <tr>
                <th>Kode Pembelian</th>
                <th>Tanggal</th>
                <th>Deskripsi</th>
                <th>Requester</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
        {% set status = pr.ApprovalDate %}
        {% if status is not empty %}
            <tr>
                <td>{{ pr.PurchReqId }}</td>
                <td>{{ pr.ApprovalDate }}</td>
                <td>{{ pr.PurchReqName }}</td>
                <td>{{ pr.Requester }}</td>
                <td>{{ pr.Status }}</td>
            </tr>
        {% else %}
            <tr>
                <td>{{ pr.PurchReqId }}</td>
                <td>-</td>
                <td>{{ pr.PurchReqName }}</td>
                <td>{{ pr.Requester }}</td>
                <td>{{ pr.Status }}</td>
            </tr>
        {% endif %}
        </tbody>
    </table>

    {% if pr.Purchreqline is not empty %}
        <legend>
            <small class="on-right text-bold fg-darker">Detil Pembelian</small>
        </legend>
        <table class="table bordered hovered" id="detail">
            <thead>
                <tr>
                    <th rowspan="2">No</th>
                    <th rowspan="2">Kode Barang</th>
                    <th rowspan="2">Nama Barang</th>
                    <th colspan="3">Jumlah (Qty.)</th>
                    <th rowspan="2">Action</th>
                </tr>
                <tr>
                    <th>Pembelian</th>
                    <th>Harga</th>
                    <th>Harga Total</th>
                </tr>
            </thead>
            <tbody>
                {% for line in pr.Purchreqline %}
                    <tr data-prlines="{{ line.RecId }}">
                        <td>{{ loop.index }}</td>
                        <td>{{ line.ItemId }}</td> 
                        <td>{{ line.ItemName }}</td>
                        <td>{{ line.Qty }}</td>
                        <td>Rp {{line.price|number_format(0,',','.')}}</td>
                        <td>{% set harga =line.Qty*line.price %}Rp {{harga |number_format(0,',','.')}}{% set total +=harga %}</td>
                        <td></td>
                        {% endfor %}
                    </tr>
                    <tr>
                        <td colspan='5' align='right' ><b>Jumlah Tagihan</b></td>
                        <td>Rp {{ total|number_format(0,',','.')  }}</td> 
                        <td></td>
                        
                    </tr>
                    <tr>{% if result is not empty %}
                            {% for list in result %}
                                  <td colspan='3' align='left' ><b>Ket :</b> {{ list.KeteranganVoid }}, <b>Oleh :</b> {{ list.VoidCreatedBy }} ( {{ list.VoidCreatedAt }} )</td>
                                  <td colspan='2' align='right' ><b>Deposit Kelebihan Bayar</b></td>
                                    <td><u>Rp {{ list.Deposit|number_format(0,',','.')}} -</u></td>
                                    {% set PRlama = list.PurchReqId %}
                                    {% set Depo = list.Deposit %}
                                    {% if Depo != 0 %} 
                                    <td><button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Pindahkan</button></td>
                                    {% else %}
                                    <td></td>
                                    {% endif %}
                                
                        {% endfor %}
                        {% else %}
                             <td colspan='4' align='right' ><b>Deposit Kelebihan Bayar</b></td>
                            <td><u>Rp {{ 0 }} -</u></td> 
                            <td></td>
                    {%endif%}
                    </tr>
                    </tr>
                    <tr>{% if result is not empty %}
                            {% for list in result %}
                                  <td colspan='3' align='left' ><b>Ket :</b> {{ list.Keterangan }} </td>
                                  <td colspan='2' align='right' ><b>Deposit Lainnya</b></td>
                                    <td><u>Rp {{ list.DepositLain|number_format(0,',','.')}} -</u></td> 
                                    <td></td>
                                
                        {% endfor %}
                        {% else %}
                             <td colspan='4' align='right' ><b>Deposit Lainnya</b></td>
                            <td><u>Rp {{ 0 }} -</u></td> 
                            <td></td>
                    {%endif%}
                    </tr>

                    
                    <tr>
                                    {% set deposit = list.Deposit %}
                                    {% set depositlainnya = list.DepositLain %}
                                    {% if deposit+depositlainnya > total %}
                                    <td colspan='5' align='right' ><b>Total Tagihan</b></td>
                                    <td><b>{% set jumlah=total-deposit-depositlainnya%}Rp {{ 0|number_format(0,',','.')  }}</b></td> 
                                    <td></td>      
                                    {% else %}
                                    <td colspan='5' align='right' ><b>Total Tagihan</b></td>
                                    {% set jumlah=total-deposit-depositlainnya%}
                                    <td><b>Rp {{ jumlah|number_format(0,',','.')  }}</b></td> 
                                    <td></td> 
                                    {% endif %}
                    <tr>
                                    {% set deposit = list.Deposit %}
                                    {% set depositlainnya = list.DepositLain %}
                                    {% if deposit+depositlainnya > total %}
                    <tr>
                                  <td colspan='5' align='right' ><b> Sisa Deposit</b></td>
                                    <td><b>{% set jumlahsisadeposit=deposit+depositlainnya-total%}<u>Rp {{ jumlahsisadeposit|number_format(0,',','.')  }}</u></b></td> 
                                  <td></td>
                    <tr>      
                                    {% else %}
                                    {% endif %}
                
                
            </tbody>
        </table>
          <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
    {{ form("deposit/savepindahdepo", "method":"post", "id": "cnformdepo") }}
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Pindahkan Deposit Kelebihan Bayar {{ pr.PurchReqId }}</h4>
        </div>
        <div class="modal-body">
        <div class="row">
            <div class="span3">
            <label for="Deposit"><strong>Jumlah Deposit :</strong></label>
            <div class="input-control text" data-role="input-control">
                <input type="hidden" id="PRlama" name="PRlama" value="{{ PRlama }}" readonly> </input>
                <input type="hidden" id="Deposit" name="Deposit" value="{{ Depo }}" readonly> </input>
                <input type="text" id="Deposit2" name="Deposit2" value="Rp {{ Depo|number_format(0,',','.')  }}" readonly> </input>
            </div> 
            </div>            
            <div class="span3">
            <label for="KodePR"><strong>Pindahkan Ke :</strong></label>
            <div class="input-control select" data-role="input-control">
            <select id="Kodeprdepo" name="Kodeprdepo">
                <option value="">--Pilih PR--</option>
            {% for list in prcabang %}
                <option value="{{ list.RecId }}">{{ list.PurchReqId }}</option>
            {% endfor %}
            </select>
            </div> 
            </div>
        </div>
        </div>
        <div id="detailkodeprdepo"></div>
        <div class="modal-footer">
          <button type="button" data-dismiss="modal" id="btn-depo">Simpan</button>
          <button type="button" data-dismiss="modal">Tutup</button>
        </div>
      </div>
    {{ end_form() }}
    </div>
</div>

                    <script>
                    $(document).ready(function() {
                        $("#Kodeprdepo").change(function(){
                        var Kodeprdepo = $("#Kodeprdepo").val();
            
                        $.ajax({
                        type: "POST",
                        url : '{{ url('deposit/detailkodeprdepo') }}',
                        data: "Kodeprdepo="+Kodeprdepo,
                        cache:false,
                        success: function(data){
                            $('#detailkodeprdepo').html(data);
                            document.frm.add.disabled=false;
                                }
                            });
                        });
                    })

    $('#btn-depo').on('click', function(){
        var frm = $('#cnformdepo');
        var jumlah = frm.find('#Deposit');
        if(!jumlah.val()){jumlah.focus().parent().addClass('error-state');return;}
        else{jumlah.parent().removeClass('error-state');}
        frm.submit();
    });
                    </script>
    {% endif %}
{% endif %}
