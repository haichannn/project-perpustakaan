<?php

namespace Tests\Feature;

use PHPUnit\Framework\Attributes\Group;
use Tests\TestCase;

#[Group("InputComponent")]
class InputComponentTest extends TestCase
{

    /**
     * Testing input without errors
     * 0@return void
     */
    public function test_it_renders_input_component_without_errors()
    {
        $response = $this
            ->withViewErrors([])
            ->blade('<x-input name="title" type="text" value="Lorem ipsum" />');

        $response->assertSee('name="title"', false);
        $response->assertSee('id="title"', false);
        $response->assertSee('value="Lorem ipsum"', false);
        $response->assertSee('type="text"', false);
        $response->assertSee('form-control');
        $response->assertDontSee('is-invalid');
        $response->assertDontSee('min="0"');
        $response->assertDontSee('max="100"');
        $response->assertDontSee('invalid-feedback');
    }

    /**
     * Testing input component without class
     * @return void
     **/
    public function test_it_renders_input_component_without_class()
    {
        $response = $this
            ->withViewErrors([])
            ->blade('<x-input name="title" />');

        $response->assertSee('name="title"', false);
        $response->assertSee('id="title"', false);
        $response->assertSee('form-control');
        $response->assertDontSee('is-invalid');
    }

    /**
     * Testing input component with errors
     *
     * @return void
     **/
    public function test_it_renders_input_component_with_errors()
    {
        $response = $this
            ->withViewErrors([
                "title" => "Field this is required"
            ])
            ->blade("<x-input name=title />");

        $response->assertSee('name="title"', false);
        $response->assertSee('id="title"', false);
        $response->assertSee('is-invalid');
        $response->assertSee('form-control');
        $response->assertSee("Field this is required");
    }

    /**
     * Testing input with different types
     * @return void
     *
     **/
    public function test_it_renders_input_component_with_different_types()
    {
        $types = ['text', 'email', 'password', 'number', 'date'];

        foreach ($types as $type) {
            $response = $this
                ->withViewErrors([])
                ->blade("<x-input name=\"{$type}\" type=\"{$type}\" />");

            $response->assertSee("id=\"{$type}\"", false);
            $response->assertSee("name=\"{$type}\"", false);
            $response->assertSee("type=\"{$type}\"", false);
            $response->assertSee('form-control');
            $response->assertDontSee('is-invalid');
        }
    }

    /**
     * Testing input component with value
     * @return void
     *
     **/
    public function test_it_renders_input_component_with_value()
    {
        $response = $this
            ->withViewErrors([])
            ->blade('<x-input name="title" value="Test value"/>');

        $response->assertSee('name="title"', false);
        $response->assertSee('id="title"', false);
        $response->assertSee('value="Test value"', false);
        $response->assertSee('form-control');
        $response->assertDontSee('is-invalid');
    }

    /**
     * Testing input component with placeholder
     * @return void
     *
     **/
    public function test_it_renders_input_component_with_placeholder()
    {
        $response = $this
            ->withViewErrors([])
            ->blade('<x-input name="title" placeholder="Enter title here" />');

        $response->assertSee('name="title"', false);
        $response->assertSee('id="title"', false);
        $response->assertSee('placeholder="Enter title here"', false);
        $response->assertSee('form-control');
        $response->assertDontSee('is-invalid');
    }

    /**
     * Testing input component with label
     * @return void
     *
     **/
    public function test_it_renders_input_component_with_label()
    {
        $response = $this
            ->withViewErrors([])
            ->blade('<x-input name="title" label="Title" />');

        $response->assertSee('name="title"', false);
        $response->assertSee('id="title"', false);
        $response->assertSee('form-control');
        $response->assertDontSee('is-invalid');
        $response->assertSee('Title');
        $response->assertSee('<label for="title" class="form-label">Title</label>', false);
    }

    /**
     * Testing input show feedback invalid
     * @return void
     * **/
    public function test_it_renders_input_component_with_show_feedback_invalid()
    {
        $response = $this
            ->withViewErrors([
                'title' => "Max length exceeded",
            ])
            ->blade('<x-input name="title" />');

        $response->assertSee('name="title"', false);
        $response->assertSee('class="invalid-feedback"', false);
        $response->assertSee('Max length exceeded', false);
        $response->assertSee('is-invalid');
        $response->assertSee('form-control');
    }
    /**
     * Testing input component with required attribute
     * @return void
     *
     **/
    public function test_it_renders_input_component_with_required_attribute()
    {
        $response = $this
            ->withViewErrors([])
            ->blade('<x-input name="title" required />');

        $response->assertSee('name="title"', false);
        $response->assertSee('id="title"', false);
        $response->assertSee('required');
        $response->assertSee('form-control');
        $response->assertDontSee('is-invalid');
    }

    /**
     * Testing input component with disabled attribute
     * @return void
     *
     **/
    public function test_it_renders_input_component_with_disabled_attribute()
    {
        $response = $this
            ->withViewErrors([])
            ->blade('<x-input name="title" disabled />');

        $response->assertSee('name="title"', false);
        $response->assertSee('id="title"', false);
        $response->assertSee('disabled');
        $response->assertSee('form-control');
        $response->assertDontSee('is-invalid');
    }

    /**
     * Testing input component with min and max attributes
     * @return void
     *
     **/
    public function test_it_renders_input_component_with_min_and_max_attributes()
    {
        $response = $this
            ->withViewErrors([])
            ->blade('<x-input name="stock" type="number" min="1" max="1000" />');

        $response->assertSee('name="stock"', false);
        $response->assertSee('id="stock"', false);
        $response->assertSee('type="number"', false);
        $response->assertSee('min="1"', false);
        $response->assertSee('max="1000"', false);
        $response->assertSee('form-control');
        $response->assertDontSee('is-invalid');
    }
}
