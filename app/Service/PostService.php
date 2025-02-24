<?php

namespace App\Service;

use App\Models\Post;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PostService
{
    public function store($data)
    {
        try {
            Db::beginTransaction();
            if (isset($data['tag_ids'])) {
                $tagIds = $data['tag_ids'];
                unset($data['tag_ids']);
            }

            $data['preview_image'] = Storage::disk('public')->put('/images', $data['preview_image']);
            $data['main_image'] = Storage::disk('public')->put('/images', $data['main_image']);
            $data['user_id'] = auth()->id();
            $post = Post::firstOrCreate($data);
            if (isset($tagIds)) {
                $post->tags()->attach($tagIds);
            }
            Db::commit();
        } catch (Exception $exception) {
            abort(500);
        }
    }

    public function update($data, $post)
    {
        try {
            Db::beginTransaction();
            if (isset($data['tag_ids'])) {
                $tagIds = $data['tag_ids'];
                unset($data['tag_ids']);
            }

            // Если загружена новая превью-картинка, удаляем старую
            if (isset($data['preview_image'])) {
                if ($post->preview_image) {
                    Storage::disk('public')->delete($post->preview_image);
                }
                $data['preview_image'] = Storage::disk('public')->put('/images', $data['preview_image']);
            }

            // Аналогично для основной картинки
            if (isset($data['main_image'])) {
                if ($post->main_image) {
                    Storage::disk('public')->delete($post->main_image);
                }
                $data['main_image'] = Storage::disk('public')->put('/images', $data['main_image']);
            }

            $post->update($data);
            if (isset($tagIds)) {
                $post->tags()->sync($tagIds);
            }
            Db::commit();
        } catch (Exception $exception) {
            Db::rollBack();
            abort(500);
        }

        return $post;
    }

    public function destroy(Post $post)
    {
        try {
            DB::beginTransaction();

            // Удаляем файлы, если они существуют
            if ($post->preview_image) {
                Storage::disk('public')->delete($post->preview_image);
            }
            if ($post->main_image) {
                Storage::disk('public')->delete($post->main_image);
            }

            // Удаляем сам пост
            $post->delete();

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            abort(500);
        }
    }
}
