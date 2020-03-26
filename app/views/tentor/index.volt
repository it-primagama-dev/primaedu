{{ content() }}

<h1>
    Validasi Tentor
    <small class="place-right">{{ link_to("tentor/view", 'View Tentor<i></i>') }}</small>
</h1>

{{ form("tentor/search", "method":"post", "autocomplete" : "off") }}

<div class="grid fluid">
    <div class="row">
        <div class="span6">
            <label for="KodeISmart">Kode I-Smart</label>
            <div class="input-control text" data-role="input-control">
                {{ text_field("KodeISmart", "maxlength" : 30) }}
                </div>
                <label for="NamaISmart">Nama I-Smart</label>
                <div class="input-control text" data-role="input-control">
                {{ text_field("NamaISmart", "maxlength" : 30) }}
                    </div>

            {{ submit_button("Cari") }}
                </div>
            </div>
    </div>

    </form>
