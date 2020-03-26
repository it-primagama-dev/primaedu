<script src="{{ url('js/mercury/mercury_loader.js') }}" type="text/javascript"></script>
<div class="content">
    <div class="grid fluid">
        <div class="row">
            <div id="header-content" class="span12" data-mercury="full">
                {{ headercontent }}
            </div>
        </div>
        <div class="row">
            <div class="span12">
                <div class="panel">
                    <div class="panel-header bg-gray fg-white">
                        <i class="icon-arrow-right-5 on-left place-left"></i>
                        <div id="panel-title" data-mercury="simple">{{ paneltitle }}</div>
                    </div>
                    <div id="panel-content" class="panel-content" data-mercury="full">
                        {{ panelcontent }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
