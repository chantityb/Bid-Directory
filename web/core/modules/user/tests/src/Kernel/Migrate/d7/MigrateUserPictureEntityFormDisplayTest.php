<?php

declare(strict_types=1);

namespace Drupal\Tests\user\Kernel\Migrate\d7;

use Drupal\Core\Entity\Entity\EntityFormDisplay;
use Drupal\Tests\migrate_drupal\Kernel\d7\MigrateDrupal7TestBase;

/**
 * Tests migration of the user_picture field's entity form display settings.
 *
 * @group user
 */
class MigrateUserPictureEntityFormDisplayTest extends MigrateDrupal7TestBase {

  /**
   * {@inheritdoc}
   */
  protected static $modules = ['image', 'file'];

  /**
   * {@inheritdoc}
   */
  protected function setUp(): void {
    parent::setUp();
    $this->executeMigrations([
      'user_picture_field',
      'user_picture_field_instance',
      'user_picture_entity_form_display',
    ]);
  }

  /**
   * Tests the field's entity form display settings.
   */
  public function testEntityFormDisplaySettings(): void {
    $component = EntityFormDisplay::load('user.user.default')->getComponent('user_picture');
    $this->assertSame('image_image', $component['type']);
    $this->assertSame('throbber', $component['settings']['progress_indicator']);
    $this->assertSame('thumbnail', $component['settings']['preview_image_style']);
  }

}
