<?php

/**
 * Description of printtemplate
 *
 * @author SyahrulFadli
 */
class HTMLtemplate {

    //put your code here

    public function headerHTML($title) {
        $headerHTML = '<html>
                        <head>
                            <title>TODO supply a title</title>
                            <meta charset="UTF-8">
                            <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        </head>
                        <body>
                            <div id="print">
                                <table class="tablePrint" width="100%">
                                    <tr>
                                        <th width="29%">
                                            <img src="/img/logo-primagama-kiri-small.png" width="120px">
                                        </th>
                                        <th class="printTitle">' . $title . '</th>
                                    </tr>';
        return $headerHTML;
    }

    public function bodyHTML($title, $content) {
        $bodyHTML = $this->headerHTML($title);
        $bodyHTML .= $content;
        $bodyHTML .= '</table>
                        </div>
                            </body>
                                </html>';

        return $bodyHTML;
    }

}

?>
