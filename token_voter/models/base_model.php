<?php

abstract class Model {
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table;

    protected $wpdb;

    public function __construct()
    {
        global $wpdb;
        $this->wpdb = $wpdb;
    }

    /**
     * Get the table associated with the model.
     *
     * @return string
     */
    public function getTable()
    {
        if (isset($this->table)) return $this->wpdb->prefix . $this->table;

        return $this->wpdb->prefix . strtolower(get_class($this));
    }

    public function insert($data) {
        $this->wpdb->insert($this->getTable(), $data);
    }

    public function getAll() {
        $table_name = $this->getTable();
        return $this->wpdb->get_results(
            "
            SELECT *
            FROM $table_name
            ", ARRAY_A
        );
    }
}

?>
