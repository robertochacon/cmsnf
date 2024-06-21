<?php

namespace App\Http\Controllers;

use App\Models\Consultations;
use App\Models\Emergencies;
use App\Models\Institutions;
use App\Models\Licenses;
use App\Models\Patients;
use App\Models\Payments;
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use Illuminate\Support\Facades\DB;
use LaravelDaily\Invoices\Classes\Buyer;

class DownloadPdfController extends Controller
{
    public function license(int $patient_id)
    {

        $patient = Patients::where("id", $patient_id)->first();

        $customer = new Buyer([
            'patient'          => $patient,
        ]);

        $item = InvoiceItem::make('Service 1')->pricePerUnit(2);

        $invoice = Invoice::make()
            ->buyer($customer)
            ->addItem($item)
            ->template('license');

        return $invoice->stream();
    }

    public function prescription(int $order)
    {
        $customer = new Buyer([
            'name'          => 'John Doe',
            'custom_fields' => [
                'email' => 'test@example.com',
            ],
        ]);

        $item = InvoiceItem::make('Service 1')->pricePerUnit(2);

        $invoice = Invoice::make()
            ->buyer($customer)
            ->addItem($item)
            ->template('prescription');

        return $invoice->stream();
    }

    public function patient(int $id)
    {
        $patient = Patients::where("id", $id)->first();
        $institution = Institutions::where("id", $patient->institution_id)->first();

        $customer = new Buyer([
            'patient' => $patient,
            'institution' => $institution,
        ]);

        $item = InvoiceItem::make('Service 1')->pricePerUnit(2);

        $invoice = Invoice::make()
            ->buyer($customer)
            ->addItem($item)
            ->logo(public_path('vendor/invoices/logo.png'))
            ->template('patient');

        return $invoice->stream();
    }

    public function patients_report()
    {
        $patients = Patients::get();

        $customer = new Buyer([
            'patients' => $patients,
        ]);

        $item = InvoiceItem::make('Service 1')->pricePerUnit(2);

        $invoice = Invoice::make()
            ->buyer($customer)
            ->addItem($item)
            ->logo(public_path('vendor/invoices/logo.png'))
            ->template('patients_report');

        return $invoice->stream();
    }

    public function consultations_report()
    {
        $consultations = Consultations::get();

        $customer = new Buyer([
            'consultations' => $consultations,
        ]);

        $item = InvoiceItem::make('Service 1')->pricePerUnit(2);

        $invoice = Invoice::make()
            ->buyer($customer)
            ->addItem($item)
            ->logo(public_path('vendor/invoices/logo.png'))
            ->template('consultations_report');

        return $invoice->stream();
    }

    public function emergencies_report()
    {
        $emergencies = Emergencies::get();

        $customer = new Buyer([
            'emergencies' => $emergencies,
        ]);

        $item = InvoiceItem::make('Service 1')->pricePerUnit(2);

        $invoice = Invoice::make()
            ->buyer($customer)
            ->addItem($item)
            ->logo(public_path('vendor/invoices/logo.png'))
            ->template('emergencies_report');

        return $invoice->stream();
    }

    public function licenses_report()
    {
        $licences = Licenses::where('status','Aprobada')->get();

        $customer = new Buyer([
            'licences' => $licences,
        ]);

        $item = InvoiceItem::make('Service 1')->pricePerUnit(2);

        $invoice = Invoice::make()
            ->buyer($customer)
            ->addItem($item)
            ->logo(public_path('vendor/invoices/logo.png'))
            ->template('licences_report');

        return $invoice->stream();
    }

    public function payments_report()
    {
        $payments = Payments::select([
            'payments.*',
            DB::raw('(SELECT name FROM insurances WHERE insurances.id = payments.insurance_id) as insurance_name')
        ])->get();

        $customer = new Buyer([
            'payments' => $payments,
        ]);

        $item = InvoiceItem::make('Service 1')->pricePerUnit(2);

        $invoice = Invoice::make()
            ->buyer($customer)
            ->addItem($item)
            ->logo(public_path('vendor/invoices/logo.png'))
            ->template('payments_report');

        return $invoice->stream();
    }

}
