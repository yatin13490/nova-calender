<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Enquiry;
use Illuminate\Support\Carbon;
use App\EnquiryEvent;

/*
|--------------------------------------------------------------------------
| Tool API Routes
|--------------------------------------------------------------------------
|
| Here is where you may register API routes for your tool. These routes
| are loaded by the ServiceProvider of your tool. They are protected
| by your tool's "Authorize" middleware by default. Now, go build!
|
*/

// Route::get('/endpoint', function (Request $request) {
//     //
// });

Route::get('/calendar', function (Request $request) {
    $events = EnquiryEvent::with(['Venue', 'EventType'])->get();
    
    $modified_event_list = $events->map(function ($item, $key) {
        // title: "test",
        // allDay: true,
        // start: moment(),
        // end: moment().add(1, "d")
        // rendering: 'background'
        $item['title'] = "#". $item->Enquiry->id . ' '. $item->Enquiry->name;
        $item['start'] =  Carbon::parse($item->date)->format('Y-m-d');
        $item['end'] =  Carbon::parse($item->date)->format('Y-m-d');
        $item['allDay'] = true;

        // dump($item); exit();
        
        return $item;
    });
    return response()->json($modified_event_list);
});