<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class AuthorsTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    /** @test */
    public function it_show_all_authors_resource()
    {
        $author1 = factory('App\Author')->create();
        $author2 = factory('App\Author')->create();

        $this->json('GET', '/api/authors')
             ->seeJson($author1->toArray())
             ->seeJson($author2->toArray())
             ->assertResponseStatus(200);
    }

    /** @test */
    public function it_show_single_author()
    {
        $author1 = factory('App\Author')->create();
        $author2 = factory('App\Author')->create();

        $this->json('GET', '/api/authors/' . $author1->id)
             ->seeJson($author1->toArray())
             ->dontSeeJson(['id' => $author2->id])
             ->assertResponseStatus(200);
    }

    /** @test */
    public function it_can_store_new_author()
    {
        $author = [
            'name' => 'Aditia',
            'email' => 'aditia.pikarin@gmail.com',
            'github' => 'pikarin',
            'twitter' => 'AditiaPikarin',
            'location' => 'Indonesia',
            'latest_article_published' => 'Developing RESTful APIs with Lumen',
        ];

        $this->json('POST', '/api/authors', $author)
            ->seeJson($author)
            ->assertResponseStatus(201);

        $this->seeInDatabase('authors', [
            'name' => 'Aditia',
            'email' => 'aditia.pikarin@gmail.com',
        ]);
    }

    /** @test */
    public function it_can_update_existing_author()
    {
        $author = factory('App\Author')->create([
            'email' => 'mamen@mamen.com',
            'location' => 'Nowhere',
        ]);

        $this->seeInDatabase('authors', [
            'email' => 'mamen@mamen.com',
            'location' => 'Nowhere',
        ]);

        $this->json('PUT', '/api/authors/' . $author->id, [
            'email' => 'aditia.pikarin@gmail.com',
            'location' => 'Indonesia',
        ])
        ->seeJson([
            'id' => $author->id,
            'email' => 'aditia.pikarin@gmail.com',
            'location' => 'Indonesia',
        ])
        ->assertResponseStatus(200);

        $this->notSeeInDatabase('authors', [
            'email' => 'mamen@mamen.com',
            'location' => 'Nowhere',
        ]);
    }

    /** @test */
    public function it_can_delete_existing_author()
    {
        $author = factory('App\Author')->create();

        $this->json('DELETE', '/api/authors/' . $author->id)
             ->seeJson(['Deleted Successfully'])
             ->assertResponseStatus(200);

        $this->notSeeInDatabase('authors', [
            'id' => $author->id,
            'name' => $author->name,
            'email' => $author->email,
        ]);
    }
}
