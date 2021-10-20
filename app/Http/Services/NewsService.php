<?php

namespace App\Http\Services;

use App\Models\News;

class NewsService 
{
    /**
     * Show one Article by id
     *
     * @param integer $id
     * @return array
     */
    public static function getArticle(int $id): array
    {
        $news = News::where([
            ['active', 1],
            ['id', $id]
        ])->first();
        return $news->toArray();
    }
    /**
     * common request method
     *
     * @param array $params
     * @param array $where
     * @return array
     */
    private static function get(array $params, array $where): array { 
        $count = (empty($params['count']) ? 30 : $params['count']);
        $order = (empty($params['order']) ? 'desc' : $params['order']);
        $news = News::where($where)
                    ->offset($count * ($params['page'] - 1))
                    ->limit($count)
                    ->orderBy('id', $order)
                    ->get();
        return $news->toArray();
    }    
    
    /**
     * Show list without filters
     *
     * @param array $params
     * @return array
     */
    public static function getList(array $params): array { 
        return self::get(
                $params,
                [
                    ['active', 1]
                ]
                );
    }

    /**
     * Search articles by author
     *
     * @param array $params
     * @param integer $authorId
     * @return array
     */
    public static function getListByAuthor(array $params, int $authorId): array {
        return self::get(
            $params,
            [
                ['author_id', $authorId],
                ['active', 1]
            ]
        );
    }

    /**
     * Search articles
     *
     * @param array $params
     * @return array
     */
    public static function getListBySearch(array $params): array {
        return self::get(
            $params,
            [
                ['active', '=', 1],
                ['title', 'like', '%' . $params['search'] . '%']
            ]
        );
    }
}

