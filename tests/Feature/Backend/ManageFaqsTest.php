<?php

namespace Tests\Feature\Backend;

use App\Models\Faqs\Faq;
use Tests\TestCase;

class ManageFaqsTest extends TestCase
{
    /** @test */
    public function a_user_can_view_faqs_index_page()
    {
        $this->actingAs($this->admin)
            ->get(route('admin.faqs.index'))
            ->assertViewIs('backend.faqs.index')
            ->assertSee(trans('labels.backend.faqs.management'))
            ->assertSee(trans('labels.backend.faqs.table.question'))
            ->assertSee(trans('labels.backend.faqs.table.answer'))
            ->assertSee(trans('labels.backend.faqs.table.status'))
            ->assertSee('Action');
    }

    /** @test */
    public function a_user_can_create_faq()
    {
        $faq = make(Faq::class);

        $this->actingAs($this->admin)
            ->post(route('admin.faqs.store'), $faq->toArray());

        $this->assertDatabaseHas(config('module.faqs.table'), ['question' => $faq->question, 'answer' => $faq->answer]);
    }

    /** @test */
    public function it_requires_question_while_creating()
    {
        $faq = make(Faq::class, ['question' => '']);

        $this->actingAs($this->admin)
            ->withExceptionHandling()
            ->post(route('admin.faqs.store'), $faq->toArray())
            ->assertSessionHasErrors('question');
    }

    /** @test */
    public function it_requires_answer_while_creating()
    {
        $faq = make(Faq::class, ['answer' => '']);

        $this->actingAs($this->admin)
            ->withExceptionHandling()
            ->post(route('admin.faqs.store'), $faq->toArray())
            ->assertSessionHasErrors('answer');
    }

    /** @test */
    public function it_requires_question_while_updating()
    {
        $faq = create(Faq::class);

        $this->actingAs($this->admin)
            ->withExceptionHandling()
            ->patch(route('admin.faqs.update', $faq), ['question' => '', 'answer' => $faq->answer])
            ->assertSessionHasErrors('question');
    }

    /** @test */
    public function it_requires_answer_while_updating()
    {
        $faq = create(Faq::class);

        $this->actingAs($this->admin)
            ->withExceptionHandling()
            ->patch(route('admin.faqs.update', $faq), ['question' => $faq->question, 'answer' => ''])
            ->assertSessionHasErrors('answer');
    }

    /** @test */
    public function a_user_can_update_faq()
    {
        $faq = create(Faq::class);

        $changed_question = 'What is Life?';
        $changed_answer = $faq->answer;
        $this->actingAs($this->admin)
            ->patch(route('admin.faqs.update', $faq), ['question' => $changed_question, 'answer' => $changed_answer]);

        $this->assertDatabaseHas(config('module.faqs.table'), ['id' => $faq->id, 'question' => $changed_question, 'answer' => $changed_answer]);
    }

    /** @test */
    public function a_user_can_delete_faq()
    {
        $faq = create(Faq::class);

        $this->actingAs($this->admin)
            ->delete(route('admin.faqs.destroy', $faq));

        $this->assertDatabaseMissing(config('module.faqs.table'), ['id' => $faq->id, 'deleted_at' => null]);
    }
}
