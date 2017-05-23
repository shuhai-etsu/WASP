<?php
/**
 * Created by PhpStorm.
 * User: sumnima
 * Date: 3/14/2017
 * Time: 10:30 PM
 */


use App\BusinessHour;


class BusinessHourTest extends TestCase
{
    /*@test*/
    public function test_weekend_business_hour()
    {
        BusinessHour::create(['weekday_id'=>'6','start_time'=>'10','end_time'=>'16','comment'=>'cannot work']);
        BusinessHour::create(['weekday_id'=>'1','start_time'=>'08:00','end_time'=>'17:00','comment'=>'canwork']);

        $businessHours=BusinessHour::weekday()->get();
        $this->assertCount(0,$businessHours);
    }
}
