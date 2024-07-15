<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    public function testStoreApiCategory()
    {
        $categoryData = [
            'name' => fake()->name()
        ];

        $response = $this->post('/api/categories', $categoryData);

        $response->assertStatus(201);

        $this->assertDatabaseHas('categories', [
            'name' => $categoryData['name'],
        ]);
    }


    public function testUpdateApiCategory()
    {
        $category = Category::factory()->create();

        $newData = [
            'name' => fake()->name()
        ];

        $response = $this->put('/api/categories/'.$category->id, $newData);

        $response->assertStatus(200);

        $this->assertDatabaseHas(
            'categories',
            [
                'id' => $category->id,
                'name' => $newData['name']
            ]
        );
    }
}
