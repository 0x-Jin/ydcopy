<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use Symfony\Component\VarDumper\Tests\VarClonerTest;

class ImportGoodsStore extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:goods_store';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'import goods store data from SQL Server to Mysql';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(){
        logger("artisan {$this->signature} stared", []);

        $mssql = DB::connection('sqlsrv');
        $mysql = DB::connection('mysql');

        $mssql->setFetchMode(2);

        $fields = ["WarehouseCode", "ProductSkuCode", "Quantity", "LockedQuantity", "ModifyTime"];
        $fieldsStr = implode(",", $fields);

        $querySql = "select {$fieldsStr} from InventoryVirtual order by ProductSkuCode";

        $mssqlData = $mssql->select($querySql);
        $this->output->progressStart(count($mssqlData));

        $fieldsStr.= ', created_at';
        $valNum = implode(',', array_fill(0, count($fields)+1, '?'));

        foreach($mssqlData as $row){
            $vals = array_values($row);
            $vals[] = time();
            $insertSql = "insert into admin_goods_store ($fieldsStr) VALUE ($valNum)";
            $mysql->insert($insertSql, $vals);
            $this->output->progressAdvance();
        }
        $this->output->progressFinish();

        logger("artisan {$this->signature} finished", []);
    }
}













