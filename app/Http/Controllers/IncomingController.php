<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Incoming;
use App\Models\Tutor;
use App\Models\Invoice;
use App\Http\Requests\IncomingRequest;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\IncomingImport;
use Illuminate\Support\Facades\DB;


class IncomingController extends Controller
{


    private function saveData($data, $incoming){
        $totalMatch = 0;
        
        // dd($data['values']);
        // $inputValues = $data->input('values');
        // dd($data['values']); 
        $inputValues = $data['values'];
        if($data['invoice_id']){
            foreach($data['invoice_id'] as $factura){

                $totalMatch += $inputValues[$factura];
                DB::table('incoming_invoice')->where('incoming_id', $incoming->id)
                ->where('invoice_id', $factura)
                ->update(['suma' => $inputValues[$factura]]);

                $forUpdateInvoice = Invoice::where('id', $factura)->first();

                $forUpdateInvoice->update([
                    'rest'      => $forUpdateInvoice->rest -  $inputValues[$factura],
                    'status'    => ($forUpdateInvoice->rest -  $inputValues[$factura] ==0 ) ? 'achitata' : 'emisa',
                ]);
            }

            $incoming->update([
                'due'   => $incoming->due - $totalMatch,
            ]);
        }
    }

    public function index(){
        $incomings = Incoming::where('due', '>', 0)->paginate(10);
        return view('incoming.index', compact('incomings'));
    }

    public function indexClosed(){
        $incomings = Incoming::where('due', 0)->paginate(10);
        return view('incoming.index', compact('incomings'));
    }

    public function addEdit(Incoming $incoming = null){
        return view('incoming.addEdit', compact('incoming'));
    }

    public function storeUpdate(IncomingRequest $request, Incoming $incoming = null){

        $data = $request->validated();

        if($incoming != null){
            $totalMatchReturn = 0;
            // dd($request->all());
            foreach($incoming->invoices as $oldAmount){
                $totalMatchReturn += $oldAmount->pivot->suma;
                $oldInvoice = Invoice::where('id', $oldAmount->id)->first();

                $oldInvoice->update([
                    'rest'    => ($oldInvoice->rest + $oldAmount->pivot->suma),
                    'status'    => 'emisa',
                ]);

                // dd($incoming);
            }

            $incoming->update($data);

            $incoming->invoices()->sync($request->invoice_id);
            
            $incoming->update([
                'due' => $incoming->due + $totalMatchReturn,
            ]);
            $data2= $request->all();
            if(isset($data2['invoice_id'])){
                $this->saveData($data2, $incoming);
            }
            
            
            // $totalMatch = 0;
            // $inputValues = $request->input('values');
            // if($request->invoice_id){
            //     foreach($request->invoice_id as $factura){

            //         $totalMatch += $inputValues[$factura];
            //         DB::table('incoming_invoice')->where('incoming_id', $incoming->id)
            //         ->where('invoice_id', $factura)
            //         ->update(['suma' => $inputValues[$factura]]);
    
            //         $forUpdateInvoice = Invoice::where('id', $factura)->first();
    
            //         $forUpdateInvoice->update([
            //             'rest'      => $forUpdateInvoice->rest -  $inputValues[$factura],
            //             'status'    => ($forUpdateInvoice->rest -  $inputValues[$factura] ==0 ) ? 'achitata' : 'emisa',
            //         ]);
            //     }
    
            //     $incoming->update([
            //         'due'   => $incoming->due - $totalMatch,
            //     ]);
            // }


            $notification = array(
                'message' =>    'Incasare modificata cu succes!',
                'alert-type'    => 'success',
            );

        }else{
            $incoming = Incoming::create($data);

            $incoming->invoices()->attach($request->invoice_id);

            $data= $request->all();
            $this->saveData($data, $incoming);

            $notification = array(
                'message' =>    'Incasare adaugata cu succes!',
                'alert-type'    => 'success',
            );
        }

        return redirect()->route('incoming.index')->with($notification);
    }

    public function delete(Incoming $incoming){

        $incoming->invoices()->detach();

        $incoming->delete();
        
        $notification = array(
            'message' =>    'Incasare stearsa cu succes!',
            'alert-type'    => 'success',
        );
        
        return redirect()->route('incoming.index')->with($notification);
    }

    public function formImport(){
        return view('incoming.import');
    }

    public function import(Request $request){
        Excel::import(new IncomingImport, $request->file);

        $notification = array(
            'message' =>    'Facturi adaugate cu succes!',
            'alert-type'    => 'success',
        );
        return redirect()->route('incoming.index')->with($notification);
    }

    public function match(){
        $allNotMached  = Incoming::where('due', '>', 0)->get();
        // $allNotMached  = Incoming::where('invoice_id', null)->get();
        foreach($allNotMached as $match){
            $payParent = Tutor::where('name', $match->name)->get();
            
            if($payParent->count() > 0){
                foreach($payParent as $pay){
                    
                    $invoices = Invoice::where('student_id', $pay->student_id)
                                        ->where('status', 'emisa')
                                        ->get();

                


                $totalMatch = 0;

                foreach($invoices as $factura){

                    if($factura->rest <= $match->due){
                        $totalMatch += $factura->rest;
                        
                        $match->invoices()->attach($factura);

                        DB::table('incoming_invoice')->where('incoming_id', $match->id)
                          ->where('invoice_id', $factura->id)
                          ->update([
                            'suma' => $factura->rest,
                            ]);
                            
                            $factura->update([
                                'rest'       => 0,
                                'status'    => 'achitata',
                            ]);
                            $match->update([
                                'due'   => ($match->due - $totalMatch),
                            ]);
                    }

                    if($factura->rest > $match->due){
                        $totalMatch += $match->due;

                        $match->invoices()->attach($factura);

                        DB::table('incoming_invoice')->where('incoming_id', $match->id)
                          ->where('invoice_id', $factura->id)
                          ->update([
                            'suma' => $match->due,
                            ]);
                            
                            $factura->update([
                                'rest'       => ($factura->rest - $match->due),
                            ]);
                            $match->update([
                                'due'   => 0,
                            ]);
                    }

                    // $forUpdateInvoice = Invoice::where('id', $factura)->first();

                    // $forUpdateInvoice->update([
                    //     'rest'      => $forUpdateInvoice->rest -  $inputValues[$factura],
                    //     'status'    => ($forUpdateInvoice->rest -  $inputValues[$factura] ==0 ) ? 'achitata' : 'emisa',
                    // ]);
                }

                    // if($invoices->count()>0){
                    //     foreach($invoices as $invoice)

                    //         if($invoice->rest <= $match->due){

                    //                 $invoice->update([
                    //                     'rest'      => 0,
                    //                     'status'    => "incasata",
                    //                 ]);


                    //                 $match->update([
                    //                     'invoice_id'    => $invoice->id,
                    //                     'due'           => $match->due - $invoice->rest,
                    //                 ]);
                    //             }
                    //         if($invoice->rest > $match->due){
                    //             $invoice->update([
                    //                 'rest'      => $invoice->rest - $match->due,
                    //             ]);
                                
                    //             $match->update([
                    //                 'invoice_id'    => $invoice->id,
                    //                 'due'           => 0,
                    //             ]);
                    //         }
                    // }
                }
            }
        }
        return redirect()->back();
    }

    public function search(Request $request){
        $search = $request->search;

        $incomings = Incoming::where('name', 'LIKE', '%' . $search . '%')
                              ->orWhere('amount', $search)
                              ->paginate(10);
        $incomings->appends([
            'search' => $request->search,
        ]);

        return view('incoming.index', compact('incomings', 'search'));
    }
}
