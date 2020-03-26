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
        {{ javascript_include('js/autoNumeric.js') }}
        <link rel="stylesheet" type="text/css" href="{{ url('jquery-ui/jquery-ui.css') }}">
        <script type="text/javascript" charset="utf8" src="{{ url('jquery-ui/jquery-ui.js') }}"></script>
        {{ javascript_include('js/metro.min.js') }}
        {{ javascript_include('js/custom.min.js') }}
        {{ javascript_include('js/main.js') }}
        <link rel="stylesheet" type="text/css" href="{{ url('datatables/dataTables.bootstrap.min.css') }}">
        {{ javascript_include('datatables/jquery.dataTables.min.js') }}
        {{ javascript_include('datatables/dataTables.bootstrap.min.js') }}
        {{ javascript_include('js/currency.js') }}
        <link rel="stylesheet" type="text/css" href="{{ url('css/styles.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ url('css/select2.additional.css') }}">
        <!-- Select2 -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.full.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
        <script type="text/javascript">var base_url ={{ url()|json_encode }}</script>
        <script src="{{url('js/scripts.js')}}"></script>
        <!-- Global site tag (gtag.js) - Google Analytics app.primagama.co.id-->
        <script async src="//www.googletagmanager.com/gtag/js?id=UA-148088236-4"></script>
        <script>window.dataLayer = window.dataLayer || [];function gtag(){dataLayer.push(arguments);}gtag('js', new Date());gtag('config', 'UA-148088236-4');</script>
        <style>
            body {
                pointer-events:none;
            }
        </style>
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
            $(document).ready(function () {
                //activate all pointer-events on body
                $('body').css('pointer-events', 'all');
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
    </body>
</html>