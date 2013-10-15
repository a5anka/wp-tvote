<?php

class Html {

    public static function printUpdate($message)
    {
        echo "<div class=\"updated\"><p><strong>$message</strong></p></div><br />";
    }

    public static function printSuccessUpdate($message)
    {
        echo "<div class=\"successupdated \"><p><strong>$message</strong></p></div><br />";
    }

    public static function printPageTitle($title)
    {
        echo "<h2>$title</h2>";
    }

    public static function printPageSubtitle($title)
    {
        echo "<h3>$title</h3>";
    }

    public static function printAwardtitle($title)
    {
        echo "<h4>$title</h4>";
    }

    public static function printAwardDescription($desc)
    {
        echo "<p>$desc</p>";
    }

    public static function openForm()
    {
        echo "<form name=\"tvote_form\" method=\"post\" action=" . str_replace( '%7E', '~', $_SERVER['REQUEST_URI']) . ">";
    }

    public static function closeForm() 
    {
        echo "</form>";
    }

    public static function openTable()
    {
        echo "<table class=\"wp-list-table widefat fixed\">";

    }

    public static function closeTable()
    {
        echo "</table>";
    }

    public static function tableHead($columns)
    {
        echo "<thead>";
        echo "<tr>";
        foreach ($columns as $col) {
            echo "<th>$col</th>";
        }
        echo "<tr>";
        echo "</thead>";

    }

    public static function tableBody($data_array)
    {
        echo "<tbody>";
        if( !empty($data_array) ) {
            
            foreach( $data_array as $row ) {
                echo "<tr>";
                foreach($row as $key => $val) {
                    echo "<td>$val</td>";
                }
                echo "</tr>";
            }
        } else {
            echo "<tr>";
            echo "<td>No data found</td>";
            echo "</tr>";
        }
        echo "</tbody>";
    }

    public static function select($name, $data)
    {
        echo "<p><select name=\"$name\">";
        foreach ($data as $row) {
            echo "<option value=" . $row[0] . ">". $row[1] ."</option>";
        }
        echo "</select></p>";
    }

    public static function radio($name, $data)
    {
        $first=True;
        foreach ($data as $row) {
            if ($first) {
                echo "<label><input type=\"radio\" checked=\"checked\" name=\"$name\" value=" . $row[0] . "> ". $row[1] ."</label><br />";
                $first=False;
            } else {
            echo "<label><input type=\"radio\" name=\"$name\" value=" . $row[0] . "> ". $row[1] ."</label><br />";
            }
        }
    }


}

?>