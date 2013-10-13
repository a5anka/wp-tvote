<?php

require_once ("base_model.php");
require_once( "nominee.php");


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

    public function insert($data) {
        $this->wpdb->insert($this->getTable(), $data);
        $nominee_model = new Nominee();

        $award_id = $this->wpdb->insert_id;
        var_dump($award_id);
        $nominee_name = "None";
        $nominee_model->insert(array('name' => $nominee_name,
                                     'award_id' => $award_id
        ));

    }

}

?>
