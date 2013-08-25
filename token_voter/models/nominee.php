<?php

require_once ("base_model.php");

class Nominee extends Model {

    protected $table = "tvote_nominees";

    public function getNomineeFor($award_id) {
        $table_name = $this->getTable();
        return $this->wpdb->get_results(
            "
            SELECT id, name
            FROM $table_name
            WHERE award_id=$award_id
            ", ARRAY_N
        );
    }

    public function getAllForSelect()
    {
        $table_name = $this->getTable();
        return $this->wpdb->get_results(
            "
            SELECT id, name
            FROM $table_name
            ", ARRAY_N
        );

    }

}

?>
