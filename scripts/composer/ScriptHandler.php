<?php
/**
 * @file
 * Contains \WordpressProject\composer\ScriptHandler.
 */

namespace WordpressProject\composer;

require_once __DIR__ . '/../../vendor/autoload.php';

use Composer\Script\Event;
use WordpressFinder\WordpressFinder;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;

class ScriptHandler {

  public static function createRequiredFiles(Event $event) {

    $fs = new Filesystem();
    $wordpressFinder = new WordpressFinder();
    $wordpressFinder->locateRoot(getcwd());

    $composerRoot = $wordpressFinder->getComposerRoot();

    $dirs = [
      'mu-plugins',
      'plugins',
      'themes',
    ];

    // Create folders for custom plugins and themes.
    foreach ($dirs as $dir) {
      if (!$fs->exists($composerRoot . '/custom/' . $dir)) {
        $fs->mkdir($composerRoot . '/custom/' . $dir);
        $event->getIO()
          ->write("  *  Created $dir directory");
      }
    }
  }

  public static function scaffoldProject(Event $event) {
	  $fs = new Filesystem();
	  $wordpressFinder = new WordpressFinder();
	  $wordpressFinder->locateRoot(getcwd());
	  $composerRoot = $wordpressFinder->getComposerRoot();
	  $dirs = array_filter(glob($composerRoot . '/custom/*'), 'is_dir');
	  foreach ($dirs as $dir) {
		  if ( ! dir_is_empty( $dir ) && $dir === $composerRoot . '/custom/plugins' ) {
			  $fs->mirror( $composerRoot . '/custom/plugins', $composerRoot . '/docroot/wp-content/plugins' );
			  $event->getIO()->write( "Copied Custom Plugins" );
		  }
		  if ( ! dir_is_empty( $dir ) && $dir === $composerRoot . '/custom/mu-plugins' ) {
			  $fs->mirror( $composerRoot . '/custom/mu-plugins', $composerRoot . '/docroot/wp-content/mu-plugins' );
			  $event->getIO()->write( "Copied MU Plugins" );
		  }
		  if ( ! dir_is_empty( $dir ) && $dir === $composerRoot . '/custom/themes' ) {
			  $themes = array_filter( glob( $composerRoot . '/custom/themes/*' ), 'is_dir' );
			  $fs->mirror( $composerRoot . '/custom/themes', $composerRoot . '/docroot/wp-content/themes' );
			  foreach ( $themes as  $theme) {
				  $event->getIO()->write($theme);
				  $theme_array = explode( '/', $theme );
				  $theme_name  = end( $theme_array );
				  if ( $fs->exists( $composerRoot . '/docroot/wp-content/themes/' . $theme_name . '/src' ) ) {
					  $fs->remove( $composerRoot . '/docroot/wp-content/themes/' . $theme_name . '/src' );
				  }
			  }
			  $event->getIO()->write( "Copied Custom Themes" );
		  }
	  }
  }
}

function dir_is_empty($dir) {
	$handle = opendir($dir);
	while (false !== ($entry = readdir($handle))) {
		if ($entry != "." && $entry != "..") {
			closedir($handle);
			return false;
		}
	}
	closedir($handle);
	return true;
}
