<?php

namespace App\Http\Controllers;

use App\Models\eventlist;
use Illuminate\Http\Request;
use App\Http\Requests\StoreeventlistRequest;
use App\Http\Requests\UpdateeventlistRequest;

class EventlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $eventlist = eventlist::all();
        return response()->json($eventlist, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function search(Request $request){
   
        $search=$request->search;
        if($search==""){
       
       
        }
        else{
            $data = eventlist::where('name','LIKE','%'+$search+'%')->get();
            return response()->json($data, 200);
        }
      
     }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreeventlistRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreeventlistRequest $request)
    {
        date_default_timezone_set('Asia/Yangon');
   
        $eventlist = new eventlist();
        $eventlist->name=$request->name;
        $eventlist->content=$request->content;
        $eventlist->eventimg=$request->eventimg;
        $eventlist->likecount=0;
        $eventlist->reactcount=0;
        $eventlist->time=date('d-m-y h:i:s');

    
  


        $eventlist->save();
        return response()->json($eventlist, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\eventlist  $eventlist
     * @return \Illuminate\Http\Response
     */
    public function show(eventlist $eventlist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\eventlist  $eventlist
     * @return \Illuminate\Http\Response
     */
    public function edit(eventlist $eventlist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateeventlistRequest  $request
     * @param  \App\Models\eventlist  $eventlist
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateeventlistRequest $request, eventlist $eventlist)
    {
 
        $eventlist->name=$request->name;
        $eventlist->content=$request->content;
        $eventlist->eventimg=$request->eventimg;

        $eventlist->update();
        return response()->json($eventlist, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\eventlist  $eventlist
     * @return \Illuminate\Http\Response
     */
    public function destroy(eventlist $eventlist)
    {
        $eventlist->delete();
        return response()->json($eventlist, 200);
    }
    public function like($id,Request $request)
    {

        //    return $id;
      
        $like = eventlist::find($id);

        $like->likecount+=1;
     
        $like->update();
        return response()->json($like, 200);
    }

    public function deleteEvent($id)
    {

        //    return $id;
        $eventlist = eventlist::find($id);
        $eventlist->delete();
        return response()->json($eventlist, 200);
    }

    public function updateEvent($id,Request $request)
    {

        //    return $id;
      
        $eventlist = eventlist::find($id);

        $eventlist->name=$request->name;
        $eventlist->content=$request->content;
        $eventlist->eventimg=$request->eventimg;
  
        $eventlist->update();
        return response()->json($eventlist, 200);
    }

}
