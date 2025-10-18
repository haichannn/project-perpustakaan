<?php

namespace Tests\Feature;

use PHPUnit\Framework\Attributes\Group;
use Tests\TestCase;

#[Group("AlertComponent")]
class AlertComponentTest extends TestCase
{

    public function test_it_renders_alert_component_with_message_and_type()
    {
        $view = $this->blade('<x-alert type="success" message="Operation completed successfully!" />');

        $view->assertSee('Operation completed successfully!');
        $view->assertSee('alert-success');
    }


    public function test_it_renders_alert_component_with_default_type()
    {
        $view = $this->blade('<x-alert message="This is an info alert." />');

        $view->assertSee('This is an info alert.');
        $view->assertSee('alert-info');
    }

    public function test_it_renders_alert_component_with_different_types()
    {
        $types = ['success', 'error', 'warning', 'info'];

        foreach ($types as $type) {
            $view = $this->blade("<x-alert type=\"{$type}\" message=\"This is a {$type} alert.\" />");

            $view->assertSee("This is a {$type} alert.");
            $view->assertSee("alert-{$type}");
        }
    }

    public function test_it_renders_alert_component_without_message()
    {
        $view = $this->blade('<x-alert type="warning" />');

        $view->assertSee('alert-warning');
        $view->assertDontSee('This is a warning alert.');
    }

}
