<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Spatie\Analytics\Facades\Analytics;
use Spatie\Analytics\Period;

class GoogleAnalitycs extends Controller
{
    public function index(){

        $array = [];
        $array['most_vested_page'] = Analytics::fetchMostVisitedPages(Period::days(7));
        $array['visitor_and_page_views'] = Analytics::fetchVisitorsAndPageViews(Period::days(7));
        $array['visitors_and_page_views_by_date'] = Analytics::fetchVisitorsAndPageViewsByDate(Period::days(7));
        $array['total_page_visitor_and_page_views'] = Analytics::fetchTotalVisitorsAndPageViews(Period::days(7));
        $array['top_references'] = Analytics::fetchTopReferrers(Period::days(7));
        $array['user_by_type'] = Analytics::fetchUserTypes(Period::days(28));
        $array['view_by_browser'] = Analytics::fetchTopBrowsers(Period::days(7));

//        'achievementId', 'adFormat', 'adSourceName','country', 'deviceCategory', 'browser', 'contentGroup', 'date', 'dateHour','deviceModel',
        $dimensions =  ['country', 'eventName'];
        try {
            $data = Analytics::get(Period::days(7),['activeUsers'] , $dimensions);

            return $data;
        }catch (\Exception $e){
            return $e;
        }




//        foreach($analyticsData as $item){
//            echo"</br>";
//            print_r($item["pageTitle"]);
//        }
    }
}
