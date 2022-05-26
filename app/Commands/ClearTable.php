<?php 

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use App\Models\UserModel;

class ClearTable extends BaseCommand{

    protected $group = "Database";
    protected $name = 'clear:table';
    protected $description = "Clears the data of the table";

    public function run(array $params){
        $model = new UserModel();

        $rows = $model->truncate();

        echo "$rows deleted successfully. \n";
    }
    
}