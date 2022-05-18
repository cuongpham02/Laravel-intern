<?php

namespace App\Exports;

use App\Models\Post;
use Date;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class PostExport implements 
    FromQuery,
    ShouldAutoSize,
    WithMapping,
    WithHeadings,
    WithColumnWidths
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct(int $id)
    {
        $this->id = $id;
    }
    public function query()
    {
        return Post::query()->with('category')->where('id',$this->id);
    }
    public function map($post): array
    {
        return[
            $post->id,
            $post->title,
            $post->content,
            $post->category->name,
            $post->created_at
        ];
    }
     public function headings(): array
    {
        return [
            '#',
            'Title',
            'Content',
            'Category',
            'Created',
        ];
    }
    public function columnWidths(): array
    {
        return [
            'A' => 8,
            'B' => 35,            
            'C' => 120,           
            'D' => 15,         
            'E' => 25,         
        ];
    }
}
