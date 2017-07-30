<?php
namespace Flarum\Core\Search\Discussion\Fulltext;

use Flarum\Core\Post;
use Flarum\Core\Discussion;
use Flarum\Core\Search\Discussion\Fulltext\DriverInterface;

class MySqlDiscussionTitleDriver implements DriverInterface
{
    /**
     * {@inheritdoc}
     */
    public function match($string)
    {
        $discussionIds = Discussion::whereRaw("is_approved = 1 AND title LIKE '%$string%'")
            ->orderBy('id', 'desc')
            ->limit(50)
            ->lists('id','start_post_id');
        $relevantPostIds = [];
        foreach ($discussionIds as $postId => $discussionId) {
            $relevantPostIds[$discussionId][] = $postId;
        }
        
        $discussionIds = Post::where('type', 'comment')
            ->where('content', 'like', "%$string%")
            ->limit(50)
            ->lists('discussion_id', 'id');

        $relevantPostIds = [];

        foreach ($discussionIds as $postId => $discussionId) {
            $relevantPostIds[$discussionId][] = $postId;
        }
        
        return $relevantPostIds;
    }
}