<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Install_store_data extends CI_Migration
{

    public function up()
    {
        // Drop table 'store_type' if it exists
        $this->dbforge->drop_table('store_type', TRUE);
        
        // Table structure for table 'store'
        $this->dbforge->add_field(array(
                'id' => array(
                        'type' => 'MEDIUMINT',
                        'constraint' => '8',
                        'unsigned' => TRUE,
                        'auto_increment' => TRUE
                ),
                'name' => array(
                        'type' => 'VARCHAR',
                        'constraint' => '100'
                ),
        ));

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('store_type');
        
        // Dumping data for table 'store_type'
        $data = array(
                    array(
                      'id'   => '1',
                      'name' => 'Petrol pump',
                    ),
                    array(
                            'id'   => '2',
                            'name' => 'Coffe bar',
                    ),
                    array(
                            'id'   => '3',
                            'name' => 'Grocery store',
                    ),
                    array(
                            'id'   => '4',
                            'name' => 'Sugar mill',
                    ),
        );
        $this->db->insert_batch('store_type', $data);
        
        // Drop table 'store' if it exists
        $this->dbforge->drop_table('store', TRUE);
        
        // Table structure for table 'store'
        $this->dbforge->add_field(array(
                'id' => array(
                        'type' => 'MEDIUMINT',
                        'constraint' => '8',
                        'unsigned' => TRUE,
                        'auto_increment' => TRUE
                ),
                'name' => array(
                        'type' => 'VARCHAR',
                        'constraint' => '100'
                ),
                'city' => array(
                        'type' => 'VARCHAR',
                        'constraint' => '50'
                ),
                'address' => array(
                        'type' => 'VARCHAR',
                        'constraint' => '255'
                ),
                'phone' => array(
                        'type' => 'VARCHAR',
                        'constraint' => '50'
                ),
                'type_id' => array(
                        'type' => 'MEDIUMINT',
                        'constraint' => '8'
                ),
                'open' => array(
                        'type' => 'VARCHAR',
                        'constraint' => '50'
                ),
                'diesel_price' => array(
                        'type' => 'FLOAT',
                        'constraint' => '50'
                ),
                'description' => array(
                        'type' => 'VARCHAR',
                        'constraint' => '255'
                ),
                'owner_id' => array(
                        'type' => 'MEDIUMINT',
                        'constraint' => '8',
                        'unsigned' => TRUE
                ),
                'zip' => array(
                        'type' => 'VARCHAR',
                        'constraint' => '10'
                ),
                'latitude' => array(
                        'type' => 'decimal',
                        'constraint' => '12,8'
                ),
                'longitude' => array(
                        'type' => 'decimal',
                        'constraint' => '12,8'
                ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('store');
        
        // Dumping data for table 'store_type'
        $data = array(
                array(
                    'id'   => '1',
                    'name' => 'Loves Keller IS-45',
                    'city' => 'Keller TX',
                    'address' => '4511 Highway 6 South, Keller, TX 73221',
                    'phone' => '(217) 344-5321',
                    'type_id' => '1',
                    'open' => '24/7',
                    'diesel_price' => '3.57',
                    'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer tincidunt lacus quis eros rutrum, ac ornare nisi facilisis. Aliquam nec leo dui. Vivamus dignissim tellus euismod sapien ornare cursus. Lorem ipsum dolor.',
                    'owner_id' => 1,
                    'zip'      => '76244',
                    'latitude' => '32.9344444',
                    'longitude' => '-97.2513889',
                ),
        );
        $this->db->insert_batch('store', $data);
        
        // Drop table 'store' if it exists
        $this->dbforge->drop_table('store_image', TRUE);
        // Table structure for table 'store_image'
        $this->dbforge->add_field(array(
                'id' => array(
                        'type' => 'MEDIUMINT',
                        'constraint' => '8',
                        'unsigned' => TRUE,
                        'auto_increment' => TRUE
                ),
                'store_id' => array(
                        'type' => 'MEDIUMINT',
                        'constraint' => '8'
                ),
                'hash' => array(
                        'type' => 'VARCHAR',
                        'constraint' => '100'
                ),
                'ord' => array(
                        'type' => 'INT',
                        'constraint' => '11'
                ),
                'name' => array(
                        'type' => 'VARCHAR',
                        'constraint' => '100'
                ),
                'org_name' => array(
                        'type' => 'VARCHAR',
                        'constraint' => '100'
                ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('store_image');
        
    }

    public function down()
    {
        $this->dbforge->drop_table('store_image', TRUE);
        $this->dbforge->drop_table('store_type', TRUE);
        $this->dbforge->drop_table('store', TRUE);
    }
}
