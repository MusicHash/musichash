<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

        <link href="//fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 96px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title">
                    <?php
                        $userID = null;
                        $agentID = null;
                        
                        if(Session::has('agentID')) {
                            $userID = Session::get('userID');
                            $agentID = Session::get('agentID');
                            $Agent = \App\Models\Agent::where('agentID', $agentID)->first();
                        }
                        
                        print_r([$userID, $agentID]);
                        print_r($Agent);
                    ?>
                    
                    @if ($userID != null)
                        {{ "I'm your master!" }}
                    @else
                        {{ "Welcome" }}
                    @endif
                </div>
            </div>
        </div>
    </body>
</html>