<h1>
    {{ link_to("index", '<i class="icon-arrow-left-3 fg-darker smaller"></i>') }}
    Ganti Password
</h1>

{{ content() }}

{{ form("chpass/index", "method":"post") }}

<div class="grid fluid">
    <div class="row">
        <div class="span6">
            <label for="OldPass">Password Lama</label>
            <div class="input-control input-icon password" data-role="input-control">
                <i class="icon-locked-2"></i>
                {{ password_field('OldPass', 'placeholder': "Ketik Disini") }}
                <button class="btn-reveal" tabindex="-1" type="button"></button>
            </div>
            <label for="NewPass1">Password Baru</label>
            <div class="input-control input-icon password" data-role="input-control">
                <i class="icon-locked-2"></i>
                {{ password_field('NewPass1', 'placeholder': "Ketik Disini") }}
                <button class="btn-reveal" tabindex="-1" type="button"></button>
            </div>
            <label for="NewPass2">Konfirmasi Password</label>
            <div class="input-control input-icon password" data-role="input-control">
                <i class="icon-locked-2"></i>
                {{ password_field('NewPass2', 'placeholder': "Ketik Disini") }}
                <button class="btn-reveal" tabindex="-1" type="button"></button>
            </div>
                <input type="submit" class="button" value="Submit">
        </div>
    </div>
</div>
</form>
