<?php
/**
 * Set-up our autoloader from composer
 */
spl_autoload_register( function($class_name) {
   
    $called_class       = str_replace( '\\', '/', $class_name );
    $class_dir_names    = explode('/', str_replace( '_', '-', $called_class));

    if( ! in_array('MakeitWorkPress', $class_dir_names) ) {
        return;
    }

    $prefix_classes     = '/src/vendor/' . strtolower(array_shift($class_dir_names)) . '/' . strtolower(array_shift($class_dir_names)) . '/src/';
    $package_classes    = implode('/', $class_dir_names);
    $class_file_path    = get_template_directory() . $prefix_classes  . $package_classes . '.php';

    if( file_exists( $class_file_path ) ) {
        require_once( $class_file_path );
    } 
});

/**
 * Set-up the updater
 */
$updater = MakeitWorkPress\WP_Updater\Boot::instance();
$updater->add(['type' => 'theme', 'source' => 'https://github.com/makeitworkpress/theme-updater-test']);
