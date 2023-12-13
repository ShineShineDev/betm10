<?php

namespace App\Http\Controllers\api;

use Exception;
use App\Models\Customer;
use App\Models\Referrals;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ReferralController extends Controller
{
    use ApiResponser;

    public function make(Request $request)
    {
        $request->validate([
            'referral_code' => 'required|exists:customers,referral_code'
        ]);

        $customer = Customer::where('referral_code', $request->referral_code)->first();

        if (!$customer) return $this->errorResponse('Invalid Code', 204);

        $auth_customer = $request->user();

        try {
            DB::beginTransaction();

            $referral = Referrals::create([
                'user_id'          => $auth_customer->id,
                'referral_user_id' => $customer->id,
                'created_at'       => now()
            ]);

            $auth_customer->update([
                'referral_id' => $referral->id
            ]);

            DB::commit();

            return $this->successResponse($referral);
        } catch (Exception $e) {

            DB::rollback();

            return $this->errorResponse($e->getMessage(), 500);
        }
    }

    public function list()
    {
        $referrals = Referrals::with('customer','customer.bet_slips.section')
            ->where('user_id', request()->user()->id)
            ->orderBy('id', 'desc')
            ->get();

        return $referrals;

    }
}
