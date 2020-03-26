<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        {{ get_title() }}
        {{ assets.outputCss('cssHeader') }}
        {{ assets.outputJs('jsHeader') }}
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="PrimaEdu">
        <meta name="author" content="Techno One">
    </head>
    <body class="metro">
        <div class="loader">
            <div class="center">
                <div class="windows8">
                    <div class="wBall" id="wBall_1">
                        <div class="wInnerBall"></div>
                    </div>
                    <div class="wBall" id="wBall_2">
                        <div class="wInnerBall"></div>
                    </div>
                    <div class="wBall" id="wBall_3">
                        <div class="wInnerBall"></div>
                    </div>
                    <div class="wBall" id="wBall_4">
                        <div class="wInnerBall"></div>
                    </div>
                    <div class="wBall" id="wBall_5">
                        <div class="wInnerBall"></div>
                    </div>
                </div>
            </div>
        </div>
        {{ content() }}
        {{ javascript_include('js/autoNumeric.js') }}
        {{ javascript_include('js/metro.min.js') }}
        {{ javascript_include('js/custom.min.js') }}
        {{ javascript_include('js/main.js') }}
    </body>
</html>

<script type="text/javascript">
$(document).ready(function() {
    $('#example1').dataTable( {
        "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        "order": [[ 0, "desc" ]]
    });
});
$(document).ready(function() {
    $('#example2').dataTable( {
        "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        "order": [[ 0, "desc" ]]
    });
});
$(document).ready(function() {
    $('#example3').dataTable( {
        "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        "order": [[ 0, "desc" ]]
    });
});
$(document).ready(function() {
    $('#example4').dataTable( {
        "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        "order": [[ 0, "desc" ]]
    });
});
$(document).ready(function() {
    $('#example5').dataTable( {
        "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        "order": [[ 0, "desc" ]]
    });
});
</script>