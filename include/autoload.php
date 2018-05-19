<?php

/* ***************************************************************************
 *
 *
 * AUTOLOADER
 *
 *
 */
if( !class_exists('FTIDirectoryHelper'))
{
	final class FTIDirectoryHelper
	{
		protected $directories = array();
		protected $current_path = "";
		
		/**
		 * Call this method to get singleton
		 *
		 * @return FTIDirectoryHelper
		 */
		public static function Instance()
		{
			static $inst = null;
			if ($inst === null) 
			{
				$inst = new FTIDirectoryHelper();
			}
			return $inst;
		}
	
		/**
		 * Private ctor so nobody else can instantiate it
		 *
		 */
		private function __construct()
		{
			
		}
		
		public function getDirectories()
		{
			return $this->directories;
		}
		
		public function setCurrentPath( $current_path )
		{
			if( $current_path !== null )
			{
				$this->current_path = $current_path;
			}	
		}
		
		public function run()
		{
			if( count( $this->directories ) == 0 )
			{
				$this->setDirectories();
			}
			return true;
		}
		
		private function setDirectories()
		{
			$this->directories[] = $this->current_path; // adding root folder
			
			$dir = new DirectoryIterator( $this->current_path );
			foreach ($dir as $i => $fileinfo)
			{
				if ($fileinfo->isDir() && !$fileinfo->isDot())
				{
					$f = $fileinfo->getPathname();
					if( !in_array( $f, $this->directories ) )
					{
						$this->directories[] = $f;
							
						$this->current_path = $fileinfo->getPathname();
						
						$this->setDirectories();
					}
				}
			}
		}
	}
}

if( !class_exists('Autoloader'))
{
	class Autoloader
	{
		protected static $arr_classes = array();
		
		public static function autoload( $classname )
		{
			$ftiDirectoryHelper = FTIDirectoryHelper::Instance();
			$ftiDirectoryHelper->setCurrentPath( FTI_PATH_CLASSES );
			$ftiDirectoryHelper->run();
			$directories = $ftiDirectoryHelper->getDirectories();
			
			// WARNING: on Linux classname contains the namespace, so I get just the name of the Class 
			$tmp = explode('.', strtolower( $classname ));
			if ( strrpos( end( $tmp ), '\\' ) !== false )
				$tmp = explode('\\', strtolower( $classname ));
			$classname = end( $tmp );
			
			//echo "0. ". $classname . "<br />";
			
			foreach( $directories as $sb )
			{
				$filepath = sprintf( '%s%s%s.class.php', $sb, ( strlen( $sb ) > 0 ) ? "" : "", basename( $classname ));
				
				//echo "1. " . $filepath . "<br />";
				
				if( is_readable( $filepath )) 
				{
					if( !in_array( $filepath, self::$arr_classes))
					{
						array_push( self::$arr_classes, $filepath );
						
						//echo "2. " . $filepath . "<br />";
						
						require_once $filepath;
						
						break;
					}
				}
			}
		}
	}
}
spl_autoload_register( "Autoloader::autoload" );