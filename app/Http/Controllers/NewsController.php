<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewsCreateRequest;
use App\Http\Requests\NewsUpdateRequest;
use App\Http\Resources\NewsResource;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Inertia\Inertia;

class NewsController extends Controller
{
    public function list(Request $request)
    {
        $articles = Article::paginate(10);

        if (Str::startsWith($request->route()->getPrefix(),'api')){
            return NewsResource::collection($articles);
        }
        else{
            return Inertia::render('News', ['news' => $articles]);
        }
    }

    public function get(Request $request, $id)
    {
        if ($id === 'create' and auth()->user()){
            return Inertia::render('ArticleForm', ['create' => true]);
        }
        $article = Article::where(['id' => $id])->first();

        if (!$article){
            if (Str::startsWith($request->route()->getPrefix(),'api')){
                return response()->json(['status' => 'not found'], 404);
            }
            else{
                $request->session()->flash('type', 'danger');
                $request->session()->flash('title', 'ERROR:');
                $request->session()->flash('message', 'Article not found');
                return redirect()->route('news.list');
            }
        }

        if (Str::startsWith($request->route()->getPrefix(),'api')){
            return new NewsResource($article);
        }
        else{
            return Inertia::render('ArticleDetail', ['article' => new NewsResource($article)]);
        }
    }

    public function edit(Request $request, $id){
        $article = Article::where([
            'author_id' => auth()->id(),
            'id' => $id
        ])->first();

        if (!$article){
            $request->session()->flash('type', 'danger');
            $request->session()->flash('title', 'ERROR:');
            $request->session()->flash('message', 'Article not found');
            return redirect()->route('news.list');
        }

        return Inertia::render('ArticleForm', ['create' => false, 'article' => new NewsResource($article)]);
    }

    public function update(NewsUpdateRequest $request, $id)
    {
        $article = Article::where([
            'author_id' => auth()->id(),
            'id' => $id
        ])->first();

        if (!$article){
            if (Str::startsWith($request->route()->getPrefix(),'api')){
                return response()->json(['status' => 'not found'], 404);
            }
            else{
                $request->session()->flash('type', 'danger');
                $request->session()->flash('title', 'ERROR:');
                $request->session()->flash('message', 'Article not found');
                return redirect()->route('news.list');
            }
        }
        $allowedKeys = ['title', 'content'];
        $updateFields = $request->only($allowedKeys);
        if ($request->hasFile('image')){
            //handle image
            $image = $request->file('image');
            $fileContent = $image->getContent();
            $newFilename = $article->id.'.'.$image->getClientOriginalExtension();
            //save image
            $savePathname = 'images/news/'.$newFilename;
            Storage::disk('local')->put($savePathname, $fileContent);
            $updateFields['image'] = env('APP_URL').'/'.$savePathname;
        }

        $article->update($updateFields);

        if (Str::startsWith($request->route()->getPrefix(),'api')){
            return response()->json(['status' => 'success']);
        }
        else{
            $request->session()->flash('type', 'success');
            $request->session()->flash('title', 'SUCCESS:');
            $request->session()->flash('message', 'Article updated successfully');
            return redirect()->route('news.get', ['id' => $article->id]);
        }
    }

    public function create(NewsCreateRequest $request)
    {
        $user = auth()->user();
        $allowedKeys = ['title', 'content'];
        $fields = $request->only($allowedKeys);
        $fields['author_id'] = $user->id;
        $article = Article::create($fields);

        //currently pass the image uploading
        $mockImage = true;
        if ($request->hasFile('image') && !$mockImage){
            //handle image
            $image = $request->file('image');
            $fileContent = $image->getContent();
            $newFilename = $article->id.'.'.$image->getClientOriginalExtension();
            //save image
            $savePathname = 'images/news/'.$newFilename;
            Storage::disk('local')->put($savePathname, $fileContent);
            $article->update(['image' => env('APP_URL').'/'.$savePathname]);
        }
        if ($mockImage){
            $article->update(['image' => env('APP_URL').'/images/news/'.$article->id.'.jpg']);
        }

        if (Str::startsWith($request->route()->getPrefix(),'api')){
            return response()->json(['status' => 'success'], 201);
        }
        else{
            return redirect()->route('news.get', ['id' => $article->id]);
        }
    }

    public function delete(Request $request, $id)
    {
        $user = auth()->user();
        $article = Article::where(['id' => $id, 'author_id' => $user->id])->first();
        if (!$article){
            if (Str::startsWith($request->route()->getPrefix(),'api')){
                return response()->json(['status' => 'not found'], 404);
            }
            else{
                $request->session()->flash('type', 'danger');
                $request->session()->flash('title', 'ERROR:');
                $request->session()->flash('message', 'Article not found');
                return redirect()->back();
            }
        }
        $article->delete();
        if (Str::startsWith($request->route()->getPrefix(),'api')){
            return response()->json(['status' => 'success']);
        }
        else{
            $request->session()->flash('type', 'success');
            $request->session()->flash('title', 'SUCCESS:');
            $request->session()->flash('message', 'Article deleted successfully');
            return redirect()->route('users.get', ['id' => $user->id]);
        }

    }
}
