<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Http\Requests\InvoiceRequest;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\InvoiceImport;

class InvoiceController extends Controller
{
    public function index(){
        $invoices = Invoice::where('status', 'emisa')->paginate(10);
        return view('invoice.index', compact('invoices'));
    }

    public function indexClosed(){
        $invoices = Invoice::where('status', 'achitata')->paginate(10);
        return view('invoice.index', compact('invoices'));
    }

    public function addEdit(Invoice $invoice = null){
        return view('invoice.addEdit', compact('invoice'));
    }

    public function storeUpdate(InvoiceRequest $request, Invoice $invoice = null){

        $data = $request->validated();

        if($invoice != null){

            $invoice->update($data);

            $notification = array(
                'message'       => 'Factura modificata cu succes!',
                'alert-type'    => 'success',
            );

        }else{
            Invoice::create($data);

            $notification = array(
                'message'       => 'Factura inregistrata cu succes!',
                'alert-type'    => 'success',
            );

        }

        return redirect()->route('invoice.index')->with($notification);
    }

    public function delete(Invoice $invoice){
        $invoice->delete();

        $notification = array(
            'message'       => 'Factura stearsa cu succes!',
            'alert-type'    => 'success',
        );

        return redirect()->route('invoice.index')->with($notification);
    }

    public function formImport(){
        return view('invoice.import');
    }

    public function import(Request $request) {
        
        Excel::import(new InvoiceImport, $request->file);

        $notification = array(
            'message' =>    'Facturi adaugate cu succes!',
            'alert-type'    => 'success',
        );
        return redirect()->route('invoice.index')->with($notification);
    }

    public function search(Request $request){
        $search = $request->search;

        $invoices = Invoice::where('name', 'LIKE', '%' . $search . '%')
                            ->orWhere('numberInv', 'LIKE', '%' . $search . '%')
                            ->orWhere('amount', 'LIKE', '%' . $search . '%')
                            ->orWhereHas('student', function($query) use($search){
                                $query->where('name', 'LIKE', '%' . $search . '%');
                            })
                            ->paginate(10);

        $invoices->appends([
            'search' => $request->search,
        ]);

        return view('invoice.index', compact('invoices', 'search'));
    }
}
