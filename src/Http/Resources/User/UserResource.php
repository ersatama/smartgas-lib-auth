<?php

declare(strict_types=1);

namespace Smartgas\Auth\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return collect([
            'id'                  => $this->id,
            'token'               => $this->token,
            'username'            => $this->username,
            'first_name'          => $this->first_name,
            'last_name'           => $this->last_name,
            'display_name'        => $this->display_name,
            'fb_device_token'     => $this->fb_device_token,
            'phone'               => $this->phone,
            'role'                => $this->role,
            'secret_key'          => $this->secret_key,
            'email'               => $this->email,
            'img'                 => $this->img,
            'thumbnail'           => $this->thumbnail,
            'vehicle_thumbnail'   => $this->vehicle_thumbnail,
            'vehicle_type'        => $this->vehicle_type,
            'company_name'        => $this->company_name,
            'iin_bin'             => $this->iin_bin,
            'company_logo'        => $this->company_logo,
            'vehicle_id'          => $this->vehicle_id,
            'card_number'         => $this->card_number,
            'iin'                 => $this->iin,
            'vehicle_year'        => $this->vehicle_year,
            'vehicle_fuel'        => $this->vehicle_fuel,
            'vehicle_mileage'     => $this->vehicle_mileage,
            'date_added'          => $this->date_added,
            'last_modified'       => $this->last_modified,
            'author_id'           => $this->author_id,
            'disabled'            => $this->disabled,
            'deleted'             => $this->deleted,
            'latitude'            => $this->latitude,
            'longitude'           => $this->longitude,
            'device_type'         => $this->device_type,
            'user_status'         => $this->user_status,
            'vehicle_manufacture' => $this->vehicle_manufacture,
            'city_id'             => $this->city_id,
            'createdby_user_id'   => $this->createdby_user_id,
            'working_days'        => $this->working_days,
            'working_hour_from'   => $this->working_hour_from,
            'working_hour_to'     => $this->working_hour_to,
            'business_id_number'  => $this->business_id_number,
            'bank_gateway'        => $this->bank_gateway,
            'is_masterpass_agree' => $this->is_masterpass_agree,
            'contract_number'     => $this->contract_number,
            'general_director'    => $this->general_director,
            'main_accountant'     => $this->main_accountant,
            'store_side'          => $this->store_side,
            'is_test'             => $this->is_test,
            'comment'             => $this->comment,
            'created_at'          => $this->created_at
        ])->filter()->toArray();
    }
}
