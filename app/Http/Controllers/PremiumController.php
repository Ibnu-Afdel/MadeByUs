<?php

namespace App\Http\Controllers;

use App\Enums\PremiumPaymentStatus;
use App\Models\PremiumPayment;
use App\Services\ChapaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PremiumController extends Controller
{
    public function showUpgrade()
    {
        return view('premium.upgrade');
    }

    public function initiatePremium(Request $request)
    {
        $user = Auth::user();
        $txRef = 'PREMIUM' . uniqid();
        $chapa = new ChapaService();

        try {
            $checkoutUrl = $chapa->initializePayment([
                'amount' => config('chapa.premium_price'),
                'email' => $user->email,
                'first_name' => $user->name,
                'last_name' => '',
                'tx_ref' => $txRef,
                'callback_url' => route('premium.callback'),
                'return_url' => route('premium.thank-you')
            ]);

            PremiumPayment::create([
                'user_id' => $user->id,
                'tx_ref' => $txRef,
                'amount' => config('chapa.premium_price'),
                'status' => PremiumPaymentStatus::PENDING
            ]);

            return redirect()->away($checkoutUrl);
        } catch (\Exception $e) {
            return back()->with('error', 'Payment failed: ' . $e->getMessage());
        }
    }

    public function handleCallback(Request $request)
    {
        $txRef = $request->query('tx_ref');
        $payment = PremiumPayment::where('tx_ref', $txRef)->firstOrFail();

        if ($payment->hasSuccess()) {
            return redirect()->route('premium.thank-you');
        }

        // Verify payment with Chapa
        $chapa = new ChapaService();
        $result = $chapa->verifyTransaction($txRef);

        // Check if payment was successful
        if (($result['status'] ?? '') === 'success' && ($result['data']['status'] ?? '') === 'success') {
            // Store Chapa response and mark as successful
            $payment->update(['chapa_response' => $result['data']]);
            $payment->markAsSuccessAndUpgrade();
            
            return redirect()->route('premium.thank-you')->with('success', 'Payment successful!');
        }

        $payment->markAsFailed();
        return redirect()->route('premium.upgrade')->with('error', 'Payment failed. Please try again.');
    }

    public function thankYou()
    {
        // just for DEMO : Auto-complete pending payments (for production, wibi wekhook thing)
        $user = Auth::user();
        if ($user && !$user->hasRole('Premium')) {
            $pendingPayment = PremiumPayment::where('user_id', $user->id)
                ->where('status', PremiumPaymentStatus::PENDING)
                ->latest()
                ->first();
            
            if ($pendingPayment) {
                $pendingPayment->markAsSuccessAndUpgrade();
            }
        }
        // --
        
        return view('premium.thank-you');
    }
}
