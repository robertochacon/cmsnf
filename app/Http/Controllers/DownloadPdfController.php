<?php

namespace App\Http\Controllers;

use App\Models\Articles;
use App\Models\Emergencies;
use App\Models\Institutions;
use App\Models\Order;
use App\Models\Partner;
use App\Models\Patients;
use Illuminate\Http\Request;
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use LaravelDaily\Invoices\Classes\Party;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\Auth;
use LaravelDaily\Invoices\Classes\Buyer;

class DownloadPdfController extends Controller
{
    public function license(int $order)
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
            ->template('patient');

        return $invoice->stream();
    }

    public function patients_report()
    {
        $patient = Patients::get();
        // $institution = Institutions::where("id", $patient->institution_id)->first();

        $customer = new Buyer([
            'patient' => $patient,
            // 'institution' => $institution,
        ]);

        $item = InvoiceItem::make('Service 1')->pricePerUnit(2);

        $invoice = Invoice::make()
            ->buyer($customer)
            ->addItem($item)
            ->template('patients_report');

        return $invoice->stream();
    }

    public function consultations_report()
    {
        $consultations = Emergencies::get();

        $customer = new Buyer([
            'consultations' => $consultations,
        ]);

        $item = InvoiceItem::make('Service 1')->pricePerUnit(2);

        $invoice = Invoice::make()
            ->buyer($customer)
            ->addItem($item)
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
            ->template('emergencies_report');

        return $invoice->stream();
    }

    public function licenses_report()
    {
        $licences = Emergencies::get();

        $customer = new Buyer([
            'licences' => $licences,
        ]);

        $item = InvoiceItem::make('Service 1')->pricePerUnit(2);

        $invoice = Invoice::make()
            ->buyer($customer)
            ->addItem($item)
            ->template('licences_report');

        return $invoice->stream();
    }

    public function payments_report()
    {
        $payments = Emergencies::get();

        $customer = new Buyer([
            'payments' => $payments,
        ]);

        $item = InvoiceItem::make('Service 1')->pricePerUnit(2);

        $invoice = Invoice::make()
            ->buyer($customer)
            ->addItem($item)
            ->template('payments_report');

        return $invoice->stream();
    }

}
