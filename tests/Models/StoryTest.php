<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Otomaties\PluginBoilerplate\Models\Story;

final class StoryTest extends TestCase
{
    public function testCanBeCreatedFromString(): void
    {
        $this->assertInstanceOf(
            Story::class,
            new Story(420)
        );
    }

    public function testPostTypeIsCorrect(): void
    {
        $this->assertEquals(
            'story',
            Story::postType()
        );
    }
}
