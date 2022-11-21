<?php

namespace App\Services;

use App\Models\Post;
use Exception;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PostService
{
    public function getAll($pageSize)
    {
        return Post::orderByDesc('updated_at')->with('person.user')->paginate($pageSize);
    }

    public function getForCurrentPerson()
    {
        return Post::where('person_id', Auth::user()->person->id)->orderByDesc('updated_at')->get();
    }

    public function get($id)
    {
        return Post::where('id', $id)->first();
    }

    public function update($id, $fields)
    {
        Post::find($id)->update($fields);
    }

    public function delete($id)
    {
        Post::find($id)->delete();
    }

    public function create($fields)
    {
        $fields['person_id'] = Auth::user()->person->id;

        return Post::create($fields);
    }

    public function like($id)
    {
        $post = Post::find($id);

        if ($post->likedPeople()->find(Auth::user()->person->id)) {
            return;
        }

        DB::beginTransaction();

        try {
            $post->likedPeople()->attach(Auth::user()->person->id);

            $post->likes++;
            $post->timestamps = false;
            $post->save();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }
    }

    public function unlike($id)
    {
        $post = Post::find($id);

        if (! $post->likedPeople()->find(Auth::user()->person->id)) {
            return;
        }

        DB::beginTransaction();

        try {
            $post->likedPeople()->detach(Auth::user()->person->id);

            $post->likes--;
            $post->timestamps = false;
            $post->save();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }
    }

    private function deletePicturePath(string $path)
    {
        if (! Storage::exists($path)) {
            throw new Exception('Picture not found');
        }

        if (! Storage::delete($path)) {
            throw new Exception('The picture could not be deleted from storage');
        }
    }

    public function getPicturePath($id)
    {
        $filename = Post::find($id)->picture;

        if ($filename != null) {
            return Storage::path('private/pictures/'.$filename);
        }

        return null;
    }

    public function savePicture($id, UploadedFile $file)
    {
        $post = Post::find($id);

        if ($post->picture != null) {
            $this->deletePicturePath('private/pictures/'.$post->picture);

            $post->picture = null;
            $post->save();
        }

        $filename = Storage::putFile('private/pictures/', $file);

        if ($filename === false) {
            throw new Exception('The picture could not be saved to storage correctly');
        }

        $dir = explode('/', $filename);

        $post->picture = end($dir);
        $post->save();
    }

    public function existsPicture($id)
    {
        $filename = Post::find($id)->picture;

        if ($filename != null) {
            if (Storage::exists('private/pictures/'.$filename)) {
                return true;
            }
            throw new Exception('The picture could not be found in the storage');
        }

        return false;
    }

    public function deletePicture($id)
    {
        $post = Post::find($id);

        $this->deletePicturePath('private/pictures/'.$post->picture);

        $post->picture = null;
        $post->save();
    }
}
