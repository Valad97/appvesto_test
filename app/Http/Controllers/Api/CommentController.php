<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Services\Comment\CommentFacade;

class CommentController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = CommentFacade::getActiveItemsLatestFirst();
        if($items->count())
            return $this->success($items);

        return $this->error('COMMENT_ERRORS', 'NO_COMMENTS');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $item = CommentFacade::save($request->all());
 
        if($item)
            return $this->success($item);

        return $this->error('COMMENT_ERRORS', 'NO_SAVE_COMMENTS');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( $comment)
    {
        $comment = CommentFacade::get($comment);
       
        if(!$comment || !$comment->is_active)
            return $this->error('COMMENT_ERRORS', 'COMMENT_NOT_FOUND');

        return $this->success($event);
    }

     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function all_by_event( $event)
    {
        $items = CommentFacade::getActiveItemsByEvent($event);
        if($items->count())
            return $this->success($items);

        return $this->error('COMMENT_ERRORS', 'NO_COMMENTS');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $comment)
    {
        // Task update only status
        $comment = CommentFacade::updateActiveStatus(CommentFacade::get($comment));
   
        if(!$comment)
            return $this->error('COMMENT_ERRORS', 'NO_UPDATE_COMMENTS');

        return $this->success($comment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($comment)
    {
        $comment = CommentFacade::delete(CommentFacade::get($comment));

        if(!$comment)
            return $this->error('COMMENT_ERRORS', 'NO_DELETE_COMMENTS');

        return $this->success($comment);
    }
}
