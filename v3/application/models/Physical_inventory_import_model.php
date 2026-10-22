<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Physical_inventory_import_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Search database by barcode.
     * If multiple items share the same barcode, prioritizes the one matching the Excel name.
     */
    public function find_by_barcode($barcode, $clean_name = null) {
        if (empty($barcode)) {
            return null;
        }
        
        $barcode_str = trim((string)$barcode);
        $query = $this->db->get_where('item', array('barcode' => $barcode_str, 'published' => 'yes'));
        if ($query->num_rows() > 0) {
            $results = $query->result_array();
            if (!empty($clean_name)) {
                $normalized_excel = $this->normalize_string($clean_name);
                foreach ($results as $row) {
                    if ($this->normalize_string($row['name']) === $normalized_excel) {
                        return $row;
                    }
                }
            }
            return $results[0];
        }
        return null;
    }

    /**
     * Search database by exact item name
     */
    public function find_by_name($name) {
        if (empty($name)) {
            return null;
        }
        $query = $this->db->get_where('item', array('name' => $name, 'published' => 'yes'));
        return $query->row_array();
    }

    /**
     * Search database by name using exact, trimmed, or normalized match.
     * If multiple items match the name (case-insensitively), prioritizes the one matching the Excel barcode.
     */
    public function find_by_clean_name($clean_name, $barcode = null) {
        if (empty($clean_name)) {
            return null;
        }
        
        $barcode_str = !empty($barcode) ? trim((string)$barcode) : '';
        
        // 1. Try exact match first
        $query = $this->db->get_where('item', array('name' => $clean_name, 'published' => 'yes'));
        if ($query->num_rows() > 0) {
            $results = $query->result_array();
            if (!empty($barcode_str)) {
                foreach ($results as $row) {
                    if (trim((string)$row['barcode']) === $barcode_str) {
                        return $row;
                    }
                }
            }
            return $results[0];
        }
        
        // 2. Try exact match on name without trailing hyphens/spaces
        $trimmed_name = preg_replace('/\s*-\s*$/', '', $clean_name);
        if ($trimmed_name !== $clean_name) {
            $query = $this->db->get_where('item', array('name' => $trimmed_name, 'published' => 'yes'));
            if ($query->num_rows() > 0) {
                $results = $query->result_array();
                if (!empty($barcode_str)) {
                    foreach ($results as $row) {
                        if (trim((string)$row['barcode']) === $barcode_str) {
                            return $row;
                        }
                    }
                }
                return $results[0];
            }
        }
        
        // 3. Try matching after normalization (querying items starting with the first word)
        $words = explode(' ', trim($clean_name));
        $first_word = isset($words[0]) ? trim($words[0]) : '';
        if (!empty($first_word)) {
            $this->db->select('*');
            $this->db->from('item');
            $this->db->like('name', $first_word, 'after');
            $this->db->where('published', 'yes');
            $results = $this->db->get()->result_array();
            
            $normalized_excel = $this->normalize_string($clean_name);
            $candidates = [];
            foreach ($results as $row) {
                if ($this->normalize_string($row['name']) === $normalized_excel) {
                    if (!empty($barcode_str) && trim((string)$row['barcode']) === $barcode_str) {
                        return $row;
                    }
                    $candidates[] = $row;
                }
            }
            if (!empty($candidates)) {
                return $candidates[0];
            }
        }
        
        return null;
    }

    /**
     * Fuzzy search by name using LIKE.
     * Prioritizes matching the Excel barcode if multiple rows are returned.
     */
    public function find_by_name_like($name, $barcode = null) {
        if (empty($name)) {
            return null;
        }
        $barcode_str = !empty($barcode) ? trim((string)$barcode) : '';
        
        $this->db->select('*');
        $this->db->from('item');
        $this->db->where('published', 'yes');
        $this->db->group_start();
        $this->db->like('name', $name);
        $this->db->or_like('name', str_replace(' ', '%', $name));
        $this->db->group_end();
        $results = $this->db->get()->result_array();
        
        if (!empty($results)) {
            if (!empty($barcode_str)) {
                foreach ($results as $row) {
                    if (trim((string)$row['barcode']) === $barcode_str) {
                        return $row;
                    }
                }
            }
            return $results[0];
        }
        
        return null;
    }

    /**
     * Look up Godown ID by name
     */
    public function get_godown_id_by_name($godown_name) {
        if (empty($godown_name)) {
            return 1; // Default godown ID
        }
        
        $godown_name = trim($godown_name);
        $query = $this->db->get_where('ims_godown', array('godown_name' => $godown_name));
        if ($query->num_rows() > 0) {
            $row = $query->row_array();
            return $row['id'];
        }
        
        // Fuzzy search for godown
        $this->db->select('id');
        $this->db->from('ims_godown');
        $this->db->like('godown_name', $godown_name);
        $this->db->limit(1);
        $query2 = $this->db->get();
        if ($query2->num_rows() > 0) {
            $row = $query2->row_array();
            return $row['id'];
        }

        return 1; // Default fallback
    }

    /**
     * Query the current stock of an item in a specific godown and batch (summing up if no batch specified)
     */
    public function get_item_current_stock($item_id, $godown_id, $batch = '') {
        $this->db->select('SUM(IFNULL(open_stock, 0) + IFNULL(current_stock, 0)) as stock');
        $this->db->from('item_godown');
        $this->db->where('item_id', $item_id);
        $this->db->where('godown_id', $godown_id);
        if ($batch !== '' && $batch !== null && $batch !== 0 && $batch !== '0' && $batch !== 'null' && $batch !== 'undefined') {
            $this->db->where('batch', $batch);
        }
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $row = $query->row_array();
            return (float) $row['stock'];
        }
        return 0.0;
    }

    /**
     * Helper to normalize a string for strict name comparison
     */
    public function normalize_string($str) {
        if (empty($str)) {
            return '';
        }
        $str = strtolower($str);
        $str = html_entity_decode($str, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $str = preg_replace('/\s*-\s*<b>.*?<\/b>\s*$/i', '', $str);
        $str = strip_tags($str);
        $str = preg_replace('/[^a-z0-9]/', '', $str);
        return $str;
    }
}
