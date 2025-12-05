<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function updateReminder(Request $request) {
        $user = $request->user();
        $request->validate([
            'weeks_reminder' => 'boolean',
            'days_reminder' => 'boolean',
        ]);

        if (!$user->subscription) {
            return response()->json(['message' => 'No active subscription found.'], 404);
        }

        $user->subscription->weeks_reminder = $request->input('weeks_reminder', false);
        $user->subscription->days_reminder = $request->input('days_reminder', false);
        $user->subscription->save();

        return response()->json(['message' => 'Reminder settings updated successfully.']);
    }

    public function update(Request $request) {

    }

    public function changePlan(Request $request) {

    }

    public function cancel(Request $request) {

    }

    public function resume(Request $request) {

    }

    public function billingPortal(Request $request) {

    }

    public function updatePaymentMethod(Request $request) {

    }

    public function invoices(Request $request) {

    }

    public function downloadInvoice(Request $request, $invoiceId) {

    }
}
