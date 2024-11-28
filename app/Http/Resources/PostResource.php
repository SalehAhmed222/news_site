<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [
            'post_id'=>$this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'desc' => $this->desc,
            'num_of_views' => $this->num_of_views,
            'status' => $this->status(),
            'publiser' => $this->user_id == null ? new AdminResource($this->admin) : new UserResource($this->user),
            'created_date' => $this->created_at->format('y-m-d h:m a'),
            'media'=> ImageResource::collection($this->images),
            'category_name'=>$this->category->name,
        ];
        if ($request->is('api/posts/show/*')) {
            $data['small_desc'] = $this->small_desc;
            $data['comment_able'] = $this->comment_able == 1 ? 'active' : 'notactive';
            $data['category_name'] = new CategoryResource($this->category);
            // $data['comments'] = new CommentCollection($this->comments);

        }
        return $data;
    }
}
