<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DistributorBusinessResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'display_name' => $this->display_name,
            'address_line' => $this->address_line,
            'address_line_stat' => $this->address_line_stat,
            'source' => $this->source,
            'employee_count' => $this->employee_count,
            'has_cash_register' => $this->has_cash_register,
            'cash_register_count' => $this->cash_register_count,
            'has_payment_terminal' => $this->has_payment_terminal,
            'need_to_contact' => $this->need_to_contact,
            'refused_to_provide_identification_number' => $this->refused_to_provide_identification_number,
            'identification_number_not_found_in_stat' => $this->identification_number_not_found_in_stat,
            'status' => $this->status,
            'status_changed' => $this->status_changed,
            'created' => $this->created,
            'modified' => $this->modified,
            'location_long' => $this->location_long,
            'location_lat' => $this->location_lat,
            'mio_id' => $this->mio_id,
            'distributor_id' => $this->distributor_id,
            'last_call_date' => $this->last_call_date,
            'organization' => new DistributorOrganizationResource($this->organization),
            'district' => new DictResource($this->district),
            'region' => new DictResource($this->region),
            'city' => new DictResource($this->city),
            'appeals_list' => AppealShortResource::collection($this->appeals)
        ];

    }
}
