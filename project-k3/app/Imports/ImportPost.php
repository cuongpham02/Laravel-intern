<?php

namespace App\Imports;

use App\Models\Post;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithValidation;
use App\Models\Category;

class ImportPost implements 
    ToModel,
    WithHeadingRow,
    WithChunkReading,
    WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        DB::beginTransaction();
        try {
            Post::updateOrCreate([
                'title' => $row['title'],
                'content' => $row['content'],
                'category_id' => Category::where('name',$row['category'])->pluck('id')->first(),
                'created_at' => $row['created'],
                'status' => $row['status'],
            ]);
            DB::commit();
        } catch (Exceptions $e) {
            DB::rollBack();
            Log::debug($e);
        }
    }
    public function chunkSize(): int
    {
      return 100;
    }
    public function rules(): array
    {
        return [
            'title' => [
                'required',
                'unique:posts,title',
                'max:150',
            ],
            'content' => [
                'required',
            ],
            'category' => [
                'required',
            ],
            'status' => [
                'numeric',
                'required',
            ],
        ];
    }
    public function customValidationMessages()
    {
        return [
            'category.required' => 'category is empty',
            'title.max' => 'title max 150 character',
            'title.required' => 'title is empty',
            'title.unique' => 'title is unique',
            'content.required' => 'content is empty',
            'status.required' => 'status is empty',
            'status.numeric' => 'status is number',

        ];
    }
}
