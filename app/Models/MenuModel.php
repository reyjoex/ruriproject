<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MenuModel extends Model
{
    public function CreateTableMenu(){
        return DB::statement("CREATE TABLE IF NOT EXISTS `menu` (
            `id` INT(10) NOT NULL AUTO_INCREMENT,
            `nama` VARCHAR(20) NULL DEFAULT NULL,
            `nmfile` VARCHAR(20) NULL DEFAULT NULL,
            `orderby` VARCHAR(3) NULL DEFAULT NULL,
            `lvluser` TINYINT(4) NULL DEFAULT NULL,
            `divisi` TINYINT(4) NULL,
            `iduser` TINYINT(4) NULL DEFAULT NULL,
            PRIMARY KEY (`id`),
            UNIQUE INDEX `nmfile` (`nmfile`),
            INDEX `group` (`orderby`)
        )
        COLLATE='utf8mb4_general_ci'
        ENGINE=InnoDB
        AUTO_INCREMENT=1;");
    }

    public function DataMenu(){        
        return DB::table('menu')->whereRaw('LENGTH(orderby) = 1')->orderBy('orderby')->get();
    }

    public function DataSubmenu(){        
        return DB::table('menu')->whereRaw('LENGTH(orderby) = 2')->orderBy('orderby')->get();
    }
}
