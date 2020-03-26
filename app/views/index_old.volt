<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        {{ get_title() }}
        {{ assets.outputCss('cssHeader') }}
        {{ assets.outputJs('jsHeader') }}
        {{ javascript_include('js/autoNumeric.js') }}
        {{ javascript_include('js/metro.min.js') }}
        {{ javascript_include('js/custom.min.js') }}
        {{ javascript_include('js/main.js') }}
        <link rel="stylesheet" type="text/css" href="{{ url('datatables/jquery.dataTables.min.css') }}">
        {{ javascript_include('datatables/jquery.dataTables.min.js') }}
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
        <script type="text/javascript">
        $(document).ready(function() {
            $('#example1').dataTable( {
                "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                "order": [[ 0, "desc" ]],
                "pagingType": "full_numbers",
                "processing": true
            });
            $('#example2').dataTable( {
                "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                "order": [[ 0, "desc" ]],
                "pagingType": "full_numbers",
                "processing": true
            });
            $('#example3').dataTable( {
                "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                "order": [[ 0, "desc" ]],
                "pagingType": "full_numbers",
                "processing": true
            });
            $('#example4').dataTable( {
                "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                "order": [[ 0, "desc" ]],
                "pagingType": "full_numbers",
                "processing": true
            });
            $('#example5').dataTable( {
                "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                "order": [[ 0, "desc" ]],
                "pagingType": "full_numbers",
                "processing": true

            });
        });
        </script>
        <!-- Histats.com  START  (aync)-->
        <script type="text/javascript">var _Hasync= _Hasync|| [];
        _Hasync.push(['Histats.start', '1,3796686,4,1,120,40,00011111']);
        _Hasync.push(['Histats.fasi', '1']);
        _Hasync.push(['Histats.track_hits', '']);
        (function() {
        var hs = document.createElement('script'); hs.type = 'text/javascript'; hs.async = true;
        hs.src = ('//s10.histats.com/js15_as.js');
        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(hs);
        })();</script>
        <!-- Histats.com  END  -->
    </body>
</html>