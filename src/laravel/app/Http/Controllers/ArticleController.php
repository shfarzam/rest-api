<?php

namespace App\Http\Controllers;

use App\Models\NewsArticle;
use App\Http\Resources\NewsArticleResource;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;



class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // show all Data
        //Here we could use Cache too
        // We could with Observer handel the Caching state (on Create clear the Cache)
        /**
         * $result = Cache::remember('list', 60*60*24, function () {
         *   $news_articles = NewsArticle::select('id', 'title', 'author', 'creation_date', 'publication_date', 'expiration_date')
         *   ->where('expiration_date', '>=', Carbon::today())
         *  ->get();
         *   return NewsArticleResource::collection($news_articles);
         *   });
         * 
         */
        $perPage = $request->query('perPage', 5);
        $news_articles = NewsArticle::select('id', 'title', 'author', 'creation_date', 'publication_date', 'expiration_date')
        ->where('expiration_date', '>=', Carbon::today())
        ->paginate($perPage);
        
        $articles = $news_articles->map(function ($article) {
            $age = $this->getAuthorAge($article->author);
            $article->age = $age;
    
            return $article;
        });

        return NewsArticleResource::collection($articles);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validate Input Parameter
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'author' => 'required|string|max:255',
            'text' => 'required|max:500',
            'creation_date' => 'required|date',
            'publication_date' => 'required|date'
        ]);
    
        // insert into Table
        $article = NewsArticle::create($validatedData);
    
        return response()->json($article, 201);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $news_article = NewsArticle::findOrFail($id);

        $age = $this->getAuthorAge($news_article->author);
        $news_article->age = $age;

        return new NewsArticleResource($news_article);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $article = NewsArticle::findOrFail($id);  
         
        $validatedData = $request->validate([
            'title' => 'nullable|max:255',
            'author' => 'nullable|string|max:255',
            'text' => 'nullable|max:500',
            'creation_date' => 'nullable|date',
            'publication_date' => 'nullable|date'
        ]);

        $article->update($validatedData);

        //$updatedArticle = NewsArticle::findOrFail($id);

        return response()->json($article);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        //
        $article = NewsArticle::findOrFail($id);

        $article->delete();

        return response()->json([
            'message' => 'Article deleted successfully.',
        ]);
    }


    /**
     * get Author age from a extern API
     */
    private function getAuthorAge(string $author)
    {
        // Extract the first name from the author string
        $authorName = explode(' ', $author)[0];

        $cacheKey = 'author_age_' . $authorName;
        $cacheDuration = 60 * 24; // Cache for 24 hours

        // Check if the result is cached
        $age = Cache::get($cacheKey);

        if ($age !== null) {
            return $age;
        }


        try {

            // Build the URL for the Agify API and Call It
            $response = Http::timeout(5)->retry(3, 100)->get(env('AGIFY_API_URL'), [
                'name' => $authorName,
            ]);
    
            if ($response->ok()) {
                $age = $response->json('age');
                // Cache the result
                Cache::put($cacheKey, $age, $cacheDuration);
                return $age;
            }
    
            throw new Exception('Failed to get age for author ' . $authorName);
        } catch (Exception $e) {
            // Log the error and return null
            Log::error($e->getMessage());
            return null;
        }
    }

}
