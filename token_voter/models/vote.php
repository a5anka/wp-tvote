<?php

require_once ("base_model.php");

class Vote extends Model {

    protected $table = "tvote_votes";

    public function getTotalVotesFor($award_id) {
        $table_name = $this->getTable();
        return $this->wpdb->get_results(
            "
            SELECT award_id, nominee_id, count(*) as total_votes
            FROM wp_tvote_votes
            WHERE award_id=$award_id
            group by nominee_id
            order by total_votes DESC
            ", ARRAY_A
        );
    }

}

?>
