<?php

namespace App\Http\Controllers;

use App\Models\Book_view;
use App\Models\Sales;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DailyContoller extends Controller
{
    public function daily()
    {
        $bookSoldCount = [];
        $bookViewedCount = [];

        $startDate = Carbon::today()->subDays(91);
        $endDate = Carbon::today()->addDays(1);
        if(auth()->user()->hasRole('Admin')){
            $bookSold = Sales::whereBetween("created_at", [$startDate, $endDate])->get();
            $bookViewed = Book_view::whereBetween("created_at", [$startDate, $endDate])->get();

        }else{

            $seller_Id=auth()->user()->seller->id;
            $sellerBooks=auth()->user()->seller->books->pluck('id','id');

            $bookSold = Sales::where('seller_id',$seller_Id)->whereBetween("created_at", [$startDate, $endDate])->get();
            $bookViewed = Book_view::whereIn('book_id',$sellerBooks)->whereBetween("created_at", [$startDate, $endDate])->get();

        }


        // $bookSold = Sales::whereBetween("created_at", [$startDate, $endDate])->get();
        // $bookViewed = Sales::whereBetween("created_at", [$startDate, $endDate])->get();

        if ($bookSold != null) {

            $currentDate = Carbon::today()->subDays(91);

            while ((Carbon::today())->gte($currentDate)) {
                $bookSoldCount[$currentDate->format("d M")] = 0;
                $bookViewedCount[$currentDate->format("d M")] = 0;
                $currentDate = $currentDate->addDays(1);
            }

            foreach ($bookSoldCount as $key => $bookSoldCounts) {
                foreach ($bookSold as $campaign) {
                    $date = Carbon::parse($campaign->created_at)->format("d M");
                    if ($key == $date) {
                        $bookSoldCount[$key] += 1;
                    }
                }
            }

            foreach ($bookViewedCount as $key => $bookViewedCounts) {
                foreach ($bookViewed as $campaign) {
                    $date = Carbon::parse($campaign->created_at)->format("d M");
                    if ($key == $date) {
                        $bookViewedCount[$key] += 1;
                    }
                }
            }

            return [$bookSoldCount, $bookViewedCount];
        }
    }
}
