<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\History;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['verified']);
    }

    public function index(Request $request)
    {
        $per_page = $request->get('page_size') ? $request->get('page_size') : '20';
        $history = History::sortable()->paginate($per_page);
        return view('/events/eventlog')->with('events', $history);
    }

    public function deactivate(Request $request)
    {
        $entry = History::whereId($request->id)->first();
        if ($entry['active'] == 0) {
            History::where('id', $request->id)->update(['active' => 1]);
            return response()->json(['success' => 1]);
        } else {
            History::where('id', $request->id)->update(['active' => 0]);
            return response()->json(['success' => 0]);
        }
    }

    public function search_event(Request $request)
    {
        $history = History::serial($request->search)->artikul($request->search)->take(5)->latest('created_at')->get();

        foreach ($history as $item) {
            $item['data'] = json_decode($item['data']);
        }

        return view('/events/add_event')->with('history', $history);
    }

    public function add_event(Request $request)
    {
        if ($request->method() == 'GET') {
            return view('/events/add_event');
        } else {
            $this->validate($request, [
                'created_at' => 'required|date_format:Y-m-d',
                'price_per_piece' => 'required|numeric|min:0.01|max:99999999.99',
                'package_price' => 'required|numeric|min:0.01|max:99999999.99',
                'pieces' => 'required|numeric'
            ], [
                    'created_at.date_format' => 'Specify date with format Y-m-d',
                    'price_per_piece.numeric' => 'Price per pice must be between: 0 and 99999999.99',
                    'package_price.numeric' => 'Package price must be between: 0 and 99999999.99',
                    'pieces.numeric' => 'CIP must be a digit'
                ]
            );
            $data = $request->all();

            $history_data = array(
                'name' => $data['name'],
                'price_per_piece' => $data['price_per_piece'],
                'pieces' => $data['pieces'],
                'package_price' => $data['package_price'],
                'status' => $data['status'],
                'state' => $data['state']
            );

            $existing_history = History::serial($data['serial_number'])->artikul($data['serial_number'])->take(5)->orderBy('created_at', 'asc')->get();
            $count = count($existing_history);

            if ($count) {
                $count--;
                if ($existing_history[$count]['data'] === json_encode($history_data)) {
                    return back()->withErrors('You need to change one of the fields');
                }

                foreach ($existing_history as $h) {
                    if ($h['created_at'] == $data['created_at']) {
                        return back()->withErrors('Date is taken');
                    }
                }
            }
            $event = History::create([
                'product_id' => $data['product_id'],
                'data' => json_encode($history_data),
                'created_at' => $data['created_at'],
                'active' => 1,
                'serial_number' => $data['serial_number'],
                'artikul_number' => $data['artikul_number'],
            ]);

            $event->save();

            return redirect('/events/add_event')->with('success', 'Record Created');
        }
    }
}
