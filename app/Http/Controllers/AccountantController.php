<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExpenseCategory;
use App\Models\Expense;
use App\Models\Booking;
use App\Models\Reservation;
use App\Models\Payment;
use App\Models\Invoice;
use Illuminate\Support\Str;

class AccountantController extends Controller
{
    public function dashboard()
    {
        $today = now()->format('Y-m-d');
        $month = now()->format('Y-m');
        
        $stats = [
            'today_sales' => Payment::whereDate('payment_date', $today)->where('status', 'confirmed')->sum('amount'),
            'month_sales' => Payment::where('payment_date', 'like', $month . '%')->where('status', 'confirmed')->sum('amount'),
            'month_expenses' => Expense::where('expense_date', 'like', $month . '%')->sum('amount'),
            'pending_payments' => Payment::where('status', 'pending')->count(),
        ];

        return view('accountant.dashboard', compact('stats'));
    }

    // Expense Categories
    public function expenseCategories()
    {
        $categories = ExpenseCategory::latest()->get();
        return view('accountant.expense-categories.index', compact('categories'));
    }

    public function storeExpenseCategory(Request $request)
    {
        ExpenseCategory::create($request->all());
        return redirect()->back()->with('success', 'Expense category created successfully');
    }

    public function updateExpenseCategory(Request $request, $id)
    {
        $category = ExpenseCategory::findOrFail($id);
        $category->update($request->all());
        return redirect()->back()->with('success', 'Expense category updated successfully');
    }

    public function deleteExpenseCategory($id)
    {
        ExpenseCategory::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Expense category deleted successfully');
    }

    // Expenses
    public function expenses()
    {
        $expenses = Expense::with(['category', 'recordedBy'])->latest()->get();
        $categories = ExpenseCategory::where('status', 'active')->get();
        return view('accountant.expenses.index', compact('expenses', 'categories'));
    }

    public function storeExpense(Request $request)
    {
        $expense = new Expense();
        $expense->expense_number = 'EXP-' . strtoupper(Str::random(8));
        $expense->fill($request->all());
        $expense->recorded_by = auth()->id();
        
        if ($request->hasFile('receipt')) {
            $expense->receipt = $request->file('receipt')->store('expenses/receipts', 'public');
        }
        
        $expense->save();

        return redirect()->back()->with('success', 'Expense recorded successfully');
    }

    // Sales Reports
    public function sales(Request $request)
    {
        $startDate = $request->start_date ?? now()->startOfMonth()->format('Y-m-d');
        $endDate = $request->end_date ?? now()->format('Y-m-d');

        $payments = Payment::whereBetween('payment_date', [$startDate, $endDate])
            ->where('status', 'confirmed')
            ->with(['booking', 'reservation', 'receivedBy'])
            ->latest()
            ->get();

        $totalSales = $payments->sum('amount');

        return view('accountant.sales.index', compact('payments', 'totalSales', 'startDate', 'endDate'));
    }

    // Invoices
    public function invoices()
    {
        $invoices = Invoice::with(['booking', 'reservation', 'createdBy'])->latest()->get();
        return view('accountant.invoices.index', compact('invoices'));
    }

    public function generateInvoice(Request $request)
    {
        $invoice = new Invoice();
        $invoice->invoice_number = 'INV-' . strtoupper(Str::random(8));
        $invoice->fill($request->all());
        $invoice->created_by = auth()->id();
        $invoice->invoice_date = now();
        $invoice->save();

        return redirect()->back()->with('success', 'Invoice generated successfully');
    }

    // Confirm Payments
    public function payments()
    {
        $payments = Payment::with(['booking', 'reservation', 'receivedBy', 'confirmedBy'])
            ->latest()
            ->get();
        return view('accountant.payments.index', compact('payments'));
    }

    public function confirmPayment(Request $request, $id)
    {
        $payment = Payment::findOrFail($id);
        $payment->status = 'confirmed';
        $payment->confirmed_by = auth()->id();
        $payment->confirmed_at = now();
        $payment->save();

        // Update booking/reservation payment status
        if ($payment->booking_id) {
            $booking = Booking::find($payment->booking_id);
            $booking->paid_amount += $payment->amount;
            $booking->balance_amount = $booking->total_amount - $booking->paid_amount;
            $booking->payment_status = $booking->balance_amount <= 0 ? 'paid' : 'partial';
            $booking->save();
        }

        if ($payment->reservation_id) {
            $reservation = Reservation::find($payment->reservation_id);
            $reservation->paid_amount += $payment->amount;
            $reservation->balance_amount = $reservation->total_amount - $reservation->paid_amount;
            $reservation->payment_status = $reservation->balance_amount <= 0 ? 'paid' : 'partial';
            $reservation->save();
        }

        return redirect()->back()->with('success', 'Payment confirmed successfully');
    }
}
