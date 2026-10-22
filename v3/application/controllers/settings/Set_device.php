<?php

/*
 * Description of Set_device Controller
 * Handled: Device Settings, Customer Criteria (Areas), Brand Criteria (Brands), and Rate Types
 */
class Set_device extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('ledgers_model', 'ledger');
    }

    public function device() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('set_device');
            $crud->set_subject(label('Set Device', $this, $this->user));
            
            // 1. Form validation/required fields
            $crud->required_fields('dev_name', 'dev_number', 'godown_id', 'bill_id', 'branch_id', 'customer_criteria', 'brand_criteria');
            
            // 2. Visible grid columns
            $crud->columns('dev_name', 'dev_number', 'godown_id', 'rate_types', 'customer_criteria', 'brand_criteria');
            
            // 3. Form fields declaration
            $crud->fields(
                'dev_name', 'dev_number', 'godown_id', 'branch_id', 'com_id', 
                'sales_billtype', 'replacement_billtype', 'bill_id', 'receipt_billtype', 
                'payment_billtype', 'estimate_billtype', 'salereturn_billtype', 
                'rate_types', 'edit_itemrate', 'nagative_stk_billing', 
                'customer_criteria', 'allocated_areas', 'allocated_customer_types',
                'brand_criteria', 'allocated_brands','rate_listing'
            );

            // 4. Field Types & Custom Select Dropdowns
            $crud->field_type('rate_listing', 'dropdown', array(
                '0' => 'No',
                '1' => 'Yes'
            ));
            
            $crud->field_type('edit_itemrate', 'dropdown', array(
                '0' => 'No',
                '1' => 'Yes'
            ));

            $crud->field_type('customer_criteria', 'dropdown', array(
                'all'           => 'All',
                'own'           => 'Own',
                'allocated'     => 'Allocated',
                'customer_type' => 'Customer Type'
            ));

            $crud->field_type('brand_criteria', 'dropdown', array(
                'all'       => 'All',
                'allocated' => 'Allocated'
            ));

            // Custom Field Rendering Callbacks
            $crud->callback_add_field('rate_types', array($this, 'callback_rate_types_checkboxes'));
            $crud->callback_edit_field('rate_types', array($this, 'callback_rate_types_checkboxes'));

            // Area Multi-select Callbacks
            $crud->callback_add_field('allocated_areas', array($this, 'callback_allocated_areas_multiselect'));
            $crud->callback_edit_field('allocated_areas', array($this, 'callback_allocated_areas_multiselect'));
            
            // Customer Type Multi-select Callbacks
            $crud->callback_add_field('allocated_customer_types', array($this, 'callback_allocated_customer_types_multiselect'));
            $crud->callback_edit_field('allocated_customer_types', array($this, 'callback_allocated_customer_types_multiselect'));

            // Brand Multi-select Callbacks
            $crud->callback_add_field('allocated_brands', array($this, 'callback_allocated_brands_multiselect'));
            $crud->callback_edit_field('allocated_brands', array($this, 'callback_allocated_brands_multiselect'));

            // Column Renderers for Datatables View (Converts IDs into Names)
            $crud->callback_column('allocated_areas', array($this, 'callback_column_allocated_areas'));
            $crud->callback_column('allocated_brands', array($this, 'callback_column_allocated_brands'));
            $crud->callback_column('allocated_customer_types', array($this, 'callback_column_allocated_customer_types'));
            
            // Before Save Callbacks (Compress Arrays to Comma-Separated Strings)
            $crud->callback_before_insert(array($this, 'callback_before_save_device'));
            $crud->callback_before_update(array($this, 'callback_before_save_device'));

            // 5. Setup relations
            $crud->set_relation('godown_id', 'ims_godown', 'godown_name');
            $crud->set_relation('com_id', 'ims_godown', 'godown_name');
            $crud->set_relation('branch_id', 'company_branch', 'brc_name');
            $crud->set_relation('replacement_billtype', 'set_billtype', 'type', ['set_billtype.transaction' => 'replacement']);
            $crud->set_relation('sales_billtype', 'set_billtype', 'type', ['set_billtype.transaction' => 'sales']);
            $crud->set_relation('bill_id', 'set_billtype', 'type', ['set_billtype.transaction' => 'sales']);
            $crud->set_relation('receipt_billtype', 'set_billtype', 'type', ['set_billtype.transaction' => 'rec']);
            $crud->set_relation('payment_billtype', 'set_billtype', 'type', ['set_billtype.transaction' => 'pay']);
            $crud->set_relation('estimate_billtype', 'set_billtype', 'type', ['set_billtype.transaction' => 'estimate']);
            $crud->set_relation('salereturn_billtype', 'set_billtype', 'type', ['set_billtype.transaction' => 'sales_return']);

            // 6. Display labels mapping
            $crud->display_as('branch_id', 'Branch');
            $crud->display_as('godown_id', 'Godown');
            $crud->display_as('com_id', 'Company Key'); 
            $crud->display_as('dev_name', 'Device');     
            $crud->display_as('rate_types', 'Rate Selection');
            $crud->display_as('customer_criteria', 'Customer Criteria');
            $crud->display_as('allocated_areas', 'Allocated Areas');
            $crud->display_as('allocated_customer_types', 'Allocated Customer Types');
            $crud->display_as('brand_criteria', 'Brand Criteria');
            $crud->display_as('allocated_brands', 'Allocated Brands');
            
            $crud->unique_fields('dev_name');
            
            $columns = array('dev_name', 'dev_number', 'godown_id', 'bill_id', 'com_id');
            foreach ($columns as $column) {
                $crud->display_as($column, label($column, $this, $this->user));
            }
            
            $output = $crud->render();

            // 7. Inject JS and CSS for dynamic toggles and scrollable checkbox list formatting
            $js_and_css = "
            <script type='text/javascript'>
                $(document).ready(function() {
                    // --- AREA FIELD TOGGLE & SYNC ---
                    function toggleAreaField() {
                        var criteria = $('#field-customer_criteria').val();
                        if (criteria === 'allocated') {
                            $('#allocated_areas_field_box').stop(true, true).slideDown(200);
                        } else {
                            $('#allocated_areas_field_box').stop(true, true).slideUp(200);
                        }
                    }

                    function toggleCustomerTypeField() {
                        var criteria = $('#field-customer_criteria').val();
                        if (criteria === 'customer_type') {
                            $('#allocated_customer_types_field_box').stop(true, true).slideDown(200);
                        } else {
                            $('#allocated_customer_types_field_box').stop(true, true).slideUp(200);
                        }
                    }

                    toggleAreaField();
                    toggleCustomerTypeField();

                    $(document).on('change', '#field-customer_criteria', function() {
                        toggleAreaField();
                        toggleCustomerTypeField();
                    });

                    $(document).on('change', '#select_all_areas', function() {
                        var isChecked = $(this).is(':checked');
                        $('.area-checkbox').prop('checked', isChecked);
                    });

                    function updateSelectAllAreasState() {
                        var total = $('.area-checkbox').length;
                        var checked = $('.area-checkbox:checked').length;
                        
                        if (total > 0 && total === checked) {
                            $('#select_all_areas').prop('checked', true).prop('indeterminate', false);
                        } else if (checked > 0 && checked < total) {
                            $('#select_all_areas').prop('checked', false).prop('indeterminate', true);
                        } else {
                            $('#select_all_areas').prop('checked', false).prop('indeterminate', false);
                        }
                    }

                    updateSelectAllAreasState();

                    $(document).on('change', '.area-checkbox', function() {
                        updateSelectAllAreasState();
                    });

                    // --- CUSTOMER TYPE SELECT ALL SYNC ---
                    $(document).on('change', '#select_all_customer_types', function() {
                        var isChecked = $(this).is(':checked');
                        $('.customer-type-checkbox').prop('checked', isChecked);
                    });

                    function updateSelectAllCustomerTypesState() {
                        var total = $('.customer-type-checkbox').length;
                        var checked = $('.customer-type-checkbox:checked').length;
                        
                        if (total > 0 && total === checked) {
                            $('#select_all_customer_types').prop('checked', true).prop('indeterminate', false);
                        } else if (checked > 0 && checked < total) {
                            $('#select_all_customer_types').prop('checked', false).prop('indeterminate', true);
                        } else {
                            $('#select_all_customer_types').prop('checked', false).prop('indeterminate', false);
                        }
                    }

                    updateSelectAllCustomerTypesState();

                    $(document).on('change', '.customer-type-checkbox', function() {
                        updateSelectAllCustomerTypesState();
                    });

                    // --- BRAND FIELD TOGGLE & SYNC ---
                    function toggleBrandField() {
                        var criteria = $('#field-brand_criteria').val();
                        if (criteria === 'allocated') {
                            $('#allocated_brands_field_box').stop(true, true).slideDown(200);
                        } else {
                            $('#allocated_brands_field_box').stop(true, true).slideUp(200);
                        }
                    }

                    toggleBrandField();

                    $(document).on('change', '#field-brand_criteria', function() {
                        toggleBrandField();
                    });

                    $(document).on('change', '#select_all_brands', function() {
                        var isChecked = $(this).is(':checked');
                        $('.brand-checkbox').prop('checked', isChecked);
                    });

                    function updateSelectAllBrandsState() {
                        var total = $('.brand-checkbox').length;
                        var checked = $('.brand-checkbox:checked').length;
                        
                        if (total > 0 && total === checked) {
                            $('#select_all_brands').prop('checked', true).prop('indeterminate', false);
                        } else if (checked > 0 && checked < total) {
                            $('#select_all_brands').prop('checked', false).prop('indeterminate', true);
                        } else {
                            $('#select_all_brands').prop('checked', false).prop('indeterminate', false);
                        }
                    }

                    updateSelectAllBrandsState();

                    $(document).on('change', '.brand-checkbox', function() {
                        updateSelectAllBrandsState();
                    });
                });
            </script>
            <style type='text/css'>
                #allocated_areas_checkbox_list label:hover,
                #allocated_customer_types_checkbox_list label:hover,
                #allocated_brands_checkbox_list label:hover {
                    background-color: #f0f8ff;
                    border-radius: 3px;
                }
            </style>";

            $output->output .= $js_and_css;
            
            $this->load->view('masters/masters', $output);
            
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    // Callback function to build the Rate Types Checkbox list UI
    public function callback_rate_types_checkboxes($value = '', $primary_key = null) {
        $rate_options = array(
            'srate'        => 'Sale Rate',
            'MRP'          => 'MRP',
            'wh_rate'      => 'WholeSale Rate',
            'special_rate' => 'Special Rate',
            'SpecialRate2' => 'Special Rate 2'
        );

        $checked_values = !empty($value) ? explode(',', $value) : array();

        $html = '<div style="padding-top:5px;">';
        foreach ($rate_options as $key => $label) {
            $checked = in_array($key, $checked_values) ? 'checked="checked"' : '';
            $html .= '<label style="margin-right: 15px; font-weight: normal; display: inline-block; cursor: pointer;">';
            $html .= '<input type="checkbox" name="rate_types[]" value="' . $key . '" ' . $checked . ' style="margin-right: 5px; vertical-align: middle;">' . $label;
            $html .= '</label>';
        }
        $html .= '</div>';

        return $html;
    }

    // Callback for Multiple Checkboxes with "Select All" for Areas from 'ims_area'
    public function callback_allocated_areas_multiselect($value = '', $primary_key = null) {
        $selected_areas = !empty($value) ? explode(',', $value) : array();
        
        $areas = $this->db->select('id, area')->order_by('area', 'ASC')->get('ims_area')->result_array();

        $html = '<div style="max-width: 400px;">';
        
        $html .= '<div style="padding: 6px 10px; background-color: #f5f5f5; border: 1px solid #ccc; border-bottom: none; border-radius: 4px 4px 0 0; font-weight: bold;">';
        $html .= '  <label style="cursor: pointer; margin: 0;">';
        $html .= '    <input type="checkbox" id="select_all_areas" style="margin-right: 8px; vertical-align: middle;"> Select All Areas';
        $html .= '  </label>';
        $html .= '</div>';

        $html .= '<div id="allocated_areas_checkbox_list" style="height: 250px; overflow-y: auto; border: 1px solid #ccc; border-radius: 0 0 4px 4px; padding: 8px; background-color: #fff;">';
        
        foreach ($areas as $area) {
            $checked = in_array($area['id'], $selected_areas) ? 'checked="checked"' : '';
            $html .= '<div style="margin-bottom: 6px;">';
            $html .= '  <label style="font-weight: normal; cursor: pointer; display: block; margin: 0;">';
            $html .= '    <input type="checkbox" name="allocated_areas[]" class="area-checkbox" value="' . $area['id'] . '" ' . $checked . ' style="margin-right: 8px; vertical-align: middle;">' . htmlspecialchars($area['area']);
            $html .= '  </label>';
            $html .= '</div>';
        }
        
        $html .= '</div>';
        $html .= '</div>';

        return $html;
    }

    // Callback for Multiple Checkboxes with "Select All" for Brands from 'item_brand'
    public function callback_allocated_brands_multiselect($value = '', $primary_key = null) {
        $selected_brands = !empty($value) ? explode(',', $value) : array();
        
        // Fetch brands from item_brand (ibr_id, ibr_name)
        $brands = $this->db->select('ibr_id, ibr_name')->order_by('ibr_name', 'ASC')->get('item_brand')->result_array();

        $html = '<div style="max-width: 400px;">';
        
        $html .= '<div style="padding: 6px 10px; background-color: #f5f5f5; border: 1px solid #ccc; border-bottom: none; border-radius: 4px 4px 0 0; font-weight: bold;">';
        $html .= '  <label style="cursor: pointer; margin: 0;">';
        $html .= '    <input type="checkbox" id="select_all_brands" style="margin-right: 8px; vertical-align: middle;"> Select All Brands';
        $html .= '  </label>';
        $html .= '</div>';

        $html .= '<div id="allocated_brands_checkbox_list" style="height: 250px; overflow-y: auto; border: 1px solid #ccc; border-radius: 0 0 4px 4px; padding: 8px; background-color: #fff;">';
        
        foreach ($brands as $brand) {
            $checked = in_array($brand['ibr_id'], $selected_brands) ? 'checked="checked"' : '';
            $html .= '<div style="margin-bottom: 6px;">';
            $html .= '  <label style="font-weight: normal; cursor: pointer; display: block; margin: 0;">';
            $html .= '    <input type="checkbox" name="allocated_brands[]" class="brand-checkbox" value="' . $brand['ibr_id'] . '" ' . $checked . ' style="margin-right: 8px; vertical-align: middle;">' . htmlspecialchars($brand['ibr_name']);
            $html .= '  </label>';
            $html .= '</div>';
        }
        
        $html .= '</div>';
        $html .= '</div>';

        return $html;
    }

    // Formats comma-separated Area IDs into Area Names in the DataGrid View
    public function callback_column_allocated_areas($value, $row) {
        if (empty($value)) {
            return '-';
        }

        $area_ids = explode(',', $value);
        $this->db->where_in('id', $area_ids);
        $query = $this->db->select('area')->get('ims_area')->result_array();

        if (!empty($query)) {
            $area_names = array_column($query, 'area');
            return implode(', ', $area_names);
        }

        return $value;
    }

    // Formats comma-separated Brand IDs into Brand Names in the DataGrid View
    public function callback_column_allocated_brands($value, $row) {
        if (empty($value)) {
            return '-';
        }

        $brand_ids = explode(',', $value);
        $this->db->where_in('ibr_id', $brand_ids);
        $query = $this->db->select('ibr_name')->get('item_brand')->result_array();

        if (!empty($query)) {
            $brand_names = array_column($query, 'ibr_name');
            return implode(', ', $brand_names);
        }

        return $value;
    }

    // Pre-save Callback to convert multi-select arrays to comma-separated strings
    public function callback_before_save_device($post_array) {
        // 1. Process Rate Types
        if (isset($post_array['rate_types']) && is_array($post_array['rate_types'])) {
            $post_array['rate_types'] = implode(',', $post_array['rate_types']);
        } else {
            $post_array['rate_types'] = '';
        }

        // 2. Process Allocated Areas (Only persist when customer_criteria is 'allocated')
        if (isset($post_array['customer_criteria']) && $post_array['customer_criteria'] === 'allocated') {
            if (isset($post_array['allocated_areas']) && is_array($post_array['allocated_areas'])) {
                $post_array['allocated_areas'] = implode(',', $post_array['allocated_areas']);
            } else {
                $post_array['allocated_areas'] = '';
            }
        } else {
            $post_array['allocated_areas'] = '';
        }
        
        // 3. Process Allocated Customer Types (Only persist when customer_criteria is 'customer_type')
        if (isset($post_array['customer_criteria']) && $post_array['customer_criteria'] === 'customer_type') {
            if (isset($post_array['allocated_customer_types']) && is_array($post_array['allocated_customer_types'])) {
                $post_array['allocated_customer_types'] = implode(',', $post_array['allocated_customer_types']);
            } else {
                $post_array['allocated_customer_types'] = '';
            }
        } else {
            $post_array['allocated_customer_types'] = '';
        }

        // 4. Process Allocated Brands (Only persist when brand_criteria is 'allocated')
        if (isset($post_array['brand_criteria']) && $post_array['brand_criteria'] === 'allocated') {
            if (isset($post_array['allocated_brands']) && is_array($post_array['allocated_brands'])) {
                $post_array['allocated_brands'] = implode(',', $post_array['allocated_brands']);
            } else {
                $post_array['allocated_brands'] = '';
            }
        } else {
            $post_array['allocated_brands'] = '';
        }

        return $post_array;
    }

    // Callback for Multiple Checkboxes with "Select All" for Customer Types from 'customer_type'
    public function callback_allocated_customer_types_multiselect($value = '', $primary_key = null) {
        $selected_types = !empty($value) ? explode(',', $value) : array();
        
        $types = $this->db->select('id, type')->order_by('type', 'ASC')->get('customer_type')->result_array();

        $html = '<div style="max-width: 400px;">';
        
        $html .= '<div style="padding: 6px 10px; background-color: #f5f5f5; border: 1px solid #ccc; border-bottom: none; border-radius: 4px 4px 0 0; font-weight: bold;">';
        $html .= '  <label style="cursor: pointer; margin: 0;">';
        $html .= '    <input type="checkbox" id="select_all_customer_types" style="margin-right: 8px; vertical-align: middle;"> Select All Types';
        $html .= '  </label>';
        $html .= '</div>';

        $html .= '<div id="allocated_customer_types_checkbox_list" style="height: 250px; overflow-y: auto; border: 1px solid #ccc; border-radius: 0 0 4px 4px; padding: 8px; background-color: #fff;">';
        
        foreach ($types as $type) {
            $checked = in_array($type['id'], $selected_types) ? 'checked="checked"' : '';
            $html .= '<div style="margin-bottom: 6px;">';
            $html .= '  <label style="font-weight: normal; cursor: pointer; display: block; margin: 0;">';
            $html .= '    <input type="checkbox" name="allocated_customer_types[]" class="customer-type-checkbox" value="' . $type['id'] . '" ' . $checked . ' style="margin-right: 8px; vertical-align: middle;">' . htmlspecialchars($type['type']);
            $html .= '  </label>';
            $html .= '</div>';
        }
        
        $html .= '</div>';
        $html .= '</div>';

        return $html;
    }

    // Formats comma-separated Customer Type IDs into Customer Type Names in the DataGrid View
    public function callback_column_allocated_customer_types($value, $row) {
        if (empty($value)) {
            return '-';
        }

        $type_ids = explode(',', $value);
        $this->db->where_in('id', $type_ids);
        $query = $this->db->select('type')->get('customer_type')->result_array();

        if (!empty($query)) {
            $type_names = array_column($query, 'type');
            return implode(', ', $type_names);
        }

        return $value;
    }
}