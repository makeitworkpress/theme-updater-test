<?php
/**
 * Set-up our autoloader from composer
 */
spl_autoload_register( function($classname) {

    $class      = str_replace( '\\', DIRECTORY_SEPARATOR, str_replace( '_', '-', strtolower($classname) ) );
    $vendor     = str_replace( 'makeitworkpress' . DIRECTORY_SEPARATOR, '', $class );
    $vendor     = 'makeitworkpress' . DIRECTORY_SEPARATOR . preg_replace( '/\//', '/src/', $vendor, 1 ); // Replace the first slash for the src folder
    $vendors    = dirname(__FILE__) .  DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . $vendor . '.php';
    
    if ( file_exists( $vendors) ) {
        include_once $vendors;
    }

} );


/**
 * Set-up the updater
 */
new MakeitWorkPress\WP_Updater\Boot(['type' => 'theme', 'source' => 'https://github.com/makeitworkpress/theme-updater-test']);