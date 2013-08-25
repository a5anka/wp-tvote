<?php

require_once ("base_model.php");

class Token extends Model {

    protected $table = "tvote_tokens";

    public function getTokenFor($token) {
        $table_name = $this->getTable();

        $token_id = $this->wpdb->get_var( $this->wpdb->prepare( 
            "
		    SELECT id
		    FROM $table_name
		    WHERE token = %s
	        ", 
            $token
        ));

        return $token_id; 
    }

}

?>
