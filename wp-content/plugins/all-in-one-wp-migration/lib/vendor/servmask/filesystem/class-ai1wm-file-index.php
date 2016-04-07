<?php
/**
 * Copyright (C) 2014-2016 ServMask Inc.
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * ███████╗███████╗██████╗ ██╗   ██╗███╗   ███╗ █████╗ ███████╗██╗  ██╗
 * ██╔════╝██╔════╝██╔══██╗██║   ██║████╗ ████║██╔══██╗██╔════╝██║ ██╔╝
 * ███████╗█████╗  ██████╔╝██║   ██║██╔████╔██║███████║███████╗█████╔╝
 * ╚════██║██╔══╝  ██╔══██╗╚██╗ ██╔╝██║╚██╔╝██║██╔══██║╚════██║██╔═██╗
 * ███████║███████╗██║  ██║ ╚████╔╝ ██║ ╚═╝ ██║██║  ██║███████║██║  ██╗
 * ╚══════╝╚══════╝╚═╝  ╚═╝  ╚═══╝  ╚═╝     ╚═╝╚═╝  ╚═╝╚══════╝╚═╝  ╚═╝
 */

class Ai1wm_File {
	/**
	 * Create a file with contents
	 *
	 * The method will only create the file if it doesn't already exist.
	 *
	 * @param string $path     Path to the file
	 * @param string $contents Contents of the file
	 *
	 * @return boolean|null
	 */
	public static function create( $path, $contents ) {
		if ( ! is_file( $path ) ) {
			$handle = fopen( $path, 'w' );
			if ( false === $handle ) {
				return false;
			}
			fwrite( $handle, $contents );
			fclose( $handle );
		}
	}
}

class Ai1wm_File_Index {
	/**
	 * Create a index.php file
	 *
	 * The method will create index.php file with contents '<?php // silence is golden' without the single quotes
	 * at the path specified by the argument.
	 *
	 * @param  string  $path Path to the index.php file
	 * @return boolean|null
	 */
	public static function create( $path ) {
		$contents = '<?php // silence is golden';
		return Ai1wm_File::create( $path, $contents );
	}
}

class Ai1wm_File_Htaccess {
	/**
	 * Create .htaccess file
	 *
	 * The method will create .htaccess file with contents 'AddType application/octet-stream .wpress'
	 *
	 * @param  string  $path Path to the .htaccess file
	 * @return boolean|null
	 */
	public static function create( $path ) {
		$contents = "<IfModule mod_mime.c>\nAddType application/octet-stream .wpress\n</IfModule>";
		return Ai1wm_File::create( $path, $contents );
	}
}
