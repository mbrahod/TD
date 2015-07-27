<?php
if (PHP_SAPI !== 'cli')
    exit('No web access allowed!');

class Migrate extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('migration');
    }

    /**
     * version for migrate controller.
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * 
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function version($version)
    {
        if ($this->input->is_cli_request()) {
            $migration = $this->migration->version($version);
            if (! $migration) {
                echo $this->migration->error_string();
            } else {
                echo 'Migration(s) done' . PHP_EOL;
            }
        } else {
            show_error('You don\'t have permission for this action');
        }
    }
}
