<?php
namespace App\Models\Admin\Tool;

use App\Models\Admin\ModelWithoutMysql;

class PlatOrder extends ModelWithoutMysql {

    protected  function _genSql($params){
        $recordWhere = sprintf("and recordDATE between '%s %s:00:00.000' and '%s %s:59:59.999'",
            $params['startDate'], $params['startHour'], $params['endDate'], $params['endHour']);
        return "
            SELECT
              TradeId,
              MemberCode,
              Quantity,
              PayAmount,
              RecordDate
            FROM
              salesorder
            WHERE ShopName = '{$params['platForm']}'
              {$recordWhere}
              AND membercode IN
              (SELECT
                MemberCode
              FROM
                SalesOrder
              WHERE ShopName = '{$params['platForm']}'
                {$recordWhere}
              GROUP BY MemberCode,
                Quantity,
                PayAmount
              HAVING COUNT(MemberCode) > 1)
            ORDER BY MemberCode DESC
        ";
    }

    protected function _fmtData($rawData){
        foreach($rawData as &$row){
            $row['Quantity'] = sprintf('%0.2f', $row['Quantity']);
            $row['PayAmount'] = sprintf('%0.2f', $row['PayAmount']);
            $row['RecordDate'] = sprintf('%.19s', $row['RecordDate']);
        }
        unset($row);
        return $rawData;
    }
}