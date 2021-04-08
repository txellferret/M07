<?php
     
    class Renderer {
     
        public static function renderArrayOfUsersToTable(array $headers, array $data): string {
            $result = "<table border='1'><thead><tr>";
            for ($i=0; $i<count($headers); $i++) {
                $result .= sprintf("<th>%s</th>", $headers[$i]);
            }
            $result .= "</tr></thead><tbody>";
            for ($i=0; $i<count($data); $i++) {
                $result .= "<tr>";
                $fieldValues = json_decode( json_encode( $data[$i] ), true );
                foreach ($fieldValues as $k=>$v) {
                    $result .= sprintf("<td>%s</td>", $v);
                }
                $result .= "</tr>";
            }
            $result .= "</tbody></table>";
            return $result;
        }
    }

