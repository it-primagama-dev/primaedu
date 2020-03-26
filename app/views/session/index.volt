{{ content() }}

<div class="grid fluid">
    <div class="row">
        <div class="offset4 span4">
            {{ form('session/start', 'role': 'form') }}
                <fieldset>
                    <legend>
                        <i class="icon-arrow-right-3"></i>
                        PrimaEdu
                    </legend>
                    <label>Username</label>
                    <div class="input-control input-icon text" data-role="input-control">
                        <i class="icon-user"></i>
                        {{ text_field('username', 'placeholder': "Ketik Disini") }}
                        <button class="btn-clear" tabindex="-1" type="button"></button>
                    </div>
                    <label>Password</label>
                    <div class="input-control input-icon password" data-role="input-control">
                        <i class="icon-locked-2"></i>
                        {{ password_field('password', 'placeholder': "Ketik Disini") }}
                        <button class="btn-reveal" tabindex="-1" type="button"></button>
                    </div>
                    <div class="place-left">{{ flash.output() }}</div>
                    <input type="submit" class="button large primary place-right" value="Login" onclick="$('.loader').show()">
                </fieldset>
            </form>
        </div>
    </div>
</div>
<!-- Global site tag (gtag.js) - Google Analytics app.primagama.co.id-->
<script async src="//www.googletagmanager.com/gtag/js?id=UA-148088236-4"></script>
<script>window.dataLayer = window.dataLayer || [];function gtag(){dataLayer.push(arguments);}gtag('js', new Date());gtag('config', 'UA-148088236-4');</script>