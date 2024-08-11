<?php

namespace App\Http\Controllers;

use App\Models\ApiLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiLogController extends Controller
{
    public function query(Request $request, $queryType)
    {
        $queryTitle = '';
        $data = collect(); // Initialize as an empty collection

        switch ($queryType) {
                // case 'total-requests':
                //     $queryTitle = 'Total API Calls';
                //     $data = collect([['count' => ApiLog::count()]]); // Wrap the count in a collection
                //     break;

            case 'all-requests':
                $queryTitle = 'All API Calls';
                $data = ApiLog::all();
                break;

            case 'successful-requests':
                $queryTitle = 'Successful API Calls: Code 200';
                $data = ApiLog::where('response_code', 200)->get();
                break;

            case 'redirected-requests':
                $queryTitle = 'Redirected API Calls: Code 302';
                $data = ApiLog::where('response_code', 302)->get();
                break;

            case 'failed-requests':
                $queryTitle = 'Failed API Calls: Code 400 or Larger';
                $data = ApiLog::where('response_code', '>=', 400)->get();
                break;

            case 'error-codes':
                $queryTitle = 'Most Called Response Codes In Descending';
                $data = ApiLog::select('response_code', DB::raw('count(*) as total'))
                    ->groupBy('response_code')
                    ->orderBy('total', 'desc')
                    ->get();
                break;

            case 'slowest-calls':
                $queryTitle = 'Slowest 50 API Calls';
                $data = ApiLog::orderBy('execution_time', 'desc')->take(50)->get();
                break;

            case 'most-called-endpoints':
                $queryTitle = 'Most Called Endpoints In Descending';
                $data = ApiLog::select('endpoint', DB::raw('count(*) as total'))
                    ->groupBy('endpoint')
                    ->orderBy('total', 'desc')
                    ->get();
                break;

            case 'calls-by-date':
                $queryTitle = 'API Calls Over Date';
                $data = ApiLog::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as total'))
                    ->groupBy(DB::raw('DATE(created_at)'))
                    ->orderBy('date', 'asc')
                    ->get();
                break;

            case 'calls-by-month':
                $queryTitle = 'API Calls Over Month';
                $data = ApiLog::select(DB::raw('DATE_FORMAT(created_at, "%M %Y") as month'), DB::raw('count(*) as total'))
                    ->groupBy(DB::raw('DATE_FORMAT(created_at, "%M %Y")'))
                    ->orderBy(DB::raw('MIN(created_at)'), 'asc')
                    ->get();
                break;

            case 'status-codes-summary':
                $queryTitle = 'Status Codes Summary';
                $data = ApiLog::select('response_code', DB::raw('count(*) as total'))
                    ->groupBy('response_code')
                    ->get();
                break;

            case 'unique-tokens':
                $queryTitle = 'API Calls by Unique Token';
                $data = ApiLog::select('token', DB::raw('count(*) as total'))
                    ->groupBy('token')
                    ->orderBy('total', 'desc')
                    ->get();
                break;
            case 'daily-unique-tokens':
                $queryTitle = 'Daily Unique Tokens';
                $data = ApiLog::select(DB::raw('DATE(created_at) as date'), 'token', DB::raw('count(*) as total'))
                    ->groupBy(DB::raw('DATE(created_at)'), 'token')
                    ->orderBy('date', 'asc')
                    ->orderBy('total', 'desc')
                    ->get();
                break;

            case 'monthly-unique-tokens':
                $queryTitle = 'Monthly Unique Tokens';
                $data = ApiLog::select(DB::raw('DATE_FORMAT(created_at, "%M %Y") as month'), 'token', DB::raw('count(*) as total'))
                    ->groupBy(DB::raw('DATE_FORMAT(created_at, "%M %Y")'), 'token')
                    ->orderBy(DB::raw('MIN(created_at)'), 'asc')
                    ->orderBy('total', 'desc')
                    ->get();
                break;
        }

        return view('api_logs.show', compact('queryTitle', 'data'));
    }
}
