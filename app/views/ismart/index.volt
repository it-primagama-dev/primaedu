{{ content() }}

<h1>
    Pencarian I-Smart
</h1>

{{ form("ismart/search", "method":"post", "autocomplete" : "off") }}

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
