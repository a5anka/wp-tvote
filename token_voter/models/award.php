<?php

require_once ("base_model.php");

class Award extends Model {

    protected $table = "tvote_awards";

    public function getAllForSelect()
    {
        $table_name = $this->getTable();
        return $this->wpdb->get_results(
            "
            SELECT id, name, descryption
            FROM $table_name
            ", ARRAY_N
        );

    }


}

?>
