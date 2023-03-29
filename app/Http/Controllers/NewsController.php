<?php
namespace App\Http\Controllers;

use App\Repositories\INewsCategoryRepository;
use App\Repositories\INewsRepository;
use App\Repositories\IServiceGroupRepository;

class NewsController extends Controller
{
    private $newsCategoryRepository;
    private $newsRepository;

    public function __construct(INewsCategoryRepository $newsCategoryRepository, INewsRepository $newsRepository)
    {
        $this->newsCategoryRepository = $newsCategoryRepository;
        $this->newsRepository = $newsRepository;
    }

    public function index($newsCategoryCode = null)
    {
        $newsCategoryId = null;
        if($newsCategoryCode) {
            $newsCategoryId = optional($this->newsCategoryRepository->findByCode($newsCategoryCode))->id;
        }
        $newsList = $this->newsRepository->getByCategory($newsCategoryId);

        $newsCategoryList = $this->newsCategoryRepository->all();
        return view('client.news.index')
            ->with('newsCategoryList', $newsCategoryList)
            ->with('newsList', $newsList);
    }

    public function show($newsCode)
    {
        $news = $this->newsRepository->findByCode($newsCode);
        if(is_null($news)){
            abort(404);
        }
        $recommendedNewsList = $this->newsRepository->getTop(3);

        return view('client.news.show')
            ->with('news', $news)
            ->with('recommendedNewsList', $recommendedNewsList);
    }
}
