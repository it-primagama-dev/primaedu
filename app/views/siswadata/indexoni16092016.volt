{{ content() }}

<div class="grid fluid">
    <div class="row">
        <div class="offset4 span4">
        <br></br>
         <img src="{{ url('img/tes.png') }}">
            {{ form('siswadata/proseslogin', 'role': 'form') }}
                <fieldset>
                    <legend>
                        <i class="icon-arrow-right-3"></i>
                        <b><i>Login Disini Sobat...</i></b>
                    </legend>
                    <label>No.VA</label>
                    <div class="input-control input-icon text" data-role="input-control">
                        <i class="icon-user"></i>
                        {{ text_field('NoVA', 'placeholder': "Ketik Disini") }}
                        <button class="btn-clear" tabindex="-1" type="button"></button>
                                            </div>
                    <label>Barcode</label>
                    <div class="input-control input-icon text" data-role="input-control">
                        <i class="icon-barcode"></i>
                        {{ text_field('bcode', 'placeholder': "Ketik Disini") }}
                        <button class="btn-clear" tabindex="-1" type="button"></button></button>
                    </div>
                    <div class="place-left">{{ flash.output() }}</div>
                    <input type="submit" class="button large primary place-right" value="Login" onclick="$('.loader').show()">
                </fieldset>
            </form>
          
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div align="center" class="modal-body">
                      <img src="{{ url('img/login.jpg') }}">
            </div>
            <div class="modal-footer">
                <input type="button" class="primary small" value="Lanjut" data-dismiss="modal">
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){

    $(window).load(function() {
        $("#myModal .modal-title").html("<center><h2><b>Salam SMART !!</b></h2></center>");
        $("#myModal").modal('show');
    });
});
</script>