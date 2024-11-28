<?php

namespace App\Http\Controllers\Admin\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class HomeAdminController extends Controller
{

    public function __construct()
    {
        $this->middleware(['can:home']);
    }
    public function index(){



        $chart_options = [
            'chart_title' => 'Posts by months',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Post',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'line',


            'filter_field' => 'created_at',
            'filter_days' => '3600', // show only transactions for this week
        ];
        $chart_post = new LaravelChart($chart_options);



        $chart_options = [
            'chart_title' => 'Users by months',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\User',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'bar',


            'filter_field' => 'created_at',
            'filter_days' => '360', // show only transactions for this week
        ];
        $chart_user = new LaravelChart($chart_options);


        $chart_options = [
            'chart_title' => 'Contacts by months',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Contact',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'line',


            'filter_field' => 'created_at',
            'filter_days' => '30', // show only transactions for this week
        ];
        $chart_contact = new LaravelChart($chart_options);




        $chart_options = [
            'chart_title' => 'Comments by months',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Comment',
            'group_by_field' => 'created_at',
            'group_by_period' => 'day',
            'chart_type' => 'bar',


            'filter_field' => 'created_at',
            'filter_days' => '30', // show only transactions for this week
        ];
        $chart_comment = new LaravelChart($chart_options);
        return view('admin.index',compact('chart_post','chart_user','chart_comment','chart_contact'));

    }
}
