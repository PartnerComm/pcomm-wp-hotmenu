<?php
namespace PComm\WP\Plugins;

use Mockery as m;

require_once('./HotMenu.php');

function add_shortcode(...$entry)
{
  return true;
}
function add_action(...$entry)
{
  return true;
}
function term_exists($term, $tax)
{
  $ignores = [
    'base-link',
    'ul-class',
    'order-by',
    'order'
  ];
  if (in_array($term, $ignores)) {
    return false;
  }
  return true;
}


class HotMenuTest extends \PHPUnit\Framework\TestCase {
  public function testItWorks() 
  {
    $this->assertEquals(true, true);
  }
  public function testInitWorksWithoutError()
  {
    $hotmenu = new HotMenu();
    $this->assertEquals($hotmenu->init(), $hotmenu);
  }
  public function testUlClassWorks()
  {
    $expectedClass = "fooClass";

    $wpQuery = m::mock('overload:WP_Query');
    $wpQuery->shouldReceive('have_posts')
            ->once()
            ->andReturn(false);
    // $externalMock->shouldReceive('getSomething')
    //     ->once()
    //     ->andReturn('Tested!');


    $hotmenu = new HotMenu();
    $results = $hotmenu->doShortcode(["ul-class" => $expectedClass]);
    $this->assertRegexp('/'.$expectedClass.'/', $results);
  }
    // public function testWPPostLoads()
    // {
    //     $mockWP = $this->getMockWPPost();
    //     $post = new Post($mockWP);
    //     $this->assertEquals(999, $post->getPostID());
    //     $this->assertEquals('test title', $post->getPostTitle());
    //     $this->assertEquals('test excerpt', $post->getPostExcerpt());
    //     $this->assertEquals(0, $post->getMenuOrder());
    //     $this->assertEquals('test', $post->getPostType());
    // }
    // private function getMockWPPost()
    // {
    //     $mockWP = $this->getMockBuilder('\WP_Post')
    //         ->getMock();
    //     $mockWP->ID = 999;
    //     $mockWP->post_title = 'test title';
    //     $mockWP->post_excerpt = 'test excerpt';
    //     $mockWP->post_content = 'test content';
    //     $mockWP->menu_order = 0;
    //     $mockWP->post_type = 'test';
    //     return $mockWP;
    // }
}