<?php

namespace Tests\Feature\Core;

use Illuminate\Support\Facades\Blade;
use Tests\TestCase;

class BadgeTest extends TestCase
{
    public function test_badge_colors_follow_palette(): void
    {
        $html = Blade::render('<x-badge status="diproses" /><x-badge status="dibatalkan" />');
        $this->assertStringContainsString('#FCEFD6', $html);
        $this->assertStringContainsString('#8E1F14', $html);
    }
}
