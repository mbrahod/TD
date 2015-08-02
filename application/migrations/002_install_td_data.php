<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Install_td_data extends CI_Migration
{

    public function up()
    {
        // Drop table 'user_profile' if it exists
        $this->dbforge->drop_table('user_profile', TRUE);
        
        // Table structure for table 'groups'
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'MEDIUMINT',
                'constraint' => '8',
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'company' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
            ),
            'city' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '50'
            ),
            'is_solo' => array(
                    'type' => 'tinyint',
                    'constraint' => '1'
            ),
            'csa_score' => array(
                    'type' => 'INT',
                    'constraint' => '50'
            ),
            'truck_number' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '50'
            ),
            'description' => array(
                'type' => 'VARCHAR',
                'constraint' => '100'
            ),
            'user_id' => array(
                    'type' => 'MEDIUMINT',
                    'constraint' => '8',
                    'unsigned' => TRUE
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('user_profile');
        
        // Dumping data for table 'groups'
        $data = array(
            array(
                'id'           => '1',
                'company'      => 'admin',
                'city'         => 'Dallas TX',
                'is_solo'      => 1,
                'csa_score'    => '850',
                'truck_number' => '# 06543555 - 3295',
                'description'  => 'Administrator',
                'user_id'      => 1
            )
        );
        $this->db->insert_batch('user_profile', $data);
    }

    public function down()
    {
        $this->dbforge->drop_table('user_profile', TRUE);
    }
}
