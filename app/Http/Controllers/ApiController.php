<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Exception;
use App\Models\VendorUsers;
use App\Models\User;
use Illuminate\Http\Request;
use App\Helpers\FirestoreHelper;

class ApiController extends Controller
{
    public function deleteUserFromDb(Request $request) {

        $validator = Validator::make($request->all(), [
            'uuid' => 'required|exists:vendor_users,uuid',  
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'status' => 'okay',
                'message' => $validator->errors()->first(), 
            ], 400);
        }
    
        DB::beginTransaction();
    
        try {
            $vendorUser = VendorUsers::where('uuid', $request->uuid)->first();
            if ($vendorUser) {
                $user_id = $vendorUser->user_id;  
                $user = User::find($user_id);
                if ($user) {
                    $user->delete();  
                } else {
                    return response()->json([
                        'status' => 'okay',
                        'message' => 'User not found with the provided user_id.',
                    ], 404);
                }
                $vendorUser->delete();
            } else {
                return response()->json([
                    'status' => 'okay',
                    'message' => 'No associated vendor user found with the provided UUID.',
                ], 404);
            }

            DB::commit();
    
            return response()->json([
                'status' => 'okay',
                'message' => 'User and associated records deleted successfully.',
            ], 200);
    
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete user. ' . $e->getMessage(),
            ], 500);
        }
    }

    public function setupStripeAccount(Request $request)
    {
        
        $user_email = $request->input('user_email');
        if (!$user_email) {
            return response()->json([
                    'status' => 'failed',
                    'error' => 'User email required'
            ], 400);
        }
        
        // Get Stripe settings
        $stripeSettings = FirestoreHelper::getDocument('settings/stripeSettings');
        $stripeSecret = $stripeSettings['stripeSecret'] ?? null;
        if (!$stripeSecret) {
            return response()->json(['error' => 'Stripe secret key not configured'], 500);
        }

        $stripe = new \Stripe\StripeClient($stripeSecret);

        // Create new Stripe account
        $account = $stripe->accounts->create([
            'type' => 'express',
            'country' => 'US',
            'email' => $user_email,
            'capabilities' => [
                'transfers' => ['requested' => true],
            ],
        ]);

        $account_id = $account->id;
        
        // Create onboarding link
        $accountLink = $stripe->accountLinks->create([
            'account' => $account_id,
            'type' => 'account_onboarding',
            'refresh_url' => route('withdraw-method'),
            'return_url' => route('withdraw-method'),
        ]);

        return response()->json([
            'status' => 'success',
            'account_id' => $account_id,
            'onboarding_url' => $accountLink->url
        ]);
    }
}
