<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NewsArticleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [
            'id' => $this->id,
            'title' => $this->title,
            'author' => $this->author,
            'creation_date' => $this->creation_date,
            'publication_date' => $this->publication_date,
            'age' => $this->age,
        ];

        // Only include the text field for the "show" endpoint
        if ($request->route()->getName() == 'news_articles.show') {
            $data['text'] = $this->text;
        }

        return $data;
    }
}
