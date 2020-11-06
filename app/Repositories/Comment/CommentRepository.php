<?php

namespace App\Repositories\Comment;

use App\Models\Entities\Comment;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class CommentRepository implements CommentInterface
{
    protected $model;

    public function __construct(Comment $item)
    {
        $this->model = $item;
    }

    /**
     * retrieves the Comment by id
     *
     * @param  int $itemId
     * @return int
     */
    public function getById(int $itemId)
    {
        return $this->model->find($itemId);
    }

    /**
     * creates a new item with the given data
     *
     * @param array $itemData
     * @return Model
     */
    public function saveItem(array $itemData)
    {
        $model = $this->model->create($itemData);
   
        $model->events()->attach([$itemData['event_id']]);
    
        return $model;
    }

    /**
     * Edit item
     *
     * @param Comment $item
     * @param array $itemData
     * @return bool
     */
    public function editItem(Comment $item, array $itemData)
    {
        return $item->update($itemData);
    }

    /**
     * @param Comment $item
     * @return bool|null
     * @throws \Exception
     */
    public function deleteItem(Comment $item)
    {
        return $item->delete();
    }

    /**
     * Get all active items
     *
     * @return mixed
     */
    public function getActiveItemsLatestFirst() {
        return $this->model
            ->where('is_active', 1)
            ->orderBy('created_at', 'DESC')
            ->get()
        ;
    }

       /**
     * Get all active items by event
     *
     * @return mixed
     */
    public function getActiveItemsByEvent($event) {
        return $this->model->with(['events' => function($query) use ($event){
                $query->wherePivot('event_id', $event);
            }])
            ->where('is_active', 1)
            ->get()
        ;
    }

    /**
     * Change the active status
     *
     * @param Comment $item
     * @return bool
     */
    public function updateActiveStatus(Comment $item)
    {
        return $item->update(['is_active' => !$item->is_active]);
    }

}
