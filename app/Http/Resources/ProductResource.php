<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * இந்த மெத்தட் ஒரு array ஆக product தகவல்களை மாற்றுகிறது.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // parent::toArray($request); இது முழு data return செய்யும். கீழே custom data return செய்கிறோம்.
        return[
            'id' => $this->id, // தயாரிப்பு ID
            'product_name' => $this->name, // தயாரிப்பு பெயர்
            'description' => $this->description, // தயாரிப்பு விளக்கம்
            'price' => $this->price, // தயாரிப்பு விலை
            'created_at' => $this->created_at, // இங்கு 'name' என்பதை 'created_at' க்கு map பண்ணியிருக்கீங்க, இது தவறு.
        ];
    }
}
