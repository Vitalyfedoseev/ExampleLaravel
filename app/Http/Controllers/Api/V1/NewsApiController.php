<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Services\NewsService;
use App\Http\Traits\RequestHandlers;

class NewsApiController extends Controller
{
    use RequestHandlers;

    // Request parameters
    private $newsParams = [
        ['order', 'string', ['asc', 'desc']],
        ['count', 'int'],
        ['search', 'string']
    ];

    public function __construct()
    {
        $this->params = self::sanitiseRequest($this->newsParams);
    }

    /**
     * Request news by author
     *
     * @param integer $authorId
     * @param integer $page
     * @return \Illuminate\Http\Response
     */
    public function showByAuthor(int $authorId, int $page = 1)
    {
        $this->params['page'] = $page;
        return NewsService::getListByAuthor($this->params, $authorId);
    }

    /**
     * Show one article
     *
     * @param integer $id
     * @return \Illuminate\Http\Response
     */
    public function showArticle(int $id)
    {
        return NewsService::getArticle($id);
    }

    /**
     * Display news filtered by search word
     *
     * @param  string $type 
     * @param  int $page 
     * @return \Illuminate\Http\Response
     */
    public function showBySearch(int $page = 1)
    {
        $this->params['page'] = $page;
        return NewsService::getListBySearch($this->params);
    }
    
    /**
     * Display news list
     *
     * @param  int  $page
     * @return \Illuminate\Http\Response
     */
    public function show(int $page = 1)
    {
        $this->params['page'] = $page;
        return NewsService::getList($this->params);
    }
}
