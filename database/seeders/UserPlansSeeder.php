<?php

namespace Database\Seeders;

use App\Models\UserPlans;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class UserPlansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserPlans::where("id",">",0)->delete();
  
        $dataJson = File::get("database/dataJson/user_plans.json");
        $userPlans = json_decode($dataJson);
  
        foreach ($userPlans->user_plans as $key => $userPlan) {
            UserPlans::create([
                "id" => $userPlan->id,
                "user_id" => $userPlan->user_id,
                "currency_id" => $userPlan->currency_id,
                "next_user_plan_id" => $userPlan->next_user_plan_id,
                "start_timestamp" => $userPlan->start_timestamp,
                "end_timestamp" => $userPlan->end_timestamp,
                "renewal_timestamp" => $userPlan->renewal_timestamp,
                "renewal_price" => $userPlan->renewal_price,
                "requires_invoice" => $userPlan->requires_invoice,
                "status" => $userPlan->status,
                "created" => $userPlan->created,
                "modified" => $userPlan->modified,
                "financiation" => $userPlan->financiation,
                "status_financiation" => $userPlan->status_financiation,
                "language" => $userPlan->language,
                "nif" => $userPlan->nif,
                "business_name" => $userPlan->business_name,
                "pending_payment" => $userPlan->pending_payment,
                "date_max_payment" => $userPlan->date_max_payment,
                "proxim_start_timestamp" => $userPlan->proxim_start_timestamp,
                "proxim_end_timestamp" => $userPlan->proxim_end_timestamp,
                "proxim_renewal_timestamp" => $userPlan->proxim_renewal_timestamp,
                "proxim_renewal_price" => $userPlan->proxim_renewal_price,
                "credits_return" => $userPlan->credits_return,
                "company_id" => $userPlan->company_id,
                "cancel_employee" => $userPlan->cancel_employee,
                "force_renovation" => $userPlan->force_renovation,
                "date_canceled" => $userPlan->date_canceled,
                "amount_confirm_canceled" => $userPlan->amount_confirm_canceled,
                "credit_confirm_canceled" => $userPlan->credit_confirm_canceled,
                "cost_center_id" => $userPlan->cost_center_id,
                "created_at" => $userPlan->created,
                "updated_at" => $userPlan->modified
            ]);
        }
    }
}
