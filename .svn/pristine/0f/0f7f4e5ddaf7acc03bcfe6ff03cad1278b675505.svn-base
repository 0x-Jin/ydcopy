<?php
namespace App\Models\Admin\Customer;

use App\Models\Admin\ModelWithoutMysql;

class Rebuy extends ModelWithoutMysql {


    protected  function _genSql($params){
        $paltWhere = $params['platForm'] == '0' ? '' : "AND b.shopCode = {$params['platForm']}";
		
        $skuCodeWhere = empty($params['skuCode']) ? '' : "AND a.SkuCode='{$params['skuCode']}'";

        return "
        select
		    b.MemberCode, b.MemberName, a.SkuCode, b.RecordDate, b.ShopName
	    from SalesOrderLine a
		left join SalesOrder b on a.SalesOrderHeaderId=b.Order_ID
	    where
	        1 = 1
            {$skuCodeWhere}
            {$paltWhere}
            AND b.RecordDate between '{$params['orderStart']}' and '{$params['orderEnd']} 23:59:59.999'
        order by b.RecordDate desc
        ";
	}

    protected function _fmtData($rawData){
        $groupData = $fmtData = $newData = [];

        foreach($rawData as $i=>$row){
            $time = strtotime($row['RecordDate']);
            if( empty($groupData[$row['ShopName']][$row['MemberName']]) ){
                $groupData[$row['ShopName']][$row['MemberName']][] = $time;
            } else if(! in_array($time, $groupData[$row['ShopName']][$row['MemberName']])){
                $groupData[$row['ShopName']][$row['MemberName']][] = $time;
            }
            sort($groupData[$row['ShopName']][$row['MemberName']]);
        }

        foreach($groupData as $plat=>$platData){
            $secBuyCount = 0;
            $fmtData[$plat] = [
                'dval1t2' => [],
                'dval2t3' => [],
                'avg1t2' => '',
                'max1t2' => '',
                'sec1t2' => '',
                'max2t3' => '',
                '1t2'    => 0,
            ];
            foreach($platData as $buyData){
                $nums = count($buyData);
                if($nums <=1 ) continue;
                $fmtData[$plat]['dval1t2'][] = (int)round(abs(($buyData[1]-$buyData[0]))/86400) ?: 1;
                if($nums > 2){
                    $fmtData[$plat]['dval2t3'][] = (int)round(abs(($buyData[2]-$buyData[0]))/86400) ?: 1;
                }
                $secBuyCount++;
            }

            //--平均第一回购周：订单时间内，第一次与第二次购买的时间差总平均值；
            if(count($fmtData[$plat]['dval1t2']) > 0){
                $fmtData[$plat]['avg1t2'] = (int)round(array_sum($fmtData[$plat]['dval1t2'])/count($fmtData[$plat]['dval1t2']));
                //--第一回购周期峰值：订单时间内，第一次购买与第二次购买的时间差的集合中，天数占比最多的值；
                $tmp1t2 = array_count_values($fmtData[$plat]['dval1t2']);
                $keys1t2 = array_keys($tmp1t2, max($tmp1t2));
                rsort($keys1t2);
                $fmtData[$plat]['max1t2'] = @$keys1t2[0] ?: '';
                //--第一回购周期峰值：订单时间内，第一次购买与第二次购买的时间差的集合中，天数占比第二多的值；

                //移除最大值，算第二大值
                $tmp1t2UnMax = array_except($tmp1t2, $keys1t2[0]);
                $seckeys1t2 = $tmp1t2UnMax ? array_keys($tmp1t2UnMax, max($tmp1t2UnMax)) : [];

                $fmtData[$plat]['sec1t2'] = @$seckeys1t2[0] ?: ( @$keys1t2[1] ?: '' );
                //--第一回购周期峰值占比：订单时间内，第一次购买与第二次购买的时间差的集合中，天数占比最多的值的会员个数/订单时间内有第二次购买的（去重）会员总数
                $fmtData[$plat]['1t2'] = $secBuyCount ? round(max($tmp1t2)/$secBuyCount, 2) : 0;
            }

            //--第二回购周期峰值：订单时间内，第二次购买与第三次购买的时间差的集合中，天数占比最多的值；
            if( count($fmtData[$plat]['dval2t3']) > 0){
                $tmp2t3 = array_count_values($fmtData[$plat]['dval2t3']);
                $keys2t3 = array_keys($tmp2t3, max($tmp2t3));
                rsort($keys2t3);
                $fmtData[$plat]['max2t3'] = @$keys2t3[0] ?: '';
            }

            $fmtData[$plat] = array_only($fmtData[$plat], ['avg1t2', 'max1t2', 'sec1t2', 'max2t3', '1t2']);
        }

        foreach($fmtData as $plat=>$row){
            $newData[] = [
                '店铺' => $plat,
                '平均第一回购周' => $row['avg1t2'],
                '第一回购周期峰值' => $row['max1t2'],
                '第一回购周期第二值' => $row['sec1t2'],
                '第二回购周期峰值' => $row['max2t3'],
                '第一回购周期峰值占比' => $row['1t2'],
            ];
        }
        return $newData;
    }
}