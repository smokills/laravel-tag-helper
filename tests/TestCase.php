<?php

namespace BeyondCode\TagHelper\Tests;

use BeyondCode\TagHelper\TagHelper;
use Spatie\Snapshots\MatchesSnapshots;
use Illuminate\Support\Facades\Artisan;
use Orchestra\Testbench\TestCase as Orchestra;
use BeyondCode\TagHelper\TagHelperServiceProvider;

abstract class TestCase extends Orchestra
{
    use MatchesSnapshots;

    protected function setUp()
    {
        parent::setUp();

        Artisan::call('view:clear');
    }

    protected function getPackageProviders($app)
    {
        return [
            TagHelperServiceProvider::class,
        ];
    }

    protected function getPackageAliases($app)
    {
        return [
            'TagHelper' => TagHelper::class,
        ];
    }

    protected function assertMatchesViewSnapshot(string $viewName, array $data = [])
    {
        $fullViewName = "views.{$viewName}";

        $this->assertMatchesXmlSnapshot(
            view($fullViewName, $data)->render()
        );
    }

    protected function assertPhpMatchesViewSnapshot(string $viewName, array $data = [])
    {
        $fullViewName = "views.{$viewName}";

        $this->assertMatchesSnapshot(
            view($fullViewName, $data)->render()
        );
    }
}
