<?php
/**
 * Set-up our autoloader from composer
 */
spl_autoload_register( function($className) {
    
    $calledClass    = str_replace( '\\', DIRECTORY_SEPARATOR, str_replace( '_', '-', strtolower($className) ) );
    $parentDir      = get_template_directory() . DIRECTORY_SEPARATOR;
    
    // Require main parent classes
    $parentClass    = $parentDir . 'classes' . DIRECTORY_SEPARATOR . $calledClass . '.php';

    if( file_exists($parentClass) ) {
        require_once( $parentClass );
        return;
    } 
    
    // Require Vendor (composer) classes
    $classNames     = explode(DIRECTORY_SEPARATOR, $calledClass);
    array_splice($classNames, 2, 0, 'src');

    $vendorClass    = $parentDir . 'vendor' . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, $classNames) . '.php';

    if( file_exists($vendorClass) ) {
        require_once( $vendorClass );    
    }
   
} );

/**
 * Set-up the updater
 */
$updater = MakeitWorkPress\WP_Updater\Boot::instance();
$updater->add(['type' => 'theme', 'source' => 'https://github.com/makeitworkpress/theme-updater-test']);
